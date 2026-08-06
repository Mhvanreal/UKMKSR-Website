<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title ?? 'Admin Dashboard' }} | UKM KSR</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind + Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 z-30 hidden bg-black bg-opacity-50 lg:hidden"></div>

    <!-- Main Container -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="fixed top-0 left-0 z-40 flex flex-col w-72 h-full transition-transform duration-300 transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0">
            @include('admin.layout.sidebar')
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 w-full min-h-screen lg:ml-72">

            <!-- Top Navbar -->
            <header class="sticky top-0 z-20 h-16 bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between h-full px-4 sm:px-6">

                    <div class="flex items-center gap-3">
                        <button id="sidebarToggle" class="text-gray-500 transition hover:text-red-600 lg:hidden focus:outline-none" aria-label="Buka menu">
                            <i class="text-xl fas fa-bars"></i>
                        </button>

                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-red-600 to-rose-600 text-white shadow-md shadow-red-200">
                            <i class="text-xl fas fa-plus"></i>
                        </div>

                        <div class="hidden ml-1 lg:block">
                            <p class="text-sm font-bold text-gray-800 leading-tight">Panel Admin UKM KSR</p>
                            <p class="text-xs text-gray-400">{{ $title ?? 'Humas Palang Merah Indonesia' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2 sm:gap-4">
                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 p-1.5 pr-3 transition rounded-full hover:bg-red-50 focus:outline-none" aria-label="Menu profil">
                                <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-br from-red-600 to-rose-600 text-white shadow">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div class="hidden text-left sm:block">
                                    <p class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-400 capitalize">{{ str_replace('_', ' ', Auth::user()->role) }}</p>
                                </div>
                                <i class="text-xs text-gray-400 fas fa-chevron-down"></i>
                            </button>

                            <div x-show="open" x-cloak @click.outside="open = false" x-transition
                                class="absolute right-0 z-50 w-56 mt-2 overflow-hidden bg-white border border-gray-200 rounded-xl shadow-lg">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 transition hover:bg-red-50">
                                    <i class="text-red-600 fas fa-user-cog"></i> Profil Saya
                                </a>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 transition hover:bg-red-50">
                                    <i class="text-red-600 fas fa-chart-line"></i> Dashboard
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full gap-3 px-4 py-3 text-sm text-red-600 transition hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="py-5 text-center text-xs text-gray-400 border-t border-gray-200">
                &copy; {{ date('Y') }} Unit Kegiatan Mahasiswa Korps Sukarela Palang Merah Indonesia (UKM KSR)
            </footer>
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
