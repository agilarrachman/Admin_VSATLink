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
                        <div class="d-flex items-start gap-4 mb-3">
                            <img class="product_image" src="/storage/{{ $nota->order->product->image_url }}"
                                alt="{{ $nota->order->product->name }}" />
                            <div class="info w-full mb-3 mb-md-0">
                                @php($badge = $nota->statusBadge())
                                <td><span class="badge me-1 mb-1 {{ $badge['class'] }}">{{ $badge['label'] }}</span></td>
                                <p class="mb-0" style="font-size: 14px">
                                    Kode Pesanan: {{ $nota->order->unique_order }}
                                </p>
                                <h4 class="mb-0 fw-bold" style="font-size: 16px">{{ $nota->order->product->name }}</h4>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-calendar-plus me-1"></i>
                                    <p class="mb-0" style="font-size: 14px">
                                        {{ $nota->installation_date ? 'Jadwal Instalasi pada tanggal ' . $nota->installation_date->translatedFormat('d F Y, H:i') : 'Belum dijadwalkan' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Status Aktivasi</p>
                        <div class="status d-flex flex-column align-items-center mb-4">
                            <div class="activation-steps w-100">
                                <div
                                    class="step {{ $activation_status->activation_status_id > 1 ? 'completed' : 'active' }}">
                                    <div class="circle">
                                        @if ($activation_status->activation_status_id > 1)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Penjadwalan</h5>
                                </div>

                                <div
                                    class="step {{ $activation_status->activation_status_id == 3 ? 'active' : '' }}
                                                {{ $activation_status->activation_status_id >= 4 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($activation_status->activation_status_id >= 4)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Perjalanan Teknisi</h5>
                                </div>

                                <div class="step {{ $activation_status->activation_status_id >= 5 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($activation_status->activation_status_id >= 5)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Proses Instalasi & Aktivasi</h5>
                                </div>

                                <div class="step {{ $activation_status->activation_status_id >= 7 ? 'completed' : '' }}">
                                    <div class="circle">
                                        @if ($activation_status->activation_status_id >= 7)
                                            <i class="bx bx-check"></i>
                                        @endif
                                    </div>
                                    <h5>Dokumen Legalitas</h5>
                                </div>
                            </div>
                            <h4 class="my-3 text-center">
                                {{ $activation_status->note }}
                            </h4>
                            {{-- @if ($nota->activation->current_status_id == 7 && !empty($nota->activation->proof_of_delivery_image_url))
                                <img src="{{ config('app.customer_url') }}/storage/{{ $nota->activation->proof_of_delivery_image_url }}"
                                    class="rounded" alt="proof_of_delivery_image">
                            @endif --}}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p class="fw-bold text-primary">Serial Number Perangkat</p>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="modem_sn" class="form-label">Modem Serial Number</label>
                                        <input class="form-control" type="text" id="modem_sn" name="modem_sn"
                                            value="{{ $nota->order->modem_sn ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="adaptor_sn" class="form-label">Adaptor Serial Number</label>
                                        <input class="form-control" type="text" id="adaptor_sn" name="adaptor_sn"
                                            value="{{ $nota->order->adaptor_sn ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="buc_sn" class="form-label">BUC Serial Number</label>
                                        <input class="form-control" type="text" id="buc_sn" name="buc_sn"
                                            value="{{ $nota->order->buc_sn ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="lnb_sn" class="form-label">LNB Serial Number</label>
                                        <input class="form-control" type="text" id="lnb_sn" name="lnb_sn"
                                            value="{{ $nota->order->lnb_sn ?? '-' }}" readonly />
                                    </div>
                                    @if ($nota->order->product->access_point != null)
                                        <div class="mb-3 col-md-6">
                                            <label for="router_sn" class="form-label">Router Serial Number</label>
                                            <input class="form-control" type="text" id="router_sn" name="router_sn"
                                                value="{{ $nota->order->router_sn ?? '-' }}" readonly />
                                        </div>
                                    @endif
                                    <div class="mb-3 col-md-6">
                                        <label for="antena_sn" class="form-label">Antena Serial Number</label>
                                        <input class="form-control" type="text" id="antena_sn" name="antena_sn"
                                            value="{{ $nota->order->antena_sn ?? '-' }}" readonly />
                                    </div>
                                </div>

                                <p class="fw-bold text-primary">Narahubung Customer</p>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="contact_name" class="form-label">Nama Lengkap</label>
                                        <input class="form-control" type="text" id="contact_name" name="contact_name"
                                            value="{{ $nota->order->customer->contact_name ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="contact_email" class="form-label">Email</label>
                                        <input class="form-control" type="text" id="contact_email"
                                            name="contact_email"
                                            value="{{ $nota->order->customer->contact_email ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="contact_phone" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="contact_phone"
                                            name="contact_phone"
                                            value="{{ $nota->order->customer->contact_phone ?? '-' }}" readonly />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="sales_name" class="form-label">Sales Pendamping</label>
                                        <input type="text" class="form-control" id="sales_name" name="sales_name"
                                            value="{{ $nota->order->customer->sales->name ?? '-' }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="fw-bold text-primary">Lokasi Instalasi dan Aktivasi</p>
                                <div id="map" class="w-full rounded-lg mb-3" style="height: 350px;"></div>
                                <div class="mb-3">
                                    <label for="full_address" class="form-label">Link Google Maps</label>
                                    <a href="{{ $nota->order->activation_address?->google_maps_url ?? '-' }}"
                                        class="form-control px-3 py-2">
                                        {{ $nota->order->activation_address?->google_maps_url ?? '-' }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Data Resource & Infrastruktur</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">AO (Access Order)</label>
                                <input type="text" name="ao" class="form-control"
                                    value="{{ $nota->ao ?? '-' }}" placeholder="Contoh: AO-2025-00123" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">SID (Service ID)</label>
                                <input type="text" name="sid" class="form-control"
                                    value="{{ $nota->sid ?? '-' }}" placeholder="Contoh: SID-88921" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">PE / Metro</label>
                                <input type="text" name="pe" class="form-control"
                                    value="{{ $nota->pe ?? '-' }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Interface</label>
                                <input type="text" name="interface" class="form-control"
                                    value="{{ $nota->interface ?? '-' }}" placeholder="Contoh: Gi0/1" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">IP WAN</label>
                                <input type="text" name="ip_wan" class="form-control"
                                    value="{{ $nota->ip_wan ?? '-' }}" placeholder="Contoh: 10.10.20.2" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">IP Backhaul</label>
                                <input type="text" name="ip_backhaul" class="form-control"
                                    value="{{ $nota->ip_backhaul ?? '-' }}" placeholder="Contoh: 172.16.1.2" readonly>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Data Node / Link</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Jenis Hub</label>
                                <input type="text" name="hub_type" class="form-control"
                                    value="{{ $nota->hub_type ?? '-' }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">NMS ID</label>
                                <input type="text" name="nms_id" class="form-control"
                                    value="{{ $nota->nms_id ?? '-' }}" placeholder="Contoh: NMS-88921" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Tanggal Pembuatan NMS</label>
                                <input type="text" name="create_nms_date" class="form-control"
                                    value="{{ $nota->create_nms_date ?? '-' }}" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">IP LAN</label>
                                <input type="text" name="ip_lan" class="form-control"
                                    value="{{ $nota->ip_lan ?? '-' }}" placeholder="Contoh: 192.168.1.1" readonly>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Subnet Mask LAN</label>
                                <input type="text" name="subnet_mask_lan" class="form-control"
                                    value="{{ $nota->subnet_mask_lan ?? '-' }}" placeholder="Contoh: 255.255.255.0"
                                    readonly>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Data Teknis dan Crosspole</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SQF</label>
                                <input type="text" name="sqf" class="form-control"
                                    value="{{ $nota->sqf ?? '-' }}" placeholder="Contoh: 78" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">ESNO (dB)</label>
                                <input type="text" step="0.1" name="esno" class="form-control"
                                    value="{{ $nota->esno ?? '-' }}" placeholder="12.5" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Line of Sight</label>
                                <input type="text" name="los" class="form-control"
                                    value="{{ $nota->los ?? '-' }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Diameter Antena</label>
                                <input type="text" name="antena_diameter" class="form-control"
                                    value="{{ $nota->antena_diameter ?? '-' }}" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID LFT (Crosspole)</label>
                                <input type="text" name="lft_id" class="form-control"
                                    value="{{ $nota->lft_id ?? '-' }}" placeholder="LFT-90231" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">C/N (dB)</label>
                                <input type="text" step="0.1" name="cn" class="form-control"
                                    value="{{ $nota->cn ?? '-' }}" placeholder="Contoh: 14.5 (dB)" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">ESN Modem</label>
                                <input type="text" name="esn_modem" class="form-control"
                                    value="{{ $nota->esn_modem ?? '-' }}" placeholder="Contoh: 15266359AV" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Antena</label>
                                <input type="text" name="antena_diameter" class="form-control"
                                    value="{{ $nota->antena_diameter ?? '-' }}" readonly>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Catatan Teknisi (Opsional)</label>
                                <textarea name="technician_note" class="form-control" rows="3" placeholder="Masukkan catatan jika ada"
                                    readonly>{{ $nota->technician_note ?? '-' }}</textarea>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Data Verifikasi Aktivasi</p>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">URL Cacti Monitoring</label>
                                <input type="text" name="cacti_url" class="form-control"
                                    value="{{ $nota->cacti_url ?? '-' }}"
                                    placeholder="Contoh: http://cacti.vsatlink.co.id/graph.php?id=123" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status Sensor</label>
                                <input type="text" name="sensor_status" class="form-control"
                                    value="{{ $nota->sensor_status ?? '-' }}" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tanggal & Waktu Online</label>
                                <input type="text" class="form-control" value="{{ $nota->online_date ?? '-' }}"
                                    name="online_date" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Bukti Monitoring (Screenshot)</label>
                                @if ($nota->monitoring_capture_image_url)
                                    <img src="{{ asset('storage/' . $nota->monitoring_capture_image_url) }}"
                                        class="rounded" alt="monitoring_capture_image" width="300">
                                @else
                                    <p class="text-muted mb-0">Screenshot bukti monitoring belum diunggah.</p>
                                @endif
                            </div>
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
        const lat = {{ $nota->order->activation_address?->latitude ?? -6.602234321160505 }};
        const lng = {{ $nota->order->activation_address?->longitude ?? 106.80913996183654 }};
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
