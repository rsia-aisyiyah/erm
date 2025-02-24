<div class="modal fade" id="modalDischargePlanning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>PERENCANAAN PASIEN PULANG (DISCHARGE PLANNING)</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formDischargePlanning">
                    <div class="row gy-2">
                        <div class="col-lg-2">
                            <label for="no_rawat" class="form-label">No. Rawat</label>
                            <input type="text" class="form-control" id="no_rawat" name="no_rawat" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label for="nm_pasien" class="form-label">Pasien</label>
                            <input type="text" class="form-control" id="nm_pasien" name="nm_pasien" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="keluarga" class="form-label">Keluarga</label>
                            <input type="text" class="form-control" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="kamar" class="form-label">Kamar</label>
                            <input type="text" class="form-control" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="tgl_registrasi" class="form-label">Tgl. Masuk</label>
                            <input type="text" class="form-control" id="tgl_registrasi" name="tgl_registrasi" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="diagnosa" class="form-label">Diag. Awal</label>
                            <input type="text" class="form-control" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="dokter" class="form-label">DPJP</label>
                            <input type="text" class="form-control" id="dokter" name="dokter" readonly>
                            <input type="hidden" id="kd_dokter" name="kd_dokter" readonly>
                        </div>

                    </div>
                    <hr>
                    <div class="alert alert-success p-2 d-none" role="alert" id="alertDischargePlanning">

                        <small> <strong>Data Sudah Diisi !</strong> oleh <strong class="petugas_input"></strong> pada <strong class="tgl_input"></strong>, Silahkan hubungi petugas apabila terdapat ketidak sesuaian</small>
                    </div>
                    <div class="row gy-2 sectionMonitoring">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="petugas" class="form-label">Petugas</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="nip" name="nip" value="{{ session()->get('pegawai')->nik }}" readonly />
                                <x-input id="petugas" name="petugas" value="{{ session()->get('pegawai')->nama }}" class="w-25" readonly />
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tgl_rencana_pulang" class="form-label">Tgl. Rencana Pulang</label>
                            <x-input id="tgl_rencana_pulang" name="tgl_rencana_pulang" class="datetimepicker" />
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="rencana_rawat" class="form-label">Rencana Rawat</label>
                            <x-input-group class="input-group-sm">
                                <x-input id="rencana_rawat" name="rencana_rawat" type="number" value=0 />
                                <x-input-group-text>
                                    Hari
                                </x-input-group-text>

                            </x-input-group>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="diagnosa_keluar" class="form-label">Diagnosa Keluar</label>
                            <select class="form-select" name="diagnosa_keluar" id="diagnosa_keluar" data-dropdown-parent="#modalDischargePlanning" style="width:100%"></select>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border ps-3">
                                <legend class="w-auto float-none" style="font-size: 12px">Kondisi Pulang</legend>
                                <x-input-group>
                                    <x-radio-group
                                        name="kondisi_pulang"
                                        :radios="[
                                            'pulang1' => ['value' => 'Sembuh', 'label' => 'Sembuh', 'checked' => true],
                                            'pulang2' => ['value' => 'Pulang APS', 'label' => 'Pulang APS'],
                                            'pulang3' => ['value' => 'Meninggal', 'label' => 'Meninggal'],
                                        ]" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border ps-3">
                                <legend class="w-auto float-none" style="font-size: 12px">Kondisi Pulang</legend>
                                <x-input-group>
                                    <x-radio-group
                                        name="mobilisasi"
                                        :radios="[
                                            'mobilisasi1' => ['value' => 'Jalan', 'label' => 'Jalan', 'checked' => true],
                                            'mobilisasi2' => ['value' => 'Tongkat', 'label' => 'Tongkat'],
                                            'mobilisasi3' => ['value' => 'Kursi Roda', 'label' => 'Kursi Roda'],
                                            'mobilisasi4' => ['value' => 'Brangkar', 'label' => 'Brangkar'],
                                        ]" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border ps-3">
                                <legend class="w-auto float-none" style="font-size: 12px">Alat yang Terpasang Saat Pulang</legend>
                                <x-input-group>
                                    <x-radio-group
                                        name="alat_terpasang"
                                        :radios="[
                                            'alat_terpasang1' => ['value' => 'Tidak Ada', 'label' => 'Tidak Ada', 'checked' => true],
                                            'alat_terpasang2' => ['value' => 'Oksigen', 'label' => 'Oksigen'],
                                            'alat_terpasang3' => ['value' => 'Infus', 'label' => 'Infus'],
                                            'alat_terpasang4' => ['value' => 'NGT', 'label', 'label' => 'NGT'],
                                            'alat_terpasang5' => ['value' => 'Kateter', 'label' => 'Kateter'],
                                            'alat_terpasang6' => ['value' => 'Lain-lain', 'label' => 'Lain-lain'],
                                        ]" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset class="border p-3">
                                <legend class="w-auto float-none" style="font-size: 12px">Penyuluhan Kesehatan yang Diberikan</legend>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="penyuluhan"
                                        :checkboxes="[
                                            'penyuluhan1' => ['value' => 'Hand Hygiene', 'label' => 'Hand Hygiene', 'checked' => true],
                                            'penyuluhan2' => ['value' => 'Evakuasi Kebakaran', 'label' => 'Evakuasi Kebakaran'],
                                            'penyuluhan3' => ['value' => 'Penggunaan APAR', 'label' => 'Penggunaan APAR'],
                                            'penyuluhan4' => ['value' => 'Bantuan Hidup Dasar', 'label' => 'Bantuan Hidup Dasar'],
                                            'penyuluhan5' => ['value' => 'Perawatan NGT', 'label' => 'Perawatan NGT'],
                                            'penyuluhan6' => ['value' => 'Perawatan Kateter', 'label' => 'Perawatan Kateter'],
                                            'penyuluhan7' => ['value' => 'Perawatan Luka', 'label' => 'Perawatan Luka'],
                                            'penyuluhan8' => ['value' => 'Infus', 'label' => 'Infus'],
                                            'penyuluhan9' => ['value' => 'Pengaturan Diet', 'label' => 'Pengaturan Diet'],
                                            'penyuluhan10' => ['value' => 'Pemberian Obat', 'label' => 'Pemberian Obat'],
                                            'penyuluhan11' => ['value' => 'Oksigen', 'label' => 'Oksigen'],
                                            'penyuluhan12' => ['value' => 'Lain-lain', 'label' => 'Lain-lain'],
                                        ]" />
                                    <x-input id="penyuluhan_lain" name="penyuluhan_lain" class="form-underline" disabled />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-6">
                            <fieldset class="border p-3">
                                <legend class="w-auto float-none" style="font-size: 12px">Dokumen / Hasil Pemeriksaan Penunjang yang Diberikan</legend>
                                <div class="row gy-2 mb-2" id="fieldDokumen">
                                    <div class="col-6">
                                        <x-input-group>
                                            <x-checkbox id="dokumen_penunjang1" name="dokumen_penunjang" value="RO" label='RO' onchange="setStatusInputChek(this)" />
                                            <x-input id="input_dokumen_RO" name="input_dokumen_RO" class="form-underline" disabled />
                                        </x-input-group>
                                    </div>
                                    <div class="col-6">
                                        <x-input-group>
                                            <x-checkbox id="dokumen_penunjang2" name="dokumen_penunjang" value="CT-Scan" label='CT-Scan' onchange="setStatusInputChek(this)" />
                                            <x-input id="input_dokumen_CT-Scan" name="input_dokumen_CT-Scan" class="form-underline" disabled />
                                        </x-input-group>
                                    </div>
                                    <div class="col-6">
                                        <x-input-group>
                                            <x-checkbox id="dokumen_penunjang3" name="dokumen_penunjang" value="USG" label='USG' onchange="setStatusInputChek(this)" />
                                            <x-input id="input_dokumen_USG" name="input_dokumen_USG" class="form-underline" disabled />
                                        </x-input-group>
                                    </div>
                                    <div class="col-6">
                                        <x-input-group>
                                            <x-checkbox id="dokumen_penunjang4" name="dokumen_penunjang" value="Lab" label='Lab' onchange="setStatusInputChek(this)" />
                                            <x-input id="input_dokumen_Lab" name="input_dokumen_Lab" class="form-underline" disabled />
                                        </x-input-group>
                                    </div>
                                    <div class="col-6">
                                        <x-input-group>
                                            <x-checkbox id="dokumen_penunjang5" name="dokumen_penunjang" value="Lain-lain" label='Lain-lain' onchange="setStatusInputChek(this)" />
                                            <x-input id="input_dokumen_Lain-lain" name="input_dokumen_Lain-lain" class="form-underline" disabled />
                                        </x-input-group>
                                    </div>
                                </div>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="dokumen_penunjang"
                                        :checkboxes="[
                                            'dokumen_penunjang6' => ['value' => 'EKG', 'label' => 'EKG'],
                                            'dokumen_penunjang7' => ['value' => 'Surat Istirahat/Surat Sakit', 'label' => 'Surat Istirahat/Surat Sakit'],
                                            'dokumen_penunjang8' => ['value' => 'Surat Keterangan Dirawat', 'label' => 'Surat Keterangan Dirawat'],
                                            'dokumen_penunjang9' => ['value' => 'Surat Lepas Rawat', 'label' => 'Surat Lepas Rawat'],
                                        ]" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <label for="aturan_pakai" class="form-label">Obat yang Diberikan Saat Pulang</label>
                            <a href="javascript:void(0)" onclick="showModalObatDischargePlanning()"><i class="bi bi-search"></i></a>
                            <table class="mt-2 table table-bordered table-striped table-sm" id="tableObatDischargePlanning">
                                <thead>
                                    <tr>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Dosis</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="diet_dirumah" class="form-label">Diet Dirumah</label>
                            <x-input id="diet_dirumah" name="diet_dirumah" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="instruksi" class="form-label">Instruksi Tindak Lanjut</label>
                            <x-input id="instruksi" name="instruksi" />
                            @csrf
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" id="btnCreateDischargePlanning">
                    <i class="bi bi-save me-1">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle me-1">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalObatDischargePlanning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>PEMBERIAN OBAT PULANG</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formObatDischargePlanning" class="mb-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="obat" class="form-label">Obat</label>
                            <select class="form-select" name="obat" id="obat" data-dropdown-parent="#modalObatDischargePlanning" style="width:100%" id="selectObatDischargePlanning"></select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <x-input id="jumlah" name="jumlah" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="dosis" class="form-label">Dosis</label>
                            <x-input id="dosis" name="dosis" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <x-input id="keterangan" name="keterangan" />
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3" id="tbResepObatPulang" width="100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Aturan Pakai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" id="btnCreateObatDischargePlanning">
                    <i class="bi bi-save me-1">
                    </i> Simpan

                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle me-1">Keluar
                    </i>
                </button>
            </div>

        </div>
    </div>
