<?php

namespace App\Core;

use App\Core\Templater\Templater;

class Application
{
    private Templater $templater;

    public function load()
    {
        Config::load();

        $this->loadTemplate();

        $url = $_SERVER["REQUEST_URI"];
        $method = $_SERVER["REQUEST_METHOD"];

        Router::load();

        Router::route($url, $method);

        // TODO: Load Router


        // temp
        // $this->templater->renderPage('index', [
        //     'title' => 'Hello, World!',
        //     'posts' => [],
        // ]);
    }

    public function loadTemplate()
    {
        $this->templater = new Templater(
            Config::get('template.directory')
        );
    }
}
