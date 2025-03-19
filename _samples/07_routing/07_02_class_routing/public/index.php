<?php

require_once __DIR__ . '/../routes/web.php';

// Get the request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Get the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Dispatch the request
$router->dispatch($requestMethod, $requestUri);
