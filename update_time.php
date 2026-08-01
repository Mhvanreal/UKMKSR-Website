<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Current time: " . now()->format('Y-m-d H:i:s') . " (" . config('app.timezone') . ")" . PHP_EOL;

$p = \App\Models\PengaturanRekrutmen::first();
echo "Before - tanggal_buka: " . ($p->tanggal_buka ?? 'null') . PHP_EOL;

// Set tanggal buka ke 5 menit lalu (sudah lewat)
$p->tanggal_buka = now()->subMinutes(5);
$p->save();

echo "After - tanggal_buka: " . $p->tanggal_buka . PHP_EOL;
echo PHP_EOL;
echo "Now running auto-check..." . PHP_EOL;

// Trigger auto-check
$p->autoCheckStatus();
echo "Status after auto-check: " . ($p->is_open ? 'DIBUKA' : 'DITUTUP') . PHP_EOL;