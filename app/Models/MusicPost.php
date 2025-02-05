<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MusicPost extends Model
{
    use HasFactory;

    protected $table = 'music_post';
    protected $fillable = ['id_users', 'music_details', 'music_url', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function details()
    {
        return $this->belongsTo(MusicDetails::class, 'music_details');
    }

    public function liked()
    {
        return $this->hasMany(Liked::class, 'id_music_post');
    }

    public function played()
    {
        return $this->hasMany(Played::class, 'id_music_post');
    }

    public function analytics()
    {
        return $this->hasOne(Analytics::class, 'id_music_post');
    }

    public function comments()
    {
    return $this->hasMany(Comments::class, 'id_music_post');
    }

    public function likeCount()
    {
    return $this->liked()->count();
    }

}
