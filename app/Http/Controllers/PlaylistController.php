<?php

namespace App\Http\Controllers;

use App\Models\Liked;
use App\Models\Playlist;
use App\Models\MusicPost;
use Illuminate\Http\Request;
use App\Models\PlaylistMusic;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{

    public function index()
    {
        $userId = Auth::id(); // Ambil ID pengguna yang login
        $playlists = Playlist::where('id_users', $userId)->withCount('musicPosts')->get();
        
        return view('apps.playlist.index', compact('playlists'));
    }
    
    public function show($id)
    {
        $playlist = Playlist::with(['musicPosts.details'])->findOrFail($id);
    
        return view('apps.playlist.detail', compact('playlist'));
    }
    
    
    public function add($id)
    {
        $music = MusicPost::findOrFail($id);
        $userId = Auth::id(); // Ambil ID pengguna yang login
        $playlists = Playlist::where('id_users', $userId)->get();
    
        if ($playlists->isEmpty()) {
            return redirect()->route('playlist.create')->with('info', 'Make a playlist first.');
        }
    
        return view('apps.playlist.add', compact('music', 'playlists'));
    }
    
    
    public function create()
    {
        return view('apps.playlist.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('imgPlaylist', 'public') : null;
        $imageUrl = $imagePath ? str_replace('public/', 'storage/', $imagePath) : null;
    
        Playlist::create([
            'id_users' => Auth::id(), // Masukkan ID pengguna yang login
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageUrl,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Playlist created successfully!');
    }
    
    public function addMusic(Request $request)
    {
        $request->validate([
            'id_playlist' => 'required|exists:playlist,id',
            'id_music_post' => 'required|exists:music_post,id',
        ]);
    
        // Cek apakah musik sudah ada di playlist
        $exists = PlaylistMusic::where('id_playlist', $request->id_playlist)
            ->where('id_music_post', $request->id_music_post)
            ->exists();
    
        if ($exists) {
            return redirect()->back()->with('info', 'The music is already in the playlist.');
        }
    
        // Tambahkan musik ke playlist
        PlaylistMusic::create([
            'id_playlist' => $request->id_playlist,
            'id_music_post' => $request->id_music_post,
        ]);
    
        return redirect()->back()->with('success', 'Music successfully added to playlist.');
    }
    
    public function library()
    {
        $userId = Auth::id();
    
        // Daftar Playlist
        $playlists = Playlist::where('id_users', $userId)->get();
    
        // Musik yang Disukai
        $likedMusics = Liked::with('musicPost.details')
            ->where('id_users', $userId)
            ->get();
    
        return view('apps.library', compact('playlists', 'likedMusics'));
    }
    

}
