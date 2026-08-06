
    @extends('admin.layout.navbar')
    @section('content')
    <div class="flex flex-col gap-1 mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Clustering</h1>
        <p class="text-sm text-gray-500">Clustering Data Anggota Aktif KSR</p>
    </div>
    <div class="container py-1 mx-auto">
    <div class="flex items-center justify-between mb-4">
        <a href="/cluster"
            class="inline-flex items-center gap-2 px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 shadow-sm">
            <i class="fas fa-brain"></i>
            Mulai Clustering Data
        </a>
    </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
        @if($anggotas && $anggotas->count() > 0)
        <table class="w-full text-sm text-left text-black rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">NIM</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Angkatan</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kehadiran</th>
                    <th scope="col" class="px-6 py-3">Nilai Kontribusi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kompetensi</th>
                    <th scope="col" class="px-6 py-3">Nilai Etika</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotas as $key => $anggota)
                    <tr class="border-b transition hover:bg-red-50/40">
                        <td class="px-4 py-2 border-r">{{ $anggota->anggota->nim }}</td>
                        <td class="px-4 py-2 border-r truncate max-w-[80px] overflow-hidden">{{ $anggota->anggota->nama }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->anggota->angkatan }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->anggota->jenis_kelamin }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->anggota->prodi }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->nilai_kehadiran }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->nilai_kontribusi }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->nilai_kompetensi }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->nilai_etika }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $anggotas->links() }}
        </div>
        @else
        <table class="w-full text-sm text-left text-black rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">NIM</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Angkatan</th>
                    <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kehadiran</th>
                    <th scope="col" class="px-6 py-3">Nilai Kontribusi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kompetensi</th>
                    <th scope="col" class="px-6 py-3">Nilai Etika</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b transition hover:bg-red-50/40">
                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="10">Tidak Ada Data Anggota</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
    </div>
    @endsection
