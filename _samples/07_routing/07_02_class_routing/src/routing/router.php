<?php

class Router
{
    private $routes = [];

    /**
     * Adds a new route to the router.
     *
     * @param string $method The HTTP method (e.g., GET, POST) for the route.
     * @param string $url The URL pattern for the route.
     * @param callable|string $action The action to be executed when the route is matched.
     */
    public function addRoute($method, $url, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'action' => $action
        ];
    }

    /**
     * Dispatches the request to the appropriate route action based on the HTTP method and URL.
     *
     * @param string $method The HTTP method of the request (e.g., 'GET', 'POST').
     * @param string $url The URL of the request.
     * @return mixed The result of the route action if a matching route is found, otherwise null.
     */
    public function dispatch($method, $url)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['url'] === $url) {
                return call_user_func($route['action']);
            }
        }
        return null;
    }
}
