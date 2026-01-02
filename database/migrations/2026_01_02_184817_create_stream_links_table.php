<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stream_links', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique(); // Unique biar database gak penuh sampah duplikat
            $table->string('title')->default('Unknown Track'); // Judul lagu
            $table->string('content_type'); // Tipe file (mp3/ogg)
            $table->string('uploader_ip')->nullable(); // Security log
            $table->timestamps(); // Created_at (biar bisa sort 'Terbaru')
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stream_links');
    }
};
