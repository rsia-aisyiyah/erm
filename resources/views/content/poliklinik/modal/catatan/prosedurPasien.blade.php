<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label for="prosedur">Prosedur</label>
        <select name="prosedur" id="prosedur" class="form-select2" data-dropdown-parent="#modalCatatan"></select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
        <table class="table table-stripped table-prosedur table-sm" id="tbProsedurPasien">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="25%">Kode Prosedur</th>
                    <th width="60%">Deskripsi</th>
                    <th width="15%"></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
@push('script')
    <script>
        const selectProsedurPasien = $('#prosedur-pasien').find('#prosedur')
        const tbProsedurPasien = $('#tbProsedurPasien').find('tbody')


        function createProsedurPasien(kode) {
            no_rawat = formSoapPoli.find('input[name=no_rawat]').val();
            kode = kode
            $.ajax({
                url: `${url}/prosedur/pasien/tambah`,
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kode: kode,
                    status: "Ralan",
                },
                method: 'POST',
            }).done((response) => {
                toastReload(response.message, 2000)
                setProsedurPasien(no_rawat)

            }).fail((error) => {
                alertErrorAjax(error).then((e) => {
                    selectProsedurPasien.empty().select2('open')
                })
            })

        }

        function getProsedurPasien(no_rawat) {
            return $.ajax({
                url: `${url}/prosedur/pasien/ambil`,
                data: {
                    no_rawat: no_rawat,
                },
            })
        }

        function setProsedurPasien(no_rawat) {
            return getProsedurPasien(no_rawat).done((response) => {
                const prosedur = response.map((item, index) => {
                    return `
                    <tr>
                        <td>${index+1}</td>
                        <td>${item.kode}</td>
                        <td>${item.icd9.deskripsi_pendek}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteProsedurPasien('${no_rawat}','${item.kode}')"><i class="bi bi-x"></i></button>
                        </td>
                    </tr>
                    `
                })
                tbProsedurPasien.empty().append(prosedur)
            });
        }

        function deleteProsedurPasien(no_rawat, kode) {
            $.ajax({
                url: `${url}/prosedur/pasien/hapus`,
                method: 'DELETE',
                data: {
                    no_rawat: no_rawat,
                    kode: kode,
                    _token: "{{ csrf_token() }}"
                }
            }).done((response) => {
                toastReload(response.message, 2000)
                setProsedurPasien(no_rawat)
            })
        }
    </script>
@endpush
