document.addEventListener('DOMContentLoaded', () => {
    const audioPlayer = document.getElementById('audio-player');
    const footerElement = document.getElementById('footer'); // Elemen footer
    let currentMusic = null;
    let isUserDragging = false;

    // Elemen UI di footer
    const playButtonFooter = document.getElementById('play-btn-footer');
    const pauseButtonFooter = document.getElementById('pause-btn');
    const slider = document.getElementById('music-slider');
    const currentTimeLabel = document.getElementById('current-time');
    const durationLabel = document.getElementById('duration');

    // Fungsi untuk memperbarui informasi UI Footer
    const updateFooter = (music) => {
        document.getElementById('footer-music-image').src = music.image;
        document.getElementById('footer-music-title').textContent = music.title;
        document.getElementById('footer-music-singer').textContent = music.singer;
        durationLabel.textContent = formatTime(audioPlayer.duration || 0);
    };

    const updatePopover = (music) => {
        document.getElementById('popover-music-title').textContent = music.title;
        document.getElementById('popover-music-singer').textContent = music.singer;
        document.getElementById('popover-duration').textContent = music.duration || '0:00';
        document.getElementById('popover-writer').textContent = music.writer;
        document.getElementById('popover-composer').textContent = music.composer;
        document.getElementById('popover-genre').textContent = music.genre;
        document.getElementById('popover-release_date').textContent = music.release_date;
        document.getElementById('popover-description').textContent = music.description;
    };

    // Fungsi untuk memperbarui tombol Play/Pause
    const updatePlayPauseButton = () => {
        if (audioPlayer.paused) {
            playButtonFooter.classList.remove('hidden');
            pauseButtonFooter.classList.add('hidden');
        } else {
            playButtonFooter.classList.add('hidden');
            pauseButtonFooter.classList.remove('hidden');
        }
    };

    // Fungsi untuk memutar musik
    function playMusic(music) {
        if (currentMusic === music.url) {
            if (audioPlayer.paused) {
                audioPlayer.play();
            } else {
                audioPlayer.pause();
            }
        } else {
            currentMusic = music.url;
            audioPlayer.src = music.url; // Tetapkan sumber audio
            audioPlayer.load(); // Muat ulang metadata audio
            audioPlayer.play(); // Mulai pemutaran
            updateFooter(music); // Perbarui UI footer
        }
        updatePlayPauseButton();

        // Tampilkan footer
        footerElement.classList.add('flex');
        footerElement.classList.remove('hidden');
    }

    // Event Listener untuk tombol Play pada daftar lagu
    document.querySelectorAll('.play-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const music = {
                url: button.dataset.musicUrl,
                image: button.dataset.image,
                title: button.dataset.title,
                singer: button.dataset.singer,
                duration: button.dataset.duration,
                writer: button.dataset.writer,
                composer: button.dataset.composer,
                genre: button.dataset.genre,
                release_date: button.dataset.release_date,
                description: button.dataset.description,
            };
            playMusic(music);
            updatePopover(music);
        });
    });

    // Event Listener untuk tombol Play di footer
    playButtonFooter.addEventListener('click', () => {
        audioPlayer.play();
        updatePlayPauseButton();
    });

    // Event Listener untuk tombol Pause di footer
    pauseButtonFooter.addEventListener('click', () => {
        audioPlayer.pause();
        updatePlayPauseButton();
    });

    // Event untuk meng-update UI slider saat audio diputar
    audioPlayer.addEventListener('timeupdate', () => {
        if (!isUserDragging) {
            // Hanya sinkronisasi saat slider tidak sedang digeser
            slider.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            currentTimeLabel.textContent = formatTime(audioPlayer.currentTime);
        }
    });

    // Fungsi untuk memformat waktu ke MM:SS
    const formatTime = (seconds) => {
        if (isNaN(seconds) || seconds === Infinity) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
    };

    // Reset UI saat musik selesai
    audioPlayer.addEventListener('ended', () => {
        slider.value = 0;
        currentTimeLabel.textContent = '0:00';
        updatePlayPauseButton();
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const addToPlaylistBtn = document.getElementById('add-to-playlist-btn');
    const playlistPopover = document.getElementById('playlist-popover');

    // Toggle popover visibility
    addToPlaylistBtn.addEventListener('click', () => {
        playlistPopover.classList.toggle('hidden');
    });

    // Close popover when clicking outside
    document.addEventListener('click', (event) => {
        if (!playlistPopover.contains(event.target) && !addToPlaylistBtn.contains(event.target)) {
            playlistPopover.classList.add('hidden');
        }
    });
});