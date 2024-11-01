<?php

namespace myfrm;

class Router
{
  public $routes = [];
  protected $uri;
  public $method;

  public function __construct()
  {
    $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/");
    # дає можливість спочатку перевірити чи є щось в _method
    # потрібно для реалізації методу delete
    $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
  }

  public function only($middleware)
  {
    // dump($this->routes);
    // dump($middleware);
    // dump(array_key_last($this->routes));

    # шукаємо відповідний елемент масиву routes щоб в полі middleware
    # записати назву middleware - user or guest
    $key = array_key_last($this->routes);
    $this->routes[$key]['middleware'] = $middleware;
    # в резкльтаті ми маємо масив з шляхами це ініші масиви. 
    # І у відповідному масиві (шляху) де має бути перевірка middleware
    # буде поле з назвою middleware
    return $this;
  }

  # function helper avoid excessive code
  public function add($uri, $controller, $method)
  {
//    dump($this->routes);
    # array_map застосовує для кожного значення якусь функцію,нашу або вбудовану
    if (is_array($method)) {
      $method = array_map('strtoupper', $method);
    } else {
      # якщо ж $method не масив ми зробимо з нього масив навмисне
      $method = [$method];
    }

    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => null,
    ];
    return $this;
  }


  public function match()
  {
    $matches = false;


    foreach ($this->routes as $route) {
      if (($route['uri'] === $this->uri) && (in_array(strtoupper($this->method), $route['method']))) {

        # за за мовчуванням middleware = null (false)
        if ($route['middleware']) {

          # додаткова перевірка ьеремо з константи нашу міделвару
          # якщо її немає буде false
          $middleware = MIDDLEWARE[$route['middleware']] ?? false;

          # якщо міделвари немає яку ми підключили кидаємо помилку
          if (!$middleware) throw new \Exception('Incorect middleware ' . $route['middleware']);

          # в іншому ж випадку підключаємо відпов. клас з методом
          (new $middleware)->handle();
        }
        require CONTROLLERS . "/{$route['controller']}";
        $matches = true;
        break;
      }
    }
    if (!$matches)
      abort();
  }

  public function get($uri, $controller)
  {
    return $this->add($uri, $controller, "GET");
  }

  public function post($uri, $controller)
  {
    return $this->add($uri, $controller, "POST");
  }

  public function delete($uri, $controller)
  {
    return $this->add($uri, $controller, "DELETE");
  }
}
