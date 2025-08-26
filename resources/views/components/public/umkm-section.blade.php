<section id="umkm"
    class="bg-gradient-to-l from-gray-100 to-gray-200 
           dark:from-gray-800 dark:to-gray-900 p-5 mx-auto   transition-colors duration-300"
    style="font-family: 'Poppins', sans-serif;" x-data="{
        kategori: 'semua',
        search: '',
        showImageModal: false,
        showDetailModal: false,
        selectedUmkm: null
    }">

    <!-- Inject data UMKM ke Alpine.js -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('umkms', @json($umkms->items()));
        });
    </script>


    <div
        class=" bg-gradient-to-r from-gray-50 to-gray-200 
               dark:from-gray-800 dark:to-gray-900
            max-w-6xl mx-auto px-4 shadow-lg rounded-xl p-12">

        <!-- Kata Pembuka -->
        <div class="text-center mb-6 sm:mb-10 dark:text-white px-4">
            <h2 class="text-2xl sm:text-3xl md:text-3xl font-bold text-gray-800 dark:text-gray-100">UMKM Desa Tirtomulyo
            </h2>
            <p
                class="text-xs sm:text-sm md:text-base text-gray-600 dark:text-gray-400 mt-2 leading-snug sm:leading-relaxed">
                Temukan berbagai produk unggulan dari UMKM Desa, mulai dari makanan, minuman, hingga jasa.
            </p>
        </div>


        <!-- Filter + Pencarian -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Kategori -->
            <div class="flex flex-wrap gap-2">
                <template x-for="kat in ['semua','makanan','minuman','jasa','lainnya']" :key="kat">
                    <button class="px-4 py-2 rounded-full border text-sm font-medium capitalize transition-colors"
                        :class="kategori === kat ?
                            'bg-yellow-400 text-white border-yellow-500' :
                            'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-200 border-gray-300 dark:border-gray-600'"
                        @click="kategori = kat" x-text="kat">
                    </button>
                </template>
            </div>


            <!-- Pencarian -->
            <div class="relative w-full md:w-1/3">
                <input type="text" placeholder="Cari produk..." x-model="search"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 
               bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 
               placeholder-gray-400 dark:placeholder-gray-300 
               focus:ring-2 focus:ring-yellow-400 focus:outline-none transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 absolute left-3 top-2.5 
               text-gray-400 dark:text-gray-300"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                </svg>
            </div>

        </div>

        <!-- Grid Card -->
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
            <template
                x-for="umkm in $store.umkms.filter(u => (kategori === 'semua' || u.kategori === kategori) 
                                                              && u.nama_produk.toLowerCase().includes(search.toLowerCase()))"
                :key="umkm.id">
                <div
                    class="bg-white dark:bg-gray-700 rounded-2xl shadow-md p-4 transition hover:shadow-xl flex flex-col">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100" x-text="umkm.nama_produk"></h3>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                        <i class="fas fa-user text-yellow-500 mr-2"></i>
                        <span x-text="umkm.nama_pemilik"></span>
                    </div>
                    <div class="relative my-4" x-show="umkm.primary_photo">
                        <img :src="'/storage/' + umkm.primary_photo"
                            class="rounded-xl w-full object-cover h-48 cursor-pointer"
                            @click="selectedUmkm = umkm; showImageModal=true;">
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-grow" x-text="umkm.deskripsi"></p>
                    <button class="mt-4 w-full bg-yellow-400 text-white py-2 rounded-xl hover:bg-yellow-500 transition"
                        @click="selectedUmkm = umkm; showDetailModal=true;">
                        Lihat Detail
                    </button>
                </div>
            </template>
        </div>

        <div class="mt-4">
            {{ $umkms->links() }}
        </div>

    </div>

    <!-- Modal Gambar -->
    <div x-show="showImageModal" x-transition
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50" @click="showImageModal=false"
        style="display: none;">
        <template x-for="(photo, index) in selectedUmkm.photos" :key="index">
            <img x-show="index === 0" :src="'/storage/' + photo.photo"
                class="max-w-full max-h-[90vh] rounded-lg shadow-lg">
        </template>
        <button @click="showImageModal=false"
            class="absolute top-5 right-5 text-white text-4xl font-bold">&times;</button>
    </div>

    <!-- Modal Detail -->
    <div x-show="showDetailModal" x-transition.opacity.scale.95
        class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display: none;">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showDetailModal=false"></div>

        <div
            class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all p-6">
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <div>
                    <!-- Nama Produk -->
                    <h2 class="text-2xl font-bold dark:text-white"
                        x-text="selectedUmkm ? selectedUmkm.nama_produk : ''"></h2>

                    <!-- Nama Pemilik dengan Icon -->
                    <div class="flex items-center text-sm text-gray-400 mt-1">
                        <i class="fas fa-user mr-2 text-yellow-500"></i>
                        <span x-text="selectedUmkm ? selectedUmkm.nama_pemilik : ''"></span>
                    </div>
                </div>

                <!-- Tombol Tutup -->
                <button @click="showDetailModal=false"
                    class="text-gray-500 hover:text-red-500 text-2xl transition">&times;</button>
            </div>


            <!-- Carousel Gambar -->
            <div class="relative mb-6" x-data="{ currentImg: 0 }">
                <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">Detail Foto</h3>
                <template x-for="(img, index) in selectedUmkm.photos" :key="index">
                    <img x-show="currentImg === index" :src="'/storage/' + img.photo"
                        class="w-full h-90 object-containt rounded-xl shadow">
                </template>
                <button @click="currentImg = (currentImg - 1 + selectedUmkm.photos.length) % selectedUmkm.photos.length"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black/70 text-xl">
                    &#10094;
                </button>

                <button @click="currentImg = (currentImg + 1) % selectedUmkm.photos.length"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black/70 text-xl">
                    &#10095;
                </button>

            </div>
            <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">Deskripsi</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed"
                x-text="selectedUmkm ? selectedUmkm.deskripsi : ''"></p>

            <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-200">Lokasi : </h3>
            <!-- Lokasi -->
            <div class="mb-6 rounded-xl overflow-hidden shadow-md">
                <div x-show="selectedUmkm" x-html="selectedUmkm.lokasi"></div>
            </div>

            <!-- Pesan / Link UMKM -->
            <div class="text-center mt-8">
                <h3 class="font-semibold text-lg mb-5 text-gray-800 dark:text-gray-200">Pesan melalui:</h3>
                <div class="flex justify-center gap-6 flex-wrap">

                    <!-- WhatsApp -->
                    <div class="relative flex flex-col items-center group w-20">
                        <a :href="selectedUmkm.link_wa ? 'https://wa.me/' + selectedUmkm.link_wa : '#'" target="_blank"
                            class="w-16 h-16 flex items-center justify-center bg-green-500 text-white text-3xl rounded-full shadow-md transition relative overflow-hidden">
                            <i class="fab fa-whatsapp"></i>
                            <!-- Overlay muncul saat hover jika link tidak tersedia -->
                            <div x-show="!selectedUmkm.link_wa"
                                class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity rounded-full pointer-events-none">
                                Belum tersedia
                            </div>
                        </a>
                        <span class="text-sm mt-2 text-gray-600 font-medium">WhatsApp</span>
                    </div>

                    <!-- Shopee -->
                    <div class="relative flex flex-col items-center group w-20">
                        <a :href="selectedUmkm.link_shopee ? selectedUmkm.link_shopee : '#'" target="_blank"
                            class="w-16 h-16 flex items-center justify-center bg-orange-500 text-white text-3xl rounded-full shadow-md transition relative overflow-hidden">
                            <i class="fas fa-shopping-bag"></i>
                            <div x-show="!selectedUmkm.link_shopee"
                                class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity rounded-full pointer-events-none">
                                Belum tersedia
                            </div>
                        </a>
                        <span class="text-sm mt-2 text-gray-600 font-medium">Shopee</span>
                    </div>

                    <!-- Tokopedia -->
                    <div class="relative flex flex-col items-center group w-20">
                        <a :href="selectedUmkm.link_tokopedia ? selectedUmkm.link_tokopedia : '#'" target="_blank"
                            class="w-16 h-16 flex items-center justify-center bg-green-700 text-white text-3xl rounded-full shadow-md transition relative overflow-hidden">
                            <i class="fas fa-store"></i>
                            <div x-show="!selectedUmkm.link_tokopedia"
                                class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity rounded-full pointer-events-none">
                                Belum tersedia
                            </div>
                        </a>
                        <span class="text-sm mt-2 text-gray-600 font-medium">Tokopedia</span>
                    </div>

                    <!-- TikTok -->
                    <div class="relative flex flex-col items-center group w-20">
                        <a :href="selectedUmkm.link_tiktok ? selectedUmkm.link_tiktok : '#'" target="_blank"
                            class="w-16 h-16 flex items-center justify-center bg-black text-white text-3xl rounded-full shadow-md transition relative overflow-hidden">
                            <i class="fab fa-tiktok"></i>
                            <div x-show="!selectedUmkm.link_tiktok"
                                class="absolute inset-0 bg-black/30 flex items-center justify-center text-white text-xs font-semibold opacity-0 group-hover:opacity-100 transition-opacity rounded-full pointer-events-none">
                                Belum tersedia
                            </div>
                        </a>
                        <span class="text-sm mt-2 text-gray-600 font-medium">TikTok</span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
