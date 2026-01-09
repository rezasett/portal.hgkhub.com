<?php

namespace App\Livewire\Home;

use App\Models\PYearFiles;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class SetYear extends Component
{
    use WithPagination;

    // Form properties
    public $yearId;
    public $year;
    public $status = 'active';
    public $locked_at;

    // UI State
    public $openCreate = false;
    public $openEdit = false;
    public $openDelete = false;
    
    // Search & Filter
    public $search = '';
    public $statusFilter = 'all';

    protected $rules = [
        'year' => 'required|integer|min:1900|max:2100|unique:p_year_files,year',
        'status' => 'required|in:active,locked,revise',
        'locked_at' => 'nullable|date',
    ];

    protected $messages = [
        'year.required' => 'Tahun harus diisi',
        'year.integer' => 'Tahun harus berupa angka',
        'year.min' => 'Tahun minimal 1900',
        'year.max' => 'Tahun maksimal 2100',
        'year.unique' => 'Tahun sudah ada dalam database',
        'status.required' => 'Status harus dipilih',
        'status.in' => 'Status tidak valid',
    ];

    public function mount()
    {
        $this->year = now()->year;
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $yearFiles = PYearFiles::query()
            ->with('creator')
            ->when($this->search, function ($query) {
                $query->where('year', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter !== 'all', function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderBy('year', 'desc')
            ->paginate(10);

        return view('livewire.home.set-year', [
            'yearFiles' => $yearFiles
        ]);
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->year = now()->year;
        $this->openCreate = true;
    }

    public function store()
    {
        $this->validate();

        try {
            // Get authenticated user or use first user as fallback (development only)
            $userId = Auth::id();
            if (!$userId) {
                // Development fallback: use first user
                $firstUser = \App\Models\User::first();
                if (!$firstUser) {
                    $this->dispatch('alert', [
                        'type' => 'error',
                        'message' => 'Tidak ada user di database. Silakan buat user terlebih dahulu!'
                    ]);
                    return;
                }
                $userId = $firstUser->id;
            }

            PYearFiles::create([
                'year' => $this->year,
                'status' => $this->status,
                'locked_at' => $this->status === 'locked' ? now() : null,
                'created_by' => $userId,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Tahun berhasil ditambahkan!'
            ]);

            $this->openCreate = false;
            $this->resetForm();
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal menambahkan tahun: ' . $e->getMessage()
            ]);
        }
    }

    public function openEditModal($id)
    {
        $yearFile = PYearFiles::findOrFail($id);
        
        $this->yearId = $yearFile->id;
        $this->year = $yearFile->year;
        $this->status = $yearFile->status;
        $this->locked_at = $yearFile->locked_at ? \Carbon\Carbon::parse($yearFile->locked_at)->format('Y-m-d') : null;
        
        $this->openEdit = true;
    }

    public function update()
    {
        $this->validate([
            'year' => 'required|integer|min:1900|max:2100|unique:p_year_files,year,' . $this->yearId,
            'status' => 'required|in:active,locked,revise',
            'locked_at' => 'nullable|date',
        ]);

        try {
            $yearFile = PYearFiles::findOrFail($this->yearId);
            
            $yearFile->update([
                'year' => $this->year,
                'status' => $this->status,
                'locked_at' => $this->status === 'locked' ? ($this->locked_at ?: now()) : null,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Tahun berhasil diupdate!'
            ]);

            $this->openEdit = false;
            $this->resetForm();
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal mengupdate tahun: ' . $e->getMessage()
            ]);
        }
    }

    public function confirmDelete($id)
    {
        $this->yearId = $id;
        $this->openDelete = true;
    }

    public function delete()
    {
        try {
            $yearFile = PYearFiles::findOrFail($this->yearId);
            $yearFile->delete();

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Tahun berhasil dihapus!'
            ]);

            $this->openDelete = false;
            $this->resetForm();
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal menghapus tahun: ' . $e->getMessage()
            ]);
        }
    }

    public function toggleStatus($id)
    {
        try {
            $yearFile = PYearFiles::findOrFail($id);
            
            $newStatus = $yearFile->status === 'active' ? 'locked' : 'active';
            $yearFile->update([
                'status' => $newStatus,
                'locked_at' => $newStatus === 'locked' ? now() : null,
            ]);

            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Status berhasil diubah!'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error',
                'message' => 'Gagal mengubah status: ' . $e->getMessage()
            ]);
        }
    }

    private function resetForm()
    {
        $this->reset(['yearId', 'year', 'status', 'locked_at']);
        $this->resetValidation();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
}
