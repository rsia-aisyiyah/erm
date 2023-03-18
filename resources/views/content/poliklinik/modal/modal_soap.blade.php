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
                            <table class="borderless mb-3">
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
                                <input type="hidden" class="no_resep form-control form-control-sm" />
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
                                                <th>No. Resep</th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Aturan Pakai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_umum">

                                        </tbody>
                                    </table>
                                    <button class="btn btn-primary btn-sm tambah_umum" type="button"
                                        onclick="tambahUmum()">Tambah
                                        Obat</button>
                                    <button class="btn btn-success btn-sm btn_simpan_resep" type="button"
                                        style="visibility: hidden">Simpan
                                        Resep</button>
                                </div>
                                <div class="tab-pane fade" id="racikan">
                                    <table class="table table-striped table-responsive" id="tb-resep-racikan"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No Racik</th>
                                                <th>No Resep</th>
                                                <th>Nama Racikan</th>
                                                <th>Metode Racikan</th>
                                                <th>Jumlah</th>
                                                <th>Aturan Pakai</th>
                                                <th>Keterangan</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="body_racikan">

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
                            'jml': $('.jumlah').val(),
                            'aturan_pakai': $('.aturan_pakai').val() + ' ' + $(
                                    '.keterangan')
                                .val(),
                        },
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
                            Swal.fire(
                                'Berhasil!',
                                'Obat telah ditambah diresep',
                                'success'
                            )
                            cekResep($('#nomor_rawat').val())
                        }
                    })
                }
            })
        });


        function simpanResepObat() {
            $.ajax({
                url: '/erm/resep/obat/simpan',
                data: {
                    _token: "{{ csrf_token() }}",
                    kd_dokter: "{{ Request::get('dokter') }}",
                    no_rawat: $('#nomor_rawat').val(),
                    no_resep: $('.no_resep').val(),
                },
                method: 'POST',
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
                    $.map(response, function(res) {
                        html += '<tr>'
                        html += '<td>' + res.data_barang.nama_brng + '</td>'
                        html += '<td>' + res.kandungan + ' mg</td>'
                        html += '<td>' + res.jml + '</td>'
                        html +=
                            '<td><button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-resep="' +
                            res.no_resep + '" data-racik="' +
                            res.no_racik +
                            '" data-obat="' + res.kode_brng +
                            '" onclick="hapusObat(this)"><i class="bi bi-trash-fill"></i></button></td>'
                        html += '</tr>'
                    });
                    $('.table-racikan tbody').append(html);
                },
            })
        }

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

                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Obat telah dihapus',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 800,
                            })

                            ambilObatRacikan();
                            cekResep(id);
                        }
                    })
                }
            })
        }

        $('tbody').on('click', '.edit', function() {
            let no_resep = $(this).attr('data-resep');
            let kode_brng = $(this).attr('data-obat');
            let no_racik = $(this).attr('data-racik');
            // console.log('noracik', no_racik)
            $('#modalObatRacik').modal('show');
            racikan = ambilRacikan(no_resep, no_racik)
            $('.no_racik').val(racikan.no_racik);
            $('.no_resep').val(racikan.no_resep);
            $('.nm_racik').val(racikan.nama_racik);
            $('.no_racik').val(no_racik);
            $('.jml').val(racikan.jml_dr);
            ambilObatRacikan();
        })
        $('#modalObatRacik').on('hidden.bs.modal', function() {
            $('.no_racik').val('');
            $('.kps').val('');
            $('.p1').val('');
            $('.p2').val('');
            $('.jml_obat').val('');
            $('.nama_obat').val('');
            $('.kandumgan').val('');
        });
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
                            url: '/erm/resep/racik/hapus',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_resep: no_resep,
                                no_racik: no_racik,
                            },
                            method: 'DELETE',
                            success: function(response) {
                                Swal.fire(
                                    'Terhapus !',
                                    'Obat berhasil dihapus',
                                    'success'
                                );
                                $('#body_racik').empty();
                                cekResep($('#nomor_rawat').val())
                            },
                            error: function(request, status, error) {
                                Swal.fire(
                                    'Gagal !',
                                    'Obat tidak terhapus',
                                    'error'
                                );
                            }
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
                                Swal.fire(
                                    'Terhapus !',
                                    'Obat berhasil dihapus',
                                    'success'
                                );
                                $('#body_umum').empty();
                                cekResep($('#nomor_rawat').val())
                            }
                        })
                    }
                }
            })
            return false;
        })

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
                                            '"><a class="dropdown-item" href="#" style="overflow:hidden">' +
                                            data.nama_brng + '</a></li>'

                                    } else {
                                        html +=
                                            '<li class="disable" data-id="' + data
                                            .kode_brng +
                                            '" data-stok="' + item.stok +
                                            '"><i><a class="dropdown-item" href="#" style="overflow:hidden;color:red">' +
                                            data.nama_brng + ' - Stok Kosong' +
                                            '</a></i></li>'

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
                            '<li><a class="dropdown-item" href="#" style="overflow:hidden">' +
                            data.aturan_pakai + '</a></li>'
                    })
                    html += '</ul>';
                    $('.list_aturan').fadeIn();
                    $('.list_aturan').html(html);
                }
            })
        }
        $('.list_obat').on('click', 'li', function() {
            // console.log($(this).data())

            if ($(this).data('stok') > 0) {
                $('.kode_obat').val($(this).data('id'));
                $('.nama_obat').val($(this).text());
                $('.kps').val($(this).data('kapasitas'));
                $('.p1').val(1);
                $('.p2').val(1);
                $('.list_obat').fadeOut();
            } else {
                $('.nama_obat').val('');
            }
        });
        $('.list_aturan').on('click', 'li', function() {
            $('.aturan_pakai').val($(this).text());
            $('.list_aturan').fadeOut();
        });

        $(document).click(function() {
            $('#list_obat').fadeOut();
            $('.list_aturan').fadeOut();
        });

        function tambahUmum() {
            $('#modalResepUmum').modal('show');
        }

        function tambahRacikan() {
            $('#modalResepRacikan').modal('show');

            // cekResepRacikan();

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
            setNoResep();
        })

        function setNoResep() {
            let tanggal = "{{ date('Y-m-d') }}";
            $.ajax({
                url: '/erm/resep/obat/akhir',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'tgl_peresepan': tanggal,
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
                    $('.no_resep').val(nomor)
                }
            })

        }

        $('#modalSoap').on('shown.bs.modal', function() {
            $('.tambah_umum').css('visibility', 'visible')
            modalsoap(id);
            cekResep(id);
            no = 1;
            isModalShow = true;
        });

        function hapusResep(no_resep, no_rawat) {
            $.ajax({
                url: '/erm/resep/obat/hapus',
                data: {
                    no_rawat: no_rawat,
                    no_resep: no_resep,
                },
                method: 'DELETE',
            })
        }

        function cekResep(no_rawat) {
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $.ajax({
                url: '/erm/resep/obat/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        $.map(response, function(res) {
                            if (Object.keys(res.resep_dokter).length > 0) {
                                $.map(res.resep_dokter, function(resep) {
                                    html = '<tr>';
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.data_barang.nama_brng +
                                        '</td>'
                                    html += '<td>' + resep.jml + '</td>'
                                    html += '<td>' + resep.aturan_pakai + '</td>'
                                    html +=
                                        '<td class="aksi"><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-resep="' +
                                        resep.no_resep + '" data-obat="' + resep
                                        .kode_brng +
                                        '"><i class="bi bi-trash-fill"></i></button></td>';
                                    html += '</tr>';
                                    $('#body_umum').append(html);
                                })
                            }
                            no_racik = Object.keys(res.resep_racikan).length + 1
                            if (Object.keys(res.resep_racikan).length > 0) {
                                $.map(res.resep_racikan, function(resep) {
                                    // console.log()
                                    html = '<tr>';
                                    html += '<td>' + resep.no_racik + '</td>'
                                    html += '<td>' + resep.no_resep + '</td>'
                                    html += '<td>' + resep.nama_racik + '</td>'
                                    html += '<td>' + resep.metode.nm_racik + '</td>'
                                    html += '<td>' + resep.jml_dr + '</td>'
                                    html += '<td>' + resep.aturan_pakai + '</td>'
                                    html +=
                                        '<td class="' + resep.no_resep + '"></td>';
                                    html += '</tr>';
                                    $('#body_racikan').append(html);
                                    if (Object.keys(resep.detail_racikan).length > 0) {
                                        // console.log(resep)
                                        d = '<tr><td></td><td colspan="6">'
                                        $.map(resep.detail_racikan, function(detail) {
                                            if (resep.no_racik == detail.no_racik) {

                                                d += '<span class="badge rounded-pill text-bg-success"><i>' +
                                                    detail.databarang
                                                    .nama_brng + ' (' +
                                                    detail.kandungan + ' mg)' +
                                                    '<i></span>';
                                            }
                                        })
                                        d += '</td></tr>'
                                        $('#body_racikan').append(d);
                                    }
                                    if (res.tgl_perawatan != "0000-00-00") {
                                        // console.log(res.tgl_perawatan)
                                        $('.' + res.no_resep).html(
                                            '<button type="button" class="btn btn-success btn-sm" style="font-size:12px"><i class="bi bi-check"></i></button>'
                                        )
                                    } else {
                                        $('.' + res.no_resep).html(
                                            '<button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-resep="' +
                                            resep.no_resep + '" data-racik="' + resep
                                            .no_racik +
                                            '"><i class="bi bi-trash-fill"></i></button> <button type="button" class="btn btn-warning btn-sm edit" style="font-size:12px" data-resep="' +
                                            resep.no_resep + '" data-racik="' + resep
                                            .no_racik +
                                            '"><i class="bi bi-pen-fill"></i></button>'
                                        )
                                    }
                                })
                            }
                            $('.no_racik').val(no_racik)
                            setNoResep();
                        })
                    } else {
                        setNoResep();
                    }
                }
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
        });

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }
    </script>
@endpush
