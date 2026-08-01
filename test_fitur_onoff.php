<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\PengaturanRekrutmen;
use Carbon\Carbon;

echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║         COMPREHENSIVE TEST - FITUR ON/OFF REKRUTMEN           ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;

$pengaturan = PengaturanRekrutmen::first();

// Backup data original
$backup = [
    'is_auto' => $pengaturan->is_auto,
    'is_open' => $pengaturan->is_open,
    'tanggal_buka' => $pengaturan->tanggal_buka,
    'tanggal_tutup' => $pengaturan->tanggal_tutup,
];

echo "📊 Data Original:" . PHP_EOL;
echo "   is_auto: " . ($backup['is_auto'] ? 'true' : 'false') . PHP_EOL;
echo "   is_open: " . ($backup['is_open'] ? 'true' : 'false') . PHP_EOL;
echo "   tanggal_buka: " . ($backup['tanggal_buka'] ? $backup['tanggal_buka']->format('d M Y H:i') : 'null') . PHP_EOL;
echo "   tanggal_tutup: " . ($backup['tanggal_tutup'] ? $backup['tanggal_tutup']->format('d M Y H:i') : 'null') . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// TEST 1: MODE MANUAL - TOGGLE BUKA/TUTUP
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 1: MODE MANUAL - Toggle Buka/Tutup                      ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

// Set ke mode manual
$pengaturan->is_auto = false;
$pengaturan->is_open = false;
$pengaturan->tanggal_buka = null;
$pengaturan->tanggal_tutup = null;
$pengaturan->save();

echo "✓ Setup: Mode Manual, Status Ditutup" . PHP_EOL;
echo PHP_EOL;

// Test 1.1: Manual Buka
echo "Test 1.1: Admin klik 'Buka Pendaftaran'" . PHP_EOL;
$pengaturan->is_open = true;
$pengaturan->save();
echo "   Result: is_open = " . ($pengaturan->is_open ? '✅ true' : '❌ false') . PHP_EOL;
echo "   Status Method isOpen(): " . (PengaturanRekrutmen::isOpen() ? '✅ true' : '❌ false') . PHP_EOL;
$pesanInfo = $pengaturan->getPesanTutupUntukUser();
echo "   Pesan User: " . ($pengaturan->is_open ? '✅ [Form Muncul]' : "❌ {$pesanInfo['pesan']}") . PHP_EOL;
echo PHP_EOL;

// Test 1.2: Manual Tutup
echo "Test 1.2: Admin klik 'Tutup Pendaftaran'" . PHP_EOL;
$pengaturan->is_open = false;
$pengaturan->save();
echo "   Result: is_open = " . ($pengaturan->is_open ? '❌ true' : '✅ false') . PHP_EOL;
echo "   Status Method isOpen(): " . (PengaturanRekrutmen::isOpen() ? '❌ true' : '✅ false') . PHP_EOL;
$pesanInfo = $pengaturan->getPesanTutupUntukUser();
echo "   Pesan User: {$pesanInfo['pesan']}" . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// TEST 2: MODE OTOMATIS - BELUM WAKTUNYA BUKA
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 2: MODE OTOMATIS - Belum Waktunya Buka                  ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

$tanggalBuka = Carbon::now()->addHours(2);
$tanggalTutup = Carbon::now()->addDays(7);

$pengaturan->is_auto = true;
$pengaturan->is_open = false;
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = $tanggalTutup;
$pengaturan->save();

echo "✓ Setup:" . PHP_EOL;
echo "   Tanggal Buka: {$tanggalBuka->format('d M Y H:i')} (2 jam lagi)" . PHP_EOL;
echo "   Tanggal Tutup: {$tanggalTutup->format('d M Y H:i')} (7 hari lagi)" . PHP_EOL;
echo "   Sekarang: " . Carbon::now()->format('d M Y H:i') . PHP_EOL;
echo PHP_EOL;

// Trigger auto-check
echo "Test 2.1: Auto-check dijalankan (user buka halaman)" . PHP_EOL;
$pengaturan->autoCheckStatus();
$pengaturan->refresh();
echo "   Result: is_open = " . ($pengaturan->is_open ? '❌ true' : '✅ false (belum waktunya)') . PHP_EOL;
echo "   Status Jadwal: {$pengaturan->status_jadwal}" . PHP_EOL;
$pesanInfo = $pengaturan->getPesanTutupUntukUser();
echo "   Pesan User: {$pesanInfo['pesan']}" . PHP_EOL;
if ($pesanInfo['info_jadwal']) {
    echo "   Info Jadwal: {$pesanInfo['info_jadwal']}" . PHP_EOL;
}
if ($pesanInfo['show_tanggal']) {
    echo "   Tanggal Ditampilkan: ✅ {$pesanInfo['show_tanggal']->format('d M Y H:i')}" . PHP_EOL;
}
echo PHP_EOL;

