<?php

include_once "./Generator.php";
$host = $_POST['name'] ?? "";
$url = '/sitemap-data/';

$siteMapGenerator = new \generator\GeneratorXml(0.7, date("Y-j-n"), 'sitemap.xml', $host);


/**
 * Write header in .xml file
 */
$header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$mapContent = '<url> <loc>' . $siteMapGenerator->getSiteAddress() . '/</loc> <lastmod>' . $siteMapGenerator->getLastmod() . '</lastmod> <priority>' . $siteMapGenerator->getPriority() . '</priority></url>';
fwrite($siteMapGenerator->getXmlPath(), $header . $mapContent);

/**
 * Write url's in .xml file
 */

$mapContent = "</urlset>";
fwrite($siteMapGenerator->getXmlPath(), $mapContent);
fclose($siteMapGenerator->getXmlPath());

$file = __DIR__ . "/sitemap.xml";
var_dump($file);
function file_download($file): array
{

    if (file_exists($file)) {
        header('X-SendFile: ' . realpath($file));
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));

        return [
            'status' => 'success',
            'message' => 'Файл успешно отдан'
        ];
    } else {
        return [
            'status' => 'error',
            'message' => 'Файл не найден'
        ];
    }
}

file_download($file);

