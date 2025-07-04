

@extends('admin.layout.navbar')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold">Tambah Blog Artikel</h1>

    <form action="{{route('blogadmin.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col space-y-2">
            <label for="judul" class="text-gray-700 py-font-medium">Judul</label>
            <input
                type="text"
                id="judul"
                name="judul"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan Judul"
                required>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="tanggal" class="py-2 font-medium text-gray-700">Tanggal Publikasi</label>
            <input
                type="date"
                id="tanggal"
                name="tanggal"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required>
        </div>
        <div class="flex flex-col space-y-2">
            <label for="gambar" class="py-2 font-medium text-gray-700">Gambar</label>
            <input
                type="file"
                id="gambar"
                name="gambar"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                accept="image/*">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="deskripsi" class="py-2 font-medium text-gray-700">Deskripsi</label>
            <textarea
                id="summernote"
                name="deskripsi"
                class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required></textarea>
        </div>
        <div class="flex justify-end gap-4 mt-4">
            <a href="{{route('blogadmin.index')}}" class="px-4 py-2 text-white bg-gray-500 rounded">Batal</a>

            <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Simpan</button>
        </div>
    </form>
</div>

<<<<<<< HEAD
@endsection
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 150,
=======

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 200,
                placeholder: 'Tulis deskripsi blog di sini...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
>>>>>>> c95d96e918cd0a611200ec1384bc91ce913d8088
        });
    });
</script>

    <!-- Tambahkan SweetAlert -->
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
@endpush
@endsection


