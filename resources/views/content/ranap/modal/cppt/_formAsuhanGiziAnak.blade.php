<div class="p-3">
    <h6 class="text-center">FORM ASUHAN GIZI ANAK</h6>
    <form action="" id="formAsuhanGiziAnak">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        @csrf
                        <label for="nip" class="form-label">Petugas</label>
                        <select name="nip" id="nip" data-dropdown-parent="#formAsuhanGiziAnak" class="form-select"
                                style="width:100%"></select>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <x-input id="tanggal" name="tanggal" class="datetimepicker" value="{{ date('d-m-Y H:i:s') }}"/>
                    </div>
                </div>
                <div class="separator m-2">A. Asesmen Gizi</div>
                <label for=""><strong>1. Data Antropometri</strong> <a href="javascript:void(0)" onclick=""
                                                                       id="searchAntropometriAnak"><i
                                class="fa fa-search"></i></a></label>
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_bb">Berat Badan</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_bb" name="antropometri_bb" style="font-size: 11px" value="0"/>
                            <span class="input-group-text"><label for="">kg</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_tb">Tinggi/Panjang Badan</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_tb" name="antropometri_tb" style="font-size: 11px" value="0"/>
                            <span class="input-group-text"><label for="">cm</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_imt">IMT</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_imt" name="antropometri_imt" style="font-size: 11px" value="0"/>
                            <span class="input-group-text"><label for="">kg/m<sup>2</sup></label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_zscore_bbperu">ZScore BB/U</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_zscore_bbperu" name="antropometri_zscore_bbperu"
                                     style="font-size: 11px" value="0"/>
                                <span class="input-group-text"><label for="">SD</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_zscore_bbpertb">ZScore BB/TB</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_zscore_bbpertb" name="antropometri_zscore_bbpertb"
                                     style="font-size: 11px" value="0"/>
                                <span class="input-group-text"><label for="">SD</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_zscore_imtperu">ZScore IMT/U</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_zscore_imtperu" name="antropometri_zscore_imtperu"
                                     style="font-size: 11px" value="0"/>
                                <span class="input-group-text"><label for="">SD</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_bbideal">BB Ideal</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_bbideal" name="antropometri_bbideal" style="font-size: 11px"
                                     value="0"/>
                                <span class="input-group-text"><label for="">KG</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_status_gizi">Status Gizi</label>
                        <x-input id="antropometri_status_gizi" name="antropometri_status_gizi" style="font-size: 11px"/>
                    </div>
                </div>
                <label for=""><strong>2. Biokimia Terkait Gizi</strong>
                    <a href="javascript:void(0)" onclick="" id="searchBiometriAnak"><i class="fa fa-search"></i></a>
                </label>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="biokimia">Biokimia</label>
                        <x-textarea id="biokimia" name="biokimia">-</x-textarea>
                    </div>
                </div>
                <label for=""><strong>3. Data Fisik/Klinis</strong></label>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_td">Tekanan Darah</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_td" name="fisik_klinis_td" style="font-size:11px"
                                     value=0></x-input>
                            <x-input-group-text for="fisik_klinis_td" label="mmHG"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_nadi">Nadi</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_nadi" name="fisik_klinis_nadi" style="font-size:11px"
                                     value=0></x-input>
                            <x-input-group-text for="fisik_klinis_nadi" label="x/menit"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_suhu">Suhu</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_suhu" name="fisik_klinis_suhu" style="font-size:11px"
                                     value=0></x-input>
                            <x-input-group-text for="fisik_klinis_suhu" label="°C"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_pernapasan">Pernapasan</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_pernapasan" name="fisik_klinis_pernapasan" style="font-size:11px"
                                     value=0></x-input>
                            <x-input-group-text for="fisik_klinis_pernapasan" label="x/menit"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_kesadaran">Kesadaran</label>
                        <select name="fisik_klinis_kesadaran" id="fisik_klinis_kesadaran" class="form-select">
                            <option value="Compos Mentis">Compos Mentis</option>
                            <option value="Apatis">Apatis</option>
                            <option value="Somnolence">Somnolence</option>
                            <option value="Sopor">Sopor</option>
                            <option value="Coma">Coma</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_nafsu_makan">Nafsu Makan</label><br/>
                        <x-input-group>
                            <x-radio-group
                                    name="fisik_klinis_nafsu_makan"
                                    :radios="[
                                    'fisik_klinis_nafsu_makan1_anak' => ['value' => 'Baik', 'label' => 'Baik', 'checked' => true],
                                    'fisik_klinis_nafsu_makan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_hilang_lemak">Hilang Lemak Subkutan</label><br/>
                        <x-input-group>
                            <x-radio-group
                                    name="fisik_klinis_hilang_lemak"
                                    :radios="[
                                    'fisik_klinis_hilang_lemak1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_hilang_lemak2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_gangguan_telan">Gangguan Menelan</label><br/>
                        <x-input-group>
                            <x-radio-group
                                    name="fisik_klinis_gangguan_telan"
                                    :radios="[
                                    'fisik_klinis_gangguan_telan1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_gangguan_telan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_gangguan_kunyah">Gangguan Mengunyah</label><br/>
                        <x-input-group>
                            <x-radio-group
                                    name="fisik_klinis_gangguan_kunyah"
                                    :radios="[
                                    'fisik_klinis_gangguan_kunyah1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_gangguan_kunyah2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinisu_dem">Udem</label><br/>
                        <x-input-group>
                            <x-radio-group
                                    name="fisik_klinis_udem"
                                    :radios="[
                                    'fisik_klinis_udem1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_udem2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_diare">Diare</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="fisik_klinis_diare"
                                           :radios="[
                                    'fisik_klinis_diare1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_diare2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_konstipasi">Konstipasi</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_konstipasi"
                                           :radios="[
                                    'fisik_klinis_konstipasi1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_konstipasi2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_mual">Mual</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_mual"
                                           :radios="[
                                    'fisik_klinis_mual1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_mual2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                        <label for="fisik_klinis_muntah">Muntah</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_muntah"
                                           :radios="[
                                    'fisik_klinis_muntah1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'fisik_klinis_muntah2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                        </x-input-group>
                    </div>
                </div>
                <label for=""><strong>4. Data Riwayat Gizi</strong></label>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="riwayat_gizi_alergi_makanan">Alergi Makanan</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="riwayat_gizi_alergi_makanan"
                                           :radios="[
                                    'riwayat_gizi_alergi_makanan1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'riwayat_gizi_alergi_makanan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                            <x-input class="br-full" id="riwayat_gizi_keterangan_alergi"
                                     name="riwayat_gizi_keterangan_alergi" style="font-size: 11px"/>
                        </x-input-group>

                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="riwayat_gizi_ketidaksukaan_makanan">Ketidaksukaan Makanan</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="riwayat_gizi_ketidaksukaan_makanan"
                                           :radios="[
                                    'riwayat_gizi_ketidaksukaan_makanan1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'riwayat_gizi_ketidaksukaan_makanan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                            <x-input class="br-full" id="riwayat_gizi_keterangan_ketidaksukaan_makanan"
                                     name="riwayat_gizi_keterangan_ketidaksukaan_makanan" style="font-size: 11px"/>
                        </x-input-group>

                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="riwayat_gizi_pantangan_makanan">Pantangan Makanan</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="riwayat_gizi_pantangan_makanan"
                                           :radios="[
                                    'riwayat_gizi_pantangan_makanan1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'riwayat_gizi_pantangan_makanan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                            <x-input class="br-full" id="riwayat_gizi_keterangan_pantangan_makanan"
                                     name="riwayat_gizi_keterangan_pantangan_makanan" style="font-size: 11px"/>
                        </x-input-group>

                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="riwayat_gizi_pola_makan">Pola Makan</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="riwayat_gizi_pola_makan"
                                           :radios="[
                                    'riwayat_gizi_pola_makan1_anak' => ['value' => 'Ada', 'label' => 'Ada', 'checked' => true],
                                    'riwayat_gizi_pola_makan2_anak' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]"/>
                            <x-input class="br-full" id="riwayat_gizi_keterangan_pola_makan"
                                     name="riwayat_gizi_keterangan_pola_makan" style="font-size: 11px"/>
                        </x-input-group>

                    </div>
                </div>
                <label for=""><strong>5. Data Riwayat Personal</strong></label>
                <div class="row">
                    <div class="col-lg">
                        <x-textarea name="riwayat_personal" id="riwayat_personal">-</x-textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="separator m-2">B. Diagnosis Gizi</div>
                    <div class="col-12">
                        <x-textarea name="diagnosis" id="diagnosis">-</x-textarea>
                    </div>
                    <div class="separator m-2">C. Intervensi Gizi</div>
                    <div class="col-12">
                        <div class="row">
                            <label for="intervensi_gizi_tujuan"><strong>1. Tujuan</strong></label>
                            <div class="col-12">
                                <x-textarea name="intervensi_gizi_tujuan" id="intervensi_gizi_tujuan">-</x-textarea>
                            </div>
                        </div>
                        <label for=""><strong>2. Interval</strong></label>
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for=""><strong>Perhitungan Kebutuhan Zat Gizi</strong></label><br>
                                <label for="intervensi_gizi_energi">Energi</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="intervensi_gizi_energi" name="intervensi_gizi_energi"
                                             style="font-size: 11px"/>
                                    <x-input-group-text for="intervensi_gizi_energi" label="Kkal"></x-input-group-text>
                                </x-input-group>
                                <label for="intervensi_gizi_protein">Protein</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="intervensi_gizi_protein" name="intervensi_gizi_protein"
                                             style="font-size: 11px"/>
                                    <x-input-group-text for="intervensi_gizi_proterin"
                                                        label="gram"></x-input-group-text>
                                </x-input-group>
                                <label for="intervensi_gizi_lemak">Lemak</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="intervensi_gizi_lemak" name="intervensi_gizi_lemak"
                                             style="font-size: 11px"/>
                                    <x-input-group-text for="intervensi_gizi_lemak" label="gram"></x-input-group-text>
                                </x-input-group>
                                <label for="intervensi_gizi_karbohidrat">Karbohidrat</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="intervensi_gizi_karbohidrat" name="intervensi_gizi_karbohidrat"
                                             style="font-size: 11px"/>
                                    <x-input-group-text for="intervensi_gizi_karbohidrat"
                                                        label="gram"></x-input-group-text>
                                </x-input-group>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <label for=""><strong>Pemberian Obat</strong></label><br>
                                <label for="intervensi_gizi_jenis_diet">Jenis Diet</label>
                                <x-input id="intervensi_gizi_jenis_diet" name="intervensi_gizi_jenis_diet"
                                         style="font-size: 11px"/>
                                <label for="intervensi_gizi_bentuk_makanan">Bentuk Makanan</label>
                                <x-input-group class="input-group-sm">
                                    <x-radio-group name="intervensi_gizi_bentuk_makanan"
                                                   :radios="[
                                            'intervensi_gizi_bentuk_makanan1_anak' => ['value' => 'Biasa', 'label' => 'Biasa', 'checked' => true],
                                            'intervensi_gizi_bentuk_makanan2_anak' => ['value' => 'Lunak', 'label' => 'Lunak'],
                                            'intervensi_gizi_bentuk_makanan3_anak' => ['value' => 'Cair', 'label' => 'Cair'],
                                        ]"/>
                                </x-input-group>
                                <label for="intervensi_gizi_rute_pemberian">Rute Pemberian</label>
                                <x-input-group class="input-group-sm">
                                    <x-radio-group name="intervensi_gizi_rute_pemberian"
                                                   :radios="[
                                            'intervensi_gizi_rute_pemberian1_anak' => ['value' => 'Oral', 'label' => 'Oral', 'checked' => true],
                                            'intervensi_gizi_rute_pemberian2_anak' => ['value' => 'Enteral', 'label' => 'Enteral'],
                                            'intervensi_gizi_rute_pemberian3_anak' => ['value' => 'Parenteral', 'label' => 'Parenteral'],
                                        ]"/>
                                </x-input-group>
                                <label for="intervensi_gizi_frekuensi">Frekuensi</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="intervensi_gizi_frekuensi" name="intervensi_gizi_frekuensi"
                                             style="font-size: 11px"/>
                                    <x-input-group-text for="intervensi_gizi_frekuensi"
                                                        label="gram"></x-input-group-text>
                                </x-input-group>
                            </div>
                        </div>
                        <label for=""><strong>3. Konseling Gizi/Edukasi</strong></label>
                        <div class="row">
                            <div class="col-12">
                                <x-textarea name="intervensi_gizi_konseling" id="intervensi_gizi_konseling">-
                                </x-textarea>
                            </div>
                        </div>
                    </div>
                    <div class="separator m-2">D. Rencana Monitoring dan Evaluasi Gizi</div>
                    <div class="col-12">
                        <x-textarea name="monitoring_evaluasi" id="monitoring_evaluasi">-</x-textarea>
                        <button class="btn btn-primary btn-sm mt-3" type="button" id="btnSimpanAsuhanGiziAnak"
                                onclick="simpanAsuhanGiziAnak()">
                            <i class="bi bi-save"></i> Simpan Asuhan Gizi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@push('script')
    <script>
        const formAsuhanGiziAnak = $('#formAsuhanGiziAnak');
        const selectPetugasGiziAnak = formAsuhanGiziAnak.find('#nip');
        const bbGiziAnak = formAsuhanGiziAnak.find('#antropometri_bb');
        const tbGiziAnak = formAsuhanGiziAnak.find('#antropometri_tb');
        const btnSimpanAsuhanGiziAnak = formAsuhanGiziAnak.find('#btnSimpanAsuhanGiziAnak');
        const btnUbahAsuhanGiziAnak = formAsuhanGiziAnak.find('#btnUbahAsuhanGiziAnak');
        const imgGiziAnak = formAsuhanGiziAnak.find('#antropometri_imt');
        const searchAntropometriAnak = formAsuhanGiziAnak.find('#searchAntropometriAnak');
        const searchBiometriAnak = formAsuhanGiziAnak.find('#searchBiometriAnak');
        const biokimiaGiziAnak = formAsuhanGiziAnak.find('#biokimia');
        const optPetugasGiziAnak = new Option('{{ session()->get('pegawai')->nik }}', '{{ session()->get('pegawai')->nama }}', false, false);
        selectPetugasGiziAnak.append(optPetugasGiziAnak).trigger('change');

        const tabAsuhanGiziAnak = $('#tabAsuhanGiziAnak');


        tabAsuhanGiziAnak.on('click', function (e) {
            const target = e.target.dataset.bsTarget
            const tabFormAsuhanGiziAnak = $(target)
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();

            searchAntropometriAnak.attr('onclick', `getListCpptRanap('${no_rawat}', '#formAsuhanGiziAnak')`)
            searchBiometriAnak.attr('onclick', `getListBiokimia('${no_rawat}', '#formAsuhanGiziAnak')`)

            $.get(`${url}/ranap/gizi/asuhan/anak`, {
                no_rawat: no_rawat
            }).done((response) => {
                const isDataAvailable = Object.values(response).length

                if (isDataAvailable) {
                    setFormData(response)
                    btnSimpanAsuhanGiziAnak.html('<i class="bi bi-save"></i> Ubah Asuhan Gizi')
                } else {
                    btnSimpanAsuhanGiziAnak.html('<i class="bi bi-save"></i> Simpan Asuhan Gizi')
                }
            })

        })

        selectPetugasGiziAnak.select2({
            allowClear: false,
            delay: 0,
            scrollAfterSelect: false,
            initSelection: function (element, callback) {
            },
            ajax: {
                url: `${url}/petugas/cari`,
                dataType: 'json',
                data: (params) => {
                    return {
                        q: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.nama,
                                id: item.nip
                            }
                        })
                    };
                },
                cache: false
            }
        });

        bbGiziAnak.on('change', function () {
            const berat = bbGiziAnak.val();
            const tinggi = tbGiziAnak.val();
            const imt = countIMT(berat, tinggi);
            imgGiziAnak.val(imt.toFixed(2));
        })

        tbGiziAnak.on('change', function () {
            const berat = bbGiziAnak.val();
            const tinggi = tbGiziAnak.val();
            const imt = countIMT(berat, tinggi);
            imgGiziAnak.val(imt.toFixed(2));
        })

        function simpanAsuhanGiziAnak() {
            const data = getDataForm('#formAsuhanGiziAnak', ['input', 'textarea', 'select']);
            data['no_rawat'] = formInfoPasien.find('input[name="no_rawat"]').val();
            btnSimpanAsuhanGiziAnak.prop('disabled', true);


            $.post(`${url}/ranap/gizi/asuhan/anak`, data).done((response) => {
                alertSuccessAjax().then(() => {
                    btnSimpanAsuhanGiziAnak.prop('disabled', false);
                })
            }).fail((error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal !',
                    text: error.responseJSON.message,
                })
            })
        }

        // function setFormData(data) {
        //     for (let key in data) {
        //         if (data.hasOwnProperty(key)) {
        //             let fields = document.querySelectorAll(`[name="${key}"]`);
        //
        //             if (fields.length > 0) {
        //                 fields.forEach(field => {
        //                     if (field.type === 'checkbox' || field.type === 'radio') {
        //                         field.checked = data[key] == field.value;
        //                     } else {
        //                         field.value = data[key];
        //                     }
        //                 });
        //             }
        //         }
        //     }
        // }
    </script>
@endpush
