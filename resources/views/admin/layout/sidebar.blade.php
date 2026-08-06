
<div class="flex flex-col h-full overflow-y-auto">

    <!-- Brand -->
    <div class="relative px-5 py-5 bg-gradient-to-br from-red-600 to-rose-600">
        <div class="absolute -top-8 -right-8 w-28 h-28 rounded-full bg-white/10"></div>
        <div class="absolute top-6 right-6 w-16 h-16 rounded-full bg-white/5"></div>
        <div class="relative flex items-center gap-3">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-white/20 text-white shadow">
                <i class="text-2xl fas fa-plus"></i>
            </div>
            <div>
                <h2 class="text-base font-bold text-white leading-tight">UKM KSR</h2>
                <p class="text-xs text-red-100">Palang Merah Indonesia</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1">

        <p class="px-3 mb-2 text-[11px] font-semibold tracking-wider uppercase text-gray-400">Menu Utama</p>

        @php
            $navItems = [
                ['name' => 'Beranda', 'route' => '/dashboard', 'icon' => 'fa-house', 'match' => 'dashboard'],
                ['name' => 'Anggota', 'route' => route('anggota.index'), 'icon' => 'fa-users', 'match' => 'anggota*'],

                ['name' => 'Permohonan', 'route' => route('pesan-layanan.index'), 'icon' => 'fa-file-lines', 'match' => 'pesan-layanan*'],
                ['name' => 'Kepengurusan', 'route' => route('Kepengurusan.index'), 'icon' => 'fa-user-tie', 'match' => 'Kepengurusan*'],
        
                ['name' => 'Program Kerja', 'route' => route('Program_kerja.index'), 'icon' => 'fa-clipboard-list', 'match' => 'Program_kerja*'],
                ['name' => 'Kegiatan', 'route' => route('kegiatan.index'), 'icon' => 'fa-calendar-days', 'match' => 'kegiatan*'],
                ['name' => 'Layanan', 'route' => route('service.index'), 'icon' => 'fa-heart', 'match' => 'service*'],
                ['name' => 'Rekrutment', 'route' => route('Rekrutment-anggota.index'), 'icon' => 'fa-user-plus', 'match' => 'rekrutment-anggota*'],
            ];
        @endphp

        @foreach ($navItems as $item)
            @php $active = request()->is($item['match']); @endphp
            <a href="{{ $item['route'] }}"
                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition
                       {{ $active ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                <i class="w-5 text-base text-center fas {{ $item['icon'] }}"></i>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach

        <p class="px-3 mt-6 mb-2 text-[11px] font-semibold tracking-wider uppercase text-gray-400">Lainnya</p>

        @php
            $otherItems = [
                ['name' => 'Blog', 'route' => route('blogadmin.index'), 'icon' => 'fa-pen-nib', 'match' => 'blogadmin'],
                ['name' => 'Galeri', 'route' => route('galeri.index'), 'icon' => 'fa-images', 'match' => 'galeri*'],
                ['name' => 'Tentang', 'route' => route('tentang.index'), 'icon' => 'fa-circle-info', 'match' => 'tentang*'],
            ];
        @endphp

        @foreach ($otherItems as $item)
            @php $active = request()->is($item['match']); @endphp
            <a href="{{ $item['route'] }}"
                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition
                       {{ $active ? 'bg-red-600 text-white shadow-md shadow-red-200' : 'text-gray-600 hover:bg-red-50 hover:text-red-700' }}">
                <i class="w-5 text-base text-center fas {{ $item['icon'] }}"></i>
                <span>{{ $item['name'] }}</span>
            </a>
        @endforeach
    </nav>

    <!-- Logout -->
    <div class="px-3 py-4 border-t border-red-100">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full gap-3 px-3 py-2.5 text-sm font-medium rounded-lg text-red-600 transition hover:bg-red-50">
                <i class="w-5 text-base text-center fas fa-right-from-bracket"></i>
                Keluar
            </button>
        </form>
    </div>
</div>
