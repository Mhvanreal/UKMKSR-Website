<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UKM KSR POLIJE</title>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
<body class="flex flex-col min-h-screen bg-white">
    @include('partials.navbar')
    <main class="flex-grow pt-6">
        <section class="px-8 py-1 bg-white border-b fade-in">
            <div class="container max-w-5xl mx-auto">

                <div class="mb-10 text-center">
                    <h1 class="text-5xl font-bold leading-tight text-gray-800">Blogging</h1>
                    <div class="w-64 h-1 mx-auto mt-4 bg-red-600 rounded-t bg-gradient-to-r from-orange-500 opacity-60"></div>
                </div>

                <form action="{{ route('blog.search') }}" method="GET" class="flex items-start justify-start mb-8">
                    <input
                        type="text"
                        name="query"
                        placeholder="Cari artikel..."
                        class="px-4 py-2 text-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        style="font-family: 'Kanit', sans-serif;"
                        value="{{ request('query') }}">

                    <button
                        type="submit"
                        class="px-4 py-2 ml-2 font-bold text-white transition duration-300 ease-in-out bg-red-600 rounded-lg hover:bg-orange-600"
                        style="font-family: 'Kanit', sans-serif;">
                        Cari
                    </button>
                </form>


                <div class="grid gap-8 pb-8 mt-12 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($data as $blog)
                    <div class="transition-shadow duration-300 bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl">
                        <img src="{{ asset('storage/' . $blog->images) }}" alt="{{ $blog->title }}" class="object-cover w-full h-48">
                        <div class="relative p-6"> <!-- Tambahkan relative -->
                            <p class="mb-2 text-xl font-bold text-black">
                                {{ $blog->title }}
                            </p>
                            <p class="mb-4 text-gray-800">
                                {!! $blog->description !!}
                            </p>
                            <div class="mt-4 text-center p-9">
                                <a href="{{ route('blog.show', $blog->id) }}"
                                    class="px-6 py-3 font-bold text-red-500 transition bg-transparent border-2 border-red-600 rounded-lg hover:bg-red-600 hover:text-white">
                                     LEARN MORE
                                 </a>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </section>

    </main>
    @include('partials.footer')
</body>
</html>


