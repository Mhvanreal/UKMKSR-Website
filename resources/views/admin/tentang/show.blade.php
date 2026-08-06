    @extends('admin.layout.navbar')
    @section('content')

    <div class="container">
        <h2 class="mb-4 text-xl font-bold">Detail Tentang UKM KSR</h2>

        <div class="p-4 bg-white border border-gray-200 rounded-2xl shadow-sm">
            <p class="mb-2 text-gray-700"><strong>Deskripsi:</strong></p>
            <div class="p-3 bg-gray-100 border rounded">
                {!! nl2br(e($data->deskripsi_ksr)) !!}
            </div>

            <p class="mt-4 text-sm text-gray-500">Dibuat pada: {{ $data->created_at->translatedFormat('d F Y') }}</p>
            <p class="text-sm text-gray-500">Diperbarui pada: {{ $data->updated_at->translatedFormat('d F Y') }}</p>

            <a href="{{ route('tentang.index') }}" class="inline-block mt-4 text-gray-500 transition hover:text-red-600">← Kembali</a>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 150,
            });
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
