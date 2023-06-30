<div class="modal fade" id="modalSkrj" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title">FORM SKRJ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_rawat" class="form-label mb-0">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm no_rawat" id="no_rawat" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="pasien" class="form-label mb-0">Pasien</label>
                        <input type="text" class="form-control form-control-sm pasien" id="pasien" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_lahir" class="form-label mb-0">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_sep" class="form-label mb-0">No. SEP</label>
                        <input type="text" class="form-control form-control-sm no_sep" id="no_sep" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="diagnosa" class="form-label mb-0">Diagnosa</label>
                        <input type="text" class="form-control form-control-sm diagnosa" id="diagnosa" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_surat" class="form-label mb-0">No. Surat</label>
                        <input type="text" class="form-control form-control-sm no_surat" id="no_surat" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_surat" class="form-label mb-0">Tgl. Surat</label>
                        <input type="text" class="form-control form-control-sm tgl_surat tanggal" id="tgl_surat" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_kontrol" class="form-label mb-0">Tgl. Kontrol</label>
                        <input type="text" class="form-control form-control-sm tgl_kontrol tanggal" id="tgl_kontrol" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="dokter" class="form-label mb-0">Spesialis/Sub</label>
                        <div class="input-group mb-3">
                            <button class="btn btn-sm btn-outline-secondary" type="button" id="btn-spesialis"><i class="bi bi-paperclip"></i></button>
                            <input type="text" class="form-control form-control-sm kode_dokter" placeholder="" aria-label="" id="kode_dokter" aria-describedby="btn-spesialis" readonly>
                            <input type="text" style="margin-left: 10px" class="form-control form-control-sm nama_dokter" placeholder="" aria-label="" aria-describedby="nama_dokter" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="poli" class="form-label mb-0">Unit/Poli</label>
                        <div class="input-group mb-3">
                            <button class="btn btn-sm btn-outline-secondary" type="button" id="btn-unit"><i class="bi bi-paperclip"></i></button>
                            <input type="text" class="form-control form-control-sm kode_poli" placeholder="" aria-label="" aria-describedby="kode_poli" readonly>
                            <input type="text" style="margin-left: 10px" class="form-control form-control-sm nama_poli" placeholder="" aria-label="" aria-describedby="nama_poli" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.modal_poli')
@include('content.poliklinik.modal.modal_spesialis')
@include('content.poliklinik.modal.modal_dokter')
@push('script')
    <script>
        $('#modalSkrj').on('shown.bs.modal', function() {
            isModalShow = true;
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
            });
            $('.tanggal').datepicker('setDate', dateStart)
        })
        $('#modalSkrj').on('hidden.bs.modal', function() {
            isModalShow = false;
            $('#opt-rawat').empty();
        })
    </script>
@endpush
