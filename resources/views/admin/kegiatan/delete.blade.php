@extends('admin.layout.navbar')

@section('content')
    <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm max-w-2xl">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Hapus Kegiatan</h1>
        <p class="text-gray-600">Apakah Anda yakin ingin menghapus kegiatan <strong>{{ $kegiatan->nama_kegiatan }}</strong>?</p>

        <form action="{{ route('kegiatan.destroy', $kegiatan->id_kegiatan) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex gap-3 mt-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Ya, Hapus</button>
                <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
@endsection
