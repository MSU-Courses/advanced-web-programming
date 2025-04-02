# Объектно-ориентированный подход: класс-обёртка над PDO

> [!NOTE]
> Эта глава является дополнительным и предназначен для тех, кто хочет углубить знания.

В предыдущих примерах взаимодействие с базой данных осуществлялось в процедурном стиле — особенно в случае с MySQLi. Такой подход прост для понимания, но плохо масштабируется. По мере роста проекта становится трудно поддерживать повторяющийся код подключения, выполнения запросов, обработки ошибок и извлечения результатов.

Объектно-ориентированный стиль помогает решить эту проблему. В этой главе будет показано, как создать класс-обёртку над PDO, который упростит работу с базой данных, сделает код более читаемым, модульным и удобным для поддержки.

```php
<?php

/**
 * Класс Database — объектно-ориентированная обёртка над PDO
 * для упрощённой и безопасной работы с базой данных.
 */
class Database
{
    /**
     * @var PDO Экземпляр PDO для подключения к базе данных.
     */
    private PDO $pdo;

    /**
     * Конструктор класса. Выполняет подключение к базе данных.
     *
     * @param string $host Хост
     * @param string $dbname Имя базы данных.
     * @param string $user Имя пользователя БД.
     * @param string $pass Пароль пользователя БД.
     * @param array $options Дополнительные опции PDO (необязательно).
     * @throws PDOException В случае ошибки подключения.
     */
    public function __construct(
        string $host,
        string $dbname,
        string $user,
        string $pass,
        array $options = []
    ) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
        $defaultOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->pdo = new PDO($dsn, $user, $pass, $options + $defaultOptions);
    }

    /**
     * Выполняет подготовленный SQL-запрос.
     *
     * @param string $sql SQL-запрос с плейсхолдерами.
     * @param array $params Массив параметров запроса.
     * @return PDOStatement Объект результата выполнения запроса.
     */
    public function query(string $sql, array $params = []): PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Получает все строки результата запроса.
     *
     * @param string $sql SQL-запрос.
     * @param array $params Параметры запроса.
     * @return array Массив всех строк результата.
     */
    public function getAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    /**
     * Получает одну строку результата запроса.
     *
     * @param string $sql SQL-запрос.
     * @param array $params Параметры запроса.
     * @return array|null Ассоциативный массив или null, если строка не найдена.
     */
    public function getOne(string $sql, array $params = []): ?array
    {
        $result = $this->query($sql, $params)->fetch();
        return $result === false ? null : $result;
    }

    /**
     * Получает значение одного поля из результата (например, COUNT(*), LAST_INSERT_ID()).
     *
     * @param string $sql SQL-запрос.
     * @param array $params Параметры запроса.
     * @return mixed Значение первой колонки первой строки результата.
     */
    public function getValue(string $sql, array $params = []): mixed
    {
        return $this->query($sql, $params)->fetchColumn();
    }

    /**
     * Возвращает ID последней вставленной записи.
     *
     * @return string ID последней вставки.
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Возвращает нативный объект PDO, если необходимо использовать его напрямую.
     *
     * @return PDO Объект подключения к базе.
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}

// Пример использования класса Database
$db = new Database('localhost', 'test', 'root', 'password');
$sql = "SELECT * FROM users WHERE id = :id";

// Получаем пользователя с id = 1
$user = $db->getOne($sql, ['id' => 1]);

// ...
```

**Создание обёртки над PDO — это первый шаг к архитектурно грамотному приложению**. Такой подход помогает избежать дублирования, упрощает тестирование и подготовку к более сложным решениям, таким как внедрение ORM, сервисов или шаблонов проектирования.
