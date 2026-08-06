@extends('admin.layout.navbar')

@section('content')
    <div class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm max-w-2xl">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Hapus Layanan</h1>
        <p class="text-gray-600">Apakah Anda yakin ingin menghapus layanan <strong>{{ $layanan->nama_layanan }}</strong>?</p>

        <form action="{{ route('service.destroy', $layanan->id_layanan) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex gap-3 mt-4">
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Ya, Hapus</button>
                <a href="{{ route('service.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>
            </div>
        </form>
    </div>
@endsection
