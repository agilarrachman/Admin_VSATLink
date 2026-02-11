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
        <td style="padding:30px; color:#333333;">
            <p style="margin-top:0; font-size:15px;"> Yth. <strong>{{ $customer_name }}</strong>, </p>
            <p style="font-size:15px; line-height:1.6;"> Kami informasikan bahwa pesanan Anda dengan kode
                <strong>{{ $unique_order }}</strong> telah <strong>dijadwalkan untuk proses instalasi dan
                    aktivasi</strong>.
            </p>
            <table width="100%" cellpadding="0" cellspacing="0"
                style="background-color:#f8f7ff; border-left:4px solid #5623d8; padding:20px; margin:20px 0;">
                <tr>
                    <td style="font-size:14px; line-height:1.8;">
                        <strong>Detail Jadwal Instalasi & Aktivasi</strong><br><br>
                        <strong>Produk:</strong> {{ $product_name }}<br>
                        <strong>Tanggal Instalasi:</strong> {{ $installation_date }}<br>
                        <strong>Sales Penanggung Jawab:</strong> {{ $sales_name }}
                    </td>
                </tr>
            </table>
            <p style="font-size:14px; line-height:1.6;"> Mohon agar Anda <strong>segera melakukan konfirmasi</strong>
                atas jadwal tersebut. Jika ada pertanyaan, silakan menghubungi tim sales kami untuk informasi
                lebih lanjut. </p>
            <table align="center" cellpadding="0" cellspacing="0" style="margin:30px auto;">
                <tr>
                    <td bgcolor="#5623d8" style="border-radius:6px;"> <a href="https://wa.me/{{ $sales_phone }}"
                            target="_blank"
                            style="display:inline-block; padding:12px 25px; color:#ffffff; text-decoration:none; font-weight:bold;">
                            Hubungi Sales </a> </td>
                </tr>
            </table>
            <p style="font-size:14px; margin-bottom:0;"> Terima kasih atas perhatian dan kerja samanya. </p>
            <p style="margin-top:25px; font-size:14px;"> Hormat kami,<br> <strong>VSATLink Center</strong> </p>
        </td>
    </tr> <!-- Footer -->
    <tr>
        <td style="background-color:#f0f0f0; padding:15px; text-align:center; font-size:12px; color:#777777;"> Email ini
            dikirim secara otomatis oleh sistem VSATLink.<br> Mohon tidak membalas email ini. </td>
    </tr>
</table>
