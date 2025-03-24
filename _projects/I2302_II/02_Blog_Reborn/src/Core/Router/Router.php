<?php

namespace App\Core\Router;

class Router
{
    /**
     * @var Route[]
     */
    private static $routes = [];

    public static function addRoute(HttpMethod $method, string $url, string|array $handler)
    {
        self::$routes[] = new Route($method, $url, $handler);
    }

    public static function get(string $url, string|array $handler)
    {
        self::addRoute(HttpMethod::GET, $url, $handler);
    }

    public static function post(string $url, string|array $handler)
    {
        self::addRoute(HttpMethod::POST, $url, $handler);
    }

    public static function handle(string $url, string $method)
    {
        foreach (self::$routes as $route) {
            if ($route->matches(self::getMethod($method), $url)) {
                $route->execute();
                return;
            }
        }

        echo "404 - Not Found";
    }

    public static function getMethod(string $method): HttpMethod
    {
        return match ($method) {
            'GET' => HttpMethod::GET,
            'POST' => HttpMethod::POST,
            'PUT' => HttpMethod::PUT,
            'DELETE' => HttpMethod::DELETE,
            'PATCH' => HttpMethod::PATCH,
            'OPTIONS' => HttpMethod::OPTIONS,
            'HEAD' => HttpMethod::HEAD,
            'TRACE' => HttpMethod::TRACE,
            'CONNECT' => HttpMethod::CONNECT,
        };
    }
}
