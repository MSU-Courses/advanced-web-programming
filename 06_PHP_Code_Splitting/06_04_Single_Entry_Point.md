# Единая точка входа в приложение и введение в маршрутизацию

В предыдущей главе мы рассмотрели базовые примеры структуры веб-приложений. Один из подходов — размещение множества отдельных файлов в папке `public`, где каждый файл отвечает за отдельную страницу (`index.php`, `about.php`, `contact.php` и т. д.). Такой метод удобен для небольших проектов, но с увеличением числа страниц и усложнением логики он становится неудобным:

- Количество файлов быстро растёт, что приводит к хаосу в структуре.
- Дублирование кода (*например*, заголовки и подвал страницы приходится вставлять в каждый файл).
- Сложности в управлении маршрутизацией и логикой обработки запросов.

Чтобы упростить организацию кода и централизовать обработку всех запросов, используется **единая точка входа**.

## Что такое единая точка входа?

**Единая точка входа (Single Entry Point)** — это файл, который принимает и обрабатывает все входящие запросы к веб-приложению. Вместо того чтобы запрашивать разные файлы напрямую (`about.php`, `contact.php`), все запросы направляются на один файл (обычно `index.php`), который анализирует URL-адрес и решает, какую страницу или действие необходимо выполнить [^1].

### Как это работает?

Допустим, пользователь вводит в браузере:

- `http://example.com/about` — запрос направляется в единую точку входа (`index.php`), которая анализирует URL и загружает страницу "О нас".
- `http://example.com/contact` — запрос направляется в `index.php`, который загружает страницу "Контакты".
- `http://example.com/article/15` — запрос направляется в `index.php`, который загружает страницу с отображением статьи с ID `15`.

Таким образом, `index.php` (_единая точка входа_) играет роль "диспетчера", распределяя запросы внутри приложения.

### Структура проекта 

#### Структура без единой точки входа

Если не используется единая точка входа, структура проекта может выглядеть следующим образом:

```
project/
├── public/
│   ├── index.php
│   ├── about.php
│   ├── contact.php
│   ├── article/
│   │   ├── index.php
│   │   └── create.php
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
```

При увеличении количества страниц эта структура становится громоздкой.

#### С использованием единой точки входа

```
project/
├── public/
│   ├── index.php       # Единая точка входа
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
├── resources/
│   ├── views/
│   │   ├── home.php        # Главная страница
│   │   ├── about.php       # Страница "О нас"
│   │   ├── contact.php     # Страница "Контакты"
│   │   ├── errors/         # Страницы ошибок
│   │   │   └── 404.php     # Страница 404
│   │   ├── article/
│   │   │   ├── index.php   # Список статей
│   │   │   └── create.php  # Форма добавления статьи
│   │   └── components/     # Общие части (header, footer)
│   │       ├── header.php
│   │       └── footer.php
└── src/
    └── ...
```

Здесь все запросы направляются на `index.php`, который через **механизм маршрутизации** загружает нужную страницу.

## Введение в маршрутизацию

**Маршрутизация (Routing)** — это процесс сопоставления URL-адресов с соответствующими действиями в приложении. Она позволяет определить, какую страницу или функцию следует выполнить для данного запроса.

**Маршрут** — это правило, которое определяет, какой URL-адрес соответствует какому действию. _Например_, URL `/about` может соответствовать странице "О нас", а `/article/15` — отображению статьи с ID 15.

Простое веб-приложение может работать без сложной маршрутизации, но в более развитых проектах маршрутизация становится необходимой.

**Примеры маршрутов**:

- http://example.com/ → Главная страница
- http://example.com/about → Страница "О нас"
- http://example.com/article/15 → Отображение статьи с ID 15

## Реализация маршрутизации

Для реализации маршрутизации в PHP можно использовать различные подходы. Рассмотрим некоторые из них.

### Определение текущего URL-адреса

Для получения URL-адреса текущей страницы в PHP используется суперглобальный массив `$_SERVER`, а именно его элемент `$_SERVER['REQUEST_URI']`. Этот параметр содержит путь и строку запроса (если она есть) после доменного имени.

#### Примеры работы `$_SERVER['REQUEST_URI']`

| Полный URL                                | Значение `$_SERVER['REQUEST_URI']` |
| ----------------------------------------- | ---------------------------------- |
| `http://example.com/about`                | `/about`                           |
| `http://example.com/article/15`           | `/article/15`                      |
| `http://example.com/contact?name=John`    | `/contact?name=John`               |
| `http://example.com/article?category=php` | `/article?category=php`            |

> [!NOTE]  
> `$_SERVER['REQUEST_URI']` возвращает путь и строку запроса, но не включает протокол (`http`/`https`) и домен.

#### Получение пути без параметров

Если необходимо получить только путь без строки запроса, можно использовать функцию `parse_url()` с параметром `PHP_URL_PATH`:

```php
<?php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo $url;
```

#### Примеры работы `parse_url()`

| Полный URL                                | Значение `$url` |
| ----------------------------------------- | --------------- |
| `http://example.com/article?category=php` | `/article`      |
| `http://example.com/contact?name=John`    | `/contact`      |

Таким образом, `parse_url()` помогает извлекать только путь, игнорируя параметры запроса, что удобно для маршрутизации или анализа URL-адресов.

### Статические маршруты (на основе массива)

Один из наиболее простых способов маршрутизации — использование ассоциативного массива, где ключами являются URL-адреса, а значениями — соответствующие файлы.

