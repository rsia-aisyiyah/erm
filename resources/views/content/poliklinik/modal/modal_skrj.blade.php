<style>
    #modalSkrj {
        z-index: 1070 !important;
    }
    .modal-backdrop + .modal-backdrop {
        z-index: 1065 !important;
    }
    .modal-backdrop + .modal-backdrop + .modal-backdrop {
        z-index: 1075 !important;
    }
</style>
<div class="modal fade" id="modalSkrj" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true" style="z-index: 1070 !important;">
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
                        <div class="col-md-3 col-sm-12">
                            <label for="no_rawat" class="form-label mb-0">No. Rawat</label>
                            <input type="text" class="form-control form-control-sm no_rawat" id="no_rawat"
                                name="no_rawat" placeholder="" readonly
                                style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="noka" class="form-label mb-0">No. Kartu</label>
                            <input type="text" class="form-control form-control-sm noka" id="noka" name="noka"
                                placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="pasien" class="form-label mb-0">Pasien</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm pasien" id="pasien" name="pasien"
                                    placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                                <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button"
                                    style="font-size:12px"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label for="tgl_lahir" class="form-label mb-0">Tanggal Lahir</label>
                            <input type="text" class="form-control form-control-sm tgl_lahir" id="tgl_lahir"
                                name="tgl_lahir" placeholder="" readonly
                                style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <label for="tglSep" class="form-label mb-0">Tgl. SEP</label>
                            <input type="date" class="form-control form-control-sm tglSep" id="tglSep" name="tglSep"
                                placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                        </div>
                        <div class="col-md-3 col-sm-12">
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
                                    aria-label="" id="kode_dokter" name="kode_dokter" aria-describedby="btn-spesialis"
                                    readonly style="background-color: #e9ecef;cursor:not-allowed">
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
                                    class="w-50 form-control form-control-sm nama_poli" name="nama_poli" placeholder=""
                                    aria-label="" aria-describedby="nama_poli" readonly>
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
                <button class="btn btn-sm btn-warning btn-bridging-skrj" onclick="tarikSkrjBridging()"><i class="bi bi-file-earmark-arrow-down"></i>
                    Tarik SKRJ Online
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


        $('#modalSkrj').on('shown.bs.modal', function () {
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

        $('#modalSkrj').on('show.bs.modal', function () {
            $(this).css('z-index', 1070);
        });

        $('#modalSkrj').on('shown.bs.modal', function () {
            const backdrops = $('.modal-backdrop');
            if (backdrops.length > 1) {
                backdrops.last().css('z-index', 1065);
            }
        });

        $('#modalSkrj').on('hidden.bs.modal', function () {
            $('.opt-rawat').empty();
            $('#formModalSkrj').trigger('reset');

            // Reset inline style z-index pada backdrop yang tersisa agar tidak menutupi modal sebelumnya
            $('.modal-backdrop').first().css('z-index', '');

            // Bersihkan backdrop gantung / berlebih jika ada
            const activeModals = $('.modal.show').length;
            const backdrops = $('.modal-backdrop');
            if (backdrops.length > activeModals) {
                backdrops.slice(activeModals).remove();
            }

            if (activeModals > 0) {
                $('body').addClass('modal-open');
                $('.modal.show').css('overflow-y', 'auto');
            } else {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            }
        });

        function tarikSkrjBridging() {
            const form = $('#formModalSkrj');
            const noKartu = form.find('input[name=noka]').val();
            const tglSep = form.find('input[name=tglSep]').val();
            const noSep = form.find('input[name=no_sep]').val();
            const bulanSep = tglSep.split('-')[1];
            const tahunSep = tglSep.split('-')[0];

            $.get(`/erm/bridging/rencanaKontrol/list/${bulanSep}/${tahunSep}/${noKartu}/1`, function (res) {
                console.log('CONSOLE KONTROL ===', res);

                if (res.metaData.code == "200" && res.response.list.length > 0) {
                    const rencanaKontrol = res.response.list;
                    const result = rencanaKontrol.find(item => item.noSepAsalKontrol === noSep);

                    console.log('RESULT ===', result);
                    
                    if(!result) {
                        Swal.fire(
                            'Informasi',
                            'Tidak ada SKRJ yang dapat ditarik untuk SEP ini, pastikan SEP sudah pernah digunakan untuk kontrol sebelumnya',
                            'info'
                        );
                        return;
                    }

                    const data = {
                        no_sep: noSep,
                        no_surat: result.noSuratKontrol,
                        tgl_surat: (result.tglTerbitKontrol && result.tglTerbitKontrol !== result.tglRencanaKontrol) ? result.tglTerbitKontrol : "{{ date('Y-m-d') }}",
                        tgl_rencana: result.tglRencanaKontrol,
                        kd_dokter_bpjs: result.kodeDokter,
                        nm_dokter_bpjs: result.namaDokter,
                        kd_poli_bpjs: result.poliTujuan,
                        nm_poli_bpjs: result.namaPoliTujuan
                    }
                    console.log('TARIK ===', data);

                    tarikRencanaKontrol(data);
                } else {
                    Swal.fire(
                        'Informasi',
                        'Peserta belum memiliki SKRJ, silahkan buat SKRJ',
                        'info'
                    );

                }

            });

        }

        function tarikRencanaKontrol(data) {

            $.ajax({
                url: '/erm/rencanaKontrol/insert',
                method: 'POST',
                data: data,
                beforeSend : function() {
                    Swal.fire({
                        title: 'Sedang memproses penarikan data ke server',
                        text: 'Mohon tunggu',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                }
            }).done((response) => {
                 Swal.fire(
                    'Berhasil',
                    'Berhasil membuat SKRJ',
                    'success'
                );
                $('.btn-buat-skrj').addClass('d-none');
                $('.btn-print-skrj')
                    .removeClass('d-none')
                    .attr('href', `/erm/rencanaKontrol/print/${response.no_surat}`);
                if ($('#tb_pasien').length) {
                    reloadTabelPoli();
                } else {
                    $('#tableSep').DataTable().ajax.reload(null, true);
                }
            }).fail((request) => {
                console.log('REQUEST ===', request);
                
                Swal.close();
                $('.btn-buat-skrj').prop('disabled', false);
                Swal.fire({
                    title: request.statusText ?? 'Terjadi Kesalahan',
                    text: request.responseText.slice(0,100) ?? 'Gagal membuat SKRJ',
                    icon: 'error'
                    
                });
            });
        }

        function simpanSkrj() {
            const form = $('#formModalSkrj');
            const btn = $('.btn-buat-skrj');
            btn.prop('disabled', true);
            const tglKontrol = form.find('input[name=tgl_kontrol]').val();
            const payloadBpjs = {
                noSEP: form.find('input[name=no_sep]').val(),
                kodeDokter: form.find('input[name=kode_dokter]').val(),
                poliKontrol: form.find('input[name=kode_poli]').val(),
                tglRencanaKontrol: tglKontrol,
                user: "{{ session()->get('pegawai')->nik }}",
                nama_dokter: form.find('input[name=nama_dokter]').val(),
                nama_poli: form.find('input[name=nama_poli]').val(),
            };
            $.ajax({
                url: '/erm/bridging/rencanaKontrol/insert',
                method: 'POST',
                dataType: 'JSON',
                data: payloadBpjs,

                beforeSend() {
                    Swal.fire({
                        title: 'Sedang mengirim data ke BPJS',
                        text: 'Mohon tunggu',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });
                },

                success(res) {
                    Swal.close();

                    if (!res || !res.metaData || res.metaData.code !== "200") {
                        btn.prop('disabled', false);
                        const msg = (res && res.metaData && res.metaData.message) ? res.metaData.message : 'Gagal membuat SKRJ ke server BPJS';
                        Swal.fire(
                            'Peringatan',
                            msg,
                            'warning'
                        );
                        return;
                    }

                    if (res.metaData.code === "200" && (!res.response || !res.response.noSuratKontrol)) {
                        btn.prop('disabled', false);
                        Swal.fire({
                            title: 'Response Kosong dari BPJS',
                            text: 'SKRJ mungkin sudah terbentuk di server BPJS namun respon belum diterima lengkap. Ingin mencoba menarik data SKRJ otomatis?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonText: 'Tarik SKRJ Sekarang',
                            cancelButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                tarikSkrjOnline();
                            }
                        });
                        return;
                    }

                    handleSkrjResponse(res, payloadBpjs);
                },

                error(request) {
                    Swal.close();
                    btn.prop('disabled', false);
                    alertErrorAjax(request);
                }
            });
        }


        function handleSkrjResponse(res, payloadBpjs) {
            const form = $('#formModalSkrj');
            const noSep = payloadBpjs.noSEP;
            const nmPoli = form.find('input[name=nama_poli]').val();
            const nmDokter = form.find('input[name=nama_dokter]').val();
            const r = res.response;
            const noSurat = r ? (r.noSuratKontrol || r.noSurat) : '';

            if (noSurat) {
                $('.nokontrol').val(noSurat);
            }

            // Jika backend sudah berhasil menyimpan langsung ke database RS (bridging_surat_kontrol_bpjs)
            if (res.saved_local) {
                Swal.fire(
                    'Berhasil',
                    'Berhasil membuat SKRJ: ' + noSurat,
                    'success'
                );
                $('.btn-buat-skrj').addClass('d-none');
                $('.btn-print-skrj')
                    .removeClass('d-none')
                    .attr('href', `/erm/rencanaKontrol/print/${noSurat}`);
                if ($('#tb_pasien').length) {
                    reloadTabelPoli();
                } else if ($.fn.DataTable && $('#tableSep').length && $.fn.DataTable.isDataTable('#tableSep')) {
                    $('#tableSep').DataTable().ajax.reload(null, true);
                }
                return;
            }

            // Fallback: simpan via ajax kedua jika belum tersimpan di backend
            const tglSuratVal = (r.tglTerbitKontrol && r.tglTerbitKontrol !== r.tglRencanaKontrol) 
                ? r.tglTerbitKontrol 
                : ($('#tgl_surat').val() || "{{ date('Y-m-d') }}");

            const dataInsert = {
                no_sep: noSep,
                no_surat: noSurat,
                tgl_surat: tglSuratVal,
                tgl_rencana: r.tglRencanaKontrol,
                kd_dokter_bpjs: payloadBpjs.kodeDokter,
                nm_dokter_bpjs: nmDokter,
                kd_poli_bpjs: payloadBpjs.poliKontrol,
                nm_poli_bpjs: nmPoli
            };

            tarikRencanaKontrol(dataInsert);
        }


        function kontrolUlang(noSep) {
            const formModalSkrj = $('#formModalSkrj');
            cekSep(noSep).done(function (response) {
                if (!response) {
                    Swal.fire('Error', 'Data SEP tidak ditemukan.', 'error');
                    return;
                }

                if (response.no_kartu) {
                    getRujukanPcarePeserta(response.no_kartu).done(function (rujukan) {
                        if (rujukan && rujukan.metaData && rujukan.metaData.code == 200 && rujukan.response) {
                            rujukanExpired(rujukan.response.rujukan.tglKunjungan);
                        } else {
                            $('.rujukan-expired').empty();
                            $('.rujukan-expired').append('<div class="alert alert-danger" style="padding:8px;border-radius:0px;font-size:12px;margin:5px" role="alert"><i class="bi bi-info-circle-fill"></i> Tidak ada rujukan dari FKTP</div>');
                        }
                    }).fail(function() {
                        $('.rujukan-expired').empty();
                    });
                }

                $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + (response.no_kartu || '') + '\', \'' + (response.tglsep || '') + '\')');
                formModalSkrj.find('input[name=no_rawat]').val(response.no_rawat || '');
                formModalSkrj.find('input[name=no_sep]').val(response.no_sep || '');
                formModalSkrj.find('input[name=tglSep]').val(response.tglsep || '');

                const umur = response.reg_periksa?.umurdaftar ? ` (${response.reg_periksa.umurdaftar})` : '';
                formModalSkrj.find('input[name=pasien]').val(`${response.nomr || ''} - ${response.nama_pasien || ''}${umur}`);
                formModalSkrj.find('input[name=tgl_lahir]').val(response.tanggal_lahir ? splitTanggal(response.tanggal_lahir) : '-');
                formModalSkrj.find('input[name=kode_poli]').val(response.kdpolitujuan || '');
                formModalSkrj.find('input[name=nama_poli]').val(response.nmpolitujuan || '');
                formModalSkrj.find('input[name=diagnosa]').val(response.nmdiagnosaawal || '');

                const nmDokter = response.reg_periksa?.dokter?.nm_dokter || response.nmdpdjp || response.nmdpjplayanan || '';
                formModalSkrj.find('input[name=nama_dokter]').val(nmDokter);
                formModalSkrj.find('input[name=kode_dokter]').val(response.kddpjp || response.kddpjplayanan || '');
                formModalSkrj.find('input[name=noka]').val(response.no_kartu || '');

                if (response.surat_kontrol != null) {
                    formModalSkrj.find('input[name=no_surat]').val(response.surat_kontrol.no_surat).addClass('is-valid');
                    formModalSkrj.find('input[name=tgl_kontrol]').val(response.surat_kontrol?.tgl_rencana).addClass('is-valid').prop('disabled', true);
                    formModalSkrj.find('input[name=tgl_surat]').val(response.surat_kontrol?.tgl_surat).addClass('is-valid');
                    formModalSkrj.find('.nama_dokter').val(response.surat_kontrol.nm_dokter_bpjs || nmDokter);
                    formModalSkrj.find('.kode_dokter').val(response.surat_kontrol.kd_dokter_bpjs || response.kddpjp || '');
                    formModalSkrj.find('.btn-buat-skrj').css('display', 'none');
                    formModalSkrj.find('#btn-spesialis').removeAttr('onclick');

                    $('.btn-print-skrj').prop('href', `/erm/rencanaKontrol/print/${response.surat_kontrol.no_surat}`);
                    $('.btn-print-skrj').removeClass('d-none');
                    $('.btn-buat-skrj').addClass('d-none');
                } else {
                    $('#btn-spesialis').removeAttr('onclick');
                    formModalSkrj.find('input[name=no_surat]').val('-').removeClass('is-valid');
                    formModalSkrj.find('input[name=tgl_surat]').val("{{ date('Y-m-d') }}").removeClass('is-valid');
                    const tglRencanaSoap = $('#tgl_rencana_kontrol').val();
                    const tglDefault = tglRencanaSoap ? tglRencanaSoap : "{{ date('Y-m-d') }}";
                    formModalSkrj.find('input[name=tgl_kontrol]').val(tglDefault).removeClass('is-valid').prop('disabled', false);

                    $('.btn-buat-skrj').removeClass('d-none');

                    $('.btn-print-skrj').prop('href', `javascript:void(0)`);
                    $('.btn-print-skrj').addClass('d-none');
                }

                Swal.close();
                $('#modalSkrj').modal('show');
            }).fail(function (xhr) {
                Swal.close();
                alertErrorAjax(xhr);
            });
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