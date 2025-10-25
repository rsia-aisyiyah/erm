<div class="modal fade" id="modalAsmedUgd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="border-radius:3pxpx">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN MEDIS GAWAT DARURAT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAsmedUgd">
                    <div class="row" style="font-size: 12px">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="pasien">
                                    Pasien
                                </label>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-4 col-lg-3">
                                        <input type="text" class="form-control form-control-sm no_rawat" placeholder="" aria-label="" name="no_rawat" id="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <label for="dokter">Dokter</label>
                                <div class="row">
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="hidden" class="kd_dokter"id="kd_dokter" name="kd_dokter">
                                        <input type="search" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="dokter">
                                        <div class="list-dokter"></div>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <div class="input-group">
                                            <select class="form-select form-select-sm" id="anamnesis" name="anamnesis">
                                                <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                                <option value="Alloanamnesis">Alloanamnesis</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm hubungan" placeholder="" aria-label="" id="hubungan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" name="hubungan">
                                        </div>
                                    </div>
                                    <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                        <input type="search" class="form-control form-control-sm tanggal" name="tanggal" placeholder="" aria-label="" id="tanggal" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-12">
                            <div class="separator m-2">TRIASE ( AUSTRALIAN TRIAGE SCALE )</div>
                            <table class="table table-bordered table-striped table-hover tblTriase">
                                <thead>
                                    <tr>
                                        <th class="all">
                                            <div class="text-nowrap">Prioritas</div>
                                            <div class="text-xs text-nowrap">Waktu Tunggu</div>
                                        </th>
                                        <th class="text-center text-nowrap bg-danger text-white">
                                            <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                <input type="checkbox" class="form-check-input me-2" name="ats_1" id="ats_1">
                                                <span class="mt-1">ATS I</span>
                                            </div>
                                            <div class="text-xs text-nowrap">Segera</div>
                                        </th>
                                        <th class="text-center bg-warning text-white">
                                            <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                <input type="checkbox" class="form-check-input me-2" name="ats_2" id="ats_2">
                                                <span class="mt-1">ATS II</span>
                                            </div>
                                            <div class="text-xs text-nowrap">10 Menit</div>
                                        </th>
                                        <th class="text-center bg-success text-white">
                                            <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                <input type="checkbox" class="form-check-input me-2" name="ats_3" id="ats_3">
                                                <span class="mt-1">ATS III</span>
                                            </div>
                                            <div class="text-xs text-nowrap">30 Menit</div>
                                        </th>
                                        <th class="text-center bg-primary text-white">
                                            <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                <input type="checkbox" class="form-check-input me-2" name="ats_4" id="ats_4">
                                                <span class="mt-1">ATS IV</span>
                                            </div>
                                            <div class="text-xs text-nowrap">60 Menit</div>
                                        </th>
                                        <th class="text-center">
                                            <div class="text-nowrap d-flex align-items-center justify-content-center">
                                                <input type="checkbox" class="form-check-input me-2" name="ats_5" id="ats_5">
                                                <span class="mt-1">ATS V</span>
                                            </div>
                                            <div class="text-xs text-nowrap">120 Menit</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            <div class="row">
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="keluhan">Keluhan Utama</label>
                                    <textarea class="form-control" name="keluhan_utama" id="keluhan_utama" name="keluhan_utama" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rps">Riwayat Penyakit Sekarang</label>
                                    <textarea class="form-control" name="rps" id="rps" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                                    <textarea class="form-control" name="rpd" id="rpd" cols="30" rows="5"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                                    <textarea class="form-control" name="rpk" id="rpk" cols="30" rows="2"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpo">Riwayat Penggunaan Obat</label>
                                    <textarea class="form-control" name="rpo" id="rpo" cols="30" rows="2"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-3 col-sm-12 col-md-6 col-lg-6">
                                    <label for="alergi">Alergi</label>
                                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder=""
                                        onfocus="removeZero(this)" onblur="cekKosong(this)" value="-">
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
                                        <option value="Apatis">Apatis</option>
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
                                    <label for="spo">SpO2(%)</label>
                                    <input type="text" class="form-control form-control-sm" id="spo" name="spo" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
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
                                            <label for="">Mata :</label>
                                            <select class="form-select" name="mata" id="mata">
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
                                            <label for="">Leher :</label>
                                            <select class="form-select" name="leher" id="leher">
                                                <option value="Normal">Normal</option>
                                                <option value="Abnormal">Abnormal</option>
                                                <option value="Tidak Diperiksa">Tidak Diperiksa</option>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                            <label for="">Thorax :</label>
                                            <select class="form-select" name="thoraks" id="thoraks">
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
                                            <label for="">Genital :</label>
                                            <select class="form-select" name="genital" id="genital">
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
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <label for="ket_fisik">Keterangan Fisik</label>
                                    <textarea class="form-control" name="ket_fisik" id="ket_fisik" cols="30" rows="9" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
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
                                    <textarea class="form-control" name="ket_lokalis" id="ket_lokalis" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>

                            </div>
                            <div class="separator m-2">4. Pemeriksaan Penunjang</div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="penunjang">EKG</label>
                                    <textarea class="form-control" name="ekg" id="ekg" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="lab">Laboratorium</label>
                                    <textarea class="form-control" name="lab" id="lab" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <label for="rad">Radiologi</label>
                                    <textarea class="form-control" name="rad" id="rad" cols="30" rows="3"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="separator m-2">5. Diagnosis / Asesmen</div>
                                    <textarea class="form-control" name="diagnosis" id="diagnosis" cols="30" rows="8"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="separator m-2">6. Tata Laksana</div>
                                    <textarea class="form-control" name="tata" id="tata" cols="30" rows="8"
                                        onfocus="removeZero(this)"
                                        onblur="cekKosong(this)">-</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm btn-asmed-ugd"><i class="bi bi-save"></i> Simpan</button>
                {{-- <button type="button" class="btn btn-warning btn-sm btn-asmed-ugd-ubah" onclick="" style="display: inline"><i class="bi bi-pencil"></i> Ubah</button> --}}
            </div>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush

