<?php

use App\Core\Application;

require_once '../src/Core/Application.php';
require_once '../src/Core/Config.php';
require_once '../src/Core/Template/Templater.php';
require_once '../src/Core/Router/Router.php';
require_once '../src/Core/Router/HttpMethod.php';
require_once '../src/Core/Router/Route.php';
require_once '../src/Http/Handlers/HomeHandler.php';

$app = new Application();

$app->run();
