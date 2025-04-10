<?php

/**
 * Sets a value in the session under the specified key.
 *
 * @param string $key The key under which the value will be stored in the session.
 * @param mixed $value The value to be stored in the session.
 *
 * @return void
 */
function setSession(string $key, mixed $value): void
{
    $_SESSION[$key] = $value;
}

/**
 * Retrieves a value from the session using the specified key.
 *
 * @param string $key The key to look for in the session.
 * @return mixed The value associated with the key, or null if the key does not exist.
 */
function getSession(string $key): mixed
{
    return $_SESSION[$key] ?? null;
}


/**
 * Invalidates the current session and starts a new one.
 *
 * This function performs the following steps:
 * 1. Unsets all session variables.
 * 2. Destroys the current session.
 * 3. Regenerates the session ID to prevent session fixation attacks.
 * 4. Deletes the session's "remember me" cookie by setting its expiration time to the past.
 * 5. Starts a new session.
 */
function sessionInvalidate()
{
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);
}
