<?php

use myfrm\App;
use myfrm\Db;
use myfrm\ServiceContainer;

$container = new ServiceContainer();

# записуємо ключ і запускаємо фн щоб підключити db_config і повернути PDO
$container->setService('\myfrm\Db', function () {
    $db_config = require CONFIG . '/db.php';
    return (Db::getInstance())->getConnection($db_config);
});


# записуємо сервіс Db за ключем '\myfrm\Db'
App::setContainer($container);