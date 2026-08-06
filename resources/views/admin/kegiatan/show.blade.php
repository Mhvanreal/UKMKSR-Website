
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl mx-auto bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Detail Kegiatan</h1>

        <p><strong>Nama Kegiatan:</strong> {{ $kegiatan->nama_kegiatan }}</p>

        <p><strong>Deskripsi:</strong></p>
        <p class="whitespace-pre-line">{{ nl2br(e($kegiatan->deskripsi_kegiatan)) }}</p>

        @if ($kegiatan->foto_kegiatan)
        <div class="mt-2">
            <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" class="w-32 h-32 object-cover rounded" alt="Foto Kegiatan">
        </div>
        @endif

        <div class="mt-4 flex gap-4 justify-end">
            <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Kembali</a>
            <a href="{{ route('kegiatan.edit', $kegiatan->id_kegiatan) }}" class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">Edit</a>
        </div>
    </div>
    @endsection
