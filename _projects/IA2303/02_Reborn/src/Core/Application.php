<?php

namespace Core;

use Core\Templater\Template;

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
                Template::render('index', ['title' => 'World!']);
                break;
            case '/article':
                Template::render('article/index', [
                    'posts' =>   [
                        [
                            'title' => 'Post 1',
                            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                            'date' => '2021-01-01'
                        ],
                        [
                            'title' => 'Post 2',
                            'content' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                            'date' => '2021-01-02'
                        ],
                        [
                            'title' => 'Post 3',
                            'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                            'date' => '2021-01-03'
                        ],
                        [
                            'title' => 'Post 3',
                            'content' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
                            'date' => '2021-01-03'
                        ],
                    ]
                ]);
                break;
            default:
                // 404
        }
    }
}
