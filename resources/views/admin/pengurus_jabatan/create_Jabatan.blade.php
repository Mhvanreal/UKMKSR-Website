<!-- Modal Jabatan -->
<div x-show="openJabatan" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="openJabatan = false" class="w-full max-w-xl p-6 bg-white border border-gray-200 rounded-2xl shadow-lg">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Tambah Data Jabatan Kepengurusan</h2>

        <form action="{{ route('jabatan.store') }}" method="POST">
            @csrf
                <div class="mb-4">
                            <label for="divisi_id" class="block mb-1 text-sm font-medium text-gray-700">Pilih Divisi</label>
                            <select id="divisi_id" name="divisi_id"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                                    required>
                                <option value="" disabled selected>Pilih Divisi</option>
                                @foreach($divisi as $d)
                <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
            @endforeach

                </select>
            </div>

            <!-- Nama Jabatan -->
            <div class="mb-4">
                <label for="nama_jabatan" class="block mb-1 text-sm font-medium text-gray-700">Nama Jabatan</label>
                <input
                    type="text"
                    id="nama_jabatan"
                    name="nama_jabatan"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="Masukkan nama jabatan"
                    required>
            </div>

            <!-- Aksi -->
            <div class="flex justify-end space-x-2">
                <button type="button"
                        @click="openJabatan = false"
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
