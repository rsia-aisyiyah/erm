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

@push('script')
    <script>
        function setResepDokter(data) {
            if (data) {
                const row = data.map((item, index) => {
                    return `<tr id="rowObatDokter${index}" data-id="${item.kode_brng}">
                            <td id="colObatDokter${index}">${item.data_barang.nama_brng}</td>
                            <td class="text-center" id="colJmlObatDokter${index}">${item.jml}</td>
                            <td id="colAturanPakaiDokter${index}">${item.aturan_pakai}</td>
                            <td id="aksiObatDokter${index}">
                                <button class="btn btn-warning btn-sm" type="button" id="btnEditObatResepDokter" onclick="editResepDokter('${index}', '${item.kode_brng}')"><i class="bi bi-pencil"></i></button>    
                                <button class="btn btn-danger btn-sm" type="button" id="btnDeleteObatResepDokter" onclick="deleteResepDokter('${item.no_resep}', '${item.kode_brng}')"><i class="bi bi-x"></i></button>    
                            </td>
                        </tr>`
                }).join('');
                tbResepDokter.find('tbody').empty().append(row);
                return true;
            }
            tbResepDokter.find('tbody').empty()
        }


        function getResepDokter(no_resep) {
            $.get(`${url}/resep/dokter/get/${no_resep}`).done((response) => {
                if (response.data) {
                    setResepDokter(response.data)
                }
            }).fail((error) => {
                alertErrorAjax(error);
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
            const selectBarang = $(`#kdObat${rowCount}`);
            selectDataBarang($(`#kdObat${rowCount}`)).on('select2:select', (e) => {
                const selectedId = e.params.data.id;
                isDuplicateObat(tbResepDokter.find('tbody'), selectedId, selectBarang)
            });
            selectAturanPakai(aturanPakai)
        }

        function createObatUmum() {
            const rowCount = tbResepDokter.find('tbody').find('tr').length
            const noResep = formSoapPoli.find('#no_resep').val();
            const no_rawat = formSoapPoli.find('#no_rawat').val();

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
                    setResepToPlan(no_rawat)
                }).fail((error) => {
                    alertErrorAjax(error)
                })
            }
        }

        function deleteResepDokter(no_resep, kode_brng) {
            const no_rawat = formSoapPoli.find(`#no_rawat`).val();
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
                setResepToPlan(no_rawat)
            }).fail((error) => {
                alertErrorAjax(error);
            })
        }

        function hapusBarisObat(id) {
            $(`#row${id}`).remove();
            $('.btn-delete').each((index, item) => {
                $(`#row${id+1}`).attr('id', `row${id+1}`).find('button').attr('onclick', `hapusBarisObat(${id+1})`);
            })
        }

        function createBarisResepDokter(id) {
            const kode_brng = $(`#kdObat${id}`).val();
            const no_rawat = formSoapPoli.find('#no_rawat').val();
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
                setResepToPlan(no_rawat)
            })
        }

        function editResepDokter(id, kode_brng) {
            const row = tbResepDokter.find('tbody').find(`#rowObatDokter${id}`)

            const no_resep = $(`#no_resep`).val();
            const no_rawat = formSoapPoli.find(`#no_rawat`).val();

            const colObat = row.find(`#colObatDokter${id}`)
            const colJml = row.find(`#colJmlObatDokter${id}`)
            const colAturan = row.find(`#colAturanPakaiDokter${id}`)
            const colAksi = row.find(`#aksiObatDokter${id}`)

            const jumlah = colJml.html()
            const kdObat = row.data('id')
            const aturan = colAturan.html()

            colAksi.empty();
            colJml.html('').append(`<input type="text" class="form-control" name="jml" id="jmlObatDokter${id}" value="${jumlah}"/>`)
            colAturan.html('').append(`<select name="aturan_pakai" id="aturanPakaiDokter${id}" data-dropdown-parent="#modalSoap" style="width:100%">
                </select>`)
            colAksi.append(`
                <button type="button" class="btn btn-sm btn-success" onclick="updateResepDokter(${id}, '${kdObat}')"><i class="bi bi-check"></i></button>
                <button type="button" class="btn btn-sm btn-danger" onclick="deleteResepDokter(${no_resep}, '${kdObat}')"><i class="bi bi-x"></i></button>
            `);

            elAturanPakai = $(`#aturanPakaiDokter${id}`);
            const optAturan = new Option(aturan, aturan, true, true);
            elAturanPakai.append(optAturan).trigger('change');
            selectAturanPakai(elAturanPakai)
        }

        function updateResepDokter(id, kode_brng) {
            const row = tbResepDokter.find('tbody');
            const no_resep = $('#no_resep').val();
            const jumlah = row.find(`#jmlObatDokter${id}`).val()
            const aturan_pakai = row.find(`#aturanPakaiDokter${id}`).val()
            const no_rawat = formSoapPoli.find(`#no_rawat`).val();

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
                setResepToPlan(no_rawat)
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }
    </script>
@endpush
