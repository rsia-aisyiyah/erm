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
                                                name="lokasi_wajah"
                                                :radios="[
                                                    'lokasi_wajah1' => ['value' => '0', 'label' => 'Tersenyum / tidak ada ekspresi khusus'],
                                                    'lokasi_wajah2' => ['value' => '1', 'label' => 'Terkadang meringis / menarik diri'],
                                                    'lokasi_wajah3' => ['value' => '2', 'label' => 'Sering menggetarkan dagu dan mengatukan rahang'],
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
                                                name="lokasi_kaki"
                                                :radios="[
                                                    'lokasi_kaki1' => ['value' => '0', 'label' => 'Gerakan normal / relaksasi'],
                                                    'lokasi_kaki2' => ['value' => '1', 'label' => 'Tidak tenang / tegang'],
                                                    'lokasi_kaki3' => ['value' => '2', 'label' => 'Kaki dibuat menendang / menarik diri'],
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
                                                name="lokasi_menangis"
                                                :radios="[
                                                    'lokasi_menangis1' => ['value' => '0', 'label' => 'Tidak menangis (bangun / tidur)'],
                                                    'lokasi_menangis2' => ['value' => '1', 'label' => 'Mengerang, merengek - rengek'],
                                                    'lokasi_menangis3' => ['value' => '2', 'label' => 'Menangis terus menerus, teriak, menjerit'],
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
                                                name="lokasi_bersuara"
                                                :radios="[
                                                    'lokasi_bersuara1' => ['value' => '0', 'label' => 'Bersuara, normal, tenang'],
                                                    'lokasi_bersuara2' => ['value' => '1', 'label' => 'Tenang bila dipeluk, digendong, atau diajak bicara'],
                                                    'lokasi_bersuara3' => ['value' => '2', 'label' => 'Sulit untuk menenangkan'],
                                                ]" />
                                        </x-input-group>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <fieldset class="border p-2">
                                <legend class="w-auto float-none" style="font-size: 13px">Penanganan yang Diberikan</legend>
                                <label for="penanganan_farmakologi" class="form-label">Penanganan Farmakologi</label>
                                <x-input id="penanganan_farmakologi" name="penanganan_farmakologi" />
                                <label for="penanganan_non_farmakologi" class="form-label">Penanganan Non-Farmakologi</label>
                                <x-input-group>
                                    <x-checkbox-group
                                        name="penanganan_non_farmakologi"
                                        :checkboxes="[
                                            'penanganan_non_farmakologi1' => ['value' => 'Istirahat', 'label' => 'Istirahat'],
                                            'penanganan_non_farmakologi2' => ['value' => 'Alih Perhatian', 'label' => 'Alih Perhatian'],
                                            'penanganan_non_farmakologi3' => ['value' => 'Reposisi', 'label' => 'Reposisi'],
                                            'penanganan_non_farmakologi4' => ['value' => 'Distraksi Relaksasi', 'label' => 'Distraksi Relaksasi'],
                                            'penanganan_non_farmakologi5' => ['value' => 'Lainnya', 'label' => 'Lainnya'],
                                        ]" />
                                    <x-input id="penanganan_non_farmakologi_lain" name="penanganan_non_farmakologi_lain" disabled class="br-full" />
                                </x-input-group>
                            </fieldset>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenNyeriDewasa">
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

        function showModalAsesmenNyeriBatita(no_rawat) {
            modalAsesmenNyeriBatita.modal('show');
            resetFormAsesmenNyeriBatita(no_rawat);
        }

        function resetFormAsesmenNyeriBatita(no_rawat) {
            formAsesmenNyeriBatita.trigger('reset');
            formAsesmenNyeriBatita.find('input[name=skala]').val(0).trigger('change');
            formAsesmenNyeriBatita.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenNyeriBatita.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenNyeriBatita.find('input[name=penanganan_non_farmakologi]').prop('checked', false).trigger('change');

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
    </script>
@endpush
