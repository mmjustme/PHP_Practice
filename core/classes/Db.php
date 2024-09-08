<?php

class Db
{
    private $connection;

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
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

}