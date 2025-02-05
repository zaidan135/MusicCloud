<x-app-layout>
    <!-- Popover Playlist -->
    <div id="playlist-popover" class="absolute hidden justify-center items-center h-full w-full left-0 top-0 z-50 backdrop-blur-sm">
        <div class="bg-gradient-to-br from-primary via-black to-fourth text-white rounded-lg p-4 w-fit h-fit shadow-xl">
            <h3 class="text-lg font-semibold mb-3">Select Playlists</h3>
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
                    <p class="text-gray-400">You don't have a playlist yet. <a href="{{ route('playlist.create') }}" class="text-blue-400 underline">Create Now</a>.</p>
                @endforelse
            </ul>
        </div>
    </div>
    <div class="p-6 bg-gradient-to-br from-primary via-black to-fourth text-white min-h-screen">
        <!-- Header -->
        <div class="mb-6 relative flex justify-center">
            <!-- Gambar Album -->
            <div class="absolute top-0 left-1/2 transform -translate-x-1/2 z-10">
                <div class="relative group">

                    <img src="{{ asset('storage/' . $music->image) }}" alt="Album Cover" class="w-60 h-60 rounded-lg shadow-2xl">
                    
                    <!-- Tombol Play yang muncul saat gambar di-hover -->
                    <button 
                        class="absolute inset-0 flex items-center justify-center w-full h-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-black bg-opacity-50 rounded-lg play-btn"
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
                        <i class="fas fa-play text-3xl text-white"></i>
                    </button>
                </div>
            </div>
            
            <!-- Judul dan Penyanyi -->
            <div class="text-center w-full bg-gradient-to-br from-black via-primary to-fourth mt-32 h-full pt-36 rounded-lg pb-6">
                <h1 class="text-4xl font-bold mt-4">{{ $music->details->title }}</h1>
                <p class="text-gray-400 text-lg">By {{ $music->details->singer }}</p>
                <div class="flex justify-center items-center gap-4 mt-7">
                    <form method="POST" action="{{ route('music.like', $music->id) }}" class="flex items-center">
                        @csrf
                        <button type="submit" class="bg-transparent text-white text-lg">
                            @if($music->liked->where('id_users', auth()->id())->isEmpty())
                                <i class="fa-regular fa-heart mr-1"></i>
                                <span class="text-gray-400">{{ $music->liked->count() }}</span>
                            @else
                                <i class="fa-solid fa-heart text-red-600 mr-1"></i>
                                <span class="text-gray-400">{{ $music->liked->count() }}</span>
                            @endif
                        </button>
                    </form>
                    <div class="text-white text-lg">
                        <i class="fa-solid fa-headphones-simple mr-1"></i>
                        <span class="text-gray-400">{{ $music->played->count() }}</span>
                    </div>
                    <div>
                        <button id="add-to-playlist-btn" class="bg-transparent text-white text-lg">
                            @if($playlists->where('id_users', auth()->id())->contains(function ($playlist) use ($music) {
                                return $playlist->musicPosts->contains('id', $music->id);
                            }))
                                <i class="fa-solid fa-bookmark"></i> <!-- Jika sudah ada di playlist -->
                            @else
                                <i class="fa-regular fa-bookmark"></i> <!-- Jika belum ada di playlist -->
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Detail Musik -->
        <div class="grid grid-cols-1 grid-rows-2 md:grid-cols-2 md:grid-rows-1 gap-6 mb-10">
            <!-- Informasi Lagu -->
            <div class="bg-gradient-to-b from-primary to-black p-6 rounded-lg shadow-lg space-y-4 w-full">
                <ul class="text-lg space-y-3 text-neutral-300">
                    <li><strong>Writer:</strong> {{ $music->details->writer }}</li>
                    <li><strong>Composer:</strong> {{ $music->details->composer }}</li>
                    <li><strong>Genre:</strong> {{ $music->details->genre }}</li>
                    <li><strong>Duration:</strong> {{ $music->details->duration }}</li>
                    <li><strong>Release Date:</strong> {{ $music->details->release_date }}</li>
                </ul>
                <p class="mt-4 text-gray-400">{{ $music->details->description }}</p>
            </div>
            <!-- Komentar Section -->
            <div class="bg-gradient-to-b from-primary to-black p-6 rounded-lg shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-neutral-300">Comment</h2>
                
                <!-- Formulir Komentar -->
                <form method="POST" action="{{ route('music.comment', $music->id) }}" class="space-y-4">
                    @csrf
                    <div class="flex flex-col">
                        <textarea name="commentar" class="bg-transparent border border-gray-700 text-neutral-200 p-3 rounded-lg w-full focus:ring-transparent focus:border-gray-500 scrollbar-thin resize-none" placeholder="Write Comment..." rows="4" required></textarea>
                    </div>
                    <button type="submit" class="bg-primary hover:bg-secondary text-white py-2 px-4 rounded-lg w-full">
                        Send
                    </button>
                </form>
            </div>

            <div class="bg-gradient-to-b from-primary to-black p-6 rounded-lg shadow-lg col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <!-- Menampilkan jumlah komentar -->
                    <h2 class="text-2xl font-semibold text-white">Komentar ({{ $music->comments->count() }})</h2>
                </div>
                <!-- Daftar Komentar -->
                <div class="mt-6 space-y-4 max-h-40 overflow-y-scroll scrollbar-thin overflow-x-hidden">
                    @foreach ($music->comments as $comment)
                    <div class="flex gap-4 items-start hover:bg-gray-700 rounded-lg p-3 transition-all">
                        <div class="flex-shrink-0">
                            @if($comment->user->profile_image)
                                <img src="{{ asset('storage/' . $comment->user->profile_image) }}" alt="User Avatar" class="w-12 h-12 rounded-full">
                            @else
                                <!-- Lingkaran dengan Inisial -->
                                <div class="flex items-center justify-center h-12 w-12 bg-gray-300 text-gray-800 rounded-full ml-3">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <p class="font-semibold text-white">{{ $comment->user->name }}</p>
                            <p class="text-gray-400 text-sm break-words">{{ $comment->commentar }}</p> <!-- Tambahkan break-words -->
                        </div>
            
                        <!-- Tombol Hapus (Hanya tampil untuk pemilik komentar) -->
                        @if(auth()->user()->id === $comment->user->id) <!-- Cek jika pengguna saat ini adalah pemilik komentar -->
                            <form method="POST" action="{{ route('music.comment.delete', ['music' => $music->id, 'comment' => $comment->id]) }}" class="flex items-center h-full justify-center ml-auto">
                                @csrf
                                @method('DELETE') <!-- Menggunakan DELETE Method -->
                                <button type="submit" class="text-red-500 text-sm hover:text-red-600">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        @endif
                    </div>                    
                    @endforeach
                </div>
            </div>
            
            </div>
        </div>
    </div>
</x-app-layout>
