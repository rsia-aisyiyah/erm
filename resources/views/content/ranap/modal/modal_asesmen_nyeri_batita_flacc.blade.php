<div class="modal fade" id="modalAsesmenNyeriBatita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>ASESMEN NYERI ANAK 1 BULAN - 3 TAHUN</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsesmenNyeriBatita">
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

                    <div class="row gy-2 sectionFormNyeriBatita">
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
                                <legend class="w-auto float-none" style="font-size: 13px">Wajah (Face)</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="wajah"
                                                :radios="[
                                                    'wajah1' => ['value' => '0', 'label' => 'Tersenyum / tidak ada ekspresi khusus'],
                                                    'wajah2' => ['value' => '1', 'label' => 'Terkadang meringis / menarik diri'],
                                                    'wajah3' => ['value' => '2', 'label' => 'Sering menggetarkan dagu dan mengatukan rahang'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Kaki (Legs)</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="kaki"
                                                :radios="[
                                                    'kaki1' => ['value' => '0', 'label' => 'Gerakan normal / relaksasi'],
                                                    'kaki2' => ['value' => '1', 'label' => 'Tidak tenang / tegang'],
                                                    'kaki3' => ['value' => '2', 'label' => 'Kaki dibuat menendang / menarik diri'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Aktivitas (Activity)</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="lokasi_aktivitas"
                                                :radios="[
                                                    'lokasi_aktivitas1' => ['value' => '0', 'label' => 'Tidur posisi normal, mudah bergerak'],
                                                    'lokasi_aktivitas2' => ['value' => '1', 'label' => 'Gerakkan menggeliat, berguling, kaku'],
                                                    'lokasi_aktivitas3' => ['value' => '2', 'label' => 'Melengkungkan punggung/ kaku/ menghentak'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Menangis (Cry)</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="menangis"
                                                :radios="[
                                                    'menangis1' => ['value' => '0', 'label' => 'Tidak menangis (bangun / tidur)'],
                                                    'menangis2' => ['value' => '1', 'label' => 'Mengerang, merengek - rengek'],
                                                    'menangis3' => ['value' => '2', 'label' => 'Menangis terus menerus, teriak, menjerit'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Bersuara (Consolability)</legend>
                                <div class="row">
                                    <div class="col-11">
                                        <x-input-group>
                                            <x-radio-group
                                                name="bersuara"
                                                :radios="[
                                                    'bersuara1' => ['value' => '0', 'label' => 'Bersuara, normal, tenang'],
                                                    'bersuara2' => ['value' => '1', 'label' => 'Tenang bila dipeluk, digendong, atau diajak bicara'],
                                                    'bersuara3' => ['value' => '2', 'label' => 'Sulit untuk menenangkan'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Penanganan yang Diberikan</legend>
                                <label for="farmakologi" class="form-label">Penanganan Farmakologi</label>
                                <x-input id="farmakologi" name="farmakologi" />
                                <label for="non_farmakologi" class="form-label">Penanganan Non-Farmakologi</label>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="non_farmakologi"
                                        :checkboxes="[
                                            'non_farmakologi1' => ['value' => 'Istirahat', 'label' => 'Istirahat'],
                                            'non_farmakologi2' => ['value' => 'Alih Perhatian', 'label' => 'Alih Perhatian'],
                                            'non_farmakologi3' => ['value' => 'Reposisi', 'label' => 'Reposisi'],
                                            'non_farmakologi4' => ['value' => 'Distraksi Relaksasi', 'label' => 'Distraksi Relaksasi'],
                                            'non_farmakologi5' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input id="non_farmakologi_lain" name="non_farmakologi_lain" disabled class="br-full" />
                                </x-input-group>
                            </fieldset>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <img src="{{ asset('/img/skala_nyeri_wong_baker_color.png') }}" alt="" class="mx-auto d-block" style="width:100%;height:auto" />
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <fieldset class="border p-2">
                                        <legend class="w-auto float-none" style="font-size: 13px">Skala Nyeri dan Interpretasi (S)</legend>
                                        <input type="range" class="form-range" min="0" max="10" step="1" id="total_skor" name="total_skor">
                                        <img src="" alt="" id="imageInterpretasiNyeri" class="mx-auto d-block" style="width:80px;height:auto">
                                        <h6 class="text-center d-none" id="textInterpretasiNyeri"></h6>
                                    </fieldset>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered" id="tbAsesmenNyeriBatita">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenNyeriBatita">
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
        const modalAsesmenNyeriBatita = $('#modalAsesmenNyeriBatita');
        const formAsesmenNyeriBatita = $('#formAsesmenNyeriBatita');
        const btnCreateAsesmenNyeriBatita = $('#btnCreateAsesmenNyeriBatita');
        const radioAsesmenNyeriBatita = formAsesmenNyeriBatita.find('input[type=radio]');
        const rangeSkalaInterpretasiBatita = formAsesmenNyeriBatita.find('input[name=total_skor]');

        function showModalAsesmenNyeriBatita(no_rawat) {
            modalAsesmenNyeriBatita.modal('show');
            renderTbAsesmenNyeriBatita(no_rawat);
            resetFormAsesmenNyeriBatita(no_rawat);
        }

        function resetFormAsesmenNyeriBatita(no_rawat) {
            formAsesmenNyeriBatita.trigger('reset');
            formAsesmenNyeriBatita.find('input[name=skala]').val(0).trigger('change');
            formAsesmenNyeriBatita.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenNyeriBatita.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenNyeriBatita.find('input[name=non_farmakologi]').prop('checked', false).trigger('change');

            getRegPeriksa(no_rawat).done((response) => {
                rangeSkalaInterpretasiBatita.val(0).trigger('change');
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


                const tanggal = formAsesmenNyeriBatita.find('input[name=tanggal]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');
                tanggal.val(dateNow);

                formAsesmenNyeriBatita.find('input[name=no_rawat]').val(no_rawat);
                formAsesmenNyeriBatita.find('input[name=no_rkm_medis]').val(pasien.no_rkm_medis);
                formAsesmenNyeriBatita.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formAsesmenNyeriBatita.find('input[name=keluarga]').val(response.p_jawab)
                formAsesmenNyeriBatita.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formAsesmenNyeriBatita.find('input[name=kamar]').val(kamar.split(',').length >= 1 ? kamar.split(',')[0] : kamar);
                formAsesmenNyeriBatita.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formAsesmenNyeriBatita.find('input[name=diagnosa]').val(kamar.split(',').length >= 1 ? kamar.split(',')[1] : '-');
                formAsesmenNyeriBatita.find('input[name=dokter]').val(dokter.nm_dokter);
            })
        }

        btnCreateAsesmenNyeriBatita.on('click', () => {
            const data = getDataForm('#formAsesmenNyeriBatita', ['input']);
            const wajahId = formAsesmenNyeriBatita.find('input[name=wajah]:checked').attr('id');
            const wajahLabel = formAsesmenNyeriBatita.find(`label[for=${wajahId}]`).html();
            const kakiId = formAsesmenNyeriBatita.find('input[name=kaki]:checked').attr('id');
            const kakiLabel = formAsesmenNyeriBatita.find(`label[for=${kakiId}]`).html();
            const aktivitasId = formAsesmenNyeriBatita.find('input[name=lokasi_aktivitas]:checked').attr('id');
            const aktivitasLabel = formAsesmenNyeriBatita.find(`label[for=${aktivitasId}]`).html();
            const menangisId = formAsesmenNyeriBatita.find('input[name=menangis]:checked').attr('id');
            const menangisLabel = formAsesmenNyeriBatita.find(`label[for=${menangisId}]`).html();
            const bersuaraId = formAsesmenNyeriBatita.find('input[name=bersuara]:checked').attr('id');
            const bersuaraLabel = formAsesmenNyeriBatita.find(`label[for=${bersuaraId}]`).html();
            const nonFarmakologi = data['non_farmakologi'] ? data['non_farmakologi'].map((item) => {
                return item;
            }).join(';') : '';

            data['wajah_ket'] = wajahLabel;
            data['kaki_ket'] = kakiLabel;
            data['aktivitas_ket'] = aktivitasLabel;
            data['aktivitas'] = data['lokasi_aktivitas']
            data['menangis_ket'] = menangisLabel;
            data['bersuara_ket'] = bersuaraLabel;
            data['interpretasi'] = formAsesmenNyeriBatita.find('#textInterpretasiNyeri').html()
            data['non_farmakologi'] = nonFarmakologi;

            $.post(`${url}/asesmen-nyeri-batita`, data).done((response) => {
                alertSuccessAjax('Data asesmen nyeri batita berhasil disimpan')
                renderTbAsesmenNyeriBatita(data.no_rawat)
                resetFormAsesmenNyeriBatita(data.no_rawat)
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

        radioAsesmenNyeriBatita.on('change', (e) => {
            let total = 0
            formAsesmenNyeriBatita.find('input[type=radio]:checked').each((i, item) => {
                total += Number($(item).val());

            })
            setSkalaInterpretasiBatita(total)

        })

        const checkFarmakologiLain = formAsesmenNyeriBatita.find('#non_farmakologi5');
        checkFarmakologiLain.on('change', (e) => {
            const element = $(e.target);
            const status = element.prop('checked');
            const input = formAsesmenNyeriBatita.find('input[name=non_farmakologi_lain]');
            input.prop('disabled', !status).val();
        })


        function setSkalaInterpretasiBatita(value) {
            rangeSkalaInterpretasiBatita.val(value).trigger('change');
        }

        rangeSkalaInterpretasiBatita.on('change', (e) => {
            const value = rangeSkalaInterpretasiBatita.val();
            const image = formAsesmenNyeriBatita.find('#imageInterpretasiNyeri')
            const keterangan = formAsesmenNyeriBatita.find('#textInterpretasiNyeri');
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

        function renderTbAsesmenNyeriBatita(no_rawat) {
            $.get(`${url}/asesmen-nyeri-batita`, {
                no_rawat: no_rawat
            }).done((response) => {
                const table = $('#tbAsesmenNyeriBatita').find('tbody');
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
                        label: "Wajah (Face)",
                        key: "wajah",
                        keterangan: "wajah_ket"
                    },
                    {
                        label: "Kaki (Leg)",
                        key: "kaki",
                        keterangan: "kaki_ket"
                    },
                    {
                        label: "Aktivitas (Activity)",
                        key: "aktivitas",
                        keterangan: "aktivitas_ket"
                    },
                    {
                        label: "Menangis (Cry)",
                        key: "menangis",
                        keterangan: "menangis_ket"
                    },
                    {
                        label: "Bersuara (Consolability)",
                        key: "bersuara",
                        keterangan: "bersuara_ket"
                    },
                    {
                        label: "Total & Interpretasi",
                        key: "total_skor",
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
                        if (item.key == 'total_skor') {
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
                            values.push(`<img src="${resource}" class="position-relative" width="50px"><br/>`)
                            values.push(`${new String(objek[item.key])} : ${objek.interpretasi}`)
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
                            const content = `<button type="button" class="btn btn-sm btn-danger" onclick="deleteAsesmenNyeriBatita('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-trash me-1"></i> Hapus</button>
                                            <button type="button" class="btn btn-sm btn-primary" onclick="editAsesmenNyeriBatita('${objek.no_rawat}', '${objek.tanggal}')"><i class="bi bi-pencil me-1"></i> Edit</button>`
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

        function deleteAsesmenNyeriBatita(no_rawat, tanggal) {
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
                    $.post(`${url}/asesmen-nyeri-batita/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal,
                    }).done((response) => {
                        alertSuccessAjax('Data asesmen nyeri batita berhasil dihapus')
                        renderTbAsesmenNyeriBatita(no_rawat)
                    })
                }
            })

        }

        function editAsesmenNyeriBatita(no_rawat, tanggal) {
            $.get(`${url}/asesmen-nyeri-batita/first`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                formAsesmenNyeriBatita.find(`input[name=wajah][value=${response.wajah}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriBatita.find(`input[name=kaki][value=${response.kaki}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriBatita.find(`input[name=lokasi_aktivitas][value=${response.aktivitas}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriBatita.find(`input[name=menangis][value=${response.menangis}]`).prop('checked', true).trigger('change');
                formAsesmenNyeriBatita.find(`input[name=bersuara][value=${response.bersuara}]`).prop('checked', true).trigger('change');
                const tanggal = splitTanggal(response.tanggal.split(' ')[0]);
                const jam = response.tanggal.split(' ')[1];
                formAsesmenNyeriBatita.find(`input[name=tanggal]`).val(`${tanggal} ${jam}`);
                formAsesmenNyeriBatita.find(`input[name=farmakologi]`).val(response.farmakologi);

                const penanganan = response.non_farmakologi ? response.non_farmakologi.split(';') : [];
                penanganan.forEach((item) => {
                    formAsesmenNyeriBatita.find(`input[name=non_farmakologi][value="${item}"]`)
                        .prop('checked', true)
                        .trigger('change');
                    if (item === 'Lainnya') {
                        formAsesmenNyeriBatita.find(`input[name=non_farmakologi_lain]`).val(response.non_farmakologi_lain);
                    }
                })

            })
        }
    </script>
@endpush
