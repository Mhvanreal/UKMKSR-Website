<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Divisi;
use App\Models\Jabatan;
use App\Models\PengurusProgramKerja;
use App\Models\PeriodeKepengurusan;
use App\Models\Pengurus;
use App\Models\ProgramKerja;
use App\Models\Anggota;

class kepengurasanSeeder extends Seeder
{

    public function run(): void
    {
        // 1. Buat divisi
        $sdm = Divisi::create([
            'nama_divisi' => 'SDM',
            'deskripsi' => 'Divisi Sumber Daya Manusia'
        ]);

        $humas = Divisi::create([
            'nama_divisi' => 'HUMAS',
            'deskripsi' => 'Hubungan Masyarakat'
        ]);

        $Danus = Divisi::create([
            'nama_divisi' => 'DANUS',
            'deskripsi' => 'Dana dan Usaha'
        ]);

        $BPH = Divisi::create([
            'nama_divisi' => 'BPH',
            'deskripsi' => 'Badan Pengurus Harian.'
        ]);

        $logistik = Divisi::create([
            'nama_divisi' => 'logistik',
            'deskripsi' => 'Logistik'
        ]);

        $PKMB = Divisi::create([
            'nama_divisi' => 'PKMB',
            'deskripsi' => 'Pusat Kegiatan Belajar Masyarakat'
        ]);

        // 2. Buat jabatan yang berada di divisi SDM

        /////sdm/////
        $jabatan = Jabatan::create([
            'nama_jabatan' => 'Kearsipan',
            'divisi_id' => $sdm->id
        ]);

        $KoordinatorSDM = Jabatan::create([
            'nama_jabatan' => 'Koordinator Bidang SDM',
            'divisi_id' => $sdm->id
        ]);

        $PPKSDM = Jabatan::create([
            'nama_jabatan' => 'Pembinaan dan Pengembangan Kapasitas',
            'divisi_id' => $sdm->id
        ]);

        $PenelitianSDM = Jabatan::create([
            'nama_jabatan' => 'Penelitian dan Evaluasi',
            'divisi_id' => $sdm->id
        ]);

        $ImplementasiSDM = Jabatan::create([
            'nama_jabatan' => 'Implementasi dan Kompetisi',
            'divisi_id' => $sdm->id
        ]);

        //////bph/////
        $KetuaBPH = Jabatan::create([
            'nama_jabatan' => 'Ketua Umum',
            'divisi_id' => $BPH->id
        ]);

        $wakilBPH = Jabatan::create([
            'nama_jabatan' => 'Wakil Ketua',
            'divisi_id' => $BPH->id
        ]);

        $bendahara1BPH = Jabatan::create([
            'nama_jabatan' => 'Bendahara umun 1',
            'divisi_id' => $BPH->id
        ]);

        $bendahara2BPH = Jabatan::create([
            'nama_jabatan' => 'Bendahara umun 2',
            'divisi_id' => $BPH->id
        ]);

        $sekretaris1BPH = Jabatan::create([
            'nama_jabatan' => 'Sekretaris 1',
            'divisi_id' => $BPH->id
        ]);

        $sekretaris2BPH = Jabatan::create([
            'nama_jabatan' => 'Sekretaris 2',
            'divisi_id' => $BPH->id
        ]);

        //////// Humas ////////

        $KoordinatorHumas = Jabatan::create([
            'nama_jabatan' => 'Koordinator Bidang Humas',
            'divisi_id' => $humas->id
        ]);

        $internalHumas = Jabatan::create([
            'nama_jabatan' => 'Humas Internal',
            'divisi_id' => $humas->id
        ]);

        $EkternalHumas = Jabatan::create([
            'nama_jabatan' => 'Humas Eksternal',
            'divisi_id' => $humas->id
        ]);

        $DKVHumas = Jabatan::create([
            'nama_jabatan' => 'DKV',
            'divisi_id' => $humas->id
        ]);

        ////////Logistik///////
        $KoordinatorLogistik = Jabatan::create([
            'nama_jabatan' => 'Koordinator Bidang Logistik',
            'divisi_id' => $logistik->id
        ]);

        $peralatanLogistik = Jabatan::create([
            'nama_jabatan' => 'peralatan dan Perlengkapan',
            'divisi_id' => $logistik->id
        ]);

        $obatLogistik = Jabatan::create([
            'nama_jabatan' => 'Obat-Obatan',
            'divisi_id' => $logistik->id
        ]);

        $KeamananLogistik = Jabatan::create([
            'nama_jabatan' => 'Keamanan dan Kebersihan',
            'divisi_id' => $logistik->id
        ]);

        //////Danus////////
        $Codanus = Jabatan::create([
            'nama_jabatan' => 'Koornidator bidang Dana Usaha',
            'divisi_id' => $Danus->id
        ]);

        $Kewirausahaandanus = Jabatan::create([
            'nama_jabatan' => 'Kewirausahaan',
            'divisi_id' => $Danus->id
        ]);

        ///////// PKBM ////////

        $CoPKBM = Jabatan::create([
            'nama_jabatan' => 'Koordinator Bidang PKBM',
            'divisi_id' => $PKMB->id
        ]);

        $BinmasPKBM = Jabatan::create([
            'nama_jabatan' => 'Binmas',
            'divisi_id' => $PKMB->id
        ]);

        $dorasPKBM = Jabatan::create([
            'nama_jabatan' => 'Doras',
            'divisi_id' => $PKMB->id
        ]);

        // 3. Buat periode kepengurusan
        $periode = PeriodeKepengurusan::create([
            'nama_periode' => 'Periode 2023',
            'tahun_mulai' => 2023,
            'tahun_selesai' => 2024,
        ]);

        $periode2024 = PeriodeKepengurusan::create([
            'nama_periode' => 'Periode 2024',
            'tahun_mulai' => 2024,
            'tahun_selesai' => 2025,
        ]);

        $periode2022 = PeriodeKepengurusan::create([
            'nama_periode' => 'Periode 2022',
            'tahun_mulai' => 2022,
            'tahun_selesai' => 2023,
        ]);

        // 4. Dummy anggota
        $anggota = Anggota::create([
            'nim' => 'E41221544',
            'nama' => 'Muhammad Khilmi',
            'email' => 'skuy@gmail.com',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2003-11-29',
            'Nama_panggilan'=> 'hilmy',
            'Agama' => 'Kristen',
            'alamat' => 'Jember',
            'alasan_join' => 'Nyari temen',
            'email'=> 'huhu@gmail.com',
            'angkatan' => '14',
            'foto' => 'foto-anggota/hilmi.jpg',
            'jurusan' => 'Teknologi Informasi',
            'No_tlpn' => '08123912700',
            'prodi' => 'Teknik Informatika',
            'Gol_darah' => 'O',
            'status' => 'aktif',
            'organisasi_yg_pernah_diikuti' => 'PMR',
            'tahun_masuk_kuliah' => '2022',
            'jenis_kelamin' => 'laki-laki',
        ]);

        // 5. Buat pengurus
        $pengurus = Pengurus::create([
            'anggota_id' => $anggota->id,
            'periode_id' => $periode->id,
            'jabatan_id' => $jabatan->id
        ]);

        $programs = [
            'Pengarsipan Digital',
            'Pendidikan Karakter',
            'Pengelolaan Database',
            'Pelatihan Soft Skill'
        ];

        foreach ($programs as $prog) {
            ProgramKerja::create([
                'nama_program' => $prog,
                'deskripsi' => 'Deskripsi untuk ' . $prog,
                'pengurus_id' => $pengurus->id
            ]);
        }

    }
}
