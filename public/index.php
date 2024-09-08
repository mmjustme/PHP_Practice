<?php
ini_set('display_errors', 1);

require dirname(__DIR__) . '/config/config.php';
require CORE . "/funcs.php";

require CORE . "/classes/Db.php";
$db_config = require CONFIG . '/db.php';

# при створенні ще одного підключення не ств нове а повертається попереднє
$db = (Db::getInstance())->getConnection($db_config);
$db2 = (Db::getInstance())->getConnection($db_config);
// dump($db);
// dump($db2);
# два підключення але повертають один і той самий об'єктobject(Db)#1
// object(Db)#1 (1) {
//     ["connection":"Db":private]=>
//     object(PDO)#3 (0) {
//     }
//     ["stmt":"Db":private]=>
//     uninitialized(PDOStatement)
//   }
//   object(Db)#1 (1) {
//     ["connection":"Db":private]=>
//     object(PDO)#3 (0) {
//     }
//     ["stmt":"Db":private]=>
//     uninitialized(PDOStatement)
//   }




require CORE . "/router.php";
