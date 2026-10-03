<?php

namespace App\Enums;
use Illuminate\Support\Str;

enum PaymentStatus: string
{
    case UNPAID         = 'unpaid';
    case PARTIALLY_PAID = 'partially_paid';
    case PAID           = 'paid';
    case OVERDUE        = 'overdue';
    case OVERPAID       = 'overpaid';

    public function label(): string
    {
        return Str::headline($this->value);
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::UNPAID         => 'bg-rose-50 dark:bg-rose-950/40 text-rose-700 dark:text-rose-400 border-rose-200 dark:border-rose-800',
            self::PARTIALLY_PAID => 'bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800',
            self::PAID           => 'bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
            self::OVERDUE        => 'bg-red-50 dark:bg-red-950/40 text-red-700 dark:text-red-400 border-red-200 dark:border-red-800',
            self::OVERPAID       => 'bg-purple-50 dark:bg-purple-950/40 text-purple-700 dark:text-purple-400 border-purple-200 dark:border-purple-800',
        };
    }
}
