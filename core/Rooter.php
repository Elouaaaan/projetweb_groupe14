<?php

namespace Core;

class Rooter
{
    private $routes = [];

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
        $path = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route => $controller) {
            if ($route === $path) {
                if ($method === 'GET') {
                    $controller();
                } else {
                    $controller($_POST);
                }
            }
        }
    }
}
