# Установка и настройка PHP

На сегодняшний день существует два основных способа установки PHP на компьютер:

- Установить PHP отдельно и использовать встроенный веб-сервер для разработки.
- Установить PHP вместе с веб-сервером, MySQL и другими инструментами в виде пакета.

В этом главе будут рассмотрены оба подхода. Для более быстрой разработки и тестирования рекомендуется использовать первый способ.

## Установка PHP отдельно

Этот способ подходит для минималистичной настройки и использования встроенного веб-сервера PHP.

### Шаги установки

1. **Скачайте PHP**. Перейдите на официальный сайт PHP: [https://www.php.net/downloads](https://www.php.net/downloads) и загрузите версию, соответствующую вашей операционной системе.
2. **Распакуйте Архив**. Извлеките файлы PHP в удобное место, например: `C:\Program Files\php`.
3. **Настройте Переменные Среды**.

   Чтобы система могла находить PHP, добавьте путь к папке `php` в переменную `Path`:

   - Нажмите `Win + R` и введите `sysdm.cpl`.
   - Перейдите на вкладку **Дополнительно** и нажмите **Переменные среды**.
   - В разделе **Системные переменные** выберите `Path` и нажмите **Изменить**.
   - Добавьте новый путь: `C:\Program Files\php`.
   - Нажмите **OK** во всех окнах для сохранения изменений.

4. **Проверьте Установку**. Откройте командную строку (`Win + R`, затем `cmd`) и выполните команду: `php -v`. Если установка прошла успешно, вы увидите версию PHP.

## Установка PHP вместе с веб-Сервером

Этот подход включает установку полного комплекта инструментов, необходимых для разработки, в одном пакете.

### Популярные сборки

- **XAMPP**: [https://www.apachefriends.org](https://www.apachefriends.org) _(рекомендуется для Windows)_.
- **OpenServer**: [https://ospanel.io](https://ospanel.io).

### Что включено в сборки

- **Веб-сервер (Apache или Nginx)** — обработка запросов и ответов клиентов.
- **PHP** — язык программирования для генерации динамического контента.
- **MySQL** — система управления базами данных.
- **phpMyAdmin** — удобный веб-интерфейс для работы с MySQL.
- **Дополнительные Инструменты** — утилиты и библиотеки для разработки.

### Преимущества и недостатки

| **Преимущества**                     | **Недостатки**                                               |
| ------------------------------------ | ------------------------------------------------------------ |
| Быстрая установка всех инструментов. | Занимает больше места на диске.                              |
| Удобство настройки окружения.        | Все проекты размещаются в одной папке, заданной настройками. |

### Установка и настройка XAMPP

#### Установка XAMPP

1. Откройте установочный файл XAMPP и следуйте инструкциям мастера.
2. Выберите следующие компоненты:
   ![Выбор компонентов XAMPP](https://i.imgur.com/Pr9CYoW.png).
3. Укажите путь для установки, например: `C:\Program Files\xampp`.

#### Конфигурация XAMPP

1. Откройте **XAMPP Control Panel**.
2. Нажмите кнопку **Start** напротив модуля Apache.
   ![Start Apache](https://i.imgur.com/OkZKO3T.png)
3. Проверьте работу сервера, введя в адресной строке браузера:

   ```
   http://localhost
   ```

   Если отображается приветственная страница XAMPP, настройка выполнена успешно.

4. Чтобы добавить проект:
   - Создайте папку в каталоге `C:\Program Files\xampp\htdocs`.
   - Поместите в неё файлы вашего сайта.
   - Для доступа к проекту перейдите по адресу:
     ```
     http://localhost/имя_папки
     ```

## Использование встроенного веб-Сервера PHP

Если вы используете встроенный веб-сервер PHP, настройка веб-сервера не требуется. Для работы достаточно выполнить несколько шагов:

1. **Запуск Встроенного Веб-Сервера**:

   - Перейдите в каталог с вашим проектом:
     ```bash
     cd путь_к_каталогу
     ```
   - Запустите встроенный веб-сервер:
     ```bash
     php -S localhost:8000
     ```
   - Откройте браузер и перейдите по адресу:
     ```
     http://localhost:8000
     ```

2. **Выполнение PHP-файла Через Консоль**:
   - Выполните команду:
     ```bash
     php имя_файла.php
     ```
   - Результат выполнения скрипта будет выведен в консоль.

> [!TIP]
> Для новичков рекомендуется начинать с использования XAMPP, так как он предоставляет готовую среду с минимальной необходимостью ручной настройки.
