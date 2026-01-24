@extends('layouts.app')

@section('title', 'Admin VSATLink | Service Activation Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Data Teknis</h5>
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

                        <hr class="w-full border-t border-white/40 pb-3">

                        <form action="/service-activations/technical-data/{{ $nota->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <p class="fw-bold text-primary mb-0">Data Teknis dan Crosspole</p>
                            <p class="mb-3">
                                Silakan lengkapi data teknis dan hasil pengukuran crosspole sesuai kondisi aktual di
                                lapangan setelah instalasi antena selesai dilakukan.
                            </p>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">SQF</label>
                                    <input type="number" step="0.01" name="sqf"
                                        class="form-control @error('sqf') is-invalid @enderror" value="{{ old('sqf', $nota->sqf) }}"
                                        placeholder="Contoh: 78" required>
                                    @error('sqf')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ESNO (dB)</label>
                                    <input type="number" step="0.01" name="esno"
                                        class="form-control @error('esno') is-invalid @enderror"
                                        value="{{ old('esno', $nota->esno) }}" placeholder="12.5" required>
                                    @error('esno')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Line of Sight</label>
                                    <select name="los" class="form-select" required>
                                        <option value="">Pilih Line of Sight</option>
                                        <option value="Bersih" @selected(old('los', $nota->los) === 'Bersih')>Bersih</option>
                                        <option value="Terhalang" @selected(old('los', $nota->los) === 'Terhalang')>Terhalang</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Diameter Antena</label>
                                    <select name="antena_diameter" class="form-select" required>
                                        <option value="">Pilih Diameter Antena</option>
                                        <option value="1.2" @selected(old('antena_diameter', $nota->antena_diameter) === '1.2')>1.2 m</option>
                                        <option value="1.8" @selected(old('antena_diameter', $nota->antena_diameter) === '1.8')>1.8 m</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ID LFT (Crosspole)</label>
                                    <input type="text" name="lft_id"
                                        class="form-control @error('lft_id') is-invalid @enderror"
                                        value="{{ old('lft_id', $nota->lft_id) }}" placeholder="LFT-90231">
                                    @error('lft_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">C/N (dB)</label>
                                    <input type="number" step="0.01" name="cn"
                                        class="form-control @error('cn') is-invalid @enderror"
                                        value="{{ old('cn', $nota->cn) }}" placeholder="Contoh: 14.5 (dB)">
                                    @error('cn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">ESN Modem</label>
                                    <input type="text" name="esn_modem"
                                        class="form-control @error('esn_modem') is-invalid @enderror"
                                        value="{{ old('esn_modem', $nota->esn_modem) }}" placeholder="Contoh: 15266359AV" required>
                                    @error('esn_modem')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Antena</label>
                                    <select name="antena_type" class="form-select" required>
                                        <option value="">Pilih Jenis Antena</option>
                                        <option value="KU-BAND V61" @selected(old('antena_type', $nota->antena_type) === 'KU-BAND V61')>KU-BAND V61</option>
                                        <option value="KU-BAND V80" @selected(old('antena_type', $nota->antena_type) === 'KU-BAND V80')>KU-BAND V80</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Catatan Teknisi (Opsional)</label>
                                    <textarea name="technician_note" class="form-control @error('technician_note') is-invalid @enderror" rows="3"
                                        placeholder="Masukkan catatan jika ada">{{ old('technician_note', $nota->technician_note) }}</textarea>
                                    @error('technician_note')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" onclick="history.back()">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
