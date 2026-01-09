# CRUD Set Tahun Takwim - Portal HGK Hub

## Deskripsi
Modul CRUD untuk mengelola data tahun takwim (periode file) dalam sistem Portal HGK Hub. Modul ini memungkinkan user untuk Create, Read, Update, dan Delete data tahun dengan status (active, locked, revise).

## Struktur File

### 1. Model
- **File**: `app/Models/PYearFiles.php`
- **Table**: `p_year_files`
- **Fields**:
  - `id` - Primary key
  - `year` - Tahun (unique)
  - `status` - Status (enum: active, locked, revise)
  - `locked_at` - Tanggal lock (nullable)
  - `created_by` - Foreign key ke users table
  - `created_at` - Timestamp
  - `updated_at` - Timestamp

### 2. Migration
- **File**: `database/migrations/2026_01_05_091436_create_p_year_files_table.php`
- **Tabel**: `p_year_files`

### 3. Livewire Component
- **File**: `app/Livewire/Home/SetYear.php`
- **Properties**:
  - Form properties: `yearId`, `year`, `status`, `locked_at`
  - UI state: `openCreate`, `openEdit`, `openDelete`
  - Search & Filter: `search`, `statusFilter`

### 4. Blade View
- **File**: `resources/views/livewire/home/set-year.blade.php`
- **Features**:
  - Responsive design (desktop & mobile)
  - Search & filter functionality
  - Modal untuk Create, Edit, Delete
  - Real-time alerts menggunakan Livewire events

### 5. Routes
- **File**: `routes/web.php`
- **Route**: `Route::get('/', SetYear::class)->name('home.set-year');`

### 6. Seeder
- **File**: `database/seeders/PYearFilesSeeder.php`
- **Purpose**: Seed data demo untuk testing

## Fitur CRUD

### Create (Tambah Data)
1. Klik tombol `+` di toolbar
2. Modal akan terbuka
3. Isi form:
   - **Tahun Takwim** (required, integer, 1900-2100, unique)
   - **Status** (required, pilihan: active/locked/revise)
4. Klik "Simpan"
5. Data akan tersimpan ke database
6. Alert sukses akan muncul
7. Modal akan tertutup otomatis

**Validasi**:
- Tahun harus diisi
- Tahun harus berupa angka
- Tahun minimal 1900, maksimal 2100
- Tahun harus unique (tidak boleh duplikat)
- Status harus dipilih

### Read (Lihat Data)
1. Data ditampilkan dalam tabel (desktop) atau card (mobile)
2. Informasi yang ditampilkan:
   - No urut
   - Tahun takwim
   - Tanggal dibuat
   - Tanggal lock
   - Dibuat oleh
   - Status (dengan warna berbeda)
3. **Filter**:
   - Filter berdasarkan status (all, active, locked, revise)
4. **Search**:
   - Cari berdasarkan tahun atau status
   - Real-time search dengan debounce 300ms
5. **Pagination**:
   - 10 data per halaman
   - Navigasi halaman di bagian bawah

### Update (Edit Data)
1. Klik tombol `✎` (Edit) pada row data
2. Modal edit akan terbuka dengan data yang sudah terisi
3. Edit form:
   - **Tahun Takwim** (dapat diubah)
   - **Status** (dapat diubah)
   - **Tanggal Lock** (muncul jika status = locked)
4. Klik "Update"
5. Data akan terupdate di database
6. Alert sukses akan muncul
7. Modal akan tertutup otomatis

**Validasi**:
- Sama seperti Create
- Tahun harus unique kecuali untuk data yang sedang diedit

### Delete (Hapus Data)
1. Klik tombol `🗑` (Hapus) pada row data
2. Modal konfirmasi akan muncul
3. Klik "Hapus" untuk konfirmasi
4. Data akan terhapus dari database
5. Alert sukses akan muncul
6. Modal akan tertutup otomatis

### Fitur Tambahan

#### Toggle Status (Lock/Unlock)
1. Klik tombol `🔒` atau `🔓` pada row data
2. Status akan berubah:
   - Active → Locked (dengan tanggal lock saat ini)
   - Locked → Active (tanggal lock dihapus)
3. Alert sukses akan muncul
4. Data akan terupdate otomatis

#### Refresh Data
- Klik tombol `⟳` untuk refresh data
- Data akan dimuat ulang dari database

## Instalasi & Setup

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. Jalankan Seeder (Opsional - untuk data demo)
```bash
php artisan db:seed --class=PYearFilesSeeder
```

### 3. Akses Aplikasi
- URL: `http://your-domain/`
- Route name: `home.set-year`

## Status & Warna

- **Active** - Hijau (bg-emerald-600)
- **Locked** - Merah (bg-red-600)
- **Revise** - Kuning (bg-amber-500)

## Teknologi yang Digunakan

- **Laravel 11** - Framework PHP
- **Livewire 3** - Framework untuk reactive components
- **Alpine.js** - JavaScript framework untuk interaktivity
- **Tailwind CSS** - Utility-first CSS framework

## Keamanan

1. **Authorization**: User harus login untuk mengakses
2. **Validation**: Semua input divalidasi di server-side
3. **CSRF Protection**: Otomatis dari Laravel
4. **SQL Injection Protection**: Menggunakan Eloquent ORM

## Responsive Design

- **Desktop** (≥768px): Table view
- **Mobile** (<768px): Card view
- Semua fitur dapat diakses di kedua mode

## Alert System

Menggunakan Livewire events untuk menampilkan alert:
- **Success** - Hijau (bg-green-600)
- **Error** - Merah (bg-red-600)
- **Info** - Biru (bg-blue-600)

Alert muncul di kanan atas dan otomatis hilang setelah 3 detik.

## Troubleshooting

### Migration Error
Jika terjadi error saat migration, cek:
1. Database connection di `.env`
2. Table `users` sudah ada (required untuk foreign key)

### Data Tidak Muncul
Jika data tidak muncul setelah create:
1. Cek console browser untuk error JavaScript
2. Cek Laravel log di `storage/logs/laravel.log`
3. Pastikan user sudah login

### Validation Error
Jika validation error tidak hilang:
1. Pastikan input sesuai dengan rules
2. Refresh halaman jika perlu
3. Clear cache browser

## Future Enhancements

Beberapa fitur yang bisa ditambahkan:
1. Export to Excel/PDF
2. Import from Excel
3. Bulk delete
4. Audit log untuk track perubahan
5. Role-based access control
6. Soft delete
7. Archive old years

## Support

Untuk pertanyaan atau issue, silakan hubungi tim development.

---
**Created**: January 2026
**Version**: 1.0
**Author**: Portal HGK Hub Development Team
