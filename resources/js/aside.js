const searchLib = document.getElementById('searchLib');
const searchBut = document.getElementById('searchBut');

searchBut.addEventListener('click', () => {
    searchLib.classList.remove('hidden');
    
    searchBut.classList.remove('flex');
    searchBut.classList.add('hidden');

    searchLib.focus();
});

searchLib.addEventListener('blur', () => {
    searchLib.classList.add('hidden');
    searchBut.classList.remove('hidden');
    searchBut.classList.add('flex');

    searchLib.value = '';
});


const btnDropPlaylist = document.getElementById('btnDropPlaylist');
const playlistElement = document.getElementById('playlistElement');
const navPlaylist = document.getElementById('navPlaylist');

btnDropPlaylist.addEventListener('click', () => {
    const isHidden = playlistElement.classList.contains('hidden');

    if (isHidden) {
        // Atur tinggi elemen sebelum menghapus kelas hidden
        playlistElement.classList.remove('hidden');
        playlistElement.style.maxHeight = '0px'; // Mulai dari tinggi 0
        setTimeout(() => {
            playlistElement.style.maxHeight = playlistElement.scrollHeight + 'px'; // Transisi ke tinggi penuh
        }, 0);

        navPlaylist.classList.remove('fa-chevron-down');
        navPlaylist.classList.add('fa-chevron-up');
    } else {
        playlistElement.style.maxHeight = '0px'; // Transisi ke tinggi 0
        setTimeout(() => {
            playlistElement.classList.add('hidden'); // Tambahkan kelas hidden setelah transisi selesai
        }, 300);

        navPlaylist.classList.remove('fa-chevron-up');
        navPlaylist.classList.add('fa-chevron-down');
    }
});

const btnDropLiked = document.getElementById('btnDropLiked');
const likedElement = document.getElementById('likedElement');
const navLiked = document.getElementById('navLiked');

btnDropLiked.addEventListener('click', () => {
    const isHidden = likedElement.classList.contains('hidden');

    if (isHidden) {
        // Atur tinggi elemen sebelum menghapus kelas hidden
        likedElement.classList.remove('hidden');
        likedElement.style.maxHeight = '0px'; // Mulai dari tinggi 0
        setTimeout(() => {
            likedElement.style.maxHeight = likedElement.scrollHeight + 'px'; // Transisi ke tinggi penuh
        }, 0);

        navLiked.classList.remove('fa-chevron-down');
        navLiked.classList.add('fa-chevron-up');
    } else {
        likedElement.style.maxHeight = '0px'; // Transisi ke tinggi 0
        setTimeout(() => {
            likedElement.classList.add('hidden'); // Tambahkan kelas hidden setelah transisi selesai
        }, 300);

        navLiked.classList.remove('fa-chevron-up');
        navLiked.classList.add('fa-chevron-down');
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const responsiveDivs = document.querySelectorAll('#responsiveDiv');

    const resizeObserver = new ResizeObserver((entries) => {
        for (const entry of entries) {
            const responsiveDiv = entry.target;
            const resDiv = responsiveDiv.querySelector('#resDiv');
            const musicCount = resDiv.querySelector('[data-element="musicCount"]');
            const createdAt = resDiv.querySelector('[data-element="createdAt"]');
            const width = entry.contentRect.width;

            // Ubah kelas berdasarkan lebar elemen #responsiveDiv
            if (width >= 700) {
                resDiv.classList.remove('hidden');
                resDiv.classList.add('grid');
                musicCount.classList.remove('hidden');
                createdAt.classList.remove('hidden');
            } else if (width >= 400) {
                resDiv.classList.remove('hidden');
                resDiv.classList.add('grid');
                musicCount.classList.remove('hidden');
                createdAt.classList.add('hidden');
            } else {
                resDiv.classList.add('hidden');
                resDiv.classList.remove('grid');
                musicCount.classList.add('hidden');
                createdAt.classList.add('hidden');
            }
        }
    });

    // Observasi setiap elemen responsiveDiv
    responsiveDivs.forEach((div) => resizeObserver.observe(div));
});
