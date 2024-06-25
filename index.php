<?php
$database = require_once __DIR__ . '/config/database.php';

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Tree</title>

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

</body>

<?php
echo Env::env('APP_NAME', 'Tree');

require_once __DIR__ . '/autoload.php';
