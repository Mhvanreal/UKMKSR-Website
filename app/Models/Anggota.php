<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    use HasFactory;

    public $fillable = [
        "nim",
        "nama",
        'Nama_panggilan',
        'Agama',
        "tanggal_lahir",
        "tempat_lahir",
        "email",
        "angkatan",
        "alasan_join",
        "jurusan",
        "prodi",
        "status",
        "tahun_masuk_kuliah",
        "jenis_kelamin",
        'Gol_darah',
        'organisasi_yg_pernah_diikuti',
        "foto",
        "alamat",
        "No_tlpn",
        'created_at',
    ];

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class);

    }

    public function dataNilai(){
        return $this->hasMany(DataNilai::class);
    }
}
