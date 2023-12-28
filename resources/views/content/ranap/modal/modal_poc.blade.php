<div class="modal fade" id="modalPlanOfCare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel"><i>PLAN OF CARE</i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formPlanOfCare">
                    <div class="row gy-2">
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <label for="">No Rawat</label>
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type="text" class="form-control form-control-sm" id="no_rawat" name="no_rawat" placeholder="" readonly="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="">Anamnesa</label>
                            <div class="input-group">
                                <select class="form-select form-select-sm" id="anamnesa" style="font-size: 12px" name="anamnesa">
                                    <option value="Autoanamnesis" selected="">Autoanamnesis</option>
                                    <option value="Alloanamnesis">Alloanamnesis</option>
                                </select>
                                <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="hubungan" name="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-3">
                            <label for="">Cara Masuk</label>
                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="poli" name="poli" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" readonly>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="keluhan">Diagnosa Kerja</label>
                            <textarea class="form-control" name="diagnosa_kerja" id="diagnosa_kerja" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="masalah">Maslah/Kebutuhan Prioritas</label>
                            <textarea class="form-control" name="masalah" id="masalah" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row gy-2">
                                <div class="col-lg-12">
                                    <label for="masalah" class="form-check-label">Kewaspadaan</label><br />
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="Standar" name="kewaspadaan" value="Standar">
                                        <label class="form-check-label" for="standar">
                                            Standar
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="Kontak" name="kewaspadaan" value="Kontak">
                                        <label class="form-check-label" for="kontak">
                                            Kontak
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="Airborn" name="kewaspadaan" value="Airborn">
                                        <label class="form-check-label" for="airborn">
                                            Airborn
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="Droplet" name="kewaspadaan" value="Droplet">
                                        <label class="form-check-label" for="droplet">
                                            Droplet
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label for="pemeriksaan">Pemeriksaan Penunjang</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" aria-label="" name="pemeriksaan_penunjang" id="laboratorium" value="Laboratorium">
                                            <label class="form-check-label" for="laboratorium">
                                                Laboratorium
                                            </label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_laboratorium" id="ket_laboratorium" style="font-size:11px" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" aria-label="" name="pemeriksaan_penunjang" id="ecg" value="ECG">
                                            <label class="form-check-label" for="ecg">
                                                ECG
                                            </label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_ecg" id="ket_ecg" style="font-size:11px" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" aria-label="" name="pemeriksaan_penunjang" id="radiologi" value="Radiologi">
                                            <label class="form-check-label" for="radiologi">
                                                Radiologi
                                            </label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_radiologi" id="ket_radiologi" style="font-size:11px" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6" id="tim">
                            <label for="dokter">Dokter DPJP & Tim</label>
                            <div class="input-group mb-1">
                                <input class="form-control" name="kd_dokter" id="kd_dokter" onfocus="removeZero(this)" onblur="cekKosong(this)" />
                                <input class="form-control w-50" name="dokter" id="dokter" onfocus="removeZero(this)" onblur="cekKosong(this)" />
                            </div>
                            <div id="perawat" class="row gy-2">
                                <div class="col-lg-12">
                                    <select class="search form-select mt-1" placeholder="Tim Perawatan" name="petugas" id="petugas1" style="width:100%;font-size:11px"></select>
                                </div>
                            </div>
                            <button type="button" class="btn-sm btn btn-primary mt-2" id="btnTimPerawat">+ Tambah Anggota</button>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="masalah">Prosedur/Tindakan</label>
                            <textarea class="form-control" name="prosedur" id="prosedur" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="masalah">Nutrisi</label>
                            <div class="row gy-2">
                                <div class="col-sm-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="Diet" aria-label="" name="diet" id="diet">
                                            <label class="form-check-label" for="diet">
                                                Diet
                                            </label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_diet" id="ket_diet" style="font-size:11px" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" value="Batasan Cairan" aria-label="" name="diet" id="batasan">
                                            <label class="form-check-label" for="batasan">
                                                Batasan Cairan
                                            </label>
                                        </div>
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" value="Ya" aria-label="" name="ket_batasan_cairan" id="Ya">
                                            <label class="form-check-label" for="batasan_cairan">
                                                Ya
                                            </label>
                                            <input class="form-check-input mt-0" type="radio" value="Tidak" aria-label="" name="ket_batasan_cairan" id="Tidak">
                                            <label class="form-check-label" for="batasan_cairan" checked>
                                                Tidak
                                            </label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="keterangan_batasan" id="keterangan_batasan" style="font-size:11px" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="aktivitas">Aktivitas</label><br />
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="aktivitas1" name="aktivitas" value="Tirah Baring Total">
                                <label class="form-check-label" for="aktivitas1">
                                    Tirah Baring Total
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="aktivitas2" name="aktivitas" value="Tirah Baring Partial">
                                <label class="form-check-label" for="aktivitas2">
                                    Tirah Baring Partial
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="aktivitas3" name="aktivitas" value="Mandiri">
                                <label class="form-check-label" for="aktivitas3">
                                    Mandiri
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="aktivitas">Pengobatan</label>
                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="Sesuai Instruksi Medis" aria-label="" name="pengobatan" id="pengobatan1">
                                    <label class="form-check-label" for="pengobatan1">
                                        Sesuai Instruksi Medis
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_pengobatan1" id="ket_pengobatan1" style="font-size:11px" disabled>
                            </div>
                            <div class="input-group input-group-sm">
                                <div class="input-group-text">
                                    <input class="form-check-input mt-0" type="radio" value="Revisi Pengobatan" aria-label="" name="pengobatan" id="pengobatan2">
                                    <label class="form-check-label" for="pengobatan2">
                                        Revisi Pengobatan
                                    </label>
                                </div>
                                <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" name="ket_pengobatan2" id="ket_pengobatan2" style="font-size:11px" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="">Keperawatan</label><br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="keperawatan1" name="keperawatan" value="Observasi Asuhan">
                                <label class="form-check-label" for="keperawatan1">
                                    Observasi Asuhan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="keperawatan2" name="keperawatan" value="Tindakan Asuhan">
                                <label class="form-check-label" for="keperawatan2">
                                    Tindakan Asuhan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="keperawatan3" name="keperawatan" value="Edukasi">
                                <label class="form-check-label" for="keperawatan3">
                                    Edukasi
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="keperawatan4" name="keperawatan" value="Rehibilitasi Medis">
                                <label class="form-check-label" for="keperawatan4">
                                    Rehibilitasi Medis
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="tindakan_rehab_medik">Tindakan Rehibilitasi Medis</label>
                            <textarea class="form-control" name="tindakan_rehab_medik" id="tindakan_rehab_medik" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="konsultasi">Konsultasi</label>
                            <textarea class="form-control" name="konsultasi" id="konsultasi" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <label for="sasaran">Sasaran</label>
                            <textarea class="form-control" name="sasaran" id="sasaran" cols="30" rows="3" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px" onclick="simpanPoc()">
                    <i class="bi bi-save">
                    </i> Simpan
                </button>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px">
                    <i class="bi bi-x-circle">
                    </i> Keluar
                </button>
            </div>
        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        var formPlanOfCare = $('#formPlanOfCare')
        $('#modalPlanOfCare').on('hidden.bs.modal', () => {
            document.getElementById("formPlanOfCare").reset();
            $('#formPlanOfCare').find('.personil').remove();
        })

        function simpanPoc() {
            const queryString = formPlanOfCare.serializeArray()
            const resultObject = {};

            queryString.forEach(item => {
                const {
                    name,
                    value
                } = item;

                // Check if the property already exists
                if (resultObject[name]) {
                    // If it's already an array, push the new value
                    if (Array.isArray(resultObject[name])) {
                        resultObject[name].push(value);
                    } else {
                        // If it's not an array, convert it to an array
                        resultObject[name] = [resultObject[name], value];
                    }
                } else {
                    // If the property doesn't exist, create it
                    resultObject[name] = value;
                }
            });

            // set pemeriksaan
            if (Array.isArray(resultObject.pemeriksaan_penunjang)) {
                resultObject.pemeriksaan_penunjang = resultObject.pemeriksaan_penunjang.map((val) => {

                    if (val == 'Laboratorium') {
                        periksa = `${val} : ${resultObject.ket_laboratorium}`
                    } else if (val == 'ECG') {
                        periksa = `${val} : ${resultObject.ket_ecg}`
                    } else if (val == 'Radiologi') {
                        periksa = `${val} : ${resultObject.ket_radiologi}`
                    }

                    return periksa;
                }).map((val) => {
                    return val;
                }).join('; ')
            } else {
                if (resultObject.pemeriksaan_penunjang == 'Laboratorium') {
                    periksa = resultObject.ket_laboratorium
                } else if (resultObject.pemeriksaan_penunjang == 'ECG') {
                    periksa = resultObject.ket_ecg
                } else if (resultObject.pemeriksaan_penunjang == 'Radiologi') {
                    periksa = resultObject.ket_radiologi
                }
                resultObject.pemeriksaan_penunjang = `${resultObject.pemeriksaan_penunjang} : ${periksa}`
            }

            // setKewaspadaan
            if (Array.isArray(resultObject.kewaspadaan)) {
                const kewaspadaan = resultObject.kewaspadaan.map((val) => {
                    return val
                }).join('; ')

                resultObject.kewaspadaan = kewaspadaan;
            }

            // set aktivitas
            if (Array.isArray(resultObject.aktivitas)) {
                const aktivitas = resultObject.aktivitas.map((val) => {
                    return val
                }).join('; ')

                resultObject.aktivitas = aktivitas;
            }

            // set nutrisi
            if (Array.isArray(resultObject.diet)) {
                resultObject.diet = resultObject.diet.map((val) => {

                    if (val == 'Diet') {
                        nutrisi = `${val} : ${resultObject.ket_diet}`
                    } else if (val == 'Batasan Cairan') {
                        nutrisi = `${val} : ${resultObject.ket_batasan_cairan} : ${resultObject.keterangan_batasan}`
                    }

                    return nutrisi;
                }).map((val) => {
                    return val;
                }).join('; ')
            } else {
                if (resultObject.diet == 'Diet') {
                    nutrisi = resultObject.ket_diet
                } else if (resultObject.diet == 'Batasan Cairan') {
                    nutrisi = `${resultObject.ket_batasan_cairan} : ${resultObject.keterangan_batasan} `
                }
                resultObject.diet = `${resultObject.diet} : ${nutrisi}`
            }

            if (resultObject.pengobatan == 'Revisi Pengobatan') {
                resultObject.pengobatan = `${resultObject.pengobatan} : ${resultObject.ket_pengobatan2}`
            } else if (resultObject.pengobatan == 'Sesuai Instruksi Medis') {
                resultObject.pengobatan = `${resultObject.pengobatan} : ${resultObject.ket_pengobatan1}`
            } else {
                resultObject.pengobatan = ``
            }

            // keperawatan
            if (Array.isArray(resultObject.keperawatan)) {
                const keperawatan = resultObject.keperawatan.map((val) => {
                    return val
                }).join('; ')

                resultObject.keperawatan = keperawatan;
            }

            $.post('poc/create',
                resultObject
            ).done((response) => {
                if (resultObject.petugas) {
                    $.post('poc/tim/create', {
                        _token: resultObject._token,
                        no_rawat: resultObject.no_rawat,
                        petugas: resultObject.petugas,
                    })
                }
                alertSuccessAjax().then(() => {
                    $('#modalPlanOfCare').modal('hide')
                    $('#tb_ranap').DataTable().destroy();
                    tb_ranap();
                })
            })
        }

        $('#laboratorium').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_laboratorium').attr('disabled', false)
            } else {
                $('#ket_laboratorium').attr('disabled', true)
                $('#ket_laboratorium').val('')
            }
        })

        $('#ecg').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_ecg').attr('disabled', false)
            } else {
                $('#ket_ecg').attr('disabled', true)
                $('#ket_ecg').val('')
            }
        })

        $('#radiologi').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_radiologi').attr('disabled', false)
            } else {
                $('#ket_radiologi').attr('disabled', true)
                $('#ket_radiologi').val('')
            }
        })
        $('#diet').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_diet').attr('disabled', false)
            } else {
                $('#ket_diet').attr('disabled', true)
                $('#ket_diet').val('')
            }
        })
        $('#batasan').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#keterangan_batasan').attr('disabled', false)
                $('#ket_batasan_cairan').attr('disabled', false)
                formPlanOfCare.find('input[name=ket_batasan_cairan]').attr('disabled', false)
            } else {
                $('#keterangan_batasan').attr('disabled', true)
                $('#keterangan_batasan').val('')
                formPlanOfCare.find('input[name=ket_batasan_cairan]').attr('disabled', true)
            }
        })

        $('#pengobatan1').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_pengobatan1').attr('disabled', false)
                $('#ket_pengobatan2').attr('disabled', true)
            } else {
                $('#ket_pengobatan1').attr('disabled', true)
                $('#ket_pengobatan2').attr('disabled', false)
                $('#ket_pengobatan1').val('')
            }
        })
        $('#pengobatan2').on('change', (e) => {
            const isChecked = e.currentTarget.checked;
            if (isChecked) {
                $('#ket_pengobatan2').attr('disabled', false)
                $('#ket_pengobatan1').attr('disabled', true)
            } else {
                $('#ket_pengobatan2').attr('disabled', true)
                $('#ket_pengobatan1').attr('disabled', false)
                $('#ket_pengobatan2').val('')
            }
        })

        function modalPlanOfCare(no_rawat) {
            getRegPeriksa(no_rawat).done((response) => {
                formPlanOfCare.find('input[name=no_rawat]').val(response.no_rawat)
                formPlanOfCare.find('input[name=poli]').val(response.poliklinik.nm_poli)
                formPlanOfCare.find('input[name=dokter]').val(response.dokter.nm_dokter)
                formPlanOfCare.find('input[name=kd_dokter]').val(response.dokter.kd_dokter)
            });
            $.get('poc', {
                no_rawat: no_rawat,
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formPlanOfCare select[name=${index}]`);
                        input = $(`#formPlanOfCare input[name=${index}][type=text]`);
                        textarea = $(`#formPlanOfCare textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formPlanOfCare select[name=${index}]`).val(value)
                        } else if (input.length) {
                            if (index == 'tanggal') {
                                value = `${splitTanggal(value.split(' ')[0])} ${value.split(' ')[1]}`
                            }
                            $(`#formPlanOfCare input[name=${index}]`).val(value)
                        } else {
                            $(`#formPlanOfCare textarea[name=${index}]`).val(value)
                        }

                    })

                    const arrKewaspadaan = response.kewaspadaan ? response.kewaspadaan.split('; ') : [''];
                    const arrPemeriksaan = response.pemeriksaan_penunjang ? response.pemeriksaan_penunjang.split(', ') : [''];
                    const arrNutrisi = response.nutrisi ? response.nutrisi.split('; ') : [''];
                    const arrAktivitas = response.aktivitas ? response.aktivitas.split('; ') : [''];
                    const arrKeperawatan = response.keperawatan ? response.keperawatan.split('; ') : [''];

                    const radioPengobatan = $(`#formPlanOfCare input[name=pengobatan]`);
                    const checkKewaspadaan = $(`#formPlanOfCare input[name=kewaspadaan]`);
                    const checkPemeriksaan = $(`#formPlanOfCare input[name=pemeriksaan_penunjang]`);
                    const checkNutrisi = $(`#formPlanOfCare input[name=diet]`);
                    const checkAktivitas = $(`#formPlanOfCare input[name=aktivitas]`);
                    const checkKeperawatan = $(`#formPlanOfCare input[name=keperawatan]`);
                    $(`#formPlanOfCare input[name=poli]`).val(`${response.reg_periksa.poliklinik.nm_poli}`)
                    $(`#formPlanOfCare input[name=dokter]`).val(`${response.reg_periksa.dokter.nm_dokter}`)
                    $(`#formPlanOfCare input[name=kd_dokter]`).val(`${response.reg_periksa.kd_dokter}`)


                    radioPengobatan.each((index, element) => {
                        const pengobatan = response.pengobatan ? response.pengobatan.split(' : ') : [''];
                        if (element.value == pengobatan[0]) {
                            $(`#formPlanOfCare input[id=${element.id}]`).prop('checked', true)
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).prop('disabled', false)
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).val(pengobatan[1])
                        }

                    })
                    checkKewaspadaan.each((index, element) => {
                        const find = arrKewaspadaan.find((el) => el == element.id)
                        $(`#formPlanOfCare input[id=${find}]`).prop('checked', true)

                    })

                    checkPemeriksaan.each((index, element) => {
                        const pemeriksaan = arrPemeriksaan.find((el) => el.split(' : ')[0].toLowerCase() == element.id)
                        if (pemeriksaan) {
                            $(`#formPlanOfCare input[id=${element.id}]`).prop('checked', true)
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).prop('disabled', false)
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).val(pemeriksaan.split(' : ')[1])
                        }
                    })
                    checkNutrisi.each((index, element) => {
                        const nutrisi = arrNutrisi.find((el) => el.split(' : ')[0].toLowerCase() === element.id)
                        const batasan = arrNutrisi.find((nut) => nut.split(' : ')[0].split(' ')[1]?.toLowerCase(), ' ===', 'cairan')
                        if (nutrisi) {
                            $(`#formPlanOfCare input[id=${element.id}]`).prop('checked', true)
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).val(nutrisi.split(' : ')[1])
                            $(`#formPlanOfCare input[id=ket_${element.id}]`).prop('disabled', false)
                        }
                        if (batasan) {
                            $(`#formPlanOfCare input[id=${element.id}]`).prop('checked', true)
                            $(`#formPlanOfCare input[id=keterangan_batasan]`).val(batasan.split(' : ')[2])
                            $(`#formPlanOfCare input[id=keterangan_batasan]`).prop('disabled', false)
                            $(`#formPlanOfCare input[id=${batasan.split(' : ')[1]}]`).prop('checked', true)

                        }
                    });
                    checkAktivitas.each((index, elemet) => {
                        const aktivitas = arrAktivitas.find((el) => el == elemet.value)
                        $(`#formPlanOfCare input[value='${aktivitas}']`).prop('checked', true)
                    })
                    checkKeperawatan.each((index, element) => {
                        const keperawatan = arrKeperawatan.find((el) => el == element.value)
                        $(`#formPlanOfCare input[value='${keperawatan}']`).prop('checked', true)
                    })

                    const tim = response.tim.map((personil, index) => {
                        return `<div class="col-lg-12 personil" id="personil${personil.id}">
                                <div class="input-group mb-1">
                                    <input class="form-control form-control-sm" name="personil" readonly value="${personil.petugas.nama}">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePersonilPoc('${personil.id}')"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>`
                    })
                    $('#formPlanOfCare').find('#perawat').prepend(tim)


                }

            })
            const petugas = $('#petugas1')
            selectPetugas(petugas)
            $('#modalPlanOfCare').modal('show');
        }

        function deletePersonilPoc(id) {
            $.post(`poc/tim/personil/delete/${id}`, {
                _token: "{{ csrf_token() }}"
            }).done((response) => {
                $('#formPlanOfCare').find(`#personil${id}`).remove();
            })
        }
        $('#btnTimPerawat').on('click', (e) => {
            const select = $('#perawat');
            const nextSelect = select.find('select').length + 1;

            const addSelect = `<div class="col-lg-12"><select class="search form-select" placeholder="Tim Perawatan" name="petugas" id="petugas${nextSelect}" style="width:100%;"></select></div>`
            select.append(addSelect)
            selectPetugas($(`#petugas${nextSelect}`))

        })

        function selectPetugas(params) {
            const select = params.select2({
                dropdownParent: $('#formPlanOfCare'),
                allowClear: true,
                delay: 0,
                scrollAfterSelect: true,
                ajax: {
                    url: 'petugas/cari',
                    dataType: 'json',
                    data: (params) => {
                        const query = {
                            q: params.term
                        }
                        return query
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nama,
                                    id: item.nip
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            return select;

        }
    </script>
@endpush
