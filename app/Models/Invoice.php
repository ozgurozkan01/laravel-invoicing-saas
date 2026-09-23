<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'amount',
        'status',
        'due_date'
    ];

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
}
