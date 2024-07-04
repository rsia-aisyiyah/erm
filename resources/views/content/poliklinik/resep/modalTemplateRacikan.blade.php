<div class="modal fade" id="modalTemplateRacikan" tabindex="-1" aria-labelledby="modalTemplateRacikan" aria-hidden="true" data-backdrop="static" data-keyboard="false" style="background-color: #00000085;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 1em">Detail Isi Resep Racikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" style="padding:10px;border-radius:0px;font-size:12px" role="alert">
                    Anda dapat menghapus / menambah daftar obat yang tercantum
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <form action="" id="formDetailRacikan">
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <label for="no_resep" class="form-label">No. Resep</label>
                                    <input type="text" id="no_resep" name="no_resep" class="form-control form-control-sm" readonly />
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label for="nama_racik" class="form-label">Nama Racik</label>
                                    <div class="input-group">
                                        <input type="text" id="no_racik" name="no_racik" class="form-control form-control-sm" readonly />
                                        <input type="text" id="nama_racik" name="nama_racik" class="form-control form-control-sm w-75" />
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <label for="metode" class="form-label">Metode</label>
                                    <select class="" name="metode" id="metode" data-dropdown-parent="#modalTemplateRacikan" style="width:100%"></select>
                                </div>
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <label for="jml_dr" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control form-control-sm" name="jml_dr" id="jml_dr" />
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <label for="aturan_pakai" class="form-label">Aturan Pakai</label>
                                    <select class="" name="aturan_pakai" id="aturan_pakai" data-dropdown-parent="#modalTemplateRacikan" style="width:100%"></select>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="container">
                                <table class="table table-racikan table-borderless" id="tbDetailResepRacikan">
                                    <thead>
                                        <tr>
                                            <th width="35%">Nama Obat</th>
                                            <th width="15%">Sediaan</th>
                                            <th width="12%">Pembagi</th>
                                            <th width="15%">Dosis</th>
                                            <th width="10%">Jumlah</th>
                                            <th width=""></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <button type="button" id="btnAddBaris" class="btn btn-success btn-sm" onclick="addBarisDetailRacikan()"><i class="bi bi-plus-circle"></i> Tambah Obat</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="createDetailResepRacik()"><i class="bi bi-save"></i> Simpan</button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const modalTemplateRacikan = $('#modalTemplateRacikan');
        const formDetailRacikan = $('#formDetailRacikan')
        const tbDetailResepRacikan = $('#tbDetailResepRacikan')
        const btnAddBaris = $('#btnAddBaris')
        modalTemplateRacikan.on('hidden.bs.modal', () => [
            tbDetailResepRacikan.find('tbody').empty()
        ])

        function editResepRacikan(no_resep, no_racik) {
            const dokter = formSoapPoli.find('#dokter').val();
            const inptNoResep = formDetailRacikan.find('#no_resep')
            const inptNmRacik = formDetailRacikan.find('#nama_racik')
            const inptMetode = formDetailRacikan.find('#metode')
            const inptJml = formDetailRacikan.find('#jml_dr')
            const inptAturan = formDetailRacikan.find('#aturan_pakai')
            const inptNoRacik = formDetailRacikan.find('#no_racik')
            $.get(`${url}/resep/racik/ambil`, {
                no_resep: no_resep,
                no_racik: no_racik,
            }).done((response) => {
                inptNoResep.val(no_resep)
                inptNmRacik.val(response.nama_racik)
                inptJml.val(response.jml_dr)
                inptNoRacik.val(response.no_racik)

                const optMetode = new Option(response.metode.nm_racik, response.kd_racik, true, true);
                inptMetode.append(optMetode).trigger('change');
                const optAturan = new Option(response.aturan_pakai, response.aturan_pakai, true, true);
                inptAturan.append(optAturan).trigger('change');

                selectMetodeRacik(inptMetode)
                selectAturanPakai(inptAturan)

                modalTemplateRacikan.modal('show')

                response.detail.forEach((item, index) => {
                    const jml = item.jml === 0 ? response.jml_dr : item.jml;
                    const isLastRow = index === response.detail.length - 1;
                    const addButton = isLastRow ? `<button class="btn btn-sm btn-success" id="btnTambahBarisDetailRacik${index}" onclick="addBarisDetailRacikan()"><i class="bi bi-plus"></i></button>` : '';

                    const row = `<tr data-id="${item.kode_brng}" id="rowDetail${index}">
                                <td>
                                    <select clas="form-select2" id="obatDetailRacikan${index}" name="kode_brng[]" data-dropdown-parent="#modalTemplateRacikan" style="width:100%">
                                    </select>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="kapasitas[]" id="kapasitas-${index}" value="${item.databarang.kapasitas}" readonly/>
                                        <span class="input-group-text input-group-text-sm">mg</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="p1[]" id="p1-${index}" onchange="hitungPembagi(${response.jml_dr}, ${index})" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" value="${item.p1}" />
                                        <span class="input-group-text input-group-text-sm">/</span>
                                        <input type="text" class="form-control form-control-sm text-start" name="p2[]" id="p2-${index}" onchange="hitungPembagi(${response.jml_dr}, ${index})" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" value="${item.p2}" />
                                    </div>   
                                </td>
                                <td>
                                     <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="kandungan[]" onchange="hitungDosis(${response.jml_dr}, ${index})" id="kandungan-${index}" value="${item.kandungan}" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" />
                                        <span class="input-group-text input-group-text-sm">mg</span>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-end" name="jml[]" id="jml-${index}" value="${jml}" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" onchange="hitungJumlah(this, ${index})"/>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" id="btnHapusBarisDetailRacik${index}" onclick="hapusBarisDetailRacik(${index})"><i class="bi bi-x"></i></button>
                                    ${addButton}
                                </td>
                        </tr>`;
                    tbDetailResepRacikan.find('tbody').append(row)
                    const elObat = $(`#obatDetailRacikan${index}`)
                    const elSediaan = $(`#kapasitas-${index}`)
                    const optBarang = new Option(item.databarang.nama_brng, item.kode_brng, true, true);
                    selectDataBarang(elObat).on('select2:select', (e) => {
                        const selectedId = e.params.data.id;
                        const isDuplicate = isDuplicateObat(tbDetailResepRacikan.find('tbody'), selectedId, elObat)

                        if (!isDuplicate) {
                            elSediaan.val(e.params.data.detail.kapasitas)
                        }

                    })
                    elObat.append(optBarang).trigger('change');
                })

                response.detail.length ? btnAddBaris.addClass('d-none') : btnAddBaris.removeClass('d-none')


            }).fail((error) => {
                alertErrorAjax(error);
            })
        }

        function addBarisDetailRacikan() {
            const body = tbDetailResepRacikan.find('tbody')
            const rowCount = body.find('tr').length;
            const jml_racik = formDetailRacikan.find('#jml_dr').val();
            btnAddBaris.addClass('d-none')

            if (rowCount > 0) {
                body.find('tr').last().find('.btn-success').remove();
            }

            const addRow = `<tr id="rowDetail${rowCount}">
                                <td>
                                    <select clas="form-select2" id="obatDetailRacikan${rowCount}" name="kode_brng[]" data-dropdown-parent="#modalTemplateRacikan" style="width:100%">
                                    </select>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="kapasitas[]" id="kapasitas-${rowCount}" value="0" readonly/>
                                        <span class="input-group-text input-group-text-sm">mg</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="p1[]" id="p1-${rowCount}" onchange="hitungPembagi(${jml_racik}, ${rowCount})" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" value="1" />
                                        <span class="input-group-text input-group-text-sm">/</span>
                                        <input type="text" class="form-control form-control-sm text-start" name="p2[]" id="p2-${rowCount}" onchange="hitungPembagi(${jml_racik}, ${rowCount})" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" value="1" />
                                    </div>   
                                </td>
                                <td>
                                     <div class="input-group">
                                        <input type="text" class="form-control form-control-sm text-end" name="kandungan[]" id="kandungan-${rowCount}" value="0" onchange="hitungDosis(${jml_racik}, ${rowCount})" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)"/>
                                        <span class="input-group-text input-group-text-sm">mg</span>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="form-control form-control-sm text-end" name="jml[]" id="jml-${rowCount}" value="0" onfocus="removeZero(this)" onblur="isEmptyNumber(this)" onkeypress="return hanyaAngka(this)" onchange="hitungJumlah(this, ${rowCount})"  />
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" id="btnHapusBarisDetailRacik${rowCount}" onclick="hapusBarisDetailRacik(${rowCount})"><i class="bi bi-x"></i></button>
                                    <button class="btn btn-sm btn-success" id="btnTambahBarisDetailRacik${rowCount}" onclick="addBarisDetailRacikan()"><i class="bi bi-plus"></i></button>
                                </td>
                        </tr>`;
            body.append(addRow);
            const elObat = $(`#obatDetailRacikan${rowCount}`)
            const elSediaan = $(`#kapasitas-${rowCount}`)
            const elJml = $(`#jml-${rowCount}`)
            selectDataBarang(elObat).on('select2:select', (e) => {
                const selectedId = e.params.data.id;
                const isDuplicate = isDuplicateObat(body, selectedId, elObat)
                if (!isDuplicate) {
                    elSediaan.val(e.params.data.detail.kapasitas)
                    elJml.val(jml_racik)
                }

            }).select2('open');
        }

        function hitungPembagi(jml_racik, id) {

            const kapasitas = $(`#kapasitas-${id}`).val();
            const p1 = $(`#p1-${id}`).val();
            const p2 = $(`#p2-${id}`).val();

            if (p1 != 0 && p2 != 0) {
                const dosis = parseFloat(kapasitas) * (parseFloat(p1) / parseFloat(p2));
                const jml_obat = (parseFloat(dosis) * parseFloat(jml_racik)) / parseFloat(kapasitas)
                $(`#kandungan-${id}`).val(dosis.toFixed(1));
                $(`#jml-${id}`).val(jml_obat.toFixed(1));
            }

        }

        function hitungDosis(jml_racik, id) {
            const kapasitas = $(`#kapasitas-${id}`).val();
            const dosis = $(`#kandungan-${id}`).val();
            const p1 = $(`#p1-${id}`).val();
            const p2 = $(`#p2-${id}`).val();

            if (parseInt(dosis) > parseInt(kapasitas)) {
                Swal.fire(
                    'Ada yang salah !',
                    'Dosis tidak boleh lebih besar dari kapasitas obat',
                    'warning'
                ).then(() => {
                    $(`#kandungan-${id}`).val(0);
                });
            } else {
                const jml_obat = (parseFloat(dosis) * parseFloat(jml_racik)) / parseFloat(kapasitas)
                $(`#jml-${id}`).val(jml_obat.toFixed(1))
                $(`#p1-${id}`).val(1);
                $(`#p2-${id}`).val(1);
            }

        }

        function hitungJumlah(el, id) {
            const kapasitas = $(`#kapasitas-${id}`).val();
            const jml = formDetailRacikan.find('#jml_dr').val();
            if (parseInt(kapasitas) > 1) {
                const dosis = kapasitas * el.value / jml
                $(`#kandungan-${id}`).val(parseFloat(dosis).toFixed(1));
            }

        }

        function hapusBarisDetailRacik(id) {
            const body = tbDetailResepRacikan.find('tbody');
            body.find(`#rowDetail${id}`).remove();

            const rowCount = body.find('tr').length;
            if (rowCount > 0) {} else {
                btnAddBaris.addClass('d-none')
                btnAddBaris.removeClass('d-none')
            }

            body.find('tr').each((index, item) => {
                // Update the row ID
                $(item).attr('id', `rowDetail${index}`);

                // Update the IDs and event handlers for the inputs and buttons within the row
                $(item).find('.btn-danger')
                    .attr('onclick', `hapusBarisDetailRacik(${index})`)
                    .attr('id', `btnHapusBarisDetailRacik${index}`);

                $(item).find('.btn-success')
                    .attr('onclick', `addBarisDetailRacikan(${index})`)
                    .attr('id', `btnTambahBarisDetailRacik${index}`);

                $(item).find('select').attr('id', `obatDetailRacikan${index}`);
                $(item).find('[name="kapasitas[]"]').attr('id', `kapasitas-${index}`);
                $(item).find('[name="p1[]"]').attr('id', `p1-${index}`);
                $(item).find('[name="p2[]"]').attr('id', `p2-${index}`);
                $(item).find('[name="kandungan[]"]').attr('id', `kandungan-${index}`);
                $(item).find('[name="jml[]"]').attr('id', `jml-${index}`);
            });

            // Add "Add" button to the last row if it doesn't exist
            const lastRow = body.find('tr').last();
            if (lastRow.find('.btn-success').length === 0) {
                lastRow.find('td:last').append(`<button class="btn btn-sm btn-success" 
                id="btnTambahBarisDetailRacik${body.find('tr').length - 1}"
                onclick="addBarisDetailRacikan()"><i class="bi bi-plus"></i></button>`);
            }
        }

        function createDetailResepRacik() {
            const body = tbDetailResepRacikan.find('tbody');
            const no_resep = formDetailRacikan.find('#no_resep').val();
            const no_racik = formDetailRacikan.find('#no_racik').val();
            const no_rawat = formSoapPoli.find('#no_rawat').val();
            const rowLength = body.find('tr').length;
            const dataResep = getDataForm('#formDetailRacikan', ['input', 'select']);
            let dataObat = []

            for (let index = 0; index < rowLength; index++) {
                const kode_brng = body.find(`#obatDetailRacikan${index}`).val()
                const jml = body.find(`#jml-${index}`).val()
                const p1 = body.find(`#p1-${index}`).val()
                const p2 = body.find(`#p2-${index}`).val()
                const kandungan = body.find(`#kandungan-${index}`).val()
                const obat = {
                    'kode_brng': kode_brng,
                    'jml': jml,
                    'p1': p1,
                    'p2': p2,
                    'kandungan': kandungan,
                }

                const isEmpty = Object.values(obat).filter((item, key) => {
                    return item === null || item === '';
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


            $.post(`${url}/resep/racik/detail/ubah`, {
                no_resep: no_resep,
                no_racik: no_racik,
                _token: "{{ csrf_token() }}",
                dataResep: dataResep,
                data: dataObat
            }).done((response) => {
                getResepRacikan(no_resep).done((response) => {
                    modalTemplateRacikan.modal('hide')
                    setResepToPlan(no_rawat)
                })

                toastReload(response.message, 2000)
            }).fail((error) => {
                alertErrorAjax(error)
            })


        }
    </script>
@endpush
