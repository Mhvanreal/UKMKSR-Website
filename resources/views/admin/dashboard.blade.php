
@extends('admin.layout.navbar')
@section('content')

@php
    $statCards = [
        ['id' => 'total-members', 'label' => 'Seluruh Anggota', 'value' => $jumlah_seluruh_anggota ?? 0, 'icon' => 'fa-users'],
        ['id' => 'active-members', 'label' => 'Anggota Aktif', 'value' => $jumlah_seluruh_anggota_aktif ?? 0, 'icon' => 'fa-user-check'],
        ['id' => 'alumni-members', 'label' => 'Anggota Alumni', 'value' => $jumlah_seluruh_anggota_alumni ?? 0, 'icon' => 'fa-user-graduate'],
        ['id' => 'event-count', 'label' => 'Kegiatan Aktif', 'value' => $jumlah_kegiatan ?? 0, 'icon' => 'fa-calendar-days'],
        ['id' => 'service-count', 'label' => 'Layanan Aktif', 'value' => $jumlah_layanan ?? 0, 'icon' => 'fa-heart'],
    ];
@endphp

<!-- Page Header -->
<div class="flex flex-col gap-3 mb-6 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h1>
        <p class="text-sm text-gray-500 mt-0.5">Ringkasan data UKM KSR Palang Merah Indonesia tahun {{ $tahun_sekarang }}</p>
    </div>
    <span class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg shadow-sm w-fit">
        <i class="text-red-600 fas fa-calendar-alt"></i>
        {{ \Carbon\Carbon::now()->format('l, d F Y') }}
    </span>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">
    @foreach ($statCards as $card)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm border-t-4 border-t-red-600 transition hover:shadow-md">
            <div class="p-5">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-red-50 rounded-xl border border-red-100">
                        <i class="text-xl text-red-600 fas {{ $card['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 leading-tight">{{ $card['label'] }}</p>
                        <p class="mt-1 text-3xl font-bold text-gray-800" id="{{ $card['id'] }}">0</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Chart + Ulang Tahun -->
<div class="grid grid-cols-1 gap-6 mt-6 xl:grid-cols-3">

    <!-- Chart Card -->
    <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm xl:col-span-2">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h3 class="text-base font-semibold text-gray-800">Statistik Jumlah Anggota</h3>
                <p class="text-xs text-gray-400">Berdasarkan angkatan {{ $angkatan_grafik[0] }} - {{ $angkatan_grafik[count($angkatan_grafik) - 1] }}</p>
            </div>
            <span class="hidden px-3 py-1.5 text-xs font-semibold text-red-700 bg-red-50 border border-red-100 rounded-lg sm:block">
                <i class="fas fa-chart-bar mr-1"></i> Grafik
            </span>
        </div>
        <div class="relative h-64">
            <canvas id="anggotaChart"></canvas>
        </div>
    </div>

    <!-- Ulang Tahun Card -->
    <div class="flex flex-col bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
            <div>
                <h3 class="text-base font-semibold text-gray-800">Ulang Tahun Anggota</h3>
                <p class="text-xs text-gray-400">14 hari ke depan</p>
            </div>
            <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-red-50 border border-red-100 text-red-600">
                <i class="fas fa-cake-candles"></i>
            </span>
        </div>

        <div class="overflow-x-auto flex-1">
            <table class="min-w-full text-sm text-left">
                <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-4 py-3 font-semibold">No</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Angkatan</th>
                        <th class="px-4 py-3 font-semibold">Prodi</th>
                        <th class="px-4 py-3 font-semibold">Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($ulang_tahun_anggota as $index => $anggota)
                        @php
                            $isToday = \Carbon\Carbon::parse($anggota->tanggal_lahir)->isToday();
                        @endphp
                        <tr class="transition hover:bg-red-50/40">
                            <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-gray-800 truncate max-w-[10rem]">{{ $anggota->nama }}</p>
                                @if ($isToday)
                                    <span class="inline-flex mt-1 px-2 py-0.5 text-[10px] font-bold text-white bg-red-600 rounded-full">Hari ini!</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $anggota->angkatan }}</td>
                            <td class="px-4 py-3 text-gray-600 truncate max-w-[8rem]">{{ $anggota->prodi }}</td>
                            <td class="px-4 py-3 text-gray-600 whitespace-nowrap">{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-gray-400">
                                <i class="fas fa-calendar-xmark text-3xl mb-2 block text-gray-300"></i>
                                Tidak ada ulang tahun dalam 2 minggu ke depan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const datas = @json($data_grafik);
    const labels = @json($angkatan_grafik);

    const ctx = document.getElementById('anggotaChart').getContext('2d');
    const anggotaChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah',
                data: datas,
                backgroundColor: 'rgba(220, 38, 38, 0.85)',
                hoverBackgroundColor: '#DC2626',
                borderRadius: 8,
                barThickness: 30,
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    grid: { color: '#F1F5F9' },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
</script>

<script>
    const jumlah_seluruh_anggota = {{ $jumlah_seluruh_anggota ?? 0 }};
    const jumlah_seluruh_anggota_aktif = {{ $jumlah_seluruh_anggota_aktif ?? 0 }};
    const jumlah_seluruh_anggota_alumni = {{ $jumlah_seluruh_anggota_alumni ?? 0 }};
    const jumlah_kegiatan = {{ $jumlah_kegiatan ?? 0 }};
    const jumlah_layanan = {{ $jumlah_layanan ?? 0 }};

    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);

        if (end === start) {
            obj.textContent = end;
            return;
        }

        let current = start;
        const increment = end > start ? 1 : -1;
        const stepTime = Math.abs(Math.floor(duration / Math.abs(end - start)));

        const timer = setInterval(function() {
            current += increment;
            obj.textContent = current;
            if (current === end) {
                clearInterval(timer);
            }
        }, stepTime);
    }

    animateValue("total-members", 0, jumlah_seluruh_anggota ? jumlah_seluruh_anggota : 0, 1000);
    animateValue("active-members", 0, jumlah_seluruh_anggota_aktif && jumlah_seluruh_anggota_aktif != null ?
        jumlah_seluruh_anggota_aktif : 0, 1000);
    animateValue("alumni-members", 0, jumlah_seluruh_anggota_alumni && jumlah_seluruh_anggota_alumni != null ?
        jumlah_seluruh_anggota_alumni : 0, 1000);
    animateValue("event-count", 0, jumlah_kegiatan ? jumlah_kegiatan : 0, 1000);
    animateValue("service-count", 0, jumlah_layanan ? jumlah_layanan : 0, 1000);
</script>

@endsection
