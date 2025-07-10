@extends('admin.layout.navbar')

@section('content')
<div class="max-w-6xl px-4 py-5 mx-auto">

    <!-- Judul Halaman -->
    <div class="mb-8 text-center">
        <div class="py-4 text-xl font-bold text-white shadow-lg bg-gradient-to-r from-red-600 to-red-300 rounded-2xl">
            Program Kepengurusan
        </div>

    </div>
    <div class="p-6 mt-10 bg-white shadow-xl rounded-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Program Kepengurusan</h2>
            <a href="{{route('Program_kerja.create')}}"
            class="px-4 py-2 text-sm text-white transition bg-green-600 rounded-full shadow-md hover:bg-green-700">
            + Tambah
        </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="font-semibold text-gray-700 bg-gray-200">
                    <tr>
                        <th class="px-6 py-3">No.</th>
                        <th class="px-6 py-3">Nama Pengurus</th>
                        <th class="px-6 py-3">Jabatan</th>
                        <th class="px-6 py-3">Periode</th>
                        <th class="px-6 py-3">Program</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach ($jabatans as $jabatan)
                        @foreach ($jabatan->pengurus as $pengurus)
                            @if ($pengurus->programKerjas->isNotEmpty())
                                <tr>
                                    <td class="px-6 py-4">{{ $no++ }}</td>
                                    <td class="px-6 py-4">{{ $pengurus->anggota->nama ?? '-' }}</td>
                                    <td class="px-6 py-4">{{ $jabatan->nama_jabatan }}</td>
                                    <td class="px-6 py-4">{{ $pengurus->periode->nama_periode }}</td>
                                    <td class="px-6 py-4">{{ $pengurus->programKerjas->count() }} Program</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('Program_kerja.detail', $pengurus->id) }}" class="text-blue-500 hover:underline">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"> --}}
    <script>
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK'
        });
        @endif
    </script>

@endsection
