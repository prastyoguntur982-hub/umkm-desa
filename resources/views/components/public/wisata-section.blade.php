<section id="wisata"
    class="bg-gray-50 dark:bg-gray-900 mx-auto pt-10 pb-10 transition-colors duration-300"
    style="font-family: 'Poppins', sans-serif;" 
    x-data="{
        current: 0,
        images: ['img/wisata1.jpg', 'img/wisata2.jpg', 'img/wisata3.jpg'],
        showImageModal: false,
        showDetailModal: false,
        kategori: 'semua',
        search: ''
    }">

    <div class="max-w-6xl mx-auto px-4 dark:bg-gray-800 bg-white shadow-lg rounded-xl p-12">

        <!-- Kata Pembuka -->
        <div class="text-center mb-10 dark:text-white">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Wisata Desa Tirtomulyo</h2>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Temukan berbagai destinasi wisata unggulan Desa Tirtomulyo. 
                Dari wisata alam, religi, hingga edukasi untuk keluarga.
            </p>
        </div>

        <!-- Filter + Pencarian -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <!-- Kategori -->
            <div class="flex flex-wrap gap-2">
                <template x-for="kat in ['semua','alam','religi','edukasi','lainnya']" :key="kat">
                    <button class="px-4 py-2 rounded-full border text-sm font-medium capitalize"
                        :class="kategori === kat ? 'bg-yellow-400 text-white border-yellow-500' :
                            'bg-white text-gray-600 border-gray-300'"
                        @click="kategori = kat" x-text="kat">
                    </button>
                </template>
            </div>

            <!-- Pencarian -->
            <div class="relative w-full md:w-1/3">
                <input type="text" placeholder="Cari wisata..." x-model="search"
                    class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3 top-2.5 text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                </svg>
            </div>
        </div>

        <!-- Grid Card -->
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
            <template
                x-for="(item, index) in [
            {nama: 'Bukit Wonokambang', kategori: 'alam', deskripsi: 'Panorama perbukitan hijau nan asri.', gambar: 'img/wisata1.jpg'},
            {nama: 'Sendang Tirto Mulyo', kategori: 'religi', deskripsi: 'Wisata religi dengan nilai sejarah.', gambar: 'img/wisata2.jpg'},
            {nama: 'Kebun Edukasi Pertanian', kategori: 'edukasi', deskripsi: 'Belajar bertani bersama petani lokal.', gambar: 'img/wisata3.jpg'}
        ].filter(p => (kategori === 'semua' || p.kategori === kategori) && p.nama.toLowerCase().includes(search.toLowerCase()))"
                :key="index">

                <!-- Card Wisata -->
                <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-md p-4 transition hover:shadow-xl flex flex-col">
                    
                    <!-- Nama Wisata -->
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100" x-text="item.nama"></h3>

                    <!-- Gambar -->
                    <div class="relative my-4">
                        <img :src="item.gambar" class="rounded-xl w-full object-cover h-48 cursor-pointer"
                            @click="showImageModal = true">
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-grow" x-text="item.deskripsi"></p>

                    <!-- Tombol Detail -->
                    <button class="mt-4 w-full bg-yellow-400 text-white py-2 rounded-xl hover:bg-yellow-500 transition"
                        @click="showDetailModal = true">
                        Lihat Detail
                    </button>
                </div>
                <!-- /Card Wisata -->

            </template>
        </div>

    </div>

    <!-- Modal Gambar -->
    <div x-show="showImageModal" x-transition
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
        @click="showImageModal = false" @keydown.window.escape="showImageModal = false" style="display: none;">

        <template x-for="(img, index) in images" :key="index">
            <img x-show="current === index" :src="img" class="max-w-full max-h-[90vh] rounded-lg shadow-lg"
                @click.stop>
        </template>

        <button @click.stop="current = (current - 1 + images.length) % images.length"
            class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black/70 text-xl">
                    &#10094;
        </button>
        <button @click.stop="current = (current + 1) % images.length"
           class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 text-white w-10 h-10 flex items-center justify-center rounded-full hover:bg-black/70 text-xl">
                    &#10094;
        </button>
        <button @click.stop="showImageModal = false"
            class="absolute top-5 right-5 text-white text-4xl font-bold focus:outline-none hover:text-red-500"
            aria-label="Close">&times;</button>
    </div>

    <!-- Modal Detail -->
    <div x-show="showDetailModal" x-transition.opacity.scale.95
        class="fixed inset-0 z-50 flex items-center justify-center px-4" style="display: none;">

        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showDetailModal = false"></div>

        <div
            class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all p-6">

            <!-- Header -->
            <div class="flex justify-between items-center border-b pb-3 mb-4">
                <h2 class="text-2xl font-bold">Detail Wisata</h2>
                <button @click="showDetailModal = false"
                    class="text-gray-500 hover:text-red-500 text-2xl transition">&times;</button>
            </div>

            <!-- Isi Modal -->
            <div>
                <p class="text-gray-600 dark:text-gray-300 mb-4 leading-relaxed">
                    Deskripsi lengkap wisata bisa ditulis di sini...
                </p>

                <!-- Lokasi -->
                <p class="text-gray-700 dark:text-gray-300 font-medium mb-2">Lokasi:</p>
                <div class="mb-6 rounded-xl overflow-hidden shadow-md">
                    <iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="350"
                        style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

</section>
