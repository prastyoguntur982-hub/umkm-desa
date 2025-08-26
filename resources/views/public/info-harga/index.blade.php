@extends('layouts.public')

@section('content')
    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16"  style="font-family: 'Poppins', sans-serif;">
        <div class="bg-white dark:bg-gray-900 text-center mb-15 animate__animated animate__fadeInDown animate__slow">
            <h1 class="text-3xl font-bold tracking-wide text-gray-800 dark:text-white inline-block relative" style="font-family: 'Poppins', sans-serif;">
                Info Harga Komoditi Pasar
                <span class="block w-16 h-1 bg-red-500 mt-2 mx-auto rounded"></span>
            </h1>
            <p class="w-[80%] mt-2 text-gray-600 dark:text-gray-300 text-sm mx-auto" style="font-family: 'Poppins', sans-serif;">
                Data dari berbagai pasar di kota semarang yang terdata di catatan Dinas Perdagangan kota Semarang
            </p>
        </div>
        <div class="mb-6">
            <input type="text" id="search-input" placeholder="Cari komoditi..."
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300">
        </div>

        <div id="no-data" class="hidden text-center col-span-full" style="font-family: 'Poppins', sans-serif;">
            <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                <x-public.no-data-img />
                <p>Data tidak ditemukan.</p>
            </div>
        </div>

        <div id="pasar-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($rataHargaPerBarang as $index => $data)
                @php
                    $fotoPath =
                        !empty($data->foto) && file_exists(public_path('storage/' . $data->foto))
                            ? asset('storage/' . $data->foto)
                            : asset('img/no-image.png');
                @endphp

                <div class="fade-on-scroll animate__animated w-full bg-white border border-gray-200 rounded-xl shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col overflow-hidden relative"
                    style="animation-delay: {{ $index * 0.1 }}s">
                    <img src="{{ $fotoPath }}" alt="{{ $data->nama_barang }}" class="w-full h-40 object-cover" />

                    <div class="p-5 flex flex-col justify-between min-h-[200px]">
                        <div>
                            <h5
                                class="mb-2 text-lg font-semibold text-gray-900 dark:text-white tracking-tight line-clamp-2">
                                {{ $data->nama_barang }}
                            </h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Harga rata-rata:</p>
                            <p x-data="{
                                val: 0,
                                target: {{ $data->rata_harga }},
                                satuan: '{{ $data->satuan }}',
                                formatRupiah(number) {
                                    return new Intl.NumberFormat('id-ID').format(number);
                                },
                                animate() {
                                    const duration = 1000;
                                    const stepTime = Math.abs(Math.floor(duration / this.target));
                                    const start = performance.now();
                                    const step = (timestamp) => {
                                        const progress = Math.min((timestamp - start) / duration, 1);
                                        this.val = Math.floor(progress * this.target);
                                        if (progress < 1) {
                                            requestAnimationFrame(step);
                                        } else {
                                            this.val = this.target;
                                        }
                                    };
                                    requestAnimationFrame(step);
                                }
                            }" x-init="animate()"
                                class="text-base font-medium text-gray-700 dark:text-gray-300">
                                Rp <span x-text="formatRupiah(val)"></span>/<span x-text="satuan"></span>
                            </p>

                        </div>
                        <a href="{{ route('info-harga.show', $data->barang_id) }}"
                            class="mt-4 text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline transition-colors duration-200">
                            Baca selengkapnya
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full animate__animated animate__fadeInUp"> 
                    <div
                        class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400" style="font-family: 'Poppins', sans-serif;">
                        <x-public.no-data-img />
                        <p class="mt-4">Data belum tersedia.</p>
                    </div>
                </div>
            @endforelse
        </div>



        <div class="mt-6">
            {{ $rataHargaPerBarang->links() }}
        </div>

        <script>
            document.getElementById('search-input').addEventListener('keyup', function() {
                const query = this.value.trim();
                const grid = document.getElementById('pasar-grid');
                const noData = document.getElementById('no-data');

                fetch(`/info-harga/search?query=${encodeURIComponent(query)}`)
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

                            grid.innerHTML += `
                        <div class="w-full max-w-xs bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden transition-transform duration-300 hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
                            <img src="${fotoPath}" alt="${item.nama}" class="w-full h-40 object-cover" />
                            <div class="p-5 flex flex-col justify-between min-h-[200px]">
                                <div>
                                    <h5 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white tracking-tight line-clamp-2">
                                        ${item.nama}
                                    </h5>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Harga rata-rata:</p>
                                    <p class="text-base font-medium text-gray-700 dark:text-gray-300">
                                        Rp ${new Intl.NumberFormat('id-ID').format(item.rata_harga)}/${item.satuan}
                                    </p>
                                </div>
                                <a href="/info-harga/${item.id}"
                                   class="mt-4 text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline transition-colors duration-200">
                                   Baca selengkapnya
                                </a>
                            </div>
                        </div>
                    `;
                        });
                    });
            });
        </script>
    @endsection
