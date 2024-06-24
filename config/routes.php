<?php

use App\Controllers\HomeController;

echo '3';
$rooter->get('/public/', HomeController::index());
