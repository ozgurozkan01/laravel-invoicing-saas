<x-app-layout>
    <!-- Hero / Karşılama Bölümü -->
    <div class="min-h-[calc(100vh-4rem)] flex flex-col justify-between">
        
        <main class="max-w-4xl mx-auto px-6 py-20 sm:py-28 text-center my-auto">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 dark:bg-indigo-950/60 text-indigo-700 dark:text-indigo-400 border border-indigo-100 dark:border-indigo-900/50 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                Modern invoicing & billing for modern businesses
            </div>

            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight text-gray-900 dark:text-white leading-tight">
                Manage clients, invoices & payments in one place.
            </h1>

            <p class="mt-6 text-lg sm:text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                BillFlow streamlines your entire cash-flow workflow. Create professional invoices, track payments, and manage client relations effortlessly.
            </p>

            <div class="mt-10 flex flex-wrap justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-3.5 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white shadow-sm transition">
                        Go to Dashboard &rarr;
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-6 py-3.5 text-sm font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white shadow-sm transition">
                        Get Started Free
                    </a>
                    
                    <a href="{{ route('login') }}" class="px-6 py-3.5 text-sm font-semibold rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Log In
                    </a>
                @endauth
            </div>
        </main>

        <footer class="w-full max-w-7xl mx-auto px-6 py-8 text-center text-xs text-gray-500 dark:text-gray-400 border-t border-gray-100 dark:border-gray-800">
            &copy; {{ date('Y') }} BillFlow. All rights reserved. Built with Laravel & Tailwind CSS.
        </footer>
        
    </div>
</x-app-layout>