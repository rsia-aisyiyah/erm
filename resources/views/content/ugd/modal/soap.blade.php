<div class="modal fade" id="modalSoapUgd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:0px">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PASIEN UGD</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tab-soap-ranap" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                            data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                            aria-selected="true">SOAP</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-tabel" data-bs-toggle="tab" data-bs-target="#tab-tabel-pane"
                            type="button" role="tab" aria-controls="tab-tabel-pane" aria-selected="false">Data
                            Pemeriksaan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-grafik" data-bs-toggle="tab" data-bs-target="#tab-grafik-pane"
                            type="button" role="tab" aria-controls="tab-grafik-pane" aria-selected="false">Grafik
                            Pasien</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-ews" data-bs-toggle="tab" data-bs-target="#tab-ews-pane"
                            type="button" role="tab" aria-controls="tab-ews-pane" aria-selected="false">EWS</button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        <form action="" method="POST" class="" id="formSoapUgd">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <table class="borderless">
                                        <tr>
                                            <td width="10%" style="font-size:11px">Pasien:</td>
                                            <td width="15%">
                                                <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" style="font-size:11px;min-height:20px;border-radius:0;" readonly>
                                            </td>
                                            <td width="30%" colspan="3">
                                                <input type="text" class="form-control form-control-sm" id="nm_pasien" name="nm_pasien" placeholder="" style="font-size:11px;min-height:20px;border-radius:0;" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Dilakukan Oleh :</td>
                                            <td width="15%">
                                                <input type="text" class="form-control form-control-sm" id="nik" name="nik"
                                                    placeholder="" style="font-size:11px;min-height:20px;border-radius:0;" readonly>
                                            </td>
                                            <td colspan="2" width="40%">
                                                <input type="search" class="form-control form-control-sm" id="nama" name="nama"
                                                    placeholder="" style="font-size:11px;min-height:20px;border-radius:0;" onkeyup="cariPetugas(this)">
                                                <div class="list_petugas"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Subjek : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Objek : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="objek" id="objek" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td colspan="3">
                                                <table>
                                                    <td width="12%" style="font-size:11px">
                                                        Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm"
                                                            id="suhu" name="suhu" placeholder="" maxlength="5"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" value="-"
                                                            onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi"
                                                            name="tinggi" placeholder="" maxlength="5"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Berat (Kg) : <input type="text" class="form-control form-control-sm" id="berat"
                                                            name="berat" placeholder="" maxlength="5"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
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
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Respirasi (/mnt): <input type="text" class="form-control form-control-sm"
                                                            id="respirasi" name="respirasi" placeholder="" maxlength="3"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Nadi (/mnt) : <input type="text" class="form-control form-control-sm"
                                                            id="nadi" name="nadi" placeholder="" maxlength="3"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
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
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        GCS (E,V,M): <input type="text" class="form-control form-control-sm"
                                                            id="gcs" name="gcs" placeholder="" maxlength="10"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        O2: <input type="text" class="form-control form-control-sm"
                                                            id="o2" name="o2" placeholder="" maxlength="10"
                                                            style="font-size:11px;min-height:20px;border-radius:0;" onfocus="removeZero(this)"
                                                            onblur="cekKosong(this)" value="-" autocomplete="off">
                                                    </td>
                                                    <td width="12%" style="font-size:11px">
                                                        Kesadaran :
                                                        <select class="form-select" name="kesadaran" id="kesadaran"
                                                            style="font-size:11px;min-height:20px;border-radius:0;>">
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
                                    <input type="hidden" name="nik" id="nik" value={{ session()->get('pegawai')->nik }}>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <table class="borderless">
                                        <tr>
                                            <td width="5%" style="font-size:11px">Alergi :</td>
                                            <td width="65%">
                                                <input type="text" class="form-control form-control-sm" id="alergi" name="alergi"
                                                    placeholder="" style="font-size:11px;min-height:20px;border-radius:0;width:100%"
                                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px" width="5%">Asesmen : </td>
                                            <td colspan="3" width="5%">
                                                <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Plan : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="plan" id="plan" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="font-size:11px">Instruksi : </td>
                                            <td colspan="3">
                                                <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="5"
                                                    style="font-size:11px;min-height:20px;border-radius:0;resize:none" onfocus="removeZero(this)"
                                                    onblur="cekKosong(this)">-</textarea>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-3" id="tab-tabel-pane" role="tabpanel" aria-labelledby="tab-tabel"
                        tabindex="0">
                        <table class="table table-striped table-bordered table-responsive text-sm table-sm" id="tbSoapUgd" style="font-size: 12px" width="100%">
                            <thead>
                                <tr role="row">
                                    <th width="5%">Aksi</th>
                                    <th width="15%">TTV & Fisik</th>
                                    <th width="80%">S.O.A.P</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i
                        class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanSoapRanap()"
                    style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
                <span id="ubah_soap"></span>
                <span id="reset_soap"></span>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function ambilSoapRalan(no_rawat, tgl_pemeriksaan, jam_rawat) {
            $.ajax({
                url: '/erm/pemeriksaan/get',
                data: {
                    no_rawat: no_rawat,
                    tgl_perawatan: tgl_pemeriksaan,
                    jam_rawat: jam_rawat,
                },
            }).done((response) => {
                $('#formSoapUgd input[name="kd_dokter"]').val(response.pegawai.nik)
            })
        }
    </script>
@endpush
