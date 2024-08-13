<div class="modal fade" id="modalKontrolUmum" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-danger" style="border-radius:0px">
                <h5 class="modal-title">FORM KONTROL PASIEN UMUM</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_rawat" class="form-label mb-0">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm no_rawat" id="no_rawat" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="pasien" class="form-label mb-0">Pasien</label>
                        <input type="hidden" class="umurdaftar">
                        <input type="hidden" class="sttsumur">
                        <input type="hidden" class="no_rkm_medis">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm pasien" id="pasien" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                            <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button" style="font-size:12px"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 gy-2">
                        <label for="tgl_lahir" class="form-label mb-0">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-3 col-sm-12 gy-2">
                        <label for="tgl_kontrol_umum" class="form-label mb-0">Tgl. Kontrol</label>
                        <input type="text" class="form-control form-control-sm tgl_kontrol_umum tanggal" onchange="setTanggalKontrol(this)" id="tgl_kontrol_umum" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_surat" class="form-label mb-0">No. Surat</label>
                        <input type="text" class="form-control form-control-sm no_surat" id="no_surat" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="dokter" class="form-label mb-0">Dokter DPJP</label>
                        <input type="hidden" class="kode_dokter" id="kode_dokter" />
                        <input type="hidden" class="dokter" id="dokter" />
                        <input type="text" class="form-control form-control-sm nama_dokter" placeholder="" aria-label="" aria-describedby="nama_dokter" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="poli" class="form-label mb-0">Unit/Poli</label>
                        <input type="hidden" class="kode_jenis" id="kode_jenis">
                        <input type="hidden" class="kode_poli" id="kode_poli">
                        <input type="text" class="form-control form-control-sm nama_poli" placeholder="" aria-label="" aria-describedby="nama_poli" readonly style="background-color: #e9ecef;cursor:not-allowed">

                    </div>
                    <input type="hidden" name="noka" class="noka">
                    <input type="hidden" name="booking" class="booking">
                    <input type="hidden" name="registrasi" class="registrasi">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-kontrol-umum" onclick="buatKontrolUmum()">Buat Surat Kontrol</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $('#modalKontrolUmum').on('shown.bs.modal', function() {
            isModalShow = true;
            date = new Date()
            hari = ('0' + (date.getDate() + 1)).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('#tgl_kontrol_umum').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                startDate: '+1d',
            });

            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('.tgl_surat').datepicker('setDate', dateStart)
            $('.tgl_kontrol_umum').datepicker('setDate', tanggal)
        })
    </script>
@endpush
