<?php

namespace App\Core\Enums;

/**
 * HTTP‑коды ошибок 
 */
enum ErrorCode: int
{
   case VALIDATION_ERROR = 400;
   case NOT_FOUND         = 404;
   case SERVER_ERROR      = 500;
}
