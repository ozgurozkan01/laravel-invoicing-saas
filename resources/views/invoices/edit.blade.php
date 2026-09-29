<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('invoices.index') }}" class="hover:text-indigo-600 transition">Invoices</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white">Edit Invoice</span>
                </div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Edit Invoice') }}
                </h2>
            </div>

            <a href="{{ route('invoices.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 text-xs font-semibold rounded-xl border border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Cancel
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="flex items-center gap-3 p-4 mb-6 bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('invoices.update', $invoice) }}"
                x-data="{
                    title: {{ Js::from(old('title', $invoice->title ?? '')) }},
                    clients: {{ Js::from($clients) }},
                    selectedClientId: '{{ old('client_id', $invoice->client_id) }}',
                    sameAsClient: true,
                    items: {{ Js::from($invoice->invoiceItems->map(fn ($item) => [
                        'description' => $item->description,
                        'quantity' => $item->quantity,
                        'unit' => $item->unit,
                        'unit_price' => $item->unit_price,
                    ])) }},
                    get selectedClient() {
                        return this.clients.find(c => c.id == this.selectedClientId) || null;
                    },
                    get total() {
                        return this.items.reduce((sum, item) => sum + (Number(item.quantity) || 0) * (Number(item.unit_price) || 0), 0);
                    },
                    addItem() {
                        this.items.push({ description: '', quantity: 1, unit: '', unit_price: 0 });
                    },
                    removeItem(index) {
                        if (this.items.length > 1) {
                            this.items.splice(index, 1);
                        }
                    }
                }"
            >
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                    <!-- ================= SOL ALAN (8 KOLON) ================= -->
                    <div class="lg:col-span-8 space-y-6">
                        <!-- 1. KART: Müşteri Seçimi & Akıllı Fatura Adresi -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <div class="mb-6 pb-6 border-b border-gray-100 dark:border-gray-700">
                                <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                    Invoice Title / Subject <span class="text-[11px] text-gray-400 font-normal lowercase">(optional)</span>
                                </label>
                                <input
                                    id="title"
                                    type="text"
                                    name="title"
                                    x-model="title"
                                    placeholder="e.g. Website Redesign Project, Monthly Retainer - Oct"
                                    class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                                >
                                @error('title')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900 dark:text-white">Billed To (Client)</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Select the recipient for this invoice</p>
                                </div>
                                <a href="{{ route('clients.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 flex items-center gap-1">
                                    <span>+ New Client</span>
                                </a>
                            </div>

                            <div>
                                <label for="client_id" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5">
                                    Select Client <span class="text-rose-500">*</span>
                                </label>
                                <select
                                    id="client_id"
                                    name="client_id"
                                    x-model="selectedClientId"
                                    required
                                    class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition"
                                >
                                    <option value="" disabled selected>Choose a client from directory...</option>
                                    @foreach ($clients as $client)
                                        <option value="{{ $client->id }}">
                                            {{ $client->name }} @if(!empty($client->company_name)) ({{ $client->company_name }}) @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-5 pt-4 border-t border-gray-100 dark:border-gray-700">
                                <label class="inline-flex items-center cursor-pointer select-none">
                                    <input
                                        type="checkbox"
                                        x-model="sameAsClient"
                                        class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-900 dark:focus:ring-offset-gray-800"
                                    >
                                    <span class="ms-2.5 text-xs font-medium text-gray-700 dark:text-gray-300">
                                        Use client's registered address as billing address
                                    </span>
                                </label>
                            </div>

                            <div x-show="sameAsClient" class="mt-3">
                                <div x-show="selectedClient" class="p-3.5 rounded-xl bg-gray-50 dark:bg-gray-900/50 border border-gray-100 dark:border-gray-700/60 text-xs text-gray-600 dark:text-gray-300 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span>Billing to: <strong class="text-gray-900 dark:text-white" x-text="selectedClient ? (selectedClient.address + ', ' + selectedClient.city + ', ' + selectedClient.state + ' ' + selectedClient.postal_code) : ''"></strong></span>
                                </div>
                                <div x-show="!selectedClient" class="text-xs text-gray-400 italic py-1">
                                    Address will be loaded automatically when you choose a client above.
                                </div>
                            </div>

                            <div x-show="!sameAsClient" x-cloak class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 space-y-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-50 dark:bg-amber-950/60 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-900/50">
                                    Custom Invoice Billing Address
                                </span>

                                <div>
                                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1">
                                        Street Address
                                    </label>
                                    <input
                                        type="text"
                                        name="custom_address"
                                        placeholder="Different billing address for this invoice..."
                                        class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-indigo-600 transition"
                                    >
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1">City</label>
                                        <input type="text" name="custom_city" placeholder="City" class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-indigo-600 transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1">State</label>
                                        <input type="text" name="custom_state" placeholder="State" class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-indigo-600 transition">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1">Zip Code</label>
                                        <input type="text" name="custom_postal_code" placeholder="Zip" class="block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-indigo-600 transition">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. KART: Fatura Kalemleri (Line Items) -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <div class="flex items-center justify-between mb-1">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Line Items</h3>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">Add the products or services being billed</p>

                            <div class="space-y-3">
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="grid grid-cols-12 gap-2 items-start p-3 rounded-xl bg-gray-50/50 dark:bg-gray-900/40 border border-gray-100 dark:border-gray-700/60">
                                        <div class="col-span-12 sm:col-span-4">
                                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Description</label>
                                            <input
                                                type="text"
                                                x-model="item.description"
                                                :name="'items[' + index + '][description]'"
                                                placeholder="e.g. Logo design"
                                                required
                                                class="block w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                            >
                                        </div>
                                        <div class="col-span-4 sm:col-span-2">
                                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Qty</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                min="0.01"
                                                x-model.number="item.quantity"
                                                :name="'items[' + index + '][quantity]'"
                                                required
                                                class="block w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                            >
                                        </div>

                                        <div class="col-span-4 sm:col-span-2" x-data="{ isCustom: false }">
                                            <div class="flex items-center justify-between mb-1.5">
                                                <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                                    Unit
                                                </label>
                                                <button 
                                                    type="button" 
                                                    x-show="isCustom" 
                                                    x-cloak
                                                    @click="isCustom = false; item.unit = 'pcs'"
                                                    class="text-[10px] font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 transition-colors cursor-pointer"
                                                >
                                                    ← List
                                                </button>
                                            </div>

                                            <div x-show="!isCustom" class="relative">
                                                <select
                                                    x-model="item.unit"
                                                    :name="!isCustom ? 'items[' + index + '][unit]' : ''"
                                                    @change="if ($event.target.value === '__custom__') { isCustom = true; item.unit = ''; }"
                                                    class="appearance-none block w-full pl-3 pr-8 py-2 text-xs font-medium rounded-lg border border-slate-200 dark:border-slate-700/80 bg-slate-50/50 dark:bg-slate-900/60 text-slate-800 dark:text-slate-100 shadow-sm hover:border-slate-300 dark:hover:border-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition cursor-pointer"
                                                >
                                                    <option value="" disabled>Select...</option>
                                                    <optgroup label="Count & Quantity">
                                                        <option value="pcs">pcs (pieces)</option>
                                                        <option value="unit">unit</option>
                                                        <option value="box">box</option>
                                                        <option value="pack">pack</option>
                                                        <option value="set">set</option>
                                                    </optgroup>
                                                    <optgroup label="Time & Services">
                                                        <option value="hr">hr (hour)</option>
                                                        <option value="day">day</option>
                                                        <option value="wk">wk (week)</option>
                                                        <option value="mo">mo (month)</option>
                                                        <option value="yr">yr (year)</option>
                                                    </optgroup>
                                                    <optgroup label="Measurement">
                                                        <option value="kg">kg (kilogram)</option>
                                                        <option value="g">g (gram)</option>
                                                        <option value="lb">lb (pound)</option>
                                                        <option value="m">m (meter)</option>
                                                        <option value="m²">m² (sq meter)</option>
                                                        <option value="l">l (liter)</option>
                                                    </optgroup>
                                                    <optgroup label="Other">
                                                        <option value="__custom__" class="font-semibold text-indigo-600 dark:text-indigo-400">
                                                            ✍️ Custom...
                                                        </option>
                                                    </optgroup>
                                                </select>

                                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2.5 text-slate-400 dark:text-slate-500">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </div>
                                            </div>

                                            <div x-show="isCustom" x-cloak class="relative">
                                                <input
                                                    type="text"
                                                    x-model="item.unit"
                                                    :name="isCustom ? 'items[' + index + '][unit]' : ''"
                                                    placeholder="e.g. project..."
                                                    class="block w-full px-3 py-2 text-xs font-medium rounded-lg border border-indigo-300 dark:border-indigo-500/50 bg-indigo-50/20 dark:bg-indigo-950/20 text-slate-800 dark:text-slate-100 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition"
                                                >
                                            </div>
                                        </div>

                                        <div class="col-span-4 sm:col-span-3">
                                            <label class="block text-[11px] font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Unit Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                min="0"
                                                x-model.number="item.unit_price"
                                                :name="'items[' + index + '][unit_price]'"
                                                required
                                                class="block w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                            >
                                        </div>
                                        <div class="col-span-12 sm:col-span-1 flex sm:justify-end items-end h-full pb-0.5">
                                            <button
                                                type="button"
                                                @click="removeItem(index)"
                                                x-show="items.length > 1"
                                                class="text-rose-500 hover:text-rose-700 p-2 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/40 transition"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <button
                                type="button"
                                @click="addItem()"
                                class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Line Item
                            </button>
                        </div>
                    </div>

                    <!-- ================= SAĞ ALAN / ÖZET PANELİ (4 KOLON - STICKY) ================= -->
                    <div class="lg:col-span-4 sticky top-6 space-y-6">
                        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">
                            <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700">
                                <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Invoice Summary</span>
                                <span class="font-mono text-xs text-gray-500 dark:text-gray-400 font-medium">#{{ $invoice->invoice_number }}</span>
                            </div>

                            <!-- Başlık Önizlemesi -->
                            <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs">
                                <span class="text-gray-500 dark:text-gray-400">Title:</span>
                                <span class="font-semibold text-gray-900 dark:text-white truncate max-w-[170px]" x-text="title || 'No Title'"></span>
                            </div>

                            <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs">
                                <span class="text-gray-500 dark:text-gray-400">Recipient:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="selectedClient ? selectedClient.name : 'Not selected'"></span>
                            </div>

                            <div class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs">
                                <span class="text-gray-500 dark:text-gray-400">Line Items:</span>
                                <span class="font-semibold text-gray-900 dark:text-white" x-text="items.length"></span>
                            </div>

                            <div class="py-4 border-b border-gray-100 dark:border-gray-700">
                                <label for="due_date" class="text-xs text-gray-500 dark:text-gray-400 block mb-1.5">Due Date:</label>
                                <input
                                    id="due_date"
                                    type="date"
                                    name="due_date"
                                    min="{{ now()->format('Y-m-d') }}"
                                    value="{{ old('due_date', $invoice->due_date ? $invoice->due_date->format('Y-m-d') : now()->addDays(14)->format('Y-m-d')) }}"
                                    required
                                    class="block w-full px-3 py-2 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 transition"
                                >
                                @error('due_date')
                                    <p class="mt-1.5 text-xs text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Canlı Toplam Tutar -->
                            <div class="py-6 text-center border-b border-gray-100 dark:border-gray-700">
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium">Total Amount Due</span>
                                <div class="mt-1 text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                                    $<span x-text="total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})">0.00</span>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-1">Calculated automatically from line items</p>
                            </div>

                            <div class="pt-5 space-y-2.5">
                                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl shadow-md shadow-indigo-500/20 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Save Changes</span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>