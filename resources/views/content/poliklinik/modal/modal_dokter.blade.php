<div class="modal fade" id="modalDokter" tabindex="-1" aria-labelledby="modalDokter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title">Dokter Praktek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-stripped table-dokter text-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Dokter</th>
                            <th>Nama Dokter</th>
                            <th>Jadwal Praktek</th>
                            <th>Kapasitas</th>
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
        $('#modalDokter').on('hidden.bs.modal', function() {
            $('#modalSkrj').modal('show')
            $('.table-dokter tbody').empty()
        })
    </script>
@endpush
