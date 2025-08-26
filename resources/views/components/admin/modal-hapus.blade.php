  <!-- Modal Konfirmasi Hapus -->
  <div id="modalHapus" class="modal fixed inset-0 bg-opacity-50 flex items-center justify-center z-50 hidden">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-sm">
          <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Hapus Data?</h2>
          <p class="text-gray-600 dark:text-gray-300 mb-4">Apakah Anda yakin ingin menghapus data ini?</p>
          <form id="formHapus" method="POST" action="">
              @csrf
              @method('DELETE')
              <div class="flex justify-end space-x-2">
                  <button type="button" onclick="closeModal('modalHapus')"
                      class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Batal</button>
                  <button type="submit"
                      class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Hapus</button>
              </div>
          </form>
      </div>
  </div>
