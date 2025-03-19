# Фильтрация и валидация данных формы

> [!NOTE]
> Золотое правило безопасности: никогда не доверяйте пользовательским данным!

## Введение

Веб-приложения активно взаимодействуют с пользователями, принимая от них данные через формы. Однако эти данные могут содержать ошибки, вредоносный код или просто не соответствовать ожидаемому формату. Чтобы избежать проблем, необходимо использовать фильтрацию и валидацию данных.

### Фильтрация данных

**Фильтрация данных** — это процесс удаления или изменения нежелательных символов из введенных пользователем данных. _Например_:

- Удаление лишних пробелов.
- Удаление или экранирование HTML-тегов.
- Преобразование текста к нужному формату (например, `email` в нижний регистр).

### Валидация данных

**Валидация данных** — это процесс проверки соответствия введенных данных определенным правилам, например:

- Длина строки (_например_, имя должно содержать от 3 до 50 символов).
- Формат (_например_, email должен соответствовать example@domain.com).
- Числовое значение (_например_, возраст должен быть в диапазоне 18–100 лет).

## Фильтрация данных формы

> [!TIP]
> Представьте, что фильтрация — это как использование водяного фильтра. Он удаляет из воды нежелательные примеси, но не проверяет, подходит ли вода для питья. Аналогично, фильтрация удаляет потенциально опасные символы, но не гарантирует правильность данных.

### Удаление пробелов

#### Проблема

Пользователь может случайно добавить пробелы в начале или конце строки.

#### Решение

Для удаления пробелов из данных формы можно использовать метод `trim()`.

```php
$name = trim($_POST['name'] ?? '');
```

### Удаление специальных символов

#### Проблема

Пользователь может намеренно ввести в форму специальные символы, такие как `<script>`, с целью выполнить атаку на веб-приложение.

Например, если в поле «Name» будет введён следующий код:

```html
<script>
  while (true) {
    alert("Hello, World!");
  }
</script>
```

И если данные сохранятся в базу данных без фильтрации, при их последующем выводе на страницу данный скрипт выполнится. В результате пользователь увидит всплывающее окно с сообщением **"Hello, World!"**, которое невозможно закрыть из-за бесконечного цикла.

#### Решение

При обработке данных, введенных пользователем, важно правильно фильтровать и экранировать специальные символы. Это необходимо для защиты от атак (например, XSS) и корректного хранения данных. В PHP есть несколько функций для очистки входных данных.

1. `htmlspecialchars()` – Преобразует специальные символы в HTML-сущности, предотвращая XSS-атаки.
   - `<` → `&lt;`
   - `>` → `&gt;`
   - `&` → `&amp;`
   - `"` → `&quot;`
   - `'` → `&#039;`
2. `htmlentities()` – Преобразует не только специальные символы, но и другие символы в HTML-сущности (например, `© → &copy;`).
3. `strip_tags()` – Удаляет HTML и PHP-теги. Полезно, если нужно оставить только текст.
4. `filter_var()` – Фильтрует переменную, удаляя нежелательные символы.
   - `FILTER_SANITIZE_STRING` (устарел в PHP 8.1) – удаляет HTML-теги.
   - `FILTER_SANITIZE_FULL_SPECIAL_CHARS` – аналог htmlspecialchars().
5. `stripslashes()` – Удаляет экранирующие слэши `(\)`.

Допустим, пользователь ввел следующий код в поле **"Name"**:

```html
<script>
  alert("Hello, World!");
</script>
```

Применяя различные функции очистки:

```php
<?php

$name = $_POST['name'] ?? '';

$filtered1 = htmlspecialchars($name);
// &lt;script&gt;alert(&quot;Hello, World!&quot;);&lt;/script&gt;

$filtered2 = htmlentities($name);
// &lt;script&gt;alert(&quot;Hello, World!&quot;);&lt;/script&gt;

$filtered3 = strip_tags($name);
// alert("Hello, World!");

$filtered4 = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// &lt;script&gt;alert(&quot;Hello, World!&quot;);&lt;/script&gt;

$filtered5 = stripslashes($name);
// (если были слэши, они удалятся)
```

