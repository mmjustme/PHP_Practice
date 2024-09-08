<?php

class Db
{
    private $connection;
    private PDOStatement $stmt;

    # підключення бази
    public function __construct(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};
        charset={$db_config['charset']}";

        try {
            $this->connection = new PDO(
                $dsn,
                $db_config['dbusername'],
                $db_config['dbpassword'],
                $db_config['options']
            );
        } catch (PDOException $e) {
            abort(500);
        }

    }

    #функція запиту в базу
    public function query($query)
    {
        $this->stmt = $this->connection->prepare($query);
        $this->stmt->execute();
        # повертаємо саме наш клас Db, а не обєкт класу PDO як раніше
        # а об'єкт класу PDO тепер буде в параметрі $stmt і в нього вже його методи типу fetchAll
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

}