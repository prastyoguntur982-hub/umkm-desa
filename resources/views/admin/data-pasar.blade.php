@extends('layouts.admin')

@section('content')
    <div x-data="{
        tab: localStorage.getItem('tab') || 'pasar', // Ambil tab terakhir dari localStorage, default ke 'pasar'
    
        // Watch untuk menyimpan tab yang dipilih ke localStorage setiap kali tab berubah
        init() {
            this.$watch('tab', value => {
                localStorage.setItem('tab', value);
            });
        }
    }" class="p-4">
        <!-- Tab Navigation -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-4" aria-label="Tabs">
                <button @click="tab = 'pasar'"
                    :class="tab === 'pasar'
                        ?
                        'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400' :
                        'text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400'"
                    class="px-3 py-2 text-sm font-medium">
                    Pasar
                </button>
                <button @click="tab = 'detail'"
                    :class="tab === 'detail'
                        ?
                        'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400' :
                        'text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400'"
                    class="px-3 py-2 text-sm font-medium">
                    Detail Pasar
                </button>
                <button @click="tab = 'dokumen'"
                    :class="tab === 'dokumen'
                        ?
                        'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400' :
                        'text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400'"
                    class="px-3 py-2 text-sm font-medium">
                    Dokumen Pelengkap
                </button>
            </nav>
        </div>

        <!-- TAB: PASAR -->
        <div x-show="tab === 'pasar'" x-cloak>
            <!-- Tabel deskripsi pasar -->
            <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <button type="button" data-modal-target="tambah-Pasar" data-modal-toggle="tambah-Pasar"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Data
                </button>

                @include('components.admin.modalTambah-Pasar')

                <div id="tablePasar"
                    class="items-center justify-center max-w-7xl mt-8 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">
                    <table class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Alamat</th>
                                <th class="px-4 py-3">Foto</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                            @foreach ($pasars as $pasar)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $pasar->nama }}</td>
                                    <td class="px-4 py-2">{{ $pasar->alamat }}</td>
                                    <td class="px-4 py-2">
                                        <button onclick="openFotoModal('{{ asset('storage/' . $pasar->foto) }}')"
                                            class="text-blue-600 hover:underline flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat
                                        </button>
                                    </td>



                                    <td class="px-4 py-2 space-x-2">
                                        <button type="button" data-modal-target="edit-Pasar-{{ $pasar->id }}"
                                            data-modal-toggle="edit-Pasar-{{ $pasar->id }}"
                                            class="text-yellow-600 hover:underline">
                                            Edit
                                        </button>

                                        @include('components.admin.modalEdit-Pasar')

                                        <button onclick="deleteForm('{{ route('admin.pasars.destroy', $pasar->id) }}')"
                                            class="text-red-600 hover:underline">Hapus</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB: DETAIL PASAR -->
        <div x-show="tab === 'detail'" x-cloak>
            <!-- Tabel detail pasar -->
            <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <button type="button" data-modal-target="tambah-detailPasar" data-modal-toggle="tambah-detailPasar"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Data
                </button>

                @include('components.admin.modalTambah-detailPasar')

                <div
                    class="bg-white items-center justify-center max-w-7xl mt-8 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">
                    <table id="table2" class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Nama Pasar</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3">Deskripsi</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($detailPasars as $detailPasar)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $detailPasar->pasar->nama }}</td>

                                    <td class="px-4 py-2">{{ $detailPasar->kategori }}</td>
                                    <td class="px-4 py-2">{{ $detailPasar->keterangan }}</td>
                                    <td class="px-4 py-2">{{ $detailPasar->deskripsi }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <button type="button" data-modal-target="edit-detailPasar-{{ $detailPasar->id }}"
                                            data-modal-toggle="edit-detailPasar-{{ $detailPasar->id }}"
                                            class="text-yellow-600 hover:underline">
                                            Edit
                                        </button>

                                        @include('components.admin.modalEdit-detailPasar')

                                        <button
                                            onclick="deleteForm('{{ route('admin.pasars.destroyDetail', $detailPasar->id) }}')"
                                            class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- TAB: DOKUMEN PELENGKAP -->
        <div x-show="tab === 'dokumen'" x-cloak>
            <!-- Tabel Dokumen -->
            <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <button type="button" data-modal-target="tambah-dokumenPasar" data-modal-toggle="tambah-dokumenPasar"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Data
                </button>

                @include('components.admin.modalTambah-dokumenPasar')


                <div
                    class="bg-white items-center justify-center max-w-7xl mt-8 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">
                    <table id="table2" class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">

                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Nama Pasar</th>
                                <th class="px-4 py-3">Judul</th>
                                <th class="px-4 py-3">Deskripsi</th>
                                <th class="px-4 py-3">Berkas</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($dokumenPasars as $dokumen)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $dokumen->pasar->nama }}</td>
                                    <td class="px-4 py-2">{{ $dokumen->judul }}</td>
                                    <td class="px-4 py-2">{{ $dokumen->deskripsi }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('admin.dokumen-pasar.unduh', $dokumen->id) }}"
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
                                        <button type="button" data-modal-target="edit-dokumenPasar-{{ $dokumen->id }}"
                                            data-modal-toggle="edit-dokumenPasar-{{ $dokumen->id }}"
                                            class="text-yellow-600 hover:underline">
                                            Edit
                                        </button>

                                        @include('components.admin.modalEdit-dokumenPasar')


                                        <button
                                            onclick="deleteForm('{{ route('admin.pasars.destroyDokumen', $dokumen->id) }}')"
                                            class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('components.admin.modal-hapus')
        @include('components.admin.modal-foto')
    </div>
@endsection
