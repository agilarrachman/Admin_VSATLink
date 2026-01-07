@extends('layouts.app')

@section('title', 'Admin VSATLink | Order Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Pesanan</h5>
                    <div class="card-body">
                        <p class="fw-bold text-primary">Rincian Pesanan</p>
                        <div class="d-flex items-start gap-4">
                            <img class="product_image" src="/storage/{{ $order->product->image_url }}"
                                alt="{{ $order->product->name }}" />
                            <div class="info w-full mb-3 mb-md-0">
                                @php($badge = $order->statusBadge())
                                <td><span class="badge me-1 mb-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                                <p class="mb-0" style="font-size: 14px">
                                    Kode Pesanan: {{ $order->unique_order }}
                                </p>
                                <h4 class="mb-0 fw-bold" style="font-size: 16px">{{ $order->product->name }}</h4>
                                <p class="mb-0" style="font-size: 14px">Pesanan dibuat pada tanggal
                                    {{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="summary my-3">
                            <div class="d-flex justify-content-between">
                                <h4>Jenis Pengiriman</h4>
                                <p class="summary text-right">{{ $order->shipping ? $order->shipping : '-' }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Harga</h4>
                                <p class="summary text-right">
                                    {{ $order->product_cost ? 'Rp' . number_format($order->product_cost, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Biaya Pengiriman</h4>
                                <p class="summary text-right">
                                    {{ $order->shipping_cost ? 'Rp' . number_format($order->shipping_cost, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Biaya Layanan Instalasi</h4>
                                <p class="summary text-right">
                                    {{ $order->installation_service_cost ? 'Rp' . number_format($order->installation_service_cost, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Biaya Transport Instalasi</h4>
                                <p class="summary text-right">                                    
                                    {{ $order->installation_transport_cost ? 'Rp' . number_format($order->installation_transport_cost, 0, ',', '.') : '-' }}
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>PPN (10%)</h4>
                                <p class="summary text-right">
                                    {{ $order->tax_cost ? 'Rp' . number_format($order->tax_cost, 0, ',', '.') : '-' }}</p>
                            </div>
                        </div>
                        <hr class="w-full border-t border-white/40">
                        <div class="d-flex justify-content-between mb-4">
                            <h4>Total</h4>
                            <p class="summary text-right">
                                {{ $order->total_cost ? 'Rp' . number_format($order->total_cost, 0, ',', '.') : '-' }}</p>
                        </div>

                        <p class="fw-bold text-primary">Status Pesanan</p>
                        <div class="status mb-4">
                            <div class="order-steps">
                                <div class="step {{ $order_status->order_status_id > 1 ? 'completed' : 'active' }}">
                                    <div class="circle">
                                        @if ($order_status->order_status_id > 1)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Konfirmasi</h5>
                                </div>

                                <div
                                    class="step {{ $order_status->order_status_id == 3 ? 'active' : '' }}
                                                {{ $order_status->order_status_id >= 4 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($order_status->order_status_id >= 4)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Pembayaran</h5>
                                </div>

                                <div
                                    class="step {{ $order_status->order_status_id == 5 ? 'active' : '' }}
                                                {{ $order_status->order_status_id >= 6 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($order_status->order_status_id >= 6)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Pengiriman</h5>
                                </div>

                                <div class="step {{ $order_status->order_status_id >= 7 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($order_status->order_status_id >= 7)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Selesai</h5>
                                </div>
                            </div>
                            <h4 class="mt-3 text-center">
                                {{ $order_status->note }}
                            </h4>
                        </div>

                        <p class="fw-bold text-primary">Narahubung Pesanan</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="contact_name" class="form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" id="contact_name" name="contact_name"
                                    value="{{ $order->order_contact?->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact_email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="contact_email" name="contact_email"
                                    value="{{ $order->order_contact?->email ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact_phone" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                    value="{{ $order->order_contact?->phone ?? '-' }}" readonly />
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Alamat Pengiriman</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input class="form-control" type="text" id="province" name="province"
                                    value="{{ $order->order_address?->province()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">Kabupaten</label>
                                <input class="form-control" type="text" id="city" name="city"
                                    value="{{ $order->order_address?->city()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="district" class="form-label">Kecamatan</label>
                                <input class="form-control" type="text" id="district" name="district"
                                    value="{{ $order->order_address?->district()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="village" class="form-label">Kelurahan</label>
                                <input class="form-control" type="text" id="village" name="village"
                                    value="{{ $order->order_address?->village()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rt" class="form-label">RT</label>
                                <input class="form-control" type="text" id="rt" name="rt"
                                    value="{{ $order->order_address?->rt ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rw" class="form-label">RW</label>
                                <input class="form-control" type="text" id="rw" name="rw"
                                    value="{{ $order->order_address?->rw ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input class="form-control" type="text" id="postal_code" name="postal_code"
                                    value="{{ $order->order_address?->village()->postal_code ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="full_address" class="form-label">Alamat Lengkap</label>
                                <textarea name="full_address" id="full_address" class="form-control" style="min-height: 160px;">{{ $order->order_address?->full_address ?? '-' }}</textarea>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Lokasi Instalasi dan Aktivasi</p>
                        <div id="map" class="w-full rounded-lg mb-3" style="height: 350px;"></div>
                        <div class="mb-3">
                            <label for="full_address" class="form-label">Link Google Maps</label>
                            <a href="{{ $order->activation_address?->google_maps_url ?? '-' }}"
                                class="form-control px-3 py-2">
                                {{ $order->activation_address?->google_maps_url ?? '-' }}
                            </a>
                        </div>

                        <div class="mt-2">
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="history.back()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // === Script Preview Map Start ===
        const lat = {{ $order->activation_address?->latitude ?? -6.602234321160505 }};
        const lng = {{ $order->activation_address?->longitude ?? 106.80913996183654 }};
        const map = L.map('map').setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .openPopup();
        // === Script Preview Map End ===
    </script>
@endsection
