<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';

    protected $fillable = ['nama_jabatan', 'divisi_id'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function pengurus()
    {
        return $this->hasMany(Pengurus::class);
    }

    // public function programKerja()
    // {
    //     return $this->hasMany(ProgramKerja::class);
    // }
}

