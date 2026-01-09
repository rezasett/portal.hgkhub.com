@php
    /**
     * CLIENT DASHBOARD – DATA REQUEST (Upload/Download Multiple Files + Modal)
     * TailwindCSS + AlpineJS (no icons)
     */

    $clientName = 'PT Sample A';
    $fiscalYear = 2025;
    $picName    = 'Bapak/Ibu PIC';

    // NOTE:
    // - templates: daftar file template yang bisa didownload (multiple)
    // - uploads: contoh daftar file yang pernah diupload (optional, bisa kamu sambungkan ke DB nanti)
    $requests = [
        [
            'id'=>1,'category'=>'Keuangan','item'=>'Trial Balance','status'=>'pending','due_date'=>'2025-01-10','uploaded_at'=>null,'aging'=>18,'priority'=>'High',
            'templates' => [
                ['name'=>'Template_TB_2025.xlsx', 'url'=>'#', 'note'=>'Format TB standar'],
                ['name'=>'Mapping_COA_TB.xlsx',   'url'=>'#', 'note'=>'Mapping COA (opsional)'],
            ],
            'uploads' => []
        ],
        [
            'id'=>2,'category'=>'Keuangan','item'=>'General Ledger','status'=>'received','due_date'=>'2025-01-12','uploaded_at'=>'2025-01-09','aging'=>0,'priority'=>'Medium',
            'templates' => [
                ['name'=>'Template_GL_2025.xlsx', 'url'=>'#', 'note'=>'Format GL standar'],
                ['name'=>'Guide_GL_Export.pdf',   'url'=>'#', 'note'=>'Panduan export dari ERP'],
            ],
            'uploads' => [
                ['name'=>'GL_2025_Jan.xlsx', 'url'=>'#', 'uploaded_at'=>'2025-01-09 10:25'],
                ['name'=>'GL_2025_Feb.xlsx', 'url'=>'#', 'uploaded_at'=>'2025-01-09 10:25'],
            ]
        ],
        [
            'id'=>3,'category'=>'Pajak','item'=>'SPT Tahunan Badan','status'=>'complete','due_date'=>'2025-01-05','uploaded_at'=>'2025-01-04','aging'=>0,'priority'=>'Low',
            'templates' => [
                ['name'=>'Checklist_SPT_2025.pdf', 'url'=>'#', 'note'=>'Checklist kelengkapan'],
                ['name'=>'Daftar_Dokumen_SPT.xlsx','url'=>'#', 'note'=>'List dokumen pendukung'],
            ],
            'uploads' => [
                ['name'=>'SPT_2025.pdf', 'url'=>'#', 'uploaded_at'=>'2025-01-04 14:03'],
            ]
        ],
        [
            'id'=>4,'category'=>'Keuangan','item'=>'AR Aging','status'=>'pending','due_date'=>'2025-01-15','uploaded_at'=>null,'aging'=>13,'priority'=>'High',
            'templates' => [
                ['name'=>'Template_AR_Aging_2025.xlsx','url'=>'#', 'note'=>'Aging per customer & bucket'],
                ['name'=>'Example_AR_Aging.xlsx',      'url'=>'#', 'note'=>'Contoh pengisian'],
                ['name'=>'Guide_AR_Aging.pdf',         'url'=>'#', 'note'=>'Panduan singkat'],
            ],
            'uploads' => []
        ],
    ];

    $total    = count($requests);
    $pending  = collect($requests)->where('status','pending')->count();
    $received = collect($requests)->where('status','received')->count();
    $complete = collect($requests)->where('status','complete')->count();
    $progress = $total ? round((($received + $complete) / $total) * 100) : 0;

    $statusLabel = fn($s) => match($s) {
        'pending'  => 'Belum Dikirim',
        'received' => 'Dikirim',
        'complete' => 'Selesai',
        default => '-',
    };

    $statusBadge = fn($s) => match($s) {
        'pending'  => 'bg-amber-50 text-amber-700 ring-1 ring-amber-200',
        'received' => 'bg-blue-50 text-blue-700 ring-1 ring-blue-200',
        'complete' => 'bg-green-50 text-green-700 ring-1 ring-green-200',
        default    => 'bg-gray-50 text-gray-700 ring-1 ring-gray-200',
    };
@endphp


