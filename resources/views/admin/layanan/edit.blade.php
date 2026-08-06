
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Edit Layanan</h1>

        <form action="{{ route('service.update', $layanan->id_layanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block font-semibold text-gray-700">Nama Layanan:</label>
            <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>

            <label class="block mt-3 font-semibold text-gray-700">Deskripsi:</label>
            <textarea name="deskripsi_layanan" class="w-full p-3 border border-gray-300 rounded-lg" id="summernote">{{ $layanan->deskripsi_layanan }}</textarea>

            <label class="block mt-3 font-semibold text-gray-700">Foto:</label>
            <input type="file" name="foto_layanan" class="w-full p-3 border border-gray-300 rounded-lg">
            @if ($layanan->foto_layanan)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $layanan->foto_layanan) }}" class="object-cover w-32 h-32 rounded-lg" alt="Foto Layanan">
                </div>
            @endif

            <label class="block mt-3 font-semibold text-gray-700">Poster:</label>
            <input type="file" name="poster_layanan" class="w-full p-3 border border-gray-300 rounded-lg">
            @if ($layanan->poster_layanan)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $layanan->poster_layanan) }}" class="object-cover w-32 h-32 rounded-lg" alt="Poster Layanan">
                </div>
            @endif

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('service.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Update</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                placeholder: 'Deskripsi Layanan...',
            });
        });
    </script>
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
    @endsection