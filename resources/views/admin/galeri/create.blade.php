@extends('admin.layout.navbar')

@section('content')

<body class="text-gray-800 bg-gray-100">
    <div class="px-4 py-5 mx-auto max-w-7xl">
        <div class="flex flex-col gap-1 mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Galeri</h1>
            <p class="text-sm text-gray-500">Unggah foto atau video untuk galeri UKM KSR</p>
        </div>
        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data"
            class="p-6 bg-white border border-gray-200 rounded-2xl shadow-sm max-w-2xl">
            @csrf

            <!-- Hidden input untuk id_jenis_galeri -->
            <input type="hidden" name="id_jenis_galeri" id="id_jenis_galeri" value="{{ $tipe }}">

            @if($tipe === 'foto')
            <div class="mb-4">
                <label for="foto_galeri" class="block mb-1 text-sm font-medium text-gray-700">Foto Galeri</label>
                <input type="file" id="foto_galeri" name="foto_galeri" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" onchange="setJenisGaleri(1)">
            </div>
            @elseif($tipe === 'video')
            <div class="mb-4">
                <label for="video_galeri" class="block mb-1 text-sm font-medium text-gray-700">Video Galeri</label>
                <input type="file" id="video_galeri" name="video_galeri" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" onchange="setJenisGaleri(2)">
            </div>
            @endif

            <div class="mb-4">
                <label for="status" class="block mb-1 text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="aktif">Aktif</option>
                    <option value="tidak">Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Simpan</button>
        </form>
    </div>

    <script>
        // Fungsi untuk mengatur jenis galeri secara dinamis
        function setJenisGaleri(tipe) {
            document.getElementById('id_jenis_galeri').value = tipe;
        }
    </script>
</body>
@endsection