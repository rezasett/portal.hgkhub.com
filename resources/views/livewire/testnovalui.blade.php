{{-- resources/views/livewire/data-request.blade.php --}}
<div
    x-data="uiShell()"
    x-init="boot()"
    class="min-h-screen bg-slate-100 text-slate-900"
>
    <div class="min-h-screen flex">

        {{-- MOBILE SIDEBAR --}}
        <div class="lg:hidden" x-cloak>
            <div class="fixed inset-0 z-40" x-show="mobileNavOpen">
                <div class="absolute inset-0 bg-slate-900/50" @click="mobileNavOpen=false"></div>

                <aside class="absolute left-0 top-0 h-full w-72 bg-blue-950 text-white shadow-2xl">
                    <div class="px-4 py-4 border-b border-white/10 flex items-center justify-between">
                        <div class="text-sm font-extrabold tracking-wide">HGK MEMO</div>
                        <button class="w-9 h-9 rounded-full bg-white/10 hover:bg-white/15" @click="mobileNavOpen=false">✕</button>
                    </div>

                    <nav class="px-3 py-4 text-sm space-y-1">
                        <a href="#" class="block px-3 py-2 rounded-xl hover:bg-white/10">Auditor Dashboard</a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/10"><span>Pre Engagement</span><span>›</span></a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/10"><span>Risk Assessment</span><span>›</span></a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/10"><span>Risk Responses</span><span>›</span></a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/10"><span>Completing & Reporting</span><span>›</span></a>
                        <a href="#" class="flex items-center justify-between px-3 py-2 rounded-xl hover:bg-white/10"><span>System Setting</span><span>›</span></a>
                    </nav>
                </aside>
            </div>
        </div>

        {{-- MAIN --}}
        <main class="flex-1 min-w-0">

            {{-- TOP BAR --}}
            <header class="sticky top-0 z-20 bg-white/80 backdrop-blur border-b border-slate-200">
                <div class="px-3 sm:px-6 py-3 flex items-center gap-3 justify-between">
                    <div class="flex items-center gap-3 min-w-0">
                        <button
                            class="lg:hidden w-10 h-10 rounded-xl border border-slate-200 hover:bg-slate-50"
                            @click="mobileNavOpen=true"
                            aria-label="Open menu"
                        >☰</button>

                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-9 h-9 rounded-2xl bg-blue-950 text-white flex items-center justify-center text-xs font-bold">HG</div>
                            <div class="min-w-0">
                                <div class="text-sm font-semibold truncate">HGK Audit • Data Request</div>
                                <div class="text-[11px] text-slate-500 truncate">
                                    Workspace • Kantor Akuntan Publik Hertanto Grace Karunawan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-semibold">
                            Export <span>▾</span>
                        </button>

                        <button class="hidden sm:inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900">
                            Upload document
                        </button>

                        <div class="flex items-center gap-2 pl-1">
                            <div class="w-9 h-9 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center text-xs font-bold">KA</div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- PAGE --}}
            <div class="px-3 sm:px-6 py-5">

                {{-- TITLE --}}
                <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                    <div>
                        <div class="text-lg sm:text-xl font-bold">Data Request</div>
                        <div class="text-[11px] text-slate-500">
                            Last updated: 24 Dec 2025, 10:56 (GMT+7)
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-semibold"
                            @click="filtersOpen = !filtersOpen"
                        >
                            <span x-text="filtersOpen ? 'Hide filters' : 'Show filters'"></span>
                            <span x-text="filtersOpen ? '▴' : '▾'"></span>
                        </button>

                        <button
                            class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                            @click="formOpen = !formOpen"
                        >
                            <span x-text="formOpen ? 'Close form' : 'Edit header'"></span>
                        </button>
                    </div>
                </div>

                {{-- KPI --}}
                <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <div class="bg-white border border-slate-200 rounded-2xl p-4">
                        <div class="text-xl font-extrabold" x-text="stats.requested"></div>
                        <div class="text-[11px] text-slate-500">Requested</div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4">
                        <div class="text-xl font-extrabold" x-text="stats.received"></div>
                        <div class="text-[11px] text-slate-500">Received</div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4">
                        <div class="text-xl font-extrabold" x-text="stats.approved"></div>
                        <div class="text-[11px] text-slate-500">Approved</div>
                    </div>
                    <div class="bg-white border border-slate-200 rounded-2xl p-4">
                        <div class="text-xl font-extrabold" x-text="stats.pending"></div>
                        <div class="text-[11px] text-slate-500">Pending</div>
                    </div>
                </div>

                {{-- FILTERS --}}
                <div class="mt-4 bg-white border border-slate-200 rounded-2xl p-4"
                     x-show="filtersOpen" x-collapse>
                    <div class="flex flex-col lg:flex-row gap-3 lg:items-center lg:justify-between">
                        <div class="flex flex-col sm:flex-row gap-2">
                            <select class="px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                                <option>All statuses</option>
                                <option>Requested</option>
                                <option>Received</option>
                                <option>Approved</option>
                            </select>

                            <select class="px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                                <option>All dates</option>
                                <option>This week</option>
                                <option>This month</option>
                            </select>

                            <button class="px-3 py-2 rounded-xl border border-slate-200 text-sm hover:bg-slate-50">
                                More filters
                            </button>
                        </div>

                        <div class="w-full lg:w-80">
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔎</span>
                                <input
                                    type="search"
                                    x-model="q"
                                    placeholder="Search item / description..."
                                    class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-sm bg-white"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- HEADER FORM --}}
                <div class="mt-4 bg-white border border-slate-200 rounded-2xl p-4"
                     x-show="formOpen" x-collapse>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Cycle</label>
                            <input x-model="meta.cycle"
                                   class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white" />
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Auditor In Charge</label>
                            <input x-model="meta.auditor"
                                   class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white" />
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-600">Client In Charge</label>
                            <input x-model="meta.client"
                                   class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white" />
                        </div>
                    </div>

                    <div class="mt-3 flex items-center justify-end gap-2">
                        <button class="px-3 py-2 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                                @click="resetMeta()">Reset</button>

                        <button class="px-4 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                                @click="toast('Header saved (demo).')">Save</button>
                    </div>
                </div>

                {{-- TABLE CARD --}}
                <div class="mt-4 bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                    <div class="p-4 border-b border-slate-100">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                            <div class="flex items-start gap-2">
                                <div class="w-20 text-slate-500">Cycle</div>
                                <div class="font-semibold" x-text="meta.cycle"></div>
                            </div>
                            <div class="flex items-start gap-2">
                                <div class="w-28 text-slate-500">Auditor In Charge</div>
                                <div class="font-semibold" x-text="meta.auditor"></div>
                            </div>
                            <div class="flex items-start gap-2">
                                <div class="w-28 text-slate-500">Client In Charge</div>
                                <div class="font-semibold" x-text="meta.client"></div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-[1100px] w-full text-sm">
                            <thead class="bg-slate-50 text-slate-600">
                            <tr class="text-xs">
                                <th class="px-4 py-3 text-left w-14">No</th>
                                <th class="px-4 py-3 text-left w-64">Item</th>
                                <th class="px-4 py-3 text-left w-[360px]">Description</th>
                                <th class="px-4 py-3 text-left w-40">Date Request</th>
                                <th class="px-4 py-3 text-left w-40">Date Received</th>
                                <th class="px-4 py-3 text-left w-40">Date Approved</th>
                                <th class="px-4 py-3 text-left w-40">Attachments</th>
                                <th class="px-4 py-3 text-left w-32">Status</th>
                                <th class="px-4 py-3 text-left w-36">Log Comment</th>
                                <th class="px-4 py-3 text-left w-36">Log Activity</th>
                                <th class="px-4 py-3 text-right w-44">Actions</th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-100">
                            <template x-for="(row, idx) in filteredRows()" :key="row.id">
                                <tr class="hover:bg-slate-50/60 align-top">
                                    <td class="px-4 py-3 text-xs text-slate-500" x-text="idx+1"></td>

                                    <td class="px-4 py-3">
                                        <div class="font-semibold" x-text="row.item"></div>
                                        <div class="mt-1 text-[11px] text-slate-500" x-text="row.tag"></div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="text-slate-700 whitespace-pre-line" x-text="row.desc"></div>
                                    </td>

                                    <td class="px-4 py-3 text-xs text-slate-600" x-text="row.date_request || '-'"></td>
                                    <td class="px-4 py-3 text-xs text-slate-600" x-text="row.date_received || '-'"></td>
                                    <td class="px-4 py-3 text-xs text-slate-600" x-text="row.date_approved || '-'"></td>

                                    {{-- Attachments: link to NEW PAGE --}}
                                    <td class="px-4 py-3">
                                        <template x-if="row.attachments && row.attachments.length">
                                            <a
                                                :href="downloadUrl(row)"
                                                class="inline-flex px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                                                target="_blank"
                                                rel="noopener"
                                            >
                                                View Downloads
                                            </a>
                                        </template>

                                        <template x-if="!(row.attachments && row.attachments.length)">
                                            <span class="text-xs text-slate-400">-</span>
                                        </template>

                                        <div class="mt-1 text-[11px] text-slate-500"
                                             x-show="row.attachments && row.attachments.length"
                                             x-text="(row.attachments?.length || 0) + ' file(s)'"></div>
                                    </td>

                                    <td class="px-4 py-3">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-semibold"
                                              :class="badgeClass(row.status)"
                                              x-text="row.status"></span>
                                    </td>

                                    <td class="px-4 py-3">
                                        <button class="text-xs font-semibold text-blue-950 hover:underline"
                                                @click="openLog('Comment', row)">view</button>
                                    </td>

                                    <td class="px-4 py-3">
                                        <button class="text-xs font-semibold text-blue-950 hover:underline"
                                                @click="openLog('Activity', row)">view</button>
                                    </td>

                                    <td class="px-4 py-3 text-right">
                                        <div class="inline-flex gap-2">
                                            {{-- Edit: modal --}}
                                            <button
                                                class="px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                                                @click="editRow(row)"
                                            >
                                                Edit
                                            </button>

                                            {{-- Delete --}}
                                            <button
                                                class="px-3 py-1.5 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                                                @click="confirmDelete(row)"
                                            >
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>

                            <template x-if="filteredRows().length === 0">
                                <tr>
                                    <td colspan="11" class="px-4 py-10 text-center text-sm text-slate-500">
                                        No data found.
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-slate-100 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between">
                        <div class="text-xs text-slate-500">
                            Rows: <span class="font-semibold" x-text="rows.length"></span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                            <button class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                                    @click="addRow()">+ Add Row</button>

                            <button class="px-4 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                                    @click="toast('Saved (demo).')">Save</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    {{-- MODAL (EDIT + LOG + DELETE CONFIRM) --}}
    <div x-cloak x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/55" @click="closeModal()"></div>

        <div class="relative w-full max-w-2xl bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-start justify-between gap-3">
                <div>
                    <div class="text-sm font-bold" x-text="modalTitle"></div>
                    <div class="text-[11px] text-slate-500" x-text="modalSub"></div>
                </div>
                <button class="w-9 h-9 rounded-full border border-slate-200 hover:bg-slate-50"
                        @click="closeModal()">✕</button>
            </div>

            {{-- EDIT --}}
            <div class="p-5" x-show="modalMode==='edit'" x-transition>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="sm:col-span-2">
                        <label class="text-xs font-semibold text-slate-600">Item</label>
                        <input x-model="draft.item"
                               class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-xs font-semibold text-slate-600">Description</label>
                        <textarea x-model="draft.desc" rows="3"
                                  class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white"></textarea>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600">Status</label>
                        <select x-model="draft.status"
                                class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                            <option>Requested</option>
                            <option>Received</option>
                            <option>Approved</option>
                            <option>Pending</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600">Tag</label>
                        <input x-model="draft.tag" placeholder="e.g. Default / PBC"
                               class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600">Date Request</label>
                        <input x-model="draft.date_request" placeholder="timestamp"
                               class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-600">Date Received</label>
                        <input x-model="draft.date_received" placeholder="timestamp"
                               class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-slate-600">Date Approved</label>
                        <input x-model="draft.date_approved" placeholder="timestamp"
                               class="mt-1 w-full px-3 py-2 rounded-xl border border-slate-200 text-sm bg-white">
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-end gap-2">
                    <button class="px-3 py-2 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                            @click="closeModal()">Cancel</button>
                    <button class="px-4 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                            @click="saveRow()">Save changes</button>
                </div>
            </div>

            {{-- LOG --}}
            <div class="p-5" x-show="modalMode==='log'" x-transition>
                <div class="text-sm text-slate-700 whitespace-pre-line" x-text="logText"></div>
                <div class="mt-4 flex items-center justify-end">
                    <button class="px-4 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                            @click="closeModal()">Close</button>
                </div>
            </div>

            {{-- DELETE CONFIRM --}}
            <div class="p-5" x-show="modalMode==='delete'" x-transition>
                <div class="text-sm text-slate-700">
                    Anda yakin ingin menghapus item ini?
                </div>

                <div class="mt-2 text-[12px] text-slate-500">
                    <span class="font-semibold" x-text="modalSub"></span>
                </div>

                <div class="mt-5 flex items-center justify-end gap-2">
                    <button class="px-3 py-2 rounded-xl border border-slate-200 text-xs font-semibold hover:bg-slate-50"
                            @click="closeModal()">Cancel</button>

                    <button class="px-4 py-2 rounded-xl bg-blue-950 text-white text-xs font-semibold hover:bg-blue-900"
                            @click="deleteRowConfirmed()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TOAST --}}
    <div x-cloak class="fixed bottom-4 right-4 z-50" x-show="toastOpen" x-transition>
        <div class="px-4 py-3 rounded-2xl shadow-lg bg-blue-950 text-white text-sm">
            <span x-text="toastMsg"></span>
        </div>
    </div>

    <script>
        function uiShell(){
            return {
                mobileNavOpen: false,
                filtersOpen: true,
                formOpen: false,
                q: '',

                boot(){},

                meta: { cycle:'2025 • Year-end Audit', auditor:'autofilled', client:'autofilled' },
                resetMeta(){
                    this.meta = { cycle:'2025 • Year-end Audit', auditor:'autofilled', client:'autofilled' };
                    this.toast('Header reset (demo).');
                },

                rows: [
                    { id: 1, item:'Trial Balance (Default)', tag:'PBC', desc:'Please provide final TB and mapping as at reporting date.', date_request:'timestamp', date_received:'-', date_approved:'-', attachments:[], status:'Requested', comment:'-', activity:'Created by Auditor' },
                    { id: 2, item:'GL Detail', tag:'PBC', desc:'General ledger detail for the whole period (excel).', date_request:'timestamp', date_received:'timestamp', date_approved:'-', attachments:[{name:'GL.xlsx'},{name:'Mapping.xlsx'}], status:'Received', comment:'Client uploaded file', activity:'Received by Auditor' },
                    { id: 3, item:'Bank Confirmation', tag:'External', desc:'List of bank accounts + authorization letter.', date_request:'timestamp', date_received:'-', date_approved:'-', attachments:[], status:'Pending', comment:'Waiting sign', activity:'Pending' },
                    { id: 4, item:'Reconciliation Schedule', tag:'PBC', desc:'AR/AP reconciliation and supporting schedules.', date_request:'timestamp', date_received:'timestamp', date_approved:'timestamp', attachments:[{name:'Reconcile.pdf'}], status:'Approved', comment:'Reviewed by Manager', activity:'Approved' },
                ],

                get stats(){
                    const s = { requested:0, received:0, approved:0, pending:0 };
                    this.rows.forEach(r => {
                        const k = (r.status || '').toLowerCase();
                        if(k === 'requested') s.requested++;
                        else if(k === 'received') s.received++;
                        else if(k === 'approved') s.approved++;
                        else s.pending++;
                    });
                    return s;
                },

                filteredRows(){
                    const q = (this.q || '').toLowerCase().trim();
                    if(!q) return this.rows;
                    return this.rows.filter(r =>
                        (r.item||'').toLowerCase().includes(q) ||
                        (r.desc||'').toLowerCase().includes(q) ||
                        (r.status||'').toLowerCase().includes(q)
                    );
                },

                badgeClass(status){
                    const s = (status||'').toLowerCase();
                    if(s === 'approved') return 'bg-emerald-100 text-emerald-700';
                    if(s === 'received') return 'bg-sky-100 text-sky-700';
                    if(s === 'requested') return 'bg-amber-100 text-amber-800';
                    return 'bg-slate-100 text-slate-700';
                },

                downloadUrl(row){
                    return `/data-request/${row.id}/downloads`;
                },

                modalOpen:false,
                modalMode:'edit',
                modalTitle:'',
                modalSub:'',
                editId:null,
                draft:{},
                logText:'',

                addRow(){
                    const id = Date.now();
                    this.rows.unshift({ id, item:'New Item', tag:'PBC', desc:'', date_request:'timestamp', date_received:'', date_approved:'', attachments:[], status:'Requested', comment:'', activity:'Created' });
                    this.toast('Row added (demo).');
                },

                editRow(row){
                    this.modalOpen = true;
                    this.modalMode = 'edit';
                    this.modalTitle = 'Edit data request';
                    this.modalSub = row.item;
                    this.editId = row.id;
                    this.draft = JSON.parse(JSON.stringify(row));
                },
                saveRow(){
                    const idx = this.rows.findIndex(r => r.id === this.editId);
                    if(idx >= 0){
                        this.rows[idx] = { ...this.rows[idx], ...this.draft };
                        this.toast('Row updated (demo).');
                    }
                    this.closeModal();
                },

                deleteId: null,
                confirmDelete(row){
                    this.modalOpen = true;
                    this.modalMode = 'delete';
                    this.modalTitle = 'Delete data request';
                    this.modalSub = row.item;
                    this.deleteId = row.id;
                },
                deleteRowConfirmed(){
                    const idx = this.rows.findIndex(r => r.id === this.deleteId);
                    if(idx >= 0){
                        this.rows.splice(idx, 1);
                        this.toast('Row deleted (demo).');
                    }
                    this.closeModal();
                },

                openLog(type, row){
                    this.modalOpen = true;
                    this.modalMode = 'log';
                    this.modalTitle = `Log ${type}`;
                    this.modalSub = row.item;
                    this.logText = (type === 'Comment') ? (row.comment || 'No comments.') : (row.activity || 'No activity.');
                },

                closeModal(){
                    this.modalOpen = false;
                    this.editId = null;
                    this.deleteId = null;
                    this.draft = {};
                    this.logText = '';
                },

                toastOpen:false,
                toastMsg:'',
                toast(msg){
                    this.toastMsg = msg;
                    this.toastOpen = true;
                    clearTimeout(this._t);
                    this._t = setTimeout(() => this.toastOpen = false, 1800);
                },
            }
        }
    </script>
</div>