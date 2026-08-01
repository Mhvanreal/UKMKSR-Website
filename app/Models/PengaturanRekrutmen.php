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
     */
    public static function getPengaturan()
    {
        return self::first() ?? self::create([
            'is_open' => false,
            'is_auto' => false,
            'pesan_tutup' => 'Pendaftaran anggota baru sedang ditutup. Silakan tunggu informasi selanjutnya.',
        ]);
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
}
