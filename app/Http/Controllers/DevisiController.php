<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\PeriodeKepengurusan;

class DevisiController extends Controller
{
     public function store(Request $request){
        $request->validate([
            'nama_divisi' => 'required',
            'deskripsi' => 'required',
        ]);

        Divisi::create([
            'nama_divisi' => $request->nama_divisi,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('Kepengurusan.index')->with('success', 'Divisi berhasil ditambahkan');
    }

    public function storeJabatan(Request $request){
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'divisi_id' => 'required|exists:divisi,id',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'divisi_id' => $request->divisi_id,
        ]);

        return redirect()->route('Kepengurusan.index')->with('success', 'Jabatan berhasil ditambahkan');
    }

    public function storePeriode(Request $request){
        $request->validate([
            'nama_periode' => 'required',
            'tahun_mulai' => 'required',
            'tahun_selesai' => 'required',
        ]);

        PeriodeKepengurusan::create([
            'nama_periode' => $request->nama_periode,
            'tahun_mulai' => $request->tahun_mulai,
            'tahun_selesai' => $request->tahun_selesai,

        ]);

        return redirect()->route('Kepengurusan.index')->with('success', 'Periode berhasil ditambahkan');

    }

}
