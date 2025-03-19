<?php

$routes = [
    'POST' => [
        '/login' => 'login',
    ],
    'GET' => [
        '/' => 'home',
        '/about' => 'about',
        '/article/(\d+)' => 'showArticle',
    ],
];
