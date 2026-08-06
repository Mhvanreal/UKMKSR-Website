<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 36px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #22c55e;
        }

        input:checked+.slider:before {
            transform: translateX(16px);
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">
    @extends('admin.layout.navbar')

    @section('content')
    <div class="max-w-6xl mx-auto py-5 px-4">

        <!-- Judul Halaman -->
        <div class="text-center mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-300 text-white text-xl font-bold py-4 rounded-2xl shadow-lg">
                Kegiatan UKM KSR
            </div>
        </div>

        <!-- Box Kegiatan Terkini -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 mt-10 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Kegiatan Terkini</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-3">No.</th>
                            <th class="px-6 py-3">Nama Kegiatan</th>
                            <th class="px-6 py-3">Tanggal Publikasi</th>
                            <th class="px-6 py-3">Tanggal Mulai</th>
                            <th class="px-6 py-3">Tanggal Selesai</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($kegiatan as $key => $item)
                        @if ($item->status === 'aktif')
                        <tr class="transition hover:bg-red-50/40">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->start_kegiatan)->format('d M Y') }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->end_kegiatan)->format('d M Y') }}</td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <a href="{{ route('kegiatan.show', $item->id_kegiatan) }}" class="text-gray-500 transition hover:text-red-600">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kegiatan.destroy', $item->id_kegiatan) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('kegiatan.toggle', $item->id_kegiatan) }}" method="POST">
                                    @csrf
                                    <label class="switch">
                                        <input type="checkbox" checked onchange="this.form.submit()">
                                        <span class="slider"></span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada kegiatan terkini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Daftar Kegiatan -->
        <div class="bg-white border border-gray-200 rounded-2xl p-6 mt-10 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Daftar Kegiatan</h2>
                <a href="{{ route('kegiatan.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full text-sm shadow-md transition">
                    + Tambah
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                        <tr>
                            <th class="px-6 py-3">No.</th>
                            <th class="px-6 py-3">Nama Layanan</th>
                            <th class="px-6 py-3">Tanggal Publikasi</th>
                            <th class="px-6 py-3">Tanggal Mulai</th>
                            <th class="px-6 py-3">Tanggal Selesai</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($daftarKegiatan as $key => $item)
                        @if ($item->status === 'tidak')
                        <tr class="transition hover:bg-red-50/40">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->nama_kegiatan }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->start_kegiatan)->format('d M Y') }}</td>
                            <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->end_kegiatan)->format('d M Y') }}</td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <a href="{{ route('kegiatan.show', $item->id_kegiatan) }}" class="text-gray-500 transition hover:text-red-600"><i class="fas fa-info-circle"></i></a>
                                <a href="{{ route('kegiatan.edit', $item->id_kegiatan) }}" class="text-yellow-500 hover:text-yellow-700"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('kegiatan.destroy', $item->id_kegiatan) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                                </form>
                                <form action="{{ route('kegiatan.toggle', $item->id_kegiatan) }}" method="POST">
                                    @csrf
                                    <label class="switch">
                                        <input type="checkbox" onchange="this.form.submit()">
                                        <span class="slider"></span>
                                    </label>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada daftar kegiatan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>

</html>