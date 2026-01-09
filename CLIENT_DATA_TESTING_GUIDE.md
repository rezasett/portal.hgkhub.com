# 🧪 Client Data CRUD - Testing Guide

## ✅ Pre-Testing Checklist

Sebelum testing, pastikan:

- [ ] Migration sudah dijalankan
- [ ] Database connection sudah benar
- [ ] Laravel server running
- [ ] Browser sudah terbuka

## 🚀 Setup Testing Environment

```bash
# 1. Jalankan migration
php artisan migrate

# 2. Seed data dummy (opsional)
php artisan db:seed --class=PClientDataSeeder

# 3. Start Laravel server
php artisan serve

# 4. Akses di browser
http://localhost:8000/client-data-settings
```

## 📋 Test Cases

### 1️⃣ Test CREATE (Tambah Data)

#### Test Case 1.1: Create Success
**Steps:**
1. Klik tombol "Create" (biru, kanan atas)
2. Modal form akan terbuka
3. Isi "Client Name": `Test Client ABC`
4. Pilih "Status": `Ongoing`
5. Klik tombol "Simpan"

**Expected Result:**
- ✅ Modal tertutup
- ✅ Toast notification muncul: "Data client berhasil ditambahkan!"
- ✅ Data baru muncul di tabel (paling atas)
- ✅ Pagination reset ke page 1

---

#### Test Case 1.2: Create - Validation (Empty Name)
**Steps:**
1. Klik tombol "Create"
2. Kosongkan "Client Name" (jangan isi)
3. Pilih "Status": `Ongoing`
4. Klik "Simpan"

**Expected Result:**
- ✅ Modal tetap terbuka
- ✅ Error message muncul di bawah field: "Nama client wajib diisi."
- ✅ Data tidak tersimpan

---

#### Test Case 1.3: Create - Validation (Duplicate Name)
**Steps:**
1. Klik tombol "Create"
2. Isi "Client Name" dengan nama yang sudah ada (contoh: `PT Maju Jaya Abadi`)
3. Pilih "Status": `Ongoing`
4. Klik "Simpan"

**Expected Result:**
- ✅ Modal tetap terbuka
- ✅ Error message muncul: "Nama client sudah ada."
- ✅ Data tidak tersimpan

---

### 2️⃣ Test READ (Tampilkan Data)

#### Test Case 2.1: Display Data
**Steps:**
1. Akses halaman `/client-data-settings`

**Expected Result:**
- ✅ Tabel menampilkan data clients
- ✅ Kolom: No, Client Name, Status, Created At, Action
- ✅ Status badge berwarna sesuai (Amber/Green/Red)
- ✅ Pagination muncul di bawah tabel

---

#### Test Case 2.2: Pagination
**Steps:**
1. Jika ada lebih dari 10 data, navigasi ke page 2
2. Klik tombol "Next" atau angka page

**Expected Result:**
- ✅ Data berubah ke halaman berikutnya
- ✅ Nomor urut melanjutkan dari page sebelumnya
- ✅ Active page button berwarna biru

---

#### Test Case 2.3: Empty State
**Steps:**
1. Hapus semua data atau search dengan keyword yang tidak ada
2. Lihat tabel

**Expected Result:**
- ✅ Pesan "No data found." muncul di tengah tabel
- ✅ Tidak ada error

---

### 3️⃣ Test UPDATE (Edit Data)

#### Test Case 3.1: Edit Success
**Steps:**
1. Klik tombol "Edit" (✏️) pada salah satu row
2. Modal terbuka dengan data ter-fill
3. Ubah "Client Name": `Updated Client Name`
4. Ubah "Status": `Completed`
5. Klik "Simpan"

**Expected Result:**
- ✅ Modal tertutup
- ✅ Toast notification: "Data client berhasil diupdate!"
- ✅ Data di tabel terupdate
- ✅ Status badge berubah warna

---

#### Test Case 3.2: Edit - No Change
**Steps:**
1. Klik tombol "Edit" pada row
2. Jangan ubah apapun
3. Klik "Simpan"

**Expected Result:**
- ✅ Modal tertutup
- ✅ Toast notification muncul
- ✅ Data tetap sama

---

#### Test Case 3.3: Edit - Cancel
**Steps:**
1. Klik tombol "Edit" pada row
2. Ubah beberapa field
3. Klik tombol "Batal" atau klik di luar modal

