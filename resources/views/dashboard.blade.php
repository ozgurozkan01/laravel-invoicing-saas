<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Overview') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Welcome back, {{ Auth::user()->name }}. Here is what’s happening with your business today.
                </p>
            </div>

            <!-- Quick Action Button -->
            <div class="flex items-center gap-3">
                <a href="{{ Route::has('invoices.create') ? route('invoices.create') : '#' }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Invoice
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- SECTION 1: Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Revenue -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue (MTD)</span>
                        <span class="p-2 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">$48,250.00</h3>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-1 font-medium">↑ +12.5% from last month</p>
                    </div>
                </div>

                <!-- Outstanding / Pending -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Outstanding Invoices</span>
                        <span class="p-2 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">$14,600.00</h3>
                        <p class="text-xs text-amber-600 dark:text-amber-400 mt-1 font-medium">3 invoices awaiting payment</p>
                    </div>
                </div>

                <!-- Active Clients -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Clients</span>
                        <span class="p-2 rounded-lg bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">24 Clients</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">2 new accounts this month</p>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Recent Invoices Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-6 flex items-center justify-between border-b border-gray-100 dark:border-gray-700">
                    <div>
                        <h3 class="font-bold text-lg text-gray-900 dark:text-white">Recent Invoices</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Latest billing activity and payment statuses</p>
                    </div>
                    <a href="{{ Route::has('invoices.index') ? route('invoices.index') : '#' }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                        View all invoices &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600 dark:text-gray-300">
                        <thead class="bg-gray-50/50 dark:bg-gray-700/50 text-xs uppercase font-medium text-gray-500 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4">Invoice ID</th>
                                <th class="px-6 py-4">Client</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Due Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            <!-- Row 1: Paid -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#INV-2026-001</td>
                                <td class="px-6 py-4 font-medium">Acme Corporation</td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">$12,500.00</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                        Paid
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">Sep 28, 2026</td>
                            </tr>
                            <!-- Row 2: Pending -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#INV-2026-002</td>
                                <td class="px-6 py-4 font-medium">Vertex Studio Ltd.</td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">$8,400.00</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800">
                                        Pending
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">Oct 05, 2026</td>
                            </tr>
                            <!-- Row 3: Overdue -->
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#INV-2026-003</td>
                                <td class="px-6 py-4 font-medium">Nova Digital Labs</td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">$3,700.00</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                                        Overdue
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500">Sep 15, 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>