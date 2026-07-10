<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\PeriodeKepengurusan;
use App\Models\Jabatan;
use App\Models\Divisi;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
     public function index()
    {
        $pengurus = Pengurus::with('anggota', 'jabatan.divisi', 'periode', 'programKerjas')->get();
        $anggota = Anggota::all();
        $periode = PeriodeKepengurusan::all();
        $jabatan = Jabatan::with('divisi')->get();
        $divisi = Divisi::all();

        return view('admin.kepengurusan.index', compact('pengurus', 'anggota', 'periode', 'divisi', 'jabatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'periode_id' => 'required|exists:periode_kepengurusan,id',
        ]);

        Pengurus::create([
            'anggota_id' => $request->anggota_id,
            'jabatan_id' => $request->jabatan_id,
            'periode_id' => $request->periode_id,
        ]);

        return redirect()->back()->with('success', 'Data pengurus berhasil ditambahkan');
    }

    public function edit($id)
    {
        $item = Pengurus::findOrFail($id);
        $anggota = Anggota::all();
        $jabatan = Jabatan::with('divisi')->get();
        $periode = PeriodeKepengurusan::all();

        return view('admin.kepengurusan.update', compact('item', 'anggota', 'jabatan', 'periode'));
    }

    public function update(Request $request, $id)
    {
        $pengurus = Pengurus::findOrFail($id);

        $pengurus->update([
            'anggota_id' => $request->anggota_id,
            'jabatan_id' => $request->jabatan_id,
            'periode_id' => $request->periode_id,
        ]);

        return redirect()->route('Kepengurusan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        $pengurus->programKerjas()->delete(); // karena programKerja punya FK ke pengurus
        $pengurus->delete();

        return redirect()->back()->with('success', 'Data pengurus berhasil dihapus.');
    }

    public function show($id)
    {
        $pengurus = Pengurus::with(['anggota', 'jabatan.divisi', 'periode', 'programKerjas'])->findOrFail($id);

        return view('admin.kepengurusan.show', compact('pengurus'));
    }

    public function tampilanblade()
    {
        $dataPengurus = Pengurus::with('anggota', 'jabatan.divisi', 'periode', 'programKerjas')->get();
        $daftarPeriode = PeriodeKepengurusan::orderBy('tahun_mulai', 'desc')->get();

        return view('LandingPage.kepengurusan', compact('dataPengurus','daftarPeriode'));
    }

    public function dataPengurus(Request $request)
    {
        $filterPeriode = $request->query('periode');
        $daftarPeriode = PeriodeKepengurusan::orderBy('tahun_mulai', 'desc')->get();

        $query = Pengurus::with(['anggota', 'jabatan', 'periode']);

        if (!empty($filterPeriode)) {
            $query->where('periode_id', $filterPeriode);
        }

        $dataPengurus = $query->get();

        return view('LandingPage.kepengurusan', compact('dataPengurus', 'daftarPeriode'));
    }


}
