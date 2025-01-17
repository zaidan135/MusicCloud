<div class="bg-transparent text-white h-24 hidden items-center" id="footer">
    <!-- Bagian Kiri: Identitas Musik -->
    <div class="flex-shrink-0 flex items-center w-1/5">
        <img id="footer-music-image" src="https://via.placeholder.com/50" alt="Album Cover" class="w-12 h-12 rounded-md mr-3" />
        <div>
            <p id="footer-music-title" class="font-semibold text-sm">Judul Musik</p>
            <p id="footer-music-singer" class="text-gray-400 text-xs">Penyanyi</p>
        </div>
    </div>

    <!-- Bagian Tengah: Tools Musik -->
    <div class="flex-grow flex flex-col items-center justify-center">
        <!-- Kontrol Musik -->
        <div class="flex items-center space-x-4">
            <button id="prev-btn" class="p-1 bg-none rounded-full hover:bg-gray-600">
                <i class="fas fa-backward"></i>
            </button>
            <button id="play-btn-footer" class="p-1 bg-none rounded-full hover:bg-gray-600 text-lg">
                <i class="fas fa-play" id="play-icon"></i>
            </button>
            <button id="pause-btn" class="p-1 bg-none rounded-full hover:bg-gray-600 text-lg hidden">
                <i class="fas fa-pause"></i>
            </button>
            <button id="next-btn" class="p-1 bg-none rounded-full hover:bg-gray-600">
                <i class="fas fa-forward"></i>
            </button>
        </div>
        <!-- Slider untuk Seek -->
        <div class="w-full">
            <input type="range" min="0" max="100" value="0" class="w-full accent-primary" id="music-slider" />
        </div>
        <!-- Waktu Audio -->
        <div class="text-xs flex justify-between w-3/4 text-gray-400">
            <span id="current-time">0:00</span>
            <span id="duration">0:00</span>
        </div>
    
        <!-- Elemen Audio (Tersembunyi) -->
        <audio id="audio-player" preload="auto" class="hidden"></audio>
    </div>
    

    <!-- Bagian Kanan: Tools Lain -->
    <div class="flex-shrink-0 flex items-center justify-center w-1/5">
        <button id="footer-details-toggle" class="p-2 bg-none rounded-full hover:bg-gray-600" title="Lihat Rincian">
            <i class="fas fa-info-circle"></i>
        </button>
        <div id="footer-details-popover" class="hidden bg-white text-black rounded-lg shadow-lg p-4 w-52 fixed bottom-10 right-10">
            <h3 class="font-semibold text-lg mb-2">Music Details</h3>
            <p>Title: <strong id="popover-music-title">#</strong></p>
            <p>Singer: <strong id="popover-music-singer">#</strong></p>
            <p>Writer: <strong id="popover-writer">#</strong></p>
            <p>Composer: <strong id="popover-composer">#</strong></p>
            <p>genre: <strong id="popover-genre">#</strong></p>
            <p>Duration: <strong id="popover-duration">#</strong></p>
            <p>Release_date: <strong id="popover-release_date">#</strong></p>
            <p id="popover-description" class="mt-2 text-sm text-gray-600">Informasi tambahan tentang musik ini.</p>
            <button id="footer-details-close" class="mt-2 text-blue-500 hover:underline">
                Tutup
            </button>
        </div>
    </div>
</div>
