<div class="modal fade" id="modalAsmedRanapKandungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN MEDIS KANDUNGAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsmedKandunganRanap">
                    <div class="row" style="font-size: 12px">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="pasien">
                                    Pasien
                                </label>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="kandungan_no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="kandungan_pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm kandungan_tgl_lahir" id="kandungan_tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="dokter">Dokter</label>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                        <input type="search" class="form-control form-control-sm kandungan_kd_dokter" placeholder="" aria-label="" id="kandungan_kd_dokter" readonly>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="search" class="form-control form-control-sm kandungan_dokter" placeholder="" aria-label="" id="kandungan_dokter">
                                        <div class="list-dokter"></div>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" id="kandungan_anamnesis" style="font-size: 12px">
                                                <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                                <option value="Alloanamnesis">Alloanamnesis</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm kandungan_hubungan" placeholder="" aria-label="" id="kandungan_hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="keluhan">Keluhan Utama</label>
                                    <textarea class="form-control" name="keluhan_utama" id="kandungan_keluhan_utama" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rps">Riwayat Penyakit Sekarang</label>
                                    <textarea class="form-control" name="rps" id="kandungan_rps" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                                    <textarea class="form-control" name="rpd" id="kandungan_rpd" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                                    <textarea class="form-control" name="rpk" id="kandungan_rpk" cols="30" rows="2"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpo">Riwayat Penggunaan Obat</label>
                                    <textarea class="form-control" name="rpo" id="kandungan_rpo" cols="30" rows="2"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpk">Alergi</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_alergi" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>


                            </div>
                            <div class="separator m-2">2. Pemeriksaan Fisik</div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="">Keadaan Umum:</label>
                                    <select class="form-select" name="keadaan" id="kandungan_keadaan">
                                        <option value="Sehat">Sehat</option>
                                        <option value="Sakit Ringan">Sakit Ringan</option>
                                        <option value="Sakit Sedang">Sakit Sedang</option>
                                        <option value="Sakit Berat">Sakit Berat</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="">Kesadaran :</label>
                                    <select class="form-select" name="kesadaran" id="kandungan_kesadaran">
                                        <option value="Compos Mentis">Compos Mentis</option>
                                        <option value="Somnolence">Somnolence</option>
                                        <option value="Sopor">Sopor</option>
                                        <option value="Coma">Coma</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="gcs">GCS(E,V,M)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_gcs" name="gcs" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="tb">TB (cm)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_tb" name="tb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="bb">BB (Kg)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_bb" name="bb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="td">TD (mmHg)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_td" name="td" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="nadi">Nadi (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_nadi" name="nadi" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="rr">RR (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_rr" name="rr" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="suhu">Suhu (<sup>0</sup>C)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_suhu" name="suhu" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="spo2">SpO2(%)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_spo" name="spo2" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Kepala :</label>
                                                <select class="form-select" name="kepala" id="kandungan_kepala">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Mata :</label>
                                                <select class="form-select" name="mata" id="kandungan_mata">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Gigi & Mulut :</label>
                                                <select class="form-select" name="gigi" id="kandungan_gigi">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">THT :</label>
                                                <select class="form-select" name="tht" id="kandungan_tht">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Thorax :</label>
                                                <select class="form-select" name="thorax" id="kandungan_thorax">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Jantung :</label>
                                                <select class="form-select" name="jantung" id="kandungan_jantung">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Paru :</label>
                                                <select class="form-select" name="paru" id="kandungan_paru">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Abdomen :</label>
                                                <select class="form-select" name="abdomen" id="kandungan_abdomen">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Genital :</label>
                                                <select class="form-select" name="genital" id="kandungan_genital">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Ekstrimitas :</label>
                                                <select class="form-select" name="ekstremitas" id="kandungan_ekstremitas">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Kulit :</label>
                                                <select class="form-select" name="kulit" id="kandungan_kulit">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <label for="ket_fisik">Keterangan Fisik</label>
                                                <textarea class="form-control" name="ket_fisik" id="kandungan_ket_fisik" cols="30" rows="10" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">3. Status Obstetri / Ginekologi</div>
                            <div class="row">
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="tfu">TFU (cm)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_tfu" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="tbj">TBJ (gram)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_tbj" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="his">HIS (x/10 mnt)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_his" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-4">
                                    <label for="kontraksi">Kontraksi</label>
                                    <select class="form-select" name="kontraksi" id="kandungan_kontraksi">
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="djj">DJJ (Dpm)</label>
                                    <input type="text" class="form-control form-control-sm" id="kandungan_djj" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="inspeksi">Inspeksi</label>
                                    <textarea class="form-control" name="inspeksi" id="kandungan_inspeksi" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="vt">VT</label>
                                    <textarea class="form-control" name="vt" id="kandungan_vt" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="inspekulo">Inspekulo</label>
                                    <textarea class="form-control" name="inspekulo" id="kandungan_inspekulo" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="rt">RT</label>
                                    <textarea class="form-control" name="rt" id="kandungan_rt" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>

                            </div>
                            <div class="separator m-2">4. Pemeriksaan Penunjang</div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="ultra">Ultrasonografi</label>
                                    <textarea class="form-control" name="ultra" id="kandungan_ultra" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="kardio">Kardiotografi</label>
                                    <textarea class="form-control" name="kardio" id="kandungan_kardio" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="lab">Laboratorium</label>
                                    <textarea class="form-control" name="lab" id="kandungan_lab" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">5. Diagnosis / Asesmen</div>
                                    <textarea class="form-control" name="diagnosis" id="kandungan_diagnosis" cols="30" rows="8"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">6. Tata Laksana</div>
                                    <textarea class="form-control" name="tata" id="kandungan_tata" cols="30" rows="8"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">7. Edukasi</div>
                                    <textarea class="form-control" name="edukasi" id="kandungan_edukasi" cols="30" rows="8"
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
                <button type="button" class="btn btn-primary btn-sm btn-asmed-kandungan" onclick="" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-sm btn-asmed-kandungan-ubah" onclick="" style="font-size: 12px"><i class="bi bi-pencil"></i> Ubah</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('.kandungan_dokter').on('keyup', (e) => {
            dokter = $('.kandungan_dokter').val();
            if (dokter.length >= 3) {
                getDokter(dokter).done((response) => {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.kd_dokter + '" data-nama="' + data.nm_dokter + '" class="dropdown-item" onclick="setDokterAsmed(this, \'#kandungan_kd_dokter\', \'#kandungan_dokter\')">' + data.nm_dokter + '</a>'
                        html += '</li>'
                    })
                    html += '</ul>';
                    $('.list-dokter').fadeIn();
                    $('.list-dokter').html(html);
                })
            }
        });


        function setDokterAsmed(param, id, dokter) {
            kd_dokter = $(param).data('id')
            nm_dokter = $(param).data('nama')

            $(id).val(kd_dokter)
            $(dokter).val(nm_dokter)
            $('.list-dokter').fadeOut();
        }

        $('#modalAsmedRanapKandungan').on('hidden.bs.modal', () => {
            $('#kandungan_no_rawat').val('-');
            $('#kandungan_pasien').val('-');
            $('#kandungan_tgl_lahir').val('-');
            $('#kandungan_kd_dokter').val('-');
            $('#kandungan_dokter').val('-');
            $('#kandungan_anamnesis').val('Autoanamnesis').change();
            $('#kandungan_hubungan').val('-');
            $('#kandungan_keluhan_utama').val('-');
            $('#kandungan_rps').val('-');
            $('#kandungan_rpd').val('-');
            $('#kandungan_rpk').val('-');
            $('#kandungan_rpo').val('-');
            $('#kandungan_alergi').val('-');
            $('#kandungan_keadaan').val('Sehat').change();
            $('#kandungan_gcs').val('-');
            $('#kandungan_kesadaran').val('Compos Mentis').change();
            $('#kandungan_td').val('-');
            $('#kandungan_nadi').val('-');
            $('#kandungan_rr').val('-');
            $('#kandungan_suhu').val('-');
            $('#kandungan_spo').val('-');
            $('#kandungan_bb').val('-');
            $('#kandungan_tb').val('-');
            $('#kandungan_kepala').val('Normal').change();
            $('#kandungan_mata').val('Normal').change();
            $('#kandungan_gigi').val('Normal').change();
            $('#kandungan_tht').val('Normal').change();
            $('#kandungan_gigi').val('Normal').change();
            $('#kandungan_jantung').val('Normal').change();
            $('#kandungan_paru').val('Normal').change();
            $('#kandungan_abdomen').val('Normal').change();
            $('#kandungan_genital').val('Normal').change();
            $('#kandungan_ekstremitas').val('Normal').change();
            $('#kandungan_kulit').val('Normal').change();
            $('#kandungan_ket_fisik').val('-');
            $('#kandungan_tfu').val('-');
            $('#kandungan_tbj').val('-');
            $('#kandungan_kontraksi').val('Ada').change();
            $('#kandungan_his').val('-');
            $('#kandungan_djj').val('-');
            $('#kandungan_inspeksi').val('-');
            $('#kandungan_inspekulo').val('-');
            $('#kandungan_vt').val('-');
            $('#kandungan_rt').val('-');
            $('#kandungan_ultra').val('-');
            $('#kandungan_kardio').val('-');
            $('#kandungan_lab').val('-');
            $('#kandungan_diagnosis').val('-');
            $('#kandungan_tata').val('-');
            $('#kandungan_edukasi').val('-');
        });

        $('.btn-asmed-kandungan').on('click', () => {
            data = {
                no_rawat: $('#kandungan_no_rawat').val(),
                kd_dokter: $('#kandungan_kd_dokter').val(),
                anamnesis: $('#kandungan_anamnesis option:selected').val(),
                hubungan: $('#kandungan_hubungan').val(),
                keluhan_utama: $('#kandungan_keluhan_utama').val(),
                rps: $('#kandungan_rps').val(),
                rpd: $('#kandungan_rpd').val(),
                rpk: $('#kandungan_rpk').val(),
                rpo: $('#kandungan_rpo').val(),
                alergi: $('#kandungan_alergi').val(),
                keadaan: $('#kandungan_keadaan option:selected').val(),
                gcs: $('#kandungan_gcs').val(),
                kesadaran: $('#kandungan_kesadaran option:selected').val(),
                td: $('#kandungan_td').val(),
                nadi: $('#kandungan_nadi').val(),
                rr: $('#kandungan_rr').val(),
                suhu: $('#kandungan_suhu').val(),
                spo: $('#kandungan_spo').val(),
                bb: $('#kandungan_bb').val(),
                tb: $('#kandungan_tb').val(),
                kepala: $('#kandungan_kepala').val(),
                mata: $('#kandungan_mata option:selected').val(),
                gigi: $('#kandungan_gigi option:selected').val(),
                tht: $('#kandungan_tht option:selected').val(),
                gigi: $('#kandungan_gigi option:selected').val(),
                jantung: $('#kandungan_jantung option:selected').val(),
                paru: $('#kandungan_paru option:selected').val(),
                abdomen: $('#kandungan_abdomen option:selected').val(),
                genital: $('#kandungan_genital option:selected').val(),
                ekstremitas: $('#kandungan_ekstremitas option:selected').val(),
                kulit: $('#kandungan_kulit option:selected').val(),
                ket_fisik: $('#kandungan_ket_fisik').val(),
                tfu: $('#kandungan_tfu').val(),
                tbj: $('#kandungan_tbj').val(),
                his: $('#kandungan_his').val(),
                kontraksi: $('#kandungan_kontraksi option:selected').val(),
                djj: $('#kandungan_djj').val(),
                inspeksi: $('#kandungan_inspeksi').val(),
                vt: $('#kandungan_vt').val(),
                inspekulo: $('#kandungan_inspekulo').val(),
                rt: $('#kandungan_rt').val(),
                lab: $('#kandungan_lab').val(),
                ultra: $('#kandungan_ultra').val(),
                kardio: $('#kandungan_kardio').val(),
                diagnosis: $('#kandungan_diagnosis').val(),
                tata: $('#kandungan_tata').val(),
                edukasi: $('#kandungan_edukasi').val(),
            }
            data._token = "{{ csrf_token() }}";
            console.log(data)
            $.ajax({
                url: '/erm/asmed/ranap/kandungan/simpan',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses !',
                    text: 'Data berhasil berhasil ditambah',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#modalAsmedRanapKandungan').modal('hide')
            });
        })
        $('.btn-asmed-kandungan-ubah').on('click', () => {
            data = {
                no_rawat: $('#kandungan_no_rawat').val(),
                kd_dokter: $('#kandungan_kd_dokter').val(),
                anamnesis: $('#kandungan_anamnesis option:selected').val(),
                hubungan: $('#kandungan_hubungan').val(),
                keluhan_utama: $('#kandungan_keluhan_utama').val(),
                rps: $('#kandungan_rps').val(),
                rpd: $('#kandungan_rpd').val(),
                rpk: $('#kandungan_rpk').val(),
                rpo: $('#kandungan_rpo').val(),
                alergi: $('#kandungan_alergi').val(),
                keadaan: $('#kandungan_keadaan option:selected').val(),
                gcs: $('#kandungan_gcs').val(),
                kesadaran: $('#kandungan_kesadaran option:selected').val(),
                td: $('#kandungan_td').val(),
                nadi: $('#kandungan_nadi').val(),
                rr: $('#kandungan_rr').val(),
                suhu: $('#kandungan_suhu').val(),
                spo: $('#kandungan_spo').val(),
                bb: $('#kandungan_bb').val(),
                tb: $('#kandungan_tb').val(),
                kepala: $('#kandungan_kepala').val(),
                mata: $('#kandungan_mata option:selected').val(),
                gigi: $('#kandungan_gigi option:selected').val(),
                tht: $('#kandungan_tht option:selected').val(),
                gigi: $('#kandungan_gigi option:selected').val(),
                jantung: $('#kandungan_jantung option:selected').val(),
                paru: $('#kandungan_paru option:selected').val(),
                abdomen: $('#kandungan_abdomen option:selected').val(),
                genital: $('#kandungan_genital option:selected').val(),
                ekstremitas: $('#kandungan_ekstremitas option:selected').val(),
                kulit: $('#kandungan_kulit option:selected').val(),
                ket_fisik: $('#kandungan_ket_fisik').val(),
                tfu: $('#kandungan_tfu').val(),
                tbj: $('#kandungan_tbj').val(),
                his: $('#kandungan_his').val(),
                kontraksi: $('#kandungan_kontraksi option:selected').val(),
                djj: $('#kandungan_djj').val(),
                inspeksi: $('#kandungan_inspeksi').val(),
                vt: $('#kandungan_vt').val(),
                inspekulo: $('#kandungan_inspekulo').val(),
                rt: $('#kandungan_rt').val(),
                lab: $('#kandungan_lab').val(),
                ultra: $('#kandungan_ultra').val(),
                kardio: $('#kandungan_kardio').val(),
                diagnosis: $('#kandungan_diagnosis').val(),
                tata: $('#kandungan_tata').val(),
                edukasi: $('#kandungan_edukasi').val(),
            }
            data._token = "{{ csrf_token() }}";
            console.log(data)
            $.ajax({
                url: '/erm/asmed/ranap/kandungan/ubah',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses !',
                    text: 'Data berhasil diubah',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#modalAsmedRanapKandungan').modal('hide')
            });
        })
    </script>
@endpush
