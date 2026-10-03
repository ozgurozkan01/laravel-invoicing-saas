<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Invoices') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manage, track, and monitor payment statuses for all your client invoices.
                </p>
            </div>

            <a href="{{ route('invoices.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create Invoice</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="w-full max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

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
                    class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-fixed text-sm text-gray-600 dark:text-gray-300">
                        <thead
                            class="bg-gray-50/50 dark:bg-gray-900/50 text-xs font-semibold text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                            <tr>
                                <th class="w-[12%] px-6 py-4">Invoice ID</th>
                                <th class="w-[15%] px-6 py-4">Title</th>
                                <th class="w-[15%] px-6 py-4">Owner / Client</th>
                                <th class="w-[12%] px-6 py-4 text-right">Amount</th>
                                <th class="w-[10%] px-6 py-4 text-center">Invoice Status</th>
                                <th class="w-[10%] px-6 py-4 text-center">Payment Status</th>
                                <th class="w-[8%] px-6 py-4 text-center whitespace-nowrap">Issue On</th>
                                <th class="w-[8%] px-6 py-4 text-center whitespace-nowrap">Due Date</th>
                                <th class="w-[8%] px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @forelse ($invoices as $invoice)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">

                                    <td class="px-6 py-4 font-mono text-xs font-semibold text-gray-900 dark:text-white">
                                        #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="min-w-0">
                                            <div
                                                class="font-semibold text-gray-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                                {{ $invoice->title }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 font-semibold text-xs flex items-center justify-center border border-indigo-100 dark:border-indigo-900/50 flex-shrink-0">
                                                {{ strtoupper(substr($invoice->client?->name ?? 'NA', 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white">
                                                    {{ $invoice->client?->name ?? 'Unknown Client' }}
                                                </div>
                                                <div class="text-[11px] text-gray-400">
                                                    @if (!empty($invoice->client?->company_name))
                                                        • {{ $invoice->client->company_name }}
                                                    @else
                                                        • {{ 'Individual' }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-right font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($invoice->amount, 2) }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span data-status="{{ $invoice->status->value }}"
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $invoice->status->badgeClass() }}">
                                            {{ $invoice->status->label() }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span data-status="{{ $invoice->status->value }}"
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $invoice->payment_status->badgeClass() }}">
                                            {{ $invoice->payment_status->label() }}
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 text-center text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d, Y') }}
                                    </td>

                                    <td
                                        class="px-6 py-4 text-center text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <div class="inline-flex items-center justify-center gap-1.5">
                                            @if ($invoice->status->value === 'draft')
                                                <a href="{{ route('invoices.edit', $invoice) }}" title="Edit Invoice"
                                                    class="p-1 text-indigo-400 hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>

                                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                                    class="inline-flex"
                                                    onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete Invoice"
                                                        class="p-1 text-rose-400 hover:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-lg transition-colors cursor-pointer">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('invoices.show', $invoice) }}" title="View Invoice"
                                                class="p-1 text-gray-400 hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700/60 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 mb-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">No
                                                invoices found</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-sm">
                                                You haven't issued any invoices yet. Create your first invoice to get
                                                started.
                                            </p>
                                            <a href="{{ route('invoices.create') }}"
                                                class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium rounded-lg shadow-sm transition">
                                                + Issue First Invoice
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (method_exists($invoices, 'hasPages') && $invoices->hasPages())
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $invoices->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
