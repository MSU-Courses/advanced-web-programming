# Функция `header` для отправки HTTP-заголовков

При обработке форм веб-страницы часто требуется управлять запросами и ответами. В этом случае удобно использовать функцию `header`, которая позволяет управлять заголовками HTTP.

**HTTP-заголовки** — это часть запроса или ответа, содержащая метаданные о передаваемом сообщении. Они могут информировать клиент о типе содержимого, коде состояния ответа, а также использоваться для перенаправления. Ниже рассмотрены способы работы с заголовками с помощью функции header в PHP.

## Общий синтаксис

Функция `header` принимает до трёх аргументов:

```php
header($header, $replace = true, $http_response_code = null);
```

- `$header`. Строка, содержащая имя заголовка и его значение.
- `$replace`. Логическое значение (по умолчанию true), которое определяет, следует ли заменять ранее отправленные заголовки с таким же именем.
- `$http_response_code`. Необязательный параметр, указывающий HTTP-код состояния (например, 301, 404).

## Примеры использования функции `header`

### 1. Перенаправление на другую страницу

При обработке формы часто требуется перенаправить пользователя на другую страницу. Для этого используется заголовок `Location`.

**Синтаксис**:

```php
header('Location: <Path>');
```

- `<Path>` — путь к странице, на которую нужно перенаправить пользователя.

**Пример.** _Пример перенаправления на страницу `/success`_

```php
<?php
header('Location: /success');
```

**Пример.** _Пример перенаправления с указанием кода состояния `301`_

```php
<?php
header('Location: /success', true, 301);
```

#### Пользовательская функция для перенаправления

Создадим функцию `redirect`, которая принимает путь и опциональный код состояния:

**Пример.** _Создание функции для перенаправления_

```php
/**
 * Перенаправление на указанный путь
 *
 * @param string $path Путь для перенаправления
 * @param int $status Код состояния ответа
 */
function redirect(string $path, int $status = 302) {
    header('Location: ' . $path, true, $status);
    exit;
}

// Использование функции
redirect('/success');
redirect('/success', 301);
```

### 2. Отправка кода состояния ответа

Иногда важно сообщить клиенту результат обработки запроса с помощью кода состояния.

**Синтаксис**:

```php
header('<Protocol> <Status Code> <Status Text>');
```

- `<Protocol>` — версия протокола HTTP (например, `HTTP/1.1`).
- `<Status Code>` — код состояния ответа (например, `200`, `404`).
- `<Status Text>` — текстовое описание кода состояния (например, `OK`, `Not Found`).

**Пример.** _Пример отправки кода `404 Not Found`_

```php
header('HTTP/1.1 404 Not Found');
```

**Пример.** _Пример отправки кода `200 OK`_

```php
header('HTTP/1.1 200 OK');
```

#### Использование `$_SERVER['SERVER_PROTOCOL']`

Чтобы избежать ошибок при смене версии HTTP-протокола, рекомендуется использовать переменную `$_SERVER['SERVER_PROTOCOL']`:

**Пример.** _Отправка кода состояния ответа с использованием `$_SERVER['SERVER_PROTOCOL']`_

```php
header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
```

#### Пользовательская функция для отправки кода состояния ответа

Создадим функцию для отправки кода состояния с использованием перечисления:

**Пример.** _Создание функции для отправки кода состояния ответа_

```php
<?php
enum HttpStatusCode: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;
    case NOT_IMPLEMENTED = 501;
}

$httpStatusMessages = [
    HttpStatusCode::OK->value => 'OK',
    HttpStatusCode::CREATED->value => 'Created',
    HttpStatusCode::NO_CONTENT->value => 'No Content',
    HttpStatusCode::BAD_REQUEST->value => 'Bad Request',
    HttpStatusCode::UNAUTHORIZED->value => 'Unauthorized',
    HttpStatusCode::FORBIDDEN->value => 'Forbidden',
    HttpStatusCode::NOT_FOUND->value => 'Not Found',
    HttpStatusCode::INTERNAL_SERVER_ERROR->value => 'Internal Server Error',
    HttpStatusCode::NOT_IMPLEMENTED->value => 'Not Implemented',
];

/**
 * Отправка заголовка с кодом состояния ответа.
 *
 * @param HttpStatusCode $statusCode Код состояния.
 */
function sendStatusCode(HttpStatusCode $statusCode): void
{
    header("{$_SERVER['SERVER_PROTOCOL']} {$statusCode->value} " . getStatusMessage($statusCode));
}

/**
 * Получение текстового сообщения для кода состояния.
 *
 * @param HttpStatusCode $statusCode Код состояния.
 * @return string Соответствующее сообщение или 'Unknown Status', если код не найден.
 */
function getStatusMessage(HttpStatusCode $statusCode): string
{
    global $httpStatusMessages;
    return $httpStatusMessages[$statusCode->value] ?? 'Unknown Status';
}
```

#### Использование функции `http_response_code`

Альтернативный способ установки кода состояния без явного указания заголовка.

**Пример.** _Отправка кода состояния ответа `404 Not Found` с использованием функции `http_response_code`:_

```php
http_response_code(404);
```

### 3. Установка заголовка `Content-Type`

Заголовок `Content-Type` определяет тип содержимого ответа, чтобы браузер мог правильно его интерпретировать.

**Синтаксис**:

```php
header('Content-Type: <MIME-Type>');
```

- `<MIME-Type>` — MIME-тип содержимого (например, `text/html`, `application/json`).

**Пример.** _Установка заголовка для JSON_

```php
header('Content-Type: application/json');
```

**Пример.** _Установка заголовка для HTML_

```php
header('Content-Type: text/html');
```

По умолчанию PHP устанавливает заголовок `Content-Type: text/html`, если он не указан явно.

## Особенности использования функции `header`

Одной из ключевых особенностей функции `header` является то, что она должна быть вызвана до отправки любых данных клиенту. В противном случае PHP выдаст ошибку:

```
Cannot modify header information - headers already sent
```

Функция `header` отправляет HTTP-заголовки, которые сообщают браузеру, как обрабатывать ответ сервера. Если заголовки уже были отправлены (например, из-за вывода текста, HTML-кода или даже пробелов перед `<?php`), сервер не сможет изменить заголовки, что приведет к ошибке.

**Пример.** _Ошибка при отправке заголовка после вывода_

```php
<?php

echo 'Hello, World!';

header('Location: /success'); // Ошибка: заголовки уже отправлены!
exit;
```

В этом случае текст `Hello, World!` уже был выведен, что привело к отправке заголовков ответа. Попытка изменить их с помощью header вызовет ошибку.

[^1]: _header_. php.net [online resource]. Available at: https://www.php.net/manual/en/function.header.php
