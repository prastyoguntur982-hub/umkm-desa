@extends('layouts.public')
{{--  --}}
@section('content')
    <section class="max-w-4xl mx-auto px-4 py-6 mb-20">
        <div class="animate__animated fade-on-scroll">
            <h2 class="mt-10 p-5 text-4xl font-bold text-gray-800 dark:text-white text-center"
                style="font-family: 'Poppins', sans-serif;">
                {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $kategori)) }}
            </h2>
            <span class="mb-10 block w-20 h-1 bg-red-600 mx-auto rounded "></span>
        </div>
        @if (!$data)
            <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400 "
                style="font-family: 'Poppins', sans-serif;">
                <x-public.no-data-img />
                <p class="mt-4">Data belum tersedia.</p>
            </div>
        @else
            <!-- Alur Penyelesaian -->
            <div class="mb-6 animate__animated fade-on-scroll">
                <div class="bg-slate-100 border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 flex flex-col items-center text-center space-y-4">
                        @if ($data->gambar)
                            <img src="{{ asset('storage/' . $data->gambar) }}" alt="Alur {{ $data->kategori }}"
                                class="rounded-xl shadow-lg max-w-full h-auto">
                        @else
                            <p class="text-gray-500 dark:text-gray-400 italic">Gambar belum tersedia</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Keterangan -->
            <div class="mb-6 animate__animated fade-on-scroll" style="font-family: 'Poppins', sans-serif;">
                <div
                    class="bg-slate-100 border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700 ">
                    <div class="-m-9 p-6 flex flex-col items-center text-center space-y-5">
                        <h3
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 font-semibold rounded-xl text-sm px-5 py-2">
                            Keterangan
                        </h3>
                    </div>

                    @php
                        $keterangan = $data->keterangan ?? '';
                        $keterangan = str_replace(['<br>', '<br/>', '<br />'], "\n", $keterangan);
                        $keteranganLines = preg_split('/\r\n|\r|\n/', $keterangan);

                        // Closure untuk menentukan level indentasi
                        $getLevel = function ($line) {
                            $line = trim($line);
                            if (preg_match('/^\d+\./', $line)) {
                                return 0; // 1.
                            }
                            if (preg_match('/^[a-z]\./', $line)) {
                                return 1; // a.
                            }
                            if (preg_match('/^[A-Z]\./', $line)) {
                                return 1; // A.
                            }
                            if (preg_match('/^[ivxlcdm]+\./i', $line)) {
                                return 2; // i.
                            }
                            if (preg_match('/^[-•]/', $line)) {
                                return 3; // bullet atau dash
                            }
                            return 0;
                        };

                        // Closure untuk parsing list bertingkat
                        $parseList = function ($lines) use (&$getLevel) {
                            $result = [];
                            $stack = [['children' => &$result, 'level' => -1]];

                            foreach ($lines as $line) {
                                $line = trim($line);
                                if ($line === '') {
                                    continue;
                                }

                                $level = $getLevel($line);

                                while (!empty($stack) && $stack[count($stack) - 1]['level'] >= $level) {
                                    array_pop($stack);
                                }

                                $parent = &$stack[count($stack) - 1]['children'];
                                $item = ['text' => $line, 'children' => []];
                                $parent[] = $item;

                                $stack[] = [
                                    'children' => &$parent[count($parent) - 1]['children'],
                                    'level' => $level,
                                ];
                            }

                            return $result;
                        };

                        // Closure untuk render list bertingkat
                        $renderList = function ($list, $level = 0) use (&$renderList) {
                            $html = '';
                            foreach ($list as $item) {
                                $margin = $level * 20;
                                $html .= '<p style="margin-left:' . $margin . 'px">' . e($item['text']) . '</p>';
                                if (!empty($item['children'])) {
                                    $html .= $renderList($item['children'], $level + 1);
                                }
                            }
                            return $html;
                        };

                        $nestedList = $parseList($keteranganLines);
                    @endphp

                    <div class="p-6 flex flex-col items-center text-center space-y-4">
                        @if (!empty(trim($keterangan)))
                            <div class="text-sm text-gray-800 dark:text-gray-200 text-left space-y-5">
                                {!! $renderList($nestedList) !!}
                            </div>
                        @else
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                Keterangan belum tersedia.
                            </p>
                        @endif
                    </div>

                </div>
            </div>

            <!-- UU Terkait -->
            <div class="animate__animated fade-on-scroll" style="font-family: 'Poppins', sans-serif;">
                <div
                    class="bg-slate-100 border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="-m-9 p-6 flex flex-col items-center text-center space-y-4">
                        <h3
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 font-semibold rounded-xl text-sm px-5 py-2">
                            UU Terkait
                        </h3>
                    </div>

                    @php
                        $uuTerkait = $data->uu_terkait ?? '';
                        $uuTerkait = str_replace(['<br>', '<br/>', '<br />'], "\n", $uuTerkait);
                        $lines = preg_split('/\r\n|\r|\n/', $uuTerkait);

                        // Closure untuk menentukan level indentasi
                        $getLevel = function ($line) {
                            $line = trim($line);
                            if (preg_match('/^\d+\./', $line)) {
                                return 0; // 1.
                            }
                            if (preg_match('/^[a-z]\./', $line)) {
                                return 1; // a.
                            }
                            if (preg_match('/^[A-Z]\./', $line)) {
                                return 1; // A.
                            }
                            if (preg_match('/^[ivxlcdm]+\./i', $line)) {
                                return 2; // i. (angka romawi)
                            }
                            if (preg_match('/^[-•]/', $line)) {
                                return 3; // bullet atau dash
                            }
                            return 0;
                        };

                        // Closure untuk parsing list bertingkat
                        $parseList = function ($lines) use (&$getLevel) {
                            $result = [];
                            $stack = [['children' => &$result, 'level' => -1]];

                            foreach ($lines as $line) {
                                $line = trim($line);
                                if ($line === '') {
                                    continue;
                                }

                                $level = $getLevel($line);

                                while (!empty($stack) && $stack[count($stack) - 1]['level'] >= $level) {
                                    array_pop($stack);
                                }

                                $parent = &$stack[count($stack) - 1]['children'];
                                $item = ['text' => $line, 'children' => []];
                                $parent[] = $item;

                                $stack[] = [
                                    'children' => &$parent[count($parent) - 1]['children'],
                                    'level' => $level,
                                ];
                            }

                            return $result;
                        };

                        // Closure untuk render list
                        $renderList = function ($list, $level = 0) use (&$renderList) {
                            $html = '';
                            foreach ($list as $item) {
                                $margin = $level * 20;
                                $html .= '<p style="margin-left:' . $margin . 'px">' . e($item['text']) . '</p>';
                                if (!empty($item['children'])) {
                                    $html .= $renderList($item['children'], $level + 1);
                                }
                            }
                            return $html;
                        };

                        $nestedList = $parseList($lines);
                    @endphp

                    <div class="p-6 flex flex-col items-center text-center space-y-4">
                        @if (!empty(trim($uuTerkait)))
                            <div class="text-sm text-gray-800 dark:text-gray-200 text-left space-y-5">
                                {!! $renderList($nestedList) !!}
                            </div>
                        @else
                            <p class="text-sm text-gray-800 dark:text-gray-200">
                                Belum ada informasi UU terkait.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection
