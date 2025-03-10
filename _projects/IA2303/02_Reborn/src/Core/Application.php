<?php

namespace Core;

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

        switch ($uri['path']) {
            case '/':
                require_once Config::templateDir . '/pages/index.php';
                break;
            case '/article':
                require_once Config::templateDir . '/pages/article/index.php';
                break;
            default:
                // 404
        }
    }
}
