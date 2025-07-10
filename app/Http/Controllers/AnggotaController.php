<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Imports\AnggotaImport;
use App\Models\DataNilai;
use Maatwebsite\Excel\Facades\Excel;


class AnggotaController extends Controller
{

    public function index(Request $request) {
        $angkatan = $request->query('angkatan');
        $angkatanList = Anggota::select('angkatan')->distinct()->orderBy('angkatan', 'asc')->pluck('angkatan');
        $query = Anggota::query();
        $query->whereIn('status', ['aktif', 'inaktif']);

        if (!empty($angkatan)) {
            $query->where('angkatan', $angkatan);
        }

        $anggotas = $query->orderBy('angkatan', 'desc')->paginate(10);

        return view('admin.anggota.index', compact('anggotas', 'angkatanList'));
    }


    public function create(){
        return view('admin.anggota.create_anggota');
    }

        public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'nim' => 'required|unique:anggota,nim',
                'Nama_panggilan' => 'nullable|string',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'nullable|string',
                'Agama' => 'nullable|string',
                'email' => 'nullable|email',
                'angkatan' => 'required|integer',
                'alasan_join' => 'nullable|string',
                'jurusan' => 'required|string',
                'prodi' => 'required|string',
                'tahun_masuk_kuliah' => 'required|digits:4',
                'status' => 'required|in:Aktif,Tidak Aktif,Inaktif',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'Gol_darah' => 'nullable|string',
                'organisasi_yg_pernah_diikuti' => 'nullable|string',
                'No_tlpn' => 'nullable|string',
                'alamat' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imagePath = null;
            if ($request->hasFile('foto')) {
                $imagePath = $request->file('foto')->store('foto-anggota', 'public');
            }

