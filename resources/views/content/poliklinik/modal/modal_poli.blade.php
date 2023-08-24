<div class="modal fade" id="modalPoli" tabindex="-1" aria-labelledby="modalPoli" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Poliklinik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-poli text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Poli</th>
                            <th>Nama Poli</th>
                            <th>Kapasitas</th>
                            <th>Jml Rencana</th>
                            <th>Persentase</th>
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
        $('#modalPoli').on('hidden.bs.modal', function() {
            $('#modalSkrj').modal('show')
            $('.table-poli tbody').empty()
        })
    </script>
@endpush
