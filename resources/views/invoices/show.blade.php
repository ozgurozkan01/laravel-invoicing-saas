<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('invoices.index') }}" class="hover:text-indigo-600 transition">Invoices</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white">#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    Invoice #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('invoices.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    ← Back to invoices
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="flex items-center gap-3 p-4 mb-6 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                <!-- ================= SOL ALAN (8 KOLON) ================= -->
                <div class="lg:col-span-8 space-y-6">

                    <!-- KART: Billed To -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white mb-4">Billed To</h3>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 font-bold text-base flex items-center justify-center border border-indigo-100 dark:border-indigo-900/50 flex-shrink-0">
                                {{ strtoupper(substr($invoice->client->name ?? 'NA', 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $invoice->client->name }}</p>
                                @if (!empty($invoice->client->company_name))
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $invoice->client->company_name }}</p>
                                @endif
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $invoice->client->email }}</p>
                                @if (!empty($invoice->client->phone))
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $invoice->client->phone }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1.5">Billing Address</h4>
                            @if (!empty($invoice->billing_address))
                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $invoice->billing_address }}
                                    @if (!empty($invoice->billing_city)), {{ $invoice->billing_city }}@endif
                                    @if (!empty($invoice->billing_state)), {{ $invoice->billing_state }}@endif
                                    @if (!empty($invoice->billing_postal_code)) {{ $invoice->billing_postal_code }}@endif
                                </p>
                            @else
                                <p class="text-sm text-gray-400 italic">No billing address on file</p>
                            @endif
                        </div>
                    </div>

                    <!-- KART: Line Items -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white">Line Items</h3>
                            <span class="text-xs font-semibold text-gray-400">{{ $invoice->invoiceItems->count() }} {{ Str::plural('item', $invoice->invoiceItems->count()) }}</span>
                        </div>

                        <div class="space-y-3">
                            @foreach ($invoice->invoiceItems as $item)
                                <div class="grid grid-cols-12 gap-3 items-center p-4 rounded-xl bg-gray-50/50 dark:bg-gray-900/40 border border-gray-100 dark:border-gray-700/60">
                                    <div class="col-span-12 sm:col-span-5">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Description</p>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->description }}</p>
                                    </div>
                                    <div class="col-span-4 sm:col-span-2">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Qty</p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }} {{ $item->unit ?: '' }}</p>
                                    </div>
                                    <div class="col-span-4 sm:col-span-2">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Unit Price</p>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">${{ number_format($item->unit_price, 2) }}</p>
                                    </div>
                                    <div class="col-span-4 sm:col-span-3 sm:text-right">
                                        <p class="text-xs text-gray-400 uppercase tracking-wider font-semibold mb-0.5">Total</p>
                                        <p class="text-sm font-bold text-gray-900 dark:text-white">${{ number_format($item->quantity * $item->unit_price, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <!-- ================= SAĞ ALAN / ÖZET PANELİ (4 KOLON - STICKY) ================= -->
                <div class="lg:col-span-4 sticky top-6 space-y-6">

                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Invoice Details</span>
                            <span class="font-mono text-xs text-gray-500 dark:text-gray-400 font-medium">#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>

                        <!-- Status -->
                        <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Status</span>
                            @if ($invoice->status === 'paid')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">Paid</span>
                            @elseif ($invoice->status === 'sent')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800">Sent</span>
                            @elseif ($invoice->status === 'overdue')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-800">Overdue</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">Draft</span>
                            @endif
                        </div>

                        <!-- Issue/Due Date -->
                        <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Issued On</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $invoice->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Due Date</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</span>
                        </div>

                        <!-- Line Item Count -->
                        <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Line Items</span>
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $invoice->invoiceItems->count() }}</span>
                        </div>

                        <!-- Subtotal / Total Breakdown -->
                        <div class="py-5 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Subtotal</span>
                                <span class="text-gray-900 dark:text-white">${{ number_format($invoice->amount, 2) }}</span>
                            </div>
                        </div>

                        <div class="py-5 text-center border-t border-gray-100 dark:border-gray-700">
                            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Amount Due</span>
                            <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                ${{ number_format($invoice->amount, 2) }}
                            </div>
                        </div>

                        <div class="pt-2 space-y-2.5">
                            <a href="{{ route('invoices.edit', $invoice) }}" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl border border-gray-200 dark:border-gray-700 text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                Edit Invoice
                            </a>
                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2.5 text-xs font-medium text-rose-600 hover:text-rose-700 transition">
                                    Delete Invoice
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>