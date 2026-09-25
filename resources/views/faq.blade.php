<x-app-layout>
    <div class="py-16 sm:py-24">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- 1. BÖLÜM: Başlık -->
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                    Frequently Asked Questions
                </span>

                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight">
                    Got questions? We've got answers.
                </h1>

                <p class="mt-4 text-base sm:text-lg text-gray-600 dark:text-gray-400">
                    Everything you need to know about BillFlow, invoice management, and tracking client payments.
                </p>
            </div>

            <!-- 2. BÖLÜM: Alpine.js Açılır-Kapanır Soru Listesi (Accordion) -->
            <div class="space-y-4">
                
                <!-- Soru 1 -->
                <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition">
                    <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center gap-4 focus:outline-none">
                        <span class="font-semibold text-base text-gray-900 dark:text-white">
                            What is BillFlow and who is it designed for?
                        </span>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="px-6 pb-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/60 pt-4">
                        BillFlow is a lightweight, modern billing and client management tool designed specifically for freelancers, consultants, creative agencies, and small startups who want to get paid without bloated accounting software.
                    </div>
                </div>

                <!-- Soru 2 -->
                <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition">
                    <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center gap-4 focus:outline-none">
                        <span class="font-semibold text-base text-gray-900 dark:text-white">
                            Can I customize invoice templates with my own branding?
                        </span>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="px-6 pb-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/60 pt-4">
                        Yes! You can add your company logo, payment notes, tax IDs, and bank details. Every invoice is exported in a crisp, print-ready PDF format.
                    </div>
                </div>

                <!-- Soru 3 -->
                <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition">
                    <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center gap-4 focus:outline-none">
                        <span class="font-semibold text-base text-gray-900 dark:text-white">
                            How does payment tracking work?
                        </span>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="px-6 pb-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/60 pt-4">
                        Invoices automatically toggle between <strong>Paid</strong>, <strong>Pending</strong>, and <strong>Overdue</strong> based on due dates and recorded transactions. You can record partial or full payments directly from the dashboard.
                    </div>
                </div>

                <!-- Soru 4 -->
                <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition">
                    <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center gap-4 focus:outline-none">
                        <span class="font-semibold text-base text-gray-900 dark:text-white">
                            Can I bill international clients in multiple currencies?
                        </span>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="px-6 pb-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/60 pt-4">
                        Absolutely. BillFlow supports USD, EUR, GBP, and major world currencies, allowing you to set specific currency and tax rates on a per-client or per-invoice basis.
                    </div>
                </div>

                <!-- Soru 5 -->
                <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden transition">
                    <button @click="open = !open" class="w-full px-6 py-5 text-left flex justify-between items-center gap-4 focus:outline-none">
                        <span class="font-semibold text-base text-gray-900 dark:text-white">
                            Is my financial data secure?
                        </span>
                        <svg :class="{'rotate-180': open}" class="w-5 h-5 text-gray-500 transition-transform duration-200 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-cloak class="px-6 pb-6 text-sm text-gray-600 dark:text-gray-400 leading-relaxed border-t border-gray-50 dark:border-gray-700/60 pt-4">
                        Yes. Built on the secure Laravel framework, all data transfers are encrypted via SSL, authentication is fortified with modern hashing, and sensitive client information is isolated in your private database.
                    </div>
                </div>

            </div>

            <!-- 3. BÖLÜM: Cevap Bulamadınız mı? (Support CTA) -->
            <div class="mt-16 p-8 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700 text-center">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Still have questions?</h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Can't find the answer you're looking for? Reach out to our team directly.
                </p>
                <a href="mailto:support@billflow.com" class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-semibold rounded-xl shadow-sm transition">
                    Contact Support
                </a>
            </div>

            <!-- Footer -->
            <footer class="mt-16 pt-8 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} BillFlow. All rights reserved. Built with Laravel & Tailwind CSS.
            </footer>

        </div>
    </div>
</x-app-layout>