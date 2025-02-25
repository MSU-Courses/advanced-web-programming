<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST['title'])) {
        $errors['title'][] = 'Title is required';
    }

    if (strlen($_POST['title']) > 255) {
        $errors['title'][] = 'Title is too long';
    }

    if (empty($_POST['content'])) {
        $errors['content'][] = 'Content is required';
    }

    if (empty($_POST['categories'])) {
        $errors['categories'][] = 'Categories is required';
    }

    if (empty($errors)) {
        $posts[] = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'categories' => $_POST['categories'],
            'date' => date('Y-m-d H:i:s'),
        ];

        file_put_contents($postPath, json_encode($posts));

        header("Location: /article.php?id=" . count($posts));

        die;
    }
}
