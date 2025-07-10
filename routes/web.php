<?php

use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\NavigateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\LayananPageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataNilaiController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\DevisiController;
use App\Http\Controllers\ProgramKerjaController;
use App\Http\Controllers\PesanLayananController;
use App\Http\Controllers\RekrutmentController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'humas_ksr'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'humas_ksr'])->group(function () {
    Route::get('/akun', [NavigateController::class, 'akun'])->middleware(['auth', 'verified'])->name('akun');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/kegiatan', [NavigateController::class, 'kegiatan'])->name('kegiatan');
    Route::get('galeri/tambah-foto', [GaleriController::class, 'tambahFoto'])->name('galeri.tambah.foto');
    Route::get('galeri/tambah-video', [GaleriController::class, 'tambahVideo'])->name('galeri.tambah.video');
    Route::post('galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::resource('/blogadmin', BlogController::class);
    Route::resource('anggota', AnggotaController::class);
    Route::get('/anggota/search', [AnggotaController::class, 'search'])->name('anggota.search');
    Route::post('/anggota/import', [AnggotaController::class, 'importExcel'])->name('anggota.import');
    Route::resource('nilai', DataNilaiController::class);
    Route::resource('clustering', ClusteringController::class);
    Route::get('/cluster', [ClusteringController::class, 'cluster']);
    Route::get('/cluster/print', [ClusteringController::class, 'printCluster']);
    Route::resource('/kegiatan', KegiatanController::class);
    Route::resource('/tentang', TentangController::class);
    Route::resource('/service', LayananPageController::class);
    Route::post('/service/toggle/{id}', [LayananPageController::class, 'toggle'])->name('service.toggle');
    Route::resource('/Kepengurusan', PengurusController::class);
    Route::resource('/devisi', DevisiController::class);
    Route::post('/jabatan_create', [DevisiController::class, 'storeJabatan'])->name('jabatan.store');
    Route::post('/Periode_create', [DevisiController::class, 'storePeriode'])->name('Periode.store');
    Route::resource('/Program_kerja', ProgramKerjaController::class);
    Route::get('/Program_kerja/detail/{pengurus}', [ProgramKerjaController::class, 'showDetail'])->name('Program_kerja.detail');
    Route::resource('/pesan-layanan', PesanLayananController::class);
    Route::post('/kegiatan/toggle/{id}', [KegiatanController::class, 'toggle'])->name('kegiatan.toggle');
    Route::post('/pesan-layanan/accept/{id}', [PesanLayananController::class, 'accept'])->name('pesan-layanan.accept');
    Route::post('/pesan-layanan/reject/{id}', [PesanLayananController::class, 'reject'])->name('pesan-layanan.reject');

    Route::resource('/Rekrutment-anggota', RekrutmentController::class);
    Route::post('/Rekrutment-anggota/{id}/terima', [RekrutmentController::class, 'terima'])->name('Rekrutment-anggota.terima');
    
    // Route::get('/rekrutmen', [RekrutmenController::class, 'index'])->name('rekrutmen.index');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

////////////landing Page////////////
Route::get('/LayananKami', [LayananPageController::class, 'layananPage'])->name('layananksr');
Route::get('/lambangPMI', [TentangController::class, 'lambang'])->name('lambang');
Route::get('/rekrutment', [RekrutmentController::class, 'ViewPage'])->name('rekrutment');
Route::get('/SejarahKsr', [TentangController::class, 'sejarah'])->name('sejarah');
Route::get('/Visi_misi', [TentangController::class, 'visimisi'])->name('visimisi');
Route::get('/SerVice' , [LayananPageController::class, 'wellayanan'])->name('serviceksr');
Route::get('/serVice/{id}', [LayananPageController::class, 'detail'])->name('service.detail');
Route::get('/SerVice', [LayananPageController::class, 'wellayanan'])->name('serviceksr');
Route::get('/KegiatanKami', [KegiatanController::class, 'viewPage'])->name('aktifitas');
Route::get('/calendar-events', [KegiatanController::class, 'getKegiatan']);
Route::get('/struktur', [PengurusController::class, 'tampilanblade'])->name('struktur');
Route::get('/kepengurusan/periode', [PengurusController::class, 'pengurusPerPeriode'])->name('kepengurusan.periode');
Route::get('/pengurus', [PengurusController::class, 'dataPengurus'])->name('pengurus');
Route::get('/program-kerja', [ProgramKerjaController::class, 'viewpage'])->name('proker');
Route::get('/pesan-layanan/create', [PesanLayananController::class, 'create'])->name('pesan_layanan.create');
Route::post('/pesan-layanan', [PesanLayananController::class, 'store'])->name('pesan_layanan.store');
Route::get('/DataAnggota', [AnggotaController::class, 'dataAnggota'])->name('dataAnggota');
Route::get('/DataAnggota/search', [AnggotaController::class, 'cari'])->name('anggota.cari');
Route::get('/Blog', [BlogController::class, 'Blogging'])->name('bloging');
Route::get('/blog/{id}', [BlogController::class, 'detail'])->name('blog.detail');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('/kegiatan-detail/{id}', [KegiatanController::class, 'detailshow'])->name('kegiatanshow.detail');

Route::post('/rekrutmen/store', [RekrutmentController::class, 'store'])->name('rekrutmen.store');
Route::get('/rekrutmen/cetak/{No_pendaftaran}', [RekrutmentController::class, 'cetak'])->name('rekrutmen.cetak');
Route::post('/rekrutmen/cek-nim', [RekrutmentController::class, 'cekNim'])->name('rekrutmen.cekNim');



Route::get('/doras', [KegiatanController::class, 'doras'])->name('doras');
require __DIR__ . '/auth.php';
