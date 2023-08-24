<div class="modal fade" id="modalPoliRujuk" tabindex="-1" aria-labelledby="modalPoliRujuk" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">REFERENSI POLI</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-poli text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Poli</th>
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
        $('#modalPoliRujuk').on('hidden.bs.modal', function() {
            // $('#modalRujukanKeluar').modal('show')
            $('.table-poli tbody').empty()
        })
        $('#modalPoliRujuk').on('shown.bs.modal', function() {
            // $('#modalRujukanKeluar').modal('hide')
            $(this).css('background-color', 'rgba(0,0,0,.25)')
        })
    </script>
@endpush
