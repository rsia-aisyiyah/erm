<table class="table table-striped table-responsive table-sm d-none" id="tbResepRacikan" width="100%">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama Racikan</th>
            <th width="15%">Metode Racikan</th>
            <th width="10%" class="text-center">Jumlah</th>
            <th>Aturan Pakai</th>
            <th width="10%"></th>
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
                                <td>${rowCount+1} <input type="hidden" name="no_racik[]" id="no_racik${rowCount}" value="${rowCount + 1}" /></td>
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
                                    <button type="button" class="btn btn-sm btn-success " data-id="row${rowCount}" onclick="createBarisResepDokter('${rowCount}')"><i class="bi bi-check"></i></button>    
                                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="row${rowCount}" onclick="hapusBarisObat('${rowCount}')"><i class="bi bi-x"></i></button>    
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
            const kd_dokter = formSoapPoli.find('#dokter').val();

            const data = [];

            for (let index = 0; index < row.length; index++) {
                // console.log();
                const racikan = {
                    'no_resep': no_resep,
                    'no_racik': row.find(`#no_racik${index}`).val(),
                    'id': row.find(`#nm_racik${index}`).val(),
                    'nm_racik': row.find(`#nm_racik${index}`).find(":selected").text(),
                    'jml_dr': row.find(`#jml_dr${index}`).val(),
                    'metode': row.find(`#metode${index}`).val(),
                    'aturan_pakai': row.find(`#aturan${index}`).val(),
                }

                $.post.

                $.get(`${url}/resep/racik/template/ambil`, {
                    id: row.find(`#nm_racik${index}`).val()
                }).done((response) => {
                    console.log(response);
                })

                console.log(`RACIKAN ${index}`, racikan);

            }
            // $.get(`${url}/resep/racik/template/ambil`, {
            //     id:
            // })
        }
    </script>
@endpush
