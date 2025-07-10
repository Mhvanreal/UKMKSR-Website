<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    protected $table = 'pengurus';

    protected $fillable = ['anggota_id', 'periode_id', 'jabatan_id'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function periode()
    {
        return $this->belongsTo(PeriodeKepengurusan::class, 'periode_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function programKerjas()
    {
        return $this->hasMany(ProgramKerja::class, 'pengurus_id');
    }



}
