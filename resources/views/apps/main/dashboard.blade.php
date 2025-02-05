<x-app-layout>
    <div class="p-6 text-white bg-gradient-to-br from-seventh via-black to-primary min-h-screen">
        <!-- Bagian Header -->
        @include('apps.main.partial.carousel')
    
        <!-- Daftar Lagu Populer -->
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Popular Music (MusicCloud)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($musicPosts as $music)
                <div class="bg-gradient-to-tr from-primary to-fourth p-5 rounded-lg shadow-lg transform hover:-translate-y-1 hover:scale-105 transition duration-300">
                    <a href="{{ route('music.show', $music->id) }}" class="flex items-start gap-4">
                        <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-20 h-20 rounded-lg shadow-md">
                        <div>
                            <p class="font-bold text-lg">{{ $music->Details->title }}</p>
                            <p class="text-gray-400 text-sm">Singer: {{ $music->Details->singer }}</p>
                            <p class="text-gray-400 text-sm">Genre: {{ $music->Details->genre }}</p>
                        </div>
                    </a>
                    <div class="mt-4 flex justify-between items-center">
                        <p class="text-gray-400 text-sm">
                            Rilis: {{ \Carbon\Carbon::parse($music->Details->release_date)->format('d M Y') }}
                        </p>
                        <button 
                            class="text-third hover:text-secondary play-btn" 
                            data-music-id="{{ $music->id }}" 
                            data-music-url="{{ asset('storage/' . $music->music_url) }}" 
                            data-image="{{ asset('storage/' . $music->image) }}" 
                            data-title="{{ $music->Details->title }}"
                            data-writer="{{ $music->Details->writer }}"  
                            data-singer="{{ $music->Details->singer }}" 
                            data-composer="{{ $music->Details->composer }}" 
                            data-genre="{{ $music->Details->genre }}" 
                            data-description="{{ $music->Details->description }}" 
                            data-duration="{{ $music->Details->duration }}"
                            data-release_date="{{ $music->Details->release_date }}">
                            <i class="fas fa-play text-2xl"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Daftar Lagu Populer dari Spotify -->
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Popular Music (Spotify)</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($spotifyTracks as $track)
                <div class="bg-gradient-to-tr from-primary to-fourth p-5 rounded-lg shadow-lg transform hover:-translate-y-1 hover:scale-105 transition duration-300">
                    <a href="{{ $track['spotify_url'] }}" target="_blank" class="flex items-start gap-4">
                        <img src="{{ $track['image'] }}" alt="Album Cover" class="w-20 h-20 rounded-lg shadow-md">
                        <div>
                            <p class="font-bold text-lg">{{ $track['name'] }}</p>
                            <p class="text-gray-400 text-sm">Artist: {{ $track['artist'] }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bagian Genre dari Database -->
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Genre (MusicCloud)</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @php
                    $genres = $musicPosts->pluck('details.genre')->unique();
                @endphp
                @foreach ($genres as $genre)
                    <a href="{{ route('genre.index', ['genre' => $genre]) }}" 
                       class="bg-gradient-to-r from-primary to-fourth text-white text-xl py-2 px-5 rounded-lg hover:bg-gray-600 transition duration-300 shadow-xl text-center">
                        {{ ucfirst($genre) }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Bagian Genre dari Spotify -->
        <section class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Genre (Spotify)</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($spotifyGenres as $genre)
                    <a href="{{ route('spotifygenre', ['genre' => $genre]) }}" 
                       class="bg-gradient-to-r from-primary to-fourth text-white text-xl py-2 px-5 rounded-lg hover:bg-gray-600 transition duration-300 shadow-xl text-center">
                        {{ ucfirst($genre) }}
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
