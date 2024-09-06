<?php
ini_set('display_errors', 1);

define("ROOT", dirname(__DIR__)); // /opt/lampp/htdocs/PHP_Practice"
define("PUBLIC", ROOT . '/public');
define("CORE", ROOT . '/core');
define("APP", ROOT . '/app');
define("CONTROLLERS", APP . '/controllers');
define("VIEWS", APP . '/views');
define("PATH", 'http://localhost/');

require CORE . "/funcs.php";

// dd("Hello");


require CONTROLLERS . '/index.php';