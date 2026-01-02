<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'title',
        'content_type',
        'uploader_ip',
        'youtube_id', // Kolom baru untuk ID Video
        'is_youtube'  // Kolom baru untuk penanda tipe link
    ];
}