> [!TIP]
> Обычно `htmlspecialchars()` или `filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS)` достаточно для защиты от XSS. `strip_tags()` полезен, если требуется полностью удалить HTML-теги.

#### Сохранять в базу данных или экранировать при выводе?

**Вопрос**: Следует ли сохранять уже экранированные данные (`htmlspecialchars()`) в базу или экранировать их при выводе?

**Лучший подход**:

- Сохранять "чистые" данные в базу (без `htmlspecialchars()`). Это гарантирует, что данные можно безопасно обрабатывать и форматировать в будущем.
- Экранировать данные при выводе на страницу (`htmlspecialchars()`).

## Валидация данных формы

Валидация похожа на проверку билетов перед посадкой в поезд: если данные не соответствуют требованиям, их не пропускают дальше.

### Валидация на стороне клиента и сервера

- **Клиентская валидация (JavaScript, HTML5)** — быстрое предупреждение пользователя, но ненадежно, так как можно отключить JavaScript.
- **Серверная валидация (PHP)** — основная защита, выполняемая на сервере перед обработкой данных.

### Проверка на пустое значение

Для проверки на пустое значение используется функция `empty()`.

```php
if (empty($_POST['name'])) {
    echo 'Поле "Имя" не может быть пустым.';
}
```

### Проверка длины строки

Для проверки длины строки используется функция `strlen()`.

```php
$name = $_POST['name'] ?? '';

if (strlen($name) < 3 || strlen($name) > 50) {
    echo 'Имя должно содержать от 3 до 50 символов.';
}
```

### Проверка email

Для проверки email используется функция `filter_var()` с фильтром `FILTER_VALIDATE_EMAIL`.

```php
$email = $_POST['email'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Некорректный email.';
}
```

### Проверка числового значения

#### Проверка, является ли значение числом

Функция `is_numeric()` позволяет проверить, содержит ли строка числовое значение (целое или дробное).

```php
<?php

$age = $_POST['age'] ?? '';

if (!is_numeric($age)) {
    echo 'Возраст должен быть числом.';
}
```

> [!IMPORTANT]
> Функция `is_numeric()` допускает строковые представления чисел (`"123"`, `"12.5"`, `"+10"`) и даже экспоненциальные записи (`"1e3"` → `1000`). Если требуется строгое соответствие целому или дробному числу, лучше использовать `filter_var()`.

#### Проверка целого числа и диапазона значений

Для проверки, является ли значение целым числом, и его соответствия заданному диапазону можно использовать `filter_var()` с флагом `FILTER_VALIDATE_INT`:

```php
<?php

$age = $_POST['age'] ?? '';

if (!filter_var($age, FILTER_VALIDATE_INT, ['options' => ['min_range' => 18, 'max_range' => 100]])) {
    echo 'Возраст должен быть числом от 18 до 100.';
}
```

> [!TIP] > `FILTER_VALIDATE_INT` не допускает дробные числа (`12.5` будет отклонено). Если необходимо разрешить дробные значения, используйте `FILTER_VALIDATE_FLOAT`.

### Проверка даты

Для проверки даты можно использовать класс `DateTime` и метод `createFromFormat()`. Например, для проверки даты в формате `YYYY-MM-DD`:

```php
$date = $_POST['date'] ?? '';

$dateObj = DateTime::createFromFormat('Y-m-d', $date);

if (!$dateObj) {
    echo 'Дата должна быть в формате YYYY-MM-DD.';
}
```

## Пример обработки формы с фильтрацией и валидацией

### Структура проекта

Для корректной обработки пользовательских данных используется следующая файловая структура:

- `index.php` — форма для отправки данных.
- `handler.php` — обработчик формы, выполняющий фильтрацию и валидацию данных.
- `functions.php` — дополнительные функции для фильтрации и валидации данных.

### Пример формы (`index.php`)

```php
<?php
require_once 'handler.php';
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="message">Сообщение:</label>
    <textarea name="message" id="message" required></textarea>

    <label for="category">Категория:</label>
    <select name="category" id="category" required>
        <option value="1">Категория 1</option>
        <option value="2">Категория 2</option>
        <option value="3">Категория 3</option>
    </select>

    <button type="submit">Отправить</button>
</form>
```

