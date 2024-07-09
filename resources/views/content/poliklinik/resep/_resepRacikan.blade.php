<table class="table table-striped table-responsive table-sm d-none" id="tbResepRacikan" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama Racikan</th>
            <th width="15%">Metode</th>
            <th width="15%" class="text-center">Jumlah</th>
            <th>Aturan Pakai</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody id="body_racikan">

    </tbody>
</table>
<div class="actionIsiResep">
    <button class="btn btn-primary btn-sm d-none" id="btnTambahResepRacik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
    <button class="btn btn-success btn-sm d-none" id="btnCreateResepRacik" type="button" onclick="createResepObatRacikan()">Simpan</button>
</div>

@push('script')
    <script>
        const tbResepRacikan = $('#tbResepRacikan')
        const btnTambahResepRacik = $('#btnTambahResepRacik')
        const btnCreateResepRacik = $('#btnCreateResepRacik')
        const btnDeleteResepRacikan = $('.btnDeleteResepRacikan')

        function tambahRacikan() {
            const rowCount = tbResepRacikan.find('tbody').find('.rowRacikan').length;
            const kd_dokter = formSoapPoli.find('#dokter').val()
            const addRow = `<tr id="row${rowCount}" class="rowRacikan">
                                    <input type="hidden" name="no_racik[]" id="no_racik${rowCount}" value="${rowCount + 1}" />
                                <td>${rowCount+1}</td>
                                <td>
                                    <select class="form-select2" data-dropdown-parent="#modalSoap" name="nm_racik[]" id="nm_racik${rowCount}" data-id="${rowCount}" style="width:100%"></select>
                                </td>
                                <td>
                                    <select class="" name="metode[]" id="metode${rowCount}" data-dropdown-parent="#modalSoap" style="width:100%"></select>
                                </td>
                                <td>
                                    <input type="hidden" name="rowNext" id="rowNext" value="${rowCount+1}"/>
                                    <input type="number" class="form-control" name="jml_dr[]" id="jml_dr${rowCount}"/>
                                </td>
                                <td>
                                    <select class="form-select2" name="aturan_pakai[]" id="aturan${rowCount}" data-id="${rowCount}" data-dropdown-parent="#modalSoap" style="width:100%"></select>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success" id="btnCreateBarisRacik${rowCount}" data-id="row${rowCount}" onclick="createBarisResepRacikan('${rowCount}')"><i class="bi bi-check"></i></button>    
                                    <button type="button" class="btn btn-sm btn-danger btn-delete-racik" id="btnDeleteBarisRacik${rowCount}" data-id="row${rowCount}" onclick="hapusBarisRacikan('${rowCount}')"><i class="bi bi-x"></i></button>    
                                </td>
                            </tr>`;
            tbResepRacikan.find('tbody').append(addRow);
            const metode = $(`#metode${rowCount}`);
            const aturanPakai = tbResepRacikan.find('tbody').find(`#aturan${rowCount}`);
            const nm_racik = tbResepRacikan.find('tbody').find(`#nm_racik${rowCount}`);
            selectMetodeRacik(metode)
            selectAturanPakai(aturanPakai)
            selectTemplateRacikan(nm_racik, kd_dokter)

        }

        function selectMetodeRacik(element) {
            return element.select2({
                ajax: {
                    url: `${url}/resep/racik/metode`,
                    dataType: 'JSON',
                    data: (params) => {
                        const query = {
                            metode: params.term
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.data.map((item) => {
                                const items = {
                                    id: item.kd_racik,
                                    text: item.nm_racik,
                                }
                                return items;
                            })
                        }
                    }

                },
            })
        }

        function selectTemplateRacikan(element, kd_dokter) {
            return element.select2({
                tags: true,
                ajax: {
                    url: `${url}/resep/racik/cari`,
                    dataType: 'JSON',
                    data: (params) => {
                        const query = {
                            nm_racik: params.term,
                            kd_dokter: kd_dokter
                        }
                        return query
                    },
                    processResults: (result) => {
                        return {
                            results: result.map((item) => {
                                const items = {
                                    id: item.id,
                                    text: item.nm_racik,
                                }
                                return items
                            })
                        }
                    }

                },
            })
        }

        function createResepObatRacikan() {
            const row = tbResepRacikan.find('tbody').find('tr')
            const no_resep = formSoapPoli.find('#no_resep').val();
            const no_rawat = formSoapPoli.find('#no_rawat').val();
            const kd_dokter = formSoapPoli.find('#dokter').val();

            const data = [];

            if (!row.length) {
                return Swal.fire({
                    title: 'Peringatan',
                    html: 'Tidak ada racikan yang dibuat',
                    icon: 'warning'
                });
            }


            for (let index = 0; index < row.length; index++) {
                const racikan = {
                    '_token': "{{ csrf_token() }}",
                    'no_resep': no_resep,
                    'no_racik': row.find(`#no_racik${index}`).val(),
                    'id': row.find(`#nm_racik${index}`).val(),
                    'nama_racik': row.find(`#nm_racik${index}`).find(":selected").text(),
                    'jml_dr': row.find(`#jml_dr${index}`).val(),
                    'kd_racik': row.find(`#metode${index}`).val(),
                    'aturan_pakai': row.find(`#aturan${index}`).val(),
                }

                if (row.find(`#no_racik${index}`).length) {
                    $.post(`${url}/resep/racik/simpan`,
                        racikan
                    ).done((response) => {
                        createObatTemplateRacikan(racikan.id, racikan.no_resep, racikan.no_racik).done(() => {
                            getResepObat(no_rawat)
                            setResepToPlan(no_rawat)
                        })
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }
            }
        }

        function createObatTemplateRacikan(id, resep, racik) {
            return $.get(`${url}/resep/racik/template/ambil`, {
                id: id
            }).done((response) => {
                if (Object.values(response).length > 0) {
                    const dataObat = response.detail.map((item, index) => {
                        return {
                            no_resep: resep,
                            no_racik: racik,
                            kode_brng: item.kode_brng,
                            p1: 1,
                            p2: 1,
                            kandungan: 0,
                            jml: 0
                        }
                    });

                    $.post(`${url}/resep/racik/detail/create/batch`, {
                        _token: "{{ csrf_token() }}",
                        dataObat: dataObat
                    }).done((response) => {
                        toastReload(response.message, 2000)
                    })

                }
                getResepRacikan(resep)

            }).fail((error) => {
                alertErrorAjax(error)
            })
        }

        function createBarisResepRacikan(id) {
            const row = tbResepRacikan.find('tbody').find('tr')
            const no_resep = formSoapPoli.find('#no_resep')
            const no_rawat = formSoapPoli.find('#no_rawat').val()

            const racikan = {
                '_token': "{{ csrf_token() }}",
                'no_resep': no_resep.val(),
                'no_racik': row.find(`#no_racik${id}`).val(),
                'id': row.find(`#nm_racik${id}`).val(),
                'nama_racik': row.find(`#nm_racik${id}`).find(":selected").text(),
                'jml_dr': row.find(`#jml_dr${id}`).val(),
                'kd_racik': row.find(`#metode${id}`).val(),
                'aturan_pakai': row.find(`#aturan${id}`).val(),
            }


            const isEmpty = Object.values(racikan).filter((item) => {
                return item == null || item == '';
            }).length

            if (isEmpty) {
                return Swal.fire({
                    html: `Data racikan belum lengkap`,
                    title: `Peringatan`,
                    icon: 'warning',
                    confirmButtonText: 'Oke',
                })
            }

            $.post(`${url}/resep/racik/create`, racikan).done((response) => {
                createObatTemplateRacikan(racikan.id, racikan.no_resep, racikan.no_racik).done(() => {
                    getResepObat(no_rawat)
                    setResepToPlan(no_rawat)
                })
                toastReload(response.message, 2000)

            }).fail((error) => {
                alertErrorAjax(error)
            })
        }

        function getResepRacikan(no_resep) {
            return $.get(`${url}/resep/racik/ambil`, {
                no_resep: no_resep,
            }).done((response) => {
                setResepRacikan(response);
            }).fail((error) => {
                alertErrorAjax(error);
            })
        }

        function hapusBarisRacikan(id) {
            const tbody = tbResepRacikan.find('tbody')
            tbody.find(`#row${id}`).remove()
            tbody.find('.rowRacikan').each((index, item) => {
                const row = tbody.find('.rowRacikan').attr('id', `row${index}`);
                row.find('button').attr('data-id', index)


                row.find(`.btn-danger`).
                attr('onclick', `hapusBarisRacikan('${index}')`).
                attr('id', `#btnDeleteBarisRacik${index}`)

                row.find(`.btn-success`).
                attr('id', `#btnCreateResepRacik${index}`).
                attr('onclick', `createBarisResepRacikan(${index})`)

                const id = Math.floor(index + 1)
                const nomor = row.find(`td`).eq(0).text(`${id}`);
                row.find(`#no_racik${index}`).val(id);

            })
        }


        function setResepRacikan(data) {
            if (data) {
                const row = data.map((item, index) => {
                    const detail = item.detail;
                    let rowDetail = '';

                    if (detail.length) {
                        const isiDetail = detail.map((item, index) => {
                            return `<span class="badge rounded-pill bg-warning text-dark" style="font-size:9px">${item.databarang.nama_brng} (${item.kandungan} mg)</span>`
                        }).join(' ')
                        rowDetail = `<tr><td></td><td colspan=5>${isiDetail}</td></tr>`;
                    }
                    return `<tr id="rowRacikan${item.no_racik}" class="rowRacikan">
                        <td>${item.no_racik}</td>
                        <td>${item.nama_racik}</td>
                        <td data-id="${item.metode.kd_racik}">${item.metode.nm_racik}</td>
                        <td class="text-center">${item.jml_dr}</td>
                        <td>${item.aturan_pakai}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" type="button" onclick="editResepRacikan('${item.no_resep}', '${item.no_racik}')" ><i class="bi bi-pencil"></i></button>    
                            <button class="btn btn-sm btn-danger btnDeleteResepRacikan ${disableButtonResep()}" type="button" onclick="deleteResepRacikan('${item.no_resep}', '${item.no_racik}')"><i class="bi bi-x"></i></button>    
                        </td>
                    </tr>${rowDetail}`
                })
                tbResepRacikan.find('tbody').empty().append(row)
                return true;
            }

        }

        function deleteResepRacikan(no_resep, no_racik) {
            const no_rawat = formSoapPoli.find(`#no_rawat`).val();

            $.ajax({
                url: `${url}/resep/racik/hapus`,
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_resep: no_resep,
                    no_racik: no_racik,
                }
            }).done((response) => {
                toastReload('Success', 2000)
                getResepRacikan(no_resep)
                setResepToPlan(no_rawat)
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }


        // function editResepRacikan(no_resep, no_racik) {
        //     const kd_dokter = formSoapPoli.find('#dokter').val();

        //     const row = tbResepRacikan.find('tbody').find(`#rowRacikan${no_racik}`)

        //     const colNamaRacik = row.find('td').eq(1)
        //     const colMetodeRacik = row.find('td').eq(2)
        //     const kd_racik = colMetodeRacik.data('id')
        //     const colJumlah = row.find('td').eq(3)
        //     const colAturan = row.find('td').eq(4)
        //     const colAksi = row.find('td').eq(5)

        //     const optAturan = new Option(colAturan.html(), colAturan.html(), true, true);
        //     const jml_racik = colJumlah.html();
        //     const optMetode = new Option(colMetodeRacik.html(), kd_racik, true, true);
        //     const optNamaRacik = new Option(colNamaRacik.html(), colNamaRacik.html(), true, true);

        //     colAksi.empty().append(`<button type="button" class="btn btn-sm btn-success" id="btnCreateBarisRacik${no_racik}" data-id="row${no_racik}" onclick="updateBarisResepRacikan('${no_racik}')"><i class="bi bi-check"></i></button>    
    //                             <button type="button" class="btn btn-sm btn-danger btn-delete-racik" id="btnDeleteBarisRacik${no_racik}" data-id="row${no_racik}" onclick="hapusBarisRacikan('${no_racik}')"><i class="bi bi-x"></i></button>    `);
        //     colAturan.html('').append(`<input type="hidden" name="no_racik[]" id="no_racik${no_racik}" value="${no_racik}" /><select name="aturan_pakai" id="aturan${no_racik}" data-dropdown-parent="#modalSoap" style="width:100%"></select>`)
        //     colJumlah.html('').append(`<input type="number" class="form-control" name="jml_dr[]" id="jml_dr${no_racik}" value="${jml_racik}"/>`)
        //     colMetodeRacik.html('').append(`<select class="" name="metode[]" id="metode${no_racik}" data-dropdown-parent="#modalSoap" style="width:100%"></select>`)
        //     colNamaRacik.html('').append(`<select class="form-select2" data-dropdown-parent="#modalSoap" name="nm_racik[]" id="nm_racik${no_racik}" data-id="${no_racik}" style="width:100%"></select>`)

        //     const elAturanPakai = $(`#aturan${no_racik}`);
        //     const elMetode = $(`#metode${no_racik}`);
        //     const elNamaRacik = $(`#nm_racik${no_racik}`);

        //     selectAturanPakai(elAturanPakai)
        //     selectMetodeRacik(elMetode)
        //     selectTemplateRacikan(elNamaRacik, kd_dokter)

        //     elAturanPakai.append(optAturan).trigger('change');
        //     elMetode.append(optMetode).trigger('change');
        //     elNamaRacik.append(optNamaRacik).trigger('change');


        // }

        // function updateBarisResepRacikan(id) {
        //     const row = tbResepRacikan.find('tbody').find('tr')
        //     const no_resep = formSoapPoli.find('#no_resep')

        //     const racikan = {
        //         '_token': "{{ csrf_token() }}",
        //         'no_resep': no_resep.val(),
        //         'no_racik': row.find(`#no_racik${id}`).val(),
        //         'id': row.find(`#nm_racik${id}`).val(),
        //         'nama_racik': row.find(`#nm_racik${id}`).find(":selected").text(),
        //         'jml_dr': row.find(`#jml_dr${id}`).val(),
        //         'kd_racik': row.find(`#metode${id}`).val(),
        //         'aturan_pakai': row.find(`#aturan${id}`).val(),
        //     }

        //     $.post(`${url}/resep/racik/update`, racikan).done((response) => {
        //         toastReload(response.message, 2000)
        //         getResepRacikan(racikan.no_resep)
        //     }).fail((error) => {
        //         alertErrorAjax(error)
        //     })

        //     console.log(racikan);
        // }
    </script>
@endpush
