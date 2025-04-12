<div class="modal fade" id="modalAsesmenResikoJatuhDewasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="#"><i>ASESMEN RESIKO JATUH DEWASA</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsesmenResikoJatuhDewasa">
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

                    <div class="row gy-2 sectionFormResikoJatuhDewasa">
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

                        <div class="col-12">
                            <div class="row">
                                <div class="mb-1 col-lg-4">
                                    <label for="">1. Riwayat Jatuh</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala1">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala1" id="penilaian_jatuhmorse_skala1">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="25">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai1">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai1" name="penilaian_jatuhmorse_nilai1" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">2. Diagnosis Skunder (≥2 Diagnosis Skunder )</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala2">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala2" id="penilaian_jatuhmorse_skala2">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="15">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai2">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai2" name="penilaian_jatuhmorse_nilai2" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">3. Alat Bantu</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala3">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala3" id="penilaian_jatuhmorse_skala3">
                                            <option value="Tidak Ada/Kursi Roda/Perawat/Tirah Baring" data-nilai="0">Tidak Ada/Kursi Roda/Perawat/Tirah Baring</option>
                                            <option value="Tongkat/Alat Penopang" data-nilai="15">Tongkat/Alat Penopang</option>
                                            <option value="Berpegangan Pada Perabot" data-nilai="30">Berpegangan Pada Perabot</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai3">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai3" name="penilaian_jatuhmorse_nilai3" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">4. Terpasang Infuse</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala4">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala4" id="penilaian_jatuhmorse_skala4">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="20">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai4">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai4" name="penilaian_jatuhmorse_nilai4" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">5. Gaya Berjalan</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala5">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala5" id="penilaian_jatuhmorse_skala5">
                                            <option value="Normal/Tirah Baring/Imobilisasi" data-nilai="0">Normal/Tirah Baring/Imobilisasi</option>
                                            <option value="Lemah" data-nilai="10">Lemah</option>
                                            <option value="Terganggu" data-nilai="20">Terganggu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai5">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai5" name="penilaian_jatuhmorse_nilai5" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">6. Status Mental</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_skala6">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuhmorse_skala6" id="penilaian_jatuhmorse_skala6">
                                            <option value="Sadar Akan Kemampuan Diri Sendiri" data-nilai="0">Sadar Akan Kemampuan Diri Sendiri</option>
                                            <option value="Sering Lupa Akan Keterbatasan Yang Dimiliki" data-nilai="15">Sering Lupa Akan Keterbatasan Yang Dimiliki</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_nilai6">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_nilai6" name="penilaian_jatuhmorse_nilai6" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-10">
                                    <label for="">Tingkat Resiko : <span class="hasilResiko" style="color:green;font-weight:bold">Resiko Rendah (0-24)</span>, Tindakan : <span class="tindakanResiko">Intervensi pencegahan resiko jatuh standar </span></label>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuhmorse_totalnilai">Total : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_totalnilai" name="penilaian_jatuhmorse_totalnilai" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="hasil_skrining">Hasil Skrining : </label>
                                    <x-textarea cols="30" rows="3" name="hasil_skrining" id="hasil_skrining"></x-textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="saran">Saran : </label>
                                    <x-textarea cols="30" rows="3" name="saran" id="saran"></x-textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="">Intervensi Pencegahan Pasien Jatuh <span class="intervensiResikoDewasa"></label>
                                    {{-- <x-input-group> --}}
                                    <x-checkbox-group name="intervensi_pencegahan" id="intervensi_pencegahan"
                                        :checkboxes="[
                                            'intervensi1' => ['value' => 'Orientasi linkgungan', 'label' => 'Orientasi linkgungan', 'checked' => true],
                                            'intervensi2' => ['value' => 'Pastikan bel mudah dijangkau (bila tersedia)', 'label' => 'Pastikan bel mudah dijangkau (bila tersedia)'],
                                            'intervensi3' => ['value' => 'Roda tempat tidur berada dalam posisi terkunci', 'label' => 'Roda tempat tidur berada dalam posisi terkunci'],
                                            'intervensi4' => ['value' => 'Posisikan tempat tidur pada posisi terendah', 'label' => 'Posisikan tempat tidur pada posisi terendah'],
                                            'intervensi5' => ['value' => 'Naikkan pagar pengaman tempat tidur', 'label' => 'Naikkan pagar pengaman tempat tidur'],
                                            'intervensi6' => ['value' => 'Usahakan penerangan cukup saat malam hari', 'label' => 'Usahakan penerangan cukup saat malam hari'],
                                            'intervensi7' => ['value' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan', 'label' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan'],
                                        ]" />
                                    {{-- </x-input-group> --}}
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive overflow-x-auto">
                            <table class="table table-striped table-bordered" id="tbAsesmenResikoJatuhDewasa">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenResikoJatuhDewasa">
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
        const modalAsesmenResikoJatuhDewasa = $('#modalAsesmenResikoJatuhDewasa');
        const formAsesmenResikoJatuhDewasa = $('#formAsesmenResikoJatuhDewasa');
        const btnCreateAsesmenResikoJatuhDewasa = $('#btnCreateAsesmenResikoJatuhDewasa');
        const radioAsesmenResikoJatuhDewasa = formAsesmenResikoJatuhDewasa.find('input[type=radio]');


        function showModalAsesmenResikoJatuhDewasa(no_rawat) {
            modalAsesmenResikoJatuhDewasa.modal('show');
            // renderTbAsesmenResikoJatuhDewasa(no_rawat);
            resetFormAsesmenResikoJatuhDewasa(no_rawat);
        }

        function resetFormAsesmenResikoJatuhDewasa(no_rawat) {
            formAsesmenResikoJatuhDewasa.trigger('reset');
            formAsesmenResikoJatuhDewasa.find('input[name=skala]').val(0).trigger('change');
            formAsesmenResikoJatuhDewasa.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenResikoJatuhDewasa.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenResikoJatuhDewasa.find('input[name=non_farmakologi]').prop('checked', false).trigger('change');

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


                const tanggal = formAsesmenResikoJatuhDewasa.find('input[name=tanggal]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');
                tanggal.val(dateNow);

                formAsesmenResikoJatuhDewasa.find('input[name=no_rawat]').val(no_rawat);
                formAsesmenResikoJatuhDewasa.find('input[name=no_rkm_medis]').val(pasien.no_rkm_medis);
                formAsesmenResikoJatuhDewasa.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formAsesmenResikoJatuhDewasa.find('input[name=keluarga]').val(response.p_jawab)
                formAsesmenResikoJatuhDewasa.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formAsesmenResikoJatuhDewasa.find('input[name=kamar]').val(kamar.split(',').length >= 1 ? kamar.split(',')[0] : kamar);
                formAsesmenResikoJatuhDewasa.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formAsesmenResikoJatuhDewasa.find('input[name=diagnosa]').val(kamar.split(',').length >= 1 ? kamar.split(',')[1] : '-');
                formAsesmenResikoJatuhDewasa.find('input[name=dokter]').val(dokter.nm_dokter);
            })
        }
    </script>
@endpush
