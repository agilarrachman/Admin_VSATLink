@extends('layouts.app')

@section('title', 'Admin VSATLink | Service Activation Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Input Data Provisioning</h5>
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
                                    <i class="bx bx-calendar me-1"></i>
                                    <p class="mb-0" style="font-size: 14px">
                                        @if ($nota->installation_date)
                                            Jadwal Instalasi pada tanggal
                                            {{ $nota->installation_date->translatedFormat('d F Y') }}
                                        @else
                                            Belum dijadwalkan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <p class="fw-bold text-primary mb-0">Data Perangkat</p>
                        <div class="row">
                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Modem Serial Number</label>
                                <input type="text" class="form-control" name="modem_sn" id="modem_sn"
                                    value="{{ $nota->order->modem_sn ?? '-' }}" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Adaptor Serial Number</label>
                                <input type="text" class="form-control" name="adaptor_sn" id="adaptor_sn"
                                    value="{{ $nota->order->adaptor_sn ?? '-' }}" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">BUC Serial Number</label>
                                <input type="text" class="form-control" name="buc_sn" id="buc_sn"
                                    value="{{ $nota->order->buc_sn ?? '-' }}" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">LNB Serial Number</label>
                                <input type="text" class="form-control" name="lnb_sn" id="lnb_sn"
                                    value="{{ $nota->order->lnb_sn ?? '-' }}" />
                            </div>

                            @if ($nota->order->product->access_point != null)
                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">Router Serial Number</label>
                                    <input type="text" class="form-control" name="router_sn" id="router_sn"
                                        value="{{ $nota->order->router_sn ?? '-' }}" readonly />
                                </div>
                            @endif

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Antena Serial Number</label>
                                <input type="text" class="form-control" name="antena_sn" id="antena_sn"
                                    value="{{ $nota->order->antena_sn ?? '-' }}" readonly />
                            </div>
                        </div>

                        <hr class="pb-3">

                        <form action="/service-activations/provisioning/{{ $nota->id }}" method="POST">
                            @csrf

                            <p class="fw-bold text-primary mb-0">Data Resource & Infrastruktur</p>
                            <p class="mb-3">
                                Data berikut digunakan untuk proses provisioning dan konfigurasi layanan di sistem jaringan
                                pusat.
                            </p>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">PE / Metro</label>
                                    <select name="pe" class="form-select" required>
                                        <option value="">Pilih PE / Metro</option>
                                        <option value="RTR-CONSUMER-7206-E1-B-BGR" @selected(old('pe') === 'RTR-CONSUMER-7206-E1-B-BGR')>
                                            RTR-CONSUMER-7206-E1-B-BGR </option>
                                        <option value="RTR-ENTERPRISE-ASR1001-XE1-A-JKT" @selected(old('pe') === 'RTR-ENTERPRISE-ASR1001-XE1-A-JKT')>
                                            RTR-ENTERPRISE-ASR1001-XE1-A-JKT</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Interface</label>
                                    <input type="text" name="interface"
                                        class="form-control @error('interface') is-invalid @enderror"
                                        value="{{ old('interface') }}" placeholder="Contoh: Gi0/1" required>
                                    @error('interface')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IP Interface</label>
                                    <input type="text" name="ip_interface"
                                        class="form-control @error('ip_interface') is-invalid @enderror"
                                        value="{{ old('ip_interface') }}" placeholder="Contoh: 10.10.20.2" required>
                                    @error('ip_interface')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IP DNS/Aplikasi</label>
                                    <input type="text" name="ip_dns"
                                        class="form-control @error('ip_dns') is-invalid @enderror"
                                        value="{{ old('ip_dns') }}" placeholder="Contoh: 172.16.1.2" required>
                                    @error('ip_dns')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IP Backhaul</label>
                                    <select name="ip_backhaul" class="form-select" required>
                                        <option value="">Pilih Jenis IP Backhaul</option>
                                        <option value="IP Public" @selected(old('ip_backhaul') === 'IP Public')>IP Public</option>
                                        <option value="IP Private" @selected(old('ip_backhaul') === 'IP Private')>IP Private</option>
                                    </select>
                                </div>
                            </div>

                            <p class="fw-bold text-primary mb-0">Data Node / Link</p>
                            <p class="mb-3">
                                Digunakan untuk konfigurasi node layanan dan integrasi ke sistem monitoring.
                            </p>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Jenis Hub</label>
                                    <select name="hub_type" class="form-select" required>
                                        <option value="">Pilih Jenis Hub</option>
                                        <option value="iDirect" @selected(old('hub_type') === 'iDirect')>iDirect</option>
                                        <option value="Newtec" @selected(old('hub_type') === 'Newtec')>Newtec</option>
                                        <option value="Hughes HX50" @selected(old('hub_type') === 'Hughes HX50')>Hughes HX50</option>
                                        <option value="Hughes HX90" @selected(old('hub_type') === 'Hughes HX90')>Hughes HX90</option>
                                        <option value="Hughes HX200" @selected(old('hub_type') === 'Hughes HX200')>Hughes HX200</option>
                                        <option value="HTS MP2" @selected(old('hub_type') === 'HTS MP2')>HTS MP2</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">NMS ID</label>
                                    <input type="text" name="nms_id"
                                        class="form-control @error('nms_id') is-invalid @enderror"
                                        value="{{ old('nms_id') }}" placeholder="Contoh: JVM88921" required>
                                    @error('nms_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Tanggal Pembuatan NMS</label>
                                    <input type="date" name="create_nms_date"
                                        class="form-control @error('create_nms_date') is-invalid @enderror"
                                        value="{{ old('create_nms_date') }}" required>
                                    @error('create_nms_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IP LAN</label>
                                    <input type="text" name="ip_lan"
                                        class="form-control @error('ip_lan') is-invalid @enderror"
                                        value="{{ old('ip_lan') }}" placeholder="Contoh: 192.168.1.1" required>
                                    @error('ip_lan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Subnet Mask LAN</label>
                                    <input type="text" name="subnet_mask_lan"
                                        class="form-control @error('subnet_mask_lan') is-invalid @enderror"
                                        value="{{ old('subnet_mask_lan') }}" placeholder="Contoh: 255.255.255.0"
                                        required>
                                    @error('subnet_mask_lan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" onclick="history.back()">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
