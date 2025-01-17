<x-app-layout>
    <div class="p-6 bg-primary text-white">
        <!-- Bagian Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Temukan Musik Favoritmu</h1>
            <p class="text-gray-400">Jelajahi koleksi lagu berdasarkan kategori.</p>
        </div>
    
        <!-- Bagian Kategori -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-3">Kategori</h2>
            <div class="flex gap-4 overflow-x-auto scrollbar-thin">
                @php
                    $genres = $musicPosts->pluck('details.genre')->unique();
                @endphp
                @foreach ($genres as $genre)
                    <button class="bg-gray-700 text-white py-2 px-4 rounded-lg hover:bg-gray-600">
                        {{ $genre }}
                    </button>
                @endforeach
            </div>
        </div>
    
        <!-- Daftar Lagu Populer -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-3">Lagu Populer</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($musicPosts as $music)
                <div class="bg-gray-800 p-4 rounded-lg flex items-center">
                    <a href="{{ route('music.show', $music->id) }}" class="flex items-center">
                        <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-12 h-12 rounded-md mr-3">
                        <div>
                            <p class="font-semibold">{{ $music->Details->title }}</p>
                            <p class="text-gray-400 text-sm">{{ $music->Details->singer }}</p>
                        </div>
                    </a>
                    <button 
                        class="ml-auto text-white hover:text-green-500 play-btn" 
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
                        data-release_date="{{ $music->Details->release_date }}" >
                        <i class="fas fa-play"></i>
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </x-app-layout>
    