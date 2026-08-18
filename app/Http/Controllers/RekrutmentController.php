<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekrutmen;
use App\Models\Anggota;
use App\Models\PengaturanRekrutmen;
use Barryvdh\DomPDF\Facade\Pdf;

class RekrutmentController extends Controller
{

    public function index(){
        $rekrutmen = Rekrutmen::latest()->get();
        $pengaturan = PengaturanRekrutmen::getPengaturan();
        return view('admin.Rekrutment.index', compact('rekrutmen', 'pengaturan'));
    }

    /**
     * Toggle status rekrutmen (buka/tutup)
     * Set manual_override = true untuk mencegah auto-check override
     */
    public function toggleStatus(Request $request)
    {
        $pengaturan = PengaturanRekrutmen::getPengaturan();
        $pengaturan->is_open = !$pengaturan->is_open;
        
        // Set manual override jika mode auto aktif
        // Ini mencegah auto-check langsung override status manual
        if ($pengaturan->is_auto) {
            $pengaturan->manual_override = true;
        }
        
        $pengaturan->save();

        $status = $pengaturan->is_open ? 'dibuka' : 'ditutup';
        return back()->with('success', "Pendaftaran rekrutmen berhasil {$status}.");
    }

    /**
     * Update pengaturan rekrutmen
     * Clear manual_override saat update pengaturan
     */
    public function updatePengaturan(Request $request)
    {
        $request->validate([
            'is_auto' => 'nullable|boolean',
            'pesan_tutup' => 'nullable|string|max:500',
            'tanggal_buka' => 'nullable|date',
            'tanggal_tutup' => 'nullable|date|after_or_equal:tanggal_buka',
        ]);

        $pengaturan = PengaturanRekrutmen::getPengaturan();
        
        // Update is_auto
        $pengaturan->is_auto = $request->has('is_auto') ? true : false;
        
        // Update fields lainnya
        $pengaturan->pesan_tutup = $request->pesan_tutup;
        $pengaturan->tanggal_buka = $request->tanggal_buka;
        $pengaturan->tanggal_tutup = $request->tanggal_tutup;
        
        // Clear manual override saat admin update pengaturan
        // Artinya jadwal baru akan aktif dan tidak lagi di-override manual
        $pengaturan->manual_override = false;
        
        $pengaturan->save();

        // Jika mode auto aktif, langsung cek jadwal
        if ($pengaturan->is_auto) {
            $pengaturan->autoCheckStatus();
        }

        return back()->with('success', 'Pengaturan rekrutmen berhasil diperbarui.');
    }

        public function show($id)
    {
        try {
            // Validasi ID harus integer untuk mencegah SQL injection
            if (!is_numeric($id)) {
                abort(404);
            }
            
            $rekrutmen = Rekrutmen::findOrFail($id);
            return view('admin.Rekrutment.show', compact('rekrutmen'));
        } catch (\Exception $e) {
            return redirect()->route('Rekrutment-anggota.index')->with('error', 'Data tidak ditemukan.');
        }
    }

        public function terima(Request $request, $id)
    {
        try {
            // Validasi ID harus integer untuk mencegah SQL injection
            if (!is_numeric($id)) {
                abort(404);
            }

            // Angkatan wajib diisi karena atribut ini belum dimiliki data rekrutmen
            $request->validate([
                'angkatan' => 'required|integer',
            ]);
            
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
                'angkatan'                   => $request->angkatan,
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
            return back()->with('error', 'Terjadi kesalahan saat menerima pendaftar: ' . $e->getMessage());
        }
    }

    /**
     * Tolak pendaftar
     */
    public function tolak($id)
    {
        try {
            // Validasi ID harus integer untuk mencegah SQL injection
            if (!is_numeric($id)) {
                abort(404);
            }
            
            $rekrut = Rekrutmen::findOrFail($id);

            if ($rekrut->status === 'Diterima') {
                return back()->with('error', 'Tidak dapat menolak pendaftar yang sudah diterima.');
            }

            if ($rekrut->status === 'Ditolak') {
                return back()->with('error', 'Pendaftar ini sudah ditolak sebelumnya.');
            }

            $rekrut->status = 'Ditolak';
            $rekrut->save();

            return back()->with('success', 'Pendaftar berhasil ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menolak pendaftar: ' . $e->getMessage());
        }
    }




    public function ViewPage(){
        $pengaturan = PengaturanRekrutmen::getPengaturan();
        return view('LandingPage.rekrutment', compact('pengaturan'));
    }

 public function cetak($No_pendaftaran)
{
    try {
        // Validasi format nomor pendaftaran (hanya angka)
        if (!preg_match('/^[0-9]+$/', $No_pendaftaran)) {
            abort(404);
        }
        
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
            // Cek apakah rekrutmen sedang dibuka
            if (!PengaturanRekrutmen::isOpen()) {
                return back()->with('error', 'Maaf, pendaftaran rekrutmen sedang ditutup.');
            }

            // Jika NIM sudah pernah terdaftar (misal koneksi tidak stabil saat pendaftaran
            // sebelumnya sehingga halaman sukses tidak tampil), tampilkan bukti yang sudah ada
            $existing = Rekrutmen::whereRaw('TRIM(nim) = ?', [trim($request->nim)])->first();
            if ($existing) {
                return redirect()
                    ->route('rekrutmen.cetak', $existing->No_pendaftaran)
                    ->with('info', 'NIM ini sudah pernah terdaftar sebelumnya. Berikut bukti pendaftaran Anda.');
            }

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
                'organisasi_yg_pernah_diikuti' => 'required',
                'tahun_masuk_kuliah' => 'required|digits:4',
                'alasan_join' => 'required',
                'foto' => 'required|mimes:jpg,jpeg,png|max:10240',
            ]);

            // Generate No_pendaftaran unik (hindari tabrakan saat 2 pendaftar submit di detik yang sama)
            do {
                $noPendaftaran = '07' . now()->format('YmdHis') . rand(10, 99);
            } while (Rekrutmen::where('No_pendaftaran', $noPendaftaran)->exists());

            $validated['No_pendaftaran'] = $noPendaftaran;

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
            return back()->withInput()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }


        public function cekNim(Request $request)
    {
        try {
            $validated = $request->validate([
                'nim' => 'required|string|max:20'
            ]);
            
            $nim = trim($validated['nim']);

            $data = Rekrutmen::whereRaw('TRIM(nim) = ?', [$nim])->first();

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
    try {
        // Validasi ID harus integer untuk mencegah SQL injection
        if (!is_numeric($id)) {
            abort(404);
        }
        
        $rekrutmen = Rekrutmen::findOrFail($id);
        $rekrutmen->delete();

        return redirect()
            ->route('Rekrutment-anggota.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()
            ->route('Rekrutment-anggota.index')
            ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}

}