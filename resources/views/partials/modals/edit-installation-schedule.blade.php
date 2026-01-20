<div class="modal fade" id="editInstallationSchedule" tabindex="-1" role="dialog"
    aria-labelledby="editInstallationScheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="/service-activations/edit-installation-schedule" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-primary" id="editInstallationScheduleLabel">
                        Edit Jadwal Instalasi & Aktivasi
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onclick="$('#editInstallationSchedule').modal('hide')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <p class="mb-3 text-muted" style="font-size: 14px">
                        Silakan pilih tanggal dan sesi waktu untuk jadwal instalasi & aktivasi layanan. Pastikan data
                        yang dimasukkan sudah benar sebelum dikonfirmasi.
                    </p>

                    <input type="hidden" name="activation_nota_id" id="edit_installation_activation_nota_id">

                    <input type="date" class="form-control mb-3" name="installation_date" id="edit_installation_date"
                        min="{{ date('Y-m-d') }}">

                    <div class="input-form mb-3">
                        <label class="form-label">Sesi Waktu</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="installation_session"
                                    id="edit_installation_session_morning" value="Pagi">
                                <label class="form-check-label" for="edit_installation_session_morning">
                                    Pagi (08.00–11.00)
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="installation_session"
                                    id="edit_installation_session_afternoon" value="Siang">
                                <label class="form-check-label" for="edit_installation_session_afternoon">
                                    Siang (13.00–17.00)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        onclick="$('#editInstallationSchedule').modal('hide')">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary" id="edit_submit_btn" disabled>
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editDateInput = document.getElementById('edit_installation_date');
    const editSubmitButton = document.getElementById('edit_submit_btn');

    function editToggleSubmit() {
        editSubmitButton.disabled = !editDateInput.value;
    }

    editDateInput.addEventListener('change', editToggleSubmit);
</script>
