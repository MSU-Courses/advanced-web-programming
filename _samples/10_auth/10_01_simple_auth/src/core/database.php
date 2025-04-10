<?php

/**
 * Establishes and returns a singleton PDO database connection.
 *
 * This function uses a static variable to ensure that only one PDO instance
 * is created and reused throughout the application. The database configuration
 * is loaded from a separate configuration file.
 *
 * @return PDO The PDO instance representing the database connection.
 *
 * @throws PDOException If an error occurs while attempting to connect to the database.
 */
function getDatabaseConnection()
{
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    try {
        $pdo = new PDO(
            sprintf(
                '%s:host=%s;dbname=%s;charset=utf8',
                config('database.driver'),
                config('database.hose'),
                config('database.database')
            ),
            config('database.username'),
            config('database.password')
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("An error occurred while connecting to the database: " . $e->getMessage());
    }

    return $pdo;
}
