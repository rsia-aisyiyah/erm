<form action="" method="POST" class="" id="formSoapRanap">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <table class="borderless">
                <tr>
                    <td width="10%" style="font-size:11px">Pasien:</td>
                    <td width="15%">
                        <input type="text" class="form-control form-control-sm" id="nomor_rawat" name="nomor_rawat" placeholder="" readonly>
                    </td>
                    <td width="30%" colspan="3">
                        <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" readonly>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Dilakukan Oleh :</td>
                    <td width="15%">
                        <input type="text" class="form-control form-control-sm" id="nik" name="nik"
                            placeholder="" readonly>
                    </td>
                    <td colspan="2" width="40%">
                        <input type="search" class="form-control form-control-sm" id="nama" name="nama"
                            placeholder="" readonly>

                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Subjek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Objek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm"
                                    id="suhu" name="suhu" placeholder="" maxlength="5"
                                    value="-"
                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi"
                                    name="tinggi" placeholder="" maxlength="5"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat"
                                    name="berat" placeholder="" maxlength="5"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Tensi : <input type="text" class="form-control form-control-sm" id="tensi"
                                    name="tensi" placeholder="" maxlength="8"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Respirasi (/mnt): <input type="text" class="form-control form-control-sm"
                                    id="respirasi" name="respirasi" placeholder="" maxlength="3"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Nadi (/mnt) : <input type="text" class="form-control form-control-sm"
                                    id="nadi" name="nadi" placeholder="" maxlength="3"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2"
                                    name="spo2" placeholder="" maxlength="3"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                GCS (E,V,M): <input type="text" class="form-control form-control-sm"
                                    id="gcs" name="gcs" placeholder="" maxlength="10"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                O2: <input type="text" class="form-control form-control-sm"
                                    id="o2" name="o2" placeholder="" maxlength="10"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%" style="font-size:11px">
                                Kesadaran :
                                <select class="form-select" name="kesadaran" id="kesadaran">
                                    <option value="Compos Mentis">Compos Mentis</option>
                                    <option value="Somnolence">Somnolence</option>
                                    <option value="Sopor">Sopor</option>
                                    <option value="Coma">Coma</option>
                                </select>
                            </td>
                        </table>
                    </td>
                </tr>
                <tr class="formEws">
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%" style="font-size:11px">
                                Keluaran Urin : <select class="form-select" name="keluaran_urin" id="keluaran_urin">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="Y">Y</option>
                                    <option value="T">T</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Proteinuria : <select class="form-select" name="proteinuria" id="proteinuria">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="++">++</option>
                                    <option value="+++">+++</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Air Ketuban : <select class="form-select" name="air_ketuban" id="air_ketuban">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Jernih">Jernih/Pink</option>
                                    <option value="Hijau">Hijau</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Skala Nyeri : <select class="form-select" name="skala_nyeri" id="skala_nyeri">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Lochia : <select class="form-select" name="lochia" id="lochia">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Banyak">Banyak</option>
                                </select>
                            </td>
                            <td width="12%" style="font-size:11px">
                                Tidak Sehat: <select class="form-select" name="terlihat_tidak_sehat" id="terlihat_tidak_sehat">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Tidak" selected>Tidak</option>
                                    <option value="Ya">Ya</option>
                                </select>
                            </td>

                        </table>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="nik" id="nik" value={{ session()->get('pegawai')->nik }}>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <table class="borderless">
                <tr>
                    <td width="15%" style="font-size:11px;vertical-align:middle">Alergi :</td>
                    <td width="20%">
                        <input type="text" class="form-control form-control-sm" id="alergi" name="alergi"
                            placeholder="" style="width:100%"
                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                    </td>
                    <td width="10%" style="font-size:11px;text-align:right;vertical-align:middle" class="waktuSoap">Tanggal :</td>
                    <td class="waktuSoap">
                        <input type="text" class="form-control form-control-sm " id="tgl_perawatan_ubah" name="tgl_perawatan_ubah" placeholder="" style="width:100%" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" disabled>
                    </td>
                    <td class="waktuSoap">
                        <div class="input-group">
                            <div class="input-group-text" style="padding: 4px">
                                <input class="form-check-input" type="checkbox" value="" aria-label="Checkbox for following text input" style="width:.8em;height:.8em;margin:0px" id="cekJam">
                            </div>
                            <input type="text" class="form-control form-control-sm " id="jam_rawat_ubah" name="jam_rawat_ubah" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="" autocomplete="off" disabled>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px" width="5%">Asesmen : </td>
                    <td colspan="4" width="5%">
                        <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="5"
                            onfocus="removeZero(this)"
                            onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Plan : </td>
                    <td colspan="4">
                        <textarea class="form-control" name="plan" id="plan" cols="30" rows="5"
                            onfocus="removeZero(this)"
                            onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td style="font-size:11px">Instruksi : </td>
                    <td colspan="4">
                        <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="5"
                            onfocus="removeZero(this)"
                            onblur="cekKosong(this)">-</textarea>
                        <input type="hidden" name="tgl_perawatan" id="tgl_perawatan" value="">
                        <input type="hidden" name="jam_rawat" id="jam_rawat" value="">
                        <input type="hidden" name="spesialis" id="spesialis" value="">

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary btn-sm btn-simpan" onclick="simpanSoapRanap()" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                        <button type="button" class="btn btn-warning btn-sm" id="btn-reset" style="font-size:12px;display:none"><i class="bi bi-arrow-clockwise"></i> Baru</button>
                        <button type="button" class="btn btn-success btn-sm" onclick="editSoap()" id="btn-ubah" style="font-size:12px;display:none"><i class="bi bi-pencil-square"></i> Ubah</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</form>
