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

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required',
            'tanggal_lahir' => 'required|date',
            'angkatan' => 'required',
            'alasan_join' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|string',
            'tahun_masuk_kuliah' => 'required',
            'status' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'alamat' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('foto-anggota', 'public');
        }

        Anggota::create([
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'angkatan' => $request->input('angkatan'),
            'alasan_join' => $request->input('alasan_join'),
            'jurusan' => $request->input('jurusan'),
            'prodi' => $request->input('prodi'),
            'tahun_masuk_kuliah' => $request->input('tahun_masuk_kuliah'),
            'status' => $request->input('status'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'foto' => $imagePath,
            'alamat' => $request->input('alamat'),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan!');
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

    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required',
            'tanggal_lahir' => 'required|date',
            'angkatan' => 'required',
            'alasan_join' => 'required|string',
            'jurusan' => 'required|string',
            'prodi' => 'required|string',
            'tahun_masuk_kuliah' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat' => 'required|string',
        ]);

        $anggota = Anggota::findOrFail($id);

        if($request->hasFile('foto')){
            if($anggota->foto){
                Storage::disk('public')->delete($anggota->foto);
            }
            $anggota->foto = $request->file('foto')->store('foto-anggota', 'public');
        }
        $anggota->nama = $request->input('nama');
        $anggota->nim = $request->input('nim');
        $anggota->tanggal_lahir = $request->input('tanggal_lahir');
        $anggota->angkatan = $request->input('angkatan');
        $anggota->alasan_join = $request->input('alasan_join');
        $anggota->jurusan = $request->input('jurusan');
        $anggota->prodi = $request->input('prodi');
        $anggota->tahun_masuk_kuliah = $request->input('tahun_masuk_kuliah');
        $anggota->jenis_kelamin = $request->input('jenis_kelamin');
        $anggota->status = $request ->input('status');
        $anggota->alamat = $request->input('alamat');
        $anggota->save();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui');
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
          // 1. Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        // 2. Baca file
        $data = Excel::toArray([], $request->file('file'));
        $rows = array_slice($data[0], 1);
        $errors = [];

        foreach ($rows as $index => $row) {
            $rowNumber = $index + 1;
            $nim = $row[0] ?? null;
            $nama = $row[1] ?? null;
            $tanggal_lahir = $row[2] ?? null;

            // Cek kelengkapan data
            if (!$nim || !$nama || !$tanggal_lahir) {
                $errors[] = "Baris ke-{$rowNumber} tidak lengkap.";
                continue;
            }

            // Cek duplikasi NIM
            if (Anggota::where('nim', $nim)->exists()) {
                $errors[] = "NIM '{$nim}' sudah terdaftar (baris ke-{$rowNumber}).";
                continue;
            }

            // Cek format tanggal
            try {
                $parsedDate = Carbon::parse($tanggal_lahir)->format('Y-m-d');
            } catch (\Exception $e) {
                $errors[] = "Format tanggal tidak valid di baris ke-{$rowNumber}: '{$tanggal_lahir}'. Gunakan format YYYY-MM-DD.";
                continue;
            }

            // Simpan data jika valid
            Anggota::create([
                'nim' => $nim,
                'nama' => $nama,
                'tanggal_lahir' => $parsedDate,
                'alamat' => $row[3] ?? '',
                'alasan_join' => $row[4] ?? '',
                'angkatan' => $row[5] ?? '',
                'jurusan' => $row[6] ?? '',
                'prodi' => $row[7] ?? '',
                'status' => $row[8] ?? '',
                'tahun_masuk_kuliah' => $row[9] ?? '',
                'jenis_kelamin' => $row[10] ?? '',
            ]);
        }

        if ($errors) {
            return back()->withErrors($errors);
        }

        return back()->with('success', 'Data berhasil diimpor.');
    }
}
