
<?php
/**
 * This script handles simple routing for a PHP application.
 * 
 * It requires the routes configuration file and processes the incoming request URI and method.
 * 
 * The script iterates over the defined routes for the given request method and matches the URI against each route pattern.
 * If a match is found, the corresponding action is executed with any extracted parameters.
 * 
 * If no match is found, a 404 Not Found response is returned.
 * 
 * @requires ../src/routes.php
 * 
 * @global array $routes The array of routes defined in the routes configuration file.
 * @global string $uri The request URI.
 * @global string $method The request method (GET, POST, etc.).
 * 
 * @return void
 */


require_once __DIR__ . '../src/handlers/index.php';
require_once __DIR__ . '../src/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$method = $_SERVER['REQUEST_METHOD'];

foreach ($routes[$method] as $route => $action) {
    $pattern = "@^" . preg_replace('/\(\d+\)/', '(\d+)', $route) . "$@";
    if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches);
        $action(...$matches);
        exit;
    }
}

http_response_code(404);
echo "404 Not Found";
