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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

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
                                <th class="w-[17%] px-6 py-4">Title</th>
                                <th class="w-[19%] px-6 py-4">Owner / Client</th>
                                <th class="w-[12%] px-6 py-4 text-right">Amount</th>
                                <th class="w-[12%] px-6 py-4 text-center">Status</th>
                                <th class="w-[10%] px-6 py-4 whitespace-nowrap">Issue On</th>
                                <th class="w-[10%] px-6 py-4 whitespace-nowrap">Due Date</th>
                                <th class="w-[8%] px-6 py-4 text-right">Actions</th>
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

                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                        ${{ number_format($invoice->amount, 2) }}
                                    </td>

                                    <!-- Status Badges -->
                                    <td class="px-6 py-4">
                                        @if ($invoice->status === 'paid')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                Paid
                                            </span>
                                        @elseif ($invoice->status === 'sent')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border border-blue-200 dark:border-blue-800">
                                                Sent
                                            </span>
                                        @elseif ($invoice->status === 'overdue')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                                                Overdue
                                            </span>
                                        @elseif ($invoice->status === 'cancelled')
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-200 dark:bg-red-500 text-red-600 dark:text-red-200 border border-red-400 dark:border-red-200">
                                                Cancelled
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 border border-gray-200 dark:border-gray-600">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Due Date -->
                                    <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                                    </td>

                                    <!-- Issue On (Dolu alan) -->
                                    <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                                        {{ \Carbon\Carbon::parse($invoice->created_at)->format('M d, Y') }}
                                    </td>

                                    <!-- Modern Actions (İkon Butonlar) -->
                                    <td class="px-2 py-4 text-right">
                                        <div class="flex items-center justify-end gap-0">
                                            @if ($invoice->status === 'draft')
                                                <a href="{{ route('invoices.edit', $invoice) }}" title="Edit Invoice"
                                                    class="p-2 text-indigo-400 hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            @endif
                                            <a href="{{ route('invoices.show', $invoice) }}" title="View Invoice"
                                                class="p-0 text-gray-400 hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700/60 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this invoice?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" title="Delete Invoice"
                                                    class="p-2 text-rose-400 hover:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-950/40 rounded-lg transition-colors cursor-pointer">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
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
