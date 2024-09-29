<?php
# final - це для остаточної реалізації singletone патерна
# озн заброну наслідування

namespace myfrm;
# для класів які встроєні в PHP окремо прописуємо тут або додаємо \ перед назвою
use PDO;
use PDOException;
use PDOStatement;

final class Db
{
    private $connection;
    private PDOStatement $stmt;
    private static $instance = null;

    # патерн single tone
    private function __cunstruct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
    }

    # проблема в можливості створення декількох об'єктів підключення до бд
    # через статичний метод getInstance ми перевіримо чи вже існує підключення
    # якщо так повернемо його якщо ні підключимо
    public static function getInstance()
    {
        # звернення до статичного параметра - self::$instance
        if (self::$instance === null) {
            # в цей блок ми попади якщо обєкту класу ще немає оск = null і відповідно створюємо
            # self() - озн створи себе сам
            self::$instance = new self();
        }
        return self::$instance;
    }

    # підключення бази
    public function getConnection(
        array $db_config
    ) {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};
        charset={$db_config['charset']}";

        try {
            $this->connection = new PDO(
                $dsn,
                $db_config['dbusername'],
                $db_config['dbpassword'],
                $db_config['options']
            );
            return $this;
        } catch (PDOException $e) {
            abort(500);
        }

    }

    #функція запиту в базу
    public function query($query, $params = [])
    {
        try {
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);
            # повертаємо саме наш клас Db, а не обєкт класу PDO як раніше
            # а об'єкт класу PDO тепер буде в параметрі $stmt і в нього вже його методи типу fetchAll
        } catch (PDOException $e) {
            return false;
        }

        return $this;
    }

    public function findAll()
    {
        return $this->stmt->fetchAll();
    }

    public function find()
    {
        return $this->stmt->fetch();
    }

    public function findOrFail()
    {
        $res = $this->find();
        if (!$res) {
            abort();
        }
        return $res;
    }

    public function rowCount()
    {
        # метод PDO який повертає к-ть видаленх рядків
        return $this->stmt->rowCount();
    }

}