            Anggota::create([
                'nama' => $request->input('nama'),
                'Nama_panggilan' => $request->input('Nama_panggilan'),
                'nim' => $request->input('nim'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'Agama' => $request->input('Agama'),
                'email' => $request->input('email'),
                'angkatan' => $request->input('angkatan'),
                'alasan_join' => $request->input('alasan_join'),
                'jurusan' => $request->input('jurusan'),
                'prodi' => $request->input('prodi'),
                'tahun_masuk_kuliah' => $request->input('tahun_masuk_kuliah'),
                'status' => $request->input('status'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'Gol_darah' => $request->input('Gol_darah'),
                'organisasi_yg_pernah_diikuti' => $request->input('organisasi_yg_pernah_diikuti'),
                'No_tlpn' => $request->input('No_tlpn'),
                'alamat' => $request->input('alamat'),
                'foto' => $imagePath,
                'created_at' => Carbon::now(),
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan data anggota. ' . $e->getMessage());
        }
    }

    public function destroy($id) {
        $anggota = Anggota::findOrFail($id);
        if ($anggota->foto) {
            Storage::disk('public')->delete($anggota->foto);
        }
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dihapus');
    }

    public function edit($id){
        $anggota = anggota::findOrFail($id);
        return view ('admin.anggota.update_anggota', compact('anggota'));
    }

        public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'Nama_panggilan' => 'nullable|string',
                'nim' => 'required|exists:anggota,nim',
                'tanggal_lahir' => 'required|date',
                'tempat_lahir' => 'nullable|string',
                'Agama' => 'nullable|string',
                'email' => 'nullable|email',
                'angkatan' => 'required|integer',
                'alasan_join' => 'nullable|string',
                'jurusan' => 'required|string',
                'prodi' => 'required|string',
                'tahun_masuk_kuliah' => 'required|digits:4',
                'status' => 'required|in:Aktif,Tidak Aktif,Inaktif',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'Gol_darah' => 'nullable|string',
                'organisasi_yg_pernah_diikuti' => 'nullable|string',
                'No_tlpn' => 'nullable|string',
                'alamat' => 'required|string',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $anggota = Anggota::findOrFail($id);

            if ($request->hasFile('foto')) {
                if ($anggota->foto) {
                    Storage::disk('public')->delete($anggota->foto);
                }
                $anggota->foto = $request->file('foto')->store('foto-anggota', 'public');
            }

            $anggota->update([
                'nama' => $request->input('nama'),
                'Nama_panggilan' => $request->input('Nama_panggilan'),
                'nim' => $request->input('nim'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'Agama' => $request->input('Agama'),
                'email' => $request->input('email'),
                'angkatan' => $request->input('angkatan'),
                'alasan_join' => $request->input('alasan_join'),
                'jurusan' => $request->input('jurusan'),
                'prodi' => $request->input('prodi'),
                'tahun_masuk_kuliah' => $request->input('tahun_masuk_kuliah'),
                'status' => $request->input('status'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'Gol_darah' => $request->input('Gol_darah'),
                'organisasi_yg_pernah_diikuti' => $request->input('organisasi_yg_pernah_diikuti'),
                'No_tlpn' => $request->input('No_tlpn'),
                'alamat' => $request->input('alamat'),
            ]);

            return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data anggota. ' . $e->getMessage());
        }
    }


    public function show($id){

        $data_anggota = Anggota::findOrFail($id);
        return view('admin.anggota.detail_anggota', [
            'title'         => 'Detail',
            'data_anggota' => $data_anggota,
        ]);
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    $angkatan = $request->input('angkatan');

    $angkatanList = Anggota::select('angkatan')->distinct()->orderBy('angkatan', 'asc')->pluck('angkatan');

    $anggotas = Anggota::query()
        ->when($query, function ($q) use ($query) {
            $q->where(function ($subQuery) use ($query) {
                $subQuery->where('nama', 'like', "%$query%")
                         ->orWhere('nim', 'like', "%$query%");
            });
        })
        ->when($angkatan, function ($q) use ($angkatan) {
            $q->where('angkatan', $angkatan);
        })
        ->orderBy('angkatan', 'desc')
        ->paginate(10)
        ->withQueryString();

    return view('admin.anggota.index', compact('anggotas', 'angkatanList'));
}

    public function dataAnggota(Request $request){
        $filterAngkatan = $request->query('angkatan');
        $daftarAngkatan = Anggota::select('angkatan')->distinct()->orderBy('angkatan', 'asc')->pluck('angkatan');

        $query = Anggota::query();
        if (!empty($filterAngkatan)) {
            $query->where('angkatan', $filterAngkatan);
        }
        $dataAnggota = $query->orderBy('angkatan', 'desc')->get();
        return view('LandingPage.anggota', compact('dataAnggota', 'daftarAngkatan'));
    }

    public function cari(Request $request){

        $searchTerm = $request->input('query');
        $selectedAngkatan = $request->input('angkatan');
        $daftarAngkatan = Anggota::select('angkatan')->distinct()->orderBy('angkatan', 'asc')->pluck('angkatan');

        $dataAnggota = Anggota::query()
            ->when($searchTerm, function ($query) use ($searchTerm) {
                $query->where('nama', 'like', "%$searchTerm%")
                    ->orWhere('nim', 'like', "%$searchTerm%");
            })
            ->when($selectedAngkatan, function ($query) use ($selectedAngkatan) {
                $query->where('angkatan', $selectedAngkatan);
            })
            ->orderBy('angkatan', 'desc')
            ->get();

        return view('LandingPage.anggota', compact('dataAnggota', 'daftarAngkatan'));
    }

    public function importExcel(Request $request)
    {
        try {
            // Validasi file
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
            ]);

            $data = Excel::toArray([], $request->file('file'));
            $rows = array_slice($data[0], 1); // lewati baris header
            $errors = [];

            foreach ($rows as $index => $row) {
                $rowNumber = $index + 2; // baris asli Excel (karena baris 1 header)

                $nim = $row[0] ?? null;
                $nama = $row[1] ?? null;
                $tanggal_lahir = $row[2] ?? null;

                if (!$nim || !$nama || !$tanggal_lahir) {
                    $errors[] = "Baris {$rowNumber}: Data wajib (NIM, Nama, Tanggal Lahir) kosong.";
                    continue;
                }

                // Skip jika NIM sudah ada
                if (Anggota::where('nim', $nim)->exists()) {
                    $errors[] = "Baris {$rowNumber}: NIM '{$nim}' sudah terdaftar.";
                    continue;
                }

                // Format tanggal
                try {
                    $parsedDate = Carbon::parse($tanggal_lahir)->format('Y-m-d');
                } catch (\Exception $e) {
                    $errors[] = "Baris {$rowNumber}: Format tanggal tidak valid: '{$tanggal_lahir}'. Gunakan YYYY-MM-DD.";
                    continue;
                }

                // Simpan data
                Anggota::create([
                    'nim' => $nim,
                    'nama' => $nama,
                    'tanggal_lahir' => $parsedDate,
                    'alamat' => $row[3] ?? null,
                    'alasan_join' => $row[4] ?? null,
                    'angkatan' => $row[5] ?? null,
                    'jurusan' => $row[6] ?? null,
                    'prodi' => $row[7] ?? null,
                    'status' => $row[8] ?? 'Aktif',
                    'tahun_masuk_kuliah' => $row[9] ?? null,
                    'jenis_kelamin' => $row[10] ?? null,
                    'email' => $row[11] ?? null,
                    'Nama_panggilan' => $row[12] ?? null,
                    'tempat_lahir' => $row[13] ?? null,
                    'Agama' => $row[14] ?? null,
                    'Gol_darah' => $row[15] ?? null,
                    'organisasi_yg_pernah_diikuti' => $row[16] ?? null,
                    'No_tlpn' => $row[17] ?? null,
                ]);
            }

            if ($errors) {
                return back()->withErrors($errors);
            }

            return back()->with('success', 'Data anggota berhasil diimpor.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengimpor data Excel. ' . $e->getMessage());
        }
    }

}
