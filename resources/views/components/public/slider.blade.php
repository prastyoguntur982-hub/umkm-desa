@props(['sliders'])

<div id="default-carousel" class="relative w-full max-h-6xl" data-carousel="slide" x-data="{ umkm: 0, dusun: 0 }"
    x-init="let u = setInterval(() => {
        if (umkm < 18) umkm++;
        else clearInterval(u)
    }, 100);
    let d = setInterval(() => {
        if (dusun < 6) dusun++;
        else clearInterval(d)
    }, 150);">
    <!-- Overlay konten -->
    <div class="absolute inset-0 z-40 flex flex-col items-center justify-center text-center px-4 sm:px-6"
        style="font-family: 'Poppins', sans-serif;">
        <h1
            class="text-xl sm:text-2xl md:text-4xl font-bold text-white drop-shadow-lg max-w-full sm:max-w-2xl md:max-w-4xl mx-auto leading-snug">
            Temukan berbagai produk unggulan dari <br class="hidden sm:block md:block">
            <span class="text-yellow-400">UMKM Desa Tirtomulyo</span>. Dukung produk lokal, belanja mudah langsung maupun
            online!
        </h1>

        <!-- Counter -->
        <div
            class="mt-6 sm:mt-8 flex flex-col sm:flex-row gap-6 sm:gap-12 text-white font-bold text-xl sm:text-2xl md:text-3xl">
            <div class="text-center">
                <span x-text="umkm" class="block text-3xl sm:text-4xl text-yellow-400"></span>
                <span class="text-xs sm:text-sm md:text-base">UMKM Terdaftar</span>
            </div>
            {{-- <div class="text-center">
            <span x-text="dusun" class="block text-3xl sm:text-4xl text-yellow-400"></span>
            <span class="text-xs sm:text-sm md:text-base">Dusun<br>Terdaftar</span>
        </div> --}}
        </div>

        <a href="#umkm"
            class="text-base sm:text-lg mt-4 inline-block bg-yellow-400 text-white px-5 py-2 rounded-xl font-semibold shadow hover:bg-yellow-500 transition">
            Cari Sekarang
        </a>
    </div>


    <!-- Carousel wrapper -->
    <div class="relative h-[400px] md:h-[650px] lg:h-[750px] overflow-hidden shadow-xl">
        @foreach ($sliders as $index => $slider)
            <div class="{{ $index === 0 ? '' : 'hidden' }} duration-1000 ease-in-out" data-carousel-item>
                <img src="{{ asset('storage/' . $slider->foto) }}"
                    class="absolute block w-full h-full object-cover object-center" alt="Slider Image">
            </div>
        @endforeach
    </div>


    <!-- Indicators -->
    <div class="absolute z-30 flex space-x-3 bottom-5 left-1/2 transform -translate-x-1/2">
        @foreach ($sliders as $index => $slider)
            <button type="button" class="w-3 h-3 bg-white/80 rounded-full hover:bg-yellow-400 transition"
                aria-label="Slide {{ $index + 1 }}" data-carousel-slide-to="{{ $index }}">
            </button>
        @endforeach
    </div>
</div>
