@php
    /**
     * REPORT TABLE + CRUD MODALS (Create / Edit / Delete)
     * TailwindCSS + AlpineJS, no icons
     * Frontend-only (hook to route/Livewire later)
     */

    $clientName = 'PT Sample A';
    $fiscalYear = 2025;

    $reports = [
        [
            'id' => 1,
            'doc' => 'Report Audit',
            'opinion' => 'Wajar Tanpa Pengecualian',
            'year' => 2025,
            'release_date' => '2026-01-08',
            'auditor' => 'Nama Akuntan Publik, CPA',
            'official_link' => 'https://example.com/pelaporan-resmi',
            'file_url' => '#',
        ],
        [
            'id' => 2,
            'doc' => 'Management Letter',
            'opinion' => '-',
            'year' => 2025,
            'release_date' => '2026-01-08',
            'auditor' => 'Nama Akuntan Publik, CPA',
            'official_link' => '-',
            'file_url' => '#',
        ],
    ];

    $opinionOptions = [
        'Wajar Tanpa Pengecualian',
        'Wajar Dengan Pengecualian',
        'Tidak Wajar',
        'Tidak Memberikan Pendapat (Disclaimer)',
        '-',
    ];
@endphp

<script src="//unpkg.com/alpinejs" defer></script>

<div class="min-h-screen bg-slate-50 text-slate-900">
    <div class="mx-auto max-w-6xl px-6 py-8"
         x-data="{
            createOpen:false,
            editOpen:false,
            deleteOpen:false,
            active:null,

            emptyRow(){
                return {
                    id: null,
                    doc: '',
                    opinion: 'Wajar Tanpa Pengecualian',
                    year: {{ (int)$fiscalYear }},
                    release_date: '',
                    auditor: '',
                    official_link: '',
                    file_url: '',
                }
            },

            openCreate(){
                this.active = this.emptyRow();
                this.createOpen = true;
            },

            openEdit(row){
                // clone agar tidak mutasi object asli
                this.active = JSON.parse(JSON.stringify(row));
                this.editOpen = true;
            },

            openDelete(row){
                this.active = JSON.parse(JSON.stringify(row));
                this.deleteOpen = true;
            },

            closeAll(){
                this.createOpen=false;
                this.editOpen=false;
                this.deleteOpen=false;
                this.active=null;
            },
         }"
    >

        {{-- HEADER --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="bg-slate-900 px-6 py-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-white">Ringkasan Report</h1>
                        <p class="mt-1 text-sm text-white/70">{{ $clientName }} • Tahun Buku {{ $fiscalYear }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <button type="button"
                                @click="openCreate()"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-white/20 hover:bg-slate-100">
                            Create
                        </button>

                        <a href="#"
                           class="rounded-lg bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/10 hover:bg-white/15">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5">
                <p class="text-sm text-slate-700">
                    Tabel ini memuat ringkasan dokumen final audit (opini, tanggal rilis, penandatangan, dan link pelaporan resmi).
                </p>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="mt-6 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-100">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-14">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Dokumen</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Jenis Opini</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-28">Tahun Buku</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-36">Tanggal Rilis</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Akuntan Publik</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-40">Pelaporan Resmi</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-52">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @foreach($reports as $i => $r)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-slate-50' }}">
                                <td class="px-4 py-3">{{ $i + 1 }}</td>

                                <td class="px-4 py-3">
                                    <p class="font-semibold text-slate-900">{{ $r['doc'] }}</p>
                                    <p class="mt-1 text-xs text-slate-500">File: {{ $r['file_url'] !== '#' ? 'Tersedia' : 'Tautan belum diatur' }}</p>
                                </td>

                                <td class="px-4 py-3 text-slate-700">{{ $r['opinion'] }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $r['year'] }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $r['release_date'] }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $r['auditor'] }}</td>

                                <td class="px-4 py-3">
                                    @if(($r['official_link'] ?? '-') !== '-')
                                        <a href="{{ $r['official_link'] }}" target="_blank"
                                           class="underline text-slate-900 hover:text-slate-700">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="text-slate-500">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ $r['file_url'] }}"
                                           class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                            Download
                                        </a>

                                        <button type="button"
                                                @click='openEdit(@json($r))'
                                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-100">
                                            Edit
                                        </button>

                                        <button type="button"
                                                @click='openDelete(@json($r))'
                                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-red-700 ring-1 ring-red-200 hover:bg-red-50">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(empty($reports))
                            <tr class="bg-white">
                                <td colspan="8" class="px-4 py-10 text-center text-sm text-slate-600">
                                    Belum ada data report.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===================== MODAL: CREATE ===================== --}}
        <div x-show="createOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="closeAll()">
            <div class="absolute inset-0 bg-slate-900/60" @click="closeAll()"></div>

            <div class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Create Report</h3>
                        <p class="mt-1 text-sm text-slate-600">Tambahkan ringkasan report untuk ditampilkan ke klien.</p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="closeAll()">
                        Tutup
                    </button>
                </div>

                <form method="POST" action="#" class="mt-5 space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Dokumen</label>
                            <input type="text" name="doc" x-model="active.doc"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900"
                                   placeholder="Contoh: Report Audit / Management Letter">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Jenis Opini</label>
                            <select name="opinion" x-model="active.opinion"
                                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                                @foreach($opinionOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Tahun Buku Audit</label>
                            <input type="number" name="year" x-model="active.year"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900"
                                   placeholder="2025">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Tanggal Rilis</label>
                            <input type="date" name="release_date" x-model="active.release_date"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900">Nama Akuntan Publik</label>
                        <input type="text" name="auditor" x-model="active.auditor"
                               class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900"
                               placeholder="Nama Akuntan Publik, CPA">
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Link Pelaporan Resmi</label>
                            <input type="url" name="official_link" x-model="active.official_link"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900"
                                   placeholder="https://...">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Link File Download</label>
                            <input type="url" name="file_url" x-model="active.file_url"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900"
                                   placeholder="https://... / storage/...">
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                @click="closeAll()">
                            Batal
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-slate-900 px-5 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== MODAL: EDIT ===================== --}}
        <div x-show="editOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="closeAll()">
            <div class="absolute inset-0 bg-slate-900/60" @click="closeAll()"></div>

            <div class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Edit Report</h3>
                        <p class="mt-1 text-sm text-slate-600">Perbarui informasi ringkasan report.</p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="closeAll()">
                        Tutup
                    </button>
                </div>

                <form method="POST" action="#" class="mt-5 space-y-4">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" :value="active?.id ?? ''">

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Dokumen</label>
                            <input type="text" name="doc" x-model="active.doc"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Jenis Opini</label>
                            <select name="opinion" x-model="active.opinion"
                                    class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                                @foreach($opinionOptions as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Tahun Buku Audit</label>
                            <input type="number" name="year" x-model="active.year"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Tanggal Rilis</label>
                            <input type="date" name="release_date" x-model="active.release_date"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900">Nama Akuntan Publik</label>
                        <input type="text" name="auditor" x-model="active.auditor"
                               class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Link Pelaporan Resmi</label>
                            <input type="url" name="official_link" x-model="active.official_link"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Link File Download</label>
                            <input type="url" name="file_url" x-model="active.file_url"
                                   class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm focus:border-slate-900 focus:ring-slate-900">
                        </div>
                    </div>

                    <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                @click="closeAll()">
                            Batal
                        </button>
                        <button type="submit"
                                class="rounded-lg bg-slate-900 px-5 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== MODAL: DELETE ===================== --}}
        <div x-show="deleteOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="closeAll()">
            <div class="absolute inset-0 bg-slate-900/60" @click="closeAll()"></div>

            <div class="relative w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Hapus Data</h3>
                        <p class="mt-1 text-sm text-slate-600">
                            Data ini akan dihapus. Pastikan benar sebelum melanjutkan.
                        </p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="closeAll()">
                        Tutup
                    </button>
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <p class="text-sm text-slate-700">
                        Anda akan menghapus: <span class="font-semibold" x-text="active?.doc ?? '-'"></span>
                    </p>

                    <form method="POST" action="#" class="mt-4 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" :value="active?.id ?? ''">

                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                @click="closeAll()">
                            Batal
                        </button>

                        <button type="submit"
                                class="rounded-lg bg-red-600 px-5 py-2 text-sm font-semibold text-white hover:bg-red-700">
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-6 text-xs text-slate-500">
            Dokumen bersifat terbatas untuk kebutuhan audit. Mohon simpan dengan aman.
        </div>
    </div>
</div>