<div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="open = false" class="w-full max-w-lg p-6 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-xl font-semibold text-center">Form Pesan Layanan</h2>

        <form action="{{ route('pesan_layanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- PILIH LAYANAN --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Pilih Layanan</label>
                <select name="id_layanan" class="w-full px-4 py-2 border rounded" required>
                    <option value="">-- Pilih Layanan --</option>
                    @foreach($layanans as $item)
                        <option value="{{ $item->id_layanan }}">{{ $item->nama_layanan }}</option>
                    @endforeach
                </select>
            </div>

            {{-- NAMA --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Nama</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border rounded" required>
            </div>

            {{-- ASAL --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Asal</label>
                <input type="text" name="asal" class="w-full px-4 py-2 border rounded" placeholder="Contoh: HMJ atau UKM" required>
            </div>

            {{-- NO HP --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Nomor HP</label>
                <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded" required>
            </div>

            {{-- NAMA KEGIATAN --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="w-full px-4 py-2 border rounded" placeholder="Masukkan nama kegiatan" required>
            </div>

            {{-- DESKRIPSI KEGIATAN --}}
            {{-- <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Deskripsi Kegiatan</label>
                <textarea name="deskripsi_kegiatan" rows="3" class="w-full px-4 py-2 border rounded" placeholder="Tuliskan deskripsi kegiatan..."></textarea>
            </div> --}}

            {{-- TANGGAL MULAI --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Tanggal Mulai</label>
                <input type="date" name="start_kegiatan" class="w-full px-4 py-2 border rounded" required>
            </div>

            {{-- TANGGAL SELESAI --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Tanggal Selesai</label>
                <input type="date" name="end_kegiatan" class="w-full px-4 py-2 border rounded" required>
            </div>

            {{-- SURAT SPH --}}
            <div class="mb-4">
                <label class="block mb-1 text-sm font-bold">Upload Surat SPH</label>
                <input type="file" name="surat_sph" class="w-full">
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-between mt-6">
                <button type="submit" class="px-4 py-2 font-semibold text-white rounded bg-sky-500 hover:bg-sky-600">
                    Kirim Permohonan
                </button>
                <button type="button" @click="open = false" class="px-4 py-2 font-semibold text-gray-700 bg-gray-200 rounded hover:bg-gray-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ANIMASI SUCCESS --}}
@if(session('success'))
    <div class="lottie-success-modal" style="
         position: fixed; top: 0; left: 0;
         width: 100%; height: 100%; background: rgba(0,0,0,0.5);
         display: flex; justify-content: center; align-items: center; z-index: 9999;">
        <div style="background: white; padding: 20px; border-radius: 10px; text-align: center;">
            <lottie-player
                src="https://assets10.lottiefiles.com/packages/lf20_jbrw3hcz.json"
                background="transparent"
                speed="1"
                style="width: 200px; height: 200px;"
                autoplay>
            </lottie-player>
            <p style="margin-top: 10px;">{{ session('success') }}</p>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector('.lottie-success-modal').style.display = 'none';
        }, 3000);
    </script>
@endif
