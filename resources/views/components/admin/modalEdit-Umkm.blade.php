<!-- Modal Edit UMKM -->
<div id="editUmkmModal-{{ $umkm->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto h-[100vh] bg-black/50 flex items-center justify-center">

    <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-xl font-semibold">Edit UMKM</h3>
            <button type="button" data-modal-hide="editUmkmModal-{{ $umkm->id }}"
                class="text-gray-400 hover:text-gray-600">&times;</button>

        </div>
        <div class="p-6">
            <form id="updateUmkmForm-{{ $umkm->id }}" action="{{ route('admin.umkms.update', $umkm->id) }}"
                method="POST" enctype="multipart/form-data" class="p-4 md:p-5">

                @csrf
                @method('PUT')

                <div class="grid gap-4 mb-4 grid-cols-2">
                    {{-- Nama Produk (full width) --}}
                    <div class="col-span-2">
                        <label for="nama_produk" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Produk</label>
                        <input type="text" name="nama_produk" id="nama_produk" value="{{ $umkm->nama_produk }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="Nama produk" required>
                    </div>

                    {{-- Nama Pemilik --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="nama_pemilik" class="block mb-2 text-sm font-medium text-gray-900">Nama
                            Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ $umkm->nama_pemilik }}"
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
                                <option value="{{ $category }}"
                                    {{ $umkm->kategori === $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Lokasi --}}
                    <div class="col-span-2 sm:col-span-1" x-data="{ openHelp: false }">
                        <label for="lokasi"
                            class="block mb-2 text-sm font-medium text-gray-900 flex items-center gap-2">
                            Lokasi
                            <!-- Icon Bantuan -->
                            <button type="button" @click="openHelp = true" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-question-circle"></i>
                            </button>
                        </label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ $umkm->lokasi }}"
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
                    @php
                        // Ambil nomor dari database, hapus '62' di awal
                        $waNumber = $umkm->link_wa ? preg_replace('/^62/', '', $umkm->link_wa) : '';
                    @endphp

                    <div class="col-span-2 sm:col-span-1">
                        <label for="link_wa" class="block mb-2 text-sm font-medium text-gray-900">Link WhatsApp</label>
                        <div class="flex">
                            <!-- Prefix +62 -->
                            <span
                                class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-800 text-white text-sm">
                                +62
                            </span>
                            <!-- Nomor WA -->
                            <input type="tel" id="wa_input" name="link_wa"
                                class="flex-1 bg-gray-50 border border-gray-300 border-l-0 text-gray-900 text-sm rounded-r-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                placeholder="8xxxxxxxxxx" value="{{ $waNumber }}" required>
                        </div>
                    </div>




                    {{-- Link Shopee --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="link_shopee" class="block mb-2 text-sm font-medium text-gray-900">Link
                            Shopee</label>
                        <input type="url" name="link_shopee" id="link_shopee" value="{{ $umkm->link_shopee }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="https://shopee.co.id/...">
                    </div>

                    {{-- Link Tokopedia --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="link_tokopedia" class="block mb-2 text-sm font-medium text-gray-900">Link
                            Tokopedia</label>
                        <input type="url" name="link_tokopedia" id="link_tokopedia"
                            value="{{ $umkm->link_tokopedia }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="https://tokopedia.com/...">
                    </div>

                    {{-- Link Tiktok --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="link_tiktok" class="block mb-2 text-sm font-medium text-gray-900">Link
                            TikTok</label>
                        <input type="url" name="link_tiktok" id="link_tiktok" value="{{ $umkm->link_tiktok }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            placeholder="https://tiktokshop.com/...">
                    </div>

                    {{-- Deskripsi (full width) --}}
                    <div class="col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-600 focus:border-blue-600"
                            placeholder="Tuliskan deskripsi produk...">{{ $umkm->deskripsi }}</textarea>
                    </div>

                    {{-- Foto Primary --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="primary_photo" class="block mb-2 text-sm font-medium text-gray-900">Foto
                            Utama</label>
                        <input type="file" name="primary_photo" id="primary_photo"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            accept="image/*">
                        @if ($umkm->primary_photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $umkm->primary_photo) }}" alt="Foto Utama"
                                    class="h-28 rounded-md border">
                            </div>
                        @endif
                    </div>

                    {{-- Foto Tambahan --}}
                    <div class="col-span-2 sm:col-span-1">
                        <label for="photos" class="block mb-2 text-sm font-medium text-gray-900">Foto
                            Tambahan</label>
                        <input type="file" name="photos[]" id="photos"
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            accept="image/*" multiple>

                        @if ($umkm->photos && $umkm->photos->count())
                            <div class="flex gap-2 mt-2 flex-wrap">
                                @foreach ($umkm->photos as $photo)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $photo->photo) }}" alt="Foto Tambahan"
                                            class="h-20 w-20 object-cover rounded-md border">
                                        <!-- Tombol hapus selalu muncul -->
                                        <button type="button"
                                            class="absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center"
                                            onclick="removeOldPhoto({{ $photo->id }}, this)">
                                            &times;
                                        </button>
                                        <input type="hidden" name="existing_photos[]" value="{{ $photo->id }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
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
                    Update UMKM
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let removedPhotos = [];

    function removeOldPhoto(photoId, btn) {
        removedPhotos.push(photoId);
        btn.parentElement.remove();
    }

    // Gunakan ID form yang spesifik
    document.getElementById('updateUmkmForm-{{ $umkm->id }}').addEventListener('submit', function(e) {
        removedPhotos.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'removed_photos[]';
            input.value = id;
            this.appendChild(input);
        });
    });
</script>
