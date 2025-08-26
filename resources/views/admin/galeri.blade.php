@extends('layouts.admin')

@section('content')
    <div x-data="{
        tab: localStorage.getItem('tab') || 'kategoriGaleri',
        init() {
            this.$watch('tab', value => {
                localStorage.setItem('tab', value);
            });
        }
    }" class="p-4">
        <!-- Tab Navigation -->
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <nav class="flex space-x-4" aria-label="Tabs">
                <button @click="tab = 'kategoriGaleri'"
                    :class="tab === 'kategoriGaleri'
                        ?
                        'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400' :
                        'text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400'"
                    class="px-3 py-2 text-sm font-medium">
                    Kategori Galeri
                </button>
                <button @click="tab = 'galeri'"
                    :class="tab === 'galeri'
                        ?
                        'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400' :
                        'text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400'"
                    class="px-3 py-2 text-sm font-medium">
                    Galeri
                </button>
            </nav>
        </div>

        <!-- TAB: Daftar Komoditas -->
        <div x-show="tab === 'kategoriGaleri'" x-cloak>
            <div class=" border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div
                    class="items-center justify-center max-w-7xl mt-8 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

                    <button type="button" onclick="tambahGaleri(1)"
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
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Thumbnail</th>
                                <th class="px-4 py-3">Tanggal</th>

                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                            @foreach ($kategoriGaleri as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->nama }}</td>
                                    <td class="px-4 py-2">
                                        <button onclick="openFotoModal('{{ asset('storage/' . $item->foto) }}')"
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
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>


                                    <td class="px-4 py-2 space-x-2">
                                        <button type="button" data-modal-target="edit-Galeri-{{ $item->id }}"
                                            data-modal-toggle="edit-Galeri-{{ $item->id }}"
                                            class="text-yellow-600 hover:underline font-medium text-sm">
                                            Edit
                                        </button>

                                        @include('components.admin.modalEdit-Galeri')

                                        <button
                                            onclick="deleteForm('{{ route('admin.galeri.destroyKategoriGaleri', $item->id) }}')"
                                            class="text-red-600 hover:underline">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <!-- TAB: galeri -->
        <div x-show="tab === 'galeri'" x-cloak>

            <div class=" border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div
                    class="bg-white items-center justify-center max-w-7xl mt-8 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

                    <button type="button" onclick="tambahGaleri(2)"
                        class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Data
                    </button>

                    <table id="table2" class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Foto</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($galeri as $item)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->kategoriGaleri->nama }}</td>
                                    <!-- Menampilkan nama pasar dari relasi -->

                                    <td class="px-4 py-2">
                                        <button onclick="openFotoModal('{{ asset('storage/' . $item->foto) }}')"
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
                                        <button onclick="deleteForm('{{ route('admin.galeri.destroy', $item->id) }}')"
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
    </div>

    @include('components.admin.modalTambah-Galeri')

    @include('components.admin.modal-foto')


    @include('components.admin.modal-hapus')
@endsection
