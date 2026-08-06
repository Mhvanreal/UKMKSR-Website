@extends('admin.layout.navbar')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm">
    <h1 class="mb-4 text-2xl font-bold text-gray-800">Detail Blog Artikel</h1>

    <p class="py-2"><strong>Judul Artikel:</strong>{{ $blog->title }}</p>
    <img class="object-cover w-32 h-32 mt-4 rounded" src="{{ asset('storage/'.$blog->images) }}" alt="{{ $blog->title }}">

    <p class="py-2 "><strong>Deskripsi Artikel:</strong>{!! $blog->description !!}</p>

    <div class="flex justify-end gap-4 mt-6">
        <a href="{{ route('blogadmin.index') }}" class="px-4 py-2 text-gray-700 bg-gray-100 border border-gray-200 rounded hover:bg-gray-200">Kembali</a>
        <a href="{{ route('blogadmin.edit', $blog->id) }}" class="px-4 py-2 text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
    </div>
</div>

@endsection
