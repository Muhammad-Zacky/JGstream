<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Register Autoloader
require __DIR__.'/../vendor/autoload.php';

// 2. Siapkan folder Storage & Cache di /tmp (Khusus Vercel)
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $tmpDir = '/tmp/laravel';
    $subDirs = [
        $tmpDir . '/storage/framework/views',
        $tmpDir . '/storage/framework/cache',
        $tmpDir . '/storage/framework/sessions',
        $tmpDir . '/bootstrap/cache',
    ];

    foreach ($subDirs as $dir) {
        if (!is_dir($dir)) mkdir($dir, 0777, true);
    }

    // Paksa Laravel pakai path bootstrap cache di /tmp
    putenv("APP_PACKAGES_CACHE={$tmpDir}/bootstrap/cache/packages.php");
    putenv("APP_SERVICES_CACHE={$tmpDir}/bootstrap/cache/services.php");
    putenv("APP_CONFIG_CACHE={$tmpDir}/bootstrap/cache/config.php");
    putenv("APP_ROUTES_CACHE={$tmpDir}/bootstrap/cache/routes.php");
}

// 3. Bootstrap Laravel
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. Set Storage Path ke /tmp jika di Vercel
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/laravel/storage');
}

// 5. Jalankan Aplikasi
$app->handleRequest(Request::capture());
