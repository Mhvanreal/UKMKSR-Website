<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use HasFactory;
    protected $table = 'program_kerja';

    protected $fillable = ['nama_program', 'deskripsi', 'jabatan_id', 'pengurus_id'];

    // public function jabatan()
    // {
    //     return $this->belongsTo(Jabatan::class);
    // }
    public function pengurus()
    {
        return $this->belongsTo(Pengurus::class);
    }
}

