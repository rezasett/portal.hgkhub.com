@php
    $engagement = [
        'name' => 'Audit Laporan Keuangan 2025',
        'client' => 'PT Sample A',
        'fiscal_year' => 2025,
        'target_date' => '2026-02-15',
        'info_date' => now()->format('d M Y'),
    ];

    $assignedAuditors = [
        ['id'=>11,'name'=>'Naufal','role'=>'Senior Auditor','phone'=>'6281111111111','tasks'=>['Lead fieldwork','Review working paper','Wrap-up discussion']],
        ['id'=>12,'name'=>'Rani','role'=>'Auditor','phone'=>'6282222222222','tasks'=>['Testing AR','Bank reconciliation','Subsequent receipt testing']],
        ['id'=>13,'name'=>'Dimas','role'=>'Auditor','phone'=>'6283333333333','tasks'=>['Inventory count','Cut-off test','COGS reasonableness']],
        ['id'=>14,'name'=>'Salsa','role'=>'Auditor','phone'=>'6284444444444','tasks'=>['Cash & bank testing','Confirmation follow-up']],
        ['id'=>15,'name'=>'Bayu','role'=>'Junior Auditor','phone'=>'6285555555555','tasks'=>['Vouching expense','Tickmark & indexing']],
        ['id'=>16,'name'=>'Tina','role'=>'Junior Auditor','phone'=>'6286666666666','tasks'=>['Scanning evidence','File naming & upload']],
    ];
@endphp

