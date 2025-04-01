<?php

use App\Core\Router\Router;

use App\Http\Handlers\HomeHandler;

// Router::get('/', [HomeHandler::class, 'index']);

Router::get('/article/{id}/edit', [HomeHandler::class, 'article']);

// Router::post('/', [HomeHandler::class, 'indexPost']);
