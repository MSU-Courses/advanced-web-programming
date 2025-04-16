<?php

use App\Core\Application;

require_once __DIR__ . '/../src/Core/Application.php';
require_once __DIR__ . '/../src/Core/Router/Router.php';
require_once __DIR__ . '/../src/Core/Router/Route.php';
require_once __DIR__ . '/../src/Core/Enums/ErrorCode.php';
require_once __DIR__ . '/../src/Core/Exception/ApiException.php';
require_once __DIR__ . '/../src/Core/Exception/ValidationException.php';
require_once __DIR__ . '/../src/Core/Validation/Validator.php';
require_once __DIR__ . '/../src/Core/Request.php';
require_once __DIR__ . '/../src/Core/Database.php';
require_once __DIR__ . '/../src/Core/Response.php';
require_once __DIR__ . '/../src/Core/Application.php';

require_once __DIR__ . '/../src/Http/Controller/Controller.php';
require_once __DIR__ . '/../src/Http/Controller/ProductController.php';
require_once __DIR__ . '/../src/Model/BaseModel.php';
require_once __DIR__ . '/../src/Model/Product.php';

$app = new Application();
$map = require __DIR__ . '/../src/routes.php';
$map($app->router);
$app->run();
