@extends('layouts.app')

@section('title', 'Admin VSATLink | Service Activation Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Verifikasi Aktivasi Layanan</h5>

                    <div class="card-body">
                        {{-- Rincian Pesanan --}}
                        <p class="fw-bold text-primary">Rincian Pesanan</p>
                        <div class="d-flex items-start gap-4 mb-3">
                            <img class="product_image" src="/storage/products/aurora.png" alt="Nama Produk" />
                            <div class="info w-full">
                                <span class="badge me-1 mb-1 bg-label-warning">Request Aktivasi</span>
                                <p class="mb-0" style="font-size:14px">Kode Pesanan: VSL-30303030-0001</p>
                                <h4 class="mb-0 fw-bold" style="font-size:16px">VSATLink Aurora</h4>
                                <p class="mb-0" style="font-size:14px">
                                    Pesanan dibuat pada 11 November 2003
                                </p>
                            </div>
                        </div>

                        {{-- Data Perangkat --}}
                        <p class="fw-bold text-primary mb-2">Data Perangkat</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Modem SN</label>
                                <input type="text" class="form-control" value="CF0015266359AV" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adaptor SN</label>
                                <input type="text" class="form-control" value="ADP-8827362" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">BUC SN</label>
                                <input type="text" class="form-control" value="C240708741" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">LNB SN</label>
                                <input type="text" class="form-control" value="C240305544" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Router SN</label>
                                <input type="text" class="form-control" value="5581040DE4E3" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Antena SN</label>
                                <input type="text" class="form-control" value="92640104-DT-240" readonly>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Form Verifikasi --}}
                        <form action="/" method="POST" enctype="multipart/form-data">
                            @csrf

                            <p class="fw-bold text-primary mb-0">Data Verifikasi Aktivasi</p>
                            <p class="mb-3">
                                Lengkapi data berikut untuk memastikan layanan telah aktif dan terpantau
                                dengan baik pada sistem monitoring.
                            </p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">URL Cacti Monitoring</label>
                                    <input type="url" name="cacti_url"
                                        class="form-control @error('cacti_url') is-invalid @enderror"
                                        value="{{ old('cacti_url') }}"
                                        placeholder="Contoh: http://cacti.vsatlink.co.id/graph.php?id=123" required>
                                    @error('cacti_url')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Sensor</label>
                                    <select name="sensor_status" class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="online" @selected(old('sensor_status') === 'online')>Online</option>
                                        <option value="unstable" @selected(old('sensor_status') === 'unstable')>Unstable</option>
                                        <option value="offline" @selected(old('sensor_status') === 'offline')>Offline</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal & Waktu Online</label>
                                    <input type="datetime-local"
                                        class="form-control @error('online_date') is-invalid @enderror"
                                        value="{{ old('online_date') }}" name="online_date" required>
                                    @error('online_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Bukti Monitoring (Screenshot)</label>
                                    <input type="file"
                                        class="form-control @error('monitoring_capture') is-invalid @enderror"
                                        name="monitoring_capture" accept="image/*" required>
                                    <small class="text-muted">
                                        Upload bukti sensor online dari Cacti / NMS
                                    </small>
                                    @error('monitoring_capture')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" onclick="history.back()">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Verifikasi Layanan Teraktivasi
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
