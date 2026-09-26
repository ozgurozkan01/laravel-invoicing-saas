<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('clients.index') }}" class="hover:text-indigo-600 transition">Clients</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white">New Client</span>
                </div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Add New Client') }}
                </h2>
            </div>

            <a href="{{ route('clients.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- 1. KART: Temel İletişim & Şirket Bilgileri -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-8 shadow-sm">
                    <div class="border-b border-gray-100 dark:border-gray-700 pb-4 mb-6">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Contact & Company Profile</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Primary information used for invoice communication</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <!-- Client Name (Zorunlu) -->
                        <div>
                            <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Contact Name <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                id="name" 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus
                                class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                            >
                            @error('name')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Company Name (OPSİYONEL) -->
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="company_name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
                                    Company / Business Name
                                </label>
                                <span class="text-[11px] text-gray-400">Optional</span>
                            </div>
                            <input 
                                id="company_name" 
                                type="text" 
                                name="company_name" 
                                value="{{ old('company_name') }}" 
                                class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                            >
                            @error('company_name')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (Zorunlu) -->
                        <div>
                            <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Email Address <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required
                                class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                            >
                            @error('email')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone (Zorunlu) -->
                        <div>
                            <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Phone Number <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                id="phone" 
                                type="text" 
                                name="phone" 
                                value="{{ old('phone') }}" 
                                required
                                class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                            >
                            @error('phone')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- 2. KART: Fatura & Adres Bilgileri -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-8 shadow-sm">
                    <div class="border-b border-gray-100 dark:border-gray-700 pb-4 mb-6">
                        <h3 class="text-base font-bold text-gray-900 dark:text-white">Billing Address</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Physical location printed on outgoing invoice receipts</p>
                    </div>

                    <div class="space-y-5">
                        <!-- Street Address (Zorunlu) -->
                        <div>
                            <label for="address" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                Street Address <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                id="address" 
                                type="text" 
                                name="address" 
                                value="{{ old('address') }}" 
                                required
                                class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                            >
                            @error('address')
                                <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- 3 Kolonlu Şehir / Eyalet / Posta Kodu Izgarası -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                            <!-- City (Zorunlu) -->
                            <div>
                                <label for="city" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                    City <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    id="city" 
                                    type="text" 
                                    name="city" 
                                    value="{{ old('city') }}" 
                                    required
                                    class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                                >
                                @error('city')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State (Zorunlu) -->
                            <div>
                                <label for="state" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                    State / Province <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    id="state" 
                                    type="text" 
                                    name="state" 
                                    value="{{ old('state') }}" 
                                    required
                                    class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                                >
                                @error('state')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Postal Code (Zorunlu) -->
                            <div>
                                <label for="postal_code" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                    Postal / Zip Code <span class="text-rose-500">*</span>
                                </label>
                                <input 
                                    id="postal_code" 
                                    type="text" 
                                    name="postal_code" 
                                    value="{{ old('postal_code') }}" 
                                    required
                                    class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                                >
                                @error('postal_code')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Alt Butonlar -->
                <div class="flex items-center justify-end gap-3 pt-2">
                    <a href="{{ route('clients.index') }}" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Discard
                    </a>

                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl shadow-md shadow-indigo-500/20 text-xs font-semibold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Save Client</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>