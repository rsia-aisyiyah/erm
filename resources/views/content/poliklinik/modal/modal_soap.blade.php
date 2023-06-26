<div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN & RESEP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-soap">
                    <div class="row">
                        <label for="nomor_rawat" class="col-lg-2 col-sm-12 col-form-label" style="font-size:12px">No.
                            Rawat</label>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="nomor_rawat" name="nomor_rawat" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="no_rm" name="no_rm" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-3 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nama_pasien" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                        <div class="col-lg-2 col-sm-12 mb-2">
                            <input type="text" class="form-control form-control-sm" id="p_jawab" name="p_jawab" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                        </div>
                    </div>
                    <hr style="margin:2px">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <table class="borderless">
                                <tr>
                                    <td width="20%">Dilakukan Oleh :</td>
                                    <td width="30%" colspan="2">
                                        <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                                    </td>
                                    <td width="45%" colspan="2">
                                        <input type="search" class="form-control form-control-sm" id="nama" name="nama" placeholder="" style="font-size:12px;min-height:12px;border-radius:0" onkeyup="cariPetugas(this)" autocomplete="off">
                                        <div class="list_petugas"></div>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Subjek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="4" style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)" onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Objek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="4" style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)" onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <tr>

                                                <td width="12%">
                                                    Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm" id="suhu" name="suhu" placeholder="" maxlength="5" style="font-size:12px;min-height:12px;border-radius:0;" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi" name="tinggi" placeholder="" maxlength="5" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat" name="berat" placeholder="" maxlength="5" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    Tensi : <input type="text" class="form-control form-control-sm" id="tensi" name="tensi" placeholder="" maxlength="8" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    Respirasi (/mnt): <input type="text" class="form-control form-control-sm" id="respirasi" name="respirasi" placeholder="" maxlength="3" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="12%">
                                                    Nadi (/mnt) : <input type="text" class="form-control form-control-sm" id="nadi" name="nadi" placeholder="" maxlength="3" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2" name="spo2" placeholder="" maxlength="3" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    GCS (E,V,M): <input type="text" class="form-control form-control-sm" id="gcs" name="gcs" placeholder="" maxlength="10" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                                <td width="12%">
                                                    Kesadaran :
                                                    <select class="form-select" name="kesadaran" id="kesadaran" style="font-size:12px;min-height:12px;border-radius:0;">
                                                        <option value="Compos Mentis">Compos Mentis</option>
                                                        <option value="Somnolence">Somnolence</option>
                                                        <option value="Sopor">Sopor</option>
                                                        <option value="Coma">Coma</option>
                                                    </select>
                                                </td>
                                                <td width="12%">
                                                    Alergi :
                                                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="" style="font-size:12px;min-height:12px;border-radius:0;" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asesmen : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="4" style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)" onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Instruksi : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="4" style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)" onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <table class="borderless mb-6" width="100%">
                                <tr>
                                    <td>Plan : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="plan" id="plan" cols="30" rows="8" style="font-size:12px;min-height:12px;border-radius:0;resize:none" readonly></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diagnosa ICD</td>
                                    <td colspan="3">
                                        <input type="search" class="form-control form-control-sm" onkeyup="cariDiagnosa(this)" name="diagnosa" id="diagnosa" style="font-size:12px;min-height:12px;border-radius:0" autocomplete="off">
                                        <div class="list-diagnosa"></div>
                                        <input type="hidden" class="no_diagnosa" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Prosedur</td>
                                    <td colspan="3">
                                        <input type="search" class="form-control form-control-sm" onkeyup="cariProsedur(this)" name="prosedur" id="prosedur" style="font-size:12px;min-height:12px;border-radius:0" autocomplete="off">
                                        <div class="list-prosedur"></div>
                                        <input type="hidden" class="no_prosedur" value="" />
                                    </td>
                                </tr>
                                <tr>
                                    <table class="table table-stripped table-diagnosa" style="margin-bottom: 30px;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th width="25%">Kode ICD</th>
                                                <th width="60%">Deskripsi</th>
                                                <th width="15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </tr>
                                <tr>
                                    <table class="table table-stripped table-prosedur" style="margin-bottom: 30px;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th width="25%">Kode Prosedur</th>
                                                <th width="60%">Deskripsi</th>
                                                <th width="15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </tr>
                            </table>


                            <input type="hidden" class="no_resep form-control form-control-sm" />
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="nav-item">
                                    <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="umum">
                                    <table class="table table-stripped table-responsive" id="tb-resep" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="18%">No. Resep</th>
                                                <th>Nama Obat</th>
                                                <th width="10%">Jumlah</th>
                                                <th>Aturan Pakai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_umum">

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-sm tambah_umum" type="button" onclick="tambahUmum()">Tambah
                                        Obat</button>
                                    <button class="btn btn-success btn-sm btn_simpan_resep" type="button" style="visibility: hidden">Simpan
                                        Resep</button>
                                </div>
                                <div class="tab-pane fade" id="racikan">
                                    <table class="table table-responsive" id="tb-resep-racikan" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">No Racik</th>
                                                <th>No Resep</th>
                                                <th>Nama Racikan</th>
                                                <th>Metode Racikan</th>
                                                <th width="10%">Jumlah</th>
                                                <th>Aturan Pakai</th>

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_racikan">

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-sm tambah_racik" type="button" onclick="tambahRacikan()">Tambah
                                        Racikan</button>
                                </div>
                                <div class="tab-pane fade" id="riwayat">
                                    <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>No Resep</th>
                                                <th>Obat/Racikan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_riwayat" class="align-top">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i class="bi bi-save"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function hapusBaris(param) {
            console.log($(this).parent().remove())
        }

        function setNoRacik(no_resep) {
            let no_racik = '';
            $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                async: false,
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    if (Object.keys(response).length >= 1) {
                        $.map(response, function(data) {
                            no = data.no_racik
                        })
                        no_racik = parseInt(no) + 1;
                    } else {
                        no_racik = 1
                    }

                }
            })
            return no_racik;


        }

        function copyResep(resep) {
            resep = ambilResep(resep);
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda mengcopy resep ini",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    let dataResep;
                    let dataObat;
                    let dataRacikan;
                    let no_resep = setNoResep();
                    let no_rawat = $('#nomor_rawat').val();
                    let no_racik = setNoRacik(no_resep)
                    $.map(resep, function(resep) {
                        if (Object.keys(ambilResep(no_resep)).length == 0) {
                            $.ajax({
                                url: '/erm/resep/obat/simpan',
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'no_resep': no_resep,
                                    'no_rawat': no_rawat,
                                    'kd_dokter': "{{ Request::get('dokter') }}",
                                },
                                method: 'POST',
                                success: function(response) {

                                }
                            })
                        }

                        if (Object.keys(resep.resep_racikan).length > 0) {
                            $.map(resep.resep_racikan, function(racik) {
                                $.ajax({
                                    url: '/erm/resep/racik/simpan',
                                    method: 'POST',
                                    data: {
                                        '_token': "{{ csrf_token() }}",
                                        'no_resep': no_resep,
                                        'no_racik': no_racik,
                                        'nama_racik': racik.nama_racik,
                                        'kd_racik': racik.kd_racik,
                                        'jml_dr': racik.jml_dr,
                                        'aturan_pakai': racik.aturan_pakai,
                                        'keterangan': racik.keterangan,
                                    },
                                    success: function(response) {
                                        $.map(racik.detail_racikan, function(racikan) {
                                            $.ajax({
                                                url: '/erm/resep/racik/detail/simpan',
                                                method: 'POST',
                                                data: {
                                                    '_token': '{{ csrf_token() }}',
                                                    'no_resep': no_resep,
                                                    'no_racik': no_racik,
                                                    'kode_brng': racikan.kode_brng,
                                                    'p1': racikan.p1,
                                                    'p2': racikan.p2,
                                                    'jml': racikan.jml,
                                                    'kandungan': racikan.kandungan,
                                                },
                                                success: function(response) {

                                                }
                                            })
                                        })
                                    }
                                })
                            })
                            cekResep(no_rawat)
                            riwayatResep($('#no_rm').val())
                            tulisPlan();
                        }
                        if (Object.keys(resep.resep_dokter).length > 0) {
                            $.map(resep.resep_dokter, function(rd) {
                                $.ajax({
                                    url: '/erm/resep/umum/simpan',
                                    method: 'POST',
                                    data: {
                                        '_token': '{{ csrf_token() }}',
                                        'no_resep': no_resep,
                                        'kode_brng': rd.kode_brng,
                                        'aturan_pakai': rd.aturan_pakai,
                                        'jml': rd.jml,
                                    },
                                    success: function(response) {

                                    }
                                })
                            })
                            $('#tb-resep-riwayat tbody').empty()
                            cekResep(no_rawat)
                            riwayatResep($('#no_rm').val())
                            tulisPlan();
                        }
                    });

                }

            })
        }

        function simpanObat() {
            no_resep = $('.no_resep').val()
            kode_obat = $('.kode_obat').val()
            jml = $('.jml').val()
            aturan_pakai = $('.aturan_pakai').val()
            if (kode_obat && jml && aturan_pakai) {
                $.ajax({
                    url: '/erm/resep/umum/simpan',
                    method: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'no_resep': no_resep,
                        'kode_brng': kode_obat,
                        'jml': jml,
                        'aturan_pakai': aturan_pakai,
                    },
                    success: function(response) {

                        cekResep($('#nomor_rawat').val())
                        tulisPlan()
                    },
                    error: function(request, status, error) {
                        Swal.fire(
                            'Gagal !',
                            'Obat tidak tersimpan<br/>' + request.responseJSON.message,
                            'error',
                        )

                    }
                }).done(function() {
                    tulisPlan()
                })
            } else {

                textObat = kode_obat ? '' : '<b class="text-danger" >Obat, </b>';
                textJml = jml ? '' : '<b class="text-danger"> Jumlah, </b>';
                textAturan = aturan_pakai ? '' : '<b class="text-danger"> Aturan Pakai</b>';
                Swal.fire(
                    'Gagal !',
                    'Kolom ' + textObat + textJml + textAturan + ' tidak boleh kosong',
                    'error'
                )
            }

        }


        $('#simpanObat').on('click', function() {
            $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    'no_resep': $('.no_resep').val(),
                },
                success: function(response) {
                    if (Object.keys(response).length == 0) {
                        simpanResepObat()
                    }
                    $.ajax({
                        url: '/erm/resep/umum/simpan',
                        method: 'POST',
                        data: {
                            '_token': "{{ csrf_token() }}",
                            'no_resep': $('.no_resep').val(),
                            'kode_brng': $('.kode_obat').val(),
                            'jml': $('.jml').val(),
                            'aturan_pakai': $('.aturan_pakai').val() + ' ' + $(
                                    '.keterangan')
                                .val(),
                        },
                        success: function(response) {
                            cekResep(id)
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal !',
                                'Obat tidak tersimpan',
                                'error'
                            )
                        }
                    })
                }
            })
        });


        function simpanResepObat() {

            kd_dokter = "{{ Request::get('dokter') }}";
            dokter = kd_dokter ? kd_dokter : $('#nik').val();

            $.ajax({
                url: '/erm/resep/obat/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    kd_dokter: dokter,
                    no_rawat: $('#nomor_rawat').val(),
                    no_resep: $('.no_resep').val(),
                },
                method: 'POST',
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa menambah resep<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            });
        }

        function ambilRacikan(no_resep, no_racik) {
            hasil = '';
            $.ajax({
                async: false,
                url: '/erm/resep/racik/ambil',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
                success: function(response) {
                    hasil = response;
                },
            })
            return hasil;
        }

        function ambilResep(no_resep) {
            hasil = '';
            $.ajax({
                async: false,
                url: '/erm/resep/obat/ambil',
                data: {
                    no_resep: no_resep,
                },
                success: function(response) {
                    hasil = response;
                },
            })
            return hasil;
        }

        function tulisPlan() {
            no_rawat = $('#nomor_rawat').val();
            $.ajax({
                url: '/erm/resep/obat/ambil',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    teksRd = '';
                    teksRr = '';
                    $.map(response, function(res) {
                        $.map(res.resep_dokter, function(rd) {
                            teksRd += rd.data_barang.nama_brng + ' ' + rd.jml + ' ' + rd
                                .aturan_pakai + '\n';
                        })

                        $.map(res.resep_racikan, function(rr) {
                            teksRr += rr.metode.nm_racik + ' ' + rr.nama_racik +
                                ' ' + rr
                                .aturan_pakai + '\n' + 'Isi : '
                            $.map(rr.detail_racikan, function(dr) {
                                // console.log('Detail Racikan', rr);
                                if (rr.no_racik == dr.no_racik) {
                                    teksRr += dr.databarang.nama_brng +
                                        ' ' +
                                        dr.kandungan + ' mg' + ', ';
                                }
                            })
                            teksRr += '\n';
                        })

                    })
                    $('#plan').val(teksRd + '\n' + teksRr);
                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak tertulis di PLAN<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            })
        }

        function hitungJumlahObat(kps, p1, p2, jumlah) {
            jumlah = $('.jml_dr').val();
            kandungan = parseFloat(kps) * (parseFloat(p1) / parseFloat(p2));
            jml_obat = (parseFloat(kandungan) * parseFloat(jumlah)) / parseFloat(kps)
            return parseFloat(jml_obat).toFixed(2);
        }

        function ambilObatRacikan() {
            $('.table-racikan tbody').empty();
            no_resep = $('.no_resep').val();
            no_racik = $('.no_racik').val();
            $.ajax({
                url: '/erm/resep/racik/detail/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: no_resep,
                    no_racik: no_racik,
                },
                success: function(response, status, detail) {
                    html = '';
                    no = 1;
                    $.map(response, function(res) {

                        kandungan = res.kandungan != 0 ? res.kandungan : res.data_barang.kapasitas;

                        html += '<tr class="">'
                        html +=
                            '<td><input type="hidden" id="kode_brng' + no + '" value="' +
                            res
                            .kode_brng +
                            '" name="kode_brng[]"/>' + res.data_barang.nama_brng + '</td>'
                        html +=
                            '<td><input type="hidden" id="kps' + no +
                            '" name="kps[]" value="' +
                            res.data_barang.kapasitas +
                            '"/>' + res.data_barang.kapasitas + ' mg </td>'
                        html +=
                            '<td><input type="search" class="form-control form-control-sm form-underline" id="p1' +
                            no +
                            '" name="p1[]" value="' +
                            res.p1 +
                            '" onfocusout="hitungObatRacik(' + no + ')"/></td>'
                        html += '<td>/</td>'
                        html +=
                            '<td><input type="search" class="form-control form-control-sm form-underline" id="p2' +
                            no +
                            '"name="p2[]" onfocusout="hitungObatRacik(' + no +
                            ')" value="' + res.p2 + '"/></td>'
                        html +=
                            '<td><input type="search" class="form-control form-control-sm form-underline" id="kandungan' +
                            no +
                            '" name="kandungan[]" onkeypress="return hanyaAngka(event)" value="' + kandungan + '" onchange="hitungDosis(' + no + ')"/></td>'
                        html += '<td>mg</td>'
                        html +=
                            '<td><input type="search" class="form-control form-control-sm form-underline" id="jml_obat' +
                            no +
                            '" name="jml[]" value="' + hitungJumlahObat(res.data_barang.kapasitas, res.p1, res.p2) + '" readonly/></td>'
                        html +=
                            '<td><button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-resep="' +
                            res.no_resep + '" data-racik="' +
                            res.no_racik +
                            '" data-obat="' + res.kode_brng +
                            '" onclick="hapusObat(this)"><i class="bi bi-trash-fill"></i></button></td>'
                        html += '</tr>'
                        no++
                    });
                    $('.table-racikan tbody').append(html);
                    $('.nomor').val(no)
                },
            })
        }

        function editObat(param) {
            kode_obat = $(param).data('barang');
            kps = $(param).data('kps');
            obat = $(param).data('obat');

            $('.simpan-obat').css('display', 'none');
            $('.ubah-obat').css('display', '');
            $('.obat-baru').css('display', '');

            $('.kandungan').val(0);
            $('.jml_obat').val(0);
            $('.kps').val(kps);
            $('.kode_obat').val(kode_obat);
            $('.nama_obat').val(obat);
            $('.p1').val(1);
            $('.p2').val(1);
        }

        $('.ubah-obat').on('click', function() {
            no_racik = $('.no_racik').val();
            no_resep = $('.no_resep').val();
            kode_brng = $('.kode_obat').val();
            p1 = $('.p1').val();
            p2 = $('.p2').val();
            kandungan = $('.kandungan').val();
            jml = $('.jml_obat').val();

            $.ajax({
                url: '/erm/resep/racik/detail/ubah',
                data: {
                    _token: '{{ csrf_token() }}',
                    kode_brng: kode_brng,
                    no_racik: no_racik,
                    no_resep: no_resep,
                    p1: p1,
                    p2: p2,
                    kandungan: kandungan,
                    jml: jml,
                },
                method: 'POST',
                success: function(response) {
                    ambilObatRacikan();
                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa mengubah obat<br/>' + request.responseJSON.message,
                        'error',
                    )
                }
            }).done(function() {
                tulisPlan();
            })
        })




        $('.obat-baru').on('click', function() {
            $('.simpan-obat').css('display', '');
            $('.ubah-obat').css('display', 'none');
            $('.obat-baru').css('display', 'none');

            $('.kandungan').val('');
            $('.jml_obat').val('');
            $('.kps').val('');
            $('.kode_obat').val('');
            $('.nama_obat').val('');
            $('.p1').val('');
            $('.p2').val('');

            $('.nama_obat').focus();

        })

        function hapusObat(param) {
            no_resep = $(param).data('resep');
            no_racik = $(param).data('racik');
            kode_brng = $(param).data('obat');
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/resep/racik/detail/hapus',
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_resep: no_resep,
                            no_racik: no_racik,
                            kode_brng: kode_brng,
                        },
                        success: function() {
                            ambilObatRacikan();
                            cekResep(id);
                        },
                        error: function(request, status, error) {
                            Swal.fire(
                                'Gagal !',
                                'Tidak menghapus obat<br/>' + request.responseJSON
                                .message,
                                'error',
                            )

                        }
                    }).done(function() {
                        tulisPlan();
                    })
                }
            })
        }

        $('tbody').on('click', '.edit', function() {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).data('racik');
            // console.log('noracik', no_racik)
            $('#modalObatRacik').modal('show');
            racikan = ambilRacikan(no_resep, no_racik)
            $('.no_resep').val(racikan.no_resep);
            $('.metode').val(racikan.metode.nm_racik);
            $('.nm_racik').val(racikan.nama_racik);
            $('.no_racik').val(no_racik);
            $('.jml_dr').val(racikan.jml_dr);
            $('.aturan_pakai_dr').val(racikan.aturan_pakai);
            ambilObatRacikan();
        })

        $('#modalObatRacik').on('shown.bs.modal', function() {
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.kandungan').val('');
            $('.kandungan').val('');
        });
        $('#modalObatRacik').on('hidden.bs.modal', function() {
            $('.no_racik').val('');
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.nama_obat').val('');
            $('.kandungan').val('');
        });

        $('tbody').on('click', '.hapus-baris', function() {
            cekResep(id)
            return false;
        })

        $('tbody').on('click', '.remove', function() {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).attr('data-racik');
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Jangan',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (no_racik) {
                        $.ajax({
                            url: '/erm/resep/racik/detail/hapus',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_resep: no_resep,
                                no_racik: no_racik,
                            },
                            method: 'DELETE',
                            success: function(response) {
                                $.ajax({
                                    url: '/erm/resep/racik/hapus',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        no_resep: no_resep,
                                        no_racik: no_racik,
                                    },
                                    method: 'DELETE',
                                })
                                $('#body_racik').empty();
                                cekResep($('#nomor_rawat').val());
                                riwayatResep($('#no_rm').val());
                            },
                            error: function(request, status, error) {
                                Swal.fire(
                                    'Gagal !',
                                    'Obat tidak terhapus',
                                    'error'
                                );
                            }
                        }).done(function() {
                            tulisPlan();
                            riwayatResep($('#no_rm').val());
                        })
                    } else {
                        $.ajax({
                            url: '/erm/resep/umum/hapus',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_resep: no_resep,
                                kode_brng: kode_brng,
                            },
                            method: 'DELETE',
                            success: function(response) {
                                $('#body_umum').empty();
                                cekResep($('#nomor_rawat').val())
                            }
                        }).done(function() {
                            tulisPlan();
                            riwayatResep($('#no_rm').val());
                        })
                    }
                }
            })
            return false;
        })

        function cariDiagnosa(diagnosa) {
            $.ajax({
                url: '/erm/penyakit/cari',
                data: {
                    'kd_penyakit': diagnosa.value,
                },
                dataType: 'JSON',
                success: function(response) {

                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    no = 1;
                    $.map(response, function(data) {
                        html +=
                            '<li data-nama="' + data.nm_penyakit + '" data-id="' + data.kd_penyakit + '" onclick="tambahDiagnosa(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kd_penyakit + ' - ' + data.nm_penyakit + '</a></li>'
                        no++;
                    })
                    html += '</ul>';
                    $('.list-diagnosa').fadeIn();
                    $('.list-diagnosa').html(html);


                }
            })
        }

        function cariProsedur(kode) {
            $.ajax({
                url: '/erm/prosedur/cari',
                data: {
                    'kode': kode.value,
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    no = 1;
                    $.map(response, function(data) {
                        html +=
                            '<li data-nama="' + data.deskripsi_pendek + '" data-id="' + data.kode + '" onclick="tambahProsedur(this)"><a class="dropdown-item" href="#" style="overflow:hidden"> ' + data.kode + ' - ' + data.deskripsi_pendek + '</a></li>'
                        no++;
                    })
                    html += '</ul>';
                    $('.list-prosedur').fadeIn();
                    $('.list-prosedur').html(html);


                }
            })
        }

        function tambahDiagnosa(param) {
            no_rawat = $('#nomor_rawat').val();
            kd_penyakit = $(param).data('id');
            prioritas = $('.no_diagnosa').val()

            $.ajax({
                url: '/erm/penyakit/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function(response) {
                    ambilDiagnosaPasien(no_rawat)
                    $('#diagnosa').val('').focus();
                }
            })

        }

        function tambahProsedur(param) {
            no_rawat = $('#nomor_rawat').val();
            kode = $(param).data('id');
            prioritas = $('.no_prosedur').val()

            $.ajax({
                url: '/erm/prosedur/pasien/tambah',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                    status: "Ralan",
                    prioritas: prioritas,
                },
                method: 'POST',
                success: function(response) {
                    ambilProsedurPasien(no_rawat)
                    $('#prosedur').val('').focus();
                }
            })

        }

        function ambilDiagnosaPasien(no_rawat) {
            $.ajax({
                url: '/erm/penyakit/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    nomor = 1;
                    $('.table-diagnosa tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            html = '<tr class="diagnosa_' + res.kd_penyakit + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kd_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += res.penyakit.nm_penyakit
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusDiagnosaPasien(\'' + no_rawat + '\', \'' + res.kd_penyakit + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-diagnosa tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada diagnosa</td>'
                        html += '</tr>'
                        $('.table-diagnosa tbody').append(html)

                    }
                    $('.no_diagnosa').val(nomor)
                }
            })
        }

        function ambilProsedurPasien(no_rawat) {
            $.ajax({
                url: '/erm/prosedur/pasien/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    nomor = 1;
                    $('.table-prosedur tbody').empty();
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            html = '<tr class="prosedur_' + res.kode + '">'
                            html += '<td>'
                            html += res.prioritas
                            html += '</td>'
                            html += '<td>'
                            html += res.kode
                            html += '</td>'
                            html += '<td>'
                            html += res.icd9.deskripsi_pendek
                            html += '</td>'
                            html += '<td>'
                            html += '<button type="button" class="btn btn-danger btn-sm" style="font-size:12px" onclick="hapusProsedurPasien(\'' + no_rawat + '\', \'' + res.kode + '\')"><i class="bi bi-trash-fill"></i></button>'
                            html += '</td>'
                            html += '</tr>'
                            nomor = res.prioritas + 1;
                            $('.table-prosedur tbody').append(html)
                        })
                    } else {
                        html = '<tr>'
                        html += '<td colspan="4" style="text-align:center">Tidak ada prosedur</td>'
                        html += '</tr>'
                        $('.table-prosedur tbody').append(html)

                    }
                    $('.no_prosedur').val(nomor)
                }
            })
        }

        function hapusProsedurPasien(no_rawat, kode) {
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/prosedur/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                },
                method: 'DELETE',
                success: function(response) {

                    $('.no_prosedur').val(parseInt(no) - 1)
                    ambilProsedurPasien(no_rawat)
                }
            })
        }

        function hapusDiagnosaPasien(no_rawat, kd_penyakit) {
            // console.log(no_rawat)
            no = $('.no_diagnosa').val();
            $.ajax({
                url: '/erm/penyakit/pasien/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                },
                method: 'DELETE',
                success: function(response) {

                    $('.no_diagnosa').val(parseInt(no) - 1)
                    ambilDiagnosaPasien(no_rawat)
                }
            })
        }

        function cariRacikan(racik) {
            $.ajax({
                url: '/erm/resep/racik/cari',
                data: {
                    'nm_racik': racik.value,
                    'kd_dokter': "{{ Request::get('dokter') }}",
                },
                dataType: 'JSON',
                success: function(response) {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response, function(data) {
                        html +=
                            '<li onclick="setNamaRacik(this)" data-nama="' + data.nm_racik + '" data-id="' + data.id + '"><a class="dropdown-item" href="#" style="overflow:hidden">' + data.nm_racik + '</a></li>'
                    })
                    html += '</ul>';
                    $('.list_racik').fadeIn();
                    $('.list_racik').html(html);

                }
            })
        }

        $('.list_racik').on('click', 'li', function() {
            $('.list_racik').fadeOut();
        })

        function setNamaRacik(racik) {
            nama_racik = $(racik).data('nama');
            id_racik = $(racik).data('id');
            $('.nm_racik').val(nama_racik);
            $('.id_racik').val(id_racik);
        }

        function cariObat(obat) {
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value,
                },
                success: function(response) {
                    // console.log(response)
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response.data, function(data) {
                        $.map(data.gudang_barang, function(item) {
                            if (data) {
                                if (data.status != "0") {
                                    if (item.stok != "0") {
                                        html +=
                                            '<li data-id="' +
                                            data.kode_brng +
                                            '" data-stok="' + item.stok +
                                            '" data-kapasitas="' + data.kapasitas +
                                            '" data-nama="' + data.nama_brng + '" onclick="ambilObat(this)"><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                            data.nama_brng + ' <span class="text-primary"><i><b>Stok (' + item.stok + ')</b></i></span></a></li>'
                                    } else {
                                        html +=
                                            '<li class="disable" data-id="' + data
                                            .kode_brng +
                                            '" data-stok="' + item.stok +
                                            '"><i><a class="dropdown-item" href="#" style="overflow:hidden;color:red">' +
                                            data.nama_brng + ' - <b>Stok Kosong' +
                                            '</b></a></i></li>'
                                    }
                                }
                            }
                        })
                    })
                    html += '</ul>';
                    $('.list_obat').fadeIn();
                    $('.list_obat').html(html);



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
                            '<li onclick="ambilAturan(this)" ><a class="dropdown-item" href="#" style="overflow:hidden">' +
                            data.aturan_pakai + '</a></li>'
                    })
                    html += '</ul>';
                    $('.list_aturan').fadeIn();
                    $('.list_aturan').html(html);
                }
            })
        }
        $('.list_obat').on('click', 'li', function() {
            if ($(this).data('stok') > 0) {
                $('.kode_obat').val($(this).data('id'));
                $('.nama_obat').val($(this).text());
                $('.kps').val($(this).data('kapasitas'));
                $('.p1').val(1);
                $('.p2').val(1);
                $('.list_obat').fadeOut();
                // $('#modalObat').modal('hide');
            } else {
                $('.nama_obat').val('');
            }
        });

        function ambilAturan(param) {
            $('.aturan_pakai').val($(param).text());
        }
        $('.list_aturan').on('click', 'li', function() {
            // console.log($(this).text())
            $('.list_aturan').fadeOut();
        });

        $(document).click(function() {
            $('.list_obat').fadeOut();
            $('.list_aturan').fadeOut();
            $('.list_racik').fadeOut();
            $('.list-diagnosa').fadeOut();
            $('.list-prosedur').fadeOut();

        });


        function tambahUmum() {
            no_resep = $('.no_resep').val();
            no_rawat = $('#nomor_rawat').val();
            cekResep(no_rawat);
            if (Object.keys(ambilResep(no_resep)).length == 0) {
                simpanResepObat();
            }
            // $('#modalResepUmum').modal('show');
            html = '<tr>';
            html += '<td><input type="hidden" class="kode_obat"/>';
            html +=
                '<input type="text" class="no_resep form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" onkeyup="cariObat(this)" autocomplete="off" class="form-control form-control-sm nama_obat form-underline" name="nama_obat" /><div class="list_obat"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" class="jml form-control form-control-sm form-underline"/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanObat()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep tbody').append(html)
            riwayatResep($('#no_rm').val())

        }

        function ambilObat(param) {
            $('.nama_obat').val($(param).data('nama'));
            $('.kode_obat').val($(param).data('id'))
        }

        function tambahRacikan() {
            no_resep = $('.no_resep').val();
            if (Object.keys(ambilResep(no_resep)).length == 0) {
                simpanResepObat();
            }

            html = '<tr>';
            html += '<td>';
            html +=
                '<input type="text" class="no_racik form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" class="no_resep form-control form-control-sm form-underline" readonly/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" autocomplete="off" onkeyup="cariRacikan(this)" class="form-control form-control-sm nm_racik form-underline" name="nm_racik"/><input type="hidden" class="id_racik" /><div class="list_racik"></div>';
            html += '</td>';

            html += '<td>';
            html +=
                '<select name=kd_racik" id="" class="form-select form-select-sm kd_racik form-underline" style="font-size:12px"> <option value="R01" selected>Puyer</option> <option value="R02">Sirup</option> <option value="R03">Salep</option> <option value="R04">Kapsul</option> </select>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" class="form-control form-control-sm jml_dr form-underline" name="jml_dr" onkeypress="return hanyaAngka(event)" />';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += '<td>';
            html +=
                '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep-racikan tbody').append(html)

            no_racik = 0;
            $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: $('.no_resep').val(),
                },
                success: function(response) {
                    if (response) {
                        $.map(response, function(data) {
                            no_racik = data.no_racik
                        })
                        no_racik = parseInt(no_racik) + 1;
                    } else {
                        no_racik = 1
                    }
                    // console.log(no_racik)
                    $('.no_racik').val(no_racik)
                    $('.no_resep').val(no_resep)
                }
            })
        }

        $('#modalResepRacikan').on('hidden.bs.modal', function() {
            $('.nm_racik').val('');
            $('.jml').val('');
            $('.aturan_pakai').val('');
            $('.keterangan').val('');
            $('.no_racik').val('');
        })

        $('#modalResepRacikan').on('shown.bs.modal', function() {
            cekResep(id);
            $('.no_resep').val(setNoResep())
        })

        function setNoResep() {
            let tanggal = "{{ date('Y-m-d') }}";
            let nomor = '';
            $.ajax({
                url: '/erm/resep/obat/akhir',
                method: 'GET',
                dataType: 'JSON',
                async: false,
                data: {
                    'tgl_peresepan': tanggal,
                    'tgl_perawatan': tanggal,
                },
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        if (response.tgl_perawatan == '0000-00-00' && response.no_rawat == $(
                                '#nomor_rawat')
                            .val()) {
                            nomor = response.no_resep;
                        } else {
                            nomor = parseInt(response.no_resep) + 1
                        }
                    } else {
                        nomor = "{{ date('Ymd') }}" + '0001';
                    }
                }
            })
            return nomor;

        }

        $('#modalSoap').on('shown.bs.modal', function() {
            $('.tambah_umum').css('visibility', 'visible')
            modalsoap(id);
            cekResep(id);
            ambilDiagnosaPasien(id);
            ambilProsedurPasien(id)
            no = 1;
            isModalShow = true;
        });

        function hapusResep(no_resep, no_rawat) {
            $.ajax({
                url: '/erm/resep/obat/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    no_resep: no_resep,
                },
                method: 'DELETE',
            })
            riwayatResep($('#no_rm').val())
        }

        function ubahObatDokter(no_resep, kode_brng, no) {
            $.ajax({
                url: '/erm/resep/umum/ubah',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                    jml: $('.u_jml_' + no).val(),
                    aturan_pakai: $('.u_aturan_' + no).val(),
                },
                success: function(response) {
                    // alert(response);
                    cekResep(id)
                    tulisPlan()
                }
            })
        }

        $('tbody').on('click', '.ubah-obat', function() {
            no = $(this).data('id')
            jml = $('.jml_' + no).text();
            aturan_pakai = $('.aturan_pakai_' + no).text();
            $('.simpan-obat-' + no).css('visibility', 'visible');
            $('.simpan-obat-' + no).css('font-size', '12px');
            $('.ubah-obat').css('display', 'none');
            $('.jml_' + no).empty()
            $('.aturan_pakai_' + no).empty()
            $('.jml_' + no).append('<input type="text" class="form-control form-control-sm form-underline u_jml_' + no + '" value="' + jml + '" />')
            $('.aturan_pakai_' + no).append('<input type="text" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline u_aturan_' + no + '" value="' + aturan_pakai + '" /><div class="list_aturan"></div>')

        })

        function cekResep(no_rawat) {
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();
            $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            if (Object.keys(res.resep_dokter).length > 0) {
                                no = 1;
                                $.map(res.resep_dokter, function(resep) {
                                    html = '<tr class="obat_' + no + '">';
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.data_barang.nama_brng +
                                        '</td>'
                                    html += '<td class="jml_' + no + '">' + resep.jml + '</td>'
                                    html += '<td class="aturan_pakai_' + no + '">' + resep.aturan_pakai + '</td>'
                                    if (res.tgl_perawatan != "0000-00-00") {
                                        $('.tambah_racik').css('visibility',
                                            'hidden')
                                        $('.tambah_umum').css('visibility',
                                            'hidden')
                                        html +=
                                            '<td class="aksi"><button type="button" class="btn btn-success btn-sm" style="font-size:12px"><i class="bi bi-check"></i></button></td>';
                                    } else {
                                        $('.tambah_racik').css('visibility',
                                            'visible')
                                        $('.tambah_umum').css('visibility',
                                            'visible')
                                        html +=
                                            '<td class="aksi"><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-resep="' +
                                            resep.no_resep + '" data-obat="' + resep
                                            .kode_brng +
                                            '"><i class="bi bi-trash-fill"></i></button><button style="font-size:12px" type="button" class="btn btn-warning btn-sm ubah-obat" data-id="' + no + '"><i class="bi bi-pencil"></i></button><button type="button" class="btn btn-primary simpan-obat-' + no + ' btn-sm" style="font-size:12;visibility:hidden" onclick="ubahObatDokter(' + resep.no_resep + ', \'' + resep.kode_brng + '\', ' + no +
                                            ')"><i class="bi bi-plus-circle"></i></button></td>';
                                    }
                                    html += '</tr>';
                                    $('#body_umum').append(html);
                                    no++;
                                })
                            }


                            if (Object.keys(res.resep_racikan).length > 0) {

                                $.map(res.resep_racikan, function(resep) {

                                    html = '<tr class="racikan_' + resep.no_racik + '">';
                                    html += '<td>' + resep.no_racik + '</td>'
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.nama_racik + '</td>'
                                    html += '<td>' + resep.metode.nm_racik + '</td>'
                                    html += '<td class="jml_dr_' + no + '">' + resep.jml_dr + '</td>'
                                    html += '<td class="aturan_pakai_dr_' + no + '">' + resep.aturan_pakai + '</td>'
                                    html +=
                                        '<td class="' + resep.no_resep + resep
                                        .no_racik +
                                        '"></td>';
                                    html += '</tr>';
                                    $('#body_racikan').append(html);
                                    if (Object.keys(resep.detail_racikan).length >
                                        0) {
                                        d = '<tr><td></td><td colspan="6">'
                                        $.map(resep.detail_racikan, function(
                                            detail) {
                                            if (resep.no_racik == detail
                                                .no_racik) {

                                                d += '<span class="badge rounded-pill text-bg-success"><i>' +
                                                    detail.databarang
                                                    .nama_brng + ' (' +
                                                    detail.kandungan +
                                                    ' mg)' +
                                                    '<i></span>';
                                            }
                                        })
                                        d += '</td></tr>'
                                        $('#body_racikan').append(d);
                                    }
                                    if (res.tgl_perawatan != "0000-00-00") {
                                        $('.tambah_racik').css('visibility',
                                            'hidden')
                                        $('.tambah_umum').css('visibility',
                                            'hidden')
                                        $('.' + resep.no_resep + resep.no_racik)
                                            .html(
                                                '<button type="button" class="btn btn-success btn-sm" style="font-size:12px"><i class="bi bi-check"></i></button>'
                                            )
                                    } else {
                                        $('.tambah_racik').css('visibility',
                                            'visible')
                                        $('.tambah_umum').css('visibility',
                                            'visible')
                                        $('.' + resep.no_resep + resep.no_racik)
                                            .html(
                                                '<button type="button" class="btn btn-danger btn-sm remove rm-dr-' + no + '" style="font-size:12px" data-resep="' +
                                                resep.no_resep + '" data-racik="' +
                                                resep.no_racik +
                                                '"><i class="bi bi-trash-fill"></i></button><button type="button" class="btn btn-warning btn-sm edit" style="font-size:12px" data-resep="' +
                                                resep.no_resep + '" data-racik="' +
                                                resep.no_racik +
                                                '"><i class="bi bi-pencil"></i>'
                                            )
                                    }
                                    no++;
                                })

                            }

                            $('.no_resep').val(res.no_resep)
                        })
                    } else {
                        $('.no_resep').val(setNoResep())
                    }
                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Ada kesalahan pemuatan obat',
                        'error'
                    );
                }
            }).done(function(response) {

            })
        }

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
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();

        });

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }

        function cariPetugas(nama) {
            // console.log()
            // alert(nama)
            $.ajax({
                url: '/erm/petugas/cari',
                data: {
                    'q': nama.value
                },
                success: function(response) {

                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:0;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.nip +
                            '" class="dropdown-item" onclick="setPetugas(this)">' + data
                            .nama +
                            '</a>'
                        html += '</li>'
                    })
                    html += '</ul>';
                    $('.list_petugas').fadeIn();
                    $('.list_petugas').html(html);
                },
            })
        }

        function setPetugas(param) {
            $('#nik').val($(param).data('id'));
            $('#nama').val($(param).text());
            $('.list_petugas').fadeOut();
        }
    </script>
@endpush
