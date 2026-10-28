<div class="modal fade" id="modalRujukanKeluar" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header text-bg-warning" style="border-radius:0px">
                <h5 class="modal-title">FORM RUJUKAN KELUAR</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="no_rawat" class="form-label mb-0" style="font-size:12px;">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm no_rawat_rujuk" id="no_rawat_rujuk" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="pasien" class="form-label mb-0" style="font-size:12px;">Pasien</label>
                        <input type="hidden" class="" id="no_kartu">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-sm pasien_rujuk" id="pasien_rujuk" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                            <button class="btn btn-secondary btn-sm btn-cari-peserta" type="button" style="font-size:12px"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_lahir" class="form-label mb-0" style="font-size:12px;">Tanggal Lahir</label>
                        <input type="text" class="form-control form-control-sm tgl_lahir_rujuk" id="tgl_lahir_rujuk" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_surat" class="form-label mb-0" style="font-size:12px;">Tgl. Surat</label>
                        <input type="text" class="form-control form-control-sm tgl_surat_rujuk" id="tgl_surat_rujuk" name="tgl_surat_rujuk" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_kontrol" class="form-label mb-0" style="font-size:12px;">Tgl. R. Kunjungan</label>
                        <input type="text" class="form-control form-control-sm tgl_kunjungan tanggal" name="tgl_kunjungan_rujuk" id="tgl_kunjungan_rujuk" placeholder="">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="no_sep_rujuk" class="form-label mb-0" style="font-size:12px;">No. SEP</label>
                        <input type="text" class="form-control form-control-sm no_sep_rujuk" id="no_sep_rujuk" name="no_sep_rujuk" placeholder="" readonly style="background-color: #e9ecef;cursor:not-allowed">
                    </div>
                    <input type="hidden" value="2" id="jns_rujuk">
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tipe_rujuk" class="form-label mb-0" style="font-size:12px;">Tipe Rujukan</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipe_rujuk" id="tipe_rujuk" style="font-size:12px">
                            <option selected disabled value="y">Pilih Jenis Rujukan</option>
                            <option value="0">0. Penuh</option>
                            <option value="1">1. Parsial</option>
                            <option value="2">2. Rujuk Balik</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="ppj_rujuk" class="form-label mb-0" style="font-size:12px;">PPK Rujukan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_ppk" name="kode_ppk">
                            <input type="text" class="form-control form-control-sm ppk_rujuk" id="ppk_rujuk" aria-label="PPK Rujukan" aria-describedby="ppk_rujuk" autocomplete="off">
                            <button class="btn btn-secondary btn-sm btn-cari" type="button" style="font-size:12px" onclick="cariFaskes()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="diagnosa_rujuk" class="form-label mb-0" style="font-size:12px;">Diagnosa</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_diagnosa_rujuk" name="kode_diagnosa_rujuk">
                            <input type="text" class="form-control form-control-sm diagnosa_rujuk" id="diagnosa_rujuk" aria-label="Diagnosa Rujukan" aria-describedby="diagnosa_rujuk" autocomplete="off">
                            <button class="btn btn-secondary btn-sm btn-cari" type="button" style="font-size:12px" onclick="cariDiagnosaRujuk()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="poli_rujuk" class="form-label mb-0" style="font-size:12px;">Poli Tujuan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_poli_rujuk" name="kode_poli_rujuk">
                            <input type="text" class="form-control form-control-sm poli_rujuk" id="poli_rujuk" aria-label="Poliklinik Tujuan" aria-describedby="poli_rujuk">
                            <button class="btn btn-secondary btn-sm btn-cari" type="button" style="font-size:12px" onclick="cariPoli()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="catatan_rujuk" class="form-label mb-0" style="font-size:12px;">Catatan</label>
                        <input type="text" class="form-control form-control-sm catatan_rujuk" id="catatan_rujuk" name="catatan_rujuk" placeholder="" autocomplete="off">
                        <div class="list_catatan"></div>
                    </div>
                    <input type="hidden" name="noka" class="noka">
                    <input type="hidden" name="nokontrol" class="nokontrol">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-rujukan mr-auto" onclick="simpanRujukanKeluar()"><i class="bi bi-envelope-plus-fill"></i> Buat Rujukan Keluar</button>
                <a href="" target="_blank" class="btn btn-sm btn-success btn-print-rujukan mr-auto"><i class="bi bi-printer"></i> Cetak Rujukan Keluar</a>
                <button class="btn btn-sm btn-warning mr-auto" onclick="generateRujukanKeluar()">Tarik Rujukan Keluar</button>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.rujukan.modal_faskes')
