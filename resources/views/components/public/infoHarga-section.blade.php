  <section class="bg-gray-50 py-2 dark:bg-gray-900" style="font-family: 'Poppins', sans-serif;">
      <div class="my-8 h-px bg-gray-300 dark:bg-gray-600"></div>
      <div class=" dark:bg-gray-900 text-center my-4">
          <h1 class="text-2xl font-bold tracking-wide text-gray-800 dark:text-white inline-block relative">
              Info Harga Pasar
              <span class="block w-16 h-1 bg-red-500 mt-2 mx-auto rounded"></span>
          </h1>
          <p class="mt-2 text-gray-600 dark:text-gray-300 text-sm ">
              Daftar harga bahan pokok dan komoditas yang tersedia di pasar.
          </p>
      </div>

      <div class="relative max-w-6xl mx-auto  overflow-hidden  rounded">
          <!-- Tombol panah kiri -->
          <button id="prevBtn"
              class="absolute left-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/80 hover:bg-white shadow-md rounded-full">
              <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
              </svg>
          </button>

          <!-- Tombol panah kanan -->
          <button id="nextBtn"
              class="absolute right-0 top-1/2 -translate-y-1/2 z-10 p-2 bg-white/80 hover:bg-white shadow-md rounded-full">
              <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
              </svg>
          </button>

          <!-- Kontainer scroll -->
          <div class="p-4 mx-10">
              <div id="slider"
                  class="scrollbar-hide flex overflow-x-auto scroll-smooth whitespace-nowrap px-8 space-x-4">
                  @foreach ($rataHargaPerBarang as $data)
                      <div class="flex flex-wrap gap-4 justify-center">
                          <div
                              class="w-[250px] bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden transition-transform duration-300 hover:shadow-xl dark:bg-gray-800 dark:border-gray-700">
                              <img class="w-full h-40 object-cover"
                                  src="{{ asset('storage/' . ($data->foto ?? 'default.jpg')) }}"
                                  alt="{{ $data->nama_barang }}" />

                              <div class="p-5 flex flex-col justify-between min-h-[200px]">
                                  <div>
                                      <h5
                                          class="mb-2 text-lg font-semibold text-gray-900 dark:text-white line-clamp-2 tracking-tight">
                                          {{ $data->nama_barang }}
                                      </h5>
                                      <p class="text-sm text-gray-500 dark:text-gray-400">Harga rata-rata:</p>
                                      <p class="text-base font-medium text-gray-700 dark:text-gray-300">
                                          Rp {{ number_format($data->rata_harga, 0, ',', '.') }}/{{ $data->satuan }}
                                      </p>

                                  </div>
                                  <a href="{{ route('info-harga.show', $data->barang_id) }}"
                                      class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline transition-colors duration-200">
                                      Baca selengkapnya
                                  </a>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
          </div>

      </div>
  </section>
