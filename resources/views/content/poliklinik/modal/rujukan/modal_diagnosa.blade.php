<div class="modal fade" id="modalDiagnosa" tabindex="-1" aria-labelledby="modalDiagnosa" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h6 class="modal-title">REFERENSI DIAGNOSA</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-diagnosa text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode ICD</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalDiagnosa').on('hidden.bs.modal', function() {
            $('#modalRujukanKeluar').modal('show')
            $('.table-diagnosa tbody').empty()
        })
        $('#modalDiagnosa').on('shown.bs.modal', function() {
            $('#modalRujukanKeluar').modal('hide')
        })
    </script>
@endpush
