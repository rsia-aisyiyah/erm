<div class="modal fade" id="modalSkrj" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header text-bg-success" style="border-radius:0px">
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
                        <label for="no_surat" class="form-label mb-0">No. Surat</label>
                        <input type="text" class="form-control form-control-sm no_surat" id="no_surat" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_surat" class="form-label mb-0">Diagnosa</label>
                        <input type="text" class="form-control form-control-sm diagnosa" id="diagnosa" placeholder="" readonly>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_surat" class="form-label mb-0">Tgl. Surat</label>
                        <input type="text" class="form-control form-control-sm tgl_surat tanggal" id="tgl_surat" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_kontrol" class="form-label mb-0">Tgl. Kontrol</label>
                        <input type="text" class="form-control form-control-sm tgl_kontrol tanggal" onchange="setTanggalKontrol(this)" id="tgl_kontrol" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="dokter" class="form-label mb-0">Spesialis/Sub</label>
                        <div class="input-group mb-3">
                            {{-- <button class="btn btn-sm btn-outline-secondary" type="button" id="btn-spesialis"><i class="bi bi-paperclip"></i></button> --}}
                            <input type="text" class="form-control form-control-sm kode_dokter" placeholder="" aria-label="" id="kode_dokter" aria-describedby="btn-spesialis" readonly>
                            <input type="text" style="margin-left: 10px" class="form-control form-control-sm nama_dokter" placeholder="" aria-label="" aria-describedby="nama_dokter" readonly>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="poli" class="form-label mb-0">Unit/Poli</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm kode_poli" placeholder="" aria-label="" aria-describedby="kode_poli" readonly>
                            <input type="text" style="margin-left: 10px" class="form-control form-control-sm nama_poli" placeholder="" aria-label="" aria-describedby="nama_poli" readonly>
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <button class="btn btn-sm btn-primary btn-buat-skrj" onclick="simpanSkrj()">Buat SKRJ</button>
                    </div>
                    <input type="hidden" name="noka" class="noka">
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
            $('#tgl_surat').datepicker('setDate', dateStart)
            $('#tgl_kontrol').datepicker('setDate', tanggal)
        })
        $('#modalSkrj').on('hidden.bs.modal', function() {
            isModalShow = false;
            $('#opt-rawat').empty();
        });

        function tarikRencanaKontrol(data) {
            $.ajax({
                url: '/erm/rencanaKontrol/insert',
                method: 'POST',
                data: data,
                success: function(response) {
                    swal.fire(
                        'Berhasil',
                        'Berhasil membuat SKRJ',
                        'success'
                    );
                    $('.btn-buat-skrj').css('display', 'none')
                    reloadTabelPoli();
                    $('#modalSkrj').modal('hide');
                },
            })
        }


        function simpanSkrj() {
            data = {
                "_token": "{{ csrf_token() }}",
                "noSEP": $('#no_sep').val(),
                "kodeDokter": $('#kode_dokter').val(),
                "poliKontrol": $('.kode_poli').val(),
                "tglRencanaKontrol": splitTanggal($('#tgl_kontrol').val()),
                "user": "{{ session()->get('pegawai')->nama }}",
            };

            $.ajax({
                url: '/erm/bridging/rencanaKontrol/insert',
                data: data,
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                dataType: 'JSON',
                method: 'POST',
                success: function(val) {
                    if (val.metaData.code == 200) {
                        console.log(val)
                        let noSEP = $('#no_sep').val();
                        let kodeDokter = $('#kode_dokter').val();
                        let tglSurat = $('#tgl_surat').val();
                        let kdPoli = $('.kode_poli').val();
                        let nmPoli = $('.nama_poli').val();
                        let nmDokter = $('.nama_dokter').val();

                        if (val.response) {
                            data = {
                                '_token': "{{ csrf_token() }}",
                                'no_sep': noSEP,
                                'tgl_surat': splitTanggal(tglSurat),
                                'no_surat': val.response.noSuratKontrol,
                                'tgl_rencana': val.response.tglRencanaKontrol,
                                'kd_dokter_bpjs': kodeDokter,
                                'nm_dokter_bpjs': nmDokter,
                                'kd_poli_bpjs': kdPoli,
                                'nm_poli_bpjs': nmPoli,
                            }
                            tarikRencanaKontrol(data)
                        } else {
                            // tgl = new Date();
                            // bulan = ("0" + (tgl.getMonth() + 1)).slice(-2)
                            // tahun = tgl.getFullYear();
                            noka = $('.noka').val()
                            rencana = cariRencanaKontrol(bulan, tahun, noka, 1)

                            alert(rencana.metaData)
                            // do {
                            // } while (rencana != null)
                            // swal.fire(
                            //     'Peringatan',
                            //     'Berhasil membuat SKRJ, dan Gagal Menambahkan SKRJ di SIM RS',
                            //     'error'
                            // );
                        }

                    } else {
                        swal.fire(
                            'Peringatan',
                            val.metaData.message,
                            'warning'
                        );
                    }
                },
            });

        }
    </script>
@endpush
