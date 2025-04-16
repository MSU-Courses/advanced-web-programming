<?php

/**
 * Application route declarations.
 */

use App\Core\Router;
use App\Http\Controller\ProductController;

return function (Router $router): void {
   $router->get('/products',        [ProductController::class, 'index']);
   $router->get('/products/{id}',   [ProductController::class, 'show']);
   $router->post('/products',        [ProductController::class, 'store']);
   $router->put('/products/{id}',   [ProductController::class, 'update']);
   $router->delete('/products/{id}',   [ProductController::class, 'destroy']);
};
