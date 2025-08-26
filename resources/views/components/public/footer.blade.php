<footer
    class="bg-gradient-to-r from-white to-gray-100 dark:from-gray-800 dark:to-gray-700 shadow-5xl hover:shadow-xl transition-all border-t dark:border-gray-600">
    <div class="max-w-screen-xl mx-auto px-4 pt-16 pb-12">
        <!-- Konten Utama Footer -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12">
            <!-- Logo & Deskripsi -->
            <div class="lg:col-span-1">
                <a href="#" class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('logo/logo.png') }}" class="h-12 w-auto" alt="Logo Kota Semarang">
                    <div class="flex flex-col text-gray-800 dark:text-white">
                        <span class="text-lg font-semibold">Tirtomulyo</span>
                        <span class="text-[11px] font-thin">Kec.Plantungan, Kab.Kendal</span>
                    </div>
                </a>
                <p class="text-sm text-gray-800 dark:text-gray-300">
                    Tirtomulyo adalah desa di kecamatan Plantungan, Kendal, Jawa Tengah, Indonesia. Desa Tirtomulyo
                    merupakan ibu kota Kecamatan Plantungan.
                </p>
            </div>

            <!-- Kontak Kami & Tautan Terkait Disatukan -->
            <div class="lg:col-span-2">
                <div class="flex flex-col sm:flex-row sm:space-x-8 space-y-8 sm:space-y-0">
                    <!-- Kontak Kami -->
                    <div class="flex-1">
                        <h2 class="mb-5 text-sm font-semibold text-gray-800 uppercase dark:text-white">Kontak Kami</h2>
                        <ul class="text-gray-800 dark:text-gray-300 text-sm space-y-3">
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt w-5 h-5 mr-2"></i>
                                <a href="tel:0243547888" class="hover:underline">024 354 7888</a>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-fax w-5 h-5 mr-2"></i>
                                <a href="fax:3544303" class="hover:underline">3544303</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tautan Terkait -->
                    <div class="flex-1">
                        <h2 class="mb-5 text-sm font-semibold text-gray-800 uppercase dark:text-white">Tautan Terkait
                        </h2>
                        <div class="flex flex-col space-y-6">
                            <a href="https://kendalkab.go.id" target="_blank"
                                class="flex items-center space-x-3 hover:opacity-80 transition">
                                <img src="{{ asset('logo/logoLapor.png') }}" alt="Pemkab Kendal"
                                    class="h-10 w-10 object-contain" />
                                <span class="text-sm text-gray-800 dark:text-gray-300">Lapor GO ID</span>
                            </a>
                            <a href="https://dokar.kendalkab.go.id" target="_blank"
                                class="flex items-center space-x-3 hover:opacity-80 transition">
                                <img src="{{ asset('logo/logo.png') }}" alt="Dokar Kendal"
                                    class="h-10 w-10 object-contain" />
                                <span class="text-sm text-gray-800 dark:text-gray-300">KendalKab</span>
                            </a>
                            <a href="https://jatengprov.go.id" target="_blank"
                                class="flex items-center space-x-3 hover:opacity-80 transition">
                                <img src="{{ asset('logo/kominfo.png') }}" alt="Pemprov Jateng"
                                    class="h-10 w-10 object-contain" />
                                <span class="text-sm text-gray-800 dark:text-gray-300">Diskominfo Kendal</span>
                            </a>
                            <a href="https://kemendagri.go.id" target="_blank"
                                class="flex items-center space-x-3 hover:opacity-80 transition">
                                <img src="{{ asset('logo/logo.png') }}" alt="Kemendagri"
                                    class="h-10 w-10 object-contain" />
                                <span class="text-sm text-gray-800 dark:text-gray-300">JDIH Kendal</span>
                            </a>
                            <a href="https://kemendagri.go.id" target="_blank"
                                class="flex items-center space-x-3 hover:opacity-80 transition">
                                <img src="{{ asset('logo/logo.png') }}" alt="Kemendagri"
                                    class="h-10 w-10 object-contain" />
                                <span class="text-sm text-gray-800 dark:text-gray-300">Plantungan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lokasi -->
            <div class="lg:col-span-2">
                <h2 class="mb-5 text-sm font-semibold text-gray-800 uppercase dark:text-white">Lokasi</h2>
                <div class="rounded-lg overflow-hidden shadow-md">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15836.982602013819!2d109.95246945385854!3d-7.097501043805209!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e706cbf8b4ce769%3A0x5027a76e356e530!2sTirtomulyo%2C%20Kec.%20Plantungan%2C%20Kabupaten%20Kendal%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1752057405769!5m2!1sid!2sid"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

        <hr class="my-10 border-gray-300 dark:border-gray-700" />

        <!-- Footer Bawah -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-gray-800 dark:text-gray-300 space-y-4 sm:space-y-0">
            <span class="text-sm">© 2025 Desa Tirtomulyo. All Rights Reserved.</span>
            <div class="flex space-x-5">
                <a href="#" class="text-gray-800 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-gray-800 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>
    </div>
</footer>
