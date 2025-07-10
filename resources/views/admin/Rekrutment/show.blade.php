@extends('admin.layout.navbar')

@section('content')
<div class="max-w-3xl p-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-2xl font-bold text-red-600">
        Detail Pendaftaran - {{ $rekrutmen->Nama ?? 'Data Tidak Ditemukan' }}
    </h2>

    <table class="w-full text-sm">
        <tr>
            <td class="w-40 py-1 font-semibold">No. Pendaftaran</td>
            <td>: {{ $rekrutmen->No_pendaftaran }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">NIM</td>
            <td>: {{ $rekrutmen->nim }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Nama Lengkap</td>
            <td>: {{ $rekrutmen->Nama }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Nama Panggilan</td>
            <td>: {{ $rekrutmen->Nama_panggilan }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Tempat, Tanggal Lahir</td>
            <td>: {{ $rekrutmen->tempat_lahir ?? '-' }}, {{ \Carbon\Carbon::parse($rekrutmen->tanggal_lahir)->translatedFormat('d M Y') }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Jenis Kelamin</td>
            <td>: {{ ucfirst($rekrutmen->jenis_kelamin) }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Agama</td>
            <td>: {{ $rekrutmen->Agama }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Jurusan</td>
            <td>: {{ $rekrutmen->jurusan }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Prodi</td>
            <td>: {{ $rekrutmen->prodi }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Email</td>
            <td>: {{ $rekrutmen->email }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">No. Telepon</td>
            <td>: {{ $rekrutmen->No_tlpn }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Golongan Darah</td>
            <td>: {{ $rekrutmen->Gol_darah }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Organisasi yang Pernah Diikuti</td>
            <td>: {{ $rekrutmen->organisasi_yg_pernah_diikuti }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold">Alasan Bergabung</td>
            <td>: {{ $rekrutmen->alasan_join }}</td>
        </tr>
        <tr>
            <td class="py-1 font-semibold align-top">Foto</td>
            <td>
                @if ($rekrutmen->foto)
                    <img src="{{ asset('storage/' . $rekrutmen->foto) }}" alt="Foto Pendaftar" class="w-32 border rounded">
                @else
                    Tidak ada foto
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('Rekrutment-anggota.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">
        &larr; Kembali ke daftar rekrutmen
    </a>
</div>
@endsection
