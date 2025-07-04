
    @extends('admin.layout.navbar')
    @section('content')

    <h1 class="mb-4 text-2xl font-bold">Anggota KSR</h1>
    <div class="container py-8 mx-auto">
        <div class="flex flex-col gap-4 mb-4 md:flex-row md:items-center md:justify-between">

            <!-- KIRI: Filter + Search -->
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:flex-wrap sm:gap-4">
                <select id="filter"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg sm:w-auto focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Semua Angkatan</option>
                    @foreach ($angkatanList as $tahun)
                        <option value="{{ $tahun }}" {{ request('angkatan') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>

                <form action="{{ route('anggota.search') }}" method="GET"
                    class="flex flex-col w-full gap-2 sm:flex-row sm:items-center sm:w-auto">
                    <input type="hidden" name="angkatan" value="{{ request('angkatan') }}">

                    <input type="text" name="query" placeholder="Cari Anggota..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        value="{{ request('query') }}">

                    <button type="submit"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 w-full sm:w-auto">
                        Cari
                    </button>
                </form>
            </div>
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-end sm:gap-4">
                <!-- Import Excel -->
                <form action="{{ route('anggota.import') }}" method="POST" enctype="multipart/form-data"
                    class="flex flex-col items-start w-full gap-2 px-4 py-2 bg-white rounded-lg shadow-md sm:flex-row sm:items-center sm:w-auto"
                    id="import-form">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls" class="text-sm text-gray-500" required>

                    <button type="button"
                        class="w-full px-4 py-2 text-white bg-green-500 rounded sm:w-auto hover:bg-green-600"
                        id="import-btn">
                        Import Excel
                    </button>
                </form>
                <a href="{{ route('anggota.create') }}"
                    class="flex items-center justify-center w-full px-4 py-2 text-white bg-green-500 rounded sm:w-auto hover:bg-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            </div>
        </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-black rtl:text-right">
            <thead class="text-xs text-black uppercase bg-white border-b border-gray-200">
                <tr>
                    {{-- <th scope="col" class="px-6 py-3">NIM</th> --}}
                    <th scope="col" class="px-6 py-3">Nama</th>
                    {{-- <th scope="col" class="px-6 py-3">Angkatan</th> --}}
                    {{-- <th scope="col" class="px-6 py-3">Jenis Kelamin</th> --}}
                    {{-- <th scope="col" class="px-6 py-3">Alamat</th> --}}
                    {{-- <th scope="col" class="px-6 py-3">Jurusan</th> --}}
                    <th scope="col" class="px-6 py-3">Prodi</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotas as $key => $anggota)
                    <tr class="border-b hover:bg-gray-50">
                        {{-- <td class="px-4 py-2 border-r">{{ $anggota->nim }}</td> --}}
                        <td class="px-4 py-2 border-r truncate max-w-[80px] overflow-hidden">{{ $anggota->nama }}</td>
                        {{-- <td class="px-4 py-2 border-r">{{ $anggota->angkatan }}</td> --}}
                        {{-- <td class="px-4 py-2 border-r">{{ $anggota->jenis_kelamin }}</td> --}}
                        {{-- <td class="px-4 py-2 border-r">{{ $anggota->alamat }}</td> --}}
                        {{-- <td class="px-4 py-2 border-r truncate max-w-[80px] overflow-hidden">{{ $anggota->jurusan }}</td> --}}
                        <td class="px-4 py-2 border-r">{{ $anggota->prodi }}</td>
                        <td class="px-4 py-2 border-r">{{ $anggota->status }}</td>
                        <td class="px-4 py-2 text-center border-r">
                            @if ($anggota->foto)
                                <img src="{{ asset('storage/' . $anggota->foto) }}"
                                     alt="Gambar Anggota"
                                     class="object-cover w-20 h-20 rounded cursor-pointer"
                                     onclick="showImage('{{ asset('storage/' . $anggota->foto) }}')">
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td class="flex items-center justify-center px-4 py-2 space-x-2">
                            <a href="{{ route('anggota.show', $anggota->id) }}" class="text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                                    <path d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                            </a>
                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="text-red-500">
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
            {{ $anggotas->links() }}
        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('import-btn').addEventListener('click', function () {
                Swal.fire({
                    title: 'Konfirmasi Import',
                    html: `
                        <p>Pastikan urutan kolom di file Excel sesuai dengan daftar di bawah dan gunakan huruf besar/kecil yang sama persis (case-sensitive).</p>
                        <ol style="text-align:left">
                            <li>nim (exp: E41225***)</li>
                            <li>nama (exp: Savira)</li>
                            <li>tanggal_Lahir (exp: 2022-01-03)</li>
                            <li>alamat (exp: Jember)</li>
                            <li>alasan_join (exp: Belajar hal baru)</li>
                            <li>angkatan (exp: 12)</li>
                            <li>jurusan (exp: Teknologi Informasi)</li>
                            <li>prodi (exp: Teknik Informatika)</li>
                            <li>status (exp: Tidak/Inaktif/Tidak Aktif)</li>
                            <li>tahun_masuk_kuliah (exp: 2021)</li>
                            <li>jenis_kelamin (exp: laki-laki/perempuan)</li>
                        </ol>
                    `,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Lanjutkan Import',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('import-form').submit();
                    }
                });
            });
        });
    </script>
    {{-- //filter// --}}
    <script>
        document.getElementById('filter').addEventListener('change', function () {
            let filterValue = this.value;
            window.location.href = `?angkatan=${filterValue}`;
        });
    </script>


    <script>
    @if ($errors->any())
        let errorMessages = `
            <ul style="text-align: left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan!',
            html: errorMessages,
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endsection
