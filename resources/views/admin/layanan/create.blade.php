
    @extends('admin.layout.navbar')

    @section('content')
    <div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="flex flex-col gap-1 mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Layanan</h1>
            <p class="text-sm text-gray-500">Tambahkan layanan baru untuk landing page</p>
        </div>

        <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block font-semibold text-gray-700">Nama Layanan:</label>
            <input type="text" name="nama_layanan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>

            <label class="block mt-3 font-semibold text-gray-700">Deskripsi:</label>
            <textarea id="summernote" name="deskripsi_layanan" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>

            <label class="block mt-3 font-semibold text-gray-700">Foto:</label>
            <input type="file" name="foto_layanan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

            <label class="block mt-3 font-semibold text-gray-700">Poster:</label>
            <input type="file" name="poster_layanan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('service.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>

                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>

    @endsection

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
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
</body>

</html>
