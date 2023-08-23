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
                <button type="button" class="btn btn-primary btn-sm btn-asmed-ugd" onclick="" style="display: inline"><i class="bi bi-save"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-sm btn-asmed-ugd-ubah" onclick="" style="display: none"><i class="bi bi-pencil"></i> Ubah</button>
            </div>
        </div>
    </div>
</div>
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



        $('.btn-asmed-ugd').on('click', () => {
            var data = {};
            $('#formAsmedUgd input').each((index, element) => {
                keys = $(element).prop('name');
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

            data._token = "{{ csrf_token() }}"



            $.ajax({
                url: '/erm/ugd/asesmen/medis/simpan',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
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

        $('.btn-asmed-ugd-ubah').on('click', () => {
            var data = {};
            $('#formAsmedUgd input').each((index, element) => {
                keys = $(element).prop('name');
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

            data._token = "{{ csrf_token() }}"

            $.ajax({
                url: '/erm/ugd/asesmen/medis/ubah',
                data: data,
                method: 'POST',
                dataType: 'JSON',
            }).done((response) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses !',
                    text: 'Data berhasil diubah',
                    showConfirmButton: false,
                    timer: 1500
                })
                $('#modalAsmedUgd').modal('hide')
            });
        });

        $('#modalAsmedUgd').on('hidden.bs.modal', () => {
            $('#formAsmedUgd input').each((index, element) => {
                console.log(element)
                $(element).val('-');
            })
            $('#formAsmedUgd textarea').each((index, element) => {
                $(element).val('-');
            })
        })
    </script>
@endpush
