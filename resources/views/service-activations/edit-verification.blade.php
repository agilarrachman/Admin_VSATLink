@extends('layouts.app')

@section('title', 'Admin VSATLink | Service Activation Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Verifikasi Aktivasi Layanan</h5>

                    <div class="card-body">
                        {{-- Rincian Pesanan --}}
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
                                            {{ $nota->installation_date->translatedFormat('d F Y') }} |
                                            {{ $nota->installation_session === 'Pagi' ? 'Pagi (08.00-11.00)' : 'Siang (13.00-17.00)' }}
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

                        <hr class="my-4">

                        {{-- Form Verifikasi --}}
                        <form action="/service-activations/verification/{{ $nota->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

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
                                        value="{{ old('cacti_url', $nota->cacti_url) }}"
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
                                        <option value="Online" @selected(old('sensor_status', $nota->sensor_status) === 'Online')>Online</option>
                                        <option value="Tidak Stabil" @selected(old('sensor_status', $nota->sensor_status) === 'Tidak Stabil')>Tidak Stabil</option>
                                        <option value="Offline" @selected(old('sensor_status', $nota->sensor_status) === 'Offline')>Offline</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal & Waktu Online</label>
                                    <input type="datetime-local"
                                        class="form-control @error('online_date') is-invalid @enderror"
                                        value="{{ old('online_date', $nota->online_date) }}" name="online_date">
                                    @error('online_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3 d-flex flex-column">
                                    <label class="form-label">Bukti Monitoring (Screenshot)</label>

                                    @if ($nota->monitoring_capture_url)
                                        <div id="monitoring-view" class="d-flex align-items-center gap-2 mb-2">
                                            <a href="{{ asset('storage/' . $nota->monitoring_capture_url) }}"
                                                target="_blank" class="btn btn-primary" title="Lihat bukti monitoring">
                                                <i class="bx bx-show me-1"></i> Lihat
                                            </a>

                                            <button type="button" class="btn btn-outline-primary px-2"
                                                title="Ganti bukti monitoring" onclick="enableMonitoringEdit()">
                                                <i class="bx bx-pencil"></i>
                                            </button>
                                        </div>

                                        <small id="monitoring-info" class="text-muted mb-2">
                                            Bukti monitoring yang telah diunggah sebelumnya.
                                        </small>
                                    @endif

                                    <div id="monitoring-edit"
                                        class="{{ $nota->monitoring_capture_url ? 'd-none' : '' }}">
                                        <input type="file"
                                            class="form-control @error('monitoring_capture') is-invalid @enderror"
                                            name="monitoring_capture" accept="image/*"
                                            {{ $nota->monitoring_capture_url ? '' : 'required' }}>

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
                            </div>

                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" onclick="history.back()">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function enableMonitoringEdit() {
            document.getElementById('monitoring-view')?.classList.add('d-none');
            document.getElementById('monitoring-info')?.classList.add('d-none');
            document.getElementById('monitoring-edit')?.classList.remove('d-none');
        }
    </script>
@endpush
