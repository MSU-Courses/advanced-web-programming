<?php

require_once __DIR__ . '/../src/Core/Config.php';
require_once __DIR__ . '/../src/Core/Application.php';  
require_once __DIR__ . '/../src/Core/Router/Router.php';
require_once __DIR__ . '/../src/Core/Router/Route.php';
require_once __DIR__ . '/../src/Http/Handlers/HomeHandler.php';

use App\Core\Application;

Application::boot();