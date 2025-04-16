<?php

namespace App\Core;

abstract class Controller
{
   protected Request  $request;
   protected Response $response;

   public function __construct(Request $req, Response $res)
   {
      $this->request  = $req;
      $this->response = $res;
   }
}
