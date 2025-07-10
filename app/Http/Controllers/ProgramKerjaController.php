<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use App\Models\Anggota;
use App\Models\PeriodeKepengurusan;
use App\Models\Jabatan;
use App\Models\Divisi;
use App\Models\ProgramKerja;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class ProgramKerjaController extends Controller
{
    public function index() {
        try {
            $jabatans = Jabatan::with(['pengurus.programKerjas', 'pengurus.anggota'])->get();
            return view('admin.program_kerja.index', compact('jabatans'));
        } catch (\Exception $e) {
            Log::error("Error saat mengambil data jabatans: " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data program kerja.');
        }
    }

        public function showDetail($id)
    {
        try {
            $pengurus = Pengurus::with(['anggota', 'jabatan', 'periode', 'programKerjas'])->findOrFail($id);
            return view('admin.program_kerja.show', compact('pengurus'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('Program_kerja.index')->with('error', 'Pengurus tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error di show(): " . $e->getMessage());
            return redirect()->route('Program_kerja.index')->with('error', 'Terjadi kesalahan saat menampilkan data.');
        }
    }

        public function create()
    {
        try {
            $pengurus = Pengurus::with(['anggota', 'jabatan'])->get();
            return view('admin.program_kerja.create', compact('pengurus'));
        } catch (\Exception $e) {
            Log::error("Error di create(): " . $e->getMessage());
            return redirect()->route('Program_kerja.index')->with('error', 'Terjadi kesalahan saat memuat form.');
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_program' => 'required|string|max:255',
                'deskripsi'    => 'nullable|string',
                'pengurus_id'  => 'required|exists:pengurus,id',
            ]);

            ProgramKerja::create([
                'nama_program' => $request->nama_program,
                'deskripsi'    => $request->deskripsi,
                'pengurus_id'  => $request->pengurus_id,
            ]);

            return redirect()->route('Program_kerja.index')->with('success', 'Program kerja berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error("Error di store(): " . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan program kerja.');
        }
    }


    public function destroy($id)
    {
        try {
            $program = ProgramKerja::findOrFail($id);
            $program->delete();

            return redirect()->route('Program_kerja.index')->with('success', 'Program kerja berhasil dihapus.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('Program_kerja.index')->with('error', 'Program kerja tidak ditemukan.');
        } catch (\Exception $e) {
            Log::error("Error di destroy(): " . $e->getMessage());
            return redirect()->route('Program_kerja.index')->with('error', 'Terjadi kesalahan saat menghapus program kerja.');
        }
    }


        public function viewpage(Request $request)
    {
        try {
            $periodeId = $request->input('periode');
            $programQuery = ProgramKerja::with('pengurus.jabatan');

            if ($periodeId) {
                $pengurusIds = Pengurus::where('periode_id', $periodeId)->pluck('id');
                $programQuery->whereIn('pengurus_id', $pengurusIds);
            }
            $dataProgram = $programQuery->get()->groupBy(function ($item) {
                return $item->pengurus->jabatan->nama_jabatan ?? 'Tidak Ada Jabatan';
            });

            $daftarPeriode = PeriodeKepengurusan::all();
            return view('LandingPage.program_kerja', compact('dataProgram', 'daftarPeriode'));
        } catch (\Exception $e) {
            \Log::error("Error di viewpage(): " . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat program kerja.');
        }
    }


}
