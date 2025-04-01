<?php

namespace App\Core\Router;

use Closure;

class Route
{
    public HTTPMethod $method;
    public array $params = [];
    public string $route;
    /**
     * @var callable|Closure
     */
    public $handler;

    function __construct(HTTPMethod $method, string $route, callable $handler)
    {
        $this->method = $method;
        $this->route = $route;
        $this->handler = $handler;
    }

    public function matches(string $url, HTTPMethod $method)
    {
        if ($this->method !== $method) {
            return false;
        }

        $urlSegments = explode('/', trim($url, '/'));
        $routeSegments = explode('/', trim($this->route, '/'));

        if (count($urlSegments) !== count($routeSegments)) {
            return false;
        }

        for ($i = 0; $i < count($urlSegments); $i++) {
            if (
                str_starts_with($routeSegments[$i], "{")
                && str_ends_with($routeSegments[$i], "}")
            ) {
                $this->params[substr($routeSegments[$i], 1, -1)] = $urlSegments[$i];
                continue;
            }

            if ($urlSegments[$i] === $routeSegments[$i]) {
                continue;
            }

            return false;
        }

        return true;
    }

    public function execute()
    {
        return call_user_func_array($this->handler, $this->params);
    }
}
