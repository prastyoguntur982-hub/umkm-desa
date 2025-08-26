@extends('layouts.public')

@section('content')
    <div class="mx-auto mt-10 mb-16 px-4 max-w-[80%]">
        <h2 class="mb-6 text-xl font-bold text-gray-800 dark:text-white border-b-2 border-red-600 inline-block pb-2 animate__animated animate__fadeInDown"
            style="font-family: 'Poppins', sans-serif;">
            {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $kategori)) }}
        </h2>

        <div class="border-gray-200 border-dashed rounded-lg dark:border-gray-700 animate__animated animate__fadeInUp ">
            <div class="flex justify-center">
                <div
                    class="items-center justify-center w-full max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-sm overflow-x-auto">
                    <table class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="px-4 py-3">Judul</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3">Berkas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                            @foreach ($data as $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">{{ $item->judul }}</td>
                                    <td class="px-4 py-2">{{ $item->keterangan }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->berkas)
                                            <a href="{{ asset('storage/' . $item->berkas) }}"
                                                class="text-red-600 hover:text-red-800 flex items-center gap-1"
                                                target="_blank" title="Unduh Berkas"
                                                download="{{ Str::slug($item->judul) }}{{ pathinfo($item->berkas, PATHINFO_EXTENSION) ? '.' . pathinfo($item->berkas, PATHINFO_EXTENSION) : '' }}">
                                                <i class="fas fa-download"></i>
                                                <span>Unduh Berkas</span>
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic">Tidak ada</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
