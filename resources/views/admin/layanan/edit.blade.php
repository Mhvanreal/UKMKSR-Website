
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-2xl font-bold">Edit Layanan</h1>

        <form action="{{ route('service.update', $layanan->id_layanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block font-semibold">Nama Layanan:</label>
            <input type="text" name="nama_layanan" value="{{ $layanan->nama_layanan }}" class="w-full p-2 border rounded" required>

            <label class="block mt-3 font-semibold">Deskripsi:</label>
            <textarea name="deskripsi_layanan" class="w-full p-2 border rounded" id="summernote">{{ $layanan->deskripsi_layanan }}</textarea>

            <label class="block mt-3 font-semibold">Foto:</label>
            <input type="file" name="foto_layanan" class="w-full p-2 border rounded">
            @if ($layanan->foto_layanan)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $layanan->foto_layanan) }}" class="object-cover w-32 h-32 rounded" alt="Foto Layanan">
                </div>
            @endif

            <label class="block mt-3 font-semibold">Poster:</label>
            <input type="file" name="poster_layanan" class="w-full p-2 border rounded">
            @if ($layanan->poster_layanan)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $layanan->poster_layanan) }}" class="object-cover w-32 h-32 rounded" alt="Poster Layanan">
                </div>
            @endif

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('service.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Update</button>
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