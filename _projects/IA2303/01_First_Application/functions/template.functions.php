<?php

if (!defined('PROJECT')) {
    die();
}


/**
 * Print form error
 * 
 * @param array $errors
 * @param string $field
 * 
 * @return void
 */
function printFormError(array $errors, string $field)
{
    foreach ($errors[$field] ?? [] as $error) {
        echo "<p class='text-red-500 text-sm'>* $error</p>";
    }
}
