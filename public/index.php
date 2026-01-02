<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

define('LARAVEL_START', microtime(true));

// 1. Autoload
require __DIR__.'/../vendor/autoload.php';

// 2. Lingkungan Vercel - Folder writable
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $tmp = '/tmp/laravel';
    foreach (['/storage/framework/views', '/storage/framework/cache', '/bootstrap/cache'] as $path) {
        if (!is_dir($tmp . $path)) mkdir($tmp . $path, 0777, true);
    }
    putenv("APP_CONFIG_CACHE={$tmp}/bootstrap/cache/config.php");
    putenv("APP_PACKAGES_CACHE={$tmp}/bootstrap/cache/packages.php");
}

// 3. Bootstrap
$app = require_once __DIR__.'/../bootstrap/app.php';

// 4. Emergency Fix: Jika 'view' masih hilang, kita paksa register di sini
$app->booting(function() use ($app) {
    if (!$app->bound('view')) {
        $app->register(Illuminate\View\ViewServiceProvider::class);
    }
});

if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $app->useStoragePath('/tmp/laravel/storage');
}

// 5. Run
$app->handleRequest(Request::capture());
