<?php

namespace App\Core;

class Request
{
   private array  $body;
   private string $method;
   private string $uri;

   public function __construct()
   {
      $this->method = $_SERVER['REQUEST_METHOD'];
      $this->uri    = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
      $input = file_get_contents('php://input');
      $this->body   = $input ? json_decode($input, true) : [];
   }

   public function getMethod(): string
   {
      return $this->method;
   }
   public function getUri(): string
   {
      return $this->uri;
   }
   public function getBody(): array
   {
      return $this->body;
   }
}
