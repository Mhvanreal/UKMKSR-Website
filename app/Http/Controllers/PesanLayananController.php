<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesanLayanan;
use App\Models\Layanan;
use App\Models\Kegiatan;
use Illuminate\Support\Str;

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

   public function store(Request $request) {
    try {
        $validated = $request->validate([
            'id_layanan'         => 'required|exists:layanan,id_layanan',
            'nama'               => 'required|string|max:255',
            'asal'               => 'required|string|max:255',
            'no_hp'              => 'required|string|max:20',
            'nama_kegiatan'      => 'required|string|max:255',
            // 'deskripsi_kegiatan' => 'nullable|string',
            'start_kegiatan'     => 'required|date',
            'end_kegiatan'       => 'required|date|after_or_equal:start_kegiatan',
            'surat_sph'          => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('surat_sph')) {
            $path = $request->file('surat_sph')->store('surat-sph', 'public');
        }

        PesanLayanan::create([
            'id_layanan'         => $validated['id_layanan'],
            'nama'               => $validated['nama'],
            'asal'               => $validated['asal'],
            'no_hp'              => $validated['no_hp'],
            'nama_kegiatan'      => $validated['nama_kegiatan'],
            // 'deskripsi_kegiatan' => $validated['deskripsi_kegiatan'],
            'start_kegiatan'     => $validated['start_kegiatan'],
            'end_kegiatan'       => $validated['end_kegiatan'],
            'surat_sph'          => $path,
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil dikirim!');
    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan pesanan layanan: '.$e->getMessage());
        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim permohonan.');
    }
}

   public function accept($id)
{
    $pesan = PesanLayanan::findOrFail($id);

    if ($pesan->status !== 'menunggu') {
        return back()->with('error', 'Layanan sudah diproses.');
    }

    $pesan->status = 'disetujui';
    $pesan->save();

    // Buat kegiatan otomatis
    Kegiatan::create([
        'id_layanan' => $pesan->id_layanan,
        'nama_kegiatan' => $pesan->nama_kegiatan,
        'deskripsi_kegiatan' => 'Kegiatan otomatis dari layanan',
        'status' => 'aktif',
        'start_kegiatan' => $pesan->start_kegiatan,
        'end_kegiatan' => $pesan->end_kegiatan,
    ]);

    // Format nomor WA
    $no_wa = preg_replace('/[^0-9]/', '', $pesan->no_hp);
    if (Str::startsWith($no_wa, '0')) {
        $no_wa = '62' . substr($no_wa, 1);
    }

    // Kirim WA (gunakan helper)
    $this->sendWhatsapp($no_wa, "Halo $pesan->nama, permohonan Anda telah *disetujui*. Silakan cek detail kegiatan Anda.");

    return back()->with('success', 'Layanan berhasil disetujui dan kegiatan telah dibuat.');
}


public function reject($id)
{
    $pesan = PesanLayanan::findOrFail($id);

    if ($pesan->status !== 'menunggu') {
        return back()->with('error', 'Layanan sudah diproses.');
    }

    $pesan->status = 'ditolak';
    $pesan->save();

    return back()->with('success', 'Permohonan layanan telah ditolak.');
}



}
