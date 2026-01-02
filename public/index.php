<?php

use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Routing\RoutingServiceProvider;

define('LARAVEL_START', microtime(true));

// 1. Load Autoloader
require __DIR__.'/../vendor/autoload.php';

// 2. Setup Folder /tmp (Wajib Vercel)
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $tmpDir = '/tmp/laravel';
    foreach (['/bootstrap/cache', '/storage/framework/views'] as $p) {
        if (!is_dir($tmpDir . $p)) mkdir($tmpDir . $p, 0777, true);
    }
    putenv("APP_PACKAGES_CACHE={$tmpDir}/bootstrap/cache/packages.php");
    putenv("APP_SERVICES_CACHE={$tmpDir}/bootstrap/cache/services.php");
}

// 3. Inisialisasi App
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. EMERGENCY REGISTER (Daftarkan sistem View secara manual)
$app->register(EventServiceProvider::class);
$app->register(RoutingServiceProvider::class);
$app->register(ViewServiceProvider::class);

// 5. Jalankan
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/laravel/storage');
}

$app->handleRequest(Request::capture());
