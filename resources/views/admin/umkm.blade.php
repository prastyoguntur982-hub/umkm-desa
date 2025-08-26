{{-- resources/views/admin/umkm.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Tombol Tambah --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold dark:text-white">Daftar UMKM</h2>
            <button data-modal-target="tambahUmkmModal" data-modal-toggle="tambahUmkmModal"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + Tambah UMKM
            </button>
        </div>

        {{-- Card UMKM --}}
        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-6">
            @foreach ($umkms as $umkm)
                <!-- Card UMKM -->
                <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-md p-4 transition hover:shadow-xl flex flex-col">

                    <!-- Nama Produk -->
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">{{ $umkm->nama_produk }}</h3>

                    <!-- Pemilik -->
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mt-1">
                        <i class="fas fa-user text-yellow-500 mr-2"></i>
                        <span>{{ $umkm->nama_pemilik }}</span>
                    </div>

                    <!-- Gambar Produk -->
                    <div class="relative my-4">
                        <img src="{{ asset('storage/' . $umkm->primary_photo) }}" alt="{{ $umkm->nama_produk }}"
                            class="rounded-xl w-full object-cover h-48 cursor-pointer">
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-sm text-gray-600 dark:text-gray-400 flex-grow">
                        {{ Str::limit($umkm->deskripsi, 100) }}
                    </p>

                    <!-- Tombol Aksi -->
                    <div class="flex gap-2 mt-4">
                        <button data-modal-target="editUmkmModal-{{ $umkm->id }}"
                            data-modal-toggle="editUmkmModal-{{ $umkm->id }}"
                            class="bg-yellow-500 text-white px-3 py-1.5 rounded-lg hover:bg-yellow-600 transition text-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </button>

                        @include('components.admin.modalEdit-Umkm')
                        {{-- Tombol Hapus --}}
                        <button onclick="deleteForm('{{ route('admin.umkms.destroy', $umkm->id) }}')"
                            class=" bg-red-600 text-white px-3 py-1.5 rounded-lg hover:bg-red-700 transition text-sm text-center">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>

                        {{-- Modal Hapus --}}
                        @include('components.admin.modal-hapus')

                    </div>
                </div>
                <!-- /Card UMKM -->
            @endforeach
        </div>

    </div>

    {{-- Modal Tambah UMKM --}}
    <div id="tambahUmkmModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[100vh] bg-black/50 flex items-center justify-center">

        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-semibold">Tambah UMKM</h3>
                <button type="button" data-modal-hide="tambahUmkmModal"
                    class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.umkms.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-4 md:p-5">
                    @csrf

                    <div class="grid gap-4 mb-4 grid-cols-2">
                        {{-- Nama Produk (full width) --}}
                        <div class="col-span-2">
                            <label for="nama_produk" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Nama produk" required>
                        </div>

                        {{-- Nama Pemilik --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900">Nama
                                Pemilik</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Nama pemilik" required>
                        </div>

                        {{-- Kategori --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="kategori" class="block mb-2 text-sm font-medium text-gray-900">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                required>
                                @php
                                    $categories = ['makanan', 'minuman', 'jasa', 'lainnya'];
                                @endphp
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Lokasi --}}
                        <!-- Bungkus label + input + modal di dalam satu x-data -->
                        <div class="col-span-2 sm:col-span-1" x-data="{ openHelp: false }">
                            <label for="lokasi"
                                class="block mb-2 text-sm font-medium text-gray-900 flex items-center gap-2">
                                Lokasi
                                <!-- Icon Bantuan -->
                                <button type="button" @click="openHelp = true" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-question-circle"></i>
                                </button>
                            </label>
                            <input type="text" name="lokasi" id="lokasi"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
           focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="Masukkan Embed Link Google Maps" required>

                            <!-- Modal Bantuan -->
                            <template x-if="openHelp">
                                <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                    <div class="bg-white rounded-xl shadow-lg p-6 w-96 relative">
                                        <button @click="openHelp = false"
                                            class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
                                            ✖
                                        </button>
                                        <h2 class="text-lg font-semibold mb-3">Cara Menambahkan Embed Link Google Maps</h2>
                                        <ol class="list-decimal list-inside text-sm text-gray-700 space-y-2">
                                            <li>Buka Google Maps dan cari lokasi UMKM.</li>
                                            <li>Klik tombol <b>Bagikan</b>.</li>
                                            <li>Pilih tab <b>Sematkan peta</b>.</li>
                                            <li>Salin <b>Embed Link</b> yang muncul.</li>
                                            <li>Tempelkan link tersebut di kolom <b>Lokasi</b>.</li>
                                        </ol>
                                        <div class="mt-3">
                                            <img src="{{ asset('img/bg.jpg') }}" alt="Contoh Embed Maps"
                                                class="rounded-md border">
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>


                        {{-- Link Whatsapp --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="link_wa" class="block mb-2 text-sm font-medium text-gray-900">Link WhatsApp</label>
                            <input type="url" name="link_wa" id="link_wa"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="https://wa.me/628xxxxxx">
                        </div>

                        {{-- Link Shopee --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="link_shopee" class="block mb-2 text-sm font-medium text-gray-900">Link
                                Shopee</label>
                            <input type="url" name="link_shopee" id="link_shopee"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="https://shopee.co.id/...">
                        </div>

                        {{-- Link Tokopedia --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="link_tokopedia" class="block mb-2 text-sm font-medium text-gray-900">Link
                                Tokopedia</label>
                            <input type="url" name="link_tokopedia" id="link_tokopedia"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="https://tokopedia.com/...">
                        </div>

                        {{-- Link Tiktok --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="link_tiktok" class="block mb-2 text-sm font-medium text-gray-900">Link
                                TikTok</label>
                            <input type="url" name="link_tiktok" id="link_tiktok"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="https://tiktokshop.com/...">
                        </div>

                        {{-- Deskripsi (full width) --}}
                        <div class="col-span-2">
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-600"
                                placeholder="Tuliskan deskripsi produk..."></textarea>
                        </div>

                        {{-- Foto Primary --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="primary_photo" class="block mb-2 text-sm font-medium text-gray-900">Foto
                                Utama</label>
                            <input type="file" name="primary_photo" id="primary_photo"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                accept="image/*" required>
                        </div>

                        {{-- Foto Tambahan --}}
                        <div class="col-span-2 sm:col-span-1">
                            <label for="photos" class="block mb-2 text-sm font-medium text-gray-900">Foto
                                Tambahan</label>
                            <input type="file" name="photos[]" id="photos"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                accept="image/*" multiple>
                        </div>
                    </div>

                    {{-- Tombol --}}
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Simpan UMKM
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
