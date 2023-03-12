<div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN S.O.A.P</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-soap">
                    <div class="row">
                        <label for="nomor_rawat" class="col-lg-2 col-sm-12 col-form-label" style="font-size:12px">No.
                            Rawat</label>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="nomor_rawat"
                                name="nomor_rawat" placeholder=""
                                style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="no_rm" name="no_rm"
                                placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-3 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="nama_pasien"
                                name="nama_pasien" placeholder=""
                                style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="p_jawab" name="p_jawab"
                                placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <table class="borderless">
                                <tr>
                                    <td width="20%">Dilakukan Oleh :</td>
                                    <td width="30%">
                                        <input type="text" class="form-control form-control-sm" id="nik"
                                            name="nik" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                                    </td>
                                    <td width="45%" colspan="2">
                                        <input type="text" class="form-control form-control-sm" id="nama"
                                            name="nama" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0" readonly>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Profesi / Jabatan / Departmen : </td>
                                    <td width="30%" colspan="2">
                                        <input type="text" class="form-control form-control-sm" id="jabatan"
                                            name="jabatan" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subjek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Objek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                Suhu (<sup>0</sup>C) : <input type="text"
                                                    class="form-control form-control-sm" id="suhu" name="suhu"
                                                    placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    value="-" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Tinggi (Cm): <input type="text"
                                                    class="form-control form-control-sm" id="tinggi"
                                                    name="tinggi" placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Berat (Kg) : <input type="text"
                                                    class="form-control form-control-sm" id="berat"
                                                    name="berat" placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                Tensi : <input type="text" class="form-control form-control-sm"
                                                    id="tensi" name="tensi" placeholder="" maxlength="8"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Respirasi (/mnt): <input type="text"
                                                    class="form-control form-control-sm" id="respirasi"
                                                    name="respirasi" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Nadi (/mnt) : <input type="text"
                                                    class="form-control form-control-sm" id="nadi"
                                                    name="nadi" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                SpO2 (%): <input type="text" class="form-control form-control-sm"
                                                    id="spo2" name="spo2" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                GCS (E,V,M): <input type="text"
                                                    class="form-control form-control-sm" id="gcs"
                                                    name="gcs" placeholder="" maxlength="10"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Kesadaran :
                                                <select class="form-select" name="kesadaran" id="kesadaran"
                                                    style="font-size:12px;min-height:12px;border-radius:0;>">
                                                    <option value="Compos Mentis">Compos Mentis</option>
                                                    <option value="Somnolence">Somnolence</option>
                                                    <option value="Sopor">Sopor</option>
                                                    <option value="Coma">Coma</option>
                                                </select>
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <table class="borderless">
                                <tr>
                                    <td width="5%">Alergi :</td>
                                    <td width="20%">
                                        <input type="text" class="form-control form-control-sm" id="alergi"
                                            name="alergi" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;width:150px"
                                            onfocus="removeZero(this)" onblur="cekKosong(this)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asesmen : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plan : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="plan" id="plan" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instruksi : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. Resep : </td>
                                    <td colspan="3">
                                        <input type="text" class="no_resep form-control form-control-sm"
                                            readonly />
                                    </td>
                                </tr>
                            </table>
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="umum">
                                    <table class="table table-stripped table-responsive" id="tb-resep"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Aturan Pakai</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-sm" type="button"
                                        onclick="tambahUmum()">Tambah
                                        Resep</button>
                                </div>
                                <div class="tab-pane fade" id="racikan">
                                    <table class="table table-stripped table-responsive" id="tb-resep-racikan"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Racikan</th>
                                                <th>Metode Racikan</th>
                                                <th>Jumlah Racik</th>
                                                <th>Aturan Pakai</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-sm" type="button"
                                        onclick="tambahRacikan()">Tambah
                                        Racikan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i
                        class="bi bi-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function cariObat(obat) {
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value,
                },
                success: function(response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response.data, function(data) {
                        if (data.status != "0") {
                            html +=
                                '<li><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                data.nama_brng + '</a></li>'
                        }
                    })
                    html += '</ul>';
                    $('#list_obat').fadeIn();
                    $('#list_obat').html(html);
                }
            })
        }

        function cariAturan(aturan) {
            $.ajax({
                url: '/erm/resep/cari',
                data: {
                    'aturan_pakai': aturan.value,
                },
                success: function(response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response, function(data) {
                        html +=
                            '<li><a class="dropdown-item" href="#" style="overflow:hidden">' +
                            data.aturan_pakai + '</a></li>'
                    })
                    html += '</ul>';
                    $('#list_aturan').fadeIn();
                    $('#list_aturan').html(html);
                }
            })
        }
        $('#list_obat').on('click', 'li', function() {
            $('.nama_obat').val($(this).text());
            $('#list_obat').fadeOut();
        });
        $('#list_aturan').on('click', 'li', function() {
            $('.aturan_pakai').val($(this).text());
            $('#list_aturan').fadeOut();
        });

        $(document).click(function() {
            $('#list_obat').fadeOut();
            $('#list_aturan').fadeOut();
        });

        function pilihObat() {

        }
        var no = 1;

        // function tambahUmum() {
        //     html = '<tr>';
        //     html += '<td>';
        //     html += no;
        //     html += '</td>';
        //     html += '<td>';
        //     html +=
        //         '<input type="search" onkeyup="cariObat(this)" autocomplete="off" class="form-control form-control-sm form-underline nama_obat" name="nama_obat[]"/>';

        //     html += '</td><span id="list_obat"></span>';
        //     html += '<td>';
        //     html +=
        //         '<input type="text" onkeypress="return hanyaAngka(event)" class="form-control form-control-sm form-underline" id="jumlah" name="jumlah[]" />';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="search" class="form-control form-control-sm form-underline" name="aturan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<input type="text" class="form-control form-control-sm form-underline" name="keterangan[]"/>';
        //     html += '</td>';
        //     html += '<td>';
        //     html += '<button class="btn btn-danger btn-sm" style="font-size:12px">x</button>';
        //     html += '</td>';
        //     html += '</tr>';
        //     $('#tb-resep').append(html);
        //     no++;
        // }
        function tambahUmum() {
            $('#modalResepUmum').modal('show');
        }

        function tambahRacikan() {
            html = '<tr>';
            html += '<td onclick="aktifTeks(this)">';
            html +=
                '<input type="text" class="form-control form-control-sm id="nama_racik" name="nama_racik[]"/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<select class="form-select" name="kd_racik[]" style="font-size:12px;min-height:12px;border-radius:0;">';
            html += '<option value="R01">Puyer</option>'
            html += '<option value="R02">Sirup</option>'
            html += '<option value="R03">Salep</option>'
            html += '<option value="R04">Kapsul</option>'
            html += '<option value="R05">TABLET/KAPSUL/KAPLET</option>'
            html += '<option value="R06">Sachet</option>'
            html += '<option value="R07">Tablet</option>'
            html += '<option value="R08">Injeksi</option>'
            html +=
                '</select>';
            html += '</td>';
            html += '<td>';
            html += '<input type="number" class="form-control form-control-sm" name="jml_dr[]"/>';
            html += '</td>';
            html += '<td>';
            html += '<input type="text" class="form-control form-control-sm" name="aturan[]"/>';
            html += '</td>';
            html += '<td>';
            html += '<input type="text" class="form-control form-control-sm" name="keterangan[]"/>';
            html += '</td>';
            html += '<td>';
            html += '<button class="btn btn-danger btn-sm" style="font-size:12px">x</button>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep-racikan').append(html);
        }

        function setNoResep() {
            let tanggal = "{{ date('Y-m-d') }}";
            $.ajax({
                url: '/erm/resep/obat/akhir',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'tgl_peresepan': tanggal
                },
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        nomor = parseInt(response.no_resep) + 1
                    } else {
                        nomor = "{{ date('Ymd') }}" + '0001';
                    }
                    $('.no_resep').val(nomor)
                }
            })

        }
        $('#modalSoap').on('shown.bs.modal', function() {
            setNoResep();
            modalsoap(id);
            no = 1;
            isModalShow = true;
        });

        $('#modalSoap').on('hidden.bs.modal', function() {
            $('#tb-resep tbody').empty();
            $('#tb-resep-racikan tbody').empty();
            isModalShow = false;
            $('#nomor_rawat').val('-');
            $('#p_jawab').val('-');
            $('#no_rm').val('-');
            $('#nama_pasien').val('-');
            $('#nama').val('-');
            $('#nik').val('-');
            $('#jabatan').val('-');
            $('#nomor_rawat').val('-');
            $('#tgl_perawatan').val('-');
            $('#subjek').val('-');
            $('#objek').val('-');
            $('#asesmen').val('-');
            $('#plan').val('-');
            $('#instruksi').val('-');
            $('#suhu').val('-');
            $('#tensi').val('-');
            $('#tinggi').val('-');
            $('#berat').val('-');
            $('#gcs').val('-');
            $('#respirasi').val('-');
            $('#alergi').val('-')
            $('#nadi').val('-');
            $('#spo2').val('-');
        });

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }
    </script>
@endpush
