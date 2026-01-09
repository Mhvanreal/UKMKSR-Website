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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    </head>
<body class="flex flex-col min-h-screen bg-white">
    @include('partials.navbar')
    <main class="flex-grow pt-6">
        <section class="px-8 py-1 bg-white border-b fade-in">
            <div class="container max-w-5xl mx-auto">

                <!-- Heading -->
                <div class="mb-10 text-center">
                    <h1 class="text-3xl font-bold leading-tight text-gray-800 animate__animated animate__fadeInUp">Blog Artikel</h1>
                    <div class="w-64 h-1 mx-auto mt-4 bg-red-600 rounded-t"></div>
                </div>

                <!-- Search Form -->
               

                <!-- Blog Cards -->
                <div class="grid gap-8 pb-8 mt-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($data as $blog)
                    <div class="relative overflow-hidden transition-transform duration-300 bg-white border border-gray-200 shadow-lg group hover:scale-105 hover:shadow-2xl">
                        <img src="{{ asset('storage/'. $blog->images) }}" alt="{{ $blog->title }}" class="object-cover w-full h-48 rounded-t-lg">
                        <div class="p-6 flex flex-col justify-between min-h-[200px]">
                            <p class="flex items-center gap-1 mb-1 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10M5 11h14M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $blog->created_at->format('d M Y') }}
                            </p>

                            <div>
                                <p class="mb-2 text-xl font-bold text-black">
                                    {{ $blog->title }}
                                </p>
                            </div>
                            <div class="mt-auto">
                                <hr
                                class="mb-4 ml-0 transition-all duration-500 ease-in-out transform translate-y-4 border-t-2 opacity-0 border-gray-80 w-2/2 group-hover:translate-y-0 group-hover:opacity-100" />

                                <div
                                    class="transition-all duration-500 ease-in-out transform translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100">
                                    <a href="{{ route('blog.detail', $blog->id) }}"
                                       class="font-bold text-blue-800 hover:underline">
                                        SELENGKAPNYA
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $data->links('vendor.pagination.custom') }}
                </div>


            </div>
        </section>
    </main>
    @include('partials.footer')
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const elements = document.querySelectorAll('.scroll-animate');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        observer.unobserve(entry.target); // agar hanya animasi sekali
                    }
                });
            }, { threshold: 0.1 });

            elements.forEach(el => observer.observe(el));
        });
    </script>
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
</body>
</html>


