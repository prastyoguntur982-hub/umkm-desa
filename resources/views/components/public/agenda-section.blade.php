<div class="mt-5 w-full bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden">
        <div class="p-4 bg-gray-100 dark:bg-gray-700 flex items-center" style="font-family: 'Poppins', sans-serif;">
            <span class="inline-block h-5 border-l-4 border-yellow-600 mr-2 rounded-sm"></span>
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Agenda Desa</h2>
        </div>
        <div class="max-w-2xl mx-auto px-4 p-2">
            <div class="flex justify-between items-center mb-4">
                <button id="prevMonth"
                    class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium">←</button>
                <h2 id="currentMonth" class="text-xl font-semibold text-gray-800 dark:text-white"></h2>
                <button id="nextMonth"
                    class="text-gray-600 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium">→</button>
            </div>
            <div id="calendar" class="grid grid-cols-7 gap-2 text-sm text-gray-700 dark:text-gray-200">

            </div>
        </div>

        <!-- Modal -->
        <div id="myModal"
            class="fixed inset-0 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden z-50">
            <div
                class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-sm md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 relative w-[90%] max-w-2xl overflow-hidden">

                <!-- Gambar -->
                <img id="modalImage"
                    class="object-containt w-full rounded-t-lg h-40 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                    src="" alt="Foto Kegiatan" />

                <!-- Konten -->
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 id="modalEventTitle"
                        class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                        <!-- Judul -->
                    </h5>
                    <p id="modalEventDate" class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">
                        <!-- Tanggal -->
                    </p>
                </div>

                <!-- Tombol Close -->
                <button id="closeModal"
                    class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 hover:text-yellow-500 text-2xl">
                    &times;
                </button>
            </div>
        </div>
    </div>
</div>
