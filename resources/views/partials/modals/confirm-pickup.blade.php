<div class="modal fade" id="confirmPickupModal" tabindex="-1" role="dialog" aria-labelledby="confirmPickupModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="/logistics/confirm-pickup" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="confirmPickupModalLabel">
                        Konfirmasi Pesanan Diterima
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3">
                        Silakan masukkan nama penerima untuk konfirmasi bahwa pesanan telah diterima.
                    </p>

                    <input type="hidden" name="order_id" id="order_id">

                    <div class="input-form mb-3">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" class="form-control" name="receiver_name" id="receiver_name"
                            placeholder="Masukkan Nama Penerima" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit_btn" disabled>
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const receiverInput = document.getElementById('receiver_name');
    const submitButton = document.getElementById('submit_btn');

    function toggleSubmit() {
        submitButton.disabled = !receiverInput.value.trim();
    }

    receiverInput.addEventListener('input', toggleSubmit);
</script>
