
    @extends('admin.layout.navbar')
    @section('content')
    <div class="container p-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-gray-700">Detail Anggota</h2>
        <div class="p-6 space-y-6 bg-white rounded-lg shadow-md">
                <div class="flex flex-col space-y-2">
                    @if ($data_anggota->foto)
                        <div class="mb-2">
                            <img src="{{asset('storage/'. $data_anggota->foto)}}" alt="foto anggota" class="object-cover rounded-full w-44 h-44">
                        </div>
                    @else
                        <div class="object-cover rounded-full w-44 h-44">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-gray-300 size-32">
                                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nama" class="font-medium text-gray-700">Nama Lengkap</label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{$data_anggota->nama}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nama" class="font-medium text-gray-700">Nama Panggilan</label>
                    <input
                        type="text"
                        id="Nama_panggilan"
                        name="Nama_panggilan"
                        value="{{$data_anggota->Nama_panggilan}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nim" class="font-medium text-gray-700">NIM</label>
                    <input
                        type="text"
                        id="nim"
                        name="nim"
                        value="{{$data_anggota->nim}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nim" class="font-medium text-gray-700">Tempat lahir</label>
                    <input
                        type="text"
                        id="tempat_lahir"
                        name="tempat_lahir"
                        value="{{$data_anggota->tempat_lahir}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="tanggal_lahir" class="font-medium text-gray-700">Tanggal Lahir</label>
                    <input
                        type="text"
                        id="tanggal_lahir"
                        name="tanggal_lahir"
                        value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($data_anggota->tanggal_lahir)->format('Y-m-d')) }}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="angkatan" class="font-medium text-gray-700">Angkatan</label>
                    <input
                        type="text"
                        id="angkatan"
                        name="angkatan"
                        value="{{$data_anggota->angkatan}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div><div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">email</label>
                    <input
                        type="text"
                        id="email"
                        name="email"
                        value="{{$data_anggota->email}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                 <div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">No_tlpn</label>
                    <input
                        type="number"
                        id="No_tlpn"
                        name="No_tlpn"
                        value="{{$data_anggota->No_tlpn}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="jurusan" class="font-medium text-gray-700">Agama</label>
                    <input
                        type="text"
                        id="Agama"
                        name="Agama"
                        value="{{$data_anggota->Agama}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="jurusan" class="font-medium text-gray-700">jurusan</label>
                    <input
                        type="text"
                        id="jurusan"
                        name="jurusan"
                        value="{{$data_anggota->jurusan}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>


                <div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">prodi</label>
                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        value="{{$data_anggota->prodi}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="tahun_masuk_kuliah" class="font-medium text-gray-700">Tahun Kuliah</label>
                    <input
                        type="text"
                        id="tahun_masuk_kuliah"
                        name="tahun_masuk_kuliah"
                        value="{{$data_anggota->tahun_masuk_kuliah}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">Jenis Kelamin</label>
                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        value="{{$data_anggota->jenis_kelamin}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nim" class="font-medium text-gray-700">Golongan Darah</label>
                    <input
                        type="text"
                        id="Gol_darah"
                        name="Gol_darah"
                        value="{{$data_anggota->Gol_darah}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="prodi" class="font-medium text-gray-700">Status Anggota</label>
                    <input
                        type="text"
                        id="prodi"
                        name="prodi"
                        value="{{$data_anggota->status}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="alamat" class="font-medium text-gray-700">Alamat</label>
                    <input
                        type="text"
                        id="alamat"
                        name="alamat"
                        value="{{$data_anggota->alamat}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="nim" class="font-medium text-gray-700">Organisasi yg pernah diikuti</label>
                    <input
                        type="text"
                        id="organisasi_yg_pernah_diikuti"
                        name="organisasi_yg_pernah_diikuti"
                        value="{{$data_anggota->organisasi_yg_pernah_diikuti}}"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>
                </div>
                <div class="flex flex-col space-y-2">
                    <label for="alasan_join" class="font-medium text-gray-700">Alasan Bergabung</label>
                    <textarea
                        id="summernote"
                        name="alasan_join"
                        rows="4"
                        class="p-3 bg-gray-200 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onmousedown="return false;" onselectstart="return false;"
                        required>{{ old('alasan_join', $data_anggota->alasan_join) }}</textarea>
                </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('anggota.index') }}" class="px-6 py-3 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">
                    Kembali
                </a>
                <a href="{{ route('anggota.edit', $data_anggota->id) }}" class="px-6 py-3 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                    Edit
                </a>
            </div>
        </div>
    </div>

@endsection
