<!-- Sidebar -->
<aside id="sidebar" class="fixed z-40 flex flex-col w-64 h-auto min-h-screen overflow-y-auto transition-all duration-300 transform -translate-x-full bg-white shadow-md md:translate-x-0 md:relative">
    <div id="sidebarHeader" class="p-4 text-center transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 12c2.5 0 4.5-2 4.5-4.5S14.5 3 12 3s-4.5 2-4.5 4.5S9.5 12 12 12zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4z" />
        </svg>
        <h2 class="text-lg font-semibold">Humas Polije</h2>
        <p class="mb-6 text-sm text-gray-500">Admin Humas</p>
        <hr class="border-gray-300">
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-grow p-4 space-y-1.5">
        <a href="/dashboard" class="flex items-center p-3 rounded-md
            {{ request()->is('dashboard') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/home.png" alt="Beranda Icon" class="w-4 h-4
                {{ request()->is('dashboard') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs font-medium sidebar-text">Beranda</span>
        </a>
        <a href="{{ route('akun') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('akun') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/user.png" alt="Akun Icon" class="w-6 h-6
                {{ request()->is('akun') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Akun</span>
        </a>

        <a href="{{ route('anggota.index') }}" class="flex items-center p-3 rounded-md
         {{ request()->is('anggota') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
         <img src="/img/icon/multi.png" alt="Anggota Icon" class="w-5 h-5
         {{ request()->is('anggota') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Anggota</span>
         </a>

        {{-- <a href="{{ route('anggota.index') }}" class="flex items-center p-3 rounded-md
            {{ request()->is('anggota') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/multi.png" alt="Anggota Icon" class="w-5 h-5
                {{ request()->is('anggota') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Anggota</span>
        </a> --}}

        <p class="text-gray-600 mt-3 text-[12px] font-semibold sidebar-text">Rekrutmen</p>
        <a href="{{ route('nilai') }}" class="flex items-center p-1 rounded-md
            {{ request()->is('nilai') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/add.png" alt="Nilai Anggota Baru Icon" class="h-7 w-7
                {{ request()->is('nilai') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Nilai Anggota Baru</span>
        </a>
        <a href="{{ route('clustering') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('clustering') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/network.png" alt="Clustering Icon" class="w-6 h-6
                {{ request()->is('clustering') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Clustering</span>
        </a>

        <p class="text-gray-600 mt-3 text-[12px] font-semibold sidebar-text">Landing Page</p>
        <a href="{{ route('tentang') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('tentang') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/info.png" alt="Tentang Icon" class="w-6 h-6
                {{ request()->is('tentang') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Tentang</span>
        </a>
        <a href="{{ route('kegiatan.index') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('kegiatan*') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/calendar.png" alt="Kegiatan Icon" class="w-6 h-6
            {{ request()->is('kegiatan*') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Kegiatan</span>
        </a>
        <a href="{{ route('layanan') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('layanan') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/heart.png" alt="Layanan Icon" class="w-6 h-6
                {{ request()->is('layanan') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Layanan</span>
        </a>
        <a href="{{ route('blogadmin.index') }}" class="flex items-center p-2 rounded-md
            {{ request()->is('blogadmin.index*') ? 'bg-black-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/writing.png" alt="Galeri Blog" class="w-6 h-6
            {{ request()->is('blogadmin.index*') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Blog</span>
        </a>
        <a href="{{ route('galeri') }}" class="flex items-center p-1 rounded-md
            {{ request()->is('galeri') ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
            <img src="/img/icon/image-galery.png" alt="Galeri Icon" class="w-7 h-7
                {{ request()->is('galeri') ? 'filter invert brightness-0' : '' }}">
            <span class="ml-2 text-xs sidebar-text">Galeri</span>
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="flex items-center w-full p-2 text-red-500 rounded-md hover:bg-gray-100">
                <img src="/img/icon/logout.png" alt="Logout Icon" class="w-6 h-6">
                <span class="ml-2 text-xs font-semibold sidebar-text">Keluar</span>
            </button>
        </form>
    </nav>
</aside>
