# Client Data CRUD - Quick Reference

## 🚀 Setup Cepat

```bash
# 1. Jalankan migration
php artisan migrate

# 2. (Opsional) Seed data dummy
php artisan db:seed --class=PClientDataSeeder

# 3. Akses di browser
http://localhost/client-data-settings
```

## 📋 Struktur Database

**Tabel**: `p_client_datas`

| Field | Type | Constraint |
|-------|------|------------|
| id | bigint | Primary Key, Auto Increment |
| client_name | varchar(255) | Unique, Not Null |
| status | enum | 'ongoing', 'completed', 'cancleled' |
| created_at | timestamp | |
| updated_at | timestamp | |

## 🎯 File-File Penting

```
app/Models/PClientData.php                           # Model
app/Livewire/Settings/ClientData.php                 # Livewire Component
resources/views/livewire/settings/client-data.blade.php  # View
database/migrations/2026_01_05_100011_create_p_client_datas_table.php  # Migration
database/seeders/PClientDataSeeder.php               # Seeder
```

## 🔧 Livewire Component Properties

```php
// Form fields
public $client_name = '';
public $status = 'ongoing';

// Modal state
public $isModalOpen = false;
public $isEditMode = false;
public $editingId = null;

// Filters & search
public $search = '';
public $filterStatus = '';

// Toast
public $toastMessage = '';
public $showToast = false;
```

## 📝 Livewire Methods

| Method | Deskripsi |
|--------|-----------|
| `openCreateModal()` | Buka modal untuk create |
| `openEditModal($id)` | Buka modal untuk edit |
| `closeModal()` | Tutup modal |
| `save()` | Simpan data (create/update) |
| `delete($id)` | Hapus data |

## 🎨 Blade Directives

```blade
{{-- Loop data --}}
@forelse ($clients as $client)
    {{ $client->client_name }}
@empty
    No data
@endforelse

{{-- Pagination --}}
{{ $clients->links() }}

{{-- Livewire Actions --}}
wire:click="openCreateModal"
wire:click="openEditModal({{ $client->id }})"
wire:click="delete({{ $client->id }})"

{{-- Livewire Model Binding --}}
wire:model="client_name"
wire:model.live="search"
wire:model.live="filterStatus"

{{-- Error Display --}}
@error('client_name')
    <p>{{ $message }}</p>
@enderror
```

## 🎭 Status Values & Colors

```php
// Status enum values
'ongoing'    // Amber badge (sedang berjalan)
'completed'  // Green badge (selesai)
'cancleled'  // Red badge (dibatalkan)
```

## 🔍 Search & Filter

**Search** (Live debounce 300ms):
- Mencari berdasarkan `client_name`
- Auto reset pagination ke page 1

**Filter Status**:
- All Status (kosong)
- ongoing
- completed
- cancleled

## ✅ Validation Rules

```php
'client_name' => 'required|string|max:255|unique:p_client_datas,client_name'
'status' => 'required|in:ongoing,completed,cancleled'
```

## 🎪 Wire Loading States

```blade
{{-- Disable saat loading --}}
wire:loading.attr="disabled"

{{-- Hide saat loading --}}
wire:loading.remove wire:target="save"

{{-- Show saat loading --}}
wire:loading wire:target="save"
```

## 💬 Toast Notification

```php
// Di Livewire Component
$this->showToastMessage('Pesan sukses!');

// Toast akan auto-hide setelah 2 detik
```

## 🚨 Delete Confirmation

```blade
wire:confirm="Are you sure you want to delete this client?"
```

## 📱 Responsive Classes

```
sm:  640px+  (small devices)
md:  768px+  (medium devices)
lg:  1024px+ (large devices)
xl:  1280px+ (extra large)
2xl: 1536px+ (2x extra large)
```

## 🎯 Route

```php
// routes/web.php
Route::get('/client-data-settings', ClientData::class)
    ->name('settings.client-data');

// Akses di view
route('settings.client-data')
{{ route('settings.client-data') }}
href="{{ route('settings.client-data') }}"
```

## 🔄 Pagination Info

```php
$clients->currentPage()      // Halaman saat ini
$clients->perPage()          // Items per halaman (10)
$clients->total()            // Total items
$clients->lastPage()         // Halaman terakhir
```

## 🐛 Debug Tips

```php
// Di Livewire Component
dd($this->client_name);      // Dump and die
logger($this->search);       // Log ke file

// Di Blade
@dump($clients)
@dd($client)
```

## 🔧 Clear Cache Commands

```bash
php artisan view:clear       # Clear compiled views
php artisan cache:clear      # Clear application cache
php artisan config:clear     # Clear config cache
php artisan route:clear      # Clear route cache

# Clear all
php artisan optimize:clear
```

## 📦 Component Lifecycle

```
1. Mount
2. Hydrate
3. Update (when property changes)
4. Render
5. Dehydrate
```

## 🎨 TailwindCSS Common Classes

```css
/* Layout */
flex, grid, block, inline-block, hidden

/* Spacing */
p-4 (padding), m-4 (margin), gap-2

/* Colors */
bg-blue-950, text-white, border-slate-200

/* Rounded */
rounded-xl, rounded-full

/* Shadows */
shadow-lg, shadow-2xl

/* Hover */
hover:bg-slate-50, hover:opacity-90

/* Text */
text-sm, text-xs, font-semibold, font-bold
```

## ⚡ AlpineJS Directives

```html
<!-- Data binding -->
x-data="{ open: @entangle('isModalOpen') }"

<!-- Events -->
@click="closeModal()"

<!-- Conditionals -->
x-show="open"
x-if="condition"

<!-- Transitions -->
x-transition
x-transition:enter
x-transition:leave

<!-- Lifecycle -->
x-init="init()"
```

## 📊 Common Queries

```php
// Get all
PClientData::all()

// With pagination
PClientData::paginate(10)

// Search
PClientData::where('client_name', 'like', '%search%')

// Filter
PClientData::where('status', 'ongoing')

// Order
PClientData::orderBy('created_at', 'desc')

// Find
PClientData::find($id)
PClientData::findOrFail($id)

// Create
PClientData::create([...])

// Update
$client->update([...])

// Delete
$client->delete()
```
