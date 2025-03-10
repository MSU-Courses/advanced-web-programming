<?php

/**
 * Retrieves and formats an error message for a specific key.
 *
 * @param array $errors An associative array of error messages.
 * @param string $key The key to look for in the errors array.
 * 
 * @return string The formatted error message if the key exists, otherwise an empty string.
 */
function getError($errors, $key)
{
    if (isset($errors[$key])) {
        return '<p class="text-red-500">* ' . $errors[$key] . '</p>';
    }

    return '';
}


/**
 * Sanitize a given string by trimming, stripping tags, and converting special characters to HTML entities.
 *
 * @param string $data The input string to be sanitized.
 * @return string The sanitized string.
 */
function sanitize(string $data)
{
    return htmlentities(strip_tags(trim($data)));
}
