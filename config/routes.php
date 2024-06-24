<?php

use App\Controllers\HomeController;

$rooter->addRoute('/', [HomeController::class, 'index']);
