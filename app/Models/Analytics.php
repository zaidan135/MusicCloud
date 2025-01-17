<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Analytics extends Model
{
    use HasFactory;

    protected $table = 'analytics';
    protected $fillable = ['id_music_post', 'plays', 'likes'];

    public function musicPost()
    {
        return $this->belongsTo(MusicPost::class, 'id_music_post');
    }
}
