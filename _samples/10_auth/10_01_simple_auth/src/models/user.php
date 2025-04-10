<?php

/**
 * Checks if a user exists in the database by their email address.
 *
 * This function queries the database to determine if a user with the
 * specified email address exists. It returns true if the user exists,
 * and false otherwise.
 *
 * @param string $email The email address to check for existence.
 * @return bool True if the user exists, false otherwise.
 */
function userExists(string $email): bool
{
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    return (bool) $stmt->fetchColumn();
}

/**
 * Finds a user by their username (email) in the database.
 *
 * @param string $username The username (email) to search for.
 * @param array $columns An optional array of column names to retrieve. Defaults to all columns ['*'].
 * @return array|null Returns an associative array of the user data if found, or null if no user is found.
 */
function findUserByUsername(string $username, array $columns = ['*']): ?array
{
    $pdo = getDatabaseConnection();
    $selectFields = implode(',', $columns);
    $stmt = $pdo->prepare("SELECT {$selectFields} FROM users WHERE email = ?");
    $stmt->execute([$username]);
    return $stmt->fetch() ?: null;
}

/**
 * Finds a user by their ID and retrieves specified columns from the database.
 *
 * @param int $userId The ID of the user to find.
 * @param array $columns An array of column names to retrieve. Defaults to ['*'] for all columns.
 * @return array|null An associative array of the user's data if found, or null if no user is found.
 *
 * @global PDO $pdo The global PDO instance used for database interaction.
 */
function findUserById(int $userId, array $columns = ['*']): ?array
{
    $pdo = getDatabaseConnection();
    $selectFields = implode(',', $columns);
    $stmt = $pdo->prepare("SELECT {$selectFields} FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch() ?: null;
}

/**
 * Finds a user in the database by their remember token.
 *
 * @param string $token The remember token used to identify the user.
 * 
 * @return array|null Returns an associative array of the user's data if found, 
 *                    or null if no user is found with the given token.
 */
function findUserByToken(string $token): ?array
{
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE remember_token = ? LIMIT 1");
    $stmt->execute([$token]);
    return $stmt->fetch() ?: null;
}

/**
 * Updates the remember token for a specific user in the database.
 *
 * @param int $userId The ID of the user whose token is being updated.
 * @param string $token The new remember token to be set for the user.
 * 
 * @return bool Returns true on success or false on failure.
 */
function updateUserToken(int $userId, string $token): bool
{
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
    return $stmt->execute([$token, $userId]);
}

/**
 * Saves a new user to the database with the provided email and password.
 *
 * @param string $email The email address of the user to be saved.
 * @param string $password The password of the user to be saved.
 * @return bool Returns true on successful insertion, false otherwise.
 */
function saveUser(string $name, string $email, string $password): bool
{
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $email, $password]);
}
