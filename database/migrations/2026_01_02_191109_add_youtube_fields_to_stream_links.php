<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('stream_links', function (Blueprint $table) {
            $table->string('youtube_id')->nullable()->after('url'); // Simpan ID video (misal: dQw4w9WgXcQ)
            $table->boolean('is_youtube')->default(false)->after('content_type'); // Penanda
        });
    }

    public function down()
    {
        Schema::table('stream_links', function (Blueprint $table) {
            $table->dropColumn(['youtube_id', 'is_youtube']);
        });
    }
};
