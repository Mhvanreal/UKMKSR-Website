
    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-6xl mx-auto py-5 px-4">

        <!-- Judul Halaman -->
        <div class="text-center mb-8">
            <div class="bg-gradient-to-r from-red-600 to-red-300 text-white text-xl font-bold py-4 rounded-2xl shadow-lg">
                Tentang UKM KSR
            </div>
        </div>

        <!-- Box Tentang UKM KSR-->
        <div class="bg-white shadow-xl rounded-3xl p-6 mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Tentang UKM KSR</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($data as $key => $item)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->deskripsi_ksr }}</td>
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('tentang.show', $item->id_tentang_ksr) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('tentang.edit', $item->id_tentang_ksr) }}"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tentang.destroy', $item->id_tentang_ksr) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada data Tentang KSR.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Info KSR -->
        <div class="bg-white shadow-xl rounded-3xl p-6 mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Info KSR</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($data as $key => $item)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->deskripsi_ksr }}</td>
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('tentang.show', $item->id_tentang_ksr) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('tentang.edit', $item->id_tentang_ksr) }}"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tentang.destroy', $item->id_tentang_ksr) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada data Info KSR.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Sejarah KSR -->
        <div class="bg-white shadow-xl rounded-3xl p-6 mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Sejarah KSR</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($data as $key => $item)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->deskripsi_ksr }}</td>
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('tentang.show', $item->id_tentang_ksr) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('tentang.edit', $item->id_tentang_ksr) }}"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tentang.destroy', $item->id_tentang_ksr) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada Sejarah KSR.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Box Visi - Misi KSR -->
        <div class="bg-white shadow-xl rounded-3xl p-6 mt-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-lg font-semibold text-gray-700">Visi Misi KSR</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-200 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">No.</th>
                            <th class="px-4 py-3">Deskripsi</th>
                            <th class="px-4 py-3">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($data as $key => $item)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="px-6 py-3">{{ $key+1 }}</td>
                            <td class="px-6 py-3">{{ $item->deskripsi_ksr }}</td>
                            <td class="px-6 py-3">
                                {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-3 flex items-center space-x-3">
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('tentang.show', $item->id_tentang_ksr) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('tentang.edit', $item->id_tentang_ksr) }}"
                                        class="text-yellow-500 hover:text-yellow-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tentang.destroy', $item->id_tentang_ksr) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">
                                Belum ada visi-misi KSR.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageWidth: 'auto',
                imageHeight: 'auto',
                imageAlt: 'Detail Foto',
                showConfirmButton: false,
                backdrop: true
            });
        }
    </script>
    @endsection