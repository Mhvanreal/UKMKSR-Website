<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'id_layanan',
        'nama_kegiatan',
        'deskripsi_kegiatan',
        'start_kegiatan',
        'end_kegiatan',
        'foto_kegiatan',
        'poster_kegiatan',
        'status',
    ];
     protected $dates = ['start_kegiatan', 'end_kegiatan'];
}
