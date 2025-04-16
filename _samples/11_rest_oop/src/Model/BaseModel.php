<?php

namespace App\Model;

use App\Core\Database;

/**
 * Базовая модель с CRUD-операциями через Query Builder.
 */
abstract class BaseModel
{
   protected string $table;
   protected string $primaryKey = 'id';
   protected Database $db;

   public function __construct()
   {
      $this->db = Database::instance();
   }

   /** Возвращает все записи */
   public function all(): array
   {
      return $this->db->select($this->table);
   }

   /** Находит запись по ID */
   public function find(int $id): ?array
   {
      $rows = $this->db->select(
         $this->table,
         ['*'],
         [$this->primaryKey => $id]
      );
      return $rows[0] ?? null;
   }

   /** Создает запись и возвращает её ID */
   public function create(array $data): int
   {
      return $this->db->insert($this->table, $data);
   }

   /** Обновляет запись по ID, возвращает число затронутых строк */
   public function update(int $id, array $data): int
   {
      return $this->db->update(
         $this->table,
         $data,
         [$this->primaryKey => $id]
      );
   }

   /** Удаляет запись по ID, возвращает число затронутых строк */
   public function delete(int $id): int
   {
      return $this->db->delete(
         $this->table,
         [$this->primaryKey => $id]
      );
   }
}
