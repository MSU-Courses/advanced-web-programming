<?php

namespace App\Core;

use App\Http\Handlers\HomeHandler;
use Route;

class Router
{
    protected static array $routes = [];

    public static function load()
    {
        require_once Config::rootDir . '/routes/routes.php';
    }

    /**
     * Routes the given URL and HTTP method to the appropriate handler.
     *
     * This method iterates through the registered routes and attempts to execute
     * the matching route based on the provided URL and HTTP method. If no matching
     * route is found, it outputs a "404" message.
     *
     * @param string $url The URL to be routed.
     * @param string $method The HTTP method (e.g., GET, POST) associated with the request.
     * @return void
     */
    public static function route(string $url, string $method)
    {
        foreach (self::$routes as $route) {
            if ($route->tryExecute($method, $url)) {
                return;
            }
        }
        echo '404';
    }

    /**
     * Adds a new route to the router.
     *
     * @param string $method The HTTP method for the route (e.g., GET, POST, etc.).
     * @param string $url The URL pattern for the route.
     * @param array $callback The callback associated with the route, typically a controller and method.
     * 
     * @return void
     */
    public static function addRoute(string $method, string $url, array $callback)
    {
        array_push(self::$routes, new Route($method, $url, $callback));
    }

    /**
     * Registers a new GET route with the specified URL and callback.
     *
     * @param string $url The URL pattern for the route.
     * @param array $callback The callback to handle the route, typically a controller and method.
     * @return void
     */
    public static function get(string $url, array $callback)
    {
        self::addRoute('GET', $url, $callback);
    }

    /**
     * Registers a new POST route with the specified URL and callback.
     *
     * @param string $url The URL pattern for the route.
     * @param array $callback The callback to handle the route, typically a controller and method.
     * @return void
     */
    public static function post(string $url, array $callback)
    {
        self::addRoute('POST', $url, $callback);
    }
}
