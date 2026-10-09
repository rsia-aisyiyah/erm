<div class="modal fade" id="modalDiagnosa" tabindex="-1" aria-labelledby="modalDiagnosa" aria-hidden="true" style="background-color: rgba(0,0,0,.5); z-index: 1070 !important;">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">REFERENSI DIAGNOSA</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <style>
                    .table-diagnosa tbody tr.row-diagnosa:hover {
                        background-color: #dbeafe !important;
                    }
                </style>
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
            // $('#modalRujukanKeluar').modal('show')
            $('.table-diagnosa tbody').empty()
        })
        $('#modalDiagnosa').on('shown.bs.modal', function() {
            // $('#modalRujukanKeluar').modal('hide')
            $(this).css('background-color', 'rgba(0,0,0,.25)')
        })
    </script>
@endpush
