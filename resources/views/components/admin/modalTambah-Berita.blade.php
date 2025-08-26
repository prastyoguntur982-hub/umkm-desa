 <!-- Modal Tambah -->
 <div id="tambah-Berita" tabindex="-1" aria-hidden="true"
     class="modal fixed inset-0 z-50 hidden  bg-opacity-30 flex justify-center items-center">
     <div class="relative p-4 w-full max-w-md max-h-full">
         <!-- Modal content -->
         <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
             <!-- Modal header -->
             <div
                 class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                 <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                     Tambah data
                 </h3>
                 <button type="button"
                     class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                      data-modal-hide="tambah-Berita">
                     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                     </svg>
                     <span class="sr-only">Close modal</span>
                 </button>
             </div>

             <!-- Modal body -->
             <div class="max-w-lg mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                 <!-- Form tambah Berita -->
                 <form class="space-y-4" action="{{ route('admin.berita.store') }}" method="POST"
                     enctype="multipart/form-data">
                     @csrf
                     <div class="mb-4">
                         <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                         <input type="text" name="judul"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                             required>
                     </div>

                     <div class="mb-4">
                         <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                         <input type="text" name="slug"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                             required>
                     </div>

                     <div class="mb-4">
                         <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Isi</label>
                         <textarea name="isi"
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                             required></textarea>
                     </div>

                     <div>
                         <label for="foto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                         </label>

                         <input type="file" id="foto" name="foto"
                             class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600"
                             required>
                     </div>
                     <button
                         class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                         type="submit">Simpan</button>
                 </form>
             </div>
         </div>
     </div>
 </div>



