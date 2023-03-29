<div class="modal fade" id="modalResepObat" tabindex="-1" aria-labelledby="modalResepObat" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RESEP OBAT</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="no_rawat" />
                <input type="hidden" class="no_resep" />
                <div class="notif">

                </div>
                <div class="row gy-2">
                    <div class="col-lg-6 col-md-6 col-sm-12" id="umum">
                        <div class="card">
                            <div class="card-header text-bg-warning">
                                Resep Non-Racik
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive" width="100%" id="tabel-umum">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Obat</th>
                                            <th>Jumlah</th>
                                            <th>Aturan Pakai</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12" id="racikan">
                        <div class="card">
                            <div class="card-header text-bg-danger">
                                Resep Racikan
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive" width="100%" id="tabel-racikan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Racikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>

                            </div>
                        </div>
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
