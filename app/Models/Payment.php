<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'amount',
        'paid_at',
        'method'
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'date',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function booted()
    {
        static::saved(function (Payment $payment) {
            $payment->invoice?->refreshPaymentStatus();
        });

        static::deleted(function (Payment $payment) {
            $payment->invoice?->refreshPaymentStatus();
        });
    }
}
