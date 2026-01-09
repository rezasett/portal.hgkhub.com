@php
    // =========================================================
    // FILTER & SORT PARAMS (GET)
    // =========================================================
    $qYear     = request('year', '');
    $qStatus   = request('status', '');
    $qPartner  = request('partner', '');
    $qManager  = request('manager', '');
    $qAuditor  = request('auditor', '');
    $qAging    = request('aging', '');    // all | 0-7 | 8-14 | 15+
    $qSearch   = request('search', '');   // search client

    $qSort = request('sort', 'client'); // client|year|status|partner|manager|auditor|total|received|pending|complete|oldest_pending|overdue_max
    $qDir  = strtolower(request('dir', 'asc')) === 'desc' ? 'desc' : 'asc';

    // =========================================================
    // OPTIONS (ganti dari DB kalau perlu)
    // =========================================================
    $yearOptions = [2023, 2024, 2025, 2026];

    $statusOptions = [
        '' => 'All Status',
        'pending' => 'Pending',
        'received' => 'Received',
        'complete' => 'Complete',
    ];

    $partnerOptions = [
        '' => 'All Partner',
        'Aryo Wibisono' => 'Aryo Wibisono',
        'Budi Santoso' => 'Budi Santoso',
        'Rina Putri' => 'Rina Putri',
    ];

    $managerOptions = [
        '' => 'All Manager',
        'Ardhi Senatama' => 'Ardhi Senatama',
        'Dewi Lestari' => 'Dewi Lestari',
    ];

    $auditorOptions = [
        '' => 'All Auditor',
        'Sarah Auditor' => 'Sarah Auditor',
        'Riko Auditor' => 'Riko Auditor',
    ];

    $agingOptions = [
        '' => 'All Aging',
        '0-7' => '0–7 days',
        '8-14' => '8–14 days',
        '15+' => '15+ days',
    ];

    // =========================================================
    // DATA CONTOH (ganti dari DB/Livewire)
    // Tambahan field untuk dashboard auditor:
    // - manager_incharge
    // - auditor_incharge
    // - oldest_pending (tanggal pending terlama)
    // - overdue_max (hari overdue terbesar untuk client tsb)
    // =========================================================
    $clients = [
        [
            'client' => 'PT Sample A',
            'year' => 2025,
            'status' => 'pending',
            'signing_partner' => 'Aryo Wibisono',
            'manager_incharge' => 'Ardhi Senatama',
            'auditor_incharge' => 'Sarah Auditor',
            'total' => 50,
            'received' => 20,
            'pending' => 25,
            'complete' => 5,
            'oldest_pending' => '2025-01-02',
            'overdue_max' => 18,
            'detail_url' => '#',
        ],
        [
            'client' => 'PT Sample B',
            'year' => 2025,
            'status' => 'received',
            'signing_partner' => 'Budi Santoso',
            'manager_incharge' => 'Dewi Lestari',
            'auditor_incharge' => 'Riko Auditor',
            'total' => 30,
            'received' => 12,
            'pending' => 8,
            'complete' => 10,
            'oldest_pending' => '2025-01-10',
            'overdue_max' => 6,
            'detail_url' => '#',
        ],
        [
            'client' => 'PT Sample C',
            'year' => 2024,
            'status' => 'complete',
            'signing_partner' => 'Aryo Wibisono',
            'manager_incharge' => 'Ardhi Senatama',
            'auditor_incharge' => 'Sarah Auditor',
            'total' => 40,
            'received' => 30,
            'pending' => 10,
            'complete' => 0,
            'oldest_pending' => '2024-12-20',
            'overdue_max' => 12,
            'detail_url' => '#',
        ],
    ];

    // =========================================================
    // HELPER: status label & badge
    // =========================================================
    $statusLabel = function($s) {
        return match($s) {
            'pending' => 'Pending',
            'received' => 'Received',
            'complete' => 'Complete',
            default => $s ?: '-',
        };
    };

    $statusBadge = function($s) {
        return match($s) {
            'pending' => 'bg-amber-100 text-amber-700',
            'received' => 'bg-blue-100 text-blue-700',
            'complete' => 'bg-green-100 text-green-700',
            default => 'bg-gray-100 text-gray-700',
        };
    };

    // =========================================================
    // SORT URL + ICON (asc/desc)
    // =========================================================
    $sortUrl = function(string $key) use ($qSort, $qDir) {
        $nextDir = ($qSort === $key && $qDir === 'asc') ? 'desc' : 'asc';
        return request()->fullUrlWithQuery(['sort' => $key, 'dir' => $nextDir]);
    };

    $sortIcon = function(string $key) use ($qSort, $qDir) {
        if ($qSort !== $key) return '↕';
        return $qDir === 'asc' ? '↑' : '↓';
    };

    // =========================================================
    // SUMMARY KPI (global)
    // =========================================================
    $sumTotal = 0; $sumReceived = 0; $sumPending = 0; $sumComplete = 0; $sumOverdue15 = 0; $sumOverdue7 = 0;
    foreach ($clients as $c) {
        $sumTotal    += (int)($c['total'] ?? 0);
        $sumReceived += (int)($c['received'] ?? 0);
        $sumPending  += (int)($c['pending'] ?? 0);
        $sumComplete += (int)($c['complete'] ?? 0);

        $od = (int)($c['overdue_max'] ?? 0);
        if ($od >= 15) $sumOverdue15++;
        if ($od >= 8)  $sumOverdue7++;
    }
    $den = max($sumTotal, 1);
    $pReceived = round(($sumReceived / $den) * 100);
    $pPending  = round(($sumPending  / $den) * 100);
    $pComplete = round(($sumComplete / $den) * 100);

    // =========================================================
    // HOTLIST (Top 5 by pending, then overdue)
    // =========================================================
    $hot = $clients;
    usort($hot, function($a,$b){
        $pa = (int)($a['pending'] ?? 0);
        $pb = (int)($b['pending'] ?? 0);
        if ($pa === $pb) return ((int)($b['overdue_max'] ?? 0)) <=> ((int)($a['overdue_max'] ?? 0));
        return $pb <=> $pa;
    });
    $hot = array_slice($hot, 0, 5);

    // =========================================================
    // NOTE:
    // Filter & sort sebaiknya dilakukan di controller/Livewire.
    // Di Blade ini saya hanya siapkan UI + query string.
    // =========================================================
