@extends('layouts.public')

@section('content')
    <div class="bg-white dark:bg-gray-900 text-center my-4 mt-15 animate__animated animate__fadeInDown animate__slow">
        <h1 class="text-3xl font-bold tracking-wide text-gray-800 dark:text-white inline-block relative">
            Berita
            <span class="block w-16 h-1 bg-red-500 mt-2 mx-auto rounded"></span>
        </h1>
        <p class="w-[80%] mt-2 text-gray-600 dark:text-gray-300 text-sm mx-auto">
            Informasi Terkini dan Terpercaya dari Dinas Perdagangan Kota Semarang
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-4 gap-8">

        {{-- Berita Utama --}}
        <div class="lg:col-span-3">
            <div id="defaultBeritaList">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($semuaBerita as $berita)
                        <div class="bg-white rounded-xl shadow overflow-hidden flex flex-col h-full dark:bg-gray-800 dark:text-white opacity-0 animate__animated"
                            data-animate="animate__fadeInUp">
                            <a href="{{ route('berita.show', $berita->slug) }}">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-48 object-cover" onmouseover="this.classList.add('animate__pulse')"
                                    onmouseout="this.classList.remove('animate__pulse')">
                            </a>
                            <div class="p-4 flex-1 flex flex-col justify-between">
                                <div>
                                    <h2 class="text-lg font-bold mb-2 text-gray-900 dark:text-white">
                                        <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                    </h2>
                                    <p class="text-sm mb-3 text-gray-700 dark:text-gray-300">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 200) }}
                                    </p>
                                </div>
                                <div
                                    class="flex justify-between text-sm mt-auto pt-2 border-t text-gray-500 dark:text-gray-400">
                                    <span>{{ $berita->created_at->format('d M Y') }}</span>
                                    <span class="flex items-center gap-1">
                                        <x-public.icon-eye class="w-4 h-4" />
                                        {{ $berita->views()->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div
                                class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                                <x-public.no-data-img />
                                <p>Belum ada berita.</p>
                            </div>
                        </div>
                    @endforelse
                </div>


                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $semuaBerita->links() }}
                </div>
            </div>

            <div id="searchResults" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>


            <div class="flex justify-between items-center mt-6">
                <div id="showing" class="text-sm text-gray-600 dark:text-gray-300">
                    <!-- Showing 1 to 6 of 8 results -->
                </div>
                <nav id="pagination" aria-label="Page navigation example"></nav>
            </div>
        </div>


        {{-- Sidebar (Search + Berita Populer) --}}
        <div class="lg:col-span-1">

            {{-- Search --}}
            <input type="text" id="searchInput" placeholder="Cari berita..." class="border p-2 rounded w-full mb-6"
                autocomplete="off" />



            {{-- Berita Populer --}}
            <ul
                class="divide-y divide-gray-100 dark:divide-gray-700 border border-gray-200 rounded-md dark:border-gray-700 bg-white dark:bg-gray-800">
                <div class="p-4 bg-gray-100 dark:bg-gray-700 flex items-center">
                    <span class="inline-block h-5 border-l-4 border-red-600 mr-2 rounded-sm"></span>
                    <h2 class="text-sm font-bold text-gray-900 dark:text-white">Berita Populer</h2>
                </div>
                @foreach ($berita_populer as $berita)
                    <li class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-4 opacity-0 animate__animated"
                        data-animate="animate__fadeInUp">
                        <a href="{{ url('berita/' . $berita->slug) }}" class="flex space-x-4">
                            <div class="w-[120px] h-[80px] flex-shrink-0 bg-gray-200 rounded overflow-hidden">
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="thumbnail"
                                    class="w-[120px] h-[80px] object-cover" />
                            </div>

                            <div class="flex flex-col justify-between overflow-hidden">
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white leading-snug line-clamp-2">
                                    {{ $berita->judul }}
                                </h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100) }}
                                </p>
                                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-2">
                                    {{ $berita->created_at->format('d M Y') }} •
                                    {{ $berita->views()->count() }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>


    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');
        const defaultBeritaList = document.getElementById('defaultBeritaList');
        const showing = document.getElementById('showing');
        const pagination = document.getElementById('pagination');

        let currentPage = 1;
        let currentQuery = '';

        function renderPagination(data) {
            if (data.last_page <= 1) {
                pagination.innerHTML = ''; // hilangkan pagination jika hanya 1 halaman
                return;
            }

            let html = `<ul class="flex items-center -space-x-px h-8 text-sm">`;

            // tombol previous
            html += `<li>
      <a href="#" id="page-prev" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Previous</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
        </svg>
      </a>
    </li>`;

            // nomor halaman
            for (let page = 1; page <= data.last_page; page++) {
                html += `<li>
        <a href="#" data-page="${page}" class="flex items-center justify-center px-3 h-8 leading-tight
          ${page === data.current_page
            ? 'z-10 text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white'
            : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'}">
          ${page}
        </a>
      </li>`;
            }

            // tombol next
            html += `<li>
      <a href="#" id="page-next" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        <span class="sr-only">Next</span>
        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
        </svg>
      </a>
    </li>`;

            html += `</ul>`;
            pagination.innerHTML = html;

            // event listener previous
            const prevBtn = document.getElementById('page-prev');
            if (prevBtn) {
                prevBtn.addEventListener('click', e => {
                    e.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        fetchBerita(currentQuery, currentPage);
                    }
                });
            }

            // event listener next
            const nextBtn = document.getElementById('page-next');
            if (nextBtn) {
                nextBtn.addEventListener('click', e => {
                    e.preventDefault();
                    if (currentPage < data.last_page) {
                        currentPage++;
                        fetchBerita(currentQuery, currentPage);
                    }
                });
            }

            // event listener nomor halaman
            const pageLinks = pagination.querySelectorAll('a[data-page]');
            pageLinks.forEach(link => {
                link.addEventListener('click', e => {
                    e.preventDefault();
                    const page = Number(e.target.dataset.page);
                    if (page !== currentPage) {
                        currentPage = page;
                        fetchBerita(currentQuery, currentPage);
                    }
                });
            });
        }

        function fetchBerita(query, page = 1) {
            fetch(`/berita/search?query=${encodeURIComponent(query)}&page=${page}`)
                .then(res => res.json())
                .then(data => {
                    currentQuery = query;
                    currentPage = page;

                    if (!data.data.length) {
                        searchResults.className =
                            "flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400";


                        searchResults.innerHTML = `
        <x-public.no-data-img />
        <p>Berita tidak ditemukan.</p>
    `;
                        showing.textContent = '';
                        pagination.innerHTML = '';
                        return;
                    }


                    // Tampilkan hasil pencarian, 2 kolom grid
                    searchResults.className = "grid grid-cols-1 md:grid-cols-2 gap-6";
                    searchResults.innerHTML = '';
                    data.data.forEach(berita => {
                        searchResults.innerHTML += `
            <div class="bg-white rounded-xl shadow overflow-hidden flex flex-col h-full dark:bg-gray-800 dark:text-white">
              <a href="/berita/${berita.slug}">
              <img src="/storage/${berita.foto}" 
     class="w-full h-48 object-cover animate__animated" 
     onmouseover="this.classList.add('animate__pulse')" 
     onmouseout="this.classList.remove('animate__pulse')" 
     alt="${berita.judul}">

              </a>
              <div class="p-4 flex-1 flex flex-col justify-between dark:text-white">
                <div>
                  <h2 class="text-lg font-bold mb-2 dark:text-white">
                    <a href="/berita/${berita.slug}">${berita.judul}</a>
                  </h2>
                  <p class="text-sm mb-3 dark:text-gray-300">
                    ${berita.isi.replace(/(<([^>]+)>)/gi, "").substring(0, 200)}...
                  </p>
                </div>
                <div class="flex justify-between text-sm text-gray-500 mt-auto pt-2 border-t dark:text-gray-400">
                  <span>${new Date(berita.created_at).toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                  })}</span>
                  <span class="flex items-center gap-1">
                      <x-public.icon-eye class="w-4 h-4" />
                     ${berita.views_count ?? 0}
                  </span>
                </div>
              </div>
            </div>
          `;
                    });

                    searchResults.classList.remove('hidden');
                    defaultBeritaList.style.display = 'none';

                    // Update showing info (from, to, total)
                    const from = (data.current_page - 1) * data.per_page + 1;
                    const to = from + data.data.length - 1;
                    const total = data.total;
                    showing.textContent = `Showing ${from} to ${to} of ${total} results`;

                    // Render pagination
                    renderPagination(data);
                })
                .catch(() => {
                    searchResults.innerHTML =
                        `<p class="text-red-600 dark:text-red-400">Terjadi kesalahan saat pencarian.</p>`;
                    showing.textContent = '';
                    pagination.innerHTML = '';
                });
        }

        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            currentPage = 1;

            if (query.length === 0) {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
                defaultBeritaList.style.display = 'block';
                showing.textContent = '';
                pagination.innerHTML = '';
                return;
            }

            defaultBeritaList.style.display = 'none';
            searchResults.classList.remove('hidden');
            searchResults.innerHTML = '<p class="text-gray-600 dark:text-gray-400">Mencari berita...</p>';

            fetchBerita(query, currentPage);
        });
    </script>
@endsection