<div x-data="waNotifyBlade()" x-init="init()" class="mt-6 space-y-4">

    {{-- HEADER --}}
    <div class="rounded-lg border border-gray-200 bg-white p-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
            <div class="min-w-0">
                <h2 class="text-base font-semibold text-gray-900">Notifikasi Penugasan Auditor (WA Web • tanpa API)</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Engagement:
                    <span class="font-semibold text-gray-900" x-text="engagement.name"></span>
                    <span class="mx-2 text-gray-300">•</span>
                    Client:
                    <span class="font-semibold text-gray-900" x-text="engagement.client"></span>
                    <span class="mx-2 text-gray-300">•</span>
                    Tahun buku:
                    <span class="font-semibold text-gray-900" x-text="engagement.fiscal_year"></span>
                </p>
                <p class="mt-1 text-sm text-gray-600">
                    Target:
                    <span class="font-semibold text-gray-900" x-text="engagement.target_date"></span>
                    <span class="mx-2 text-gray-300">•</span>
                    Tanggal info:
                    <span class="font-semibold text-gray-900" x-text="engagement.info_date"></span>
                </p>

                <div class="mt-3 rounded-md border border-gray-200 bg-gray-50 p-3 text-xs text-gray-700">
                    <div class="font-semibold text-gray-900">Catatan penting (browser):</div>
                    <ul class="mt-1 list-disc pl-5 space-y-0.5">
                        <li>Tanpa WhatsApp API, sistem hanya membuka tab WA dengan pesan siap kirim. Kamu tetap klik <b>Send</b> manual.</li>
                        <li>Kalau tab masih cuma 1, berarti popup diblok. Aktifkan “Allow pop-ups” untuk domain ini.</li>
                    </ul>
                </div>
            </div>

            {{-- ACTION TOP --}}
            <div class="flex flex-wrap gap-2">
                <button
                    type="button"
                    @click="toggleAll(true)"
                    class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                >
                    Select All
                </button>

                <button
                    type="button"
                    @click="toggleAll(false)"
                    class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                >
                    Clear
                </button>

                <button
                    type="button"
                    @click="resetAllMessages()"
                    class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                >
                    Reset Template All
                </button>

                <button
                    type="button"
                    @click="openTabsSelectedPreopen()"
                    class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                >
                    Send Selected (Open Tabs)
                </button>

                <button
                    type="button"
                    @click="openTabsAllPreopen()"
                    class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                >
                    Send to All (Open 6 Tabs)
                </button>
            </div>
        </div>

        <div class="mt-2 text-xs text-gray-500">
            Batch size:
            <span class="font-semibold text-gray-700" x-text="maxTabsPerClick"></span>
            <span class="mx-2 text-gray-300">•</span>
            Next batch starts at:
            <span class="font-semibold text-gray-700" x-text="batchIndex + 1"></span>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="rounded-lg border border-gray-200 bg-white p-4">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-900">Daftar Auditor Ditugaskan</h3>
            <p class="text-xs text-gray-500"><span x-text="auditors.length"></span> orang</p>
        </div>

        <div class="mt-3 overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 w-10 text-left"></th>
                        <th class="px-4 py-2 w-12 text-left">No</th>
                        <th class="px-4 py-2 w-56 text-left">Auditor</th>
                        <th class="px-4 py-2 w-40 text-left">No. WA</th>
                        <th class="px-4 py-2 text-left">Pesan (Auto-load dari tugas, editable)</th>
                        <th class="px-4 py-2 w-44 text-left">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <template x-for="(a, idx) in auditors" :key="a.id">
                        <tr :class="idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
                            <td class="px-3 py-2 align-top">
                                <input type="checkbox" x-model="a.selected"
                                    class="mt-1 h-4 w-4 rounded border-gray-300 text-gray-900">
                            </td>

                            <td class="px-4 py-2 align-top" x-text="idx + 1"></td>

                            <td class="px-4 py-2 align-top">
                                <p class="font-semibold text-gray-900" x-text="a.name"></p>
                                <p class="text-xs text-gray-600" x-text="a.role"></p>

                                <div class="mt-2">
                                    <p class="text-xs font-semibold text-gray-900">Scope/Tugas:</p>
                                    <ul class="mt-1 list-disc pl-5 text-xs text-gray-700 space-y-0.5">
                                        <template x-for="(t, ti) in a.tasks" :key="ti">
                                            <li x-text="t"></li>
                                        </template>
                                    </ul>
                                </div>

                                <div class="mt-2 text-[11px] text-gray-500">
                                    Status:
                                    <span class="font-semibold"
                                          :class="a.status === 'Blocked' ? 'text-red-700' : 'text-gray-700'"
                                          x-text="a.status || '-'"></span>
                                </div>
                            </td>

                            <td class="px-4 py-2 align-top">
                                <span class="text-gray-900" x-text="a.phone"></span>
                                <p class="mt-1 text-[11px] text-gray-500">Format 62xxxxxxxxxx</p>
                            </td>

                            <td class="px-4 py-2 align-top">
                                <textarea
                                    x-model="a.message"
                                    rows="8"
                                    class="w-full min-w-[420px] rounded border border-gray-300 bg-white px-3 py-2 text-xs text-gray-900 focus:border-gray-400 focus:outline-none"
                                ></textarea>

                                <div class="mt-2 flex items-center justify-between">
                                    <p class="text-[11px] text-gray-500">
                                        <span class="font-semibold" x-text="(a.message || '').length"></span> chars
                                    </p>
                                    <button
                                        type="button"
                                        @click="resetMessage(a)"
                                        class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1 text-[11px] font-medium text-gray-700 hover:bg-gray-100"
                                    >
                                        Reset
                                    </button>
                                </div>
                            </td>

                            <td class="px-4 py-2 align-top">
                                <div class="flex gap-2">
                                    <a
                                        :href="waUrlFrom(a)"
                                        target="_blank"
                                        @click="markOpened(a)"
                                        class="inline-flex items-center rounded border border-green-600 bg-green-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-700"
                                        :class="(!sanitizePhone(a.phone) || !(a.message && a.message.trim().length) ? 'opacity-50 pointer-events-none' : '')"
                                    >
                                        Send
                                    </a>

                                    <button
                                        type="button"
                                        @click="copy(a)"
                                        class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                                        :class="(!(a.message && a.message.trim().length) ? 'opacity-50 pointer-events-none' : '')"
                                    >
                                        Copy
                                    </button>
                                </div>

                                <p class="mt-2 text-[11px] text-gray-500">
                                    Send membuka WA tab baru (pesan siap kirim).
                                </p>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function waNotifyBlade() {
        return {
            engagement: @js($engagement),
            auditors: @js($assignedAuditors),

            // ✅ set 6 supaya 6 tab (sesuai request)
            maxTabsPerClick: 6,
            batchIndex: 0,

            init() {
                this.auditors = this.auditors.map(a => ({
                    ...a,
                    selected: true,
                    status: '',
                    message: this.buildMessage(a),
                }));
            },

            sanitizePhone(phone) {
                return (phone || '').toString().replace(/[^0-9]/g, '');
            },

            buildMessage(a) {
                const tasks = (a.tasks || []).map((t, i) => `${i + 1}. ${t}`).join('\n');

                const lines = [];
                lines.push(`Halo ${a.name},`);
                lines.push('');
                lines.push(`Kamu ditugaskan pada *${this.engagement.name}*.`);
                lines.push(`Client: *${this.engagement.client}* • Tahun buku: *${this.engagement.fiscal_year}*`);
                lines.push(`Target: ${this.engagement.target_date}`);
                lines.push(`Info: ${this.engagement.info_date}`);
                lines.push('');

                if ((tasks || '').trim().length) {
                    lines.push('*Scope/Tugas:*');
                    lines.push(tasks);
                    lines.push('');
                }

                lines.push('Mohon konfirmasi penerimaan tugas & mulai persiapan working paper ya.');
                lines.push('');
                lines.push('Terima kasih.');
                lines.push('- PM/Tim Audit');

                return lines.join('\n');
            },

            waUrlFrom(a) {
                const phone = this.sanitizePhone(a.phone);
                const msg = (a.message || '').trim();
                if (!phone || !msg.length) return '#';
                return `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;
            },

            markOpened(a) {
                a.status = 'Opened';
            },

            copy(a) {
                const msg = (a.message || '').trim();
                if (!msg.length) return;
                navigator.clipboard.writeText(msg);
                a.status = 'Copied';
            },

            resetMessage(a) {
                a.message = this.buildMessage(a);
                a.status = 'Reset';
            },

            resetAllMessages() {
                this.auditors.forEach(a => {
                    a.message = this.buildMessage(a);
                    a.status = 'Reset';
                });
            },

            toggleAll(state) {
                this.auditors.forEach(a => a.selected = state);
            },

            // ========= CORE: PRE-OPEN TABS (SELECTED) =========
            openTabsSelectedPreopen() {
                const list = this.auditors
                    .filter(a => a.selected)
                    .map(a => ({ a, url: this.waUrlFrom(a) }))
                    .filter(x => x.url !== '#');

                if (!list.length) return;

                const batch = list.slice(0, this.maxTabsPerClick);

                // 1) pre-open about:blank synchronously
                const wins = batch.map(() => window.open('about:blank', '_blank'));

                // 2) navigate each opened tab
                batch.forEach((x, i) => {
                    const w = wins[i];
                    if (w) {
                        w.location.href = x.url;
                        x.a.status = 'Opened';
                    } else {
                        x.a.status = 'Blocked';
                    }
                });
            },

            // ========= CORE: PRE-OPEN TABS (ALL, BATCH CONTINUE) =========
            openTabsAllPreopen() {
                const list = this.auditors
                    .map(a => ({ a, url: this.waUrlFrom(a) }))
                    .filter(x => x.url !== '#');

                if (!list.length) return;

                const start = this.batchIndex;
                const end = Math.min(start + this.maxTabsPerClick, list.length);
                const batch = list.slice(start, end);

                // 1) pre-open blank tabs in one click
                const wins = batch.map(() => window.open('about:blank', '_blank'));

                // 2) navigate to WA
                batch.forEach((x, i) => {
                    const w = wins[i];
                    if (w) {
                        w.location.href = x.url;
                        x.a.status = 'Opened';
                    } else {
                        x.a.status = 'Blocked';
                    }
                });

                // update pointer
                this.batchIndex = end;
                if (this.batchIndex >= list.length) this.batchIndex = 0;
            },
        }
    }
</script>