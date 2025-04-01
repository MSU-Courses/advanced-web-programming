<?php

declare(strict_types=1);

namespace App\Core\Router;

class Route
{
    public string $method;
    public string $path;
    public $callback;
    public array $params = [];

    public function __construct(string $method, string $path, callable $callback, array $params = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
        $this->params = $params;
    }
    
    public function match(string $url, string $method): bool
    {
        if ($this->method !== $method) {
            return false;
        }

        $parsedRoute = explode('/', trim($this->path, '/'));
        $parsedUrl = explode('/', trim($url, '/'));

        if (count($parsedRoute) !== count($parsedUrl)) {
            return false;
        }

        for ($i = 0; $i < count($parsedRoute); $i++) {
            if (str_starts_with($parsedRoute[$i], '{')) {
                assert(str_ends_with($parsedRoute[$i], '}'));
                $this->params[] = $parsedUrl[$i];
                continue;
            }

            if ($parsedRoute[$i] === $parsedUrl[$i]) {
                continue;
            }

            return false;
        }

        return true;
    }

    public function execute()
    {
        call_user_func($this->callback, ...$this->params);
    }
}
