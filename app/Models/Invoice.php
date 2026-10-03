<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'title',
        'amount',
        'status',
        'payment_status',
        'due_date',
        'billing_address',
        'billing_city',
        'billing_state',
        'billing_postal_code'
    ];

    protected function casts(): array
    {
        return [
            'status' => InvoiceStatus::class,
            'payment_status' => PaymentStatus::class,
            'due_date' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function invoiceItems(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function canBeDeleted(): bool
    {
        return $this->status === 'draft';
    }

    public function getPaidAmountAttribute(): float
    {
        return (float) $this->payments()->sum('amount');
    }

    public function getRemainingAmountAttribute(): float
    {
        return max(0, (float) $this->amount - $this->paid_amount);
    }

    public function getIsOverdueAttribute(): bool
    {
        if ($this->payment_status === PaymentStatus::PAID)
        {
            return false;
        }

        return $this->due_date && $this->due_date->isPast();
    }

    public function refreshPaymentStatus()
    {
        $totalCents = (int) round($this->amount * 100);
        $paidCents  = (int) round($this->payments() ->sum('amount') * 100);

        $newStatus = match (true) {
            $paidCents === 0            => PaymentStatus::UNPAID,
            $paidCents < $totalCents    => PaymentStatus::PARTIALLY_PAID,
            $paidCents === $totalCents  => PaymentStatus::PAID,
            default                     => PaymentStatus::OVERPAID
        };

        if ($this->payment_status !== $newStatus) 
        {
            $this->update(['payment_status' => $newStatus]);
        }
    }

}
