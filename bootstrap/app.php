<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. Kita simpan dulu ke variabel $app, jangan langsung di-return
$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();


// 2. TAMBAHAN PENTING UNTUK VERCEL (Fix Read-Only Error)
/*
|--------------------------------------------------------------------------
| Vercel Fix: Use /tmp for storage
|--------------------------------------------------------------------------
| Karena server Vercel itu Read-Only, kita harus pindahkan folder storage
| ke folder sementara (/tmp) yang boleh ditulisi.
*/
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'production') {
    $storagePath = '/tmp/storage';
    
    // Set path baru
    $app->useStoragePath($storagePath);
    
    // Pastikan folder untuk cache view ada, kalau tidak error lagi
    if (!is_dir($storagePath . '/framework/views')) {
        mkdir($storagePath . '/framework/views', 0777, true);
    }
}

// 3. Kembalikan aplikasi yang sudah dimodifikasi
return $app;
