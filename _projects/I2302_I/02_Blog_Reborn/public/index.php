<?php

use Core\Templater\Template;
use Core\Templater\Templater;

require_once __DIR__ . '/../src/Core/Config.php';
require_once __DIR__ . '/../src/Core/Templater/Templater.php';

$template = new Templater('../templates/');

$title = "TItle from DB";

$template->renderPage('article/index', [
    'title' => $title,
    'posts' => 1,
]);