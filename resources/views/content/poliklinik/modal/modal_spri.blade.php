<div class="modal fade" id="modalSpri" tabindex="-1" aria-labelledby="modalSpri" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header" style="border-radius:0px;background-color: #8c00ff;color:#fff">
                <h5 class="modal-title">FORM SURAT PERINTAH RAWAT INAP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_rawat_inap" class="form-label mb-0">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm no_rawat_inap" id="no_rawat_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="pasien" class="form-label mb-0">Pasien</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm pasien_inap" id="pasien_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                            <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button" style="font-size:12px"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_lahir_inap" class="form-label mb-0">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir_inap" id="tgl_lahir_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_kartu_inap" class="form-label mb-0">No. Kartu</label>
                        <input type="text" class="form-control form-control-sm no_kartu_inap" id="no_kartu_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>

                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="no_surat_inap" class="form-label mb-0">No. Surat</label>
                        <input type="text" class="form-control form-control-sm no_surat_inap" id="no_surat_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="diagnosa_inap" class="form-label mb-0">Diagnosa</label>
                        <input type="hidden" class="kd_diagnosa_inap" id="kd_diagnosa_inap">
                        <input type="text" class="form-control form-control-sm diagnosa_inap" id="diagnosa_inap" placeholder="Cari diagnosa rawat inap...." autocomplete="off">
                        <div class="list-diagnosa"></div>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_surat_inap" class="form-label mb-0">Tgl. Surat</label>
                        <input type="text" class="form-control form-control-sm tgl_surat_inap" id="tgl_surat_inap" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="tgl_inap" class="form-label mb-0">Tgl. Rawat Inap</label>
                        <input type="text" class="form-control form-control-sm tgl_inap tanggal" onchange="setTanggalKontrol(this)" id="tgl_kontrol" placeholder="">
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="kode_dokter_inap" class="form-label mb-0">Spesialis/Sub</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm kode_dokter_inap" placeholder="" aria-label="" id="kode_dokter" aria-describedby="btn-spesialis" readonly style="background-color: #e9ecef;cursor:not-allowed">
                            <input type="search" style="margin-left: 10px;width:30%;background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm nama_dokter_inap" placeholder="" aria-label="" aria-describedby="nama_dokter" readonly><br />
                        </div>
                        <div class="list-dokter"></div>
                    </div>
                    <div class="col-md-6 col-sm-12 gy-2">
                        <label for="poli_inap" class="form-label mb-0">Unit/Poli</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm kode_poli_inap" placeholder="" aria-label="" aria-describedby="kode_poli" readonly style="background-color: #e9ecef;cursor:not-allowed">
                            <input type="text" style="margin-left: 10px;background-color: #e9ecef;cursor:not-allowed;width:30%" class="form-control form-control-sm nama_poli_inap" placeholder="" aria-label="" aria-describedby="nama_poli" readonly>
                        </div>

                    </div>
                    <input type="hidden" name="no_spri" class="no_spri">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-spri" onclick="simpanSpri()"><i class="bi bi-plus-circle-fill"></i> Buat SPRI</button>
            </div>
        </div>
    </div>
</div>
{{-- @include('content.poliklinik.modal.modal_poli')
@include('content.poliklinik.modal.modal_spesialis')
@include('content.poliklinik.modal.modal_dokter') --}}
@push('script')
    <script>
        $('#modalSpri').on('shown.bs.modal', function() {
            // console.log(tanggalKontrol)
            isModalShow = true;
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('.tgl_inap').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                setDate: dateStart,
                startDate: '+1',
            });
            $('#tgl_surat').val(splitTanggal("{{ date('Y-m-d') }}"));
            $('.tgl_inap').datepicker('setDate', tanggal)


        })
        $('#modalSpri').on('hidden.bs.modal', function() {
            isModalShow = false;
            $('.opt-rawat').empty();
            tanggalKontrol = splitTanggal("{{ date('Y-m-d') }}");
        });

        function tarikSpri(data) {
            $.ajax({
                url: '/erm/spri/insert',
                method: 'POST',
                data: data,
                success: function(response) {
                    swal.fire(
                        'Berhasil',
                        'Berhasil membuat SPRI',
                        'success'
                    );
                    $('.btn-buat-skrj').css('display', 'none')
                    reloadTabelPoli();
                    $('#modalSpri').modal('hide');
                },
            })
        }


        function simpanSpri() {
            let data = {
                "_token": "{{ csrf_token() }}",
                "noKartu": $('.no_kartu_inap').val(),
                "kodeDokter": $('.kode_dokter_inap').val(),
                "poliKontrol": $('.kode_poli_inap').val(),
                "tglRencanaKontrol": splitTanggal($('.tgl_inap').val()),
                "user": "{{ session()->get('pegawai')->nik }}",
            };

            $.ajax({
                url: '/erm/bridging/spri/insert',
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
                    console.log('RESPONSE BPJS', val)
                    let dataTarik = {
                        no_rawat: $('.no_rawat_inap').val(),
                        no_kartu: $('.no_kartu_inap').val(),
                        tgl_surat: splitTanggal($('.tgl_surat_inap').val()),
                        tgl_rencana: splitTanggal($('.tgl_inap').val()),
                        kd_dokter_bpjs: $('.kode_dokter_inap').val(),
                        nm_dokter_bpjs: $('.nama_dokter_inap').val(),
                        kd_poli_bpjs: $('.kode_poli_inap').val(),
                        nm_poli_bpjs: $('.nama_poli_inap').val(),
                        diagnosa: $('.diagnosa_inap').val(),
                        sep: '-',
                    };

                    if (val.metaData.code == 200) {
                        if (val.response != null) {
                            let dataSpri = Object.assign(dataTarik, {
                                no_rujukan: val.response.noSPRI,
                                _token: "{{ csrf_token() }}",
                            })
                            tarikSpri(dataSpri)
                            $('.nokontrol').val(val.response.noSuratKontrol)
                        } else {
                            getListRencanaKontrol(bulan, tahun, $('.no_kartu_inap').val(), 1).done(function(response) {
                                $('.nokontrol').val(data.noSuratKontrol)
                                $.map(response.response.list, function(spri) {
                                    if (spri.namaJnsKontrol == 'SPRI') {
                                        let dataSpri = Object.assign(dataTarik, {
                                            no_rujukan: spri.noSuratKontrol,
                                            _token: "{{ csrf_token() }}",
                                        })
                                        tarikSpri(dataSpri)
                                        $('.nokontrol').val(val.response.noSuratKontrol)
                                    }
                                })

                            })

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
