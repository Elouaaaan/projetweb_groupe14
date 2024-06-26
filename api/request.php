<?php

require_once __DIR__ . '/../bootstrap.php';

use App\Controllers\ArbreController;

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
$requestMethod = $_SERVER["REQUEST_METHOD"];

switch ($uri[3]) {
    case 'arbre':
        $options = [
        'per_page' => $_GET['per_page'] ?? null,
        'page' => $_GET['page'] ?? null,
        'column' => $_GET['column'] ?? null,
        'reverse' => $_GET['reverse'] ?? null,
        'search' => $_GET['search'] ?? null,
        ];
        
        $controller = new ArbreController($requestMethod, $options);
        $controller->processRequest();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}

