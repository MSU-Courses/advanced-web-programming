<?php

if (!defined('APP_NAME')) {
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts[] = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'date' => date('Y-m-d'),
        'categories' => explode(',', $_POST['categories']),
    ];

    file_put_contents('./data/posts.json', json_encode($posts));

    header('Location: /article.php?id=' . count($posts));

    return;
}
