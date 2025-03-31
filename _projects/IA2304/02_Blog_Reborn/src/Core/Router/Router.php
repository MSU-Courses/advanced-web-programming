<?php

declare(strict_types=1);

namespace App\Core\Router;

use App\Core\Config;

class Router
{
    public static array $routes;

    public static function addRoute(string $method, string $path, callable $callback)
    {
        self::$routes[$path][$method] = new Route($method, $path, $callback);
    }

    public static function get(string $path, callable $callback)
    {
        self::addRoute('GET', $path, $callback);
    }

    public static function post(string $path, callable $callback)
    {
        self::addRoute('POST', $path, $callback);
    }

    public static function loadRoutes()
    {
        $routeFiles = glob(Config::routeDir . '*.php');

        if (!$routeFiles) {
            throw new \RuntimeException('Failed to load route files.');
        }

        foreach ($routeFiles as $file) {
            require_once $file;
        }
    }

    public static function route(string $url, string $method)
    {
        $url = rtrim($url, '/');

        foreach (self::$routes as $path => $route) {
            if ($route[$method]->match($url, $method)) {
                $route[$method]->execute();
                return;
            }
        }

        http_response_code(404);
        echo "404 Not Found";
        return;
    }
}
