<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\JenisGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    // Menampilkan semua data galeri
    public function index(Request $request)
    {
        $tipe = $request->input('tipe', 'semua');
        $query = Galeri::with('jenisGaleri')->where('status', 'aktif');

        if ($tipe === 'foto') {
            $query->whereNotNull('foto_galeri');
        } elseif ($tipe === 'video') {
            $query->whereNotNull('video_galeri');
        }

        $galeri = $query->get();
        return view('admin.galeri.index', compact('galeri', 'tipe'));
    }

    // Menambahkan foto ke galeri
    public function tambahFoto()
    {
        $jenisGaleri = JenisGaleri::all();
        return view('admin.galeri.create', ['tipe' => 'foto', 'jenisGaleri' => $jenisGaleri]);
    }


    public function tambahVideo()
    {
        $jenisGaleri = JenisGaleri::all();
        return view('admin.galeri.create', ['tipe' => 'video', 'jenisGaleri' => $jenisGaleri]);
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'id_jenis_galeri' => 'required|in:1,2',
            'foto_galeri'     => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'video_galeri'    => 'nullable|mimes:mp4,mkv,avi',
            'status'          => 'required|in:aktif,tidak',
        ]);

        $data = $request->only(['id_jenis_galeri', 'status']);
        if ($request->hasFile('foto_galeri')) {
            $fotoPath = $request->file('foto_galeri')->store('galeri/foto', 'public');
            $data['foto_galeri'] = $fotoPath;
        }

        if ($request->hasFile('video_galeri')) {
            $video = $request->file('video_galeri');

            $videoPath = $video->storeAs(
                'galeri/video',
                time() . '_' . $video->getClientOriginalName(),
                'local'
            );

            $data['video_galeri'] = $videoPath;
        }

        Galeri::create($data);
        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil ditambahkan.');

    } catch (\Exception $e) {
        \Log::error('Gagal menyimpan data galeri: ' . $e->getMessage());
        return back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
    }
}



}
