<div class="p-6 bg-white">

    {{-- BACK BUTTON --}}
    <div class="mb-4">
        <a href="{{ route('dareq.dareq-client-detail') }}"
           class="inline-flex items-center gap-2 rounded-md bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 hover:bg-gray-300">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>
    </div>

    {{-- TITLE --}}
    <h1 class="text-3xl font-normal text-gray-900 mb-6">Data Request</h1>

    {{-- HEADER INFO --}}
    <div class="flex justify-between items-start mb-6">
        <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm">
            <div class="font-semibold">Cycle</div>
            <div class="border px-3 py-1 italic text-gray-700">autofilled</div>

            <div class="font-semibold">Auditor Incharge</div>
            <div class="border px-3 py-1 italic text-gray-700">autofilled</div>

            <div class="font-semibold">Client Incharge</div>
            <div class="border px-3 py-1 italic text-gray-700">autofilled</div>
        </div>

        {{-- EDIT BUTTON (OPEN MODAL) --}}
        <button type="button"
            data-open-modal="editHeaderModal"
            class="h-fit rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
            Edit
        </button>
    </div>

    {{-- DETAIL TABLE --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-800 text-sm">
            <thead>
                <tr>
                    <th class="border border-gray-800 px-3 py-2 w-14">No</th>
                    <th class="border border-gray-800 px-3 py-2 w-56">Item</th>
                    <th class="border border-gray-800 px-3 py-2 w-64">Description</th>
                    <th class="border border-gray-800 px-3 py-2 w-40">Date Request</th>
                    <th class="border border-gray-800 px-3 py-2 w-40">Date Received</th>
                    <th class="border border-gray-800 px-3 py-2 w-40">Date Approved</th>
                    <th class="border border-gray-800 px-3 py-2 w-48">Attachment</th>
                    <th class="border border-gray-800 px-3 py-2 w-32">Status</th>
                    <th class="border border-gray-800 px-3 py-2 w-32">Log Comment</th>
                    <th class="border border-gray-800 px-3 py-2 w-32">Log Activity</th>
                </tr>
            </thead>

            <tbody>
                {{-- DATA ROW (contoh) --}}
                <tr>
                    <td class="border border-gray-800 px-3 py-2 text-center">1</td>
                    <td class="border border-gray-800 px-3 py-2">Trial Balance (:Default:)</td>
                    <td class="border border-gray-800 px-3 py-2"></td>
                    <td class="border border-gray-800 px-3 py-2">timestamp</td>
                    <td class="border border-gray-800 px-3 py-2">timestamp</td>
                    <td class="border border-gray-800 px-3 py-2">timestamp</td>

                    {{-- Attachment: Download & Upload -> modal --}}
                    <td class="border border-gray-800 px-3 py-2">
                        <div class="flex items-center gap-2">
                            <button type="button"
                                data-open-modal="downloadModal"
                                data-row-id="1"
                                data-item-name="Trial Balance (:Default:)"
                                class="inline-flex items-center justify-center rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Download
                            </button>

                            <button type="button"
                                data-open-modal="uploadModal"
                                data-row-id="1"
                                data-item-name="Trial Balance (:Default:)"
                                class="inline-flex items-center justify-center rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Upload
                            </button>
                        </div>
                    </td>

                    <td class="border border-gray-800 px-3 py-2"></td>

                    {{-- Log Comment modal --}}
                    <td class="border border-gray-800 px-3 py-2 text-center">
                        <button type="button"
                            data-open-modal="logCommentModal"
                            data-row-id="1"
                            data-item-name="Trial Balance (:Default:)"
                            class="text-blue-700 hover:underline">
                            view
                        </button>
                    </td>

                    {{-- Log Activity modal --}}
                    <td class="border border-gray-800 px-3 py-2 text-center">
                        <button type="button"
                            data-open-modal="logActivityModal"
                            data-row-id="1"
                            data-item-name="Trial Balance (:Default:)"
                            class="text-blue-700 hover:underline">
                            view
                        </button>
                    </td>
                </tr>

                {{-- EMPTY ROWS --}}
                @for($i = 0; $i < 6; $i++)
                    <tr>
                        @for($j = 0; $j < 10; $j++)
                            <td class="border border-gray-800 h-8"></td>
                        @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>

    {{-- ADD ROW BUTTON (OPEN MODAL) --}}
    <div class="mt-6 flex justify-end">
        <button type="button"
            data-open-modal="addRowModal"
            class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
            Add Row
        </button>
    </div>

    {{-- ===========================
        MODAL TEMPLATE (CENTER)
       =========================== --}}
    @php
      // helper: none needed, just using consistent structure below
    @endphp

    {{-- ============================================================
        MODAL: EDIT HEADER (Cycle/Auditor/Client)
       ============================================================ --}}
    <div id="editHeaderModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <h3 class="text-base font-semibold text-gray-900">Edit Header</h3>
                    <button type="button" data-close-modal="editHeaderModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Cycle</label>
                                <input type="text" name="cycle"
                                       value="autofilled"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Auditor Incharge</label>
                                <input type="text" name="auditor_incharge"
                                       value="autofilled"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Client Incharge</label>
                                <input type="text" name="client_incharge"
                                       value="autofilled"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2">
                            <button type="button" data-close-modal="editHeaderModal"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                                Cancel
                            </button>

                            <button type="submit"
                                class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL: ADD ROW (create item row)
       ============================================================ --}}
    <div id="addRowModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <h3 class="text-base font-semibold text-gray-900">Add Row</h3>
                    <button type="button" data-close-modal="addRowModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4">
                    <form action="#" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Item</label>
                                <input type="text" name="item"
                                       placeholder="e.g. Trial Balance"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Description</label>
                                <textarea name="description" rows="3"
                                          class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Date Request</label>
                                <input type="text" name="date_request" placeholder="timestamp / date"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-900 mb-1">Status</label>
                                <input type="text" name="status" placeholder="optional"
                                       class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2">
                            <button type="button" data-close-modal="addRowModal"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                                Cancel
                            </button>

                            <button type="submit"
                                class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL: DOWNLOAD (list file + tombol download)
       ============================================================ --}}
    <div id="downloadModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Download Attachment</h3>
                        <p class="text-xs text-gray-600 mt-1">
                            Item: <span id="downloadItemName" class="font-medium text-gray-800">-</span>
                            <span class="mx-1 text-gray-400">•</span>
                            Row: <span id="downloadRowId" class="font-medium text-gray-800">-</span>
                        </p>
                    </div>

                    <button type="button" data-close-modal="downloadModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4">
                    <div class="border rounded-md p-3">
                        <p class="text-sm font-semibold text-gray-900 mb-2">Available Files</p>

                        {{-- contoh statis (nanti ganti @foreach) --}}
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <p class="truncate text-gray-900">Trial_Balance_2025.xlsx</p>
                                    <p class="text-xs text-gray-500">Uploaded: 2025-01-15 10:10</p>
                                </div>
                                <a href="#"
                                   class="shrink-0 inline-flex items-center justify-center rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                    Download
                                </a>
                            </li>

                            <li class="flex items-center justify-between gap-4">
                                <div class="min-w-0">
                                    <p class="truncate text-gray-900">TB_Supporting.pdf</p>
                                    <p class="text-xs text-gray-500">Uploaded: 2025-01-16 09:30</p>
                                </div>
                                <a href="#"
                                   class="shrink-0 inline-flex items-center justify-center rounded bg-blue-600 px-3 py-1 text-xs font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                    Download
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <button type="button" data-close-modal="downloadModal"
                            class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL: UPLOAD (multiple + preview)
       ============================================================ --}}
    <div id="uploadModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Upload Attachment</h3>
                        <p class="text-xs text-gray-600 mt-1">
                            Item: <span id="uploadItemName" class="font-medium text-gray-800">-</span>
                            <span class="mx-1 text-gray-400">•</span>
                            Row: <span id="uploadRowId" class="font-medium text-gray-800">-</span>
                        </p>
                    </div>

                    <button type="button" data-close-modal="uploadModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4">
                    <form id="uploadForm" action="#" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="row_id" id="uploadRowIdInput" value="">
                        <input type="hidden" name="item_name" id="uploadItemNameInput" value="">

                        <div>
                            <label class="block text-sm font-semibold text-gray-900 mb-1">Select Files (multiple)</label>

                            <input
                                id="attachmentsInput"
                                type="file"
                                name="attachments[]"
                                multiple
                                class="block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700
                                       border border-gray-300 rounded-md p-2"
                            />

                            <p class="mt-2 text-xs text-gray-600">
                                Tip: kamu bisa pilih banyak file sekaligus (Ctrl/Shift).
                            </p>
                        </div>

                        <div class="border rounded-md p-3">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900">Selected Files</p>
                                <span id="selectedCount"
                                      class="text-xs font-semibold text-gray-700 bg-gray-200 rounded-full px-2 py-0.5">
                                    0 file
                                </span>
                            </div>

                            <ul id="selectedFilesList" class="mt-2 space-y-1 text-sm text-gray-800 max-h-40 overflow-auto">
                                <li class="text-gray-500 italic">No file selected.</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-end gap-2 pt-2">
                            <button type="button" data-close-modal="uploadModal"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                                Cancel
                            </button>

                            <button type="submit"
                                class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL: LOG COMMENT
       ============================================================ --}}
    <div id="logCommentModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Log Comment</h3>
                        <p class="text-xs text-gray-600 mt-1">
                            Item: <span id="commentItemName" class="font-medium text-gray-800">-</span>
                            <span class="mx-1 text-gray-400">•</span>
                            Row: <span id="commentRowId" class="font-medium text-gray-800">-</span>
                        </p>
                    </div>

                    <button type="button" data-close-modal="logCommentModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4 space-y-4">
                    <div class="border rounded-md p-3">
                        <p class="text-sm font-semibold text-gray-900 mb-2">History</p>

                        {{-- contoh statis --}}
                        <div class="space-y-3 text-sm">
                            <div class="border rounded-md p-3">
                                <div class="flex items-center justify-between">
                                    <p class="font-semibold text-gray-900">Auditor A</p>
                                    <p class="text-xs text-gray-500">2025-01-15 10:20</p>
                                </div>
                                <p class="mt-1 text-gray-800">Mohon upload TB final yang sudah ditandatangani.</p>
                            </div>

                            <div class="border rounded-md p-3">
                                <div class="flex items-center justify-between">
                                    <p class="font-semibold text-gray-900">Client PIC</p>
                                    <p class="text-xs text-gray-500">2025-01-15 13:10</p>
                                </div>
                                <p class="mt-1 text-gray-800">Siap, akan kami upload hari ini.</p>
                            </div>
                        </div>
                    </div>

                    <form action="#" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="row_id" id="commentRowIdInput" value="">
                        <label class="block text-sm font-semibold text-gray-900">Add Comment</label>
                        <textarea name="comment" rows="3"
                                  class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-close-modal="logCommentModal"
                                class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                                Close
                            </button>
                            <button type="submit"
                                class="rounded-md bg-blue-600 px-6 py-2 text-sm font-semibold text-white ring-1 ring-blue-700 hover:bg-blue-700">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL: LOG ACTIVITY
       ============================================================ --}}
    <div id="logActivityModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-lg bg-white shadow-lg overflow-hidden">
                <div class="flex items-center justify-between px-5 py-4 border-b">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Log Activity</h3>
                        <p class="text-xs text-gray-600 mt-1">
                            Item: <span id="activityItemName" class="font-medium text-gray-800">-</span>
                            <span class="mx-1 text-gray-400">•</span>
                            Row: <span id="activityRowId" class="font-medium text-gray-800">-</span>
                        </p>
                    </div>

                    <button type="button" data-close-modal="logActivityModal"
                        class="rounded-md bg-gray-200 px-3 py-1.5 text-sm font-medium text-gray-800 hover:bg-gray-300">
                        Close
                    </button>
                </div>

                <div class="px-5 py-4">
                    <div class="border rounded-md p-3">
                        <p class="text-sm font-semibold text-gray-900 mb-2">Activity Timeline</p>

                        {{-- contoh statis --}}
                        <ol class="space-y-2 text-sm">
                            <li class="flex items-start justify-between gap-4 border rounded-md p-3">
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900">Request Created</p>
                                    <p class="text-gray-700">Row dibuat oleh Auditor A</p>
                                </div>
                                <span class="text-xs text-gray-500 whitespace-nowrap">2025-01-14 09:00</span>
                            </li>

                            <li class="flex items-start justify-between gap-4 border rounded-md p-3">
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-900">File Uploaded</p>
                                    <p class="text-gray-700">TB_Supporting.pdf diunggah oleh Client PIC</p>
                                </div>
                                <span class="text-xs text-gray-500 whitespace-nowrap">2025-01-16 09:30</span>
                            </li>
                        </ol>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="button" data-close-modal="logActivityModal"
                            class="rounded-md bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800 hover:bg-gray-300">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================================
        MODAL SCRIPT (GENERIC)
       ============================================================ --}}
    <script>
        (function () {
            const open = (id) => {
                const el = document.getElementById(id);
                if (el) el.classList.remove('hidden');
            };

            const close = (id) => {
                const el = document.getElementById(id);
                if (el) el.classList.add('hidden');
            };

            // Fill modal context (row_id & item_name)
            const setContext = (modalId, rowId, itemName) => {
                if (modalId === 'downloadModal') {
                    const r = document.getElementById('downloadRowId');
                    const i = document.getElementById('downloadItemName');
                    if (r) r.textContent = rowId || '-';
                    if (i) i.textContent = itemName || '-';
                }

                if (modalId === 'uploadModal') {
                    const r = document.getElementById('uploadRowId');
                    const i = document.getElementById('uploadItemName');
                    const rInput = document.getElementById('uploadRowIdInput');
                    const iInput = document.getElementById('uploadItemNameInput');

                    if (r) r.textContent = rowId || '-';
                    if (i) i.textContent = itemName || '-';
                    if (rInput) rInput.value = rowId || '';
                    if (iInput) iInput.value = itemName || '';

                    const attachmentsInput = document.getElementById('attachmentsInput');
                    const selectedFilesList = document.getElementById('selectedFilesList');
                    const selectedCount = document.getElementById('selectedCount');

                    const renderSelectedFiles = (files) => {
                        const arr = Array.from(files || []);
                        if (selectedCount) selectedCount.textContent = arr.length + (arr.length === 1 ? ' file' : ' file');
                        if (!selectedFilesList) return;

                        selectedFilesList.innerHTML = '';
                        if (!arr.length) {
                            const li = document.createElement('li');
                            li.className = 'text-gray-500 italic';
                            li.textContent = 'No file selected.';
                            selectedFilesList.appendChild(li);
                            return;
                        }
                        arr.forEach(f => {
                            const li = document.createElement('li');
                            li.className = 'flex items-center justify-between gap-3';

                            const left = document.createElement('span');
                            left.className = 'truncate';
                            left.textContent = f.name;

                            const right = document.createElement('span');
                            right.className = 'text-xs text-gray-500 whitespace-nowrap';
                            right.textContent = Math.ceil(f.size / 1024) + ' KB';

                            li.appendChild(left);
                            li.appendChild(right);
                            selectedFilesList.appendChild(li);
                        });
                    };

                    if (attachmentsInput) {
                        attachmentsInput.value = '';
                        renderSelectedFiles([]);
                        attachmentsInput.onchange = (e) => renderSelectedFiles(e.target.files);
                    }
                }

                if (modalId === 'logCommentModal') {
                    const r = document.getElementById('commentRowId');
                    const i = document.getElementById('commentItemName');
                    const rInput = document.getElementById('commentRowIdInput');

                    if (r) r.textContent = rowId || '-';
                    if (i) i.textContent = itemName || '-';
                    if (rInput) rInput.value = rowId || '';
                }

                if (modalId === 'logActivityModal') {
                    const r = document.getElementById('activityRowId');
                    const i = document.getElementById('activityItemName');

                    if (r) r.textContent = rowId || '-';
                    if (i) i.textContent = itemName || '-';
                }
            };

            // Open modal buttons
            document.querySelectorAll('[data-open-modal]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-open-modal');
                    const rowId = btn.getAttribute('data-row-id');
                    const itemName = btn.getAttribute('data-item-name');
                    if (id) {
                        setContext(id, rowId, itemName);
                        open(id);
                    }
                });
            });

            // Close modal buttons
            document.querySelectorAll('[data-close-modal]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-close-modal');
                    if (id) close(id);
                });
            });

            // Click backdrop closes (click on container itself)
            ['editHeaderModal','addRowModal','downloadModal','uploadModal','logCommentModal','logActivityModal'].forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                el.addEventListener('click', (e) => {
                    if (e.target === el) close(id);
                });
            });

            // ESC to close all
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    ['editHeaderModal','addRowModal','downloadModal','uploadModal','logCommentModal','logActivityModal'].forEach(close);
                }
            });
        })();
    </script>

</div>