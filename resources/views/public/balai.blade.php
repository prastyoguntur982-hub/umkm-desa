@extends('layouts.public')

@section('content')
    <h2 class="mt-10 p-5 text-4xl font-bold text-gray-800 dark:text-white text-center animate__animated animate__fadeInUp"
        style="font-family: 'Poppins', sans-serif;">
        {{ \Illuminate\Support\Str::headline(str_replace('-', ' ', $kategori)) }}
    </h2>
    <span
        class="mb-10 block w-20 h-1 bg-red-600 mx-auto rounded animate__animated animate__fadeInUp animate__delay-1s"></span>

    {{-- CEK BALAI --}}
    @if (empty($balai) || !isset($balai->id))
        <div class="flex flex-col items-center justify-center py-10 text-center text-gray-600 dark:text-gray-400"
            style="font-family: 'Poppins', sans-serif;">
            <x-public.no-data-img />
            <p class="mt-4">Data belum tersedia.</p>
        </div>
    @else
    {{--  --}}
        <div class="items-center mx-auto w-[85%]">
            {{-- MAP --}}
            <div class="p-3 pb-10">
                <div class="relative p-2 h-80 md:h-[512px] bg-slate-400 rounded-lg">

                    @if ($balai->kategori === 'Balai Pengembangan Kemasan dan Industri Kreatif')
                        <iframe class="rounded-lg"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31680.65234570102!2d110.39241584590751!3d-6.999679055788483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708ca656eac67f%3A0x5b3a443fe40adaa2!2sBalai%20Industri%20Kreatif%20Digital%20dan%20Kemasan!5e0!3m2!1sen!2sid!4v1746423393920!5m2!1sen!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @else
                        <iframe class=" rounded-lg"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0119830099447!2d110.46058119999996!3d-7.0078712999999935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708cf098911765%3A0x3f17478eee466a6d!2sBPSMB%20(Balai%20Pengujian%20Dan%20Sertifikasi%20Mutu%20Barang)%20Semarang!5e0!3m2!1sen!2sid!4v1746426997917!5m2!1sen!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="p-3 mb-5">
                <div
                    class="flex items-center justify-between mx-auto bg-slate-300 border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="max-w-5xl mx-auto flex flex-col items-center space-y-3 p-4 text-center"
                        style="font-family: 'Poppins', sans-serif;">
                        <h3
                            class="-m-9 w-40 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-xl text-base px-5 py-2.5 tracking-wide shadow-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Alamat
                        </h3>
                        <p class="pt-12 text-base text-gray-800 font-serif leading-relaxed dark:text-gray-200">
                            {{ $balai->alamat }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- DESKRIPSI --}}
            <div class="p-3 mb-15">
                <div
                    class="flex items-center justify-between mx-auto bg-slate-300 border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                    <div class="max-w-5xl mx-auto flex flex-col items-center space-y-3 p-4 text-center"
                        style="font-family: 'Poppins', sans-serif;">
                        <h3
                            class="-m-9 w-40 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-semibold rounded-xl text-base px-5 py-2.5 tracking-wide shadow-md dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            Deskripsi
                        </h3>
                        <div
                            class="pt-10 pb-5 text-center text-gray-800 text-base font-serif leading-relaxed dark:text-gray-200">
                            <p class="p-3 text-sm text-center text-gray-800 dark:text-gray-200">
                                @php
                                    $deskripsi = $balai->deskripsi ?? '';
                                    $deskripsi = str_replace(['<br>', '<br/>', '<br />'], "\n", $deskripsi);
                                    $deskripsiLines = preg_split('/\r\n|\r|\n/', $deskripsi);

                                    $getLevel = function ($line) {
                                        $line = trim($line);
                                        if (preg_match('/^\d+\./', $line)) {
                                            return 0;
                                        }
                                        if (preg_match('/^[a-zA-Z]\./', $line)) {
                                            return 1;
                                        }
                                        if (preg_match('/^[ivxlcdm]+\./i', $line)) {
                                            return 2;
                                        }
                                        if (preg_match('/^[-•]/', $line)) {
                                            return 3;
                                        }
                                        return 0;
                                    };

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

                                    $renderList = function ($list, $level = 0) use (&$renderList) {
                                        $html = '';
                                        foreach ($list as $item) {
                                            $margin = $level * 20;
                                            $html .=
                                                '<p style="margin-left:' . $margin . 'px">' . e($item['text']) . '</p>';
                                            if (!empty($item['children'])) {
                                                $html .= $renderList($item['children'], $level + 1);
                                            }
                                        }
                                        return $html;
                                    };

                                    $nestedList = $parseList($deskripsiLines);
                                    echo $renderList($nestedList);
                                @endphp
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
