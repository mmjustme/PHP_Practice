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

// маємо пробоему коли в строку долаємо GET параметри, тому робимо наступним чином
// parse_url розбиває нашу строку на такі параметри
// var_dump(parse_url('http://localhost/PHP_Practice/about?id=1'));
// array(4) { ["scheme"]=> string(4) "http" 
// ["host"]=> string(9) "localhost" 
// ["path"]=> string(19) "/PHP_Practice/about" 
// ["query"]=> string(4) "id=1" 
// }
// тим самим відділяє основну строку і інші параметри

// Означає ми одразу беремо частину шляху яка наз path а це /PHP_Practice/about
// а тоді вже забираємо "/" в кінці через trim
// і ми знову отримуємо "PHP_Practice/about" але тепер можемо вписувати get параметри в строку
$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/"); // PHP_Practice
// dd($uri);

// також GET параметри втрачаються оск необхідно дадати налаштування htaccess такі як [L,QSA]
// що озн додати в кінець усі усі заппити в адресну строку
// dump($_GET);
// array(2) {
// ["about"]=>
// string(0) ""
// ["id"]=>
// string(1) "1"
//   }

if ($uri === "PHP_Practice") {
    require CONTROLLERS . '/index.php';

} elseif ($uri == 'PHP_Practice/about') {

    require CONTROLLERS . '/about.php';
} else {
    abort();
}


require CONTROLLERS . '/index.php';