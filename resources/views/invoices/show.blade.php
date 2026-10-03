<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('invoices.index') }}" class="hover:text-indigo-600 transition">Invoices</a>
                    <span>/</span>
                    <span
                        class="text-gray-900 dark:text-white">#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('invoices.index') }}"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    ← Back to invoices
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('error'))
                <div
                    class="mb-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if (session('success'))
                <div
                    class="flex items-center gap-3 p-4 mb-6 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <div class="lg:col-span-8 space-y-6">

                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/80 p-6 sm:p-7 shadow-xs">
                        <div
                            class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700/70 mb-5">
                            <div class="flex items-center gap-2.5">
                                <div
                                    class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Billed To</h3>
                            </div>

                            @if (Route::has('clients.show') && isset($invoice->client))
                                <a href="{{ route('clients.show', $invoice->client) }}"
                                    class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 inline-flex items-center gap-1 group">
                                    <span>View Profile</span>
                                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endif
                        </div>

                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-50 to-indigo-100/70 dark:from-indigo-950/50 dark:to-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-bold text-base flex items-center justify-center border border-indigo-100/80 dark:border-indigo-800/40 flex-shrink-0 shadow-2xs">
                                {{ strtoupper(substr($invoice->client->name ?? 'NA', 0, 2)) }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white">
                                        {{ $invoice->client->name ?? 'Unknown Client' }}
                                    </h4>
                                    @if (!empty($invoice->client->company_name))
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-gray-100 dark:bg-gray-700/60 text-gray-600 dark:text-gray-300">
                                            {{ $invoice->client->company_name }}
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-2.5 space-y-1.5 text-xs text-gray-500 dark:text-gray-400">
                                    @if (!empty($invoice->client->email))
                                        <a href="mailto:{{ $invoice->client->email }}"
                                            class="flex items-center gap-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors group w-fit">
                                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-indigo-500 transition-colors flex-shrink-0"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                            </svg>
                                            <span class="truncate">{{ $invoice->client->email }}</span>
                                        </a>
                                    @endif

                                    @if (!empty($invoice->client->phone))
                                        <a href="tel:{{ $invoice->client->phone }}"
                                            class="flex items-center gap-2 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors group w-fit">
                                            <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-indigo-500 transition-colors flex-shrink-0"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                            </svg>
                                            <span>{{ $invoice->client->phone }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-5 p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-900/40 border border-gray-100 dark:border-gray-700/60">
                            <div
                                class="flex items-center gap-1.5 text-[11px] font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500 mb-1.5">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span>Billing Address</span>
                            </div>

                            @if (!empty($invoice->billing_address))
                                <p class="text-xs sm:text-sm text-gray-700 dark:text-gray-300 leading-relaxed pl-5">
                                    {{ $invoice->billing_address }}@if (!empty($invoice->billing_city))
                                        , {{ $invoice->billing_city }}
                                    @endif
                                    @if (!empty($invoice->billing_state))
                                        , {{ $invoice->billing_state }}
                                    @endif
                                    @if (!empty($invoice->billing_postal_code))
                                        <span
                                            class="font-mono text-xs font-semibold bg-gray-200/50 dark:bg-gray-700/50 px-1.5 py-0.5 rounded ml-1">{{ $invoice->billing_postal_code }}</span>
                                    @endif
                                </p>
                            @else
                                <p class="text-xs text-gray-400 italic pl-5">No billing address on file</p>
                            @endif
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/80 p-6 sm:p-7 shadow-xs">
                        <!-- Header -->
                        <div
                            class="flex items-center justify-between pb-5 border-b border-gray-100 dark:border-gray-700/70">
                            <div class="flex items-center gap-2.5">
                                <div
                                    class="w-8 h-8 rounded-lg bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm0 5.25h.007v.008H3.75V12Zm0 5.25h.007v.008H3.75v-.008Z" />
                                    </svg>
                                </div>
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Line Items</h3>
                            </div>

                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                {{ $invoice->invoiceItems->count() }}
                                {{ Str::plural('item', $invoice->invoiceItems->count()) }}
                            </span>
                        </div>

                        <!-- Table Container -->
                        <div class="overflow-x-auto -mx-6 sm:mx-0 px-6 sm:px-0">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="border-b border-gray-150 dark:border-gray-700/60 text-[11px] font-semibold tracking-wider uppercase text-gray-400 dark:text-gray-500">
                                        <th class="py-3.5 pl-2">Description</th>
                                        <th class="py-3.5 px-3 text-center sm:text-left">Qty</th>
                                        <th class="py-3.5 px-3 text-right">Unit Price</th>
                                        <th class="py-3.5 pr-2 text-right">Amount</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                                    @foreach ($invoice->invoiceItems as $item)
                                        <tr
                                            class="group hover:bg-gray-50/60 dark:hover:bg-gray-900/30 transition-colors">
                                            <td class="py-4 pl-2 pr-4 align-top">
                                                <span
                                                    class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                    {{ $item->description }}
                                                </span>
                                            </td>

                                            <td class="py-4 px-3 align-top whitespace-nowrap text-center sm:text-left">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-gray-100 dark:bg-gray-700/60 text-gray-700 dark:text-gray-300 font-mono">
                                                    {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}
                                                    @if ($item->unit)
                                                        <span
                                                            class="ml-1 text-gray-400 font-sans font-normal">{{ $item->unit }}</span>
                                                    @endif
                                                </span>
                                            </td>

                                            <td
                                                class="py-4 px-3 align-top text-right whitespace-nowrap text-sm text-gray-600 dark:text-gray-400 font-mono">
                                                ${{ number_format($item->unit_price, 2) }}
                                            </td>

                                            <td
                                                class="py-4 pr-2 pl-3 align-top text-right whitespace-nowrap text-sm font-semibold text-gray-900 dark:text-white font-mono">
                                                ${{ number_format($item->quantity * $item->unit_price, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($invoice->payments->count() > 0)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/80 p-6 shadow-xs">
                            <div class="flex items-center justify-between mb-5">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0v2.25m0-2.25l4.5 4.5m14.25-4.5h-.75A.75.75 0 0 0 19.5 6h-.75m0 0v2.25m0-2.25l-4.5 4.5m0 0 4.5 4.5m-4.5-4.5L12 9m0 0-4.5 4.5m0 0-4.5-4.5M12 9V3" />
                                        </svg>
                                    </div>
                                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Payment History</h3>
                                </div>

                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                                    {{ $invoice->payments->count() }}
                                    {{ \Illuminate\Support\Str::plural('payment', $invoice->payments->count()) }}
                                </span>
                            </div>

                            <div class="space-y-2.5">
                                @foreach ($invoice->payments as $payment)
                                    <div
                                        class="group flex items-center justify-between p-3.5 rounded-xl bg-gray-50/70 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700/60 hover:border-gray-200 dark:hover:border-gray-600 transition-all duration-200">
                                        <div class="flex items-center gap-3.5">
                                            <div
                                                class="flex-shrink-0 w-9 h-9 rounded-xl bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-2xs">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->method ?? 'Payment')) }}
                                                    </p>
                                                    @if (!empty($payment->transaction_id))
                                                        <span
                                                            class="text-[11px] font-mono text-gray-400 bg-gray-200/60 dark:bg-gray-700/60 px-1.5 py-0.5 rounded">
                                                            #{{ \Illuminate\Support\Str::limit($payment->transaction_id, 8) }}
                                                        </span>
                                                    @endif
                                                </div>
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                                                    {{ $payment->paid_at->format('M d, Y') }}
                                                    <span class="text-gray-300 dark:text-gray-600">·</span>
                                                    {{ $payment->paid_at->format('H:i') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <p
                                                class="text-sm font-bold tracking-tight text-emerald-600 dark:text-emerald-400">
                                                +${{ number_format($payment->amount, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($invoice->payment_status !== \App\Enums\PaymentStatus::PAID && $invoice->status === \App\Enums\InvoiceStatus::SENT)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-150 dark:border-gray-700/80 p-6 sm:p-7 shadow-xs relative overflow-hidden">

                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Record Payment
                                        </h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Manually log a transaction
                                            for this invoice</p>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('payments.store', $invoice) }}" method="POST" class="space-y-5">
                                @csrf

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <div>
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label
                                                class="block text-xs font-semibold text-gray-700 dark:text-gray-300">
                                                Amount <span class="text-rose-500">*</span>
                                            </label>
                                            <button type="button"
                                                onclick="document.getElementById('amount_input').value = '{{ $invoice->remaining_amount }}'"
                                                class="text-[11px] font-semibold text-emerald-600 dark:text-emerald-400 hover:underline cursor-pointer">
                                                Pay in full
                                            </button>
                                        </div>
                                        <div class="relative rounded-xl shadow-2xs">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400 dark:text-gray-500 font-medium sm:text-sm">
                                                $
                                            </div>
                                            <input type="number" id="amount_input" step="0.01" name="amount"
                                                min="0.01" max="{{ $invoice->remaining_amount }}"
                                                placeholder="0.00" required
                                                class="block w-full pl-8 pr-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm font-mono focus:bg-white dark:focus:bg-gray-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition">
                                        </div>
                                        @error('amount')
                                            <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 font-medium">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                            Date Paid <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="date" name="paid_at"
                                            min="{{ $invoice->created_at->format('Y-m-d') }}"
                                            max="{{ now()->format('Y-m-d') }}" value="{{ now()->format('Y-m-d') }}"
                                            required
                                            class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition">
                                        @error('paid_at')
                                            <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 font-medium">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                                            Payment Method <span class="text-rose-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select name="method" required
                                                class="appearance-none block w-full px-3.5 py-2.5 pr-10 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:outline-none transition">
                                                <option value="bank_transfer">🏦 Bank Transfer</option>
                                                <option value="credit_card">💳 Credit Card</option>
                                                <option value="cash">💵 Cash</option>
                                                <option value="online">⚡ Online Payment</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </div>
                                        @error('method')
                                            <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 font-medium">
                                                {{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="pt-2 flex flex-col sm:flex-row items-center justify-end gap-3">
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-2.5 px-6 rounded-xl text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-500 active:scale-[0.98] shadow-sm shadow-emerald-600/30 transition-all duration-150 cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <span>Record Payment</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>

                <div class="lg:col-span-4 sticky top-6 space-y-6">

                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">
                        <div
                            class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Invoice
                                Details</span>
                            <span
                                class="font-mono text-xs text-gray-500 dark:text-gray-400 font-medium">#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Invoice Status</span>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border  {{ $invoice->status->badgeClass() }}">
                                {{ $invoice->status->label() }}
                            </span>
                        </div>

                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Payment Status</span>
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold border {{ $invoice->payment_status->badgeClass() }}">
                                {{ $invoice->payment_status->label() }}
                            </span>
                        </div>

                        @if ($invoice->is_overdue)
                            <div
                                class="py-3 px-3 my-2 border border-rose-200 dark:border-rose-800/60 bg-rose-50 dark:bg-rose-950/40 rounded-xl flex justify-between items-center">
                                <span
                                    class="text-xs font-bold text-rose-700 dark:text-rose-400 flex items-center gap-1.5 uppercase tracking-wide">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Overdue
                                </span>
                                <span class="text-xs font-medium text-rose-600 dark:text-rose-400">
                                    {{ $invoice->due_date->diffForHumans() }}
                                </span>
                            </div>
                        @endif

                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Issued On</span>
                            <span
                                class="text-sm font-semibold text-gray-900 dark:text-white">{{ $invoice->created_at->format('M d, Y') }}</span>
                        </div>
                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Due Date</span>
                            <span
                                class="text-sm font-semibold text-gray-900 dark:text-white">{{ $invoice->due_date->format('M d, Y') }}</span>
                        </div>

                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Line Items</span>
                            <span
                                class="text-sm font-semibold text-gray-900 dark:text-white">{{ $invoice->invoiceItems->count() }}</span>
                        </div>

                        <div class="py-5 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Subtotal</span>
                                <span
                                    class="text-gray-900 dark:text-white">${{ number_format($invoice->amount, 2) }}</span>
                            </div>
                            @if ($invoice->paid_amount > 0)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Amount Paid</span>
                                    <span
                                        class="text-emerald-600 dark:text-emerald-400">-${{ number_format($invoice->paid_amount, 2) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="py-5 text-center border-t border-gray-100 dark:border-gray-700">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">
                                {{ $invoice->payment_status === \App\Enums\PaymentStatus::PAID ? 'Total Amount' : 'Remaining Amount Due' }}
                            </span>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                ${{ number_format($invoice->remaining_amount, 2) }}
                            </div>
                        </div>

                        <div class="pt-4 space-y-2.5">

                            @if ($invoice->status === \App\Enums\InvoiceStatus::DRAFT)
                                <form action="{{ route('invoices.mark-as-sent', $invoice) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold shadow-md shadow-indigo-600/20 active:scale-[0.99] transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>Mark as Sent</span>
                                    </button>
                                </form>
                            @endif

                            <div
                                class="grid {{ $invoice->status === \App\Enums\InvoiceStatus::DRAFT ? 'grid-cols-2' : 'grid-cols-1' }} gap-2">
                                <a href="{{ route('invoices.pdf', $invoice) }}" target="_blank"
                                    class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 hover:bg-gray-50 dark:hover:bg-gray-700/60 text-gray-700 dark:text-gray-200 text-xs font-medium transition shadow-sm">
                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>PDF</span>
                                </a>

                                @if ($invoice->status === \App\Enums\InvoiceStatus::DRAFT)
                                    <a href="{{ route('invoices.edit', $invoice) }}"
                                        class="flex items-center justify-center gap-1.5 py-2 px-3 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800/80 hover:bg-gray-50 dark:hover:bg-gray-700/60 text-gray-700 dark:text-gray-200 text-xs font-medium transition shadow-sm">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>
                                @endif
                            </div>

                            <div
                                class="pt-2 border-t border-gray-100 dark:border-gray-800 flex items-center justify-center gap-4">
                                @if (
                                    $invoice->status !== \App\Enums\InvoiceStatus::CANCELLED &&
                                        $invoice->payment_status !== \App\Enums\PaymentStatus::PAID)
                                    <form action="{{ route('invoices.cancel', $invoice) }}" method="POST"
                                        onsubmit="return confirm('Cancel this invoice? Cancelled invoices are returned to your quota.')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="text-xs font-medium text-amber-500 hover:text-amber-400 transition cursor-pointer">
                                            Cancel Invoice
                                        </button>
                                    </form>
                                @endif

                                @can('delete', $invoice)
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this invoice?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs font-medium text-rose-500/80 hover:text-rose-400 transition cursor-pointer">
                                            Delete Invoice
                                        </button>
                                    </form>
                                @endcan
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
