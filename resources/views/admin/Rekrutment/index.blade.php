@extends('admin.layout.navbar')
@section('content')

<div class="max-w-6xl px-4 py-5 mx-auto">
    <!-- Judul Halaman -->
    <div class="mb-8 text-center">
        <div class="py-4 text-xl font-bold text-white shadow-lg bg-gradient-to-r from-red-600 to-red-300 rounded-2xl">
            Data Pendaftaran Rekrutmen
        </div>
    </div>

    <div class="p-6 mt-10 bg-white shadow-xl rounded-2xl">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="font-semibold text-gray-700 bg-gray-200">
                    <tr>
                        <th class="px-6 py-3">No.</th>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NIM</th>
                        <th class="px-6 py-3">No Hp</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $no = 1; @endphp
                    @foreach ($rekrutmen as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $no++ }}</td>
                            <td class="px-6 py-4">{{ $item->Nama }}</td>
                            <td class="px-6 py-4">{{ $item->nim }}</td>
                            <td class="px-6 py-4">{{ $item->No_tlpn }}</td>
                            <td class="px-6 py-4">{{ $item->status }}</td>
                               <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2 md:flex-row">
                                        <a href="{{ route('Rekrutment-anggota.show', $item->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                            <i class="mr-2 fas fa-info-circle"></i> Detail
                                        </a>

                                        @if($item->status !== 'Diterima')
                                        <form action="{{ route('Rekrutment-anggota.terima', $item->id) }}" method="POST" onsubmit="return confirm('Terima pendaftar ini?')">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                                Terima
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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
</div>

@endsection
