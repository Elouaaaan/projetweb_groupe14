<?php

$classmap = [
    'Core' => __DIR__ . '/core/',
    'App' => __DIR__ . '/app/',
];

spl_autoload_register(function (string $classname) use ($classmap) {
    $parts = explode('\\', $classname);

    $namespace = array_shift($parts);
    $classfile = array_pop($parts) . '.php';

    if (!array_key_exists($namespace, $classmap)) {
        return;
    }

    $path = implode(DIRECTORY_SEPARATOR, $parts);
    $file = $classmap[$namespace] . $path . DIRECTORY_SEPARATOR . $classfile;

    if (!file_exists($file) && !class_exists($classname)) {
        echo "File not found: $file";
        return;
    }
    require_once $file;
});
