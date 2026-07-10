<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tentang;
use App\Models\Info;
use App\Models\VisiMisi;
use App\Models\Sejarah;
//yailah

class TentangController extends Controller
{
    public function index()
    {
        $tentang = Tentang::all();
        $info = Info::all();
        $sejarah = Sejarah::all();
        $visimisi = VisiMisi::all();

        return view('admin.tentang.index', compact('tentang', 'info', 'sejarah', 'visimisi'));
    }

    public function create()
    {
        return view('admin.tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate(['deskripsi_ksr' => 'required']);
        Tentang::create($request->all());
        return redirect()->route('tentang.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Tentang::findOrFail($id);
        return view('admin.tentang.show', compact('data'));
    }


	public function edit(Request $request, $id)
    {
        // Cek tipe data berdasarkan parameter
        $type = $request->get('type', 'tentang');

        $data = null;
        switch ($type) {
            case 'info':
                $data = Info::findOrFail($id);
                break;
            case 'visimisi':
                $data = VisiMisi::findOrFail($id);
                break;
            case 'sejarah':
                $data = Sejarah::findOrFail($id);
                break;
            default:
                $data = Tentang::findOrFail($id);
        }

        return view('admin.tentang.edit', compact('data', 'type'));
    }

	 public function update(Request $request, $id)
    {
        $type = $request->input('type', 'tentang');

        switch ($type) {
            case 'info':
                $request->validate(['link_yt_info_ksr' => 'required']);
                $data = Info::findOrFail($id);
                $data->update(['link_yt_info_ksr' => $request->link_yt_info_ksr]);
                break;
            case 'visimisi':
                $request->validate(['deskripsi_visi_misi_ksr' => 'required']);
                $data = VisiMisi::findOrFail($id);
                $data->update(['deskripsi_visi_misi_ksr' => $request->deskripsi_visi_misi_ksr]);
                break;
            case 'sejarah':
                $request->validate(['deskripsi_ksr' => 'required']);
                $data = Sejarah::findOrFail($id);
                $data->update(['deskripsi_ksr' => $request->deskripsi_ksr]);
                break;
            default:
                $request->validate(['deskripsi_ksr' => 'required']);
                $data = Tentang::findOrFail($id);
                $data->update(['deskripsi_ksr' => $request->deskripsi_ksr]);
        }

        return redirect()->route('tentang.index')->with('success', 'Data berhasil diubah');
    }

    public function destroy($id)
    {
        Tentang::destroy($id);
        return back()->with('success', 'Data berhasil dihapus');
    }

    ///////////// Function landingPage //////////////
    public function lambang()
    {
        $lambang = tentang::latest()->first();
        return view('LandingPage.lambang', compact('lambang'));
    }

    public function sejarah()
    {
        $sejarah = Sejarah::latest()->first();
        return view('LandingPage.sejarah', compact('sejarah'));
    }

    public function visimisi()
    {
        $visimisi = Visimisi::latest()->first();
        return view('LandingPage.visimisi', compact('visimisi'));
    }
}
