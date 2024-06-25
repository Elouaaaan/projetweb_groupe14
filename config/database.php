<?php

require_once __DIR__ . '/../autoload.php';

use Core\Env;

(new Env(__DIR__ . '/../.env'))->load();

return [
    'host' => getenv('DB_HOST'),
    'username' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'database' => getenv('DB_DATABASE'),
];
