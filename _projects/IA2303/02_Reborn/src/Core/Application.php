<?php

namespace App\Core;

use App\Core\Router\Router\Router;
use App\Core\Templater\Template;

class Application
{
    /**
     * Application entry point
     */
    public function run()
    {
        // Load configuration
        Config::load();

        // Routing
        $uri = parse_url($_SERVER['REQUEST_URI']);
        $method = $_SERVER['REQUEST_METHOD'];

        require_once Config::rootDir . '/routes/routes.php';

        Router::route($uri['path'], $method);
    }
}
