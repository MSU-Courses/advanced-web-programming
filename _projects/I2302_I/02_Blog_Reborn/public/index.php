<?php

use Core\Application;

require_once __DIR__ . '/../src/Core/Config.php';
require_once __DIR__ . '/../src/Core/Application.php';
require_once __DIR__ . '/../src/Core/Templater/Templater.php';

$app = new Application();

$app->load();