<?php

/**
 * Render error message if exist
 * 
 * @param array $errors Errors array
 * @param string $key Input name
 * 
 * @return void
 */
function renderErrorIfExist($errors, $key) {
    if (isset($errors[$key])) {
        echo "<span class='text-red-500'>* {$errors[$key]}</span>";
    }
}