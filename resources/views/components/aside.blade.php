<aside class="bg-seventh text-white h-full overflow-y-auto scrollbar-thin w-full">
    <!-- Bagian Header -->
    <div class="my-5">
        <div class="grid grid-rows-3 font-bold">
            <a href="{{ route('dashboard') }}" class="w-full h-full hover:bg-secondary grid items-center py-3 px-4">
                <div class="flex items-center gap-3 text-xl text-neutral-100"><i class="fa-solid fa-house"></i><h1>Home</h1></div>
            </a>
            <a href="{{ route('music.create') }}" class="w-full h-full hover:bg-secondary grid items-center py-3 px-4">
                <div class="flex items-center gap-3 text-xl text-neutral-400"><i class="fa-solid fa-plus"></i><h1>Upload Music</h1></div>
            </a>
            <a href="{{ route('playlist.create') }}" class="w-full h-full hover:bg-secondary grid items-center py-3 px-4">
                <div class="flex items-center gap-3 text-xl text-neutral-400"><i class="fa-solid fa-plus"></i><h1>Create Playlist</h1></div>
            </a>
        </div>
    </div>

    
    
    <div class="m-4">
        <div class="bg-neutral-600 w-full h-1 mb-5"></div>
        <h2 class="flex items-center gap-3 text-xl text-neutral-500 mb-5 cursor-default"><i class="fa-solid fa-chart-bar"></i>Your Library</h2>
        <div class="w-full h-full flex items-center my-5">
            <button id="searchBut" class="flex items-center gap-2 text-lg text-neutral-400 h-10 w-full"><i class="fa-solid fa-magnifying-glass"></i><h1></h1>Search</button>
            <input type="text" name="searchLib" id="searchLib" class="h-10 bg-transparent border-t-0 border-l-0 border-r-0 border-b-2 border-b-primary outline-none focus:border-primary focus:ring-transparent text-gray-400 w-full hidden">
        </div>


<!-- Bagian Playlist -->
        <div id="btnDropPlaylist" class="w-full cursor-pointer hover:opacity-75">
            <div class="text-md font-semibold mb-3 text-neutral-500 flex items-center justify-center w-full gap-3">
                <div>Playlist</div>
                <div class="flex-1 h-[1px] bg-neutral-500"></div>
                <i id="navPlaylist" class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="mb-6 hidden overflow-hidden transition-all duration-300 ease-in-out" id="playlistElement">
            <ul id="playlist-list" class="space-y-2">
                @forelse($playlists as $playlist)
                    <li>
                        <a href="{{ route('playlist.show', $playlist->id) }}" class="flex items-center space-x-3 rounded-md mb-3 bg-transparent hover:bg-secondary p-2" id="responsiveDiv">
                            <div class="min-h-14 max-h-14 min-w-14 max-w-14 overflow-hidden rounded-lg">
                                @if($playlist->image)
                                    <img class="w-full" src="{{ asset('storage/' . $playlist->image) }}" alt="Playlist Image">
                                @else
                                    @php
                                        $musicImages = $playlist->musicPosts->take(4)->pluck('image')->filter();
                                    @endphp
                                    @if($musicImages->count() > 0)
                                        <div class="grid grid-cols-2 grid-rows-2 w-full rounded-lg">
                                            @foreach($musicImages as $image)
                                                <img src="{{ asset('storage/' . $image) }}" alt="Music Image" class="object-cover w-full h-full">
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="bg-gray-500 text-white flex items-center justify-center min-w-14 min-h-14">
                                            {{ strtoupper(substr($playlist->name, 0, 2)) }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                            <div class="w-full">
                                <div class="text-neutral-100 font-semibold">
                                    {{ $playlist->name }}
                                </div>
                                <div class="text-sm text-neutral-600 flex">
                                    <div><i class="fa-solid fa-pen"></i> {{ $playlist->user->name }}</p></div>
                                </div>
                            </div>
                            <div id="resDiv" class="w-full hidden grid-cols-2">
                                <p class="text-sm text-gray-400 hidden" data-element="musicCount">
                                    {{ $playlist->music_count }}
                                    <span>
                                        Music
                                    </span>
                                </p>
                                <p class="hidden" data-element="createdAt">
                                    {{ $playlist->created_at }}
                                </p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="text-gray-400">Tidak ada playlist ditemukan.</li>
                @endforelse
            </ul>
            <a href="{{ route('playlist.index') }}" class="flex items-center justify-center w-full gap-3 hover:opacity-75">
                <div class="flex-1 h-[1px] bg-neutral-500"></div>
                <strong class="text-neutral-500">All Playlists</strong>
                <div class="flex-1 h-[1px] bg-neutral-500"></div>
            </a>
        </div>
        
    
        <!-- Musik yang Disukai -->
        <div id="btnDropLiked" class="w-full cursor-pointer hover:opacity-75">
            <div class="text-md font-semibold mb-3 text-neutral-500 flex items-center justify-center w-full gap-3">
                <div>Liked</div>
                <div class="flex-1 h-[1px] bg-neutral-500"></div>
                <i id="navLiked" class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
        <div class="mb-6 hidden overflow-hidden transition-all duration-300 ease-in-out" id="likedElement">
            <ul class="space-y-2">
                @forelse($likedMusic as $liked)
                    <li>
                        <a href="{{ route('music.show', $liked->musicPost->id) }}" class="flex">
                            <img src="{{ asset('storage/' . $liked->musicPost->image) }}" alt="Album Cover" class="w-12 h-12 rounded-md mr-3">
                            <div>
                                <p class="font-semibold">{{ $liked->musicPost->Details->title }}</p>
                                <p class="text-gray-400 text-sm">{{ $liked->musicPost->Details->singer }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <li class="text-gray-400">Tidak ada musik yang disukai.</li>
                @endforelse
            </ul>
        </div>
    </div>
</aside>
