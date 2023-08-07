<div class="modal fade" id="modalRujukanKeluar" tabindex="-1" aria-labelledby="modalSkrj" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:0px">
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
                        <input type="text" class="form-control form-control-sm tgl_kunjungan tanggal" name="tgl_kunjungan_rujuk" onchange="setTanggalKontrol(this)" id="tgl_kunjungan_rujuk" placeholder="">
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
                            <input type="search" class="form-control form-control-sm ppk_rujuk" id="ppk_rujuk" aria-label="PPK Rujukan" aria-describedby="ppk_rujuk" autocomplete="off">
                            <button class="btn btn-secondary btn-sm btn-cari" type="button" style="font-size:12px" onclick="cariFaskes()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="diagnosa_rujuk" class="form-label mb-0" style="font-size:12px;">Diagnosa</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_diagnosa_rujuk" name="kode_diagnosa_rujuk">
                            <input type="search" class="form-control form-control-sm diagnosa_rujuk" id="diagnosa_rujuk" aria-label="Diagnosa Rujukan" aria-describedby="diagnosa_rujuk" autocomplete="off">
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
                        <input type="search" class="form-control form-control-sm catatan_rujuk" id="catatan_rujuk" name="catatan_rujuk" placeholder="" autocomplete="off">
                        <div class="list_catatan"></div>
                    </div>
                    <input type="hidden" name="noka" class="noka">
                    <input type="hidden" name="nokontrol" class="nokontrol">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-buat-rujukan mr-auto" onclick="simpanRujukanKeluar()"><i class="bi bi-envelope-plus-fill"></i> Buat Rujukan Keluar</button>
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
            faskes = $('#ppk_rujuk').val();

            if (faskes.length < 3) {
                swal.fire({
                    title: 'Gagal',
                    text: 'Minimal 3 digit kata kunci FKTP',
                    showConfirmButton: true,
                    icon: 'error',
                });
            } else {
                for (let jenis = 2; jenis >= 1; jenis--) {
                    data = [];
                    no = 2;
                    html = '';
                    $.ajax({
                        url: '/erm/bridging/referensi/faskes/' + faskes + '/' + jenis,
                        dataType: 'JSON',
                        method: 'GET',
                    }).done(function(response) {
                        html = '';
                        html += '<tr>'
                        html += '<td></td>'
                        html += '<td colspan="2">FASKES TINGKAT ' + jenis + ' </td></tr>'
                        no--;
                        if (response.metaData.code == 200 && response.response != null) {
                            urut = 1;
                            $.map(response.response.faskes, function(val) {
                                html += '<tr class="urut" >'
                                html += '<td>' + urut + '</td>'
                                html += '<td><span style="cursor:pointer" class="badge text-bg-primary" onclick="setPpkRujukan(\'' + val.kode + '\', \'' + val.nama + '\')">' + val.kode + '</span></td>'
                                html += '<td>' + val.nama + '</td>'
                                html += '</tr>'
                                urut++;
                            })
                        } else {
                            html += '<tr>'
                            html += '<td></td><td colspan="3" ><strong class="text-danger">' + response.metaData.message + '</strong></td>'
                            html += '</tr>'
                        }
                        $('.table-faskes tbody').append(html);
                        $('#modalFaskes').css('background-color', 'rgba(0,0,0,.25)')
                        $('#modalFaskes').modal('show')

                    })
                }
            }


        }

        function cariDiagnosaRujuk() {
            diagnosa = $('#diagnosa_rujuk').val();
            $.ajax({
                url: '/erm/bridging/referensi/diagnosa/' + diagnosa,
                method: 'GET',
                dataType: 'JSON',
            }).done(function(response) {
                html = '';
                if (response.metaData.code == 200 && response.response != null) {
                    urut = 1;
                    $.map(response.response.diagnosa, function(val) {
                        html += '<tr class="diagnosa' + val.kode + '" >'
                        html += '<td>' + urut + '</td>'
                        html += '<td><span style="cursor:pointer" class="badge text-bg-primary" onclick="setDiagnosa(\'' + val.kode + '\', \'' + val.nama + '\')">' + val.kode + '</span></td>'
                        html += '<td>' + val.nama + '</td>'
                        html += '</tr>'
                        urut++;
                    })
                } else {
                    html += '<tr>'
                    html += '<td colspan="3" ><strong class="text-danger text-center">' + response.metaData.message + '</strong></td>'
                    html += '</tr>'
                }
                $('.table-diagnosa tbody').append(html);
                $('#modalDiagnosa').css('background-color', 'rgba(0,0,0,.25)')
                $('#modalDiagnosa').modal('show')
            })
        }

        function cariPoli() {
            poli = $('#poli_rujuk').val();
            $.ajax({
                url: '/erm/bridging/referensi/poli/' + poli,
                method: 'GET',
                dataType: 'JSON',
            }).done(function(response) {
                html = '';
                if (response.metaData.code == 200 && response.response != null) {
                    urut = 1;
                    $.map(response.response.poli, function(val) {
                        html += '<tr class="poli' + val.kode + '" >'
                        html += '<td>' + urut + '</td>'
                        html += '<td><span style="cursor:pointer" class="badge text-bg-primary" onclick="setPoli(\'' + val.kode + '\', \'' + val.nama + '\')">' + val.kode + '</span></td>'
                        html += '<td>' + val.nama + '</td>'
                        html += '</tr>'
                        urut++;
                    })
                } else {
                    html += '<tr>'
                    html += '<td colspan="3" ><strong class="text-danger text-center">' + response.metaData.message + '</strong></td>'
                    html += '</tr>'
                }
                $('.table-poli tbody').append(html);
                $('#modalPoliRujuk').css('background-color', 'rgba(0,0,0,.25)')
                $('#modalPoliRujuk').modal('show')
            })
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
                        'nm_ppkDirujuk': $('#ppk_rujuk').val(),
                        'nama_diagRujukan': $('#diagnosa_rujuk').val(),
                        'nama_poliRujukan': $('#poli_rujuk').val(),
                    }

                    if (response.metaData.code == 200) {
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

            });

            return listRujukan;
        }

        function getRujukanKeluar(noRujukan) {
            let rujukanKeluar = $.ajax({
                url: '/erm/bridging/rujukan/keluar/' + noRujukan,
                method: "GET",
                dataType: 'JSON',
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
                    reloadTabelPoli();
                }
            })
        }
    </script>
@endpush
