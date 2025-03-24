<?php

namespace App\Core;

use App\Core\Router\Router;
use App\Core\Template\Templater;

/**
 * Class Application
 *
 * This class represents the core application.
 */
class Application
{
    public function run()
    {
        $templater = new Templater(Config::rootDir . 'templates');

        // Routing
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        
        $this->route($uri, $method);
    }

    public function route(string $url, string $method)
    {
        require_once Config::rootDir . 'routes/routes.php';

        Router::handle($url, $method);
    }
}
