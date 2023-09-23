<div class="modal fade" id="modalAskepRanapAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN KEPERAWATAN ANAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAskepAnakRanap">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-2">
                                <label for="pasien">Pasien</label>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <input type="text" class="form-control form-control-sm no_rawat" name="no_rawat" placeholder="" aria-label="" id="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-6 col-lg-2">
                                    <label for="">Dokter DPJP</label>
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" name="kd_dokter" readonly>
                                </div>
                                <div class="col-sm-8 col-md-6 col-lg-4">
                                    <label for=""></label>
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="dokter" autocomplete="off" readonly>
                                    <div class="list-dokter"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control form-control-sm tanggal" placeholder="" aria-label="" id="tanggal" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="jam">Jam</label>
                                    <input type="text" class="form-control form-control-sm jam" placeholder="" aria-label="" id="jam" value="{{ date('H:i:s') }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="kasus_trauma">Kasus</label>
                                    <select class="form-select form-select-sm" id="kasus_trauma" style="font-size: 12px;height:28px" name="kasus_trauma">
                                        <option value="Trauma" selected>Trauma</option>
                                        <option value="Non Trauma">Non Trauma</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="nip1">Pengkaji 1</label>
                                    <input type="search" class="form-control form-control-sm nip1" placeholder="" aria-label="" id="nip1" name="nip1" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip1"></label>
                                    <input type="search" class="form-control form-control-sm pengkaji1" placeholder="" aria-label="" id="pengkaji1" name="pengkaji1" onkeyup="cariPetugasAskep(this, 1)">
                                    <div class="list_petugas1"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="nip2">Pengkaji 2</label>
                                    <input type="search" class="form-control form-control-sm nip2" placeholder="" aria-label="" id="nip2" name="nip2" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip2"></label>
                                    <input type="search" class="form-control form-control-sm pengkaji2" placeholder="" aria-label="" id="pengkaji2" name="pengkaji2" onkeyup="cariPetugasAskep(this, 2)">
                                    <div class="list_petugas2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <label for="nip2">Anamnesis</label>
                                    <div class="input-group">
                                        <select class="form-select form-select-sm" id="anamnesis" style="font-size: 12px">
                                            <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                            <option value="Alloanamnesis">Alloanamnesis</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm hubungan" placeholder="" aria-label="" id="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label for="tiba_diruang_rawat">Tiba di ruang</label>
                                    <select class="form-select form-select-sm" id="tiba_diruang_rawat" name="tiba_diruang_rawat" style="font-size: 12px;height:28px">
                                        <option value="Jalan Tanpa Bantuan" selected>Jalan Tanpa Bantuan</option>
                                        <option value="Kursi Roda">Kursi Roda</option>
                                        <option value="Brankar">Brankar</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="cara_masuk">Cara Masuk</label>
                                    <select class="form-select form-select-sm" id="cara_masuk" name="cara_masuk" style="font-size: 12px;height:28px">
                                        <option value="Poli" selected>Poli</option>
                                        <option value="IGD">IGD</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- 
                        --}}
                        {{-- <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="pasien">
                                Pasien
                            </label>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="dokter">Dokter DPJP</label>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <input type="search" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <input type="search" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter">
                                    <div class="list-dokter"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <div class="input-group">
                                        <select class="form-select form-select-sm" id="anamnesis" style="font-size: 12px">
                                            <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                            <option value="Alloanamnesis">Alloanamnesis</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm hubungan" placeholder="" aria-label="" id="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <label for="nip1">Pengkaji 1</label>
                            <input type="search" class="form-control form-control-sm nip1" placeholder="" aria-label="" id="nip1" readonly>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label for="nip"></label>
                            <input type="search" class="form-control form-control-sm pengkaji1" placeholder="" aria-label="" id="pengkaji1">
                            <div class="list-petugas-1"></div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-2">
                            <label for="nip2">Pengkaji 2</label>
                            <input type="search" class="form-control form-control-sm nip2" placeholder="" aria-label="" id="nip2" readonly>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                            <label for="nip2"></label>
                            <input type="search" class="form-control form-control-sm pengkaji2" placeholder="" aria-label="" id="pengkaji2">
                            <div class="list-petugas-2"></div>

                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-md-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="search" class="form-control form-control-sm tanggal" placeholder="" aria-label="" id="tanggal" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="col-sm-12 col-md-12 col-md-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="search" class="form-control form-control-sm tanggal" placeholder="" aria-label="" id="tanggal" value="{{ date('d-m-Y') }}">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="keluhan">Keluhan Utama</label>
                                    <textarea class="form-control" name="keluhan_utama" id="keluhan_utama" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rps">Riwayat Penyakit Sekarang</label>
                                    <textarea class="form-control" name="rps" id="rps" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                                    <textarea class="form-control" name="rpd" id="rpd" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                                    <textarea class="form-control" name="rpk" id="rpk" cols="30" rows="2" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpo">Riwayat Penggunaan Obat</label>
                                    <textarea class="form-control" name="rpo" id="rpo" cols="30" rows="2" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpk">Alergi</label>
                                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>


                            </div>
                            <div class="separator m-2">2. Pemeriksaan Fisik</div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="">Keadaan Umum:</label>
                                    <select class="form-select" name="keadaan" id="keadaan">
                                        <option value="Sehat">Sehat</option>
                                        <option value="Sakit Ringan">Sakit Ringan</option>
                                        <option value="Sakit Sedang">Sakit Sedang</option>
                                        <option value="Sakit Berat">Sakit Berat</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="">Kesadaran :</label>
                                    <select class="form-select" name="kesadaran" id="kesadaran">
                                        <option value="Compos Mentis">Compos Mentis</option>
                                        <option value="Somnolence">Somnolence</option>
                                        <option value="Sopor">Sopor</option>
                                        <option value="Coma">Coma</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="gcs">GCS(E,V,M)</label>
                                    <input type="text" class="form-control form-control-sm" id="gcs" name="gcs" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                                    <label for="tb">TB (cm)</label>
                                    <input type="text" class="form-control form-control-sm" id="tb" name="tb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="bb">BB (Kg)</label>
                                    <input type="text" class="form-control form-control-sm" id="bb" name="bb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="td">TD (mmHg)</label>
                                    <input type="text" class="form-control form-control-sm" id="td" name="td" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="nadi">Nadi (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="nadi" name="nadi" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="rr">RR (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="rr" name="rr" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="suhu">Suhu (<sup>0</sup>C)</label>
                                    <input type="text" class="form-control form-control-sm" id="suhu" name="suhu" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="spo2">SpO2(%)</label>
                                    <input type="text" class="form-control form-control-sm" id="spo" name="spo2" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row">
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Kepala :</label>
                                                <select class="form-select" name="kepala" id="kepala">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Mata :</label>
                                                <select class="form-select" name="mata" id="mata">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Gigi & Mulut :</label>
                                                <select class="form-select" name="gigi" id="gigi">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">THT :</label>
                                                <select class="form-select" name="tht" id="tht">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Thorax :</label>
                                                <select class="form-select" name="thorax" id="thorax">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Jantung :</label>
                                                <select class="form-select" name="jantung" id="jantung">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Paru :</label>
                                                <select class="form-select" name="paru" id="paru">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Abdomen :</label>
                                                <select class="form-select" name="abdomen" id="abdomen">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Genital :</label>
                                                <select class="form-select" name="genital" id="genital">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Ekstrimitas :</label>
                                                <select class="form-select" name="ekstremitas" id="ekstremitas">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Abnormal">Abnormal</option>
                                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                                </select>
                                            </div>
                                            <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                                <label for="">Kulit :</label>
                                                <select class="form-select" name="kulit" id="kulit">
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
                                                <textarea class="form-control" name="ket_fisik" id="ket_fisik" cols="30" rows="10" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
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
                                    <input type="text" class="form-control form-control-sm" id="tfu" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="tbj">TBJ (gram)</label>
                                    <input type="text" class="form-control form-control-sm" id="tbj" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="his">HIS (x/10 mnt)</label>
                                    <input type="text" class="form-control form-control-sm" id="his" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-4">
                                    <label for="kontraksi">Kontraksi</label>
                                    <select class="form-select" name="kontraksi" id="kontraksi">
                                        <option value="Ada">Ada</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                                    <label for="djj">DJJ (Dpm)</label>
                                    <input type="text" class="form-control form-control-sm" id="djj" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="inspeksi">Inspeksi</label>
                                    <textarea class="form-control" name="inspeksi" id="inspeksi" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="vt">VT</label>
                                    <textarea class="form-control" name="vt" id="vt" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="inspekulo">Inspekulo</label>
                                    <textarea class="form-control" name="inspekulo" id="inspekulo" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="rt">RT</label>
                                    <textarea class="form-control" name="rt" id="rt" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>

                            </div>
                            <div class="separator m-2">4. Pemeriksaan Penunjang</div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="ultra">Ultrasonografi</label>
                                    <textarea class="form-control" name="ultra" id="ultra" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="kardio">Kardiotografi</label>
                                    <textarea class="form-control" name="kardio" id="kardio" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="lab">Laboratorium</label>
                                    <textarea class="form-control" name="lab" id="lab" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">5. Diagnosis / Asesmen</div>
                                    <textarea class="form-control" name="diagnosis" id="diagnosis" cols="30" rows="8" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">6. Tata Laksana</div>
                                    <textarea class="form-control" name="tata" id="tata" cols="30" rows="8" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <div class="separator m-2">7. Edukasi</div>
                                    <textarea class="form-control" name="edukasi" id="edukasi" cols="30" rows="8" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary simpanAskepAnak" onclick="" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                {{-- <button type="button" class="btn btn-warning simpanAskepAnak" onclick="" style="font-size: 12px"><i class="bi bi-pencil"></i> Ubah</button> --}}
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function getAskepRanapAnak(no_rawat) {
            const askep = $.ajax({
                url: '/erm/ranap/askep/anak',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
            })

            return askep;
        }

        function askepRanapAnak(no_rawat) {
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                jk = regPeriksa.pasien.jk == 'P' ? 'PEREMPUAN' : 'LAKI-LAKI';
                $('#formAskepAnakRanap input[name=no_rawat]').val(no_rawat)
                $('#formAskepAnakRanap input[name=pasien]').val(`${regPeriksa.pasien.nm_pasien} (${jk})`)
                $('#formAskepAnakRanap input[name=tgl_lahir]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
                $('#formAskepAnakRanap input[name=kd_dokter]').val(regPeriksa.kd_dokter)
                $('#formAskepAnakRanap input[name=dokter]').val(regPeriksa.dokter.nm_dokter)
            })
            getAskepRanapAnak(no_rawat).done((response) => {
                let pengkaji1 = response ? response.pengkaji1.nama : "{{ session()->get('pegawai')->nama }}";
                let nip1 = response ? response.nip1 : "{{ session()->get('pegawai')->nik }}";
                $('#formAskepAnakRanap input[name=nip1]').val(nip1)
                $('#formAskepAnakRanap input[name=pengkaji1]').val(pengkaji1)
                $('#formAskepAnakRanap input[name=nip2]').val(response.nip2)
                $('#formAskepAnakRanap input[name=pengkaji2]').val(response.pengkaji2.nama)
                console.log(response);
            })
            $('#modalAskepRanapAnak').modal('show')
        }

        $('#modalAskepRanapAnak').on('shown.bs.modal', () => {
            $('#tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })
        })

        function cariPetugasAskep(p, no) {
            getPetugas(p.value, no).done((response) => {
                html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                $.map(response, function(data) {
                    html += `<li><a data-id="${data.nip}" class="dropdown-item" onclick="setPetugasAskep(this, ${no})">${data.nama}</a><li>`
                })
                html += '</ul>';
                $('.list_petugas' + no).fadeIn();
                $('.list_petugas' + no).html(html);
            })
        }

        function setPetugasAskep(p, no) {
            const nip = $(p).data('id');
            const nama = $(p).text();

            $('.nip' + no).val(nip)
            $('.pengkaji' + no).val(nama)

            $('.list_petugas' + no).fadeOut();
        }
    </script>
@endpush
