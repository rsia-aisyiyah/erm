<form action="" id="formResepUgd">
    <input type="hidden" name="no_resep" />
    <input type="hidden" name="no_rawat" />
    <input type="hidden" name="kd_dokter" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
<ul class="nav nav-tabs" id="tabResepUgd">
    <li class="nav-item">
        <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
    </li>
    <li class="nav-item">
        <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
    </li>
    {{-- <li class="nav-item">
        <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
    </li> --}}
</ul>
<div class="tab-content">
    <div class="tab-pane fade show active" id="umum">
        <table class="table table-stripped table-responsive table-sm" id="tb-resep-umum-ugd" width="100%">
            <thead>
                <tr>
                    <th width="18%">No. Resep</th>
                    <th>Nama Obat</th>
                    <th width="10%">Jumlah</th>
                    <th>Aturan Pakai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="body">

            </tbody>
        </table>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
            <button class="btn btn-primary btn-sm btn-umum" type="button"><i class="bi bi-plus-circle"></i> Tambah Obat</button>
        </div>
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
        <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
            <button class="btn btn-primary btn-sm btn-racikan" type="button">Tambah Racikan</button>
        </div>
    </div>
    <div class="tab-pane fade" id="riwayat">
        <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th width="65%">Obat/Racikan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="body_riwayat" class="align-top">

            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="modalObatRacik" aria-labelledby="modalObatRacik" aria-hidden="true" style="background-color: #00000062!important;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="">Isian Obat Racikan</h2>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary"
                    role="alert">
                    Anda dapat menghapus / menambah daftar obat yang tercantum
                </div>
                <form action="" id="formDetailResep">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="no_resep" style="font-size:12px">Nomor Resep</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm no_resep mb-1" name="no_resep" readonly />
                                </div>
                                <div class="col-md-2">
                                    <label for="nm_racik" style="font-size:12px">Nama Racikan</label>
                                    <input type="search" autocomplete="off"
                                        class="form-control form-control-sm nm_racik mb-1" name="nm_racik" />
                                </div>
                                <div class="col-md-2">
                                    <label for="metode" style="font-size:12px">Metode</label>
                                    <select name="metode" id="" class="form-select form-select-sm kd_racik" style="font-size:12px">
                                        <option value="R01" selected="">Puyer</option>
                                        <option value="R02">Sirup</option>
                                        <option value="R03">Salep</option>
                                        <option value="R04">Kapsul</option>
                                    </select>
                                    {{-- <input type="text" autocomplete="off"
                                        class="form-control form-control-sm metode mb-1" name="metode" readonly /> --}}
                                </div>
                                <div class="col-md-2">
                                    <label for="jml_dr" style="font-size:12px">Jumlah Racik</label>
                                    <input type="text" autocomplete="off"
                                        class="form-control form-control-sm jml_dr mb-1" name="jml_dr" readonly />
                                </div>
                                <div class="col-md-3">
                                    <label for="jml" style="font-size:12px">Aturan Pakai</label>
                                    <input type="search" autocomplete="off" onkeyup="cariAturan(this)"
                                        class="form-control form-control-sm aturan_pakai mb-1" name="aturan_pakai" id="aturan_pakai" />
                                    <input type="hidden" class="nomor">
                                    <input type="hidden" value="" class="no_racik" name="no_racik" />
                                    <div class="list_aturan" style="display: none;"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="container table-responsive">
                                    <table class="table table-racikan-detail table-borderless">
                                        <thead>
                                            <tr>
                                                <th width="35%">Nama Obat</th>
                                                <th>Sediaan</th>
                                                <th width="7%">P1</th>
                                                <th width="3%"></th>
                                                <th width="7%">P2</th>
                                                <th width="8%">Dosis</th>
                                                <th></th>
                                                <th>Jumlah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="tambahDaftarRacik()"><i class="bi bi-plus-circle"></i> Tambah
                                        Obat</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanDosisObat()"><i
                        class="bi bi-save" data-bs-dismiss="modal"></i> Simpan</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function tambahDaftarRacik() {
            no = $('.nomor').val();
            html = '<tr class="obat-' + no + '">'
            html += '<td><input type="hidden" id="kode_brng' + no + '"/><input type="search" onkeyup="cariObatRacikan(this, ' + no + ')" autocomplete="off" class="form-control form-control-sm nama_obat_' + no + ' form-underline" name="nama_obat" /><div class="list_obat_' + no + '"></div></td>'
            html += '<td><input type="search" autocomplete="off" class="form-control form-control-sm form-underline" id="kps' +
                no + '" name="kps" readonly /></td>'
            html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p1' + no + '" name="p1[]" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>'
            html += '<td>/</td>'
            html += '<td><input type="search" class="form-control form-control-sm form-underline" id="p2' + no + '"name="p2[]" onkeyup="hitungObatRacik(' + no + ')" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>'
            html += '<td><input type="search" onkeypress="return hanyaAngka(event)" class="form-control form-control-sm form-underline" id="kandungan' + no + '" name="kandungan[]" onkeyup="hitungDosis(' + no + ')" autocomplete="off"/></td>'
            html += '<td>mg</td>'
            html +=
                '<td><input type="search" class="form-control form-control-sm form-underline" id="jml_obat' +
                no +
                '" name="jml[]" readonly/></td>'
            html +=
                '<td><a href="#modal" data-no=' + no +
                ' type="button" class="btn btn-danger btn-sm x"  style="font-size:12px"><i class="bi bi-trash-fill"></i></a></td>'
            html += '</tr>'
            $('.table-racikan-detail tbody').append(html);
            no = parseInt(no) + 1;
            $('.nomor').val(no)

        }

        function tambahResep(kategori, noRawat) {
            const resepByRawat = getResepByRawat(noRawat)
            const getLast = getLastNoResep();
            let row = 0;
            $('.nama_obat').focus()
            resepByRawat.done((resep) => {
                if (resep.length) {
                    $.map(resep, (res) => {
                        noResep = res.no_resep;
                    })
                    $('#formResepUgd input[name="no_resep"]').val(noResep)
                    if (kategori == 'umum') {
                        row = 1 + $('#tb-resep-umum-ugd tbody').children('tr').length;
                        $('#tb-resep-umum-ugd tbody').append(setRowUmum(noResep, row));
                    } else if (kategori == 'racikan') {
                        row = 1 + $('#tb-resep-racikan tbody').children('tr').length;

                        console.log($('#tb-resep-racikan tbody').children('tr'));

                        $('#tb-resep-racikan tbody').append(setRowRacikan(noResep, row));
                        getResepRacikan().done((rr) => {
                            if (rr.length) {
                                $.map(rr, function(data) {
                                    no_racik = data.no_racik
                                })
                                no_racik = parseInt(no_racik) + 1;
                            } else {
                                no_racik = 1
                            }
                            $('.no_racik').val(no_racik)
                        })
                    }
                } else {
                    getLast.done((result) => {

                        noResep = result.length ? parseInt(result.no_resep) + 1 : "{{ date('Ymd') }}0001"
                        const dokter = $('#formResepUgd input[name="kd_dokter"]').val()
                        const no_rawat = $('#formResepUgd input[name="no_rawat"]').val()
                        const _token = $('#formResepUgd input[name="_token"]').val()
                        $('#formResepUgd input[name="no_resep"]').val(noResep)
                        if (kategori == 'umum') {
                            $('#tb-resep-umum-ugd tbody').append(setRowUmum(noResep, row));
                        } else if (kategori == 'racikan') {
                            $('#tb-resep-racikan tbody').append(setRowRacikan(noResep, row));
                            getResepRacikan().done((rr) => {
                                if (rr.length) {
                                    $.map(response, function(data) {
                                        no_racik = data.no_racik
                                    })
                                    no_racik = parseInt(no_racik) + 1;
                                } else {
                                    no_racik = 1
                                }
                                $('.no_racik').val(no_racik)
                            })
                        }
                        data = getDataForm('#formResepUgd', ['input'], ['']);
                        data['no_resep'] = noResep
                        createResepObat(data).done((response) => {
                            console.log(response);
                        })
                    })
                }
            })
        }


        function setRowUmum(noResep, id) {
            html = `<tr id="umum-${id}">`;
            html += `<td><input type="hidden" class="kode_brng" name="kode_brng"/><input type="hidden" class="_token" name="_token" value="{{ csrf_token() }}"/>`;
            html += `<input type="text" class="no_resep form-control form-control-sm form-underline" name="no_resep" readonly value="${noResep}"/>`;
            html += '</td>';
            html += '<td>';
            html += '<input type="search" name="cari-obat" onkeyup="cariObat(this)" autocomplete="off" class="form-control form-control-sm nama_obat form-underline" name="nama_obat" /><div class="list_obat"></div>';
            html += '</td>';
            html += '<td>';
            html += '<input type="search" name="jml" class="jml form-control form-control-sm form-underline"/>';
            html += '</td>';
            html += '<td>';
            html += '<input type="search" name="aturan_pakai" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" />';
            html += '</td>';
            html += '<td>';
            html += `<div class="status">
                    <button type="button" class="btn btn-primary btn-sm simpan" onclick="simpanObat(${id})" style="font-size:12px"><i class="bi bi-save2"></i></button>
                    <a href="javascript:void(0)" type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></a>
                </div>`;
            html += '</td>';
            html += '</tr>';
            $('.btn-umum').fadeOut()

            return html;
        }



        function cariTemplateRacikan(nm_racik) {
            $.ajax({
                url: '/erm/resep/racik/cari',
                data: {
                    'nm_racik': nm_racik.value,
                    'kd_dokter': "-",
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        html =
                            '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                        $.map(response, function(data) {
                            html += '<li onclick="setNamaRacik(this)" data-nama="' + data.nm_racik + '" data-id="' + data.id + '"><a class="dropdown-item" href="javascript:void(0)" style="overflow:hidden">' + data.nm_racik + '</a></li>'
                        })
                        html += '</ul>';
                        $('.list_racik').fadeIn();
                        $('.list_racik').html(html);
                    }

                }
            })
        }

        function setNamaRacik(element) {
            nama_racik = $(element).data('nama');
            id_racik = $(element).data('id');
            $('.nama_racik').val(nama_racik);
            $('.id_racik').val(id_racik)
            $('.list_racik').fadeOut();
        }

        function setRowRacikan(no_resep, id) {
            html = `<tr id="racikan-${id}">`;
            html += '<td>';
            html += '<input type="text" name="no_racik" class="no_racik form-control form-control-sm form-underline" readonly/>';
            html += '<input type="hidden" name="_token" value="{{ csrf_token() }}"/>';
            html += '<input type="hidden" name="keterangan" value="-"/>';
            html += '</td>';
            html += '<td>';
            html += `<input type="text" name="no_resep" class="no_resep form-control form-control-sm form-underline" readonly value="${no_resep}"/>`;
            html += '</td>';
            html += '<td>';
            html += `<input type="search" autocomplete="off" class="form-control form-control-sm form-underline nama_racik" name="nama_racik" onkeyup="cariTemplateRacikan('-', this)"/><input type="hidden" class="id_racik" name="id_racik"/><div class="list_racik"></div>`;
            html += '</td>';

            html += '<td>';
            html += '<select name="kd_racik" id="" class="form-select form-select-sm kd_racik form-underline" style="font-size:12px"> <option value="R01" selected>Puyer</option> <option value="R02">Sirup</option> <option value="R03">Salep</option> <option value="R04">Kapsul</option> </select>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" class="form-control form-control-sm jml_dr form-underline" name="jml_dr" onkeypress="return hanyaAngka(event)" />';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += '<td>';
            html += `<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan(${id})" style="font-size:12px"><i class="bi bi-plus-circle"></i></button>
                <button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>`;
            html += '</td>';
            html += '</tr>';
            $('.btn-racikan').fadeOut()

            return html;
        }

        // ambil resep racikan by nomor resep
        function getResepRacikan(no_resep) {
            let resep = $.ajax({
                url: '/erm/resep/racik/ambil',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_resep: no_resep,
                },

            })
            return resep;
        }



        function cariObat(obat) {
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value,
                },
                success: function(response) {
                    html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response.data, function(data) {
                        $.map(data.gudang_barang, function(item) {
                            if (data) {
                                if (data.status != "0") {
                                    if (item.stok != "0") {
                                        html += `<li 
                                        data-id="${data.kode_brng}"
                                        data-stok="${item.stok}"
                                        data-kapasitas="${data.kapasitas}"
                                        data-nama="${data.nama_brng}"
                                        onclick="setObatUmum(this)"><a class="dropdown-item" href="#" style="overflow:hidden">${data.nama_brng}<span class="text-primary"><i><b> Stok (${item.stok})</b></i></span></a></li>`
                                    } else {
                                        html += `<li class="disable"><i><a class="dropdown-item" href="javascript:void(0)" style="overflow:hidden;color:red">${data.nama_brng} - <b>Stok Kosong</b></a></i></li>`
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



        function setObatUmum(param, form) {
            $(`input[name=cari-obat]`).val($(param).data('nama'));
            $(`input[name=kode_brng]`).val($(param).data('id'));
            $('.list_obat').fadeOut();
        }

        function createSimpanResep() {

        }

        function simpanRacikan(id) {
            no_rawat = $('#formSoapUgd input[name="no_rawat"]').val();
            id_racik = $(`#racikan-${id} input[name="id_racik"]`).val();
            data = getDataForm(`#racikan-${id}`, ['input', 'select'], [''])
            $.ajax({
                url: '/erm/resep/racik/simpan',
                data: data,
                method: 'POST',
            }).done((response) => {
                $('.btn-umum').css('display', 'inline')
                getTemplateRacikan('-', data.nama_racik, id_racik).done((template) => {
                    $.map(template.detail_racik, (dr) => {
                        simpanObatRacikanTemplate(dr.kode_brng, data.no_racik, data.no_resep)
                    })
                })
                setListResep(no_rawat);
                tulisPlan(no_rawat);
            }).fail((request, status, error) => {
                Swal.fire(
                    'Gagal !',
                    'Obat tidak tersimpan<br/>' + request.responseJSON.message,
                    'error',
                )
            })
        }

        function simpanObatRacikanTemplate(kode_obat, no_racik, no_resep) {
            let template = $.ajax({
                url: '/erm/resep/racik/detail/simpan',
                method: 'POST',
                data: {

                    '_token': '{{ csrf_token() }}',
                    'no_resep': no_resep,
                    'no_racik': no_racik,
                    'kode_brng': kode_obat,
                    'kandungan': 0,
                    'p1': 1,
                    'p2': 1,
                    'jml': 0,
                },
            })

            return template;
        }

        function simpanObat(id) {
            no_rawat = $('#formSoapUgd input[name="no_rawat"]').val();
            data = getDataForm(`#umum-${id}`, ['input'], ['cari-obat'])
            if (data.kode_brng && data.jml && data.aturan_pakai) {
                $.ajax({
                    url: '/erm/resep/umum/simpan',
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        $('.btn-umum').css('display', 'inline')
                        setListResep(no_rawat);
                        tulisPlan(no_rawat);
                    },
                    error: function(request, status, error) {

                    }
                })
            } else {

                textObat = data.kode_brng ? '' : '<b class="text-danger" >Obat, </b>';
                textJml = data.jml ? '' : '<b class="text-danger"> Jumlah, </b>';
                textAturan = data.aturan_pakai ? '' : '<b class="text-danger"> Aturan Pakai</b>';
                Swal.fire(
                    'Gagal !',
                    'Kolom ' + textObat + textJml + textAturan + ' tidak boleh kosong',
                    'error'
                )
            }

        }


        // modal tambah detail obat racikan
        function tambahDetail(no_resep, no_racik) {
            $('#modalObatRacik').modal('show')
            getResepRacikan(no_resep).done((racik) => {
                $('.table-racikan-detail tbody').empty();
                $.map(racik, (rr) => {
                    if (rr.no_racik == no_racik) {
                        $('#formDetailResep input[name=nm_racik]').val(rr.nama_racik)
                        $('#formDetailResep input[name=no_resep]').val(rr.no_resep)
                        $('#formDetailResep input[name=no_racik]').val(rr.no_racik)
                        $('#formDetailResep select[name=metode]').val(rr.kd_racik).change()
                        $('#formDetailResep input[name=jml_dr]').val(rr.jml_dr)
                        $('#formDetailResep input[name=aturan_pakai]').val(rr.aturan_pakai)
                    }
                    getDetailRacikan(no_resep, no_racik).done((response) => {
                        console.log(response);
                        setRowDetailRacikan(response, rr.jml_dr);
                    })
                })
            })
        }

        function setRowDetailRacikan(data, jml) {
            let no = 1;
            $.map(data, (res) => {
                kandungan = res.kandungan != 0 ? res.kandungan : res.data_barang.kapasitas;

                html = `<tr class="obat-${no}">`
                html += `<td><input type="hidden" id="kode_brng${no}" value="${res.kode_brng}" name="kode_brng[]"/> ${res.data_barang.nama_brng}</td>`
                html += `<td><input type="hidden" id="kps${no}" name="kps[]" value="${res.data_barang.kapasitas}"/>${res.data_barang.kapasitas} mg </td>`
                html += `<td><input type="search" class="form-control form-control-sm form-underline" id="p1${no}" name="p1[]" value="${res.p1}" onkeyup="hitungObatRacik(${no})" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>`
                html += '<td>/</td>'
                html += `<td><input type="search" class="form-control form-control-sm form-underline" id="p2${no}"name="p2[]" onkeyup="hitungObatRacik(${no})" value="${res.p2}" onfocusout="setNilaiPembagi(this)" autocomplete="off"/></td>`
                html += `<td><input type="search" class="form-control form-control-sm form-underline" id="kandungan${no}" name="kandungan[]" onkeypress="return hanyaAngka(event)" value="${kandungan}" onkeyup="hitungDosis(${no})" autocomplete="off"/></td>`
                html += '<td>mg</td>'
                html += `<td><input type="search" class="form-control form-control-sm form-underline" id="jml_obat${no}" name="jml[]" value="${hitungJumlahObat(res.data_barang.kapasitas, res.p1, res.p2, jml)}" readonly/></td>`
                html += `<td><button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-resep="${res.no_resep}" data-racik="${res.no_racik}" data-obat="${res.kode_brng}" data-no="${no}" onclick="hapusObatRacikan(this)"><i class="bi bi-trash-fill"></i></button></td>`
                html += '</tr>'
                no++
                $('.table-racikan-detail').append(html);
            })
            $('.nomor').val(no)
        }


        function hapusObatRacikan(param) {
            no_resep = $(param).data('resep');
            no_racik = $(param).data('racik');
            kode_brng = $(param).data('obat');
            no = $(param).data('no');

            const no_rawat = $('#formResepUgd input[name=no_rawat]').val()

            console.log(no);
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
                        error: function(request, status, error) {
                            Swal.fire(
                                'Gagal !',
                                'Tidak menghapus obat<br/>' + request.responseJSON
                                .message,
                                'error',
                            )

                        }
                    }).done(function() {
                        $('.obat-' + no).remove();
                        hitungBarisObat($('.table-racikan-detail'))
                        setListResep(no_rawat);
                        tulisPlan(no_rawat);
                    })
                }
            })
        }

        function hitungBarisObat(table) {
            table.find('tr').each(function(index, element) {
                $(element).attr('class', 'obat-' + index)
                $(element).find('td:eq(0) input').attr('id', 'kode_brng' + index)
                $(element).find('td:eq(1) input').attr('id', 'kps' + index)
                $(element).find('td:eq(2) input').attr('id', 'p1' + index)
                $(element).find('td:eq(2) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(4) input').attr('id', 'p2' + index)
                $(element).find('td:eq(4) input').attr('onchange', 'hitungObatRacik(' + index + ')')
                $(element).find('td:eq(5) input').attr('id', 'kandungan' + index)
                $(element).find('td:eq(5) input').attr('onchange', 'hitungDosis(' + index + ')')
                $(element).find('td:eq(7) input').attr('id', 'jml_obat' + index)
            });
            $('.nomor').val(table.find('tr').length);
            console.log(table.find('tr').length);
        }

        function simpanDosisObat() {
            const no_racik = $('#formDetailResep input[name=no_racik]').val()
            const no_resep = $('#formDetailResep input[name=no_resep]').val()
            const no_rawat = $('#formResepUgd input[name=no_rawat]').val()
            let banyakBaris = $('.nomor').val()

            console.log(banyakBaris);
            for (let no = 1; no < banyakBaris; no++) {
                $.ajax({
                    url: '/erm/resep/racik/detail/ubah',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'no_resep': no_resep,
                        'no_racik': no_racik,
                        'kode_brng': $('#kode_brng' + no).val(),
                        'kandungan': $('#kandungan' + no).val(),
                        'p1': $('#p1' + no).val(),
                        'p2': $('#p2' + no).val(),
                        'jml': $('#jml_obat' + no).val(),
                    },
                    method: 'POST',
                    error: function(response) {
                        Swal.fire('Gagal !', response.responseJSON.message, 'error');
                    }
                }).done((response) => {
                    setListResep(no_rawat);
                    $('#modalObatRacik').modal('hide')
                })
                tulisPlan(no_rawat);
            }
        }

        $('#tb-resep-umum-ugd tbody').on('click', '.hapus-baris', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            $('.btn-umum').fadeIn()
            return false;
        })
        $('#tb-resep-racikan tbody').on('click', '.hapus-baris', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            $('.btn-racikan').fadeIn()
            return false;
        })

        //ambil detail isi resep racikan 
        function getDetailRacikan(no_resep, no_racik) {
            const racikan = $.ajax({
                url: '/erm/resep/racik/detail/ambil',
                data: {
                    'no_resep': no_resep,
                    'no_racik': no_racik,
                }
            });
            return racikan;
        }

        function getLastNoResep() {
            const noResep = $.ajax({
                url: '/erm/resep/get/nomor/akhir',
            });
            return noResep;
        }

        function getResepByRawat(noRawat) {
            const id = textRawat(noRawat, '-');
            const resep = $.ajax({
                url: '/erm/resep/get/rawat/' + id
            })
            return resep;
        }

        function createResepObat(data) {

            let resep = $.ajax({
                url: '/erm/resep/obat/simpan',
                method: 'POST',
                data: data,
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak bisa menambah resep<br/>' + request.responseJSON.message,
                        'error',
                    )
                }
            });
            return resep;
        }

        function hapusObatUmum(no_resep, kode_brng) {
            const no_rawat = $('#formResepUgd input[name=no_rawat]').val()
            const data = {
                'no_resep': no_resep,
                'kode_brng': kode_brng,
                '_token': "{{ csrf_token() }}",
            };
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
                        url: '/erm/resep/umum/hapus',
                        method: 'DELETE',
                        data: data,
                        error: function(request, status, error) {
                            Swal.fire('Gagal !', 'Tidak menghapus obat<br/>' + request.responseJSON.message, 'error', )

                        }
                    }).done(function() {
                        setListResep(no_rawat)
                        tulisPlan(no_rawat)
                    })
                }
            })
        }

        function hapusRacikan(no_resep, no_racik) {
            const no_rawat = $('#formResepUgd input[name=no_rawat]').val()
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
                    hapusResepRacikan(no_resep, no_racik).done((response) => {
                        setListResep(no_rawat)
                        tulisPlan(no_rawat)
                    }).fail((request, status, error) => {
                        Swal.fire('Gagal !', 'Tidak menghapus obat<br/>' + request.responseJSON.message, 'error', )
                    })
                }
            })

        }
    </script>
@endpush
