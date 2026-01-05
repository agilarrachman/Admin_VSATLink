<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="cancelOrderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="/orders/cancel" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="cancelOrderModalLabel">Batalkan Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin membatalkan pesanan ini?</p>
                    <input type="hidden" name="order_id" id="order_id">
                    <textarea name="reason" id="reason" class="form-control" placeholder="Tuliskan alasan pembatalan pesanan di sini..."
                        style="min-height: 160px;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger" disabled>Batalkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reason = document.getElementById('reason');
        const submitBtn = reason.closest('form').querySelector('button[type="submit"]');

        reason.addEventListener('input', function () {
            if (reason.value.trim().length > 0) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        });
    });
</script>