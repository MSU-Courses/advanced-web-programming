<?php

namespace App\Core;

use App\Core\Route;

/**
 * HTTP router: holds Route instances and dispatches incoming requests.
 */
class Router
{
   private array    $routes = [];
   private Request  $request;
   private Response $response;

   public function __construct(Request $request, Response $response)
   {
      $this->request  = $request;
      $this->response = $response;
   }

   public function get(string $path, array $handler): void
   {
      $this->add('GET', $path, $handler);
   }

   public function post(string $path, array $handler): void
   {
      $this->add('POST', $path, $handler);
   }

   public function put(string $path, array $handler): void
   {
      $this->add('PUT', $path, $handler);
   }

   public function delete(string $path, array $handler): void
   {
      $this->add('DELETE', $path, $handler);
   }

   private function add(string $method, string $path, array $handler): void
   {
      $this->routes[] = new Route($method, $path, [$handler[0], $handler[1]]);
   }

   /**
    * Dispatches the current request using tryExecute on each route.
    */
   public function resolve(): void
   {
      $method = $this->request->getMethod();
      $uri    = $this->request->getUri();

      foreach ($this->routes as $route) {
         if ($route->matches($method, $uri)) {
            [$class, $action] = $route->handler;
            // Instantiate controller with request & response
            $controller = new $class($this->request, $this->response);
            // Call action with extracted URI params
            call_user_func_array([$controller, $action], $route->params);
            return;
         }
      }

      $this->response
         ->setStatus(404)
         ->json(['error' => 'Not Found']);
   }
}
