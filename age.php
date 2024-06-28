<?php

require __DIR__ . '/bootstrap.php';

use App\Controllers\HomeController;
use App\Controllers\ArbreController;

echo (new ArbreController('GET'))->getUprooted(1);

echo HomeController::age();
