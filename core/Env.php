<?php

namespace Core;

class Env
{
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function load()
    {
        if (file_exists($this->path)) {
            $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                if (strpos($line, '=') === false || strpos($line, '#') === 0) {
                    continue;
                }

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

