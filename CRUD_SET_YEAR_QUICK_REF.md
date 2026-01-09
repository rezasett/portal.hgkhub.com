# 🎯 CRUD Set Year - Quick Reference

## 📁 File Locations

| Type | Path |
|------|------|
| Model | `app/Models/PYearFiles.php` |
| Component | `app/Livewire/Home/SetYear.php` |
| View | `resources/views/livewire/home/set-year.blade.php` |
| Migration | `database/migrations/2026_01_05_091436_create_p_year_files_table.php` |
| Seeder | `database/seeders/PYearFilesSeeder.php` |

## 🚀 Commands

```bash
# Migration
php artisan migrate

# Seeder
php artisan db:seed --class=PYearFilesSeeder

# Rollback (if needed)
php artisan migrate:rollback --step=1
```

## 🎨 Routes

```php
Route::get('/', SetYear::class)->name('home.set-year');
```

## 💾 Database Fields

```php
$table->id();
$table->year('year')->unique();
$table->enum('status', ['active', 'locked','revise'])->default('active');
$table->date('locked_at')->nullable();
$table->foreignId('created_by')->constrained('users')->onDelete('cascade');
$table->timestamps();
```

## 🔧 Livewire Methods

### Public Methods
```php
openCreateModal()     // Open create modal
store()              // Save new year
openEditModal($id)   // Open edit modal with data
update()             // Update existing year
confirmDelete($id)   // Show delete confirmation
delete()             // Delete year
toggleStatus($id)    // Toggle active/locked status
```

### Properties
```php
// Form
$yearId, $year, $status, $locked_at

// UI State
$openCreate, $openEdit, $openDelete

// Search & Filter
$search, $statusFilter
```

## 🎯 Validation Rules

```php
'year' => 'required|integer|min:1900|max:2100|unique:p_year_files,year'
'status' => 'required|in:active,locked,revise'
'locked_at' => 'nullable|date'
```

## 🎨 Status Colors

| Status | Color Class | Background |
|--------|-------------|------------|
| Active | `bg-emerald-600` | Green |
| Locked | `bg-red-600` | Red |
| Revise | `bg-amber-500` | Yellow |

## 📱 Responsive Breakpoints

| Screen | View Type | Class |
|--------|-----------|-------|
| Desktop (≥768px) | Table | `hidden md:block` |
| Mobile (<768px) | Cards | `md:hidden` |

## 🔔 Alert Events

```php
$this->dispatch('alert', [
    'type' => 'success|error|info',
    'message' => 'Your message here'
]);
```

## 🎯 Model Scopes

```php
PYearFiles::active()->get()   // Get active years
PYearFiles::locked()->get()   // Get locked years
PYearFiles::revise()->get()   // Get revise years
```

## 🔗 Relationships

```php
$yearFile->creator  // BelongsTo User (who created the year)
```

## 📊 Quick Test Data

```php
// Via Seeder
2020 - Locked (2021-01-15)
2021 - Locked (2022-01-20)
2022 - Locked (2023-02-10)
2023 - Revise
2024 - Active
2025 - Active
```

## 🛠️ Common Tasks

### Add New Year (Manual)
```php
PYearFiles::create([
    'year' => 2026,
    'status' => 'active',
    'locked_at' => null,
    'created_by' => auth()->id(),
]);
```

### Update Status
```php
$yearFile->update([
    'status' => 'locked',
    'locked_at' => now(),
]);
```

### Query Examples
```php
// Get all active years
$activeYears = PYearFiles::where('status', 'active')->get();

// Get years with creator
$years = PYearFiles::with('creator')->get();

// Search by year
$results = PYearFiles::where('year', 'like', '%2024%')->get();
```

## 🎨 UI Components

### Modals
- Create Modal: `@if($openCreate)`
- Edit Modal: `@if($openEdit)`
- Delete Modal: `@if($openDelete)`

### Action Buttons
| Icon | Action | Color |
|------|--------|-------|
| ✎ | Edit | Blue (`bg-blue-950`) |
| 🔒/🔓 | Toggle Lock | Red/Green |
| 🗑 | Delete | Red (`bg-rose-600`) |

## 💡 Tips & Tricks

1. **Real-time Search**: Uses `wire:model.live.debounce.300ms`
2. **Pagination**: Automatic with `$yearFiles->links()`
3. **Responsive**: Mobile-first approach
4. **Auto-close Modals**: Set `open*` properties to `false`
5. **Loading States**: Livewire handles automatically

## 🐛 Troubleshooting

| Issue | Solution |
|-------|----------|
| Migration error | Check users table exists |
| Validation fails | Check rules and input values |
| Data not showing | Run seeder or check query |
| Modal not closing | Check `wire:click="$set('openCreate', false)"` |
| Alert not showing | Check Livewire event dispatch |

## 📚 Documentation Links

- Full Documentation: `CRUD_SET_YEAR_README.md`
- Summary: `CRUD_SET_YEAR_SUMMARY.md`
- This Quick Ref: `CRUD_SET_YEAR_QUICK_REF.md`

---
**Last Updated**: January 7, 2026
