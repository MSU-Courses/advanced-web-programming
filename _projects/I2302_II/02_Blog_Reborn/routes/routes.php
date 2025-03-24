<?php

require_once '../src/Http/Handlers/HomeHandler.php';

use App\Core\Router\Router;

Router::get('/', [HomeHandler::class, 'home']);
Router::get('/about', [HomeHandler::class, 'about']);