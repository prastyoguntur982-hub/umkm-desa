<nav
    class="sticky top-0 z-50 bg-gray-50 md:bg-whites shadow-lg border-b border-gray-200 dark:border-gray-800 dark:bg-gray-800 p-2">

    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-6 py-5">

        <!-- LOGO -->
        <a href="/" id="logo-scroll"
            class="hidden items-center space-x-2 pr-4 md:pr-12  transition-all duration-300">
            <div class="flex items-center space-x-3 rtl:space-x-reverse w-full max-w-sm">
                <img src="{{ asset('logo/logo.png') }}" class="h-7 sm:h-10 w-auto" alt="Logo Kota Semarang">
                <div class="font-[Poppins] text-gray-700 dark:text-white flex-col md:flex md:flex-col md:space-y-0.5">

                    <!-- Tampilkan di mobile (<md) & desktop (lg+): 2 baris -->
                    <span class="block md:hidden lg:block text-sm">Tirtomulyo</span>
                    <span class="block md:hidden lg:block text-[10px] font-thin">Kec.Plantungan, Kab.Kendal</span>
                </div>
            </div>
        </a>

        <button data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
            aria-controls="drawer-navigation"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- drawer component -->
        <div id="drawer-navigation"
            class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800"
            tabindex="-1" aria-labelledby="drawer-navigation-label">
            <!-- LOGO -->
            <div class="flex items-center space-x-3 rtl:space-x-reverse mb-2">
                <a href="{{ route('landing.home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('logo/logo.png') }}" class="h-7 sm:h-10 w-auto" alt="Logo Kendal">
                    <div
                        class="font-[Poppins] text-gray-700 dark:text-white flex-col md:flex md:flex-col md:space-y-0.5">
                        <span class="block md:hidden lg:block text-sm">Tirtomulyo</span>
                        <span class="block md:hidden lg:block text-[10px] font-thin">Kec.Plantungan, Kab.Kendal</span>
                    </div>
                    <!-- <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span> -->
                </a>
            </div>
            <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <div class="py-4 overflow-y-auto">
                <ul class="space-y-2 font-medium md:text-sm lg:text-base">

                    <!-- Beranda -->
                    <li>
                        <a href="{{ route('landing.home') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <!-- Icon Home -->
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 
                group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 1.293a1 1 0 00-1.414 0l-7 7A1 1 0 003 9h1v8a1 1 0
                       001 1h4v-5h2v5h4a1 1 0
                       001-1V9h1a1 1 0 00.707-1.707l-7-7z" />
                            </svg>
                            <span class="ms-3">Beranda</span>
                        </a>
                    </li>

                    <!-- Profil Desa -->
                    {{-- <li>
                        <a href="#profil-desa"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white 
                   hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <!-- Icon Map -->
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 
                group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.5 2.134a1 1 0 01.894 0l5.618 2.81a1 1 0 01.553.894v10.226a1 1 0
                         01-1.447.894L10 14.618l-5.118 2.34A1 1 0
                         013.5 16.064V5.838a1 1 0 01.553-.894L9.5 2.134z" clip-rule="evenodd" />
                            </svg>
                            <span class="ms-3">Profil Desa</span>
                        </a>
                    </li> --}}

                    <!-- UMKM Desa -->
                    <li>
                        <a href="#umkm"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white 
                   hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <!-- Icon Store / Shopping Bag -->
                            <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 
                group-hover:text-gray-900 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v2H3.5A1.5 1.5 0
                         002 6.5v10A1.5 1.5 0 003.5 18h13a1.5 1.5 0
                         001.5-1.5v-10A1.5 1.5 0 0016.5 5H15V3a1 1 0
                         00-1-1h-2a1 1 0 00-1 1v2H9V3a1 1 0
                         00-1-1H6zm0 6a1 1 0 012 0h4a1 1 0 112 0h1.5v8h-13v-8H6z" clip-rule="evenodd" />
                            </svg>
                            <span class="ms-3">UMKM Desa</span>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

        <div id="mega-menu-full"
            class="items-center justify-between font-medium hidden w-full md:flex md:w-auto md:order-1">
            <ul x-data="{ active: 'home' }" x-init="window.addEventListener('scroll', () => {
                let homeTop = 0;
                let profilTop = document.querySelector('#profil-desa').offsetTop - 100;
                let umkmTop = document.querySelector('#umkm').offsetTop - 100;
            
                {{-- if (window.scrollY >= umkmTop) {
                    active = 'umkm';
                } else if (window.scrollY >= profilTop) {
                    active = 'profil-desa';
                } else {
                    active = 'home';
                } --}}
            
                if (window.scrollY >= umkmTop) {
                    active = 'umkm';
                } else {
                    active = 'home';
                }
            });"
                class="flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
           bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 
           md:border-0 dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">

                <li>
                    <a href="{{ route('landing.home') }}"
                        :class="active === 'home'
                            ?
                            'border-b-2 border-yellow-400 text-yellow-400' :
                            'text-gray-900 dark:text-white'"
                        class="block py-2 px-3 transition-colors">
                        Beranda
                    </a>
                </li>

                {{-- <li>
                    <a href="#profil-desa"
                        :class="active === 'profil-desa'
                            ?
                            'border-b-2 border-yellow-400 text-yellow-400' :
                            'text-gray-900 dark:text-white'"
                        class="block py-2 px-3 transition-colors">
                        Profil Desa
                    </a>
                </li> --}}

                <li>
                    <a href="#umkm"
                        :class="active === 'umkm'
                            ?
                            'border-b-2 border-yellow-400 text-yellow-400' :
                            'text-gray-900 dark:text-white'"
                        class="block py-2 px-3 transition-colors">
                        UMKM Desa
                    </a>
                </li>
            </ul>

        </div>

        <!-- Social Media Icons -->
        <div id="sosmed-scroll"
            class="hidden lg:flex items-center justify-between space-x-6 w-full lg:w-auto lg:order-2">

            <!-- Website Resmi Desa -->
            <a href="https://tirtomulyo.desa.id" target="_blank"
                class="text-gray-600 dark:text-white hover:text-green-600 dark:hover:text-green-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10
               10-4.486 10-10S17.514 2 12 2zm6.931 6h-2.051a15.82 15.82 0 0 0-1.713-3.725A8.032 8.032 0 0 1 18.931 8zM12 4c1.563
               0 3.002 1.79 3.797 4H8.203C9 5.79 10.437 4 12 4zM4.691
               14a7.936 7.936 0 0 1 0-4h2.186a17.27 17.27 0 0 0 0 4H4.691zM5.069
               16h2.051a15.82 15.82 0 0 0 1.713 3.725A8.032 8.032 0 0 1 5.069 16zM12
               20c-1.563 0-3.002-1.79-3.797-4h7.594C15.002 18.21 13.563 20 12
               20zm2.134-.275A15.82 15.82 0 0 0 16.88 16h2.051a8.032 8.032 0 0 1-4.797
               3.725zM17.123 14h-2.246a17.27 17.27 0 0 0 0-4h2.246a15.27 15.27 0 0 1 0
               4zM9.123 14a17.27 17.27 0 0 1 0-4h5.754a17.27 17.27 0 0 1 0 4H9.123z" />
                </svg>
            </a>


            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100016203455008" target="_blank"
                class="text-gray-600 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.12 8.44 9.88v-6.99H7.9v-2.89h2.54V9.41c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.87h2.78l-.44 2.89h-2.34V22C18.34 21.12 22 16.99 22 12z" />
                </svg>
            </a>

            <!-- Twitter -->
            <a href="https://x.com/DPerdaganganSMG" target="_blank"
                class="text-gray-600 dark:text-white hover:text-gray-900 dark:hover:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M6.94 3h3.56l3.56 4.98L18.44 3H22l-6.38 8.64L22 21h-3.56l-3.56-5.1L8.88 21H5.31l6.38-8.64L5.31 3h1.63z" />
                </svg>
            </a>

            <!-- Instagram -->
            <a href="https://www.instagram.com/dinasperdagangansemarang?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                target="_blank" class="text-gray-600 dark:text-white hover:text-pink-500 dark:hover:text-pink-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M12 2.16c3.2 0 3.584.012 4.85.07 1.17.056 1.97.25 2.43.42a4.92 4.92 0 011.78 1.16 4.92 4.92 0 011.16 1.78c.17.46.364 1.26.42 2.43.058 1.266.07 1.65.07 4.85s-.012 3.584-.07 4.85c-.056 1.17-.25 1.97-.42 2.43a4.92 4.92 0 01-1.16 1.78 4.92 4.92 0 01-1.78 1.16c-.46.17-1.26.364-2.43.42-1.266.058-1.65.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.056-1.97-.25-2.43-.42a4.92 4.92 0 01-1.78-1.16 4.92 4.92 0 01-1.16-1.78c-.17-.46-.364-1.26-.42-2.43C2.172 15.584 2.16 15.2 2.16 12s.012-3.584.07-4.85c.056-1.17.25-1.97.42-2.43a4.92 4.92 0 011.16-1.78 4.92 4.92 0 011.78-1.16c.46-.17 1.26-.364 2.43-.42C8.416 2.172 8.8 2.16 12 2.16zm0 1.68c-3.15 0-3.52.012-4.76.068-.98.045-1.51.208-1.86.35-.47.18-.8.39-1.15.74a3.25 3.25 0 00-.74 1.15c-.14.35-.3.88-.35 1.86-.056 1.24-.068 1.61-.068 4.76s.012 3.52.068 4.76c.045.98.208 1.51.35 1.86.18.47.39.8.74 1.15.35.35.68.56 1.15.74.35.14.88.3 1.86.35 1.24.056 1.61.068 4.76.068s3.52-.012 4.76-.068c.98-.045 1.51-.208 1.86-.35.47-.18.8-.39 1.15-.74.35-.35.56-.68.74-1.15.14-.35.3-.88.35-1.86.056-1.24.068-1.61.068-4.76s-.012-3.52-.068-4.76c-.045-.98-.208-1.51-.35-1.86a3.25 3.25 0 00-.74-1.15 3.25 3.25 0 00-1.15-.74c-.35-.14-.88-.3-1.86-.35-1.24-.056-1.61-.068-4.76-.068zm0 3.96a5.88 5.88 0 110 11.76 5.88 5.88 0 010-11.76zm0 1.68a4.2 4.2 0 100 8.4 4.2 4.2 0 000-8.4zm6.4-.84a1.4 1.4 0 110 2.8 1.4 1.4 0 010-2.8z" />
                </svg>

            </a>

            <!-- YouTube -->
            <a href="https://www.youtube.com/channel/UCkcsdNFBpMv-bOuVm14pK2g" target="_blank"
                class="text-gray-600 dark:text-white hover:text-red-600 dark:hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M19.615 3.184a3.01 3.01 0 012.121 2.122C22 6.69 22 12 22 12s0 5.31-.264 6.694a3.01 3.01 0 01-2.121 2.122C18.235 21.2 12 21.2 12 21.2s-6.235 0-7.615-.384a3.01 3.01 0 01-2.122-2.122C2 17.31 2 12 2 12s0-5.31.264-6.694a3.01 3.01 0 012.122-2.122C5.765 2.8 12 2.8 12 2.8s6.235 0 7.615.384zM10 15.5l6-3.5-6-3.5v7z" />
                </svg>
            </a>

        </div>

    </div>
</nav>
