<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invoice;
use App\Mail\PaymentReceivedMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $validated = $request->validate([
            'amount'  => ['required', 'numeric', 'min:0.01', 'max:' . $invoice->remaining_amount],
            'paid_at' => ['required', 'date', 'after_or_equal:' . $invoice->created_at->format('Y-m-d'), 'before_or_equal:today'],
            'method'  => ['required', 'in:cash,bank_transfer,credit_card,online,other'],
        ]);

        $payment = null;

         DB::transaction(function () use ($validated, $invoice, &$payment) {
            $payment = $invoice->payments()->create($validated);
        });

        if ($invoice->client && !empty($invoice->client->email)) {
            Mail::to($invoice->client->email)->send(new PaymentReceivedMail($payment, $invoice->fresh()));
        }

        return redirect()->route('invoices.show', $invoice)->with('success', 'Ödeme kaydedildi.');
    }
}
