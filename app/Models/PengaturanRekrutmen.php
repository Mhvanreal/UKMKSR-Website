<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PengaturanRekrutmen extends Model
{
    protected $table = 'pengaturan_rekrutmen';

    protected $fillable = [
        'is_open',
        'is_auto',
        'pesan_tutup',
        'tanggal_buka',
        'tanggal_tutup',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'is_auto' => 'boolean',
        'tanggal_buka' => 'datetime',
        'tanggal_tutup' => 'datetime',
    ];

    /**
     * Get pengaturan rekrutmen (singleton pattern)
     * Selalu ambil data fresh dari database tanpa cache
     */
    public static function getPengaturan()
    {
        // Gunakan fresh() untuk bypass cache dan ambil data terbaru
        $pengaturan = self::first() ?? self::create([
            'is_open' => false,
            'is_auto' => false,
            'pesan_tutup' => 'Pendaftaran anggota baru sedang ditutup. Silakan tunggu informasi selanjutnya.',
        ]);
        
        // Jika mode auto aktif, langsung cek jadwal
        if ($pengaturan->is_auto) {
            $pengaturan->autoCheckStatus();
            $pengaturan->refresh(); // Reload data terbaru
        }
        
        return $pengaturan;
    }

    /**
     * Cek apakah rekrutmen sedang dibuka
     * Auto-check jika mode otomatis aktif
     */
    public static function isOpen()
    {
        $pengaturan = self::getPengaturan();
        
        // Jika mode otomatis aktif, cek jadwal
        if ($pengaturan->is_auto) {
            $pengaturan->autoCheckStatus();
            $pengaturan->refresh(); // Reload data dari database
        }
        
        return $pengaturan->is_open;
    }

    /**
     * Auto check dan update status berdasarkan jadwal
     */
    public function autoCheckStatus()
    {
        if (!$this->is_auto) {
            return;
        }

        $now = Carbon::now();
        $shouldBeOpen = false;

        // Cek apakah ada tanggal buka dan tutup
        if ($this->tanggal_buka && $this->tanggal_tutup) {
            // Jika sekarang antara tanggal buka dan tutup
            $shouldBeOpen = $now->between($this->tanggal_buka, $this->tanggal_tutup);
        } 
        // Jika hanya ada tanggal buka
        elseif ($this->tanggal_buka && !$this->tanggal_tutup) {
            // Buka jika sudah melewati tanggal buka
            $shouldBeOpen = $now->gte($this->tanggal_buka);
        }
        // Jika hanya ada tanggal tutup
        elseif (!$this->tanggal_buka && $this->tanggal_tutup) {
            // Buka sampai tanggal tutup
            $shouldBeOpen = $now->lte($this->tanggal_tutup);
        }

        // Update status jika berubah
        if ($this->is_open !== $shouldBeOpen) {
            $this->is_open = $shouldBeOpen;
            $this->save();
            
            \Log::info('Auto-update status rekrutmen', [
                'status' => $shouldBeOpen ? 'dibuka' : 'ditutup',
                'waktu' => $now->format('Y-m-d H:i:s')
            ]);
        }
    }

    /**
     * Cek status jadwal untuk info
     */
    public function getStatusJadwalAttribute()
    {
        if (!$this->is_auto) {
            return 'Mode Manual';
        }

        $now = Carbon::now();

        if ($this->tanggal_buka && $this->tanggal_tutup) {
            if ($now->lt($this->tanggal_buka)) {
                return 'Menunggu Pembukaan: ' . $this->tanggal_buka->format('d M Y H:i');
            } elseif ($now->between($this->tanggal_buka, $this->tanggal_tutup)) {
                return 'Aktif sampai: ' . $this->tanggal_tutup->format('d M Y H:i');
            } else {
                return 'Periode Selesai';
            }
        } elseif ($this->tanggal_buka) {
            return $now->gte($this->tanggal_buka) ? 'Dibuka Otomatis' : 'Menunggu: ' . $this->tanggal_buka->format('d M Y H:i');
        } elseif ($this->tanggal_tutup) {
            return $now->lte($this->tanggal_tutup) ? 'Aktif sampai: ' . $this->tanggal_tutup->format('d M Y H:i') : 'Periode Selesai';
        }

        return 'Jadwal Belum Diset';
    }

    /**
     * Get pesan dan info untuk user di halaman publik saat pendaftaran ditutup
     * Return array dengan 'pesan', 'info_jadwal', dan 'show_tanggal'
     */
    public function getPesanTutupUntukUser()
    {
        $now = Carbon::now();
        $result = [
            'pesan' => $this->pesan_tutup ?? 'Pendaftaran anggota baru sedang ditutup. Silakan tunggu informasi selanjutnya.',
            'info_jadwal' => null,
            'show_tanggal' => false,
        ];

        // Jika mode manual atau tidak ada jadwal, tampilkan pesan default saja
        if (!$this->is_auto) {
            return $result;
        }

        // Mode otomatis - tentukan pesan berdasarkan kondisi jadwal
        if ($this->tanggal_buka && $this->tanggal_tutup) {
            // Ada jadwal buka dan tutup
            if ($now->lt($this->tanggal_buka)) {
                // Belum dibuka - tampilkan kapan akan dibuka
                $result['info_jadwal'] = 'Pendaftaran akan dibuka pada:';
                $result['show_tanggal'] = $this->tanggal_buka;
            } elseif ($now->gt($this->tanggal_tutup)) {
                // Periode sudah selesai
                $result['pesan'] = 'Periode pendaftaran telah berakhir.';
                $result['info_jadwal'] = 'Pendaftaran terakhir ditutup pada ' . $this->tanggal_tutup->format('d M Y H:i') . '. Silakan tunggu informasi periode berikutnya.';
            }
        } elseif ($this->tanggal_buka && !$this->tanggal_tutup) {
            // Hanya ada tanggal buka
            if ($now->lt($this->tanggal_buka)) {
                // Belum dibuka - tampilkan kapan akan dibuka
                $result['info_jadwal'] = 'Pendaftaran akan dibuka pada:';
                $result['show_tanggal'] = $this->tanggal_buka;
            } else {
                // Sudah lewat tanggal buka tapi ditutup manual
                $result['pesan'] = 'Pendaftaran sementara ditutup oleh admin.';
                $result['info_jadwal'] = 'Silakan tunggu informasi selanjutnya.';
            }
        } elseif (!$this->tanggal_buka && $this->tanggal_tutup) {
            // Hanya ada tanggal tutup (jarang)
            if ($now->gt($this->tanggal_tutup)) {
                // Periode sudah selesai
                $result['pesan'] = 'Periode pendaftaran telah berakhir.';
                $result['info_jadwal'] = 'Pendaftaran ditutup pada ' . $this->tanggal_tutup->format('d M Y H:i') . '.';
            }
        }

        return $result;
    }
}
