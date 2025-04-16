<?php
// config/database.php
return [
   'default'     => 'sqlite',
   'connections' => [
      'mysql' => [
         'driver'   => 'mysql',
         'host'     => '127.0.0.1',
         'port'     => 3306,
         'database' => 'myapp',
         'username' => 'root',
         'password' => '',
         'charset'  => 'utf8mb4',
         'options'  => [],
      ],
      'sqlite' => [
         'driver'   => 'sqlite',
         'database' => __DIR__ . '/../database.sqlite',
      ],
   ],
];
