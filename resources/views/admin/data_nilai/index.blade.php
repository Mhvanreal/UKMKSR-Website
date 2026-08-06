
    @extends('admin.layout.navbar')
    @section('content')

    <div class="flex flex-col gap-1 mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Nilai Anggota KSR</h1>
        <p class="text-sm text-gray-500">Kelola nilai kehadiran, kontribusi, kompetensi, dan etika anggota</p>
    </div>
    <div class="container py-4 mx-auto">
        <div class="flex flex-col gap-4 mb-4 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:space-x-2">
                <form action="#" method="GET" class="flex flex-col w-full gap-2 sm:flex-row sm:items-center">
                    <input type="text" name="query" placeholder="Cari Anggota..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 sm:w-auto">

                    <button type="submit"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-auto">
                        Cari
                    </button>
                </form>
            </div>
            <a href="{{ route('nilai.create') }}"
                class="flex items-center justify-center w-full px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700 md:w-auto">
                <i class="mr-2 fas fa-plus"></i>
                Tambah
            </a>
        </div>

    <div class="overflow-x-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
        @if ($data_nilais && $data_nilais->count() > 0)
        <table class="w-full text-sm text-left text-black rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">NIM</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Angkatan</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kehadiran</th>
                    <th scope="col" class="px-6 py-3">Nilai Kontribusi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kompetensi</th>
                    <th scope="col" class="px-6 py-3">Nilai Etika</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_nilais as $data_nilai)
                    <tr class="border-b transition hover:bg-red-50/40">
                        <td class="px-4 py-2 text-center border-r">{{$data_nilai->anggota->nim}}</td>
                        <td class="px-4 py-2 border-r truncate max-w-[80px] overflow-hidden">{{$data_nilai->anggota->nama}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->anggota->angkatan}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->anggota->prodi}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->nilai_kehadiran}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->nilai_kontribusi}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->nilai_kompetensi}}</td>
                        <td class="px-4 py-2 border-r">{{$data_nilai->nilai_etika}}</td>
                        <td class="flex items-center justify-center px-4 py-2 space-x-2">
                            <a href="{{ route('nilai.show', $data_nilai->anggota_id) }}" class="text-gray-500 transition hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('nilai.edit', $data_nilai->anggota_id) }}" class="text-yellow-500 transition hover:text-yellow-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                            </a>
                            <form action="{{ route('nilai.destroy', $data_nilai->anggota_id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data nilai anggota ini?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="text-red-500 transition hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $data_nilais->links() }}
        </div>
        @else
        <table class="w-full text-sm text-left text-black rtl:text-right">
            <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">NIM</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Angkatan</th>
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kehadiran</th>
                    <th scope="col" class="px-6 py-3">Nilai Kontribusi</th>
                    <th scope="col" class="px-6 py-3">Nilai Kompetensi</th>
                    <th scope="col" class="px-6 py-3">Nilai Etika</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b transition hover:bg-red-50/40">
                    <td class="border border-gray-300 px-4 py-2 text-center" colspan="9">Tidak Ada Data Nilai Anggota</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>
    </div>

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