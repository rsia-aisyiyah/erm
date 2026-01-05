<div class="modal fade" id="modalSpri" tabindex="-1" aria-labelledby="modalSpri" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="border-radius:0px;background-color: #8c00ff;color:#fff">
                <h5 class="modal-title">FORM SURAT PERINTAH RAWAT INAP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formSpri">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 ">
                            <label for="pasien" class="form-label mb-0">Pasien</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm pasien" id="pasien" name="pasien"
                                       placeholder="" readonly/>
                                <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button"
                                        style="font-size:12px"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <label for="no_rawat" class="form-label mb-0">No. Rawat</label>
                            <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat"
                                   placeholder="" readonly/>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <label for="tgl_lahir_inap" class="form-label mb-0">Tanggal Lahir</label>
                            <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir"
                                   name="tgl_lahir"
                                   placeholder="" readonly/>
                        </div>
                        <div class="col-md-5 col-sm-12 ">
                            <label for="no_kartu_inap" class="form-label mb-0">No. Kartu</label>
                            <x-input-group>
                                <input type="text" class="form-control form-control-sm no_kartu" id="no_kartu"
                                       name="no_kartu"
                                       placeholder="" readonly>
                                <x-input id="penjab" name="penjab" class="w-25" readonly=""></x-input>
                            </x-input-group>
                        </div>
                        <div class="col-md-4 col-sm-12 ">
                            <label for="no_sep" class="form-label mb-0">No. SEP</label>
                            <x-input id="no_sep" name="no_sep" readonly="true"></x-input>
                        </div>
                        <div class="col-md-3 col-sm-12 ">
                            <label for="nmppkrujukan" class="form-label mb-0">Nm. PPK Rujukan</label>
                            <x-input id="nmppkrujukan" name="nmppkrujukan" readonly="true"></x-input>
                        </div>

                        <div class="col-md-6 col-sm-12 ">
                            <label for="no_surat" class="form-label mb-0">No. Surat</label>
                            <input type="text" class="form-control form-control-sm no_surat" id="no_surat"
                                   name="no_surat"
                                   placeholder="" readonly>
                        </div>

                        <div class="col-md-6 col-sm-12 ">
                            <label for="tgl_surat" class="form-label mb-0">Tgl. Surat</label>
                            <input type="date" class="form-control form-control-sm tgl_surat" name="tgl_surat"
                                   id="tgl_surat"
                                   placeholder="" readonly disabled>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <label for="tgl_inap" class="form-label mb-0">Tgl. Rawat Inap</label>
                            <input type="date" class="form-control form-control-sm tgl_inap"
                                   id="tgl_inap" name="tgl_inap" placeholder="">
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <label for="diagnosa_inap" class="form-label mb-0">Diagnosa</label>
                            <select name="kd_diagnosa_inap" id="kd_diagnosa_inap" class="select2 w-100"
                                    data-parent-dropdown="#modalSpri">
                                <option value="" selected>Pilih Diagnosa Awal</option>

                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <label for="kode_dokter_inap" class="form-label mb-0">Spesialis/Sub</label>
                            <select name="kd_dokter_bpjs" id="kd_dokter_bpjs" class="select2 w-100"
                                    data-parent-dropdown="#modalSpri">
                                <option value="">Pilih Dokter DPJP</option>
                            </select>
                            <div class="list-dokter"></div>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                            <label for="poli_inap" class="form-label mb-0">Unit/Poli</label>
                            <div class="input-group mb-3">
                                <select name="kode_poli_inap" id="kode_poli_inap" class="w-100" class="select2 w-100"
                                        data-parent-dropdown="#modalSpri">
                                    <option value="" selected>Pilih Poliklinik</option>
                                </select>
                            </div>

                        </div>
                        <input type="hidden" name="no_spri" class="no_spri">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-spri" onclick="simpanSpri()"><i
                            class="bi bi-plus-circle-fill"></i> Buat SPRI
                </button>
                <a href="" target="_blank" class="btn btn-sm btn-success btn-print-spri"><i class="bi bi-printer"></i>
                    Cetak SPRI</a>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>

        const $formSpri = $('#formSpri');

        $formSpri.find('select[name=kd_diagnosa_inap]').select2({
            allowClear: false,
            delay: 0,
            dropdownParent: $formSpri,
            scrollAfterSelect: true,
            width: '100%',
            initSelection: function (element, callback) {
            },
            ajax: {
                url: `/erm/penyakit/cari`,
                dataType: 'json',
                data: (params) => {
                    return {
                        kd_penyakit: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: `${item.kd_penyakit} - ${item.nm_penyakit}`,
                                id: `${item.kd_penyakit} - ${item.nm_penyakit}`
                            }
                        })
                    };
                },
                cache: false
            }
        })

        $formSpri.find('select[name=kode_poli_inap]').select2({
            allowClear: false,
            delay: 0,
            dropdownParent: $formSpri,
            scrollAfterSelect: true,
            width: '100%',

            ajax: {
                url: `/erm/mapping/poliklinik`,
                dataType: 'json',
                data: (params) => {
                    return {
                        kd_poli: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: `${item.poliklinik?.nm_poli}`,
                                id: item.kd_poli_bpjs
                            }
                        })
                    };
                },
                cache: false
            }
        })
        $formSpri.find('select[name=kd_dokter_bpjs]').select2({
            allowClear: false,
            delay: 0,
            dropdownParent: $formSpri,
            scrollAfterSelect: true,
            width: '100%',

            ajax: {
                url: `/erm/mapping/dokter`,
                dataType: 'json',
                data: (params) => {
                    return {
                        nm_dokter: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: `${item.nm_dokter_bpjs}`,
                                id: item.kd_dokter_bpjs
                            }
                        })
                    };
                },
                cache: false
            }
        })

        $('#modalSpri').on('shown.bs.modal', function () {

        })


        function showModalSpri(no_rawat) {
            $.get(`/erm/spri/get`, {no_rawat: no_rawat}).done((val) => {
                $('.btn-cari-peserta').attr('onclick', `getPesertaDetail('${val.pasien.no_peserta}', '${val.tgl_reg}')`);

                $formSpri.find('input[name=no_rawat]').val(no_rawat)
                $formSpri.find('input[name=pasien]').val(`${val.no_rkm_medis} ${val.pasien.nm_pasien} ( ${val.umurdaftar} ${val.sttsumur})`)
                $formSpri.find('input[name=tgl_lahir]').val(splitTanggal(val.pasien.tgl_lahir))
                $formSpri.find('input[name=no_kartu]').val(val.pasien.no_peserta)
                $formSpri.find('input[name=penjab]').val(val.penjab.png_jawab)
                $formSpri.find('input[name=no_sep]').val(val.sep.no_sep)
                $formSpri.find('input[name=nmppkrujukan]').val(val.sep.nmppkpelayanan)
                $formSpri.find('input[name=tgl_surat]').val(val.tgl_registrasi).prop('readonly', false)
                if (val.spri) {

                    $formSpri.find('input[name=no_surat]').val(val.spri.no_surat).addClass('is-valid').prop('readonly', true)
                    $formSpri.find('input[name=tgl_inap]').val(val.spri.tgl_rencana).addClass('is-valid').prop('readonly', true)

                    const diagnosa = new Option(val.spri.diagnosa, val.spri.diagnosa, true, true);
                    $formSpri.find('select[name=kd_diagnosa_inap]').append(diagnosa).trigger('select').prop('disabled', true);

                    const dokter = new Option(val.spri.nm_dokter_bpjs, val.spri.kd_dokter_bpjs, true, true);
                    $formSpri.find('select[name=kd_dokter_bpjs]').append(dokter).trigger('select').prop('disabled', true);

                    const poliklinik = new Option(val.spri.nm_poli_bpjs, val.spri.kd_poli_bpjs, true, true);
                    $formSpri.find('select[name=kode_poli_inap]').append(poliklinik).trigger('select').prop('disabled', true);

                    $('.btn-buat-spri').addClass('d-none')
                    $('.btn-print-spri').removeClass('d-none').prop('href', `/erm/spri/print/${val.spri.no_surat}`)

                } else {
                    $formSpri.find('input[name=no_surat]').val("").removeClass('is-valid')
                    $formSpri.find('input[name=tgl_inap]').val("{{date('Y-m-d')}}").removeClass('is-valid').prop('readonly', false)

                    $formSpri.find('select[name=kd_diagnosa_inap]').prop('disabled', false);
                    $formSpri.find('select[name=kd_dokter_bpjs]').prop('disabled', false);
                    $formSpri.find('select[name=kode_poli_inap]').prop('disabled', false);

                    const diagnosa = new Option(val.sep.nmdiagnosaawal, val.sep.diagawal, true, true)
                    $formSpri.find('select[name=kd_diagnosa_inap]').append(diagnosa).trigger('select')

                    const dokter = new Option(val.sep.nmdpdjp, val.sep.kddpjp, true, true)
                    $formSpri.find('select[name=kd_dokter_bpjs]').append(dokter).trigger('select')

                    const poliklinik = new Option(val.sep.nmpolitujuan,val.sep.kdpolitujuan, true, true)
                    $formSpri.find('select[name=kode_poli_inap]').append(poliklinik).trigger('select')

                    $('.btn-buat-spri').removeClass('d-none')
                    $('.btn-print-spri').addClass('d-none').prop('href', `javascript:void(0)`)
                }
                $('#modalSpri').modal('show')
            })
        }

        $('#modalSpri').on('hidden.bs.modal', function () {
            $formSpri.trigger('reset')
            $('.opt-rawat').empty();
        });

        function tarikSpri(data) {
            $.ajax({
                url: '/erm/spri/insert',
                method: 'POST',
                data: data,
                success: function (response) {
                    swal.fire(
                        'Berhasil',
                        'Berhasil membuat SPRI',
                        'success'
                    );
                    $('.btn-buat-skrj').css('display', 'none')
                    $('#modalSpri').modal('hide');
                    reloadTabelPoli();
                },
            })
        }


        function simpanSpri() {
            let data = {
                "noKartu": $formSpri.find('input[name=no_kartu]').val(),
                "kodeDokter": $formSpri.find('select[name=kd_dokter_bpjs]').val(),
                "poliKontrol":$formSpri.find('select[name=kode_poli_inap]').val(),
                "tglRencanaKontrol": $formSpri.find('input[name=tgl_inap]').val(),
                "user": "{{ session()->get('pegawai')->nik }}",
            };


            $.ajax({
                url: '/erm/bridging/spri/insert',
                data: data,
                beforeSend: function () {
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
                success: function (val) {
                    let dataTarik = {
                        no_rawat: $formSpri.find('input[name=no_rawat]').val(),
                        no_kartu: $formSpri.find('input[name=no_kartu]').val(),
                        tgl_surat: $formSpri.find('input[name=tgl_surat]').val(),
                        tgl_rencana: $formSpri.find('input[name=tgl_inap]').val(),
                        kd_dokter_bpjs: $formSpri.find('select[name=kd_dokter_bpjs]').val(),
                        nm_dokter_bpjs: $formSpri.find('select[name=kd_dokter_bpjs] option:selected').text(),
                        kd_poli_bpjs: $formSpri.find('select[name=kode_poli_inap]').val(),
                        nm_poli_bpjs: $formSpri.find('select[name=kode_poli_inap] option:selected').text(),
                        diagnosa:  $formSpri.find('select[name=kd_diagnosa_inap]').val(),
                        sep: '-',
                    };

                    if (val.metaData.code == 200) {
                        if (val.response != null) {
                            let dataSpri = Object.assign(dataTarik, {
                                no_rujukan: val.response.noSPRI,
                            })
                            tarikSpri(dataSpri)
                            $('.nokontrol').val(val.response.noSuratKontrol)
                        } else {
                            getListRencanaKontrol(bulan, tahun, dataTarik.no_kartu, 1).done(function (response) {
                                $formSpri.find('input[name=no_surat]').val(data.noSuratKontrol)
                                $.map(response.response.list, function (spri) {
                                    if (spri.namaJnsKontrol == 'SPRI') {
                                        let dataSpri = Object.assign(dataTarik, {
                                            no_rujukan: spri.noSuratKontrol,
                                        })
                                        tarikSpri(dataSpri)
                                        $formSpri.find('input[name=no_surat]').val(val.response.noSuratKontrol)
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

        //
        // function getPerintahInap(no_rawat) {
        //     return $.ajax({
        //         url: '/erm/spri/get/',
        //         data: {
        //             no_rawat : no_rawat
        //         },
        //         dataType: 'JSON',
        //         error: (request) => {
        //             alertSessionExpired(request.status)
        //         },
        //     });
        // }


        function rawatInap(noRm, tanggal) {

            const formSpri = $('#formSpri')
            getPasienPeriksa(noRm, tanggal).done((response) => {
                $.map(response, (periksa) => {
                    getPerintahInap(periksa.pasien.no_peserta, tanggal).done((val) => {

                        $('.btn-cari-peserta').attr('onclick', `getPesertaDetail('${periksa.pasien.no_peserta}', '${tanggal}')`);
                        $('.no_rawat_inap').val(periksa.no_rawat)
                        $('.pasien_inap').val(periksa.no_rkm_medis + ' - ' + periksa.pasien.nm_pasien + ' (' + periksa.umurdaftar + ' ' + periksa.sttsumur + ' )');
                        $('.tgl_lahir_inap').val(splitTanggal(periksa.pasien.tgl_lahir));
                        $('.no_kartu_inap').val(periksa.pasien.no_peserta);
                        $('.no_surat_inap').val(val.no_surat);

                        if (Object.keys(val).length > 0) {
                            $('.tgl_surat_inap').val(splitTanggal(val.tgl_surat));
                            $('.tgl_inap').val(splitTanggal(val.tgl_rencana));
                            $('.kode_dokter_inap').val(val.kd_dokter_bpjs);
                            $('.nama_dokter_inap').val(val.nm_dokter_bpjs);
                            $('.diagnosa_inap').val(val.diagnosa);
                            $('.diagnosa_inap').attr('disabled', true);
                            $('.tgl_inap').attr('disabled', true);
                            $('.btn-buat-spri').css('display', 'none')
                            $('.kode_poli_inap').val(val.kd_poli_bpjs);
                            $('.nama_poli_inap').val(val.nm_poli_bpjs);
                        } else {
                            $('.diagnosa_inap').attr('disabled', false);
                            $('.tgl_inap').attr('disabled', false);
                            $('.btn-buat-spri').css('display', 'inline')
                            $('.tgl_surat_inap').val("{{ date('d-m-Y') }}");
                            $('.tgl_inap').val("{{ date('d-m-Y') }}");
                            getPoliBpjs(periksa.kd_poli).done((response) => {
                                $('.kode_poli_inap').val(response.kd_poli_bpjs)
                                $('.nama_poli_inap').val(response.nm_poli_bpjs)
                            })
                            getDokter(periksa.kd_dokter).done((response) => {
                                $.map(response, (data) => {
                                    $('.kode_dokter_inap').val(data.mapping_dokter.kd_dokter_bpjs);
                                    $('.nama_dokter_inap').val(data.nm_dokter);
                                })
                            })
                        }

                    })
                })
            })
            $('#modalSpri').modal('show');
        }

        $('.diagnosa_inap').on('keyup', function () {
            let dx = $(this).val();
            if (dx.length >= 3) {
                getDiagnosa(dx).done(function (response) {
                    if (response) {
                        html =
                            '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                        no = 1;
                        $.map(response, function (data) {
                            html +=
                                '<li data-nama="' + data.nm_penyakit + '" data-id="' + data.kd_penyakit + '" onclick="setDiagnosaInap(this)"><a class="dropdown-item" href="javascript:void(0)" style="overflow:hidden"> ' + data.kd_penyakit + ' - ' + data.nm_penyakit + '</a></li>'
                            no++;
                        })
                        html += '</ul>';
                        $('.list-diagnosa').fadeIn();
                        $('.list-diagnosa').html(html);
                    }
                })
            }
        })


        function setDiagnosaInap(p) {
            let kdDiagnosa = $(p).data('id');
            let nmDiagnosa = $(p).data('nama');
            $('.diagnosa_inap').val(kdDiagnosa + ' - ' + nmDiagnosa);
            $('.kd_diagnosa_inap').val(kdDiagnosa);
        }

    </script>
@endpush
