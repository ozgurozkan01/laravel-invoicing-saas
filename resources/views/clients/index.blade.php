<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Clients') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Manage your client relationships, contact information, and billing details.
                </p>
            </div>

            <a href="{{ route('clients.create') }}" 
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Client
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Success Message -->
            @if (session('success'))
                <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm shadow-sm">
                    <svg class="w-5 h-5 flex-shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Clients Card & Table -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left table-fixed text-sm text-gray-600 dark:text-gray-300">
                        <thead 
                            class="bg-gray-50/50 dark:bg-gray-900/50 text-xs font-semibold text-gray-500 dark:text-gray-400 border-b border-gray-100 dark:border-gray-700">
                            <tr>
                                <th class="w-[27%] px-6 py-4">Client & Company</th>
                                <th class="w-[28%] px-6 py-4">Contact Info</th>
                                <th class="w-[15%] px-6 py-4">Invoice Info</th>
                                <th class="w-[15%] px-6 py-4">Client Since</th>
                                <th class="w-[15%] px-6 py-4 text-center whitespace-nowrap w-px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                            @forelse ($clients as $client)
                                <tr class="hover:bg-gray-50/75 dark:hover:bg-gray-700/25 transition">
                                    
                                    <!-- 1. Name & Company + Initials Avatar -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3.5">
                                            <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 font-bold text-xs flex items-center justify-center border border-indigo-100 dark:border-indigo-900/50 flex-shrink-0 shadow-sm">
                                                {{ strtoupper(substr($client->name, 0, 2)) }}
                                            </div>
                                            <div class="min-w-0">
                                                <div class="font-semibold text-gray-900 dark:text-white truncate">
                                                    {{ $client->name }}
                                                </div>
                                                <div class="text-xs text-gray-400 dark:text-gray-400 truncate">
                                                    {{ $client->company_name ?: ($client->client_type === 'corporate' ? 'Corporate Client' : 'Individual Client') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- 2. Contact Details (Email + Phone) -->
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col space-y-1">
                                            <a href="mailto:{{ $client->email }}" class="inline-flex items-center gap-1.5 text-xs text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-mono transition">
                                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $client->email }}
                                            </a>
                                            @if($client->phone)
                                                <a href="tel:{{ $client->phone }}" class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                                    <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                    </svg>
                                                    {{ $client->phone }}
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm">
                                        <div class="text-gray-900 dark:text-white font-medium">
                                            {{ $client->invoices_count }} {{ Str::plural('invoice', $client->invoices_count) }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            ${{ number_format($client->invoices_sum_amount ?? 0, 2) }}
                                        </div>
                                    </td>

                                    <!-- 4. Created At -->
                                    <td class="px-6 py-4">
                                        <div class="text-xs font-medium text-gray-700 dark:text-gray-300">
                                            {{ $client->created_at ? $client->created_at->format('M d, Y') : '-' }}
                                        </div>
                                        <div class="text-[11px] text-gray-400">
                                            {{ $client->created_at ? $client->created_at->diffForHumans() : '' }}
                                        </div>
                                    </td>

                                    <!-- 5. Actions (Modern Icon Buttons) -->
                                    <td class="px-11 py-4 text-right">
                                        <div class="flex items-center justify-end gap-0">
                                            <!-- 1. Edit (Mor Kalem) -->
                                            <a href="{{ route('clients.edit', $client) }}" 
                                            title="Edit Client"
                                            class="p-2 text-indigo-400 hover:text-indigo-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                                </svg>
                                            </a>

                                            <!-- 2. View / Details (Gri Belge) -->
                                            <a href="{{ Route::has('clients.show') ? route('clients.show', $client) : '#' }}" 
                                            title="View Client"
                                            class="p-2 text-gray-400 hover:text-gray-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                                    <polyline points="14 2 14 8 20 8"/>
                                                    <line x1="16" y1="13" x2="8" y2="13"/>
                                                    <line x1="16" y1="17" x2="8" y2="17"/>
                                                </svg>
                                            </a>

                                            <!-- 3. Delete (Kırmızı Çöp Kovası) -->
                                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        title="Delete Client"
                                                        class="p-2 text-rose-400 hover:text-rose-300 transition-colors cursor-pointer flex items-center">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                        <polyline points="3 6 5 6 21 6"/>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                        <line x1="10" y1="11" x2="10" y2="17"/>
                                                        <line x1="14" y1="11" x2="14" y2="17"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-12 h-12 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-400 mb-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-base font-semibold text-gray-900 dark:text-white">No clients found</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-sm">
                                                You haven't added any clients yet. Start by creating your first client account.
                                            </p>
                                            <a href="{{ route('clients.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium rounded-lg shadow-sm transition">
                                                + Add First Client
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (method_exists($clients, 'hasPages') && $clients->hasPages())
                    <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                        {{ $clients->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>