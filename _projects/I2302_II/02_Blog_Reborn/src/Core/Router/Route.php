<?php

namespace App\Core\Router;

class Route
{
    public HttpMethod $method;
    public string $url;
    public $handler;

    public function __construct(HttpMethod $method, string $url, $handler)
    {
        $this->method = $method;
        $this->url = $url;
        $this->handler = $handler;
    }

    public function matches(HttpMethod $method, string $url): bool
    {
        return $this->method === $method && $this->url === $url;
    }

    public function execute()
    {
        if (is_string($this->handler)) {
            $handler = new $this->handler();
            $handler();
        } else {
            $handler = new $this->handler[0]();
            $method = $this->handler[1];
            $handler->$method();
        }
    }
}
