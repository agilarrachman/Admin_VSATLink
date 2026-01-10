<style>
    #inputSNModal .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
    }
</style>

<div class="modal fade" id="inputSNModal" tabindex="-1" role="dialog" aria-labelledby="inputSNModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="/logistics/input-sn" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="inputSNModalLabel">
                        Input Serial Number
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="fw-bold text-primary">Rincian Pesanan</p>
                    <div class="d-flex items-center gap-4 mb-3">
                        <img class="product_image" id="product_image" src="" alt="" />
                        <div class="info w-full mb-3 mb-md-0">
                            <p class="mb-0" style="font-size: 14px" id="unique_order"></p>
                            <h4 class="mb-0 fw-bold" style="font-size: 16px" id="product_name"></h4>
                            <p class="mb-0" style="font-size: 14px" id="created_at"></p>
                        </div>
                    </div>

                    <p class="mb-3">
                        Silakan masukkan seluruh serial number perangkat pada form di bawah ini untuk melanjutkan proses
                        logistik.
                    </p>

                    <input type="hidden" name="order_id" id="order_id">

                    <div class="input-form mb-3">
                        <label class="form-label">Modem Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="modem_sn" id="modem_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>

                    <div class="input-form mb-3">
                        <label class="form-label">Adaptor Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="adaptor_sn" id="adaptor_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>

                    <div class="input-form mb-3">
                        <label class="form-label">BUC Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="buc_sn" id="buc_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>

                    <div class="input-form mb-3">
                        <label class="form-label">LNB Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="lnb_sn" id="lnb_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>

                    <div class="input-form mb-3" id="input-router">
                        <label class="form-label">Router Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="router_sn" id="router_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>

                    <div class="input-form mb-3">
                        <label class="form-label">Antena Serial Number</label>
                        <input type="text" class="form-control format-rupiah" name="antena_sn" id="antena_sn"
                            placeholder="Masukkan serial number (6-20 karakter)" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary" disabled>
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('inputSNModal');
    const submitButton = modal.querySelector('button[type="submit"]');

    function isValidSerial(value) {
        const length = value.trim().length;
        return length >= 6 && length <= 20;
    }

    function isVisible(element) {
        return element.offsetParent !== null;
    }

    function toggleSubmit() {
        let allValid = true;

        const inputs = modal.querySelectorAll(
            '#modem_sn, #adaptor_sn, #buc_sn, #lnb_sn, #router_sn, #antena_sn'
        );

        inputs.forEach(input => {
            if (!isVisible(input)) {
                return;
            }

            if (!isValidSerial(input.value)) {
                allValid = false;
            }
        });

        submitButton.disabled = !allValid;
    }

    modal.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('input', toggleSubmit);
    });

    submitButton.disabled = true;
</script>