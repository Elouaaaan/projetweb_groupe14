<?php

require __DIR__ . '/bootstrap.php';

use App\Controllers\HomeController;

var_dump($_GET);

if (empty($_GET['id_arbre'])) {
    header('Location: /tableaucarte.php');
    exit;
}

echo HomeController::age();
