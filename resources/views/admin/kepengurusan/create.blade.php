<!-- Modal -->
<div x-show="openModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div @click.away="openModal = false" class="w-full max-w-xl p-6 bg-white border border-gray-200 rounded-2xl shadow-lg">
        <h2 class="mb-4 text-xl font-semibold text-gray-800">Tambah Data Pengurus</h2>

        <form action="{{route('Kepengurusan.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Anggota</label>
                <select name="anggota_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Anggota --</option>
                    @foreach($anggota as $a)
                        <option value="{{ $a->id }}">{{ $a->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="jabatan_id" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <select name="jabatan_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                        <option value="{{ $j->id }}">{{ $j->divisi->nama_divisi }} - {{ $j->nama_jabatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="periode_id" class="block text-sm font-medium text-gray-700">Periode</label>
                <select name="periode_id" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option disabled selected>-- Pilih Periode --</option>
                    @foreach($periode as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_periode }} ({{ $p->tahun_mulai }} - {{ $p->tahun_selesai }})</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" @click="openModal = false"
                    class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded hover:bg-gray-200">Batal</button>
                <button type="submit"
                    class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>
</div>


