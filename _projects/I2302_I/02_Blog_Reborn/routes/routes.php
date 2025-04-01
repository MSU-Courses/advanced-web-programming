<?php

use App\Core\Router;
use App\Http\Handlers\HomeHandler;

Router::get('/', [HomeHandler::class, 'home']);
Router::post('/', [HomeHandler::class, 'about']);
Router::get('/article/{id}/{name}', [HomeHandler::class, 'show']);
