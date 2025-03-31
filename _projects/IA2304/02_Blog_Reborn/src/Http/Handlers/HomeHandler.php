<?php

namespace App\Http\Handlers;

class HomeHandler
{
    public static function index()
    {
        echo "Home!";
    }

    public static function indexPost()
    {
        echo "Index Post!";
    }

    public static function article(int $id)
    {
        echo "Article!" . $id;
    }
}
