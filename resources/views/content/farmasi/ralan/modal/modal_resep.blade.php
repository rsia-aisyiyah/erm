<div class="modal fade" id="modalResepObat" tabindex="-1" aria-labelledby="modalResepObat" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP OBAT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="no_rawat" />
                <input type="hidden" class="no_resep" />

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12" id="umum">
                        <table class="table table-striped table-responsive" width="100%" id="tabel-umum">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Obat</td>
                                    <td>Jumlah</td>
                                    <td>Aturan Pakai</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" id="racikan">
                        <table class="table table-responsive" width="100%" id="tabel-racikan">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Racikan</td>
                                    <td>Isi</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
@push('script')
    <script></script>
@endpush
