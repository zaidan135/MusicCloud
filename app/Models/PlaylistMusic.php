<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaylistMusic extends Model
{
    use HasFactory;

    protected $table = 'playlist_music';
    protected $fillable = ['id_playlist', 'id_music_post', 'added_at'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class, 'id_playlist');
    }

    public function musicPost()
    {
        return $this->belongsTo(MusicPost::class, 'id_music_post');
    }
}
