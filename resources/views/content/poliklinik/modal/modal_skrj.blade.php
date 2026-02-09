<div class="modal fade" id="modalSkrj" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-success" style="border-radius:0px">
                <h5 class="modal-title">FORM SURAT KONTROL ULANG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="rujukan-expired"></div>
                <form action="" id="formModalSkrj">
                    <div class="row gy-2">
                        <div class="col-md-6 col-sm-12">
                            <label for="no_rawat" class="form-label mb-0">No. Rawat</label>
                            <input type="text" class="form-control form-control-sm no_rawat" id="no_rawat"
                                placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="pasien" class="form-label mb-0">Pasien</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm pasien" id="pasien"
                                    placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                                <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button"
                                    style="font-size:12px"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="tgl_lahir" class="form-label mb-0">Tanggal Lahir</label>
                            <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir"
                                placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="no_sep" class="form-label mb-0">No. SEP</label>
                            <input type="text" class="form-control form-control-sm no_sep" id="no_sep" name="no_sep"
                                placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <label for="no_surat" class="form-label mb-0">No. Surat</label>
                            <input type="text" class="form-control form-control-sm no_surat" id="no_surat"
                                name="no_surat" placeholder="" readonly
                                style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="no_surat" class="form-label mb-0">Diagnosa</label>
                            <input type="text" class="form-control form-control-sm diagnosa" id="diagnosa"
                                name="diagnosa" placeholder="" readonly
                                style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="tgl_surat" class="form-label mb-0">Tgl. Surat</label>
                            <input type="date" class="form-control form-control-sm tgl_surat" id="tgl_surat"
                                name="tgl_surat" placeholder="" readonly
                                style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="tgl_kontrol" class="form-label mb-0">Tgl. Kontrol</label>
                            <input type="date" class="form-control form-control-sm tgl_kontrol" name="tgl_kontrol"
                                id="tgl_kontrol" placeholder="">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="dokter" class="form-label mb-0">Spesialis/Sub</label>
                            <div class="input-group mb-3">
                                <input type="text" class=" form-control form-control-sm kode_dokter" placeholder=""
                                    aria-label="" id="kode_dokter" name="kode_dokter"
                                    aria-describedby="btn-spesialis" readonly
                                    style="background-color: #e9ecef;cursor:not-allowed">
                                <input type="text" style="background-color: #e9ecef;cursor:not-allowed"
                                    class="w-50 form-control form-control-sm nama_dokter" name="nama_dokter"
                                    placeholder="" aria-label="" aria-describedby="nama_dokter" readonly>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="poli" class="form-label mb-0">Unit/Poli</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm kode_poli" placeholder=""
                                    aria-label="" name="kode_poli" aria-describedby="kode_poli" readonly
                                    style="background-color: #e9ecef;cursor:not-allowed">
                                <input type="text" style="background-color: #e9ecef;cursor:not-allowed"
                                    class="w-50 form-control form-control-sm nama_poli" name="nama_poli"
                                    placeholder="" aria-label="" aria-describedby="nama_poli" readonly>
                            </div>

                        </div>
                        <input type="hidden" name="noka" class="noka">
                        <input type="hidden" name="nokontrol" class="nokontrol">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-skrj" onclick="simpanSkrj()"><i class="bi bi-plus"></i>
                    Buat SKRJ
                </button>
                <a href="" target="_blank" class="btn btn-sm btn-success btn-print-skrj d-none"><i
                        class="bi bi-printer"></i> Cetak SKRJ</a>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.modal_poli')
