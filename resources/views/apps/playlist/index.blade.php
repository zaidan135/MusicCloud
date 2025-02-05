<x-app-layout>
    <div class="p-6 text-white">
        <h1 class="text-2xl font-bold mb-4">Playlist List</h1>

        @if($playlists->isEmpty())
            <p class="text-gray-400">
                You don't have a playlist yet. 
                <a href="{{ route('playlist.create') }}" class="text-blue-500 underline">Create a playlist now.</a>
            </p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($playlists as $playlist)
                    <div class="bg-gradient-to-b from-primary to-zinc-950 rounded-lg p-4 shadow-lg">
                        <!-- Gambar Playlist -->
                        <div class="mb-4 w-full h-60 overflow-hidden rounded-lg">
                            @if($playlist->image)
                                <img class="w-full h-full object-cover" src="{{ asset('storage/' . $playlist->image) }}" alt="{{ $playlist->name }}">
                            @else
                                @php
                                    $musicImages = $playlist->musicPosts->take(4)->pluck('image')->filter();
                                @endphp
                                @if($musicImages->count() >= 4)
                                    <div class="grid grid-cols-2 grid-rows-2 w-full h-full rounded-lg">
                                        @foreach($musicImages as $image)
                                            <img src="{{ asset('storage/' . $image) }}" alt="Music Image" class="object-cover w-full h-full">
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gray-500 text-white flex items-center justify-center w-full h-full text-4xl font-bold">
                                        {{ strtoupper(substr($playlist->name, 0, 2)) }}
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Detail Playlist -->
                        <h2 class="text-xl font-semibold">{{ $playlist->name }}</h2>
                        <p class="text-gray-400 text-sm truncate">{{ $playlist->description }}</p>
                        <p class="mt-2 text-gray-300 text-sm">Total Music: {{ $playlist->music_posts_count }}</p>

                        <!-- Tombol View Details -->
                        <a href="{{ route('playlist.show', $playlist->id) }}" 
                           class="block mt-4 bg-primary text-white text-center py-2 px-4 rounded-lg hover:bg-fourth transition">
                            View Details
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
