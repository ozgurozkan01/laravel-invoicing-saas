<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="font-bold text-2xl text-gray-900 dark:text-white tracking-tight">
                        {{ __('Overview') }}
                    </h2>
                    @if ($plan && $plan->max_invoice_limit !== null)
                        <div class="relative group inline-block">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-medium bg-white dark:bg-gray-800 border {{ $invoiceCount >= $plan->max_invoice_limit ? 'border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-400 bg-rose-50/50' : 'border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300' }} shadow-xs hover:border-indigo-300 dark:hover:border-indigo-600 transition cursor-help">
                                <span class="relative flex h-2 w-2">
                                    @if ($invoiceCount >= $plan->max_invoice_limit)
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                                    @else
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                    @endif
                                </span>

                                <span><strong
                                        class="font-semibold">{{ $invoiceCount }}</strong>/{{ $plan->max_invoice_limit }}
                                    Invoices</span>

                                <svg class="w-3 h-3 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200 transition-transform duration-200 group-hover:translate-y-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <div
                                class="absolute left-0 mt-2 w-72 p-4 bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-800 text-xs z-50 invisible opacity-0 -translate-y-1 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 ease-out pointer-events-none group-hover:pointer-events-auto">

                                <div
                                    class="flex items-center justify-between pb-2.5 border-b border-gray-100 dark:border-gray-800">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white">{{ $plan->name ?? 'Free' }}
                                        Plan Limit</span>
                                    <span
                                        class="font-bold {{ $invoiceCount >= $plan->max_invoice_limit ? 'text-rose-500' : 'text-indigo-600 dark:text-indigo-400' }}">
                                        {{ round(($invoiceCount / $plan->max_invoice_limit) * 100) }}% Used
                                    </span>
                                </div>

                                <div
                                    class="w-full h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full mt-3 overflow-hidden">
                                    <div class="h-full {{ $invoiceCount >= $plan->max_invoice_limit ? 'bg-rose-500' : 'bg-indigo-600' }} rounded-full transition-all"
                                        style="width: {{ min(100, ($invoiceCount / $plan->max_invoice_limit) * 100) }}%">
                                    </div>
                                </div>

                                <div class="mt-3.5 space-y-2 text-gray-600 dark:text-gray-400">
                                    <div class="flex justify-between items-center">
                                        <span>Active billable:</span>
                                        <span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $invoiceCount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('invoices.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Invoice
                </a>

                <a href="{{ route('clients.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Client
                </a>
            </div>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if (session('success'))
                <div
                    class="flex items-center justify-between p-4 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 rounded-xl text-sm">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ session('success') }}
                    </span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">

                <div
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Total Collected</p>
                            <span
                                class="text-xs font-medium text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/40 px-2 py-0.5 rounded-md">Paid</span>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight mt-2">
                            ${{ number_format($totalRevenue, 2) }}
                        </h3>
                    </div>

                    <p class="text-xs text-gray-500 mt-3">Historical received revenue</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Awaiting</p>
                            <span
                                class="text-xs font-medium text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/40 px-2 py-0.5 rounded-md">{{ $outstandingCount }}
                                Invoice</span>
                        </div>
                        <h3 class="text-2xl font-bold text-amber-600 dark:text-amber-400 tracking-tight mt-2">
                            ${{ number_format($outstandingAmount, 2) }}
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Pending upcoming payment</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Overdue Risk</p>
                            <span
                                class="text-xs font-medium text-rose-700 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/40 px-2 py-0.5 rounded-md">{{ $overdueCount }}
                                Urgent</span>
                        </div>
                        <h3 class="text-2xl font-bold text-rose-600 dark:text-rose-400 tracking-tight mt-2">
                            ${{ number_format($overdueAmount, 2) }}
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Requires follow-up</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Cancelled</p>
                            <span
                                class="text-xs font-medium text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-2 py-0.5 rounded-md">
                                {{ $cancelledCount ?? 0 }} Cancelled
                            </span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-500 dark:text-gray-400 tracking-tight mt-2">
                            ${{ number_format($cancelledAmount ?? 0, 2) }}
                        </h3>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">Revoked or written off</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-medium uppercase tracking-wider text-gray-400">Clients</p>
                            <span
                                class="text-xs font-medium text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/40 px-2 py-0.5 rounded-md">+{{ $newClientsThisMonth }}
                                new</span>
                        </div>
                        <h3
                            class="flex items-center gap-2 text-2xl font-bold text-gray-900 dark:text-white tracking-tight mt-2">
                            <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ $totalClients }}</span>
                        </h3>
                    </div>
                    <p class="text-xs text-gray-500 mt-3">Accounts billed this year</p>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div
                    class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm p-6 flex flex-col justify-between">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                        <div>
                            <h3 class="font-bold text-base text-gray-900 dark:text-white">Cashflow Inflow</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Monthly revenue collection trends</p>
                        </div>

                        <div
                            class="inline-flex items-center p-1 bg-gray-100 dark:bg-gray-900/60 rounded-xl border border-gray-200/50 dark:border-gray-700/50 self-start sm:self-auto">
                            <button type="button" onclick="changePeriod('7D')" data-period="7D"
                                class="period-btn px-3 py-1 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                Week
                            </button>
                            <button type="button" onclick="changePeriod('1M')" data-period="1M"
                                class="period-btn px-3 py-1 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                Month
                            </button>
                            <button type="button" onclick="changePeriod('6M')" data-period="6M"
                                class="period-btn px-3 py-1 text-xs font-semibold rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-xs transition">
                                6 Months
                            </button>
                            <button type="button" onclick="changePeriod('1Y')" data-period="1Y"
                                class="period-btn px-3 py-1 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition">
                                Year
                            </button>
                        </div>
                    </div>

                    <div class="relative h-64 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700/60 shadow-sm p-6 flex flex-col justify-between">
                    <div>
                        <div
                            class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-gray-700">
                            <div>
                                <h3 class="font-bold text-base text-gray-900 dark:text-white">Attention Needed</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Past due or due soon (within 7
                                    days)</p>
                            </div>
                            <span class="flex h-2.5 w-2.5 relative">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500"></span>
                            </span>
                        </div>

                        <div class="divide-y divide-gray-100 dark:divide-gray-800 mt-2">
                            @forelse ($attentionInvoices as $invoice)
                                <a href="{{ route('invoices.show', $invoice) }}"
                                    class="group flex items-center justify-between py-3 px-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-800/60 transition duration-150">

                                    <div class="min-w-0 pr-3">
                                        <p
                                            class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $invoice->title ?? 'Invoice #' . str_pad($invoice->id, 4, '0', STR_PAD_LEFT) }}
                                        </p>
                                        <div
                                            class="flex items-center gap-1.5 text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                                            <span class="truncate max-w-[120px]">{{ $invoice->client->name }}</span>
                                            <span>•</span>
                                            @if ($invoice->status === 'overdue')
                                                <span class="text-rose-500 font-medium">
                                                    Overdue {{ $invoice->due_date->diffForHumans() }}
                                                </span>
                                            @else
                                                <span class="text-amber-500/90 font-medium">
                                                    Due {{ $invoice->due_date->diffForHumans() }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <span
                                            class="text-sm font-semibold text-gray-900 dark:text-white tabular-nums tracking-tight">
                                            ${{ number_format($invoice->amount, 2) }}
                                        </span>
                                        <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-200 group-hover:translate-x-0.5 transition-all"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </a>
                            @empty
                                <div class="py-8 text-center">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">All caught up!</p>
                                    <p class="text-xs text-gray-500 mt-1">No overdue or urgent invoices right now.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 mt-4">
                        <a href="{{ route('invoices.index') }}"
                            class="block text-center text-xs font-medium text-gray-600 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400 py-1 transition">
                            Open Invoices Manager &rarr;
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const allChartData = @json($chartData);
        let revenueChart = null;

        function initChart(period = '6M') {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return;

            const isDark = document.documentElement.classList.contains('dark');
            const currentData = allChartData[period] || allChartData['6M'];

            revenueChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: currentData.labels,
                    datasets: [{
                        label: 'Revenue',
                        data: currentData.data,
                        backgroundColor: '#6366f1',
                        hoverBackgroundColor: '#4f46e5',
                        borderRadius: 6,
                        borderSkipped: false,
                        barThickness: period === '1Y' ? 16 : 24,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 400
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            padding: 10,
                            callbacks: {
                                label: (context) => '$' + Number(context.raw).toLocaleString()
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: isDark ? '#94a3b8' : '#64748b',
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            border: {
                                dash: [4, 4]
                            },
                            grid: {
                                color: isDark ? '#334155' : '#f1f5f9'
                            },
                            ticks: {
                                color: isDark ? '#94a3b8' : '#64748b',
                                font: {
                                    size: 11
                                },
                                callback: (v) => '$' + Number(v).toLocaleString()
                            }
                        }
                    }
                }
            });
        }

        function changePeriod(period) {
            if (!revenueChart || !allChartData[period]) return;

            document.querySelectorAll('.period-btn').forEach(btn => {
                if (btn.dataset.period === period) {
                    btn.className =
                        'period-btn px-3 py-1 text-xs font-semibold rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-xs transition';
                } else {
                    btn.className =
                        'period-btn px-3 py-1 text-xs font-medium rounded-lg text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition';
                }
            });

            revenueChart.data.labels = allChartData[period].labels;
            revenueChart.data.datasets[0].data = allChartData[period].data;
            revenueChart.data.datasets[0].barThickness = period === '1Y' ? 16 : 24;
            revenueChart.update();
        }

        document.addEventListener('DOMContentLoaded', () => {
            initChart('6M');
        });
    </script>
</x-app-layout>
