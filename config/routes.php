<?php

use App\Controllers\HomeController;

echo HomeController::index();
$rooter->get('/public/', HomeController::index());
