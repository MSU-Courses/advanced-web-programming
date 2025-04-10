<?php

// require core functions and helpers
require_once __DIR__ . '/src/core/config.php';
require_once __DIR__ . '/src/helpers/auth.php';
require_once __DIR__ . '/src/helpers/token.php';
require_once __DIR__ . '/src/helpers/session.php';
require_once __DIR__ . '/src/models/user.php';
require_once __DIR__ . '/src/core/database.php';
require_once __DIR__ . '/src/core/auth.php';

// require handlers
require_once __DIR__ . '/src/handlers/home.php';
require_once __DIR__ . '/src/handlers/auth.php';

// set the httpOnly flag for the session cookie
session_set_cookie_params([
    'httpOnly' => true,
]);

// start the session
session_start();

if (!isAuthenticated()) {
    tryLoadUserFromToken();
}

// simple routing with switch statement
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url) {
    case '/':
        homeHandler();
        break;
    case '/about':
        aboutHandler();
        break;
    case '/login':
        loginHandler();
        break;
    case '/register':
        registerHandler();
        break;
    case '/logout':
        logoutHandler();
        break;
    default:
        http_response_code(404);
        echo '404 Not Found';
        break;
}
