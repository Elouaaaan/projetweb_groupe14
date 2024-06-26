<?php

namespace App\Views;

use Core\Env;

class HTML {
    public static function generateHead() {
        return '
        <head>
            <meta charset="utf-8">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
            <title>' . getenv('APP_NAME') . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="assets/css/main.css">
            <link rel="stylesheet" type="text/css" href="assets/css/header.css">

            <link rel="stylesheet" type="text/css" href="assets/css/form.css">
            
            <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
            <script src="assets/js/script.js" defer></script>
        </head>
        ';
    }

    public static function generateBody($header, $content, $footer) {
        return '
        <body>
            ' . $header . '
            ' . $content . '
            ' . $footer . '
        </body>
        ';
    }

    public static function generateHTML($header, $content, $footer) {
        return '
        <!DOCTYPE html>
        <html lang="fr">
        ' . self::generateHead() . '
        ' . self::generateBody($header, $content, $footer) . '
        </html>
        ';
    }
}

