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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
            <title>' . $appName . '</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
            <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
            <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
            <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
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
