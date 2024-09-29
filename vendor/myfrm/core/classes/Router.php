<?php
namespace myfrm;
class Router
{
    protected $routes = [];
    protected $uri;
    protected $method;

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], "/");
        # дає можливість спочатку перевірити чи є щось в _method
        # потрібно для реалізації методу delete
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    # function helper avoid excessive code
    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    public function match()
    {
        $matches = false;

        # пробігаємося по наших роутах це масиви з uri,controller, methods
        foreach ($this->routes as $route) {
            #якщо є співпадіння в строці запиту і методі підключаємо відпов. контроллер
            if (($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) {
                require CONTROLLERS . "/{$route['controller']}";
                // dd($route);
                $matches = true;
                break;
            }
        }
        if (!$matches)
            abort();
    }

    public function get($uri, $controller)
    {
        $this->add($uri, $controller, "GET");
    }

    public function post($uri, $controller)
    {
        $this->add($uri, $controller, "POST");
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, "DELETE");
    }
}