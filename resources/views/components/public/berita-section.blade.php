<!-- Berita -->
<div class="bg-gradient-to-bl from-yellow-0 to-yellow-50 dark:from-gray-800 dark:to-gray-900 animate__animated animate__fadeIn">
    <div class="mx-auto px-4 md:px-6 max-w-7xl">
        <div class="flex flex-row flex-wrap">
            <!-- Berita Terbaru -->
            <div
                class="flex-shrink max-w-full w-full lg:w-2/3 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s">
                <div class="w-full py-3" style="font-family: 'Poppins', sans-serif;">
                    <h2 class="text-gray-800 text-2xl font-bold dark:text-white" >
                        <span class="inline-block h-5 border-l-4 border-yellow-600 mr-2 rounded-sm"></span>Berita Terbaru
                    </h2>
                </div>
                <div class="flex flex-row flex-wrap -mx-3">
                    <!-- Berita Terbaru atas -->
                    @if (!empty($berita_pertama))
                        <div
                            class=" flex-shrink max-w-full w-full px-3 pb-5 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="bg-gray-50 relative hover-img max-h-112 overflow-hidden rounded-xl">
                                <a href="{{ route('berita.show', $berita_pertama->slug) }}">
                                    <img class="w-full h-full object-cover rounded-xl bg-black"
                                        src="{{ asset('storage/' . $berita_pertama->foto) }}"
                                        alt="{{ $berita_pertama->judul }}">
                                </a>
                                <div
                                    class="absolute px-5 pt-8 pb-5 bottom-0 w-full bg-gradient-to-t from-black/80 to-transparent rounded-b-xl">
                                    <a href="{{ route('berita.show', $berita_pertama->slug) }}">
                                        <h2
                                            class="text-xl sm:text-3xl font-bold capitalize text-white mb-1.5 line-clamp-2">
                                            {{ $berita_pertama->judul }}
                                        </h2>
                                    </a>
                                    <p class="text-gray-100 line-clamp-2 w-full">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita_pertama->isi), 200) }}
                                    </p>
                                    <div class="pt-2 text-gray-300 text-sm flex flex-wrap items-center gap-3 mt-2">
                                        <div class="inline-block h-3 border-l-2 border-yellow-600 mr-2"></div>
                                        {{ $berita_pertama->created_at->format('d M Y') }}
                                        <span class="flex items-center gap-1">
                                            <x-public.icon-eye class="w-4 h-4" />
                                            {{ $berita_pertama->views()->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full px-3 pb-5 animate__animated animate__fadeInUp animate__delay-2s">
                            <div
                                class="bg-gray-100 text-center text-gray-600 dark:bg-gray-800 dark:text-gray-300 py-10 rounded-xl">
                                <p class="text-lg font-semibold">Belum ada berita utama yang tersedia.</p>
                            </div>
                        </div>
                    @endif

                    <!-- Berita Lainnya -->
                    @forelse ($berita_lainnya as $index => $berita)
                        <div
                            class="flex-shrink max-w-full w-full sm:w-1/3 px-3 pb-3 pt-5 sm:pt-0 animate__animated animate__fadeInUp animate__delay-{{ $index + 1 }}s">
                            <div
                                class="h-[350px] overflow-hidden rounded-xl bg-gray-50 dark:bg-gray-800 relative flex flex-col">
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                    class="block h-1/2 w-full overflow-hidden bg-black">
                                    <img class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}">
                                </a>
                                <div class="flex-1 flex flex-col justify-between py-3 px-3 dark:text-white">
                                    <div>
                                        <h3 class="text-lg font-bold leading-tight mb-2 line-clamp-2">
                                            <a
                                                href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-300 leading-tight mb-2 line-clamp-6">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 200) }}
                                        </p>
                                    </div>
                                    <div class="flex gap-3 text-gray-600 dark:text-white text-sm mt-3">
                                        <div class="flex items-center gap-1">
                                            <span class="h-3 border-l-2 border-yellow-600 mr-1"></span>
                                            {{ $berita->created_at->format('d M Y') }}
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <x-public.icon-eye class="w-4 h-4" />
                                            {{ $berita->views()->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full px-3 pt-3 animate__animated animate__fadeInUp animate__delay-2s">
                            <div
                                class="bg-gray-100 text-center text-gray-600 dark:bg-gray-800 dark:text-gray-300 py-6 rounded-xl">
                                <p class="text-md">Belum ada berita lainnya yang tersedia.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Tombol Lihat Lainnya -->
                <div class="flex justify-center mt-6 mb-10 animate__animated animate__fadeInUp animate__delay-3s">
                    <a href="/berita"
                        class="inline-flex items-center px-6 py-2 text-sm font-semibold text-white bg-yellow-600 hover:bg-yellow-700 rounded-xl transition">
                        Lihat Berita Lainnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Berita Populer -->
            <div
                class="flex-shrink max-w-full w-full lg:w-1/3 lg:pl-8 lg:pt-14 lg:pb-8 order-first lg:order-last animate__animated animate__fadeInUp animate__delay-2s">
                <div class="w-full bg-white dark:bg-gray-800 rounded-xl overflow-hidden">
                    <div class="mb-6">
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 flex items-center" style="font-family: 'Poppins', sans-serif;">
                            <span class="inline-block h-5 border-l-4 border-yellow-600 mr-2 rounded-sm"></span>
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white">Berita Populer</h2>
                        </div>
                        <div class="overflow-hidden relative h-72 sm:h-90">
                            <ul id="scrolling-list" class="post-number dark:text-white space-y-2">
                                @foreach ($berita_populer as $berita)
                                    <li
                                        class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-4">
                                        <a href="{{ url('berita/' . $berita->slug) }}" class="flex space-x-4">
                                            <div
                                                class="w-[120px] h-[80px] flex-shrink-0 bg-gray-200 rounded overflow-hidden">
                                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="thumbnail"
                                                    class="w-[120px] h-[80px] object-cover" />
                                            </div>


                                            <div class="flex flex-col justify-between overflow-hidden">
                                                <h3
                                                    class="text-sm font-semibold text-gray-900 dark:text-white leading-snug line-clamp-2">
                                                    {{ $berita->judul }}
                                                </h3>
                                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 line-clamp-2">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 200) }}
                                                </p>
                                                <div class="text-[11px] text-gray-500 dark:text-gray-400 mt-2">
                                                    {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }} •
                                                    {{ $berita->views()->count() }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Agenda -->
                @include('components.public.agenda-section')
            </div>
        </div>
    </div>
</div>
