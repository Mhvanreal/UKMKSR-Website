
    @extends('admin.layout.navbar')
    @section('content')
    <div class="container p-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Edit Blog</h2>
        <form action="{{ route('blogadmin.update', $blog->id) }}" method="POST" class="p-6 space-y-6 bg-white border border-gray-200 rounded-2xl shadow-sm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col space-y-2">
                <label for="judul" class="font-medium text-gray-700">Judul</label>
                <input
                    type="text"
                    id="judul"
                    name="judul"
                    value="{{$blog->title}}"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan Judul"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="tanggal" class="font-medium text-gray-700">Tanggal Publikasi</label>
                <input
                    type="date"
                    id="tanggal"
                    name="tanggal"
                    value="{{$blog->created_at->format('Y-m-d')}}"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="gambar" class="font-medium text-gray-700">Gambar</label>
                @if ($blog->images)
                    <div class="mb-2">
                        <img src="{{asset('storage/'. $blog->images)}}" alt="Gambar Blog" class="w-32 h-32 rounded-md">
                    </div>
                @endif
                <input
                    type="file"
                    id="gambar"
                    name="gambar"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    accept="image/*">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="deskripsi" class="font-medium text-gray-700">Deskripsi</label>
                <textarea
                    id="summernote"
                    name="deskripsi"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                    required>{{ $blog->description }}</textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 text-white bg-red-600 rounded-md hover:bg-red-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>

<!-- Tambahkan Script Summernote -->

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
        });
    </script>
@endpush

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




