<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="text-gray-800 bg-gray-100">
    @extends('admin.layout.navbar')
    @section('content')
    <div class="container py-8 mx-auto">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Blog</h1>
            <a href="{{route('blogadmin.create')}}" class="flex items-center px-4 py-2 text-white bg-green-500 rounded hover:bg-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700 bg-white border border-gray-200">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-2 border-r">No</th>
                        <th class="px-4 py-2 border-r">Judul</th>
                        <th class="px-4 py-2 border-r">Tanggal Publikasi</th>
                        <th class="px-4 py-2 border-r">Deskripsi</th>
                        <th class="px-4 py-2 border-r">Gambar</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $key => $blog)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2 text-center border-r">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 border-r">{{ $blog->title }}</td>
                            <td class="px-4 py-2 text-center border-r">{{ $blog->created_at ? $blog->created_at->format('Y-m-d') : '-' }}</td>
                            <td class="px-4 py-2 border-r">{!! Str::limit(strip_tags($blog->description), 50, '...') !!}</td>
                            <td class="px-4 py-2 text-center border-r">
                                @if ($blog->images)
                                    <img src="{{ asset('storage/' . $blog->images) }}" alt="Gambar Blog" class="object-cover w-20 h-20 rounded">
                                @else
                                    <span>-</span>
                                @endif
                            </td>
                            <td class="flex items-center justify-center px-4 py-2 space-x-2">
                                <a href="{{ route('blogadmin.edit', $blog->id) }}" class="flex items-center px-2 py-1 text-white bg-yellow-400 rounded hover:bg-yellow-500">Edit</a>
                                <form action="{{ route('blogadmin.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus blog ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session("success") }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</body>

</html>
