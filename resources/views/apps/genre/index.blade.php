<x-app-layout>
    <div class="text-white">
        <div class="relative bg-gradient-to-r from-primary via-purple-700 to-fourth text-white text-center py-10 shadow-lg">
            <h1 class="text-4xl font-extrabold uppercase tracking-widest drop-shadow-lg">
                <i class="fas fa-music mr-2"></i>{{ ucfirst($genre) }}
            </h1>
            <p class="mt-2 text-gray-200 text-lg font-light">Explore the best songs in the {{ ucfirst($genre) }} genre</p>
        </div>        

        @if($musicPosts->isEmpty())
            <p class="text-gray-400">No music found in this genre.</p>
        @else
            <div class="overflow-x-auto bg-primary p-4 rounded-b-lg shadow-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-600 text-gray-300">
                            <th class="p-3">Cover</th>
                            <th class="p-3">Title</th>
                            <th class="p-3">Singer</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($musicPosts as $music)
                            <tr class="border-b border-gray-700 hover:bg-secondary transition duration-300">
                                <td class="p-3">
                                    <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-12 h-12 rounded-md">
                                </td>
                                <td class="p-3">{{ $music->details->title }}</td>
                                <td class="p-3 text-gray-400">{{ $music->details->singer }}</td>
                                <td class="p-3">
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
