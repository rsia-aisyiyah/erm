<div class="modal fade" id="modalAsesmenNyeriAnak" tabindex="-1" aria-labelledby="modalAsesmenNyeriAnak" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id=""><i>ASESMEN NYERI ANAK > 7 TAHUN (NUMERIC RATING SCALE)</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsesmenNyeriAnak">
                    <div class="row gy-2">
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="no_rawat" class="form-label">No. Rawat</label>
                            <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" readonly>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <label for="nm_pasien" class="form-label">Pasien</label>
                            <x-input-group>
                                <x-input id="no_rkm_medis" name="no_rkm_medis" readonly />
                                <input type="text" class="form-control form-control-sm w-50" id="nm_pasien" name="nm_pasien" readonly>
                            </x-input-group>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="keluarga" class="form-label">Keluarga</label>
                            <input type="text" class="form-control form-control-sm" id="keluarga" name="keluarga" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control form-control-sm" id="alamat" name="alamat" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="kamar" class="form-label">Kamar</label>
                            <input type="text" class="form-control form-control-sm" id="kamar" name="kamar" readonly>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="tgl_registrasi" class="form-label">Tgl. Masuk</label>
                            <input type="text" class="form-control form-control-sm" id="tgl_registrasi" name="tgl_registrasi" readonly>
                        </div>
                        <div class="col-lg-2">
                            <label for="diagnosa" class="form-label">Diag. Awal</label>
                            <input type="text" class="form-control form-control-sm" id="diagnosa" name="diagnosa" readonly>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="dokter" class="form-label">DPJP</label>
                            <input type="text" class="form-control form-control-sm" id="dokter" name="dokter" readonly>
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
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <x-input-group class="input-group-sm">
                                <x-input-group-text>
                                    <i class="bi bi-calendar3"></i>
                                </x-input-group-text>
                                <x-input id="tanggal" name="tanggal" class="datetimepicker" />

                            </x-input-group>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">

                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Pemicu / Provocataion (P)</legend>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="pemicu"
                                        :checkboxes="[
                                            'pemicuAnak1' => ['value' => 'Benturan', 'label' => 'Benturan'],
                                            'pemicuAnak2' => ['value' => 'Penyayatan', 'label' => 'Penyayatan'],
                                            'pemicuAnak3' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input class="br-full" id="pemicu_lainnya" name="pemicu_lain" disabled></x-input>
                                </x-input-group>
                            </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Kualitas / Quality (Q)</legend>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="kualitas"
                                        :checkboxes="[
                                            'kualitasAnak1' => ['value' => 'Tertusuk', 'label' => 'Tertusuk'],
                                            'kualitasAnak2' => ['value' => 'Tertekan', 'label' => 'Tertekan'],
                                            'kualitasAnak3' => ['value' => 'Tertimpa Benda', 'label' => 'Tertimpa Benda'],
                                            'kualitasAnak4' => ['value' => 'Diiris-iris', 'label' => 'Diiris-iris'],
                                            'kualitasAnak5' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input class="br-full" id="kualitas_lain" name="kualitas_lain" disabled></x-input>
                                </x-input-group>
                            </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Lokasi / Region (R)</legend>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="lokasi"
                                        :checkboxes="[
                                            'lokasiAnak1' => ['value' => 'Perut', 'label' => 'Perut'],
                                            'lokasiAnak2' => ['value' => 'Tangan Kanan', 'label' => 'Tangan Kanan'],
                                            'lokasiAnak3' => ['value' => 'Tangan Kiri', 'label' => 'Tangan Kiri'],
                                            'lokasiAnak4' => ['value' => 'Dada', 'label' => 'Dada'],
                                            'lokasiAnak5' => ['value' => 'Kepala', 'label' => 'Kepala'],
                                            'lokasiAnak6' => ['value' => 'Kaki Kanan', 'label' => 'Kaki Kanan'],
                                            'lokasiAnak7' => ['value' => 'Kaki Kiri', 'label' => 'Kaki Kiri'],
                                            'lokasiAnak8' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input class="br-full" id="lokasi_lain" name="lokasi_lain" disabled></x-input>
                                </x-input-group>
                            </fieldset>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <img src="{{ asset('/img/skala_nyeri_wong_baker_color.png') }}" alt="" class="mx-auto d-block" style="width:100%;height:auto" />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Skala Nyeri dan Interpretasi (S)</legend>
                                <input type="range" class="form-range" min="0" max="10" step="1" id="skala" name="skala">
                                <img src="" alt="" id="imageSkalaNyeri" class="mx-auto d-block" style="width:100px;height:auto">
                                <h6 class="text-center d-none" id="textSkala"></h6>
                            </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="waktu" class="form-label">Waktu Timbulnya Nyeri / Timing (T)</label>
                            <x-input id="waktu" name="waktu" />
                        </div>

                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Penanganan yang Diberikan</legend>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="penanganan_farmakologi" class="form-label">Penanganan Farmakologi</label>
                                        <x-input id="penanganan_farmakologi" name="penanganan_farmakologi" />
                                    </div>
                                    <div class="col-8">
                                        <label for="penanganan_non_farmakologi" class="form-label">Penanganan Non-Farmakologi</label>
                                        <x-input-group>
                                            <x-checkbox-group
                                                name="penanganan_non_farmakologi"
                                                :checkboxes="[
                                                    'penanganan_non_farmakologiAnak1' => ['value' => 'Istirahat', 'label' => 'Istirahat'],
                                                    'penanganan_non_farmakologiAnak2' => ['value' => 'Alih Perhatian', 'label' => 'Alih Perhatian'],
                                                    'penanganan_non_farmakologiAnak3' => ['value' => 'Reposisi', 'label' => 'Reposisi'],
                                                    'penanganan_non_farmakologiAnak4' => ['value' => 'Distraksi Relaksasi', 'label' => 'Distraksi Relaksasi'],
                                                    'penanganan_non_farmakologiAnak5' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                                ]" />
                                            <x-input id="penanganan_non_farmakologi_lain" name="penanganan_non_farmakologi_lain" disabled class="br-full" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <div class="table-responsive overflow-x-auto" style="max-width: 100%">
                                <table class="mt-2 table table-bordered table-striped nowrap" id="tableAsesmenNyeriAnak">
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenNyeriAnak">
                    <i class="bi bi-save me-1">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 13px">
                    <i class="bi bi-x-circle me-1">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalAsesmenNyeriAnak = $('#modalAsesmenNyeriAnak');
        const formAsesmenNyeriAnak = $('#formAsesmenNyeriAnak');
        const btnCreateAsesmenNyeriAnak = $('#btnCreateAsesmenNyeriAnak');
        const tableAsesmenNyeriAnak = $('#tableAsesmenNyeriAnak');

        function showModalAsesmenNyeriAnak(no_rawat) {
            resetFormAsesmenNyeriAnak(no_rawat)
            renderTableAsesmenNyeriAnak(no_rawat)
            modalAsesmenNyeriAnak.modal('show')
        }


        function resetFormAsesmenNyeriAnak(no_rawat) {
            formAsesmenNyeriAnak.trigger('reset');
            formAsesmenNyeriAnak.find('input[name=skala]').val(0).trigger('change');
            formAsesmenNyeriAnak.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenNyeriAnak.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenNyeriAnak.find('input[name=penanganan_non_farmakologi]').prop('checked', false).trigger('change');

            getRegPeriksa(no_rawat).done((response) => {

                const {
                    pasien,
                    kamar_inap,
                    poliklinik,
                    dokter
                } = response;

                let kamar = '';

                if (kamar_inap.length >= 1) {
                    kamar = response.kamar_inap.map((item) => {
                        const valKamar = item.stts_pulang != 'Pindah Kamar' ? item.kamar.bangsal.nm_bangsal : '-';
                        return [valKamar, item.diagnosa_awal];
                    }).join(',');
                } else {
                    kamar = poliklinik.nm_poli
                }


                const tanggal = formAsesmenNyeriAnak.find('input[name=tanggal]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');
                tanggal.val(dateNow);

                formAsesmenNyeriAnak.find('input[name=no_rawat]').val(no_rawat);
                formAsesmenNyeriAnak.find('input[name=no_rkm_medis]').val(pasien.no_rkm_medis);
                formAsesmenNyeriAnak.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formAsesmenNyeriAnak.find('input[name=keluarga]').val(response.p_jawab)
                formAsesmenNyeriAnak.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formAsesmenNyeriAnak.find('input[name=kamar]').val(kamar.split(',').length >= 1 ? kamar.split(',')[0] : kamar);
                formAsesmenNyeriAnak.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formAsesmenNyeriAnak.find('input[name=diagnosa]').val(kamar.split(',').length >= 1 ? kamar.split(',')[1] : '-');
                formAsesmenNyeriAnak.find('input[name=dokter]').val(dokter.nm_dokter);
            })
        }

        function renderTableAsesmenNyeriAnak(no_rawat) {
            $.get(`${url}/asesmen-nyeri-anak`, {
                no_rawat: no_rawat
            }).done((response) => {
                const tbody = tableAsesmenNyeriAnak.find('tbody');
                tbody.empty(); // Bersihkan konten tbody
                if (Object.keys(response).length == 0) {
                    return false;
                }

                resetFormAsesmenNyeriAnak(no_rawat)

                const barisData = [{
                        label: "Tanggal",
                        key: "tanggal",
                        key_lain: ""
                    },
                    {
                        label: "Penyebab / Provocataion (P)",
                        key: "pemicu",
                        key_lain: "pemicu_lain"
                    },
                    {
                        label: "Kualitas / Quality (Q)",
                        key: "kualitas",
                        key_lain: "kualitas_lain"
                    },
                    {
                        label: "Lokasi / Region (R)",
                        key: "lokasi",
                        key_lain: "lokasi_lain"
                    },
                    {
                        label: "Skala nyeri dan Interpretasi (S)",
                        key: "skala",
                        key_lain: "ket_skala"
                    },
                    {
                        label: "Waktu Timbulnya Nyeri / Timing (T)",
                        key: "waktu"
                    },
                    {
                        label: "Penanganan",
                        key: "penanganan_farmakologi",
                        key_lain: "penanganan_non_farmakologi",
                        key_lain_lain: "penanganan_non_farmakologi_lain"
                    },
                    {
                        label: "Petugas",
                        key: "petugas"
                    }, {
                        label: "Aksi",
                        key: "action"
                    }
                ];

                const headerRow = $("<tr></tr>");
                headerRow.append($("<th></th>")); // Kolom kosong untuk label

                response.forEach((item, index) => {
                    if (index === 0) {
                        headerRow.append($("<th></th>").text("Asesmen Awal"));
                    } else {
                        headerRow.append($("<th></th>").text("Asesmen Ulang"));
                    }

                })
                tbody.append(headerRow);

                barisData.forEach(item => {
                    const baris = $("<tr></tr>");
                    baris.append($(`<th width="15%"></th>`).text(item.label));
                    // Tambahkan baris header "Asesmen Awal" dan "Asesmen Ulang"
                    response.forEach(objek => {
                        const selData = $("<td></td>");
                        let values = [];
                        if (item.key === "petugas") {
                            const value = objek[item.key];
                            values.push(value.nama);
                        } else if (item.key === 'tanggal') {
                            const value = objek[item.key];

                            values.push(`${formatTanggal(value)}`);
                        } else if (item.key === 'skala') {
                            const value = objek[item.key];
                            let resource = "";
                            if (value == 0) {
                                resource = "{{ asset('/img/skala_1.png') }}"
                            } else if (value >= 1 && value <= 3) {
                                resource = "{{ asset('/img/skala_1-3.png') }}"
                            } else if (value >= 4 && value <= 5) {
                                resource = "{{ asset('/img/skala_4-5.png') }}"
                            } else if (value == 6) {
                                resource = "{{ asset('/img/skala_6.png') }}"
                            } else if (value >= 7 && value <= 9) {
                                resource = "{{ asset('/img/skala_6-8-9.png') }}"
                            } else if (value == 10) {
                                resource = "{{ asset('/img/skala_10.png') }}"

                            }
                            values.push(`<img src="${resource}" class="position-relative" width="50px">`)
                            values.push(`${objek[item.key]} ( ${objek[item.key_lain]} )`);


                        } else if (item.key === 'penanganan_farmakologi') {
                            const value = objek[item.key];
                            values.push(`<strong>Farmakologi : </strong> <br/>${value}`);
                            if (objek[item.key_lain]) {
                                const nonFarmakologi = objek[item.key_lain].split(';').map((vals) => {
                                    return `<li>${vals} ${vals === 'Lainnya' && objek[item.key_lain_lain] ? `: ${objek[item.key_lain_lain]}` : ''}</li>`;
                                });
                                values.push(`<strong>Non Farmakologi : </strong>`);
                                values.push(`<ul class="ms-0">${nonFarmakologi.join('')}</ul>`);
                            }
                        } else if (item.key === 'action') {
                            const user = "{{ session()->get('pegawai')->nik }}";
                            const content = `
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteAsesmenNyeriAnak('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-trash me-1"></i> Hapus</button>
                            <button type="button" class="btn btn-sm btn-primary" onclick="editAsesmenNyeriAnak('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-pencil me-1"></i> Edit</button>`
                            const action = user === objek['petugas']['nama'] ? content : '';
                            values.push(action);
                        } else {
                            if (objek[item.key]) values.push(...objek[item.key].split(';').map(v => v.trim()));
                            if (objek[item.key_lain]) values.push(...objek[item.key_lain].split(';').map(v => v.trim()));
                            if (objek[item.key_lain_lain]) values.push(...objek[item.key_lain_lain].split(';').map(v => v.trim()));
                        }
                        values = [...new Set(values)];
                        let value = values.filter(v => v).join('<br/>');
                        // Gabungkan baris setelah "Lainnya"
                        value = value.replace(/Lainnya<br\/>(.*)/, 'Lainnya : $1');
                        selData.html(value);
                        baris.append(selData);
                    });
                    tbody.append(baris);
                });
            })
        }

        btnCreateAsesmenNyeriAnak.on('click', () => {
            const data = getDataForm('#formAsesmenNyeriAnak', ['input', 'checkbox', 'radio']);

            const pemicu = data.pemicu ? data.pemicu.map((item) => {
                return item;
            }).join(';') : '';
            const kualitas = data.kualitas ? data.kualitas.map((item) => {
                return item;
            }).join(';') : '';
            const penanganan = data.penanganan_non_farmakologi ? data.penanganan_non_farmakologi.map((item) => {
                return item;
            }).join(';') : '';
            const lokasi = data.lokasi ? data.lokasi.map((item) => {
                return item;
            }).join(';') : '';

            data['pemicu'] = pemicu;
            data['kualitas'] = kualitas;
            data['penanganan_non_farmakologi'] = penanganan;
            data['lokasi'] = lokasi;
            data['ket_skala'] = formAsesmenNyeriAnak.find('#textSkala').text().split(' - ')[1];

            $.post(`${url}/asesmen-nyeri-anak`, data).done((response) => {
                formAsesmenNyeriAnak.find(`input`).removeClass('is-invalid');
                alertSuccessAjax('Data asesmen nyeri anak berhasil disimpan')
                renderTableAsesmenNyeriAnak(data['no_rawat']);

                return response;
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
                            formAsesmenNyeriAnak.find(`input[name=${field}]`).addClass('is-invalid');
                        })

                    })
                } else {
                    let errorDisplay = '';


                    Object.entries(error.responseJSON).forEach((item) => {
                        errorDisplay += `${item[1].substring(0,100)}****`
                    })

                    errorMessage = `${errorDisplay}<br><small>Error Code : ${error.status}</small> `
                }
                Swal.fire({
                    icon: "error",
                    title: error.statusText,
                    html: `<small class="text-danger">${errorMessage}</small>`,
                    showConfirmButton: true
                })
            })


        })


        const skalaInputAnakRange = formAsesmenNyeriAnak.find('#skala');
        skalaInputAnakRange.on('change input', () => {
            const value = skalaInputAnakRange.val()
            const imageSkalaNyeri = formAsesmenNyeriAnak.find('#imageSkalaNyeri')
            const textSkala = formAsesmenNyeriAnak.find('#textSkala');
            let resource = ''
            let text = ''
            if (value == 0) {
                resource = "{{ asset('/img/skala_1.png') }}"
                text = 'Tidak Nyeri'
            } else if (value >= 1 && value <= 3) {
                resource = "{{ asset('/img/skala_1-3.png') }}"
                text = 'Nyeri Ringan'
            } else if (value >= 4 && value <= 5) {
                resource = "{{ asset('/img/skala_4-5.png') }}"
                text = 'Tidak Nyaman'
            } else if (value == 6) {
                resource = "{{ asset('/img/skala_6.png') }}"
                text = 'Mengganggu'
            } else if (value >= 7 && value <= 9) {
                resource = "{{ asset('/img/skala_6-8-9.png') }}"
                text = 'Nyeri'
            } else if (value == 10) {
                resource = "{{ asset('/img/skala_10.png') }}"
                text = 'Nyeri Tidak Tertahankan'

            }
            textSkala.text(`${value} - ${text}`).removeClass('d-none')
            imageSkalaNyeri.attr('src', resource)


        })


        const pemicuLainAnak = formAsesmenNyeriAnak.find('#pemicuAnak3');
        pemicuLainAnak.on('change', () => {
            const input = formAsesmenNyeriAnak.find('input[name=pemicu_lain]');
            if (pemicuLainAnak.is(':checked')) {
                input.prop('disabled', false);
            } else {
                input.prop('disabled', true);
                input.val('-');
            }
        })
        const kualitasLainAnak = formAsesmenNyeriAnak.find('#kualitasAnak5');
        kualitasLainAnak.on('change', () => {
            const input = formAsesmenNyeriAnak.find('input[name=kualitas_lain]');
            if (kualitasLainAnak.is(':checked')) {
                input.prop('disabled', false);
            } else {
                input.prop('disabled', true);
                input.val('-');
            }
        })
        const penangananLainAnak = formAsesmenNyeriAnak.find('#penanganan_non_farmakologiAnak5');
        penangananLainAnak.on('change', () => {
            const input = formAsesmenNyeriAnak.find('input[name=penanganan_non_farmakologi_lain]');
            if (penangananLainAnak.is(':checked')) {
                input.prop('disabled', false);
            } else {
                input.prop('disabled', true);
                input.val('-');
            }
        })
        const lokasiLainAnak = formAsesmenNyeriAnak.find('#lokasiAnak8');
        lokasiLainAnak.on('change', () => {
            const input = formAsesmenNyeriAnak.find('input[name=lokasi_lain]');
            if (lokasiLainAnak.is(':checked')) {

                input.prop('disabled', false);
            } else {
                input.prop('disabled', true);
                input.val('-');
                if (formAsesmenNyeriAnak.find('#lokasi_lain').val() == '-') {}
            }
        })

        function deleteAsesmenNyeriAnak(no_rawat, tanggal) {
            Swal.fire({
                icon: 'question',
                title: 'Hapus Data',
                text: 'Apakah anda yakin ingin menghapus data ini ?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
            }).then((e) => {
                if (e.isConfirmed) {
                    $.post(`${url}/asesmen-nyeri-anak/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal
                    }).done((response) => {
                        alertSuccessAjax().then(() => {
                            renderTableAsesmenNyeriAnak(no_rawat)
                        })
                    }).fail((error) => {

                        Swal.fire({
                            icon: 'error',
                            title: error.statusText,
                            html: error.responseJSON
                        })
                    })
                }
            })

        }

        function editAsesmenNyeriAnak(no_rawat, tanggal) {
            $.get(`${url}/asesmen-nyeri-anak/first`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                formAsesmenNyeriAnak.find("input[tanggal]").val(response.tanggal);

                const pemicu = response.pemicu ? response.pemicu.split(';') : [];
                pemicu.forEach((item) => {
                    formAsesmenNyeriAnak.find(`input[name=pemicu][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        if (item === 'Lainnya') {
                            formAsesmenNyeriAnak.find(`input[name=pemicu_lain]`).val(response.pemicu_lain);
                        }
                    }
                })

                const kualitasAnak = response.kualitas ? response.kualitas.split(';') : [];
                kualitasAnak.forEach((item) => {
                    formAsesmenNyeriAnak.find(`input[name=kualitas][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        formAsesmenNyeriAnak.find(`input[name=kualitas_lain]`).val(response.kualitas_lain);
                    }
                })

                const lokasiAnak = response.lokasi ? response.lokasi.split(';') : [];
                lokasiAnak.forEach((item) => {
                    formAsesmenNyeriAnak.find(`input[name=lokasi][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        formAsesmenNyeriAnak.find(`input[name=lokasi_lain]`).val(response.lokasi_lain);
                    }
                })

                const penangananAnak = response.penanganan_non_farmakologi ? response.penanganan_non_farmakologi.split(';') : [];
                penangananAnak.forEach((item) => {
                    formAsesmenNyeriAnak.find(`input[name=penanganan_non_farmakologi][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        formAsesmenNyeriAnak.find(`input[name=penanganan_non_farmakologi_lain]`)
                            .val(response.penanganan_non_farmakologi_lain);
                    }
                })
                formAsesmenNyeriAnak.find('input[name=penanganan_farmakologi]').val(response.penanganan_farmakologi);
                formAsesmenNyeriAnak.find('input[name=waktu]').val(response.waktu);
                formAsesmenNyeriAnak.find('input[name=tanggal]').val(response.tanggal);
                formAsesmenNyeriAnak.find('input[name=skala]').val(response.skala).trigger('change');

            })
        }
    </script>
@endpush
