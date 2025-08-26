<!-- Gallery Section -->
<div class="py-10 bg-gradient-to-l from-yellow-0 to-yellow-50  dark:from-gray-700 dark:to-gray-900" id="gallery" style="font-family: 'Poppins', sans-serif;">
  

    <div class="container mx-auto md:px-6 max-w-7xl">
        <!-- Heading -->
        <div class="text-center mb-8 animate__animated animate__fadeInUp animate__delay-1s">
            <h2 class="text-3xl font-semibold tracking-tight text-gray-800 dark:text-white">
                Galeri
            </h2>
            <span class="block w-20 h-1 bg-yellow-500 mt-3 mx-auto rounded-full"></span>
            <p class="text-sm text-gray-600 dark:text-gray-300 mt-4">
                Dokumentasi kegiatan masyarakat, pembangunan desa, dan momen penting di Desa Tirtomulyo.
            </p>
        </div>


        <!-- Gallery -->
        <div class="relative animate__animated animate__fadeInUp" x-data="gallery({{ Js::from($fotoGaleri) }})">

            <!-- Main Image -->
            <div class="rounded-xl overflow-hidden shadow-lg mb-6">
                <template x-for="(photo, index) in photos" :key="index">
                    <div x-show="current === index" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="animate__animated animate__zoomIn">
                        <img :src="photo" class="w-full h-72 md:h-[520px] object-cover"
                            :alt="'Gallery image ' + (index + 1)">
                    </div>
                </template>
                <!-- Navigation Buttons -->
                <button @click="prev()"
                    class="absolute top-1/2 left-3 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 dark:bg-gray-700 shadow-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-rose-500 transition animate__animated animate__fadeInLeft">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="next()"
                    class="absolute top-1/2 right-3 -translate-y-1/2 w-10 h-10 rounded-full bg-white/90 dark:bg-gray-700 shadow-lg flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-rose-500 transition animate__animated animate__fadeInRight">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="grid grid-cols-4 gap-4 mt-4">
                <template x-for="(photo, index) in photos" :key="index">
                    <div @click="current = index"
                        class="rounded-lg overflow-hidden cursor-pointer transition-all duration-200 ring-offset-2 animate__animated animate__fadeInUp"
                        :class="{ 'ring-2 ring-rose-500': current === index }">
                        <img :src="photo" class="w-full h-30 object-cover" :alt="'Thumbnail ' + (index + 1)">
                    </div>
                </template>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-5 animate__animated animate__fadeInUp mb-5">
            <a href="{{ route('galeri.index') }}"
                class="inline-block px-6 py-3 text-sm font-semibold text-white rounded-lg shadow-md bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 transition dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-600">
                Lihat selengkapnya
            </a>

        </div>
    </div>
</div>

<script>
    // ========== galeri ==========
    document.addEventListener('alpine:init', () => {
        Alpine.data('gallery', (photos) => ({
            photos,
            current: 0,
            next() {
                this.current = (this.current + 1) % this.photos.length;
            },
            prev() {
                this.current = (this.current - 1 + this.photos.length) % this.photos.length;
            }
        }));
    });
</script>
