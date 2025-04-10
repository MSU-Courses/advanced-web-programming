<?php

/**
 * Checks if the user is authenticated.
 *
 * This function determines whether a user is currently authenticated
 * by checking if the 'user_id' key exists in the session data.
 *
 * @return bool Returns true if the user is authenticated, false otherwise.
 */
function isAuthenticated(): bool
{
    return getUserSession() ? true : false;
}

/**
 * Sets the user ID in the session.
 *
 * This function stores the given user ID in the session under the key 'user_id'.
 *
 * @param int $userId The ID of the user to be stored in the session.
 *
 * @return void
 */
function setUserSession(int $userId): void
{
    setSession('user_id', $userId);
}

/**
 * Retrieves the user ID from the current session.
 *
 * @return int|null Returns the user ID if it exists in the session, or null if not set.
 */
function getUserSession(): ?int
{
    return getSession('user_id');
}


/**
 * Redirects the user to a specified path if they are authenticated.
 *
 * This function checks if the user is authenticated by calling the 
 * `isAuthenticated()` function. If the user is authenticated, it sends 
 * an HTTP header to redirect them to the specified path and terminates 
 * the script execution.
 *
 * @param string $path The path to redirect the user to if authenticated.
 *
 * @return void
 */
function redirectIfAuthenticated(string $path): void
{
    if (isAuthenticated()) {
        header("Location: $path");
        exit;
    }
}
