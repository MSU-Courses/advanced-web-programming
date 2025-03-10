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
        $templater = new Templater();

        // Routing
        $uri = $_SERVER['REQUEST_URI'];

        switch ($uri) {
            case '/':
                $title = 'My Blog!';
                
                $templater->render('index', [
                    'title' => $title,
                ]);

                break;
            case '/article':
                require '../templates/pages/article/index.php';
            default:
                // 404 error
        }
    }
}
