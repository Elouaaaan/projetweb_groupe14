<?php

require __DIR__ . '/bootstrap.php';

use App\Controllers\HomeController;

if (empty($_GET['id_arbre'])) {
    header('Location: /tableaucarte.php');
    exit;
}

echo HomeController::age();
