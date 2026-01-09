@php
    /**
     * WHATSAPP REMINDER (NO BACKEND)
     * - Default message tampil dan editable (textarea)
     * - Penerima dipilih (tidak hardcode)
     * - Tombol send/copy ukuran normal
     * - Table pending items tetap ada
     */

    $clientName = 'PT Sample A';
    $today = now()->format('d M Y');

    // Dummy penerima (frontend only) - nanti tinggal ganti dari DB
    $recipients = [
        ['id' => 1, 'name' => 'Bapak Andi', 'role' => 'PIC Keuangan', 'phone' => '6285810070278'],
        ['id' => 2, 'name' => 'Ibu Sari',  'role' => 'Admin',        'phone' => '6281234567890'],
        ['id' => 3, 'name' => 'Bapak Budi', 'role' => 'Direktur',    'phone' => '6287777777777'],
    ];

    // Pending items (table tetap ada)
    $pendingItems = [
        ['item' => 'Trial Balance', 'due' => '2025-01-10', 'aging' => 18],
        ['item' => 'General Ledger', 'due' => '2025-01-12', 'aging' => 16],
        ['item' => 'AR Aging', 'due' => '2025-01-15', 'aging' => 13],
    ];

    // Pesan default bawaan
    $lines = [];
    $lines[] = "Yth. {$recipients[0]['name']},";
    $lines[] = "";
    $lines[] = "Menindaklanjuti *data request audit* untuk *{$clientName}* per {$today}, berikut item yang masih *Pending*:";
    $lines[] = "";

    foreach ($pendingItems as $i => $p) {
        $lines[] = ($i + 1) . ". {$p['item']} (Due: {$p['due']}, Aging: {$p['aging']} hari)";
    }

    $lines[] = "";
    $lines[] = "Mohon dapat diunggah/ditindaklanjuti. Jika ada kendala, mohon info ya.";
    $lines[] = "";
    $lines[] = "Terima kasih.";
    $lines[] = "- Tim Audit";

    $defaultMessage = implode("\n", $lines);
@endphp

<div
    x-data="{
        clientName: @js($clientName),
        today: @js($today),
        recipients: @js($recipients),
        pending: @js($pendingItems),

        selectedId: String({{ $recipients[0]['id'] }}),
        message: @js($defaultMessage),

        get selected() {
            return this.recipients.find(r => String(r.id) === String(this.selectedId)) || null
        },

        sanitizePhone(phone) {
            return (phone || '').toString().replace(/[^0-9]/g, '')
        },

        // hanya update baris pertama (Yth. ...)
        updateGreetingOnly() {
            if (!this.message) return;
            const lines = this.message.split('\n');
            if (lines.length && lines[0].trim().toLowerCase().startsWith('yth.')) {
                lines[0] = `Yth. ${this.selected?.name || 'Bapak/Ibu PIC'},`;
                this.message = lines.join('\n');
            }
        },

        waLink() {
            const phone = this.sanitizePhone(this.selected?.phone);
            if (!phone) return '#';
            return `https://wa.me/${phone}?text=${encodeURIComponent(this.message || '')}`
        },

        copy() {
            navigator.clipboard.writeText(this.message || '');
        }
    }"
    class="mt-6 rounded-lg border border-gray-200 bg-white p-4"
>
    {{-- HEADER --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div class="min-w-0">
            <h3 class="text-base font-semibold text-gray-900">WhatsApp Reminder (Pending Items)</h3>
            <p class="mt-1 text-sm text-gray-600">
                Client: <span class="font-semibold text-gray-900">{{ $clientName }}</span>
            </p>

            {{-- PILIH PENERIMA --}}
            <div class="mt-3">
                <label class="block text-sm font-semibold text-gray-900 mb-2">Pilih penerima</label>
                <select
                    x-model="selectedId"
                    @change="updateGreetingOnly()"
                    class="w-full sm:w-80 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-gray-400 focus:outline-none"
                >
                    @foreach($recipients as $r)
                        <option value="{{ $r['id'] }}">
                            {{ $r['name'] }} — {{ $r['role'] }} ({{ $r['phone'] }})
                        </option>
                    @endforeach
                </select>

                <p class="mt-2 text-xs text-gray-500">
                    Nomor sebaiknya format <span class="font-semibold">62xxxxxxxxxx</span> (tanpa +).
                </p>
            </div>
        </div>

        {{-- ACTION (UKURAN NORMAL) --}}

    </div>

    {{-- TEXTAREA EDITABLE (PESAN BAWAAN LANGSUNG MUNCUL) --}}
    <div class="mt-4">
        <div class="flex items-center justify-between">
            <label class="block text-sm font-semibold text-gray-900 mb-2">Pesan WhatsApp (Editable)</label>
            <p class="text-xs text-gray-500">
                <span class="font-semibold" x-text="(message || '').length"></span> chars
            </p>
        </div>

        <textarea
            x-model="message"
            rows="10"
            class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-gray-400 focus:outline-none"
            placeholder="Tulis pesan WhatsApp di sini..."
        ></textarea>

        <p class="mt-2 text-xs text-gray-500">
            Pesan di atas adalah template bawaan dan bisa kamu edit sebelum dikirim.
        </p>
        <br>
        <div class="flex gap-2">
            <a
                :href="waLink()"
                target="_blank"
                class="inline-flex items-center rounded border border-green-600 bg-green-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-green-700"
                :class="(!selected?.phone || !(message && message.trim().length) ? 'opacity-50 pointer-events-none' : '')"
            >
                Send
            </a>

            <button
                type="button"
                @click="copy()"
                class="inline-flex items-center rounded border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-100"
                :class="(!(message && message.trim().length) ? 'opacity-50 pointer-events-none' : '')"
            >
                Copy
            </button>
        </div>
    </div>

    {{-- TABLE PENDING ITEMS (TETAP ADA) --}}
    <div class="mt-6">
        <p class="text-sm font-semibold text-gray-900 mb-2">Pending List</p>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left w-14 font-semibold text-gray-900">No</th>
                        <th class="px-4 py-2 text-left font-semibold text-gray-900">Item</th>
                        <th class="px-4 py-2 text-left w-32 font-semibold text-gray-900">Due</th>
                        <th class="px-4 py-2 text-left w-28 font-semibold text-gray-900">Aging</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingItems as $i => $p)
                        <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">
                            <td class="px-4 py-2">{{ $i + 1 }}</td>
                            <td class="px-4 py-2">{{ $p['item'] }}</td>
                            <td class="px-4 py-2">{{ $p['due'] }}</td>
                            <td class="px-4 py-2">{{ $p['aging'] }} hari</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>