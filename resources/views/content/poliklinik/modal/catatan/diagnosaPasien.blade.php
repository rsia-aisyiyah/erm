<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <label for="diagnosa">Diagnosa</label>
        <select name="diagnosa" id="diagnosa" class="form-select2" data-dropdown-parent="#modalCatatan"></select>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">
        <table class="table table-stripped table-diagnosa table-sm" id="tbDiagnosaPasien">
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="25%">Kode ICD</th>
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
        const selectDiagnosaPasien = $('#diagnosa-pasien').find('#diagnosa')
        const tbDiagnosaPasien = $('#tbDiagnosaPasien').find('tbody')


        function createDiagnosaPasien(kd_penyakit) {
            no_rawat = formSoapPoli.find('input[name=no_rawat]').val();
            kd_penyakit = kd_penyakit

            $.ajax({
                url: `${url}/penyakit/pasien/tambah`,
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                    status: "Ralan",
                },
                method: 'POST',
            }).done((response) => {
                toastReload(response.message, 2000)
                setDiagnosaPasien(no_rawat)

            }).fail((error) => {
                alertErrorAjax(error).then((e) => {
                    selectDiagnosaPasien.empty().select2('open')
                })
            })

        }

        function deleteDiagnosaPasien(no_rawat, kd_penyakit) {
            $.ajax({
                url: `${url}/penyakit/pasien/hapus`,
                method: 'DELETE',
                data: {
                    no_rawat: no_rawat,
                    kd_penyakit: kd_penyakit,
                    _token: "{{ csrf_token() }}"
                }
            }).done((response) => {
                toastReload(response.message, 2000)
                setDiagnosaPasien(no_rawat)
            })
        }
    </script>
@endpush
