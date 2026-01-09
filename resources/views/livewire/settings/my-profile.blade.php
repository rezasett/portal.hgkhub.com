<div class="min-h-screen bg-slate-100 flex flex-col">

 
    {{-- MAIN WRAPPER --}}
    <div class="flex-1 flex flex-col lg:flex-row mx-auto w-full">

       

        {{-- MAIN SECTION (profile + content) --}}
        <main class="flex-1 flex flex-col lg:flex-row">

            

            {{-- LEFT: CLIENT PROFILE --}}
            <section class="w-full lg:w-80 bg-white border-r border-slate-200 p-6 space-y-6">
                <div class="flex items-center justify-between">
                    <div class="text-xs text-slate-400">My Profile</div>
                    <button class="text-xs text-blue-950">✏ Edit</button>
                </div>

                <div class="flex flex-col items-center space-y-3">
                    <div class="relative">
                        <img
                            src="https://via.placeholder.com/96"
                            class="w-24 h-24 rounded-full object-cover"
                            alt="Client"
                        >
                        <span
                            class="absolute -bottom-1 left-1/2 -translate-x-1/2 bg-blue-950 text-white text-[11px] px-2 py-0.5 rounded-full shadow"
                        >
                            Audit Client
                        </span>
                    </div>

                    <h2 class="text-lg font-semibold">PT Sumber Makmur Tbk</h2>

                    <div class="flex space-x-4 text-xs text-slate-500">
                        <button class="flex flex-col items-center">
                            <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[13px]">📝</span>
                            Note
                        </button>
                        <button class="flex flex-col items-center">
                            <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[13px]">📌</span>
                            Risks
                        </button>
                        <button class="flex flex-col items-center">
                            <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[13px]">📑</span>
                            WP
                        </button>
                        <button class="flex flex-col items-center">
                            <span class="w-7 h-7 rounded-full bg-slate-100 flex items-center justify-center text-[13px]">✉</span>
                            Email
                        </button>
                    </div>
                </div>

                <div class="space-y-3">
                    <div>
                        <div class="text-[11px] text-slate-400">Next Meeting</div>
                        <div class="mt-1 px-3 py-2 bg-slate-50 rounded-lg text-sm flex justify-between">
                            <span>Feb 10, 2025</span>
                            <span>10:00 am</span>
                        </div>
                    </div>

                    <div>
                        <div class="text-[11px] text-slate-400">Last Discussion</div>
                        <div class="mt-1 px-3 py-2 bg-slate-50 rounded-lg text-sm">
                            Jan 25, 2025
                        </div>
                    </div>
                </div>

                <div class="space-y-2 text-xs">
                    <div class="flex items-center space-x-2">
                        <span>✉</span>
                        <a href="#" class="text-blue-950">info@hgkfirm.com</a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>📞</span>
                        <span>021-75930431</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span>🌐</span>
                        <a href="https://www.hgkfirm.com/" class="text-blue-950">https://www.hgkfirm.com</a>
                    </div>
                </div>

                {{-- BIO TETAP, TIDAK DIUBAH --}}
                <div>
                    <div class="text-sm font-semibold mb-1">Bio</div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        KAP HERTANTO, GRACE, KARUNAWAN (HGK) is an independent member firm of TIAG International.
                        We are supported by competent and professional expertise and located in Jakarta.
                        We provide audit and assurance services, and business consulting to government, public,
                        and private institutions.
                    </p>
                    <p class="mt-2 text-[11px] text-slate-400 leading-relaxed">
                        An Independent Member Firm of TIAG - A Worldwide Alliance of Independent Accounting Firms.
                        <br>
                        Anggota Independen dari TIAG International - Aliansi Dunia dari Firma Akuntansi Independen.
                    </p>
                </div>

                <div class="flex space-x-3 text-lg text-slate-400 pt-2 border-t border-slate-100">
                    <a href="#">in</a>
                    <a href="#">f</a>
                    <a href="#">tw</a>
                </div>
            </section>

            {{-- RIGHT: MAIN CONTENT (AUDIT) --}}
            <section class="flex-1 p-4 sm:p-6 space-y-4">
                {{-- Tabs --}}
                <div class="border-b border-slate-200 flex space-x-6 text-xs sm:text-sm text-slate-500 font-medium">
                    <button class="pb-2 border-b-2 border-transparent hover:text-blue-950">
                        Notes
                    </button>
                    <button class="pb-2 border-b-2 border-blue-950 text-blue-950">
                        Audit Engagements
                    </button>
                    <button class="pb-2 border-b-2 border-transparent hover:text-blue-950">
                        Working Papers
                    </button>
                    <button class="pb-2 border-b-2 border-transparent hover:text-blue-950 hidden sm:inline">
                        Task List
                    </button>
                    <button class="pb-2 border-b-2 border-transparent hover:text-blue-950 hidden sm:inline">
                        Activity
                    </button>
                </div>

                {{-- CARD LIST --}}
                <div class="space-y-4">
                    {{-- Engagement card 1 --}}
                    <article class="bg-white rounded-xl shadow-sm border border-slate-100">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between px-4 py-3 border-b border-slate-100 text-xs text-slate-400">
                            <span>FY 2024 Audit — Planning completed</span>
                            <span class="mt-1 sm:mt-0">Rp 350.000.000</span>
                        </div>
                        <div class="px-4 py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-semibold text-slate-800">
                                Audit of Financial Statements PT Sumber Makmur Tbk
                            </h3>
                            <div class="flex items-center space-x-3 text-xs">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 font-semibold">
                                    FIELDWORK
                                </span>
                                <button class="text-blue-700 font-medium">View Audit Plan</button>
                                <button class="text-slate-400 text-lg">▾</button>
                            </div>
                        </div>
                    </article>

                    {{-- Engagement card 2 with billing schedule --}}
                    <article class="bg-white rounded-xl shadow-sm border border-slate-100">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between px-4 py-3 border-b border-slate-100 text-xs text-slate-400">
                            <span>FY 2024 Audit — Engagement signed</span>
                            <span class="mt-1 sm:mt-0">Rp 500.000.000</span>
                        </div>

                        <div
                            class="px-4 py-3 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-semibold text-slate-800">
                                Audit of Financial Statements PT Prima Logistik
                            </h3>
                            <div class="flex items-center space-x-3 text-xs">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full bg-sky-50 text-sky-600 font-semibold">
                                    IN PLANNING
                                </span>
                                <button class="text-slate-400 text-lg">▾</button>
                            </div>
                        </div>

                        {{-- Billing plan table --}}
                        <div class="px-4 py-4 bg-slate-50 rounded-b-xl">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div class="flex-1">
                                    <div class="text-xs font-semibold text-slate-500 mb-2">
                                        Audit Fee Schedule
                                    </div>
                                    <div class="bg-white rounded-lg shadow-sm border border-slate-100">
                                        <div
                                            class="grid grid-cols-3 text-xs font-semibold text-slate-500 border-b border-slate-100">
                                            <div class="px-3 py-2">Due Date</div>
                                            <div class="px-3 py-2">Invoice</div>
                                            <div class="px-3 py-2 text-right">Status</div>
                                        </div>
                                        <div class="divide-y divide-slate-100 text-xs">
                                            <div class="grid grid-cols-3 px-3 py-2">
                                                <span>Jan 31, 2025</span>
                                                <span>Rp 150.000.000</span>
                                                <span class="text-right text-emerald-500 font-semibold">PAID</span>
                                            </div>
                                            <div class="grid grid-cols-3 px-3 py-2">
                                                <span>Mar 31, 2025</span>
                                                <span>Rp 200.000.000</span>
                                                <span class="text-right text-emerald-500 font-semibold">PAID</span>
                                            </div>
                                            <div class="grid grid-cols-3 px-3 py-2">
                                                <span>May 31, 2025</span>
                                                <span>Rp 150.000.000</span>
                                                <span class="text-right text-amber-500 font-semibold">PENDING</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full sm:w-60 space-y-2">
                                    <div class="text-xs font-semibold text-slate-500">
                                        Outstanding Fee Balance – Rp 150.000.000
                                    </div>
                                    <div class="space-y-2 text-xs">
                                        <button
                                            class="w-full py-2 rounded-lg bg-blue-950 text-white font-semibold text-sm">
                                            View Billing Details
                                        </button>
                                        <button
                                            class="w-full py-2 rounded-lg border border-slate-300 text-slate-700">
                                            Send Reminder Email
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    {{-- Engagement card 3 --}}
                    <article class="bg-white rounded-xl shadow-sm border border-slate-100">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between px-4 py-3 border-b border-slate-100 text-xs text-slate-400">
                            <span>Review engagement — fieldwork finished</span>
                            <span class="mt-1 sm:mt-0">Rp 120.000.000</span>
                        </div>
                        <div class="px-4 py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-semibold text-slate-800">
                                Review of Financial Information Koperasi Sejahtera 2024
                            </h3>

                            <div class="flex items-center space-x-3 text-xs">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full bg-sky-50 text-sky-600 font-semibold">
                                    REVIEW
                                </span>
                                <button class="text-blue-700 font-medium">Draft Report</button>
                                <button class="text-slate-400 text-lg">▾</button>
                            </div>
                        </div>
                    </article>

                    {{-- Engagement card 4 --}}
                    <article class="bg-white rounded-xl shadow-sm border border-slate-100">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between px-4 py-3 border-b border-slate-100 text-xs text-slate-400">
                            <span>Agreed-Upon Procedures — completed</span>
                            <span class="mt-1 sm:mt-0">Rp 80.000.000</span>
                        </div>
                        <div class="px-4 py-3 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <h3 class="text-sm sm:text-base font-semibold text-slate-800">
                                AUP on Specific Accounts Dana Pensiun ABC
                            </h3>

                            <div class="flex items-center space-x-3 text-xs">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 font-semibold">
                                    COMPLETED
                                </span>
                                <button class="text-blue-700 font-medium">View Report</button>
                                <button class="text-slate-400 text-lg">▾</button>
                            </div>
                        </div>
                    </article>
                </div>

                {{-- FOOTER BOTTOM --}}
                <div class="flex flex-col sm:flex-row justify-between items-center text-[11px] text-slate-400 mt-6">
                    <div class="flex space-x-3 mb-2 sm:mb-0">
                        <a href="https://www.airfield.ie/" class="hover:text-blue-950">Privacy Policy</a>
                        <a href="https://termify.io/" class="hover:text-blue-950">Terms of Use</a>
                    </div>
                    <span>Copyright © 2019 Delenta Inc. All Rights Reserved.</span>
                </div>
            </section>
        </main>
    </div>
</div>