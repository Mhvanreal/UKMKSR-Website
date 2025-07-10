@extends('admin.layout.navbar')
@section('content')
<div class="container p-8 mx-auto">
    <h2 class="mb-6 text-2xl font-bold text-gray-700">Edit Anggota</h2>
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" class="p-6 space-y-6 bg-white rounded-lg shadow-md" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col space-y-2">
            <label for="nama" class="font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ $anggota->nama }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="nim" class="font-medium text-gray-700">NIM</label>
            <input type="text" id="nim" name="nim" value="{{ $anggota->nim }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="email" class="font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" value="{{ $anggota->email }}" class="p-3 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="nama_panggilan" class="font-medium text-gray-700">Nama Panggilan</label>
            <input type="text" id="nama_panggilan" name="nama_panggilan" value="{{ $anggota->Nama_panggilan ?? '' }}" class="p-3 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="tanggal_lahir" class="font-medium text-gray-700">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('Y-m-d')) }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="tempat_lahir" class="font-medium text-gray-700">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $anggota->tempat_lahir ?? '' }}" class="p-3 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="agama" class="font-medium text-gray-700">Agama</label>
            <input type="text" id="agama" name="agama" value="{{ $anggota->Agama ?? '' }}" class="p-3 border border-gray-300 rounded-md">
        </div>

         <div class="flex flex-col space-y-2">
            <label for="No_tlpn" class="font-medium text-gray-700">No Telepon</label>
            <input type="text" id="No_tlpn" name="No_tlpn" value="{{ $anggota->No_tlpn }}" class="p-3 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="gol_darah" class="font-medium text-gray-700">Golongan Darah</label>
            <input type="text" id="gol_darah" name="gol_darah" value="{{ $anggota->Gol_darah ?? '' }}" class="p-3 border border-gray-300 rounded-md">
        </div>

        <div class="flex flex-col space-y-2">
            <label for="organisasi_yg_pernah_diikuti" class="font-medium text-gray-700">Organisasi yang Pernah Diikuti</label>
            <textarea id="organisasi_yg_pernah_diikuti" name="organisasi_yg_pernah_diikuti" class="p-3 border border-gray-300 rounded-md">{{ old('organisasi_yg_pernah_diikuti', $anggota->organisasi_yg_pernah_diikuti) }}</textarea>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="angkatan" class="font-medium text-gray-700">Angkatan</label>
            <input type="text" id="angkatan" name="angkatan" value="{{ $anggota->angkatan }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="jurusan" class="font-medium text-gray-700">Jurusan</label>
            <input type="text" id="jurusan" name="jurusan" value="{{ $anggota->jurusan }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="prodi" class="font-medium text-gray-700">Prodi</label>
            <input type="text" id="prodi" name="prodi" value="{{ $anggota->prodi }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="tahun_masuk_kuliah" class="font-medium text-gray-700">Tahun Masuk Kuliah</label>
            <input type="text" id="tahun_masuk_kuliah" name="tahun_masuk_kuliah" value="{{ $anggota->tahun_masuk_kuliah }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label class="font-medium text-gray-700">Jenis Kelamin</label>
            <div class="flex items-center space-x-4">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="jenis_kelamin" value="laki-laki" class="w-4 h-4" @checked($anggota->jenis_kelamin == 'laki-laki')>
                    <span>Laki-laki</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="jenis_kelamin" value="perempuan" class="w-4 h-4" @checked($anggota->jenis_kelamin == 'perempuan')>
                    <span>Perempuan</span>
                </label>
            </div>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="status" class="font-medium text-gray-700">Status</label>
            <select id="status" name="status" class="p-3 border border-gray-300 rounded-md" required>
                <option value="Aktif" {{ $anggota->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $anggota->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                <option value="Inaktif" {{ $anggota->status == 'Inaktif' ? 'selected' : '' }}>Inaktif</option>
            </select>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="alamat" class="font-medium text-gray-700">Alamat</label>
            <input type="text" id="alamat" name="alamat" value="{{ $anggota->alamat }}" class="p-3 border border-gray-300 rounded-md" required>
        </div>

        <div class="flex flex-col space-y-2">
            <label for="alasan_join" class="font-medium text-gray-700">Alasan Bergabung</label>
            <textarea id="summernote" name="alasan_join" rows="4" class="p-3 border border-gray-300 rounded-md">{{ old('alasan_join', $anggota->alasan_join) }}</textarea>
        </div>


        <div class="flex flex-col space-y-2">
            <label for="foto" class="font-medium text-gray-700">Foto</label>
            @if ($anggota->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="foto anggota" class="w-32 h-32 rounded-md">
                </div>
            @endif
            <input type="file" id="foto" name="foto" class="p-3 border border-gray-300 rounded-md" accept="image/*">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('anggota.index') }}" class="px-6 py-3 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Kembali</a>
            <button type="submit" class="px-6 py-3 text-white bg-green-500 rounded-md hover:bg-green-600">Simpan</button>
        </div>
    </form>
</div>

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