<div class="bg-slate-50 text-slate-900 w-full min-h-screen">
    <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8"
         x-data="{
            uploadOpen:false,
            downloadOpen:false,
            active:null,
            pickedFiles:[],
            openUpload(row){
                this.active = row;
                this.pickedFiles = [];
                this.uploadOpen = true;
                this.$nextTick(() => { if (this.$refs.fileInput) this.$refs.fileInput.value = null; });
            },
            openDownload(row){
                this.active = row;
                this.downloadOpen = true;
            },
            closeAll(){
                this.uploadOpen = false;
                this.downloadOpen = false;
                this.active = null;
                this.pickedFiles = [];
            },
            onPickFiles(e){
                this.pickedFiles = Array.from(e.target.files || []);
            },
            removePicked(idx){
                this.pickedFiles.splice(idx, 1);
            },
         }"
    >

        {{-- HEADER --}}
        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 overflow-hidden">
            <div class="bg-slate-900 px-6 py-6">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-white">Portal Dokumen Audit</h1>
                        <p class="mt-1 text-sm text-white/70">{{ $clientName }} • Tahun Buku {{ $fiscalYear }}</p>
                    </div>
                    <div class="rounded-xl bg-white/10 px-4 py-3 text-sm text-white/80 ring-1 ring-white/10">
                        PIC: <span class="font-semibold text-white">{{ $picName }}</span><br>
                        Update: <span class="font-semibold text-white">{{ now()->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <div class="px-6 py-5">
                <p class="text-sm text-slate-700">
                    Klik <span class="font-semibold">Download Format</span> untuk mendapatkan template (bisa lebih dari 1 file),
                    lalu unggah dokumen Anda (bisa upload lebih dari 1 file).
                </p>
            </div>
        </div>

        {{-- SUMMARY --}}
        <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-12">
            <div class="lg:col-span-8 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-slate-700">Belum Dikirim</p>
                    <p class="mt-2 text-3xl font-semibold text-amber-700">{{ $pending }}</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-slate-700">Dikirim</p>
                    <p class="mt-2 text-3xl font-semibold text-blue-700">{{ $received }}</p>
                </div>
                <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm font-semibold text-slate-700">Selesai</p>
                    <p class="mt-2 text-3xl font-semibold text-green-700">{{ $complete }}</p>
                </div>
            </div>

            <div class="lg:col-span-4 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-semibold text-slate-700">Progress</p>
                    <p class="text-sm font-semibold text-slate-900">{{ $progress }}%</p>
                </div>
                <div class="mt-3 h-2.5 w-full rounded-full bg-slate-200">
                    <div class="h-2.5 rounded-full bg-slate-900" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="mt-6 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Daftar Dokumen</h2>
                    <p class="mt-1 text-sm text-slate-600">Upload & download bisa lebih dari satu file per item.</p>
                </div>
            </div>

            <div class="mt-4 overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-14">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900">Dokumen</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-28">Batas</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-28">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-900 w-72">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @foreach($requests as $i => $r)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-slate-50' }}">
                                <td class="px-4 py-3">{{ $i + 1 }}</td>

                                <td class="px-4 py-3">
                                    <p class="font-semibold text-slate-900">{{ $r['item'] }}</p>
                                    <p class="mt-1 text-xs text-slate-500">Kategori: {{ $r['category'] }}</p>

                                    {{-- Optional: ringkas list file yang sudah diupload --}}
                                    @if(!empty($r['uploads']))
                                        <div class="mt-2 text-xs text-slate-600">
                                            <p class="font-semibold text-slate-700">File yang sudah dikirim:</p>
                                            <ul class="mt-1 space-y-1">
                                                @foreach($r['uploads'] as $uf)
                                                    <li class="flex items-center justify-between gap-3 rounded-lg bg-white px-3 py-2 ring-1 ring-slate-200">
                                                        <span class="truncate">{{ $uf['name'] }}</span>
                                                        <a href="{{ $uf['url'] ?? '#' }}"
                                                           class="shrink-0 rounded-md bg-slate-900 px-3 py-1.5 text-xs font-semibold text-white hover:bg-slate-800">
                                                            Download
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-slate-700">{{ $r['due_date'] }}</td>

                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold {{ $statusBadge($r['status']) }}">
                                        {{ $statusLabel($r['status']) }}
                                    </span>
                                    <p class="mt-1 text-xs text-slate-500">Upload: {{ $r['uploaded_at'] ?: '-' }}</p>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-2">
                                        {{-- DOWNLOAD TEMPLATES (multiple) --}}
                                        <button type="button"
                                                @click='openDownload(@json($r))'
                                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50">
                                            Download Format
                                        </button>

                                        {{-- UPLOAD MULTIPLE --}}
                                        @if(($r['status'] ?? '') === 'pending')
                                            <button type="button"
                                                    @click='openUpload(@json($r))'
                                                    class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                                Upload
                                            </button>
                                        @else
                                            <span class="text-sm text-slate-500 px-2 py-2">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        @if(empty($requests))
                            <tr class="bg-white">
                                <td colspan="5" class="px-4 py-10 text-center text-sm text-slate-600">
                                    Tidak ada data request.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ===================== MODAL: UPLOAD MULTIPLE ===================== --}}
        <div x-show="uploadOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="closeAll()">
            <div class="absolute inset-0 bg-slate-900/60" @click="closeAll()"></div>

            <div class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Upload Dokumen (Bisa Banyak File)</h3>
                        <p class="mt-1 text-sm text-slate-600">
                            <span class="font-semibold" x-text="active?.item ?? '-'"></span>
                            <span class="text-slate-400">•</span>
                            Batas: <span class="font-semibold" x-text="active?.due_date ?? '-'"></span>
                        </p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="closeAll()">
                        Tutup
                    </button>
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <form method="POST" action="#" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="request_id" :value="active?.id ?? ''">

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Pilih File (multiple)</label>
                            <input x-ref="fileInput"
                                   type="file"
                                   name="files[]"
                                   multiple
                                   @change="onPickFiles($event)"
                                   class="mt-2 block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm
                                          file:mr-4 file:rounded-md file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white
                                          hover:file:bg-slate-800 focus:border-slate-900 focus:ring-slate-900">
                            <p class="mt-2 text-xs text-slate-500">
                                Anda bisa upload lebih dari 1 file (contoh: per bulan / per cabang).
                            </p>
                        </div>

                        {{-- LIST FILE TERPILIH --}}
                        <div class="rounded-xl bg-white p-4 ring-1 ring-slate-200">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-900">File terpilih</p>
                                <p class="text-xs text-slate-500" x-text="pickedFiles.length ? `${pickedFiles.length} file` : 'Belum ada file'"></p>
                            </div>

                            <div class="mt-3 space-y-2" x-show="pickedFiles.length">
                                <template x-for="(f, idx) in pickedFiles" :key="idx">
                                    <div class="flex items-center justify-between gap-3 rounded-lg bg-slate-50 px-3 py-2 ring-1 ring-slate-200">
                                        <div class="min-w-0">
                                            <p class="truncate text-sm font-semibold text-slate-900" x-text="f.name"></p>
                                            <p class="text-xs text-slate-500" x-text="Math.round(f.size/1024) + ' KB'"></p>
                                        </div>
                                        <button type="button"
                                                class="shrink-0 rounded-md bg-white px-3 py-1.5 text-xs font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                                @click="removePicked(idx)">
                                            Hapus
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <div class="mt-3 text-sm text-slate-600" x-show="!pickedFiles.length">
                                Pilih file untuk ditampilkan di sini.
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-900">Catatan (opsional)</label>
                            <textarea name="note" rows="3"
                                      class="mt-2 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm
                                             focus:border-slate-900 focus:ring-slate-900"
                                      placeholder="Contoh: file final / ada revisi / data per bulan."></textarea>
                        </div>

                        <div class="flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                            <button type="button"
                                    class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                    @click="closeAll()">
                                Batal
                            </button>
                            <button type="submit"
                                    class="rounded-lg bg-slate-900 px-5 py-2 text-sm font-semibold text-white hover:bg-slate-800"
                                    :disabled="pickedFiles.length === 0"
                                    :class="pickedFiles.length === 0 ? 'opacity-50 cursor-not-allowed' : ''">
                                Kirim Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: DOWNLOAD MULTIPLE ===================== --}}
        <div x-show="downloadOpen" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             @keydown.escape.window="closeAll()">
            <div class="absolute inset-0 bg-slate-900/60" @click="closeAll()"></div>

            <div class="relative w-full max-w-2xl rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200" x-transition>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Download Format (Bisa Banyak File)</h3>
                        <p class="mt-1 text-sm text-slate-600">
                            Untuk: <span class="font-semibold" x-text="active?.item ?? '-'"></span>
                        </p>
                    </div>
                    <button type="button"
                            class="rounded-lg bg-white px-3 py-2 text-sm font-semibold text-slate-700 ring-1 ring-slate-300 hover:bg-slate-50"
                            @click="closeAll()">
                        Tutup
                    </button>
                </div>

                <div class="mt-5 rounded-xl bg-slate-50 p-4 ring-1 ring-slate-200">
                    <div class="rounded-xl bg-white p-4 ring-1 ring-slate-200">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-900">Daftar file format</p>
                            <p class="text-xs text-slate-500"
                               x-text="(active?.templates?.length || 0) ? `${active.templates.length} file` : '0 file'"></p>
                        </div>

                        <div class="mt-3 space-y-2" x-show="active?.templates?.length">
                            <template x-for="(t, idx) in active.templates" :key="idx">
                                <div class="flex flex-col gap-2 rounded-lg bg-slate-50 px-3 py-3 ring-1 ring-slate-200 sm:flex-row sm:items-center sm:justify-between">
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-semibold text-slate-900" x-text="t.name"></p>
                                        <p class="mt-1 text-xs text-slate-500" x-text="t.note || ''"></p>
                                    </div>
                                    <a :href="t.url || '#'"
                                       class="inline-flex justify-center rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                                        Download
                                    </a>
                                </div>
                            </template>
                        </div>

                        <div class="mt-3 text-sm text-slate-600" x-show="!(active?.templates?.length)">
                            Tidak ada file format untuk item ini.
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
                        <button type="button"
                                class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50"
                                @click="closeAll()">
                            Tutup
                        </button>

                        {{-- OPTIONAL: Download All (zip) --}}
                        <a :href="`#`"
                           class="inline-flex justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 ring-1 ring-slate-300 hover:bg-slate-50">
                            Download Semua (ZIP)
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>