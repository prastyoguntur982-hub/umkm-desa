  @extends('layouts.admin')

  @section('content')
      <div class=" pl-2 pr-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
          <div
              class="items-center justify-center max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

              <button type="button" data-modal-target="tambah-Ppid" data-modal-toggle="tambah-Ppid"
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
                          <th class="px-4 py-3">judul</th>
                          <th class="px-4 py-3">keterangan</th>
                          <th class="px-4 py-3">berkas</th>
                          <th class="px-4 py-3">Aksi</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                      @foreach ($ppid as $item)
                          <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                              <td class="px-4 py-2">{{ $loop->iteration }}</td>
                              <td class="px-4 py-2">{{ Str::headline(str_replace('-', ' ', $item->kategori)) }}</td>

                              <td class="px-4 py-2">{{ $item->judul }}</td>
                              <td class="px-4 py-2">{{ $item->keterangan }}</td>

                              <td class="px-4 py-2">
                                  <a href="{{ route('admin.ppid.unduh', $item->id) }}"
                                      class="flex items-center text-blue-600 hover:underline">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                          viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M7 10l5 5m0 0l5-5m-5 5V3" />
                                      </svg>
                                      Unduh
                                  </a>
                              </td>


                              <td class="px-4 py-2 space-x-2">
                                  <button type="button" data-modal-target="edit-Ppid-{{ $item->id }}"
                                      data-modal-toggle="edit-Ppid-{{ $item->id }}"
                                      class="text-yellow-600 hover:underline">
                                      Edit
                                  </button>

                                  @include('components.admin.modalEdit-Ppid')

                                  <button onclick="deleteForm('{{ route('admin.ppid.destroy', $item->id) }}')"
                                      class="text-red-600 hover:underline">Hapus</button>

                              </td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>

          </div>
      </div>


      @include('components.admin.modalTambah-Ppid')
      @include('components.admin.modal-hapus')
  @endsection
