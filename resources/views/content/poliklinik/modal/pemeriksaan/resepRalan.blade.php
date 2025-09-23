<input type="hidden" class="no_resep form-control form-control-sm" name="no_resep" />
<div class="border p-3 mt-3 bg-light">
    <div class="d-flex justify-content-between gap-2 mb-2">
        <label for="no_resep p-2">No. Resep :
            <span class="noResepText"></span>
            <a href="javascript:void(0)" class="actionResep" onclick="deleteResep()"><i class="bi bi-trash text-danger"></i></a>
        </label>
        <small style="font-size:11px">Tgl. Resep : <span class="labelTglResep"></span></small>
    </div>
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

        <div class="tab-pane fade show active mt-3 table-responsive" id="umum">
            <table class="table table-bordered" id="tb-resep" width="100%">
                <thead>
                    <tr>
                        <th width="30%">Nama Obat</th>
                        <th width="10%">Jumlah</th>
                        <th width="20%">Aturan Pakai</th>
                        <th>Harga </th>
                        <th>Harga Total </th>
                        <th width="5%"></th>
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
        <div class="tab-pane fade mt-3" id="racikan">
            <table class="table table-responsive table-bordered" id="tb-resep-racikan" width="100%">
                <thead>
                    <tr>
                        <th width="30%">Nama Racikan</th>
                        <th width="8%">Metode</th>
                        <th width="8%">Jumlah</th>
                        <th width="10%">Aturan Pakai</th>
                        <th width="10%">Subtotal</th>
                        <th width="6%"></th>
                    </tr>
                </thead>
                <tbody id="body_racikan">

                </tbody>
            </table>
            <button class="btn btn-primary btn-sm tambah_racik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
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
</div>
@push('script')
    <script>
        const btnTambahObatUmum = $('.tambah_umum')
        const bodyResepRacikan = $('#body_racikan')
        const bodyResepObatUmum = $('#tb-resep').find('tbody')

        function getResepObat(no_rawat) {
            $.get(`/erm/resep/obat/ambil`, {
                no_rawat: no_rawat
            }).done((response) => {
                if (!response.length) {
                    bodyResepObatUmum.empty();
                    bodyResepRacikan.empty();
                    formSoapPoli.find('textarea[name="rtl"]').val("-")
                    return;
                }
                response.map((val) => {
                    getObatResepUmum(val.no_resep)
                    getResepRacikan(val.no_resep)
                    tulisPlan(no_rawat)
                    $('.noResepText').text(val.no_resep);
                    $('.labelTglResep').text(`${formatTanggal(val.tgl_peresepan)} ${val.jam_peresepan}`);
                })
            })
        }

        function getObatResepUmum(no_resep) {
            $.get(`/erm/resep/umum/get/${no_resep}`).done((response) => {
                if (!response.length) {
                    bodyResepObatUmum.empty();
                    return;
                }
                const content = response.map((val, index) => {
                    const total = val.data_barang.ralan * val.jml;
                    return `<tr class="obatUmum-${val.kode_brng}" title="${val.data_barang.letak_barang}">
                    <td>${val.data_barang.nama_brng}</td>
                    <td>${val.jml}</td>
                    <td>${val.aturan_pakai}</td>
                    <td class="text-end">
                        <span>${formatCurrency(val.data_barang.ralan)}</span>
                    </td>
                    <td class="labelTotalObatUmum text-end" data-number="${total}">
                        ${formatCurrency(total)}
                    </td>
                    <td>
                        <div class="d-flex justify-content-start gap-2 actionsObatUmum">
                            <span class="text-danger deleteObatUmum" style="cursor: pointer" onclick="deleteObatUmum('${no_resep}', '${val.kode_brng}' )"><i class="bi bi-trash"></i></span>    
                            <span class="text-warning editObatUmum" style="cursor: pointer" onclick="editObatUmum('${no_resep}', '${val.kode_brng}' )"><i class="bi bi-pencil"></i></span>    
                        </div>
                    </td>
                    </tr>`
                })
                bodyResepObatUmum.html(content)
                totalObatUmum()
            })
        }

        function getResepRacikan(no_resep) {
            $.get(`/erm/resep/racik/ambil`, {
                no_resep: no_resep
            }).done((response) => {
                if (!response.length) {
                    bodyResepRacikan.empty();
                }
                const content = response.map((val) => {
                    const subtotal = val.detail.reduce((sum, item) => {
                        return sum + (parseInt(item.databarang.ralan) * parseInt(item.jml));
                    }, 0);


                    const obat = val.detail.map((item) => {
                        return `<span class="badge bg-success">${item.databarang.nama_brng} (${item.kandungan} mg)</span>`
                    })
                    const rowObat = `<tr class="table-sm">
                      
                            <td colspan="5">${obat.join('|')}</td>
                            <td></td>
                        </tr>`
                    return `<tr class="racikan-${val.no_racik}">
                                    <td>${val.nama_racik}</td>
                                    <td>${val.metode.nm_racik}</td>
                                    <td>${val.jml_dr}</td>  
                                    <td>${val.aturan_pakai}</td>
                                    <td class="subtotalRacikan text-end" data-number="${subtotal}">
                                        ${formatCurrency(subtotal)}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start gap-2 actionsRacikan">
                                            <span class="text-danger deleteRacikan" style="cursor: pointer" onclick="hapusRacikan('${no_resep}', '${val.no_racik}' )"><i class="bi bi-trash" title="Hapus Racikan"></i></span>    
                                            <span class="text-warning editRacikan" style="cursor: pointer" onclick="editRacikan('${no_resep}', '${val.no_racik}' )"><i class="bi bi-pencil" title="Edit Racikan"></i></span>    
                                        </div>    
                                    </td>
                                </tr>
                                ${rowObat}`;
                });

                bodyResepRacikan.html(content)
                totalResepRacikan()
            })
        }

        function totalObatUmum() {

            let labelTotalObatUmum = 0;
            bodyResepObatUmum.find('.totalObatUmum').remove();
            $('.labelTotalObatUmum').each((index, el) => {
                const total = $(el).data('number');
                labelTotalObatUmum += parseInt(total);

            })
            totalRow = `
                <tr class="totalObatUmum">
                <th colspan="4" class="text-end">Total</th>
                <td colspan="" class="text-end">
                    ${formatCurrency(labelTotalObatUmum)}
                </td>
                <td colspan=""></td>

                </tr>`
            bodyResepObatUmum.append(totalRow);
        }

        function totalResepRacikan() {
            let totalRacikan = 0;
            $('.subtotalRacikan').each((index, el) => {
                const total = $(el).data('number');
                totalRacikan += parseInt(total);
            })

            totalRow = `
                <tr class="totalRacikan">
                <td colspan="4">Total</td>
                <td colspan="" class="text-end">
                    ${formatCurrency(totalRacikan)}
                </td>
                <td colspan=""></td>

                </tr>`
            bodyResepRacikan.append(totalRow);

        }

        function deleteObatUmum(no_resep, kode_brng) {
            const no_rawat = $('input[name="no_rawat"][value!=""]:first').val();
            Swal.fire({
                title: 'Yakin ?',
                text: "Anda tidak bisa mengembalikan lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/resep/umum/hapus',
                        method: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_resep: no_resep,
                            kode_brng: kode_brng,
                        },
                    }).done(function() {
                        swalToast('Berhasil Hapus Obat')
                        getResepObat(no_rawat)
                    }).fail(function(request) {
                        Swal.fire('Gagal !', 'Tidak menghapus obat<br/>' + request.responseJSON.message, 'error', )
                    })
                }
            })
        }

        const editObatUmum = (no_resep, kode_brng) => {
            const row = $(`.obatUmum-${kode_brng}`);
            const namaObat = row.find('td:eq(0)').text();
            const jumlah = row.find('td:eq(1)').text();
            const aturanPakai = row.find('td:eq(2)').text();
            const harga = row.find('td:eq(3)').text().split();
            const hargaTotal = row.find('td:eq(4)').text();

            btnTambahObatUmum.addClass('d-none');

            $.get(`/erm/obat/get/${kode_brng}`).done((response) => {
                let html = `
            <td>
                <input type="search" 
                       autocomplete="off" 
                       class="form-control form-control-sm nama_obat_umum form-underline" 
                       name="nama_obat_umum" 
                       value="${response.nama_brng}" 
                       readonly />
            </td>
            <td>
                <input type="search" 
                       autocomplete="off" 
                       class="form-control form-control-sm jml_umum form-underline" 
                       name="jml_umum" 
                       value="${jumlah}" 
                       onkeypress="return hanyaAngka(event)" />
            </td>
            <td>
                <input type="search" 
                       autocomplete="off" 
                       class="form-control form-control-sm aturan_pakai form-underline" 
                       name="aturan_pakai" 
                       value="${aturanPakai}" />
                <div class="list_aturan"></div>
            </td>
            <td>
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <span class="labelHarga">${harga}</span>
                    <input type="hidden" id="harga" name="harga" value="${response.ralan}" />
                </div>
            </td>
            <td>
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <span class="labelSubTotalHarga">${hargaTotal}</span>
                </div>
            </td>
            <td>
                <div class="status d-flex justify-content-start gap-2">
                    <button type="button" 
                            class="btn btn-primary btn-sm" 
                            onclick="updateObatUmum(${no_resep}, '${kode_brng}')" 
                            style="font-size:10px">
                        <i class="bi bi-floppy"></i>
                    </button>
                    <button type="button" 
                            class="btn btn-danger btn-sm" 
                            onclick="cancelUpdateObatUmum(${no_resep})" 
                            style="font-size:12px">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
            </td>
        `;

                row.html(html);
                hitungHarga();
            });
        };


        const cancelUpdateObatUmum = (no_resep) => {
            btnTambahObatUmum.removeClass('d-none')
            getObatResepUmum(no_resep)
        }

        const updateObatUmum = (no_resep, kode_brng) => {
            const jumlah = $(`.obatUmum-${kode_brng}`).find('td:eq(1)').find('.jml_umum').val();
            const aturanPakai = $(`.obatUmum-${kode_brng}`).find('td:eq(2)').find('.aturan_pakai').val();
            const no_rawat = $('input[name="no_rawat"][value!=""]:first').val();
            $.post(`/erm/resep/umum/ubah`, {
                _token: "{{ csrf_token() }}",
                no_resep: no_resep,
                kode_brng: kode_brng,
                jml: jumlah,
                aturan_pakai: aturanPakai,
            }).done(function(response) {
                getResepObat(no_rawat)
                btnTambahObatUmum.removeClass('d-none')
                swalToast('Berhasil Mengubah Obat')
                tulisPlan()
            }).fail((error) => {
                Swal.fire({
                    icon: 'error',
                    title: `Terjadi Kesalahan`,
                    html: `${error.status} : ${error.statusText}`,
                })
            })

        }

        const deleteResep = () => {
            const noResep = $('.noResepText').text();
            const no_rawat = formSoapPoli.find('[name=no_rawat]').val();

            Swal.fire({
                title: 'Yakin ?',
                text: "Anda menghapus resep ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((response) => {
                if (response.isConfirmed) {
                    $.ajax({
                        url: `/erm/resep/delete/${noResep}`,
                        type: 'delete',
                        dataType: 'json',
                    }).done((response) => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            html: 'Resep dihapus',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        formSoapPoli.find('[name=rtl]').val('-');
                        getResepObat(no_rawat)
                        tulisPlan()

                        $('.no_resep').val('')
                        $('.noResepText').text('')
                        $('.labelTglResep').text(``);
                    })
                }
            })


        }

        function createResep(kd_dokter, no_rawat) {
            $.post(`/erm/resep/create`, {
                _token: "{{ csrf_token() }}",
                kd_dokter: kd_dokter,
                no_rawat: no_rawat,
            }).done((response) => {
                tulisPlan()
                $('.no_resep').val(response.no_resep)
                $('.noResepText').text(response.no_resep)
                $('.labelTglResep').text(`${formatTanggal(response.tgl_peresepan)} ${response.jam_peresepan}`);
            })
        }

        function tambahUmum() {

            const no_resep = $('.noResepText').text();
            const no_rawat = formSoapPoli.find('[name=no_rawat]').val();
            const no_rkm_medis = formSoapPoli.find('[name=no_rkm_medis]').val();
            const kd_dokter = formSoapPoli.find('[name=kd_dokter]').val();

            if (!no_resep) {
                createResep(kd_dokter, no_rawat)
            }

            html = '<tr>';
            html += `<td>
                            <input type="hidden" class="kode_obat_umum"/>
                            <input type="text" onkeyup="cariObat(this, event)" autocomplete="off" class="form-control form-control-sm nama_obat_umum form-underline" name="nama_obat_umum" /><div class="list_obat"></div>
                            </td>`;
            html += '<td>';
            html +=
                '<input type="text" class="jml_umum form-control form-control-sm form-underline"/>';
            html += '</td>';
            html += '<td>';
            html +=
                '<input type="text" onkeyup="cariAturan(this, event)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';

            html += `<td>
                            <x-input type="hidden" id="harga" name="harga" readonly/>
                            
                            <span class="labelHarga"></span>
                            </td>`

            html += `<td>
                                <span class="labelSubTotalHarga"></span>
                        </td>`
            html += `<td>
                                <div class="status d-flex justify-content-start gap-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="createObatUmum()" style="font-size:12px"><i class="bi bi-floppy"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-x"></i></button>
                                </div>
                        </td>`;

            html += '</tr>';
            $('#tb-resep tbody').append(html)
            totalObatUmum()

            hitungHarga();
            btnTambahObatUmum.addClass('d-none')


        }

        $('#tb-resep tbody').on('click', '.hapus-baris', function() {
            $(this).closest('tr').remove();
            btnTambahObatUmum.removeClass('d-none')
        })

        $('#tb-resep-racikan tbody').on('click', '.hapus-baris', function(e) {
            e.preventDefault();
            row = $(this).parents('td').parents('tr').remove();
            $('.btn-racikan').fadeIn()
            totalResepRacikan();
            $('.tambah_racik').removeClass('d-none')
            return false;
        })




        const hitungHarga = () => {
            $('.jml_umum').on('change', function(e) {
                const jumlah = $(this).val();
                const harga = $(this).closest('tr').find('#harga').val();
                const total = toRupiah(jumlah * harga);
                $(this).closest('tr').find('.labelSubTotalHarga').text(`Rp. ${total}`);

            })
        }



        function ambilObat(param) {

            $('.nama_obat_umum').val($(param).data('nama'));
            $('.kode_obat_umum').val($(param).data('id'))
            const harga = $(param).data('harga');
            $('#harga').val(harga);
            $('.labelHarga').text(toRupiah(harga));
            $('.jml_umum ').val(1).trigger('change');
        }

        function tambahRacikan() {

            const no_resep = $('.noResepText').text();
            const no_rawat = formSoapPoli.find('[name=no_rawat]').val();
            const no_rkm_medis = formSoapPoli.find('[name=no_rkm_medis]').val();
            const kd_dokter = formSoapPoli.find('[name=kd_dokter]').val();



            if (!no_resep) {
                $.post(`/erm/resep/create`, {
                    _token: "{{ csrf_token() }}",
                    kd_dokter: kd_dokter,
                    no_rawat: no_rawat,
                }).done((response) => {
                    $('.no_resep').val(response.no_resep)
                    $('.noResepText').text(response.no_resep)
                    $('.labelTglResep').text(`${formatTanggal(response.tgl_peresepan)} ${response.jam_peresepan}`);
                })
            }

            html = '<tr>';
            html += '<td>';
            html +=
                '<input type="search" autocomplete="off" onkeyup="cariRacikan(this, event)" class="form-control form-control-sm nm_racik form-underline" name="nm_racik"/><input type="hidden" class="id_racik" /><div class="list_racik"></div>';
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
                '<input type="search" onkeyup="cariAturan(this, event)" autocomplete="off" class="form-control form-control-sm aturan_pakai form-underline" name="aturan_pakai" /><div class="list_aturan"></div>';
            html += '</td>';
            html += `<td></td>`
            html += '<td>';
            html +=
                '<div class="status"><button type="button" class="btn btn-primary btn-sm" onclick="simpanRacikan()" style="font-size:12px"><i class="bi bi-plus-circle"></i></button><button type="button" class="btn btn-danger btn-sm hapus-baris" style="font-size:12px"><i class="bi bi-trash"></i></button></div>';
            html += '</td>';
            html += '</tr>';
            $('#tb-resep-racikan tbody').append(html)

            const rowTotalRacikan = $('.totalRacikan')
            rowTotalRacikan.detach();
            $('#tb-resep-racikan tbody').append(rowTotalRacikan);
            $('.tambah_racik').addClass('d-none')
        }

        function simpanRacikan() {
            const no_resep = $('.noResepText').text();
            const id_template = $('.id_racik').val();
            const jml_dr = $('.jml_dr').val()
            const aturan_pakai = $('.aturan_pakai').val()
            const nama_racik = $('.nm_racik').val()
            const kd_racik = $('.kd_racik').find(":selected").val()

            if (nama_racik && aturan_pakai && jml_dr) {
                $.ajax({
                    url: '/erm/resep/racik/simpan',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_resep: no_resep,
                        nama_racik: nama_racik,
                        kd_racik: kd_racik,
                        jml_dr: jml_dr,
                        aturan_pakai: aturan_pakai,
                        keterangan: '-',
                        id_template: id_template,

                    },
                    method: 'POST',

                }).done(function(response) {
                    tulisPlan()
                    getResepRacikan(no_resep)
                    editRacikan(no_resep, response.data.no_racik)

                    $('.tambah_racik').removeClass('d-none')
                }).fail(function(request) {
                    Swal.fire(
                        'Gagal !',
                        request.responseJSON.message,
                        'error'
                    );
                })
            } else {
                textObat = nama_racik ? '' : '<b class="text-danger" >Nama Racikan, </b>';
                textJml = jml_dr ? '' : '<b class="text-danger"> Jumlah, </b>';
                textAturan = aturan_pakai ? '' : '<b class="text-danger"> Aturan Pakai</b>';

                Swal.fire(
                    'Gagal !',
                    'Kolom ' + textObat + textJml + textAturan + 'obat racikan tidak boleh kosong',
                    'error'
                )
            }

        }


        function createObatUmum() {
            const no_resep = $('.noResepText').text()
            const kode_obat = $('.kode_obat_umum').val()
            const jml = $('.jml_umum').val()
            const aturan_pakai = $('.aturan_pakai').val()
            const no_rawat = $('#nomor_rawat').val()
            const kd_dokter = $('#kd_dokter').val()



            if (kode_obat && jml && aturan_pakai) {
                $.ajax({
                    url: '/erm/resep/umum/simpan',
                    method: 'POST',
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'no_resep': no_resep,
                        'kode_brng': kode_obat,
                        'jml': jml,
                        'status': 'ralan',
                        'aturan_pakai': aturan_pakai,
                        'no_rawat': no_rawat,

                    },
                    success: function(response) {
                        getObatResepUmum(no_resep)
                        btnTambahObatUmum.removeClass('d-none')
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
                    'Kolom ' + textObat + textJml + textAturan + 'obat tidak boleh kosong',
                    'error'
                )
            }

        }

        function editRacikan(no_resep, no_racik) {
            const formTabelRacikan = $('#formTabelRacikan');
            const tableDetailRacikan = $('#tableDetailRacikan').find('tbody');
            $.get(`/erm/resep/racik/ambil`, {
                no_resep: no_resep,
                no_racik: no_racik,
            }).done((response) => {
                formTabelRacikan.find(`[name=no_resep]`).val(no_resep);
                formTabelRacikan.find(`[name=no_racik]`).val(no_racik);
                formTabelRacikan.find(`[name=nama_racik]`).val(response.nama_racik);
                formTabelRacikan.find(`[name=jml_dr]`).val(response.jml_dr);
                formTabelRacikan.find(`[name=aturan_pakai]`).val(response.aturan_pakai);
                formTabelRacikan.find(`[name=metode]`).val(response.kd_racik).change();
                formTabelRacikan.find(`[name=nomorObat]`).val(response.detail.length);

                const contentObat = response.detail.map((val, index) => {
                    const subtotal = (parseInt(val.databarang.ralan) * parseInt(val.jml));
                    return `
                    <tr id="obat-${index}">
                        <td>
                            <x-input id="kode_brng_${index}" class="kode_brng_${index}" name="kode_brng[]" value="${val.kode_brng}" type="hidden" />
                            <x-input id="nama_obat_${index}" class="nama_obat_${index} form-underline" name="nm_brng[]" value="${val.databarang.nama_brng}" onkeyup="cariObatRacikan(this, ${index}, event)" type="search" />
                            <div class="list_obat_${index}"></div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <x-input id="kps${index}" class="kps${index} form-underline" name="kps[]" value="${val.databarang.kapasitas}" readonly type="search" />
                                <span class="mt-2">mg</span>
                            </div>    
                        </td>
                        <td>
                            <x-input-group class="input-group-sm">
                                <x-input id="p1${index}" class="p1${index} form-underline" name="p1[]" value="${val.p1}" type="search" onfocusout="setNilaiPembagi(this)" onchange="hitungObatRacik(${index})" autocomplete="off" onkeypress="return hanyaAngka(event)"/>
                                <x-input-group-text>/</x-input-group-text>
                                <x-input id="p2${index}" class="p2${index} form-underline" name="p2[]" value="${val.p2}" type="search" onfocusout="setNilaiPembagi(this)" onchange="hitungObatRacik(${index})"  autocomplete="off" onkeypress="return hanyaAngka(event)"/>
                            </x-input-group>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <x-input id="kandungan${index}" class="kandungan${index} form-underline" name="kandungan[]" value="${val.kandungan}" onchange="hitungDosis(${index})" type="search" />
                                <span class="mt-2">mg</span>
                            </div>     
                        </td>
                        <td id="labelHargaBarang${index}" data-number="${val.databarang.ralan}" class="text-end">
                            ${formatCurrency(val.databarang.ralan)}
                        </td>
                        <td>
                            <x-input id="jml_obat${index}" class="jml_obat${index} form-underline" name="jml[]" value="${val.jml}" type="search" oninput="hitungByJumlah(${index})" autocomplete="off" onkeypress="return hanyaAngka(event)" />
                        </td>
                        <td class="labelSubTotalBarang text-end" id="labelSubTotalBarang${index}">
                            ${formatCurrency(subtotal)}
                        </td>
                        <td>
                             <a href="javascript:void(0)" data-no="${index}" type="button" 
                                    class="btn btn-danger btn-sm x form-label mb-0">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                        `
                })

                $(`#modalObatRacik`).modal('show');
                tableDetailRacikan.html(contentObat);

                //tambah row di akhir table dengan total harga 
                const total = response.detail.reduce((total, val) => {
                    return total + (parseInt(val.databarang.ralan) * parseInt(val.jml));
                }, 0);

                const contentTotal = `
                <tr id="rowTotalBarangRacikan">
                    <td colspan="6">Total</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <span>Rp. </span>    
                            <span id="labelTotalBarangRacikan">${toRupiah(total)}</span>
                        </div>
                        
                    </td>
                    <td></td>
                </tr>
                `
                tableDetailRacikan.append(contentTotal);


            })
            // ambilRacikan(no_resep, no_racik).done((item) => {
            //     console.log('ITEM ---', item);
            //     $('#modalObatRacik').modal('show');

            //     // $('.no_resep').val(racikan.no_resep);
            //     // $('.metode').val(racikan.metode.nm_racik);
            //     // $('.nm_racik').val(racikan.nama_racik);
            //     // $('.no_racik').val(no_racik);
            //     // $('.jml_dr').val(racikan.jml_dr);
            //     // $('.aturan_pakai').val(racikan.aturan_pakai);
            //     // ambilObatRacikan();
            // })
        }
    </script>
@endpush
