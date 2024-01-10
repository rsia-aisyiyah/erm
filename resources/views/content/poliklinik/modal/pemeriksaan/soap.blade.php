<form action="" method="POST" id="formSoapPoli">
    <div class="row">

        <div class="col-lg-3 col-sm-12 mb-2">
            <div class="input-group">
                <label for="nomor_rawat" class="input-group-text" style="font-size:12px;height: 28px">No.
                    Rawat</label>
                <input type="text" class="form-control form-control-sm" id="nomor_rawat" name="no_rawat" placeholder="" readonly>
            </div>
        </div>
        <div class="col-lg-1 col-sm-12 mb-2">
            <input type="text" class="form-control form-control-sm" id="no_rm" name="no_rkm_medis" placeholder="" readonly>
        </div>
        <div class="col-lg-3 col-sm-12 mb-2">
            <input type="text" class="form-control form-control-sm" id="nama_pasien" name="nm_pasien" placeholder="" readonly>
        </div>
        <div class="col-lg-1 col-sm-12 mb-2">
            <input type="text" class="form-control form-control-sm" id="png_jawab" name="png_jawab" placeholder="" readonly>
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <input type="text" class="form-control form-control-sm" id="p_jawab" name="p_jawab" placeholder="" readonly>
        </div>
        <div class="col-lg-2 col-sm-12 mb-2">
            <input type="text" class="form-control form-control-sm" id="ket_pasien" name="ket_pasien" placeholder="Keterangan">
        </div>
    </div>
    <hr style="margin:2px">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <table class="borderless">
                <tr>
                    <td width="20%">Dilakukan Oleh :</td>
                    <td width="30%" colspan="2">
                        <input type="hidden" id="jam_rawat" name="jam_rawat">
                        <input type="hidden" id="tgl_perawatan" name="tgl_perawatan">
                        <input type="hidden" id="nik" name="nik">
                        <input type="hidden" id="kd_dokter" name="kd_dokter" value="{{ Request::get('dokter') }}">
                        <input type="hidden" id="kd_poli" name="kd_poli" value="{{ Request::segment(2) }}">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="lingkar_perut" name="lingkar_perut" value="-">
                        <input type="hidden" id="evaluasi" name="evaluasi" value="-">
                        <input type="text" class="form-control form-control-sm" id="user" name="user" placeholder="" readonly>
                    </td>
                    <td width="45%" colspan="2">
                        <input type="search" class="form-control form-control-sm" id="nama_user" name="nama_user" placeholder="" onkeyup="cariPetugas(this)" autocomplete="off">
                        <div class="list_petugas"></div>

                    </td>
                </tr>
                <tr>
                    <td>Subjek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="keluhan" id="subjek" cols="30" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Objek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="pemeriksaan" id="objek" cols="30" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <tr>

                                <td width="12%">
                                    Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm" id="suhu" name="suhu_tubuh" placeholder="" maxlength="5" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi" name="tinggi" placeholder="" maxlength="5" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat" name="berat" placeholder="" maxlength="5" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    Tensi : <input type="text" class="form-control form-control-sm" id="tensi" name="tensi" placeholder="" maxlength="8" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    Respirasi (/mnt): <input type="text" class="form-control form-control-sm" id="respirasi" name="respirasi" placeholder="" value="-" maxlength="3" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                            </tr>
                            <tr>
                                <td width="12%">
                                    Nadi (/mnt) : <input type="text" class="form-control form-control-sm" id="nadi" name="nadi" placeholder="" maxlength="3" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2" name="spo2" placeholder="" maxlength="3" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    GCS (E,V,M): <input type="text" class="form-control form-control-sm" id="gcs" name="gcs" placeholder="" maxlength="10" value="-" onfocus="removeZero(this)" onblur="cekKosong(this)">
                                </td>
                                <td width="12%">
                                    Kesadaran :
                                    <select class="form-select" name="kesadaran" id="kesadaran">
                                        <option value="Compos Mentis">Compos Mentis</option>
                                        <option value="Apatis">Apatis</option>
                                        <option value="Somnolence">Somnolence</option>
                                        <option value="Sopor">Sopor</option>
                                        <option value="Coma">Coma</option>
                                    </select>
                                </td>
                                <td width="12%">
                                    Alergi :
                                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="" onfocus="removeZero(this)" value="-" onblur="cekKosong(this)">
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Asesmen : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="penilaian" id="asesmen" cols="30" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>

                <tr>
                    <td>Instruksi : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="4" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <table class="borderless mb-6" width="100%">
                <tr>
                    <td>Plan : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="rtl" id="plan" cols="30" rows="8" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button class="btn btn-warning btn-sm" type="button" style="font-size: 12px" onclick="catatanPasien()"><i class="bi bi-pen"></i> Diagnosa & Catatan</button>
                        <button type="button" class="btn btn-success btn-sm" onclick="simpanSoap()" style="display: none"><i class="bi bi-save"></i> Simpan SOAP</button>
                    </td>
                </tr>
            </table>

            <input type="hidden" class="no_resep form-control form-control-sm" />
            <ul class="nav nav-tabs mt-4" id="myTab">
                <li class="nav-item">
                    <a href="#umum" class="nav-link active" data-bs-toggle="tab">NON RACIKAN</a>
                </li>
                <li class="nav-item">
                    <a href="#racikan" class="nav-link" data-bs-toggle="tab">RACIKAN</a>
                </li>
                <li class="nav-item">
                    <a href="#riwayat" class="nav-link" data-bs-toggle="tab">RIWAYAT RESEP</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="umum">
                    <table class="table table-stripped table-responsive table-sm" id="tb-resep" width="100%">
                        <thead>
                            <tr>
                                <th width="18%">No. Resep</th>
                                <th>Nama Obat</th>
                                <th width="10%">Jumlah</th>
                                <th>Aturan Pakai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="body_umum">

                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm tambah_umum" type="button" onclick="tambahUmum()">Tambah
                        Obat</button>
                    <button class="btn btn-success btn-sm btn_simpan_resep" type="button" style="visibility: hidden">Simpan
                        Resep</button>
                </div>
                <div class="tab-pane fade" id="racikan">
                    <table class="table table-responsive" id="tb-resep-racikan" width="100%">
                        <thead>
                            <tr>
                                <th width="10%">No Racik</th>
                                <th>No Resep</th>
                                <th>Nama Racikan</th>
                                <th>Metode Racikan</th>
                                <th width="10%">Jumlah</th>
                                <th>Aturan Pakai</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="body_racikan">

                        </tbody>
                    </table>
                    <button class="btn btn-primary btn-sm tambah_racik" type="button" onclick="tambahRacikan()">Tambah Racikan</button>
                </div>
                <div class="tab-pane fade" id="riwayat">
                    <table class="table table-responsive" id="tb-resep-riwayat" width="100%">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th width="65%">Obat/Racikan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="body_riwayat" class="align-top">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
