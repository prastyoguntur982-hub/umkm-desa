<div id="edit-Ppid-{{ $item->id }}" tabindex="-1" aria-hidden="true"
    class="modal fixed inset-0 z-50 hidden  bg-opacity-30 flex justify-center items-center">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
            <!-- Modal header -->
            <div
                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit data
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="edit-Ppid-{{ $item->id }}">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Form Edit -->
            <div class="max-w-lg mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <form method="POST" action="{{ route('admin.ppid.update', $item->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                        <select name="kategori"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Informasi serta merta"
                                {{ $item->kategori == 'Informasi serta merta' ? 'selected' : '' }}>Informasi serta merta
                            </option>
                            <option value="Informasi wajib berkala diumumkan"
                                {{ $item->kategori == 'Informasi wajib berkala diumumkan' ? 'selected' : '' }}>Informasi
                                wajib berkala diumumkan</option>
                            <option value="Informasi tersedia setiap saat"
                                {{ $item->kategori == 'Informasi tersedia setiap saat' ? 'selected' : '' }}>Informasi
                                tersedia setiap saat</option>
                            <option value="Media informasi lainnya"
                                {{ $item->kategori == 'Media informasi lainnya' ? 'selected' : '' }}>Media informasi
                                lainnya</option>
                            <option value="Informasi yang dikecualikan"
                                {{ $item->kategori == 'Informasi yang dikecualikan' ? 'selected' : '' }}>Informasi yang
                                dikecualikan</option>
                            <option value="Surat keputusan"
                                {{ $item->kategori == 'Surat keputusan' ? 'selected' : '' }}>Surat keputusan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="judul" value="{{ $item->judul }}" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required></input>
                    </div>
                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                        <input type="text" name="keterangan" value="{{ $item->keterangan }}" rows="3"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Berkas</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600"
                            type="file" name="berkas" class="w-full mt-1">
                        <small class="text-gray-500 dark:text-gray-400">Biarkan kosong jika tidak ingin mengubah
                            berkas.</small>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
