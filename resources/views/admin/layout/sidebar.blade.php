<!-- Sidebar -->
<aside
    x-cloak
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed top-16 left-0 z-40 w-64 h-[calc(100vh-4rem)] bg-white shadow-md transition-transform duration-300 transform md:translate-x-0 md:static md:block"
    >
    <div class="p-1 text-center border-b">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 12c2.5 0 4.5-2 4.5-4.5S14.5 3 12 3s-4.5 2-4.5 4.5S9.5 12 12 12zm0 2c-4 0-7 2-7 4v1h14v-1c0-2-3-4-7-4z" />
        </svg>
        <h2 class="mt-2 text-lg font-semibold">Humas UKM KSR</h2>
        <p class="text-sm text-gray-500">Admin Humas</p>
    </div>
    <nav class="p-4 space-y-1.5">
        @php
            $navItems = [
                ['name' => 'Beranda', 'route' => '/dashboard', 'icon' => 'home.png', 'match' => 'dashboard'],
                ['name' => 'Anggota', 'route' => route('anggota.index'), 'icon' => 'multi.png', 'match' => 'anggota*'],
                ['name' => 'Data Nilai Anggota', 'route' => route('nilai.index'), 'icon' => 'add.png', 'match' => 'nilai*'],
                ['name' => 'Clustering', 'route' => route('clustering.index'), 'icon' => 'network.png', 'match' => 'clustering*'],
                ['name' => 'Tentang', 'route' => route('tentang.index'), 'icon' => 'info.png', 'match' => 'tentang*'],
                ['name' => 'Permohonan', 'route' => route('pesan-layanan.index'), 'icon' => 'file.png', 'match' => 'pesan-layanan*'],
                ['name' => 'Kepengurusan', 'route' => route('Kepengurusan.index'), 'icon' => 'pengurus.png', 'match' => 'Kepengurusan*'],
                ['name' => 'Program Kerja', 'route' => route('Program_kerja.index'), 'icon' => 'program.png', 'match' => 'Program_kerja*'],
                ['name' => 'Kegiatan', 'route' => route('kegiatan.index'), 'icon' => 'calendar.png', 'match' => 'kegiatan*'],
                ['name' => 'Layanan', 'route' => route('service.index'), 'icon' => 'heart.png', 'match' => 'service*'],
                ['name' => 'Blog', 'route' => route('blogadmin.index'), 'icon' => 'writing.png', 'match' => 'blogadmin'],
                ['name' => 'Galeri', 'route' => route('galeri.index'), 'icon' => 'image-galery.png', 'match' => 'galeri*'],
            ];
        @endphp

        @foreach ($navItems as $item)
            <a href="{{ $item['route'] }}" class="flex items-center p-2 rounded-md {{ request()->is($item['match']) ? 'bg-red-500 text-white' : 'hover:bg-gray-100 text-gray-700' }}">
                <img src="/img/icon/{{ $item['icon'] }}" alt="{{ $item['name'] }} Icon" class="w-6 h-6 {{ request()->is($item['match']) ? 'filter invert brightness-0' : '' }}">
                <span class="ml-2 text-xs sidebar-text">{{ $item['name'] }}</span>
            </a>
        @endforeach

        <p class="mt-4 text-xs font-semibold text-gray-600">Lainnya</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center w-full p-2 mt-2 text-red-500 rounded-md hover:bg-gray-100">
                <img src="/img/icon/logout.png" alt="Logout Icon" class="w-6 h-6">
                <span class="ml-2 text-xs font-semibold">Keluar</span>
            </button>
        </form>
    </nav>
</aside>
