<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Tree</title>
</head>

<body>
    <h1>Welcome to Tree</h1>
</body>

<?php

echo 'Hello World';
require_once __DIR__ . '/autoload.php';
echo 'Hello World';

use Core\Router;

echo 'Hello World';

$router = new Router();
echo 'Hello World';

require_once __DIR__ . '/config/routes.php';
echo 'Hello World';

$rooter->run();
echo 'Hello World';
