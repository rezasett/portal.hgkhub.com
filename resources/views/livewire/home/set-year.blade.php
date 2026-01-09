<div class="min-h-screen bg-slate-100 text-slate-900">
    {{-- Loading Indicator --}}
    <div wire:loading class="fixed top-0 left-0 right-0 z-[80] bg-blue-950 text-white text-center py-2 text-xs font-semibold">
        ⏳ Loading...
    </div>

    {{-- Alert Component --}}
    <div x-data="{ show: false, type: 'success', message: '' }"
         @alert.window="show = true; type = $event.detail.type; message = $event.detail.message; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed top-4 right-4 z-[70] max-w-md">
        <div :class="{
            'bg-green-600': type === 'success',
            'bg-red-600': type === 'error',
            'bg-blue-600': type === 'info'
        }" class="px-4 py-3 rounded-2xl shadow-lg text-white text-sm">
            <span x-text="message"></span>
        </div>
    </div>

    {{-- PAGE WRAP --}}
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

        {{-- WELCOME / INFO BANNER --}}
        <section class="bg-white rounded-2xl border border-slate-200 shadow-[0_18px_50px_-35px_rgba(2,6,23,0.45)] overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                    <div class="min-w-0">
                        <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight">
                            Selamat Datang di Portal HGK Hub
                        </h1>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                            Kelola tahun takwim untuk pengaturan periode laporan dan file.
                        </p>

                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold">
                                🧾 Data Selected: [year]
                            </span>
                            <span class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700">
                                🔒 Welcome : [user] 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- MAIN CARD: "SET TAHUN TAKWIM" + TABLE --}}
        <section class="mt-6 bg-white rounded-2xl border border-slate-200 shadow-[0_18px_50px_-35px_rgba(2,6,23,0.45)] overflow-hidden">
            {{-- header --}}
            <div class="px-5 sm:px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-2xl bg-blue-950/10 text-blue-950 flex items-center justify-center text-base">🗓️</div>
                        <div class="min-w-0">
                            <h2 class="text-sm sm:text-base font-extrabold truncate">Set Tahun Takwim</h2>
                            <p class="text-[12px] text-slate-500 truncate">
                                Kelola periode laporan tahunan & status pengiriman.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔎</span>
                        <input
                            type="search"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Cari tahun / status…"
                            class="w-64 max-w-[72vw] pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-950/15"
                        />
                    </div>

                    <select
                        wire:model.live="statusFilter"
                        class="px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white"
                    >
                        <option value="all">Semua status</option>
                        <option value="active">Active</option>
                        <option value="locked">Locked</option>
                        <option value="revise">Revise</option>
                    </select>
                </div>
            </div>

            {{-- toolbar row --}}
            <div class="px-5 sm:px-6 py-3 border-b border-slate-100 flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <button
                        type="button"
                        wire:click.prevent="openCreateModal"
                        class="h-9 w-9 rounded-md bg-blue-950 text-white hover:bg-blue-900 grid place-items-center shadow-sm"
                        title="Tambah Tahun"
                    >＋</button>

                    <button
                        type="button"
                        wire:click.prevent="$refresh"
                        class="h-9 w-9 rounded-md bg-blue-950/10 text-blue-950 hover:bg-blue-950/15 border border-blue-950/10 grid place-items-center"
                        title="Refresh"
                    >⟳</button>

                    <div class="hidden sm:block text-[12px] text-slate-500 ml-2">
                        Total: <span class="font-semibold text-slate-700">{{ $yearFiles->total() }}</span> tahun
                    </div>
                </div>
            </div>

            {{-- TABLE (desktop) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-[980px] w-full text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr class="text-xs">
                            <th class="px-5 py-3 text-left w-16">No.</th>
                            <th class="px-5 py-3 text-left w-48">Tahun Takwim</th>
                            <th class="px-5 py-3 text-left w-44">Tanggal Dibuat</th>
                            <th class="px-5 py-3 text-left w-52">Tanggal Lock</th>
                            <th class="px-5 py-3 text-left w-32">Dibuat Oleh</th>
                            <th class="px-5 py-3 text-left w-56">Status</th>
                            <th class="px-5 py-3 text-left w-44">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($yearFiles as $index => $yearFile)
                            <tr class="hover:bg-slate-50/60" wire:key="year-{{ $yearFile->id }}">
                                <td class="px-5 py-4 text-slate-600">{{ $yearFiles->firstItem() + $index }}</td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold text-slate-900">{{ $yearFile->year }}</span>
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-slate-700 text-xs">
                                    {{ $yearFile->created_at->format('d/m/Y H:i') }}
                                </td>
                                
                                <td class="px-5 py-4 text-slate-700 text-xs">
                                    {{ $yearFile->locked_at ? $yearFile->locked_at->format('d/m/Y') : '—' }}
                                </td>
                                
                                <td class="px-5 py-4 text-slate-700 text-xs">
                                    {{ $yearFile->creator->name ?? '—' }}
                                </td>

                                <td class="px-5 py-4">
                                    @if($yearFile->status === 'active')
                                        <div class="w-full rounded-md bg-emerald-600 text-white px-3 py-2 text-xs font-semibold">
                                            Active
                                        </div>
                                    @elseif($yearFile->status === 'locked')
                                        <div class="w-full rounded-md bg-red-600 text-white px-3 py-2 text-xs font-semibold">
                                            Locked
                                        </div>
                                    @else
                                        <div class="w-full rounded-md bg-amber-500 text-white px-3 py-2 text-xs font-semibold">
                                            Revise
                                        </div>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            wire:click.prevent="openEditModal({{ $yearFile->id }})"
                                            class=" rounded-md bg-orange-500 text-white hover:bg-orange-400 grid place-items-center px-4 py-2"
                                            title="Edit"
                                        >Edit</button>

                                        <button
                                            type="button"
                                            wire:click.prevent="toggleStatus({{ $yearFile->id }})"
                                            wire:loading.attr="disabled"
                                            class=" rounded-md {{ $yearFile->status === 'active' ? 'bg-red-600 hover:bg-red-700' : 'bg-emerald-700 hover:bg-emerald-800' }} text-white grid place-items-center px-4 py-2 disabled:opacity-50"
                                            title="{{ $yearFile->status === 'active' ? 'Lock' : 'Unlock' }}"
                                        >{{ $yearFile->status === 'active' ? 'Lock' : 'Unlock' }}</button>

                                        <button
                                            type="button"
                                            wire:click.prevent="confirmDelete({{ $yearFile->id }})"
                                            class="h-9 w-9 rounded-md bg-rose-600 text-white hover:bg-rose-700 grid place-items-center"
                                            title="Hapus"
                                        >🗑</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-12 text-center text-sm text-slate-500">
                                    Data tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- MOBILE LIST (cards) --}}
            <div class="md:hidden p-4 space-y-3">
                @forelse($yearFiles as $yearFile)
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm" wire:key="mobile-year-{{ $yearFile->id }}">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2">
                                    <div class="h-9 w-9 rounded-2xl bg-blue-950/10 text-blue-950 flex items-center justify-center">🗓️</div>
                                    <div class="min-w-0">
                                        <div class="text-sm font-extrabold">Tahun {{ $yearFile->year }}</div>
                                        <div class="text-[11px] text-slate-500 truncate">
                                            Dibuat: <span class="font-semibold text-slate-700">{{ $yearFile->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 grid grid-cols-2 gap-2 text-[12px] text-slate-600">
                                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-2">
                                        <div class="text-slate-500">Dibuat Oleh</div>
                                        <div class="font-semibold text-slate-800">{{ $yearFile->creator->name ?? '—' }}</div>
                                    </div>
                                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-2">
                                        <div class="text-slate-500">Tanggal Lock</div>
                                        <div class="font-semibold text-slate-800 truncate">{{ $yearFile->locked_at ? $yearFile->locked_at->format('d/m/Y') : '—' }}</div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    @if($yearFile->status === 'active')
                                        <div class="w-full rounded-md bg-emerald-600 text-white px-3 py-2 text-xs font-semibold">
                                            Active
                                        </div>
                                    @elseif($yearFile->status === 'locked')
                                        <div class="w-full rounded-md bg-red-600 text-white px-3 py-2 text-xs font-semibold">
                                            Locked
                                        </div>
                                    @else
                                        <div class="w-full rounded-md bg-amber-500 text-white px-3 py-2 text-xs font-semibold">
                                            Revise
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2">
                            <button 
                                type="button"
                                wire:click.prevent="openEditModal({{ $yearFile->id }})"
                                class="flex-1 px-3 py-2 rounded-md bg-yellow-300 text-white hover:bg-blue-900 text-xs font-semibold">
                                ✎ Edit
                            </button>
                            <button 
                                type="button"
                                wire:click.prevent="toggleStatus({{ $yearFile->id }})"
                                wire:loading.attr="disabled"
                                class="flex-1 px-3 py-2 rounded-md {{ $yearFile->status === 'active' ? 'bg-red-600 hover:bg-red-700' : 'bg-emerald-700 hover:bg-emerald-800' }} text-white text-xs font-semibold disabled:opacity-50">
                                {{ $yearFile->status === 'active' ? '🔒 Lock' : '🔓 Unlock' }}
                            </button>
                            <button 
                                type="button"
                                wire:click.prevent="confirmDelete({{ $yearFile->id }})"
                                class="px-3 py-2 rounded-md bg-rose-600 text-white hover:bg-rose-700 text-xs font-semibold">
                                🗑
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center text-sm text-slate-500">
                        Data tidak ditemukan.
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="px-5 sm:px-6 py-4 border-t border-slate-100">
                {{ $yearFiles->links() }}
            </div>
        </section>
    </div>

    {{-- MODAL CREATE --}}
    @if($openCreate)
    <div class="fixed inset-0 z-[60]">
        <div class="absolute inset-0 bg-slate-900/30" wire:click.prevent="$set('openCreate', false)"></div>

        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-lg bg-white rounded-xl border border-slate-200 shadow-2xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-slate-200">
                    <div class="text-sm font-extrabold text-slate-800">Tambah Tahun Baru</div>
                    <button type="button" class="h-9 w-9 rounded-lg hover:bg-slate-50 grid place-items-center" wire:click.prevent="$set('openCreate', false)">✕</button>
                </div>

                <form wire:submit.prevent="store">
                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 items-start gap-3">
                            <label class="text-sm text-slate-700 pt-2">Tahun Takwim <span class="text-red-500">*</span></label>
                            <div class="sm:col-span-2">
                                <input
                                    type="number"
                                    wire:model="year"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-950/15 @error('year') border-red-500 @enderror"
                                    placeholder="2026"
                                    min="1900"
                                    max="2100"
                                />
                                @error('year')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 items-start gap-3">
                            <label class="text-sm text-slate-700 pt-2">Status <span class="text-red-500">*</span></label>
                            <div class="sm:col-span-2">
                                <select
                                    wire:model="status"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-950/15 @error('status') border-red-500 @enderror"
                                >
                                    <option value="active">Active</option>
                                    <option value="locked">Locked</option>
                                    <option value="revise">Revise</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="text-[12px] text-slate-500">
                            <span class="text-red-500">*</span> Field wajib diisi
                        </div>
                    </div>

                    <div class="px-5 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-2">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-950 text-white hover:bg-blue-900 text-sm font-semibold disabled:opacity-50"
                        >
                            <span wire:loading.remove wire:target="store">💾 Simpan</span>
                            <span wire:loading wire:target="store">⏳ Menyimpan...</span>
                        </button>
                        <button
                            type="button"
                            wire:click.prevent="$set('openCreate', false)"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 hover:bg-slate-50 text-sm font-semibold"
                        >
                            ✖ Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL EDIT --}}
    @if($openEdit)
    <div class="fixed inset-0 z-[60]">
        <div class="absolute inset-0 bg-slate-900/30" wire:click.prevent="$set('openEdit', false)"></div>

        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-lg bg-white rounded-xl border border-slate-200 shadow-2xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-slate-200">
                    <div class="text-sm font-extrabold text-slate-800">Edit Tahun</div>
                    <button type="button" class="h-9 w-9 rounded-lg hover:bg-slate-50 grid place-items-center" wire:click.prevent="$set('openEdit', false)">✕</button>
                </div>

                <form wire:submit.prevent="update">
                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-3 items-start gap-3">
                            <label class="text-sm text-slate-700 pt-2">Tahun Takwim <span class="text-red-500">*</span></label>
                            <div class="sm:col-span-2">
                                <input
                                    type="number"
                                    wire:model="year"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-950/15 @error('year') border-red-500 @enderror"
                                    placeholder="2026"
                                    min="1900"
                                    max="2100"
                                />
                                @error('year')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 items-start gap-3">
                            <label class="text-sm text-slate-700 pt-2">Status <span class="text-red-500">*</span></label>
                            <div class="sm:col-span-2">
                                <select
                                    wire:model="status"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-950/15 @error('status') border-red-500 @enderror"
                                >
                                    <option value="active">Active</option>
                                    <option value="locked">Locked</option>
                                    <option value="revise">Revise</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if($status === 'locked')
                        <div class="grid grid-cols-1 sm:grid-cols-3 items-start gap-3">
                            <label class="text-sm text-slate-700 pt-2">Tanggal Lock</label>
                            <div class="sm:col-span-2">
                                <input
                                    type="date"
                                    wire:model="locked_at"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-950/15 @error('locked_at') border-red-500 @enderror"
                                />
                                @error('locked_at')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="text-[12px] text-slate-500">
                            <span class="text-red-500">*</span> Field wajib diisi
                        </div>
                    </div>

                    <div class="px-5 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-2">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-blue-950 text-white hover:bg-blue-900 text-sm font-semibold disabled:opacity-50"
                        >
                            <span wire:loading.remove wire:target="update">💾 Update</span>
                            <span wire:loading wire:target="update">⏳ Mengupdate...</span>
                        </button>
                        <button
                            type="button"
                            wire:click.prevent="$set('openEdit', false)"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 hover:bg-slate-50 text-sm font-semibold"
                        >
                            ✖ Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- MODAL DELETE CONFIRMATION --}}
    @if($openDelete)
    <div class="fixed inset-0 z-[60]">
        <div class="absolute inset-0 bg-slate-900/30" wire:click.prevent="$set('openDelete', false)"></div>

        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="w-full max-w-md bg-white rounded-xl border border-slate-200 shadow-2xl overflow-hidden">
                <div class="px-5 py-4 flex items-center justify-between border-b border-slate-200">
                    <div class="text-sm font-extrabold text-slate-800">Konfirmasi Hapus</div>
                    <button type="button" class="h-9 w-9 rounded-lg hover:bg-slate-50 grid place-items-center" wire:click.prevent="$set('openDelete', false)">✕</button>
                </div>

                <div class="p-5">
                    <div class="flex items-start gap-4">
                        <div class="h-12 w-12 rounded-full bg-red-100 flex items-center justify-center text-2xl flex-shrink-0">
                            ⚠️
                        </div>
                        <div class="flex-1">
                            <h3 class="text-base font-bold text-slate-900">Hapus Data Tahun?</h3>
                            <p class="mt-2 text-sm text-slate-600">
                                Apakah Anda yakin ingin menghapus data tahun ini? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="px-5 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-2">
                    <button
                        type="button"
                        wire:click.prevent="delete"
                        wire:loading.attr="disabled"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-red-600 text-white hover:bg-red-700 text-sm font-semibold disabled:opacity-50"
                    >
                        <span wire:loading.remove wire:target="delete">🗑 Hapus</span>
                        <span wire:loading wire:target="delete">⏳ Menghapus...</span>
                    </button>
                    <button
                        type="button"
                        wire:click.prevent="$set('openDelete', false)"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md border border-slate-200 hover:bg-slate-50 text-sm font-semibold"
                    >
                        ✖ Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>