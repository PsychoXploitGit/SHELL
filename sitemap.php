<?php
// Mendeteksi direktori skrip saat ini
$directoryPath = dirname(__FILE__);

// Nama file daftar (diletakkan di direktori yang sama dengan skrip ini)
$fileName = $directoryPath . '/raptor.txt';

// Membaca file dan mendapatkan isi dalam bentuk array
$entries = file_exists($fileName) ? file($fileName, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

// Mendapatkan basis URL
$scriptPath = $_SERVER['PHP_SELF'];
$basePath = rtrim(dirname($scriptPath), '/\\');
$baseUrl = 'https://' . $_SERVER['HTTP_HOST'];

// Membuat awal file XML
$sitemap = new SimpleXMLElement('<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9"></urlset>');

// Menambahkan URL ke file sitemap
foreach ($entries as $entry) {
    // Mengganti spasi dengan tanda plus
    $formattedEntry = str_replace(' ', '+', $entry);

    $url = $sitemap->addChild('url');
    $url->addChild('loc', $baseUrl . $basePath . '/?page=' . $formattedEntry);
    $url->addChild('lastmod', date('Y-m-d'));
    
}

// Menyimpan file sitemap di direktori yang sama dengan skrip
$sitemapFilePath = $directoryPath . '/sitemap.xml';
$sitemap->asXML($sitemapFilePath);

// Output ke browser
header('Content-Type: application/xml');
echo $sitemap->asXML();
?>