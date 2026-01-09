@php
    /**
     * CLIENT PORTAL – NOTIFICATIONS (SUPER SIMPLE)
     * TailwindCSS + AlpineJS, no icons
     */

    $clientName = 'PT Sample A';
    $fiscalYear = 2025;

    $notifications = [
        [
            'id' => 101,
            'title' => 'Reminder: Dokumen belum dikirim',
            'is_read' => false,
            'created_at' => '2026-01-08 09:10',
            'summary' => 'Masih ada dokumen yang belum dikirim. Mohon diunggah agar proses audit lancar.',
            'details' => 'Dokumen yang belum dikirim: Trial Balance, AR Aging. Silakan unggah melalui menu Data Request.',
            'actions' => [
                ['label' => 'Buka Data Request', 'url' => '#'],
            ],
        ],
        [
            'id' => 102,
            'title' => 'Dokumen diterima',
            'is_read' => true,
            'created_at' => '2026-01-07 16:40',
            'summary' => 'General Ledger sudah diterima dan sedang ditinjau tim audit.',
            'details' => 'Jika ada revisi/pertanyaan, tim audit akan mengirim notifikasi lanjutan.',
            'actions' => [
                ['label' => 'Lihat Status Dokumen', 'url' => '#'],
            ],
        ],
    ];
@endphp

<script src="//unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-5xl px-6 py-8"
         x-data="{
            open:false,
            active:null,
            show(n){ this.active=n; this.open=true; },
            close(){ this.open=false; this.active=null; },
         }"
    >

        {{-- HEADER --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="bg-slate-900 px-6 py-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-white">Notifikasi</h1>
                        <p class="mt-1 text-sm text-white/70">
                            {{ $clientName }} • Tahun Buku {{ $fiscalYear }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-white/20 hover:bg-slate-100">
                            Tandai semua dibaca
                        </button>

                        <a href="#"
                           class="rounded-lg bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/10 hover:bg-white/15">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4">
                <p class="text-sm text-slate-700">
                    Klik notifikasi untuk melihat detail.
                </p>
            </div>
        </div>

        {{-- LIST --}}
        <div class="mt-6 space-y-3">
            @forelse($notifications as $n)
                <button type="button"
                        @click='show(@json($n))'
                        class="w-full text-left rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200 hover:bg-slate-50">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <p class="text-base font-semibold text-slate-900">{{ $n['title'] }}</p>
                                @if(!$n['is_read'])
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold bg-amber-50 text-amber-700 ring-1 ring-amber-200">
                                        Baru
                                    </span>
                                @endif
                            </div>

                            <p class="mt-2 text-sm text-slate-600">{{ $n['summary'] }}</p>
                            <p class="mt-2 text-xs text-slate-500">{{ $n['created_at'] }}</p>
                        </div>

                        <div class="mt-2 sm:mt-0">
                            <span class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white">
                                Lihat
                            </span>
                        </div>
                    </div>
                </button>
            @empty
                <div class="rounded-2xl bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm text-slate-600">Tidak ada notifikasi.</p>
                </div>
            @endforelse
        </div>

        {{-- MODAL DETAIL --}}
        <div x-show="open" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="close()">
            <div class="absolute inset-0 bg-slate-900/60" @click="close()"></div>

            <div class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div class="min-w-0">
                        <h3 class="text-lg font-semibold text-slate-900" x-text="active?.title ?? 'Detail Notifikasi'"></h3>
                        <p class="mt-1 text-sm text-slate-500" x-text="active?.created_at ?? ''"></p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="close()">
                        Tutup
                    </button>
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <p class="text-sm text-slate-700 leading-relaxed" x-text="active?.details ?? ''"></p>

                    <div class="mt-4 flex flex-wrap gap-2" x-show="active?.actions?.length">
                        <template x-for="(a, idx) in (active?.actions || [])" :key="idx">
                            <a :href="a.url || '#'"
                               class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800"
                               x-text="a.label">
                            </a>
                        </template>

                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50">
                            Tandai dibaca
                        </button>
                    </div>
                </div>

                <div class="mt-5 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                    <button type="button"
                            class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="close()">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="mt-6 text-xs text-slate-500">
            Notifikasi hanya untuk kebutuhan komunikasi audit.
        </div>

    </div>
</div>