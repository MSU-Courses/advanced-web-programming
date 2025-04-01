<?php

namespace App\Core;

use App\Core\Router\Router;

class Application
{
    public static function boot()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        Router::loadRoutes();

        Router::route($url, $method);
    }
}
