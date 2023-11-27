<form action="" id="formAsmedRanapKandungan" class="form-asmed-kandungan">
    <div class="row" style="font-size: 12px">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="pasien">
                    Pasien
                </label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="kandungan_no_rawat" name="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <div class="input-group">
                            <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="kandungan_pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                            <button class="btn btn-sm btn-outline-secondary" type="button" name="riwayatAsmedRanap"><i class="bi bi-search"></i></button>

                        </div>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm kandungan_tgl_lahir" id="kandungan_tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="dokter">Dokter</label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="search" class="form-control form-control-sm kandungan_kd_dokter" placeholder="" aria-label="" id="kandungan_kd_dokter" name="kd_dokter" readonly>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" class="form-control form-control-sm kandungan_dokter" placeholder="" aria-label="" id="kandungan_dokter" name="nm_dokter">
                        <div class="list-dokter"></div>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <div class="input-group">
                            <select class="form-select form-select-sm" id="kandungan_anamnesis" name="anamnesis" style="font-size: 12px">
                                <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                <option value="Alloanamnesis">Alloanamnesis</option>
                            </select>
                            <input type="search" class="form-control form-control-sm kandungan_hubungan" placeholder="" aria-label="" id="kandungan_hubungan" name="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            <div class="separator m-2">2. Pemeriksaan Fisik <a href="javascript:void(0)" class="badge text-bg-primary srcPemeriksaanAsmed" style="margin-left:10px"><i class="bi bi-search"></i></a></div>
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
                        <option value="Apatis">Apatis</option>
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
                    <label for="spo">SpO2(%)</label>
                    <input type="text" class="form-control form-control-sm" id="kandungan_spo" name="spo" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
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
                                <select class="form-select" name="thoraks" id="kandungan_thoraks">
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
                    <input type="text" class="form-control form-control-sm" id="kandungan_tfu" name="tfu" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                </div>
                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                    <label for="tbj">TBJ (gram)</label>
                    <input type="text" class="form-control form-control-sm" id="kandungan_tbj" name="tbj" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                </div>
                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                    <label for="his">HIS (x/10 mnt)</label>
                    <input type="text" class="form-control form-control-sm" id="kandungan_his" name="his" placeholder=""
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
                    <input type="text" class="form-control form-control-sm" id="kandungan_djj" name="djj" placeholder=""
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

@push('script')
    <script>
        function simpanAsmedRanapKandungan() {
            let element = ['input', 'select', 'textarea'];
            let exclude = ['pasien', 'nm_dokter', 'tgl_lahir', ''];
            data = getDataForm('#formAsmedRanapKandungan', element, exclude);
            getAsmedRanapKandungan(data.no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    updateAsmedRanapKandungan(data).done((response) => {
                        alertSuccessAjax('Berhasil mengubah asesmen medis').then(() => {
                            const tableRanap = $('#tb_ranap');
                            if (tableRanap) {
                                $('#tb_ranap').DataTable().destroy()
                                tb_ranap();
                            }
                        })
                    }).fail((request) => {
                        alertErrorAjax(request)
                    })
                } else {
                    createAsmedRanapKandungan(data).done((response) => {
                        alertSuccessAjax('Berhasil menambah asesmen medis').then(() => {
                            const tableRanap = $('#tb_ranap');
                            if (tableRanap) {
                                $('#tb_ranap').DataTable().destroy()
                                tb_ranap();
                            }
                        })
                    }).fail((request) => {
                        alertErrorAjax(request)
                    })
                }
            })
        }

        function updateAsmedRanapKandungan(data) {
            const updateAsmed = $.ajax({
                url: '/erm/asmed/ranap/kandungan/ubah',
                data: data,
                method: 'POST',
            });

            return updateAsmed;
        }

        function createAsmedRanapKandungan(data) {
            const createAsmed = $.ajax({
                url: '/erm/asmed/ranap/kandungan/simpan',
                data: data,
                method: 'POST',
                success: (response) => {
                    alertSuccessAjax('Berhasil membuat asesmen medis').then(() => {
                        $('#tb_ranap').DataTable().destroy()
                        tb_ranap();
                        $('#modalRiwayatAsmed').modal('hide')
                    })
                },
                error: (request) => {
                    alertErrorAjax(request);
                }
            });
            return createAsmed;
        }
    </script>
@endpush
