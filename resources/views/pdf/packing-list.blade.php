<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>PACKING LIST {{ $order->packing_list_id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 10pt;
            color: #333;
        }

        @page {
            size: A4;
            margin: 15mm;
        }

        .page {
            padding: 15mm;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #5A38DF;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .logo {
            width: 160px;
            margin-bottom: 10px;
        }

        h2 {
            color: #5A38DF;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: top;
        }

        th {
            background-color: #5A38DF;
            color: white;
        }

        .section {
            background-color: #e8f1ff;
            font-weight: bold;
            color: #5A38DF;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 90px;
            color: rgba(90, 56, 223, 0.08);
            font-weight: bold;
            text-align: center;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .line {
            border-top: 1px solid #333;
            width: 260px;
            margin-left: auto;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="watermark">PACKING LIST</div>

    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <img src="{{ public_path('/assets/img/Logo VSATLink.png') }}" class="logo">
            <h2>PACKING LIST</h2>
        </div>

        <!-- INFORMASI UMUM -->
        <table>
            <tr>
                <td width="25%"><strong>ID Packing List</strong></td>
                <td width="25%">{{ $order->packing_list_id }}</td>
                <td width="25%"><strong>Tanggal</strong></td>
                <td width="25%">{{ now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td><strong>Order ID</strong></td>
                <td>{{ $order->unique_order }}</td>
                <td><strong>Metode Pengiriman</strong></td>
                <td>{{ $order->shipping }}</td>
            </tr>
            <tr>
                <td><strong>No Resi JNE</strong></td>
                <td colspan="3">
                    {{ $order->shipping === 'JNE' ? $order->jne_tracking_number ?? '-' : '-' }}
                </td>
            </tr>
            <tr>
                <td><strong>PIC</strong></td>
                <td>Tim Logistik Bogor</td>
                <td><strong>Keperluan</strong></td>
                <td>Instalasi Pelanggan</td>
            </tr>
        </table>

        <!-- Kontak -->
        <table>
            <tr class="section">
                <td colspan="4">Kontak</td>
            </tr>
            <tr>
                <td width="25%"><strong>Nama</strong></td>
                <td colspan="3">{{ $order->order_contact?->name }}</td>
            </tr>
            <tr>
                <td width="25%"><strong>Email</strong></td>
                <td colspan="3">{{ $order->order_contact?->email }}</td>
            </tr>
            <tr>
                <td width="25%"><strong>Nomor Telepon</strong></td>
                <td colspan="3">{{ $order->order_contact?->phone }}</td>
            </tr>
        </table>

        <!-- LOKASI -->
        <table>
            <tr class="section">
                <td colspan="4">Lokasi</td>
            </tr>
            <tr>
                <td width="25%"><strong>Lokasi Awal</strong></td>
                <td colspan="3">
                    Warehouse VSATLink<br>
                    Jl. Sholeh Iskandar No. KM 6, RT.04/RW.01,<br>
                    Cibadak, Kec. Tanah Sereal, Kota Bogor, Jawa Barat 16166
                </td>
            </tr>

            @if ($order->shipping === 'JNE')
                <tr>
                    <td><strong>Lokasi Tujuan</strong></td>
                    <td colspan="3">
                        {{ $order->customer->full_address }}<br>
                        {{ $order->order_address?->village()->name }},
                        {{ $order->order_address?->district()->name }}<br>
                        {{ $order->order_address?->city()->name }},
                        {{ $order->order_address?->province()->name }}
                    </td>
                </tr>
            @else
                <tr>
                    <td><strong>Pengambilan</strong></td>
                    <td colspan="3">Ambil di Tempat (Warehouse VSATLink)</td>
                </tr>
            @endif
        </table>

        <!-- DAFTAR PERANGKAT -->
        <table>
            <tr class="section">
                <td colspan="4">Daftar Perangkat</td>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Perangkat</th>
                <th>Serial Number</th>
                <th>Qty</th>
            </tr>
            <tr>
                <td>1</td>
                <td>{{ $order->product->modem ?? '-' }}</td>
                <td>{{ $order->modem_sn ?? '-' }}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>2</td>
                <td>{{ $order->product->adaptor ?? '-' }}</td>
                <td>{{ $order->adaptor_sn ?? '-' }}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>3</td>
                <td>{{ $order->product->buc ?? '-' }}</td>
                <td>{{ $order->buc_sn ?? '-' }}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>4</td>
                <td>{{ $order->product->lnb ?? '-' }}</td>
                <td>{{ $order->lnb_sn ?? '-' }}</td>
                <td>1</td>
            </tr>
            <tr>
                <td>5</td>
                <td>{{ $order->product->antena ?? '-' }}</td>
                <td>{{ $order->antena_sn ?? '-' }}</td>
                <td>1</td>
            </tr>
            @if ($order->router_sn)
                <tr>
                    <td>6</td>
                    <td>{{ $order->product->access_point ?? '-' }}</td>
                    <td>{{ $order->router_sn }}</td>
                    <td>1</td>
                </tr>
            @endif
        </table>

        <!-- MATERIAL -->
        <table>
            <tr class="section">
                <td colspan="4">Material yang Digunakan</td>
            </tr>
            <tr>
                <th>No</th>
                <th>Material</th>
                <th>Spesifikasi</th>
                <th>Qty</th>
            </tr>
            <tr>
                <td>1</td>
                <td>IFL Cable RG6</td>
                <td>Outdoor</td>
                <td>2 × 20 Meter</td>
            </tr>
            <tr>
                <td>2</td>
                <td>F-type Connector</td>
                <td>-</td>
                <td>4 Pcs</td>
            </tr>
            <tr>
                <td>3</td>
                <td>UTP Cable CAT5</td>
                <td>-</td>
                <td>1 Meter</td>
            </tr>
            <tr>
                <td>4</td>
                <td>RJ45 Connector</td>
                <td>-</td>
                <td>2 Pcs</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Grounding Cable</td>
                <td>2,5 mm</td>
                <td>5 Meter</td>
            </tr>
            <tr>
                <td>6</td>
                <td>Skun</td>
                <td>2,5 mm</td>
                <td>2 Pcs</td>
            </tr>
            <tr>
                <td>7</td>
                <td>Sealant 3M</td>
                <td>-</td>
                <td>2 Meter</td>
            </tr>
            <tr>
                <td>8</td>
                <td>Ties Cable</td>
                <td>-</td>
                <td>30 Pcs</td>
            </tr>
        </table>

        <!-- SIGNATURE -->
        <div class="signature">
            <div class="line">
                Bogor, {{ now()->format('d-m-Y') }}<br>
                <strong>Warehouse VSATLink</strong>
            </div>
        </div>

    </div>
</body>

</html>
