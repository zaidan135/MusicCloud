<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Liked extends Model
{
    use HasFactory;

    protected $table = 'liked';
    protected $fillable = ['id_users', 'id_music_post', 'liked_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function musicPost()
    {
        return $this->belongsTo(MusicPost::class, 'id_music_post');
    }
}
