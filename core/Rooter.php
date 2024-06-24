<?php

namespace Core;

class Rooter
{
    private $routes = [];

    public function get(string $path, array $callback)
    {
        $this->addRoute('GET', $path, $callback);
    }

    public function post(string $path, array $callback)
    {
        $this->addRoute('POST', $path, $callback);
    }

    private function addRoute(string $method, string $path, array $callback)
    {
        $path = ltrim($path, '/');

        $this->routes[$method][$path] = $callback;
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['REQUEST_URI'];

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            echo '404 Not Found';
            return;
        }

        echo call_user_func($callback);
    }
}
