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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body class="flex flex-col min-h-screen bg-gray-100">
        @include('partials.navbar')
        <section class="relative flex items-center justify-center w-full min-h-[60vh] text-white bg-black">
            <img class="absolute inset-0 object-cover w-full h-full opacity-70" src="{{ asset('img/kegiatan1.png') }}" alt="Kegiatan 1">
            <div class="relative z-10 px-4 text-center">
                <h1 class="text-5xl font-bold text-white md:text-6xl lg:text-7xl animate__animated animate__fadeInUp" style="font-family: 'Kanit', sans-serif;">
                    KEPENGURUSAN
                </h1>
                <hr class="w-1/2 mx-auto my-4 border-t-2 border-white opacity-80">
                <p class="mt-2 text-sm text-white md:text-lg">Unit Kegiatan Mahasiswa Korps Sukarela Palang Merah Indonesia Unit Politeknik Negeri Jember</p>
            </div>
        </section>
        <div class="w-full bg-red-600 h-7"></div>
        <main class="container flex-1 p-6 mx-auto">
            <section class="p-4 px-20 bg-white rounded-lg shadow-md">
                <div class="flex-grow mb-9">
                    <div class="px-3 py-2 mt-1 text-center">
                        <h1 class="mt-1 mb-2 text-3xl font-bold animate__animated animate__fadeInLeft" style="font-family: sans-serif;">
                            KEPENGURUSAN</h1>
                        <div class="flex flex-col items-center mt-3">
                            <img src="{{ asset('img/Lambang.png') }}" alt="lambang" class="w-40 h-30">
                            <h1 class="mt-2 font-bold text-l animate__animated animate__fadeInRight" style="font-family: sans-serif;">
                                UKM KSR POLITEKNIK NEGERI JEMBER
                            </h1>
                        </div>
                        <hr class="w-1/2 mx-auto mt-2 mb-2 border-t-2 border-black opacity-50">
                    </div>
                </div>

                <div class="flex justify-start mb-6">
                    <form method="GET" action="{{ route('pengurus') }}">
                        <select name="periode" onchange="this.form.submit()"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 sm:w-auto">
                            <option value="">Semua Periode</option>
                            @foreach ($daftarPeriode as $periode)
                                <option value="{{ $periode->id }}" {{ request('periode') == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->nama_periode }} ({{ $periode->tahun_mulai }} - {{ $periode->tahun_selesai ?? 'Sekarang' }})
                                </option>
                            @endforeach
                        </select>
                    </form>

                </div>

                <!-- Foto Buniya -->
                <div class="flex justify-center mt-10 scroll-animate">
                    <div class="flex flex-col items-center max-w-sm p-5 overflow-hidden bg-white rounded-lg shadow">
                        <img src="{{ asset('img/buniya.JPG') }}" alt="buniya" class="object-cover max-w-[240px] h-auto rounded-md"/>
                        <div class="pt-6 text-center">
                            <h3 class="mb-2 text-xl font-bold text-black">Niyalatul Muna S.Kom., MT</h3>
                            <p class="mb-2 text-xl text-gray-800">Pembina</p>
                        </div>
                    </div>
                </div>


                @php
                    $pengurusKetua = $dataPengurus->filter(function ($item) {
                        $jabatan = strtolower($item->jabatan->nama_jabatan);
                        return $jabatan === 'ketua umum' || $jabatan === 'wakil ketua';
                    });
                @endphp


        <div class="container py-10 mx-auto">
            <div class="flex flex-wrap justify-center gap-8">
                @foreach($pengurusKetua as $item)
                    <div class="flex flex-col items-center max-w-sm p-5 overflow-hidden bg-white rounded-lg shadow scroll-animate">
                        <img src="{{ asset('storage/'.$item->anggota->foto) }}"
                            alt="{{ $item->anggota->nama }}"
                            class="object-cover max-w-[240px] h-auto rounded-md" />
                        <div class="pt-6 text-center">
                            <h3 class="mb-2 text-xl font-bold text-black">{{ $item->anggota->nama }}</h3>
                            <p class="mb-2 text-gray-800">
                                {{ $item->jabatan->divisi->nama_divisi }} - {{ $item->jabatan->nama_jabatan }}
                            </p>
                            <p class="text-gray-600">
                                Periode: {{ $item->periode->tahun_mulai }} - {{ $item->periode->tahun_selesai ?? 'Sekarang' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @php
            $pengurusLain = $dataPengurus->filter(function ($item) {
                $jabatan = strtolower($item->jabatan->nama_jabatan);
                return $jabatan !== 'ketua umum' && $jabatan !== 'wakil ketua';
            });
        @endphp

        <div class="container py-10 mx-auto">
            <div class="{{ count($pengurusLain) <= 3 ? 'flex flex-wrap justify-center gap-8' : 'grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center' }}">
                @foreach($pengurusLain as $item)
                    <div class="flex flex-col items-center max-w-sm p-5 overflow-hidden bg-white rounded-lg shadow scroll-animate">
                        <img src="{{ asset('storage/'.$item->anggota->foto) }}"
                            alt="{{ $item->anggota->nama }}"
                            class="object-cover max-w-[240px] h-auto rounded-md"/>
                        <div class="pt-6 text-center">
                            <h3 class="mb-2 text-xl font-bold text-black">{{ $item->anggota->nama }}</h3>
                            <p class="mb-2 text-gray-800">{{ $item->jabatan->divisi->nama_divisi }} - {{ $item->jabatan->nama_jabatan }}</p>
                            <p class="text-gray-600">Periode: {{ $item->periode->tahun_mulai }} - {{ $item->periode->tahun_selesai ?? 'Sekarang' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


            </section>
        </main>
        <div class="w-full bg-red-600 h-7"></div>

        @include('partials.footer')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("animate__fadeInUp");
                        }
                    });
                }, {
                    threshold: 0.1,
                });

                document.querySelectorAll(".fade-on-scroll").forEach((el) => {
                    el.classList.add("opacity-0", "animate__animated");
                    observer.observe(el);
                });
            });
        </script>
    <script>
        document.getElementById('filterPeriode').addEventListener('change', function () {
            let filterValue = this.value;
            let params = new URLSearchParams(window.location.search);
            if (filterValue) {
                params.set('periode', filterValue);
            } else {
                params.delete('periode');
            }
            window.location.href = `?${params.toString()}`;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target); // Optional: hanya animasi sekali
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.scroll-animate').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const animatedEls = document.querySelectorAll('.animate-on-scroll');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });

            animatedEls.forEach(el => observer.observe(el));
        });
        </script>


    </body>







