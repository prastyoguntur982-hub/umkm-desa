  {{-- <section class="bg-center bg-no-repeat bg-cover bg-gray-700 bg-blend-multiply"
        style="background-image: url('{{ asset('storage/' . $pasar->foto) }}');">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24">
            <h1 class="mb-4 text-5xl font-extrabold tracking-tight leading-none text-white lg:text-6xl">
                {{ strtoupper($pasar->nama) }}
            </h1>
        </div>
    </section> --}}




  @extends('layouts.public')

  @section('content')
      <section class="relative bg-center bg-no-repeat bg-cover bg-gray-900 bg-blend-overlay"
          style="background-image: url('{{ asset('storage/' . $pasar->foto) }}'); min-height: 420px;">
          <div class="absolute inset-0 bg-transparant bg-opacity-60" aria-hidden="true"></div>
          <div class="px-4 mx-auto max-w-screen-xl text-center py-24">
              <h1
                  class="text-white font-extrabold tracking-wide leading-tight text-4xl sm:text-5xl md:text-6xl drop-shadow-lg uppercase">
                  Pasar {{ $pasar->nama }}
              </h1>
          </div>
      </section>


      <div class="mx-auto mt-10 mb-16 px-4 max-w-[80%]" style="font-family: 'Poppins', sans-serif;">
          <!-- Tabel Kategori & Item -->
          @foreach ($groupedItems as $kategori => $items)
              <section class="mb-10">
                  <h2
                      class="mb-4 text-2xl font-semibold text-gray-800 dark:text-gray-100 border-b-2 border-red-600 inline-block pb-1">
                      {{ ucfirst($kategori) }}
                  </h2>
                  <table
                      class="w-full text-left text-gray-700 dark:text-gray-300 rounded-lg shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 transition duration-300">
                      <thead class="bg-red-100 dark:bg-red-900">
                          <tr>
                              <th class="px-6 py-3 font-medium text-cen">Keterangan</th>
                              <th class="px-6 py-3 font-medium text-center">Deskripsi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($items as $item)
                              <tr
                                  class="bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-700 transition-colors cursor-default border-b border-gray-200 dark:border-gray-700">
                                  <td class="px-6 py-4 whitespace-normal">{{ $item->keterangan }}</td>
                                  <td class="whitespace-normal">
                                      @php
                                          $deskripsi = $item->deskripsi ?? '';
                                          $deskripsi = str_replace(['<br>', '<br/>', '<br />'], "\n", $deskripsi);
                                          $lines = preg_split('/\r\n|\r|\n/', $deskripsi);

                                          // Closure untuk cek level indentasi
                                          $getLevel = function ($line) {
                                              $line = trim($line);

                                              if (preg_match('/^\d+\./', $line)) {
                                                  return 0; // 1.
                                              }
                                              if (preg_match('/^[a-z]\./', $line)) {
                                                  return 1; // a.
                                              }
                                              if (preg_match('/^[A-Z]\./', $line)) {
                                                  return 1; // A.
                                              }
                                              if (preg_match('/^[ivxlcdm]+\./i', $line)) {
                                                  return 2; // i. (angka romawi)
                                              }
                                              if (preg_match('/^[-•]/', $line)) {
                                                  return 3; // bullet atau dash
                                              }

                                              return 0; // default
                                          };

                                          // Closure untuk parsing list bertingkat
                                          $parseList = function ($lines) use (&$getLevel) {
                                              $result = [];
                                              $stack = [['children' => &$result, 'level' => -1]];

                                              foreach ($lines as $line) {
                                                  $line = trim($line);
                                                  if ($line === '') {
                                                      continue;
                                                  }

                                                  $level = $getLevel($line);

                                                  while (
                                                      !empty($stack) &&
                                                      $stack[count($stack) - 1]['level'] >= $level
                                                  ) {
                                                      array_pop($stack);
                                                  }

                                                  $parent = &$stack[count($stack) - 1]['children'];
                                                  $item = ['text' => $line, 'children' => []];
                                                  $parent[] = $item;

                                                  $stack[] = [
                                                      'children' => &$parent[count($parent) - 1]['children'],
                                                      'level' => $level,
                                                  ];
                                              }

                                              return $result;
                                          };

                                          // Closure untuk render list rekursif
                                          $renderList = function ($list, $level = 0) use (&$renderList) {
                                              $html = '';
                                              foreach ($list as $item) {
                                                  $margin = $level * 20;
                                                  $html .=
                                                      '<p style="margin-left:' .
                                                      $margin .
                                                      'px">' .
                                                      e($item['text']) .
                                                      '</p>';
                                                  if (!empty($item['children'])) {
                                                      $html .= $renderList($item['children'], $level + 1);
                                                  }
                                              }
                                              return $html;
                                          };

                                          $nestedList = $parseList($lines);
                                      @endphp


                                      <div class="p-6 flex flex-col items-center text-center space-y-4">
                                          @if (!empty(trim($deskripsi)))
                                              <div class="text-sm text-gray-800 dark:text-gray-200 text-left space-y-5">
                                                  {!! $renderList($nestedList) !!}
                                              </div>
                                          @else
                                              <p class="text-sm text-gray-800 dark:text-gray-200">
                                                  Deskripsi belum tersedia.
                                              </p>
                                          @endif
                                      </div>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </section>
          @endforeach

          <!-- Search Dokumen Kelengkapan -->
          <section class="mb-8">
              <label for="search-dokumen" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Cari
                  Dokumen:</label>
              <input id="search-dokumen" type="search" placeholder="Masukkan kata kunci pencarian..."
                  class="w-full px-5 py-3 border border-gray-300 rounded-lg text-gray-900 dark:bg-gray-900 dark:text-white dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-red-600 transition" />
          </section>

          <!-- Daftar Dokumen Kelengkapan -->
          <section id="dokumen-list" class="space-y-6">
              @forelse ($dokumens as $dokumen)
                  <article
                      class="flex flex-col sm:flex-row bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                      <div
                          class="flex items-center justify-center bg-red-100 dark:bg-red-700 text-gray-700 dark:text-white font-semibold px-6 py-10 rounded-t-lg sm:rounded-t-none sm:rounded-l-lg w-full sm:w-32 text-center">
                          Dokumen
                      </div>
                      <div class="p-6 flex flex-col justify-between flex-grow">
                          <div>
                              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $dokumen->judul }}
                              </h3>
                              <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 leading-relaxed break-words">
                                  {{ $dokumen->deskripsi }}
                              </p>

                          </div>

                          <a href="{{ route('dokumen-pasar.unduh', $dokumen->id) }}"
                              class="inline-flex items-center space-x-4 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-600 font-semibold transition">
                              <i class="fas fa-download mr-2"></i>
                              Unduh
                          </a>
                      </div>
                  </article>
              @empty
                  <div class="col-span-full">
                      <div
                          class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                          <x-public.no-data-img />
                          <p>Data belum tersedia.</p>
                      </div>
                  </div>
              @endforelse

              {{-- Pagination --}}
              <div>
                  {{ $dokumens->links() }}
              </div>
          </section>
      </div>

      <!-- Script untuk search dokumen di client-side -->
      <script>
          document.getElementById('search-dokumen').addEventListener('input', function() {
              const query = this.value.toLowerCase();
              const dokumenList = document.getElementById('dokumen-list');
              const dokumenItems = dokumenList.querySelectorAll('article');

              dokumenItems.forEach(item => {
                  const judul = item.querySelector('h3').textContent.toLowerCase();
                  const deskripsi = item.querySelector('p').textContent.toLowerCase();

                  if (judul.includes(query) || deskripsi.includes(query)) {
                      item.style.display = '';
                  } else {
                      item.style.display = 'none';
                  }
              });
          });
      </script>
  @endsection
