<?php

namespace App\Enums;
use Illuminate\Support\Str;

enum InvoiceStatus: string
{
    case DRAFT      = 'draft';
    case SENT       = 'sent';
    case CANCELLED  = 'cancelled';

    public function label(): string
    {
        return Str::headline($this->value);
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::DRAFT     => 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-600',
            self::SENT      => 'bg-blue-50 dark:bg-blue-950/40 text-blue-700 dark:text-blue-400 border-blue-200 dark:border-blue-800',
            self::CANCELLED => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-white border-zinc-300 dark:border-zinc-600',
        };
    }
}
