<?php

namespace App\Core\Router;

use Closure;

class Route
{
    public HTTPMethod $method;
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
}
