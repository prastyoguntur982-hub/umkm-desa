   @extends('layouts.admin')

   @section('content')
       {{-- <div class="p-4 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

           <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
               <!-- Card 1: Pengunjung -->
               <div x-data="{
                   count: 0,
                   target: {{ $totalPengunjung }},
                   animateCount() {
                       let interval = setInterval(() => {
                           if (this.count < this.target) {
                               this.count += Math.ceil(this.target / 50);
                               if (this.count > this.target) this.count = this.target;
                           } else {
                               clearInterval(interval);
                           }
                       }, 20);
                   }
               }" x-init="animateCount()"
                   class="flex items-center gap-4 h-28 p-5 rounded-xl bg-gradient-to-r from-blue-100 to-blue-300 dark:from-gray-800 dark:to-gray-700 shadow-md hover:shadow-xl transition-all border border-blue-200 dark:border-gray-600">
                   <div class="bg-white dark:bg-gray-800 p-3 rounded-full shadow-md">
                       <!-- Icon: Users -->
                       <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                           stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round"
                               d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m3-4a4 4 0 110-8 4 4 0 010 8zm6 0a4 4 0 100-8 4 4 0 000 8z">
                           </path>
                       </svg>
                   </div>
                   <div>
                       <p class="text-xs text-gray-600 dark:text-gray-400 uppercase font-semibold tracking-wide">Jumlah
                           Pengunjung</p>
                       <p class="text-2xl font-bold text-gray-800 dark:text-white" x-text="count.toLocaleString()"></p>
                   </div>
               </div>

               <!-- Card 2: Postingan -->
               <div x-data="{
                   count: 0,
                   target: {{ $totalPostingan }},
                   animateCount() {
                       let interval = setInterval(() => {
                           if (this.count < this.target) {
                               this.count += Math.ceil(this.target / 50);
                               if (this.count > this.target) this.count = this.target;
                           } else {
                               clearInterval(interval);
                           }
                       }, 20);
                   }
               }" x-init="animateCount()"
                   class="flex items-center gap-4 h-28 p-5 rounded-xl bg-gradient-to-r from-purple-100 to-purple-300 dark:from-gray-800 dark:to-gray-700 shadow-md hover:shadow-xl transition-all border border-purple-200 dark:border-gray-600">
                   <div class="bg-white dark:bg-gray-800 p-3 rounded-full shadow-md">
                       <!-- Icon: Document -->
                       <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                           stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round"
                               d="M8 16h8M8 12h8m-6-8h6a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2z">
                           </path>
                       </svg>
                   </div>
                   <div>
                       <p class="text-xs text-gray-600 dark:text-gray-400 uppercase font-semibold tracking-wide">Jumlah
                           Postingan</p>
                       <p class="text-2xl font-bold text-gray-800 dark:text-white" x-text="count.toLocaleString()"></p>
                   </div>
               </div>

               <!-- Card 3: Pasar -->
               <div x-data="{
                   count: 0,
                   target: {{ $totalPasar }},
                   animateCount() {
                       let interval = setInterval(() => {
                           if (this.count < this.target) {
                               this.count += Math.ceil(this.target / 50);
                               if (this.count > this.target) this.count = this.target;
                           } else {
                               clearInterval(interval);
                           }
                       }, 20);
                   }
               }" x-init="animateCount()"
                   class="flex items-center gap-4 h-28 p-5 rounded-xl bg-gradient-to-r from-green-100 to-green-300 dark:from-gray-800 dark:to-gray-700 shadow-md hover:shadow-xl transition-all border border-green-200 dark:border-gray-600">
                   <div class="bg-white dark:bg-gray-800 p-3 rounded-full shadow-md">
                       <!-- Icon: Store -->
                       <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                           stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                           <path stroke-linecap="round" stroke-linejoin="round"
                               d="M4 6h16M4 10h16M4 14h4m0 0v6m0-6h12a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v6a2 2 0 002 2h4z">
                           </path>
                       </svg>
                   </div>
                   <div>
                       <p class="text-xs text-gray-600 dark:text-gray-400 uppercase font-semibold tracking-wide">Jumlah
                           Pasar</p>
                       <p class="text-2xl font-bold text-gray-800 dark:text-white" x-text="count.toLocaleString()"></p>
                   </div>
               </div>
           </div>

           <div
               class="bg-white max-w-7xl mx-auto mt-8 mb-8 p-6 rounded-xl shadow-sm dark:bg-gray-900 overflow-x-auto transition-all duration-300">
               <table id="table" class="datatable min-w-full text-sm text-left text-gray-800 dark:text-gray-200">
                   <thead
                       class="text-xs font-semibold uppercase tracking-wider bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-700 text-gray-700 dark:text-gray-300 border-b border-gray-300 dark:border-gray-600">
                       <tr>
                           <th class="px-5 py-3">Nama Barang</th>
                           <th class="px-5 py-3">Satuan</th>
                           <th class="px-5 py-3">Harga Saat Ini</th>
                           <th class="px-5 py-3">Harga Sebelumnya</th>
                           <th class="px-5 py-3">Perubahan</th>
                           <th class="px-5 py-3">Persentase</th>
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                       @foreach ($data as $item)
                           @php
                               $isNaik = $item['perubahan'] >= 0;
                               $warnaHarga = $isNaik
                                   ? 'text-green-600 dark:text-green-400 font-bold'
                                   : 'text-red-600 dark:text-red-400 font-bold';
                               $ikon = $isNaik
                                   ? '<svg class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>'
                                   : '<svg class="h-4 w-4 mr-1 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>';
                           @endphp
                           <tr class="hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200">
                               <td class="px-5 py-3 whitespace-nowrap">{{ $item['nama_barang'] }}</td>
                               <td class="px-5 py-3">{{ $item['satuan'] }}</td>
                               <td class="px-5 py-3 {{ $warnaHarga }}">
                                   Rp {{ number_format($item['harga_terbaru'], 0, ',', '.') }}
                               </td>
                               <td class="px-5 py-3">
                                   Rp {{ number_format($item['harga_sebelumnya'], 0, ',', '.') }}
                               </td>
                               <td class="px-5 py-3 flex items-center {{ $warnaHarga }}">
                                   {!! $ikon !!}
                                   Rp {{ number_format(abs($item['perubahan']), 0, ',', '.') }}
                               </td>
                               <td class="px-5 py-3 font-medium text-center">
                                   <span
                                       class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                            {{ $isNaik
                                ? 'bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-200'
                                : 'bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-200' }}">
                                       {{ $isNaik ? '+' : '-' }}{{ number_format(abs($item['persentase']), 2) }}%
                                   </span>
                               </td>
                           </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>



       </div> --}}
   @endsection
