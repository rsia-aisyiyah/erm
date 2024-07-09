<form action="" class="form-asmed-kandungan" id="formAsmedRajalKandungan">
    <div class="row">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="pasien">
                    Pasien
                </label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" id="no_rawat" name="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" aria-label="" aria-describedby="pasien" readonly="">
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                    </div>
                </div>

            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <label for="dokter">Dokter</label>
                <div class="row">
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                        <input type="search" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" name="kd_dokter" readonly>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                        <input type="search" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="nm_dokter" autocomplete="off">
                        <div class="list-dokter"></div>
                    </div>
                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                        <div class="input-group">
                            <select class="form-select form-select-sm" id="anamnesis" name="anamnesis">
                                <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                <option value="Alloanamnesis">Alloanamnesis</option>
                            </select>
                            <input type="search" class="form-control form-control-sm hubungan" placeholder="" aria-label="" id="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" name="hubungan" autocomplete="off">
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
                    <textarea class="form-control" name="keluhan_utama" id="keluhan_utama" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rps">Riwayat Penyakit Sekarang</label>
                    <textarea class="form-control" name="rps" id="rps" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                    <textarea class="form-control" name="rpd" id="rpd" cols="30" rows="5"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                    <textarea class="form-control" name="rpk" id="rpk" cols="30" rows="2"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="rpo">Riwayat Penggunaan Obat</label>
                    <textarea class="form-control" name="rpo" id="rpo" cols="30" rows="2"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="mb-3 col-sm-12 col-md-6 col-lg-4">
                    <label for="alergi">Alergi</label>
                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
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
                    <select class="form-select" name="kesadaran" id="">
                        <option value="Compos Mentis">Compos Mentis</option>
                        <option value="Apatis">Apatis</option>
                        <option value="Somnolence">Somnolence</option>
                        <option value="Sopor">Sopor</option>
                        <option value="Coma">Coma</option>
                    </select>
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="gcs">GCS(E,V,M)</label>
                    <input type="text" class="form-control form-control-sm" id="gcs" name="gcs" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="tb">TB (cm)</label>
                    <input type="text" class="form-control form-control-sm" id="tb" name="tb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="bb">BB (Kg)</label>
                    <input type="text" class="form-control form-control-sm" id="bb" name="bb" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="td">TD (mmHg)</label>
                    <input type="text" class="form-control form-control-sm" id="td" name="td" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-3">
                    <label for="nadi">Nadi (x/menit)</label>
                    <input type="text" class="form-control form-control-sm" id="nadi" name="nadi" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="rr">RR (x/menit)</label>
                    <input type="text" class="form-control form-control-sm" id="rr" name="rr" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="suhu">Suhu (<sup>0</sup>C)</label>
                    <input type="text" class="form-control form-control-sm" id="suhu" name="suhu" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                    <label for="spo">spo(%)</label>
                    <input type="text" class="form-control form-control-sm" id="spo" name="spo" placeholder="" maxlength="10"onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Kepala :</label>
                                <select class="form-select" name="kepala" id="kepala">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Abdomen :</label>
                                <select class="form-select" name="abdomen" id="abdomen">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Mata :</label>
                                <select class="form-select" name="mata" id="mata">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Genital & Anus:</label>
                                <select class="form-select" name="genital" id="genital">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Gigi & Mulut :</label>
                                <select class="form-select" name="gigi" id="gigi">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Ekstrimitas :</label>
                                <select class="form-select" name="ekstremitas" id="ekstremitas">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">THT :</label>
                                <select class="form-select" name="tht" id="tht">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">Kulit :</label>
                                <select class="form-select" name="kulit" id="kulit">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                            <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                <label for="">thoraks :</label>
                                <select class="form-select" name="thoraks" id="thoraks">
                                    <option value="Normal">Normal</option>
                                    <option value="Abnormal">Abnormal</option>
                                    <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <input type="text" class="form-control form-control-sm" id="tfu" name="tfu" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                    <label for="tbj">TBJ (gram)</label>
                    <input type="text" class="form-control form-control-sm" id="tbj" name="tbj" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="mb-2 col-sm-6 col-md-4 col-lg-2">
                    <label for="his">HIS (x/10 mnt)</label>
                    <input type="text" class="form-control form-control-sm" id="his" name="his" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
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
                    <input type="text" class="form-control form-control-sm" id="djj" name="djj" placeholder=""
                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="inspeksi">Inspeksi</label>
                    <textarea class="form-control" name="inspeksi" id="inspeksi" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="vt">VT</label>
                    <textarea class="form-control" name="vt" id="vt" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="inspekulo">Inspekulo</label>
                    <textarea class="form-control" name="inspekulo" id="inspekulo" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <label for="rt">RT</label>
                    <textarea class="form-control" name="rt" id="rt" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>

            </div>
            <div class="separator m-2">4. Pemeriksaan Penunjang</div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="ultra">Ultrasonografi</label>
                    <textarea class="form-control" name="ultra" id="ultra" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="kardio">Kardiotografi</label>
                    <textarea class="form-control" name="kardio" id="kardio" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <label for="lab">Laboratorium</label>
                    <textarea class="form-control" name="lab" id="lab" cols="30" rows="3"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">5. Diagnosis / Asesmen</div>
                    <textarea class="form-control" name="diagnosis" id="diagnosis" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">6. Tata Laksana</div>
                    <textarea class="form-control" name="tata" id="tata" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="separator m-2">7. Konsul / Rujuk</div>
                    <textarea class="form-control" name="konsul" id="konsul" cols="30" rows="8"
                        onfocus="removeZero(this)"
                        onblur="cekKosong(this)">-</textarea>
                </div>
                {{-- <div class="mt-3 col-sm-12 col-md-12 col-lg-4">

                </div> --}}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
    </div>
</form>

@push('script')
    <script>
        $('.dokter').on('keyup', (e) => {
            dokter = $('.dokter').val();
            if (dokter.length >= 3) {
                getDokter(dokter).done((response) => {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                    $.map(response, function(data) {
                        html += '<li>'
                        html += '<a data-id="' + data.kd_dokter + '" data-nama="' + data.nm_dokter + '" class="dropdown-item" onclick="setDokterAsmed(this, \'#kd_dokter\', \'#dokter\')">' + data.nm_dokter + '</a>'
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

        function simpanAsmedRajalKandungan() {
            element = ['input', 'select', 'textarea'];
            except = ['nm_dokter', 'tgl_lahir', 'pasien']
            const data = getDataForm('#formAsmedRajalKandungan', element, except);
            getAsmedRajalKandungan(data.no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    updateAsmedRajalKandungan(data)
                } else {
                    createAsmedRajalKandungan(data)
                }
            })
        }

        function createAsmedRajalKandungan(data) {
            $.ajax({
                url: '/erm/poliklinik/asmed/kandungan/simpan',
                data: data,
                method: 'POST',
                dataType: 'JSON',
                success: (response) => {
                    alertSuccessAjax('Berhasil menambah asesmen medis').then(() => {

                    })
                },
                error: (request) => {
                    alertErrorAjax(request);
                }
            })
        }

        function updateAsmedRajalKandungan(data) {
            $.ajax({
                url: '/erm/poliklinik/asmed/kandungan/edit',
                data: data,
                method: 'POST',
                dataType: 'JSON',
                success: (response) => {
                    alertSuccessAjax('Berhasil mengubah asesmen medis').then(() => {

                    })
                },
                error: (request) => {
                    alertErrorAjax(request);
                }
            })
        }
    </script>
@endpush
