<?php

class Route
{
    public string $method;
    public string $path;
    public array $callback;
    public array $params;

    function __construct(string $method, string $path, array $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }

    /**
     * Determines if the given HTTP method and URL match the route's method and path.
     *
     * This method checks if the HTTP method matches the route's method and if the
     * URL structure matches the route's path structure. It also extracts and stores
     * any dynamic parameters from the URL if the route path contains placeholders.
     *
     * @param string $method The HTTP method (e.g., 'GET', 'POST') to match against the route.
     * @param string $url The URL to match against the route's path.
     * @return bool Returns true if the method and URL match the route; otherwise, false.
     */
    public function matches(string $method, string $url)
    {
        if ($this->method !== $method) {
            return false;
        }

        $urlSegments = explode('/', trim($url, '/'));
        $routeSegments = explode('/', trim($this->path, '/'));

        if (count($urlSegments) !== count($routeSegments)) {
            return false;
        }

        for ($i = 0; $i < count($urlSegments); $i++) {
            if (str_starts_with($routeSegments[$i], '{')) {
                assert(str_ends_with($routeSegments[$i], '}'));
                $this->params[trim($routeSegments[$i], '{}')] = $urlSegments[$i];
                continue;
            }

            if ($urlSegments[$i] === $routeSegments[$i]) {
                continue;
            }

            return false;
        }

        return true;
    }

    /**
     * Attempts to execute the route callback if the HTTP method and URL match the route.
     *
     * @param string $metod The HTTP method (e.g., GET, POST) to match against the route.
     * @param string $url The URL to match against the route.
     * @return bool Returns true if the route matches and the callback is executed, false otherwise.
     */
    public function tryExecute(string $metod, string $url)
    {
        if ($this->matches($metod, $url)) {
            call_user_func_array($this->callback, $this->params);
            return true;
        }

        return false;
    }
}
