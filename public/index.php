<?php
use myfrm\Router;
ini_set('display_errors', 1);
session_start();


use myfrm\Db;

require_once __DIR__ . "/../vendor/autoload.php";

require dirname(__DIR__) . '/config/config.php';
require CORE . "/funcs.php";


$db_config = require CONFIG . '/db.php';
$db = (Db::getInstance())->getConnection($db_config);


$router = new Router();

// require CORE . "/router.php";
