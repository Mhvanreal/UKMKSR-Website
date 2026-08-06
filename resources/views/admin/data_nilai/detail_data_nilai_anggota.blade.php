
    @extends('admin.layout.navbar')
    @section('content')
    <div class="container p-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-gray-800">Detail Anggota</h2>
        <div class="p-6 space-y-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
                <div class="flex flex-col space-y-2">
                    <label for="nim" class="font-medium text-gray-700">NIM</label>
                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="{{$data_nilais->anggota->nim}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nama" class="font-medium text-gray-700">Nama</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{$data_nilais->anggota->nama}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="angkatan" class="font-medium text-gray-700">Angkatan</label>
                    <input
                        type="text"
                        id="angkatan"
                        name="angkatan"
                        value="{{$data_nilais->anggota->angkatan}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">prodi</label>
                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        value="{{$data_nilais->anggota->prodi}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nilai_kehadiran" class="font-medium text-gray-700">Nilai Kehadiran</label>
                    <input
                        type="text"
                        id="nilai_kehadiran"
                        name="nilai_kehadiran"
                        value="{{$data_nilais->nilai_kehadiran}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nilai_kontribusi" class="font-medium text-gray-700">Nilai Kontribusi</label>
                    <input
                        type="text"
                        id="nilai_kontribusi"
                        name="nilai_kontribusi"
                        value="{{$data_nilais->nilai_kontribusi}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nilai_kompetensi" class="font-medium text-gray-700">Nilai Kompetensi</label>
                    <input
                        type="text"
                        id="nilai_kompetensi"
                        name="nilai_kompetensi"
                        value="{{$data_nilais->nilai_kompetensi}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nilai_etika" class="font-medium text-gray-700">Nilai Etika</label>
                    <input
                        type="text"
                        id="nilai_etika"
                        name="nilai_etika"
                        value="{{$data_nilais->nilai_etika}}"
                        class="p-3 border border-gray-200 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('nilai.index') }}" class="px-6 py-3 bg-gray-100 border border-gray-200 text-gray-700 rounded-md hover:bg-gray-200">
                    Kembali
                </a>
                <a href="{{ route('nilai.edit', $data_nilais->anggota_id) }}" class="px-6 py-3 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                    Edit
                </a>
            </div>
        </div>
    </div>

@endsection