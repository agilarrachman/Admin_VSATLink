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
                            <img class="product_image" src="/storage/products/aurora.png" alt="Nama Produk" />
                            <div class="info w-full">
                                <span class="badge me-1 mb-1 bg-label-warning">Sudah Dijadwalkan</span>
                                <p class="mb-0 fs-6">Kode Pesanan: VSL-30303030-0001</p>
                                <h4 class="mb-0 fw-bold fs-6">VSATLink Aurora</h4>
                                <p class="mb-0 fs-6">Pesanan dibuat pada tanggal 11 November 2003</p>
                            </div>
                        </div>

                        <p class="fw-bold text-primary mb-0">Data Perangkat</p>
                        <div class="row">
                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Modem Serial Number</label>
                                <input type="text" class="form-control" name="modem_sn" id="modem_sn"
                                    value="MDM66388383" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Adaptor Serial Number</label>
                                <input type="text" class="form-control" name="adaptor_sn" id="adaptor_sn"
                                    value="MDM66388383" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">BUC Serial Number</label>
                                <input type="text" class="form-control" name="buc_sn" id="buc_sn" value="MDM66388383"
                                    readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">LNB Serial Number</label>
                                <input type="text" class="form-control" name="lnb_sn" id="lnb_sn"
                                    value="MDM66388383" />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Router Serial Number</label>
                                <input type="text" class="form-control" name="router_sn" id="router_sn"
                                    value="MDM66388383" readonly />
                            </div>

                            <div class="input-form mb-3 col-md-6">
                                <label class="form-label">Antena Serial Number</label>
                                <input type="text" class="form-control" name="antena_sn" id="antena_sn"
                                    value="MDM66388383" readonly />
                            </div>
                        </div>

                        <hr class="pb-3">

                        <form action="/" method="POST">
                            @csrf
                            
                            <p class="fw-bold text-primary mb-0">Data Resource & Infrastruktur</p>
                            <p class="mb-3">
                                Data berikut digunakan untuk proses provisioning dan konfigurasi layanan di sistem jaringan
                                pusat.
                            </p>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">AO (Access Order)</label>
                                    <input type="text" name="ao"
                                        class="form-control @error('ao') is-invalid @enderror" value="{{ old('ao') }}"
                                        placeholder="Contoh: AO-2025-00123" required>
                                    @error('ao')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">SID (Service ID)</label>
                                    <input type="text" name="sid"
                                        class="form-control @error('sid') is-invalid @enderror" value="{{ old('sid') }}"
                                        placeholder="Contoh: SID-88921" required>
                                    @error('sid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">PE / Metro</label>
                                    <select name="pe" class="form-select" required>
                                        <option value="">Pilih PE / Metro</option>
                                        <option value="PE-JKT-01" @selected(old('pe') === 'PE-JKT-01')>PE-JKT-01</option>
                                        <option value="PE-SBY-01" @selected(old('pe') === 'PE-SBY-01')>PE-SBY-01</option>
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
                                    <label class="form-label">IP WAN</label>
                                    <input type="text" name="ip_wan"
                                        class="form-control @error('ip_wan') is-invalid @enderror"
                                        value="{{ old('ip_wan') }}" placeholder="Contoh: 10.10.20.2" required>
                                    @error('ip_wan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">IP Backhaul</label>
                                    <input type="text" name="ip_backhaul"
                                        class="form-control @error('ip_backhaul') is-invalid @enderror"
                                        value="{{ old('ip_backhaul') }}" placeholder="Contoh: 172.16.1.2" required>
                                    @error('ip_backhaul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                        <option value="Mangoesky" @selected(old('hub_type') === 'Mangoesky')>Mangoesky</option>
                                        <option value="iDirect" @selected(old('hub_type') === 'iDirect')>iDirect</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">NMS ID</label>
                                    <input type="text" name="nms_id"
                                        class="form-control @error('nms_id') is-invalid @enderror"
                                        value="{{ old('nms_id') }}" placeholder="Contoh: NMS-88921" required>
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
