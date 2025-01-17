<aside class="p-4 bg-primary text-white h-full overflow-y-auto scrollbar-thin w-64">
    <!-- Bagian Header -->
    <h2 class="text-lg font-bold mb-4">Library Kamu</h2>

    <!-- Tools -->
    <div class="mb-6">
        <input type="text" id="search-playlist" placeholder="Cari Playlist..." class="w-full bg-gray-800 rounded-md p-2 text-white" />
    </div>

    <!-- Bagian Playlist -->
    <div class="mb-6">
        <h3 class="text-md font-semibold mb-3">Playlist</h3>
        <ul id="playlist-list" class="space-y-2">
            @forelse($playlists as $playlist)
                <li>
                    <a href="{{ route('playlist.show', $playlist->id) }}" class="flex items-center space-x-3 p-2 rounded-md bg-gray-800 hover:bg-gray-700">
                        <i class="fas fa-music"></i>
                        <span>{{ $playlist->name }}</span>
                    </a>
                </li>
            @empty
                <li class="text-gray-400">Tidak ada playlist ditemukan.</li>
            @endforelse
        </ul>
        <a href="{{ route('playlist.index') }}" class="block mt-4 bg-blue-500 hover:bg-blue-600 text-center py-2 px-4 rounded-md">Lihat Semua Playlist</a>
    </div>

    <!-- Musik yang Disukai -->
    <div class="mb-6">
        <h3 class="text-md font-semibold mb-3">Musik yang Disukai</h3>
        <ul class="space-y-2">
            @forelse($likedMusic as $liked)
                <li>
                    <a href="{{ route('music.show', $liked->musicPost->id) }}" class="flex items-center space-x-3 p-2 rounded-md bg-gray-800 hover:bg-gray-700">
                        <i class="fas fa-heart text-red-500"></i>
                        <span>{{ $liked->musicPost->details->title }}</span>
                    </a>
                </li>
            @empty
                <li class="text-gray-400">Tidak ada musik yang disukai.</li>
            @endforelse
        </ul>
    </div>
</aside>
