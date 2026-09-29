<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $validated = $request->validate([
            'paid_at' => 'required|date|after_or_equal:' . $invoice->created_at->format('Y-m-d') . '|before_or_equal:today',
            'method' => 'required|in:cash,bank_transfer,credit_card',
        ]);

        $validated['amount'] = $invoice->amount;

        DB::transaction(function () use ($validated, $invoice) {
            $invoice->payments()->create($validated);
            $invoice->update(['status' => 'paid']);
        });

        return redirect()->route('invoices.show', $invoice)->with('success', 'Ödeme kaydedildi.');
    }
}
