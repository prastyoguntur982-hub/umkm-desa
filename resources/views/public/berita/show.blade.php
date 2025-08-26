@extends('layouts.public')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-7xl">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Konten Utama: foto hero + isi berita -->
            <div class="lg:col-span-2 flex flex-col space-y-8">

                {{-- Foto hero dengan judul --}}
                <section x-data="{ open: false }"
                    class="bg-center bg-no-repeat bg-cover bg-gray-800 bg-blend-multiply rounded-xl overflow-hidden h-96"
                    style="background-image: url('{{ asset('storage/' . $berita->foto) }}');" @click="open = true">
                    <div class="flex flex-col justify-center items-center h-full px-6 text-center bg-transparent">
                        <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-white drop-shadow-md">
                            {{ $berita->judul }}
                        </h1>
                        <p class="mt-2 text-md text-gray-200">
                            {{ $berita->created_at->translatedFormat('l, d F Y') }} —
                            <span class="font-semibold text-white">{{ $berita->views()->count() }} views</span>
                        </p>
                    </div>

                    <!-- Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50"
                        style="display: none;" @click="open = false" @keydown.window.escape="open = false">
                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                            class="max-w-full max-h-[90vh] rounded-lg shadow-lg" @click.stop />
                        <button @click.stop="open = false"
                            class="absolute top-5 right-5 text-white text-3xl font-bold focus:outline-none"
                            aria-label="Close">&times;</button>
                    </div>
                </section>


                {{-- Isi berita --}}
                <article class="prose lg:prose-xl dark:prose-invert text-gray-700 dark:text-gray-300 max-w-full">
                    <p
                        class="first-line:uppercase first-line:tracking-widest first-letter:text-6xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start">
                        {!! nl2br(e($berita->isi)) !!}
                    </p>
                </article>

                <div class="mb-10">
                    <a href="/berita" class="inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                        ← Kembali ke daftar
                    </a>
                </div>

            </div>

            <!-- Sidebar Berita Terbaru -->
            <div class="lg:col-span-1">

                {{-- Search --}}
                <input type="text" id="searchInput" placeholder="Cari berita..." class="border p-2 rounded w-full mb-6"
                    autocomplete="off" />

                {{-- Berita Populer --}}
                <ul
                    class="divide-y divide-gray-100 dark:divide-gray-700 border border-gray-200 rounded-md dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="p-4 bg-gray-100 dark:bg-gray-700 flex items-center">
                        <span class="inline-block h-5 border-l-4 border-red-600 mr-2 rounded-sm"></span>
                        <h2 class="text-sm font-bold text-gray-900 dark:text-white">Berita Lainnya</h2>
                    </div>
                    @foreach ($berita_terbaru as $berita)
                        <li class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-4 opacity-0 animate__animated"
                            data-animate="animate__fadeInUp">
                            <a href="{{ url('berita/' . $berita->slug) }}" class="flex space-x-4">
                                <div class="w-[120px] h-[80px] flex-shrink-0 bg-gray-200 rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="thumbnail"
                                        class="w-[120px] h-[80px] object-cover" />
                                </div>

                                <div class="flex flex-col justify-between overflow-hidden">
                                    <h3
                                        class="text-sm font-semibold text-gray-900 dark:text-white leading-snug line-clamp-2">
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
    </div>
@endsection
