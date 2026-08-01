# Setup Task Scheduler untuk Fitur Otomatis Rekrutmen

## 🎯 Tujuan
Agar pendaftaran rekrutmen otomatis buka/tutup sesuai jadwal yang ditentukan admin.

---

## 🖥️ Setup di Development (Windows)

### Opsi 1: Manual Test (Recommended untuk Dev)
```bash
# Test command manual
php artisan rekrutmen:check-schedule

# Cek schedule list
php artisan schedule:list
```

### Opsi 2: Run Schedule Worker (Dev Only)
```bash
# Jalankan scheduler setiap menit (blocking process)
php artisan schedule:work
```

**Note:** Opsi 2 akan block terminal, jadi pakai terminal terpisah atau background process.

---

## 🚀 Setup di Production (Linux/Hosting)

### 1. **Via Cron Job (Linux/VPS)**

Edit crontab:
```bash
crontab -e
```

Tambahkan baris ini:
```bash
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

**Contoh lengkap:**
```bash
* * * * * cd /home/ukmksr/public_html && php artisan schedule:run >> /dev/null 2>&1
```

**Penjelasan:**
- `* * * * *` = Setiap menit
- `cd /path/to/project` = Masuk ke folder project
- `php artisan schedule:run` = Jalankan Laravel scheduler
- `>> /dev/null 2>&1` = Suppress output

### 2. **Via cPanel (Shared Hosting)**

1. Login ke **cPanel**
2. Cari menu **"Cron Jobs"**
3. Pilih **"Common Settings"**: `Every Minute (* * * * *)`
4. **Command:**
   ```bash
   /usr/local/bin/php /home/username/public_html/artisan schedule:run
   ```
5. Klik **"Add New Cron Job"**

**Screenshot contoh:**
```
┌─────────────────────────────────────┐
│ Minute: *                           │
│ Hour: *                             │
│ Day: *                              │
│ Month: *                            │
│ Weekday: *                          │
│                                     │
│ Command:                            │
│ /usr/.../php artisan schedule:run   │
└─────────────────────────────────────┘
```

### 3. **Via Plesk**

1. Login **Plesk Panel**
2. Go to **"Scheduled Tasks"**
3. Click **"Add Task"**
4. **Task Type:** Run a command
5. **Command:**
   ```bash
   php /var/www/vhosts/domain.com/httpdocs/artisan schedule:run
   ```
6. **Schedule:** Every minute
7. Save

### 4. **Via Supervisor (VPS - Recommended)**

Create file `/etc/supervisor/conf.d/laravel-scheduler.conf`:

```ini
[program:laravel-scheduler]
process_name=%(program_name)s
command=/usr/bin/php /path/to/project/artisan schedule:work
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/log/laravel-scheduler.log
```

Reload supervisor:
```bash
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start laravel-scheduler
```

---

## ✅ Verifikasi

### 1. Cek Schedule Terdaftar
```bash
php artisan schedule:list
```

**Output yang benar:**
```
* * * * *  php artisan rekrutmen:check-schedule ..... Next Due: 24 seconds
```

### 2. Test Manual
```bash
php artisan rekrutmen:check-schedule
```

**Output:**
- Jika auto OFF: `Mode otomatis tidak aktif.`
- Jika auto ON: `Status rekrutmen: DIBUKA (tidak ada perubahan)`

### 3. Cek Log Laravel
```bash
tail -f storage/logs/laravel.log
```

Cari log:
```
[2026-07-31 15:30:00] local.INFO: Auto-update status rekrutmen {"status":"dibuka"}
```

### 4. Cek dari Admin Panel
1. Login admin
2. Buka menu Rekrutmen
3. Aktifkan **Mode Otomatis** ✅
4. Set tanggal buka & tutup
5. Tunggu sesuai jadwal
6. Status otomatis berubah

---

## 🔧 Troubleshooting

### Problem: Scheduler tidak jalan

**Cek cron job:**
```bash
crontab -l
```

**Cek log cron:**
```bash
grep CRON /var/log/syslog
```

**Manual test:**
```bash
php artisan schedule:run
```

### Problem: Command tidak ditemukan

**Cek path PHP:**
```bash
which php
# Output: /usr/bin/php
```

Update cron dengan path lengkap:
```bash
* * * * * /usr/bin/php /path/to/project/artisan schedule:run
```

### Problem: Permission denied

**Fix permission:**
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Problem: Tidak update otomatis

1. **Cek mode auto aktif:**
   ```bash
   php artisan tinker
   >>> App\Models\PengaturanRekrutmen::first()->is_auto
   ```

2. **Cek tanggal valid:**
   ```bash
   >>> $p = App\Models\PengaturanRekrutmen::first()
   >>> $p->tanggal_buka
   >>> $p->tanggal_tutup
   ```

3. **Manual trigger:**
   ```bash
   php artisan rekrutmen:check-schedule
   ```

---

## 📊 Monitoring

### Check Schedule Status
```bash
# List semua schedule
php artisan schedule:list

# Test run (tanpa nunggu waktu)
php artisan schedule:test
```

### Log Monitoring
```bash
# Real-time log
tail -f storage/logs/laravel.log | grep rekrutmen

# Cek history
cat storage/logs/laravel.log | grep "Auto-update"
```

---

## ⚙️ Konfigurasi Lanjutan

### Ubah Interval Check

Edit `routes/console.php`:

```php
// Setiap 5 menit (hemat resources)
Schedule::command('rekrutmen:check-schedule')
    ->everyFiveMinutes()
    ->withoutOverlapping();

// Setiap jam
Schedule::command('rekrutmen:check-schedule')
    ->hourly()
    ->withoutOverlapping();

// Custom: Setiap 10 menit
Schedule::command('rekrutmen:check-schedule')
    ->cron('*/10 * * * *')
    ->withoutOverlapping();
```

### Email Notification (Opsional)

```php
Schedule::command('rekrutmen:check-schedule')
    ->everyMinute()
    ->withoutOverlapping()
    ->emailOutputOnFailure('admin@ukmksr.com');
```

---

## 📝 Checklist Deployment

- [ ] Cron job sudah ditambahkan
- [ ] Path PHP sudah benar
- [ ] Permission folder storage/bootstrap OK
- [ ] `php artisan schedule:run` manual berjalan
- [ ] Mode auto diaktifkan di admin panel
- [ ] Tanggal buka/tutup sudah di-set
- [ ] Log monitoring berjalan
- [ ] Test dengan set tanggal dekat (5 menit)

---

## 🎯 Cara Kerja

```
┌──────────────────────────────────────────────┐
│  Cron Job (Setiap Menit)                     │
│  * * * * * php artisan schedule:run          │
└────────────────┬─────────────────────────────┘
                 │
                 ▼
┌──────────────────────────────────────────────┐
│  Laravel Scheduler                            │
│  routes/console.php                          │
└────────────────┬─────────────────────────────┘
                 │
                 ▼
┌──────────────────────────────────────────────┐
│  Command: rekrutmen:check-schedule            │
│  app/Console/Commands/CheckRekrutmenSchedule  │
└────────────────┬─────────────────────────────┘
                 │
                 ▼
┌──────────────────────────────────────────────┐
│  Model: PengaturanRekrutmen                   │
│  Method: autoCheckStatus()                   │
│  - Cek is_auto aktif?                        │
│  - Cek tanggal sekarang                      │
│  - Update status is_open                     │
└──────────────────────────────────────────────┘
```

---

**Last Update:** 31 Juli 2026  
**Version:** 1.0  
**Maintainer:** Tim UKM KSR
