<?php

use App\Controllers\HomeController;

echo HomeController::index();
$router->get('/', HomeController::index());
$router->get('/home', HomeController::index());
