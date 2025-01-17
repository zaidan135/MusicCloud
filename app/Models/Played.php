<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Played extends Model
{
    use HasFactory;

    protected $table = 'played';
    protected $fillable = ['id_users', 'id_music_post', 'played_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function musicPost()
    {
        return $this->belongsTo(MusicPost::class, 'id_music_post');
    }
}
