<?php !defined('PROJECT_NAME') && die(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo PROJECT_NAME; ?></title>
    <link rel="stylesheet" href="./assets/styles/output.css">
</head>

<body>
    <header class="border border-gray-200 text-base">
        <div class="flex justify-between items-center px-16 py-4 font-medium">
            <h1 class=""><?php echo PROJECT_NAME; ?></h1>
            <a href="#" class="py-1 px-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Login</a>
        </div>
    </header>