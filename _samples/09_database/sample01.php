<?php

$config = require_once('config.php');

// Connect to PostgreSQL

$pdo = "";

try {
    $dsn = "pgsql:host={$config['host']};dbname={$config['db']}";
    $pdo = new PDO($dsn, $config['user'], $config['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die($exception->getMessage());
}

// Create table

$sql = "
    CREATE TABLE IF NOT EXISTS test (
        id SERIAL PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );
";

try {
    $pdo->query($sql);
    echo "Table created successfully.";
} catch (PDOException $exception) {
    die($exception->getMessage());
}

/**
 * Insert data into the table
 */

// simulate user input

// $name = "Jolly Doe";

// $sql = "
//     INSERT INTO test (name) VALUES (:name);
// ";

// try {
//     $stmt = $pdo->prepare($sql);
//     $stmt->execute([
//         ':name' => $name
//     ]);
//     $lastId = $pdo->lastInsertId();
//     echo "Data Inserted successfully. Last inserted ID: " . $lastId;
// } catch (PDOException $exception) {
//     die($exception->getMessage());
// }

/**
 * Select data from the table
 */

// simulate user input

//$name = "John Doe' OR 1=1; -- ";
$name = "John Doe";

$sql = "
    SELECT * FROM test WHERE name = :name
";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name
    ]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Data selected successfully.";
} catch (PDOException $exception) {
    die($exception->getMessage());
}
