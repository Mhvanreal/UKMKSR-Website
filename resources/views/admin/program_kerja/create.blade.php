<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Layanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="flex flex-col gap-1 mb-4">
        <h1 class="mb-1 text-2xl font-bold text-gray-800">Program Kerja Kepengurusan</h1>
        <p class="text-sm text-gray-500">Tambahkan program kerja untuk pengurus</p>
    </div>

    <form action="{{ route('Program_kerja.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium text-gray-700">Pilih Pengurus</label>
           <select name="pengurus_id" required
                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                <option disabled selected>Pilih Pengurus</option>
                @foreach($pengurus as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->anggota->nama }} - {{ $p->jabatan->nama_jabatan }} - {{ $p->periode->nama_periode }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="nama_program" class="block py-2 mt-3 font-semibold text-gray-700">Nama Program</label>
            <input type="text" name="nama_program" id="nama_program" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
        </div>

        <div class="mb-4">
            <label class="block py-2 mt-3 font-semibold text-gray-700">Program Kerja</label>
            <textarea id="summernote" name="deskripsi" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
        </div>

        <div class="flex justify-end">
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
</body>
</html>
