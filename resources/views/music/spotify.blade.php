<x-app-layout>
    <div class="text-white">
        <div class="relative bg-gradient-to-r from-primary via-purple-700 to-fourth text-white text-center py-10 shadow-lg">
            <h1 class="text-4xl font-extrabold uppercase tracking-widest drop-shadow-lg">
                <i class="fas fa-music mr-2"></i> Genre: {{ ucfirst($genre) }} (Spotify)
            </h1>
            <p class="mt-2 text-gray-200 text-lg font-light">Explore the best songs in the {{ ucfirst($genre) }} genre</p>
        </div>

        @if(empty($tracks))
            <p class="text-gray-400 text-center mt-6">No music found for this genre.</p>
        @else
            <div class="overflow-x-auto bg-primary p-4 rounded-b-lg shadow-lg">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-600 text-gray-300">
                            <th class="py-3 px-6">Cover</th>
                            <th class="py-3 px-6">Title</th>
                            <th class="py-3 px-6">Artist</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tracks as $track)
                            <tr class="border-b border-gray-600">
                                <td class="py-3 px-6">
                                    <img src="{{ $track['album']['images'][0]['url'] }}" alt="Cover" class="w-16 h-16 rounded-md">
                                </td>
                                <td class="py-3 px-6">{{ $track['name'] }}</td>
                                <td class="py-3 px-6">{{ $track['artists'][0]['name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>
