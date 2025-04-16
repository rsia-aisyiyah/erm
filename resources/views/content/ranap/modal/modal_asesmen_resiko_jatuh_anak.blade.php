<div class="modal fade" id="modalAsesmenResikoJatuhAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="#"><i>ASESMEN RESIKO JATUH ANAK / HUMPY-DUMPTY</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsesmenResikoJatuhAnak">
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
                    <div class="row gy-2 sectionFormResikoJatuhAnak">
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


                        <div class="col-8">
                            <fieldset class="border p-3">
                                <div class="row gy-1">
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
                                        <label for="">2. Diagnosis Skunder (≥2 Dx. Skunder )</label>
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
                                    <div class="mb-1 col-lg-2 offset-md-10">
                                        <div class="input-group">
                                            <label for="penilaian_jatuhmorse_totalnilai">Total : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuhmorse_totalnilai" name="penilaian_jatuhmorse_totalnilai" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 ">
                                        <label for="hasil_skrining" class="form-label">Hasil Skrining : </label>
                                        <x-textarea cols="30" rows="3" name="hasil_skrining" id="hasil_skrining"></x-textarea>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label for="saran" class="form-label">Saran : </label>
                                        <x-textarea cols="30" rows="4" name="saran" id="saran"></x-textarea>
                                    </div>


                                </div>
                            </fieldset>

                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">
                                <strong> <span class="intervensiResikoDewasa"></strong>

                            </label>
                            <div class="d-none intervensiResiko1">
                                <x-checkbox-group class="check_intervensi_pencegahan" name="intervensi_pencegahan"
                                    :checkboxes="[
                                        'intervensi1' => ['value' => 'Orientasi linkgungan', 'label' => 'Orientasi linkgungan'],
                                        'intervensi2' => ['value' => 'Pastikan bel mudah dijangkau (bila tersedia)', 'label' => 'Pastikan bel mudah dijangkau (bila tersedia)'],
                                        'intervensi3' => ['value' => 'Roda tempat tidur berada dalam posisi terkunci', 'label' => 'Roda tempat tidur berada dalam posisi terkunci'],
                                        'intervensi4' => ['value' => 'Posisikan tempat tidur pada posisi terendah', 'label' => 'Posisikan tempat tidur pada posisi terendah'],
                                        'intervensi5' => ['value' => 'Naikkan pagar pengaman tempat tidur', 'label' => 'Naikkan pagar pengaman tempat tidur'],
                                        'intervensi6' => ['value' => 'Usahakan penerangan cukup saat malam hari', 'label' => 'Usahakan penerangan cukup saat malam hari'],
                                        'intervensi7' => ['value' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan', 'label' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan'],
                                    ]" />

                            </div>
                            <div class="d-none intervensiResiko2">
                                <x-checkbox-group class="check_intervensi_pencegahan" name="intervensi_pencegahan"
                                    :checkboxes="[
                                        'intervensi8' => ['value' => 'Lakukan semua pedoman resiko jatuh rendah', 'label' => 'Lakukan semua pedoman resiko jatuh rendah'],
                                        'intervensi9' => ['value' => 'Beri tanda segitiga warna kuning pada bed dan pintu pasien', 'label' => 'Beri tanda segitiga warna kuning pada bed dan pintu pasien'],
                                        'intervensi10' => ['value' => 'Beri tanda resiko jatuh pada identitas pasien', 'label' => 'Beri tanda resiko jatuh pada identitas pasien'],
                                        'intervensi11' => ['value' => 'Posisikan tempat tidur pada posisi terendah', 'label' => 'Posisikan tempat tidur pada posisi terendah'],
                                        'intervensi12' => ['value' => 'Naikkan pagar pengaman tempat tidur', 'label' => 'Naikkan pagar pengaman tempat tidur'],
                                        'intervensi13' => ['value' => 'Usahakan penerangan cukup saat malam hari', 'label' => 'Usahakan penerangan cukup saat malam hari'],
                                        'intervensi14' => ['value' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan', 'label' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan'],
                                    ]" />

                            </div>
                            <div class="d-none intervensiResiko3">
                                <x-checkbox-group class="check_intervensi_pencegahan" name="intervensi_pencegahan"
                                    :checkboxes="[
                                        'intervensi15' => ['value' => 'Lakukan semua pencegahan jatuh resiko rendah dan sedang', 'label' => 'Lakukan semua pencegahan jatuh resiko rendah dan sedang'],
                                        'intervensi16' => ['value' => 'Kunjungi dan monitor pasien setiap 1 jam', 'label' => 'Kunjungi dan monitor pasien setiap 1 jam'],
                                        'intervensi17' => ['value' => 'Tempatkan kamar pasien dekat dengan ners station', 'label' => 'Tempatkan kamar pasien dekat dengan ners station'],
                                        'intervensi18' => ['value' => 'Pastikan pasien menggunakan alat bantu jalan', 'label' => 'Pastikan pasien menggunakan alat bantu jalan'],
                                        'intervensi19' => ['value' => 'Libatkan keluarga untuk mengawasi pasien', 'label' => 'Libatkan keluarga untuk mengawasi pasien'],
                                        'intervensi20' => ['value' => 'Usahakan penerangan cukup saat malam hari', 'label' => 'Usahakan penerangan cukup saat malam hari'],
                                        'intervensi21' => ['value' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan', 'label' => 'Pastikan kebutuhan pribadi pasien dalam jangkauan'],
                                    ]" />
                            </div>
                            <x-input type="hidden" name="update" id="update" value=0 />
                        </div>
                        <div class="table-responsive table-responsive-md overflow-x-auto">
                            <table class="table table-striped table-bordered" id="tbAsesmenResikoJatuhAnak">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-striped table-bordered" id="tableResikoJatuhAnak" style="min-width: 1200px;">
                            <tbody>
                                <!-- your existing table rows -->
                            </tbody>
                        </table>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 13px" id="btnCreateAsesmenResikoJatuhAnak">
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
        const modalAsesmenResikoJatuhAnak = $('#modalAsesmenResikoJatuhAnak');
        const formAsesmenResikoJatuhAnak = $('#formAsesmenResikoJatuhAnak');
        const btnCreateAsesmenResikoJatuhAnak = $('#btnCreateAsesmenResikoJatuhAnak');
        const radioAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('input[type=radio]');
        const tableResikoJatuhAnak = $('#tableResikoJatuhAnak');


        const selectsAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('select[name^=penilaian_jatuhmorse_skala]');
        selectsAsesmenResikoJatuhAnak.change((e) => {
            const nilai = $(e.target).find(':selected').data('nilai');
            const inputName = $(e.target).attr('name').replace('skala', 'nilai');
            formAsesmenResikoJatuhAnak.find(`input[name=${inputName}]`).val(nilai);
            countTingkatResikoJatuhAnak();
        });

        function countTingkatResikoJatuhAnak() {
            const skalaValues = [1, 2, 3, 4, 5, 6].map(i => parseInt(formAsesmenResikoJatuhAnak.find(`input[name=penilaian_jatuhmorse_nilai${i}]`).val()) || 0);
            const skalaNyeri = skalaValues.reduce((sum, val) => sum + val, 0);

            let hasilResiko, tindakanResiko, textColor;
            $('.intervensiResiko1, .intervensiResiko2, .intervensiResiko3').addClass('d-none');
            if (parseInt(skalaNyeri) <= 24) {
                hasilResiko = 'Resiko Rendah (0-24)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar';
                textColor = 'green';
                $('.intervensiResiko1').removeClass('d-none');
            } else if (parseInt(skalaNyeri) <= 44) {
                hasilResiko = 'Resiko Sedang (25-44)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar';
                textColor = '#ff8b00';
                $('.intervensiResiko2').removeClass('d-none');
            } else {
                hasilResiko = 'Resiko Tinggi (>45)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar & Intervensi resiko jatuh tinggi';
                textColor = 'red';
                $('.intervensiResiko3').removeClass('d-none');
            }
            $('.intervensiResikoDewasa').html(`${hasilResiko} <br/> ${tindakanResiko}`);
            $('.intervensiResikoDewasa').css('color', textColor);
            formAsesmenResikoJatuhAnak.find('input[name=penilaian_jatuhmorse_totalnilai]').val(skalaNyeri);
            formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').val(`${hasilResiko} : ${tindakanResiko}`);
        }

        function showModalAsesmenResikoJatuhAnak(no_rawat) {
            Swal.fire({
                title: '<i>Belum tersedia</i>',
                icon: 'info',
                html: `Masih dalam proses pengembangan, terimakasih`
            })
            // modalAsesmenResikoJatuhAnak.modal('show');
            // renderResikojatuhDewasa(no_rawat)
            // resetFormAsesmenResikoJatuhAnak(no_rawat);
            // countTingkatResikoJatuhAnak();
        }

        const chekIntervensiAnak = formAsesmenResikoJatuhAnak.find('.check_intervensi_pencegahan');

        chekIntervensiAnak.change((e) => {
            const check = formAsesmenResikoJatuhAnak.find('input[name=intervensi_pencegahan]:checked');
            const arrayChecked = check.serializeArray();
            const value = arrayChecked.map((item) => item.value).join(';\n');
            const textareaSaran = formAsesmenResikoJatuhAnak.find('textarea[name=saran]')


            textareaSaran.text(value)

        });

        function resetFormAsesmenResikoJatuhAnak(no_rawat) {
            formAsesmenResikoJatuhAnak.trigger('reset');
            formAsesmenResikoJatuhAnak.find('input[name=skala]').val(0).trigger('change');
            formAsesmenResikoJatuhAnak.find('input[name=lokasi]').prop('checked', false).trigger('change');
            formAsesmenResikoJatuhAnak.find('input[name=penyuluhan]').prop('checked', false).trigger('change');
            formAsesmenResikoJatuhAnak.find('input[name=non_farmakologi]').prop('checked', false).trigger('change');

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


                const tanggal = formAsesmenResikoJatuhAnak.find('input[name=tanggal]');
                const dateNow = moment().format('DD-MM-YYYY HH:mm:ss');
                tanggal.val(dateNow);

                formAsesmenResikoJatuhAnak.find('input[name=no_rawat]').val(no_rawat);
                formAsesmenResikoJatuhAnak.find('input[name=no_rkm_medis]').val(pasien.no_rkm_medis);
                formAsesmenResikoJatuhAnak.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${response.umurdaftar} ${response.sttsumur})`);
                formAsesmenResikoJatuhAnak.find('input[name=keluarga]').val(response.p_jawab)
                formAsesmenResikoJatuhAnak.find('input[name=alamat]').val(`${pasien.alamat}, ${pasien.kecamatanpj}`)
                formAsesmenResikoJatuhAnak.find('input[name=kamar]').val(kamar.split(',').length >= 1 ? kamar.split(',')[0] : kamar);
                formAsesmenResikoJatuhAnak.find('input[name=tgl_registrasi]').val(`${formatTanggal(response.tgl_registrasi)} ${response.jam_reg}`);
                formAsesmenResikoJatuhAnak.find('input[name=diagnosa]').val(kamar.split(',').length >= 1 ? kamar.split(',')[1] : '-');
                formAsesmenResikoJatuhAnak.find('input[name=dokter]').val(dokter.nm_dokter);
                formAsesmenResikoJatuhAnak.find('input[name=update]').val(0);
                formAsesmenResikoJatuhAnak.find('textarea[name=saran]').text('');
                formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').text('');

            })
        }

        btnCreateAsesmenResikoJatuhAnak.on('click', () => {
            const data = getDataForm('#formAsesmenResikoJatuhAnak', ['input', 'select', 'textarea']);
            const isUpdate = formAsesmenResikoJatuhAnak.find('input[name=update]').val()


            if (isUpdate != 0) {
                console.log(isUpdate);
                updateResikoJatuhAnak(data);
                return false;
            }
            console.log('CREATED');
            $.post(`${url}/asesmen/resiko-jatuh-dewasa`, data).done((response) => {
                alertSuccessAjax('Berhasil membuat resiko jatuh dewasa')
                renderResikojatuhDewasa(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat']);
                countTingkatResikoJatuhAnak(data['no_rawat']);
            })
        })


        function updateResikoJatuhAnak(data) {
            $.ajax({
                url: `${url}/asesmen/resiko-jatuh-dewasa`,
                type: 'PUT',
                data: data
            }).done((response) => {
                alertSuccessAjax('Berhasil mengubah resiko jatuh dewasa')
                renderResikojatuhDewasa(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat'])
            })
        }

        function renderResikojatuhDewasa(no_rawat) {

            $.get(`${url}/asesmen/resiko-jatuh-dewasa/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                tableResikoJatuhAnak.find('tbody').empty();
                if (Object.keys(response).length === 0) {
                    return false;
                }
                const barisData = [{
                        label: "Tanggal",
                        key: "tanggal",
                        value: "",

                    }, {
                        label: 'Riwayat Jatuh',
                        key: 'penilaian_jatuhmorse_skala1',
                        value: 'penilaian_jatuhmorse_nilai1'
                    }, {
                        label: 'Diagnosis Sekunder >2',
                        key: 'penilaian_jatuhmorse_skala2',
                        value: 'penilaian_jatuhmorse_nilai2'
                    }, {
                        label: 'Alat Bantu',
                        key: 'penilaian_jatuhmorse_skala3',
                        value: 'penilaian_jatuhmorse_nilai3'
                    }, {
                        label: 'Terpasang Infus',
                        key: 'penilaian_jatuhmorse_skala4',
                        value: 'penilaian_jatuhmorse_nilai4'
                    }, {
                        label: 'Gaya Berjalan',
                        key: 'penilaian_jatuhmorse_skala5',
                        value: 'penilaian_jatuhmorse_nilai5'
                    }, {
                        label: 'Status Mental',
                        key: 'penilaian_jatuhmorse_skala6',
                        value: 'penilaian_jatuhmorse_nilai6'
                    },
                    {
                        label: 'Nilai Total',
                        key: 'penilaian_jatuhmorse_totalnilai',
                        value: ''
                    },
                    {
                        label: 'Hasil Skrining',
                        key: 'hasil_skrining',
                        value: ''
                    }, {
                        label: 'Saran',
                        key: 'saran',
                        value: ''
                    }, {
                        label: 'Petugas',
                        key: 'petugas',
                        value: '',
                    }
                ];

                const headerRow = $("<tr></tr>");
                headerRow.append($("<th></th>"));

                response.forEach((item, index) => {
                    if (index === 0) {
                        headerRow.append($("<th></th>").text("Asesmen Awal"));
                    } else {
                        headerRow.append($("<th></th>").text("Asesmen Ulang"));
                    }
                })

                tableResikoJatuhAnak.find('tbody').append(headerRow);

                barisData.forEach(item => {
                    const baris = $("<tr></tr>");
                    baris.append($(`<th width="15%"></th>`).text(item.label));
                    tableResikoJatuhAnak.find('tbody').append(baris);
                    response.forEach((data, index) => {
                        const selData = $(`<td></td>`);
                        let values = [];
                        switch (item.key) {
                            case 'saran':
                                const val = data[item.key].split(';');
                                const list = val.map((item) => {
                                    values.push(`<li>${item}</li>`);
                                });
                                values = [...new Set(values)];
                                values = values.join('');
                                selData.append(values);
                                baris.append(selData);
                                break;
                            case 'tanggal':

                                const userSession = "{{ session()->get('pegawai')->nik }}";
                                let button = '';
                                if (userSession == data['petugas']['nip']) {
                                    button = ` <span class="badge bg-primary p-1 ms-2" style="cursor: pointer" onclick="getResikoJatuhAnak('${data.no_rawat}', '${data.tanggal}')"><i class="bi bi-pencil-square"></i></span>
                                    <span class="badge bg-danger p-1" style="cursor: pointer" onclick="deleteResikoJatuhAnak('${data.no_rawat}', '${data.tanggal}')"><i class="bi bi-trash"></i></span>`;
                                }


                                values.push(`${formatTanggal(data[item.key])} ${button}`);
                                selData.append(values);
                                baris.append(selData);
                                break;
                            case 'penilaian_jatuhmorse_totalnilai':
                                if (data[item.key] <= 24) {
                                    values.push(`<strong class="text-success">${data[item.key]}</strong>`);
                                } else if (data[item.key] <= 44) {
                                    values.push(`<strong class="text-warning">${data[item.key]}</strong>`);
                                } else {
                                    values.push(`<strong class="text-danger">${data[item.key]}</strong>`);
                                }

                                selData.append(values);
                                baris.append(selData);
                                break;
                            case 'petugas':
                                values.push(data[item.key]['nama']);
                                selData.append(values);
                                baris.append(selData);
                                break;
                            default:
                                values.push(data[item.key]);

                                if (item.value) {
                                    values.push(` (${data[item.value]})`);
                                }
                                selData.append(values);
                                baris.append(selData);
                                break;
                        }
                    })
                });
            })

        }

        function getResikoJatuhAnak(no_rawat, tanggal) {
            $.get(`${url}/asesmen/resiko-jatuh-dewasa/get`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                for (let i = 1; i <= 6; i++) {
                    formAsesmenResikoJatuhAnak.find(`select[name=penilaian_jatuhmorse_skala${i}]`)
                        .val(response[`penilaian_jatuhmorse_skala${i}`]).trigger('change');
                }
                formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').val(response.hasil_skrining);
                formAsesmenResikoJatuhAnak.find('textarea[name=saran]').val(response.saran);
                const dateTimeSplit = response.tanggal.split(' ');
                const date = splitTanggal(dateTimeSplit[0]);
                const time = dateTimeSplit[1];
                formAsesmenResikoJatuhAnak.find('input[name=tanggal]').val(`${date} ${time}`);
                formAsesmenResikoJatuhAnak.find('input[name=update]').val(1);

            });
        }

        function deleteResikoJatuhAnak(no_rawat, tanggal) {
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
                    $.ajax({
                        url: `${url}/asesmen/resiko-jatuh-dewasa`,
                        type: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            tanggal: tanggal
                        },
                    }).done((response) => {
                        alertSuccessAjax('Berhasil menghapus resiko jatuh dewasa')
                        renderResikojatuhDewasa(no_rawat)
                        resetFormAsesmenResikoJatuhAnak(no_rawat)
                    })
                }
            })
        }
    </script>
@endpush
