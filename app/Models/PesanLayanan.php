<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanLayanan extends Model
{
    use HasFactory;
    protected $table = 'pesan_layanan';
    protected $fillable = [
        'id_layanan',
        'nama',
        'asal',
        'nama_kegiatan',
        'surat_sph',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan');
    }
}
