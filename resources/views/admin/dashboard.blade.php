
    @extends('admin.layout.navbar')
    @section('content')
    <h1 class="mb-2 text-2xl font-bold">Beranda</h1>
    <div class="container py-8 mx-auto">
    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="flex flex-col justify-center h-48 p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
            <h3 class="mb-2 text-center text-gray-500">Seluruh Anggota {{$tahun_sekarang}}</h3>
            <p class="text-6xl font-bold text-center text-gray-500" id="total-members"></p>
        </div>

        <div class="flex flex-col justify-center h-48 p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
            <h3 class="mb-2 text-center text-gray-500">Anggota Aktif {{$tahun_sekarang}}</h3>
            <p class="text-6xl font-bold text-center text-gray-500" id="active-members"></p>
        </div>

        <div class="flex flex-col justify-center h-48 p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
            <h3 class="mb-2 text-center text-gray-500">Anggota In-Aktif {{$tahun_sekarang}}</h3>
            <p class="text-6xl font-bold text-center text-gray-500" id="inactive-members"></p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 mt-8 md:grid-cols-3">
        <div class="p-6 transition bg-white shadow rounded-2xl hover:shadow-xl md:col-span-2">
            <h3 class="mb-4 text-gray-500">Statistik Jumlah Anggota</h3>
            <canvas id="anggotaChart" class="w-full h-40"></canvas>
        </div>

        <div class="flex flex-col gap-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="flex flex-col justify-center h-48 p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
                    <h3 class="mb-2 text-center text-gray-500">Kegiatan {{$tahun_sekarang}}</h3>
                    <p class="text-6xl font-bold text-center text-gray-500" id="event-count"></p>
                </div>

                <div class="flex flex-col justify-center h-48 p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
                    <h3 class="mb-2 text-center text-gray-500">Layanan {{$tahun_sekarang}}</h3>
                    <p class="text-6xl font-bold text-center text-gray-500" id="service-count"></p>
                </div>
            </div>

           <div class="p-6 transition bg-white shadow rounded-2xl hover:shadow-xl">
            <h3 class="mb-4 text-lg font-semibold text-center text-gray-500">Ulang Tahun Anggota</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-black table-fixed">
                    <thead class="text-xs text-white uppercase bg-red-500">
                        <tr>
                            <th class="w-10 px-4 py-2">No</th>
                            <th class="w-32 px-4 py-2">Nama</th>
                            <th class="w-24 px-4 py-2">Angkatan</th>
                            <th class="w-32 px-4 py-2">Prodi</th>
                            <th class="w-32 px-4 py-2">Tanggal Lahir</th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="overflow-x-auto overflow-y-auto max-h-60">
                <table class="min-w-full text-sm text-left text-black table-fixed">
                    <tbody>
                        @forelse ($ulang_tahun_anggota as $index => $anggota)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="w-10 px-4 py-2">{{ $index + 1 }}</td>
                                <td class="w-32 px-4 py-2 truncate">{{ $anggota->nama }}</td>
                                <td class="w-24 px-4 py-2">{{ $anggota->angkatan }}</td>
                                <td class="w-32 px-4 py-2 truncate">{{ $anggota->prodi }}</td>
                                <td class="w-32 px-4 py-2">{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center">Tidak ada ulang tahun dalam 2 minggu ke depan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        </div>

        </div>
    </div>

    <footer class="mt-10 text-center text-gray-500">
        © 2025 Unit Kegiatan Mahasiswa Korps Sukarela (UKM KSR)
    </footer>

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
                    backgroundColor: ['#22C55E', '#22C55E', '#22C55E', '#22C55E', '#22C55E'],
                    borderRadius: 10,
                    barThickness: 35
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script>
        const jumlah_seluruh_anggota = {{$jumlah_seluruh_anggota ?? 0}};
        const jumlah_seluruh_anggota_aktif = {{$jumlah_seluruh_anggota_aktif ?? 0}};
        const jumlah_seluruh_anggota_in_aktif = {{$jumlah_seluruh_anggota_in_aktif ?? 0}};
        const jumlah_kegiatan = {{$jumlah_kegiatan ?? 0}};
        const jumlah_layanan = {{$jumlah_layanan ?? 0}};

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
        animateValue("active-members", 0, jumlah_seluruh_anggota_aktif && jumlah_seluruh_anggota_aktif != null ? jumlah_seluruh_anggota_aktif : 0, 1000);
        animateValue("inactive-members", 0, jumlah_seluruh_anggota_in_aktif && jumlah_seluruh_anggota_in_aktif != null ? jumlah_seluruh_anggota_in_aktif : 0, 1000);
        animateValue("event-count", 0, jumlah_kegiatan ? jumlah_kegiatan : 0, 1000);
        animateValue("service-count", 0, jumlah_layanan ? jumlah_layanan : 0, 1000);
    </script>

    @endsection
