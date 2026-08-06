
    @extends('admin.layout.navbar')
    @section('content')

    <div class="container mx-auto">
    <div class="flex flex-col gap-1 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Struktur Kepengurusan</h1>
        <p class="text-sm text-gray-500">Kelola pengurus, divisi, jabatan, dan periode kepengurusan</p>
    </div>
    <div class="flex flex-col gap-4 mb-4 md:flex-row md:items-center md:justify-between">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:space-x-2">
            {{-- <form action="" method="GET" class="flex flex-col w-full gap-2 sm:flex-row sm:items-center">
                <input type="hidden" name="angkatan" value="">
                <input type="text" name="query" placeholder="Cari Pengurus..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 sm:w-auto"
                    value="">

                <button type="submit"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-auto">
                    Cari
                </button>
            </form> --}}

            <script>
                document.getElementById('filter').addEventListener('change', function () {
                    let filterValue = this.value;
                    window.location.href = `?angkatan=${filterValue}`;
                });
            </script>
        </div>
    </div>

    <div class="p-6 mt-4 bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Kepengurusan</h2>

            <div x-data="{ openModal: false, openDivisi: false, openJabatan: false, openPeriode: false }" class="relative">
                @include('admin.kepengurusan.create')
                @include('admin.devisi.create')
                @include('admin.pengurus_jabatan.create_Jabatan')
                @include('admin.pengurus_jabatan.create_priode')

                <!-- Tombol Add Data -->
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                    class="flex items-center px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300"
                    type="button">
                    Add Data
                    <svg class="w-2.5 h-2.5 ms-3 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdown"
                    class="absolute z-10 hidden mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-red-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" @click.prevent="openModal = true"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Pengurus</a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="openDivisi = true"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Divisi</a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="openJabatan = true"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Jabatan</a>
                        </li>
                        <li>
                            <a href="#" @click.prevent="openPeriode = true"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-red-500 dark:hover:text-white">Periode Kepengurusan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabel Kepengurusan -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="text-xs font-semibold uppercase bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3">No.</th>
                        <th class="px-6 py-3">Nama Pengurus</th>
                        <th class="px-6 py-3">Jabatan</th>
                        <th class="px-6 py-3">Periode Kepengurusan</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($pengurus as $index => $item)
                        <tr>
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">{{ $item->anggota->nama }}</td>
                            {{-- <td class="px-6 py-3">{{ $item->jabatan->divisi->nama_divisi }}</td> --}}
                            <td class="px-6 py-3">{{ $item->jabatan->nama_jabatan }}</td>
                            <td class="px-6 py-3">{{ $item->periode->nama_periode }}</td>
                            <td class="flex items-center px-6 py-3 space-x-3" x-data="{ openModal: false, detailUrl: '' }">
                                <a href="{{route('Kepengurusan.show', $item->id)}}" class="text-gray-500 transition hover:text-red-600">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            <div x-data="{ openModal: false }">
                                <a href="{{route('Kepengurusan.edit', $item->id)}}" class="text-yellow-500 transition hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            <form action="{{route('Kepengurusan.destroy', $item->id)}}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 transition hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
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


