# Dokumentasi Fitur Rekrutmen

## 📋 Fitur yang Tersedia

### 1. **On/Off Pendaftaran**
Admin dapat mengaktifkan/menonaktifkan pendaftaran rekrutmen.

**Cara Kerja:**
- Admin klik tombol "Buka Pendaftaran" / "Tutup Pendaftaran"
- Konfirmasi SweetAlert muncul
- Status berubah di database
- User tidak bisa mendaftar saat ditutup

### 2. **Verifikasi Pendaftar**

#### Status Pendaftar:
- 🟡 **Belum Diverifikasi** (default saat daftar)
- 🟢 **Diterima** (sudah jadi anggota)
- 🔴 **Ditolak** (tidak diterima)

#### Tombol Aksi (berdasarkan status):

| Status | Tombol Tersedia |
|--------|-----------------|
| Belum Diverifikasi | **Detail** + **Terima** + **Tolak** |
| Diterima | **Detail** + **Hapus** |
| Ditolak | **Detail** + **Hapus** |

### 3. **Tombol Terima**
- **Warna:** Hijau 🟢
- **Fungsi:** Menerima pendaftar sebagai anggota baru
- **Proses:**
  1. Konfirmasi SweetAlert
  2. Data dipindahkan ke tabel `anggota`
  3. Status berubah jadi "Diterima"
  4. Tombol berubah jadi "Hapus"

### 4. **Tombol Tolak**
- **Warna:** Orange 🟠
- **Fungsi:** Menolak pendaftar
- **Proses:**
  1. Konfirmasi SweetAlert
  2. Status berubah jadi "Ditolak"
  3. Data tetap di tabel `rekrutmen`
  4. Tombol berubah jadi "Hapus"

### 5. **Tombol Hapus**
- **Warna:** Merah 🔴
- **Fungsi:** Menghapus data pendaftaran
- **Muncul saat:** Status "Diterima" atau "Ditolak"
- **Proses:**
  1. Konfirmasi SweetAlert dengan warning
  2. Data dihapus permanent dari database
  3. **Tidak bisa di-undo!**

### 6. **Pengaturan Pesan**
Admin bisa set:
- Pesan custom saat pendaftaran ditutup
- Tanggal buka pendaftaran (opsional)
- Tanggal tutup pendaftaran (opsional)

---

## 🔒 Keamanan

### SQL Injection Protection
```php
// Validasi ID
if (!is_numeric($id)) {
    abort(404);
}

// Validasi NIM
'nim' => 'required|numeric|digits_between:1,20'

// Validasi No Pendaftaran
if (!preg_match('/^[0-9]+$/', $No_pendaftaran)) {
    abort(404);
}
```

### CSRF Protection
Semua form POST sudah dilindungi dengan `@csrf`

### Authorization
Route dilindungi middleware `humas_ksr`

---

## 🎨 UI/UX

### Status Badge
```php
// Diterima
<span class="bg-green-100 text-green-700">Diterima</span>

// Ditolak  
<span class="bg-red-100 text-red-700">Ditolak</span>

// Belum Diverifikasi
<span class="bg-yellow-100 text-yellow-700">Belum Diverifikasi</span>
```

### Konfirmasi SweetAlert

#### Terima Pendaftar
```javascript
Swal.fire({
    title: 'Terima Pendaftar',
    text: 'Apakah Anda yakin ingin menerima pendaftar ini?',
    icon: 'question',
    confirmButtonColor: '#10b981', // Hijau
})
```

#### Tolak Pendaftar
```javascript
Swal.fire({
    title: 'Tolak Pendaftar',
    text: 'Apakah Anda yakin ingin menolak pendaftar ini?',
    icon: 'warning',
    confirmButtonColor: '#f97316', // Orange
})
```

#### Hapus Data
```javascript
Swal.fire({
    title: 'Hapus Data?',
    html: 'Tindakan ini tidak dapat dibatalkan!',
    icon: 'error',
    confirmButtonColor: '#dc2626', // Merah
})
```

---

## 📊 Flow Diagram

```
┌──────────────────────────────────────────────────────────┐
│                   PENDAFTAR BARU                         │
│              (Status: Belum Diverifikasi)                │
└────────────┬────────────────────────┬────────────────────┘
             │                        │
        [TERIMA]                  [TOLAK]
             │                        │
             ▼                        ▼
┌────────────────────────┐  ┌────────────────────────┐
│   Status: Diterima     │  │   Status: Ditolak      │
│   + Jadi Anggota       │  │   + Tidak jadi anggota │
└────────┬───────────────┘  └────────┬───────────────┘
         │                           │
         │     [HAPUS DATA]          │
         └────────────┬──────────────┘
                      │
                      ▼
          ┌───────────────────────┐
          │   Data Dihapus dari   │
          │   Database            │
          └───────────────────────┘
```

---

## 🧪 Testing

### Test Manual

1. **Test Toggle Pendaftaran:**
   ```
   - Login sebagai admin
   - Klik "Tutup Pendaftaran"
   - Konfirmasi muncul
   - Cek di landing page → form hilang
   ```

2. **Test Terima Pendaftar:**
   ```
   - Pilih pendaftar dengan status "Belum Diverifikasi"
   - Klik "Terima"
   - Konfirmasi
   - Cek tabel anggota → data masuk
   - Cek status → berubah "Diterima"
   ```

3. **Test Tolak Pendaftar:**
   ```
   - Pilih pendaftar dengan status "Belum Diverifikasi"
   - Klik "Tolak"
   - Konfirmasi
   - Cek status → berubah "Ditolak"
   - Data masih ada di rekrutmen
   ```

4. **Test Hapus Data:**
   ```
   - Pilih pendaftar dengan status "Diterima" atau "Ditolak"
   - Klik "Hapus"
   - Konfirmasi dengan warning
   - Data hilang dari database
   ```

5. **Test SQL Injection:**
   ```
   URL: /Rekrutment-anggota/1' OR 1=1--
   Hasil: 404 Not Found ✅
   
   NIM: 123' OR '1'='1
   Hasil: Validation Error ✅
   ```

---

## 📝 Catatan Penting

### ⚠️ Warning
1. **Hapus data permanent!** Tidak bisa di-restore
2. **Backup database** sebelum hapus data massal
3. **Cek ulang** sebelum terima/tolak pendaftar

### 💡 Tips
1. Gunakan filter/search untuk data banyak
2. Export data sebelum hapus (fitur tambahan)
3. Set tanggal buka/tutup untuk otomasi

### 🔮 Fitur yang Bisa Ditambah
- [ ] Filter berdasarkan status
- [ ] Export to Excel/PDF
- [ ] Soft delete (trash bin)
- [ ] Bulk actions (terima/tolak/hapus banyak)
- [ ] Notifikasi email ke pendaftar
- [ ] Log activity admin
- [ ] Auto-close berdasarkan tanggal

---

## 🚀 Deployment Checklist

- [x] Migration dijalankan
- [x] Route terdaftar
- [x] Controller siap
- [x] View UI/UX bagus
- [x] Keamanan SQL injection
- [x] CSRF protection
- [x] Konfirmasi SweetAlert
- [x] Status badge warna
- [x] Testing lokal
- [ ] Testing production
- [ ] Backup database

---

**Update:** 31 Juli 2026
**Version:** 2.0
**Developer:** AI Assistant + Tim UKM KSR
