<?php

require_once __DIR__ . '/../autoload.php';

use App\Controllers\HomeController;

$rooter->addRoute('/', [HomeController::class, 'index']);
