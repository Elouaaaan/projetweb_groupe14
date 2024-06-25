<?php

require_once __DIR__ . '/../autoload.php';

use Core\Env;

(new Env(__DIR__ . '/../.env'))->load();

return [
    'conn' => getenv('DB_CONNECTION'),
    'host' => getenv('DB_HOST'),
    'name' => getenv('DB_DATABASE'),
    'user' => getenv('DB_USERNAME'),
    'pass' => getenv('DB_PASSWORD')
];
