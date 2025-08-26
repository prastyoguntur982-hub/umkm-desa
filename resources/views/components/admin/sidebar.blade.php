<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 shadow-lg"
    aria-label="Sidebar">
    <div class="h-full px-4 py-6 overflow-y-auto bg-white border-r dark:bg-gray-900 dark:border-gray-700">

        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-6">
            <img src="{{ asset('logo/Logo Kota Semarang.png') }}" class="h-10 w-auto" alt="Logo Kota Semarang">
            <div class="font-semibold text-gray-800 dark:text-white leading-tight -ml-3 mb-2">
                <div class="text-base">Desa Tirtomulyo</div>
                <div class="text-xs text-gray-500 dark:text-gray-300">Kec. Plantungan, Kab. Kendal</div>
            </div>
        </div>

        <ul class="space-y-2 text-sm font-medium text-gray-700 dark:text-gray-200">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard.index') }}"
                    class="flex items-center p-2 rounded-lg group 
                    {{ request()->routeIs('admin.dashboard.*')
                        ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                        : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-indigo-600 
                        dark:text-gray-400 dark:group-hover:text-indigo-400"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1V9.5z" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <!-- UMKM -->
            <li>
                <a href="{{ route('admin.umkms.index') }}"
                    class="flex items-center p-2 rounded-lg group 
                    {{ request()->routeIs('admin.umkms.*')
                        ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                        : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-indigo-600 
                        dark:text-gray-400 dark:group-hover:text-indigo-400"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 7h18M3 12h18M3 17h18" />
                    </svg>
                    <span class="ml-3">UMKM</span>
                </a>
            </li>

            <!-- Wisata -->
            {{-- <li>
                <a href="{{ route('admin.wisata.index') }}"
                    class="flex items-center p-2 rounded-lg group 
                    {{ request()->routeIs('admin.wisata.*')
                        ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                        : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                    <svg class="w-5 h-5 text-gray-500 group-hover:text-indigo-600 
                        dark:text-gray-400 dark:group-hover:text-indigo-400"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 21v-2a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span class="ml-3">Wisata</span>
                </a>
            </li> --}}

            <!-- Pengaturan (Dropdown) -->
            <li x-data="{ open: {{ request()->routeIs('admin.sosmed.*') || request()->routeIs('admin.slider.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2 rounded-lg transition-all"
                    :class="open ? 'bg-gray-100 text-indigo-600 dark:bg-gray-800 dark:text-indigo-400' :
                        'hover:bg-gray-100 dark:hover:bg-gray-800'">

                    <!-- Icon -->
                    <!-- Icon Gear (simple) -->
                    <svg class="w-5 h-5"
                        :class="open ? 'text-indigo-600 dark:text-indigo-400' :
                            'text-gray-500 dark:text-gray-400'"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317a1.724 1.724 0 013.35 0 1.724 1.724 0 002.573 1.066c1.52-.88 3.43.986 2.55 2.506a1.724 1.724 0 001.065 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.88 1.52-.986 3.43-2.506 2.55a1.724 1.724 0 00-2.573 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.52.88-3.43-.986-2.55-2.506a1.724 1.724 0 00-1.065-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.065-2.573c-.88-1.52.986-3.43 2.506-2.55a1.724 1.724 0 002.573-1.065z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>


                    <span class="flex-1 ml-3 text-left whitespace-nowrap">Pengaturan</span>

                    <svg class="w-3 h-3 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                    </svg>
                </button>

                <ul x-show="open" class="pl-8 mt-1 space-y-1" x-transition>
                    {{-- <li>
                        <a href="{{ route('admin.profil-desa.index') }}"
                            class="block p-2 rounded-lg transition-all
                {{ request()->routeIs('admin.profil-desa.*')
                    ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                    : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            Profil Desa
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('admin.slider.index') }}"
                            class="block p-2 rounded-lg transition-all
                {{ request()->routeIs('admin.slider.*')
                    ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                    : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            Slider
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sosmed.index') }}"
                            class="block p-2 rounded-lg transition-all
                {{ request()->routeIs('admin.sosmed.*')
                    ? 'bg-gray-200 text-indigo-600 dark:bg-gray-700 dark:text-indigo-400'
                    : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}">
                            Sosial Media
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
    </div>
</aside>
