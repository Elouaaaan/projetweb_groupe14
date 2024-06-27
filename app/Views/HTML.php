<?php

namespace App\Views;

class HTML
{
    public static function generateHead($cssFiles = [], $jsFiles = [])
    {
        $cssLinks = '';
        foreach ($cssFiles as $cssFile) {
            $cssLinks .= '<link rel="stylesheet" type="text/css" href="assets/css/' . $cssFile . '">' . PHP_EOL;
        }

        $jsScripts = '';
        foreach ($jsFiles as $jsFile) {
            $jsScripts .= '<script src="assets/js/' . $jsFile . '" defer></script>' . PHP_EOL;
        }

        $appName = getenv('APP_NAME');

        return '
        <head>
            <meta charset="utf-8">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
            <title>' . $appName . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            ' . $cssLinks . '
            ' . $jsScripts . '
        </head>
        ';
    }

    public static function generateBody($header, $content, $footer)
    {
        return '
        <body>
            ' . $header . '
            ' . $content . '
            ' . $footer . '
        </body>
        ';
    }

    public static function generateHTML($header, $content, $footer, $cssFiles = [], $jsFiles = [])
    {
        return '
        <!DOCTYPE html>
        <html lang="fr">
        ' . self::generateHead($cssFiles, $jsFiles) . '
        ' . self::generateBody($header, $content, $footer) . '
        </html>
        ';
    }
}
