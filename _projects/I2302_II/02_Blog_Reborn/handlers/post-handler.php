<?php

if (!defined('APP_NAME')) {
    die();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title'])) {
        $errors['title'] = 'Title is required';
    }

    if (empty($_POST['content'])) {
        $errors['content'] = 'Content is required';
    }

    if (strlen($_POST['title']) > 255) {
        $errors['title'] = 'Title is too long';
    }

    if (strlen($_POST['content']) > 1000) {
        $errors['content'] = 'Content is too long';
    }

    if (count($errors) === 0) {
        $posts[] = [
            'title' => htmlentities($_POST['title']),
            'content' => htmlentities($_POST['content']),
            'date' => date('Y-m-d'),
            'categories' => empty($_POST['categories']) ?
                ['Unknown'] :
                explode(',', htmlentities(($_POST['categories']))),
        ];

        file_put_contents('./data/posts.json', json_encode($posts));

        header('Location: /article.php?id=' . count($posts));

        return;
    }

}
