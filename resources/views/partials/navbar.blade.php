<!-- Navbar -->
<nav id="navbar" class="fixed top-0 left-0 z-50 w-full p-4 text-white transition-all duration-300 bg-black">

<div class="container flex items-center justify-between mx-auto">
        <img src="{{ asset('img/logo_utama.svg') }}" alt="Logo" class="h-14" href="{{route('welcome')}}">
        <button id="menuBtn" class="text-3xl text-white lg:hidden">&#9776;</button>
        <!-- Navbar Desktop -->
        <ul class="hidden space-x-6 lg:flex">
            <li><a href="{{route('welcome')}}" class="font-bold hover:text-gray-300">Beranda</a></li>
            <li class="relative group">
                <a href="" class="font-bold hover:text-gray-300">
                    Tentang
                </a>
                <ul class="absolute left-0 hidden w-40 text-gray-700 bg-white shadow-lg group-hover:block">
                    <li><a href="{{route('sejarah')}}" class="block px-4 py-2 hover:bg-gray-200">Sejarah</a></li>
                    <li><a href="{{route('visimisi')}}" class="block px-4 py-2 hover:bg-gray-200">Visi Misi</a></li>
                    <li><a href="{{route('proker')}}" class="block px-4 py-2 hover:bg-gray-200">Program Kerja</a></li>
                    <li><a href="{{route('struktur')}}" class="block px-4 py-2 hover:bg-gray-200">Kepengurusan</a></li>
                    <li><a href="{{route('lambang')}}" class="block px-4 py-2 hover:bg-gray-200">Lambang PMI</a></li>
                    <li><a href="{{route('dataAnggota')}}" class="block px-4 py-2 hover:bg-gray-200">Anggota </a></li>
                </ul>
            </li>
            <li class="relative group">
                <a href="{{route('layananksr')}}" class="font-bold hover:text-gray-300">Layanan</a>
            </li>

            <li class="relative group">
                <a href="{{ route('aktifitas') }}" class="font-bold hover:text-gray-300">Kegiatan</a>
            </li>
            <li><a href="" class="font-bold hover:text-gray-300">Pendaftaran</a></li>
            <li><a href="{{route('bloging')}}" class="font-bold hover:text-gray-300">Blog</a></li>
            <li><a href="{{ url('login') }}" class="font-bold hover:text-gray-300">Login</a></li>

        </ul>
    </div>
</nav>

<div id="sidebar" class="fixed top-0 right-0 z-50 w-64 h-screen text-white transition-transform transform translate-x-full bg-black shadow-lg lg:hidden">
    <div class="flex items-center justify-between p-5 border-b border-gray-700">
        <h2 class="text-lg font-bold">Menu</h2>
        <button id="closeSidebar" class="text-3xl text-gray-300 hover:text-red-500">&times;</button>
    </div>
    <ul class="p-5 space-y-4">
        <li><a href="{{route('welcome')}}" class="block font-bold text-green-400">BERANDA</a></li>

        <!-- Dropdown Menu -->
        <li>
            <button class="flex items-center justify-between w-full text-left hover:text-gray-300 dropdown-btn">TENTANG
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 ease-in-out dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <ul class="hidden pl-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out opacity-0 max-h-0 dropdown-content">
                <li><a href="{{route('sejarah')}}" class="block hover:text-gray-300">Sejarah</a></li>
                <li><a href="{{route('visimisi')}}" class="block hover:text-gray-300">Visi Misi</a></li>
                <li><a href="{{route('proker')}}" class="block hover:text-gray-300">Program Kerja</a></li>
                <li><a href="{{route('struktur')}}" class="block hover:text-gray-300">Kepengurusan</a></li>
                <li><a href="{{route('dataAnggota')}}" class="block hover:text-gray-300">Anggota</a></li>
                <li><a href="{{route('lambang')}}" class="block hover:text-gray-300">Lambang PMI</a></li>
            </ul>
        </li>

        <li>
            <a href="{{route('layananksr')}}" class="block hover:text-gray-300">LAYANAN</a>
        </li>
        <li>
            <button class="flex items-center justify-between w-full text-left hover:text-gray-300 dropdown-btn">
                KEGIATAN
                <svg class="w-4 h-4 ml-2 transition-transform duration-300 ease-in-out dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            {{-- <ul class="hidden pl-4 space-y-2 overflow-hidden transition-all duration-300 ease-in-out opacity-0 max-h-0 dropdown-content">
                <li><a href="#" class="block hover:text-gray-300">Donor Darah</a></li>
                <li><a href="#" class="block hover:text-gray-300">Bakti Sosial</a></li>
                <li><a href="#" class="block hover:text-gray-300">Dies Natalis</a></li>
                <li><a href="#" class="block hover:text-gray-300">Rencara Kerja Tindak Lanjut</a></li>
                <li><a href="#" class="block hover:text-gray-300">Diklatsar dan Pelantikan Anggota</a></li>
        </li>
            </ul> --}}
        </li>
        <li><a href="{{route('bloging')}}" class="block hover:text-gray-300">BLOG</a></li>
        <li><a href="" class="block hover:text-gray-300">Pendaftaran</a></li>
        <button id="navAction" type="button" class="px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"  onclick="window.location='{{ url('login') }}'">
            Login
        </button>

        <li class="mt-5">
            <h3 class="text-lg font-bold">TENTANG KAMI</h3>
            <p class="text-sm text-gray-400">Organisasi kepalangmerahan di kampus pendidikan, Politeknik Negeri Jember</p>
        </li>
        <li class="mt-5">
            <h3 class="text-lg font-bold">IKUTI KAMI</h3>
            <div class="flex mt-2 space-x-3">
                <a href="#" class="text-xl"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-xl"><i class="fab fa-x-twitter"></i></a>
                <a href="#" class="text-xl"><i class="fab fa-instagram"></i></a>
            </div>
        </li>
    </ul>
</div>

<main class="px-4 pt-20">
    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p> --}}
</main>

<script>
    document.getElementById("menuBtn").addEventListener("click", function() {
        document.getElementById("sidebar").classList.remove("translate-x-full");
    });

    document.getElementById("closeSidebar").addEventListener("click", function() {
        document.getElementById("sidebar").classList.add("translate-x-full");
    });

    document.querySelectorAll('.dropdown-btn').forEach(button => {
        button.addEventListener("click", function () {
            const dropdown = this.nextElementSibling;
            const icon = this.querySelector(".dropdown-icon");

            dropdown.classList.toggle("hidden");

            if (!dropdown.classList.contains("hidden")) {
                setTimeout(() => {
                    dropdown.classList.add("opacity-100", "max-h-64");
                    dropdown.classList.remove("opacity-0", "max-h-0");
                }, 10);
            } else {
                dropdown.classList.add("opacity-0", "max-h-0");
                dropdown.classList.remove("opacity-100", "max-h-64");
                setTimeout(() => {
                    dropdown.classList.add("hidden");
                }, 300);
            }

            icon.classList.toggle("rotate-180");
        });
    });
    window.addEventListener("scroll", function() {
    var navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
        navbar.classList.remove("bg-black");
        navbar.classList.add("bg-transparent", "shadow-lg");
    } else {
        navbar.classList.remove("bg-transparent", "shadow-lg");
        navbar.classList.add("bg-black");
    }
});



</script>

{{-- <style>
   #navbar {
    background: transparent;
    transition: background-color 0.3s, box-shadow 0.3s;

}

</style> --}}

