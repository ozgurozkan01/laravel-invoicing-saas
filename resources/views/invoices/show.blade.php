<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
            Invoice #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">Billed To</h3>
                        <p class="text-base font-bold text-gray-900 dark:text-white">{{ $invoice->client->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $invoice->billing_address }}, {{ $invoice->billing_city }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Due Date</p>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}
                        </p>
                    </div>
                </div>

                <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300 mb-6">
                    <thead class="text-xs uppercase text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                        <tr>
                            <th class="py-2">Description</th>
                            <th class="py-2">Qty</th>
                            <th class="py-2">Unit</th>
                            <th class="py-2">Unit Price</th>
                            <th class="py-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($invoice->invoiceItems as $item)
                            <tr>
                                <td class="py-2">{{ $item->description }}</td>
                                <td class="py-2">{{ $item->quantity }}</td>
                                <td class="py-2">{{ $item->unit }}</td>
                                <td class="py-2">${{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-2 text-right">${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="flex justify-end">
                    <div class="text-right">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total Amount</p>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($invoice->amount, 2) }}</p>
                    </div>
                </div>
            </div>

            <a href="{{ route('invoices.index') }}" class="text-sm text-indigo-600 hover:text-indigo-500">← Back to Invoices</a>

        </div>
    </div>
</x-app-layout>