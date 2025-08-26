@extends('layouts.public')

@section('content')
    <div class="bg-white dark:bg-gray-900 text-center my-4 mt-15 animate__animated animate__fadeInDown animate__slow">
        <h1 class="text-3xl font-bold tracking-wide text-gray-800 dark:text-white inline-block relative">
            Galeri
            <span class="block w-16 h-1 bg-red-500 mt-2 mx-auto rounded"></span>
        </h1>
    </div>

    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 -mt-5">
        <div class="mb-6">
            <input type="text" id="search-input" placeholder="Cari galeri..."
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:ring-red-400 focus:border-red-600">
        </div>

        <div id="galeri-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10 ">
            @foreach ($kategoriGaleri as $item)
                <div
                    class="fade-on-scroll animate__animated rounded overflow-hidden shadow-lg bg-white dark:bg-gray-800 hover:shadow-2xl transition transform hover:scale-105 cursor-pointer">
                    <div class="relative h-60">
                        <a href="{{ route('galeri.show', $item->id) }}">
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $item->foto) }}"
                                alt="{{ $item->nama }}">
                            <div class="absolute inset-0 bg-red-50 opacity-25 hover:opacity-0 transition duration-300">
                            </div>
                        </a>
                        <div
                            class="absolute bottom-0 left-0 bg-red-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-red-600 transition dark:hover:bg-gray-100">
                            Foto
                        </div>
                        <div
                            class="text-sm absolute top-0 right-0 bg-red-600 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-red-600 transition dark:hover:bg-gray-100">
                            <span class="font-bold">{{ \Carbon\Carbon::parse($item->tanggal)->format('d') }}</span>
                            <small>{{ \Carbon\Carbon::parse($item->tanggal)->format('M') }}</small>
                        </div>
                    </div>
                    <div class="px-6 py-4">
                        <div
                            class="font-semibold text-lg inline-block text-gray-800 dark:text-gray-100 hover:text-red-600 transition">
                            <a href="{{ route('galeri.show', $item->id) }}">
                                {{ $item->nama }}
                            </a>

                        </div>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            Ditambahkan pada {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                </div>
            @endforeach
        </div>


        <div id="no-data"
            class="hidden flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">

            <x-public.no-data-img />
            <p>Galeri tidak ditemukan.</p>
        </div>
    </div>

    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            const query = this.value.trim();
            const grid = document.getElementById('galeri-grid');
            const noData = document.getElementById('no-data');

            fetch(`/galeri/search?query=${encodeURIComponent(query)}`)
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
                        const fotoPath = item.foto ? `/storage/${item.foto}` : `/img/no-image.png`;
                        const tanggal = new Date(item.tanggal);
                        const day = tanggal.getDate().toString().padStart(2, '0');
                        const month = tanggal.toLocaleString('id-ID', {
                            month: 'short'
                        });

                        grid.innerHTML += `
                        <div
                            class="rounded overflow-hidden shadow-lg bg-white dark:bg-gray-800  hover:shadow-2xl transition transform hover:scale-105 cursor-pointer">
                            <div class="relative h-60">
                                <a href="/galeri/${item.id}">
                                    <img class="w-full h-full object-cover" src="${fotoPath}" alt="${item.nama}">
                                    <div class="absolute inset-0 bg-red-50 opacity-25 hover:opacity-0 transition duration-300"></div>
                                </a>
                                <div class="absolute bottom-0 left-0 bg-red-600 px-4 py-2 text-white text-sm hover:bg-white hover:text-red-600 transition dark:hover:bg-gray-100">
                                    Foto
                                </div>
                                <div class="text-sm absolute top-0 right-0 bg-red-600 px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-red-600 transition dark:hover:bg-gray-100">
                                    <span class="font-bold">${day}</span>
                                    <small>${month}</small>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="font-semibold text-lg inline-block text-gray-800 dark:text-gray-100 hover:text-red-600 transition">
                                   <a href="/galeri/${item.id}">
                                      ${item.nama}
                                   </a>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">
                                    Ditambahkan pada ${new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                                
                                </p>
                            </div>
                          
                        </div>
                    `;
                    });
                })
                .catch(err => {
                    console.error(err);
                    grid.innerHTML = '<p class="text-red-600">Gagal memuat data galeri.</p>';
                    grid.classList.remove('hidden');
                    noData.classList.add('hidden');
                });
        });
    </script>
@endsection