```php
<?php

// public/index.php (единая точка входа)

// Массив маршрутов
$routes = [
    '/' => 'home.php',
    '/about' => 'about.php',
    '/contact' => 'contact.php',
    '/article/create' => 'article/create.php',
];

// Получаем текущий URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$templatesDir = __DIR__ . '/../resources/views/';

// Проверяем маршрут
if (array_key_exists($url, $routes)) {
    require_once $templatesDir . $routes[$url];
} else {
    // Страница 404
    require_once $templatesDir . 'errors/404.php';
    http_response_code(404);
    exit();
}
```

Если URL-адрес есть в массиве `$routes`, загружается соответствующий файл. В противном случае — страница ошибки 404.

> [!NOTE]
> Для удобства массив маршрутов можно вынести в отдельный файл (`src/routes.php`) и подключать его в `index.php`.

### Реализация маршрутизации через оператор `switch`

Другой простой способ — использование конструкции `switch`, которая выполняет подключение нужного файла в зависимости от переданного URL

```php
<?php

// public/index.php

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$templatesDir = __DIR__ . '/../resources/views/';

switch ($url) {
    case '/':
        require_once $templatesDir . 'home.php';
        break;
    case '/about':
        require_once $templatesDir . 'about.php';
        break;
    case '/contact':
        require_once $templatesDir . 'contact.php';
        break;
    default:
        require_once $templatesDir . 'errors/404.php';
        http_response_code(404);
        break;
}
```

Этот метод удобен для небольшого количества маршрутов, но становится громоздким при увеличении их числа.

### Динамическая маршрутизация с использованием регулярных выражений

Часто URL-адреса содержат параметры, _например_, `http://example.com/article/15`, где `15` — идентификатор статьи. Для обработки таких маршрутов можно использовать регулярные выражения.

```php
<?php

// public/index.php

// Получаем текущий URL
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$templatesDir = __DIR__ . '/../resources/views/';

// Определяем, какой файл подключить
// То есть, если URL соответствует шаблону /article/<число>, подключаем файл article/show.php
if (preg_match('/^\/article\/(\d+)$/', $url, $matches)) {
    $articleId = $matches[1];
    require_once $templatesDir . 'article/show.php';
} else {
    require_once $templatesDir . 'errors/404.php';
    http_response_code(404);
}
```

### Использование функций обратного вызова (callback)

Более гибкий подход к маршрутизации — использование функций-обработчиков, которые вызываются при совпадении URL с шаблоном маршрута.

_Например_,

- Пользователь вводит URL `/about` -> вызывается функция `showAbout()`.
- Пользователь вводит URL `/article/15` -> вызывается функция `showArticle(15)`.
- Пользователь вводит URL `/article/15/edit` -> вызывается функция `editArticle(15)`.
- и другие

```php
<?php

// public/index.php

$routes = [
    '/' => function () {
        echo 'Главная страница';
    },
    '/about' => function () {
        echo 'Страница "О нас"';
    },
    '/contact' => function () {
        echo 'Страница "Контакты"';
    },
    '/article/(\d+)' => function ($articleId) {
        echo 'Статья с ID ' . $articleId;
    },
    '/article/(\d+)/edit' => function ($articleId) {
        echo 'Редактирование статьи с ID ' . $articleId;
    },
];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

foreach ($routes as $route => $action) {
    if (preg_match('#^' . $route . '$#', $url, $matches)) {
        array_shift($matches);
        $action(...$matches);
        exit();
    }
}

http_response_code(404);
echo "<html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1></body></html>";
```

### Вынесение обработчиков маршрутов в отдельные файлы

Для лучшей организации кода функции-обработчики можно вынести в отдельный файл.

```php
<?php

// src/handlers/article.php

function showArticle($articleId)
{
    echo 'Статья с ID ' . $articleId;
}

function editArticle($articleId)
{
    echo 'Редактирование статьи с ID ' . $articleId;
}
```

В единой точке входа подключаем файл с обработчиками и вызываем соответствующую функцию.

```php
<?php

// public/index.php

require_once __DIR__ . '/../src/handlers/article.php';

$routes = [
    '/article/(\d+)' => 'showArticle',
    '/article/(\d+)/edit' => 'editArticle',
];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

foreach ($routes as $route => $action) {
    if (preg_match('#^' . $route . '$#', $url, $matches)) {
        // Если URL соответствует шаблону маршрута
        // Вызываем функцию-обработчик
        // Если есть динамические параметры, передаём их в функцию
        // Например:
        //      /article/15 -> Массив $matches содержит [15]
        //      /article/15/edit -> Массив $matches содержит [15]
        // Передаём параметры в функцию с помощью оператора распаковки
        array_shift($matches);
        $action(...$matches);
        exit();
    }
}

http_response_code(404);
echo "<html><head><title>404 Not Found</title></head><body><h1>404 Not Found</h1></body></html>";
```

### Ограничения рассмотренных методов

В приведённых выше примерах были рассмотрены базовые подходы к маршрутизации. Однако, у них есть существенные ограничения:

- Отсутствует поддержка обработки HTTP-методов (`GET`, `POST`, `PUT`, `DELETE`). В текущих реализациях маршруты определяются только по URL без учёта типа запроса.
- Отсутствует параметризация и более сложная логика маршрутов, что затрудняет разработку масштабируемых приложений.

[^1]: _Framework Fundamentals—Single Point of Entry_. medium.com [online resource]. Available at: https://medium.com/@KyleMinshall/intermediate-web-development-single-point-of-entry-cea15423d13e
