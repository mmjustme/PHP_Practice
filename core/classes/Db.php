<?php

class Db
{
    private $connection;

    public function __construct(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbusername={$db_config['dbusername']};charset={$db_config['charset']}";

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

}