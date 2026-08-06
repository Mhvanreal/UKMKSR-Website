@extends('admin.layout.navbar')
@section('content')

<div class="max-w-6xl px-4 py-5 mx-auto">
    <!-- Judul Halaman -->
    <div class="mb-8 text-center">
        <div class="py-4 text-xl font-bold text-white shadow-lg bg-gradient-to-r from-red-600 to-red-300 rounded-2xl">
            Data Pendaftaran Rekrutmen
        </div>
    </div>

    <!-- Pengaturan Rekrutmen -->
    <div class="p-6 mb-6 bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-4">
                    <h3 class="text-lg font-semibold text-gray-700">Status Pendaftaran:</h3>
                    <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $pengaturan->is_open ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $pengaturan->is_open ? 'DIBUKA' : 'DITUTUP' }}
                    </span>
                </div>
                @if($pengaturan->manual_override && $pengaturan->is_auto)
                    <div class="flex items-center gap-2 px-3 py-1 text-xs bg-yellow-50 border border-yellow-200 rounded-lg text-yellow-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <span>Mode Manual Override Aktif - Auto-check dinonaktifkan sementara</span>
                    </div>
                @endif
            </div>
            <form id="toggleForm" action="{{ route('Rekrutment-anggota.toggle-status') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmToggle({{ $pengaturan->is_open ? 'false' : 'true' }})"
                    class="px-6 py-2 text-sm font-semibold text-white rounded-lg transition-colors {{ $pengaturan->is_open ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                    {{ $pengaturan->is_open ? 'Tutup Pendaftaran' : 'Buka Pendaftaran' }}
                </button>
            </form>
        </div>

        <!-- Form Pengaturan Pesan -->
        <div class="pt-4 mt-4 border-t border-gray-200">
            <form id="settingsForm" action="{{ route('Rekrutment-anggota.update-pengaturan') }}" method="POST">
                @csrf
                
                <!-- Mode Otomatis -->
                <div class="p-4 mb-4 border border-red-200 rounded-lg bg-red-50">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" name="is_auto" id="is_auto" value="1" 
                            {{ $pengaturan->is_auto ? 'checked' : '' }}
                            class="mt-1 w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500"
                            onchange="toggleAutoMode(this.checked)">
                        <div class="flex-1">
                            <label for="is_auto" class="block text-sm font-semibold text-red-900 cursor-pointer">
                                Mode Otomatis
                            </label>
                            <p class="mt-1 text-xs text-red-700">
                                Pendaftaran akan otomatis dibuka/ditutup berdasarkan tanggal & waktu yang ditentukan.
                            </p>
                            @if($pengaturan->is_auto)
                                <div class="mt-2 px-3 py-2 text-xs bg-white rounded border border-red-200">
                                    <strong>Status:</strong> {{ $pengaturan->status_jadwal }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="md:col-span-2">
                        <label for="pesan_tutup" class="block mb-2 text-sm font-medium text-gray-700">Pesan Saat Pendaftaran Ditutup</label>
                        <textarea name="pesan_tutup" id="pesan_tutup" rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Pesan yang ditampilkan saat pendaftaran ditutup">{{ $pengaturan->pesan_tutup }}</textarea>
                    </div>
                    <div>
                        <label for="tanggal_buka" class="block mb-2 text-sm font-medium text-gray-700">
                            Tanggal Buka 
                            <span id="label-auto-buka" class="text-xs text-red-600 {{ $pengaturan->is_auto ? '' : 'hidden' }}">(Wajib jika mode auto)</span>
                        </label>
                        <input type="datetime-local" name="tanggal_buka" id="tanggal_buka" 
                            value="{{ $pengaturan->tanggal_buka ? $pengaturan->tanggal_buka->format('Y-m-d\TH:i') : '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="tanggal_tutup" class="block mb-2 text-sm font-medium text-gray-700">
                            Tanggal Tutup 
                            <span id="label-auto-tutup" class="text-xs text-red-600 {{ $pengaturan->is_auto ? '' : 'hidden' }}">(Opsional)</span>
                        </label>
                        <input type="datetime-local" name="tanggal_tutup" id="tanggal_tutup" 
                            value="{{ $pengaturan->tanggal_tutup ? $pengaturan->tanggal_tutup->format('Y-m-d\TH:i') : '' }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="button" onclick="confirmUpdateSettings()" class="px-6 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="p-6 mt-4 bg-white border border-gray-200 rounded-2xl shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="text-xs font-semibold uppercase bg-gray-50 text-gray-500">
                    <tr>
                        <th class="px-6 py-3">No.</th>
                        <th class="px-6 py-3">Nama Lengkap</th>
                        <th class="px-6 py-3">NIM</th>
                        <th class="px-6 py-3">No Hp</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @php $no = 1; @endphp
                    @foreach ($rekrutmen as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $no++ }}</td>
                            <td class="px-6 py-4">{{ $item->Nama }}</td>
                            <td class="px-6 py-4">{{ $item->nim }}</td>
                            <td class="px-6 py-4">{{ $item->No_tlpn }}</td>
                            <td class="px-6 py-4">
                                @if($item->status === 'Diterima')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Diterima
                                    </span>
                                @elseif($item->status === 'Ditolak')
                                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                        Belum Diverifikasi
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2 md:flex-row">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('Rekrutment-anggota.show', $item->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700">
                                        <i class="mr-2 fas fa-info-circle"></i> Detail
                                    </a>

                                    @if($item->status === 'Belum Diverifikasi')
                                        <!-- Tombol Terima -->
                                        <button onclick="confirmTerima({{ $item->id }})"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-green-500 rounded-md hover:bg-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            Terima
                                        </button>

                                        <!-- Tombol Tolak -->
                                        <button onclick="confirmTolak({{ $item->id }})"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-orange-500 rounded-md hover:bg-orange-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            Tolak
                                        </button>
                                    @endif

                                    @if($item->status === 'Diterima' || $item->status === 'Ditolak')
                                        <!-- Tombol Hapus untuk data yang sudah diproses -->
                                        <button onclick="confirmHapus({{ $item->id }})"
                                            class="inline-flex items-center justify-center px-4 py-2 text-sm text-white bg-red-600 rounded-md hover:bg-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Hapus
                                        </button>
                                    @endif
                                </div>

                                <!-- Hidden Forms -->
                                <form id="form-terima-{{ $item->id }}" action="{{ route('Rekrutment-anggota.terima', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                                <form id="form-tolak-{{ $item->id }}" action="{{ route('Rekrutment-anggota.tolak', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                                <form id="form-hapus-{{ $item->id }}" action="{{ route('Rekrutment-anggota.destroy', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Toggle mode otomatis
        function toggleAutoMode(isAuto) {
            const labelBuka = document.getElementById('label-auto-buka');
            const labelTutup = document.getElementById('label-auto-tutup');
            
            if (isAuto) {
                labelBuka.classList.remove('hidden');
                labelTutup.classList.remove('hidden');
            } else {
                labelBuka.classList.add('hidden');
                labelTutup.classList.add('hidden');
            }
        }

        // Konfirmasi toggle status pendaftaran
        function confirmToggle(willOpen) {
            const action = willOpen ? 'membuka' : 'menutup';
            const status = willOpen ? 'dibuka' : 'ditutup';
            
            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin ${action} pendaftaran rekrutmen?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: willOpen ? '#10b981' : '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, ' + (willOpen ? 'Buka' : 'Tutup'),
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('toggleForm').submit();
                }
            });
        }

        // Konfirmasi update pengaturan
        function confirmUpdateSettings() {
            const isAuto = document.getElementById('is_auto').checked;
            const tanggalBuka = document.getElementById('tanggal_buka').value;
            
            // Validasi jika mode auto aktif tapi tanggal buka kosong
            if (isAuto && !tanggalBuka) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Mode Otomatis',
                    text: 'Tanggal Buka wajib diisi jika mode otomatis aktif!',
                    confirmButtonColor: '#f59e0b'
                });
                return;
            }
            
            let message = 'Simpan perubahan pengaturan rekrutmen?';
            if (isAuto) {
                message = 'Mode otomatis akan aktif! Pendaftaran akan dibuka/ditutup otomatis sesuai jadwal.';
            }
            
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3b82f6',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('settingsForm').submit();
                }
            });
        }

        // Konfirmasi terima pendaftar
        function confirmTerima(id) {
            Swal.fire({
                title: 'Terima Pendaftar',
                text: 'Apakah Anda yakin ingin menerima pendaftar ini sebagai anggota?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Terima',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-terima-' + id).submit();
                }
            });
        }

        // Konfirmasi tolak pendaftar
        function confirmTolak(id) {
            Swal.fire({
                title: 'Tolak Pendaftar',
                html: 'Apakah Anda yakin ingin <b>menolak</b> pendaftar ini?<br><small>Status akan berubah menjadi "Ditolak"</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f97316',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Tolak',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-tolak-' + id).submit();
                }
            });
        }

        // Konfirmasi hapus data
        function confirmHapus(id) {
            Swal.fire({
                title: 'Hapus Data?',
                html: 'Apakah Anda yakin ingin <b>menghapus</b> data pendaftaran ini?<br><small class="text-red-600">Tindakan ini tidak dapat dibatalkan!</small>',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        }

        // Alert untuk success message
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            confirmButtonText: 'OK',
            timer: 3000
        });
        @endif

        // Alert untuk error message
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session("error") }}',
            confirmButtonText: 'OK'
        });
        @endif
    </script>
</div>

@endsection
