<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrutmen extends Model
{
     use HasFactory;
     protected $table = 'rekrutmen';

    protected $fillable = [
        'No_pendaftaran',
        'nim',
        'Nama',
        'Nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'Agama',
        'jurusan',
        'prodi',
        'alamat',
        'email',
        'No_tlpn',
        'Gol_darah',
        'jenis_kelamin',
        'organisasi_yg_pernah_diikuti',
        'tahun_masuk_kuliah',
        'alasan_join',
        'foto',
        'status',
        'anggota_id',
    ];
}
