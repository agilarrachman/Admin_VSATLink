<table width="600" cellpadding="0" cellspacing="0"
    style="background-color:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">

    <!-- Header -->
    <tr>
        <td style="background-color:#5623d8; text-align:center;">
            <h1 style="color:white;">Notifikasi VSATLink</h1>
        </td>
    </tr>

    <!-- Body -->
    <tr>
        <td style="padding:30px; color:#333333;">
            <p style="margin-top:0; font-size:15px;">
                Yth. <strong>Tim Instalasi</strong>,
            </p>

            <p style="font-size:15px; line-height:1.6;"> Kami informasikan bahwa data <strong>nodelink dan
                    provisioning</strong> untuk pesanan berikut telah berhasil diinput oleh Tim Provisioning.
            </p>

            <!-- Order Detail Box -->
            <table width="100%" cellpadding="0" cellspacing="0"
                style="background-color:#f8f7ff; border-left:4px solid #5623d8; padding:20px; margin:20px 0;">
                <tr>
                    <td style="font-size:14px; line-height:1.8;">
                        <strong>Detail Pesanan</strong><br><br>
                        <strong>Nama Customer:</strong> {{ $order->customer->name }}<br>
                        <strong>Kode Pesanan:</strong> {{ $order->unique_order }}<br>
                        <strong>Produk:</strong> {{ $order->product->name }}<br>                        
                        <strong>Jadwal Instalasi:</strong> {{ $activation_nota->installation_date->translatedFormat('d F Y H:i') }}
                    </td>
                </tr>
            </table>

            <p style="font-size:14px; line-height:1.6;"> Pastikan seluruh proses instalasi dan aktivasi dilakukan sesuai
                prosedur operasional yang berlaku. </p>

            <p style="margin-top:25px; font-size:14px;">
                Hormat kami,<br>
                <strong>Sistem VSATLink</strong>
            </p>
        </td>
    </tr>

    <!-- Footer -->
    <tr>
        <td style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777777;">
            Email ini dikirim secara otomatis oleh sistem VSATLink.<br>
            Mohon tidak membalas email ini.
        </td>
    </tr>
</table>
