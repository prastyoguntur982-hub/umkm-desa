@extends('layouts.public')

@section('content')
    <section class="relative bg-center bg-no-repeat bg-cover bg-gray-900 bg-blend-overlay"
        style="background-image: url('{{ asset('storage/' . $barang->foto) }}'); min-height: 420px;">
        <div class="absolute inset-0 bg-transparant bg-opacity-60" aria-hidden="true"></div>
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24">
            <h1
                class="text-white font-extrabold tracking-wide leading-tight text-2xl sm:text-5xl md:text-6xl drop-shadow-lg uppercase">
                Daftar harga {{ $barang->nama }} dari berbagai pasar di kota semarang
            </h1>
        </div>
    </section>

    <div class="border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="flex justify-center">
            <div
                class="items-center justify-center w-full max-w-7xl mt-6 mb-8 p-4 rounded-lg bg-gray-50 dark:bg-gray-800 shadow-sm overflow-x-auto">
                <table class="datatable w-full text-sm text-left text-gray-700 dark:text-gray-200">
                    <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nama Pasar</th>
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Per tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                        @foreach ($data as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">
                                    <a href="{{ route('pasar.show', $item->pasar_id) }}"
                                        class="text-gray-600 dark:text-gray-400  hover:underline">
                                        {{ $loop->iteration }}
                                    </a>
                                </td>
                                <td class="px-4 py-2"> 
                                    <a href="{{ route('pasar.show', $item->pasar_id) }}"
                                        class="text-gray-600 dark:text-gray-400 hover:underline">
                                        {{ $item->nama_pasar }}
                                    </a>
                                </td>
                                <td class="px-4 py-2">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
