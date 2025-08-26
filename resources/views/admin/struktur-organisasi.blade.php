@extends('layouts.admin')

@section('content')
    <div class="pl-2 pr-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div
            class="items-center justify-center max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-md overflow-x-auto">

            <button type="button" data-modal-target="tambah-strukturOrganisasi" data-modal-toggle="tambah-strukturOrganisasi"
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
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jabatan</th>
                        <th class="px-4 py-3">NIP</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Posisi Bagan</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                    @foreach ($struktur as $item)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-4 py-2">{{ $item->id }}</td>
                            <td class="px-4 py-2">{{ $item->nama }}</td>
                            <td class="px-4 py-2">{{ $item->jabatan }}</td>
                            <td class="px-4 py-2">{{ $item->nip }}</td>
                            <td class="px-4 py-2">
                                @if ($item->foto)
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
                                @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @php
                                    $parent = $struktur->firstWhere('id', $item->parent_id);
                                @endphp

                                @if ($parent)
                                    Dibawah {{ $parent->jabatan }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-4 py-2 space-x-2">
                                <button type="button" data-modal-target="edit-strukturOrganisasi-{{ $item->id }}"
                                    data-modal-toggle="edit-strukturOrganisasi-{{ $item->id }}"
                                    class="text-yellow-600 hover:underline">
                                    Edit
                                </button>
                                @include('components.admin.modalEdit-strukturOrganisasi')

                                <button onclick="deleteForm('{{ route('admin.struktur-organisasi.destroy', $item->id) }}')"
                                    class="text-red-600 hover:underline">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('components.admin.modalTambah-strukturOrganisasi')
    @include('components.admin.modal-hapus')
    @include('components.admin.modal-foto')
@endsection
