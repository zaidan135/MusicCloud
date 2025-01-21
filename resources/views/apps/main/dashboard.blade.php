<x-app-layout>
    <div class="p-6 text-white bg-gradient-to-br from-seventh via-black to-primary min-h-screen">
        <!-- Bagian Header -->
        <div class="mb-6 text-center">
            <h1 class="text-4xl font-bold mb-2">Temukan Musik Favoritmu</h1>
            <p class="text-gray-400 text-lg">Jelajahi koleksi lagu terbaik berdasarkan kategori, penyanyi, atau lagu populer.</p>
        </div>
    
        <!-- Bagian Kategori -->
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Kategori</h2>
            <div class="flex gap-4 overflow-x-auto scrollbar-thin">
                @php
                    $genres = $musicPosts->pluck('details.genre')->unique();
                @endphp
                @foreach ($genres as $genre)
                    <button class="bg-black text-white py-2 px-5 rounded-lg hover:from-gray-600 hover:to-gray-500 transition duration-300 shadow-xl">
                        {{ $genre }}
                    </button>
                @endforeach
            </div>
        </div>
    
        <!-- Daftar Lagu Populer -->
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-5">Lagu Populer</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($musicPosts as $music)
                <div class="bg-gradient-to-tr from-primary to-fourth p-5 rounded-lg shadow-lg transform hover:-translate-y-1 hover:scale-105 transition duration-300">
                    <a href="{{ route('music.show', $music->id) }}" class="flex items-start gap-4">
                        <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-20 h-20 rounded-lg shadow-md">
                        <div>
                            <p class="font-bold text-lg">{{ $music->Details->title }}</p>
                            <p class="text-gray-400 text-sm">Penyanyi: {{ $music->Details->singer }}</p>
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
    </div>
</x-app-layout>
