<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekrutmen;
use App\Models\Anggota;
use Barryvdh\DomPDF\Facade\Pdf;

class RekrutmentController extends Controller
{

    public function index(){
        $rekrutmen = Rekrutmen::latest()->get();
        return view('admin.Rekrutment.index', compact('rekrutmen'));
    }

        public function show($id)
    {
        try {
            $rekrutmen = Rekrutmen::findOrFail($id);
            return view('admin.Rekrutment.show', compact('rekrutmen'));
        } catch (\Exception $e) {
            return redirect()->route('Rekrutment-anggota.index')->with('error', 'Data tidak ditemukan.');
        }
    }

        public function terima($id)
    {
        try {
            $rekrut = Rekrutmen::findOrFail($id);

            if ($rekrut->anggota_id !== null || $rekrut->status === 'Diterima') {
                return back()->with('error', 'Pendaftar ini sudah diterima sebelumnya.');
            }

            $anggota = Anggota::create([
                'nim'                        => $rekrut->nim,
                'email'                      => $rekrut->email,
                'nama'                       => $rekrut->Nama,
                'nama_panggilan'             => $rekrut->Nama_panggilan,
                'tanggal_lahir'              => $rekrut->tanggal_lahir,
                'tempat_lahir'               => $rekrut->tempat_lahir,
                'alamat'                     => $rekrut->alamat,
                'alasan_join'                => $rekrut->alasan_join,
                'angkatan'                   => $rekrut->angkatan,
                'foto'                       => $rekrut->foto,
                'jurusan'                    => $rekrut->jurusan,
                'prodi'                      => $rekrut->prodi,
                'agama'                      => $rekrut->Agama,
                'No_tlpn'                    => $rekrut->No_tlpn,
                'gol_darah'                  => $rekrut->Gol_darah,
                'organisasi_yg_pernah_diikuti' => $rekrut->organisasi_yg_pernah_diikuti,
                'status'                     => 'Aktif',
                'tahun_masuk_kuliah'         => $rekrut->tahun_masuk_kuliah,
                'jenis_kelamin'              => $rekrut->jenis_kelamin,
            ]);
            $rekrut->status = 'Diterima';
            $rekrut->anggota_id = $anggota->id;
            $rekrut->save();

            return back()->with('success', 'Pendaftar berhasil diterima dan ditambahkan sebagai anggota.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menerima pendaftar.');
        }
    }




    public function ViewPage(){
       return view('LandingPage.rekrutment');
    }
    
 public function cetak($No_pendaftaran)
{
    try {
        $data = Rekrutmen::where('No_pendaftaran', $No_pendaftaran)->firstOrFail();

        // Alih-alih generate PDF, langsung render Blade-nya
        return view('LandingPage.surat', compact('data'));

    } catch (\Exception $e) {
        \Log::error('Error saat menampilkan bukti: ' . $e->getMessage());
        return back()->with('error', 'Gagal menampilkan bukti: ' . $e->getMessage());
    }
}
  

 public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nim' => 'required|unique:rekrutmen',
                'Nama' => 'required',
                'Nama_panggilan' => 'required',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'required',
                'Agama' => 'required',
                'jurusan' => 'required',
                'prodi' => 'required',
                'alamat' => 'required',
                'email' => 'required|email',
                'No_tlpn' => 'required',
                'Gol_darah' => 'required',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'organisasi_yg_pernah_diikuti' => 'nullable',
                'tahun_masuk_kuliah' => 'required|digits:4',
                'alasan_join' => 'required',
                'foto' => 'nullable|mimes:jpg,jpeg,png|max:10240',
            ]);

            $validated['No_pendaftaran'] = '07' . now()->format('YmdHis') . rand(10,99);

            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('foto_rekrutmen', 'public');
            }

            $rekrutmen = Rekrutmen::create($validated);

            // return redirect()->route('rekrutmen.cetak', $rekrutmen->No_pendaftaran);

            return view('LandingPage.success', [
        'no_pendaftaran' => $rekrutmen->No_pendaftaran,
        'wa_link'        => 'https://chat.whatsapp.com/CQNFX3PtVoE1UNx6I5GpNg?mode=ac_t'
    ]);
        } catch (\Exception $e) {
            \Log::error('Error saat menyimpan rekrutmen: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    
        public function cekNim(Request $request)
    {
        try {
            $request->validate(['nim' => 'required']);
            $data = Rekrutmen::where('nim', $request->nim)->first();

            if ($data) {
                return redirect()->route('rekrutmen.cetak', $data->No_pendaftaran);
            }

            return back()->with('error', 'NIM belum pernah mendaftar.');
        } catch (\Exception $e) {
            \Log::error('Error saat mengecek NIM: ' . $e->getMessage());
            return back()->with('error', 'Gagal melakukan pengecekan: ' . $e->getMessage());
        }
    }

public function destroy($id)
{
    $rekrutmen = Rekrutmen::findOrFail($id);

    $rekrutmen->delete();

    return redirect()
        ->route('Rekrutment-anggota.index')
        ->with('success', 'Data pendaftaran berhasil dihapus.');
}
}
