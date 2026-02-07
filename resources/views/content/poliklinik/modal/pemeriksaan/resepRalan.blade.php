<div id="formInfoPasienResep">
    <input type="hidden" class="no_resep form-control form-control-sm" name="no_resep" />
    <input type="hidden" name="no_rawat" id="no_rawat" />
    <input type="hidden" name="no_rkm_medis" id="no_rkm_medis" />
    <input type="hidden" name="kd_dokter" id="kd_dokter" />
    <input type="hidden" name="status_lanjut" id="status_lanjut" />
    <input type="hidden" name="kelasHarga" id="kelasHarga" />

</div>
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
        <div class="tab-pane fade" id="riwayat" style="max-height: 50vh;overflow: auto">
            <table class="table table-responsive table-bordered tb-resep-riwayat" id="" width="100%">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th width="40%">Non-Racikan</th>
                        <th width="40%">Racikan</th>
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
            const status = $('#formInfoPasienResep').find('#status_lanjut').val();

            $.get(`/erm/resep/obat/ambil`, {
                no_rawat: no_rawat,
                status: status
            }).done((response) => {
                if (status === 'ranap') {
                    getResepRawatInap(no_rawat)
                }
                if (!response.length) {
                    bodyResepObatUmum.empty();
                    bodyResepRacikan.empty();
                    formSoapPoli.find('textarea[name="rtl"]').val("-")
                    $('.noResepText').text('');
                    $('.labelTglResep').text(``);
                    return;
                }

                response.map((val) => {
                    getObatResepUmum(val.no_resep)
                    getResepRacikan(val.no_resep)
                    tulisPlan()
                    $('.noResepText').text(val.no_resep);
                    $('.labelTglResep').text(`${formatTanggal(val.tgl_peresepan)} ${val.jam_peresepan}`);
                })

            })
        }

        function tulisPlan() {
            const no_rawat = $('#formInfoPasienResep').find('#no_rawat').val();
            const status = $('#formInfoPasienResep').find('#status_lanjut').val();
            $.ajax({
                url: '/erm/resep/obat/ambil',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                    status: status,
                },
                success: function(response) {
                    let teksRd = '';
                    let teksRr = '';
                    $.map(response, function(res) {
                        $.map(res.resep_dokter, function(rd) {
                            teksRd += `${rd.data_barang.nama_brng}, jml : ${rd.jml} ${rd.data_barang.kode_satuan.satuan} aturan pakai ${rd.aturan_pakai} \n`;
                        })

                        $.map(res.resep_racikan, function(rr) {
                            teksRr += `${rr.metode.nm_racik} ${rr.nama_racik}, jml : ${rr.jml_dr} aturan pakai ${rr.aturan_pakai}, isian :  \n`
                            let no = 1
                            $.map(rr.detail_racikan, function(dr) {
                                if (rr.no_racik == dr.no_racik) {
                                    teksRr += `   - ${dr.databarang.nama_brng} dosis ${dr.kandungan} mg, jml : ${dr.jml} \n`
                                    no++;
                                }
                            })
                            teksRr += '\n';
                        })

                    })

                    formSoapPoli.find('textarea[name="rtl"]').val(teksRd + '\n' + teksRr);
                    $('#formSoapRanap').find('textarea[name=plan]').val(teksRd + '\n' + teksRr);
                    $('#formSoapUgd').find('textarea[name=plan]').val(teksRd + '\n' + teksRr);


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
            const no_rawat = $('#formInfoPasienResep').find('#no_rawat').val();
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
            const no_rawat = $('#formInfoPasienResep').find('[name=no_rawat]').val();
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
            const no_rawat = $('#formInfoPasienResep').find('[name=no_rawat]').val();

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
                    }).fail((error) => {
                        Swal.fire({
                            icon: 'error',
                            title: `Terjadi Kesalahan!`,
                            html: `<h4 class="text-danger">${error.responseJSON?.message}</h4> ${error.status} : ${error.statusText}`,
                        })
                    })
                }
            })


        }

        function createResep(kd_dokter, no_rawat) {
            const formInfoPasienResep = $('#formInfoPasienResep')
            const status_lanjut = formInfoPasienResep.find('[name=status_lanjut]').val();
            $.post(`/erm/resep/create`, {
                _token: "{{ csrf_token() }}",
                kd_dokter: kd_dokter,
                no_rawat: no_rawat,
                status: status_lanjut,
            }).done((response) => {
                tulisPlan()
                $('.no_resep').val(response.no_resep)
                $('.noResepText').text(response.no_resep)
                $('.labelTglResep').text(`${formatTanggal(response.tgl_peresepan)} ${response.jam_peresepan}`);
            })
        }

        function tambahUmum() {

            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_resep = $('.noResepText').text();
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            const no_rkm_medis = formInfoPasienResep.find('[name=no_rkm_medis]').val();
            const kd_dokter = formInfoPasienResep.find('[name=kd_dokter]').val();

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

            const formInfoPasienResep = $('#formInfoPasienResep')
            const no_resep = $('.noResepText').text();
            const no_rawat = formInfoPasienResep.find('[name=no_rawat]').val();
            const no_rkm_medis = formInfoPasienResep.find('[name=no_rkm_medis]').val();
            const kd_dokter = formInfoPasienResep.find('[name=kd_dokter]').val();

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

            const formInfoPasienResep = $('#formInfoPasienResep')

            const no_resep = $('.noResepText').text()
            const kode_obat = $('.kode_obat_umum').val()
            const jml = $('.jml_umum').val()
            const aturan_pakai = $('.aturan_pakai').val()
            const no_rawat = formInfoPasienResep.find('#no_rawat').val()
            const kd_dokter = formInfoPasienResep.find('#kd_dokter').val()

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
                console.log('RESPONSE EDIT ===', response);
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

        let selectedRacikanIndex = -1;

        function cariRacikan(racik, e) {
            // let $list = $(".list_racik ul li");

            let $list = $(racik).siblings(".list_racik").find("ul li");

            if (e.key === "ArrowDown") {
                if (selectedRacikanIndex < $list.length - 1) {
                    selectedRacikanIndex++;
                }
                setActiveAturan($list, selectedRacikanIndex);
                return;
            }

            if (e.key === "ArrowUp") {
                if (selectedRacikanIndex > 0) {
                    selectedRacikanIndex--;
                }
                setActiveAturan($list, selectedRacikanIndex);
                return;
            }

            if (e.key === "Enter") {
                if (selectedRacikanIndex >= 0 && $list.eq(selectedRacikanIndex).length) {
                    $list.eq(selectedRacikanIndex).trigger("click");
                }
                return;
            }
            $.ajax({
                url: '/erm/resep/racik/cari',
                data: {
                    'nm_racik': racik.value,
                    'kd_dokter': "{{ Request::get('dokter') }}",
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        html =
                            '<ul class="dropdown-menu show" style="width:auto;display:block;position:absolute;font-size:12px;max-height:200px;overflow-y:auto">';
                        $.map(response, function(data) {
                            html +=
                                '<li onclick="setNamaRacik(this)" data-nama="' + data.nm_racik + '" data-id="' + data.id + '"><a class="dropdown-item" href="#" style="overflow:hidden">' + data.nm_racik + '</a></li>'
                        })
                        html += '</ul>';
                        $('.list_racik').fadeIn().html(html);
                    }

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

        let selectedIndex = -1; // posisi item aktif
        function cariObat(obat, e) {
            const kelas = $('#formInfoPasienResep').find('input[name="kelasHarga"]').val();
            // Navigasi keyboard
            let $list = $(".list_obat ul li");
            if (e.key === "ArrowDown") {
                if (selectedIndex < $list.length - 1) {
                    selectedIndex++;
                }
                setActive($list);
                return;
            }
            if (e.key === "ArrowUp") {
                if (selectedIndex > 0) {
                    selectedIndex--;
                }
                setActive($list);
                return;
            }
            if (e.key === "Enter") {
                if (selectedIndex >= 0 && $list.eq(selectedIndex).length) {
                    $list.eq(selectedIndex).trigger("click");
                }
                return;
            }

            // Ajax pencarian
            $.ajax({
                url: '/erm/obat/cari',
                data: {
                    'nama': obat.value
                },
                success: function(response) {

                    let html =
                        '<ul class="dropdown-menu show" style="width:auto;display:block;position:absolute;font-size:12px;max-height:200px;overflow-y:auto">';
                    $.map(response.data, function(data) {
                        console.log('kelas ===', kelas);
                        console.log('DATA HAGRA ===', data[kelas]);

                        $.map(data.gudang_barang, function(item) {
                            if (data && data.status != "0") {
                                if (item.stok) {
                                    html += `<li data-id="${data.kode_brng}" 
                                                data-stok="${item.stok}" 
                                                data-kapasitas="${data.kapasitas}" 
                                                data-nama="${data.nama_brng}" 
                                                data-harga="${data[kelas]}"
                                                onclick="ambilObat(this)">
                                                <a class="dropdown-item" href="#">
                                                    ${data.nama_brng} 
                                                    <span class="text-primary">
                                                        - Rp. ${toRupiah(data[kelas])} - 
                                                        <i><b>Stok (${item.stok})</b></i>
                                                    </span><br/>
                                                    <span class="text-disable" style="font-size:9px;color:#8b8b8b">
                                                        Kandungan : ${data.letak_barang}
                                                    </span>
                                                </a>
                                            </li>`;
                                } else {
                                    html += `
                                        <li class="disable" 
                                            data-id="${data.kode_brng}" 
                                            data-stok="${item.stok}">
                                            <a class="dropdown-item text-danger" href="#">
                                                ${data.nama_brng} - Rp. ${toRupiah(data[kelas])} - <b>Stok Kosong</b>
                                                <br/><span class="text-disable" style="font-size:9px;color:#8b8b8b">
                                                        Kandungan : ${data.letak_barang}
                                                </span>
                                            </a>
                                             
                                        </li>
                                    `;
                                }
                            }
                        });
                    });
                    html += '</ul>';
                    $('.list_obat').fadeIn().html(html);
                    selectedIndex = -1; // reset setiap kali pencarian baru
                }
            });
        }

        function setActive($list) {
            // reset semua
            $list.removeClass("active").find("span").addClass("text-primary");

            if (selectedIndex >= 0) {
                let $activeItem = $list.eq(selectedIndex);
                $activeItem.addClass("active");
                $activeItem.find("span").removeClass("text-primary");

                // auto scroll supaya item selalu kelihatan
                let container = $(".list_obat ul")[0];
                let item = $activeItem[0];
                if (item && container) {
                    container.scrollTop = item.offsetTop - container.offsetTop;
                }
            }
        }

        function setActiveRacikan($list) {
            // reset semua
            $list.removeClass("active").find("span").addClass("text-primary");

            if (selectedIndex >= 0) {
                let $activeItem = $list.eq(selectedIndex);
                $activeItem.addClass("active");
                $activeItem.find("span").removeClass("text-primary");

                // auto scroll supaya item selalu kelihatan
                let container = $(".list_racik ul")[0];
                let item = $activeItem[0];
                if (item && container) {
                    container.scrollTop = item.offsetTop - container.offsetTop;
                }
            }
        }


        // function cariAturan(aturan) {
        //     $.ajax({
        //         url: '/erm/resep/cari',
        //         data: {
        //             'aturan_pakai': aturan.value,
        //         },
        //         success: function(response) {
        //             if (response) {
        //                 html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
        //                 $.map(response, function(data) {
        //                     html +=
        //                         '<li onclick="ambilAturan(this)" ><a class="dropdown-item" href="#" style="overflow:hidden">' +
        //                         data.aturan_pakai + '</a></li>'
        //                 })
        //                 html += '</ul>';
        //                 $('.list_aturan').fadeIn();
        //                 $('.list_aturan').html(html);
        //             }
        //         }
        //     })
        // }

        let aturanIndex = -1; // global index aktif untuk navigasi aturan

        function cariAturan(aturan, e) {
            let $list = $(aturan).siblings(".list_aturan").find("ul li");

            if (e.key === "ArrowDown") {
                if (aturanIndex < $list.length - 1) {
                    aturanIndex++;
                }
                setActiveAturan($list, aturanIndex);
                return;
            }

            if (e.key === "ArrowUp") {
                if (aturanIndex > 0) {
                    aturanIndex--;
                }
                setActiveAturan($list, aturanIndex);
                return;
            }

            if (e.key === "Enter") {
                if (aturanIndex >= 0 && $list.eq(aturanIndex).length) {
                    $list.eq(aturanIndex).trigger("click");
                }
                return;
            }

            // kalau bukan navigasi, lakukan pencarian ajax
            $.ajax({
                url: '/erm/resep/cari',
                data: {
                    'aturan_pakai': aturan.value
                },
                success: function(response) {
                    if (response) {
                        let html = `
                    <ul class="dropdown-menu show" 
                        style="width:auto;display:block;position:absolute;font-size:12px;max-height:200px;overflow-y:auto">
                `;

                        $.map(response, function(data) {
                            html += `
                        <li onclick="ambilAturan(this)" class="dropdown-item">${data.aturan_pakai}</li>`;
                        });

                        html += `</ul>`;
                        $(aturan).siblings('.list_aturan').fadeIn().html(html);

                        aturanIndex = -1; // reset index setiap kali pencarian baru
                    }
                }
            });
        }

        // --- Set Item Aktif ---
        function setActiveAturan($list, index) {
            $list.removeClass("active");
            if (index >= 0) {
                let $activeItem = $list.eq(index);
                $activeItem.addClass("active");

                // auto scroll supaya item aktif selalu kelihatan
                let container = $list.closest("ul")[0];
                let item = $activeItem[0];
                if (item && container) {
                    container.scrollTop = item.offsetTop - container.offsetTop;
                }
            }
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
            // console.log('PARAM ===', $(param), 'VALUE PARAM', param);
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
            $('.list-dokter').fadeOut();

        });


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
            const resep = $.ajax({
                url: '/erm/resep/obat/akhir',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    'tgl_peresepan': tanggal,
                    'tgl_perawatan': tanggal,
                },
            })
            return resep;

        }

        function cekResep(no_rawat) {
            $('#body_umum').empty();
            $('#body_racikan').empty();
            $('#body_riwayat').empty();
            $('.tambah_racik').css('visibility', 'visible')
            $('.tambah_umum').css('visibility', 'visible')
            let resep = $.ajax({
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
                                        $('.tambah_racik').css('visibility', 'hidden')
                                        $('.tambah_umum').css('visibility', 'hidden')
                                        html += '<td class="aksi"><button type="button" class="btn btn-success btn-sm" style="font-size:12px"><i class="bi bi-check"></i></button></td>';
                                    } else {
                                        $('.tambah_racik').css('visibility', 'visible')
                                        $('.tambah_umum').css('visibility', 'visible')
                                        html += '<td class="aksi"><button type="button" class="btn btn-danger btn-sm remove" style="font-size:12px" data-resep="' + resep.no_resep + '" data-obat="' + resep.kode_brng + '"><i class="bi bi-trash-fill"></i></button><button style="font-size:12px" type="button" class="btn btn-warning btn-sm ubah-obat" data-id="' + no +
                                            '"><i class="bi bi-pencil"></i></button><button type="button" class="btn btn-primary simpan-obat-' + no +
                                            ' btn-sm" style="font-size:12;visibility:hidden" onclick="ubahObatDokter(' + resep.no_resep + ', \'' + resep.kode_brng + '\', ' + no + ')"><i class="bi bi-plus-circle"></i></button></td>';
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
                                        $('.tambah_racik').css('visibility', 'hidden')
                                        $('.tambah_umum').css('visibility', 'hidden')

                                        const btnLihatDetail = `<button type="button" class="btn btn-success btn-sm" style="font-size:12px" onclick="showDetailRacikan('${resep.no_resep}', '${resep.no_racik}')">
                                                    <i class="bi bi-check"></i>
                                            </button>`

                                        $('.' + resep.no_resep + resep.no_racik).html(btnLihatDetail)
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

                        setNoResep().done((response) => {
                            if (Object.keys(response).length > 0) {
                                if (response.tgl_perawatan == '0000-00-00' && response.no_rawat == $('#nomor_rawat').val()) {
                                    nomor = response.no_resep;
                                } else {
                                    nomor = parseInt(response.no_resep) + 1
                                }
                            } else {
                                nomor = "{{ date('Ymd') }}" + '0001';
                            }
                            $('.no_resep').val(nomor)
                        })
                    }

                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Ada kesalahan pemuatan obat',
                        'error'
                    );
                }
            })

            return resep;
        }

        function riwayatResep(no_rm) {

            $('.tb-resep-riwayat tbody').empty()
            $.ajax({
                url: `/erm/resep/riwayat/${no_rm}`,
                method: 'GET',
            }).done((response) => {

                const resep = response.map((item) => {
                    let resepDokter = '';
                    let resepRacikan = '';
                    if (item.resep_dokter) {
                        resepDokter = item.resep_dokter.map((items) => {
                            return `<li>${items.data_barang.nama_brng} @${items.jml} ${items.data_barang?.kode_satuan?.satuan} ${items.aturan_pakai}</li>`
                        }).join('')
                    }
                    if (item.resep_racikan) {
                        resepRacikan = item.resep_racikan.map((items) => {
                            const obat = items.detail.map((itemsObat) => {
                                return `<span class="badge text-bg-success">${itemsObat.databarang.nama_brng}</span>`
                            }).join(', ')

                            return `<li>
                                           ${items.nama_racik} @${items.jml_dr} ${items.metode.nm_racik} ${items.aturan_pakai}<br/>
                                           ${obat}
                                    </li>`
                        }).join('')
                    }

                    if (item.tgl_penyerahan === '0000-00-00' && item.tgl_perawatan) {
                        return '';
                    }
                    return `<tr>
                                <td width="15%">${formatTanggal(item.tgl_peresepan)}</td>
                                <td><ul>${resepDokter}</ul></td>
                                <td><ul>${resepRacikan}</ul></td>
                                <td><button style="font-size:12px" class="btn btn-warning btn-sm" onclick="copyResep(${item.no_resep})" type="button"><i class="bi bi-clipboard-check-fill"></i> Copy Resep</button></td>

                            </tr>`

                    console.log('RESPO ===', item);
                })

                $('.tb-resep-riwayat tbody').html(resep)

                // $.map(response, (resep) => {
                //     if (resep.resep_dokter.length > 0 || resep.resep_racikan.length > 0) {
                //         html = `<tr>`
                //         html += `<td width="15%">${formatTanggal(resep.tgl_peresepan)} <br>${resep.no_resep}</td>`
                //         html += `<td><ul style="disc inside">`
                //         $.map(resep.resep_dokter, (dokter) => {
                //             html += `<li>${dokter.data_barang.nama_brng}, ${dokter.jml} ${dokter.data_barang.kode_satuan.satuan}, aturan pakai ${dokter.aturan_pakai}</li>`
                //         })
                //         $.map(resep.resep_racikan, (racikan) => {
                //             html += `<li>${racikan.nama_racik}, jumlah ${racikan.jml_dr} ${racikan.metode.nm_racik}, aturan pakai ${racikan.aturan_pakai}</li>`
                //             $.map(racikan.detail_racikan, (detail) => {
                //                 html += `<span class="badge rounded-pill text-bg-success">${detail.databarang.nama_brng}</span>`
                //             })
                //         })
                //
                //         html += `</ul></td>`
                //         html += `<td><button style="font-size:12px" class="btn btn-warning btn-sm" onclick="copyResep(${resep.no_resep})" type="button"><i class="bi bi-clipboard-check-fill"></i> Copy Resep</button></td>`;
                //         html += `<tr>`
                //         $('.tb-resep-riwayat tbody').append(html)
                //     }
                // })
            })
        }

        function getResepByRawat(noRawat) {
            const id = textRawat(noRawat, '-');
            const resep = $.ajax({
                url: '/erm/resep/get/rawat/' + id
            })
            return resep;
        }


        function getResepRawatInap(no_rawat) {
            const tbResepRawatInap = $('.tbResepRawatInap').find('tbody');
            tbResepRawatInap.empty();
            getResepByRawat(no_rawat).done((response) => {
                const content = response.map((item, index) => {

                    const resepDokter = item.resep_dokter.map((rd, index) => {
                        return `<li>${rd.data_barang.nama_brng}, @${rd.jml} ${rd.data_barang.kode_satuan.satuan} S: ${rd.aturan_pakai}</li>`;
                    })

                    const resepRacikan = item.resep_racikan.map((rr, index) => {
                        const racikan = `${rr.metode.nm_racik} ${rr.nama_racik}, jml : ${rr.jml_dr} aturan pakai ${rr.aturan_pakai}, isian :  </br>`
                        const detailRacikan = rr.detail_racikan.map((dr, index) => {
                            if (rr.no_racik == dr.no_racik) {
                                return `<span class="badge text-bg-success">${dr.databarang.nama_brng} dosis ${dr.kandungan} mg, jml : ${dr.jml} </span></br>`
                            }
                        })
                        return `${racikan}${detailRacikan.join('')}`
                    })
                    return `
                        <tr>
                            <td>
                                <ul>
                                    <li>
                                        Resep : ${item.tgl_peresepan} ${item.jam_peresepan}
                                    </li>
                                    <li>
                                        Proses : ${item.tgl_perawatan} ${item.jam}
                                    </li>
                                    <li>
                                        Penyerahan : ${item.tgl_penyerahan} ${item.jam_penyerahan}    
                                    </li>  
                                </ul>
                            </td>
                            <td>${item.no_resep}</td>
                            <td>${item.resep_dokter.length ? `<ul>${resepDokter.join('')}</ul>` : ''}</td>
                            <td>${item.resep_racikan.length ? `<ul>${resepRacikan.join('')}</ul>` : ''}</td>
                            
                        </tr>
                    `
                })

                tbResepRawatInap.html(content);

            })
        }
    </script>
@endpush
