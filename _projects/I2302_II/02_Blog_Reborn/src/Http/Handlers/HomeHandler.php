<?php

use App\Core\Config;
use App\Core\Template\Templater;

class HomeHandler
{
    public function home()
    {
        $templater = new Templater(Config::rootDir . 'templates');

        return $templater->renderPage('/index', [
            'title' => 'Home Page',
            'content' => 'Welcome to the Home Page'
        ]);
    }

    public function about()
    {
        echo 'About Page';
    }
}
