 <header class="bg-white border-gray-200 dark:bg-gray-900 p-5">
     <div class="flex flex-wrap items-center mx-auto max-w-screen-xl p-4">

         <!-- LOGO -->
         <div class="flex items-center space-x-2 sm:space-x-3 rtl:space-x-reverse">
             <a href="/" class="flex items-center space-x-2 sm:space-x-3 rtl:space-x-reverse">
                 <img src="{{ asset('logo/logo.png') }}" class="h-8 sm:h-12 w-auto"
                     alt="Logo Kota Semarang" />

                 <div class="font-[Poppins] text-gray-700 dark:text-white text-xs sm:text-base leading-tight">
                     <!-- Di mobile: tampil vertikal. Di sm ke atas: inline -->
                     <div class="flex flex-col sm:flex-row sm:space-x-1">
                         {{-- <span class="block">Desa</span> --}}
                         <span class="block">Tirtomulyo</span>
                     </div>
                     <span class="block text-[10px] sm:text-xs font-thin">Kec.Plantungan, Kab.Kendal</span>
                 </div>
             </a>


         </div>

         <div class="flex items-center space-x-6 rtl:space-x-reverse ml-auto">

             <!-- Language Dropdown -->
             {{-- <div class="relative">
                 <button id="google_translate_element" data-dropdown-toggle="dropdownLanguage"
                     class="inline-flex items-center justify-center text-xs font-medium text-gray-900 bg-white border border-gray-300 rounded-full px-3 py-1.5 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600"
                     type="button">
                     <img src="https://flagcdn.com/w40/id.png" class="w-4 h-3 me-2" alt="Indonesia">
                     Bahasa
                     <svg class="w-3 h-3 ml-1" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                         <path d="M19 9l-7 7-7-7" />
                     </svg>
                 </button>

                 <div id="dropdownLanguage"
                     class="z-[999] hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-40 dark:bg-gray-700 absolute mt-2 right-0">
                     <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                         <li>
                             <a href="#"
                                 class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                 <img src="https://flagcdn.com/w40/id.png" class="w-5 h-4 me-2" alt="Indonesia">
                                 Indonesia
                             </a>
                         </li>
                         <li>
                             <a href="#"
                                 class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                                 <img src="https://flagcdn.com/w40/us.png" class="w-5 h-4 me-2" alt="English">
                                 English
                             </a>
                         </li>
                     </ul>
                 </div>
             </div> --}}

             <!-- Switch Theme -->
             <label class="inline-flex items-center cursor-pointer">
                 <input type="checkbox" id="theme-toggle-switch" class="sr-only peer">
                 <div
                     class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600 after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full dark:border-gray-600">
                 </div>
                 <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300 flex items-center gap-1">
                     <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                         <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                     </svg>
                     <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                         <path fill-rule="evenodd" clip-rule="evenodd"
                             d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" />
                     </svg>
                 </span>
             </label>
         </div>
     </div>
 </header>
