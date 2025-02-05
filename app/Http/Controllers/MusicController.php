<?php

namespace App\Http\Controllers;

use getID3;
use App\Models\Liked;
use GuzzleHttp\Client;
use App\Models\Comments;
use App\Models\Playlist;
use App\Models\MusicPost;
use App\Models\MusicDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{

    private $client;
    private $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->token = $this->getAccessToken();
    }

    private function getAccessToken()
    {
        $response = $this->client->post('https://accounts.spotify.com/api/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => env('SPOTIFY_CLIENT_ID'),
                'client_secret' => env('SPOTIFY_CLIENT_SECRET'),
            ],
        ]);

        return json_decode($response->getBody(), true)['access_token'];
    }

    public function index()
    {
        // Ambil semua lagu dari database dengan informasi detailnya
        $musicPosts = MusicPost::with('Details')->get();

        $selectedMusicPost = $musicPosts->first();

        // Ambil genre dari Spotify
        $spotifyGenres = $this->getSpotifyGenres();
        // Ambil musik populer dari Spotify
        $spotifyTracks = $this->getSpotifyTopTracks();

        // Kirim data ke view
        return view('apps.main.dashboard', compact('musicPosts', 'selectedMusicPost', 'spotifyGenres', 'spotifyTracks'));
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
    
        return redirect()->back()->with('success', 'Music uploaded successfully!');
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

          return redirect()->back()->with('info', 'Like deleted.');
        }
    
        // Tambahkan like baru
        Liked::create([
            'id_users' => $userId,
            'id_music_post' => $id,
        ]);
    
        return redirect()->back()->with('success', 'The music has been liked!');
    }

    public function addComment(Request $request, MusicPost $music)
    {
        // Validasi input
        $request->validate([
            'commentar' => 'required|string|max:500',  // Pastikan kolom komentar diisi dan tidak melebihi 500 karakter
        ]);
    
        // Membuat instance baru dari model Comment
        $comment = new Comments();
    
        // Menyimpan data yang diterima ke dalam kolom terkait
        $comment->id_users = auth::id();  // Ambil ID pengguna yang sedang login
        $comment->id_music_post = $music->id;  // Ambil ID musik yang diberikan
        $comment->commentar = $request->commentar;  // Ambil komentar yang dimasukkan
    
        // Simpan komentar ke database
        $comment->save();  // Pastikan Anda memanggil method save untuk menyimpan data ke dalam database
    
        // Mengembalikan halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function deleteComment(MusicPost $music, Comments $comment)
    {
        // Cek apakah pengguna yang login adalah pemilik komentar
        if ($comment->id_users !== auth::id()) {
            return redirect()->back()->with('error', "You cannot delete other people's comments.");
        }
    
        // Menghapus komentar
        $comment->delete();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('music.show', $music->id)->with('success', 'Comment successfully deleted!');
    }


    private function getSpotifyGenres()
    {
        try {
            $response = $this->client->get("https://api.spotify.com/v1/browse/categories", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                    'Accept' => 'application/json',
                ],
                'query' => ['country' => 'US', 'limit' => 20], // Filter untuk hasil lebih akurat
            ]);
    
            $categories = json_decode($response->getBody(), true)['categories']['items'] ?? [];
            return array_map(fn($category) => $category['name'], $categories); // Ambil hanya nama genre
    
        } catch (\Exception $e) {
            \Log::error("Spotify API Error: " . $e->getMessage());
            return [];
        }
    }
    
    

    private function getSpotifyTopTracks()
    {
        $response = $this->client->get("https://api.spotify.com/v1/browse/new-releases", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->token,
            ],
            'query' => [
                'country' => 'US',
                'limit' => 10,
            ],
        ]);

        $albums = json_decode($response->getBody(), true)['albums']['items'];

        $tracks = [];
        foreach ($albums as $album) {
            $tracks[] = [
                'name' => $album['name'],
                'artist' => $album['artists'][0]['name'],
                'image' => $album['images'][0]['url'] ?? null,
                'spotify_url' => $album['external_urls']['spotify'],
            ];
        }

        return $tracks;
    }
    
}
