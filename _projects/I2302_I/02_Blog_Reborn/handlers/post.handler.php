<?php

require_once './functions/helpers.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = [
        'title' => sanitizeData($_POST['title']),
        'content' => sanitizeData($_POST['content']),
        'categories' => sanitizeData($_POST['categories'] ?? []),
        'date' => date('Y-m-d H:i:s'),
    ];

    if (empty($data['title'])) {
        $errors['title'][] = 'Title is required';
    }

    if (empty($data['content'])) {
        $errors['content'][] = 'Content is required';
    }

    if (empty($data['categories'])) {
        $errors['categories'][] = 'Categories is required';
    }

    if (strlen($data['title']) > 255) {
        $errors['title'][] = 'Title is too long';
    }

    if (count($errors) === 0) {
        $posts[] = [
            'title' => $data['title'],
            'content' => $data['content'],
            'categories' => $data['categories'],
            'date' => $data['date'],
        ];

        file_put_contents($postsPath, json_encode($posts));

        header("Location: /article.php?id=" . count($posts) - 1);

        die;
    }
}
