@extends('admin.layout.navbar')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold">Tambah Blog Artikel</h1>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-600 bg-red-100 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form tambah blog --}}
    <form action="{{ route('blogadmin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col space-y-2">
            <label for="judul" class="text-gray-700 py-2 font-medium">Judul</label>
            <input
                type="text"
                id="judul"
                name="judul"
                value="{{ old('judul') }}"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Judul"
                required>
        </div>

        <div class="flex flex-col space-y-2 mt-4">
            <label for="tanggal" class="py-2 font-medium text-gray-700">Tanggal Publikasi</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                value="{{ old('tanggal') }}"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>

        <div class="flex flex-col space-y-2 mt-4">
            <label for="gambar" class="py-2 font-medium text-gray-700">Gambar</label>
            <input
                type="file"
                id="gambar"
                name="gambar"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
        </div>

        <div class="flex flex-col space-y-2 mt-4">
            <label for="deskripsi" class="py-2 font-medium text-gray-700">Deskripsi</label>
            <textarea
                id="summernote"
                name="deskripsi"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('blogadmin.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">Simpan</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    {{-- Summernote & jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                placeholder: 'Tulis deskripsi artikel di sini...',
            });
        });
    </script>
@endpush
