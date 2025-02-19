<?php

if (!defined('APP_NAME')) {
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="./assets/styles/output.css">
</head>

<body>
    <header class="border border-gray-200 py-3 px-8 lg:px-16">
        <div class="mx-auto flex justify-between items-center font-medium text-base">
            <h1>Blog App</h1>
            <a href="#">
                <button class="bg-blue-700 py-1 px-4 rounded-md text-white">Login</button>
            </a>
        </div>
    </header>