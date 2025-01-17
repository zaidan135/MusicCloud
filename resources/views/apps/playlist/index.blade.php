<x-app-layout>
    <div class="p-6 bg-primary text-white">
        <h1 class="text-2xl font-bold mb-4">Daftar Playlist</h1>
        
        @if($playlists->isEmpty())
            <p class="text-gray-400">Anda belum memiliki playlist. <a href="{{ route('playlist.create') }}" class="text-blue-500 underline">Buat playlist sekarang.</a></p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($playlists as $playlist)
                    <div class="bg-gray-800 rounded-lg p-4">
                        <div class="mb-4">
                            <img src="{{ $playlist->image ? asset('storage/' . $playlist->image) : 'https://via.placeholder.com/150' }}" alt="{{ $playlist->name }}" class="w-full rounded-lg">
                        </div>
                        <h2 class="text-xl font-semibold">{{ $playlist->name }}</h2>
                        <p class="text-gray-400 text-sm">{{ $playlist->description }}</p>
                        <p class="mt-2 text-gray-300 text-sm">Total Lagu: {{ $playlist->music_posts_count }}</p>
                        <a href="{{ route('playlist.show', $playlist->id) }}" class="block mt-4 bg-blue-500 text-white text-center py-2 px-4 rounded-lg hover:bg-blue-600">
                            Lihat Detail
                        </a>
                        
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
