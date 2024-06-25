<table class="table table-striped table-responsive table-sm d-none" id="tbResepRacikan" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama Racikan</th>
            <th width="15%">Metode Racikan</th>
            <th width="10%" class="text-center">Jumlah</th>
            <th>Aturan Pakai</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody id="body_racikan">

    </tbody>
</table>
<button class="btn btn-primary btn-sm d-none" id="btnTambahResepRacik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
<button class="btn btn-success btn-sm d-none" id="btnCreateResepRacik" type="button" onclick="createResepObatRacikan()">Simpan</button>

@push('script')
    <script>
        const tbResepRacikan = $('#tbResepRacikan')
        const btnTambahResepRacik = $('#btnTambahResepRacik')
        const btnCreateResepRacik = $('#btnCreateResepRacik')

        function tambahRacikan() {
            const rowCount = tbResepRacikan.find('tbody').find('tr').length;
            const kd_dokter = formSoapPoli.find('#dokter').val()
            const addRow = `<tr id="row${rowCount}">
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
            const no_rawat = formSoapPoli.find('#no_rawats').val();
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

                $.post(`${url}/resep/racik/simpan`,
                    racikan
                ).done((response) => {
                    $.get(`${url}/resep/racik/template/ambil`, {
                        id: racikan.id
                    }).done((response) => {
                        const obat = response.detail_racik.map((item, index) => {
                            return {
                                no_resep: racikan.no_resep,
                                no_racik: racikan.no_racik,
                                kode_brng: item.kode_brng,
                                p1: 1,
                                p2: 1,
                                kandungan: 0,
                                jml: 0
                            }
                        });

                        $.post(`${url}/resep/racik/detail/create/batch`, {
                            _token: "{{ csrf_token() }}",
                            dataObat: obat
                        }).done((response) => {
                            toastReload(response.message, 2000)
                            getResepRacikan(racikan.no_resep)
                        })
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }).fail((error) => {
                    alertErrorAjax(error)
                })
            }
        }

        function createBarisResepRacikan(id) {
            const row = tbResepRacikan.find('tbody').find('tr')
            const no_resep = formSoapPoli.find('#no_resep')

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
                getResepRacikan(racikan.no_resep)
                toastReload(response.message, 2000)
            }).fail((error) => {
                alertErrorAjax(error)
            })


        }

        function getResepRacikan(no_resep) {
            console.log(no_resep);
            $.get(`${url}/resep/racik/ambil`, {
                no_resep: no_resep
            }).done((response) => {
                console.log('RESPONSE===', response);
                setResepRacikan(response);
            }).fail((error) => {
                alertErrorAjax(error);
            })
        }

        function hapusBarisRacikan(id) {
            const tbody = tbResepRacikan.find('tbody')
            tbody.find(`#row${id}`).remove()
            tbody.find('tr').each((index, item) => {
                const id = Math.floor(index + 1)
                const row = tbody.find('tr').eq(index).attr('id', `row${index}`);
                const nomor = row.find(`td`).eq(0).text(`${id}`);

                row.find(`#no_racik${index}`).val(id);
                row.find('button').attr('data-id', index)
                row.find(`#btnDeleteBarisRacik${index}`).attr('onclick', `hapusBarisRacikan('${index}')`)
                row.find(`#btnCreateResepRacik${index}`).attr('onclick', `createBarisResepRacikan('${index}')`)
                console.log(index, item);
            })
        }

        function setResepRacikan(data) {
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
                            <button class="btn btn-sm btn-danger" type="button" onclick="deleteResepRacikan('${item.no_resep}', '${item.no_racik}')"><i class="bi bi-x"></i></button>    
                        </td>
                    </tr>${rowDetail}`
                })
                tbResepRacikan.find('tbody').empty().append(row)
                return true;
            }

        }

        function deleteResepRacikan(no_resep, no_racik) {
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
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }
    </script>
@endpush
