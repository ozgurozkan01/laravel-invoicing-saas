<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f9fafb; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 12px; border: 1px solid #e5e7eb; }
        .header { margin-bottom: 24px; }
        .receipt-card { background: #f3f4f6; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .row { display: flex; justify-content: space-between; margin-bottom: 8px; }
        .bold { font-weight: 600; }
        .total-paid { color: #059669; font-size: 18px; font-weight: bold; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #4f46e5; color: #ffffff !important; text-decoration: none; border-radius: 8px; font-weight: 500; margin-top: 15px; }
        .footer { margin-top: 30px; font-size: 12px; color: #6b7280; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Payment Confirmation</h2>
            <p>Dear {{ $invoice->client->name }},</p>
            <p>We have successfully received your payment for invoice <strong>#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</strong>.</p>
        </div>

        <div class="receipt-card">
            <div class="row">
                <span>Payment Date:</span>
                <span class="bold">{{ $payment->paid_at->format('M d, Y') }}</span>
            </div>
            <div class="row">
                <span>Payment Method:</span>
                <span class="bold">{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</span>
            </div>
            <div class="row">
                <span>Amount Paid:</span>
                <span class="total-paid">${{ number_format($payment->amount, 2) }}</span>
            </div>
            <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 12px 0;">
            <div class="row">
                <span>Invoice Total:</span>
                <span>${{ number_format($invoice->amount, 2) }}</span>
            </div>
            <div class="row">
                <span>Total Paid So Far:</span>
                <span>${{ number_format($invoice->paid_amount, 2) }}</span>
            </div>
            <div class="row">
                <span class="bold">Remaining Balance:</span>
                <span class="bold" style="color: {{ $invoice->remaining_amount > 0 ? '#b91c1c' : '#059669' }};">
                    ${{ number_format($invoice->remaining_amount, 2) }}
                </span>
            </div>
        </div>

        @if($invoice->remaining_amount == 0)
            <p style="color: #059669; font-weight: 600;">✓ This invoice is now completely paid. Thank you!</p>
        @else
            <p>You have an outstanding balance of <strong>${{ number_format($invoice->remaining_amount, 2) }}</strong> on this invoice.</p>
        @endif

        <p>The updated invoice PDF has been attached to this email for your records.</p>

        <div class="footer">
            <p>Thank you for choosing {{ config('app.name') }}.</p>
        </div>
    </div>
</body>
</html>