### Обработчик формы (`handler.php`)

Для хранения ошибок валидации часто используется массив `$errors`, где ключ — имя поля, а значение — массив ошибок. _Например_:

```php
$errors = [
    'name' => ['Введите ваше имя.'],
];
```

Пример кода обработчика формы:

```php
<?php
// handler.php

/**
 * Sanitize data from user input.
 *
 * @param string $value User input.
 *
 * @return string Sanitized value.
 */
function sanitize($value): string {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'name' => sanitize($_POST['name'] ?? ''),
        'email' => sanitize($_POST['email'] ?? ''),
        'message' => sanitize($_POST['message'] ?? ''),
        'category' => sanitize($_POST['category'] ?? ''),
    ];

    // Валидация имени
    if (empty($formData['name'])) {
        $errors['name'][] = 'Введите ваше имя.';
    } elseif (strlen($formData['name']) < 3) {
        $errors['name'][] = 'Имя должно содержать не менее 3 символов.';
    } elseif (strlen($formData['name']) > 50) {
        $errors['name'][] = 'Имя должно содержать не более 50 символов.';
    }

    // Валидация email
    if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'][] = 'Некорректный email.';
    }

    // Валидация сообщения
    if (empty($formData['message'])) {
        $errors['message'][] = 'Введите сообщение.';
    }

    // Валидация категории
    if (empty($formData['category'])) {
        $errors['category'][] = 'Выберите категорию.';
    }

    // Если ошибок нет, можно обработать данные
    if (empty($errors)) {
        // Данные успешно прошли проверку
        // Можно выполнить сохранение в БД или другие действия
        header('Location: index.php');
        exit;
    }
}
```

### Вывод ошибок валидации

Для отображения ошибок прямо в форме:

```php
<?php require_once 'handler.php'; ?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" required>
    <!-- Проверяем, если есть ошибки для поля "name" -->
    <?php if (!empty($errors['name'])): ?>
        <ul>
            <!-- Выводим все ошибки для поля "name" -->
            <?php foreach ($errors['name'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <?php if (!empty($errors['email'])): ?>А
        <ul>
            <?php foreach ($errors['email'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <label for="message">Сообщение:</label>
    <textarea name="message" id="message" required></textarea>
    <?php if (!empty($errors['message'])): ?>
        <ul>
            <?php foreach ($errors['message'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <label for="category">Категория:</label>
    <select name="category" id="category" required>
        <option value="1">Категория 1</option>
        <option value="2">Категория 2</option>
        <option value="3">Категория 3</option>
    </select>
    <?php if (!empty($errors['category'])): ?>
        <ul>
            <?php foreach ($errors['category'] as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <button type="submit">Отправить</button>
</form>
```

### Оптимизация кода с использованием функций

Чтобы сделать код более удобочитаемым, можно вынести обработку ошибок в отдельную функцию (`functions.php`):

```php
<?php
// functions.php

function printErrors($errors, $field) {
    if (!empty($errors[$field])) {
        echo '<ul>';
        foreach ($errors[$field] as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
    }
}
```

Тогда форма (`index.php`) будет выглядеть компактнее:

```php
<?php
require_once 'handlers.php';
require_once 'functions.php';
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="name">Имя:</label>
    <input type="text" name="name" id="name" required>
    <?php printErrors($errors, 'name'); ?>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>
    <?php printErrors($errors, 'email'); ?>

    <label for="message">Сообщение:</label>
    <textarea name="message" id="message" required></textarea>
    <?php printErrors($errors, 'message'); ?>

    <label for="category">Категория:</label>
    <select name="category" id="category" required>
        <option value="1">Категория 1</option>
        <option value="2">Категория 2</option>
        <option value="3">Категория 3</option>
    </select>
    <?php printErrors($errors, 'category'); ?>

    <button type="submit">Отправить</button>
</form>
```

[^1]: _How to Set up PHP Form Validation: PHP Script, Ajax, JavaScript, and Database Methods Explained_. mailtrap.io [online resource]. Available at: https://mailtrap.io/blog/php-form-validation/
