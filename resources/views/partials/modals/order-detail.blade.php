<style>
    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    h4 {
        font-size: 14px !important;
        margin-bottom: 0 !important;
    }

    p.summary {
        font-size: 14px !important;
        margin-bottom: 0 !important;
    }

    .order-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin: 24px 0 32px;
    }

    /* garis horizontal */
    .order-steps::before {
        content: '';
        position: absolute;
        top: 14px;
        left: 0;
        right: 0;
        height: 2px;
        background: #e5e7eb;
        z-index: 1;
    }

    .step {
        position: relative;
        z-index: 2;
        text-align: center;
        width: 25%;
    }

    .step .circle {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        color: white;
        font-size: 16px;
    }

    /* status selesai */
    .step.completed .circle {
        background: #5623D8;
    }

    /* status aktif (sedang berjalan) */
    .step.active .circle {
        border: 2px solid #5623D8;
        background: white;
        color: #5623D8;
    }

    .step h5 {
        font-size: 14px;
        margin-bottom: 2px;
        font-weight: 600;
    }

    .step p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    .order-info {
        margin-top: 12px;
        padding: 12px 16px;
        background: #f5f3ff;
        border-left: 4px solid #5623D8;
        border-radius: 6px;
        font-size: 14px;
        color: #1f2937;
    }
</style>

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
                    <img class="product-image" src="assets/img/products/produkVSAT1.png" alt="Product Image" />
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
                        <input class="form-control" type="text" id="village" name="village" value="Tegallega"
                            readonly />
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
