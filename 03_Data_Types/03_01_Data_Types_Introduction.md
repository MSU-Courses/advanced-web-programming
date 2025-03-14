# Введение в типы данных в PHP

PHP является динамически типизированным языком программирования. Это означает, что при объявлении переменных не требуется указывать их тип. Тип переменной определяется автоматически на основе присвоенного значения.

**Пример.** _Объявление переменных в PHP_

```php
<?php
$number = 42;        // Целое число
$float = 3.14;       // Дробное число
$str = "Hello, world!"; // Строка
```

Типы данных в PHP позволяют:

- Определять, какие операции можно выполнять с переменными.
- Ограничивать возможные значения, которые переменные могут принимать.
- Управлять тем, как данные хранятся и обрабатываются в памяти.

Для проверки типа данных и значения переменной можно использовать встроенные функции, такие как `gettype()` и `var_dump()`.

- `gettype()` _возвращает_ тип переменной.
- `var_dump()` _выводит_ тип и значение переменной, а также дополнительную информацию, например, длину строки.

**Пример.** _Проверка типа переменной_

```php
<?php
$number = 42;
echo gettype($number); // integer
var_dump($number);     // int(42)
```

В дальнейшем мы рассмотрим все типы данных в PHP более подробно, а также их использование в различных сценариях.

## Указание типа переменной

При изучении данной главы может возникнуть вопрос: "Зачем знать тип переменной, если PHP определяет его автоматически?".

С выходом **PHP 7.0** появилась возможность явно указывать тип данных для переменных в определённых случаях. Это нововведение помогает писать более понятный, надёжный и предсказуемый код.

### Когда можно указывать тип переменной?

- **В объявлении аргументов функции**. Позволяет ограничить типы данных, которые функция принимает.
- **Для возвращаемого значения функции**. Указывает, какого типа значение должна возвращать функция.
- **В объявлении свойств класса**. Помогает контролировать тип данных, хранимых в объекте.
- **Другие случаи**. Типизация позволяет применять строгий подход к структурам данных, интерфейсам и обработке ошибок.

### Преимущества явного указания типов

- **Улучшение читаемости кода**. Читая код, вы сразу видите, какие типы данных ожидаются.
- **Повышение надёжности**. PHP вызывает ошибку, если передан аргумент или возвращено значение неправильного типа.
- **Упрощение отладки**. Сужение возможных типов данных помогает быстрее находить ошибки.

**Пример.** _Указание типа аргументов и возвращаемого значения_

```php
<?php

/**
 * Функция сложения двух чисел.
 *
 * @param int $a Первое число.
 * @param int $b Второе число.
 *
 * @return int Сумма чисел.
 */
function sum(int $a, int $b): int {
    return $a + $b;
}

echo sum(5, 10);
```

В этом примере:

- **Типы аргументов** (`int $a`, `int $b`) указываются в скобках после имени параметра.
- **Тип возвращаемого значения** (`: int`) указывается после двоеточия.
