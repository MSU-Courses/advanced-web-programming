<?php

/**
 * Attempts to load a user from a session token stored in cookies.
 *
 * This function checks if a user session is already active. If not, it retrieves
 * a token from the cookies, validates it, and attempts to find the associated user.
 * If a valid user is found, the session ID is regenerated for security purposes,
 * and the user's ID is stored in the session.
 *
 * @return bool Returns true if a user is successfully loaded from the token, 
 *              otherwise false.
 */
function tryLoadUserFromToken(): void
{
    $tokenName = config('session.remember_token_name');

    $token = $_COOKIE[$tokenName] ?? null;

    if (!isset($token)) {
        return;
    }

    $user = findUserByToken($token, ["id"]);

    session_regenerate_id(true);

    if ($user) {
        setUserSession($user['id']);
        return;
    }

    return;
}

/**
 * Retrieves the currently authenticated user from the session.
 *
 * This function uses a static variable to cache the user object, ensuring
 * that the user is only fetched once per request. If no user is authenticated,
 * it returns null.
 *
 * @return mixed The authenticated user object if a user is logged in, or null if no user is authenticated.
 */
function getCurrentUser()
{
    static $cachedUser = null;

    if ($cachedUser !== null) {
        return $cachedUser;
    }

    if (!isAuthenticated()) {
        return null;
    }

    $cachedUser = findUserById($_SESSION['user_id']);

    return $cachedUser;
}



/**
 * Authenticates a user by setting up their session and optionally remembering them.
 *
 * @param int $userId The ID of the user to authenticate.
 * @param bool $remember Optional. Whether to remember the user across sessions. Defaults to false.
 * 
 * @return bool Returns true on successful authentication.
 *
 * This function regenerates the session ID for security purposes, sets the user session,
 * and if the $remember parameter is true, generates a token, stores it in a cookie, 
 * and updates the user's token in the database.
 */
function authenticate($userId, $remember = false): bool
{
    session_regenerate_id(true);

    setUserSession($userId);

    if ($remember) {
        $token = generateToken();
        setTokenToCookie($token);
        updateUserToken($userId, $token);
    }

    return true;
}

/**
 * Attempts to authenticate a user with the provided email and password.
 *
 * @param string $email The email address of the user attempting to log in.
 * @param string $password The plaintext password provided by the user.
 * @param bool $remember Whether to remember the user for future sessions.
 * 
 * @return bool Returns true if authentication is successful, false otherwise.
 */
function tryAttemp(string $email, string $password, bool $remember): array|null
{
    $errors = [];

    if (isAuthenticated()) {
        header('Location: /');
        exit;
    }

    $user = findUserByUsername($email, ['id', 'password']);

    if (!$user) {
        $errors[] = "Login or password is incorrect.";
        return $errors;
    }

    if (!password_verify($password, $user['password'])) {
        $errors[] = "Login or password is incorrect.";
        return $errors;
    }

    authenticate($user['id'], $remember);

    return null;
}

/**
 * Logs the user out by invalidating the current session, 
 * deleting the authentication token from the cookie, 
 * and redirecting the user to the login page.
 *
 * @return void
 */
function logoutHandler()
{
    sessionInvalidate();
    if (isRemembered()) {
        deleteTokenFromCookie();
    }
    header('Location: /login');
    return;
}
