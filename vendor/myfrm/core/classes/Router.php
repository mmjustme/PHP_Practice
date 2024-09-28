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
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    # function helper avoid excessive code
    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'methods' => $method,
        ];
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