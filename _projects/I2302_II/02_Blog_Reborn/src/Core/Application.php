<?php

/**
 * Class Application
 *
 * This class represents the core application.
 */
class Application
{
    public function run()
    {
        $templater = new Templater(__DIR__ . '/../../templates', __DIR__ .  '/../../public');

        // Routing
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                $title = 'My Blog!';

                $templater->renderPage('/index', [
                    'title' => $title,
                ]);

                break;
            case '/article':
                $posts = [
                    [
                        'title' => 'My first post',
                        'content' => 'This is my first post. Welcome!',
                        'date' => '2021-01-01',
                    ],
                    [
                        'title' => 'My second post',
                        'content' => 'This is my second post. Welcome!',
                        'date' => '2021-01-02',
                    ],
                    [
                        'title' => 'My third post',
                        'content' => 'This is my third post. Welcome!',
                        'date' => '2021-01-03',
                    ],
                ];

                $templater->renderPage('/article/index', compact('posts'));
                break;
            default:
                // 404 error
        }
    }
}
