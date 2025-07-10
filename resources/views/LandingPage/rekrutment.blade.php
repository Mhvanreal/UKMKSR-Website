<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Rekrutmen Anggota Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
       <div class="p-4 mb-6 text-sm text-blue-900 bg-blue-100 border border-blue-300 rounded-lg">
            <h2 class="mb-2 text-lg font-semibold">Informasi Pendaftaran</h2>
             {{-- <h3>Berikut ini Alur Pendaftaran</h3> --}}
            <p>Silakan Mengisi formulir pendaftaran ini dengan benar kemudian cetak bukti pendaftaran. Setelah itu segera kirim bukti pendaftaran tersebut ke Sekretaris UKM KSR PMI Polije sebagai syarat pendaftaran</p>
            <p>Silakan masukkan <strong>NIM</strong> Anda untuk memeriksa status pendaftaran sebelumnya. Jika belum pernah mendaftar, lanjutkan dengan mengisi formulir di bawah ini.</p>
        </div>
    <form action="{{ route('rekrutmen.cekNim') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex flex-col items-center gap-4 md:flex-row">
            <input type="text" name="nim" placeholder="Masukkan NIM untuk cek pendaftaran"
                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            <button type="submit"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">Cek Bukti Pendaftaran</button>
        </div>
    </form>


    <section class="p-6 bg-white rounded-lg shadow-md">
        <form action="{{route('rekrutmen.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 font-bold">NIM</label>
                    <input type="text" name="nim" class="w-full px-4 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block mb-2 font-bold">Nama Lengkap</label>
                    <input type="text" name="Nama" class="w-full px-4 py-2 border rounded" required>
                </div>
                <div>
                    <label class="block mb-2 font-bold">Nama Panggilan</label>
                    <input type="text" name="Nama_panggilan" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">tempat_lahir</label>
                    <input type="text" name="tempat_lahir" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Agama</label>
                    <input type="text" name="Agama" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Jurusan</label>
                    <input type="text" name="jurusan" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Program Studi</label>
                    <input type="text" name="prodi" class="w-full px-4 py-2 border rounded" placeholder = "D-IV Teknik Informatika">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Alamat</label>
                    <input type="text" name="alamat" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">No. Telepon</label>
                    <input type="text" name="No_tlpn" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Golongan Darah</label>
                    <input type="text" name="Gol_darah" class="w-full px-4 py-2 border rounded">
                </div>
                <div>
                    <label class="block mb-2 font-bold">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-2 border rounded">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 font-bold">Tahun Masuk Kuliah</label>
                    <input type="number" name="tahun_masuk_kuliah" class="w-full px-4 py-2 border rounded">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 font-bold">Organisasi yang Pernah Diikuti</label>
                    <textarea name="organisasi_yg_pernah_diikuti" class="w-full px-4 py-2 border rounded"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2 font-bold">Alasan Bergabung</label>
                    <textarea name="alasan_join" class="w-full px-4 py-2 border rounded"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block mb-2 font-bold">Foto</label>
                    <input type="file" name="foto" class="w-full">
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                    Submit
                </button>
            </div>
        </form>
    </section>
</main>

<div class="w-full bg-red-600 h-7"></div>
@include('partials.footer')
</body>
</html>
