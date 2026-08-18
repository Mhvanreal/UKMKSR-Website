<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rekrutmen Anggota Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body class="flex flex-col min-h-screen bg-gray-100">
@include('partials.navbar')

<section class="relative flex items-center justify-center w-full h-screen text-white">
    <img class="absolute top-0 left-0 object-cover w-full h-full filter "
         src="{{ asset('img/kegiatan1.png') }}" alt="Kegiatan 1">
    <div class="relative z-10 text-center">
        <h1 class="text-5xl font-bold text-white animate__animated animate__fadeInUp" style="font-family: 'Kanit', sans-serif;">
            REKRUTMEN ANGGOTA BARU</h1>
        <hr class="w-1/2 mx-auto my-4 border-t-2 border-white opacity-80">
        <p class="mt-4 text-lg text-white">UKM KSR PMI POLITEKNIK NEGERI JEMBER</p>
    </div>
</section>
<div class="w-full bg-red-600 h-7"></div>



    <main class="container flex-1 px-4 py-8 mx-auto">

    @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 bg-red-200 rounded-lg">{{ session('error') }}</div>
    @endif

    @if(!$pengaturan->is_open)
        <!-- Pendaftaran Ditutup -->
        @php
            $pesanInfo = $pengaturan->getPesanTutupUntukUser();
        @endphp
        
        <div class="p-8 text-center bg-white rounded-lg shadow-md">
            <div class="flex justify-center mb-4">
                <svg class="w-20 h-20 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="mb-4 text-2xl font-bold text-red-600">Pendaftaran Ditutup</h2>
            <p class="mb-4 text-gray-600">{{ $pesanInfo['pesan'] }}</p>
            
            @if($pesanInfo['info_jadwal'])
                <div class="p-4 mb-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <p class="text-sm text-gray-700">{{ $pesanInfo['info_jadwal'] }}</p>
                    @if($pesanInfo['show_tanggal'])
                        <p class="mt-2 text-lg font-semibold text-blue-600">
                            {{ $pesanInfo['show_tanggal']->format('d M Y H:i') }} WIB
                        </p>
                    @endif
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('welcome') }}" class="px-6 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Kembali ke Beranda
                </a>
            </div>

            <!-- Form Cek Bukti Pendaftaran (tetap tersedia) -->
            <div class="pt-6 mt-8 border-t border-gray-200">
                <p class="mb-4 text-sm text-gray-600">Sudah pernah mendaftar? Cek bukti pendaftaran Anda:</p>
                <form action="{{ route('rekrutmen.cekNim') }}" method="POST" class="flex flex-col items-center gap-4 md:flex-row md:justify-center">
                    @csrf
                    <input type="text" name="nim" placeholder="Masukkan NIM" required
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <button type="submit"
                        class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Cek Bukti Pendaftaran</button>
                </form>
            </div>
        </div>
    @else
        <!-- Pendaftaran Dibuka -->
       <div class="p-4 mb-6 text-sm text-blue-900 bg-blue-100 border border-blue-300 rounded-lg">
            <h2 class="mb-2 text-lg font-semibold">Informasi Pendaftaran</h2>
             {{-- <h3>Berikut ini Alur Pendaftaran</h3> --}}
            <p>Silakan Mengisi formulir pendaftaran ini dengan benar kemudian cetak bukti pendaftaran. Setelah itu segera kirim bukti pendaftaran tersebut ke Sekretaris UKM KSR PMI Polije sebagai syarat pendaftaran</p>
            <p>Silakan masukkan <strong>NIM</strong> Anda untuk memeriksa status pendaftaran sebelumnya. Jika belum pernah mendaftar, lanjutkan dengan mengisi formulir di bawah ini.</p>
        </div>
    <form action="{{ route('rekrutmen.cekNim') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex flex-col items-center gap-4 md:flex-row">
            <input type="text" name="nim" placeholder="Masukkan NIM untuk cek pendaftaran" required
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Cek Bukti Pendaftaran</button>
        </div>
    </form>

    @if ($errors->any())
    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 border border-red-400 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif


    <section class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('rekrutmen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            
            {{-- NIM --}}
            <div>
                <label for="nim" class="block font-medium">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" 
                    class="w-full border rounded px-3 py-2" required>
                @error('nim') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Nama Lengkap --}}
            <div>
                <label class="block mb-2 font-bold">Nama Lengkap</label>
                <input type="text" name="Nama" value="{{ old('Nama') }}" class="w-full px-4 py-2 border rounded" required>
                @error('Nama') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Nama Panggilan --}}
            <div>
                <label class="block mb-2 font-bold">Nama Panggilan</label>
                <input type="text" name="Nama_panggilan" value="{{ old('Nama_panggilan') }}" class="w-full px-4 py-2 border rounded" required>
                @error('Nama_panggilan') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div>
                <label class="block mb-2 font-bold">Tempat lahir</label>
                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="w-full px-4 py-2 border rounded" required>
                @error('tempat_lahir') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label class="block mb-2 font-bold">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full px-4 py-2 border rounded" required>
                @error('tanggal_lahir') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Agama --}}
            <div>
                <label class="block mb-2 font-bold">Agama</label>
                <input type="text" name="Agama" value="{{ old('Agama') }}" class="w-full px-4 py-2 border rounded" required>
                @error('Agama') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Jurusan --}}
            <div>
                <label class="block mb-2 font-bold">Jurusan</label>
                <input type="text" name="jurusan" value="{{ old('jurusan') }}" class="w-full px-4 py-2 border rounded" required>
                @error('jurusan') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Program Studi --}}
            <div>
                <label class="block mb-2 font-bold">Program Studi</label>
                <input type="text" name="prodi" value="{{ old('prodi') }}" class="w-full px-4 py-2 border rounded" placeholder="D-IV Teknik Informatika" required>
                @error('prodi') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block mb-2 font-bold">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat') }}" class="w-full px-4 py-2 border rounded" required>
                @error('alamat') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-2 font-bold">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-2 border rounded" required>
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- No Telepon --}}
            <div>
                <label class="block mb-2 font-bold">No. Telepon</label>
                <input type="text" name="No_tlpn" value="{{ old('No_tlpn') }}" class="w-full px-4 py-2 border rounded" required>
                @error('No_tlpn') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Golongan Darah --}}
            <div>
                <label class="block mb-2 font-bold">Golongan Darah</label>
                <input type="text" name="Gol_darah" value="{{ old('Gol_darah') }}" class="w-full px-4 py-2 border rounded" required>
                @error('Gol_darah') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label class="block mb-2 font-bold">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full px-4 py-2 border rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Tahun Masuk --}}
            <div>
                <label class="block mb-2 font-bold">Tahun Masuk Kuliah</label>
                <input type="number" name="tahun_masuk_kuliah" value="{{ old('tahun_masuk_kuliah') }}" class="w-full px-4 py-2 border rounded" required>
                @error('tahun_masuk_kuliah') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Organisasi --}}
            <div class="md:col-span-2">
                <label class="block mb-2 font-bold">Organisasi yang Pernah Diikuti</label>
                <textarea name="organisasi_yg_pernah_diikuti" class="w-full px-4 py-2 border rounded" required>{{ old('organisasi_yg_pernah_diikuti') }}</textarea>
                @error('organisasi_yg_pernah_diikuti') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Alasan Join --}}
            <div class="md:col-span-2">
                <label class="block mb-2 font-bold">Alasan Bergabung</label>
                <textarea name="alasan_join" class="w-full px-4 py-2 border rounded" required>{{ old('alasan_join') }}</textarea>
                @error('alasan_join') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            {{-- Foto --}}
            <div class="md:col-span-2">
                <label class="block mb-2 font-bold">Foto</label>
                <input type="file" name="foto" class="w-full" required>
                @error('foto') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                Submit
            </button>
        </div>
    </form>

    </section>
    @endif
</main>

<div class="w-full bg-red-600 h-7"></div>
@include('partials.footer')
</body>
</html>
