<?php

require_once __DIR__ . '/../src/Core/Config.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        require_once Config::rootDir . '/templates/index.php';
        break;
    case '/about':
        $content = file_get_contents(Config::rootDir . '/templates/about.tpl');
        require_once Config::rootDir . '/templates/layouts/default.layout.php';
        break;
    default:
        echo "404";
        break;
}
