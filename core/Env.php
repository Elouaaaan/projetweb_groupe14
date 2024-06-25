<?php

namespace Core;

class Env
{
    public static function load()
    {
        $envFile = __DIR__ . '/../.env';

        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                    list($key, $value) = explode('=', $line, 2);
                    $key = trim($key);
                    $value = trim($value);

                    if (!array_key_exists($key, $_ENV)) {
                        $_ENV[$key] = $value;
                    }
                }
            }
        }
    }

    public static function env($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

Env::load();
