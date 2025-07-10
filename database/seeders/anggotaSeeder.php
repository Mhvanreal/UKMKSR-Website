<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;


class anggotaSeeder extends Seeder
{
    public function run(): void
    {
        anggota::create([
            'nim' => 'E41221500',
            'nama' => 'Muhammad Dhani',
            'Nama_panggilan' => 'Daniy',
            'email'=> 'dani@gmail.com',
            'tempat_lahir' => 'Surabaya',
            'tanggal_lahir' => '2003-01-29',
            'Agama' => 'Kristen',
            'alamat' => 'jember Utara',
            'alasan_join' => 'nyari Pacar',
            'angkatan' => '13',
            'foto' => 'foto-anggota/hilmi.jpg',
            'jurusan' => 'Teknologi Informasi',
            'prodi' => 'Teknik Informatika',
            'Gol_darah' => 'AB',
            'No_tlpn' => '08123912414',
            'organisasi_yg_pernah_diikuti' => 'Tidak ada',
            'status' => 'aktif',
            'tahun_masuk_kuliah' => '2022',
            'jenis_kelamin' => 'laki-laki',
        ]);
    }
}
