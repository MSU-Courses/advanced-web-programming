<?php

namespace App\Http\Handlers;

use App\Core\Templater\Template;

class HomeHandler {
    public static function home() {
        Template::render('index', ['title' => 'Home']);
    }
}