<?php

require_once __DIR__ . '/autoload.php';

use Core\Env;
use Core\Database;

(new Env(__DIR__ . '/.env'))->load();

$conn = Database::getInstance()->getConnection();