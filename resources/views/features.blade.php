<x-app-layout>
    <div class="py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- 1. BÖLÜM: Sayfa Başlığı (Hero Header) -->
            <div class="text-center max-w-3xl mx-auto">
                <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                    Built for Freelancers, Agencies & Startups
                </span>

                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight">
                    Everything you need to get paid faster.
                </h1>

                <p class="mt-5 text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                    BillFlow takes the friction out of billing. Manage client relationships, generate professional invoices, and track incoming payments with complete clarity.
                </p>
            </div>

            <!-- 2. BÖLÜM: 6'lı Özellik Kartları Grid'i -->
            <div class="mt-16 sm:mt-20 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Özellik 1: Smart Invoicing -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Instant Invoicing</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Generate beautiful PDF invoices in seconds. Customize item rates, taxes, discounts, and payment terms effortlessly.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                        PDF Export & Print Ready &rarr;
                    </div>
                </div>

                <!-- Özellik 2: Client Management -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Client Directory</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Organize all client contacts, billing addresses, and historical payment records in one central address book.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                        Full Customer CRM &rarr;
                    </div>
                </div>

                <!-- Özellik 3: Real-Time Payment Tracking -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Payment Tracking</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Know which invoices are paid, pending, or overdue in real-time. Record partial or full payments with single-click reconciliation.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                        Live Status Badges &rarr;
                    </div>
                </div>

                <!-- Özellik 4: Automated Reminders -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Automated Reminders</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Never chase late payments manually again. Send automated friendly email nudges before and after invoice due dates.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-amber-600 dark:text-amber-400">
                        Smart Due Notifications &rarr;
                    </div>
                </div>

                <!-- Özellik 5: Financial Metrics & Insights -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Revenue Insights</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Clear monthly revenue breakdown and outstanding balance overviews directly on your dashboard.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                        Real-Time Analytics &rarr;
                    </div>
                </div>

                <!-- Özellik 6: Multi-Currency & Security -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:border-indigo-200 dark:hover:border-indigo-800 transition duration-200 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Secure & Multi-Currency</h3>
                        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                            Bill international clients in USD, EUR, or GBP. Your data is encrypted and safeguarded with enterprise-grade standards.
                        </p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-50 dark:border-gray-700/50 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                        Bank-Grade Encryption &rarr;
                    </div>
                </div>

            </div>

            <!-- 3. BÖLÜM: Alt Aksiyon Alanı (CTA Banner) -->
            <div class="mt-20 bg-indigo-600 dark:bg-indigo-700 rounded-3xl p-8 sm:p-14 text-center text-white relative overflow-hidden shadow-xl shadow-indigo-500/10">
                <div class="max-w-2xl mx-auto">
                    <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                        Ready to streamline your billing?
                    </h2>
                    <p class="mt-4 text-indigo-100 text-base sm:text-lg">
                        Join modern businesses using BillFlow to manage clients, issue invoices, and get paid without delays.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="px-6 py-3.5 bg-white text-indigo-700 hover:bg-indigo-50 font-semibold rounded-xl text-sm shadow-sm transition">
                                Go to Your Dashboard &rarr;
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-6 py-3.5 bg-white text-indigo-700 hover:bg-indigo-50 font-semibold rounded-xl text-sm shadow-sm transition">
                                Create Free Account
                            </a>
                            <a href="{{ route('login') }}" class="px-6 py-3.5 bg-indigo-700/60 hover:bg-indigo-700 border border-indigo-400/40 text-white font-semibold rounded-xl text-sm transition">
                                Log In
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="mt-20 pt-8 border-t border-gray-100 dark:border-gray-800 text-center text-xs text-gray-500 dark:text-gray-400">
                &copy; {{ date('Y') }} BillFlow. All rights reserved. Built with Laravel & Tailwind CSS.
            </footer>

        </div>
    </div>
</x-app-layout>