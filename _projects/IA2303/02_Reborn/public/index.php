<?php

require_once '../src/Core/Application.php';
require_once '../src/Core/Config.php';
require_once '../src/Core/Templater/Template.php';

use Core\Application;

$app = new Application();

$app->run();