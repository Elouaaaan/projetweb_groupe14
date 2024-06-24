<?php

use App\Controllers\HomeController;

$rooter->get('/public/', HomeController::index());