**Expected Result:**
- ✅ Modal tertutup
- ✅ Perubahan tidak tersimpan
- ✅ Data di tabel tetap seperti semula

---

### 4️⃣ Test DELETE (Hapus Data)

#### Test Case 4.1: Delete Success
**Steps:**
1. Klik tombol "Delete" (🗑️) pada salah satu row
2. Browser confirmation muncul
3. Klik "OK"

**Expected Result:**
- ✅ Confirmation dialog tertutup
- ✅ Toast notification: "Data client berhasil dihapus!"
- ✅ Row terhapus dari tabel
- ✅ Data tidak ada di database

---

#### Test Case 4.2: Delete - Cancel
**Steps:**
1. Klik tombol "Delete" pada row
2. Browser confirmation muncul
3. Klik "Cancel"

**Expected Result:**
- ✅ Confirmation dialog tertutup
- ✅ Data tidak terhapus
- ✅ Row tetap di tabel

---

### 5️⃣ Test SEARCH (Pencarian)

#### Test Case 5.1: Search - Found
**Steps:**
1. Ketik di search box: `Maju`
2. Tunggu 300ms (debounce)

**Expected Result:**
- ✅ Tabel menampilkan hanya data yang mengandung "Maju"
- ✅ Pagination reset ke page 1
- ✅ Jumlah data berubah sesuai hasil search

---

#### Test Case 5.2: Search - Not Found
**Steps:**
1. Ketik di search box: `XXXNONEXISTXXX`
2. Tunggu 300ms

**Expected Result:**
- ✅ Tabel menampilkan "No data found."
- ✅ Tidak ada error

---

#### Test Case 5.3: Search - Clear
**Steps:**
1. Ketik di search box: `Test`
2. Hapus semua text (clear search)

**Expected Result:**
- ✅ Tabel kembali menampilkan semua data
- ✅ Pagination kembali normal

---

### 6️⃣ Test FILTER (by Status)

#### Test Case 6.1: Filter - Ongoing
**Steps:**
1. Pilih "Ongoing" di dropdown status
2. Lihat tabel

**Expected Result:**
- ✅ Tabel hanya menampilkan data dengan status "Ongoing"
- ✅ Pagination reset ke page 1
- ✅ Semua badge berwarna amber

---

#### Test Case 6.2: Filter - Completed
**Steps:**
1. Pilih "Completed" di dropdown
2. Lihat tabel

**Expected Result:**
- ✅ Tabel hanya menampilkan data dengan status "Completed"
- ✅ Semua badge berwarna hijau

---

#### Test Case 6.3: Filter - Canceled
**Steps:**
1. Pilih "Canceled" di dropdown
2. Lihat tabel

**Expected Result:**
- ✅ Tabel hanya menampilkan data dengan status "Canceled"
- ✅ Semua badge berwarna merah

---

#### Test Case 6.4: Filter - All Status
**Steps:**
1. Pilih "All Status" di dropdown
2. Lihat tabel

**Expected Result:**
- ✅ Tabel menampilkan semua data
- ✅ Badge mixed colors

---

### 7️⃣ Test COMBINED (Search + Filter)

#### Test Case 7.1: Search + Filter
**Steps:**
1. Ketik search: `PT`
2. Pilih filter: `Ongoing`

**Expected Result:**
- ✅ Tabel menampilkan data yang mengandung "PT" DAN status "Ongoing"
- ✅ Pagination reset
- ✅ Hasil filter akurat

---

### 8️⃣ Test RESPONSIVE (Mobile View)

#### Test Case 8.1: Mobile View
**Steps:**
1. Buka browser DevTools (F12)
2. Toggle device toolbar (Ctrl+Shift+M)
3. Pilih device: iPhone 12 Pro atau responsive
4. Test semua fitur

**Expected Result:**
- ✅ Layout menyesuaikan screen
- ✅ Search box, filter, button tetap accessible
- ✅ Tabel scrollable horizontal jika perlu
- ✅ Modal responsif
- ✅ Semua fitur berfungsi normal

---

### 9️⃣ Test LOADING STATES

#### Test Case 9.1: Save Loading
**Steps:**
1. Klik Create/Edit
2. Isi form
3. Klik "Simpan"
4. Perhatikan button

