  @extends('layouts.admin')

  @section('content')
      <div class=" pl-2 pr-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <div
              class="items-center justify-center max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

              <button type="button" data-modal-target="tambah-Balai" data-modal-toggle="tambah-Balai"
                  class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                      xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                  </svg>
                  Tambah Data
              </button>

              <table class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                  <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                      <tr>

                          <th class="px-4 py-3">#</th>
                          <th class="px-4 py-3">Kategori</th>
                          <th class="px-4 py-3">Alamat</th>
                          <th class="px-4 py-3">Deskripsi</th>
                          <th class="px-4 py-3">Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                      @foreach ($balai as $item)
                          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              <td class="px-4 py-2">{{ $loop->iteration }}</td>
                              <td class="px-4 py-2">{{ Str::headline(str_replace('-', ' ', $item->kategori)) }}</td>
                              <td class="px-4 py-2">{{ $item->alamat }}</td>
                              <td class="px-4 py-2">{{ $item->deskripsi }}</td>
                              
                              <td class="px-4 py-2 space-x-2">
                                  <button type="button" data-modal-target="edit-Balai-{{ $item->id }}"
                                      data-modal-toggle="edit-Balai-{{ $item->id }}"
                                      class="text-yellow-600 hover:underline">
                                      Edit
                                  </button>

                                  @include('components.admin.modalEdit-Balai')

                                  <button onclick="deleteForm('{{ route('admin.balai.destroy', $item->id) }}')"
                                      class="text-red-600 hover:underline">Hapus</button>

                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>

          </div>
      </div>

      @include('components.admin.modalTambah-Balai')
      @include('components.admin.modal-hapus')

  @endsection
