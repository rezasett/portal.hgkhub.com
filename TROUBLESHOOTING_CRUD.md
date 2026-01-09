# 🔧 Troubleshooting Guide - CRUD Set Year

## Masalah: CRUD Tidak Bekerja

### ✅ Checklist Sebelum Testing

#### 1. Database Migration
```bash
php artisan migrate:status
```
✅ Pastikan `2026_01_05_091436_create_p_year_files_table` sudah RAN

#### 2. Data Exists
```bash
php test-crud.php
```
✅ Harus menampilkan minimal 6-7 records

#### 3. Server Running
```bash
php artisan serve
```
✅ Akses: http://localhost:8000

---

## 🔍 Testing Step by Step

### Test 1: Page Loading
1. Buka browser → http://localhost:8000
2. ✅ Harus tampil halaman "Set Tahun Takwim"
3. ✅ Harus tampil data tahun dalam tabel/card

**Jika tidak tampil data:**
- Cek console browser (F12) untuk error JavaScript
- Cek Network tab apakah ada error 500
- Cek Laravel log: `storage/logs/laravel.log`

### Test 2: Search Function
1. Ketik "2024" di search box
2. ✅ Table harus filter dan hanya tampil tahun 2024

**Jika tidak bekerja:**
- Search menggunakan `wire:model.live` (sudah diperbaiki)
- Cek console untuk Livewire errors
- Refresh halaman dengan Ctrl+F5

### Test 3: Filter Status
1. Pilih "Active" dari dropdown filter
2. ✅ Table harus hanya tampil data dengan status Active

**Jika tidak bekerja:**
- Cek dropdown value: "all", "active", "locked", "revise"
- Clear browser cache
- Pastikan Livewire assets loaded

### Test 4: Create (Tambah Data)
1. Klik tombol `+`
2. ✅ Modal harus muncul
3. Isi tahun: 2027
4. Pilih status: Active
5. Klik "Simpan"
6. ✅ Alert hijau "Tahun berhasil ditambahkan!"
7. ✅ Modal tertutup
8. ✅ Data baru muncul di table

**Jika modal tidak muncul:**
```bash
# Clear Livewire cache
php artisan livewire:publish --force
php artisan view:clear
```

**Jika submit tidak bekerja:**
- Cek console untuk validation errors
- Pastikan created_by field ada user
- Cek apakah form method `wire:submit.prevent="store"`

### Test 5: Edit Data
1. Klik tombol `✎` pada salah satu row
2. ✅ Modal edit harus muncul dengan data terisi
3. Ubah status
4. Klik "Update"
5. ✅ Alert hijau "Tahun berhasil diupdate!"
6. ✅ Data terupdate di table

**Jika data tidak terupdate:**
- Cek `openEditModal($id)` dipanggil dengan benar
- Cek validation rules untuk edit
- Refresh dan coba lagi

### Test 6: Delete Data
1. Klik tombol `🗑` pada salah satu row
2. ✅ Modal konfirmasi muncul
3. Klik "Hapus"
4. ✅ Alert hijau "Tahun berhasil dihapus!"
5. ✅ Data hilang dari table

**Jika delete tidak bekerja:**
- Cek foreign key constraints
- Pastikan tidak ada child records yang terkait
- Cek Laravel log untuk error

### Test 7: Toggle Status
1. Klik tombol `🔒` (Lock) pada tahun dengan status Active
2. ✅ Status berubah jadi Locked
3. ✅ Icon berubah jadi `🔓`
4. ✅ locked_at terisi dengan tanggal sekarang
5. Klik lagi `🔓` (Unlock)
6. ✅ Status kembali Active

---

## 🐛 Common Errors & Solutions

### Error: "Class PYearFiles not found"
**Solution:**
```bash
composer dump-autoload
php artisan optimize:clear
```

### Error: "Column not found: locked_at"
**Solution:**
```bash
php artisan migrate:rollback --step=1
php artisan migrate
```

### Error: "SQLSTATE[23000]: Integrity constraint violation"
**Solution:**
- Tahun yang diinput sudah ada (duplicate)
- Pastikan tahun unique

### Error: "Call to undefined method"
**Solution:**
- Clear cache dan optimize
```bash
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Error: Livewire not responding
**Solution:**
1. Refresh dengan Ctrl+F5
2. Clear browser cache
3. Check if Livewire scripts loaded:
```bash
# Publish Livewire assets
php artisan livewire:publish --assets
```

### Error: Modal tidak muncul
**Solution:**
- Pastikan Alpine.js loaded
- Check file `resources/views/layouts/app.blade.php`
- Pastikan ada `@livewireScripts` sebelum `</body>`

### Error: Alert tidak muncul
**Solution:**
- Cek event dispatcher: `$this->dispatch('alert', ...)`
- Pastikan Alpine.js listener ada: `@alert.window`
- Cek console browser untuk JavaScript errors

---

## 🔧 Advanced Debugging

### Enable Query Log
Tambahkan di `SetYear.php`:
```php
use Illuminate\Support\Facades\DB;

public function render()
{
    DB::enableQueryLog();
    
    $yearFiles = PYearFiles::query()
        ->with('creator')
        // ... rest of code
        
    dd(DB::getQueryLog()); // Debug queries
    
    return view('livewire.home.set-year', [
        'yearFiles' => $yearFiles
    ]);
}
```

### Check Livewire Component State
Tambahkan di blade:
```blade
@if(config('app.debug'))
    <div class="fixed bottom-0 left-0 bg-black text-white p-2 text-xs">
        Search: {{ $search ?? 'null' }} | 
        Filter: {{ $statusFilter ?? 'null' }}
    </div>
@endif
```

### Test API Manually
Buka browser console dan jalankan:
```javascript
// Test Livewire call
Livewire.find('component-id').call('openCreateModal');
```

---

## 📊 Verification Checklist

Setelah semua test, pastikan:
- [ ] ✅ Page loads without errors
- [ ] ✅ Data tampil di table (desktop) atau card (mobile)
- [ ] ✅ Search bekerja real-time
- [ ] ✅ Filter bekerja
- [ ] ✅ Pagination muncul (jika data > 10)
- [ ] ✅ Create: Modal muncul, form submit, data tersimpan
- [ ] ✅ Edit: Modal muncul, data terisi, update berhasil
- [ ] ✅ Delete: Konfirmasi muncul, data terhapus
- [ ] ✅ Toggle: Status berubah, locked_at terupdate
- [ ] ✅ Alert notifications muncul
- [ ] ✅ Responsive di mobile
- [ ] ✅ No console errors
- [ ] ✅ No PHP errors in log

---

## 🚀 Quick Fix Commands

```bash
# Full reset jika masih bermasalah
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
composer dump-autoload

# Restart server
php artisan serve
```

---

## 📞 Still Not Working?

1. **Check Laravel Log**
   ```bash
   tail -f storage/logs/laravel.log
   ```

2. **Check Browser Console**
   - Press F12
   - Go to Console tab
   - Look for errors

3. **Check Network Tab**
   - Press F12
   - Go to Network tab
   - Filter by "Fetch/XHR"
   - Check Livewire requests

4. **Enable Debug Mode**
   - Set `APP_DEBUG=true` in `.env`
   - Refresh page
   - Check detailed error messages

5. **Test with Sample Data**
   ```bash
   php test-crud.php
   ```
   Jika ini bekerja tapi browser tidak, masalah ada di frontend.

---

**Remember**: Jika semua sudah dicek dan masih tidak bekerja, restart server dan browser, lalu coba lagi dari awal.

---

**Version**: 1.0  
**Last Updated**: January 7, 2026
