<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MusicDetails extends Model
{
    use HasFactory;

    protected $table = 'music_details';
    protected $fillable = ['title', 'writer', 'singer', 'composer', 'genre', 'description', 'duration', 'release_date'];
}
