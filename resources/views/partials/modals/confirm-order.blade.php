<div class="modal fade" id="confirmOrderModal" tabindex="-1" role="dialog" aria-labelledby="confirmOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="confirmOrderModalLabel">
                        Konfirmasi Pesanan
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Silakan masukkan rincian biaya yang akan dikenakan kepada pelanggan.
                        Pastikan nominal sudah sesuai sebelum melakukan konfirmasi.
                    </p>

                    <div class="input-form mb-3">
                        <label class="form-label">Biaya Layanan Instalasi</label>
                        <input type="text" class="form-control format-rupiah" placeholder="Contoh: 1.500.000"
                            data-target="service_cost" />
                        <input type="hidden" name="service_cost" id="service_cost">
                    </div>

                    <div class="input-form">
                        <label class="form-label">Biaya Transport Instalasi</label>
                        <input type="text" class="form-control format-rupiah" placeholder="Contoh: 500.000"
                            data-target="transport_cost" />
                        <input type="hidden" name="transport_cost" id="transport_cost">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.format-rupiah').forEach(input => {
        input.addEventListener('input', function() {
            // Ambil angka saja
            let rawValue = this.value.replace(/\D/g, '');

            // Simpan ke input hidden (tanpa titik)
            const targetId = this.dataset.target;
            document.getElementById(targetId).value = rawValue;

            // Format tampilan ribuan
            if (rawValue) {
                this.value = rawValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            } else {
                this.value = '';
            }
        });
    });
</script>
