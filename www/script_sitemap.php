<?php

$baseURL = "https://adibida.fr"; // Remplacez par votre URL de base
$routes = yaml_parse_file("routes.yml"); // Chargez les routes à partir du fichier route.yml

// Créez le contenu du fichier sitemap.xml
$xmlContent = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
$xmlContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

// Parcourez les routes pour générer les URLs dans le fichier sitemap.xml
foreach ($routes as $route => $config) {
    $url = $baseURL . '/' . $route;
    $xmlContent .= "\t<url>" . PHP_EOL;
    $xmlContent .= "\t\t<loc>\"{$url}\"</loc>" . PHP_EOL;
    $xmlContent .= "\t</url>" . PHP_EOL;
}

$xmlContent .= '</urlset>';

// Enregistrez le contenu dans le fichier sitemap.xml
$file = fopen('sitemap.xml', 'w');
fwrite($file, $xmlContent);
fclose($file);

echo 'Le fichier sitemap.xml a été généré avec succès.';
