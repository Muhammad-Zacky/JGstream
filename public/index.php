<?php

// =================================================================
// 🕵️‍♂️ AREA DEBUGGING VERCEL (SEMENTARA)
// =================================================================
// Kode ini akan menampilkan isi folder cache.
// Jika kamu melihat file 'config.php' di sini, itulah penyebab errornya.

$cachePath = __DIR__ . '/../bootstrap/cache';

if (is_dir($cachePath)) {
    $files = scandir($cachePath);
    echo "<div style='font-family: monospace; padding: 20px; background: #f0f0f0; border: 2px solid red;'>";
    echo "<h2 style='color: red;'>⚠️ DEBUG MODE: Isi Folder bootstrap/cache</h2>";
    echo "<pre>";
    print_r($files);
    echo "</pre>";
    echo "<hr>";
    echo "<p><strong>Analisa:</strong></p>";
    echo "<ul>";
    echo "<li>Jika ada <strong>config.php</strong> -> Hapus file ini di GitHub!</li>";
    echo "<li>Jika ada <strong>routes-v7.php</strong> -> Hapus file ini di GitHub!</li>";
    echo "<li>Jika isinya cuma <strong>.</strong>, <strong>..</strong>, dan <strong>.gitignore</strong> -> Folder BERSIH (Aman).</li>";
    echo "</ul>";
    echo "</div>";
    die(); // Matikan aplikasi di sini supaya kita fokus ke diagnosa
} else {
    echo "<h1>Folder bootstrap/cache tidak ditemukan! (Aneh)</h1>";
    die();
}
// =================================================================


use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::handle());
