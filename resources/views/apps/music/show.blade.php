<x-apps-layout>
    <div class="p-6 bg-primary text-white">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold">{{ $music->details->title }}</h1>
            <p class="text-gray-400">By {{ $music->details->singer }}</p>
        </div>

        <!-- Detail Musik -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Gambar Album -->
            <div>
                <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="size-96 rounded-lg">
            </div>
            <!-- Informasi Lagu -->
            <div>
                <ul class="text-lg space-y-2">
                    <li><strong>Writer:</strong> {{ $music->details->writer }}</li>
                    <li><strong>Composer:</strong> {{ $music->details->composer }}</li>
                    <li><strong>Genre:</strong> {{ $music->details->genre }}</li>
                    <li><strong>Duration:</strong> {{ $music->details->duration }}</li>
                    <li><strong>Release Date:</strong> {{ $music->details->release_date }}</li>
                </ul>
                <p class="mt-4 text-gray-400">{{ $music->details->description }}</p>
            </div>
        </div>

        <!-- Statistik -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-3">Statistik</h2>
            <ul class="space-y-2">
                <li><strong>Liked:</strong> {{ $music->liked->count() }}</li>
                <li><strong>Played:</strong> {{ $music->played->count() }}</li>
            </ul>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-3">Aksi</h2>
            <div class="flex items-center space-x-4">
                <!-- Tombol Like -->
                <form method="POST" action="{{ route('music.like', $music->id) }}">
                    @csrf
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                        <i class="fas fa-heart"></i>
                        {{ $music->liked->where('id_users', auth()->id())->isEmpty() ? 'Like' : 'Unlike' }}
                    </button>
                </form>
                <!-- Jumlah Like -->
                <span class="text-gray-400">{{ $music->liked->count() }} Likes</span>
            </div>
        </div>
    </div>

    <!-- Tombol Tambah ke Playlist -->
<div class="mt-6">
    <h2 class="text-xl font-semibold mb-3">Aksi</h2>
    <div class="flex items-center space-x-4">
        <!-- Tombol Like -->
        <form method="POST" action="{{ route('music.like', $music->id) }}">
            @csrf
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">
                <i class="fas fa-heart"></i>
                {{ $music->liked->where('id_users', auth()->id())->isEmpty() ? 'Like' : 'Unlike' }}
            </button>
        </form>
        <!-- Jumlah Like -->
        <span class="text-gray-400">{{ $music->liked->count() }} Likes</span>

        <!-- Tombol Tambah ke Playlist -->
        <button id="add-to-playlist-btn" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-lg">
            <i class="fas fa-plus"></i> Tambah ke Playlist
        </button>
    </div>
</div>

<!-- Popover Playlist -->
<div id="playlist-popover" class="hidden bg-gray-800 text-white rounded-lg shadow-lg p-4 absolute z-10">
    <h3 class="text-lg font-semibold mb-3">Pilih Playlist</h3>
    <ul class="space-y-2">
        @forelse ($playlists as $playlist)
            <li>
                <form method="POST" action="{{ route('playlist.addMusic') }}">
                    @csrf
                    <input type="hidden" name="id_playlist" value="{{ $playlist->id }}">
                    <input type="hidden" name="id_music_post" value="{{ $music->id }}">
                    <button type="submit" class="w-full text-left bg-gray-700 hover:bg-gray-600 py-2 px-4 rounded-lg">
                        {{ $playlist->name }}
                    </button>
                </form>
            </li>
        @empty
            <p class="text-gray-400">Anda belum memiliki playlist. <a href="{{ route('playlist.create') }}" class="text-blue-400 underline">Buat sekarang</a>.</p>
        @endforelse
    </ul>
</div>

</x-apps-layout>
