<?php

use Core\Env;

return [
    'host' => Env::env('DB_HOST', 'localhost'),
    'username' => Env::env('DB_USERNAME', 'root'),
    'password' => Env::env('DB_PASSWORD', ''),
    'database' => Env::env('DB_DATABASE', 'my_app'),
];
