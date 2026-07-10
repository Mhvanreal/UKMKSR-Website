<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $angkatan_terakhir = Anggota::max('angkatan');
        $tahun_sekarang = date('Y');
        
        $angkatan_awal = $angkatan_terakhir - 4;
        $angkatan_grafik = range($angkatan_awal, $angkatan_terakhir);

        
        $data_grafik = collect($angkatan_grafik)->map(function ($angkatan) {
            return Anggota::where('angkatan', $angkatan)
                ->whereIn('status', ['Aktif', 'Alumni'])
                ->count();
        });
        
	$angkatan_mulai = $angkatan_terakhir - 2;
        $jumlah_seluruh_anggota = Anggota::whereBetween('angkatan', [$angkatan_mulai, $angkatan_terakhir])->whereIn('status', ['Aktif', 'Alumni'])->count();
        $jumlah_seluruh_anggota_aktif = Anggota::whereBetween('angkatan', [$angkatan_mulai, $angkatan_terakhir])->where('status', 'Aktif')->count();
        $jumlah_seluruh_anggota_alumni = Anggota::whereBetween('angkatan', [$angkatan_mulai, $angkatan_terakhir])->where('status', 'Alumni')->count();

        $jumlah_kegiatan = Kegiatan::where('status', 'aktif')->count();
        $jumlah_layanan = Layanan::where('status', 'aktif')->count();

        // ulang tahun
        $today = Carbon::today();
        $twoWeeksLater = $today->copy()->addDays(14);

        $ulang_tahun_anggota = Anggota::select('*')
            ->whereRaw("DATE_FORMAT(tanggal_lahir, '%m-%d') >= ?", [$today->format('m-d')])
            ->whereRaw("DATE_FORMAT(tanggal_lahir, '%m-%d') <= ?", [$twoWeeksLater->format('m-d')])
            ->orderByRaw("DATE_FORMAT(tanggal_lahir, '%m-%d')")
            ->get();

        return view('admin.dashboard', [
            'title' => 'Beranda',
            'tahun_sekarang' => $tahun_sekarang, 
            'jumlah_seluruh_anggota' => $jumlah_seluruh_anggota,
            'jumlah_seluruh_anggota_aktif' => $jumlah_seluruh_anggota_aktif,
  	    'jumlah_seluruh_anggota_alumni' => $jumlah_seluruh_anggota_alumni,
            'jumlah_kegiatan' => $jumlah_kegiatan,
            'jumlah_layanan' => $jumlah_layanan,
            'data_grafik' => $data_grafik->toArray(),
            'angkatan_grafik' => $angkatan_grafik,
            'ulang_tahun_anggota' => $ulang_tahun_anggota
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
