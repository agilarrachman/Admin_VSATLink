<div class="modal fade" id="inputInstallationSchedule" tabindex="-1" role="dialog"
    aria-labelledby="inputInstallationScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="/service-activations/input-installation-schedule" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="inputInstallationScheduleLabel">
                        Input Jadwal Instalasi & Aktivasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3 text-muted" style="font-size: 14px">
                        Silakan pilih tanggal untuk jadwal instalasi & aktivasi layanan. Pastikan data
                        yang dimasukkan sudah benar sebelum dikonfirmasi.
                    </p>

                    <input type="hidden" name="activation_nota_id" id="activation_nota_id">

                    <div class="input-form mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="installation_date" id="installation_date"
                            min="{{ date('Y-m-d') }}" required />
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
    const dateInput = document.getElementById('installation_date');
    const submitButton = document.getElementById('submit_btn');

    function toggleSubmit() {
        submitButton.disabled = !dateInput.value;
    }

    dateInput.addEventListener('change', toggleSubmit);
</script>
