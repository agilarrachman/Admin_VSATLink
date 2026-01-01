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
                <div class="d-flex items-start gap-4 mb-3">
                    <img class="product_image" id="product_image" src="" alt="" />
                    <div class="info w-full mb-3 mb-md-0">
                        <p class="mb-0" style="font-size: 14px" id="unique_order"></p>
                        <h4 class="mb-0 fw-bold" style="font-size: 16px" id="product_name"></h4>
                        <p class="mb-0" id="product_cost"></p>
                        <p class="mb-0" style="font-size: 14px" id="created_at"></p>
                    </div>
                </div>

                <p class="fw-bold text-primary">Lokasi Instalasi dan Aktivasi</p>
                <div class="mb-3">
                    <label for="full_address" class="form-label">Link Google Maps</label>
                    <a href="#" id="google_maps_url" class="form-control px-3 py-2" target="_blank"></a>
                </div>
                <div id="map" class="w-full rounded-lg mb-3" style="height: 250px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>