@endphp

<div class="mt-6">

    {{-- HEADER --}}
    <div class="flex items-end justify-between gap-4">
        <div>
            <h2 class="text-base font-semibold text-gray-900">Auditor Dashboard • Data Request Progress (Per Client)</h2>
            <p class="mt-1 text-sm text-gray-600">Monitoring Received • Pending • Complete + Aging/Overdue</p>
        </div>

        <div class="text-sm text-gray-600">
            Updated: <span class="font-medium text-gray-900">{{ now()->format('Y-m-d H:i') }}</span>
        </div>
    </div>

    {{-- KPI CARDS (ringkas untuk auditor) --}}
    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-5">
        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-sm font-semibold text-gray-900">Total Items</p>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sumTotal }}</p>
            <p class="mt-1 text-xs text-gray-500">All clients</p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-900">Received</p>
                <span class="rounded-full bg-blue-100 px-2 py-0.5 text-xs font-semibold text-blue-700">{{ $pReceived }}%</span>
            </div>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sumReceived }}</p>
            <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                <div class="h-2 rounded-full bg-blue-600" style="width: {{ $pReceived }}%"></div>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-900">Pending</p>
                <span class="rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">{{ $pPending }}%</span>
            </div>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sumPending }}</p>
            <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                <div class="h-2 rounded-full bg-amber-500" style="width: {{ $pPending }}%"></div>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <div class="flex items-center justify-between">
                <p class="text-sm font-semibold text-gray-900">Complete</p>
                <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">{{ $pComplete }}%</span>
            </div>
            <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $sumComplete }}</p>
            <div class="mt-3 h-2 w-full rounded-full bg-gray-200">
                <div class="h-2 rounded-full bg-green-600" style="width: {{ $pComplete }}%"></div>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-4">
            <p class="text-sm font-semibold text-gray-900">Overdue</p>
            <div class="mt-2 space-y-1 text-sm">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">≥ 8 days</span>
                    <span class="font-semibold text-gray-900">{{ $sumOverdue7 }} client</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-700">≥ 15 days</span>
                    <span class="font-semibold text-gray-900">{{ $sumOverdue15 }} client</span>
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">Based on max overdue per client</p>
        </div>
    </div>

    {{-- FILTER BAR (tambahan: search + manager + auditor + aging) --}}
    <form method="GET" class="mt-4 rounded-lg border border-gray-200 bg-white p-4">
        <div class="grid grid-cols-1 gap-3 sm:grid-cols-12 sm:items-end">
            {{-- Search --}}
            <div class="sm:col-span-3">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Search Client</label>
                <input type="text" name="search" value="{{ $qSearch }}"
                       placeholder="Search client name..."
                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Tahun Buku --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Tahun Buku</label>
                <select name="year"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">All Year</option>
                    @foreach($yearOptions as $y)
                        <option value="{{ $y }}" @selected((string)$qYear === (string)$y)>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Status</label>
                <select name="status"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($statusOptions as $val => $label)
                        <option value="{{ $val }}" @selected((string)$qStatus === (string)$val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Signing Partner --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Signing Partner</label>
                <select name="partner"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($partnerOptions as $val => $label)
                        <option value="{{ $val }}" @selected((string)$qPartner === (string)$val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Manager Incharge --}}
            <div class="sm:col-span-3">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Manager Incharge</label>
                <select name="manager"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($managerOptions as $val => $label)
                        <option value="{{ $val }}" @selected((string)$qManager === (string)$val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Auditor Incharge --}}
            <div class="sm:col-span-3">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Auditor Incharge</label>
                <select name="auditor"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($auditorOptions as $val => $label)
                        <option value="{{ $val }}" @selected((string)$qAuditor === (string)$val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Aging --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-semibold text-gray-900 mb-1">Aging</label>
                <select name="aging"
                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach($agingOptions as $val => $label)
                        <option value="{{ $val }}" @selected((string)$qAging === (string)$val)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Buttons --}}
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit"
                        class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                    Filter
                </button>

                <a href="{{ url()->current() }}"
                   class="w-full text-center rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                    Reset
                </a>
            </div>
        </div>

        {{-- keep sort params on filter submit --}}
        <input type="hidden" name="sort" value="{{ $qSort }}">
        <input type="hidden" name="dir" value="{{ $qDir }}">
    </form>

    {{-- HOTLIST (Top 5) --}}
    <div class="mt-4 rounded-lg border border-gray-200 bg-white p-4">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-gray-900">Hotlist • Priority Follow-up (Top 5)</p>
            <p class="text-xs text-gray-500">Sorted by Pending desc, then Overdue desc</p>
        </div>

        <div class="mt-3 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left font-semibold text-gray-900 w-14">No</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900">Client</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">Pending</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">Overdue</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900 w-40">Oldest Pending</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hot as $i => $c)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                            <td class="px-4 py-2">{{ $i + 1 }}</td>
                            <td class="px-4 py-2 font-semibold text-gray-900">{{ $c['client'] }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-flex rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">
                                    {{ $c['pending'] }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <span class="inline-flex rounded-full bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-700">
                                    {{ $c['overdue_max'] ?? 0 }} days
                                </span>
                            </td>
                            <td class="px-4 py-2 text-gray-900">{{ $c['oldest_pending'] ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ $c['detail_url'] ?? '#' }}" class="text-blue-700 hover:underline font-medium">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="bg-white">
                            <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500 italic">No data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- LEGEND --}}
    <div class="mt-4 flex flex-wrap items-center gap-3 text-xs">
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded bg-blue-600"></span>
            <span class="font-semibold text-gray-700">Received</span>
        </span>
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded bg-amber-500"></span>
            <span class="font-semibold text-gray-700">Pending</span>
        </span>
        <span class="inline-flex items-center gap-2">
            <span class="h-2.5 w-2.5 rounded bg-green-600"></span>
            <span class="font-semibold text-gray-700">Complete</span>
        </span>
    </div>

    {{-- GRAFIK (STACKED BAR PER CLIENT) --}}
    <div class="mt-4 rounded-lg border border-gray-200 bg-white p-4">
        <div class="flex items-center justify-between">
            <p class="text-sm font-semibold text-gray-900">Grafik Progress per Client</p>
            <p class="text-xs text-gray-500">Bar = 100% dari total request per client</p>
        </div>

        <div class="mt-4 space-y-4">
            @forelse($clients as $c)
                @php
                    $total = max((int)($c['total'] ?? 0), 1);
                    $received = (int)($c['received'] ?? 0);
                    $pending  = (int)($c['pending'] ?? 0);
                    $complete = (int)($c['complete'] ?? 0);

                    $pR = round(($received / $total) * 100);
                    $pP = round(($pending  / $total) * 100);
                    $pC = round(($complete / $total) * 100);

                    $sum = $pR + $pP + $pC;
                    if ($sum !== 100) $pP = max(0, $pP + (100 - $sum));
                @endphp

                <div class="grid grid-cols-1 gap-2 sm:grid-cols-12 sm:items-center">
                    <div class="sm:col-span-4">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $c['client'] }}</p>
                        <p class="text-xs text-gray-500">
                            Tahun: {{ $c['year'] ?? '-' }}
                            • Status: <span class="font-semibold">{{ $statusLabel($c['status'] ?? '') }}</span>
                            • Partner: {{ $c['signing_partner'] ?? '-' }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Mgr: {{ $c['manager_incharge'] ?? '-' }}
                            • Auditor: {{ $c['auditor_incharge'] ?? '-' }}
                            • Oldest Pending: {{ $c['oldest_pending'] ?? '-' }}
                            • Overdue: {{ $c['overdue_max'] ?? 0 }}d
                        </p>
                    </div>

                    <div class="sm:col-span-7">
                        <div class="h-3 w-full overflow-hidden rounded-full bg-gray-200">
                            <div class="h-3 bg-blue-600 float-left" style="width: {{ $pR }}%"></div>
                            <div class="h-3 bg-amber-500 float-left" style="width: {{ $pP }}%"></div>
                            <div class="h-3 bg-green-600 float-left" style="width: {{ $pC }}%"></div>
                        </div>

                        <div class="mt-1 flex flex-wrap gap-2 text-xs">
                            <span class="rounded-full bg-blue-100 px-2 py-0.5 font-semibold text-blue-700">
                                R: {{ $received }} ({{ $pR }}%)
                            </span>
                            <span class="rounded-full bg-amber-100 px-2 py-0.5 font-semibold text-amber-700">
                                P: {{ $pending }} ({{ $pP }}%)
                            </span>
                            <span class="rounded-full bg-green-100 px-2 py-0.5 font-semibold text-green-700">
                                C: {{ $complete }} ({{ $pC }}%)
                            </span>
                        </div>
                    </div>

                    <div class="sm:col-span-1 sm:text-right">
                        <a href="{{ $c['detail_url'] ?? '#' }}"
                           class="text-blue-700 hover:underline text-sm font-medium">
                            View
                        </a>
                    </div>
                </div>
            @empty
                <div class="text-sm text-gray-500 italic">No data.</div>
            @endforelse
        </div>
    </div>

    {{-- TABLE (SORTABLE HEADERS) + QUICK ACTIONS --}}
    <div class="mt-5 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-14">No</th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900">
                        <a href="{{ $sortUrl('client') }}" class="inline-flex items-center gap-2 hover:underline">
                            Client <span class="text-xs text-gray-600">{{ $sortIcon('client') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">
                        <a href="{{ $sortUrl('year') }}" class="inline-flex items-center gap-2 hover:underline">
                            Tahun Buku <span class="text-xs text-gray-600">{{ $sortIcon('year') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-32">
                        <a href="{{ $sortUrl('status') }}" class="inline-flex items-center gap-2 hover:underline">
                            Status <span class="text-xs text-gray-600">{{ $sortIcon('status') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-44">
                        <a href="{{ $sortUrl('partner') }}" class="inline-flex items-center gap-2 hover:underline">
                            Signing Partner <span class="text-xs text-gray-600">{{ $sortIcon('partner') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-44">
                        <a href="{{ $sortUrl('manager') }}" class="inline-flex items-center gap-2 hover:underline">
                            Manager <span class="text-xs text-gray-600">{{ $sortIcon('manager') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-44">
                        <a href="{{ $sortUrl('auditor') }}" class="inline-flex items-center gap-2 hover:underline">
                            Auditor <span class="text-xs text-gray-600">{{ $sortIcon('auditor') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-24">
                        <a href="{{ $sortUrl('total') }}" class="inline-flex items-center gap-2 hover:underline">
                            Total <span class="text-xs text-gray-600">{{ $sortIcon('total') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">
                        <a href="{{ $sortUrl('received') }}" class="inline-flex items-center gap-2 hover:underline">
                            Received <span class="text-xs text-gray-600">{{ $sortIcon('received') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">
                        <a href="{{ $sortUrl('pending') }}" class="inline-flex items-center gap-2 hover:underline">
                            Pending <span class="text-xs text-gray-600">{{ $sortIcon('pending') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">
                        <a href="{{ $sortUrl('complete') }}" class="inline-flex items-center gap-2 hover:underline">
                            Complete <span class="text-xs text-gray-600">{{ $sortIcon('complete') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-40">
                        <a href="{{ $sortUrl('oldest_pending') }}" class="inline-flex items-center gap-2 hover:underline">
                            Oldest Pending <span class="text-xs text-gray-600">{{ $sortIcon('oldest_pending') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-28">
                        <a href="{{ $sortUrl('overdue_max') }}" class="inline-flex items-center gap-2 hover:underline">
                            Overdue <span class="text-xs text-gray-600">{{ $sortIcon('overdue_max') }}</span>
                        </a>
                    </th>

                    <th class="px-4 py-2 text-left font-semibold text-gray-900 w-44">Quick Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($clients as $i => $c)
                    <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="px-4 py-2">{{ $i + 1 }}</td>

                        <td class="px-4 py-2 font-semibold text-gray-900">{{ $c['client'] }}</td>

                        <td class="px-4 py-2 font-semibold text-gray-900">{{ $c['year'] ?? '-' }}</td>

                        <td class="px-4 py-2">
                            <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-semibold {{ $statusBadge($c['status'] ?? '') }}">
                                {{ $statusLabel($c['status'] ?? '') }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-gray-900">{{ $c['signing_partner'] ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-900">{{ $c['manager_incharge'] ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-900">{{ $c['auditor_incharge'] ?? '-' }}</td>

                        <td class="px-4 py-2 font-semibold text-gray-900">{{ $c['total'] }}</td>

                        <td class="px-4 py-2">
                            <span class="inline-flex rounded-full bg-blue-100 px-2 py-0.5 text-xs font-semibold text-blue-700">
                                {{ $c['received'] }}
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            <span class="inline-flex rounded-full bg-amber-100 px-2 py-0.5 text-xs font-semibold text-amber-700">
                                {{ $c['pending'] }}
                            </span>
                        </td>

                        <td class="px-4 py-2">
                            <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">
                                {{ $c['complete'] }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-gray-900">{{ $c['oldest_pending'] ?? '-' }}</td>
                        <td class="px-4 py-2 text-gray-900">{{ $c['overdue_max'] ?? 0 }} days</td>

                        <td class="px-4 py-2">
                            <div class="flex items-center gap-2">
                                <a href="{{ $c['detail_url'] ?? '#' }}"
                                   class="inline-flex items-center justify-center rounded bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                    View
                                </a>

                                <a href="{{ ($c['detail_url'] ?? '#') . '?tab=pending' }}"
                                   class="inline-flex items-center justify-center rounded bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white ring-1 ring-amber-600 hover:bg-amber-600">
                                    Pending Items
                                </a>

                                <a href="{{ route('dashboard.auditor-export') }}"
                                   class="inline-flex items-center justify-center rounded bg-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-800 hover:bg-gray-300">
                                    Export
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    @for($k=0; $k<6; $k++)
                        <tr class="{{ $k % 2 === 0 ? 'bg-gray-200' : 'bg-white' }}">
                            <td colspan="14" class="h-10"></td>
                        </tr>
                    @endfor
                @endforelse
            </tbody>
        </table>
    </div>

</div>
    