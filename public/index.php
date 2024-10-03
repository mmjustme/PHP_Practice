<?php

ini_set('display_errors', 1);

use myfrm\App;
use myfrm\Db;
use myfrm\Router;

session_start();

require_once __DIR__ . "/../vendor/autoload.php";
require dirname(__DIR__) . '/config/config.php';
require __DIR__ .  '/bootstrap.php';
require CORE . "/funcs.php";

# виклик PDO через сервіс 
$db = App::getContainer()->getService('\myfrm\Db');
dump($db);
// die;

$db_config = require CONFIG . '/db.php';
$db = (Db::getInstance())->getConnection($db_config);

$router = new Router();

require_once CONFIG . '/routes.php';
$router->match();