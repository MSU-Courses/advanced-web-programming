<?php

use Core\Application;
use Core\Config;

require_once __DIR__ . '/../src/Core/Config.php';
require_once __DIR__ . '/../src/Core/Application.php';
require_once __DIR__ . '/../src/Core/Templater/Templater.php';
require_once __DIR__ . '/../src/Core/Router/Router.php';
require_once __DIR__ . '/../src/Http/Handlers/HomeHandler.php';
// require_once __DIR__ . '/../config/routes.php';

$app = new Application();

$app->load();
