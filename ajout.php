<?php

require __DIR__ . '/bootstrap.php';

use App\Controllers\HomeController;
use App\Controllers\ArbreController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ArbreController('POST');
    $controller->addArbre();
}


echo HomeController::ajout();
