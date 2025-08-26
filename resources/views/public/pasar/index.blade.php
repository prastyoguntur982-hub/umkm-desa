@extends('layouts.public')

@section('content')
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16"  style="font-family: 'Poppins', sans-serif;">
        <div class="bg-white dark:bg-gray-900 text-center mb-15 animate__animated animate__fadeInDown animate__slow" style="font-family: 'Poppins', sans-serif;">
            <h1 class="text-3xl font-bold tracking-wide text-gray-800 dark:text-white inline-block relative">
                Profil Pasar
                <span class="block w-16 h-1 bg-red-500 mt-2 mx-auto rounded"></span>
            </h1>
            <p class="w-[80%] mt-2 text-gray-600 dark:text-gray-300 text-sm mx-auto">
                Data dari beberapa pasar di kota semarang yang terdata di catatan Dinas Perdagangan kota Semarang
            </p>
        </div>
        <div class="mb-6">
            <input type="text" id="search-input" placeholder="Cari pasar..."
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        </div>http://localhost:8000/jadwal-kesehatan

        <div id="no-data" class="hidden text-center col-span-full" style="font-family: 'Poppins', sans-serif;">
            <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                <x-public.no-data-img />
                <p>Data tidak ditemukan.</p>
            </div>
        </div>

        <div id="pasar-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($pasar as $index => $item)
                @php
                    $fotoPath =
                        !empty($item->foto) && file_exists(public_path('storage/' . $item->foto))
                            ? asset('storage/' . $item->foto)
                            : asset('img/no-image.png');
                @endphp

                <div class="fade-on-scroll animate__animated w-full bg-white border border-gray-200 rounded-xl shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden relative"
                    style="animation-delay: {{ $index * 0.1 }}s">
                    <a href="{{ route('pasar.show', $item->id) }}">
                        <img class="rounded-t-xl w-full h-48 object-cover" src="{{ $fotoPath }}"
                            alt="{{ $item->nama }}" />
                    </a>

                    <div class="flex flex-col flex-grow p-4 pb-20">
                        <a href="{{ route('pasar.show', $item->id) }}">
                            <h3 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white mb-1">
                                {{ $item->nama }}
                            </h3>
                        </a>

                        <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">
                            {{ $item->alamat }}
                        </p>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-white dark:bg-gray-800">
                        <a href="{{ route('pasar.show', $item->id) }}"
                            class="w-full block text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Selengkapnya
                        </a>
                    </div>
                </div>
            @empty
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        document.getElementById('pasar-grid').classList.add('hidden');
                        document.getElementById('no-data').classList.remove('hidden');
                    });
                </script>
            @endforelse
        </div>


        <div class="mt-6">
            {{ $pasar->links() }}
        </div>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            const query = this.value;
            const grid = document.getElementById('pasar-grid');
            const noData = document.getElementById('no-data');

            fetch(`/pasar/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    grid.innerHTML = '';

                    if (data.length === 0) {
                        grid.classList.add('hidden');
                        noData.classList.remove('hidden');
                        return;
                    }

                    noData.classList.add('hidden');
                    grid.classList.remove('hidden');

                    data.forEach(item => {

                        let fotoPath = item.foto ? `/storage/${item.foto}` : `/img/no-image.png`;

                        grid.innerHTML += `
                    <div class="w-full bg-white border border-gray-200 rounded-xl shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden relative">
                        <a href="#">
                            <img class="rounded-t-xl w-full h-48 object-cover" src="${fotoPath}" alt="${item.nama}" />
                        </a>

                        <div class="flex flex-col flex-grow p-4 pb-20">
                            <a href="#">
                                <h3 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white mb-1">${item.nama}</h3>
                            </a>

                            <p class="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">${item.alamat}</p>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-white dark:bg-gray-800">
                           <a href="/pasar/${item.id}" class="w-full block text-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Selengkapnya</a>

                        </div>
                    </div>
                `;
                    });
                });
        });
    </script>
@endsection
