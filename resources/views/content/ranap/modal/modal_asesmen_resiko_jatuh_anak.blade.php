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
                                        <label for="">1. Umur</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala1" id="penilaian_humptydumpty_skala1">
                                                <option value="" selected disabled>-</option>
                                                <option value="0 - 3 Tahun" data-nilai="4">0 - 3 Tahun</option>
                                                <option value="3 - 7 Tahun" data-nilai="3">3 - 7 Tahun</option>
                                                <option value="7 - 13 Tahun" data-nilai="2">7 - 13 Tahun</option>
                                                <option value="0 - 28 Hari" data-nilai="1">0 - 28 Hari</option>
                                                <option value="> 13 Tahun" data-nilai="0"> > 13 Tahun</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai1">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai1" name="penilaian_humptydumpty_nilai1" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">2. Jenis Kelamin</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala2" id="penilaian_humptydumpty_skala2">
                                                <option value="" selected disabled>-</option>
                                                <option value="Laki-laki" data-nilai="2">Laki-laki</option>
                                                <option value="Perempuan" data-nilai="1">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai2">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai2" name="penilaian_humptydumpty_nilai2" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">3. Diagnosa</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala3" id="penilaian_humptydumpty_skala3">
                                                <option value="" selected disabled>-</option>
                                                <option value="Kelainan Neurologi" data-nilai="4">Kelainan Neurologi</option>
                                                <option value="Perubahan Dalam Oksigen(Masalah Saluran Nafas, Dehidrasi, Anemia, Anoreksia / Sakit Kepala, Dll)" data-nilai="3">Perubahan Dalam Oksigen(Masalah Saluran Nafas, Dehidrasi, Anemia, Anoreksia / Sakit Kepala, Dll)</option>
                                                <option value="Kelainan Psikis / Perilaku" data-nilai="2">Kelainan Psikis / Perilaku</option>
                                                <option value="Diagnosa Lain" data-nilai="1">Diagnosa Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai3">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai3" name="penilaian_humptydumpty_nilai3" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">4. Gangguan Kognitif</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala4" id="penilaian_humptydumpty_skala4">
                                                <option value="" selected disabled>-</option>
                                                <option value="Tidak Sadar Terhadap Keterbatasan" data-nilai="3">Tidak Sadar Terhadap Keterbatasan</option>
                                                <option value="Lupa Keterbatasan" data-nilai="2">Lupa Keterbatasan</option>
                                                <option value="Mengetahui Kemampuan Diri" data-nilai="1">Mengetahui Kemampuan Diri</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai4">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai4" name="penilaian_humptydumpty_nilai4" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">5. Faktor Lingkungan</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala5" id="penilaian_humptydumpty_skala5">
                                                <option value="" selected disabled>-</option>
                                                <option value="Riwayat Jatuh Dari Tempat Tidur Saat Bayi/Anak" data-nilai="4">Riwayat Jatuh Dari Tempat Tidur Saat Bayi/Anak</option>
                                                <option value="Pasien Menggunakan Alat Bantu/Box/Mebel" data-nilai="3">Pasien Menggunakan Alat Bantu/Box/Mebel</option>
                                                <option value="Pasien Berada Di Tempat Tidur" data-nilai="2">Pasien Berada Di Tempat Tidur</option>
                                                <option value="Di Luar Ruang Rawat" data-nilai="1">Di Luar Ruang Rawat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai5">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai5" name="penilaian_humptydumpty_nilai5" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">6. Efek Obat Penenang/Operasi/Anestesi</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala6" id="penilaian_humptydumpty_skala6">
                                                <option value="" selected disabled>-</option>
                                                <option value="Dalam 24 Jam" data-nilai="3">Dalam 24 Jam</option>
                                                <option value="Dalam 48 Jam" data-nilai="2">Dalam 48 Jam</option>
                                                <option value="> 48 Jam" data-nilai="1"> > 48 Jam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai6">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai6" name="penilaian_humptydumpty_nilai6" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-4">
                                        <label for="">7. Penggunaan Obat</label>
                                    </div>
                                    <div class="mb-1 col-lg-6">
                                        <div class="input-group">
                                            <select class="form-select br-full" name="penilaian_humptydumpty_skala7" id="penilaian_humptydumpty_skala7">
                                                <option value="" selected disabled>-</option>
                                                <option value="Bermacam-macam Obat Yang Digunakan : Obat Sedative (Kecuali Pasien ICU Yang Menggunakan sedasi dan paralisis), Hipnotik, Barbiturat, Fenoti-Azin, Antidepresan, Laksans/Diuretika,Narkotik" data-nilai="3">Bermacam-macam Obat Yang Digunakan : Obat Sedative (Kecuali Pasien ICU Yang Menggunakan sedasi dan paralisis), Hipnotik, Barbiturat, Fenoti-Azin, Antidepresan, Laksans/Diuretika,Narkotik</option>
                                                <option value="Salah Satu Dari Pengobatan Di Atas" data-nilai="2">Salah Satu Dari Pengobatan Di Atas</option>
                                                <option value="Pengobatan Lain" data-nilai="1">Pengobatan Lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-lg-2">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_nilai7">Nilai : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_nilai7" name="penilaian_humptydumpty_nilai7" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-1 col-lg-2 offset-md-10">
                                        <div class="input-group">
                                            <label for="penilaian_humptydumpty_totalnilai">Total : </label>
                                            <input type="text" class="form-control form-control-sm br-full" id="penilaian_humptydumpty_totalnilai" name="penilaian_humptydumpty_totalnilai" value="0" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <label for="hasil_skrining" class="form-label">Hasil Skrining : </label>
                                                <x-textarea cols="30" rows="5" name="hasil_skrining" id="hasil_skrining"></x-textarea>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <label for="saran" class="form-label">Saran : </label>
                                                <x-textarea cols="30" rows="5" name="saran" id="saran" readonly></x-textarea>

                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </fieldset>

                        </div>
                        <div class="col-4">
                            <label for="" class="form-label">
                                <strong> <span class="intervensiResikoAnak"></strong>

                            </label>
                            <div class="d-none intervensiResikoAnak1">
                                <x-checkbox-group class="check_intervensi_pencegahan_anak" name="intervensi_pencegahan_anak"
                                    :checkboxes="[
                                        'intervensi1' => ['value' => 'Sarankan pasien/keluarga untuk meminta bantuan bila diperlukan', 'label' => 'Sarankan pasien/keluarga untuk meminta bantuan bila diperlukan'],
                                        'intervensi2' => ['value' => 'Dekatkan bel ke pasien dan ajarkan keluarga cara penggunaannya', 'label' => 'Dekatkan bel ke pasien dan ajarkan keluarga cara penggunaannya'],
                                        'intervensi3' => ['value' => 'Anjurkan pasien menggunakan sandal saat turun/menggunakan pakaian yang tidak menimbulkan cidera', 'label' => 'Anjurkan pasien menggunakan sandal saat turun/menggunakan pakaian yang tidak menimbulkan cidera'],
                                        'intervensi4' => ['value' => 'Kaji kebutuhan eliminasi pasien', 'label' => 'Kaji kebutuhan eliminasi pasien'],
                                        'intervensi5' => ['value' => 'Hindarkan barang-barang yang berbahaya didekat pasien', 'label' => 'Hindarkan barang-barang yang berbahaya didekat pasien'],
                                        'intervensi6' => ['value' => 'Ajarkan keluarga/penunggu pasien untuk ikut mencegah resiko jatuh', 'label' => 'Ajarkan keluarga/penunggu pasien untuk ikut mencegah resiko jatuh'],
                                        'intervensi7' => ['value' => 'Usahakan penerangan cukup pada malam hari', 'label' => 'Usahakan penerangan cukup pada malam hari'],
                                        'intervensi8' => ['value' => 'Dokumentasikan tindakan perawat dan tindakan lanjutan', 'label' => 'Dokumentasikan tindakan perawat dan tindakan lanjutan'],
                                    ]" />

                            </div>
                            <div class="d-none-s intervensiResiko2">
                                <x-checkbox-group class="check_intervensi_pencegahan_anak" name="intervensi_pencegahan_anak"
                                    :checkboxes="[
                                        'intervensi9' => ['value' => 'Sarankan pasien/keluarga untuk meminta bantuan bila diperlukan', 'label' => 'Sarankan pasien/keluarga untuk meminta bantuan bila diperlukan'],
                                        'intervensi10' => ['value' => 'Tempatkan bel panggilan dalam jangkuan tangan pasien', 'label' => 'Tempatkan bel panggilan dalam jangkuan tangan pasien'],
                                        'intervensi11' => ['value' => 'Tempatkan benda-benda milik pasien di dekat pasien dalam posisi terkunci', 'label' => 'Tempatkan benda-benda milik pasien di dekat pasien dalam posisi terkunci'],
                                        'intervensi12' => ['value' => 'Pastikan tempat tidur dalam posisi rendah dan roda terkunci', 'label' => 'Pastikan tempat tidur dalam posisi rendah dan roda terkunci'],
                                        'intervensi13' => ['value' => 'Pastikan pakaian pasien diatas mata kaki', 'label' => 'Pastikan pakaian pasien diatas mata kaki'],
                                        'intervensi14' => ['value' => 'Bantu pasien saat transfer/ambulasi', 'label' => 'Bantu pasien saat transfer/ambulasi'],
                                        'intervensi15' => ['value' => 'Pasangkan sisi pengaman tempat tidur', 'label' => 'Pasangkan sisi pengaman tempat tidur'],
                                        'intervensi16' => ['value' => 'Pastikan pasien terpasang penanda tambahan pasien resiko jatuh', 'label' => 'Pastikan pasien terpasang penanda tambahan pasien resiko jatuh'],
                                        'intervensi17' => ['value' => 'Pastikan tanda pasien resiko jatuh terpasang di tempat tidur pasien dan RM pasien Pasang restrain bila perlu', 'label' => 'Pastikan tanda pasien resiko jatuh terpasang di tempat tidur pasien dan RM pasien Pasang restrain bila perlu'],
                                        'intervensi18' => ['value' => 'Monitor kebutuhan toilating pasien secara continue dan berikan bantuan bila diperlukan', 'label' => 'Monitor kebutuhan toilating pasien secara continue dan berikan bantuan bila diperlukan'],
                                        'intervensi19' => ['value' => 'Beritahukan efek dari obat/anestesi kepada pasien/keluarga pasien', 'label' => 'Beritahukan efek dari obat/anestesi kepada pasien/keluarga pasien'],
                                        'intervensi20' => ['value' => 'Berikan orientasi ruangan sekitar kepada pasien/keluarga pasien', 'label' => 'Berikan orientasi ruangan sekitar kepada pasien/keluarga pasien'],
                                    ]" />

                            </div>
                            <x-input type="hidden" name="update" id="update" value=0 />
                        </div>
                    </div>

                </form>
                <div class="mt-2 table-responsive" style="overflow-x: auto;">
                    <table class="table table-striped table-bordered" id="tableResikoJatuhAnak" style="min-width: 1200px;">
                        <tbody>
                            <!-- your existing table rows -->
                        </tbody>
                    </table>
                </div>
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
    {{-- <script>
        const modalAsesmenResikoJatuhAnak = $('#modalAsesmenResikoJatuhAnak');
        const formAsesmenResikoJatuhAnak = $('#formAsesmenResikoJatuhAnak');
        const btnCreateAsesmenResikoJatuhAnak = $('#btnCreateAsesmenResikoJatuhAnak');
        const radioAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('input[type=radio]');
        const tableResikoJatuhAnak = $('#tableResikoJatuhAnak');


        const selectsAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('select[name^=penilaian_humptydumpty_skala]');
        selectsAsesmenResikoJatuhAnak.change((e) => {
            const nilai = $(e.target).find(':selected').data('nilai');
            const inputName = $(e.target).attr('name').replace('skala', 'nilai');
            formAsesmenResikoJatuhAnak.find(`input[name=${inputName}]`).val(nilai);
            countTingkatResikoJatuhAnak();
        });

        function countTingkatResikoJatuhAnak() {
            const skalaValues = [1, 2, 3, 4, 5, 6].map(i => parseInt(formAsesmenResikoJatuhAnak.find(`input[name=penilaian_humptydumpty_nilai${i}]`).val()) || 0);
            const skalaNyeri = skalaValues.reduce((sum, val) => sum + val, 0);

            let hasilResiko, tindakanResiko, textColor;
            $('.intervensiResikoAnak1, .intervensiResiko2, .intervensiResiko3').addClass('d-none');
            if (parseInt(skalaNyeri) <= 24) {
                hasilResiko = 'Resiko Rendah (0-24)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar';
                textColor = 'green';
                $('.intervensiResikoAnak1').removeClass('d-none');
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
            $('.intervensiResikoAnak').html(`${hasilResiko} <br/> ${tindakanResiko}`);
            $('.intervensiResikoAnak').css('color', textColor);
            formAsesmenResikoJatuhAnak.find('input[name=penilaian_humptydumpty_totalnilai]').val(skalaNyeri);
            formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').val(`${hasilResiko} : ${tindakanResiko}`);
        }

        

        const chekIntervensiAnak = formAsesmenResikoJatuhAnak.find('.check_intervensi_pencegahan_anak');

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
            $.post(`${url}/asesmen/resiko-jatuh-anak`, data).done((response) => {
                alertSuccessAjax('Berhasil membuat resiko jatuh dewasa')
                renderResikoJatuhAnak(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat']);
                countTingkatResikoJatuhAnak(data['no_rawat']);
            })
        })


        function updateResikoJatuhAnak(data) {
            $.ajax({
                url: `${url}/asesmen/resiko-jatuh-anak`,
                type: 'PUT',
                data: data
            }).done((response) => {
                alertSuccessAjax('Berhasil mengubah resiko jatuh dewasa')
                renderResikoJatuhAnak(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat'])
            })
        }

        function renderResikoJatuhAnak(no_rawat) {

            $.get(`${url}/asesmen/resiko-jatuh-anak/get`, {
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
                        key: 'penilaian_humptydumpty_skala1',
                        value: 'penilaian_humptydumpty_nilai1'
                    }, {
                        label: 'Diagnosis Sekunder >2',
                        key: 'penilaian_humptydumpty_skala2',
                        value: 'penilaian_humptydumpty_nilai2'
                    }, {
                        label: 'Alat Bantu',
                        key: 'penilaian_humptydumpty_skala3',
                        value: 'penilaian_humptydumpty_nilai3'
                    }, {
                        label: 'Terpasang Infus',
                        key: 'penilaian_humptydumpty_skala4',
                        value: 'penilaian_humptydumpty_nilai4'
                    }, {
                        label: 'Gaya Berjalan',
                        key: 'penilaian_humptydumpty_skala5',
                        value: 'penilaian_humptydumpty_nilai5'
                    }, {
                        label: 'Status Mental',
                        key: 'penilaian_humptydumpty_skala6',
                        value: 'penilaian_humptydumpty_nilai6'
                    },
                    {
                        label: 'Nilai Total',
                        key: 'penilaian_humptydumpty_totalnilai',
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
                            case 'penilaian_humptydumpty_totalnilai':
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
            $.get(`${url}/asesmen/resiko-jatuh-anak/get`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {
                for (let i = 1; i <= 6; i++) {
                    formAsesmenResikoJatuhAnak.find(`select[name=penilaian_humptydumpty_skala${i}]`)
                        .val(response[`penilaian_humptydumpty_skala${i}`]).trigger('change');
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
                        url: `${url}/asesmen/resiko-jatuh-anak`,
                        type: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            tanggal: tanggal
                        },
                    }).done((response) => {
                        alertSuccessAjax('Berhasil menghapus resiko jatuh dewasa')
                        renderResikoJatuhAnak(no_rawat)
                        resetFormAsesmenResikoJatuhAnak(no_rawat)
                    })
                }
            })
        }
    </script> --}}

    <script>
        const modalAsesmenResikoJatuhAnak = $('#modalAsesmenResikoJatuhAnak');
        const formAsesmenResikoJatuhAnak = $('#formAsesmenResikoJatuhAnak');
        const btnCreateAsesmenResikoJatuhAnak = $('#btnCreateAsesmenResikoJatuhAnak');
        const radioAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('input[type=radio]');
        const tableResikoJatuhAnak = $('#tableResikoJatuhAnak');

        function showModalAsesmenResikoJatuhAnak(no_rawat) {
            modalAsesmenResikoJatuhAnak.modal('show');
            resetFormAsesmenResikoJatuhAnak(no_rawat);
            renderResikoJatuhAnak(no_rawat)
            countTingkatResikoJatuhAnak();
        }

        function resetFormAsesmenResikoJatuhAnak(no_rawat) {
            formAsesmenResikoJatuhAnak.trigger('reset');
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

        function renderResikoJatuhAnak(no_rawat) {

            $.get(`${url}/asesmen/resiko-jatuh-anak/get`, {
                no_rawat: no_rawat
            }).done((response) => {
                const table = tableResikoJatuhAnak.find('tbody');
                table.empty();
                if (Object.keys(response).length === 0) {
                    return false;
                }
                const barisData = [{
                        label: "Tanggal",
                        key: "tanggal",
                        value: "",

                    }, {
                        label: 'Umur',
                        key: 'penilaian_humptydumpty_skala1',
                        value: 'penilaian_humptydumpty_nilai1'
                    }, {
                        label: 'Jenis Kelamin',
                        key: 'penilaian_humptydumpty_skala2',
                        value: 'penilaian_humptydumpty_nilai2'
                    }, {
                        label: 'Diagnosa',
                        key: 'penilaian_humptydumpty_skala3',
                        value: 'penilaian_humptydumpty_nilai3'
                    }, {
                        label: 'Gangguan Kognitif',
                        key: 'penilaian_humptydumpty_skala4',
                        value: 'penilaian_humptydumpty_nilai4'
                    }, {
                        label: 'Faktor Lingkungan',
                        key: 'penilaian_humptydumpty_skala5',
                        value: 'penilaian_humptydumpty_nilai5'
                    }, {
                        label: 'Efek Obat Penennang/Operasi/Anestesi',
                        key: 'penilaian_humptydumpty_skala6',
                        value: 'penilaian_humptydumpty_nilai6'
                    },
                    {
                        label: 'Penggunaan Obat',
                        key: 'penilaian_humptydumpty_skala7',
                        value: 'penilaian_humptydumpty_nilai7'
                    },
                    {
                        label: 'Nilai Total',
                        key: 'penilaian_humptydumpty_totalnilai',
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
                        headerRow.append($("<th width=15%></th>").text("Asesmen Awal"));
                    } else {
                        headerRow.append($("<th width=15%></th>").text("Asesmen Ulang"));
                    }
                })

                table.append(headerRow);

                barisData.forEach(item => {
                    const baris = $("<tr></tr>");
                    baris.append($(`<th width="2%"></th>`).text(item.label));
                    table.append(baris);
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
                            case 'penilaian_humptydumpty_totalnilai':
                                if (data[item.key] <= 11) {
                                    values.push(`<strong class="text-success">${data[item.key]}</strong>`);
                                } else if (data[item.key] >= 12) {
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
        btnCreateAsesmenResikoJatuhAnak.on('click', () => {
            const data = getDataForm('#formAsesmenResikoJatuhAnak', ['input', 'select', 'textarea']);
            const isUpdate = formAsesmenResikoJatuhAnak.find('input[name=update]').val()

            if (isUpdate != 0) {
                updateResikoJatuhAnak(data);
                return false;
            }

            $.post(`${url}/asesmen/resiko-jatuh-anak`, data).done((response) => {
                alertSuccessAjax('Berhasil membuat resiko jatuh dewasa')
                renderResikoJatuhAnak(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat']);
                countTingkatResikoJatuhAnak(data['no_rawat']);
            }).fail((request) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `${request.responseJSON.message} <br/> <small class="text-danger" style="font-size:12px">${request.responseText.substring(0, 200)}</small>`,
                    showConfirmButton: true
                })
            })
        })


        const selectsAsesmenResikoJatuhAnak = formAsesmenResikoJatuhAnak.find('select[name^=penilaian_humptydumpty_skala]');
        selectsAsesmenResikoJatuhAnak.change((e) => {
            const nilai = $(e.target).find(':selected').data('nilai');
            const inputName = $(e.target).attr('name').replace('skala', 'nilai');
            formAsesmenResikoJatuhAnak.find(`input[name=${inputName}]`).val(nilai);
            countTingkatResikoJatuhAnak();
        });

        function countTingkatResikoJatuhAnak() {
            const skalaValues = [1, 2, 3, 4, 5, 6, 7].map(i => parseInt(formAsesmenResikoJatuhAnak.find(`input[name=penilaian_humptydumpty_nilai${i}]`).val()) || 0);
            const skalaNyeri = skalaValues.reduce((sum, val) => sum + val, 0);
            let hasilResiko, tindakanResiko, textColor;
            $('.intervensiResikoAnak1, .intervensiResiko2').addClass('d-none');
            if (parseInt(skalaNyeri) <= 11) {

                hasilResiko = 'Resiko Rendah (7-11)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar';
                textColor = 'green';
                $('.intervensiResikoAnak1').removeClass('d-none');
            } else if (parseInt(skalaNyeri) > 11) {
                hasilResiko = 'Resiko Tinggi (12-23)';
                tindakanResiko = 'Intervensi pencegahan resiko jatuh tinggi';
                textColor = 'red';
                $('.intervensiResiko2').removeClass('d-none');
            }
            $('.intervensiResikoAnak').html(`${hasilResiko} <br/> ${tindakanResiko}`);
            $('.intervensiResikoAnak').css('color', textColor);
            formAsesmenResikoJatuhAnak.find('input[name=penilaian_humptydumpty_totalnilai]').val(skalaNyeri);
            formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').text(`${hasilResiko} : ${tindakanResiko}`);
        }


        const chekIntervensiAnak = formAsesmenResikoJatuhAnak.find('.check_intervensi_pencegahan_anak');

        chekIntervensiAnak.change((e) => {

            const check = formAsesmenResikoJatuhAnak.find('input[name=intervensi_pencegahan_anak]:checked');
            const arrayChecked = check.serializeArray();
            const value = arrayChecked.map((item) => item.value).join(';\n');
            const textareaSaran = formAsesmenResikoJatuhAnak.find('textarea[name=saran]')
            textareaSaran.empty().text(value)

        });

        function getResikoJatuhAnak(no_rawat, tanggal) {
            $.get(`${url}/asesmen/resiko-jatuh-anak/get`, {
                no_rawat: no_rawat,
                tanggal: tanggal
            }).done((response) => {

                for (let i = 1; i <= 7; i++) {
                    formAsesmenResikoJatuhAnak.find(`select[name=penilaian_humptydumpty_skala${i}]`)
                        .val(response[`penilaian_humptydumpty_skala${i}`]).trigger('change');
                }
                formAsesmenResikoJatuhAnak.find('textarea[name=hasil_skrining]').text(response.hasil_skrining);
                formAsesmenResikoJatuhAnak.find('textarea[name=saran]').text(response.saran);
                const dateTimeSplit = response.tanggal.split(' ');
                const date = splitTanggal(dateTimeSplit[0]);
                const time = dateTimeSplit[1];
                formAsesmenResikoJatuhAnak.find('input[name=tanggal]').val(`${date} ${time}`);
                formAsesmenResikoJatuhAnak.find('input[name=update]').val(1);
                response.saran.split(';\n').forEach((item) => {
                    formAsesmenResikoJatuhAnak.find(`input[type=checkbox][value="${item}"]`).each(function() {
                        const checkbox = $(this);
                        if (!checkbox.closest('.d-none').length) {
                            checkbox.prop('checked', true);
                        }
                    });
                });

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
                        url: `${url}/asesmen/resiko-jatuh-anak`,
                        type: 'DELETE',
                        data: {
                            no_rawat: no_rawat,
                            tanggal: tanggal
                        },
                    }).done((response) => {
                        alertSuccessAjax('Berhasil menghapus resiko jatuh dewasa')
                        renderResikoJatuhAnak(no_rawat)
                        resetFormAsesmenResikoJatuhAnak(no_rawat)
                    })
                }
            })
        }

        function updateResikoJatuhAnak(data) {
            $.ajax({
                url: `${url}/asesmen/resiko-jatuh-anak`,
                type: 'PUT',
                data: data
            }).done((response) => {
                alertSuccessAjax('Berhasil mengubah resiko jatuh dewasa')
                renderResikoJatuhAnak(data['no_rawat']);
                resetFormAsesmenResikoJatuhAnak(data['no_rawat'])
            }).fail((error) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `${request.responseJSON.message} <br/> <small class="text-danger" style="font-size:12px">${request.responseText.substring(0, 200)}</small>`,
                    showConfirmButton: true
                })
            })
        }
    </script>
@endpush
