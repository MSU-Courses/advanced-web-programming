<?php

use App\Core\Router\Router\Router;
use App\Http\Handlers\HomeHandler;

Router::get('/', [HomeHandler::class, 'home']);