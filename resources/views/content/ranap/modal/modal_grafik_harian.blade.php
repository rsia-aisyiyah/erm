<div class="modal fade" id="modalGrafikHarian" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalGrafikHarianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg shadow-lg">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">TAMBAH GRAFIK HARIAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="formSaveGrafikHarian">
                <div class="modal-body">
                    <div class="mb-4">
                        <div class="form-group">
                            <label for="no_rawat" class="form-label">No Rawat</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control form-control-sm" id="no_rawat"
                                        name="no_rawat" placeholder="" readonly
                                        style="font-size:11px;min-height:20px;border-radius:0;"
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" id="nm_pasien" name="nm_pasien"
                                        placeholder="" readonly
                                        style="font-size:11px;min-height:20px;border-radius:0;"
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table borderless">
                                <tbody>
                                    <tr>
                                        <td>Suhu Tubuh</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="suhu_tubuh"
                                                name="suhu_tubuh" placeholder="" maxlength="8"
                                                style="font-size:11px;min-height:20px;border-radius:0;"
                                                onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tensi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="tensi"
                                                name="tensi" placeholder="" maxlength="8"
                                                style="font-size:11px;min-height:20px;border-radius:0;"
                                                onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nadi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="nadi"
                                                name="nadi" placeholder="" maxlength="8"
                                                style="font-size:11px;min-height:20px;border-radius:0;"
                                                onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Respirasi</td>
                                        <td>:</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm" id="respirasi"
                                                name="respirasi" placeholder="" maxlength="8"
                                                style="font-size:11px;min-height:20px;border-radius:0;"
                                                onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table borderless">
                                <tr>
                                    <td>SPO2</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="spo2" name="spo2"
                                            placeholder="" maxlength="8"
                                            style="font-size:11px;min-height:20px;border-radius:0;"
                                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                    </td>
                                </tr>
                                <tr>
                                    <td>o2</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="o2" name="o2"
                                            placeholder="" maxlength="8"
                                            style="font-size:11px;min-height:20px;border-radius:0;"
                                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                    </td>
                                </tr>
                                <tr>
                                    <td>gcs</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="gcs" name="gcs"
                                            placeholder="" maxlength="8"
                                            style="font-size:11px;min-height:20px;border-radius:0;"
                                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                    </td>
                                </tr>
                                <tr>
                                    <td>kesadaran</td>
                                    <td>:</td>
                                    <td>
                                        <select class="form-select" name="kesadaran" id="kesadaran"
                                            style="font-size:12px;min-height:12px;border-radius:0;">
                                            <option value="Compos Mentis">Compos Mentis</option>
                                            <option value="Somnolence">Somnolence</option>
                                            <option value="Sopor">Sopor</option>
                                            <option value="Coma">Coma</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                        style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary btn-sm" style="font-size: 12px"><i
                            class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>