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

if (!defined('AUTOLOAD_VERSION')) {
    require_once dirname(__DIR__) . '/autoload.php';
}

use Core\Rooter;

$echo "Hello World";

$rooter = new Rooter();

require_once __DIR__ . '/../config/routes.php';

$rooter->run();
