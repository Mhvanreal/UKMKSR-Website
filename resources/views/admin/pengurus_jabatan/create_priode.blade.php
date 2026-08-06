<!-- Modal Jabatan -->
<div x-show="openPeriode" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="openPeriode = false" class="w-full max-w-xl p-6 bg-white border border-gray-200 rounded-2xl shadow-lg">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Tambah Data Periode Kepengurusan</h2>

        <form action="{{route('Periode.store')}}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_periode" class="block mb-1 text-sm font-medium text-gray-700">Nama Periode</label>
                <input
                    type="text"
                    id="nama_periode"
                    name="nama_periode"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan Nama Periode"
                    required>
            </div>

            <div class="mb-4">
                <label for="tahun_mulai" class="block mb-1 text-sm font-medium text-gray-700">Tahun Mulai</label>
                <input
                    type="text"
                    id="tahun_mulai"
                    name="tahun_mulai"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan nama Tahun mulai"
                    required>
            </div>

            <div class="mb-4">
                <label for="tahun_selesai" class="block mb-1 text-sm font-medium text-gray-700">Tahun Selesai</label>
                <input
                    type="text"
                    id="tahun_selesai"
                    name="tahun_selesai"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan nama Tahun Selesai"
                    required>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button"
                        @click="openPeriode = false"
                        class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
