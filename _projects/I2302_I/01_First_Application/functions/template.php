<?php


/**
 * Print form errors.
 * 
 * @param array $errors
 * @param string $field
 * 
 * @return void
 */
function printFormErrors($errors, $field)
{
    foreach ($errors[$field] ?? [] as $error) {
        echo "<p class='text-red-500'>* $error</p>";
    }
}
