<?php

require CONFIG . "/routes.php";

$uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/"); // PHP_Practice
// dump($uri);

// Перевіримо наявність ключа в uri в масиві routes
// тобто якщо ми знайшли about ми підключимо відпов.контроллер
if (array_key_exists($uri, $routes)) {
  // додаткова перевірка чи такий файл взаглі існує
  if (file_exists(CONTROLLERS . "/{$routes[$uri]}")) {
    require CONTROLLERS . "/{$routes[$uri]}";
  } else {
    abort();
  }
} else {
  abort();
}
