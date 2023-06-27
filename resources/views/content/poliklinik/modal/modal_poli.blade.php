<div class="modal fade" id="modalPoli" tabindex="-1" aria-labelledby="modalPoli" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius:0px">
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
        // $('#modalSkrj').on('shown.bs.modal', function() {
        //     isModalShow = true;
        //     date = new Date()
        //     hari = ('0' + (date.getDate())).slice(-2);
        //     bulan = ('0' + (date.getMonth() + 1)).slice(-2);
        //     tahun = date.getFullYear();
        //     dateStart = hari + '-' + bulan + '-' + tahun;
        //     $('.tanggal').datepicker({
        //         format: 'dd-mm-yyyy',
        //         orientation: 'bottom',
        //         autoclose: true,
        //     });
        //     $('.tanggal').datepicker('setDate', dateStart)
        // })
        $('#modalPoli').on('hidden.bs.modal', function() {
            // isModalShow = false;
            // $('#opt-rawat').empty();
            $('#modalSkrj').modal('show')
            $('.table-poli tbody').empty()
        })
    </script>
@endpush
