<div class="modal fade" id="modalCatatanEdukasiPasien" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true" style="background-color: rgb(0 0 0 / 49%)">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">Catatan Pelaksanaan Edukasi Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPasienCatatanEdukasi">
                    <div class="row gy-2">
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="no_rawat" label="No. Rawat"></x-input-group-text>
                                <x-input id="no_rawat" name="no_rawat" readonly/>
                            </x-input-group>

                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nm_pasien" label="Pasien"></x-input-group-text>
                                <x-input id="nm_pasien" name="nm_pasien" readonly/>
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tgl_lahir" label="Tgl. Lahir"></x-input-group-text>
                                <x-input id="tgl_lahir" name="tgl_lahir" readonly class="w-25"/>
                                <x-input id="umur" name="umur" readonly=""/>
                            </x-input-group>
                        </div>

                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="p_jawab" label="Keluarga"></x-input-group-text>
                                <x-input id="p_jawab" name="p_jawab" readonly/>
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="kamar" label="Kamar"></x-input-group-text>
                                <x-input id="kamar" name="kamar" readonly/>
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="diagnosa_awal" label="Diagnosa"></x-input-group-text>
                                <x-input id="diagnosa_awal" name="diagnosa_awal" readonly/>
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="dokter" label="Dokter"></x-input-group-text>
                                <x-input id="dokter" name="dokter" readonly/>
                            </x-input-group>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="lama" label="Lama"></x-input-group-text>
                                <x-input id="lama" name="lama" readonly/>
                            </x-input-group>
                        </div>

                    </div>
                </form>
                <hr/>
                <form id="formCatatanEdukasiPasien">
                    <div class="row gy-2">
                        <div class="col-lg-3 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="tanggal" label="Tanggal"></x-input-group-text>
                                <x-input id="tanggal" name="tanggal" class="datetimepicker"></x-input>
                            </x-input-group>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <x-input-group class="input-group-sm">
                                <x-input-group-text for="nip" label="Petugas"/>
                                <x-input id="nip" name="nip" readonly></x-input>
                                <x-input id="nama" name="nama" class="w-25" readonly></x-input>
                            </x-input-group>
                        </div>
                        <div class="col-12">
                            <label for="materi">Materi</label>
                            <x-input id="materi" name="materi"></x-input>
                        </div>
                        <div class="col-12">
                            <label for="metode"><strong>Metode</strong></label>
                            <x-input-group>
                                <x-radio-group name="metode"
                                               :radios="[
                                    'metode1' => ['value' => 'Diskusi', 'label' => 'Diskusi', 'checked' => true],
                                    'metode2' => ['value' => 'Simulasi (S)', 'label' => 'Simulasi (S)'],
                                    'metode3' => ['value' => 'Demonstrasi (Demo)', 'label' => 'Demonstrasi (Demo)'],
                                    'metode4' => ['value' => 'Ceramah', 'label' => 'Ceramah'],
                                    'metode5' => ['value' => 'Observasi (O)', 'label' => 'Observasi (O)'],
                                    'metode6' => ['value' => 'Praktek Langsung (PL)', 'label' => 'Praktek Langsung (PL)'],
                                ]"/>
                            </x-input-group>
                        </div>
                        <div class="col-12">
                            <label for="hambatan"><strong>Hambatan</strong></label>
                            <x-input-group>
                                <x-radio-group name="hambatan"
                                               :radios="[
                                    'hambatan1' => ['value' => 'Tidak Ada', 'label' => 'Tidak Ada', 'checked' => true],
                                    'hambatan2' => ['value' => 'Bahasa', 'label' => 'Bahasa'],
                                    'hambatan3' => ['value' => 'Kehilangan Harapan', 'label' => 'Kehilangan Harapan'],
                                    'hambatan4' => ['value' => 'Masalah Keuangan', 'label' => 'Masalah Keuangan'],
                                    'hambatan5' => ['value' => 'Kesalahan', 'label' => 'Kesalahan'],
                                    'hambatan6' => ['value' => 'Faktor Budaya', 'label' => 'Faktor Budaya'],
                                    'hambatan7' => ['value' => 'Kelemahan Sensori', 'label' => 'Kelemahan Sensori'],
                                    'hambatan8' => ['value' => 'Tidak Percaya Diri', 'label' => 'Tidak Percaya Diri'],
                                    'hambatan9' => ['value' => 'Menyangkal', 'label' => 'Menyangkal'],
                                    'hambatan10' => ['value' => 'Kecemasan/Ketakutan', 'label' => 'Kecemasan/Ketakutan'],
                                    'hambatan11' => ['value' => 'Kelemahan Kognitif', 'label' => 'Kelemahan Kognitif'],
                                    'hambatan12' => ['value' => 'Tidak Tertarik/Tidak Berminat', 'label' => 'Tidak Tertarik/Tidak Berminat'],
                                    'hambatan13' => ['value' => 'Lain-lain', 'label' => 'Lain-lain'],

                                    ]"/>
                                <x-input id="hambatan_lain" name="hambatan_lain" class="form-underline" disabled/>
                            </x-input-group>
                        </div>
                        <div class="col-12">
                            <label for="intervensi"><strong>Intervensi Mengatasi Hambatan</strong></label>
                            <x-input-group>
                                <x-radio-group name="intervensi"
                                               :radios="[
                                    'intervensi1' => ['value' => 'Tidak Ada', 'label' => 'Tidak Ada', 'checked' => true],
                                    'intervensi2' => ['value' => 'Menyediakan Penerjemah', 'label' => 'Menyediakan Penerjemah'],
                                    'intervensi3' => ['value' => 'Melakukan pendekatan secara budaya/agama', 'label' => 'Melakukan pendekatan secara budaya/agama'],
                                    'intervensi4' => ['value' => 'Mengulangi materi', 'label' => 'Mengulangi materi'],
                                    'intervensi5' => ['value' => 'Melibatkan keluarga terdekat', 'label' => 'Melibatkan keluarga terdekat'],
                                    'intervensi6' => ['value' => 'Melakukan pendekatan dengan cara memakai role model untuk perubahan perilaku', 'label' => 'Melakukan pendekatan dengan cara memakai role model untuk perubahan perilaku'],
                                    'intervensi7' => ['value' => 'Lain-lain', 'label' => 'Lain-lain'],
                                   ]"/>
                                <x-input id="intervensi_lain" name="intervensi_lain" class="form-underline" disabled/>
                            </x-input-group>
                        </div>
                        <div class="col">
                            <label for="evaluasi"><strong>Evaluasi</strong></label>
                            <x-input-group>
                                <x-radio-group name="evaluasi"
                                               :radios="[
                                    'evaluasi1' => ['value' => 'Tidak Mengerti', 'label' => 'Tidak Mengerti'],
                                    'evaluasi2' => ['value' => 'Mengerti, tidak mampu menjelaskan/melakukan', 'label' => 'Mengerti, tidak mampu menjelaskan/melakukan'],
                                    'evaluasi3' => ['value' => 'Mengerti, mampu menjelaskan/melakukan', 'label' => 'Mengerti, mampu menjelaskan/melakukan', 'checked' => true],
                                   ]"/>
                            </x-input-group>
                        </div>
                        @csrf
                    </div>
                </form>
                <hr>
                <div class="table-responsive" style="max-height: 180px;overflow: auto">
                    <table class="table table-striped table-hover table-bordered" id="tableCatatanEdukasiPasien">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Materi</th>
                            <th>Tanggal</th>
                            <th>Metode</th>
                            <th>Hambatan & Cara Mengatasi</th>
                            <th>Evaluasi</th>
                            <th>Keluarga</th>
                            <th>Edukator</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px"
                        onclick="simpanCatatanEdukasi()">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle"> </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const modalCatatanEdukasiPasien = $('#modalCatatanEdukasiPasien')
        const formCatatanEdukasiPasien = $('#formCatatanEdukasiPasien')
        const formPasienCatatanEdukasi = $('#formPasienCatatanEdukasi')
        const tableCatatanEdukasiPasien = $('#tableCatatanEdukasiPasien')

        const radioGroupHambatan = formCatatanEdukasiPasien.find('input[name="hambatan"]')
        const radioGroupIntervensi = formCatatanEdukasiPasien.find('input[name="intervensi"]')


        function catatanEdukasiPasien(no_rawat) {
            modalCatatanEdukasiPasien.modal('show')
            const nip = "{{session()->get('pegawai')->nik}}";
            const nm_petugas = "{{session()->get('pegawai')->nama}}";
            const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');


            formCatatanEdukasiPasien.find('input[name=nip]').val(nip)
            formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas)
            formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal)
            getRegPeriksa(no_rawat).done((response) => {
                const {pasien, dokter, kamar_inap} = response;
                const kamar = kamar_inap.filter((item) => item.stts_pulang !== 'Pindah Kamar');
                const bangsal = kamar.map((item) => {
                    return item.kamar.bangsal.nm_bangsal
                }).join('')
                const diagnosa = kamar_inap.map((item) => {
                    return item.diagnosa_awal
                }).join('')
                const lama = kamar_inap.map((item) => {
                    return item.lama
                }).join('')

                formPasienCatatanEdukasi.find('input[name=no_rawat]').val(no_rawat)
                formPasienCatatanEdukasi.find('input[name=nm_pasien]').val(pasien.nm_pasien)
                formPasienCatatanEdukasi.find('input[name=tgl_lahir]').val(formatTanggal(pasien.tgl_lahir))
                formPasienCatatanEdukasi.find('input[name=umur]').val(`${response.umurdaftar} ${response.sttsumur}`)
                formPasienCatatanEdukasi.find('input[name=p_jawab]').val(response.p_jawab)
                formPasienCatatanEdukasi.find('input[name=kamar]').val(bangsal)
                formPasienCatatanEdukasi.find('input[name=diagnosa_awal]').val(diagnosa)
                formPasienCatatanEdukasi.find('input[name=dokter]').val(dokter.nm_dokter)
                formPasienCatatanEdukasi.find('input[name=lama]').val(`${lama} Hari`)

                renderCatatanEdukasiPasien(no_rawat)

            })


        }

        function renderCatatanEdukasiPasien(no_rawat) {
            tableCatatanEdukasiPasien.find('tbody').empty();
            $.get(`${url}/catatan/pelaksanaan/edukasi/pasien`, {
                no_rawat: no_rawat
            }).done((response) => {
                if (response.length) {
                    const dataCatatan = response.map((item, index) => {
                        return `<tr>
                                <td>${index + 1}</td>
                                <td>${item.materi}</td>
                                <td>${item.tanggal}</td>
                                <td>${item.metode}</td>
                                <td>${item.hambatan_lain ? item.hambatan_lain : item.hambatan} &
                                    ${item.intervensi_lain ? item.intervensi_lain : item.intervensi}</td>
                                <td>${item.evaluasi}</td>
                                <td>${item.reg_periksa.p_jawab}</td>
                                <td>${item.petugas.nama}</td>
                                <td><button class="btn btn-danger btn-sm" onclick="deleteCatatanEdukasiPasien('${item.no_rawat}', '${item.tanggal}', '${item.nip}')"><i class="bi bi-trash"></i></button></td>
                    </tr>`
                    })
                    tableCatatanEdukasiPasien.find('tbody').append(dataCatatan);

                }

            })
        }

        radioGroupHambatan.on('change', function () {
            const radioHambatanLain = formCatatanEdukasiPasien.find('#hambatan13')
            const hambatanLain = formCatatanEdukasiPasien.find('input[name="hambatan_lain"]')

            if (radioHambatanLain.is(':checked')) {
                hambatanLain.removeAttr('disabled')
            } else {
                hambatanLain.attr('disabled', 'disabled')
                hambatanLain.val('-')
            }
        })

        radioGroupIntervensi.on('change', function () {
            const radioIntervensiLain = formCatatanEdukasiPasien.find('#intervensi7')
            const intervensiLain = formCatatanEdukasiPasien.find('input[name="intervensi_lain"]')

            if (radioIntervensiLain.is(':checked')) {
                intervensiLain.removeAttr('disabled')
            } else {
                intervensiLain.attr('disabled', 'disabled')
                intervensiLain.val('-')
            }
        })

        function simpanCatatanEdukasi() {
            const data = getDataForm('#formCatatanEdukasiPasien', ['input', 'select', 'textarea']);
            data['no_rawat'] = formPasienCatatanEdukasi.find('input[name=no_rawat]').val();
            data['hambatan_lain'] = data['hambatan'] === 'Lain-lain' ? data['hambatan_lain'] : '';
            data['intervensi_lain'] = data['intervensi'] === 'Lain-lain' ? data['intervensi_lain'] : '';

            const tanggal = data['tanggal'].split(' ');
            data['tanggal'] = `${splitTanggal(tanggal[0])} ${tanggal[1]}`

            $.post(`${url}/catatan/pelaksanaan/edukasi/pasien`, data).done((response) => {
                formCatatanEdukasiPasien.trigger('reset')
                alertSuccessAjax(response).then(() => {
                    renderCatatanEdukasiPasien(data['no_rawat'])
                    const nip = "{{session()->get('pegawai')->nik}}";
                    const nm_petugas = "{{session()->get('pegawai')->nama}}";
                    const tanggal = moment().format('DD-MM-YYYY HH:mm:ss');


                    formCatatanEdukasiPasien.find('input[name=nip]').val(nip)
                    formCatatanEdukasiPasien.find('input[name=nama]').val(nm_petugas)
                    formCatatanEdukasiPasien.find('input[name=tanggal]').val(tanggal)
                    formCatatanEdukasiPasien.find('#hambatan_lain').attr('disabled', 'disabled')
                    formCatatanEdukasiPasien.find('#intervensi_lain').attr('disabled', 'disabled')

                })
            }).fail((error) => {
                alertErrorAjax(error)
            })
        }

        function deleteCatatanEdukasiPasien(no_rawat, tanggal, nip) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data yang di hapus tidak bisa dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/catatan/pelaksanaan/edukasi/pasien/delete`, {
                        no_rawat: no_rawat,
                        tanggal: tanggal,
                        nip: nip,
                        _token: "{{ csrf_token() }}"
                    }).done((response) => {
                        alertSuccessAjax(response).then(() => {
                            renderCatatanEdukasiPasien(no_rawat)
                        })
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }
            })

        }
    </script>
@endpush
