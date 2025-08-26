<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-gray-50 dark:bg-gray-600">
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: '{{ session('warning') }}',
                confirmButtonColor: '#d33',
            });
        @endif
    </script>

    <script>
        @if ($errors->any())
            Swal.fire({
                title: "Gagal!",
                text: {!! json_encode($errors->first()) !!},
                icon: "error",
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>


    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="pt-20 sm:ml-64">

        @yield('content')

    </main>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        const themeToggle = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        // Set icon based on localStorage
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }

        themeToggle.addEventListener('click', function() {
            // toggle icons
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            // toggle theme
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });

        // modal foto
        function openFotoModal(fotoUrl) {
            const modal = document.getElementById('modalFoto');
            const imgTag = modal.querySelector('img');
            imgTag.src = fotoUrl;
            console.log(fotoUrl);
            modal.classList.remove('hidden');
        }

        // modal hapus 
        function deleteForm(deleteUrl) {
            console.log(deleteUrl)
            const modal = document.getElementById('modalHapus');
            const form = document.getElementById('formHapus');
            form.action = deleteUrl;
            modal.classList.remove('hidden');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }

        function closeAllModals() {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => modal.classList.add('hidden'));
        }


        function tambahGaleri(formType) {
            const modal = document.getElementById('tambahModal-Galeri');
            const formTambahKategoriGaleri = document.getElementById('formTambahKategoriGaleri');
            const formTambahGaleri = document.getElementById('formTambahGaleri');

            formTambahKategoriGaleri.classList.add('hidden');
            formTambahGaleri.classList.add('hidden');

            if (formType === 1) {
                formTambahKategoriGaleri.classList.remove('hidden');
            } else if (formType === 2) {
                formTambahGaleri.classList.remove('hidden');
            }

            modal.classList.remove('hidden');
        }


        // convert angka
        function formatRupiah(input) {
            let angka = input.value.replace(/\D/g, '');
            let formatted = new Intl.NumberFormat('id-ID').format(angka);
            input.value = formatted;
        }
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event delegation: ketika tombol diklik, cari modal dan tampilkan
            document.body.addEventListener("click", function(e) {
                const target = e.target.closest("[data-modal-toggle]");
                if (target) {
                    const modalId = target.getAttribute("data-modal-toggle");
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.remove("hidden");
                        modal.classList.add("flex");
                    }
                }
            });
        });
    </script>




</body>

</html>
