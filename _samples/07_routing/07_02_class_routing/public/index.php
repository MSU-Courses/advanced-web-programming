<?php

require_once __DIR__ . '/../routes/web.php';

// Get the request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Get the request URI
$requestUri = $_SERVER['REQUEST_URI'];

// Dispatch the request
$router->dispatch($requestMethod, $requestUri);
