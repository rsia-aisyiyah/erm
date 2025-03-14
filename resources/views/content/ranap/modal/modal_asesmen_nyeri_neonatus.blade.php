<div class="modal fade" id="modalAsesmenNyeriNeonatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="#"><i>ASESMEN NYERI NEONATAL INFANT PAINT SCORE (0 - 28 HARI)</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsesmenNyeriNeonatus">
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

                    <div class="row gy-2 sectionFormNyeriNeonatus">
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
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label for="total_nilai" class="form-label">Total Nilai</label>
                            <x-input readonly id="total_nilai" name="total_nilai"></x-input>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <label for="total_nilai" class="form-label">Keterangan</label>
                            <x-input readonly id="keterangan" name="keterangan"></x-input>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Ekspresi Wajah</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="ekspresi_wajah_nilai"
                                                :radios="[
                                                    'ekspresi_wajah_nilai1' => ['value' => '0', 'label' => 'Otot wajah rileks, ekspresi netral'],
                                                    'ekspresi_wajah_nilai2' => ['value' => '1', 'label' => 'Otot wajah tegang, alis berkerut, rahang dan dagu terkunci'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Tangisan</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="tangisan_nilai"
                                                :radios="[
                                                    'tangisan_nilai1' => ['value' => '0', 'label' => 'Tenang, tidak menangis'],
                                                    'tangisan_nilai2' => ['value' => '1', 'label' => 'Megerang, sebentar-sebentar menangis'],
                                                    'tangisan_nilai3' => ['value' => '2', 'label' => 'Terus menerus menangis, menangis kencang, melengking'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Pola Nafas</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="pola_nafas_nilai"
                                                :radios="[
                                                    'pola_nafas_nilai1' => ['value' => '0', 'label' => 'Rileks, nafas reguler'],
                                                    'pola_nafas_nilai2' => ['value' => '1', 'label' => 'Pola nafas berubah : tidak teratur, lebih cepat dari biasanya, tersedak, menahan nafas'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Tangan</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="tangan_nilai"
                                                :radios="[
                                                    'tangan_nilai1' => ['value' => '0', 'label' => 'Rileks, otot tangan tidak kaku'],
                                                    'tangan_nilai2' => ['value' => '1', 'label' => 'Kadang fleksi/ekstensi yang kaku, meluruskan tangan tapi dengan cepat melakukan fleksi/ekstensi yang kaku'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Kaki</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="kaki_nilai"
                                                :radios="[
                                                    'kaki_nilai1' => ['value' => '0', 'label' => 'Rileks, otot kaki tidak kaku, kadang bergerak tak beraturan'],
                                                    'kaki_nilai2' => ['value' => '1', 'label' => 'Fleksi/ekstensi yang kaku, meluruskan kaki tepi dengan cepat melakukan fleksi/ekstensi yang kaku'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Kesadaran</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="kesadaran_nilai"
                                                :radios="[
                                                    'kesadaran_nilai1' => ['value' => '0', 'label' => 'Tidur pulas atau cepat bangun, alergi dan tenang'],
                                                    'kesadaran_nilai2' => ['value' => '1', 'label' => 'Rewel, gelisah dan meronta-ronta'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Penanganan yang Diberikan</legend>
                                <label for="farmakologi" class="form-label">Penanganan Farmakologi</label>
                                <x-input id="farmakologi" name="farmakologi" />
                                <label for="non_farmakologi" class="form-label">Penanganan Non-Farmakologi</label>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="non_farmakologi"
                                        :checkboxes="[
                                            'non_farmakologiNeonatus1' => ['value' => 'Istirahat', 'label' => 'Istirahat'],
                                            'non_farmakologiNeonatus2' => ['value' => 'Alih Perhatian', 'label' => 'Alih Perhatian'],
                                            'non_farmakologiNeonatus3' => ['value' => 'Reposisi', 'label' => 'Reposisi'],
                                            'non_farmakologiNeonatus4' => ['value' => 'Distraksi Relaksasi', 'label' => 'Distraksi Relaksasi'],
                                            'non_farmakologiNeonatus5' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input id="non_farmakologi_lain_neonatus" name="non_farmakologi_lain" disabled class="br-full" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <br>
                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered" id="tbAsesmenNyeriNeonatus">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenNyeriNeonatus">
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
        const modalAsesmenNyeriNeonatus = $('#modalAsesmenNyeriNeonatus');
        const formAsesmenNyeriNeonatus = $('#formAsesmenNyeriNeonatus');
        const btnCreateAsesmenNyeriNeonatus = $('#btnCreateAsesmenNyeriNeonatus');
        const radioAsesmenNyeriNeonatus = formAsesmenNyeriNeonatus.find('input[type=radio]');
        const rangeSkalaInterpretasiNeonatus = formAsesmenNyeriNeonatus.find('input[name=total_nilai]');

        function showModalAsesmenNyeriNeonatus(no_rawat) {
            modalAsesmenNyeriNeonatus.modal('show');
            renderTbAsesmenNyeriNeonatus(no_rawat);
            resetFormAsesmenNyeriNeonatus(no_rawat);
        }

        function resetFormAsesmenNyeriNeonatus(no_rawat) {
            formAsesmenNyeriNeonatus.trigger('reset');
            formAsesmenNyeriNeonatus.find('input[name=skala]').val(0).trigger('change');
            formAsesmenNyeriNeonatus.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenNyeriNeonatus.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenNyeriNeonatus.find('input[name=non_farmakologi]').prop('checked', false).trigger('change');

            getRegPeriksa(no_rawat).done((response) => {
                rangeSkalaInterpretasiNeonatus.val(0).trigger('change');
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


                const tanggal = formAsesmenNyeriNeonatus.find('input[name=tanggal]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');
                tanggal.val(dateNow);

                formAsesmenNyeriNeonatus.find('input[name=no_rawat]').val(no_rawat);
                formAsesmenNyeriNeonatus.find('input[name=no_rkm_medis]').val(pasien.no_rkm_medis);
                formAsesmenNyeriNeonatus.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formAsesmenNyeriNeonatus.find('input[name=keluarga]').val(response.p_jawab)
                formAsesmenNyeriNeonatus.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formAsesmenNyeriNeonatus.find('input[name=kamar]').val(kamar.split(',').length >= 1 ? kamar.split(',')[0] : kamar);
                formAsesmenNyeriNeonatus.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formAsesmenNyeriNeonatus.find('input[name=diagnosa]').val(kamar.split(',').length >= 1 ? kamar.split(',')[1] : '-');
                formAsesmenNyeriNeonatus.find('input[name=dokter]').val(dokter.nm_dokter);
            })
        }

        btnCreateAsesmenNyeriNeonatus.on('click', () => {
            const data = getDataForm('#formAsesmenNyeriNeonatus', ['input']);
            const wajahId = formAsesmenNyeriNeonatus.find('input[name=ekspresi_wajah_nilai]:checked').attr('id');
            const wajahLabel = formAsesmenNyeriNeonatus.find(`label[for=${wajahId}]`).html();
            const kakiId = formAsesmenNyeriNeonatus.find('input[name=kaki_nilai]:checked').attr('id');
            const kakiLabel = formAsesmenNyeriNeonatus.find(`label[for=${kakiId}]`).html();
            const tangisanId = formAsesmenNyeriNeonatus.find('input[name=tangisan_nilai]:checked').attr('id');
            const tangisanLabel = formAsesmenNyeriNeonatus.find(`label[for=${tangisanId}]`).html();
            const polaNafasId = formAsesmenNyeriNeonatus.find('input[name=pola_nafas_nilai]:checked').attr('id');
            const polaNafasLabel = formAsesmenNyeriNeonatus.find(`label[for=${polaNafasId}]`).html();
            const tanganId = formAsesmenNyeriNeonatus.find('input[name=tangan_nilai]:checked').attr('id');
            const tanganLabel = formAsesmenNyeriNeonatus.find(`label[for=${tanganId}]`).html();
            const kesadaranId = formAsesmenNyeriNeonatus.find('input[name=kesadaran_nilai]:checked').attr('id');
            const kesadaranLabel = formAsesmenNyeriNeonatus.find(`label[for=${kesadaranId}]`).html();
            const nonFarmakologi = data['non_farmakologi'] ? data['non_farmakologi'].map((item) => {
                return item;
            }).join(';') : '';

            data['ekspresi_wajah_ket'] = wajahLabel;
            data['kaki_ket'] = kakiLabel;
            data['tangan_ket'] = tanganLabel;
            data['tangisan_ket'] = tangisanLabel;
            data['kesadaran_ket'] = kesadaranLabel;
            data['pola_nafas_ket'] = polaNafasLabel;
            data['keterangan'] = formAsesmenNyeriNeonatus.find('input[name=keterangan]').val()
            data['non_farmakologi'] = nonFarmakologi;

            $.post(`${url}/asesmen-nyeri-neonatus`, data).done((response) => {
                alertSuccessAjax('Data asesmen nyeri batita berhasil disimpan')
                renderTbAsesmenNyeriNeonatus(data.no_rawat)
                resetFormAsesmenNyeriNeonatus(data.no_rawat)
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
                            formAsesmenNyeriDewasa.find(`input[name=${field}]`).addClass('is-invalid');
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

        const totalNilai = formAsesmenNyeriNeonatus.find('input[name=total_nilai]');
        const keteranganNilai = formAsesmenNyeriNeonatus.find('input[name=keterangan]');
        radioAsesmenNyeriNeonatus.on('change', (e) => {
            let total = 0
            formAsesmenNyeriNeonatus.find('input[type=radio]:checked').each((i, item) => {
                total += Number($(item).val());
            })

            totalNilai.val(total)
            if (total > 3) {
                keteranganNilai.val('Terdapat Nyeri pada Bayi').addClass('is-invalid text-danger')
                totalNilai.addClass('is-invalid text-danger')
            } else {
                keteranganNilai.val('Tidak Ada Tanda Nyeri').removeClass('is-invalid text-danger')
                totalNilai.removeClass('is-invalid text-danger')
            }

        })

        const checkFarmakologiLainNeonatus = formAsesmenNyeriNeonatus.find('#non_farmakologiNeonatus5');
        checkFarmakologiLainNeonatus.on('change', (e) => {
            const element = $(e.target);
            const status = element.prop('checked');
            const input = formAsesmenNyeriNeonatus.find('#non_farmakologi_lain_neonatus');
            input.prop('disabled', !status).val();
        })


        function setSkalaInterpretasiNeonatus(value) {
            rangeSkalaInterpretasiNeonatus.val(value).trigger('change');
        }

        rangeSkalaInterpretasiNeonatus.on('change', (e) => {
            const value = rangeSkalaInterpretasiNeonatus.val();
            const image = formAsesmenNyeriNeonatus.find('#imageInterpretasiNyeri')
            const keterangan = formAsesmenNyeriNeonatus.find('#textInterpretasiNyeri');
            let src = '';
            let teks = '';
            if (value >= 1 && value <= 3) {
                resource = "{{ asset('/img/skala_1-3.png') }}"
                teks = 'Nyeri Ringan'
            } else if (value >= 4 && value <= 5) {
                resource = "{{ asset('/img/skala_4-5.png') }}"
                teks = 'Nyeri Sedang'
            } else if (value == 6) {
                resource = "{{ asset('/img/skala_6.png') }}"
                teks = 'Nyeri Sedang'
            } else if (value >= 7 && value <= 9) {
                resource = "{{ asset('/img/skala_6-8-9.png') }}"
                teks = 'Nyeri Berat'
            } else if (value == 10) {
                resource = "{{ asset('/img/skala_10.png') }}"
                teks = 'Nyeri Berat'
            } else {
                resource = "{{ asset('/img/skala_1.png') }}"
                teks = 'Rileks/Nyaman'
            }
            image.attr('src', resource);
            keterangan.html(teks).removeClass('d-none');
        })

        function renderTbAsesmenNyeriNeonatus(no_rawat) {
            $.get(`${url}/asesmen-nyeri-neonatus`, {
                no_rawat: no_rawat
            }).done((response) => {
                const table = $('#tbAsesmenNyeriNeonatus').find('tbody');
                table.empty();

                if (response.length == 0) {
                    return false;
                }

                const barisData = [{
                        label: "Tanggal",
                        key: "tanggal",
                        key_lain: ""
                    },
                    {
                        label: "Ekspresi Wajah",
                        key: "ekspresi_wajah_nilai",
                        keterangan: "ekspresi_wajah_ket"
                    },

                    {
                        label: "Tangisan",
                        key: "tangisan_nilai",
                        keterangan: "tangisan_ket"
                    },
                    {
                        label: "Pola Nafas",
                        key: "pola_nafas_nilai",
                        keterangan: "pola_nafas_ket"
                    },
                    {
                        label: "Tangan",
                        key: "tangan_nilai",
                        keterangan: "tangan_ket"
                    },
                    {
                        label: "Kaki",
                        key: "kaki_nilai",
                        keterangan: "kaki_ket"
                    },
                    {
                        label: "Kesadaran",
                        key: "kesadaran_nilai",
                        keterangan: "kesadaran_ket"
                    },

                    {
                        label: "Nilai & Interpretasi",
                        key: "total_nilai",
                    },
                    {
                        label: "Penanganan",
                        key: "penanganan",
                        keterangan: "non_farmakologi",
                        keterangan_lain: "non_farmakologi_lain"
                    },
                    {
                        label: "Petugas",
                        key: "petugas"
                    },
                    {
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
                table.append(headerRow);

                barisData.forEach(item => {
                    const baris = $("<tr></tr>");
                    baris.append($(`<th width="15%"></th>`).text(item.label));
                    response.forEach(objek => {
                        const selData = $("<td></td>");
                        let values = [];
                        if (item.key == 'total_nilai') {
                            const value = objek[item.key];
                            let className = "";
                            if (value > 3) {
                                className = "text-danger";
                            }
                            values.push(`<span class="${className}">${new String(objek[item.key])} : ${objek.keterangan_nilai}</span>`)
                        } else if (item.key === 'tanggal') {
                            const value = objek[item.key];
                            values.push(`${formatTanggal(value)}`);
                        } else if (item.key == 'petugas') {
                            const value = objek[item.key];
                            values.push(value.nama);
                        } else if (item.key == 'penanganan') {
                            const value = objek['farmakologi'];
                            values.push(`<strong>Farmakologi : </strong> <br/>${value}`);
                            if (objek['non_farmakologi']) {
                                const nonFarmakologi = objek['non_farmakologi'].split(';').map((vals) => {
                                    return `<li>${vals} ${vals === 'Lainnya' && objek['non_farmakologi_lain'] ? `: ${objek['non_farmakologi_lain']}` : ''}</li>`;
                                });
                                values.push(`<strong><br/>Non Farmakologi : </strong>`);
                                values.push(`<ul class="ms-0">${nonFarmakologi.join('')}</ul>`);
                            }
                        } else if (item.key == 'action') {
                            const user = "{{ session()->get('pegawai')->nik }}";
                            const content = `<button type="button" class="btn btn-sm btn-danger" onclick="deleteAsesmenNyeriNeonatus('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-trash me-1"></i> Hapus</button>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="editAsesmenNyeriNeonatus('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-pencil me-1"></i> Edit</button>`
                            const action = user === objek['petugas']['nama'] ? content : '';
                            values.push(action);
                        } else {
                            values.push(new String(objek[item.key]))
                            values.push(` - ${objek[item.keterangan]}`)
                        }
                        values = [...new Set(values)];
                        let value = values.filter(v => v).join('');
                        // // Gabungkan baris setelah "Lainnya"
                        value = value.replace(/Lainnya<br\/>(.*)/, 'Lainnya : $1');
                        selData.html(value);
                        baris.append(selData);
                    });
                    table.append(baris);
                });
            })

        }

        function deleteAsesmenNyeriNeonatus(no_rawat, tanggal) {
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
                    $.post(`${url}/asesmen-nyeri-neonatus/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal,
                    }).done((response) => {
                        alertSuccessAjax('Data asesmen nyeri neonatus berhasil dihapus')
                        renderTbAsesmenNyeriNeonatus(no_rawat)
                    })
                }
            })

        }

        function editAsesmenNyeriNeonatus(no_rawat, tanggal) {
            $.get(`${url}/asesmen-nyeri-neonatus/first`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                formAsesmenNyeriNeonatus.find(`input[name=ekspresi_wajah_nilai][value=${response.ekspresi_wajah_nilai}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriNeonatus.find(`input[name=kaki_nilai][value=${response.kaki_nilai}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriNeonatus.find(`input[name=tangan_nilai][value=${response.tangan_nilai}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriNeonatus.find(`input[name=tangisan_nilai][value=${response.tangisan_nilai}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriNeonatus.find(`input[name=pola_nafas_nilai][value=${response.pola_nafas_nilai}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriNeonatus.find(`input[name=kesadaran_nilai][value=${response.kesadaran_nilai }]`).prop('checked', true).trigger('change');
                const tanggal = splitTanggal(response.tanggal.split(' ')[0]);
                const jam = response.tanggal.split(' ')[1];
                formAsesmenNyeriNeonatus.find(`input[name=tanggal]`).val(`${tanggal} ${jam}`);
                formAsesmenNyeriNeonatus.find(`input[name=farmakologi]`).val(response.farmakologi);

                const penanganan = response.non_farmakologi ? response.non_farmakologi.split(';') : [];
                penanganan.forEach((item) => {
                    formAsesmenNyeriNeonatus.find(`input[name=non_farmakologi][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        formAsesmenNyeriNeonatus.find(`input[name=non_farmakologi_lain]`).val(response.non_farmakologi_lain);
                    }
                })

            })
        }
    </script>
@endpush
