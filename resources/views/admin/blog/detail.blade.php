@extends('admin.layout.navbar')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-md">
    <h1 class="mb-4 text-2xl font-bold">Detail Blog Artikel</h1>

    <p class="py-2"><strong>Judul Artikel:</strong>{{ $blog->title }}</p>
    <img class="mt-4" src="{{ asset('storage/'.$blog->images) }}" alt="{{ $blog->title }}" class="object-cover w-32 h-32 rounded">

    <p class="py-2 "><strong>Deskripsi Artikel:</strong>{!! $blog->description !!}</p>

    <div class="flex justify-end gap-4 mt-6">
        <a href="{{ route('blogadmin.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded">Kembali</a>
        <a href="{{ route('blogadmin.edit', $blog->id) }}" class="px-4 py-2 text-white bg-yellow-500 rounded">Edit</a>
    </div>
</div>

@endsection
