<!-- Main Content -->
<div class="flex-1 bg-white p-4 pl-0.5">
  <div class="px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="sm:flex sm:items-start sm:justify-between gap-4">
      <div>
        <h1 class="text-base font-semibold text-gray-900">Client Prospect Data</h1>
        <p class="mt-1 text-sm text-gray-600">Prospect Dashboard</p>
      </div>

      <!-- Right actions -->
      <div class="flex flex-col items-end gap-3">
        <a
          href="#"
          class="inline-flex items-center rounded-full bg-blue-700 p-2 text-white shadow hover:bg-indigo-500"
          title="Add"
        >
          <svg class="size-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z"/>
          </svg>
        </a>

        <div class="relative w-full sm:w-72">
          <input
            type="text"
            placeholder="Search client..."
            class="w-full rounded-md border border-gray-300 pl-10 pr-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
          />
          <svg
            class="absolute left-3 top-2.5 h-4 w-4 text-gray-400"
            fill="none" stroke="currentColor" viewBox="0 0 24 24"
          >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Tabs -->
    <div class="mt-6 border-b border-gray-200">
      <div class="flex gap-6">
        <button
          class="border-b-2 border-blue-600 pb-3 text-sm font-semibold text-blue-700">
          Progress
        </button>
        <button
          class="pb-3 text-sm font-semibold text-gray-500 hover:text-green-600">
          Done
        </button>
      </div>
    </div>

    <!-- TABLE -->
    <div class="mt-6 overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left font-semibold text-gray-900 w-16">No</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-900">Client Name</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-900 w-40">Total Request</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-900 w-40">Total Received</th>
            <th class="px-4 py-2 text-left font-semibold text-gray-900 w-60">Action</th>
          </tr>
        </thead>

        <tbody>
          <!-- DATA ROW -->
          <tr class="bg-white">
            <td class="px-4 py-2">1</td>
            <td class="px-4 py-2">Sample</td>
            <td class="px-4 py-2">3</td>
            <td class="px-4 py-2">1</td>
            <td class="px-4 py-2">
              <a href="{{ route('dareq.dareq-client-detail') }}" class="text-blue-700 hover:underline font-medium">
                View
              </a>
              &nbsp;|&nbsp;              
              <a href="{{ route('dareq.dareq-client-notif-wa') }}" class="text-blue-700 hover:underline font-medium">
                Notify Auditor
              </a>
            </td>
          </tr>

          <!-- EMPTY STRIPED ROWS (SAMA PERSIS SEPERTI GAMBAR) -->
          <tr class="bg-gray-200"><td colspan="5" class="h-8"></td></tr>
          <tr class="bg-white"><td colspan="5" class="h-8"></td></tr>
          <tr class="bg-gray-200"><td colspan="5" class="h-8"></td></tr>
          <tr class="bg-white"><td colspan="5" class="h-8"></td></tr>
          <tr class="bg-gray-200"><td colspan="5" class="h-8"></td></tr>
          <tr class="bg-white"><td colspan="5" class="h-8"></td></tr>
        </tbody>
      </table>
    </div>

  </div>
</div>