<form action="" class="form-asmed-anak" id="formAsmedRanapAnak">
    <div class="row" style="font-size: 12px">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="pasien">
                    Pasien
                </label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="anak_no_rawat" name="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <div class="input-group">
                            <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" name="pasien" id="anak_pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                            <button class="btn btn-sm btn-outline-secondary" type="button" name="riwayatAsmedRanap"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm anak_tgl_lahir" name="tgl_lahir" id="anak_tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="dokter">Dokter</label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="search" class="form-control form-control-sm anak_kd_dokter" placeholder="" aria-label="" id="anak_kd_dokter" name="kd_dokter" readonly>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" class="form-control form-control-sm anak_dokter" placeholder="" aria-label="" id="anak_dokter" name="nm_dokter">
                        <div class="list-dokter"></div>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <div class="input-group">
                            <select class="form-select form-select-sm" id="anak_anamnesis" style="font-size: 12px" name="anamnesis">
                                <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                <option value="Alloanamnesis">Alloanamnesis</option>
                            </select>
                            <input type="search" class="form-control form-control-sm anak_hubungan" placeholder="" aria-label="" id="anak_hubungan" name="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
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
                    <textarea class="form-control" name="keluhan_utama" id="anak_keluhan_utama" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rps">Riwayat Penyakit Sekarang</label>
                    <textarea class="form-control" name="rps" id="anak_rps" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                    <textarea class="form-control" name="rpd" id="anak_rpd" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                    <textarea class="form-control" name="rpk" id="anak_rpk" cols="30" rows="2"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpo">Riwayat Penggunaan Obat</label>
                    <textarea class="form-control" name="rpo" id="anak_rpo" cols="30" rows="2"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpk">Alergi</label>
                    <input type="text" class="form-control form-control-sm" id="anak_alergi" name="alergi" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                </div>


            </div>
            <div class="separator m-2">2. Pemeriksaan Fisik <a href="javascript:void(0)" class="badge text-bg-primary srcPemeriksaanAsmed" style="margin-left:10px"><i class="bi bi-search"></i></a></div>
            <div class="row">
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="">Keadaan Umum:</label>
                    <select class="form-select" name="keadaan" id="anak_keadaan">
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit Ringan">Sakit Ringan</option>
                        <option value="Sakit Sedang">Sakit Sedang</option>
                        <option value="Sakit Berat">Sakit Berat</option>
                    </select>
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="">Kesadaran :</label>
                    <select class="form-select" name="kesadaran" id="anak_kesadaran">
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolence">Somnolence</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Coma">Coma</option>
                    </select>
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="gcs">GCS(E,V,M)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_gcs" name="gcs" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="tb">TB (cm)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_tb" name="tb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="bb">BB (Kg)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_bb" name="bb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="td">TD (mmHg)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_td" name="td" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="nadi">Nadi (x/menit)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_nadi" name="nadi" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="rr">RR (x/menit)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_rr" name="rr" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="suhu">Suhu (<sup>0</sup>C)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_suhu" name="suhu" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="spo2">SpO2(%)</label>
                    <input type="text" class="form-control form-control-sm" id="anak_spo" name="spo" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Kepala :</label>
                    <select class="form-select" name="kepala" id="anak_kepala">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Mata :</label>
                    <select class="form-select" name="mata" id="anak_mata">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Gigi & Mulut :</label>
                    <select class="form-select" name="gigi" id="anak_gigi">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">THT :</label>
                    <select class="form-select" name="tht" id="anak_tht">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Thoraks :</label>
                    <select class="form-select" name="thoraks" id="anak_thorax">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Jantung :</label>
                    <select class="form-select" name="jantung" id="anak_jantung">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Paru :</label>
                    <select class="form-select" name="paru" id="anak_paru">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Abdomen :</label>
                    <select class="form-select" name="abdomen" id="anak_abdomen">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Genital :</label>
                    <select class="form-select" name="genital" id="anak_genital">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Ekstrimitas :</label>
                    <select class="form-select" name="ekstremitas" id="anak_ekstremitas">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                    <label for="">Kulit :</label>
                    <select class="form-select" name="kulit" id="anak_kulit">
                        <option value="Normal">Normal</option>
                        <option value="Abnormal">Abnormal</option>
                        <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="ket_fisik">Keterangan Fisik</label>
                    <textarea class="form-control" name="ket_fisik" id="anak_ket_fisik" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="separator m-2">3. Status Lokalis</div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <img src="{{ asset('/img/set-lokalis.jpg') }}" class="mx-auto d-block" style="max-width: 65%; height:auto">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label for="keluhan">Keterangan Lokalis</label>
                    <textarea class="form-control" name="ket_lokalis" id="anak_ket_lokalis" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>

            </div>
            <div class="separator m-2">4. Pemeriksaan Penunjang</div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="lab">Laboratorium</label>
                    <textarea class="form-control" name="lab" id="anak_lab" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="rad">Radiologi</label>
                    <textarea class="form-control" name="rad" id="anak_rad" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="penunjang">Penunjang Lainnya</label>
                    <textarea class="form-control" name="penunjang" id="anak_penunjang" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">5. Diagnosis / Asesmen</div>
                    <textarea class="form-control" name="diagnosis" id="anak_diagnosis" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">6. Tata Laksana</div>
                    <textarea class="form-control" name="tata" id="anak_tata" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">7. Edukasi</div>
                    <textarea class="form-control" name="edukasi" id="anak_edukasi" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
        </div>
    </div>
</form>
@push('script')
    <script>
        function simpanAsmedRanapAnak() {
            let element = ['input', 'select', 'textarea'];
            let exclude = ['pasien', 'nm_dokter', 'tgl_lahir', ''];
            data = getDataForm('#formAsmedRanapAnak', element, exclude);
            getAsmedRanapAnak(data.no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    updateAsmedRanapAnak(data).done((response) => {
                        alertSuccessAjax('Berhasil mengubah asesmen medis').then(() => {
                            $('#tb_ranap').DataTable().destroy()
                            tb_ranap();
                        })
                    }).fail((request) => {
                        alertErrorAjax(request)
                    })
                } else {
                    createAsmedRanapAnak(data).done((response) => {
                        alertSuccessAjax('Berhasil mengubah asesmen medis').then(() => {
                            $('#tb_ranap').DataTable().destroy()
                            tb_ranap();
                        })
                    }).fail((request) => {
                        alertErrorAjax(request)
                    })
                }
            })
        }

        function updateAsmedRanapAnak(data) {
            const updateAsmed = $.ajax({
                url: '/erm/asmed/ranap/anak/ubah',
                data: data,
                method: 'POST',
            });

            return updateAsmed;
        }

        function createAsmedRanapAnak(data) {
            const createAsmed = $.ajax({
                url: '/erm/asmed/ranap/anak/simpan',
                data: data,
                method: 'POST',
            });
            return createAsmed;
        }
    </script>
@endpush
