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
                <p class="fw-bold text-primary">Informasi Perusahaan</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="agilarrachman"
                            readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="company_name" class="form-label">Nama Perusahaan</label>
                        <input class="form-control" type="text" id="company_name" name="company_name"
                            value="PT. VSATLink Indonesia" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="fullname" class="form-label">Nama Pejabat yang Berwenang</label>
                        <input class="form-control" type="text" id="fullname" name="fullname" value="Agil ArRachman"
                            readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="npwp" class="form-label">Nomor NPWP Perusahaan</label>
                        <input class="form-control" type="text" id="npwp" name="npwp"
                            value="01.000.013.1-093.000" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email Perusahaan</label>
                        <input class="form-control" type="text" id="email" name="email"
                            value="agilarrachman@example.com" placeholder="agilarrachman@example.com" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Nomor Telepon Perusahaan</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="081332303211"
                            readonly />
                    </div>
                </div>
                <p class="fw-bold text-primary">Informasi Akun</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="sales" class="form-label">Sales Pendamping</label>
                        <input class="form-control" type="text" id="sales" name="sales"
                            value="Nasihuy Setiawan" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Sumber Informasi</label>
                        <input class="form-control" type="text" id="role" name="role" value="Media Sosial"
                            readonly />
                    </div>
                </div>
                <p class="fw-bold text-primary">Alamat Perusahaan</p>
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
                <p class="fw-bold text-primary">Narahubung Perusahaan</p>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="contact_name" class="form-label">Nama Narahubung</label>
                        <input class="form-control" type="text" id="contact_name" name="contact_name"
                            value="Agil Musthafa" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact_email" class="form-label">Email Narahubung</label>
                        <input class="form-control" type="text" id="contact_email" name="contact_email"
                            value="agilarrachman@example.com" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact_phone" class="form-label">Nomor Telepon Narahubung</label>
                        <input type="number" class="form-control" id="contact_phone" name="contact_phone"
                            value="081332303211" readonly />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="contact_position" class="form-label">Jabatan Narahubung</label>
                        <input class="form-control" type="text" id="contact_position" name="contact_position"
                            value="Head of Finance" readonly />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