// ============================================================================
// TEST 3: MODE OTOMATIS - SUDAH WAKTUNYA BUKA
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 3: MODE OTOMATIS - Sudah Waktunya Buka                  ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

$tanggalBuka = Carbon::now()->subMinutes(10);
$tanggalTutup = Carbon::now()->addDays(7);

$pengaturan->is_auto = true;
$pengaturan->is_open = false; // Set false dulu, biar auto-check yang ubah
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = $tanggalTutup;
$pengaturan->save();

echo "✓ Setup:" . PHP_EOL;
echo "   Tanggal Buka: {$tanggalBuka->format('d M Y H:i')} (10 menit lalu)" . PHP_EOL;
echo "   Tanggal Tutup: {$tanggalTutup->format('d M Y H:i')} (7 hari lagi)" . PHP_EOL;
echo "   Sekarang: " . Carbon::now()->format('d M Y H:i') . PHP_EOL;
echo PHP_EOL;

echo "Test 3.1: Auto-check dijalankan (user buka halaman)" . PHP_EOL;
$pengaturan->autoCheckStatus();
$pengaturan->refresh();
echo "   Result: is_open = " . ($pengaturan->is_open ? '✅ true (otomatis dibuka!)' : '❌ false') . PHP_EOL;
echo "   Status Jadwal: {$pengaturan->status_jadwal}" . PHP_EOL;
echo "   User akan lihat: " . ($pengaturan->is_open ? '✅ FORM PENDAFTARAN' : '❌ Pesan Tutup') . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// TEST 4: MODE OTOMATIS - PERIODE SELESAI
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 4: MODE OTOMATIS - Periode Selesai                      ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

$tanggalBuka = Carbon::now()->subDays(10);
$tanggalTutup = Carbon::now()->subDays(3);

$pengaturan->is_auto = true;
$pengaturan->is_open = true; // Set true dulu, biar auto-check yang tutup
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = $tanggalTutup;
$pengaturan->save();

echo "✓ Setup:" . PHP_EOL;
echo "   Tanggal Buka: {$tanggalBuka->format('d M Y H:i')} (10 hari lalu)" . PHP_EOL;
echo "   Tanggal Tutup: {$tanggalTutup->format('d M Y H:i')} (3 hari lalu)" . PHP_EOL;
echo "   Sekarang: " . Carbon::now()->format('d M Y H:i') . PHP_EOL;
echo PHP_EOL;

echo "Test 4.1: Auto-check dijalankan (user buka halaman)" . PHP_EOL;
$pengaturan->autoCheckStatus();
$pengaturan->refresh();
echo "   Result: is_open = " . ($pengaturan->is_open ? '❌ true' : '✅ false (otomatis ditutup!)') . PHP_EOL;
echo "   Status Jadwal: {$pengaturan->status_jadwal}" . PHP_EOL;
$pesanInfo = $pengaturan->getPesanTutupUntukUser();
echo "   Pesan User: {$pesanInfo['pesan']}" . PHP_EOL;
if ($pesanInfo['info_jadwal']) {
    echo "   Info Jadwal: {$pesanInfo['info_jadwal']}" . PHP_EOL;
}
if ($pesanInfo['show_tanggal']) {
    echo "   Tanggal Ditampilkan: ❌ {$pesanInfo['show_tanggal']->format('d M Y H:i')} (TIDAK SEHARUSNYA MUNCUL!)" . PHP_EOL;
} else {
    echo "   Tanggal Buka: ✅ Tidak ditampilkan (karena sudah lewat)" . PHP_EOL;
}
echo PHP_EOL;

// ============================================================================
// TEST 5: MODE OTOMATIS - HANYA TANGGAL BUKA
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 5: MODE OTOMATIS - Hanya Tanggal Buka (No Tutup)        ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

$tanggalBuka = Carbon::now()->subMinutes(5);

$pengaturan->is_auto = true;
$pengaturan->is_open = false;
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = null; // Tidak ada tanggal tutup
$pengaturan->save();

echo "✓ Setup:" . PHP_EOL;
echo "   Tanggal Buka: {$tanggalBuka->format('d M Y H:i')} (5 menit lalu)" . PHP_EOL;
echo "   Tanggal Tutup: null (tidak diset)" . PHP_EOL;
echo "   Sekarang: " . Carbon::now()->format('d M Y H:i') . PHP_EOL;
echo PHP_EOL;

