<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengaturanRekrutmen;

class CheckRekrutmenSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rekrutmen:check-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check dan update status rekrutmen berdasarkan jadwal otomatis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memeriksa jadwal rekrutmen...');
        
        $pengaturan = PengaturanRekrutmen::getPengaturan();
        
        if (!$pengaturan->is_auto) {
            $this->warn('Mode otomatis tidak aktif.');
            return 0;
        }

        $statusBefore = $pengaturan->is_open;
        
        // Auto check dan update status
        $pengaturan->autoCheckStatus();
        $pengaturan->refresh();
        
        $statusAfter = $pengaturan->is_open;

        if ($statusBefore !== $statusAfter) {
            $status = $statusAfter ? 'DIBUKA' : 'DITUTUP';
            $this->info("✅ Status rekrutmen berubah menjadi: {$status}");
            
            // Log perubahan
            \Log::info("Rekrutmen auto-update: {$status}", [
                'tanggal_buka' => $pengaturan->tanggal_buka?->format('Y-m-d H:i:s'),
                'tanggal_tutup' => $pengaturan->tanggal_tutup?->format('Y-m-d H:i:s'),
            ]);
        } else {
            $status = $statusAfter ? 'DIBUKA' : 'DITUTUP';
            $this->line("Status rekrutmen: {$status} (tidak ada perubahan)");
        }

        $this->info("Status Jadwal: {$pengaturan->status_jadwal}");
        
        return 0;
    }
}
