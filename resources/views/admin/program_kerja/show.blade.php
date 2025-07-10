@extends('admin.layout.navbar')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h2 class="mb-4 text-2xl font-bold text-red-600">
        Program Kerja - {{ $pengurus->anggota->nama ?? 'Pengurus Tidak Ditemukan' }}
    </h2>

    <p><strong>Jabatan:</strong> {{ $pengurus->jabatan->nama_jabatan ?? '-' }}</p>
    <p><strong>Periode:</strong> {{ $pengurus->periode->nama_periode ?? '-' }}</p>

    <h3 class="mt-6 mb-2 text-lg font-semibold text-gray-800">Daftar Program Kerja:</h3>
    <ul class="space-y-3">
        @forelse($pengurus->programKerjas as $program)
            <li class="relative pl-4 border-l-4 border-red-600">
                <div class="flex items-start justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ $program->nama_program }}</h4>
                        <p class="text-sm text-gray-600">{!! $program->deskripsi !!}</p>
                    </div>
                    <form action="{{ route('Program_kerja.destroy', $program->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus program ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 font-bold text-gray-700 transition bg-transparent border-2 border-gray-400 rounded-lg hover:border-sky-400 hover:text-sky-400">Hapus</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="text-gray-500">Tidak ada program kerja untuk pengurus ini.</li>
        @endforelse
    </ul>

    <a href="{{ route('Program_kerja.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">
        &larr; Kembali
    </a>
</div>
@endsection
