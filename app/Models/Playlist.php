<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Playlist extends Model
{
    use HasFactory;

    protected $table = 'playlist';
    protected $fillable = ['id_users', 'name', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function musicPosts()
    {
        return $this->belongsToMany(MusicPost::class, 'playlist_music', 'id_playlist', 'id_music_post')
                    ->withTimestamps();
    }
}
