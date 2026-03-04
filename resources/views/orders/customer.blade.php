@extends('layouts.app')

@section('title', 'Admin VSATLink | Order Management')

@section('content')
    <div class="container-xxl grow container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Informasi Customer</h5>
                    <div class="card-body">
                        <p class="fw-bold text-primary">Informasi
                            {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : 'Saya' }}</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="customer_type" class="form-label">Jenis Customer</label>
                                <input class="form-control" type="text" name="customer_type" id="customer_type"
                                    value="{{ $order->customer->customer_type }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input class="form-control" type="text" name="username" id="username"
                                    value="{{ $order->customer->username }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama
                                    {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : 'Lengkap' }}</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $order->customer->name }}" readonly />
                            </div>
                            @if ($order->customer->customer_type != 'Perorangan')
                                <div class="mb-3 col-md-6">
                                    <label for="company_representative_name" class="form-label">Nama Pejabat yang
                                        Berwenang</label>
                                    <input class="form-control" type="text" id="company_representative_name"
                                        name="company_representative_name"
                                        value="{{ $order->customer->company_representative_name }}" readonly />
                                </div>
                            @endif
                            <div class="mb-3 col-md-6">
                                <label for="npwp" class="form-label">Nomor NPWP
                                    {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : '' }}</label>
                                <input class="form-control" type="text" id="npwp" name="npwp"
                                    value="{{ $order->customer->npwp }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">Email
                                    {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : '' }}</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    value="{{ $order->customer->email }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon
                                    {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : '' }}</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    value="{{ $order->customer->phone }}" readonly />
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Informasi Akun</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="sales_name" class="form-label">Nama Sales Pendamping</label>
                                <input class="form-control" type="text" id="sales_name" name="sales_name"
                                    value="{{ $order->customer->sales->name }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sales_phone" class="form-label">Nomor Telepon Sales Pendamping</label>
                                <input class="form-control" type="text" id="sales_phone" name="sales_phone"
                                    value="{{ $order->customer->sales->phone }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sales_email" class="form-label">Email Sales Pendamping</label>
                                <input class="form-control" type="text" id="sales_email" name="sales_email"
                                    value="{{ $order->customer->sales->email }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="source_information" class="form-label">Sumber Informasi</label>
                                <input class="form-control" type="text" id="source_information" name="source_information"
                                    value="{{ $order->customer->source_information }}" readonly />
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Alamat
                            {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : 'Saya' }}</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input class="form-control" type="text" id="province" name="province"
                                    value="{{ $order->customer->province()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">Kabupaten</label>
                                <input class="form-control" type="text" id="city" name="city"
                                    value="{{ $order->customer->city()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="district" class="form-label">Kecamatan</label>
                                <input class="form-control" type="text" id="district" name="district"
                                    value="{{ $order->customer->district()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="village" class="form-label">Kelurahan</label>
                                <input class="form-control" type="text" id="village" name="village"
                                    value="{{ $order->customer->village()->name ?? '-' }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rt" class="form-label">RT</label>
                                <input class="form-control" type="text" id="rt" name="rt"
                                    value="{{ $order->customer->rt }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rw" class="form-label">RW</label>
                                <input class="form-control" type="text" id="rw" name="rw"
                                    value="{{ $order->customer->rw }}" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input class="form-control" type="text" id="postal_code" name="postal_code"
                                    value="{{ $order->customer->postal_code }}" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="full_address" class="form-label">Alamat Lengkap</label>
                                <textarea name="full_address" id="full_address" class="form-control" style="min-height: 160px;">{{ $order->customer->full_address }}</textarea>
                            </div>
                        </div>

                        @if ($order->customer->customer_type != 'Perorangan')
                            <p class="fw-bold text-primary">Narahubung Perusahaan</p>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="contact_name" class="form-label">Nama Narahubung</label>
                                    <input class="form-control" type="text" id="contact_name" name="contact_name"
                                        value="{{ $order->customer->contact_name }}" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="contact_email" class="form-label">Email Narahubung</label>
                                    <input class="form-control" type="text" id="contact_email" name="contact_email"
                                        value="{{ $order->customer->contact_email }}" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="contact_phone" class="form-label">Nomor Telepon Narahubung</label>
                                    <input type="number" class="form-control" id="contact_phone" name="contact_phone"
                                        value="{{ $order->customer->contact_phone }}" readonly />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="contact_position" class="form-label">Jabatan Narahubung</label>
                                    <input class="form-control" type="text" id="contact_position"
                                        name="contact_position" value="{{ $order->customer->contact_position }}"
                                        readonly />
                                </div>
                            </div>
                        @endif

                        <p class="fw-bold text-primary">Dokumen Legalitas
                            {{ $order->customer->customer_type != 'Perorangan' ? 'Perusahaan' : 'Saya' }}</p>
                        <div class="row">
                            <div class="mb-3 col-md-4 d-flex flex-column">
                                <label class="mb-2 font-medium">NPWP</label>
                                <a href="/download/npwp/{{ $order->unique_order }}" target="_blank"
                                    class="btn btn-primary" style="width: fit-content">
                                    Unduh PDF
                                </a>
                            </div>
                            <div class="mb-3 col-md-4 d-flex flex-column">
                                <label class="mb-2 font-medium">NIB</label>
                                <a href="/download/nib/{{ $order->unique_order }}" target="_blank"
                                    class="btn btn-primary" style="width: fit-content">
                                    Unduh PDF
                                </a>
                            </div>

                            <div class="mb-3 col-md-4 d-flex flex-column">
                                <label class="mb-2 font-medium">SK Kemenkumham Akta Pendirian</label>
                                <a href="/download/sk/{{ $order->unique_order }}" target="_blank"
                                    class="btn btn-primary" style="width: fit-content">
                                    Unduh PDF
                                </a>
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
@endsection
