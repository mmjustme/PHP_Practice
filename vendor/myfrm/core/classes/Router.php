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
}