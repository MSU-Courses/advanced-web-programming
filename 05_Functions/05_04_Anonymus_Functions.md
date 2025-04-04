# Анонимные функции

> [!NOTE]
> Данная глава является необязательной и предназначена для тех, кто стремится углубить свои знания.

**Анонимные функции** (также известные как замыкания, от английского "closures") — это функции, которые не имеют имени. Они часто **используются для передачи как значения переменных или аргументов другим функциям** [^1].

Анонимные функции создаются с использованием ключевого слова `function` без указания имени. Они могут принимать аргументы, возвращать значения и работать с переменными из внешней области видимости

**Пример.** _Присваивание анонимной функции переменной_

```php
<?php

$sum = function ($a, $b) {
    return $a + $b;
};

echo $sum(2, 3); // Вывод: 5
```

**Объяснение**:

- Анонимная функция, которая возвращает сумму двух чисел, присваивается переменной $sum.
- Затем эта переменная используется для вызова функции с аргументами `2` и `3`.

## Использование анонимных функций

### 1. Передача как аргумента другой функции

Анонимные функции часто используются в качестве аргументов других функций.

```php
<?php

$numbers = [1, 2, 3, 4, 5];

// Используем анонимную функцию для фильтрации чисел
$filtered = array_filter($numbers, function ($num) {
    return $num % 2 === 0; // Оставляем только чётные числа
});

print_r($filtered);
// Вывод: Array ( [1] => 2 [3] => 4 )
```

Функция `array_filter` принимает массив и функцию-обработчик. Анонимная функция проверяет, является ли число чётным.

### 2. Использование переменных из внешней области видимости

Анонимные функции могут использовать переменные из внешней области видимости с помощью ключевого слова `use`.

```php
<?php

$multiplier = 3;

$multiply = function ($num) use ($multiplier) {
    return $num * $multiplier;
};

echo $multiply(5); // Вывод: 15
```

- Ключевое слово `use` позволяет передать переменную `$multiplier` в анонимную функцию.
- Теперь функция `multiply` умножает переданное значение на `3`.

### 3. Возврат анонимной функции

Анонимные функции могут быть возвращены как результат выполнения другой функции.

```php
<?php

function createMultiplier($factor) {
    return function ($num) use ($factor) {
        return $num * $factor;
    };
}

$double = createMultiplier(2);
$triple = createMultiplier(3);

echo $double(4); // Вывод: 8
echo $triple(4); // Вывод: 12
```

Функция `createMultiplier` возвращает анонимную функцию, которая умножает переданное число на заданный множитель.

## Ключевое слово `use`

Ключевое слово `use` в PHP позволяет анонимным функциям использовать переменные из внешней области видимости. Это особенно полезно, когда требуется передать значения переменных внутрь функции, не делая их глобальными.

**Синтаксис**

```php
$function = function (type $arg1, ...) use ($var1, $var2, ...): return_type {
    // Тело функции
    return $returnValue;
};
```

- `use ($var1, $var2, ...)` — список переменных, которые будут переданы в функцию из внешней области видимости.
- Переменные передаются по значению, если не указано иное.

**Пример.** _Ошибка без использования use_

Попробуем использовать переменную из внешней области видимости без ключевого слова `use`:

```php
<?php

$multiplier = 3;

$multiply = function ($num) {
    // Ошибка: переменная $multiplier не определена внутри функции
    return $num * $multiplier;
};

echo $multiply(5);
```

Переменные из внешней области видимости недоступны внутри анонимной функции, если не использовать `use`.

**Пример.** _Правильное использование use_

```php
<?php

$multiplier = 3;

$multiply = function ($num) use ($multiplier) {
    return $num * $multiplier;
};

echo $multiply(5); // Вывод: 15
```

Ключевое слово `use` позволяет передать значение переменной `$multiplier` внутрь анонимной функции. Функция теперь успешно использует переменную из внешней области видимости.

> [!NOTE]
> По умолчанию переменные передаются в анонимные функции по значению, что означает, что изменения внутри функции не затронут оригинальную переменную.

**Пример.** _Сортировка массива по динамическому критерию_

```php
<?php

$order = 'desc'; // Можно задать 'asc' или 'desc'
$numbers = [30, 60, 20, 80, 40];

usort($numbers, function ($a, $b) use ($order) {
    return $order === 'asc' ? $a <=> $b : $b <=> $a;
});

print_r($numbers);
// Вывод при $order = 'desc': Array ( [0] => 80 [1] => 60 [2] => 40 [3] => 30 [4] => 20 )
```

Критерий сортировки передаётся в анонимную функцию через переменную `$order` с использованием use.

[^1]: *Anonymous functions*. php.net [online resource]. Available at: https://www.php.net/manual/ru/language.types.array.php