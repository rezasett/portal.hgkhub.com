@php
/**
 * ADMIN DASHBOARD – AUDITOR DATA REQUEST (Interactive)
 * TailwindCSS + AlpineJS • Professional UI • No icons
 * Dummy data only (replace from DB / Livewire later)
 */

$title = 'Admin Dashboard • Data Request Auditor';
$asOf  = now()->format('d M Y, H:i');

$filters = [
  'q' => '',
  'year' => 2025,
  'status' => 'all', // all | pending | received | complete | overdue
  'signing_partner' => 'all',
  'auditor' => 'all',
  'sort' => 'aging',
  'dir' => 'desc',
];

$kpis = [
  'total_requests' => 128,
  'pending' => 37,
  'received' => 61,
  'complete' => 30,
  'overdue' => 12,
];

$chartStatus = [
  ['key' => 'pending',  'label' => 'Pending',  'value' => $kpis['pending']],
  ['key' => 'received', 'label' => 'Received', 'value' => $kpis['received']],
  ['key' => 'complete', 'label' => 'Complete', 'value' => $kpis['complete']],
  ['key' => 'overdue',  'label' => 'Overdue',  'value' => $kpis['overdue']],
];

$auditorSummary = [
  ['id'=>11,'name'=>'Naufal','role'=>'Senior Auditor','pending'=>9,'received'=>12,'complete'=>5,'overdue'=>3],
  ['id'=>12,'name'=>'Rani',  'role'=>'Auditor',       'pending'=>11,'received'=>18,'complete'=>7,'overdue'=>4],
  ['id'=>13,'name'=>'Dimas', 'role'=>'Auditor',       'pending'=>6,'received'=>14,'complete'=>8,'overdue'=>2],
  ['id'=>14,'name'=>'Salsa', 'role'=>'Junior Auditor','pending'=>5,'received'=>9,'complete'=>4,'overdue'=>1],
];

$partners = [
  ['id' => 1, 'name' => 'Partner A'],
  ['id' => 2, 'name' => 'Partner B'],
  ['id' => 3, 'name' => 'Partner C'],
];

$auditors = [
  ['id' => 11, 'name' => 'Naufal'],
  ['id' => 12, 'name' => 'Rani'],
  ['id' => 13, 'name' => 'Dimas'],
  ['id' => 14, 'name' => 'Salsa'],
];

$rows = [
  [
    'id'=>101,'client'=>'PT Sample A','year'=>2025,'request_no'=>'DR-2025-001','item'=>'Trial Balance',
    'auditor'=>'Rani','auditor_id'=>12,'partner'=>'Partner A','partner_id'=>1,'due'=>'2026-01-10','aging'=>18,
    'status'=>'pending','last_update'=>'2026-01-08 09:20',
    'priority'=>'high',
    'attachments'=>0,
    'notes'=>'Menunggu TB final dan mapping akun terbaru.',
    'timeline'=>[
      ['at'=>'2026-01-02 10:11','txt'=>'Request dibuat oleh Admin.'],
      ['at'=>'2026-01-05 15:08','txt'=>'Reminder pertama terkirim ke auditor.'],
      ['at'=>'2026-01-08 09:20','txt'=>'Status masih pending, follow-up ke PIC klien.'],
    ],
  ],
  [
    'id'=>102,'client'=>'PT Sample A','year'=>2025,'request_no'=>'DR-2025-002','item'=>'General Ledger',
    'auditor'=>'Naufal','auditor_id'=>11,'partner'=>'Partner A','partner_id'=>1,'due'=>'2026-01-12','aging'=>16,
    'status'=>'received','last_update'=>'2026-01-07 16:05',
    'priority'=>'medium',
    'attachments'=>3,
    'notes'=>'GL diterima, perlu cek kelengkapan periode dan kode akun.',
    'timeline'=>[
      ['at'=>'2026-01-03 09:00','txt'=>'Request dibuat.'],
      ['at'=>'2026-01-07 16:05','txt'=>'File masuk (3 lampiran). Status berubah menjadi received.'],
    ],
  ],
  [
    'id'=>103,'client'=>'PT Sample B','year'=>2025,'request_no'=>'DR-2025-014','item'=>'AR Aging Detail',
    'auditor'=>'Dimas','auditor_id'=>13,'partner'=>'Partner B','partner_id'=>2,'due'=>'2026-01-05','aging'=>23,
    'status'=>'overdue','last_update'=>'2026-01-06 11:41',
    'priority'=>'high',
    'attachments'=>0,
    'notes'=>'Overdue. Perlu escalasi ke partner & PIC klien.',
    'timeline'=>[
      ['at'=>'2025-12-20 13:40','txt'=>'Request dibuat.'],
      ['at'=>'2026-01-03 10:00','txt'=>'Reminder kedua terkirim.'],
      ['at'=>'2026-01-06 11:41','txt'=>'Status overdue otomatis.'],
    ],
  ],
  [
    'id'=>104,'client'=>'PT Sample C','year'=>2024,'request_no'=>'DR-2024-088','item'=>'Bank Statement',
    'auditor'=>'Salsa','auditor_id'=>14,'partner'=>'Partner C','partner_id'=>3,'due'=>'2025-12-28','aging'=>41,
    'status'=>'complete','last_update'=>'2026-01-02 14:12',
    'priority'=>'low',
    'attachments'=>5,
    'notes'=>'Selesai. Semua rekening sudah lengkap 12 bulan.',
    'timeline'=>[
      ['at'=>'2025-12-01 09:10','txt'=>'Request dibuat.'],
      ['at'=>'2025-12-20 17:45','txt'=>'File masuk (5 lampiran).'],
      ['at'=>'2026-01-02 14:12','txt'=>'Ditutup complete oleh admin.'],
    ],
  ],
];

