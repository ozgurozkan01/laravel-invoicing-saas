@php
    $inputClass =
        'block w-full px-3.5 py-2.5 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 text-gray-900 dark:text-white text-sm placeholder:text-gray-400 focus:bg-white dark:focus:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition';
    $labelClass = 'block text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300 mb-1.5';
    $errorClass = 'mt-1.5 text-xs text-rose-600 dark:text-rose-400';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                    <a href="{{ route('clients.index') }}" class="hover:text-indigo-600 transition">Clients</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white">{{ $client->name }}</span>
                </div>
                <h2 class="font-bold text-2xl text-gray-900 dark:text-white leading-tight">
                    {{ __('Edit Client') }}
                </h2>
            </div>


        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start" x-data="{
                clientType: '{{ old('client_type', $client->client_type ?? 'individual') }}',
                name: {{ Js::from(old('name', $client->name)) }},
                company: {{ Js::from(old('company_name', $client->company_name)) }},
                get initials() {
                    return (this.name || '?').trim().substring(0, 2).toUpperCase();
                }
            }">

                <div class="lg:col-span-8 space-y-6">

                    <form id="update-client-form" action="{{ route('clients.update', $client) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Client Type</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">Choose how this client is
                                identified on invoices</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="client_type" value="individual" x-model="clientType"
                                        class="sr-only">
                                    <div :class="clientType === 'individual'
                                        ?
                                        'border-indigo-600 bg-indigo-50/60 dark:bg-indigo-950/40 ring-1 ring-indigo-600' :
                                        'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'"
                                        class="flex items-center gap-3 p-4 rounded-xl border transition">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Individual
                                            </p>
                                        </div>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="client_type" value="corporate" x-model="clientType"
                                        class="sr-only">
                                    <div :class="clientType === 'corporate'
                                        ?
                                        'border-indigo-600 bg-indigo-50/60 dark:bg-indigo-950/40 ring-1 ring-indigo-600' :
                                        'border-gray-200 dark:border-gray-700 hover:border-gray-300 dark:hover:border-gray-600'"
                                        class="flex items-center gap-3 p-4 rounded-xl border transition">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H5m14 0h2M5 21H3M9 7h1m-1 4h1m4-4h1m-1 4h1M10 21v-4h4v4" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Corporate</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('client_type')
                                <p class="{{ $errorClass }}">{{ $message }}</p>
                            @enderror
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Client Information</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">
                                <span x-show="clientType === 'individual'">Enter individual identification
                                    details</span>
                                <span x-show="clientType === 'corporate'" x-cloak>Enter official company and tax
                                    details</span>
                            </p>

                            <div x-show="clientType === 'individual'" class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="{{ $labelClass }}">Full Name <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="name" x-model="name"
                                        :required="clientType === 'individual'" :disabled="clientType !== 'individual'"
                                        class="{{ $inputClass }}">
                                    @error('name')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">Company Name <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="company_name" x-model="company"
                                        :required="clientType === 'corporate'" :disabled="clientType !== 'corporate'"
                                        class="{{ $inputClass }}">
                                    @error('company_name')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">Tax Office <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="tax_office"
                                        value="{{ old('tax_office', $client->tax_office) }}"
                                        :required="clientType === 'corporate'" :disabled="clientType !== 'corporate'"
                                        class="{{ $inputClass }}">
                                    @error('tax_office')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">National ID Number <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="identity_number"
                                        value="{{ old('identity_number', $client->identity_number) }}"
                                        :required="clientType === 'individual'"
                                        :disabled="clientType !== 'individual'" class="{{ $inputClass }}">
                                    @error('identity_number')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div x-show="clientType === 'corporate'" x-cloak
                                class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                                <div>
                                    <label class="{{ $labelClass }}">Contact Name<span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="name" x-model="name"
                                        :required="clientType === 'corporate'"
                                        :disabled="clientType !== 'corporate'" class="{{ $inputClass }}">
                                    @error('name')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">Company Name <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="company_name" x-model="company"
                                        :required="clientType === 'corporate'"
                                        :disabled="clientType !== 'corporate'" class="{{ $inputClass }}">
                                    @error('company_name')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">Tax Office <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="tax_office"
                                        value="{{ old('tax_office', $client->tax_office) }}"
                                        :required="clientType === 'corporate'"
                                        :disabled="clientType !== 'corporate'" class="{{ $inputClass }}">
                                    @error('tax_office')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="{{ $labelClass }}">Tax Number <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="tax_number"
                                        value="{{ old('tax_number', $client->tax_number) }}"
                                        :required="clientType === 'corporate'"
                                        :disabled="clientType !== 'corporate'" class="{{ $inputClass }}">
                                    @error('tax_number')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Contact Details</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">How to reach this client for
                                invoicing</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="{{ $labelClass }}">Email Address <span
                                            class="text-rose-500">*</span></label>
                                    <input type="email" name="email" value="{{ old('email', $client->email) }}"
                                        required class="{{ $inputClass }}">
                                    @error('email')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="relative" x-data="{
                                    open: false,
                                    selected: { code: 'tr', dial: '+90', name: 'Turkey', placeholder: '555 123 45 67' },
                                    phoneInput: '',
                                    countries: [
                                        { code: 'al', dial: '+355', name: 'Albania', placeholder: '67 123 4567' },
                                        { code: 'dz', dial: '+213', name: 'Algeria', placeholder: '551 23 45 67' },
                                        { code: 'ar', dial: '+54', name: 'Argentina', placeholder: '11 1234-5678' },
                                        { code: 'am', dial: '+374', name: 'Armenia', placeholder: '77 123456' },
                                        { code: 'au', dial: '+61', name: 'Australia', placeholder: '412 345 678' },
                                        { code: 'at', dial: '+43', name: 'Austria', placeholder: '664 1234567' },
                                        { code: 'az', dial: '+994', name: 'Azerbaijan', placeholder: '50 123 45 67' },
                                        { code: 'bh', dial: '+973', name: 'Bahrain', placeholder: '3600 1234' },
                                        { code: 'bd', dial: '+880', name: 'Bangladesh', placeholder: '1712-345678' },
                                        { code: 'be', dial: '+32', name: 'Belgium', placeholder: '470 12 34 56' },
                                        { code: 'ba', dial: '+387', name: 'Bosnia and Herzegovina', placeholder: '61 123 456' },
                                        { code: 'br', dial: '+55', name: 'Brazil', placeholder: '11 91234-5678' },
                                        { code: 'bg', dial: '+359', name: 'Bulgaria', placeholder: '87 123 4567' },
                                        { code: 'cm', dial: '+237', name: 'Cameroon', placeholder: '6 71 23 45 67' },
                                        { code: 'ca', dial: '+1', name: 'Canada', placeholder: '(555) 000-0000' },
                                        { code: 'cl', dial: '+56', name: 'Chile', placeholder: '9 1234 5678' },
                                        { code: 'cn', dial: '+86', name: 'China', placeholder: '138 0013 8000' },
                                        { code: 'co', dial: '+57', name: 'Colombia', placeholder: '300 123 4567' },
                                        { code: 'cr', dial: '+506', name: 'Costa Rica', placeholder: '8312 3456' },
                                        { code: 'hr', dial: '+385', name: 'Croatia', placeholder: '91 234 5678' },
                                        { code: 'cy', dial: '+357', name: 'Cyprus', placeholder: '96 123456' },
                                        { code: 'cz', dial: '+420', name: 'Czech Republic', placeholder: '601 123 456' },
                                        { code: 'dk', dial: '+45', name: 'Denmark', placeholder: '20 12 34 56' },
                                        { code: 'do', dial: '+1', name: 'Dominican Republic', placeholder: '(809) 234-5678' },
                                        { code: 'ec', dial: '+593', name: 'Ecuador', placeholder: '99 123 4567' },
                                        { code: 'eg', dial: '+20', name: 'Egypt', placeholder: '100 123 4567' },
                                        { code: 'ee', dial: '+372', name: 'Estonia', placeholder: '5123 4567' },
                                        { code: 'et', dial: '+251', name: 'Ethiopia', placeholder: '91 123 4567' },
                                        { code: 'fi', dial: '+358', name: 'Finland', placeholder: '41 2345678' },
                                        { code: 'fr', dial: '+33', name: 'France', placeholder: '6 12 34 56 78' },
                                        { code: 'ge', dial: '+995', name: 'Georgia', placeholder: '555 12 34 56' },
                                        { code: 'de', dial: '+49', name: 'Germany', placeholder: '151 23456789' },
                                        { code: 'gh', dial: '+233', name: 'Ghana', placeholder: '23 123 4567' },
                                        { code: 'gr', dial: '+30', name: 'Greece', placeholder: '691 234 5678' },
                                        { code: 'hk', dial: '+852', name: 'Hong Kong', placeholder: '5123 4567' },
                                        { code: 'hu', dial: '+36', name: 'Hungary', placeholder: '20 123 4567' },
                                        { code: 'is', dial: '+354', name: 'Iceland', placeholder: '612 3456' },
                                        { code: 'in', dial: '+91', name: 'India', placeholder: '98765 43210' },
                                        { code: 'id', dial: '+62', name: 'Indonesia', placeholder: '812-3456-7890' },
                                        { code: 'iq', dial: '+964', name: 'Iraq', placeholder: '790 123 4567' },
                                        { code: 'ie', dial: '+353', name: 'Ireland', placeholder: '85 123 4567' },
                                        { code: 'il', dial: '+972', name: 'Israel', placeholder: '50-123-4567' },
                                        { code: 'it', dial: '+39', name: 'Italy', placeholder: '312 345 6789' },
                                        { code: 'ci', dial: '+225', name: 'Ivory Coast', placeholder: '01 23 45 67 89' },
                                        { code: 'jp', dial: '+81', name: 'Japan', placeholder: '90-1234-5678' },
                                        { code: 'jo', dial: '+962', name: 'Jordan', placeholder: '7 9012 3456' },
                                        { code: 'kz', dial: '+7', name: 'Kazakhstan', placeholder: '701 123 4567' },
                                        { code: 'ke', dial: '+254', name: 'Kenya', placeholder: '712 345678' },
                                        { code: 'kw', dial: '+965', name: 'Kuwait', placeholder: '5123 4567' },
                                        { code: 'kg', dial: '+996', name: 'Kyrgyzstan', placeholder: '555 123 456' },
                                        { code: 'lv', dial: '+371', name: 'Latvia', placeholder: '21 234 567' },
                                        { code: 'lb', dial: '+961', name: 'Lebanon', placeholder: '70 123 456' },
                                        { code: 'lt', dial: '+370', name: 'Lithuania', placeholder: '612 34567' },
                                        { code: 'lu', dial: '+352', name: 'Luxembourg', placeholder: '621 123 456' },
                                        { code: 'my', dial: '+60', name: 'Malaysia', placeholder: '12-345 6789' },
                                        { code: 'mt', dial: '+356', name: 'Malta', placeholder: '9912 3456' },
                                        { code: 'mu', dial: '+230', name: 'Mauritius', placeholder: '5251 2345' },
                                        { code: 'mx', dial: '+52', name: 'Mexico', placeholder: '55 1234 5678' },
                                        { code: 'ma', dial: '+212', name: 'Morocco', placeholder: '612-345678' },
                                        { code: 'np', dial: '+977', name: 'Nepal', placeholder: '984-1234567' },
                                        { code: 'nl', dial: '+31', name: 'Netherlands', placeholder: '6 12345678' },
                                        { code: 'nz', dial: '+64', name: 'New Zealand', placeholder: '21 123 4567' },
                                        { code: 'ng', dial: '+234', name: 'Nigeria', placeholder: '802 123 4567' },
                                        { code: 'mk', dial: '+389', name: 'North Macedonia', placeholder: '70 123 456' },
                                        { code: 'no', dial: '+47', name: 'Norway', placeholder: '412 34 567' },
                                        { code: 'om', dial: '+968', name: 'Oman', placeholder: '9123 4567' },
                                        { code: 'pk', dial: '+92', name: 'Pakistan', placeholder: '300 1234567' },
                                        { code: 'pa', dial: '+507', name: 'Panama', placeholder: '6123-4567' },
                                        { code: 'py', dial: '+595', name: 'Paraguay', placeholder: '981 123456' },
                                        { code: 'pe', dial: '+51', name: 'Peru', placeholder: '912 345 678' },
                                        { code: 'ph', dial: '+63', name: 'Philippines', placeholder: '917 123 4567' },
                                        { code: 'pl', dial: '+48', name: 'Poland', placeholder: '512 345 678' },
                                        { code: 'pt', dial: '+351', name: 'Portugal', placeholder: '912 345 678' },
                                        { code: 'qa', dial: '+974', name: 'Qatar', placeholder: '3312 3456' },
                                        { code: 'ro', dial: '+40', name: 'Romania', placeholder: '712 345 678' },
                                        { code: 'sa', dial: '+966', name: 'Saudi Arabia', placeholder: '50 123 4567' },
                                        { code: 'sn', dial: '+221', name: 'Senegal', placeholder: '70 123 45 67' },
                                        { code: 'rs', dial: '+381', name: 'Serbia', placeholder: '60 1234567' },
                                        { code: 'sg', dial: '+65', name: 'Singapore', placeholder: '8123 4567' },
                                        { code: 'sk', dial: '+421', name: 'Slovakia', placeholder: '912 345 678' },
                                        { code: 'si', dial: '+386', name: 'Slovenia', placeholder: '31 234 567' },
                                        { code: 'za', dial: '+27', name: 'South Africa', placeholder: '71 123 4567' },
                                        { code: 'kr', dial: '+82', name: 'South Korea', placeholder: '10-1234-5678' },
                                        { code: 'es', dial: '+34', name: 'Spain', placeholder: '612 34 56 78' },
                                        { code: 'lk', dial: '+94', name: 'Sri Lanka', placeholder: '71 234 5678' },
                                        { code: 'se', dial: '+46', name: 'Sweden', placeholder: '70 123 45 67' },
                                        { code: 'ch', dial: '+41', name: 'Switzerland', placeholder: '78 123 45 67' },
                                        { code: 'tw', dial: '+886', name: 'Taiwan', placeholder: '912 345 678' },
                                        { code: 'tz', dial: '+255', name: 'Tanzania', placeholder: '712 345 678' },
                                        { code: 'th', dial: '+66', name: 'Thailand', placeholder: '81 234 5678' },
                                        { code: 'tn', dial: '+216', name: 'Tunisia', placeholder: '20 123 456' },
                                        { code: 'tr', dial: '+90', name: 'Turkey', placeholder: '555 123 45 67' },
                                        { code: 'tm', dial: '+993', name: 'Turkmenistan', placeholder: '65 123456' },
                                        { code: 'ua', dial: '+380', name: 'Ukraine', placeholder: '50 123 4567' },
                                        { code: 'ae', dial: '+971', name: 'United Arab Emirates', placeholder: '50 123 4567' },
                                        { code: 'gb', dial: '+44', name: 'United Kingdom', placeholder: '7911 123456' },
                                        { code: 'us', dial: '+1', name: 'United States', placeholder: '(555) 000-0000' },
                                        { code: 'uy', dial: '+598', name: 'Uruguay', placeholder: '94 123 456' },
                                        { code: 'uz', dial: '+998', name: 'Uzbekistan', placeholder: '90 123 45 67' },
                                        { code: 'vn', dial: '+84', name: 'Vietnam', placeholder: '91 234 56 78' }
                                    ],
                                    init() {
                                        let existingPhone = {{ Js::from(old('phone', $client->phone ?? '')) }};
                                        if (existingPhone && existingPhone.startsWith('+')) {
                                            // Uzun alan kodlarını önce yakalamak için sırala (+971 önce, +9 sonra)
                                            let matched = [...this.countries]
                                                .sort((a, b) => b.dial.length - a.dial.length)
                                                .find(c => existingPhone.startsWith(c.dial));
                                
                                            if (matched) {
                                                this.selected = matched;
                                                this.phoneInput = existingPhone.substring(matched.dial.length).trim();
                                                return;
                                            }
                                        }
                                        this.phoneInput = existingPhone;
                                    },
                                    select(country) {
                                        this.selected = country;
                                        this.open = false;
                                    }
                                }">
                                    <label for="phone" class="{{ $labelClass }}">
                                        Phone Number <span class="text-rose-500">*</span>
                                    </label>

                                    <input type="hidden" name="country_dial_code" :value="selected.dial">

                                    <div
                                        class="relative flex rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 shadow-sm focus-within:bg-white dark:focus-within:bg-gray-900 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:border-transparent transition">

                                        <button type="button" @click="open = !open"
                                            class="flex items-center gap-2 pl-3.5 pr-2.5 py-2.5 border-r border-gray-200 dark:border-gray-700 bg-gray-100/50 dark:bg-gray-800/40 hover:bg-gray-100 dark:hover:bg-gray-800/80 transition rounded-l-xl flex-shrink-0 cursor-pointer">
                                            <img :src="`https://flagcdn.com/w20/${selected.code}.png`"
                                                :alt="selected.name"
                                                class="w-5 h-3.5 object-cover rounded-xs shadow-xs">
                                            <span
                                                class="text-xs font-semibold text-gray-800 dark:text-gray-200 uppercase"
                                                x-text="selected.code"></span>
                                            <span class="text-xs text-gray-500 dark:text-gray-400 font-medium"
                                                x-text="`(${selected.dial})`"></span>
                                            <svg class="w-3.5 h-3.5 text-gray-400 ml-0.5 transition-transform"
                                                :class="open ? 'rotate-180' : ''" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <input type="tel" name="phone" id="phone" x-model="phoneInput"
                                            :placeholder="selected.placeholder" required
                                            class="block w-full px-3.5 py-2.5 bg-transparent border-0 text-sm text-gray-900 dark:text-white placeholder:text-gray-400 dark:placeholder:text-gray-500 focus:ring-0 focus:outline-none">

                                        <div x-show="open" x-cloak @click.outside="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="opacity-0 translate-y-2"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="opacity-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 translate-y-2"
                                            class="absolute top-full left-0 mt-2 w-64 max-h-60 overflow-y-auto z-50 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-xl py-1 divide-y divide-gray-100 dark:divide-gray-700/50">
                                            <template x-for="c in countries" :key="c.code">
                                                <button type="button" @click="select(c)"
                                                    class="w-full flex items-center justify-between px-3.5 py-2.5 text-xs text-left hover:bg-indigo-50 dark:hover:bg-indigo-950/40 transition cursor-pointer"
                                                    :class="selected.code === c.code ?
                                                        'bg-indigo-50/70 dark:bg-indigo-950/60 font-semibold text-indigo-600 dark:text-indigo-400' :
                                                        'text-gray-700 dark:text-gray-300'">
                                                    <div class="flex items-center gap-2.5">
                                                        <img :src="`https://flagcdn.com/w20/${c.code}.png`"
                                                            :alt="c.name"
                                                            class="w-5 h-3.5 object-cover rounded-xs shadow-xs">
                                                        <span x-text="c.name" class="truncate max-w-[120px]"></span>
                                                    </div>
                                                    <span class="font-mono text-gray-400 dark:text-gray-500"
                                                        x-text="c.dial"></span>
                                                </button>
                                            </template>
                                        </div>
                                    </div>

                                    @error('phone')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 sm:p-7 shadow-sm">
                            <h3 class="text-base font-bold text-gray-900 dark:text-white mb-1">Billing Address</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-5">Used as the default billing
                                address on new invoices</p>

                            <div class="space-y-5">
                                <div>
                                    <label class="{{ $labelClass }}">Street Address <span
                                            class="text-rose-500">*</span></label>
                                    <input type="text" name="address"
                                        value="{{ old('address', $client->address) }}" required
                                        class="{{ $inputClass }}">
                                    @error('address')
                                        <p class="{{ $errorClass }}">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <div>
                                        <label class="{{ $labelClass }}">Country <span
                                                class="text-rose-500">*</span></label>
                                        <input type="text" name="country"
                                            value="{{ old('country', $client->country ?? 'Turkey') }}" required
                                            class="{{ $inputClass }}">
                                        @error('country')
                                            <p class="{{ $errorClass }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">City <span
                                                class="text-rose-500">*</span></label>
                                        <input type="text" name="city"
                                            value="{{ old('city', $client->city) }}" required
                                            class="{{ $inputClass }}">
                                        @error('city')
                                            <p class="{{ $errorClass }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">State / District <span
                                                class="text-rose-500">*</span></label>
                                        <input type="text" name="state"
                                            value="{{ old('state', $client->state) }}" required
                                            class="{{ $inputClass }}">
                                        @error('state')
                                            <p class="{{ $errorClass }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="{{ $labelClass }}">Postal Code <span
                                                class="text-rose-500">*</span></label>
                                        <input type="text" name="postal_code"
                                            value="{{ old('postal_code', $client->postal_code) }}" required
                                            class="{{ $inputClass }}">
                                        @error('postal_code')
                                            <p class="{{ $errorClass }}">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div
                        class="bg-rose-50/40 dark:bg-rose-950/20 rounded-2xl border border-rose-200 dark:border-rose-900/60 p-6 shadow-sm">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-bold text-rose-900 dark:text-rose-200">Delete this client</h3>
                                <p class="text-xs text-rose-600 dark:text-rose-400 mt-0.5">Once deleted, all client
                                    data and draft invoices will be permanently removed.</p>
                            </div>

                            <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this client? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2.5 rounded-xl text-xs font-semibold text-white bg-rose-600 hover:bg-rose-700 transition flex items-center gap-1.5 shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Client
                                </button>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="lg:col-span-4 lg:sticky lg:top-6 space-y-6">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 p-6 shadow-sm">

                        <div
                            class="flex flex-col items-center text-center pb-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="w-16 h-16 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 font-bold text-xl flex items-center justify-center border border-indigo-100 dark:border-indigo-900/50 shadow-sm"
                                x-text="initials"></div>
                            <p class="mt-3 text-base font-bold text-gray-900 dark:text-white"
                                x-text="name || 'Unnamed client'"></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400"
                                x-text="clientType === 'corporate' ? (company || 'Corporate client') : 'Individual client'">
                            </p>
                        </div>

                        <div
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs">
                            <span class="text-gray-500 dark:text-gray-400">Client since</span>
                            <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $client->created_at->format('M d, Y') }}</span>
                        </div>

                        <a href="{{ route('invoices.index', ['client_id' => $client->id]) }}"
                            class="py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center text-xs group hover:text-indigo-600 transition">
                            <span
                                class="text-gray-500 dark:text-gray-400 group-hover:text-indigo-600 transition">Invoices</span>
                            <div
                                class="flex items-center gap-1 font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 transition">
                                <span>{{ $client->invoices()->count() }}</span>
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-indigo-600" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>

                        <div class="pt-5 space-y-2.5">
                            <button form="update-client-form" type="submit"
                                class="w-full flex items-center justify-center gap-2 py-3 px-4 rounded-xl shadow-md shadow-indigo-500/20 text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Save Changes</span>
                            </button>

                            <a href="{{ route('clients.index') }}"
                                class="w-full block text-center py-2.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
                                Discard changes
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
