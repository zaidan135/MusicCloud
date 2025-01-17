<x-app-layout>
    <div class="p-6 bg-primary text-white">
        <h1 class="text-2xl font-bold mb-4">Tambah ke Playlist</h1>
        <p class="text-gray-400 mb-6">Pilih playlist untuk menambahkan lagu.</p>
        
        <form method="POST" action="{{ route('playlist.store') }}">
            @csrf
            <input type="hidden" name="music_id" value="{{ $music->id }}">
            
            <div class="space-y-4">
                @foreach($playlists as $playlist)
                    <label class="block">
                        <input type="radio" name="playlist_id" value="{{ $playlist->id }}" required>
                        <span class="text-white">{{ $playlist->name }}</span>
                    </label>
                @endforeach
            </div>
            
            <button type="submit" class="mt-6 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
                Tambahkan ke Playlist
            </button>
        </form>
    </div>
</x-app-layout>
