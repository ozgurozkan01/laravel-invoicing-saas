<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalRevenue = $user->invoices()->where('status', 'paid')->sum('amount');

        $outstandingQuery = $user->invoices()->where('status', 'sent');
        $outstandingAmount = $outstandingQuery->sum('amount');
        $outstandingCount = $outstandingQuery->count();

        $overdueQuery = $user->invoices()->where('status', 'overdue');
        $overdueAmount = $overdueQuery->sum('amount');
        $overdueCount = $overdueQuery->count();

        $totalClients = $user->clients()->count();
        $newClientsThisMonth = $user->clients()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // 🎯 ATTENTION NEEDED: Limit olmadan hepsini getir
        $attentionInvoices = $user->invoices()
            ->with('client')
            ->where(function ($query) {
                $query->where('status', 'overdue')
                    ->orWhere(function ($subQuery) {
                        $subQuery->where('status', 'sent')
                            ->whereBetween('due_date', [
                                now()->startOfDay(), 
                                now()->addDays(7)->endOfDay()
                            ]);
                    });
            })
            ->orderBy('due_date', 'asc')
            ->get();

        $monthlyRevenue = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = $user->invoices()
                ->where('status', 'paid')
                ->whereMonth('updated_at', $month->month)
                ->whereYear('updated_at', $month->year)
                ->sum('amount');

            $monthlyRevenue->push([
                'label' => $month->format('M'),
                'total' => $total,
            ]);
        }

        $weekly = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $total = $user->invoices()
                ->where('status', 'paid')
                ->whereDate('updated_at', $date->toDateString())
                ->sum('amount');

            $weekly->push([
                'label' => $date->format('D'),
                'total' => (float) $total,
            ]);
        }

        $monthly = collect();
        for ($i = 3; $i >= 0; $i--) {
            $startOfWeek = now()->subWeeks($i)->startOfWeek();
            $endOfWeek   = now()->subWeeks($i)->endOfWeek();

            $total = $user->invoices()
                ->where('status', 'paid')
                ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                ->sum('amount');

            $monthly->push([
                'label' => 'W' . (4 - $i),
                'total' => (float) $total,
            ]);
        }

        $sixMonths = collect();
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = $user->invoices()
                ->where('status', 'paid')
                ->whereMonth('updated_at', $month->month)
                ->whereYear('updated_at', $month->year)
                ->sum('amount');

            $sixMonths->push([
                'label' => $month->format('M'),
                'total' => (float) $total,
            ]);
        }

        $yearly = collect();
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $total = $user->invoices()
                ->where('status', 'paid')
                ->whereMonth('updated_at', $month->month)
                ->whereYear('updated_at', $month->year)
                ->sum('amount');

            $yearly->push([
                'label' => $month->format('M y'),
                'total' => (float) $total,
            ]);
        }

        $chartData = [
            '7D' => ['labels' => $weekly->pluck('label'),    'data' => $weekly->pluck('total')],
            '1M' => ['labels' => $monthly->pluck('label'),   'data' => $monthly->pluck('total')],
            '6M' => ['labels' => $sixMonths->pluck('label'), 'data' => $sixMonths->pluck('total')],
            '1Y' => ['labels' => $yearly->pluck('label'),    'data' => $yearly->pluck('total')],
        ];

        $plan = $user->plan;
        $invoiceCount = $user->invoices()->count();
        $cancelledCount  = $user->invoices()->where('status', 'cancelled')->count();
        $cancelledAmount = $user->invoices()->where('status', 'cancelled')->sum('amount');

        return view('dashboard', compact(
            'chartData',
            'totalRevenue',
            'outstandingAmount',
            'outstandingCount',
            'overdueAmount',
            'overdueCount',
            'totalClients',
            'newClientsThisMonth',
            'attentionInvoices',
            'monthlyRevenue',
            'plan',
            'invoiceCount',
            'cancelledCount',
            'cancelledAmount',
        ));
    }
}
