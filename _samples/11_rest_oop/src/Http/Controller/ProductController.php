<?php

namespace App\Http\Controller;

use App\Core\Controller;
use App\Core\Database;
use App\Model\Product;
use App\Core\Exception\ApiException;
use App\Core\Enums\ErrorCode;
use App\Core\Exception\ValidationException;
use App\Helpers\Functions;
use App\Validation\Validator;

class ProductController extends Controller
{
   private Product $model;

   public function __construct()
   {
      parent::__construct(new \App\Core\Request(), new \App\Core\Response());
      $this->model = new Product(Database::getConnection());
   }

   public function index(): void
   {
      $all = $this->model->all();
      // добавляем HATEOAS для каждого элемента
      $result = array_map(fn($item) => [
         'data'   => $item,
         '_links' => [
            'self'       => ['href' => "/products/{$item['id']}", 'method' => 'GET'],
            'update'     => ['href' => "/products/{$item['id']}", 'method' => 'PUT'],
            'delete'     => ['href' => "/products/{$item['id']}", 'method' => 'DELETE'],
         ]
      ], $all);

      $this->response->json(
         ['products' => $result],
         ['create' => ['href' => '/products', 'method' => 'POST']]
      );
   }

   public function show($id): void
   {
      $item = $this->model->find((int)$id);
      if (!$item) {
         throw new ApiException('Product not found', ErrorCode::NOT_FOUND);
      }

      $links = [
         'self'       => ['href' => "/products/$id", 'method' => 'GET'],
         'collection' => ['href' => '/products',    'method' => 'GET'],
         'update'     => ['href' => "/products/$id", 'method' => 'PUT'],
         'delete'     => ['href' => "/products/$id", 'method' => 'DELETE'],
      ];

      $this->response->json($item, $links);
   }

   public function store(): void
   {
      try {
         $data = Validator::make($this->request->getBody())
            ->field('name')->required()->string()->min(3)->max(100)
            ->field('price')->required()->numeric()
            ->validate();

         $id = $this->model->create($data);

         $this->response
            ->setStatus(201)
            ->json(
               ['message' => 'Created', 'id' => $id],
               ['self' => ['href' => "/products/{$id}", 'method' => 'GET']]
            );
      } catch (ValidationException $e) {
         // Возвращаем ошибки валидации
         $this->response
            ->setStatus(400)
            ->json(['errors' => $e->getErrors()]);
      }
   }

   public function update($id): void
   {
      try {
         $data = Validator::make($this->request->getBody())
            ->field('name')->required()->string()->min(3)->max(100)
            ->field('price')->required()->numeric()
            ->validate();

         $rows = $this->model->update((int)$id, $data);

         if ($rows === 0) {
            $this->response->setStatus(404)
               ->json(['error' => 'Product not found']);
            return;
         }

         $this->response->json(
            ['message' => 'Updated'],
            ['self' => ['href' => "/products/{$id}", 'method' => 'GET']]
         );
      } catch (ValidationException $e) {
         $this->response
            ->setStatus(400)
            ->json(['errors' => $e->getErrors()]);
      }
   }

   public function destroy($id): void
   {
      if (!$this->model->delete((int)$id)) {
         throw new ApiException('Product not found', ErrorCode::NOT_FOUND);
      }

      $this->response->json(
         ['message' => 'Deleted'],
         ['collection' => ['href' => '/products', 'method' => 'GET']]
      );
   }
}
