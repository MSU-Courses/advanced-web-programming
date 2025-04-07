<?php

// OOP 

class Database
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        $this->connect($config);
    }

    private function connect(array $config)
    {
        try {
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['db']}";
            $this->pdo = new PDO($dsn, $config['user'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }
    }

    public function insert(string $table, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return $this->pdo->lastInsertId();
        } catch (PDOException $exception) {
            throw $exception;
        }
    }

    public function select(string $table, array $columns = ["*"], array $conditions = [])
    {
        $columns = implode(", ", $columns);
        $sql = "SELECT {$columns} FROM {$table}";

        if (!empty($conditions)) {
            $sql .= " WHERE ";
            foreach ($conditions as $index => $condition) {
                if ($index > 0) {
                    $sql .= " AND ";
                }
                $sql .= "{$condition[0]} {$condition[1]} :{$condition[0]}";
            }
        }


        try {
            $stmt = $this->pdo->prepare($sql);
            foreach ($conditions as $condition) {
                $stmt->bindValue(":{$condition[0]}", $condition[2]);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            throw $exception;
        }
    }
}

// usage

$config = require_once 'config.php';

$db = new Database($config);

// $db->insert('test', [
//     'name' => 'Anny Doe',
// ]);

$result = $db->select('test', ['name'], [
    ['name', 'LIKE', '%Doe%']
]);

print_r($result);
