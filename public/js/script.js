document.addEventListener('DOMContentLoaded', function () {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = item.querySelector('.dropdown-icon');

        question.addEventListener('click', () => {
            const isActive = answer.classList.contains('active');

            // Menutup semua item FAQ lainnya
            faqItems.forEach(otherItem => {
                otherItem.querySelector('.faq-answer').classList.remove('active');
                otherItem.querySelector('.dropdown-icon').classList.remove('rotated');
            });

            // Membuka atau menutup item yang diklik
            if (!isActive) {
                answer.classList.add('active');
                icon.classList.add('rotated');
            }
        });
    });

    // Hamburger menu functionality
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');
    const navButtons = document.querySelector('.nav-buttons');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        navB.classList.toggle('active');
    });
});

// Fungsi untuk menyesuaikan ukuran testimonial secara dinamis
function adjustTestimonials() {
    const testimonials = document.querySelector('.testimonials');
    const cards = document.querySelectorAll('.testimonial-card');
    const container = document.querySelector('.hero-testimoni');
    const containerWidth = container.offsetWidth;
    
    // Update indicator
    document.getElementById('widthValue').textContent = containerWidth;
    
    // Jika container terlalu sempit untuk menampung semua kartu dengan skala yang ditentukan
    if (containerWidth < 900) {
        // Ubah layout menjadi grid 2 kolom pada layar kecil
        testimonials.classList.add('wrap-mode');
    } else {
        testimonials.classList.remove('wrap-mode');
        
        // Hitung lebar yang dibutuhkan untuk semua kartu dengan skala yang berbeda
        const requiredWidth = (cards[0].offsetWidth * 1) + (cards[1].offsetWidth * 1.1) + 
                            (cards[2].offsetWidth * 1.2) + (cards[3].offsetWidth * 1.1) + 
                            (cards[4].offsetWidth * 1) + (parseFloat(getComputedStyle(testimonials).gap) * 4);
        
        // Jika testimonial melebihi lebar container, kurangi skala semua kartu
        if (requiredWidth > containerWidth - 40) { // 40px untuk padding
            const scaleFactor = (containerWidth - 40) / requiredWidth;
            
            // Terapkan skala yang disesuaikan
            cards[0].style.transform = `scale(${1 * scaleFactor})`;
            cards[1].style.transform = `scale(${1.1 * scaleFactor})`;
            cards[2].style.transform = `scale(${1.2 * scaleFactor})`;
            cards[3].style.transform = `scale(${1.1 * scaleFactor})`;
            cards[4].style.transform = `scale(${1 * scaleFactor})`;
        } else {
            // Kembalikan ke skala default jika cukup ruang
            cards[0].style.transform = 'scale(1)';
            cards[1].style.transform = 'scale(1.1)';
            cards[2].style.transform = 'scale(1.2)';
            cards[3].style.transform = 'scale(1.1)';
            cards[4].style.transform = 'scale(1)';
        }
    }
}

// Panggil fungsi saat halaman dimuat dan diresize
window.addEventListener('load', adjustTestimonials);
window.addEventListener('resize', adjustTestimonials);