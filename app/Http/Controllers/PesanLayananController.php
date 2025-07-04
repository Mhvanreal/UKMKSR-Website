<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesanLayanan;
use App\Models\Layanan;




class PesanLayananController extends Controller
{

    public function index(){
        $pesanan = PesanLayanan::with('layanan')->latest()->get();
        $layanan = Layanan::all();
        return view('admin.permohonan.index', compact('pesanan', 'layanan'));
    }

    public function create(){
        $layanans = Layanan::where('status', 'aktif')->get();
        return view('LandingPage.PesanLayanan', compact('layanans'));
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'id_layanan'     => 'required|exists:layanan,id_layanan',
            'nama'           => 'required|string|max:255',
            'asal'           => 'required|string|max:255',
            'no_hp'          => 'required',
            'nama_kegiatan'  => 'required|string|max:255',
            'surat_sph'      => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('surat_sph')) {
            $path = $request->file('surat_sph')->store('surat-sph', 'public');
        }

        PesanLayanan::create([
            'id_layanan'    => $validated['id_layanan'],
            'nama'          => $validated['nama'],
            'asal'          => $validated['asal'],
            'no_hp'         => $validated['no_hp'],
            'nama_kegiatan' => $validated['nama_kegiatan'],
            'surat_sph'     => $path,
            // 'status' default 'menunggu'
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');
    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan pesanan layanan: '.$e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim permohonan. Silakan coba lagi.');
    }
}


}
