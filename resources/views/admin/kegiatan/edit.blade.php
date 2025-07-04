    @extends('admin.layout.navbar')
    @section('content')

    <div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-4 text-2xl font-bold">Edit Kegiatan</h1>

        <form action="{{ route('kegiatan.update', $kegiatan->id_kegiatan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label class="block font-semibold">Nama Kegiatan:</label>
            <input type="text" name="nama_kegiatan" value="{{ $kegiatan->nama_kegiatan }}" class="w-full p-2 border rounded" required>

            <label class="block mt-3 font-semibold">Deskripsi:</label>
            <textarea name="deskripsi_kegiatan" class="w-full p-2 border rounded" id="summernote">{{ $kegiatan->deskripsi_kegiatan }}</textarea>

            <label class="block mt-3 font-semibold">Tanggal Mulai:</label>
            <input type="date" name="start_kegiatan" value="{{ \Carbon\Carbon::parse($kegiatan->start_kegiatan)->format('Y-m-d') }}" class="w-full p-2 border rounded" required>

            <label class="block mt-3 font-semibold">Tanggal Selesai:</label>
            <input type="date" name="end_kegiatan" value="{{ \Carbon\Carbon::parse($kegiatan->end_kegiatan)->format('Y-m-d') }}" class="w-full p-2 border rounded" required>

            <label class="block mt-3 font-semibold">Foto:</label>
            <input type="file" name="foto_kegiatan" class="w-full p-2 border rounded">
            @if ($kegiatan->foto_kegiatan)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" class="object-cover w-32 h-32 rounded" alt="Foto Kegiatan">
            </div>
            @endif

            <label class="block mt-3 font-semibold">Poster:</label>
            <input type="file" name="poster_kegiatan" class="w-full p-2 border rounded">
            @if ($kegiatan->poster_kegiatan)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $kegiatan->poster_kegiatan) }}" class="object-cover w-32 h-32 rounded" alt="Poster Kegiatan">
            </div>
            @endif
            <label class="block mt-3 font-semibold">Status:</label>
<select name="status" class="w-full p-2 border rounded" required>
    <option value="aktif" {{ $kegiatan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
    <option value="tidak" {{ $kegiatan->status == 'tidak' ? 'selected' : '' }}>Tidak Aktif</option>
</select>


            <div class="flex justify-end gap-4 mt-4">
                <a href="{{ route('kegiatan.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Batal</a>
                <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded">Update</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
                placeholder: 'Deskripsi Kegiatan...',
            });
        });
    </script>
    @endsection

