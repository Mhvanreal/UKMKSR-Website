# 🤖 Fitur Otomatis Pendaftaran Rekrutmen

## Deskripsi
Fitur ini memungkinkan pendaftaran rekrutmen **otomatis dibuka dan ditutup** sesuai jadwal yang ditentukan. Admin tidak perlu manual klik tombol "Buka Pendaftaran" lagi!

---

## 🎯 Manfaat

### Untuk Admin:
✅ **Tidak perlu ingat** kapan harus buka/tutup pendaftaran  
✅ **Otomatis berjalan** sesuai jadwal  
✅ **Hemat waktu** - set sekali, jalan otomatis  
✅ **Backup manual** - tetap bisa toggle manual jika darurat

### Untuk Calon Anggota:
✅ **Tepat waktu** - pendaftaran dibuka pas jam yang dijadwalkan  
✅ **Fair** - semua daftar di waktu yang sama  
✅ **Transparan** - tahu kapan pendaftaran buka/tutup

---

## 📋 Cara Penggunaan

### 1. Login Admin
Buka: **Dashboard → Rekrutmen Anggota**

### 2. Aktifkan Mode Otomatis

![Checkbox Mode Auto](https://via.placeholder.com/600x100/3b82f6/ffffff?text=✓+Mode+Otomatis)

- ✅ **Centang** checkbox **"🤖 Mode Otomatis"**
- Status jadwal akan muncul di bawah checkbox

### 3. Set Tanggal & Waktu

```
┌─────────────────────────────────────────┐
│ Tanggal Buka:  2026-08-01  09:00       │ ← WAJIB (jika mode auto)
│ Tanggal Tutup: 2026-08-15  23:59       │ ← OPSIONAL
└─────────────────────────────────────────┘
```

**Contoh Skenario:**

| Tanggal Buka | Tanggal Tutup | Hasil |
|--------------|---------------|-------|
| 01-Aug 09:00 | 15-Aug 23:59 | Buka dari 1-15 Agustus |
| 01-Aug 09:00 | (kosong) | Buka mulai 1 Agustus, tidak tutup otomatis |
| (kosong) | 15-Aug 23:59 | Sudah buka, tutup otomatis 15 Agustus |

### 4. Klik "Simpan Pengaturan"

Dialog konfirmasi akan muncul:
```
Mode otomatis akan aktif! 
Pendaftaran akan dibuka/ditutup otomatis sesuai jadwal.

[Ya, Simpan]  [Batal]
```

### 5. Selesai! 🎉

Status akan berubah otomatis sesuai jadwal.

---

## 🔍 Monitoring Status

### Di Admin Panel

```
┌─────────────────────────────────────────┐
│ Status Pendaftaran: DIBUKA / DITUTUP    │
│                                         │
│ ✅ Mode Otomatis                        │
│ Status: Aktif sampai 15 Aug 2026 23:59 │
└─────────────────────────────────────────┘
```

**Status yang mungkin muncul:**
- ⏳ **Menunggu Pembukaan:** [tanggal]
- ✅ **Aktif sampai:** [tanggal]
- ⏱️ **Dibuka Otomatis** (tanpa batas waktu)
- ❌ **Periode Selesai**
- 📋 **Jadwal Belum Diset**

### Di Landing Page

Calon anggota akan melihat:
- **Jika Ditutup:** Pesan + info tanggal buka (jika ada)
- **Jika Dibuka:** Form pendaftaran normal

---

## ⚙️ Mode Manual vs Mode Otomatis

### Mode Manual (Default)

```
Admin klik tombol → Status berubah
```

- ✅ Kontrol penuh
- ❌ Harus ingat buka/tutup
- ❌ Bisa telat buka

### Mode Otomatis (Baru!)

```
Sistem cek jadwal → Status berubah otomatis
```

- ✅ Otomatis tepat waktu
- ✅ Tidak perlu ingat
- ✅ Tetap bisa manual override

---

## 💡 Tips & Trik

### 1. **Set Tanggal Dekat untuk Test**
```
Tanggal Buka: Hari ini + 5 menit
Tanggal Tutup: Hari ini + 10 menit
```
Tunggu 5 menit, cek apakah status berubah otomatis.

### 2. **Mode Hybrid**
- Aktifkan mode auto untuk jadwal utama
- Tetap bisa toggle manual jika ada perubahan mendadak
- Manual toggle akan override sampai jadwal berikutnya

### 3. **Notifikasi**
Cek log di `storage/logs/laravel.log`:
```
[2026-08-01 09:00:00] Auto-update status rekrutmen {"status":"dibuka"}
```

### 4. **Emergency Override**
Jika ada masalah mendesak:
1. **Matikan** mode otomatis (uncheck)
2. Toggle manual
3. Status akan tetap sampai mode auto diaktifkan lagi

---

## 🐛 Troubleshooting

### Problem: Status tidak berubah otomatis

**Solusi:**
1. ✅ Cek mode otomatis **AKTIF** (checkbox tercentang)
2. ✅ Cek tanggal buka **SUDAH DIISI**
3. ✅ Refresh halaman (Ctrl+F5)
4. ✅ Hubungi IT untuk cek scheduler

### Problem: Checkbox mode auto tidak muncul

**Solusi:**
1. Clear browser cache
2. Hard refresh (Ctrl+F5)
3. Logout → Login lagi

### Problem: Status jadwal salah

**Solusi:**
1. Cek timezone server
2. Update tanggal dengan format benar
3. Simpan ulang pengaturan

---

## ❓ FAQ

### Q: Apakah mode auto akan override tombol manual?
**A:** Tidak. Tombol manual tetap berfungsi kapan saja. Tapi jika mode auto aktif, status akan dicek ulang setiap menit.

### Q: Bisa set tanggal buka tapi tidak ada tanggal tutup?
**A:** Bisa! Pendaftaran akan dibuka otomatis dan tetap buka sampai di-tutup manual.

### Q: Kalau lupa set tanggal, apakah mode auto tetap jalan?
**A:** Jika mode auto aktif tapi tanggal buka kosong, sistem akan warning dan tidak akan auto-update.

### Q: Apakah bisa set jam spesifik?
**A:** Ya! Format `datetime-local` memungkinkan set sampai menit.  
Contoh: `2026-08-01 09:30` = 1 Agustus jam 09:30

### Q: Bagaimana cara mematikan mode auto?
**A:** Uncheck checkbox "Mode Otomatis" → Simpan. Status kembali ke mode manual.

---

## 🔐 Keamanan

- ✅ Hanya **admin** yang bisa akses pengaturan
- ✅ Validasi tanggal (tanggal tutup harus > tanggal buka)
- ✅ Konfirmasi sebelum simpan
- ✅ Log semua perubahan status
- ✅ SQL injection protected

---

## 🚀 Technical Details (untuk Developer)

### Arsitektur
```
Cron Job (setiap menit)
    ↓
Laravel Scheduler
    ↓
Command: rekrutmen:check-schedule
    ↓
Model: PengaturanRekrutmen::autoCheckStatus()
    ↓
Update is_open di database
```

### Files Modified
1. `app/Models/PengaturanRekrutmen.php` - Logic auto-check
2. `app/Console/Commands/CheckRekrutmenSchedule.php` - Command
3. `routes/console.php` - Scheduler setup
4. `resources/views/admin/Rekrutment/index.blade.php` - UI checkbox
5. Migration: `add_is_auto_to_pengaturan_rekrutmen_table`

### Testing
```bash
# Test manual
php artisan rekrutmen:check-schedule

# Cek schedule list
php artisan schedule:list

# Run scheduler (blocking)
php artisan schedule:work
```

---

## 📞 Support

Jika ada masalah atau pertanyaan:
- 📧 Email: it@ukmksr.ac.id
- 💬 WhatsApp: 08xx-xxxx-xxxx
- 📝 GitHub Issues: [link-repo]

---

**Version:** 1.0  
**Last Update:** 31 Juli 2026  
**Author:** Tim IT UKM KSR
