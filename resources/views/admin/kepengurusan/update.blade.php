<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kepengurusan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script> <!-- Add Alpine.js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="text-gray-800 bg-gray-100">
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
        <h1 class="mb-4 text-2xl font-bold text-gray-800">Edit Pengurus</h1>

        <form action="{{ route('Kepengurusan.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Anggota</label>
                <select name="anggota_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Anggota --</option>
                    @foreach($anggota as $a)
                        <option value="{{ $a->id }}" {{ $a->id == $item->anggota_id ? 'selected' : '' }}>{{ $a->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <select name="jabatan_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                        <option value="{{ $j->id }}" {{ $j->id == $item->jabatan_id ? 'selected' : '' }}>
                            {{ $j->divisi->nama_divisi }} - {{ $j->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="periode_id" class="block text-sm font-medium text-gray-700">Periode</label>
                <select name="periode_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Periode --</option>
                    @foreach($periode as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $item->periode_id ? 'selected' : '' }}>
                            {{ $p->nama_periode }} ({{ $p->tahun_mulai }} - {{ $p->tahun_selesai }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('Kepengurusan.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded-lg hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>
@endsection

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



