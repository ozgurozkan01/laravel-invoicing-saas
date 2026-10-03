<!DOCTYPE html>
<html lang="tr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</title>
    <style>
        @page {
            margin: 35px 42px 45px 42px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "DejaVu Sans", sans-serif;
            color: #1e293b;
            font-size: 11px;
            line-height: 1.5;
            background: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Tipografi & Yardımcı Sınıflar */
        .w-full {
            width: 100%;
            border-collapse: collapse;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #64748b;
            font-size: 9.5px;
        }

        .font-semibold {
            font-weight: bold;
            color: #0f172a;
        }

        /* Üst Bölüm Çizgileri */
        .divider {
            border-bottom: 1px solid #e2e8f0;
            margin: 18px 0;
        }

        /* Durum Rozeti (Badge) */
        .status-badge {
            display: inline-block;
            padding: 3px 9px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .status-paid {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .status-sent {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .status-overdue {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .status-cancelled {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #f87171;
        }

        .status-draft {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        /* Fatura Tablosu */
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .invoice-table th {
            border-bottom: 2px solid #0f172a;
            padding: 8px 10px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            color: #0f172a;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .invoice-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 10.5px;
            color: #334155;
        }

        /* Toplam Tablosu */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 6px 10px;
            font-size: 11px;
        }

        .grand-total {
            border-top: 2px solid #0f172a;
            border-bottom: 2px solid #0f172a;
        }

        .grand-total td {
            padding: 10px 10px;
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
        }

        /* Sayfa Alt Bilgisi */
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0;
            right: 0;
            border-top: 1px solid #f1f5f9;
            padding-top: 12px;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- ================= 1. HEADER (LOGO & FATURA NO) ================= -->
    <table class="w-full">
        <tr>
            <td style="width: 50%; vertical-align: middle;">
                <table style="border-collapse: collapse;">
                    <tr>
                        <td style="width: 38px; height: 38px; vertical-align: middle;">
                            <!-- Doğrudan Base64 SVG (DomPDF'in yutamayacağı format) -->
                            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzOCIgaGVpZ2h0PSIzOCIgdmlld0JveD0iMCAwIDM4IDM4Ij4KICA8cmVjdCB3aWR0aD0iMzgiIGhlaWdodD0iMzgiIHJ4PSIxMCIgZmlsbD0iIzRmNDZlNSIvPgogIDxwYXRoIGQ9Ik0xOC41IDEwTDEwLjUgMjJoN2wtMSA2IDgtMTBoLTdsMS02eiIgZmlsbD0iI2ZmZmZmZiIvPgo8L3N2Zz4="
                                width="38" height="38" style="display: block; border-radius: 10px;"
                                alt="BillFlow Logo" />
                        </td>
                        <td style="padding-left: 11px; vertical-align: middle;">
                            <div
                                style="font-size: 21px; font-weight: bold; color: #0f172a; letter-spacing: -0.5px; line-height: 1;">
                                Bill<span style="color: #4f46e5;">Flow</span><span style="color: #4f46e5;">.</span>
                            </div>
                            <div style="font-size: 8.5px; color: #94a3b8; letter-spacing: 0.2px; margin-top: 3px;">
                                Automated Invoicing & Billing
                            </div>
                        </td>
                    </tr>
                </table>
            </td>

            <!-- SAĞ: Invoice No & Status -->
            <td style="width: 50%; vertical-align: middle;" class="text-right">
                <div style="font-size: 20px; font-weight: bold; letter-spacing: -0.5px; color: #0f172a;">
                    INVOICE
                </div>
                <div style="font-size: 11.5px; font-weight: bold; color: #4f46e5; margin-top: 2px;">
                    #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                </div>
                <div style="margin-top: 5px;">
                    @if ($invoice->status === 'paid')
                        <div>
                            <span class="status-badge status-paid">Paid</span>
                        </div>
                        <div style="font-size: 8px; color: #059669; font-weight: bold; margin-top: 3px;">
                            Payment received. Thank you!
                        </div>
                    @elseif ($invoice->status === 'sent')
                        <div>
                            <span class="status-badge status-sent">Pending Payment</span>
                        </div>
                        <div style="font-size: 8px; color: #1e40af; margin-top: 3px;">
                            Awaiting payment before due date
                        </div>
                    @elseif ($invoice->status === 'overdue')
                        <div>
                            <span class="status-badge status-overdue">Overdue</span>
                        </div>
                        <div style="font-size: 8px; color: #dc2626; font-weight: bold; margin-top: 3px;">
                            Past due date. Please settle immediately
                        </div>
                    @elseif ($invoice->status === 'cancelled')
                        <div>
                            <span class="status-badge status-cancelled">Cancelled / Void</span>
                        </div>
                        <div style="font-size: 8px; color: #dc2626; font-weight: bold; margin-top: 3px;">
                            No payment required · Invoice voided
                        </div>
                    @else
                        <div>
                            <span class="status-badge status-draft">Draft</span>
                        </div>
                        <div style="font-size: 8px; color: #64748b; font-style: italic; margin-top: 3px;">
                            Not an official invoice · Pending review
                        </div>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <!-- ================= 2. MÜŞTERİ & TARİH BİLGİLERİ ================= -->
    <table class="w-full" style="margin-bottom: 25px;">
        <tr>
            <!-- Billed To -->
            <td style="width: 50%; vertical-align: top; padding-right: 20px;">
                <div class="text-muted"
                    style="text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px; margin-bottom: 6px;">
                    Billed To
                </div>
                <div style="font-size: 13px; font-weight: bold; color: #0f172a;">
                    {{ $invoice->client->name ?? 'Valued Customer' }}
                </div>
                @if (!empty($invoice->client->company_name))
                    <div style="font-size: 11px; font-weight: bold; color: #475569; margin-top: 1px;">
                        {{ $invoice->client->company_name }}
                    </div>
                @endif
                <div style="color: #64748b; font-size: 10px; margin-top: 3px;">
                    {{ $invoice->client->email ?? '' }}
                    @if (!empty($invoice->client->phone))
                        · {{ $invoice->client->phone }}
                    @endif
                </div>
                @if (!empty($invoice->billing_address))
                    <div style="color: #64748b; font-size: 10px; margin-top: 3px; line-height: 1.35;">
                        {{ $invoice->billing_address }}
                        @if (!empty($invoice->billing_city))
                            , {{ $invoice->billing_city }}
                        @endif
                        @if (!empty($invoice->billing_state))
                            , {{ $invoice->billing_state }}
                        @endif
                        @if (!empty($invoice->billing_postal_code))
                            {{ $invoice->billing_postal_code }}
                        @endif
                    </div>
                @endif
            </td>

            <!-- Tarih ve Ödeme Bilgileri -->
            <td style="width: 50%; vertical-align: top;">
                <table class="w-full">
                    <tr>
                        <td class="text-muted"
                            style="text-transform: uppercase; font-weight: bold; padding-bottom: 5px;">Issue Date:</td>
                        <td class="text-right font-semibold" style="padding-bottom: 5px;">
                            {{ $invoice->created_at ? $invoice->created_at->format('M d, Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted"
                            style="text-transform: uppercase; font-weight: bold; padding-bottom: 5px;">Due Date:</td>
                        <td class="text-right font-semibold"
                            style="padding-bottom: 5px; color: {{ $invoice->due_date && $invoice->due_date->isPast() ? '#dc2626' : '#0f172a' }};">
                            {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted" style="text-transform: uppercase; font-weight: bold;">Currency:</td>
                        <td class="text-right font-semibold">USD ($)</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- ================= 3. FATURA KALEMLERİ TABLOSU ================= -->
    <table class="invoice-table">
        <thead>
            <tr>
                <th style="width: 52%;">Description</th>
                <th style="width: 14%; text-align: center;">Qty</th>
                <th style="width: 17%; text-align: right;">Unit Price</th>
                <th style="width: 17%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoice->invoiceItems ?? [] as $item)
                <tr>
                    <td style="font-weight: bold; color: #1e293b;">
                        {{ $item->description }}
                    </td>
                    <td style="text-align: center; color: #64748b;">
                        {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }}
                        @if (!empty($item->unit))
                            <span style="font-size: 8.5px; color: #94a3b8;">{{ $item->unit }}</span>
                        @endif
                    </td>
                    <td style="text-align: right; color: #64748b;">
                        ${{ number_format($item->unit_price, 2) }}
                    </td>
                    <td style="text-align: right; font-weight: bold; color: #0f172a;">
                        ${{ number_format($item->quantity * $item->unit_price, 2) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 25px; color: #94a3b8; font-style: italic;">
                        No line items found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- ================= 4. NOTLAR VE TOPLAM ALANI ================= -->
    <table class="w-full">
        <tr>
            <!-- Sol: Ödeme Talimatı Notu -->
            <td style="width: 55%; vertical-align: top; padding-right: 35px;">
                <div
                    style="font-size: 9px; font-weight: bold; text-transform: uppercase; color: #64748b; letter-spacing: 0.5px; margin-bottom: 4px;">
                    Payment Information
                </div>
                <div style="font-size: 9.5px; color: #64748b; line-height: 1.45;">
                    Thank you for partnering with us. Please ensure the payment is settled on or before the due date.
                    For wire transfers or queries regarding this invoice, contact our support team.
                </div>
            </td>

            <!-- Sağ: Ara Toplam ve Genel Toplam -->
            <td style="width: 45%; vertical-align: top;">
                <table class="totals-table">
                    <tr>
                        <td style="color: #64748b;">Subtotal</td>
                        <td class="text-right font-semibold">${{ number_format($invoice->amount, 2) }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td>Total Due</td>
                        <td class="text-right" style="color: #4f46e5;">
                            ${{ number_format($invoice->amount, 2) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- ================= 5. FOOTER (NETBİOCA İMZASI) ================= -->
    <div class="footer">
        <div style="font-size: 9.5px; font-weight: bold; color: #475569; margin-bottom: 2px;">
            Thank you for your business!
        </div>
        <div style="font-size: 8.5px; color: #94a3b8;">
            BillFlow Invoicing Systems · Istanbul, Turkey
        </div>
        <div style="font-size: 8.5px; color: #94a3b8;">
            BillFlow is an official product of <strong style="color: #4f46e5;">Netbioca</strong>. All rights reserved.
        </div>
    </div>

</body>

</html>
