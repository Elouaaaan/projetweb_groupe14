<?php

require __DIR__ . '/bootstrap.php';

use App\Controllers\HomeController;
use App\Controllers\ArbreController;

var_dump($_GET);

if (empty($_GET['id_arbre'])) {
    header('Location: /tableaucarte.php');
    exit;
}

echo (new ArbreController('GET'))->getUprooted(1);

echo HomeController::age();
