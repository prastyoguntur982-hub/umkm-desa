<!doctype html>
<html class="dark:bg-gray-900">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        .font-noto-serif {
            font-family: 'Noto Serif', serif;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>


    <title>Desa-Tirtomulyo</title>

</head>

<body>
    <div>

        <x-public.header />
        <x-public.navbar />


        <main class=" dark:bg-gray-900">


            @yield('content')

        </main>

        <div class="fixed bottom-4 right-4 z-50 flex flex-col items-center space-y-4">
            <!-- Tombol Scroll to Top -->
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="w-10 h-10 md:w-15 md:h-15 flex items-center justify-center rounded-full bg-yellow-600 text-white shadow-lg hover:bg-yellow-700 dark:bg-yellow-500 dark:hover:bg-yellow-600 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-7 md:h-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </button>
        </div>






        <x-public.footer />



</body>

</html>
