<div class="card">
    <div class="card-body" style="height:40vh">
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
            <div class="tab-pane fade show active" id="umum" style="overflow-y: auto;max-height: 30vh">
                <table class="table table-striped table-responsive table-sm d-none" id="tbResepDokter" width="100%">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th width="10%" class="text-center">Jumlah</th>
                            <th width="35%">Aturan Pakai</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_umum">

                    </tbody>
                </table>
                <button class="btn btn-primary btn-sm d-none" id="btnTambahResepUmum" type="button" onclick="tambahObatUmum()">Tambah Obat</button>
                <button class="btn btn-success btn-sm d-none" id="btnSimpanResepUmum" type="button" onclick="createObatUmum()">Simpan</button>
            </div>
            <div class="tab-pane fade" id="racikan">
                <table class="table table-striped table-responsive table-sm d-none" id="tbResepRacikan" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama Racikan</th>
                            <th>Metode Racikan</th>
                            <th width="10%" class="text-center">Jumlah</th>
                            <th>Aturan Pakai</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="body_racikan">

                    </tbody>
                </table>
                <button class="btn btn-primary btn-sm d-none" id="btnTambahResepRacik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
            </div>
            <div class="tab-pane fade" id="riwayat" style="max-height: 250px; overflow-y: auto">
                <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Resep</th>
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
    <div class="card-footer" id="actionResep">
        <button class="btn btn-primary btn-sm" id="btnCreateResep" type="button" onclick="createResep()"><i class="bi bi-plus-circle-fill me-1"></i>Buat Resep</button>
        <button class="btn btn-danger btn-sm d-none" id="btnDeleteResep" type="button"><i class="bi bi-trash me-1"></i>Hapus Resep</button>
    </div>
</div>

