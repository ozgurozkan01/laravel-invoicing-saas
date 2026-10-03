<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice from BillFlow</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 40px 15px; color: #1e293b;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 580px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- 1. ÜST HEADER: Logo & Fatura Numarası -->
        <tr>
            <td style="padding: 28px 36px; border-bottom: 1px solid #f1f5f9; background-color: #ffffff;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="vertical-align: middle;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width: 34px; height: 34px; vertical-align: middle;">
                                        <!-- BillFlow Şimşek Logo (Base64) -->
                                        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzNCIgaGVpZ2h0PSIzNCIgdmlld0JveD0iMCAwIDM4IDM4Ij4KICA8cmVjdCB3aWR0aD0iMzgiIGhlaWdodD0iMzgiIHJ4PSIxMCIgZmlsbD0iIzRmNDZlNSIvPgogIDxwYXRoIGQ9Ik0xOC41IDEwTDEwLjUgMjJoN2wtMSA2IDgtMTBoLTdsMS02eiIgZmlsbD0iI2ZmZmZmZiIvPgo8L3N2Zz4=" 
                                             width="34" height="34" style="display: block; border-radius: 8px;" alt="BillFlow" />
                                    </td>
                                    <td style="padding-left: 10px; font-size: 19px; font-weight: 800; color: #0f172a; vertical-align: middle;">
                                        Bill<span style="color: #4f46e5;">Flow</span><span style="color: #4f46e5;">.</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="right" style="vertical-align: middle;">
                            <span style="display: inline-block; padding: 4px 10px; background-color: #eff6ff; color: #1d4ed8; font-size: 11px; font-weight: 700; border-radius: 6px; letter-spacing: 0.5px;">
                                #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 2. ANA BÖLÜM: Selamlama & Tutar Vurgusu -->
        <tr>
            <td style="padding: 32px 36px 20px 36px;">
                <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; letter-spacing: -0.3px;">
                    Dear {{ $invoice->client->name ?? 'Valued Customer' }},
                </h2>
                <p style="font-size: 14px; line-height: 1.6; color: #64748b; margin: 0 0 24px 0;">
                    Your invoice <strong>#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</strong> has been issued. An official PDF copy with complete details is attached to this email.
                </p>

                <!-- Tutar Kartı (Hero Box) -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #faf5ff; border: 1.5px solid #e9d5ff; border-radius: 12px; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 20px 24px;">
                            <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #7e22ce; letter-spacing: 0.8px; margin-bottom: 4px;">Amount Due</span>
                            <span style="font-size: 28px; font-weight: 800; color: #4338ca; letter-spacing: -0.5px;">${{ number_format($invoice->amount, 2) }}</span>
                        </td>
                        <td align="right" style="padding: 20px 24px; vertical-align: bottom;">
                            <span style="display: block; font-size: 11px; color: #7e22ce; font-weight: 600;">Due Date</span>
                            <span style="font-size: 13px; font-weight: 700; color: #0f172a;">
                                {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : '-' }}
                            </span>
                        </td>
                    </tr>
                </table>

                <!-- Fatura Kalemleri Özeti -->
                <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #94a3b8; letter-spacing: 0.8px; margin-bottom: 10px;">
                    Invoice Summary
                </div>
                <table width="100%" cellpadding="0" cellspacing="0" style="border: 1px solid #f1f5f9; border-radius: 8px; margin-bottom: 24px; overflow: hidden;">
                    @forelse ($invoice->invoiceItems ?? [] as $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 16px; font-size: 13px; font-weight: 600; color: #1e293b;">
                                {{ $item->description }}
                                <span style="display: block; font-size: 11px; color: #94a3b8; font-weight: normal; margin-top: 2px;">
                                    Qty: {{ rtrim(rtrim(number_format($item->quantity, 2), '0'), '.') }} {{ $item->unit }}
                                </span>
                            </td>
                            <td align="right" style="padding: 12px 16px; font-size: 13px; font-weight: 700; color: #0f172a;">
                                ${{ number_format($item->quantity * $item->unit_price, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" style="padding: 12px 16px; font-size: 13px; color: #94a3b8; font-style: italic;">
                                Invoice details included in attachment.
                            </td>
                        </tr>
                    @endforelse
                </table>

                <!-- BUTON YERİNE: ŞIK PDF EK DOSYA BİLGİ ROZETİ -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 12px 18px;">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="width: 36px; vertical-align: middle;">
                                        <!-- PDF İkon Rozeti -->
                                        <div style="width: 32px; height: 32px; background-color: #fee2e2; border-radius: 8px; text-align: center; line-height: 32px; font-size: 10px; font-weight: 800; color: #dc2626;">
                                            PDF
                                        </div>
                                    </td>
                                    <td style="padding-left: 12px; vertical-align: middle;">
                                        <div style="font-size: 13px; font-weight: 700; color: #0f172a;">
                                            INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}.pdf
                                        </div>
                                        <div style="font-size: 11px; color: #64748b;">
                                            Full invoice document is attached to this email
                                        </div>
                                    </td>
                                    <td align="right" style="vertical-align: middle;">
                                        <span style="display: inline-block; font-size: 10.5px; font-weight: 700; color: #047857; background-color: #ecfdf5; border: 1px solid #a7f3d0; padding: 4px 10px; border-radius: 6px;">
                                            Attached ✓
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <!-- İLETİŞİM & DESTEK KUTUSU -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
                    <tr>
                        <td style="font-size: 12px; line-height: 1.5; color: #64748b;">
                            <strong style="color: #0f172a; display: block; margin-bottom: 2px;">Questions about this invoice?</strong>
                            Need help or have billing inquiries? Contact our billing team anytime at 
                            <a href="mailto:support@netbioca.com" style="color: #4f46e5; text-decoration: none; font-weight: 600;">support@netbioca.com</a> 
                            or call us at <strong>+90 (850) 000-0000</strong>.
                        </td>
                    </tr>
                </table>

            </td>
        </tr>

        <!-- 3. FOOTER -->
        <tr>
            <td style="padding: 24px 36px; background-color: #f8fafc; border-top: 1px solid #f1f5f9; text-align: center;">
                <p style="margin: 0 0 6px 0; font-size: 11px; color: #64748b;">
                    BillFlow Invoicing Systems · Istanbul, Turkey
                </p>
                <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                    BillFlow is an official product of <strong style="color: #4f46e5;">Netbioca</strong>. All rights reserved.
                </p>
            </td>
        </tr>
    </table>

</body>
</html>