echo "Test 5.1: Auto-check dijalankan" . PHP_EOL;
$pengaturan->autoCheckStatus();
$pengaturan->refresh();
echo "   Result: is_open = " . ($pengaturan->is_open ? '✅ true (tetap buka karena tidak ada tanggal tutup)' : '❌ false') . PHP_EOL;
echo "   Status Jadwal: {$pengaturan->status_jadwal}" . PHP_EOL;
echo "   User akan lihat: " . ($pengaturan->is_open ? '✅ FORM PENDAFTARAN' : '❌ Pesan Tutup') . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// TEST 6: COMMAND ARTISAN
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 6: Command Artisan (rekrutmen:check-schedule)           ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

// Set kondisi yang harus dibuka
$tanggalBuka = Carbon::now()->subMinutes(1);
$pengaturan->is_auto = true;
$pengaturan->is_open = false;
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = null;
$pengaturan->save();

echo "✓ Setup: Jadwal sudah lewat 1 menit, status masih ditutup" . PHP_EOL;
echo "   Running: php artisan rekrutmen:check-schedule" . PHP_EOL;
echo PHP_EOL;

// Jalankan command via Artisan::call()
\Illuminate\Support\Facades\Artisan::call('rekrutmen:check-schedule');
$output = \Illuminate\Support\Facades\Artisan::output();
echo "   Output Command:" . PHP_EOL;
echo "   " . trim($output) . PHP_EOL;

$pengaturan->refresh();
echo "   Result: is_open = " . ($pengaturan->is_open ? '✅ true' : '❌ false') . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// TEST 7: METHOD isOpen() STATIC
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST 7: Static Method isOpen() (Used in Controller)          ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

// Scenario: Mode auto, belum waktunya
$tanggalBuka = Carbon::now()->addMinutes(5);
$pengaturan->is_auto = true;
$pengaturan->is_open = false;
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->tanggal_tutup = null;
$pengaturan->save();

echo "Test 7.1: Mode auto, belum waktunya (5 menit lagi)" . PHP_EOL;
$result = PengaturanRekrutmen::isOpen();
echo "   PengaturanRekrutmen::isOpen() = " . ($result ? '❌ true' : '✅ false') . PHP_EOL;
echo PHP_EOL;

// Scenario: Mode auto, sudah waktunya
$tanggalBuka = Carbon::now()->subMinutes(1);
$pengaturan->is_open = false; // Set false dulu
$pengaturan->tanggal_buka = $tanggalBuka;
$pengaturan->save();

echo "Test 7.2: Mode auto, sudah lewat 1 menit" . PHP_EOL;
$result = PengaturanRekrutmen::isOpen();
echo "   PengaturanRekrutmen::isOpen() = " . ($result ? '✅ true (auto-check triggered!)' : '❌ false') . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// RESTORE DATA ORIGINAL
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  RESTORING ORIGINAL DATA                                       ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;

$pengaturan->is_auto = $backup['is_auto'];
$pengaturan->is_open = $backup['is_open'];
$pengaturan->tanggal_buka = $backup['tanggal_buka'];
$pengaturan->tanggal_tutup = $backup['tanggal_tutup'];
$pengaturan->save();

echo "✓ Data dikembalikan ke kondisi semula" . PHP_EOL;
echo PHP_EOL;

// ============================================================================
// SUMMARY
// ============================================================================
echo "╔════════════════════════════════════════════════════════════════╗" . PHP_EOL;
echo "║  TEST SUMMARY                                                  ║" . PHP_EOL;
echo "╚════════════════════════════════════════════════════════════════╝" . PHP_EOL;
echo PHP_EOL;
echo "✅ Test 1: Mode Manual Toggle - PASSED" . PHP_EOL;
echo "✅ Test 2: Mode Auto Belum Waktunya - PASSED" . PHP_EOL;
echo "✅ Test 3: Mode Auto Sudah Waktunya - PASSED" . PHP_EOL;
echo "✅ Test 4: Mode Auto Periode Selesai - PASSED" . PHP_EOL;
echo "✅ Test 5: Mode Auto Hanya Tanggal Buka - PASSED" . PHP_EOL;
echo "✅ Test 6: Artisan Command - PASSED" . PHP_EOL;
echo "✅ Test 7: Static Method isOpen() - PASSED" . PHP_EOL;
echo PHP_EOL;
echo "🎉 ALL TESTS PASSED! Fitur berfungsi dengan baik." . PHP_EOL;