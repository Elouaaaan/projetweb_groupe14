<?php

use App\Helpers\Env;

return [
    'name' => Env::env('APP_NAME', 'Tree'),
    'url' => Env::env('APP_URL', 'http://localhost'),
    'debug' => Env::env('APP_DEBUG', true),
    'timezone' => Env::env('APP_TIMEZONE', 'UTC'),
    'locale' => Env::env('APP_LOCALE', 'en'),
];
