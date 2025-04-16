<?php

namespace App\Core;

use App\Core\Enums\ErrorCode;

class Response
{
   private int   $status  = 200;
   private array $headers = ['Content-Type' => 'application/json'];

   public function setStatus(int $code): self
   {
      $this->status = $code;
      return $this;
   }

   public function addHeader(string $name, string $value): self
   {
      $this->headers[$name] = $value;
      return $this;
   }

   /**
    * Устанавливаем тело ответа с данными и HATEOAS‑ссылками
    *
    * @param mixed $data
    * @param array $links ['rel' => ['href'=>...,'method'=>...], ...]
    */
   public function json(mixed $data, array $links = []): void
   {
      http_response_code($this->status);
      foreach ($this->headers as $k => $v) {
         header("$k: $v");
      }

      $payload = is_array($data) ? $data : ['data' => $data];
      if ($links) {
         $payload['_links'] = $links;
      }

      echo json_encode($payload, JSON_UNESCAPED_UNICODE);
   }

   /**
    * Формируем единый формат ошибок
    */
   public function error(string $message, ErrorCode $code): void
   {
      $this->setStatus($code->value)
         ->json([
            'error'       => $message,
            'error_code'  => $code->name
         ]);
   }
}
