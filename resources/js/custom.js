const resizer = document.getElementById('resizer');
const leftColumn = document.getElementById('left-column');
const rightColumn = document.getElementById('right-column');

// Variabel untuk tracking posisi mouse
let isResizing = false;
let lastDownX = 0;

// Fungsi untuk memulai resize
resizer.addEventListener('mousedown', function(e) {
    isResizing = true;
    lastDownX = e.clientX;

    // Menambahkan user-select: none saat mulai drag
    document.body.style.userSelect = 'none';

    document.addEventListener('mousemove', handleMouseMove);
    document.addEventListener('mouseup', stopResize);
});

// Fungsi untuk menangani pergerakan mouse saat resize
function handleMouseMove(e) {
    if (!isResizing) return;
    const offsetRight = e.clientX - lastDownX;
    lastDownX = e.clientX;

    // Mengubah lebar left-column
    const newWidth = leftColumn.offsetWidth + offsetRight;
    if (newWidth > 300 && newWidth < window.innerWidth / 2) { // Pastikan kolom tidak terlalu kecil atau besar
        leftColumn.style.width = newWidth + 'px';
    }
}

// Fungsi untuk menghentikan proses resize
function stopResize() {
    isResizing = false;

    // Mengembalikan user-select ke normal setelah selesai drag
    document.body.style.userSelect = '';

    document.removeEventListener('mousemove', handleMouseMove);
    document.removeEventListener('mouseup', stopResize);
}


document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('footer-details-toggle');
    const popover = document.getElementById('footer-details-popover');
    const closeButton = document.getElementById('footer-details-close');

    if (!toggleButton || !popover || !closeButton) {
        console.error("Popover elements not found");
        return;
    }

    // Toggle popover visibility
    toggleButton.addEventListener('click', () => {
        if (popover.classList.contains('hidden')) {
            popover.classList.remove('hidden');
        } else {
            popover.classList.add('hidden');
        }
    });

    // Close popover
    closeButton.addEventListener('click', () => {
        popover.classList.add('hidden');
    });
});
