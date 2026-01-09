@php
    // ambil client dari query
    $qClient = request('client', ''); // contoh: "PT Sample A"

    // CONTOH DATA (ganti dari DB)
    $rows = [
        ['client' => 'PT Sample A','year'=>2025,'status'=>'pending','signing_partner'=>'Aryo Wibisono','manager'=>'Ardhi Senatama','auditor'=>'Sarah Auditor','total'=>50,'received'=>20,'pending'=>25,'complete'=>5,'oldest_pending'=>'2025-01-02','overdue_max'=>18],
        ['client' => 'PT Sample B','year'=>2025,'status'=>'received','signing_partner'=>'Budi Santoso','manager'=>'Dewi Lestari','auditor'=>'Riko Auditor','total'=>30,'received'=>12,'pending'=>8,'complete'=>10,'oldest_pending'=>'2025-01-10','overdue_max'=>6],
    ];

    // FILTER: hanya 1 PT
    if ($qClient !== '') {
        $rows = array_values(array_filter($rows, fn($r) => strtolower($r['client']) === strtolower($qClient)));
    }

    // summary
    $sumTotal = $sumReceived = $sumPending = $sumComplete = 0;
    foreach ($rows as $r) {
        $sumTotal += $r['total']; $sumReceived += $r['received']; $sumPending += $r['pending']; $sumComplete += $r['complete'];
    }

    $statusLabel = fn($s) => match($s) {
        'pending' => 'Pending',
        'received' => 'Received',
        'complete' => 'Complete',
        default => '-',
    };

    $clientTitle = $qClient ?: ($rows[0]['client'] ?? 'Unknown Client');
@endphp

<div class="bg-white p-8 text-gray-900">

    <div class="mb-6 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-semibold">Data Request – Export (Per Client)</h1>
            <p class="mt-1 text-sm text-gray-600">
                Client: <span class="font-semibold text-gray-900">{{ $clientTitle }}</span>
                • Generated {{ now()->format('d M Y H:i') }}
            </p>
        </div>

        <div class="flex gap-2 print:hidden">
            <a href="{{ url()->previous() }}"
               class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold hover:bg-gray-300">
                Back
            </a>
            <button onclick="window.print()"
                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold hover:bg-gray-300">
                Print
            </button>
             <a href="{{ route('dashboard.auditor-send-wa')}}"
                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold hover:bg-gray-300">
                Send WA
             </a>
        </div>
    </div>

    {{-- KPI --}}
    <div class="mb-6 grid grid-cols-4 gap-4 text-sm">
        <div class="rounded-md border p-4">
            <p class="text-gray-600">Total Request</p>
            <p class="text-xl font-semibold">{{ $sumTotal }}</p>
        </div>
        <div class="rounded-md border p-4">
            <p class="text-gray-600">Received</p>
            <p class="text-xl font-semibold">{{ $sumReceived }}</p>
        </div>
        <div class="rounded-md border p-4">
            <p class="text-gray-600">Pending</p>
            <p class="text-xl font-semibold">{{ $sumPending }}</p>
        </div>
        <div class="rounded-md border p-4">
            <p class="text-gray-600">Complete</p>
            <p class="text-xl font-semibold">{{ $sumComplete }}</p>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-800 text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Tahun Buku</th>
                    <th class="border px-3 py-2">Status</th>
                    <th class="border px-3 py-2">Signing Partner</th>
                    <th class="border px-3 py-2">Manager</th>
                    <th class="border px-3 py-2">Auditor</th>
                    <th class="border px-3 py-2">Total</th>
                    <th class="border px-3 py-2">Received</th>
                    <th class="border px-3 py-2">Pending</th>
                    <th class="border px-3 py-2">Complete</th>
                    <th class="border px-3 py-2">Oldest Pending</th>
                    <th class="border px-3 py-2">Overdue (Days)</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rows as $i => $r)
                    <tr>
                        <td class="border px-3 py-2 text-center">{{ $i + 1 }}</td>
                        <td class="border px-3 py-2 text-center">{{ $r['year'] }}</td>
                        <td class="border px-3 py-2 text-center">{{ $statusLabel($r['status']) }}</td>
                        <td class="border px-3 py-2">{{ $r['signing_partner'] }}</td>
                        <td class="border px-3 py-2">{{ $r['manager'] }}</td>
                        <td class="border px-3 py-2">{{ $r['auditor'] }}</td>
                        <td class="border px-3 py-2 text-right">{{ $r['total'] }}</td>
                        <td class="border px-3 py-2 text-right">{{ $r['received'] }}</td>
                        <td class="border px-3 py-2 text-right">{{ $r['pending'] }}</td>
                        <td class="border px-3 py-2 text-right">{{ $r['complete'] }}</td>
                        <td class="border px-3 py-2 text-center">{{ $r['oldest_pending'] }}</td>
                        <td class="border px-3 py-2 text-center">{{ $r['overdue_max'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="border px-4 py-6 text-center text-gray-500 italic">
                            Data tidak ditemukan untuk client tersebut.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>