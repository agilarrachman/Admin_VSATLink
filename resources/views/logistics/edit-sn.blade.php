@extends('layouts.app')

@section('title', 'Admin VSATLink | Logistic Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Serial Number</h5>
                    <div class="card-body">
                        <p class="fw-bold text-primary">Rincian Pesanan</p>
                        <div class="d-flex items-start gap-4 mb-3">
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
                        <form action="/logistics/update-sn/{{ $order->unique_order }}" method="POST">
                            @method('PUT')
                            @csrf
                            <p class="mb-3">
                                Silakan masukkan seluruh serial number perangkat pada form di bawah ini untuk
                                melanjutkan proses
                                logistik.
                            </p>

                            <div class="row">
                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">Modem Serial Number</label>
                                    <input type="text" class="form-control @error('modem_sn') is-invalid @enderror"
                                        name="modem_sn" id="modem_sn" value="{{ old('modem_sn', $order->modem_sn) }}"
                                        placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                    @error('modem_sn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">Adaptor Serial Number</label>
                                    <input type="text" class="form-control @error('adaptor_sn') is-invalid @enderror"
                                        name="adaptor_sn" id="adaptor_sn" value="{{ old('adaptor_sn', $order->adaptor_sn) }}"
                                        placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                    @error('adaptor_sn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">BUC Serial Number</label>
                                    <input type="text" class="form-control @error('buc_sn') is-invalid @enderror"
                                        name="buc_sn" id="buc_sn" value="{{ old('buc_sn', $order->buc_sn) }}"
                                        placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                    @error('buc_sn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">LNB Serial Number</label>
                                    <input type="text" class="form-control @error('lnb_sn') is-invalid @enderror"
                                        name="lnb_sn" id="lnb_sn" value="{{ old('lnb_sn', $order->lnb_sn) }}"
                                        placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                    @error('lnb_sn')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                @if ($order->product->access_point != null)
                                    <div class="input-form mb-3 col-md-6">
                                        <label class="form-label">Router Serial Number</label>
                                        <input type="text" class="form-control @error('router_sn') is-invalid @enderror"
                                            name="router_sn" id="router_sn"
                                            value="{{ old('router_sn', $order->router_sn) }}"
                                            placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                        @error('router_sn')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                @endif

                                <div class="input-form mb-3 col-md-6">
                                    <label class="form-label">Antena Serial Number</label>
                                    <input type="text" class="form-control @error('antena_sn') is-invalid @enderror"
                                        name="antena_sn" id="antena_sn" value="{{ old('antena_sn', $order->antena_sn) }}"
                                        placeholder="Masukkan serial number (6-20 karakter)" data-required />
                                    @error('antena_sn')
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
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
