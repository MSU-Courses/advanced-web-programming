<?php

require_once __DIR__ . '/../src/Core/Config.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        $content = file_get_contents(Config::rootDir . '/templates/index.tpl');
        $article = "Article";
        $content = str_replace("<!-- article -->", "<div>$article</div>", $content);

        $layout = file_get_contents(Config::rootDir . '/templates/layouts/default.layout.tpl');
        $layout = str_replace("<!-- content -->", $content, $layout);

        echo $layout;
        break;
    case '/about':
        // $content = file_get_contents(Config::rootDir . '/templates/about.tpl');
        // require_once Config::rootDir . '/templates/layouts/default.layout.php';
        break;
    default:
        echo "404";
        break;
}