@include('content.poliklinik.modal.rujukan.modal_diagnosa')
@include('content.poliklinik.modal.rujukan.modal_poli')
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
            dateStart = parseInt(hari) + '-' + bulan + '-' + tahun;
            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('#tgl_kunjungan_rujuk').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
            });

            $('#tgl_surat_rujuk').val(splitTanggal("{{ date('Y-m-d') }}"));
            $('#tgl_kunjungan_rujuk').datepicker('setDate', tanggal)
        })

        $('#modalRujukanKeluar').on('hidden.bs.modal', function() {
            $('#ppk_rujuk').removeAttr('disabled')
            $('#poli_rujuk').removeAttr('disabled')
            $('#tipe_rujuk').removeAttr('disabled')
            $('#tgl_kunjungan_rujuk').removeAttr('disabled')
            $('#diagnosa_rujuk').removeAttr('disabled')
            $('#catatan_rujuk').removeAttr('disabled')
            $('#modalRujukanKeluar .modal-footer').removeAttr('style')
            $('#ppk_rujuk').val('')
            tanggalKontrol = splitTanggal("{{ date('Y-m-d') }}");
            $('.btn-cari').css('display', 'inline')
            $('#diagnosa_rujuk').val('')
            $('#poli_rujuk').val('')
            $('#catatan_rujuk').val('')
            $("#tipe_rujuk option[value='x']").remove();
            $("#tipe_rujuk").val("y").change();
            $('#modalRujukanKeluar .modal-footer').removeAttr('style')
        })

        $('#tipe_rujuk').on('change', function(evt) {
            if (this.value == 2) {
                getPeserta($('#no_kartu').val()).done(function(response) {
                    kode_faskes = response.response.peserta.provUmum.kdProvider;
                    $('#kode_ppk').val(kode_faskes)
                    $.ajax({
                        url: '/erm/bridging/referensi/faskes/' + response.response.peserta.provUmum.kdProvider,
                        dataType: 'JSON',
                        method: 'GET',
                    }).done(function(fktp) {
                        $.map(fktp.response.faskes, function(faskes) {
                            if (faskes.kode == kode_faskes) {
                                $('#ppk_rujuk').val(faskes.nama)
                            }
                        })
                    })
                })
            } else {
                $('#kode_ppk').val('')
                $('#ppk_rujuk').val('')
            }
        })

        function cariFaskes() {
            const faskes = $('#ppk_rujuk').val();

            if (!faskes || faskes.length < 3) {
                swal.fire({
                    title: 'Gagal',
                    text: 'Minimal 3 digit kata kunci FKTP/Faskes',
                    showConfirmButton: true,
                    icon: 'error',
                });
                return;
            }

            $('.table-faskes tbody').empty().html('<tr><td colspan="3" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary me-2"></div> Mencari data faskes BPJS...</td></tr>');
            $('#modalFaskes').modal('show');

            const reqFaskes2 = $.ajax({
                url: '/erm/bridging/referensi/faskes/' + encodeURIComponent(faskes) + '/2',
                dataType: 'JSON',
                method: 'GET'
            });

            const reqFaskes1 = $.ajax({
                url: '/erm/bridging/referensi/faskes/' + encodeURIComponent(faskes) + '/1',
                dataType: 'JSON',
                method: 'GET'
            });

            $.when(reqFaskes2, reqFaskes1).always(function(res2, res1) {
                let html = '';
                const data2 = Array.isArray(res2) ? res2[0] : res2;
                const data1 = Array.isArray(res1) ? res1[0] : res1;

                // 1. Faskes Tingkat 2
                html += '<tr class="table-light"><td colspan="3" class="fw-bold text-muted py-1" style="font-size:12px;">FASKES TINGKAT 2 (Rumah Sakit)</td></tr>';
                if (data2 && data2.metaData && data2.metaData.code == "200" && data2.response && data2.response.faskes) {
                    let urut = 1;
                    $.each(data2.response.faskes, function(i, val) {
                        const safeNama = (val.nama || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                        html += `<tr class="row-faskes" style="cursor:pointer;" onclick="setPpkRujukan('${val.kode}', '${safeNama}')" title="Klik untuk memilih faskes ini">`;
                        html += `<td>${urut}</td>`;
                        html += `<td><span class="badge text-bg-primary">${val.kode}</span></td>`;
                        html += `<td class="fw-semibold text-primary">${val.nama}</td>`;
                        html += `</tr>`;
                        urut++;
                    });
                } else {
                    html += `<tr><td colspan="3" class="text-muted ps-3 fst-italic" style="font-size:12px;">${(data2 && data2.metaData) ? data2.metaData.message : 'Tidak ada faskes tingkat 2'}</td></tr>`;
                }

                // 2. Faskes Tingkat 1
                html += '<tr class="table-light"><td colspan="3" class="fw-bold text-muted py-1" style="font-size:12px;">FASKES TINGKAT 1 (Puskesmas/Klinik/Dokter)</td></tr>';
                if (data1 && data1.metaData && data1.metaData.code == "200" && data1.response && data1.response.faskes) {
                    let urut = 1;
                    $.each(data1.response.faskes, function(i, val) {
                        const safeNama = (val.nama || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                        html += `<tr class="row-faskes" style="cursor:pointer;" onclick="setPpkRujukan('${val.kode}', '${safeNama}')" title="Klik untuk memilih faskes ini">`;
                        html += `<td>${urut}</td>`;
                        html += `<td><span class="badge text-bg-primary">${val.kode}</span></td>`;
                        html += `<td class="fw-semibold text-primary">${val.nama}</td>`;
                        html += `</tr>`;
                        urut++;
                    });
                } else {
                    html += `<tr><td colspan="3" class="text-muted ps-3 fst-italic" style="font-size:12px;">${(data1 && data1.metaData) ? data1.metaData.message : 'Tidak ada faskes tingkat 1'}</td></tr>`;
                }

                $('.table-faskes tbody').html(html);
            });
        }

        function cariDiagnosaRujuk() {
            const diagnosa = $('#diagnosa_rujuk').val();
            if (!diagnosa || diagnosa.length < 3) {
                swal.fire({
                    title: 'Gagal',
                    text: 'Minimal 3 digit kata kunci diagnosa',
                    showConfirmButton: true,
                    icon: 'error',
                });
                return;
            }
            $('.table-diagnosa tbody').empty().html('<tr><td colspan="3" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary me-2"></div> Mencari data diagnosa...</td></tr>');
            $('#modalDiagnosa').modal('show');

            $.ajax({
                url: '/erm/bridging/referensi/diagnosa/' + encodeURIComponent(diagnosa),
                method: 'GET',
                dataType: 'JSON',
            }).done(function(response) {
                let html = '';
                if (response.metaData && response.metaData.code == "200" && response.response != null && response.response.diagnosa) {
                    let urut = 1;
                    $.each(response.response.diagnosa, function(i, val) {
                        const safeNama = (val.nama || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                        html += `<tr class="row-diagnosa" style="cursor:pointer;" onclick="setDiagnosa('${val.kode}', '${safeNama}')" title="Klik untuk memilih diagnosa ini">`;
                        html += `<td>${urut}</td>`;
                        html += `<td><span class="badge text-bg-primary">${val.kode}</span></td>`;
                        html += `<td class="fw-semibold text-primary">${val.nama}</td>`;
                        html += `</tr>`;
                        urut++;
                    });
                } else {
                    html += `<tr><td colspan="3" class="text-danger text-center">${response.metaData ? response.metaData.message : 'Diagnosa tidak ditemukan'}</td></tr>`;
                }
                $('.table-diagnosa tbody').html(html);
            });
        }

        function cariPoli() {
            const poli = $('#poli_rujuk').val();
            if (!poli || poli.length < 3) {
                swal.fire({
                    title: 'Gagal',
                    text: 'Minimal 3 digit kata kunci poli',
                    showConfirmButton: true,
                    icon: 'error',
                });
                return;
            }
            $('.table-poli tbody').empty().html('<tr><td colspan="3" class="text-center py-4"><div class="spinner-border spinner-border-sm text-primary me-2"></div> Mencari data poli...</td></tr>');
            $('#modalPoliRujuk').modal('show');

            $.ajax({
                url: '/erm/bridging/referensi/poli/' + encodeURIComponent(poli),
                method: 'GET',
                dataType: 'JSON',
            }).done(function(response) {
                let html = '';
                if (response.metaData && response.metaData.code == "200" && response.response != null && response.response.poli) {
                    let urut = 1;
                    $.each(response.response.poli, function(i, val) {
                        const safeNama = (val.nama || '').replace(/'/g, "\\'").replace(/"/g, '&quot;');
                        html += `<tr class="row-poli" style="cursor:pointer;" onclick="setPoli('${val.kode}', '${safeNama}')" title="Klik untuk memilih poli ini">`;
                        html += `<td>${urut}</td>`;
                        html += `<td><span class="badge text-bg-primary">${val.kode}</span></td>`;
                        html += `<td class="fw-semibold text-primary">${val.nama}</td>`;
                        html += `</tr>`;
                        urut++;
                    });
                } else {
                    html += `<tr><td colspan="3" class="text-danger text-center">${response.metaData ? response.metaData.message : 'Poli tidak ditemukan'}</td></tr>`;
                }
                $('.table-poli tbody').html(html);
            });
        }

        function setPpkRujukan(kode, nama) {
            $('#ppk_rujuk').val(nama)
            $('#kode_ppk').val(kode)
            $('#modalFaskes').modal('hide')
        }

        function setDiagnosa(kode, nama) {
            $('#kode_diagnosa_rujuk').val(kode)
            $('#diagnosa_rujuk').val(nama)
            $('#modalDiagnosa').modal('hide')
        }

        function setPoli(kode, nama) {
            $('#kode_poli_rujuk').val(kode)
            $('#poli_rujuk').val(nama)
            $('#modalPoliRujuk').modal('hide')
        }
        $('#catatan_rujuk').on('keyup', function() {
            data = [
                'KONTROL POST SC SELESAI',
                'KONSULTASI SELESAI',
                'MOHON RUJUK KEMBALI TANGGAL',
                'PARTUS SPONTAN DI FKTP',
                'PRO PICU',
                'MOHON TINDAK LANJUT',
            ];
            let input = $(this).val();
            let obj = data.filter(item => item.toLowerCase().indexOf(input) > -1);
            if (obj.length > 0) {
                html = '<ul class="dropdown-menu" style="width:auto;display:inline;position:absolute;border-radius:0;font-size:12px">';
                $.map(obj, function(val) {
                    html += '<li>'
                    html += '<a href="javascript:void(0)" class="dropdown-item" onclick="setCatatan(this)">' + val +
                        '</a>'
                    html += '</li>'
                })
                html += '</ul>'
                $('.list_catatan').fadeIn();
                $('.list_catatan').html(html);
            } else {
                $('.list_catatan').fadeOut();
            }
        })

        function setCatatan(catatan) {
            $('#catatan_rujuk').val(catatan.text)
            $('.list_catatan').fadeOut();
        }

        function simpanRujukanKeluar() {

            let data = {
                'noSep': $('#no_sep_rujuk').val(),
                'tglRujukan': splitTanggal($('#tgl_surat_rujuk').val()),
                'tglRencanaKunjungan': splitTanggal($('#tgl_kunjungan_rujuk').val()),
                'ppkDirujuk': $('#kode_ppk').val(),
                'jnsPelayanan': $('#jns_rujuk').val(),
                'catatan': $('#catatan_rujuk').val(),
                'diagRujukan': $('#kode_diagnosa_rujuk').val(),
                'tipeRujukan': $('#tipe_rujuk').val(),
                'poliRujukan': $('#kode_poli_rujuk').val(),
                'user': "{{ session()->get('pegawai')->nik }}",
            };
            let token = {
                '_token': "{{ csrf_token() }}",
            }
            dataRujukan = Object.assign(data, token)
            $.ajax({
                url: '/erm/bridging/rujukan/insert',
                data: dataRujukan,
                method: 'POST',
                dataType: 'JSON',
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
                success: function(response) {
                    delete data._token;
                    delete data.noSep;
                    delete data.tipeRujukan;
                    detailData = {
                        'nm_ppkDirujuk': $('#ppk_rujuk').val().length ? $('#ppk_rujuk').val() : '-',
                        'nama_diagRujukan': $('#diagnosa_rujuk').val(),
                        'nama_poliRujukan': $('#poli_rujuk').val(),
                    }

                    if (response.metaData.code == "200") {
                        if (response.response != null) {
                            rujukan = {
                                '_token': "{{ csrf_token() }}",
                                'no_sep': $('#no_sep_rujuk').val(),
                                'no_rujukan': response.response.rujukan.noRujukan,
                                'tipeRujukan': $('#tipe_rujuk option:selected').text(),
                            }

                            dataRujukan = Object.assign(data, detailData, rujukan)
                            tarikRujukanKeluar(dataRujukan)
                        } else {
                            tanggal = "{{ date('Y-m-d') }}";
                            no_sep = $('#no_sep_rujuk').val();
                            tanggal = "{{ date('Y-m-d') }}";
                            getListRujukanKeluar(tanggal, tanggal).done(function(response) {
                                $.map(response.response.list, function(val) {
                                    if (no_sep == val.noSep) {
                                        getRujukanKeluar(val.noRujukan).done(function(response) {
                                            rujukan = {
                                                '_token': "{{ csrf_token() }}",
                                                'no_sep': $('#no_sep_rujuk').val(),
                                                'no_rujukan': response.response.rujukan.noRujukan,
                                                'tipeRujukan': $('#tipe_rujuk option:selected').text(),
                                            }
                                            dataRujukan = Object.assign(data, detailData, rujukan)
                                            tarikRujukanKeluar(dataRujukan)
                                        })
                                    }
                                })
                            })
                        }
                    } else {
                        swal.fire(
                            'Peringatan',
                            response.metaData.message,
                            'warning'
                        );
                    }
                }
            })


        }

        function getListRujukanKeluar(tglPertama, tglKedua) {
            let listRujukan = $.ajax({
                url: '/erm/bridging/rujukan/keluar/list/' + tglPertama + '/' + tglKedua,
                method: 'GET',
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },

            });

            return listRujukan;
        }

        function getRujukanKeluar(noRujukan) {
            let rujukanKeluar = $.ajax({
                url: '/erm/bridging/rujukan/keluar/' + noRujukan,
                method: "GET",
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return rujukanKeluar;
        }

        function tarikRujukanKeluar(data) {
            let rujukanKeluar = $.ajax({
                url: '/erm/rujukan/insert',
                data: data,
                method: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    swal.fire(
                        'Berhasil',
                        'Berhasil Membuat Rujukan Keluar',
                        'success'
                    );
                    $('.btn-buat-rujukan').css('display', 'none')
                    if ($('#tb_pasien').length) {
                        reloadTabelPoli();
                    } else {
                        $('#tableSep').DataTable().ajax.reload(null, true);
                    }
                }
            })
        }

        function rujukanKeluar(noSep) {
            $('#modalRujukanKeluar').modal('show')
            cekSep(noSep).done(function(response) {
                $('#no_kartu').val(response.no_kartu)
                $('#no_sep_rujuk').val(response.no_sep)
                $('#no_rawat_rujuk').val(response.no_rawat)
                $('#pasien_rujuk').val(response.reg_periksa.no_rkm_medis + ' - ' + response.nama_pasien)
                $('#tgl_lahir_rujuk').val(splitTanggal(response.tanggal_lahir))
                $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.no_kartu + '\', \'' + response.tglsep + '\')');
                if (response.rujukan_keluar) {
                    $('#ppk_rujuk').attr('disabled', '')
                    $('#poli_rujuk').attr('disabled', '')
                    $('#tipe_rujuk').attr('disabled', '')
                    $('#tgl_kunjungan_rujuk').attr('disabled', '')
                    $('#diagnosa_rujuk').attr('disabled', '')
                    $('#catatan_rujuk').attr('disabled', '')
                    $('.btn-cari').css('display', 'none')
                    $('#ppk_rujuk').val(response.rujukan_keluar.nm_ppkDirujuk)
                    tanggalKontrol = splitTanggal(response.rujukan_keluar.tglRencanaKunjungan);
                    $('#diagnosa_rujuk').val(response.rujukan_keluar.nama_diagRujukan)
                    $('#poli_rujuk').val(response.rujukan_keluar.poliRujukan)
                    $('#catatan_rujuk').val(response.rujukan_keluar.catatan)
                    $('#tipe_rujuk').append('<option selected disable value="x">' + response.rujukan_keluar.tipeRujukan + '</option>')
                    $('.btn-print-rujukan').prop('href', `/erm/rujukan/print/${response.rujukan_keluar.no_rujukan}`).removeClass('d-none')
                    $('.btn-buat-rujukan').addClass('d-none')
                } else {
                    $('#ppk_rujuk').removeAttr('disabled').val('');
                    $('#poli_rujuk').removeAttr('disabled').val('');
                    $('#tipe_rujuk').removeAttr('disabled');
                    $('#tgl_kunjungan_rujuk').removeAttr('disabled');
                    $('#diagnosa_rujuk').removeAttr('disabled').val('');
                    $('#catatan_rujuk').removeAttr('disabled');
                    $('.btn-cari').css('display', '');

                    const rtlCatatan = response.reg_periksa?.rencana_kontrol_ralan?.catatan;
                    if (rtlCatatan && rtlCatatan !== '-') {
                        $('#catatan_rujuk').val(rtlCatatan);
                    } else {
                        $('#catatan_rujuk').val('');
                    }

                    $('.btn-buat-rujukan').removeClass('d-none');
                    $('.btn-print-rujukan').prop('href', `javascript:void(0)`).addClass('d-none');
                }
            })
        }

        function generateRujukanKeluar() {
            tanggal = "{{ date('Y-m-d') }}";
            no_sep = $('#no_sep_rujuk').val();
            tanggal = "{{ date('Y-m-d') }}";
            getListRujukanKeluar(tanggal, tanggal).done(function(response) {
                console.log('RESPONSE ===', response);
                const result = response.response.list.find(val => val.noSep === no_sep);


                getRujukanKeluar(result.noRujukan).done(function(response) {

                    if (response.metaData.code !== "200") {
                        swal.fire(
                            'Peringatan',
                            `Coba lagi ${response.metaData.message}`,
                            'warning'
                        );
                        return;
                    }

                    const result = response.response.rujukan;

                    const dataRujukan = {
                        'no_sep': result.noSep,
                        'tglRujukan': splitTanggal(result.tglRujukan),
                        'tglRencanaKunjungan': splitTanggal(result.tglRujukan),
                        'ppkDirujuk': result.ppkDirujuk,
                        'nm_ppkDirujuk': result.namaPpkDirujuk,
                        'jnsPelayanan': result.jnsPelayanan,
                        'catatan': result.catatan,
                        'diagRujukan': result.diagRujukan,
                        'nama_diagRujukan': result.namaDiagRujukan,
                        'tipeRujukan': result.tipeRujukan,
                        'poliRujukan': result.poliRujukan,
                        'nama_poliRujukan': result.namaPoliRujukan,
                        'no_rujukan': result.noRujukan,
                        'user': "{{ session()->get('pegawai')->nik }}",
                    };
                    Swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    tarikRujukanKeluar(dataRujukan)
                    modalRujukanKeluar.modal('hide')
                })
            })
        }
    </script>
@endpush
