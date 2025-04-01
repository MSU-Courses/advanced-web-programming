<?php

namespace App\Http\Handlers;

class HomeHandler
{
    public static function home()
    {
        echo 'Hello, World!';
    }

    public static function about()
    {
        echo 'About Us';
    }

    public static function show(int $id, string $name)
    {
        echo 'Store' . $id . " " . $name;
    }
}
