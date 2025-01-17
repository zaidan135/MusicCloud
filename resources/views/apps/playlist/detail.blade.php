<x-app-layout>
    <div class="p-6 bg-primary text-white">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold">{{ $playlist->name }}</h1>
            <p class="text-gray-400">{{ $playlist->description }}</p>
        </div>

        <!-- Daftar Musik di Playlist -->
        @if($playlist->musicPosts->isEmpty())
            <p class="text-gray-400">Tidak ada lagu dalam playlist ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($playlist->musicPosts as $music)
                    <div class="bg-gray-800 p-4 rounded-lg flex items-center">
                        <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-12 h-12 rounded-md mr-3">
                        <div>
                            <p class="font-semibold">{{ $music->details->title }}</p>
                            <p class="text-gray-400 text-sm">{{ $music->details->singer }}</p>
                        </div>
                        <button 
                            class="ml-auto text-white hover:text-green-500 play-btn" 
                            data-music-id="{{ $music->id }}" 
                            data-music-url="{{ asset('storage/' . $music->music_url) }}" 
                            data-image="{{ asset('storage/' . $music->image) }}" 
                            data-title="{{ $music->details->title }}"
                            data-writer="{{ $music->details->writer }}"  
                            data-singer="{{ $music->details->singer }}" 
                            data-composer="{{ $music->details->composer }}" 
                            data-genre="{{ $music->details->genre }}" 
                            data-description="{{ $music->details->description }}" 
                            data-duration="{{ $music->details->duration }}"
                            data-release_date="{{ $music->details->release_date }}" >
                            <i class="fas fa-play"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
