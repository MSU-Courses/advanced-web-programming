<?php

namespace App\Core\Router\Router;

use App\Core\Router\HTTPMethod;
use App\Core\Router\Route;
use App\Core\Templater\Template;

class Router
{
    /**
     * var Route[] $routes
     */
    protected static array $routes = [];

    public static function route($uri, $method)
    {
        foreach (self::$routes as $route) {
            if ($route->route === $uri && $route->method->value === $method) {
                call_user_func($route->handler);
                return;
            }
        }
    }

    public static function addRoute(HTTPMethod $httpMethod, string $route, callable $handler)
    {
        array_push(self::$routes, new Route($httpMethod, $route, $handler));
    }

    public static function get(string $route, callable $handler)
    {
        self::addRoute(HTTPMethod::GET, $route, $handler);
    }

    public static function post(string $route, callable $handler)
    {
        self::addRoute(HTTPMethod::POST, $route, $handler);
    }
}
