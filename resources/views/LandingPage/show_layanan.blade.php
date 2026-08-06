<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UKM KSR POLIJE</title>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <script src="https://unpkg.com/alpinejs" defer></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <style>
            [x-cloak] { display: none !important; }
        </style>

    </head>
<body class="flex flex-col min-h-screen bg-white">
    @include('partials.navbar')
    <section class="relative flex items-center justify-center w-full h-screen text-white animate__animated animate__fadeIn">
        <img class="absolute top-0 left-0 object-cover w-full h-full filter "
             src="{{ asset('img/layananpage.png') }}"alt="layanan">
        <div class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50"></div>
        <div class="relative z-10 text-center">
            <h1 class="font-bold text-white text-7xl animate__animated animate__fadeInUp" style="font-family: 'Kanit', sans-serif;">LAYANAN</h1>
            <hr class="w-1/2 mx-auto my-4 border-t-2 border-white opacity-80">
            <p class="mt-4 text-lg text-white">Unit Kegiatan Mahasiswa Korps Sukarela Palang Merah Indonesia Unit Politeknik Negeri Jember</p>
        </div>
    </section>
    <div class="w-full bg-red-600 h-7"></div>
    <main class="container flex-1 mx-auto">
       {{-- show_layanan.blade.php --}}
       <section class="p-5 bg-white rounded-lg" x-data="{ open: false }">
        <div class="flex flex-col items-center justify-center p-6 py-12 animate-on-scroll">
            <h2 class="text-3xl font-bold text-center">Detail Layanan</h2>
            <hr class="w-1/5 mx-auto mt-2 mb-2 border-t-2 border-black opacity-50">
            <div class="container px-4 py-6 mx-auto">
                <div class="max-w-2xl mx-auto overflow-hidden bg-white rounded-lg shadow-lg">
                    <img src="{{ asset('storage/' . $layanan->poster_layanan) }}" alt="Poster {{ $layanan->nama_layanan }}" class="w-full h-auto">

                    <div class="p-6">
                        <h2 class="mb-4 text-3xl font-bold text-center text-gray-800 ">{{ $layanan->nama_layanan }}</h2>
                        <div class="text-gray-700">
                            {!! $layanan->deskripsi_layanan !!}
                        </div>
                    </div>

                    <div class="mt-4 text-center p-9">
                        <button @click="open = true"
                                class="px-6 py-3 font-bold text-gray-700 transition bg-transparent border-2 border-gray-400 rounded-lg hover:border-sky-400 hover:text-sky-400">
                            Gunakan Layanan
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @include('LandingPage.PesanLayanan')
    </section>
</main>
    @include('partials.footer')
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const animatedEls = document.querySelectorAll('.animate-on-scroll');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.2
        });

        animatedEls.forEach(el => observer.observe(el));
    });
    </script>

</html>
