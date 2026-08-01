# Keamanan Fitur Rekrutmen

## Proteksi SQL Injection

### 1. Validasi Parameter ID
Semua method yang menerima `$id` dari URL sudah divalidasi:

```php
// Before: Vulnerable
$rekrutmen = Rekrutmen::findOrFail($id);

// After: Protected
if (!is_numeric($id)) {
    abort(404);
}
$rekrutmen = Rekrutmen::findOrFail($id);
```

**Method yang sudah diproteksi:**
- `show($id)` - Menampilkan detail pendaftar
- `terima($id)` - Menerima pendaftar
- `destroy($id)` - Hapus pendaftar

### 2. Validasi NIM
Input NIM sudah divalidasi dengan Laravel Validation:

```php
// Before: Vulnerable
$data = Rekrutmen::where('nim', $request->nim)->first();

// After: Protected
$validated = $request->validate([
    'nim' => 'required|numeric|digits_between:1,20'
]);
$data = Rekrutmen::where('nim', $validated['nim'])->first();
```

### 3. Validasi Nomor Pendaftaran
Nomor pendaftaran di-sanitasi dan divalidasi format:

```php
// Sanitasi input
$No_pendaftaran = filter_var($No_pendaftaran, FILTER_SANITIZE_STRING);

// Validasi format (hanya angka)
if (!preg_match('/^[0-9]+$/', $No_pendaftaran)) {
    abort(404);
}
```

### 4. Laravel Eloquent ORM
Laravel menggunakan **PDO Prepared Statements** secara otomatis:

```php
// Ini AMAN karena Laravel otomatis prepare statement
Rekrutmen::where('nim', $nim)->first();
Rekrutmen::findOrFail($id);
```

**HINDARI query raw tanpa binding:**
```php
// ❌ JANGAN LAKUKAN INI
DB::select("SELECT * FROM rekrutmen WHERE nim = '$nim'");

// ✅ LAKUKAN INI
DB::select("SELECT * FROM rekrutmen WHERE nim = ?", [$nim]);
// Atau gunakan Eloquent
Rekrutmen::where('nim', $nim)->get();
```

## CSRF Protection

Semua form sudah dilindungi dengan CSRF token:

```blade
<form method="POST">
    @csrf
    <!-- form fields -->
</form>
```

## Mass Assignment Protection

Model sudah menggunakan `$fillable`:

```php
protected $fillable = [
    'nim', 'Nama', 'email', // dst
];
```

## File Upload Security

Upload foto sudah divalidasi:

```php
'foto' => 'nullable|mimes:jpg,jpeg,png|max:10240'
```

**Rekomendasi tambahan:**
- Ganti nama file saat upload
- Simpan di storage, bukan public folder
- Scan virus untuk file upload

## XSS Protection

Laravel Blade otomatis escape output:

```blade
{{ $item->Nama }}  <!-- Aman, otomatis escaped -->
{!! $item->Nama !!} <!-- Berbahaya, raw HTML -->
```

## Checklist Keamanan

- [x] SQL Injection - Protected (Eloquent + Validation)
- [x] CSRF - Protected (Laravel CSRF)
- [x] XSS - Protected (Blade Auto-escape)
- [x] Mass Assignment - Protected ($fillable)
- [x] File Upload - Validated (mimes, max size)
- [x] Authorization - Protected (Middleware humas_ksr)
- [x] Input Validation - Protected (Laravel Validation)
- [ ] Rate Limiting - Belum (Tambahkan jika diperlukan)
- [ ] 2FA Admin - Belum (Opsional)

## Update Log

- **2026-07-31**: Tambah validasi ID dan NIM untuk mencegah SQL injection
- **2026-07-31**: Tambah konfirmasi SweetAlert untuk aksi kritis
