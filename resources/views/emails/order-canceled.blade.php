<table width="600" cellpadding="0" cellspacing="0"
    style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
    <!-- Header -->
    <tr>
        <td style="background-color:#5623d8; text-align:center; padding:20px 0;">
            <h1 style="color: white; margin:0;">Notifikasi VSATLink</h1>
        </td>
    </tr>

    <!-- Body -->
    <tr>
        <td style="padding:30px; color:#333333; font-family:Arial, sans-serif;">
            <p style="margin-top:0; font-size:15px;">Yth. <strong>{{ $customer_name }}</strong>,</p>
            <p style="font-size:15px; line-height:1.6;">
                Pesanan Anda dengan kode <strong>{{ $unique_order }}</strong> telah <strong>dibatalkan</strong>
                oleh <strong>{{ $sales_name }}</strong>.
            </p>

            <!-- Order Detail Box -->
            <table width="100%" cellpadding="0" cellspacing="0"
                style="background-color:#fff3f3; border-left:4px solid #5623d8; padding:20px; margin:20px 0;">
                <tr>
                    <td style="font-size:14px; line-height:1.8;">
                        <strong>Detail Pesanan</strong><br><br>
                        <strong>Produk:</strong> {{ $product_name }}<br>
                        <strong>Alasan Pembatalan:</strong> {{ $reason }}<br>
                        <strong>Tanggal Dibatalkan:</strong> {{ $updated_date }}
                    </td>
                </tr>
            </table>

            <p style="font-size:14px; line-height:1.6;">
                Jika ada pertanyaan terkait pembatalan pesanan Anda, silakan hubungi tim sales kami.
                Kami siap membantu dan memberikan solusi terbaik.
            </p>

            <!-- Button Hubungi Sales -->
            <p style="text-align:center; margin:30px 0;">
                <a href="https://wa.me/{{ $sales_phone }}" target="_blank"
                    style="background-color:#5623d8; color:white; padding:12px 25px; text-decoration:none; border-radius:6px; font-weight:bold; display:inline-block;">
                    Hubungi Sales
                </a>
            </p>

            <p style="font-size:14px; margin-bottom:0;">Terima kasih atas perhatian dan kerja samanya.</p>
            <p style="margin-top:25px; font-size:14px;">Hormat kami,<br><strong>VSATLink Center</strong></p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777777;">
            Email ini dikirim secara otomatis oleh sistem VSATLink.<br> Mohon tidak membalas email ini.
        </td>
    </tr>
</table>
