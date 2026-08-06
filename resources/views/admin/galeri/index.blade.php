
    @extends('admin.layout.navbar')
    @section('content')
    <body class="text-gray-800 bg-gray-100">
        <div class="px-4 py-5 mx-auto max-w-7xl">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Galeri</h1>
                <!-- Button Dropdown -->
                <div class="relative">
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="inline-flex items-center gap-2 text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Add Data
                        <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdown" class="z-10 hidden bg-red-700 divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('galeri.tambah.foto') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Tambah Foto</a>
                            </li>
                            <li>
                                <a href="{{ route('galeri.tambah.video') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Tambah Video</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="mb-6 border-b border-gray-300">
                <nav class="flex space-x-6 text-sm font-semibold">
                    <a href="?tipe=semua" class="pb-2 transition-all duration-200 {{ $tipe === 'semua' ? 'border-b-2 border-red-600 text-red-600' : 'border-transparent text-gray-600 hover:border-red-300' }}">Semua</a>
                    <a href="?tipe=foto" class="pb-2 transition-all duration-200 {{ $tipe === 'foto' ? 'border-b-2 border-red-600 text-red-600' : 'border-transparent text-gray-600 hover:border-red-300' }}">Foto</a>
                    <a href="?tipe=video" class="pb-2 transition-all duration-200 {{ $tipe === 'video' ? 'border-b-2 border-red-600 text-red-600' : 'border-transparent text-gray-600 hover:border-red-300' }}">Video</a>
                </nav>
            </div>

            {{-- Grid Galeri --}}
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 justify-items-center">
                @foreach ($galeri as $item)
                <div class="bg-gray-100 border border-gray-200 rounded-xl w-full aspect-[2/1] overflow-hidden shadow-sm">
                    @if ($item->foto_galeri)
                    <!-- Foto -->
                    <img src="{{ asset('storage/' . $item->foto_galeri) }}" class="object-cover w-full h-full" alt="Foto Galeri">
                    @elseif ($item->video_galeri)
                    <!-- Video -->
                    <video controls class="object-cover w-full h-full">
                        <source src="{{ asset('storage/' . $item->video_galeri) }}" type="video/mp4">
                        Browser tidak mendukung tag video.
                    </video>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </body>

    <script>
        document.getElementById("dropdownDefaultButton").addEventListener("click", function() {
            const dropdown = document.getElementById("dropdown");
            dropdown.classList.toggle("hidden");
        });
    </script>

    @endsection

