@extends('admin.layout.navbar')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold">Detail Pengurus</h1>

    <p><strong>Nama Pengurus:</strong> {{ $pengurus->anggota->nama }}</p>

    <p><strong>Jabatan:</strong>  {{ $pengurus->jabatan->divisi->nama_divisi}} -{{ $pengurus->jabatan->nama_jabatan}}</p>
    <p><strong>Periode:</strong> {{ $pengurus->periode->nama_periode}}</p>

    @if ($pengurus->anggota && $pengurus->anggota->foto)
    <div class="mt-4">
        <img src="{{ asset('storage/' . $pengurus->anggota->foto) }}"
             alt="Foto Anggota"
             class="object-cover w-40 h-40 rounded">
    </div>
@else
    <p class="text-sm text-gray-500">Foto tidak tersedia.</p>
@endif


    <div class="flex justify-end gap-4 mt-6">
        <a href="{{ route('Kepengurusan.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Kembali</a>
        <a href="{{ route('Kepengurusan.edit', $pengurus->id) }}" class="px-4 py-2 text-white bg-yellow-500 rounded">Edit</a>
    </div>
</div>
@endsection
