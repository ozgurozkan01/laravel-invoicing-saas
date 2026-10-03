<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Cancelled - BillFlow</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f1f5f9; margin: 0; padding: 40px 15px; color: #1e293b;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 580px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- 1. ÜST HEADER: Logo & İptal Rozeti -->
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
                            <span style="display: inline-block; padding: 4px 10px; background-color: #fef2f2; color: #dc2626; font-size: 11px; font-weight: 800; border-radius: 6px; letter-spacing: 0.6px; border: 1px solid #fecaca; text-transform: uppercase;">
                                Cancelled
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 2. ANA BÖLÜM -->
        <tr>
            <td style="padding: 32px 36px 20px 36px;">
                <h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0; letter-spacing: -0.3px;">
                    Dear {{ $invoice->client->name ?? 'Valued Customer' }},
                </h2>
                <p style="font-size: 14px; line-height: 1.6; color: #64748b; margin: 0 0 24px 0;">
                    This is an official confirmation that invoice <strong>#INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</strong> has been <span style="color: #dc2626; font-weight: 700;">cancelled and voided</span>. <strong>No payment is required</strong> for this invoice.
                </p>

                <!-- İptal Durum Kutusu (Hero Box) -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fef2f2; border: 1.5px solid #fecaca; border-radius: 12px; margin-bottom: 24px;">
                    <tr>
                        <td style="padding: 20px 24px;">
                            <span style="display: block; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #991b1b; letter-spacing: 0.8px; margin-bottom: 4px;">
                                Voided Amount
                            </span>
                            <span style="font-size: 26px; font-weight: 800; color: #b91c1c; text-decoration: line-through; letter-spacing: -0.5px;">
                                ${{ number_format($invoice->amount, 2) }}
                            </span>
                            <span style="display: inline-block; margin-left: 8px; font-size: 13px; font-weight: 700; color: #059669; text-decoration: none;">
                                &rarr; $0.00 Due
                            </span>
                        </td>
                        <td align="right" style="padding: 20px 24px; vertical-align: bottom;">
                            <span style="display: block; font-size: 11px; color: #991b1b; font-weight: 600;">Invoice Reference</span>
                            <span style="font-size: 13px; font-weight: 700; color: #0f172a;">
                                #INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <!-- Bilgilendirme Notu -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; margin-bottom: 24px;">
                    <tr>
                        <td style="font-size: 12px; line-height: 1.6; color: #64748b;">
                            <strong style="color: #0f172a; display: block; margin-bottom: 4px;">What does this mean?</strong>
                            • You can disregard any prior payment requests regarding this invoice.<br>
                            • If you have already executed a bank transfer or payment, our billing team will process the reversal/credit accordingly.<br>
                            • If a replacement invoice is issued, you will receive a separate notification.
                        </td>
                    </tr>
                </table>

                <!-- İLETİŞİM & DESTEK KUTUSU -->
                <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px;">
                    <tr>
                        <td style="font-size: 12px; line-height: 1.5; color: #64748b;">
                            <strong style="color: #0f172a; display: block; margin-bottom: 2px;">Have questions regarding this cancellation?</strong>
                            If you believe this invoice was cancelled in error or need assistance, reach out to us at 
                            <a href="mailto:support@netbioca.com" style="color: #4f46e5; text-decoration: none; font-weight: 600;">support@netbioca.com</a> 
                            or call our billing department at <strong>+90 (850) 000-0000</strong>.
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