@push('js')
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
@endpush

@push('script')
    <script>
        $('.dokter').on('keyup', (e) => {
            dokter = $('.dokter').val();
            if (dokter.length >= 3) {
                getDokter(dokter).done((response) => {
                    html =
                        '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;border-radius:3px;font-size:12px">';
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

        $('#modalAsmedUgd').on('hidden.bs.modal', () => {

        });

        function simpanTriase(data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url: '/erm/triase/simpan',
                type: 'POST',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    return true;
                },
                error: function(response) {
                    console.log(response);
                    return false;
                }
            });
        }

        $('.btn-asmed-ugd').on('click', () => {
            var data = {};
            var dataTriase = {};

            var no_rawat = '';

            $('#formAsmedUgd input').each((index, element) => {
                keys = $(element).prop('name');
                if ($(element).attr('type') == 'checkbox') {
                    return true;
                }

                if (keys == 'no_rawat') {
                    no_rawat = $(element).val();
                }

                data[keys] = $(element).val();

            })

            $('#formAsmedUgd select').each((index, element) => {
                keys = $(element).prop('name');
                data[keys] = $(element).val();
            })

            $('#formAsmedUgd textarea').each((index, element) => {
                keys = $(element).prop('name');
                data[keys] = $(element).val();
            })

            // checkbox
            $('#formAsmedUgd input[type=checkbox]').each((index, element) => {
                keys = $(element).prop('name').replaceAll('[', '_').replaceAll(']', '');
                var isChecked = $(element).is(":checked");

                var expKeys = keys.split('_');

                if (dataTriase[expKeys[0]] == undefined) {
                    dataTriase[expKeys[0]] = [];
                }

                var kode_skala_keys = 'kode_' + expKeys[0];

                // only push if checked
                if (isChecked) {
                    dataTriase[expKeys[0]].push({
                        'no_rawat': no_rawat,
                        [kode_skala_keys]: $(element).val()
                    });
                } else {
                    dataTriase[expKeys[0]].push({
                        'no_rawat': no_rawat,
                        [kode_skala_keys]: null
                    });
                }
            })

            data._token = "{{ csrf_token() }}"

            $.ajax({
                url: '/erm/ugd/asesmen/medis/simpan',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
                simpanTriase(dataTriase);
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses !',
                    text: 'Data berhasil berhasil ditambah',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#modalAsmedUgd').modal('hide')
            });
        });

        // $('.btn-asmed-ugd-ubah').on('click', () => {
        //     var data = {};
        //     var dataTriase = {};

        //     var no_rawat = '';

        //     $('#formAsmedUgd input').each((index, element) => {
        //         keys = $(element).prop('name');

        //         if ($(element).attr('type') == 'checkbox') {
        //             return true;
        //         }

        //         if (keys == 'no_rawat') {
        //             no_rawat = $(element).val();
        //         }

        //         data[keys] = $(element).val();
        //         data[keys] = $(element).val();

        //     })

        //     $('#formAsmedUgd select').each((index, element) => {
        //         keys = $(element).prop('name');
        //         data[keys] = $(element).val();
        //     })

        //     $('#formAsmedUgd textarea').each((index, element) => {
        //         keys = $(element).prop('name');
        //         data[keys] = $(element).val();
        //     })

        //     // checkbox
        //     $('#formAsmedUgd input[type=checkbox]').each((index, element) => {
        //         keys = $(element).prop('name').replaceAll('[', '_').replaceAll(']', '');
        //         var isChecked = $(element).is(":checked");

        //         var expKeys = keys.split('_');

        //         if (dataTriase[expKeys[0]] == undefined) {
        //             dataTriase[expKeys[0]] = [];
        //         }

        //         var kode_skala_keys = 'kode_' + expKeys[0];

        //         // only push if checked
        //         if (isChecked) {
        //             dataTriase[expKeys[0]].push({
        //                 'no_rawat': no_rawat,
        //                 [kode_skala_keys]: $(element).val()
        //             });
        //         } else {
        //             dataTriase[expKeys[0]].push({
        //                 'no_rawat': no_rawat,
        //                 [kode_skala_keys]: null
        //             });
        //         }
        //     })

        //     data._token = "{{ csrf_token() }}"

        //     $.ajax({
        //         url: '/erm/ugd/asesmen/medis/ubah',
        //         data: data,
        //         method: 'POST',
        //         dataType: 'JSON',
        //     }).done((response) => {
        //         simpanTriase(dataTriase);
        //         Swal.fire({
        //             icon: 'success',
        //             title: 'Sukses !',
        //             text: 'Data berhasil diubah',
        //             showConfirmButton: false,
        //             timer: 1500
        //         })
        //         $('#modalAsmedUgd').modal('hide')
        //     });
        // });

        $('#modalAsmedUgd').on('hidden.bs.modal', () => {
            $('#formAsmedUgd input').each((index, element) => {
                $(element).val('-');
            })
            $('#formAsmedUgd textarea').each((index, element) => {
                $(element).val('-');
            })

            $('.tblTriase').DataTable().destroy();
        });

        for (let index = 1; index <= 5; index++) {
            $('#modalAsmedUgd').on('change', '#ats_' + index, function() {
                if ($(this).is(":checked")) {
                    $('.item-skala' + index).each((i, element) => {
                        $(element).prop('disabled', false);
                    })
                } else {
                    $('.item-skala' + index).each((i, element) => {
                        $(element).prop('disabled', true);
                        $(element).prop('checked', false);
                    })
                }
            });
        }

        $("#modalAsmedUgd").on('show.bs.modal', function(e) {
            setTimeout(() => {
                var no_rawat = $("#modalAsmedUgd #no_rawat").val();

                $('.tblTriase').DataTable({
                    responsive: true,
                    paging: false,
                    searching: false,
                    info: false,
                    ordering: false,
                    ajax: {
                        url: '/erm/triase/get/indikator',
                        data: {
                            no_rawat: no_rawat
                        }
                    },
                    columns: [{
                            data: 'nama_pemeriksaan'
                        },
                        {
                            data: 'skala1',
                            render: function(data) {
                                var skala1 = JSON.parse(data); // Parse string JSON menjadi objek JavaScript
                                var html = '<div class="d-flex flex-column">';
                                skala1.forEach(function(item) {
                                    var c = '';
                                    if (item.triase && item.triase.kode_skala1 == item.kode_skala1) {
                                        $("#ats_1").prop('checked', true);
                                        c = 'checked';
                                    } else {
                                        $("#ats_1").prop('checked', false);
                                    }

                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala1" disabled type="checkbox" name="skala1[' + item.kode_skala1 + ']" id="skala1_' + item.kode_skala1 + '" value="' + item.kode_skala1 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala1_' + item.kode_skala1 + '">' + item.pengkajian_skala1 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala2',
                            render: function(data) {
                                var skala2 = JSON.parse(data); // Parse string JSON menjadi objek JavaScript
                                var html = '<div class="d-flex flex-column">';
                                skala2.forEach(function(item) {
                                    var c = '';
                                    if (item.triase && item.triase.kode_skala1 == item.kode_skala1) {
                                        $("#ats_2").prop('checked', true);
                                        c = 'checked';
                                    } else {
                                        $("#ats_2").prop('checked', false);
                                    }

                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala2" disabled type="checkbox" name="skala2[' + item.kode_skala2 + ']" id="skala2_' + item.kode_skala2 + '" value="' + item.kode_skala2 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala2_' + item.kode_skala2 + '">' + item.pengkajian_skala2 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala3',
                            render: function(data) {
                                var skala3 = JSON.parse(data); // Parse string JSON menjadi objek JavaScript
                                var html = '<div class="d-flex flex-column">';
                                skala3.forEach(function(item) {
                                    var c = '';
                                    if (item.triase && item.triase.kode_skala1 == item.kode_skala1) {
                                        $("#ats_3").prop('checked', true);
                                        c = 'checked';
                                    } else {
                                        $("#ats_3").prop('checked', false);
                                    }

                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala3" disabled type="checkbox" name="skala3[' + item.kode_skala3 + ']" id="skala3_' + item.kode_skala3 + '" value="' + item.kode_skala3 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala3_' + item.kode_skala3 + '">' + item.pengkajian_skala3 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala4',
                            render: function(data) {
                                var skala4 = JSON.parse(data); // Parse string JSON menjadi objek JavaScript
                                var html = '<div class="d-flex flex-column">';
                                skala4.forEach(function(item) {
                                    var c = '';
                                    if (item.triase && item.triase.kode_skala1 == item.kode_skala1) {
                                        $("#ats_4").prop('checked', true);
                                        c = 'checked';
                                    } else {
                                        $("#ats_4").prop('checked', false);
                                    }

                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala4" disabled type="checkbox" name="skala4[' + item.kode_skala4 + ']" id="skala4_' + item.kode_skala4 + '" value="' + item.kode_skala4 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala4_' + item.kode_skala4 + '">' + item.pengkajian_skala4 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                        {
                            data: 'skala5',
                            render: function(data) {
                                var skala5 = JSON.parse(data); // Parse string JSON menjadi objek JavaScript
                                var html = '<div class="d-flex flex-column">';
                                skala5.forEach(function(item) {
                                    var c = '';
                                    if (item.triase && item.triase.kode_skala1 == item.kode_skala1) {
                                        $("#ats_5").prop('checked', true);
                                        c = 'checked';
                                    } else {
                                        $("#ats_5").prop('checked', false);
                                    }

                                    html += '<div class="form-check form-check-inline">';
                                    html += '<input class="form-check-input item-skala5" disabled type="checkbox" name="skala5[' + item.kode_skala5 + ']" id="skala5_' + item.kode_skala5 + '" value="' + item.kode_skala5 + '" ' + c + '>';
                                    html += '<label class="form-check-label text-nowrap" for="skala5_' + item.kode_skala5 + '">' + item.pengkajian_skala5 + '</label>';
                                    html += '</div>';
                                });
                                html += '</div>';
                                return html;
                            }
                        },
                    ]
                });
            }, 1000);

            setInterval(() => {
                for (let index = 1; index <= 5; index++) {
                    if ($('.item-skala' + index + ':checked').length > 0) {
                        $('.item-skala' + index).each((i, element) => {
                            $(element).prop('disabled', false);
                        })

                        $("#ats_" + index).prop('checked', true);
                    }
                }
            }, 1500);
        });

        function modalAsmedUgd(params) {
            getAsmedUgd(params).done((response) => {
                if (Object.keys(response).length == 0) {
                    return getRegPeriksa(params).done((regPeriksa) => {

                        $('.btn-asmed-ugd-ubah').css('display', 'none')
                        $('.btn-asmed-ugd').css('display', 'inline')
                        $('#formAsmedUgd input[name="no_rawat"]').val(regPeriksa.no_rawat)
                        $('#formAsmedUgd input[name="pasien"]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                        $('#formAsmedUgd input[name="tgl_lahir"]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} (${hitungUmur(regPeriksa.pasien.tgl_lahir)})`)
                        $('#formAsmedUgd input[name="kd_dokter"]').val("{{ session()->get('pegawai')->nik }}")
                        $('#formAsmedUgd input[name="dokter"]').val("{{ session()->get('pegawai')->nama }}")
                        $('#formAsmedUgd input[name="tanggal"]').val(`${formatTanggal("{{ date('Y-m-d') }}")} {{ date('H:i:s') }}`)

                    })
                } else {
                    $('#formAsmedUgd input[name="no_rawat"]').val(response.no_rawat)
                    $('#formAsmedUgd input[name="pasien"]').val(`${response.reg_periksa.pasien.nm_pasien} (${response.reg_periksa.pasien.jk})`)
                    $('#formAsmedUgd input[name="tgl_lahir"]').val(`${formatTanggal(response.reg_periksa.pasien.tgl_lahir)} (${hitungUmur(response.reg_periksa.pasien.tgl_lahir)})`)
                    $('#formAsmedUgd input[name="kd_dokter"]').val(response.kd_dokter)
                    $('#formAsmedUgd input[name="dokter"]').val(response.dokter.nm_dokter)
                    $('#formAsmedUgd input[name="tanggal"]').val(response.tanggal)
                    $('#formAsmedUgd input[name="tanggal"]').attr('style', 'background-color: #e9ecef;cursor:not-allowed')
                    $('#formAsmedUgd select[name="anamnesis"]').val(response.anamnesis).change()
                    $('#formAsmedUgd input[name="hubungan"]').val(response.hubungan)
                    $('#formAsmedUgd textarea[name="keluhan_utama"]').val(response.keluhan_utama)
                    $('#formAsmedUgd textarea[name="rps"]').val(response.rps)
                    $('#formAsmedUgd textarea[name="rpd"]').val(response.rpd)
                    $('#formAsmedUgd textarea[name="rpk"]').val(response.rpk)
                    $('#formAsmedUgd textarea[name="rpo"]').val(response.rpo)
                    $('#formAsmedUgd input[name="alergi"]').val(response.alergi)
                    $('#formAsmedUgd select[name="keadaan"]').val(response.keadaan).change()
                    $('#formAsmedUgd select[name="kesadaran"]').val(response.kesadaran).change()
                    $('#formAsmedUgd input[name="gcs"]').val(response.gcs)
                    $('#formAsmedUgd input[name="tb"]').val(response.tb)
                    $('#formAsmedUgd input[name="bb"]').val(response.bb)
                    $('#formAsmedUgd input[name="td"]').val(response.td)
                    $('#formAsmedUgd input[name="nadi"]').val(response.nadi)
                    $('#formAsmedUgd input[name="rr"]').val(response.rr)
                    $('#formAsmedUgd input[name="suhu"]').val(response.suhu)
                    $('#formAsmedUgd input[name="spo"]').val(response.spo)
                    $('#formAsmedUgd select[name="kepala"]').val(response.kepala).change()
                    $('#formAsmedUgd select[name="mata"]').val(response.mata).change()
                    $('#formAsmedUgd select[name="gigi"]').val(response.gigi).change()
                    $('#formAsmedUgd select[name="leher"]').val(response.leher).change()
                    $('#formAsmedUgd select[name="thoraks"]').val(response.thoraks).change()
                    $('#formAsmedUgd select[name="abdomen"]').val(response.abdomen).change()
                    $('#formAsmedUgd select[name="ekstremitas"]').val(response.ekstremitas).change()
                    $('#formAsmedUgd textarea[name="ket_fisik"]').val(response.ket_fisik)
                    $('#formAsmedUgd textarea[name="ket_lokalis"]').val(response.ket_lokalis)
                    $('#formAsmedUgd textarea[name="ekg"]').val(response.ekg)
                    $('#formAsmedUgd textarea[name="lab"]').val(response.lab)
                    $('#formAsmedUgd textarea[name="rad"]').val(response.rad)
                    $('#formAsmedUgd textarea[name="diagnosis"]').val(response.diagnosis)
                    $('#formAsmedUgd textarea[name="tata"]').val(response.tata)


                }

            })
            $('#modalAsmedUgd').modal('show');
        }
    </script>
@endpush
