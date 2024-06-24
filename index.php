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
echo dirname(__DIR__) . '/autoload.php';

require_once dirname(__DIR__) . '/autoload.php';
echo 'aaa';

use Core\Router;

echo 'aaa';

$router = new Router();
echo 'aaa';

require_once dirname(__DIR__) . '/config/routes.php';
echo 'aaa';

$rooter->run();
