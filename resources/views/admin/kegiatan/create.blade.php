
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl mx-auto bg-white border border-gray-200 p-6 rounded-2xl shadow-sm">
        <div class="flex flex-col gap-1 mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Kegiatan</h1>
            <p class="text-sm text-gray-500">Tambahkan kegiatan baru UKM KSR</p>
        </div>

        <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="block font-semibold text-gray-700">Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>

            <label class="block font-semibold text-gray-700 mt-3">Deskripsi:</label>
            <textarea id="summernote" name="deskripsi_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg"></textarea>

            <label class="block font-semibold text-gray-700 mt-3">Tanggal Mulai:</label>
            <input type="date" name="start_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>

            <label class="block font-semibold text-gray-700 mt-3">Tanggal Selesai:</label>
            <input type="date" name="end_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>

            <label class="block font-semibold text-gray-700 mt-3">Foto:</label>
            <input type="file" name="foto_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

            <label class="block font-semibold text-gray-700 mt-3">Poster:</label>
            <input type="file" name="poster_kegiatan" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">

            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
            });
        });
    </script>
    @endsection