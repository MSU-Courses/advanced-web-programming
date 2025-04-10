<?php

/**
 * Generates a cryptographically secure random token.
 *
 * @param int $size The size of the random bytes to generate. Defaults to 32.
 *                   The resulting token will be twice this size in length
 *                   due to hexadecimal encoding.
 * @return string A hexadecimal representation of the generated random bytes.
 * @throws Exception If it was not possible to gather sufficient entropy.
 */
function generateToken(int $size = 32)
{
    return bin2hex(random_bytes($size / 2));
}

/**
 * Sets a token as a cookie with a specified expiry time.
 *
 * This function retrieves the token expiry time and cookie name
 * from the application's configuration, then sets the token
 * as a cookie accessible across the entire domain.
 *
 * @param string $token The token to be stored in the cookie.
 *
 * @return void
 */
function setTokenToCookie(string $token): void
{
    $expiry = time() + config('session.remember_token_expiry');
    setcookie(config('session.remember_token_name'), $token, $expiry, '/', httponly: true);
}

/**
 * Deletes the authentication token from the user's browser cookies.
 *
 * This function sets the cookie with the name specified in the configuration
 * (using the 'remember_token_name' key) to an empty value and sets its expiry
 * time to a past timestamp, effectively removing it from the browser.
 *
 * @return void
 */
function deleteTokenFromCookie(): void
{
    $expiry = time() - config('session.remember_token_expiry');
    setcookie(config('session.remember_token_name'), '', $expiry, '/', httponly: true);
}

/**
 * Checks if the user has a "remember me" cookie set.
 *
 * This function determines whether the user has opted to be remembered
 * by checking for the presence of a specific cookie. The cookie name
 * is retrieved from the application's configuration using the key
 * 'session.remember_token_name'.
 *
 * @return bool True if the "remember me" cookie is set, false otherwise.
 */
function isRemembered(): bool
{
    return isset($_COOKIE[config('session.remember_token_name')]);
}
