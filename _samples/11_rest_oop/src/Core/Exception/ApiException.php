<?php

namespace App\Core\Exception;

use App\Core\Enums\ErrorCode;
use Throwable;

class ApiException extends \Exception
{
   public function __construct(string $message, ErrorCode $code, ?Throwable $previous = null)
   {
      parent::__construct($message, $code->value, $previous);
   }

   public function getErrorCode(): ErrorCode
   {
      return ErrorCode::from($this->getCode());
   }
}
