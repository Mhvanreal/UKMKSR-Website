<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use Illuminate\Support\Str;
use Illuminate\Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\PesanLayanan;
use App\Models\Kegiatan;

class LayananPageController extends Controller
{

    public function layananPage(){
        $layanans = Layanan::where('status', 'aktif')->get();
        return view('LandingPage.layanan', compact('layanans'));
    }

    // public function wellayanan(){
    //     $layanans = Layanan::where('status', 'aktif')->get();
    //     return view('welcome', compact('layanans'));
    // }

    public function index()
    {
        $layanan = Layanan::select('id_layanan', 'nama_layanan', 'created_at', 'status')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        $daftarLayanan = Layanan::select('id_layanan', 'nama_layanan', 'created_at', 'status')
            ->where('status', 'tidak')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.layanan.index', compact('layanan', 'daftarLayanan'));
    }

    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.show', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'nullable|string',
            'foto_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'poster_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $fotoPath = null;
        $posterPath = null;

        if ($request->hasFile('foto_layanan')) {
            $fotoFile = $request->file('foto_layanan');
            $fotoNama = time() . '_' . $fotoFile->getClientOriginalName();
            $fotoPath = $fotoFile->storeAs('layanan', $fotoNama, 'public');
        }

        if ($request->hasFile('poster_layanan')) {
            $posterFile = $request->file('poster_layanan');
            $posterNama = time() . '_' . $posterFile->getClientOriginalName();
            $posterPath = $posterFile->storeAs('layanan', $posterNama, 'public');
        }

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'deskripsi_layanan' => $request->deskripsi_layanan,
            'foto_layanan' => $fotoPath,
            'poster_layanan' => $posterPath,
        ]);

        return redirect()->route('service.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi_layanan' => 'nullable|string',
            'foto_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'poster_layanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;

        if ($request->hasFile('foto_kegiatan')) {

            if ($layanan->foto_layanan) {
                Storage::delete('public/' . $layanan->foto_layanan);
            }
            $fotoPath = $request->file('foto_layanan')->store('layanan/foto', 'public');
            $layanan->foto_layanan = $fotoPath;
        }

        if ($request->hasFile('poster_layanan')) {
            if ($layanan->poster_kegiatan) {
                Storage::delete('public/' . $layanan->poster_layanan);
            }
            $posterPath = $request->file('poster_layanan')->store('layanan/poster', 'public');
            $layanan->poster_layanan = $posterPath;
        }

        $layanan->save();

        return redirect()->route('service.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Layanan::destroy($id);
        return redirect()->route('service.index')->with('success', 'Layanan berhasil dihapus!');
    }

    public function toggle($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->status = $layanan->status === 'aktif' ? 'tidak' : 'aktif';
        $layanan->save();

        return back()->with('success', 'Status layanan berhasil diperbarui.');
    }

    public function detail($id) {
        $layanan = Layanan::findOrFail($id);
        $layanans = Layanan::where('status', 'aktif')->get();
        return view('LandingPage.show_layanan', compact('layanan', 'layanans'));
    }

//     public function accept($id) {
//     $pesan = PesanLayanan::findOrFail($id);

//     if ($pesan->status !== 'menunggu') {
//         return back()->with('error', 'Layanan sudah diproses.');
//     }
//     $pesan->status = 'disetujui';
//     $pesan->save();
//     Kegiatan::create([
//         'id_layanan' => $pesan->id_layanan,
//         'nama_kegiatan' => $pesan->nama_kegiatan,
//         'deskripsi_kegiatan' => 'Kegiatan otomatis dari layanan',
//         'status' => 'aktif',
//         'start_kegiatan' => now(),
//         'end_kegiatan' => now()->addDays(1),
//     ]);

//     return back()->with('success', 'Layanan berhasil disetujui dan kegiatan telah dibuat.');
// }
}
