<?php

namespace App\Validation;

use App\Core\Exception\ValidationException;

/**
 * Простой валидатор данных с fluent-интерфейсом.
 */
class Validator
{
   private array $data;
   private array $errors = [];
   private string $currentField;
   private array $rules = [];

   private function __construct(array $data)
   {
      $this->data = $data;
   }

   /**
    * Инициализирует валидатор с массивом данных.
    */
   public static function make(array $data): self
   {
      return new self($data);
   }

   /**
    * Устанавливает поле для применения последующих правил.
    */
   public function field(string $field): self
   {
      $this->currentField = $field;
      if (!isset($this->rules[$field])) {
         $this->rules[$field] = [];
      }
      return $this;
   }

   /**
    * Правило "обязательно".
    */
   public function required(): self
   {
      $this->rules[$this->currentField][] = ['required'];
      return $this;
   }

   /**
    * Правило "строка".
    */
   public function string(): self
   {
      $this->rules[$this->currentField][] = ['string'];
      return $this;
   }

   /**
    * Правило "число".
    */
   public function numeric(): self
   {
      $this->rules[$this->currentField][] = ['numeric'];
      return $this;
   }

   /**
    * Минимальная длина строки.
    */
   public function min(int $min): self
   {
      $this->rules[$this->currentField][] = ['min', $min];
      return $this;
   }

   /**
    * Максимальная длина строки.
    */
   public function max(int $max): self
   {
      $this->rules[$this->currentField][] = ['max', $max];
      return $this;
   }

   /**
    * Выполняет валидацию по заданным правилам.
    * @throws ValidationException
    */
   public function validate(): array
   {
      foreach ($this->rules as $field => $rules) {
         $value = $this->data[$field] ?? null;

         foreach ($rules as $rule) {
            $ruleName = $rule[0];
            $param = $rule[1] ?? null;

            switch ($ruleName) {
               case 'required':
                  if (empty($value) && $value !== '0') {
                     $this->addError($field, 'Поле обязательно.');
                  }
                  break;

               case 'string':
                  if (!is_string($value)) {
                     $this->addError($field, 'Поле должно быть строкой.');
                  }
                  break;

               case 'numeric':
                  if (!is_numeric($value)) {
                     $this->addError($field, 'Поле должно быть числом.');
                  }
                  break;

               case 'min':
                  if (is_string($value) && mb_strlen($value) < $param) {
                     $this->addError($field, "Минимальная длина {$param} символов.");
                  }
                  break;

               case 'max':
                  if (is_string($value) && mb_strlen($value) > $param) {
                     $this->addError($field, "Максимальная длина {$param} символов.");
                  }
                  break;

               default:
                  // можно добавить другие правила
            }
         }
      }

      if (!empty($this->errors)) {
         throw new ValidationException($this->errors);
      }

      return $this->data;
   }

   /**
    * Добавляет сообщение об ошибке для поля.
    */
   private function addError(string $field, string $message): void
   {
      $this->errors[$field][] = $message;
   }
}