@include('content.poliklinik.modal.modal_spesialis')
@include('content.poliklinik.modal.modal_dokter')
@push('script')
    <script>
        var tanggalKontrol = '';


        $('#modalSkrj').on('shown.bs.modal', function() {
            // console.log(tanggalKontrol)
            // isModalShow = true;
            // date = new Date()
            // hari = ('0' + (date.getDate())).slice(-2);
            // bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            // tahun = date.getFullYear();
            // dateStart = hari + '-' + bulan + '-' + tahun;
            // let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            // $('#tgl_kontrol').datepicker({
            //     format: 'dd-mm-yyyy',
            //     orientation: 'bottom',
            //     autoclose: true,
            //     setDate: dateStart,
            //     startDate: '+1',
            // });
            // $('.tanggal').datepicker({
            //     format: 'dd-mm-yyyy',
            //     orientation: 'bottom',
            //     autoclose: true,
            //     setDate: dateStart,
            //     startDate: '+1',
            // });

        })

        $('#modalSkrj').on('hidden.bs.modal', function() {
            $('.opt-rawat').empty();
            $('#formModalSkrj').trigger('reset');
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
                    $('.btn-buat-skrj').addClass('d-none')
                    $('.btn-print-skrj ').removeClass('d-none').attr('href', `/erm/rencanaKontrol/print/${response.no_surat}`)
                    if ($('#tb_pasien').length) {
                        reloadTabelPoli();
                    } else {
                        $('#tableSep').DataTable().ajax.reload(null, true);
                    }
                },
            })
        }

        function simpanSkrj() {
            const $form = $('#formModalSkrj');

            const tglKontrol = $form.find('input[name=tgl_kontrol]').val();

            const payloadBpjs = {
                noSEP: $form.find('input[name=no_sep]').val(),
                kodeDokter: $form.find('input[name=kode_dokter]').val(),
                poliKontrol: $form.find('input[name=kode_poli]').val(),
                tglRencanaKontrol: tglKontrol,
                user: "{{ session()->get('pegawai')->nik }}"
            };
            $.ajax({
                url: '/erm/bridging/rencanaKontrol/insert',
                method: 'POST',
                dataType: 'JSON',
                data: payloadBpjs,
                beforeSend() {
                    Swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon tunggu',
                        showConfirmButton: false,
                        didOpen: () => Swal.showLoading()
                    });
                },
                success(res) {
                    if (res.metaData.code !== "200") {
                        Swal.fire('Peringatan', res.metaData.message, 'warning');
                        return;
                    }
                    handleSkrjResponse(res, payloadBpjs);
                },
                error(request, status, error) {
                    alertErrorAjax(request);
                }
            });
        }


        function handleSkrjResponse(res, payloadBpjs) {
            const $form = $('#formModalSkrj');

            const noSep = payloadBpjs.noSEP;
            const nmPoli = $form.find('input[name=nama_poli]').val();
            const nmDokter = $form.find('input[name=nama_dokter]').val();

            if (res.response) {
                const r = res.response;

                const dataInsert = {
                    no_sep: noSep,
                    no_surat: r.noSuratKontrol,
                    tgl_surat: r.tglRencanaKontrol,
                    tgl_rencana: r.tglRencanaKontrol,
                    kd_dokter_bpjs: payloadBpjs.kodeDokter,
                    nm_dokter_bpjs: nmDokter,
                    kd_poli_bpjs: payloadBpjs.poliKontrol,
                    nm_poli_bpjs: nmPoli
                };


                $('.nokontrol').val(r.noSuratKontrol);

                tarikRencanaKontrol(dataInsert);
            }
        }


        function kontrolUlang(noSep) {
            const formModalSkrj = $('#formModalSkrj');
            cekSep(noSep).done(function(response) {
                getRujukanPcarePeserta(response.no_kartu).done(function(rujukan) {
                    if (rujukan.metaData.code == 200 && rujukan.response) {
                        rujukanExpired(rujukan.response.rujukan.tglKunjungan)
                    } else {
                        $('.rujukan-expired').empty()
                        $('.rujukan-expired').append('<div class="alert alert-danger" style="padding:8px;border-radius:0px;font-size:12px;margin:5px" role="alert"><i class="bi bi-info-circle-fill"></i> Tidak ada rujukan dari FKTP</div>');
                    }
                })

                $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.no_kartu + '\', \'' + response.tglsep + '\')');
                formModalSkrj.find('input[name=no_rawat]').val(response.no_rawat)
                formModalSkrj.find('input[name=no_sep]').val(response.no_sep)
                formModalSkrj.find('input[name=pasien]').val(response.nomr + ' - ' + response.nama_pasien + ' (' + response.reg_periksa.umurdaftar + ')');
                formModalSkrj.find('input[name=tgl_lahir]').val(splitTanggal(response.tanggal_lahir))
                formModalSkrj.find('input[name=kode_poli]').val(response.kdpolitujuan)
                formModalSkrj.find('input[name=nama_poli]').val(response.nmpolitujuan)
                formModalSkrj.find('input[name=diagnosa]').val(response.nmdiagnosaawal)
                formModalSkrj.find('input[name=nama_dokter]').val(response.reg_periksa.dokter.nm_dokter)
                formModalSkrj.find('input[name=kode_dokter]').val(response.kddpjp)
                formModalSkrj.find('input[name=noka]').val(response.no_kartu)

                if (response.surat_kontrol != null) {
                    formModalSkrj.find('input[name=no_surat]').val(response.surat_kontrol.no_surat).addClass('is-valid')
                    formModalSkrj.find('input[name=tgl_kontrol]').val(response.surat_kontrol?.tgl_rencana).addClass('is-valid').prop('disabled', true)
                    formModalSkrj.find('input[name=tgl_surat]').val(response.surat_kontrol?.tgl_surat).addClass('is-valid')
                    formModalSkrj.find('.nama_dokter').val(response.surat_kontrol.nm_dokter_bpjs)
                    formModalSkrj.find('.kode_dokter').val(response.surat_kontrol.kd_dokter_bpjs)
                    formModalSkrj.find('.btn-buat-skrj').css('display', 'none');
                    formModalSkrj.find('#btn-spesialis').removeAttr('onclick');

                    $('.btn-print-skrj').prop('href', `/erm/rencanaKontrol/print/${response.surat_kontrol.no_surat}`);
                    $('.btn-print-skrj').removeClass('d-none');
                    $('.btn-buat-skrj').addClass('d-none');
                } else {

                    $('#btn-spesialis').removeAttr('onclick');
                    formModalSkrj.find('input[name=no_surat]').val('-').removeClass('is-valid')
                    formModalSkrj.find('input[name=tgl_surat]').val('').removeClass('is-valid')
                    formModalSkrj.find('input[name=tgl_kontrol]').val("{{ date('Y-m-d') }}").removeClass('is-valid').prop('disabled', false)

                    $('.btn-buat-skrj').removeClass('d-none');

                    $('.btn-print-skrj').prop('href', `javascript:void(0)`);
                    $('.btn-print-skrj').addClass('d-none');
                }
                $('#modalSkrj').modal('show')
            })
        }


        function rujukanExpired(tanggal) {
            $('.rujukan-expired').empty()
            let tglRujukan = new Date(tanggal)
            tglRujukan.setDate(tglRujukan.getDate() + 90)
            expiredRujukan = tglRujukan.toISOString().split('T')[0];
            $('.rujukan-expired').append('<div class="alert alert-warning" style="padding:8px;border-radius:0px;font-size:12px;margin:5px" role="alert"><i class="bi bi-info-circle-fill"></i> Masa berlaku rujukan sampai : <strong>' + formatTanggal(expiredRujukan) + '</strong></div>');
        }
    </script>
@endpush
