<div class="modal fade" id="modalKontrolUmum" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header text-bg-danger" style="border-radius:0px">
                <h5 class="modal-title">FORM KONTROL PASIEN UMUM</h5>
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
                    <div class="col-md-3 col-sm-12 gy-2">
                        <label for="tgl_lahir" class="form-label mb-0">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" placeholder="" readonly>
                    </div>
                    <div class="col-md-3 col-sm-12 gy-2">
                        <label for="tgl_kontrol" class="form-label mb-0">Tgl. Kontrol</label>
                        <input type="text" class="form-control form-control-sm tgl_kontrol tanggal" onchange="setTanggalKontrol(this)" id="tgl_kontrol" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_surat" class="form-label mb-0">No. Surat</label>
                        <input type="text" class="form-control form-control-sm no_surat" id="no_surat" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="dokter" class="form-label mb-0">Dokter DPJP</label>
                        <input type="hidden" class="kode_dokter" id="kode_dokter" />
                        <input type="text" class="form-control form-control-sm nama_dokter" placeholder="" aria-label="" aria-describedby="nama_dokter" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="poli" class="form-label mb-0">Unit/Poli</label>
                        <input type="hidden" class="kode_poli" id="kode_poli">
                        <input type="text" class="form-control form-control-sm nama_poli" placeholder="" aria-label="" aria-describedby="nama_poli" readonly>

                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <button class="btn btn-sm btn-primary btn-buat-kontrol-umum" onclick="buatKontrolUmum()">Buat Surat Kontrol</button>
                    </div>
                    <input type="hidden" name="noka" class="noka">
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#modalKontrolUmum').on('shown.bs.modal', function() {
            console.log(tanggalKontrol)
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

            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('.tgl_surat').datepicker('setDate', dateStart)
            $('.tgl_kontrol').datepicker('setDate', tanggal)
        })
    </script>
@endpush
