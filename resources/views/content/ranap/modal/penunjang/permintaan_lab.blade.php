<form action="" id="formPermintaanLab">
    <div class="row gy-2 mb-3">
        <div class="col-md-10">
            <label for="pemeriksaan" class="form-label">Pemeriksaan Lab</label>
            <select name="pemeriksaan" id="pemeriksaan" class="form-select" multiple data-dropdown-parent="#modalLabRanap" style="width:100%">
                <option value="">x</option>
                <option value="">y</option>
                <option value="">z</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="pemeriksaan" class="form-label">No. Permintaan</label>
            <input type="text" class="form-control" />
        </div>
    </div>
    <table class="table table-responsive table-striped" id="tablePermintaanLab">
        <thead>
            <tr>
                <th><input type="checkbox" name="p" id="p" /></th>
                <th>Pemeriksaan</th>
                <th>Satuan</th>
                <th>Nilai Rujukan</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</form>
@push('script')
    <script>
        const formPermintaanLab = $('#formPermintaanLab')
        const selectPemeriksaan = formPermintaanLab.find('#pemeriksaan')
        const tablePermintaanLab = $('#tablePermintaanLab');
        selectPemeriksaan.select2({
            tags: true,
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
            $.get(`./lab/template/get`, {
                kode: data
            }).done((response) => {
                const pemeriksaan = response.map((item) => {
                    return `<tr>
                    <td><input type="checkbox" name="p" id="p" /></td>
                    <td>${item.Pemeriksaan}</td>
                    <td>${item.satuan}</td>
                    <td>${item.nilai_rujukan_ld}</td>
                    </tr>`
                })
                tablePermintaanLab.find('tbody').empty().append(pemeriksaan)

            })
        })
    </script>
@endpush
