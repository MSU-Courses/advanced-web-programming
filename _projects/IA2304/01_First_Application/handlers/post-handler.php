<?php

require_once './functions/http.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    print_r(sanitize($_POST['title'] ?? ""));
    $data = [
        'title' => sanitize($_POST['title'] ?? ""),
        'content' => sanitize($_POST['content'] ?? ""),
        'categories' => $_POST['categories'] ?? [],
    ];

    // validation

    if (empty($data['title'])) {
        $errors['title'] = 'Title is required';
    }

    if (empty($data['content'])) {
        $errors['content'] = 'Content is required';
    }

    if (empty($data['categories'])) {
        $errors['categories'] = 'Categories is required';
    }

    if (strlen($data['title']) > 255) {
        $errors['title'] = 'Title is too long';
    }

    if (count($errors) === 0) {
        $posts[] = [
            'title' => $data['title'],
            'content' => $data['content'],
            'categories' => $data['categories'],
            'date' => date('Y-m-d H:i:s')
        ];

        file_put_contents($postPath, json_encode($posts));

        route('/');

        return;
    }

    sendHttpStatus(HTTP_STATUS_CODES::BAD_REQUEST);
}
