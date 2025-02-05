document.addEventListener('DOMContentLoaded', () => {
    const audioPlayer = document.getElementById('audio-player');
    const footerElement = document.getElementById('footer');
    const contentElement = document.getElementById('content');

    let currentMusic = null;
    let isUserDragging = false;
    let isMetadataLoaded = false; // Flag untuk menandai bahwa metadata sudah tersedia

    // Elemen UI di footer
    const playButtonFooter = document.getElementById('play-btn-footer');
    const pauseButtonFooter = document.getElementById('pause-btn');
    const slider = document.getElementById('music-slider');
    const currentTimeLabel = document.getElementById('current-time');
    const durationLabel = document.getElementById('duration');

    // Fungsi format waktu ke format MM:SS
    const formatTime = (seconds) => {
        if (isNaN(seconds) || seconds === Infinity) return '0:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    };

    // Fungsi untuk mengupdate tampilan durasi
    const updateDuration = () => {
        if (audioPlayer.duration && audioPlayer.duration > 0) {
            durationLabel.textContent = formatTime(audioPlayer.duration);
        }
    };

    // Fungsi untuk mengupdate footer dengan data musik
    const updateFooter = (music) => {
        document.getElementById('footer-music-image').src = music.image;
        document.getElementById('footer-music-title').textContent = music.title;
        document.getElementById('footer-music-singer').textContent = music.singer;
    };

    // Fungsi untuk mengupdate popover informasi musik
    const updatePopover = (music) => {
        document.getElementById('popover-music-title').textContent = music.title;
        document.getElementById('popover-music-singer').textContent = music.singer;
        document.getElementById('popover-duration').textContent = formatTime(music.duration);
        document.getElementById('popover-writer').textContent = music.writer;
        document.getElementById('popover-composer').textContent = music.composer;
        document.getElementById('popover-genre').textContent = music.genre;
        document.getElementById('popover-release_date').textContent = music.release_date;
        document.getElementById('popover-description').textContent = music.description;
    };

    // Fungsi untuk mengupdate tampilan tombol play/pause
    const updatePlayPauseButton = () => {
        if (audioPlayer.paused) {
            playButtonFooter.classList.remove('hidden');
            pauseButtonFooter.classList.add('hidden');
        } else {
            playButtonFooter.classList.add('hidden');
            pauseButtonFooter.classList.remove('hidden');
        }
    };

    // Fungsi untuk menghapus metadata musik yang tersimpan (metadata lama)
    const clearMusicStatus = () => {
        localStorage.removeItem('currentMusic');
    };

    // Fungsi untuk menyimpan state musik ke localStorage (metadata baru)
    const saveMusicStatus = (currentTime) => {
        // Hanya simpan state jika audioPlayer.src valid dan metadata sudah ada
        if (!audioPlayer.src || !isMetadataLoaded) return;
        // Data metadata yang akan disimpan (metadata baru)
        const musicStatus = {
            audioSrc: audioPlayer.src,
            title: document.getElementById('footer-music-title').textContent,
            singer: document.getElementById('footer-music-singer').textContent,
            image: document.getElementById('footer-music-image').src,
            currentTime: currentTime,
            isPlaying: !audioPlayer.paused
        };
        // Hapus metadata lama sebelum menyimpan metadata baru
        clearMusicStatus();
        localStorage.setItem('currentMusic', JSON.stringify(musicStatus));
    };

    // Fungsi untuk mengupdate waktu mulai musik (berdasarkan slider)
    // dan menyimpan metadata baru
    const updateMusicStart = (newTime) => {
        audioPlayer.currentTime = newTime;
        // Saat slider mengubah currentTime, kita simpan metadata baru (mengirim metadata lama plus currentTime baru)
        saveMusicStatus(newTime);
    };

    // Fungsi utama untuk memutar musik dari data yang diberikan
    const playMusic = (music) => {
        const isNewMusic = currentMusic !== music.url;
        isMetadataLoaded = false; // Reset flag metadata

        // Jika musik baru, hapus metadata lama dan muat musik baru
        if (isNewMusic) {
            currentMusic = music.url;
            clearMusicStatus(); // Hapus metadata lama
            audioPlayer.src = music.url;
            // Pasang listener loadedmetadata sekali untuk update durasi, set flag, dan simpan state awal
            audioPlayer.addEventListener('loadedmetadata', function onLoadedMetadata() {
                isMetadataLoaded = true;
                updateDuration();
                // Jika terdapat state tersimpan untuk musik yang sama, terapkan currentTime
                const storedMusic = JSON.parse(localStorage.getItem('currentMusic'));
                if (storedMusic && storedMusic.audioSrc === audioPlayer.src && storedMusic.currentTime) {
                    audioPlayer.currentTime = storedMusic.currentTime;
                }
                // Segera simpan state begitu metadata sudah ada
                saveMusicStatus(audioPlayer.currentTime);
            }, { once: true });
            audioPlayer.load();
        }

        // Jika musik yang sama, toggle play/pause
        if (audioPlayer.paused) {
            audioPlayer.play().catch(err => console.error('Error saat memulai pemutaran:', err));
        } else {
            audioPlayer.pause();
        }

        // Update UI footer dan popover dengan metadata musik baru
        updateFooter(music);
        updatePopover(music);
        updatePlayPauseButton();

        // Tampilkan footer dan sesuaikan margin konten
        footerElement.classList.add('flex');
        footerElement.classList.remove('hidden');
        contentElement.classList.remove('mb-2');

        // Simpan state awal (metadata baru)
        saveMusicStatus(audioPlayer.currentTime);
    };

    // --- Restore state dari localStorage (jika ada) --- //
    const storedMusic = JSON.parse(localStorage.getItem('currentMusic'));
    if (storedMusic && storedMusic.audioSrc) {
        console.log('State ditemukan di localStorage:', storedMusic);
        audioPlayer.src = storedMusic.audioSrc;
        updateFooter({
            image: storedMusic.image,
            title: storedMusic.title,
            singer: storedMusic.singer
        });
        // Pasang listener loadedmetadata untuk menerapkan currentTime dari state
        audioPlayer.addEventListener('loadedmetadata', () => {
            isMetadataLoaded = true;
            updateDuration();
            console.log('Restore currentTime:', storedMusic.currentTime);
            audioPlayer.currentTime = storedMusic.currentTime || 0;
            if (storedMusic.isPlaying) {
                audioPlayer.play().catch(err => console.error('Error saat melanjutkan pemutaran:', err));
            }
            updatePlayPauseButton();
        }, { once: true });
    }

    // --- Event Delegation untuk tombol play pada daftar lagu --- //
    document.body.addEventListener('click', (event) => {
        const btn = event.target.closest('.play-btn');
        if (btn) {
            const music = {
                url: btn.dataset.musicUrl,
                image: btn.dataset.image,
                title: btn.dataset.title,
                singer: btn.dataset.singer,
                duration: parseFloat(btn.dataset.duration),
                writer: btn.dataset.writer,
                composer: btn.dataset.composer,
                genre: btn.dataset.genre,
                release_date: btn.dataset.release_date,
                description: btn.dataset.description,
            };
            playMusic(music);
        }
    });

    // --- Event Listener untuk tombol Play/Pause di footer --- //
    playButtonFooter.addEventListener('click', () => {
        audioPlayer.play().catch(err => console.error('Error saat memulai pemutaran:', err));
        updatePlayPauseButton();
    });
    pauseButtonFooter.addEventListener('click', () => {
        audioPlayer.pause();
        updatePlayPauseButton();
    });

    // --- Event listener untuk update slider dan simpan state --- //
    audioPlayer.addEventListener('timeupdate', () => {
        if (!isUserDragging && isMetadataLoaded && audioPlayer.duration) {
            slider.value = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            currentTimeLabel.textContent = formatTime(audioPlayer.currentTime);
        }
        // Simpan state secara berkala dengan metadata baru
        saveMusicStatus(audioPlayer.currentTime);
    });

    // Reset UI ketika musik selesai
    audioPlayer.addEventListener('ended', () => {
        audioPlayer.currentTime = 0;
        slider.value = 0;
        currentTimeLabel.textContent = '0:00';
        updatePlayPauseButton();
        saveMusicStatus(0);
    });

    // --- Bagian Slider ---
    // Saat slider sedang digeser: hanya update label (jika metadata sudah ada)
    slider.addEventListener('input', () => {
        if (!isMetadataLoaded || !audioPlayer.duration) return;
        isUserDragging = true;
        const newTime = (slider.value / 100) * audioPlayer.duration;
        currentTimeLabel.textContent = formatTime(newTime);
    });

    // Saat slider dilepas: update currentTime dan simpan metadata baru (menghapus metadata lama)
    slider.addEventListener('change', () => {
        if (!isMetadataLoaded || !audioPlayer.duration) return;
        const newTime = (slider.value / 100) * audioPlayer.duration;
        updateMusicStart(newTime);
        isUserDragging = false;
    });

    // --- Error Handling ---
    audioPlayer.addEventListener('error', () => {
        console.error('Error memuat audio');
        alert('Terjadi kesalahan saat memutar musik');
    });

    // --- Playlist Popover Toggle ---
    const addToPlaylistBtn = document.getElementById('add-to-playlist-btn');
    const playlistPopover = document.getElementById('playlist-popover');
    addToPlaylistBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        playlistPopover.classList.toggle('hidden');
        playlistPopover.classList.toggle('flex');
    });
    document.addEventListener('click', (event) => {
        if (!playlistPopover.contains(event.target) && !addToPlaylistBtn.contains(event.target)) {
            playlistPopover.classList.add('hidden');
            playlistPopover.classList.remove('flex');
        }
    });
});
