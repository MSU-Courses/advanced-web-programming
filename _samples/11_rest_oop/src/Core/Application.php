<?php

namespace App\Core;

use App\Core\Exception\ApiException;
use App\Core\Enums\ErrorCode;

class Application
{
   public Router   $router;
   public Request  $request;
   public Response $response;

   public function __construct()
   {
      $this->request  = new Request();
      $this->response = new Response();
      $this->router   = new Router($this->request, $this->response);
   }

   public function run(): void
   {
      $this->init();
      try {
         $this->router->resolve();
      } catch (ApiException $e) {
         // наша предсказуемая ошибка
         $this->response->error($e->getMessage(), $e->getErrorCode());
      } catch (\Throwable $e) {
         // всё остальное — внутренние ошибки
         $this->response->error('Internal Server Error', ErrorCode::SERVER_ERROR);
         // echo $e->getMessage();
         // при отладке можно залогировать $e->getMessage()
      }
   }

   public function init() {
      Database::init(__DIR__ . '/../../config/database.php');
   }
}
