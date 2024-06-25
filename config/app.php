<?php

require_once __DIR__ . '/../autoload.php';

use Core\Env;

(new Env(__DIR__ . '/../.env'))->load();

return [
    'name' => getenv('APP_NAME'),
    'url' => getenv('APP_URL'),
];
