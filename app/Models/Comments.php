<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'id_users',
        'id_music_post',
        'commentar',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    /**
     * Relasi ke model MusicPost.
     */
    public function musicPost()
    {
        return $this->belongsTo(MusicPost::class, 'id_music_post');
    }
}
