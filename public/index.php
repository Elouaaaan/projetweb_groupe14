<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree</title>
</head>

<body>
    <script>
        fetch('/')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
    </script>
</body>

<?php

require __DIR__ . '/../config/routes.php';
