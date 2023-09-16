<div class="modal fade" id="modalResumeRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">RESUME MEDIS RAWAT INAP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formResumeRanap">
                    <div class="row" style="font-size: 12px">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="pasien">
                                    Pasien
                                </label>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="no_rawat" name="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-2">
                                        <label for="dokter">Dokter</label>
                                        <input type="search" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" name="kd_dokter" readonly>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <label for="kd_dokter"></label>
                                        <input type="search" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="dokter" readonly>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                        <label for="kamar">Kamar & Pembiayaan</label>
                                        <input type="search" class="form-control form-control-sm kamar" placeholder="" aria-label="" id="kamar" name="kamar" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-4 col-lg-2">
                                        <label for="tgl_masuk">Tgl. Masuk</label>
                                        <input type="search" class="form-control form-control-sm tgl_masuk" placeholder="" aria-label="" id="tgl_masuk" name="tgl_masuk" readonly>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-4 col-lg-2">
                                        <label for="tgl_masuk">Tgl. Keluar</label>
                                        <input type="search" class="form-control form-control-sm tgl_keluar" placeholder="" aria-label="" id="tgl_keluar" name="tgl_keluar" readonly>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-4 col-lg-3">
                                        <label for="diagnosa_awal">Diagnosa Awal</label>
                                        <input type="search" class="form-control form-control-sm diagnosa_awal" placeholder="" aria-label="" id="diagnosa_awal" name="diagnosa_awal">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-4 col-lg-3">
                                        <label for="alasan">Alasan Masuk Dirawat</label>
                                        <input type="search" class="form-control form-control-sm alasan" placeholder="" aria-label="" id="alasan" name="alasan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            <div class="row">
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="keluhan">Keluhan Utama <a href="javascript:void(0)" id="srcKeluhan" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="keluhan_utama" id="keluhan_utama" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="pemeriksaan_fisik">Pemeriksaan Fisik <a href="javascript:void(0)" id="srcPemeriksaan" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="pemeriksaan_fisik" id="pemeriksaan_fisik" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="jalannya_penyakit">Jalannya Penyakit Selama Perawatan <a href="javascript:void(0)" id="srcPenyakit" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="jalannya_penyakit" id="jalannya_penyakit" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="pemeriksaan_penunjang">Pemeriksaan Radiologi Terpenting <a href="javascript:void(0)" id="srcRadiologi" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="pemeriksaan_penunjang" id="pemeriksaan_penunjang" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="hasil_lanorat">Pemeriksaan Laborat Terpenting <a href="javascript:void(0)" id="srcLab" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="hasil_laborat" id="hasil_laborat" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="tindakan_dan_operasi">Tindakan/Operasi Selama Perawatan <a href="javascript:void(0)" id="srcTindakan" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="tindakan_dan_operasi" id="tindakan_dan_operasi" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-12 col-lg-12">
                                    <label for="obat_di_rs">Obat-obatan Selama Perwatan <a href="javascript:void(0)" id="srcLab" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="obat_di_rs" id="obat_di_rs" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">2. Diagnosa</div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="diagnosa_utama" class="mt-2">Diagnosa Utama</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="diagnosa_utama" id="diagnosa_utama" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_diagnosa_utama" id="kode_diagnosa_utama" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="diagnosa_skunder1" class="mt-2">Diagnosa Skunder 1</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="diagnosa_skunder1" id="diagnosa_skunder1" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_diagnosa_skunder1" id="kode_diagnosa_skunder1" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="diagnosa_skunder2" class="mt-2">Diagnosa Skunder 2</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="diagnosa_skunder2" id="diagnosa_skunder2" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_diagnosa_skunder2" id="kode_diagnosa_skunder2" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="diagnosa_skunder3" class="mt-2">Diagnosa Skunder 3</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="diagnosa_skunder3" id="diagnosa_skunder3" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_diagnosa_skunder3" id="kode_diagnosa_skunder3" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="diagnosa_skunder4" class="mt-2">Diagnosa Skunder 4</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="diagnosa_skunder4" id="diagnosa_skunder4" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_diagnosa_skunder4" id="kode_diagnosa_skunder4" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>


                            </div>
                            <div class="separator m-2">3. Prosedur</div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="prosedur_utama" class="mt-2">Prosedur Utama</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="prosedur_utama" id="prosedur_utama" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_prosedur_utama" id="kode_prosedur_utama" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="prosedur_skunder1" class="mt-2">Prosedur Skunder 1</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="prosedur_skunder1" id="prosedur_skunder1" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_prosedur_skunder1" id="kode_prosedur_skunder1" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="prosedur_skunder2" class="mt-2">Diagnosa Skunder 2</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="prosedur_skunder2" id="prosedur_skunder2" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_prosedur_skunder2" id="kode_prosedur_skunder2" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                                <div class="col-sm-12 col-md-4 col-lg-3 mb-2">
                                    <label for="prosedur_skunder3" class="mt-2">Diagnosa Skunder 3</label>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                    <input class="form-control" name="prosedur_skunder3" id="prosedur_skunder3" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                                    <input class="form-control" name="kode_prosedur_skunder3" id="kode_prosedur_skunder3" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>

                            </div>

                            <div class="row">
                                <div class="separator m-2"></div>
                                <div class="mb-2 col-sm-12 col-md-12 col-lg-12">
                                    <label for="edukasi">Instruksi/Anjuran dan Edukasi (Follow up)</label>
                                    <textarea class="form-control" name="edukasi" id="edukasi" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                        <label for="keadaan">Keadaan Pulang</label>
                                        <select class="form-select" name="keadaan" id="keadaan">
                                            <option value="Membaik">Membaik</option>
                                            <option value="Sembuh">Sembuh</option>
                                            <option value="Keadaan Khusus">Keadaan Khusus</option>
                                            <option value="Meninggal">Meninggal</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                        <label for="ket_keadaan"></label>
                                        <select class="form-select" name="ket_keadaan" id="ket_keadaan">
                                            <option value="SANAM">SANAM</option>
                                            <option value="BOLAM">BOLAM</option>
                                            <option value="MALAM">MALAM</option>
                                            <option value="BUBIA">BUBIA</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <label for="cara_keluar">Cara Keluar</label>
                                        <select class="form-select" name="cara_keluar" id="cara_keluar">
                                            <option value="Atas Izin Dokter">Atas Izin Dokter</option>
                                            <option value="Pindah RS">Pindah RS</option>
                                            <option value="Pulang Atas Permintaan Sendiri">Pulang Atas Permintaan Sendiri</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-2">
                                        <label for="ket_cara_keluar"></label>
                                        <input class="form-control" name="ket_cara_keluar" id="ket_cara_keluar" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <label for="dilanjutkan">Dilanjutkan</label>
                                    <select class="form-select" name="dilanjutkan" id="dilanjutkan">
                                        <option value="Kembali Ke RS">Kembali Ke RS</option>
                                        <option value="RS Lain">RS Lain</option>
                                        <option value="Dokter Luar">Dokter Luar</option>
                                        <option value="Puskesmas">Puskesmas</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <label for="ket_dilanjutkan"></label>
                                    <input class="form-control" name="ket_dilanjutkan" id="ket_dilanjutkan" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                    <label for="kontrol">Tanggal & Jam Kontrol</label>
                                    <input class="form-control" name="kontrol" id="kontrol" onfocus="removeZero(this)" onblur="cekKosong(this)" value='-' />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-2 col-sm-12 col-md-12 col-lg-12">
                                    <label for="obat_pulang">Obat Pulang <a href="javascript:void(0)" id="srcObat" class="badge text-bg-primary"><i class="bi bi-search"></i></a></label>
                                    <textarea class="form-control" name="obat_pulang" id="obat_pulang" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm btn-asmed-anak" onclick="" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-sm btn-asmed-anak-ubah" onclick="" style="font-size: 12px"><i class="bi bi-pencil"></i> Ubah</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function resumeMedis(noRawat) {
            console.log(noRawat);
            getRegPeriksa(noRawat).done((response) => {
                console.log(response);


                $('#formResumeRanap input[name=no_rawat]').val(response.no_rawat);
                $('#formResumeRanap input[name=pasien]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`);
                $('#formResumeRanap input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} (${hitungUmur(response.pasien.tgl_lahir)})`);
                $('#formResumeRanap input[name=kd_dokter]').val(`${response.dokter.kd_dokter}`);
                $('#formResumeRanap input[name=dokter]').val(`${response.dokter.nm_dokter}`);
                $.map(response.kamar_inap, (inap) => {
                    tgl_keluar = inap.tgl_keluar == '0000-00-00' ? `${inap.tgl_keluar} ${inap.jam_keluar}` : `${formatTanggal(inap.tgl_keluar)} ${inap.jam_keluar} `;
                    $('#formResumeRanap input[name=kamar]').val(`${inap.kamar.bangsal.nm_bangsal} ( ${response.penjab.png_jawab} )`);
                    $('#formResumeRanap input[name=tgl_masuk]').val(`${formatTanggal(inap.tgl_masuk)} ${inap.jam_masuk}`);
                    $('#formResumeRanap input[name=tgl_keluar]').val(`${tgl_keluar}`);
                    $('#formResumeRanap input[name=diagnosa_awal]').val(`${inap.diagnosa_awal}`);
                })

                $.map(response.diagnosa_pasien, (diagnosa) => {
                    if (diagnosa.prioritas == 1) {
                        $('#formResumeRanap input[name=diagnosa_utama]').val(diagnosa.penyakit.nm_penyakit)
                        $('#formResumeRanap input[name=kode_diagnosa_utama]').val(diagnosa.kd_penyakit)
                    }
                })
                // set action pencarian
                $('#formResumeRanap #srcKeluhan').attr('onclick', `listKeluhan('${response.no_rawat}')`);
                $('#formResumeRanap #srcPemeriksaan').attr('onclick', `listPemeriksaan('${response.no_rawat}')`);
            })
            $('#modalResumeRanap').modal('show')
        }
        $(function() {
            $('#kontrol').datetimepicker();
        });
    </script>
@endpush
