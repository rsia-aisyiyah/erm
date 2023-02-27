<div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background-color: #e7e7e7;">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN S.O.A.P</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-soap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="borderless">
                                <tr>
                                    <td width="15%">No Rawat : </td>
                                    <td width="30%">
                                        <input type="text" class="form-control form-control-sm" id="nomor_rawat"
                                            name="nomor_rawat" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;">
                                    </td>
                                    <td width="20%">
                                        <input type="text" class="form-control form-control-sm" id="no_rm"
                                            name="no_rm" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;">
                                    </td>
                                    <td width="30%">
                                        <input type="text" class="form-control form-control-sm" id="nama_pasien"
                                            name="nama_pasien" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="borderless">
                                <tr>
                                    <td width="20%">Dilakukan Oleh :</td>
                                    <td width="30%">
                                        <input type="text" class="form-control form-control-sm" id="nik"
                                            name="nik" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                                    </td>
                                    <td width="45%" colspan="2">
                                        <input type="text" class="form-control form-control-sm" id="nama"
                                            name="nama" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0" readonly>

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Profesi / Jabatan / Departmen : </td>
                                    <td width="30%" colspan="2">
                                        <input type="text" class="form-control form-control-sm" id="jabatan"
                                            name="jabatan" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subjek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Objek : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                Suhu (<sup>0</sup>C) : <input type="text"
                                                    class="form-control form-control-sm" id="suhu" name="suhu"
                                                    placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    value="-" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Tinggi (Cm): <input type="text"
                                                    class="form-control form-control-sm" id="tinggi"
                                                    name="tinggi" placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Berat (Kg) : <input type="text"
                                                    class="form-control form-control-sm" id="berat"
                                                    name="berat" placeholder="" maxlength="5"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                Tensi : <input type="text" class="form-control form-control-sm"
                                                    id="tensi" name="tensi" placeholder="" maxlength="8"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Respirasi (/mnt): <input type="text"
                                                    class="form-control form-control-sm" id="respirasi"
                                                    name="respirasi" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Nadi (/mnt) : <input type="text"
                                                    class="form-control form-control-sm" id="nadi"
                                                    name="nadi" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="3">
                                        <table>
                                            <td width="12%">
                                                SpO2 (%): <input type="text" class="form-control form-control-sm"
                                                    id="spo2" name="spo2" placeholder="" maxlength="3"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                GCS (E,V,M): <input type="text"
                                                    class="form-control form-control-sm" id="gcs"
                                                    name="gcs" placeholder="" maxlength="10"
                                                    style="font-size:12px;min-height:12px;border-radius:0;"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)">
                                            </td>
                                            <td width="12%">
                                                Kesadaran :
                                                <select class="form-select" name="kesadaran" id="kesadaran"
                                                    style="font-size:12px;min-height:12px;border-radius:0;>">
                                                    <option value="Compos Mentis">Compos Mentis</option>
                                                    <option value="Somnolence">Somnolence</option>
                                                    <option value="Sopor">Sopor</option>
                                                    <option value="Coma">Coma</option>
                                                </select>
                                            </td>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table class="borderless">
                                <tr>
                                    <td width="5%">Alergi :</td>
                                    <td width="20%">
                                        <input type="text" class="form-control form-control-sm" id="alergi"
                                            name="alergi" placeholder=""
                                            style="font-size:12px;min-height:12px;border-radius:0;width:150px"
                                            onfocus="removeZero(this)" onblur="cekKosong(this)">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Asesmen : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plan : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="plan" id="plan" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Instruksi : </td>
                                    <td colspan="3">
                                        <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="4"
                                            style="font-size:12px;min-height:12px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                            onblur="cekKosong(this)"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoap()"><i
                        class="bi bi-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalSoap').on('shown.bs.modal', function() {
            modalsoap(id);
            isModalSoapShow = true;
        });

        $('#modalSoap').on('hidden.bs.modal', function() {
            isModalSoapShow = false;
            reloadTabelPoli();
        });

        function ambilNoRawat(no_rawat) {
            id = no_rawat;
        }
    </script>
@endpush
