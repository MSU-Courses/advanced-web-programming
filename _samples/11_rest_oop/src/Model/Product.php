<?php

namespace App\Model;

/**
 * Модель "Product" без прямой работы с PDO.
 */
class Product extends BaseModel
{
   protected string $table = 'products';

   public function __construct()
   {
      parent::__construct();
      // Здесь можно добавить дополнительные инициализации
   }

   /**
    * Поиск товаров с ценой не ниже указанной.
    */
   public function findByMinPrice(float $minPrice): array
   {
      // Предполагаем, что Query Builder поддерживает сравнение >=
      return $this->db->select(
         $this->table,
         ['*'],
         ['price' => $minPrice]
      );
   }
}