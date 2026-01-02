<?php

use App\Http\Controllers\StreamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan; // Tambahan wajib biar bisa panggil Artisan

Route::get('/', [StreamController::class, 'index']);
Route::post('/check', [StreamController::class, 'check']);

// Route Sakti untuk Streaming
// GTA akan akses: https://jgstream.vercel.app/stream/dQw4w9WgXcQ.mp3
Route::get('/stream/{videoId}', [StreamController::class, 'streamYoutube']);

// --- TAMBAHAN KHUSUS VERCEL ---
// Route Rahasia untuk setup Database (Pengganti Terminal)
// Nanti akses link ini SEKALI saja setelah deploy: 
// https://nama-web.vercel.app/init-db-zacky
Route::get('/init-db-zacky', function () {
    try {
        // Menjalankan migrasi database secara paksa (force)
        Artisan::call('migrate --force');
        
        // Membersihkan cache config (opsional tapi bagus)
        Artisan::call('config:clear');
        
        return '
            <div style="font-family: sans-serif; text-align: center; padding: 50px;">
                <h1 style="color: green;">✅ Database Berhasil Dibuat (Migrated)!</h1>
                <p>Tabel database sudah siap. Sekarang website bisa digunakan.</p>
                <a href="/">Kembali ke Home</a>
            </div>
        ';
    } catch (\Exception $e) {
        return '
            <div style="font-family: sans-serif; text-align: center; padding: 50px;">
                <h1 style="color: red;">❌ Error Terjadi</h1>
                <p>' . $e->getMessage() . '</p>
                <p>Pastikan Environment Variables (Database Credentials) di Vercel sudah benar.</p>
            </div>
        ';
    }
});
