<?php

require_once __DIR__ . '/../src/routing/router.php';

$router = new Router();

$router->addRoute('GET', '/', 'showHome');
$router->addRoute('GET', '/about', 'showAbout');
$router->addRoute('GET', '/article/(\d+)', 'showArticle');
$router->addRoute('POST', '/login', 'login');
