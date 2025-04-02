# Создание базы данных

На других курсах вы уже знакомились с процессом создания баз данных. Тем не менее, мы повторим этот этап, чтобы закрепить знания. В этом разделе будет показан пример создания базы данных с использованием **MySQL** в составе пакета **XAMPP** и **PostgreSQL** с использованием **pgAdmin**.

## MySQL и XAMPP

> [!TIP]  
> Пример установки XAMPP приведён в главе `02_02_Installation.md`.

### Запуск сервера баз данных

1. Откройте XAMPP.
2. Запустите сервер MySQL, нажав кнопку `Start` в секции `MySQL`.  
   <img src="https://img001.prntscr.com/file/img001/iiJWKNS7RES9LkENu-rWnA.png" alt="XAMPP" width="600">
3. При успешном запуске сервер станет активным, надпись `MySQL` подсветится зелёным цветом, а кнопка `Start` изменится на `Stop`.  
   <img src="https://img001.prntscr.com/file/img001/IwoELzcyS6OzUYbJlAazfQ.png" alt="XAMPP" width="600">
4. Если сервер базы данных не запускается, попробуйте запустить XAMPP от имени администратора.
5. Также запустите сервер `Apache`, нажав кнопку `Start` в блоке `Apache`. Он потребуется для работы веб-интерфейса **phpMyAdmin**, используемого для администрирования баз данных.  
   <img src="https://img001.prntscr.com/file/img001/nPobxFrWRui0yX0RAjXyXA.png" alt="XAMPP" width="600">

### Создание базы данных

1. Нажмите кнопку **Admin** напротив строки `MySQL`.  
   <img src="https://img001.prntscr.com/file/img001/3bfQIqsISYiJykkECR_9sQ.png" alt="XAMPP" width="600">
2. Откроется веб-интерфейс **phpMyAdmin** в браузере. С помощью него вы можете управлять базами данных через визуальный интерфейс.  
   <img src="https://img001.prntscr.com/file/img001/hpU-ICMvRKGy6lyVlrA4Dg.png" alt="phpMyAdmin" width="600">
3. Для создания новой базы данных нажмите вкладку **Создать БД**.  
   <img src="https://img001.prntscr.com/file/img001/yoS3mcJtTmKR7G-GyqA5IQ.png" alt="phpMyAdmin" width="600">
4. Укажите имя базы данных (1) и нажмите кнопку **Создать** (2).  
   <img src="https://img001.prntscr.com/file/img001/_heXxtyKTHamOeiox1jZ0w.png" alt="phpMyAdmin" width="600">
5. После создания база данных появится в списке слева.  
   <img src="https://img001.prntscr.com/file/img001/LIdnXcKaRJOTmc7MrBtXqA.png" alt="phpMyAdmin" width="600">

### Данные для подключения к базе данных

Для последующей работы с базой данных вам понадобятся следующие параметры подключения:

| Параметр         | Значение                              |
| ---------------- | ------------------------------------- |
| **Хост**         | `localhost`                           |
| **Порт**         | `3306` (порт по умолчанию для MySQL)  |
| **База данных**  | Имя вашей базы (например, `blog_app`) |
| **Пользователь** | `root` (по умолчанию)                 |
| **Пароль**       | пустой (по умолчанию)                 |

> [!TIP]  
> В реальных проектах рекомендуется создать отдельного пользователя с ограниченными правами вместо использования `root`.

## PostgreSQL и pgAdmin

Для выполнения шагов, описанных ниже, на вашем компьютере должны быть установлены:

- [PostgreSQL Server](https://www.postgresql.org/download/) — сервер баз данных PostgreSQL;
- [pgAdmin](https://www.pgadmin.org/download/) — графический интерфейс для управления PostgreSQL.

### Создание пользователя

1. Запустите **pgAdmin**.  
   <img src="https://img001.prntscr.com/file/img001/kY3FXzX7S-K_58mwqVihKw.png" alt="pgAdmin" width="600">

2. При первом запуске программа запросит пароль для доступа к интерфейсу. Введите его и нажмите **OK**.

3. В левой части окна находится дерево объектов. Разверните пункт `Servers`.  
   <img src="https://img001.prntscr.com/file/img001/JJajDSN4QBCbHLErJtWKoA.png" alt="pgAdmin" width="600">

4. Щёлкните правой кнопкой мыши на **Login/Group Roles** и выберите `Create` → `Login/Group Role...`.  
   <img src="https://img001.prntscr.com/file/img001/IiSAXPn8TN6Q9N80Qqz_Ag.png" alt="pgAdmin" width="600">

5. Во вкладке **General** введите имя нового пользователя (например, `blog_usr`).  
   <img src="https://img001.prntscr.com/file/img001/kTU84F8ETiGVPE8iDl06Qg.png" alt="pgAdmin" width="600">

6. Перейдите на вкладку **Definition** (#1) и установите пароль для пользователя (#2).  
   <img src="https://img001.prntscr.com/file/img001/o0t0_oOnRiaPlmN86emlLA.png" alt="pgAdmin" width="600">

7. Затем откройте вкладку **Privileges** (#1) и установите флажок **Can Login** (#2).  
   <img src="https://img001.prntscr.com/file/img001/wTutZRHASDmCH5TxUih63A.png" alt="pgAdmin" width="600">

8. Нажмите кнопку **Save** в правом нижнем углу, чтобы создать пользователя.

### Создание базы данных

1. В дереве объектов щёлкните правой кнопкой мыши на **Databases** и выберите `Create` → `Database...`.  
   <img src="https://img001.prntscr.com/file/img001/6Sgdeg7_QkGoPsjbhY4QIQ.png" alt="pgAdmin" width="600">

2. Во вкладке **General** укажите имя базы данных (например, `blog`) (#1) и выберите ранее созданного пользователя в поле **Owner** (#2).
   <img src="https://img001.prntscr.com/file/img001/7S5224wKS-imknvqIUflwA.png" alt="pgAdmin" width="600">

3. Нажмите кнопку **Save** в правом нижнем углу.

4. Новая база данных появится в списке слева (#1), а внутри неё вы сможете создавать таблицы и другие объекты (#2).  
   <img src="https://img001.prntscr.com/file/img001/1-LuNcXNQRG7opPpKgQmAA.png" alt="pgAdmin" width="600">

### Данные для подключения к базе данных

Для подключения к созданной базе данных в своём приложении используйте следующие параметры:

| Параметр         | Значение                                           |
| ---------------- | -------------------------------------------------- |
| **Хост**         | `localhost`                                        |
| **Порт**         | `5432` (порт по умолчанию для PostgreSQL)          |
| **База данных**  | Имя базы (например, `blog`)                        |
| **Пользователь** | Имя созданного пользователя (например, `blog_usr`) |
| **Пароль**       | Пароль, заданный при создании пользователя         |
| **Кодировка**    | `UTF-8`                                            |
| **Драйвер**      | `pgsql` (используется в PDO или других клиентах)   |