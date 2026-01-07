<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-primary" id="customerModalLabel">Detail Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="fw-bold text-primary" id="label-info">Informasi</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="customer_type" class="form-label">Jenis Customer</label>
                        <input class="form-control" type="text" name="customer_type" id="customer_type" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username" id="username" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label" id="label-name">Nama</label>
                        <input class="form-control" type="text" id="name" name="name" readonly />
                    </div>
                    <div class="mb-3 col-md-6 company-fields">
                        <label for="company_representative_name" class="form-label">Nama Pejabat yang Berwenang</label>
                        <input class="form-control" type="text" id="company_representative_name"
                            name="company_representative_name" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="npwp" class="form-label" id="label-npwp">Nomor NPWP</label>
                        <input class="form-control" type="text" id="npwp" name="npwp" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label" id="label-email">Email</label>
                        <input class="form-control" type="text" id="email" name="email" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label" id="label-phone">Nomor Telepon</label>
                        <input type="number" class="form-control" id="phone" name="phone" readonly />
                    </div>
                </div>

                <p class="fw-bold text-primary">Informasi Akun</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="sales" class="form-label">Sales Pendamping</label>
                        <input class="form-control" type="text" id="sales" name="sales" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="source_information" class="form-label">Sumber Informasi</label>
                        <input class="form-control" type="text" id="source_information" name="source_information"
                            readonly />
                    </div>
                </div>

                <p class="fw-bold text-primary" id="label-address">Alamat</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="province" class="form-label">Provinsi</label>
                        <input class="form-control" type="text" id="province" name="province" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="city" class="form-label">Kabupaten</label>
                        <input class="form-control" type="text" id="city" name="city" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="district" class="form-label">Kecamatan</label>
                        <input class="form-control" type="text" id="district" name="district" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="village" class="form-label">Kelurahan</label>
                        <input class="form-control" type="text" id="village" name="village" readonly />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="rt" class="form-label">RT</label>
                        <input class="form-control" type="text" id="rt" name="rt" readonly />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="rw" class="form-label">RW</label>
                        <input class="form-control" type="text" id="rw" name="rw" readonly />
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="postal_code" class="form-label">Kode Pos</label>
                        <input class="form-control" type="text" id="postal_code" name="postal_code" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="full_address" class="form-label">Alamat Lengkap</label>
                        <textarea name="full_address" id="full_address" class="form-control" style="min-height: 160px;"></textarea>
                    </div>
                </div>

                <div class="contact-fields" id="contact-fields">
                    <p class="fw-bold text-primary">Narahubung Perusahaan</p>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="contact_name" class="form-label">Nama Narahubung</label>
                            <input class="form-control" type="text" id="contact_name" name="contact_name"
                                readonly />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_email" class="form-label">Email Narahubung</label>
                            <input class="form-control" type="text" id="contact_email" name="contact_email"
                                readonly />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_phone" class="form-label">Nomor Telepon Narahubung</label>
                            <input type="number" class="form-control" id="contact_phone" name="contact_phone"
                                readonly />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="contact_position" class="form-label">Jabatan Narahubung</label>
                            <input class="form-control" type="text" id="contact_position" name="contact_position"
                                readonly />
                        </div>
                    </div>
                </div>

                <div class="document-fields" id="document-fields">
                    <p class="fw-bold text-primary" id="label-document">Dokumen Legalitas</p>
                    <div class="row">
                        <div class="mb-3 col-md-6 d-flex flex-column">
                            <label class="mb-2 font-medium">NPWP</label>
                            <a href="#" target="_blank" class="btn btn-primary btn-download-npwp"
                                style="width: fit-content">
                                Unduh PDF
                            </a>
                        </div>
                        <div class="company-fields col-md-6">
                            <div class="mb-3 d-flex flex-column">
                                <label class="mb-2 font-medium">NIB</label>
                                <a href="#" target="_blank" class="btn btn-primary btn-download-nib"
                                    style="width: fit-content">
                                    Unduh PDF
                                </a>
                            </div>
                        </div>
                        <div class="company-fields">
                            <div class="company-fields mb-3 d-flex flex-column">
                                <label class="mb-2 font-medium">SK Kemenkumham Akta Pendirian</label>
                                <a href="#" target="_blank" class="btn btn-primary btn-download-sk"
                                    style="width: fit-content">
                                    Unduh PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
