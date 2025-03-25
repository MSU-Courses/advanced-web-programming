<?php

use Http\Handlers\HomeHandler;

return [
    '/' => [HomeHandler::class, 'home'],
    '/about' => [HomeHandler::class, 'about'],
];
