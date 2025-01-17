<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileUsers extends Model
{
    use HasFactory;

    protected $table = 'profile_users';
    protected $fillable = ['id_users', 'image', 'profession', 'bio', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
