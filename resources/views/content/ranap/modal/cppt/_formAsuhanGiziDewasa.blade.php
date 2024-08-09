<div class="p-3">
    <h6 class="text-center">FORM ASUHAN GIZI DEWASA</h6>
    <form action="" id ="formAsuhanGiziDewasa">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <x-input id="tanggal" name="tanggal" class="datetimepicker" value="{{ date('d-m-Y H:i:s') }}" />
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="petugas" class="form-label">Petugas</label>
                        <select name="petugas" id="petugas" class="form-select-2 form-select"></select>
                    </div>
                </div>
                <div class="separator m-2">1. Data Antropometri</div>
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_bb">Berat Badan</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_bb" name="antropometri_bb" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">kg</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_tb">Tinggi Badan</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_tb" name="antropometri_tb" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">cm</label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_imt">IMT</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_imt" name="antropometri_imt" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">kg/m<sup>2</sup></label></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <label for="antropometri_lla">LILA</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_lla" name="antropometri_lla" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">cm</label></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label for="antropometri_bb_sebelum_hamil">BB Sebelum Hamil</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_bb_sebelum_hamil" name="antropometri_bb_sebelum_hamil" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">KG</label></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label for="antropometri_bbideal">BB Ideal</label>
                        <div class="input-group input-group-sm">
                            <x-input id="antropometri_bbideal" name="antropometri_bbideal" style="font-size: 11px" />
                            <span class="input-group-text"><label for="">KG</label></span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <label for="antropometri_status_gizi">Status Gizi</label>
                        <x-input id="antropometri_status_gizi" name="antropometri_status_gizi" style="font-size: 11px" />
                    </div>

                </div>
                <div class="separator m-2">2. Biokimia Terkait Gizi</div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label for="biokimia">Biokimia</label>
                        <x-textarea id="biokimia" name="biokimia">-</x-textarea>
                    </div>
                </div>
                <div class="separator m-2">3. Data Fisik/Klinis</div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_td">Tekanan Darah</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_td" name="fisik_klinis_td" style="font-size:11px"></x-input>
                            <x-input-group-text for="fisik_klinis_td" label="mmHG"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_nadi">Nadi</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_nadi" name="fisik_klinis_nadi" style="font-size:11px"></x-input>
                            <x-input-group-text for="fisik_klinis_nadi" label="x/menit"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_suhu">Suhu</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_suhu" name="fisik_klinis_suhu" style="font-size:11px"></x-input>
                            <x-input-group-text for="fisik_klinis_suhu" label="°C"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_pernapasan">Pernapasan</label>
                        <x-input-group class="input-group-sm">
                            <x-input id="fisik_klinis_pernapasan" name="fisik_klinis_pernapasan" style="font-size:11px"></x-input>
                            <x-input-group-text for="fisik_klinis_pernapasan" label="x/menit"></x-input-group-text>
                        </x-input-group>
                        <label for="fisik_klinis_kesadaran">Kesadaran</label>
                        <x-input id="fisik_klinis_kesadaran" name="fisik_klinis_kesadaran" style="font-size:11px"></x-input>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_nafsu_makan">Nafsu Makan</label><br />
                        <x-input-group>
                            <x-radio-group
                                name="fisik_klinis_nafsu_makan"
                                :radios="[
                                    'fisik_klinis_nafsu_makan1' => ['value' => 'Baik', 'label' => 'Baik'],
                                    'fisik_klinis_nafsu_makan2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_hilang_lemak">Hilang Lemak Subkutan</label><br />
                        <x-input-group>
                            <x-radio-group
                                name="fisik_klinis_hilang_lemak"
                                :radios="[
                                    'fisik_klinis_hilang_lemak1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_hilang_lemak2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_ganguan_telan">Gangguan Menelan</label><br />
                        <x-input-group>
                            <x-radio-group
                                name="fisik_klinis_ganguan_telan"
                                :radios="[
                                    'fisik_klinis_ganguan_telan1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_ganguan_telan2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_ganguan_kunyah">Gangguan Mengunyah</label><br />
                        <x-input-group>
                            <x-radio-group
                                name="fisik_klinis_ganguan_kunyah"
                                :radios="[
                                    'fisik_klinis_ganguan_kunyah1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_ganguan_kunyah2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinisudem">Udem</label><br />
                        <x-input-group>
                            <x-radio-group
                                name="fisik_klinisudem"
                                :radios="[
                                    'fisik_klinis_udem1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_udem2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <label for="fisik_klinis_diare">Diare</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="fisik_klinis_diare"
                                :radios="[
                                    'fisik_klinis_diare1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_diare2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_konstipasi">Konstipasi</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_konstipasi"
                                :radios="[
                                    'fisik_klinis_konstipasi1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_konstipasi2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_mual">Mual</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_mual"
                                :radios="[
                                    'fisik_klinis_mual1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_mual2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                        <label for="fisik_klinis_muntah">Muntah</label>
                        <x-input-group>
                            <x-radio-group name="fisik_klinis_muntah"
                                :radios="[
                                    'fisik_klinis_muntah1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'fisik_klinis_muntah2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                        </x-input-group>
                    </div>
                </div>
                <div class="separator m-2">4. Data Riwayat Gizi</div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <label for="riwayat_gizi_alergi_makanan">Alergi Makanan</label>
                        <x-input-group class="input-group-sm">
                            <x-radio-group name="riwayat_gizi_alergi_makanan"
                                :radios="[
                                    'riwayat_gizi_alergi_makanan1' => ['value' => 'Ada', 'label' => 'Ada'],
                                    'riwayat_gizi_alergi_makanan2' => ['value' => 'Tidak', 'label' => 'Tidak'],
                                ]" />
                            <x-input class="br-full" id="riwayat_gizi_keterangan_gizi" name="riwayat_gizi_keterangan_gizi" style="font-size: 11px" />
                        </x-input-group>

                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
