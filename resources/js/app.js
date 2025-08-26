// ========== Import ==========
import 'flowbite';
import 'animate.css';
import Alpine from 'alpinejs';
import { DataTable } from "simple-datatables";

// ========== Inisialisasi Alpine ==========
window.Alpine = Alpine;
Alpine.start();

// ========== DataTable ==========
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.datatable').forEach((table, index) => {
        const storageKey = `datatable-state-${index}`;

        // Cek apakah ada data sebelumnya
        const savedState = JSON.parse(localStorage.getItem(storageKey)) || {};

        const datatable = new DataTable(table, {
            paging: true,
            perPage: savedState.perPage || 5,
            perPageSelect: [5, 10, 15, 20, 25],
            sortable: true
        });

        // Setelah datatable terinisialisasi
        datatable.on('datatable.page', (page) => {
            const state = JSON.parse(localStorage.getItem(storageKey)) || {};
            state.page = page;
            localStorage.setItem(storageKey, JSON.stringify(state));
        });

        datatable.on('datatable.perpage', (perPage) => {
            const state = JSON.parse(localStorage.getItem(storageKey)) || {};
            state.perPage = perPage;
            localStorage.setItem(storageKey, JSON.stringify(state));
        });

        datatable.on('datatable.sort', (column, direction) => {
            const state = JSON.parse(localStorage.getItem(storageKey)) || {};
            state.sort = { column, direction };
            localStorage.setItem(storageKey, JSON.stringify(state));
        });

        // Tunggu datatable ready, lalu set ke halaman sebelumnya (jika ada)
        datatable.on('datatable.init', () => {
            if (savedState.page) {
                datatable.page(savedState.page);
            }
            if (savedState.sort) {
                datatable.columns.sort(savedState.sort.column, savedState.sort.direction);
            }
        });
    });
});

// ========== Dark Mode Toggle ==========
const toggleSwitch = document.getElementById('theme-toggle-switch');
const darkIcon = document.getElementById('theme-toggle-dark-icon');
const lightIcon = document.getElementById('theme-toggle-light-icon');

// Set tema awal dari localStorage atau preferensi sistem
if (
    localStorage.getItem('color-theme') === 'dark' ||
    (!localStorage.getItem('color-theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
) {
    document.documentElement.classList.add('dark');
    toggleSwitch.checked = true;
    darkIcon.classList.remove('hidden');
    lightIcon.classList.add('hidden');
} else {
    document.documentElement.classList.remove('dark');
    toggleSwitch.checked = false;
    lightIcon.classList.remove('hidden');
    darkIcon.classList.add('hidden');
}

toggleSwitch.addEventListener('change', function () {
    const isDark = this.checked;
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('color-theme', isDark ? 'dark' : 'light');
    darkIcon.classList.toggle('hidden', !isDark);
    lightIcon.classList.toggle('hidden', isDark);
});

// ========== Logo Scroll (Navbar) ==========
const logo = document.getElementById('logo-scroll');

window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const width = window.innerWidth;

    if (scrollTop > 50 && (width < 768 || width >= 1024)) {
        logo.classList.remove('hidden');
    } else {
        logo.classList.add('hidden');
    }
});

// Deteksi resize supaya tetap patuh ke logika resolusi
window.addEventListener('resize', () => {
    const width = window.innerWidth;
    const scrollTop = window.scrollY || document.documentElement.scrollTop;

    if (scrollTop > 50 && (width < 768 || width >= 1024)) {
        logo.classList.remove('hidden');
    } else {
        logo.classList.add('hidden');
    }
});

// ========== Sosial Media Icon Scroll (Responsive) ==========
let lastScrollTop = 0;
const sosmed = document.getElementById("sosmed-scroll");

window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    const width = window.innerWidth;

    if (width >= 768 && width < 1024) {
        if (currentScroll > lastScrollTop) {
            sosmed.classList.add("opacity-0", "pointer-events-none");
        } else if (currentScroll <= window.innerHeight * 0.01) {
            sosmed.classList.remove("opacity-0", "pointer-events-none");
        }
    } else {
        sosmed.classList.remove("opacity-0", "pointer-events-none");
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});

// ========== Card Info Harga Slider ==========
const slider = document.getElementById('slider');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

function slideNext() {
    const isEnd = slider.scrollLeft + slider.offsetWidth >= slider.scrollWidth - 1;
    slider.scrollTo({
        left: isEnd ? 0 : slider.scrollLeft + 300,
        behavior: 'smooth'
    });
}

function slidePrev() {
    const isStart = slider.scrollLeft === 0;
    slider.scrollTo({
        left: isStart ? slider.scrollWidth : slider.scrollLeft - 300,
        behavior: 'smooth'
    });
}

nextBtn?.addEventListener('click', slideNext);
prevBtn?.addEventListener('click', slidePrev);

// Auto-slide
setInterval(slideNext, 3000);

// ========== Berita Populer Auto Scroll ==========
const list = document.getElementById('scrolling-list');
if (list) list.innerHTML += list.innerHTML;


document.addEventListener("DOMContentLoaded", () => {
    // ==== Animate on Scroll (with data-animate attribute) ====
    const animatedItems = document.querySelectorAll("[data-animate]");

    const animateObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const animationClass = el.getAttribute("data-animate");
                el.classList.add(animationClass);
                el.classList.remove("opacity-0");
                animateObserver.unobserve(el);
            }
        });
    }, { threshold: 0.1 });

    animatedItems.forEach(item => animateObserver.observe(item));

    // ==== Fade on Scroll (specific class trigger) ====
    const fadeElements = document.querySelectorAll('.fade-on-scroll');

    const fadeObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate__fadeInUp');
                fadeObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    fadeElements.forEach(el => fadeObserver.observe(el));
});
