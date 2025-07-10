
    @extends('admin.layout.navbar')
    @section('content')
    <div class="container p-8 mx-auto">
        <h2 class="mb-6 text-2xl font-bold text-gray-700">Tambah Anggota</h2>
        <form action="{{ route('anggota.store') }}" method="POST" class="p-6 space-y-6 bg-white rounded-lg shadow-md" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col space-y-2">
                <label for="nama" class="font-medium text-gray-700">Nama Lengkap</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="Nama_panggilan" class="font-medium text-gray-700">Nama Panggilan</label>
                <input
                    type="text"
                    id="Nama_panggilan"
                    name="Nama_panggilan"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nama panggilan">
            </div>
            <div class="flex flex-col space-y-2">
                <label for="nim" class="font-medium text-gray-700">NIM</label>
                <input
                    type="text"
                    id="nim"
                    name="nim"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan NIM"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="tempat_lahir" class="font-medium text-gray-700">Tempat Lahir</label>
                <input
                    type="text"
                    id="tempat_lahir"
                    name="tempat_lahir"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan tempat lahir">
            </div>
            <div class="flex flex-col space-y-2">
                <label for="tanggal_lahir" class="font-medium text-gray-700">Tanggal Lahir</label>
                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tanggal Lahir"
                    required>
            </div>
            {{-- ... (sebelum baris Angkatan) --}}

            <div class="flex flex-col space-y-2">
                <label for="email" class="font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan email">
            </div>
            <div class="flex flex-col space-y-2">
                <label for="Agama" class="font-medium text-gray-700">Agama</label>
                <input
                    type="text"
                    id="Agama"
                    name="Agama"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan agama">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="Gol_darah" class="font-medium text-gray-700">Golongan Darah</label>
                <input
                    type="text"
                    id="Gol_darah"
                    name="Gol_darah"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan golongan darah">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="organisasi_yg_pernah_diikuti" class="font-medium text-gray-700">Organisasi yang Pernah Diikuti</label>
                <textarea
                    id="organisasi_yg_pernah_diikuti"
                    name="organisasi_yg_pernah_diikuti"
                    rows="3"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tulis organisasi yang pernah diikuti"></textarea>
            </div>

            <div class="flex flex-col space-y-2">
                <label for="No_tlpn" class="font-medium text-gray-700">No. Telepon</label>
                <input
                    type="text"
                    id="No_tlpn"
                    name="No_tlpn"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan nomor telepon aktif">
            </div>

            <div class="flex flex-col space-y-2">
                <label for="angkatan" class="font-medium text-gray-700">Angkatan</label>
                <input
                    type="text"
                    id="angkatan"
                    name="angkatan"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan angkatan"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="jurusan" class="font-medium text-gray-700">jurusan</label>
                <input
                    type="text"
                    id="jurusan"
                    name="jurusan"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan jurusan"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="prodi" class="font-medium text-gray-700">prodi</label>
                <input
                    type="text"
                    id="prodi"
                    name="prodi"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan prodi"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="tahun_masuk_kuliah" class="font-medium text-gray-700">Tahun Kuliah</label>
                <input
                    type="text"
                    id="tahun_masuk_kuliah"
                    name="tahun_masuk_kuliah"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan tahun masuk kuliah"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label class="font-medium text-gray-700">Jenis Kelamin</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="jenis_kelamin" value="laki-laki" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <span>Laki-laki</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="jenis_kelamin" value="perempuan" class="w-4 h-4 text-blue-600 focus:ring-blue-500">
                        <span>Perempuan</span>
                    </label>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="status" class="font-medium text-gray-700">Status</label>
                <select
                    id="status"
                    name="status"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="" disabled selected>Pilih status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                    <option value="Inaktif">Inaktif</option>
                </select>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="alamat" class="font-medium text-gray-700">Alamat</label>
                <input
                    type="text"
                    id="alamat"
                    name="alamat"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan alamat"
                    required>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="alasan_join" class="font-medium text-gray-700">Alasan Bergabung</label>
                <textarea
                    id="summernote"
                    name="alasan_join"
                    rows="4"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan alasan Bergabung KSR"
                    required></textarea>
            </div>
            <div class="flex flex-col space-y-2">
                <label for="foto" class="font-medium text-gray-700">Foto</label>
                <input
                    type="file"
                    id="foto"
                    name="foto"
                    class="p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    accept="image/*">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-md hover:bg-green-600">
                    Simpan
                </button>
            </div>
        </form>
    </div>

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

@endsection



