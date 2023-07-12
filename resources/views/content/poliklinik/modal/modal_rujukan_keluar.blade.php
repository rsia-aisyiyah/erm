<div class="modal fade" id="modalRujukanKeluar" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header text-bg-warning" style="border-radius:0px">
                <h5 class="modal-title">FORM RUJUKAN KELUAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="no_rawat" class="form-label mb-0" style="font-size:12px;">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm no_rawat_rujuk" id="no_rawat_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="pasien" class="form-label mb-0" style="font-size:12px;">Pasien</label>
                        <input type="text" class="form-control form-control-sm pasien_rujuk" id="pasien_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_lahir" class="form-label mb-0" style="font-size:12px;">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir_rujuk" id="tgl_lahir_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_surat" class="form-label mb-0" style="font-size:12px;">Tgl. Surat</label>
                        <input type="text" class="form-control form-control-sm tgl_surat_rujuk" id="tgl_surat_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_kontrol" class="form-label mb-0" style="font-size:12px;">Tgl. R. Kunjungan</label>
                        <input type="text" class="form-control form-control-sm tgl_kunjungan tanggal" onchange="setTanggalKontrol(this)" id="tgl_kunjungan" placeholder="">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="no_sep" class="form-label mb-0" style="font-size:12px;">No. SEP</label>
                        <input type="text" class="form-control form-control-sm no_sep_rujuk" id="no_sep_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="jns_rujuk" class="form-label mb-0" style="font-size:12px;">Jenis Rujukan</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="jns_rujuk" style="font-size:12px">
                            <option selected disabled>Pilih Jenis Rujukan</option>
                            <option value="0">Penuh</option>
                            <option value="1">Parsial</option>
                            <option value="2">Rujuk Balik</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="ppj_rujuk" class="form-label mb-0" style="font-size:12px;">PPK Rujukan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_ppk">
                            <input type="text" class="form-control form-control-sm ppk_rujuk" id="ppk_rujuk" aria-label="PPK Rujukan" aria-describedby="ppk_rujuk" readonly>
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="diagnosa_rujuk" class="form-label mb-0" style="font-size:12px;">Diagnosa</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_diagnosa">
                            <input type="text" class="form-control form-control-sm diagnosa_rujuk" id="diagnosa_rujuk" aria-label="Diagnosa Rujukan" aria-describedby="diagnosa_rujuk" readonly>
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="poli_rujuk" class="form-label mb-0" style="font-size:12px;">Poli Tujuan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_poli_rujuk">
                            <input type="text" class="form-control form-control-sm poli_rujuk" id="poli_rujuk" aria-label="Poliklinik Tujuan" aria-describedby="poli_rujuk" readonly>
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="catatan_rujuk" class="form-label mb-0" style="font-size:12px;">Catatan</label>
                        <input type="text" class="form-control form-control-sm catatan_rujuk" id="catatan_rujuk" placeholder="">
                    </div>
                    <input type="hidden" name="noka" class="noka">
                    <input type="hidden" name="nokontrol" class="nokontrol">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-skrj mr-auto" onclick="simpanRujukanKeluar()"><i class="bi bi-envelope-plus-fill"></i> Buat Rujukan Keluar</button>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.modal_poli')
@include('content.poliklinik.modal.modal_spesialis')
@include('content.poliklinik.modal.modal_dokter')
@push('script')
    <script>
        $('#modalRujukanKeluar').on('shown.bs.modal', function() {
            isModalShow = true;
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = parseInt(hari) + 1 + '-' + bulan + '-' + tahun;
            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('#tgl_kunjungan').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
            });

            console.log(tanggal)
            $('#tgl_surat_rujuk').val(splitTanggal("{{ date('Y-m-d') }}"));
            $('#tgl_kunjungan').datepicker('setDate', tanggal)
        })
        $('#jns_rujuk').on('change', function(evt) {
            if (this.value == 2) {
                cekSep($('#no_sep_rujuk').val()).done(function(response) {
                    $('#kode_ppk').val(response.kdppkrujukan)
                    $('#ppk_rujuk').val(response.kdppkrujukan + ' - ' + response.nmppkrujukan)
                });
            } else {
                $('#kode_ppk').val('')
                $('#ppk_rujuk').val('')
            }
        })
    </script>
@endpush
