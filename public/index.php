<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// 1. Register Autoloader
require __DIR__.'/../vendor/autoload.php';

// 2. Setup folder writable untuk Vercel
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $tmpDir = '/tmp/laravel';
    foreach (['/storage/framework/views', '/storage/framework/cache', '/bootstrap/cache'] as $path) {
        if (!is_dir($tmpDir . $path)) mkdir($tmpDir . $path, 0777, true);
    }
    // Set path cache ke /tmp agar tidak Read-Only
    putenv("APP_PACKAGES_CACHE={$tmpDir}/bootstrap/cache/packages.php");
    putenv("APP_SERVICES_CACHE={$tmpDir}/bootstrap/cache/services.php");
}

// 3. Bootstrap & Handle Request
$app = require_once __DIR__.'/../bootstrap/app.php';

if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/laravel/storage');
}

$app->handleRequest(Request::capture());