</div>
@push('script')
    <script>
        const modalDischargePlanning = $('#modalDischargePlanning');
        const modalObatDischargePlanning = $('#modalObatDischargePlanning');
        const formDischargePlanning = $('#formDischargePlanning');
        const formObatDischargePlanning = $('#formObatDischargePlanning');
        const selectDiagnosaKeluar = formDischargePlanning.find('select[name=diagnosa_keluar]');
        const btnCreateDischargePlanning = $('#btnCreateDischargePlanning');
        const selectObatDischargePlanning = formObatDischargePlanning.find('select[name=obat]');
        const btnCreateObatDischargePlanning = $('#btnCreateObatDischargePlanning');
        const tableObatDischargePlanning = $('#tableObatDischargePlanning');
        const tableResepObatPulang = $('#tbResepObatPulang');

        modalDischargePlanning.on('hidden.bs.modal', () => {
            $('#alertDischargePlanning').addClass('d-none');
            tableObatDischargePlanning.find('tbody').empty();
            tableResepObatPulang.find('tbody').empty();
            formDischargePlanning.trigger('reset');
            formDischargePlanning.find('input[name=penyuluhan_lain]').prop('disabled', true);
            formDischargePlanning.find('input[name=penyuluhan_lain]').prop('disabled', true);
            selectDiagnosaKeluar.val('-').trigger('change');
            $('#fieldDokumen').find('input[type=text]').prop('disabled', true);
        })

        selectDiagnosaKeluar.select2({
            placeholder: 'Pilih Diagnosa Keluar',
            allowClear: true,
            tags: true,
            ajax: {
                url: `${url}/penyakit/cari`,
                type: 'get',
                data: function(params) {
                    return {
                        nm_penyakit: params.term,
                        kd_penyakit: params.term
                    }
                },
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.kd_penyakit} - ${item.nm_penyakit}`,
                                id: `${item.kd_penyakit} - ${item.nm_penyakit}`
                            }
                        })
                    };
                },
                cache: true
            }
        })

        selectObatDischargePlanning.select2({
            placeholder: 'Pilih Obat',
            allowClear: true,
            tags: true,
            ajax: {
                url: `${url}/obat`,
                type: 'get',
                data: function(params) {
                    return {
                        nama: params.term
                    }
                },
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: `${item.nama_brng}`,
                                id: `${item.nama_brng}`
                            }
                        })
                    };
                },
                cache: true
            }
        })


        function showModalObatDischargePlanning() {
            const no_rawat = formObatDischargePlanning.find('input[name=no_rawat]').val();
            modalObatDischargePlanning.modal('show');

        }
        btnCreateObatDischargePlanning.on('click', () => {
            const form = $(`#formObatDischargePlanning`);
            const data = getDataForm('#formObatDischargePlanning', ['input', 'select', 'checkbox', 'radio']);
            tableObatDischargePlanning.find('tbody').append(`<tr id="${data.obat};${data.jumlah};${data.dosis};${data.keterangan}">
                <td>${data.obat}</td>
                <td>${data.jumlah}</td>
                <td>${data.dosis}</td>
                <td>${data.keterangan}</td>
                <td><a href="javascript:void(0)" onclick="hapusObatDischargePlanning('${data.id};${data.obat};${data.jumlah};${data.dosis};${data.keterangan}')"><i class="bi bi-trash-fill text-danger"></i></a></td>
                </tr>`)
        })

        btnCreateDischargePlanning.on('click', (e) => {
            e.preventDefault();
            const form = $(`#formDischargePlanning`);
            const data = getDataForm('#formDischargePlanning', ['input', 'select', 'checkbox', 'radio']);
            const obat = tableObatDischargePlanning.find('tbody');
            const tanggal_rencana = data['tgl_rencana_pulang'].split(' ')[0];
            const jam_rencana = data['tgl_rencana_pulang'].split(' ')[1];
            data['tgl_rencana_pulang'] = `${splitTanggal(tanggal_rencana)} ${jam_rencana}`;

            if (data.dokumen_penunjang) {
                let dokumen = [];
                const penunjang = data.dokumen_penunjang.map((item, index) => {
                    const input = data[`input_dokumen_${item}`];
                    return `${item}${input ? ` : ${input}` : ''}`;
                }).join(';')
                data['dokumen_penunjang'] = penunjang
            }
            if (data.penyuluhan) {
                const penyuluhan = data.penyuluhan.map((item, index) => {
                    return item
                }).join(';')

                data['penyuluhan'] = penyuluhan
            }

            if (obat.find('tr').length) {
                let obatData = '';
                const listObat = obat.find('tr').each((index, item) => {
                    const nm_obat = $(item).find('td:first').text();
                    const jumlah = $(item).find('td:nth-child(2)').text();
                    const dosis = $(item).find('td:nth-child(3)').text();
                    const keterangan = $(item).find('td:nth-child(4)').text();

                    obatData += `${nm_obat}; ${jumlah}; ${dosis}; ${keterangan}\n`
                    // obatData.push({
                    //     obat: obatData[index].obat,
                    //     jumlah: obatData[index].jumlah,
                    //     dosis: obatData[index].dosis,
                    //     keterangan: obatData[index].keterangan
                    // })
                })
                data['obat_pulang'] = obatData;
            }


            $.post(`${url}/discharge-planning`, data).done((response) => {
                alertSuccessAjax()
                modalDischargePlanning.modal('hide')
                $('#formDischargePlanning').trigger('reset')
                tb_ranap();
            }).fail((error) => {
                let errorMessage = '';
                if (error.status === 422) {
                    formDischargePlanning.find(`input`)
                    const {
                        responseJSON
                    } = error;
                    Object.entries(responseJSON.errors).forEach(([field, messages]) => {
                        messages.forEach(message => {
                            errorMessage += `${field} : ${message} <br/>`
                        })

                    })
                } else {
                    errorMessage = `${error.responseJSON}. <br><small>ErrCode [${error.status}]</small> `
                }
                Swal.fire({
                    icon: "error",
                    title: error.statusText,
                    html: `<small class="text-danger">${errorMessage}</small>`,
                    showConfirmButton: true
                })
            })

        });

        function setStatusInputChek(e) {
            const element = $(e);
            const id = element.attr('id');
            const value = element.val() === '-' || element.val() === "" ? '' : element.val();
            const status = element.prop('checked');
            const input = formDischargePlanning.find(`input[name=input_dokumen_${value}]`);

            input.prop('disabled', !status).val(status ? '-' : '');

        }

        const checkPenyuluhanLain = formDischargePlanning.find('#penyuluhan12');

        checkPenyuluhanLain.on('change', (e) => {
            const element = $(e.target);
            const status = element.prop('checked');
            const input = formDischargePlanning.find('input[name=penyuluhan_lain]');
            const value = element.val() === '-' || element.val() === "" ? '' : element.val();
            input.prop('disabled', !status).val(value);
        })

        function showModalDischargePlanning(no_rawat) {
            modalDischargePlanning.modal('show')

            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    kamar_inap,
                    dokter
                } = response;

                const kamar = response.kamar_inap.map((item) => {
                    const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                    return [valKamar, item.diagnosa_awal];
                }).join(',');

                const tgl_dischare = formDischargePlanning.find('input[name=tgl_rencana_pulang]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');

                tgl_dischare.val(dateNow);
                formDischargePlanning.find('input[name=no_rawat]').val(no_rawat);
                formDischargePlanning.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formDischargePlanning.find('input[name=keluarga]').val(response.p_jawab)
                formDischargePlanning.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formDischargePlanning.find('input[name=kamar]').val(kamar.split(',')[0]);
                formDischargePlanning.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formDischargePlanning.find('input[name=diagnosa]').val(kamar.split(',')[1]);
                formDischargePlanning.find('input[name=dokter]').val(dokter.nm_dokter);



                $.get(`${url}/discharge-planning`, {
                    no_rawat: no_rawat
                }).done((response) => {

                    if (Object.values(response).length) {
                        $('.tgl_input').text(formatTanggal(response.tanggal));
                        $('.petugas_input').text(response.petugas.nama);

                        $('#alertDischargePlanning').removeClass('d-none');
                        const tgl_rencana_pulang = response.tgl_rencana_pulang.split(' ')[0];
                        const jam_rencana_pulang = response.tgl_rencana_pulang.split(' ')[1];
                        formDischargePlanning.find('input[name=tgl_rencana_pulang]').val(`${splitTanggal(tgl_rencana_pulang)} ${jam_rencana_pulang}`);
                        formDischargePlanning.find('input[name=rencana_rawat]').val(response.rencana_rawat);
                        formDischargePlanning.find('input[name=penyuluhan_lain]').val(response.penyuluhan_lain);
                        formDischargePlanning.find(`input[name=mobilisasi][value="${response.mobilisasi}"]`).prop('checked', true).trigger('change');
                        formDischargePlanning.find(`input[name=alat_terpasang][value="${response.alat_terpasang}"]`).prop('checked', true).trigger('change');
                        formDischargePlanning.find(`input[name=kondisi_pulang][value="${response.kondisi_pulang}"]`).prop('checked', true).trigger('change');
                        formDischargePlanning.find(`input[name=diet_dirumah]`).val(response.diet_dirumah);
                        formDischargePlanning.find(`input[name=instruksi]`).val(response.instruksi);
                        formDischargePlanning.find('input[name=petugas]').val(response.petugas.nama);
                        formDischargePlanning.find('input[name=nip]').val(response.nip);
                        const optionDiagnosa = new Option(response.diagnosa_keluar, response.diagnosa_keluar, true, true)
                        formDischargePlanning.find('select[name=diagnosa_keluar]').append(optionDiagnosa).trigger('change');

                        setPenyuluhanDischargePlanning(response.penyuluhan)
                        setDokumenDischargePlanning(response.dokumen_penunjang)
                        setObatDischargePlanning(response.obat_pulang)
                    } else {
                        formDischargePlanning.find('input[name=petugas]').val("{{ session()->get('pegawai')->nama }}");
                        formDischargePlanning.find('input[name=nip]').val("{{ session()->get('pegawai')->nik }}");
                    }

                })
                modalDischargePlanning.modal('show')


            })
        }

        function setPenyuluhanDischargePlanning(content) {
            const arrContent = content ? content.split(';') : '';
            if (arrContent.length < 1) {
                return false;
            }
            arrContent.forEach(element => {
                formDischargePlanning.find(`input[name=penyuluhan][value="${element}"]`).prop('checked', true).trigger('change');
            });
        }

        function setDokumenDischargePlanning(content) {
            const arrContent = content ? content.split(';') : '';
            if (arrContent.length < 1) {
                return false;
            }
            arrContent.forEach(element => {
                const arrElement = element.split(' : ');
                if (arrElement.length === 2) {
                    formDischargePlanning.find(`input[name=dokumen_penunjang][value="${arrElement[0]}"]`).prop('checked', true).trigger('change');
                    formDischargePlanning.find(`input[name=input_dokumen_${arrElement[0]}]`).val(`${arrElement[1]}`)
                }
                formDischargePlanning.find(`input[name=dokumen_penunjang][value="${element}"]`).prop('checked', true).trigger('change');
            });
        }

        function setObatDischargePlanning(content) {
            const arrContent = content ? content.split('\n') : '';
            const obat = tableObatDischargePlanning.find('tbody');
            obat.empty();
            if (arrContent.length < 1) {
                return false;
            }
            arrContent.forEach(element => {
                const arrElement = element.split(';');
                obat.append(`<tr id="${arrElement[0]};${arrElement[1]};${arrElement[2]};${arrElement[3]}">
                <td>${arrElement[0]}</td>
                <td>${arrElement[1]}</td>
                <td>${arrElement[2]}</td>
                <td>${arrElement[3]}</td>
                <td><a href="javascript:void(0)" onclick="hapusObatDischargePlanning('${arrElement[0]};${arrElement[1]};${arrElement[2]};${arrElement[3]}')"><i class="bi bi-trash-fill text-danger"></i></a></td>
                </tr>`)
            })

        }

        function hapusObatDischargePlanning(content) {
            const arrContent = content.split(';');
            const obat = tableObatDischargePlanning.find('tbody');
            obat.find(`tr[id="${content}"]`).remove();
        }

        // function loadTableEdukasiObat(no_rawat) {
        //     $.get(`${url}/edukasi-obat-pulang`, {
        //         no_rawat: no_rawat,
        //     }).done((response) => {
        //         const data = response.map((item) => {
        //             return `<tr>
    //                     <td>${item.tgl}</td>
    //                     <td>${item.obat.nama_brng}</td>
    //                     <td>${item.aturan}</td>
    //                     <td>${item.jml}</td>
    //                     <td>${item.intruksi}</td>
    //                     <td>${item.pagi === '1' ? 'Pagi,' :''} ${item.siang === '1' ? 'Siang,' :''} ${item.sore === '1' ? 'Sore,' :''}${item.malam === '1' ? 'Malam,' :''}</td>
    //                     <td>${item.keterangan}</td>
    //                     <td>${item.petugas.nama}</td>
    //                     <td><a href="javascript:void(0)" onclick="deleteEdukasiObatPulang('${item.no_rawat}', '${item.kode_brng}', '${item.nip}')" class="text-danger" style="cursor: pointer"><i class="bi bi-trash3"></i></a></td>
    //                 </tr>`
        //         })

        //         tableEdukasiObatPulang.find('tbody').empty().html(data)
        //     })
        // }

        // function createEdukasiObatPulang() {
        //     const data = getDataForm('#formDischargePlanning', ['input', 'select', 'textarea']);
        //     $.post(`${url}/edukasi-obat-pulang`, data, (res) => {
        //         loadTableEdukasiObat(data.no_rawat)
        //         toastReload('Berhasil', 2000)

        //         formDischargePlanning.find('input[name=jml]').val('-')
        //         formDischargePlanning.find('input[name=aturan_pakai]').val('-')
        //         formDischargePlanning.find('input[name=instruksi]').val('-')
        //         formDischargePlanning.find('input[name=keterangan]').val('-')
        //         selectObatPulang.val(null).trigger('change');
        //     })

        // }

        // function deleteEdukasiObatPulang(no_rawat, kode_brng, nip) {
        //     Swal.fire({
        //         title: 'Yakin ?',
        //         text: "Anda tidak bisa mengembalikan lagi",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, hapus saja!',
        //         cancelButtonText: 'Jangan',
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.post(`${url}/edukasi-obat-pulang/delete`, {
        //                 no_rawat: no_rawat,
        //                 kode_brng: kode_brng,
        //                 nip: nip,
        //                 _token: "{{ csrf_token() }}"
        //             }).done((response) => {
        //                 loadTableEdukasiObat(no_rawat)
        //                 toastReload('Berhasil', 2000)
        //             }).fail((error) => {
        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Gagal !',
        //                     text: error.responseJSON,
        //                 })
        //             })
        //         }

        //     })
        // }
    </script>
@endpush
