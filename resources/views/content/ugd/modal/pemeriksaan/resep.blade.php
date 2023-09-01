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
    <li class="nav-item">
        <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
    </li>
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
@push('script')
    <script>
        function tambahUmum(noRawat) {
            const resepByRawat = getResepByRawat(noRawat)
            const getLast = getLastNoResep();
            const row = $('#tb-resep-umum-ugd tbody').children('tr').length;
            $('.nama_obat').focus()
            resepByRawat.done((resep) => {
                if (resep.length) {
                    $.map(resep, (res) => {
                        noResep = res.no_resep;
                    })
                    $('#formResepUgd input[name="no_resep"]').val(noResep)
                    $('#tb-resep-umum-ugd tbody').append(setRowUmum(noResep, row));
                } else {
                    getLast.done((result) => {
                        const date = new Date();
                        noResep = result.length ? parseInt(result.no_resep) + 1 : `${date.getFullYear()}${date.getMonth()}${date.getDate()}0001`
                        const dokter = $('#formResepUgd input[name="kd_dokter"]').val()
                        const no_rawat = $('#formResepUgd input[name="no_rawat"]').val()
                        const _token = $('#formResepUgd input[name="_token"]').val()
                        $('#formResepUgd input[name="no_resep"]').val(noResep)
                        $('#tb-resep-umum-ugd tbody').hide().append(setRowUmum(noResep, row)).fadeIn(1000);
                        data = getDataForm('#formResepUgd', ['input'], ['']);
                        data['no_resep'] = noResep

                        console.log(data);
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
            html += '<input type="search" name="aturan_pakai" onkeyup="cariAturan(this)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
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
                                        onclick="setObat(this)"><a class="dropdown-item" href="#" style="overflow:hidden">${data.nama_brng}<span class="text-primary"><i><b> Stok (${item.stok})</b></i></span></a></li>`
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



        function setObat(param, form) {
            $(`input[name=cari-obat]`).val($(param).data('nama'));
            $(`input[name=kode_brng]`).val($(param).data('id'));
            $('.list_obat').fadeOut();
        }

        function createSimpanResep() {

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
                    },
                    error: function(request, status, error) {
                        Swal.fire(
                            'Gagal !',
                            'Obat tidak tersimpan<br/>' + request.responseJSON.message,
                            'error',
                        )

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

        $('#tb-resep-umum-ugd tbody').on('click', '.hapus-baris', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            // $('.btn-umum').css('display', 'inline')
            $('.btn-umum').fadeIn()
            return false;
        })

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
    </script>
@endpush
