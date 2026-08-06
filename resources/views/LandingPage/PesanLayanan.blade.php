<div x-show="open" x-cloak x-transition.opacity.duration.200ms
     @keydown.escape.window="open = false"
     x-init="$watch('open', v => document.body.style.overflow = v ? 'hidden' : '')"
     class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto bg-black bg-opacity-50 sm:p-6">
    <div @click.away="open = false" role="dialog" aria-modal="true"
         class="relative flex flex-col w-full max-w-lg max-h-[85vh] bg-white rounded-2xl shadow-2xl">

        {{-- HEADER --}}
        <div class="flex items-center justify-between flex-shrink-0 px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">Form Pesan Layanan</h2>
            <button type="button" @click="open = false"
                class="flex items-center justify-center w-8 h-8 text-gray-400 transition rounded-full hover:bg-gray-100 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>

        {{-- BODY (scrollable) --}}
        <div class="min-h-0 px-6 py-5 overflow-y-auto overscroll-contain">
            <form id="formPesanLayanan" action="{{ route('pesan_layanan.store') }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf

                {{-- PILIH LAYANAN --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Pilih Layanan</label>
                    <div class="relative">
                        <select name="id_layanan"
                            class="w-full px-3.5 py-2.5 pr-10 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm transition appearance-none focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                            required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanans as $item)
                                <option value="{{ $item->id_layanan }}">{{ $item->nama_layanan }}</option>
                            @endforeach
                        </select>
                        <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <i class="text-xs text-gray-400 fas fa-chevron-down"></i>
                        </span>
                    </div>
                </div>

                {{-- NAMA --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="nama"
                        class="w-full px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                        required>
                </div>

                {{-- ASAL --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Asal</label>
                    <input type="text" name="asal"
                        class="w-full px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                        placeholder="Contoh: HMJ atau UKM" required>
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Nomor HP</label>
                    <input type="text" name="no_hp"
                        class="w-full px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                        required>
                </div>

                {{-- NAMA KEGIATAN --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan"
                        class="w-full px-3.5 py-2.5 text-sm text-gray-700 placeholder-gray-400 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                        placeholder="Masukkan nama kegiatan" required>
                </div>

                {{-- TANGGAL --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input type="date" name="start_kegiatan"
                            class="w-full px-3.5 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                            required>
                    </div>
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input type="date" name="end_kegiatan"
                            class="w-full px-3.5 py-2.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm transition focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-500/20"
                            required>
                    </div>
                </div>

                {{-- SURAT SPH --}}
                <div>
                    <label class="block mb-1.5 text-sm font-medium text-gray-700">Upload Surat SPH</label>
                    <input type="file" name="surat_sph"
                        class="block w-full text-sm text-gray-600 file:mr-3 file:px-3.5 file:py-2 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-600 cursor-pointer hover:file:bg-red-100 transition">
                </div>
            </form>
        </div>

        {{-- FOOTER (aksi selalu terlihat) --}}
        <div class="flex items-center justify-end gap-3 flex-shrink-0 px-6 py-4 bg-gray-50 border-t border-gray-100 rounded-b-2xl">
            <button type="button" @click="open = false"
                class="px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm transition hover:bg-gray-100">
                Batal
            </button>
            <button type="submit" form="formPesanLayanan"
                class="px-5 py-2.5 text-sm font-semibold text-white rounded-lg shadow-md bg-sky-500 transition hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500/40">
                Kirim Permohonan
            </button>
        </div>
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
