<form action="" id="formPermintaanLab">
    <div class="row gy-2 mb-3">
        <div class="col-md-2">
            <label for="pemeriksaan" class="form-label">No. Permintaan</label>
            <input type="text" class="form-control" name="noorder" id="noorder" />
        </div>
        <div class="col-md-5">
            <label for="diagnosa_klinis" class="form-label">Indikasi/Klinis</label>
            <input type="text" class="form-control" name="diagnosa_klinis" id="diagnosa_klinis" />
        </div>
        <div class="col-md-5">
            <label for="informasi_tambahan" class="form-label">Informasi Tambahan</label>
            <input type="text" class="form-control" name="informasi_tambahan" id="informasi_tambahan" />
        </div>
        <div class="col-md-12">
            <label for="pemeriksaan" class="form-label">Pemeriksaan Lab</label>
            <select name="pemeriksaan" id="pemeriksaan" class="form-select" multiple data-dropdown-parent="#modalLabRanap" style="width:100%"></select>
        </div>
    </div>
    <table class="table table-responsive table-bordered" id="tablePermintaanLab">
        <thead>
            <tr class="table-secondary">
                <th width="2%"><input type="checkbox" name="p" id="p" /></th>
                <th>Pemeriksaan</th>
                <th>Satuan</th>
                <th>Nilai Rujukan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <button type="button" class="btn btn-primary" id="btnKirimPermintaan">Kirim Permintaan</button>
</form>
@push('script')
    <script>
        const formPermintaanLab = $('#formPermintaanLab')
        const selectPemeriksaan = formPermintaanLab.find('#pemeriksaan')
        const tablePermintaanLab = $('#tablePermintaanLab');
        selectPemeriksaan.select2({
            tags: false,
            ajax: {
                url: './lab/jenis/get',
                dataType: 'JSON',

                data: (params) => {
                    const query = {
                        nm_perawatan: params.term
                    }
                    return query
                },
                processResults: (data) => {
                    return {
                        results: data.map((item) => {
                            const items = {
                                id: item.kd_jenis_prw,
                                text: `${item.nm_perawatan}`,
                            }
                            return items;
                        })
                    }
                }

            },
        });

        selectPemeriksaan.on('select2:select', (e) => {

            const data = selectPemeriksaan.val();
            $.get(`./lab/jenis/template/get`, {
                kode: data
            }).done((response) => {
                let subPemeriksaan = '';
                let pemeriksaan = '';

                response.forEach((item) => {
                    pemeriksaan = response.map((item) => {

                        return `<tr>
                        <td><input type="checkbox" class="form-check checkJenisPemeriksaan" name="${item.kd_jenis_prw}" id="${item.kd_jenis_prw}" onclick="checkJenisPemeriksaan(this)"/></td>
                        <td colspan=3><b>${item.nm_perawatan}</b></td>
                        </tr>${setTemplatePemeriksaan(item.template)}`
                    });
                })
                tablePermintaanLab.find('tbody').empty().append(pemeriksaan).append(subPemeriksaan)
            })
        })

        selectPemeriksaan.on('select2:unselect', (e) => {
            const data = selectPemeriksaan.val();
            if (data.length) {
                $.get(`./lab/jenis/template/get`, {
                    kode: data
                }).done((response) => {
                    let subPemeriksaan = '';
                    let pemeriksaan = '';

                    response.forEach((item) => {
                        pemeriksaan = response.map((item) => {
                            return `<tr>
                            <td><input type="checkbox" class="form-check checkJenisPemeriksaan" name="${item.kd_jenis_prw}" id="${item.kd_jenis_prw}" /></td>
                            <td colspan=3><b>${item.nm_perawatan}</b></td>
                            </tr>${setTemplatePemeriksaan(item.template)}`
                        });
                    })
                    tablePermintaanLab.find('tbody').empty().append(pemeriksaan).append(subPemeriksaan)
                })
            } else {
                tablePermintaanLab.find('tbody').empty()
            }
        })

        function setTemplatePemeriksaan(data) {
            return data.map((i) => {
                if (i.Pemeriksaan.length) {
                    return `<tr>
                        <td><input type="checkbox" name="${i.id_template}" id="${i.id_template}" data-parent="${i.kd_jenis_prw}" /></td>
                        <td><span class="ms-4">${i.Pemeriksaan}</span></td>
                        <td>${i.satuan}</td>
                        <td><b>LD</b> : ${i.nilai_rujukan_ld} ${i.satuan}, <b>LA</b> : ${i.nilai_rujukan_la} ${i.satuan}, <b>PD</b> : ${i.nilai_rujukan_pd} ${i.satuan}, <b>PA</b> : ${i.nilai_rujukan_pa} ${i.satuan} </td>
                    </tr>`

                }
            })
        }

        $('#p').on('click', (e) => {
            const isCheck = $(e.currentTarget).prop('checked')
            tablePermintaanLab.find('input[type=checkbox]').each((index, el) => {
                if (isCheck) {
                    $(el).prop('checked', true)
                } else {
                    $(el).prop('checked', false)
                }
            })
        })

        function checkJenisPemeriksaan(el) {
            const isCheck = $(el).prop('checked');
            tablePermintaanLab.find('input[type=checkbox]').each((index, e) => {
                if (e.dataset.parent == el.id) {
                    if (isCheck) {
                        $(e).prop('checked', true)
                    } else {
                        $(e).prop('checked', false)
                    }
                }
            })
        }
        $('#btnKirimPermintaan').on('click', () => {
            const data = getDataForm('#formPermintaanLab', ['input']);
            console.log(data);
        })
    </script>
@endpush
