<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Desa-Tirtomulyo') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center relative"
       style="background-image: url('{{ asset('img/bg.jpg') }}')">

        <!-- Overlay blur -->
        <div class="absolute inset-0 bg-black/30 backdrop-blur-md"></div>

        <!-- Konten transparan -->
        <div
            class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-6 rounded-xl shadow-xl bg-white/60 dark:bg-gray-800/60 backdrop-blur-md ring-1 ring-white/40">
            <div class="flex justify-center items-center pb-5 pt-2">
                <a href="/">
                    <x-application-logo />
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</html>
