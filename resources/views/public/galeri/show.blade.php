@extends('layouts.public')

@section('content')
    {{-- Hero Section dengan gambar dari kategori --}}
    <section class="bg-center  bg-no-repeat bg-cover bg-gray-700 bg-blend-multiply"
        style="background-image: url('{{ asset('storage/' . $kategori->foto) }}'); font-family: 'Poppins', sans-serif;">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-36">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                {{ $kategori->nama }}
            </h1>
        </div>
    </section>

    {{-- Gallery Masonry Style --}}
    <div class="p-4 mb-15" x-data="{ open: false, imgSrc: '', imgAlt: '' }">
        @if ($galeri->isNotEmpty())
            <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
                @foreach ($galeri as $item)
                    <div class="break-inside-avoid">
                        <img @click="open = true; imgSrc = `{{ asset('storage/' . $item->foto) }}`; imgAlt = `{{ $item->kategoriGaleri->nama }}`"
                            class="w-full rounded-lg cursor-pointer transition duration-300 ease-in-out hover:scale-105 shadow-md"
                            src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->kategoriGaleri->nama }}">
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-span-full">
                <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400">
                    <x-public.no-data-img />
                    <p>Belum ada foto.</p>
                </div>
            </div>
        @endif




        {{-- Modal Preview --}}
        <div x-show="open" x-transition class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
            style="display: none;" @click="open = false" @keydown.window.escape="open = false">

            <img :src="imgSrc" :alt="imgAlt" class="max-w-full max-h-[90vh] rounded-lg shadow-lg"
                @click.stop />

            <button @click.stop="open = false"
                class="absolute top-5 right-5 text-white text-3xl font-bold focus:outline-none"
                aria-label="Close">&times;</button>
        </div>


    </div>
@endsection
