<?php

namespace App\Core\Exception;

use Exception;

class ValidationException extends Exception
{
   protected array $errors;

   public function __construct(array $errors)
   {
      parent::__construct("Validation failed");
      $this->errors = $errors;
   }

   /**
    * Возвращает массив ошибок в формате [field => [messages...], ...]
    */
   public function getErrors(): array
   {
      return $this->errors;
   }
}
