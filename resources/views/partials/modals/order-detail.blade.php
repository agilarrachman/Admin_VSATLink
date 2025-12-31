<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="orderModalLabel">Detail Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fw-bold text-primary">Rincian Pesanan</p>
                <div class="d-flex items-start gap-4">
                    <img class="product-image" src="/storage/{{ $order->product->image_url }}"
                        alt="{{ $order->product->name }}" />
                    <div class="info w-full mb-3 mb-md-0">
                        @php($badge = $order->statusBadge())
                        <td><span class="badge me-1 mb-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                        <p class="mb-0" style="font-size: 14px">
                            Kode Pesanan: {{ $order->unique_order }}
                        </p>
                        <h4 class="mb-0 fw-bold" style="font-size: 16px">{{ $order->product->name }}</h4>
                        <p class="mb-0" style="font-size: 14px">Pesanan dibuat pada tanggal
                            {{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="summary my-3">
                    <div class="d-flex justify-content-between">
                        <h4>Jenis Pengiriman</h4>
                        <p class="summary text-right">JNE</p>
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
                        <h4>Biaya Instalasi</h4>
                        <p class="summary text-right">
                            {{ $order->installation_service_cost == 0 && $order->installation_transport_cost == 0
                                ? '-'
                                : 'Rp ' . number_format($order->installation_service_cost + $order->installation_transport_cost, 0, ',', '.') }}
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

                <p class="fw-bold text-primary">Lokasi Instalasi dan Aktivasi</p>
                <div class="mb-3">
                    <label for="full_address" class="form-label">Link Google Maps</label>
                    <a href="{{ $order->activation_address?->google_maps_url ?? '-' }}" class="form-control px-3 py-2">
                        {{ $order->activation_address?->google_maps_url ?? '-' }}
                    </a>
                </div>
                <div id="map" class="w-full rounded-lg mb-3" style="height: 250px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
