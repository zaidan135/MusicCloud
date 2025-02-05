<x-app-layout>
    <div class="p-6 text-white">
        <!-- Header -->
        <div class="mb-6 relative flex justify-center">
            <!-- Gambar Playlist -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 z-10">
                <div class="relative group w-60 h-60 overflow-hidden rounded-lg shadow-2xl">
                    @if($playlist->image)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $playlist->image) }}" alt="Playlist Image">
                    @else
                        @php
                            $musicImages = $playlist->musicPosts->take(4)->pluck('image')->filter();
                        @endphp
                        @if($musicImages->count() >= 4)
                            <div class="grid grid-cols-2 grid-rows-2 w-full h-full">
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
            </div>
        
            <!-- Nama Playlist dan Deskripsi -->
            <div class="text-center w-full bg-gradient-to-br from-black via-primary to-fourth mt-32 h-full pt-36 rounded-lg pb-6">
                <h1 class="text-4xl font-bold mt-4">{{ $playlist->name }}</h1>
                <p class="text-gray-400 text-lg">{{ $playlist->description }}</p>
            </div>
        </div>

        @if($playlist->musicPosts->isEmpty())
        <p class="text-gray-400">There are no songs in this playlist.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-white rounded-lg overflow-hidden">
                    <thead class="bg-fourth">
                        <tr>
                            <th class="p-4 text-left">Cover</th>
                            <th class="p-4 text-left">Title</th>
                            <th class="p-4 text-left">Singer</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($playlist->musicPosts as $music)
                            <tr class="border-b border-gray-700 hover:bg-primary">
                                <td class="p-4">
                                    <a href="{{ route('music.show', $music->id) }}" class="flex">
                                    <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-12 h-12 rounded-md">
                                </td>
                                <td class="p-4"><a href="{{ route('music.show', $music->id) }}" class="flex">{{ $music->details->title }}</td>
                                <td class="p-4"><a href="{{ route('music.show', $music->id) }}" class="flex">{{ $music->details->singer }}</td>
                                <td class="p-4 text-center">
                                    <button 
                                        class="text-white hover:text-green-500 play-btn" 
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
                                        data-release_date="{{ $music->details->release_date }}">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
