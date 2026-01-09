# Client Data CRUD - Dokumentasi

## Deskripsi
CRUD (Create, Read, Update, Delete) untuk manajemen data client menggunakan **Livewire 3**, **AlpineJS**, dan **TailwindCSS**.

## Struktur File

### 1. Model
- **File**: `app/Models/PClientData.php`
- **Table**: `p_client_datas`
- **Fields**:
  - `id` - Primary key
  - `client_name` - Nama client (unique, required)
  - `status` - Status (enum: ongoing, completed, cancleled)
  - `created_at` - Timestamp pembuatan
  - `updated_at` - Timestamp update

### 2. Livewire Component
- **File**: `app/Livewire/Settings/ClientData.php`
- **Features**:
  - Pagination (10 items per page)
  - Real-time search by client name
  - Filter by status
  - Create new client
  - Edit existing client
  - Delete client with confirmation
  - Toast notifications
  - Form validation

### 3. Blade View
- **File**: `resources/views/livewire/settings/client-data.blade.php`
- **UI Components**:
  - Responsive data table
  - Search input with live search
  - Status filter dropdown
  - Create/Edit modal
  - Pagination controls
  - Toast notifications
  - Loading states

### 4. Migration
- **File**: `database/migrations/2026_01_05_100011_create_p_client_datas_table.php`

### 5. Seeder
- **File**: `database/seeders/PClientDataSeeder.php`

## Cara Penggunaan

### 1. Jalankan Migration
```bash
php artisan migrate
```

### 2. (Opsional) Jalankan Seeder untuk Data Dummy
```bash
php artisan db:seed --class=PClientDataSeeder
```

### 3. Akses Halaman
- URL: `/client-data-settings`
- Route name: `settings.client-data`

## Fitur-Fitur

### ✅ CREATE (Tambah Data)
1. Klik tombol **"+ Create"**
2. Isi form:
   - **Client Name** (required, unique)
   - **Status** (required: ongoing/completed/canceled)
3. Klik **"Simpan"**
4. Toast notification akan muncul

### ✅ READ (Tampilkan Data)
- Data ditampilkan dalam tabel responsif
- Pagination otomatis (10 items per page)
- Menampilkan:
  - Nomor urut
  - Nama client
  - Status (dengan badge berwarna)
  - Tanggal dibuat
  - Tombol aksi

### ✅ UPDATE (Edit Data)
1. Klik tombol **Edit (✏️)** pada baris data
2. Form modal akan terbuka dengan data yang sudah terisi
3. Ubah data yang diperlukan
4. Klik **"Simpan"**
5. Toast notification akan muncul

### ✅ DELETE (Hapus Data)
1. Klik tombol **Delete (🗑️)** pada baris data
2. Konfirmasi penghapusan akan muncul
3. Klik **"Ya, hapus"** untuk menghapus
4. Toast notification akan muncul

### 🔍 SEARCH (Pencarian)
- Ketik nama client di search box
- Hasil akan difilter secara real-time (debounce 300ms)
- Pagination akan reset ke halaman 1

### 🎯 FILTER by Status
- Pilih status dari dropdown:
  - All Status (tampilkan semua)
  - Ongoing
  - Completed
  - Canceled
- Hasil akan difilter secara real-time
- Pagination akan reset ke halaman 1

## Validasi Form

### Client Name
- ✅ Required (wajib diisi)
- ✅ String
- ✅ Max 255 karakter
- ✅ Unique (tidak boleh duplikat)

### Status
- ✅ Required (wajib diisi)
- ✅ Enum: ongoing, completed, cancleled

## Status Badge Colors

| Status | Background | Text Color |
|--------|-----------|------------|
| Ongoing | Amber | Amber-800 |
| Completed | Emerald | Emerald-800 |
| Canceled | Rose | Rose-800 |

## Technologies Used

- **Laravel 11** - Backend Framework
- **Livewire 3** - Full-stack framework for dynamic interfaces
- **AlpineJS** - Lightweight JavaScript framework for UI interactions
- **TailwindCSS** - Utility-first CSS framework
- **MySQL** - Database

## Troubleshooting

### Migration Error
Jika terjadi error saat migrate:
```bash
php artisan migrate:fresh
php artisan db:seed --class=PClientDataSeeder
```

### Data Tidak Muncul
1. Pastikan migration sudah dijalankan
2. Cek database apakah tabel `p_client_datas` ada
3. Jalankan seeder untuk data dummy

### Toast Tidak Muncul
1. Pastikan AlpineJS sudah ter-load
2. Cek browser console untuk error JavaScript

### Pagination Tidak Berfungsi
1. Pastikan Livewire sudah ter-install dengan benar
2. Clear cache: `php artisan view:clear`

## Catatan Penting

⚠️ **Typo di Migration**: Status "cancleled" adalah typo dari "canceled", tetapi sudah digunakan di migration. Jika ingin memperbaiki, ubah di:
1. Migration file
2. Model PClientData
3. Livewire Component
4. Blade view

## Future Improvements

- [ ] Export to Excel/PDF
- [ ] Bulk delete
- [ ] Advanced filtering (date range, multiple status)
- [ ] Sorting by column
- [ ] Import from CSV/Excel
- [ ] Client detail page
- [ ] Activity log
- [ ] Soft delete support
