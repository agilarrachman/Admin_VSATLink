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
                            <img class="product-image" src="/assets/img/products/produkVSAT1.png" alt="Product Image" />
                            <div class="info w-full mb-3 mb-md-0">
                                <span class="badge bg-label-info me-1">Sedang Diproses</span>
                                <p class="mb-0" style="font-size: 14px">
                                    Kode Pesanan: VSL7393741
                                </p>
                                <h4 class="mb-0 fw-bold" style="font-size: 16px">Nama Layanan</h4>
                                <p class="mb-0" style="font-size: 14px">
                                    Pesanan dibuat pada tanggal 19 November
                                    2025
                                </p>
                            </div>
                        </div>
                        <div class="summary my-3">
                            <div class="d-flex justify-content-between">
                                <h4>Jenis Pengiriman</h4>
                                <p class="summary text-right">JNE</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Harga</h4>
                                <p class="summary text-right">Rp11.500.000</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Biaya Pengiriman</h4>
                                <p class="summary text-right">Rp11.500.000</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>Biaya Instalasi</h4>
                                <p class="summary text-right">Rp11.500.000</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4>PPN (10%)</h4>
                                <p class="summary text-right">Rp1.150.000</p>
                            </div>
                        </div>
                        <hr class="w-full border-t border-white/40">
                        <div class="d-flex justify-content-between mb-4">
                            <h4>Total</h4>
                            <p class="summary text-right">Rp50.150.000</p>
                        </div>

                        <p class="fw-bold text-primary">Status Pesanan</p>
                        <div class="status mb-4">
                            <div class="order-steps">
                                <div class="step completed">
                                    <div class="circle">
                                        <i class="bx bx-check"></i>
                                    </div>
                                    <h5>Konfirmasi</h5>
                                </div>

                                <div class="step completed">
                                    <div class="circle">
                                        <i class="bx bx-check"></i>
                                    </div>
                                    <h5>Pembayaran</h5>
                                </div>

                                <div class="step active">
                                    <div class="circle"></div>
                                    <h5>Pengiriman</h5>
                                </div>

                                <div class="step">
                                    <div class="circle"></div>
                                    <h5>Selesai</h5>
                                </div>
                            </div>
                            <h4 class="mt-3 text-center">
                                Pesanan diterima, tapi belum upload bukti pengiriman
                            </h4>
                        </div>

                        <p class="fw-bold text-primary">Narahubung Pesanan</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="contact_name" class="form-label">Nama Lengkap</label>
                                <input class="form-control" type="text" id="contact_name" name="contact_name"
                                    value="Agil Musthafa" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact_email" class="form-label">Email</label>
                                <input class="form-control" type="text" id="contact_email" name="contact_email"
                                    value="agilarrachman@example.com" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="contact_phone" class="form-label">Telepon Narahubung</label>
                                <input type="number" class="form-control" id="contact_phone" name="contact_phone"
                                    value="081332303211" readonly />
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Alamat Pengiriman</p>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="province" class="form-label">Provinsi</label>
                                <input class="form-control" type="text" id="province" name="province" value="Jawa Barat"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="city" class="form-label">Kabupaten</label>
                                <input class="form-control" type="text" id="city" name="city" value="Kota Bogor"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="district" class="form-label">Kecamatan</label>
                                <input class="form-control" type="text" id="district" name="district"
                                    value="Bogor Tengah" readonly />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="village" class="form-label">Kelurahan</label>
                                <input class="form-control" type="text" id="village" name="village"
                                    value="Tegallega" readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rt" class="form-label">RT</label>
                                <input class="form-control" type="text" id="rt" name="rt" value="3"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="rw" class="form-label">RW</label>
                                <input class="form-control" type="text" id="rw" name="rw" value="4"
                                    readonly />
                            </div>
                            <div class="mb-3 col-md-4">
                                <label for="postal_code" class="form-label">Kode Pos</label>
                                <input class="form-control" type="text" id="postal_code" name="postal_code"
                                    value="12345" readonly />
                            </div>
                            <div class="mb-3">
                                <label for="full_address" class="form-label">Alamat Lengkap</label>
                                <textarea name="full_address" id="full_address" class="form-control" style="min-height: 160px;">Jalan Sudirman No 19</textarea>
                            </div>
                        </div>

                        <p class="fw-bold text-primary">Lokasi Instalasi dan Aktivasi</p>
                        <div id="map" class="w-full rounded-lg mb-3" style="height: 350px;"></div>
                        <div class="mb-3">
                            <label for="full_address" class="form-label">Link Google Maps</label>
                            <a href="https://maps.app.goo.gl/189CmxbFUrZpXsD19" class="form-control px-3 py-2">
                                https://maps.app.goo.gl/189CmxbFUrZpXsD19
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
        // Koordinat dummy
        const lat = -6.602234321160505;
        const lng = 106.80913996183654;

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
