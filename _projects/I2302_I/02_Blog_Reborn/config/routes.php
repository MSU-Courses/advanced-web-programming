<?php

use App\Http\Handlers\HomeHandler;

return [
    '/' => [HomeHandler::class, 'home'],
    '/about' => [HomeHandler::class, 'about'],
];
