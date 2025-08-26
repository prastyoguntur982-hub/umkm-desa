<section id="profil-desa"
    class="bg-gradient-to-r from-gray-100 to-gray-200 
           dark:from-gray-800 dark:to-gray-900 p-10
           mx-auto pt-10 pb-5 transition-colors duration-300"
    style="font-family: 'Poppins', sans-serif;">

    <div
        class="bg-gradient-to-l from-gray-50 to-gray-200 
               dark:from-gray-800 dark:to-gray-900
               max-w-6xl mx-auto px-4 shadow-lg rounded-xl p-5">


        <!-- Judul -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-2 sm:gap-4 mb-4 sm:mb-6">
            {{-- <div class="w-12 sm:w-16 md:w-20 h-[3px] sm:h-[4px] bg-yellow-500 rounded-full"></div> --}}
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 text-center">Profil
                Desa</h2>
            {{-- <div class="w-12 sm:w-16 md:w-20 h-[3px] sm:h-[4px] bg-yellow-500 rounded-full"></div> --}}
        </div>

        <!-- Deskripsi -->
        <p
            class="text-gray-600 dark:text-gray-300 text-center text-xs sm:text-sm md:text-base max-w-full sm:max-w-xl md:max-w-2xl mx-auto mb-6 sm:mb-8 leading-snug sm:leading-relaxed">
            Desa Tirtomulyo terdiri dari <span class="font-semibold">7 dusun</span> yang masing-masing memiliki potensi,
            kearifan lokal, dan ciri khas unik. Berikut adalah gambaran singkat dusun-dusun yang ada di Desa Tirtomulyo.
        </p>


        <!-- Container scrollable horizontal -->
        <div class="relative z-10">

            <!-- Tombol Navigasi -->
            <button onclick="scrollSlider(-1)"
                class="absolute left-2 sm:left-3 top-1/2 -translate-y-1/2 bg-yellow-500/70 text-white w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full hover:bg-yellow-600 transition text-lg sm:text-xl z-50">
                &#10094;
            </button>
            <button onclick="scrollSlider(1)"
                class="absolute right-2 sm:right-3 top-1/2 -translate-y-1/2 bg-yellow-500/70 text-white w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full hover:bg-yellow-600 transition text-lg sm:text-xl z-50">
                &#10095;
            </button>

            <!-- Slider -->
            <div id="slider"
                class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth scrollbar-hide px-2 sm:px-4 py-4 min-h-[220px] sm:min-h-[280px]">

                <!-- Card Dusun -->
                <div
                    class="relative min-w-[250px] sm:min-w-[300px] md:min-w-[350px] h-48 sm:h-56 md:h-60 rounded-xl overflow-hidden shadow-md hover:scale-105 transition-transform duration-500">
                    <img src="img/bg.jpg" alt="Dusun Wonokambang" class="w-full h-full object-cover">
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center px-2">
                        <h3 class="text-lg sm:text-xl md:text-xl font-bold text-white text-center">
                            Dusun <span class="text-yellow-400">Wonokambang</span>
                        </h3>
                    </div>
                </div>

                <div
                    class="relative min-w-[250px] sm:min-w-[300px] md:min-w-[350px] h-48 sm:h-56 md:h-60 rounded-xl overflow-hidden shadow-md hover:scale-105 transition-transform duration-500">
                    <img src="img/bg.jpg" alt="Dusun Wonokambang" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center px-2">
                        <h3 class="text-lg sm:text-xl md:text-xl font-bold text-white text-center">
                            Dusun <span class="text-yellow-400">Wonokambang</span>
                        </h3>
                    </div>
                </div>

                <!-- Tambahkan card lainnya dengan pola sama -->
            </div>
        </div>

    </div>
</section>

<!-- CSS untuk sembunyikan scrollbar -->
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<!-- Script untuk navigasi slider -->
<script>
    function scrollSlider(direction) {
        const slider = document.getElementById('slider');
        const scrollAmount = 300; // geser per klik
        slider.scrollBy({
            left: direction * scrollAmount,
            behavior: 'smooth'
        });
    }
</script>
