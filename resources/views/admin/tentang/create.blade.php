
    @extends('admin.layout.navbar')
    @section('content')
    <div class="max-w-4xl p-6 mx-auto mt-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Tambah Tentang UKM KSR</h1>

        <form action="{{ route('tentang.store') }}" method="POST">
            @csrf

            <label class="block font-semibold text-gray-700">Deskripsi:</label>
            <textarea id="summernote" name="deskripsi_ksr" required>{{ old('deskripsi_ksr') }}</textarea>
            @error('deskripsi_ksr')
            <span class="text-xs text-red-500">{{ $message }}</span>
            @enderror

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('tentang.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded hover:bg-gray-200">Kembali</a>
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                placeholder: 'Tulis deskripsi tentang UKM KSR di sini...',
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageWidth: 'auto',
                imageHeight: 'auto',
                imageAlt: 'Detail Foto',
                showConfirmButton: false,
                backdrop: true
            });
        }
    </script>
    @endsection