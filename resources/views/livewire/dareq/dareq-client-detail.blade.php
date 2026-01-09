{{-- Alpine (hapus jika sudah include global) --}}
<script src="//unpkg.com/alpinejs" defer></script>

<div class="mt-6" x-data="dataRequestTable()">

    {{-- BACK BUTTON (KIRI ATAS) --}}
    <div class="mb-3">
        <a href="{{ route('dareq.dareq-client-index') }}"
           class="inline-flex items-center gap-2 rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
    </div>

    <h2 class="text-2xl font-normal text-gray-900">Data Request</h2>

    <div class="mt-4 overflow-x-auto">
        <table class="min-w-[1100px] w-full text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-14">No</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-56">Cycle</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-24">Detail</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-52">Auditor Incharge</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-52">Client Incharge</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-52">Total Item Request</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-52">Total Item Received</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-16">%</th>
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-40">Action</th>
                </tr>
            </thead>

            <tbody>
                <template x-for="(r, idx) in rows" :key="r.id">
                    <tr :class="idx % 2 === 0 ? 'bg-white' : 'bg-gray-200'">
                        <td class="px-4 py-2" x-text="idx + 1"></td>
                        <td class="px-4 py-2" x-text="r.cycle"></td>
                        <td class="px-4 py-2">
                            <a href="{{ route('dareq.dareq-client-detail-cycle') }}" class="text-blue-700 hover:underline">View</a>
                        </td>
                        <td class="px-4 py-2" x-text="r.auditor_incharge"></td>
                        <td class="px-4 py-2" x-text="r.client_incharge"></td>
                        <td class="px-4 py-2" x-text="r.total_request"></td>
                        <td class="px-4 py-2" x-text="r.total_received"></td>
                        <td class="px-4 py-2" x-text="percent(r.total_received, r.total_request) + '%'"></td>
                        <td class="px-4 py-2">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button"
                                        @click="openEdit(r)"
                                        class="inline-flex h-6 items-center justify-center rounded bg-blue-600 px-4 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                    Edit
                                </button>
                                <button type="button"
                                        @click="openDelete(r)"
                                        class="inline-flex h-6 items-center justify-center rounded bg-blue-600 px-4 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>

                <tr class="bg-white" x-show="rows.length === 0">
                    <td class="px-4 py-6 text-center text-gray-600" colspan="9">
                        Belum ada data.
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- ADD ROW BUTTON --}}
        <div class="mt-6 flex justify-end">
            <button type="button"
                    @click="openAdd()"
                    class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                Add Row
            </button>
        </div>
    </div>

    {{-- ============ ADD / EDIT MODAL (REUSE) ============ --}}
    <div x-show="modalForm"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         aria-modal="true"
         role="dialog"
         @keydown.escape.window="closeForm()"
    >
        {{-- overlay --}}
        <div class="absolute inset-0 bg-black/40" @click="closeForm()"></div>

        {{-- modal box --}}
        <div class="relative w-full max-w-2xl rounded-xl bg-white shadow-xl ring-1 ring-black/10">
            <div class="flex items-start justify-between gap-4 border-b border-gray-200 px-6 py-4">
                <div>
                    <p class="text-base font-semibold text-gray-900" x-text="formMode === 'add' ? 'Add Row' : 'Edit Row'"></p>
                    <p class="mt-1 text-xs text-gray-500" x-text="formMode === 'add'
                        ? 'Tambah cycle baru untuk data request (dummy).'
                        : 'Ubah data cycle yang sudah ada (dummy).'">
                    </p>
                </div>
                <button type="button"
                        @click="closeForm()"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-300">
                    Close
                </button>
            </div>

            <div class="px-6 py-4">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Cycle</label>
                        <input type="text"
                               x-model="form.cycle"
                               placeholder="Contoh: Revenue, Purchase, Payroll, General (default)"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:border-gray-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Auditor Incharge</label>
                        <input type="text"
                               x-model="form.auditor_incharge"
                               placeholder="Contoh: All / Naufal / Rani"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:border-gray-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Client Incharge</label>
                        <input type="text"
                               x-model="form.client_incharge"
                               placeholder="Contoh: Bpk/Ibu PIC"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:border-gray-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Total Item Request</label>
                        <input type="number"
                               min="0"
                               x-model.number="form.total_request"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-gray-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Total Item Received</label>
                        <input type="number"
                               min="0"
                               x-model.number="form.total_received"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-gray-400 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2 rounded-md bg-gray-100 px-4 py-3">
                        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-sm text-gray-700">
                                Progress:
                                <span class="font-semibold text-gray-900"
                                      x-text="percent(form.total_received, form.total_request) + '%'"></span>
                            </p>

                            <div class="w-full sm:w-2/3">
                                <div class="h-2 w-full rounded-full bg-gray-200">
                                    <div class="h-2 rounded-full bg-blue-600"
                                         :style="'width:' + percent(form.total_received, form.total_request) + '%'"></div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">
                                    Tip: Total received tidak boleh melebihi total request (dummy validation).
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-1 block text-xs font-semibold text-gray-900">Detail URL (optional)</label>
                        <input type="text"
                               x-model="form.detail_url"
                               placeholder="Contoh: /data-request/123"
                               class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:border-gray-400 focus:outline-none">
                    </div>
                </div>

                <div class="mt-5 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <button type="button"
                            @click="closeForm()"
                            class="rounded-md bg-gray-200 px-5 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                        Cancel
                    </button>

                    <button type="button"
                            @click="submitForm()"
                            class="rounded-md bg-blue-600 px-5 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                        Save
                    </button>
                </div>

                <p class="mt-3 text-xs text-gray-500">
                    *Ini masih dummy (frontend). Nanti tinggal mapping ke Livewire action / store DB.
                </p>
            </div>
        </div>
    </div>

    {{-- ============ DELETE CONFIRM MODAL ============ --}}
    <div x-show="modalDelete"
         x-transition
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         aria-modal="true"
         role="dialog"
         @keydown.escape.window="closeDelete()"
    >
        <div class="absolute inset-0 bg-black/40" @click="closeDelete()"></div>

        <div class="relative w-full max-w-lg rounded-xl bg-white shadow-xl ring-1 ring-black/10">
            <div class="border-b border-gray-200 px-6 py-4">
                <p class="text-base font-semibold text-gray-900">Delete Row</p>
                <p class="mt-1 text-xs text-gray-500">
                    Yakin ingin menghapus row:
                    <span class="font-semibold text-gray-900" x-text="targetDelete?.cycle ?? '-'"></span>?
                </p>
            </div>

            <div class="px-6 py-4">
                <div class="rounded-md bg-gray-100 px-4 py-3 text-sm text-gray-700">
                    Aksi ini dummy. Untuk real delete, hubungkan ke Livewire / endpoint delete.
                </div>

                <div class="mt-5 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <button type="button"
                            @click="closeDelete()"
                            class="rounded-md bg-gray-200 px-5 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                        Cancel
                    </button>

                    <button type="button"
                            @click="confirmDelete()"
                            class="rounded-md bg-blue-600 px-5 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function dataRequestTable() {
    return {
        // dummy initial rows
        rows: [
            { id: 1, cycle: 'General (default)', detail_url: '#', auditor_incharge: 'All', client_incharge: '', total_request: 0, total_received: 0 },
            { id: 2, cycle: ':autocreated:',      detail_url: '#', auditor_incharge: ':automapping:', client_incharge: '', total_request: 0, total_received: 0 },
            { id: 3, cycle: ':autocreated:',      detail_url: '#', auditor_incharge: ':automapping:', client_incharge: '', total_request: 0, total_received: 0 },
            { id: 4, cycle: ':autocreated:',      detail_url: '#', auditor_incharge: ':automapping:', client_incharge: '', total_request: 0, total_received: 0 },
        ],

        // modal states
        modalForm: false,
        formMode: 'add',     // add | edit
        editingId: null,     // row id when edit

        modalDelete: false,
        targetDelete: null,

        // form model
        form: {
            cycle: '',
            auditor_incharge: 'All',
            client_incharge: '',
            total_request: 0,
            total_received: 0,
            detail_url: '#'
        },

        // helpers
        percent(received, request) {
            const r = Number(received || 0);
            const q = Number(request || 0);
            if (!q || q <= 0) return 0;
            return Math.max(0, Math.min(100, Math.round((r / q) * 100)));
        },

        // open add
        openAdd() {
            this.formMode = 'add';
            this.editingId = null;
            this.form = {
                cycle: '',
                auditor_incharge: 'All',
                client_incharge: '',
                total_request: 0,
                total_received: 0,
                detail_url: '#'
            };
            this.modalForm = true;
        },

        // open edit
        openEdit(row) {
            this.formMode = 'edit';
            this.editingId = row.id;

            // clone to avoid direct mutation before save
            this.form = {
                cycle: row.cycle ?? '',
                auditor_incharge: row.auditor_incharge ?? 'All',
                client_incharge: row.client_incharge ?? '',
                total_request: Number(row.total_request ?? 0),
                total_received: Number(row.total_received ?? 0),
                detail_url: row.detail_url ?? '#'
            };

            this.modalForm = true;
        },

        // close form
        closeForm() {
            this.modalForm = false;
        },

        // submit (add or edit)
        submitForm() {
            // basic validation
            if (!this.form.cycle || this.form.cycle.trim().length < 2) {
                alert('Cycle wajib diisi.');
                return;
            }
            if (Number(this.form.total_received) > Number(this.form.total_request)) {
                alert('Total received tidak boleh lebih besar dari total request.');
                return;
            }

            if (this.formMode === 'add') {
                const nextId = this.rows.length ? Math.max(...this.rows.map(x => x.id)) + 1 : 1;
                this.rows.push({
                    id: nextId,
                    cycle: this.form.cycle.trim(),
                    detail_url: (this.form.detail_url || '#').trim(),
                    auditor_incharge: (this.form.auditor_incharge || 'All').trim(),
                    client_incharge: (this.form.client_incharge || '').trim(),
                    total_request: Number(this.form.total_request || 0),
                    total_received: Number(this.form.total_received || 0),
                });
            } else {
                const idx = this.rows.findIndex(r => r.id === this.editingId);
                if (idx !== -1) {
                    this.rows[idx] = {
                        ...this.rows[idx],
                        cycle: this.form.cycle.trim(),
                        detail_url: (this.form.detail_url || '#').trim(),
                        auditor_incharge: (this.form.auditor_incharge || 'All').trim(),
                        client_incharge: (this.form.client_incharge || '').trim(),
                        total_request: Number(this.form.total_request || 0),
                        total_received: Number(this.form.total_received || 0),
                    };
                }
            }

            this.closeForm();
        },

        // delete flow
        openDelete(row) {
            this.targetDelete = row;
            this.modalDelete = true;
        },
        closeDelete() {
            this.modalDelete = false;
            this.targetDelete = null;
        },
        confirmDelete() {
            if (!this.targetDelete) return;
            this.rows = this.rows.filter(r => r.id !== this.targetDelete.id);
            this.closeDelete();
        }
    }
}
</script>