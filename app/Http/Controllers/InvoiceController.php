<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Auth::user()->invoices;

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Auth::user()->clients;

        return view('invoices.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'due_date' => 'required|date|after_or_equal:today',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string|max:255',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $client = Client::findOrFail($validated['client_id']);
        $this->authorize('view', $client);

        DB::transaction(function () use ($validated, $client) {
            $invoice = Auth::user()->invoices()->create([
                'client_id'           => $validated['client_id'],
                'due_date'            => $validated['due_date'],
                'status'              => 'draft',
                'amount'              => 0,
                'billing_address'     => $client->address,
                'billing_city'        => $client->city,
                'billing_state'       => $client->state,
                'billing_postal_code' => $client->postal_code,
            ]);

            foreach ($validated['items'] as $item) {
                $invoice->invoiceItems()->create($item);
            }

            $total = $invoice->invoiceItems->sum(fn ($item) => $item->quantity * $item->unit_price);
            $invoice->update(['amount' => $total]);
        });

        return redirect()->route('invoices.index')->with('success', 'Invoice is created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice is deleted successfully!');
    }

    public function cancel(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $invoice->update(['status' => 'cancelled']);

        return redirect()->route('invoices.show', $invoice)->with('success', 'The invoice has been canceled successfully!');
    }

    public function markAsSent(Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        if ($invoice->status !== 'draft')
        {
            return redirect()->route('invoices.show', $invoice)->with('error', 'Only draft invoices can be sent!');
        }

        $invoice->update(['status' => 'sent']);

        return redirect()->route('invoices.show', $invoice)->with('success', 'The invoice has been marked as sent!');
    }
}
