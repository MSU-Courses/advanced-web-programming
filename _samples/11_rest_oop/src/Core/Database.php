<?php

namespace App\Core;

use PDO;
use PDOException;
use InvalidArgumentException;
use RuntimeException;

/**
 * Менеджер подключений к БД и простой Query Builder.
 */
class Database
{
   private static array $connections = [];
   private static array $config;
   private PDO $pdo;

   /**
    * Инициализация: загружаем конфиг один раз.
    */
   public static function init(string $configPath): void
   {
      if (!file_exists($configPath)) {
         throw new InvalidArgumentException("Config file not found: {$configPath}");
      }
      self::$config = require $configPath;
   }

   /**
    * Получаем PDO-инстанс по имени подключения.
    */
   public static function getConnection(string $name = ""): PDO
   {
      $name = self::$config['default'] ?? array_key_first(self::$config['connections']);

      if (isset(self::$connections[$name])) {
         return self::$connections[$name];
      }

      if (!isset(self::$config['connections'][$name])) {
         throw new InvalidArgumentException("Connection \"{$name}\" is not configured.");
      }

      $cfg = self::$config['connections'][$name];
      $dsn = self::buildDsn($cfg);

      try {
         $pdo = new PDO($dsn, $cfg['username'] ?? null, $cfg['password'] ?? null, $cfg['options'] ?? []);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
         throw new RuntimeException("DB connection failed ({$name}): " . $e->getMessage(), (int)$e->getCode());
      }

      return self::$connections[$name] = $pdo;
   }

   /**
    * Строим DSN для разных драйверов.
    */
   private static function buildDsn(array $cfg): string
   {
      return match ($cfg['driver']) {
         'mysql' => sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $cfg['host'],
            $cfg['port'] ?? 3306,
            $cfg['database'],
            $cfg['charset'] ?? 'utf8mb4'
         ),
         'pgsql' => sprintf(
            'pgsql:host=%s;port=%d;dbname=%s',
            $cfg['host'],
            $cfg['port'] ?? 5432,
            $cfg['database']
         ),
         'sqlite' => 'sqlite:' . $cfg['database'],
         default => throw new InvalidArgumentException("Unsupported driver: {$cfg['driver']}")
      };
   }

   /**
    * Конструктор закрыт: используем статический getInstance().
    */
   private function __construct(PDO $pdo)
   {
      $this->pdo = $pdo;
   }

   /**
    * Возвращает экземпляр Database для работы с Query Builder.
    */
   public static function instance(string $name = ""): self
   {
      $pdo = self::getConnection($name);
      return new self($pdo);
   }

   /**
    * Выполняет SELECT.
    * @param string $table
    * @param array|string $columns
    * @param array $where ['col' => value]
    */
   public function select(string $table, array|string $columns = ['*'], array $where = []): array
   {
      $cols = is_array($columns) ? implode(', ', $columns) : $columns;
      $sql = "SELECT {$cols} FROM {$table}";
      $params = [];
      if ($where) {
         $conds = array_map(fn($col) => "{$col} = :{$col}", array_keys($where));
         $sql .= ' WHERE ' . implode(' AND ', $conds);
         $params = $where;
      }
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($params);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }

   /**
    * Выполняет INSERT.
    */
   public function insert(string $table, array $data): int
   {
      $cols = array_keys($data);
      $placeholders = array_map(fn($col) => ":{$col}", $cols);
      $sql = sprintf(
         "INSERT INTO %s (%s) VALUES (%s)",
         $table,
         implode(', ', $cols),
         implode(', ', $placeholders)
      );
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($data);
      return (int)$this->pdo->lastInsertId();
   }

   /**
    * Выполняет UPDATE.
    */
   public function update(string $table, array $data, array $where): int
   {
      $set = array_map(fn($col) => "{$col} = :set_{$col}", array_keys($data));
      $cond = array_map(fn($col) => "{$col} = :where_{$col}", array_keys($where));
      $sql = sprintf(
         "UPDATE %s SET %s WHERE %s",
         $table,
         implode(', ', $set),
         implode(' AND ', $cond)
      );
      $params = [];
      foreach ($data as $k => $v) {
         $params["set_{$k}"] = $v;
      }
      foreach ($where as $k => $v) {
         $params["where_{$k}"] = $v;
      }
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($params);
      return $stmt->rowCount();
   }

   /**
    * Выполняет DELETE.
    */
   public function delete(string $table, array $where): int
   {
      $conds = array_map(fn($col) => "{$col} = :{$col}", array_keys($where));
      $sql = sprintf(
         "DELETE FROM %s WHERE %s",
         $table,
         implode(' AND ', $conds)
      );
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($where);
      return $stmt->rowCount();
   }
}
