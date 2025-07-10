<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard</title>

    <!-- Tailwind + Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="font-sans bg-gray-100">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 z-30 hidden bg-black bg-opacity-50 lg:hidden"></div>

    <!-- Main Container -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-full transition-transform duration-300 transform -translate-x-full bg-white shadow lg:translate-x-0">
            @include('admin.layout.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full min-h-screen lg:ml-64">
            <!-- Top Navbar -->
            <header class="sticky top-0 z-20 flex items-center justify-between h-16 px-4 bg-white shadow">
                <div class="flex items-center gap-3">
                    <button id="sidebarToggle" class="text-gray-700 lg:hidden focus:outline-none">
                        <i class="text-2xl fas fa-bars"></i>
                    </button>
                    <img src="/img/Logo_solo.png" class="h-10" alt="Logo">
                </div>
                <div class="text-red-600">
                    <a href="{{ route('profile.edit') }}">
                        <i class="text-2xl fas fa-user-circle"></i>
                    </a>
                </div>
            </header>

            <!-- Content -->
            <main class="p-4 sm:p-6 md:p-8">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Sidebar Toggle Script -->
    <script>
        const toggleBtn = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('mobileOverlay');

        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

</body>
</html>
