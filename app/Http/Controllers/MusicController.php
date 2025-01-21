<?php

namespace App\Http\Controllers;

use getID3;
use App\Models\Liked;
use App\Models\Playlist;
use App\Models\MusicPost;
use App\Models\MusicDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index()
    {
        // Ambil semua lagu dari database dengan informasi detailnya
        $musicPosts = MusicPost::with('Details')->get();

        $selectedMusicPost = $musicPosts->first();

        // Kirim data ke view
        return view('apps.main.dashboard', compact('musicPosts', 'selectedMusicPost'));
    }

    public function create()
    {
        return view('apps.musicpost.music_post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'nullable|string',
            'singer' => 'nullable|string',
            'composer' => 'nullable|string',
            'genre' => 'nullable|string',
            'description' => 'nullable|string',
            'music_file' => 'required|file|mimes:mp3,wav,ogg',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        // Simpan file musik
        $musicPath = $request->file('music_file')->store('music', 'public');
        $musicUrl = str_replace('public/', 'storage/', $musicPath);

        // Simpan gambar cover ke disk 'public'
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null;
        $imageUrl = $imagePath ? str_replace('public/', 'storage/', $imagePath) : null;

    
        // Ambil durasi file musik menggunakan getID3
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze(storage_path('app/public/' . $musicPath));
        $duration = isset($fileInfo['playtime_string']) ? ($fileInfo['playtime_string']) : '0:00';
    
        // Simpan Music Details
        $musicDetails = MusicDetails::create([
            'title' => $request->title,
            'writer' => $request->writer,
            'singer' => $request->singer,
            'composer' => $request->composer,
            'genre' => $request->genre,
            'description' => $request->description,
            'duration' => $duration, // Durasi terisi otomatis
            'release_date' => now(),
        ]);
    
        // Simpan Music Post
        MusicPost::create([
            'id_users' => Auth::id(),
            'music_details' => $musicDetails->id,
            'music_url' => $musicUrl,
            'image' => $imageUrl,
        ]);
    
        return redirect()->back()->with('success', 'Music berhasil diunggah!');
    }

    public function show($id)
    {
        $music = MusicPost::with('details', 'user', 'liked', 'played', 'analytics')->findOrFail($id);
        $playlists = Playlist::where('id_users', Auth::id())->get();
    
        return view('apps.music.show', compact('music', 'playlists'));
    }
    

    public function like($id)
    {
        $userId = auth::id(); // Ambil ID pengguna yang login
    
        // Periksa apakah sudah di-like sebelumnya
        $liked = Liked::where('id_users', $userId)
                      ->where('id_music_post', $id)
                      ->first();
    
        if ($liked) {
          // Jika sudah di-like, hapus berdasarkan id_users dan id_music_post
          Liked::where('id_users', $userId)
              ->where('id_music_post', $id)
              ->delete();

          return redirect()->back()->with('info', 'Like dihapus.');
        }
    
        // Tambahkan like baru
        Liked::create([
            'id_users' => $userId,
            'id_music_post' => $id,
        ]);
    
        return redirect()->back()->with('success', 'Musik berhasil di-like!');
    }
    
}
