<div class="modal fade" id="modalGrafikHarian" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        {{-- <div class="modal-content" style="border-radius:0px; height:100vh;"> --}}
        <form method="post" class="modal-content" id="formSaveGrafikHarian" style="background: #f3f3f3;">
            <div class="" id="kdDokter"></div>
            <div class="" id="spesialisDOkter"></div>
            <div class="" id="nmPasien"></div>
            <div class="modal-header" style="background: #dfdfdf;">
                <h5 class="modal-title fs-5" id="exampleModalLabel">GRAFIK HARIAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-12 col-lg-5 order-lg-2">
                            <div class="mb-4">
                                <div class="form-group">
                                    <label for="no_rawat" class="form-label">No Rawat</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm" id="no_rawat"
                                                name="no_rawat" placeholder="" readonly

                                                onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                        </div>
                                        <div class="col-md-8">
                                            <input class="form-control form-control-sm" id="nm_pasien"
                                                name="nm_pasien" placeholder="" readonly

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
                                                <td style="width:20%;">Suhu Tubuh</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="suhu_tubuh" name="suhu_tubuh" placeholder=""
                                                        maxlength="8"

                                                        onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                        value="-">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;">Tensi</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="tensi" name="tensi" placeholder="" maxlength="8"

                                                        onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                        value="-">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;">Nadi</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="nadi" name="nadi" placeholder="" maxlength="8"

                                                        onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                        value="-">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:20%;">Respirasi</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" class="form-control form-control-sm"
                                                        id="respirasi" name="respirasi" placeholder="" maxlength="8"

                                                        onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                        value="-">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 order-lg-1">
                                    <table class="table borderless">
                                        <tr>
                                            <td style="width:20%;">SPO2</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" id="spo2"
                                                    name="spo2" placeholder="" maxlength="8"

                                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;">o2</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" id="o2"
                                                    name="o2" placeholder="" maxlength="8"

                                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;">gcs</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" id="gcs"
                                                    name="gcs" placeholder="" maxlength="8"

                                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;">kesadaran</td>
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
                        <div class="col-12 col-lg-7 order-md-1">
                            <div class="table-responsive">
                                <table class="table table-sm table-border table-hover table-striped" id="tableGrafikHarian">
                                    <thead>
                                        <tr>
                                            <th>Waktu Perawatan</th>
                                            <th>Suhu</th>
                                            <th>Tensi</th>
                                            <th>Nadi</th>
                                            <th>Respirasi</th>
                                            <th>SPO2</th>
                                            <th>O2</th>
                                            <th>GCS</th>
                                            <th>Kesadaran</th>
                                            <th width='70'>#</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="background: #dfdfdf">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle"></i> Keluar
                </button>
                <button type="submit" class="btn btn-primary btn-sm" style="font-size: 12px">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <span class="editGrafik"></span>
            </div>
        </form>
        {{-- </div> --}}
    </div>
</div>
