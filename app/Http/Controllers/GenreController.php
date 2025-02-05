<?php

namespace App\Http\Controllers;

use App\Models\MusicPost;

class GenreController extends Controller
{
    public function index($genre)
    {
        // Ambil data musik berdasarkan genre
        $musicPosts = MusicPost::whereHas('details', function ($query) use ($genre) {
            $query->where('genre', $genre);
        })->get();

        // Kirim data ke view
        return view('apps.genre.index', compact('musicPosts', 'genre'));
    }
}
