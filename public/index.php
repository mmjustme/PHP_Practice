<?php
ini_set('display_errors', 1);

define("ROOT", dirname(__DIR__)); // /opt/lampp/htdocs/PHP_Practice"
define("PUBLIC", ROOT . '/public');
define("CORE", ROOT . '/core');
define("APP", ROOT . '/app');
define("CONTROLLERS", APP . '/controllers');
define("VIEWS", APP . '/views');
define("PATH", 'http://localhost/PHP_Practice');

require CORE . "/funcs.php";

$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/"); // PHP_Practice

if ($uri === "PHP_Practice") {
    require CONTROLLERS . '/index.php';

} elseif ($uri == 'PHP_Practice/about') {

    require CONTROLLERS . '/about.php';
} else {
    abort();
}


require CONTROLLERS . '/index.php';