@push('script')
    <script>
        const actionResep = $('#actionResep');
        const btnCreateResep = actionResep.find('#btnCreateResep')
        const btnDeleteResep = actionResep.find('#btnDeleteResep')
        const btnTambahResepUmum = $('#btnTambahResepUmum')
        const btnSimpanResepUmum = $('#btnSimpanResepUmum')
        const btnTambahResepRacik = $('#btnTambahResepRacik')
        const tbResepDokter = $('#tbResepDokter')
        const tbResepRacikan = $('#tbResepRacikan')


        function getResepObat(no_rawat) {
            $.get(`${url}/resep/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const hasData = !!response.data
                if (response.data) {
                    formSoapPoli.find('#no_resep').val(response.data.no_resep)
                    setResepDokter(response.data.resep_dokter)
                    setResepRacikan(response.data.resep_racikan)
                    btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                } else {
                    btnDeleteResep.removeAttr('onclick')
                }
                toggleElementResep(hasData)

            })
        }

        function toggleElementResep(hasData = true) {
            const elements = [
                btnDeleteResep,
                tbResepDokter,
                tbResepRacikan,
                btnTambahResepRacik,
                btnTambahResepUmum,
                btnSimpanResepUmum,
            ];
            const reserveElements = [btnCreateResep];

            elements.forEach(element => element.toggleClass('d-none', !hasData));
            reserveElements.forEach(element => element.toggleClass('d-none', hasData));
        }

        function setResepDokter(data) {
            if (data) {
                const row = data.map((item, index) => {
                    return `<tr id="rowObatDokter${index}">
                            <td id="obatDokter${index}" data-id="${item.kode_brng}">${item.data_barang.nama_brng}</td>
                            <td class="text-center" id="jmlObatDokter${index}">${item.jml}</td>
                            <td id="aturanPakaiDokter${index}">${item.aturan_pakai}</td>
                            <td id="aksiObatDokter${index}">
                                <button class="btn btn-warning btn-sm" type="button" onclick="editResepDokter('${index}', '${item.kode_brng}')"><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-danger btn-sm" type="button" onclick="deleteResepDokter('${item.no_resep}', '${item.kode_brng}')"><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>`
                }).join('');
                tbResepDokter.find('tbody').empty().append(row);
                return true;
            }
            tbResepDokter.find('tbody').empty()
        }

        function setResepRacikan(data) {
            console.log('DATA RACIK ===', data);
            if (data) {
                const row = data.map((item, index) => {
                    const detail = item.detail_racikan;
                    let rowDetail = '';
                    if (detail.length) {
                        const isiDetail = detail.map((item, index) => {
                            return `<span class="badge rounded-pill bg-warning text-dark" style="font-size:10px">${item.databarang.nama_brng} (${item.kandungan} mg)</span>`
                        }).join(' ')
                        rowDetail = `<tr><td></td><td colspan=5>${isiDetail}</td></tr>`;
                    }
                    return `<tr>
                            <td>${item.no_racik}</td>
                            <td>${item.nama_racik}</td>
                            <td>${item.metode.nm_racik}</td>
                            <td class="text-center">${item.jml_dr}</td>
                            <td>${item.aturan_pakai}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" type="button" ><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-sm btn-danger" type="button" ><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>${rowDetail}`
                    console.log('DETAIL ===', item.detail_racikan);
                })
                tbResepRacikan.find('tbody').empty().append(row)
                return true;
            }

        }

        function createResep() {
            const formSoapPoli = $('#formSoapPoli');
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            const dokter = formSoapPoli.find('select[name="dokter"]').val();

            console.log(role);

            if (role === 'dokter') {
                $.post(`${url}/resep/create`, {
                    '_token': "{{ csrf_token() }}",
                    'no_rawat': no_rawat,
                    'kd_dokter': dokter
                }).done((response) => {
                    toastReload(response.message, 2000)
                    btnDeleteResep.attr('onclick', `deleteResep(${response.data.no_resep})`)
                    toggleElementResep()
                    formSoapPoli.find('input[name=no_resep]').val(response.data.no_resep);
                }).fail((response) => {
                    alertErrorAjax(response);
                });

            } else {
                Swal.fire({
                    title: 'Gagal',
                    html: 'Anda tidak diperbolehkan membuat resep',
                    icon: 'error',
                })
            }
        }

        function deleteResep(no_resep) {
            $.ajax({
                url: `${url}/resep/delete/${no_resep}`,
                method: 'DELETE',
                data: {
                    '_token': "{{ csrf_token() }}"
                }
            }).done((response) => {
                toastReload(response.message, 2000)
                toggleElementResep(false)
                tbResepDokter.find('tbody').empty()
                tbResepRacikan.find('tbody').empty()
            })
        }

        function tambahObatUmum() {
            const rowCount = tbResepDokter.find('tbody').find('tr').length;
            const addRow = `<tr id="row${rowCount}">
                <td><select class="form-select2" data-dropdown-parent="#modalSoap" name="nm_obat[]" id="kdObat${rowCount}" data-id="${rowCount}" style="width:100%">
                    </select></td>
                <td>
                    <input type="hidden" name="rowNext" id="rowNext" value="${rowCount+1}"/>
                    <input type="hidden" name="kode_brng[]" id="kdObat${rowCount}Val"/>
                    <input type="number" class="form-control" name="jumlah[]" id="jmlObat${rowCount}"/>
                </td>
                <td><select class="" name="aturan_pakai[]" id="aturan${rowCount}" data-id="${rowCount}" data-dropdown-parent="#modalSoap" style="width:100%"></select></td>
                <td>
                    <button type="button" class="btn btn-sm btn-success " data-id="row${rowCount}" onclick="createBarisResepDokter('${rowCount}')"><i class="bi bi-check"></i></button>    
                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="row${rowCount}" onclick="hapusBarisObat('${rowCount}')"><i class="bi bi-x"></i></button>    
                </td>
            </tr>`;
            tbResepDokter.find('tbody').append(addRow);
            const aturanPakai = $(`#aturan${rowCount}`);
            selectDataBarang($(`#kdObat${rowCount}`))
            selectAturanPakai(aturanPakai).on('select2:select', (e) => {
                const aturan = e.currentTarget.value;
                $.post(`${url}/aturan/create`, {
                    '_token': "{{ csrf_token() }}",
                    'aturan': aturan
                }).done((response) => {
                    if (response.status === 'success') {
                        toastReload(response.message, 2000)
                        const optAturan = new Option(aturan, aturan, true, true);
                        aturanPakai.append(optAturan).trigger('change');
                    }
                })
            });
        }

        function selectDataBarang(element) {
            element.select2({
                delay: 2,
                scrollAfterSelect: true,
                ajax: {
                    url: `${url}/obat/cari`,
                    dataType: 'JSON',

                    data: (params) => {
                        const query = {
                            nama: params.term
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.data.map((item) => {
                                const stok = getStokBarang(item);
                                const ketStok = stok > 0 ? '' : 'text-danger';
                                const items = {
                                    id: item.kode_brng,
                                    text: `<span class="${ketStok}">${item.nama_brng}</span> <br/> Stok : ${stok}  <span class="text-muted">Rp.${toRupiah(item.ralan)}</span>`,
                                    name: `${item.nama_brng}`,
                                }
                                return items;

                            })
                        }
                    }

                },
                templateSelection: (item) => {
                    return item.name
                },
                escapeMarkup: (markup) => {
                    return markup;
                },
                cache: true
            }).on('select2:open', function() {
                setTimeout(function() {
                    $('.select2-search__field').focus();
                }, 100); // Adjust delay as needed
            });
        }

        function selectAturanPakai(element) {
            return element.select2({
                tags: true,
                ajax: {
                    url: `${url}/aturan/get`,
                    dataType: 'JSON',

                    data: (params) => {
                        const query = {
                            aturan: params.term
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.map((item) => {
                                const items = {
                                    id: item.aturan,
                                    text: item.aturan,
                                    name: item.aturan,
                                }
                                return items;
                            })
                        }
                    }

                },
            }).on('select2:select', (e) => {
                const aturan = e.currentTarget.value;
                $.post(`${url}/aturan/create`, {
                    '_token': "{{ csrf_token() }}",
                    'aturan': aturan
                }).done((response) => {
                    if (response.status === 'success') {
                        toastReload(response.message, 2000)
                        const optAturan = new Option(aturan, aturan, true, true);
                        aturanPakai.append(optAturan).trigger('change');
                    }
                })
            });
        }

        function getStokBarang(item) {
            return item.gudang_barang.filter((itemGudang) => {
                return itemGudang.kd_bangsal === 'RM7'
            }).map((filteredItem) => {
                return filteredItem.stok
            }).join('');
        }

        function createObatUmum() {
            const rowCount = tbResepDokter.find('tbody').find('tr').length
            const noResep = $(`#no_resep`).val();

            let dataObat = [];
            for (let index = 0; index <= rowCount; index++) {
                const findInput = $(`#row${index}`).find('input');
                if (findInput.length) {
                    const kodeBrng = $(`#kdObat${index}`).val();
                    const jml = $(`#jmlObat${index}`).val();
                    const aturanPakai = $(`#aturan${index}`).val();
                    const obat = {
                        'no_resep': noResep,
                        'kode_brng': kodeBrng,
                        'jml': jml,
                        'aturan_pakai': aturanPakai,
                    }
                    const isEmpty = Object.values(obat).filter((item) => {
                        return item == null || item == '';
                    }).length

                    if (isEmpty) {
                        return Swal.fire({
                            html: `Terdapat data yang kosong`,
                            title: `Peringatan`,
                            icon: 'warning',
                            confirmButtonText: 'Oke',
                        })

                    }
                    dataObat.push(obat)
                }
            }


            if (dataObat) {
                $.post(`${url}/resep/dokter/create`, {
                    dataObat: dataObat,
                    '_token': "{{ csrf_token() }}",
                }).done((response) => {
                    toastReload(response.message, 2000)
                    getResepDokter(noResep)
                    // const no_rawat = $('#formCpptRajal input[name=no_rawat]').val()
                    // $('#btnCetakResep').attr('onclick', `cetakResep('${no_rawat}')`)
                    // tulisPlan(noResep)
                    // setResepDokter(noResep)
                }).fail((error) => {
                    alertErrorAjax(error)
                })
            }
        }

        function getResepDokter(no_resep) {
            $.get(`${url}/resep/dokter/get/${no_resep}`).done((response) => {
                if (response.data) {
                    const row = response.data.map((item, index) => {
                        return `<tr id="rowObatDokter${index}">
                            <td id="obatDokter${index}" data-id="${item.kode_brng}">${item.data_barang.nama_brng}</td>
                            <td class="text-center" id="jmlObatDokter${index}">${item.jml}</td>
                            <td id="aturanPakanDokter${index}">${item.aturan_pakai}</td>
                            <td id="aksiObatDokter${index}">
                                <button class="btn btn-warning btn-sm" type="button" onclick="editResepDokter('${index}', '${item.kode_brng}')"><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-danger btn-sm" type="button" onclick="deleteResepDokter('${item.no_resep}', '${item.kode_brng}')"><i class="bi bi-x"></i></button> 
                            </td>
                        </tr>`
                    }).join('');
                    tbResepDokter.find('tbody').empty().append(row);
                    return true;
                }
                tbResepDokter.find('tbody').empty()
            }).fail((error) => {
                alertErrorAjax(error);
            })

        }

        function deleteResepDokter(no_resep, kode_brng) {
            $.ajax({
                url: `${url}/resep/dokter/delete`,
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                }
            }).done((response) => {
                getResepDokter(no_resep)
            }).fail((error) => {
                alertErrorAjax(error);
            })
        }

        function hapusBarisObat(id) {
            // const nextId = parseInt(id) + parseInt(1);
            $(`#row${id}`).remove();
            $('.btn-delete').each((index, item) => {
                $(`#row${id+1}`).attr('id', `row${id+1}`).find('button').attr('onclick', `hapusBarisObat(${id+1})`);
            })
        }

        function createBarisResepDokter(id) {
            const kode_brng = $(`#kdObat${id}`).val();
            const jml = $(`#jmlObat${id}`).val();
            const aturan = $(`#aturan${id}`).val();
            const no_resep = $(`#no_resep`).val();

            $.post(`${url}/resep/umum/simpan`, {
                'no_resep': no_resep,
                'kode_brng': kode_brng,
                'jml': jml,
                'aturan_pakai': aturan,
                '_token': "{{ csrf_token() }}",
            }).done((response) => {
                getResepDokter(no_resep)
            })
        }

        function editResepDokter(id, kode_brng) {
            const row = tbResepDokter.find('tbody').find(`#rowObatDokter${id}`)

            const no_resep = $(`#no_resep`).val();

            const colObat = row.find(`#obatDokter${id}`)
            const colJml = row.find(`#jmlObatDokter${id}`)
            const colAturan = row.find('td').find(`#aturanPakaiDokter${id}`)
            const colAksi = row.find(`#aksiObatDokter${id}`)

            console.log(row.find('td').find(`#aturanPakaiDokter${id}`));


            const jumlah = colJml.html()
            const kdObat = colObat.data('id')
            const aturan = colAturan.html()

            colAksi.empty();
            colJml.html('').append(`<input type="text" class="form-control" name="jml" id="jmlObatDokter${id}" value="${jumlah}"/>`)
            colAturan.html('').append(`<select name="aturan_pakai" id="selAturanPakaiDokter${id}" data-dropdown-parent="#modalSoap" style="width:100%">
                </select>`)
            colAksi.append(`
                <button type="button" class="btn btn-sm btn-success" onclick="updateResepDokter(${id}, '${kdObat}')"><i class="bi bi-check"></i></button>
                <button type="button" class="btn btn-sm btn-danger" onclick="hapusObatDokter(${no_resep}, '${kdObat}')"><i class="bi bi-x"></i></button>
            `);

            elAturanPakai = $(`#selAturanPakaiDokter${id}`);
            const optAturan = new Option(aturan, aturan, true, true);
            elAturanPakai.append(optAturan).trigger('change');
            selectAturanPakai(elAturanPakai)
        }

        function updateResepDokter(id, kode_brng) {
            const row = tbResepDokter.find('tbody');
            const no_resep = $('#no_resep').val();
            const jumlah = row.find(`#jmlObatDokter${id}`).find('input').val()
            const aturan_pakai = row.find(`#aturanPakaiDokter${id}`).find('select').val()

            const data = {
                kode_brng: kode_brng,
                jml: jumlah,
                aturan_pakai: aturan_pakai,
                no_resep: no_resep
            }

            $.ajax({
                url: `${url}/resep/dokter/update`,
                method: 'POST',
                data: {
                    no_resep: no_resep,
                    kode_brng: kode_brng,
                    jml: jumlah,
                    aturan_pakai: aturan_pakai,
                    _token: "{{ csrf_token() }}"
                },
            }).done((response) => {
                toastReload(response.message, 2000)
                getResepDokter(no_resep)
            }).fail((error) => {
                alertErrorAjax(error)
            })

            console.log(data);
        }
    </script>
@endpush
