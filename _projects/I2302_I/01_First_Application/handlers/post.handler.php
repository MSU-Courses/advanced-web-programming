<?php

require_once './functions/helpers.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $posts[] = [
        'title' => sanitizeData($_POST['title']),
        'content' => sanitizeData($_POST['content']),
        'categories' => sanitizeData($_POST['categories']),
        'date' => date('Y-m-d H:i:s'),
    ];

    file_put_contents($postsPath, json_encode($posts));

    header("Location: /article.php?id=" . count($posts) - 1);

    die;
}