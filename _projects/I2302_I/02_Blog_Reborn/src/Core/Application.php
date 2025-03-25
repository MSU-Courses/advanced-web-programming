<?php

namespace Core;

use Core\Templater\Templater;




class Application
{
    private Templater $templater;

    public function load()
    {
        Config::load();

        $this->loadTemplate();

        $url = $_SERVER["REQUEST_URI"];

        Router::load();

        Router::route($url);

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
