 <div id="tambah-infoHarga" tabindex="-1" aria-hidden="true"
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
                     data-modal-hide="tambah-infoHarga">
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
                 <form class="space-y-4" id="formTambahHarga" action="{{ route('admin.info-harga.store') }}"
                     method="POST">
                     @csrf
                     <div>
                         <label for="pasar_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                             Pasar</label>
                         <div class="relative">
                             <select name="pasar_id"
                                 class="bg-gray-50 block w-full px-4 py-2 text-sm font-medium text-gray-900 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 max-h-48 overflow-y-auto">
                                 <option value="" disabled selected>Pilih Pasar</option>
                                 @foreach ($pasars as $pasar)
                                     <option value="{{ $pasar->id }}">{{ $pasar->nama }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                     <div>
                         <label for="barang_id"
                             class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                             Barang</label>
                         <div class="relative">
                             <select name="barang_id"
                                 class="bg-gray-50 block w-full px-4 py-2 text-sm font-medium text-gray-900 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:outline-none focus:border-blue-500 max-h-48 overflow-y-auto">
                                 <option value="" disabled selected>Pilih</option>
                                 @foreach ($daftar_barang as $barang)
                                     <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>

                     <div>
                         <label for="harga" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                             Harga
                         </label>
                         <input id="harga" name="harga" type="text" inputmode="numeric" autocomplete="off"
                             required
                             class="border border-gray-300 text-gray-900 text-sm rounded-lg 
        focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 
        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                             oninput="formatRupiah(this)" />
                     </div>

                     <div>
                         <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                             Tanggal
                         </label>
                         <input id="tanggal" name="tanggal" type="date" required
                             class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
           rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 
           dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                     </div>

                     <button
                         class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"
                         type="submit">Simpan</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
