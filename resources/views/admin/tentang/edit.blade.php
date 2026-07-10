@extends('admin.layout.navbar')
@section('content')
    <div class="px-6 py-6 mx-auto" style="max-width: 95%;">
        <div class="p-8 bg-white rounded-lg shadow-md">
            @if ($type == 'tentang')
                <h1 class="mb-6 text-2xl font-bold">Edit Tentang UKM KSR</h1>
            @elseif($type == 'info')
                <h1 class="mb-6 text-2xl font-bold">Edit Info KSR</h1>
            @elseif($type == 'visimisi')
                <h1 class="mb-6 text-2xl font-bold">Edit Visi Misi KSR</h1>
            @elseif($type == 'sejarah')
                <h1 class="mb-6 text-2xl font-bold">Edit Sejarah KSR</h1>
            @endif

            <form
                action="{{ route('tentang.update', $type == 'tentang' ? $data->id_tentang_ksr : ($type == 'info' ? $data->id_info_ksr : ($type == 'visimisi' ? $data->id_visi_misi_ksr : $data->id_sejarah_ksr))) }}"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="{{ $type }}">

                @if ($type == 'info')
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Link YouTube Info KSR:</label>
                        <input type="text" name="link_yt_info_ksr"
                            class="w-full min-h-[300px] p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ old('link_yt_info_ksr', $data->link_yt_info_ksr) }}" required
                            placeholder="Masukkan link YouTube">
                        @error('link_yt_info_ksr')
                            <span class="block mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @elseif($type == 'visimisi')
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Deskripsi Visi Misi:</label>
                        <textarea id="summernote" name="deskripsi_visi_misi_ksr" required rows="10"
                            class="w-full min-h-[300px] p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
    {{ old('deskripsi_visi_misi_ksr', $data->deskripsi_visi_misi_ksr) }}
    </textarea>
                        @error('deskripsi_visi_misi_ksr')
                            <span class="block mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @else
                    <div class="mb-4">
                        <label class="block mb-2 font-semibold">Deskripsi:</label>
                        <textarea id="summernote" name="deskripsi_ksr"  class="w-full min-h-[300px] p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>{{ old('deskripsi_ksr', 
$data->deskripsi_ksr) }}</textarea>
                        @error('deskripsi_ksr')
                            <span class="block mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="flex justify-end gap-4 mt-6">
                    <a href="{{ route('tentang.index') }}"
                        class="px-6 py-2 text-white transition bg-gray-500 rounded-lg hover:bg-gray-600">Kembali</a>
                    <button type="submit"
                        class="px-6 py-2 text-white transition bg-green-600 rounded-lg hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            @if ($type != 'info')
                $('#summernote').summernote({
                    height: 500,
                    minHeight: 400,
                    maxHeight: 800,
                    focus: true,
                    dialogsInBody: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ],
                    callbacks: {
                        onInit: function() {
                            // Set width untuk editor
                            $('.note-editor').css('width', '100%');
                            $('.note-editable').css({
                                'width': '100%',
                                'max-width': '100%'
                            });
                        }
                    }
                });
            @endif
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

