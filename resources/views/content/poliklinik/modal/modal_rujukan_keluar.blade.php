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
                        <input type="text" class="form-control form-control-sm tgl_surat_rujuk" id="tgl_surat_rujuk" name="tgl_surat_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tgl_kontrol" class="form-label mb-0" style="font-size:12px;">Tgl. R. Kunjungan</label>
                        <input type="text" class="form-control form-control-sm tgl_kunjungan tanggal" name="tgl_kunjungan_rujuk" onchange="setTanggalKontrol(this)" id="tgl_kunjungan_rujuk" placeholder="">
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="no_sep_rujuk" class="form-label mb-0" style="font-size:12px;">No. SEP</label>
                        <input type="text" class="form-control form-control-sm no_sep_rujuk" id="no_sep_rujuk" name="no_sep_rujuk" placeholder="" readonly style="background-color: #f0f0f0;cursor:not-allowed">
                    </div>
                    <input type="hidden" value="2" id="jns_rujuk">
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="tipe_rujuk" class="form-label mb-0" style="font-size:12px;">Tipe Rujukan</label>
                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipe_rujuk" id="tipe_rujuk" style="font-size:12px">
                            <option selected disabled value="">Pilih Jenis Rujukan</option>
                            <option value="0">Penuh</option>
                            <option value="1">Parsial</option>
                            <option value="2">Rujuk Balik</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="ppj_rujuk" class="form-label mb-0" style="font-size:12px;">PPK Rujukan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_ppk" name="kode_ppk">
                            <input type="search" class="form-control form-control-sm ppk_rujuk" id="ppk_rujuk" aria-label="PPK Rujukan" aria-describedby="ppk_rujuk">
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px" onclick="cariFaskes()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 gy-3">
                        <label for="diagnosa_rujuk" class="form-label mb-0" style="font-size:12px;">Diagnosa</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_diagnosa_rujuk" name="kode_diagnosa_rujuk">
                            <input type="search" class="form-control form-control-sm diagnosa_rujuk" id="diagnosa_rujuk" aria-label="Diagnosa Rujukan" aria-describedby="diagnosa_rujuk">
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px" onclick="cariDiagnosaRujuk()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="poli_rujuk" class="form-label mb-0" style="font-size:12px;">Poli Tujuan</label>
                        <div class="input-group mb-3">
                            <input type="hidden" id="kode_poli_rujuk" name="kode_poli_rujuk">
                            <input type="text" class="form-control form-control-sm poli_rujuk" id="poli_rujuk" aria-label="Poliklinik Tujuan" aria-describedby="poli_rujuk">
                            <button class="btn btn-secondary btn-sm" type="button" style="font-size:12px" onclick="cariPoli()"><i class="bi bi-paperclip"></i></button>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="catatan_rujuk" class="form-label mb-0" style="font-size:12px;">Catatan</label>
                        <input type="search" class="form-control form-control-sm catatan_rujuk" id="catatan_rujuk" name="catatan_rujuk" placeholder="">
                        <div class="list_catatan"></div>
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
            dateStart = parseInt(hari) + 1 + '-' + bulan + '-' + tahun;
            let tanggal = tanggalKontrol ? tanggalKontrol : dateStart;
            $('#tgl_kunjungan_rujuk').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
            });

            console.log(tanggal)
            $('#tgl_surat_rujuk').val(splitTanggal("{{ date('Y-m-d') }}"));
            $('#tgl_kunjungan_rujuk').datepicker('setDate', tanggal)
        })
        $('#tipe_rujuk').on('change', function(evt) {
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

        function cariFaskes() {
            $('#modalFaskes').modal('show')
            faskes = $('#ppk_rujuk').val();
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
                    console.log(response)
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

                })
            }
        }

        function cariDiagnosaRujuk() {
            $('#modalDiagnosa').modal('show')
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
            })
        }

        function cariPoli() {
            $('#modalPoliRujuk').modal('show')
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
            console.log(obj)
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
            data = {
                '_token': "{{ csrf_token() }}",
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

            $.ajax({
                url: '/erm/bridging/rujukan/insert',
                data: data,
                method: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if (response.metaData.code == 200) {
                        console.log(response);
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
    </script>
@endpush