$maxBar = max(array_map(fn($x) => $x['value'], $chartStatus));
@endphp

{{-- Alpine (hapus jika sudah include global) --}}
<script src="//unpkg.com/alpinejs" defer></script>

<div
  x-data="adminDataRequestDashboard({
    initialFilters: @js($filters),
    rows: @js($rows),
    auditors: @js($auditors),
    partners: @js($partners),
  })"
  class="w-full min-h-screen bg-slate-50 text-slate-900"
>
  <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
      <div class="min-w-0">
        <h1 class="text-lg font-semibold tracking-tight text-slate-900">{{ $title }}</h1>
        <p class="mt-1 text-sm text-slate-600">
          Monitoring operasional permintaan data audit • Update:
          <span class="font-semibold text-slate-900">{{ $asOf }}</span>
        </p>
      </div>

      <div class="flex flex-wrap gap-2">
        <button
          type="button"
          @click="toast('Export disiapkan (dummy). Nanti hubungkan ke Livewire/DB.')"
          class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
        >
          Export
        </button>
        <button
          type="button"
          @click="toast('Settings (dummy).')"
          class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
        >
          Settings
        </button>
      </div>
    </div>

    {{-- KPI Cards --}}
    <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">
      <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold text-slate-600">Total Requests</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $kpis['total_requests'] }}</p>
        <p class="mt-1 text-xs text-slate-500">Semua tahun & status</p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold text-slate-600">Pending</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $kpis['pending'] }}</p>
        <p class="mt-1 text-xs text-slate-500">Belum diterima klien</p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold text-slate-600">Received</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $kpis['received'] }}</p>
        <p class="mt-1 text-xs text-slate-500">File sudah masuk</p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold text-slate-600">Complete</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $kpis['complete'] }}</p>
        <p class="mt-1 text-xs text-slate-500">Sudah ditutup</p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-4">
        <p class="text-xs font-semibold text-slate-600">Overdue</p>
        <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $kpis['overdue'] }}</p>
        <p class="mt-1 text-xs text-slate-500">Lewat due date</p>
      </div>
    </div>

    {{-- Tabs + Quick Summary --}}
    <div class="mt-6 rounded-xl border border-slate-200 bg-white p-4">
      <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
        <div class="min-w-0">
          <p class="text-sm font-semibold text-slate-900">Status Tabs</p>
          <p class="mt-1 text-xs text-slate-500">Klik untuk cepat memfilter berdasarkan status</p>
        </div>

        <div class="flex flex-wrap gap-2">
          <template x-for="t in statusTabs" :key="t.key">
            <button
              type="button"
              @click="filters.status = t.key"
              :class="filters.status === t.key
                ? 'bg-slate-900 text-white border-slate-900'
                : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-100'"
              class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-semibold"
            >
              <span x-text="t.label"></span>
              <span class="rounded-full px-2 py-0.5"
                    :class="filters.status === t.key ? 'bg-white/15 text-white' : 'bg-slate-100 text-slate-700'">
                <span x-text="t.count"></span>
              </span>
            </button>
          </template>
        </div>
      </div>

      <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
          <p class="text-xs font-semibold text-slate-600">Rows (filtered)</p>
          <p class="mt-1 text-lg font-semibold text-slate-900" x-text="filteredRows.length"></p>
          <p class="mt-1 text-xs text-slate-500">Sesuai filter & tab aktif</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
          <p class="text-xs font-semibold text-slate-600">Unique Clients</p>
          <p class="mt-1 text-lg font-semibold text-slate-900" x-text="summary.uniqueClients"></p>
          <p class="mt-1 text-xs text-slate-500">Klien terdampak</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
          <p class="text-xs font-semibold text-slate-600">Due &lt; 7 days</p>
          <p class="mt-1 text-lg font-semibold text-slate-900" x-text="summary.dueSoon"></p>
          <p class="mt-1 text-xs text-slate-500">Butuh follow-up cepat</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
          <p class="text-xs font-semibold text-slate-600">Avg Aging (days)</p>
          <p class="mt-1 text-lg font-semibold text-slate-900" x-text="summary.avgAging"></p>
          <p class="mt-1 text-xs text-slate-500">Rata-rata aging</p>
        </div>
      </div>
    </div>

    {{-- Row: Chart + Auditor summary --}}
    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">

      {{-- Simple bar chart (CSS only) --}}
      <div class="rounded-xl border border-slate-200 bg-white p-4 lg:col-span-1">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-semibold text-slate-900">Distribusi Status</p>
            <p class="mt-1 text-xs text-slate-500">Ringkasan visual (tanpa library)</p>
          </div>
          <div class="text-xs text-slate-500">As of {{ $asOf }}</div>
        </div>

        <div class="mt-4 space-y-3">
          @foreach($chartStatus as $c)
            @php $w = $maxBar > 0 ? round(($c['value'] / $maxBar) * 100) : 0; @endphp
            <div>
              <div class="flex items-center justify-between text-xs">
                <p class="font-semibold text-slate-700">{{ $c['label'] }}</p>
                <p class="font-semibold text-slate-900">{{ $c['value'] }}</p>
              </div>
              <div class="mt-1 h-2 w-full rounded bg-slate-100">
                <div class="h-2 rounded bg-slate-900/80" style="width: {{ $w }}%"></div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-4 rounded-lg border border-slate-200 bg-slate-50 p-3 text-xs text-slate-600">
          Tips: Nantinya bar ini bisa di-“bind” ke data hasil filter (Livewire computed).
        </div>
      </div>

      {{-- Auditor workload summary --}}
      <div class="rounded-xl border border-slate-200 bg-white p-4 lg:col-span-2">
        <div class="flex items-start justify-between">
          <div>
            <p class="text-sm font-semibold text-slate-900">Ringkasan per Auditor</p>
            <p class="mt-1 text-xs text-slate-500">Kapasitas & prioritas tindak lanjut</p>
          </div>
          <button
            type="button"
            @click="toast('Halaman auditor (dummy).')"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Lihat semua auditor
          </button>
        </div>

        <div class="mt-4 overflow-x-auto">
          <table class="min-w-full text-sm">
            <thead class="bg-slate-100">
              <tr>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700">Auditor</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700 w-24">Pending</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700 w-24">Received</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700 w-24">Complete</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700 w-24">Overdue</th>
                <th class="px-4 py-2 text-left text-xs font-semibold text-slate-700 w-44">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($auditorSummary as $i => $a)
                <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-slate-50' }}">
                  <td class="px-4 py-2">
                    <p class="font-semibold text-slate-900">{{ $a['name'] }}</p>
                    <p class="text-xs text-slate-500">{{ $a['role'] }}</p>
                  </td>
                  <td class="px-4 py-2 font-semibold text-slate-900">{{ $a['pending'] }}</td>
                  <td class="px-4 py-2 font-semibold text-slate-900">{{ $a['received'] }}</td>
                  <td class="px-4 py-2 font-semibold text-slate-900">{{ $a['complete'] }}</td>
                  <td class="px-4 py-2 font-semibold text-slate-900">{{ $a['overdue'] }}</td>
                  <td class="px-4 py-2">
                    <div class="flex flex-wrap gap-2">
                      <button
                        type="button"
                        @click="filters.auditor = {{ $a['id'] }}; toast('Filter auditor: {{ $a['name'] }}')"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
                      >
                        Fokus
                      </button>
                      <button
                        type="button"
                        @click="openReminder({ auditor: '{{ $a['name'] }}', scope: 'auditor' })"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
                      >
                        Reminder
                      </button>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>

    {{-- Filters --}}
    <div class="mt-6 rounded-xl border border-slate-200 bg-white p-4">
      <div class="flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
        <div class="min-w-0">
          <p class="text-sm font-semibold text-slate-900">Filter & Pencarian</p>
          <p class="mt-1 text-xs text-slate-500">Realtime (dummy). Nanti diganti Livewire wire:model.</p>
        </div>

        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-6 lg:gap-3">
          <div class="lg:col-span-2">
            <label class="mb-1 block text-xs font-semibold text-slate-700">Search</label>
            <input
              type="text"
              x-model.trim.debounce.300ms="filters.q"
              placeholder="Client / item / auditor / nomor"
              class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 placeholder:text-slate-400 focus:border-slate-400 focus:outline-none"
            />
          </div>

          <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700">Tahun Buku</label>
            <select x-model="filters.year"
              class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
              <option value="all">All</option>
              <option value="2025">2025</option>
              <option value="2024">2024</option>
            </select>
          </div>

          <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700">Status</label>
            <select x-model="filters.status"
              class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
              <option value="all">All</option>
              <option value="pending">Pending</option>
              <option value="received">Received</option>
              <option value="complete">Complete</option>
              <option value="overdue">Overdue</option>
            </select>
          </div>

          <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700">Signing Partner</label>
            <select x-model="filters.signing_partner"
              class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
              <option value="all">All</option>
              @foreach($partners as $p)
                <option value="{{ $p['id'] }}">{{ $p['name'] }}</option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="mb-1 block text-xs font-semibold text-slate-700">Auditor</label>
            <select x-model="filters.auditor"
              class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
              <option value="all">All</option>
              @foreach($auditors as $a)
                <option value="{{ $a['id'] }}">{{ $a['name'] }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
        <div class="flex flex-wrap gap-2">
          <button
            type="button"
            @click="resetFilters()"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Reset Filter
          </button>

          <button
            type="button"
            @click="toast('Export filtered (dummy).')"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Export Filtered
          </button>
        </div>

        <div class="text-xs text-slate-500">
          Sort: <span class="font-semibold text-slate-900" x-text="filters.sort"></span>
          • Dir: <span class="font-semibold text-slate-900" x-text="filters.dir"></span>
        </div>
      </div>
    </div>

    {{-- Bulk Action Bar (only when selected > 0) --}}
    <div x-show="selectedIds.length > 0" x-transition class="mt-4 rounded-xl border border-slate-200 bg-white p-4">
      <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm">
          <span class="font-semibold text-slate-900" x-text="selectedIds.length"></span>
          <span class="text-slate-600">baris dipilih</span>
        </div>

        <div class="flex flex-wrap gap-2">
          <button
            type="button"
            @click="openBulk()"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Bulk Update Status
          </button>
          <button
            type="button"
            @click="openAssign({ scope: 'bulk' })"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Assign Auditor
          </button>
          <button
            type="button"
            @click="openReminder({ scope: 'bulk' })"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Send Reminder (WA)
          </button>
          <button
            type="button"
            @click="clearSelection()"
            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
          >
            Clear
          </button>
        </div>
      </div>
    </div>

    {{-- Detail Table --}}
    <div class="mt-6 rounded-xl border border-slate-200 bg-white">
      <div class="border-b border-slate-200 p-4">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <p class="text-sm font-semibold text-slate-900">Detail Data Request</p>
            <p class="mt-1 text-xs text-slate-500">
              Klik baris untuk melihat detail panel (SLA, timeline, notes, attachments).
            </p>
          </div>

          <div class="flex flex-wrap gap-2">
            <button
              type="button"
              @click="openBulk()"
              class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
            >
              Bulk Update
            </button>
            <button
              type="button"
              @click="openAssign({ scope: 'table' })"
              class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100"
            >
              Assign Auditor
            </button>
          </div>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-slate-100 sticky top-0 z-10">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-12">
                <input type="checkbox"
                  @change="toggleAll($event.target.checked)"
                  :checked="allChecked"
                  class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-0">
              </th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-12">No</th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('client')">Client</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-28">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('year')">Tahun Buku</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-32">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('request_no')">No. Request</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('item')">Item</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-32">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('auditor')">Auditor</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-36">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('partner')">Signing Partner</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-28">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('due')">Due</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-28">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('aging')">Aging</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-28">
                <button type="button" class="font-semibold hover:underline" @click="sortBy('status')">Status</button>
              </th>

              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-28">Files</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-40">Last Update</th>
              <th class="px-4 py-3 text-left text-xs font-semibold text-slate-700 w-44">Action</th>
            </tr>
          </thead>

          <tbody>
            <template x-for="(r, idx) in pagedRows" :key="r.id">
              <template>
                <tr
                  @click="toggleExpand(r.id)"
                  :class="expandedId === r.id ? 'bg-slate-100' : (idx % 2 === 0 ? 'bg-white' : 'bg-slate-50')"
                  class="cursor-pointer hover:bg-slate-100/70"
                >
                  <td class="px-4 py-3" @click.stop>
                    <input type="checkbox"
                      :value="r.id"
                      @change="toggleOne(r.id, $event.target.checked)"
                      :checked="selectedIds.includes(r.id)"
                      class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-0">
                  </td>

                  <td class="px-4 py-3 text-slate-700" x-text="(page - 1) * pageSize + idx + 1"></td>

                  <td class="px-4 py-3">
                    <p class="font-semibold text-slate-900" x-text="r.client"></p>
                    <p class="mt-0.5 text-xs text-slate-500">
                      Priority:
                      <span class="font-semibold text-slate-900" x-text="r.priority"></span>
                    </p>
                  </td>

                  <td class="px-4 py-3 text-slate-900 font-semibold" x-text="r.year"></td>

                  <td class="px-4 py-3 text-slate-700" x-text="r.request_no"></td>

                  <td class="px-4 py-3">
                    <p class="font-semibold text-slate-900" x-text="r.item"></p>
                    <p class="mt-0.5 text-xs text-slate-500">
                      SLA: <span class="font-semibold text-slate-900" x-text="slaText(r)"></span>
                    </p>
                  </td>

                  <td class="px-4 py-3 text-slate-700" x-text="r.auditor"></td>
                  <td class="px-4 py-3 text-slate-700" x-text="r.partner"></td>
                  <td class="px-4 py-3 text-slate-700" x-text="r.due"></td>

                  <td class="px-4 py-3">
                    <div class="flex flex-col">
                      <span class="font-semibold text-slate-900" x-text="r.aging + ' hari'"></span>
                      <span class="text-xs text-slate-500" x-text="agingHint(r)"></span>
                    </div>
                  </td>

                  <td class="px-4 py-3">
                    <span class="inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold"
                      :class="statusBadge(r.status)">
                      <span x-text="r.status.toUpperCase()"></span>
                    </span>
                  </td>

                  <td class="px-4 py-3">
                    <div class="inline-flex items-center rounded-full border border-slate-200 bg-white px-2.5 py-1 text-xs font-semibold text-slate-800">
                      <span x-text="r.attachments"></span>
                      <span class="ml-1 text-slate-500">files</span>
                    </div>
                  </td>

                  <td class="px-4 py-3 text-xs text-slate-600" x-text="r.last_update"></td>

                  <td class="px-4 py-3" @click.stop>
                    <div class="flex flex-wrap gap-2">
                      <button type="button"
                        @click="toast('Open detail page (dummy): ' + r.request_no)"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                        Detail
                      </button>
                      <button type="button"
                        @click="openAssign({ scope: 'row', row: r })"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                        Assign
                      </button>
                      <button type="button"
                        @click="openReminder({ scope: 'row', row: r })"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                        Reminder
                      </button>
                      <button type="button"
                        @click="openNotes(r)"
                        class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                        Notes
                      </button>
                    </div>
                  </td>
                </tr>

                {{-- Expanded Panel --}}
                <tr x-show="expandedId === r.id" x-transition>
                  <td colspan="14" class="px-4 pb-4">
                    <div class="rounded-xl border border-slate-200 bg-white p-4">
                      <div class="flex flex-col gap-3 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0">
                          <p class="text-sm font-semibold text-slate-900">
                            Detail Panel • <span class="font-semibold" x-text="r.request_no"></span>
                          </p>
                          <p class="mt-1 text-xs text-slate-500">
                            Informasi lebih lengkap untuk admin: SLA, progress, timeline, dan catatan tindak lanjut.
                          </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                          <button type="button"
                            @click="toast('Simulasi: mark as received')"
                            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                            Quick: Mark Received
                          </button>
                          <button type="button"
                            @click="toast('Simulasi: close complete')"
                            class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                            Quick: Close Complete
                          </button>
                        </div>
                      </div>

                      <div class="mt-4 grid grid-cols-1 gap-3 lg:grid-cols-3">
                        {{-- SLA Card --}}
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                          <p class="text-xs font-semibold text-slate-600">SLA / Risk</p>
                          <p class="mt-1 text-sm font-semibold text-slate-900" x-text="slaText(r)"></p>
                          <div class="mt-2 h-2 w-full rounded bg-slate-200">
                            <div class="h-2 rounded bg-slate-900/80" :style="'width:' + slaPercent(r) + '%'"></div>
                          </div>
                          <p class="mt-2 text-xs text-slate-500" x-text="slaHint(r)"></p>
                        </div>

                        {{-- Notes --}}
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                          <p class="text-xs font-semibold text-slate-600">Notes</p>
                          <p class="mt-1 text-sm font-semibold text-slate-900">Ringkasan tindak lanjut</p>
                          <p class="mt-2 text-sm text-slate-700 leading-relaxed" x-text="r.notes"></p>
                          <div class="mt-3">
                            <button type="button" @click="openNotes(r)"
                              class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
                              Edit Notes
                            </button>
                          </div>
                        </div>

                        {{-- Attachments --}}
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                          <p class="text-xs font-semibold text-slate-600">Attachments</p>
                          <p class="mt-1 text-sm font-semibold text-slate-900" x-text="r.attachments + ' file(s)'"></p>
                          <p class="mt-2 text-xs text-slate-500">
                            Dummy list file. Nanti bisa connect ke table uploads per request.
                          </p>
                          <div class="mt-3 space-y-2">
                            <template x-if="r.attachments === 0">
                              <div class="rounded-md border border-slate-200 bg-white p-2 text-xs text-slate-600">
                                Belum ada file masuk.
                              </div>
                            </template>
                            <template x-if="r.attachments > 0">
                              <div class="space-y-2">
                                <template x-for="n in r.attachments" :key="n">
                                  <div class="rounded-md border border-slate-200 bg-white p-2 text-xs text-slate-700">
                                    File_<span x-text="n"></span>_<span x-text="r.request_no"></span>.pdf
                                  </div>
                                </template>
                              </div>
                            </template>
                          </div>
                        </div>
                      </div>

                      {{-- Timeline --}}
                      <div class="mt-4 rounded-lg border border-slate-200 bg-white p-3">
                        <p class="text-xs font-semibold text-slate-700">Activity Timeline</p>
                        <div class="mt-3 grid grid-cols-1 gap-2">
                          <template x-for="(t, ti) in r.timeline" :key="ti">
                            <div class="rounded-md border border-slate-200 bg-slate-50 p-2">
                              <p class="text-xs font-semibold text-slate-900" x-text="t.at"></p>
                              <p class="mt-1 text-sm text-slate-700" x-text="t.txt"></p>
                            </div>
                          </template>
                        </div>
                      </div>

                    </div>
                  </td>
                </tr>
              </template>
            </template>
          </tbody>
        </table>
      </div>

      {{-- Footer / Pagination --}}
      <div class="border-t border-slate-200 p-4">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
          <p class="text-xs text-slate-500">
            Menampilkan
            <span class="font-semibold text-slate-900" x-text="pagedRows.length"></span>
            dari
            <span class="font-semibold text-slate-900" x-text="filteredRows.length"></span>
            baris (dummy)
          </p>

          <div class="flex items-center gap-2">
            <select x-model.number="pageSize"
              class="rounded-md border border-slate-300 bg-white px-2 py-1.5 text-xs text-slate-900 focus:border-slate-400 focus:outline-none">
              <option :value="5">5 / page</option>
              <option :value="10">10 / page</option>
              <option :value="20">20 / page</option>
            </select>

            <button type="button" @click="prevPage()"
              class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
              Prev
            </button>
            <div class="text-xs text-slate-600">
              Page <span class="font-semibold text-slate-900" x-text="page"></span>
              / <span class="font-semibold text-slate-900" x-text="totalPages"></span>
            </div>
            <button type="button" @click="nextPage()"
              class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100">
              Next
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- MODALS + TOAST --}}
  <div x-show="toastOpen" x-transition
    class="fixed right-4 top-4 z-[60] w-[min(420px,calc(100vw-2rem))]">
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-lg">
      <p class="text-sm font-semibold text-slate-900">Notifikasi</p>
      <p class="mt-1 text-sm text-slate-700" x-text="toastMsg"></p>
      <div class="mt-3 flex justify-end gap-2">
        <button type="button" @click="toastOpen=false"
          class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
          Tutup
        </button>
      </div>
    </div>
  </div>

  {{-- Modal Shell --}}
  <div x-show="modal.open" x-transition class="fixed inset-0 z-[70]">
    <div class="absolute inset-0 bg-slate-900/30" @click="closeModal()"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
      <div class="w-full max-w-2xl rounded-2xl border border-slate-200 bg-white shadow-xl">
        <div class="border-b border-slate-200 p-4">
          <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
              <p class="text-sm font-semibold text-slate-900" x-text="modal.title"></p>
              <p class="mt-1 text-xs text-slate-500" x-text="modal.subtitle"></p>
            </div>
            <button type="button" @click="closeModal()"
              class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
              Close
            </button>
          </div>
        </div>

        <div class="p-4">
          {{-- Assign --}}
          <template x-if="modal.type === 'assign'">
            <div class="space-y-3">
              <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700">
                Scope: <span class="font-semibold text-slate-900" x-text="modal.payload.scope"></span>
                <template x-if="modal.payload.row">
                  <div class="mt-2 text-xs text-slate-500">
                    Target: <span class="font-semibold text-slate-900" x-text="modal.payload.row.request_no"></span>
                    • <span x-text="modal.payload.row.client"></span>
                    • <span x-text="modal.payload.row.item"></span>
                  </div>
                </template>
                <template x-if="modal.payload.scope === 'bulk'">
                  <div class="mt-2 text-xs text-slate-500">
                    Target: <span class="font-semibold text-slate-900" x-text="selectedIds.length + ' selected rows'"></span>
                  </div>
                </template>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Pilih Auditor</label>
                <select x-model="modal.form.auditor_id"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
                  <option value="">-- pilih --</option>
                  <template x-for="a in auditors" :key="a.id">
                    <option :value="a.id" x-text="a.name"></option>
                  </template>
                </select>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Catatan</label>
                <textarea x-model="modal.form.note" rows="3"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                  placeholder="Contoh: Assign ulang karena overload / perubahan tim / eskalasi."></textarea>
              </div>

              <div class="flex justify-end gap-2">
                <button type="button" @click="closeModal()"
                  class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                  Cancel
                </button>
                <button type="button" @click="applyAssign()"
                  class="rounded-md border border-slate-900 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                  Apply Assign
                </button>
              </div>
            </div>
          </template>

          {{-- Reminder --}}
          <template x-if="modal.type === 'reminder'">
            <div class="space-y-3">
              <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700">
                Scope: <span class="font-semibold text-slate-900" x-text="modal.payload.scope"></span>
                <template x-if="modal.payload.row">
                  <div class="mt-2 text-xs text-slate-500">
                    Target: <span class="font-semibold text-slate-900" x-text="modal.payload.row.request_no"></span>
                    • Auditor: <span class="font-semibold text-slate-900" x-text="modal.payload.row.auditor"></span>
                  </div>
                </template>
                <template x-if="modal.payload.auditor">
                  <div class="mt-2 text-xs text-slate-500">
                    Target Auditor: <span class="font-semibold text-slate-900" x-text="modal.payload.auditor"></span>
                  </div>
                </template>
                <template x-if="modal.payload.scope === 'bulk'">
                  <div class="mt-2 text-xs text-slate-500">
                    Target: <span class="font-semibold text-slate-900" x-text="selectedIds.length + ' selected rows'"></span>
                  </div>
                </template>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Template Pesan</label>
                <textarea x-model="modal.form.message" rows="5"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                  placeholder="Tulis pesan reminder untuk WA (dummy)."></textarea>
                <p class="mt-1 text-xs text-slate-500">
                  Nanti bisa kamu generate dynamic: client, item, due date, link portal, dsb.
                </p>
              </div>

              <div class="flex justify-end gap-2">
                <button type="button" @click="closeModal()"
                  class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                  Cancel
                </button>
                <button type="button" @click="sendReminder()"
                  class="rounded-md border border-slate-900 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                  Open WA Web (Dummy)
                </button>
              </div>
            </div>
          </template>

          {{-- Bulk Update --}}
          <template x-if="modal.type === 'bulk'">
            <div class="space-y-3">
              <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700">
                Target: <span class="font-semibold text-slate-900" x-text="selectedIds.length + ' selected rows'"></span>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Update Status</label>
                <select x-model="modal.form.status"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
                  <option value="">-- pilih --</option>
                  <option value="pending">pending</option>
                  <option value="received">received</option>
                  <option value="complete">complete</option>
                  <option value="overdue">overdue</option>
                </select>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Catatan</label>
                <textarea x-model="modal.form.note" rows="3"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                  placeholder="Contoh: bulk close karena pekerjaan selesai / bulk mark received karena file masuk."></textarea>
              </div>

              <div class="flex justify-end gap-2">
                <button type="button" @click="closeModal()"
                  class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                  Cancel
                </button>
                <button type="button" @click="applyBulkStatus()"
                  class="rounded-md border border-slate-900 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                  Apply Bulk Update
                </button>
              </div>
            </div>
          </template>

          {{-- Notes --}}
          <template x-if="modal.type === 'notes'">
            <div class="space-y-3">
              <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-700">
                Target: <span class="font-semibold text-slate-900" x-text="modal.payload.row.request_no"></span>
                • <span x-text="modal.payload.row.client"></span>
              </div>

              <div>
                <label class="mb-1 block text-xs font-semibold text-slate-700">Notes</label>
                <textarea x-model="modal.form.notes" rows="5"
                  class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"></textarea>
              </div>

              <div class="flex justify-end gap-2">
                <button type="button" @click="closeModal()"
                  class="rounded-md border border-slate-300 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">
                  Cancel
                </button>
                <button type="button" @click="saveNotes()"
                  class="rounded-md border border-slate-900 bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                  Save Notes
                </button>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>

  <script>
    function adminDataRequestDashboard({ initialFilters, rows, auditors, partners }) {
      return {
        rows,
        auditors,
        partners,

        filters: {
          q: initialFilters.q ?? '',
          year: String(initialFilters.year ?? 'all'),
          status: initialFilters.status ?? 'all',
          signing_partner: String(initialFilters.signing_partner ?? 'all'),
          auditor: String(initialFilters.auditor ?? 'all'),
          sort: initialFilters.sort ?? 'aging',
          dir: initialFilters.dir ?? 'desc',
        },

        expandedId: null,
        selectedIds: [],

        page: 1,
        pageSize: 10,

        toastOpen: false,
        toastMsg: '',

        modal: {
          open: false,
          type: null, // assign | reminder | bulk | notes
          title: '',
          subtitle: '',
          payload: {},
          form: {},
        },

        get filteredRows() {
          let data = [...this.rows];

          // status
          if (this.filters.status !== 'all') {
            data = data.filter(r => r.status === this.filters.status);
          }

          // year
          if (this.filters.year !== 'all') {
            data = data.filter(r => String(r.year) === String(this.filters.year));
          }

          // partner
          if (this.filters.signing_partner !== 'all') {
            data = data.filter(r => String(r.partner_id) === String(this.filters.signing_partner));
          }

          // auditor
          if (this.filters.auditor !== 'all') {
            data = data.filter(r => String(r.auditor_id) === String(this.filters.auditor));
          }

          // search
          const q = (this.filters.q || '').toLowerCase().trim();
          if (q) {
            data = data.filter(r => {
              const hay = `${r.client} ${r.item} ${r.auditor} ${r.request_no} ${r.partner}`.toLowerCase();
              return hay.includes(q);
            });
          }

          // sort
          const sortKey = this.filters.sort;
          const dir = this.filters.dir === 'asc' ? 1 : -1;

          data.sort((a, b) => {
            const av = a[sortKey];
            const bv = b[sortKey];

            // date compare for 'due'
            if (sortKey === 'due') {
              const ad = new Date(av + 'T00:00:00');
              const bd = new Date(bv + 'T00:00:00');
              return (ad - bd) * dir;
            }

            if (typeof av === 'number' && typeof bv === 'number') return (av - bv) * dir;
            return String(av).localeCompare(String(bv)) * dir;
          });

          // reset page if overflow
          const tp = Math.max(1, Math.ceil(data.length / this.pageSize));
          if (this.page > tp) this.page = tp;

          return data;
        },

        get totalPages() {
          return Math.max(1, Math.ceil(this.filteredRows.length / this.pageSize));
        },

        get pagedRows() {
          const start = (this.page - 1) * this.pageSize;
          return this.filteredRows.slice(start, start + this.pageSize);
        },

        get allChecked() {
          if (this.pagedRows.length === 0) return false;
          return this.pagedRows.every(r => this.selectedIds.includes(r.id));
        },

        get statusTabs() {
          const base = [
            { key: 'all',      label: 'All' },
            { key: 'pending',  label: 'Pending' },
            { key: 'received', label: 'Received' },
            { key: 'complete', label: 'Complete' },
            { key: 'overdue',  label: 'Overdue' },
          ];

          const counts = { all: this.rows.length, pending:0, received:0, complete:0, overdue:0 };
          this.rows.forEach(r => { if (counts[r.status] !== undefined) counts[r.status]++; });

          return base.map(t => ({ ...t, count: counts[t.key] ?? 0 }));
        },

        get summary() {
          const setClients = new Set(this.filteredRows.map(r => r.client));
          const avg = this.filteredRows.length
            ? Math.round(this.filteredRows.reduce((s,r)=>s + (r.aging||0), 0) / this.filteredRows.length)
            : 0;

          // due soon (dummy: compare with "today")
          const today = new Date('{{ now()->format('Y-m-d') }}T00:00:00');
          const dueSoon = this.filteredRows.filter(r => {
            const d = new Date(r.due + 'T00:00:00');
            const diff = Math.ceil((d - today) / (1000*60*60*24));
            return diff >= 0 && diff <= 7;
          }).length;

          return {
            uniqueClients: setClients.size,
            avgAging: avg,
            dueSoon,
          };
        },

        resetFilters() {
          this.filters.q = '';
          this.filters.year = '2025';
          this.filters.status = 'all';
          this.filters.signing_partner = 'all';
          this.filters.auditor = 'all';
          this.filters.sort = 'aging';
          this.filters.dir = 'desc';
          this.page = 1;
          this.expandedId = null;
          this.toast('Filter direset (dummy).');
        },

        sortBy(key) {
          if (this.filters.sort === key) {
            this.filters.dir = this.filters.dir === 'asc' ? 'desc' : 'asc';
          } else {
            this.filters.sort = key;
            this.filters.dir = 'asc';
          }
          this.toast('Sort: ' + key + ' (' + this.filters.dir + ')');
        },

        prevPage() { if (this.page > 1) this.page--; },
        nextPage() { if (this.page < this.totalPages) this.page++; },

        toggleExpand(id) {
          this.expandedId = (this.expandedId === id) ? null : id;
        },

        toggleAll(checked) {
          const ids = this.pagedRows.map(r => r.id);
          if (checked) {
            ids.forEach(id => { if (!this.selectedIds.includes(id)) this.selectedIds.push(id); });
          } else {
            this.selectedIds = this.selectedIds.filter(id => !ids.includes(id));
          }
        },

        toggleOne(id, checked) {
          if (checked) {
            if (!this.selectedIds.includes(id)) this.selectedIds.push(id);
          } else {
            this.selectedIds = this.selectedIds.filter(x => x !== id);
          }
        },

        clearSelection() {
          this.selectedIds = [];
          this.toast('Selection cleared.');
        },

        statusBadge(status) {
          switch (status) {
            case 'pending':  return 'bg-amber-50 text-amber-800 border-amber-200';
            case 'received': return 'bg-slate-50 text-slate-800 border-slate-200';
            case 'complete': return 'bg-emerald-50 text-emerald-800 border-emerald-200';
            case 'overdue':  return 'bg-rose-50 text-rose-800 border-rose-200';
            default:         return 'bg-slate-50 text-slate-800 border-slate-200';
          }
        },

        agingHint(r) {
          if (r.status === 'overdue') return 'late';
          if (r.aging >= 30) return 'high aging';
          if (r.aging >= 14) return 'watchlist';
          return 'normal';
        },

        // SLA (dummy logic)
        slaPercent(r) {
          // makin tinggi aging + overdue -> makin tinggi bar
          let p = Math.min(100, Math.round((r.aging / 30) * 100));
          if (r.status === 'overdue') p = Math.max(p, 85);
          if (r.priority === 'high') p = Math.min(100, p + 10);
          return p;
        },
        slaText(r) {
          const p = this.slaPercent(r);
          if (p >= 85) return 'Critical';
          if (p >= 60) return 'High';
          if (p >= 35) return 'Medium';
          return 'Low';
        },
        slaHint(r) {
          if (r.status === 'overdue') return 'Overdue: escalasi ke partner & PIC klien.';
          if (this.slaPercent(r) >= 60) return 'Butuh follow-up dalam 24–48 jam.';
          return 'Monitoring rutin.';
        },

        toast(msg) {
          this.toastMsg = msg;
          this.toastOpen = true;
          clearTimeout(this._t);
          this._t = setTimeout(() => this.toastOpen = false, 2800);
        },

        openAssign(payload = {}) {
          this.modal.open = true;
          this.modal.type = 'assign';
          this.modal.title = 'Assign Auditor';
          this.modal.subtitle = 'Atur penugasan auditor (dummy). Nanti hubungkan ke Livewire action.';
          this.modal.payload = payload;
          this.modal.form = { auditor_id: '', note: '' };
        },

        openReminder(payload = {}) {
          this.modal.open = true;
          this.modal.type = 'reminder';
          this.modal.title = 'Send Reminder (WhatsApp)';
          this.modal.subtitle = 'Template pesan reminder (dummy). Nanti bisa generate otomatis per request.';
          this.modal.payload = payload;

          // default message template
          let header = 'Reminder Data Request Audit';
          let body = 'Mohon tindak lanjut permintaan data audit. Terima kasih.';
          if (payload.row) {
            body =
              `Mohon tindak lanjut permintaan data:\n` +
              `Client: ${payload.row.client}\n` +
              `Item: ${payload.row.item}\n` +
              `No: ${payload.row.request_no}\n` +
              `Due: ${payload.row.due}\n\n` +
              `Mohon update status / upload file di portal. Terima kasih.`;
          }
          if (payload.auditor) {
            body =
              `Halo ${payload.auditor},\n` +
              `Mohon cek daftar data request Anda hari ini dan update status di dashboard.\n` +
              `Terima kasih.`;
          }

          this.modal.form = { message: `${header}\n\n${body}` };
        },

        openBulk() {
          if (this.selectedIds.length === 0) return this.toast('Pilih minimal 1 baris dulu.');
          this.modal.open = true;
          this.modal.type = 'bulk';
          this.modal.title = 'Bulk Update Status';
          this.modal.subtitle = 'Update status sekaligus (dummy).';
          this.modal.payload = {};
          this.modal.form = { status: '', note: '' };
        },

        openNotes(row) {
          this.modal.open = true;
          this.modal.type = 'notes';
          this.modal.title = 'Edit Notes';
          this.modal.subtitle = 'Catatan internal admin untuk tindak lanjut.';
          this.modal.payload = { row };
          this.modal.form = { notes: row.notes || '' };
        },

        closeModal() {
          this.modal.open = false;
          this.modal.type = null;
          this.modal.payload = {};
          this.modal.form = {};
        },

        applyAssign() {
          if (!this.modal.form.auditor_id) return this.toast('Pilih auditor terlebih dulu.');
          const auditor = this.auditors.find(a => String(a.id) === String(this.modal.form.auditor_id));
          const name = auditor ? auditor.name : 'Unknown';

          if (this.modal.payload.scope === 'row' && this.modal.payload.row) {
            const id = this.modal.payload.row.id;
            const r = this.rows.find(x => x.id === id);
            if (r) {
              r.auditor_id = auditor.id;
              r.auditor = name;
              r.last_update = '{{ now()->format('Y-m-d H:i') }}';
              r.timeline = [{ at: '{{ now()->format('Y-m-d H:i') }}', txt: `Assigned to ${name} (dummy).` }, ...(r.timeline||[])];
            }
            this.toast(`Assigned ${this.modal.payload.row.request_no} -> ${name}`);
          } else {
            // bulk or table scope
            const targets = (this.modal.payload.scope === 'bulk') ? this.selectedIds : [];
            targets.forEach(id => {
              const r = this.rows.find(x => x.id === id);
              if (r) {
                r.auditor_id = auditor.id;
                r.auditor = name;
                r.last_update = '{{ now()->format('Y-m-d H:i') }}';
                r.timeline = [{ at: '{{ now()->format('Y-m-d H:i') }}', txt: `Assigned to ${name} (dummy).` }, ...(r.timeline||[])];
              }
            });
            this.toast(`Assigned ${targets.length} row(s) -> ${name}`);
          }

          this.closeModal();
        },

        applyBulkStatus() {
          if (!this.modal.form.status) return this.toast('Pilih status dulu.');
          const status = this.modal.form.status;

          this.selectedIds.forEach(id => {
            const r = this.rows.find(x => x.id === id);
            if (r) {
              r.status = status;
              r.last_update = '{{ now()->format('Y-m-d H:i') }}';
              r.timeline = [{ at: '{{ now()->format('Y-m-d H:i') }}', txt: `Bulk status -> ${status} (dummy).` }, ...(r.timeline||[])];
            }
          });

          this.toast(`Bulk updated ${this.selectedIds.length} row(s) -> ${status}`);
          this.closeModal();
        },

        sendReminder() {
          // Dummy: open new tab to WA web would be implemented later.
          this.toast('Simulasi: membuka WA Web dengan pesan (dummy).');
          this.closeModal();
        },

        saveNotes() {
          const row = this.modal.payload.row;
          const r = this.rows.find(x => x.id === row.id);
          if (r) {
            r.notes = this.modal.form.notes;
            r.last_update = '{{ now()->format('Y-m-d H:i') }}';
            r.timeline = [{ at: '{{ now()->format('Y-m-d H:i') }}', txt: `Notes updated (dummy).` }, ...(r.timeline||[])];
          }
          this.toast('Notes tersimpan (dummy).');
          this.closeModal();
        },
      }
    }
  </script>
</div>