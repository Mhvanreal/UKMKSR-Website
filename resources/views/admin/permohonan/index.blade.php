@extends('admin.layout.navbar')

@section('content')
<div class="max-w-6xl px-4 py-5 mx-auto">
    <div class="mb-8 text-center">
        <div class="py-4 text-xl font-bold text-white shadow-lg bg-gradient-to-r from-red-600 to-red-300 rounded-2xl">
          Permohonan
        </div>

    </div>
    <div class="p-6 mt-10 bg-white shadow-xl rounded-2xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Surat Permohonan</h2>

        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="font-semibold text-gray-700 bg-gray-200">
                    <tr>
                        <th class="px-6 py-3">No.</th>
                        <th class="px-6 py-3">Layanan</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Asal</th>
                        <th class="px-6 py-3">No Hp</th>
                        <th class="px-6 py-3">Nama Kegiatan</th>
                        <th class="px-6 py-3">Surat SPH</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  @foreach ($pesanan as $index => $item)
                        <tr>
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">{{ $item->layanan->nama_layanan }}</td>
                            <td class="px-6 py-3">{{ $item->nama }}</td>
                            <td class="px-6 py-3">{{ $item->asal }}</td>
                            <td class="px-6 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="px-6 py-3">
                                @if($item->surat_sph)
                                    <a href="{{ asset('storage/' . $item->surat_sph) }}" target="_blank">
                                        <img src="/img/icon/file.png" alt="Surat Icon" class="inline w-6 h-6">
                                    </a>
                                @else
                                    <span class="text-gray-400">Tidak ada file</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
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
