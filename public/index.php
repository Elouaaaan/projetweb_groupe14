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

require_once dirname(__DIR__) . '/autoload.php';

echo '1';

use Core\Rooter;

echo '2';

$rooter = new Rooter();

echo '3';

require_once __DIR__ . '/../config/routes.php';

echo '4';

$rooter->run();
