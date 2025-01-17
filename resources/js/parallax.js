document.addEventListener('scroll', function () {
    const scrollTop = window.scrollY;

    // Kecepatan untuk setiap gambar (disesuaikan)
    const speed1 = 0.1; // Paling lambat
    const speed2 = 0.2;
    const speed3 = 0.4;
    const speed4 = 0.3;

    // Efek parallax
    document.querySelector('.img1 #img1-1').style.transform = `translateY(${scrollTop * speed4}px)`;

    document.querySelector('.img2 #img2-1').style.transform = `translateY(${scrollTop * speed3}px)`;
    document.querySelector('.img2 #img2-2').style.transform = `translateY(${scrollTop * speed3}px)`;

    document.querySelector('.img3 #img3-1').style.transform = `translateY(${scrollTop * speed2}px)`;

    document.querySelector('.img4 #img4-1').style.transform = `translateY(${scrollTop * speed1}px)`;

    document.querySelector('.img4 #img4-1').style.transform = `translateY(${scrollTop * speed1}px)`;

});

document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk scroll otomatis ke elemen tertentu
    const scrollToSection = (sectionId) => {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ behavior: 'smooth' });
        }
    };

    // Event listener untuk tombol navigasi
    const joinButton = document.querySelector('#navJoin');
    const aboutButton = document.querySelector('#navAbout');
    const quotesButton = document.querySelector('#navQuotes');

    if (joinButton) {
        joinButton.addEventListener('click', () => scrollToSection('mainContent'));
    }

    if (aboutButton) {
        aboutButton.addEventListener('click', () => scrollToSection('additionalContent'));
    }
    if (quotesButton) {
        quotesButton.addEventListener('click', () => scrollToSection('quotesSection'));
    }

    const hamburgerMenu = document.getElementById('hamburgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');

    // Toggle Mobile Menu
    hamburgerMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Navigasi untuk mobile menu
    const navJoinMobile = document.getElementById('navJoinMobile');
    const navQuotesMobile = document.getElementById('navQuotesMobile');
    const navAboutMobile = document.getElementById('navAboutMobile');

    navJoinMobile.addEventListener('click', () => scrollToSection('mainContent'));
    navQuotesMobile.addEventListener('click', () => scrollToSection('quotesSection'));
    navAboutMobile.addEventListener('click', () => scrollToSection('additionalContent'));

    // Elemen yang akan diamati
    const sections = [
        document.getElementById('mainContent'),
        document.getElementById('quotesSection'),
        document.getElementById('footer')
    ];

    // Menambahkan kelas animasi ketika elemen terlihat
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in'); // Tambahkan kelas animasi
            } else {
                entry.target.classList.remove('fade-in'); // Hapus animasi saat elemen keluar dari viewport
            }
        });
    }, {
        threshold: 0.3 // Elemen terlihat 30% di layar
    });

    // Mendaftarkan setiap elemen ke dalam observer
    sections.forEach(section => {
        if (section) {
            section.classList.add('fade-out'); // Tambahkan gaya awal
            observer.observe(section);
        }
    });
});
