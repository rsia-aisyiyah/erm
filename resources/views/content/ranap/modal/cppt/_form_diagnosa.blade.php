<div class="row">
    <div class="col-lg-6 col-sm-12 col-md-12">
        <form class="" id="formDxPx">
            <div class="form-fieldset">
                <label for="diagnosa">Diagnosa</label>
                <select class="form-select select2" name="diagnosa" id="diagnosa" style="width:100%"></select>
            </div>
            <div class="form-fieldset">
                <label for="prosedur">Prosedur</label>
                <select class="form-select select2" name="prosedur" id="prosedur" style="width:100%"></select>
            </div>
            <button type="button" class="btn btn-sm btn-primary mt-3" id="btnSimpanDxPx">
                <i class="bi bi-floppy"></i>
                Simpan
            </button>
        </form>
    </div>
    <div class="col-lg-6 col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Diagnosis Akhir</h4>
                <table class="table table-sm table-bordered" id="tbDiagnosisAkhirRanap">
                    <thead>
                    <tr>
                        <th>No. Rawat</th>
                        <th>Kode</th>
                        <th>Diagnosis</th>
                        <th>Prioritas</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h4 class="card-title">Data Prosedur Pasien</h4>
                <table class="table table-sm table-bordered" id="tbProsedurPasienRanap">
                    <thead>
                    <tr>
                        <th>No. Rawat</th>
                        <th>Kode</th>
                        <th>Prosedur</th>
                        <th>Prioritas</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const tabDiagnosaRanap = $('#tab-diagnosa')

        tabDiagnosaRanap.on('click', function () {
            const formDxPx = $('#formDxPx');
            const no_rawat = $('#formInfoPasien').find('input[name=no_rawat]').val();


            formDxPx.find('#prosedur').select2({
                allowClear: false,
                delay: 0,
                dropdownParent: $('#modalSoapRanap'),
                scrollAfterSelect: false,
                multiple: true,
                initSelection: function (element, callback) {
                },
                ajax: {
                    url: `${url}/prosedur/cari`,
                    dataType: 'json',
                    data: (params) => {
                        return {
                            kode: params.term
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: `${item.kode} - ${item.deskripsi_panjang}`,
                                    id: item.kode
                                }
                            })
                        };
                    },
                    cache: false
                }
            })
            formDxPx.find('#diagnosa').select2({
                allowClear: false,
                delay: 0,
                dropdownParent: $('#modalSoapRanap'),
                scrollAfterSelect: false,
                multiple: true,
                initSelection: function (element, callback) {
                },
                ajax: {
                    url: `${url}/penyakit/cari`,
                    dataType: 'json',
                    data: (params) => {
                        return {
                            kd_penyakit: params.term
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: `${item.kd_penyakit} - ${item.nm_penyakit}`,
                                    id: item.kd_penyakit
                                }
                            })
                        };
                    },
                    cache: false
                }
            })
            setProsedurPasienRanap(no_rawat)
            setDiagnosisAkhirPasienRanap(no_rawat)



        })


        function setDiagnosisAkhirPasienRanap(no_rawat){
            const tbDiagnosisAkhirRanap = $('#tbDiagnosisAkhirRanap').find('tbody')
            const selected = $('#formDxPx').find('#diagnosa');
            $.get(`/erm/penyakit/pasien/ambil`, {
                'no_rawat': no_rawat

            }).done((response) => {
                tbDiagnosisAkhirRanap.empty()
                selected.empty()
                if (response.length === 0) {
                    return false;
                }
                const contentDiagnosis = response.map((item, index) => {
                    return `<tr>
                        <td>${item.no_rawat}</td>
                        <td>${item.kd_penyakit}</td>
                        <td>${item.penyakit.nm_penyakit}</td>
                        <td>${item.prioritas}</td>

                       </tr>`
                }).join('')

                tbDiagnosisAkhirRanap.html(contentDiagnosis)

                selected.empty();

                response.forEach(item => {
                    const option = new Option(
                        `${item.kd_penyakit} - ${item.penyakit.nm_penyakit}`,
                        item.kd_penyakit,
                        true,
                        true
                    );
                    selected.append(option);
                });

                selected.trigger('change');

            })
        }

        function setProsedurPasienRanap(no_rawat){
            const tbProsedurPasienRanap = $('#tbProsedurPasienRanap').find('tbody')
            const selected = $('#formDxPx').find('#prosedur');
            $.get(`/erm/prosedur/pasien/ambil`, {
                'no_rawat': no_rawat

            }).done((response) => {
                selected.empty()
                tbProsedurPasienRanap.empty()
                if (response.length === 0) {
                    return false;
                }

                const contentProsedur = response.map((item, index) => {
                    return `<tr>
                        <td>${item.no_rawat}</td>
                        <td>${item.kode}</td>
                        <td>${item.icd9.deskripsi_pendek}</td>
                        <td>${item.prioritas}</td>

                       </tr>`
                }).join('')
                tbProsedurPasienRanap.html(contentProsedur)


                selected.empty();

                response.forEach(item => {
                    const option = new Option(
                        `${item.kode} - ${item.icd9.deskripsi_pendek}`,
                        item.kode,
                        true,
                        true
                    );
                    selected.append(option);
                });

                selected.trigger('change');
            })
        }


        $('#btnSimpanDxPx').on('click', function () {
            const dataForm = getDataForm('#formDxPx', ['select']);
            const no_rawat = $('#formInfoPasien').find('input[name=no_rawat]').val();

            const {diagnosa, prosedur} = dataForm;

            const dataDiagnosa = diagnosa.map(function (item, index) {
                const prioritas = index + 1;
                return {
                    'no_rawat': no_rawat,
                    'kd_penyakit': item,
                    'status': 'Ranap',
                    'prioritas': prioritas
                }
            })

            const dataProsedur = prosedur.map(function (item, index) {
                const prioritas = index + 1;
                return {
                    'no_rawat': no_rawat,
                    'kode': item,
                    'status': 'Ranap',
                    'prioritas': prioritas
                }
            })

            createDiagnosaRanap(no_rawat, dataDiagnosa)
            createProsedurRanap(no_rawat, dataProsedur)
        })

        function createDiagnosaRanap(no_rawat, data) {
            $.post(`/erm/penyakit/pasien`, {
                'no_rawat': no_rawat,
                'data': data
            }).done((response) => {
                setDiagnosisAkhirPasienRanap(no_rawat)
                swalToast('Diagnosa disimpan')
            }).fail((result) => {
                alertErrorAjax(result)
            })
        }

        function createProsedurRanap(no_rawat, data) {
            $.post(`/erm/prosedur/pasien`, {
                'no_rawat': no_rawat,
                'data': data
            }).done((response) => {
                setProsedurPasienRanap(no_rawat)
                swalToast('Prosedur disimpan')
            }).fail((result) => {
                alertErrorAjax(result)
            })
        }
    </script>
    @endpush