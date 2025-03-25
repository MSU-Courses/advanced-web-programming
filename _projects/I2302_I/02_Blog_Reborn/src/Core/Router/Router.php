<?php

namespace App\Core;

class Router
{
    protected static array $routes = [];

    public static function load()
    {
        self::$routes = Config::get('routes');
    }

    public static function route(string $url)
    {
        if (array_key_exists($url, self::$routes)) {
            self::$routes[$url]();
            return;
        }
        echo '404';
    }
}
