# Рекомендации по написанию кода на PHP

Каждый язык программирования имеет свои особенности и лучшие практики. Чтобы писать качественный код на PHP, недостаточно знать только синтаксис языка — необходимо следовать принципам чистого, понятного и поддерживаемого кода.

В этом разделе приведены основные рекомендации по написанию кода на PHP. С углублением изучения языка, этот список будет расширяться.

## Основные рекомендации

### Использование PHP-тегов `<?php`

PHP-код начинается с открывающего тега `<?php`. Эти теги позволяют внедрять PHP-код в HTML-документы. Закрывающий тег `?>` используется только при необходимости.

1. **Начинайте PHP-код с новой строки после открывающего тега.**
   Это повышает читаемость кода.

   ```php
   <?php
   
   echo "Hello, world!";
   ```

2. **Не используйте закрывающий тег `?>`, если файл состоит только из PHP-кода.**  
   Это предотвращает возможные ошибки, связанные с пробелами или переносами строк после закрывающего тега.

   ```php
   <?php
   
   echo "Этот файл заканчивается PHP-кодом, закрывающий тег не нужен.";
   ```

3. **Используйте закрывающий тег `?>`, если после PHP-кода следует HTML.**  
   Например:
   ```php
   <div>
       <?php
       echo "Hello, world!";
       ?>
   </div>
   ```

### Не смешивайте PHP и HTML без необходимости [^2]

Смешивание PHP и HTML может значительно ухудшить читаемость и усложнить поддержку кода. Логика должна быть отделена от представления, а PHP-код использоваться только там, где это действительно необходимо.

#### Пример плохой практики

```php
<div>
    <?php
    if ($userLoggedIn) {
        echo "<p>Добро пожаловать, $userName!</p>";
    } else {
        echo "<p>Пожалуйста, войдите в систему.</p>";
    }
    ?>
</div>
```

В данном примере HTML и PHP тесно переплетены, что усложняет понимание структуры и внесение изменений.

#### Пример хорошей практики

Используйте структурированный подход, минимизируя переключение между PHP и HTML:

```php
<div>
    <?php if ($userLoggedIn) { ?>
        <p>Добро пожаловать, <? echo $userName; ?>!</p>
    <?php } else { ?>
        <p>Пожалуйста, войдите в систему.</p>
    <?php } ?>
</div>
```

#### Пример с тернарным оператором

Если нужно упростить код, используйте тернарный оператор для формирования текста заранее:

```php
<?php
$message = $userLoggedIn
    ? "Добро пожаловать, $userName!"
    : "Пожалуйста, войдите в систему.";
?>

<div>
    <p><?php echo $message; ?></p>
</div>
```

#### Пример с использованием цикла

Для повторяющихся элементов, таких как списки, также можно применить аккуратное разделение:

```php
<ul>
    <?php for ($i = 1; $i <= 5; $i++) { ?>
        <li>Элемент <?php echo $i; ?></li>
    <?php } ?>
</ul>
```

Как можно заметить, разделение PHP-кода и HTML делает код более читаемым и понятным.

### Использование короткого синтаксиса `echo` [^1]

В PHP существует сокращённый синтаксис для вывода переменных: `<?= $variable ?>`. Он является эквивалентом записи `<?php echo $variable; ?>` и может сделать код более компактным и читаемым.

**Пример.** _Использование короткого синтаксиса `echo`_

```php
<?php
$name = "Alice";
?>

<p>Привет, <?= $name ?>!</p>
```

Этот синтаксис удобен для вставки переменных непосредственно в HTML и часто используется для упрощения шаблонов.

Этот подход, хотя и упрощает код, не рекомендуется для использования в крупных проектах из-за возможных проблем с совместимостью, так как некоторые серверы могут его не поддерживать. Поэтому предпочтительнее придерживаться стандартного синтаксиса `<?php echo $variable; ?>`.

### Стандарты PSR

Для разработки на PHP существуют стандарты, которые помогают улучшить качество кода, сделать его более читаемым и удобным для поддержки.

Одним из наиболее популярных стандартов является **PSR** (*PHP Standard Recommendation*). **PSR** описывает проверенные на практике концепции и подходы, которые упрощают взаимодействие между разработчиками и обеспечивают единообразие в написании кода.

На сегодняшний день PSR включает множество стандартов, таких как PSR-1, PSR-2, PSR-3, PSR-4 и другие, каждый из которых охватывает определённый аспект разработки.

Для начала изучения рекомендуется ознакомится с двумя основными стандартами:

- **PSR-1**: Basic Coding Standard. Этот стандарт описывает основные правила написания кода на PHP, включая соглашения об именовании классов, методов и констант [^3].
- **PSR-12**: Extended Coding Style. Данный стандарт определяет стиль написания кода, включая правила отступов, расположение скобок и использование пробелов, что делает код более читаемым [^4].

> [!NOTE]
> На данном этапе нет необходимости запоминать все детали и вникать в них глубоко. Достаточно знать, что такие стандарты существуют. Мы будем постепенно изучать их и разбирать на практике в процессе освоения PHP.

[^1]: _PHP tags_. php.net [online resource]. Available at: https://www.php.net/manual/en/language.basic-syntax.phptags.php
[^2]: _Instruction separation_. php.net [online resource]: Available at: https://www.php.net/manual/en/language.basic-syntax.instruction-separation.php
[^3]: _PSR-1: Basic Coding Standard_. PHP-FIG [online resource]. Available at: https://www.php-fig.org/psr/psr-1/
[^4]: _PSR-12: Extended Coding Style_. PHP-FIG [online resource]. Available at: https://www.php-fig.org/psr/psr-12/