<?php

use App\Controllers\HomeController;

$rooter->addRoute('/public/', [HomeController::class, 'index']);
