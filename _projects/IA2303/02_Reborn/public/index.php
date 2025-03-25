<?php

require_once '../src/Core/Application.php';
require_once '../src/Core/Config.php';
require_once '../src/Core/Templater/Template.php';
require_once '../src/Core/Router/HTTPMethod.php';
require_once '../src/Core/Router/Router.php';
require_once '../src/Core/Router/Route.php';
require_once '../src/Http/Handlers/HomeHandler.php';
require_once '../routes/routes.php';


use App\Core\Application;

$app = new Application();

$app->run();