<?php

namespace Core;

class Rooter
{
    private $routes = [];

    public function __construct()
    {
        $this->routes = [];
    }

    public function addRoute($path, $controller)
    {
        $this->routes[$path] = function () use ($controller) {
            $class = $controller[0];
            $method = $controller[1];
            $instance = new $class();
            $instance->$method();
        };
    }

    public function run()
    {
        echo 'Running...';
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        echo 'Still running...';
        foreach ($this->routes as $route => $controller) {
            echo $route;
            if ($route === $path) {
                echo 'ça marche';
                if ($method === 'GET') {
                    echo 'ça marche GET';
                    echo $controller();
                } else {
                    $controller($_POST);
                }
            }
        }
    }
}
