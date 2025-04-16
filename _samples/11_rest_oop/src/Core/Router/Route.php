<?php

namespace App\Core;

/**
 * Represents a single HTTP route with method, path pattern, and handler.
 */
class Route
{
   public string $method;
   public string $path;
   public array  $handler;
   public array  $params = [];

   public function __construct(string $method, string $path, array $handler)
   {
      $this->method  = strtoupper($method);
      $this->path    = $path;
      $this->handler = $handler;
   }

   /**
    * Checks if the incoming request matches this route.
    * Extracts path parameters into $this->params.
    */
   public function matches(string $method, string $uri): bool
   {
      if ($this->method !== strtoupper($method)) {
         return false;
      }

      $uriSegments   = explode('/', trim($uri, '/'));
      $routeSegments = explode('/', trim($this->path, '/'));

      if (count($uriSegments) !== count($routeSegments)) {
         return false;
      }

      foreach ($routeSegments as $i => $segment) {
         if (str_starts_with($segment, '{') && str_ends_with($segment, '}')) {
            $key = trim($segment, '{}');
            $this->params[$key] = $uriSegments[$i];
         } elseif ($segment !== $uriSegments[$i]) {
            return false;
         }
      }

      return true;
   }

   /**
    * Attempts to match and, if successful, execute the route handler.
    * @return bool True if the route matched and handler ran, false otherwise.
    */
   public function tryExecute(string $method, string $uri): bool
   {
      if (!$this->matches($method, $uri)) {
         return false;
      }
      call_user_func_array($this->handler, $this->params);
      return true;
   }
}