**Expected Result:**
- ✅ Button disabled saat loading
- ✅ Spinner icon muncul
- ✅ Text berubah jadi "Saving..."
- ✅ Setelah selesai, kembali normal

---

### 🔟 Test ERROR HANDLING

#### Test Case 10.1: Database Error
**Steps:**
1. Stop database server
2. Try to create/edit data

**Expected Result:**
- ✅ Error ditangani dengan baik
- ✅ Toast notification dengan pesan error
- ✅ Tidak ada crash

---

## 📊 Test Result Template

```
┌─────────────────────────────────────────┐
│  CLIENT DATA CRUD - TEST RESULTS        │
├─────────────────────────────────────────┤
│                                         │
│  CREATE Tests:                          │
│  ✅ 1.1 Create Success                  │
│  ✅ 1.2 Validation - Empty Name         │
│  ✅ 1.3 Validation - Duplicate Name     │
│                                         │
│  READ Tests:                            │
│  ✅ 2.1 Display Data                    │
│  ✅ 2.2 Pagination                      │
│  ✅ 2.3 Empty State                     │
│                                         │
│  UPDATE Tests:                          │
│  ✅ 3.1 Edit Success                    │
│  ✅ 3.2 Edit No Change                  │
│  ✅ 3.3 Edit Cancel                     │
│                                         │
│  DELETE Tests:                          │
│  ✅ 4.1 Delete Success                  │
│  ✅ 4.2 Delete Cancel                   │
│                                         │
│  SEARCH Tests:                          │
│  ✅ 5.1 Search Found                    │
│  ✅ 5.2 Search Not Found                │
│  ✅ 5.3 Search Clear                    │
│                                         │
│  FILTER Tests:                          │
│  ✅ 6.1 Filter Ongoing                  │
│  ✅ 6.2 Filter Completed                │
│  ✅ 6.3 Filter Canceled                 │
│  ✅ 6.4 Filter All Status               │
│                                         │
│  COMBINED Tests:                        │
│  ✅ 7.1 Search + Filter                 │
│                                         │
│  RESPONSIVE Tests:                      │
│  ✅ 8.1 Mobile View                     │
│                                         │
│  LOADING Tests:                         │
│  ✅ 9.1 Save Loading                    │
│                                         │
│  ERROR Tests:                           │
│  ✅ 10.1 Database Error                 │
│                                         │
├─────────────────────────────────────────┤
│  Total: 21 Tests                        │
│  Passed: __/21                          │
│  Failed: __/21                          │
│  Pass Rate: ___%                        │
└─────────────────────────────────────────┘
```

## 🐛 Common Issues & Solutions

### Issue 1: Modal tidak muncul
**Solution:**
- Check browser console for errors
- Pastikan AlpineJS loaded
- Check `$isModalOpen` value

### Issue 2: Search tidak bekerja
**Solution:**
- Check network tab (Livewire requests)
- Pastikan debounce 300ms berjalan
- Check `wire:model.live.debounce.300ms`

### Issue 3: Pagination error
**Solution:**
- Check `$clients` variable di component
- Pastikan pagination enabled: `use WithPagination;`
- Clear view cache: `php artisan view:clear`

### Issue 4: Toast tidak muncul
**Solution:**
- Check `@this.on('show-toast')` event
- Check AlpineJS x-data, x-show
- Check timeout logic

### Issue 5: Validation tidak muncul
**Solution:**
- Check `@error` directive
- Check validation rules di component
- Check error bag: `$errors`

## 🎯 Performance Testing

### Test Page Load
- [ ] Initial load < 2s
- [ ] Livewire requests < 500ms
- [ ] Pagination change < 300ms
- [ ] Search debounce = 300ms

### Test Database Queries
```bash
# Enable query logging
DB::enableQueryLog();

# Check queries after action
dd(DB::getQueryLog());
```

## ✅ Final Checklist

Sebelum consider testing complete:

- [ ] Semua CRUD operations berfungsi
- [ ] Search berfungsi dengan baik
- [ ] Filter berfungsi dengan baik
- [ ] Pagination berfungsi
- [ ] Validation berfungsi
- [ ] Toast notifications muncul
- [ ] Modal open/close berfungsi
- [ ] Loading states berfungsi
- [ ] Responsive di mobile
- [ ] Error handling berfungsi
- [ ] No console errors
- [ ] No PHP errors
- [ ] Database integrity terjaga

---

**Happy Testing! 🎉**
