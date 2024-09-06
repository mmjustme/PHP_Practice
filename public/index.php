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

$uri = trim($_SERVER['REQUEST_URI'], "/"); // "/PHP_Practice/" => PHP_Practice

// dd($uri);

if ($uri === "PHP_Practice") {
    require CONTROLLERS . '/index.php';
} elseif ($uri == 'PHP_Practice/about.php') {
    require CONTROLLERS . '/about.php';
} else {
    abort();
}


require CONTROLLERS . '/index.php';