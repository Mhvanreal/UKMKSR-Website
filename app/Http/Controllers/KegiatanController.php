<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::select('id_kegiatan', 'nama_kegiatan', 'created_at', 'status', 'start_kegiatan', 'end_kegiatan')
            ->where('status', 'aktif')
            ->latest()
            ->get();

        $daftarKegiatan = Kegiatan::select('id_kegiatan', 'nama_kegiatan', 'created_at', 'status', 'start_kegiatan', 'end_kegiatan')
            ->where('status', 'tidak')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.kegiatan.index', compact('kegiatan', 'daftarKegiatan'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'start_kegiatan' => 'required|date',
            'end_kegiatan' => 'required|date|after_or_equal:start_kegiatan',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'poster_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $fotoPath = null;
        $posterPath = null;

        if ($request->hasFile('foto_kegiatan')) {
            $fotoFile = $request->file('foto_kegiatan');
            $fotoNama = time() . '_' . $fotoFile->getClientOriginalName();
            $fotoPath = $fotoFile->storeAs('kegiatan/foto', $fotoNama, 'public');
        }

        if ($request->hasFile('poster_kegiatan')) {
            $posterFile = $request->file('poster_kegiatan');
            $posterNama = time() . '_' . $posterFile->getClientOriginalName();
            $posterPath = $posterFile->storeAs('kegiatan/poster', $posterNama, 'public');
        }

        Kegiatan::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'start_kegiatan' => $request->start_kegiatan,
            'end_kegiatan' => $request->end_kegiatan,
            'foto_kegiatan' => $fotoPath,
            'poster_kegiatan' => $posterPath,
        ]);

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

   public function update(Request $request, $id)
{
    try {
        $kegiatan = Kegiatan::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'start_kegiatan' => 'required|date',
            'end_kegiatan' => 'required|date|after_or_equal:start_kegiatan',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'poster_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|in:aktif,tidak',
        ]);

        $kegiatan->nama_kegiatan = $request->nama_kegiatan;
        $kegiatan->deskripsi_kegiatan = $request->deskripsi_kegiatan;
        $kegiatan->start_kegiatan = $request->start_kegiatan;
        $kegiatan->end_kegiatan = $request->end_kegiatan;
        $kegiatan->status = $request->status;

        if ($request->hasFile('foto_kegiatan')) {
            if ($kegiatan->foto_kegiatan && Storage::exists('public/' . $kegiatan->foto_kegiatan)) {
                Storage::delete('public/' . $kegiatan->foto_kegiatan);
            }

            $fotoFile = $request->file('foto_kegiatan');
            $fotoNama = time() . '_' . $fotoFile->getClientOriginalName();
            $fotoPath = $fotoFile->storeAs('kegiatan/foto', $fotoNama, 'public');
            $kegiatan->foto_kegiatan = $fotoPath;
        }

        if ($request->hasFile('poster_kegiatan')) {
            if ($kegiatan->poster_kegiatan && Storage::exists('public/' . $kegiatan->poster_kegiatan)) {
                Storage::delete('public/' . $kegiatan->poster_kegiatan);
            }

            $posterFile = $request->file('poster_kegiatan');
            $posterNama = time() . '_' . $posterFile->getClientOriginalName();
            $posterPath = $posterFile->storeAs('kegiatan/poster', $posterNama, 'public');
            $kegiatan->poster_kegiatan = $posterPath;
        }

        $kegiatan->save();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');

    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function destroy($id)
    {
        Kegiatan::destroy($id);
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus!');
    }

    public function toggle($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->status = $kegiatan->status === 'aktif' ? 'tidak' : 'aktif';
        $kegiatan->save();

        return back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }

    public function viewPage()
    {
        $kegiatans = Kegiatan::where('status', 'aktif')->latest()->paginate(6);
        return view('LandingPage.kegiatan', compact('kegiatans'));

    }

    public function getKegiatan()
    {
        $kegiatan = Kegiatan::where('status', 'aktif')->get();

        $events = [];

        foreach ($kegiatan as $item) {
            $events[] = [
                'title' => $item->nama_kegiatan,
                'start' => $item->start_kegiatan,
                'end' => $item->end_kegiatan,
                'description' => $item->deskripsi_kegiatan,
            ];
        }

        return response()->json($events);
    }

    public function doras(){
        return view ('LandingPage.kegiatan.doras');
    }

public function detailshow($id){
    $kegiatan = Kegiatan::findOrFail($id);
    $kegiatans = Kegiatan::where('status', 'aktif')->get();
    return view('LandingPage.detail_kegiatan', compact('kegiatan', 'kegiatans'));
}





}

