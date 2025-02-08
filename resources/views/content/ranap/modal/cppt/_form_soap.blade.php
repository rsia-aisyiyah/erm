<form action="" method="POST" class="" id="formSoapRanap">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <table class="borderless text-sm">
                <tr>
                    <td width="10%">Dilakukan Oleh :</td>
                    <td width="60%" colspan="2">
                        <div class="input-group input-group-sm">
                            <div class="input-group-text"><i class="bi bi-person"></i></div>
                            <input type="text" class="form-control form-control-sm" id="nik" name="nik"
                                placeholder="" readonly>
                            <input type="search" class="form-control form-control-sm w-50" id="nama" name="nama"
                                placeholder="" readonly>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Subjek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="subjek" id="subjek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Objek : </td>
                    <td colspan="3">
                        <textarea class="form-control" name="objek" id="objek" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%">
                                Suhu (<sup>0</sup>C) : <input type="text" class="form-control form-control-sm"
                                    id="suhu" name="suhu" placeholder="" maxlength="5"
                                    value="-"
                                    onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
                                Tinggi (Cm): <input type="text" class="form-control form-control-sm" id="tinggi"
                                    name="tinggi" placeholder="" maxlength="5"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
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
                            <td width="12%">
                                Tensi : <input type="text" class="form-control form-control-sm" id="tensi"
                                    name="tensi" placeholder="" maxlength="8"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
                                Respirasi (/mnt): <input type="text" class="form-control form-control-sm"
                                    id="respirasi" name="respirasi" placeholder="" maxlength="3"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
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
                            <td width="12%">
                                SpO2 (%): <input type="text" class="form-control form-control-sm" id="spo2"
                                    name="spo2" placeholder="" maxlength="3"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
                                GCS (E,V,M): <input type="text" class="form-control form-control-sm"
                                    id="gcs" name="gcs" placeholder="" maxlength="10"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
                            </td>
                            <td width="12%">
                                O2: <input type="text" class="form-control form-control-sm"
                                    id="o2" name="o2" placeholder="" maxlength="10"
                                    onfocus="removeZero(this)"
                                    onblur="cekKosong(this)" value="-" autocomplete="off">
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
                        </table>
                    </td>
                </tr>
                <tr class="formEws">
                    <td></td>
                    <td colspan="3">
                        <table>
                            <td width="12%">
                                Keluaran Urin : <select class="form-select" name="keluaran_urin" id="keluaran_urin">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="Y">Y</option>
                                    <option value="T">T</option>
                                </select>
                            </td>
                            <td width="12%">
                                Proteinuria : <select class="form-select" name="proteinuria" id="proteinuria">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="++">++</option>
                                    <option value="+++">+++</option>
                                </select>
                            </td>
                            <td width="12%">
                                Air Ketuban : <select class="form-select" name="air_ketuban" id="air_ketuban">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Jernih">Jernih/Pink</option>
                                    <option value="Hijau">Hijau</option>
                                </select>
                            </td>
                            <td width="12%">
                                Skala Nyeri : <select class="form-select" name="skala_nyeri" id="skala_nyeri">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </td>
                            <td width="12%">
                                Lochia : <select class="form-select" name="lochia" id="lochia">
                                    <option value="" style="display:none"></option>
                                    <option value="-">-</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Banyak">Banyak</option>
                                </select>
                            </td>
                            <td width="12%">
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
                    <td width="5%">Asesmen : </td>
                    <td colspan="4" width="5%">
                        <textarea class="form-control" name="asesmen" id="asesmen" cols="30" rows="5"
                            onfocus="removeZero(this)"
                            onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Plan : </td>
                    <td colspan="4">
                        <textarea class="form-control" name="plan" id="plan" cols="30" rows="5"
                            onfocus="removeZero(this)"
                            onblur="cekKosong(this)">-</textarea>
                    </td>
                </tr>
                <tr class="d-none">
                    <td>Instruksi : </td>
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

@push('script')
    <script>
        $('#btn-reset').on('click', function(event) {
            no_rawat = formSoapRanap.find('input[name="nomor_rawat"]').val();
            formSoapRanap.find('input').each((index, element) => {
                $(element).val('-');
                $(element).removeAttr('readonly');
                $('#jam_rawat').val('');
                $('#tgl_perawatan').val('');
            })
            formSoapRanap.find('textarea').each((index, element) => {
                $(element).val('-')
            });

            formSoapRanap.find('textarea').removeAttr('readonly')
            formSoapRanap.find('select').removeAttr('disabled', false)

            getRegPeriksa(no_rawat).done((response) => {

                formSoapRanap.find('input[name="nomor_rawat"]').val(response.no_rawat)
                formSoapRanap.find('input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
                formSoapRanap.find('input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
                formSoapRanap.find('input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")

                formSoapRanap.find('input[name="nomor_rawat"]').attr('readonly', true)
                formSoapRanap.find('input[name="nm_pasien"]').attr('readonly', true)
                formSoapRanap.find('input[name="nama"]').attr('readonly', true)
                formSoapRanap.find('input[name="nik"]').attr('readonly', true)
            })


            $('#btn-reset').css('display', 'none')
            $('#btn-ubah').css('display', 'none')

        });

        function simpanSoapRanap() {

            const no_rawat = modalSoapRanap.find('input[name=no_rawat]').val();
            let kd_dokter = formSoapRanap.find('.btn-simpan').attr('data-kd-dokter');
            let spesialis = formSoapRanap.find('.btn-simpan').attr('data-spesialis');
            let nm_pasien = formSoapRanap.find('.btn-simpan').attr('data-nm-pasien');
            $.ajax({
                url: '/erm/soap/simpan',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'sumber': 'SOAP',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': $('#nik').val(),
                    'no_rawat': no_rawat,
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'nadi': $('#nadi').val(),
                    'tensi': $('#tensi').val(),
                    'spo2': $('#spo2').val(),
                    'gcs': $('#gcs').val(),
                    'o2': $('#o2').val(),
                    'kesadaran': $('#kesadaran option:selected').val(),
                    'alergi': $('#alergi').val(),
                    'keluhan': $('#subjek').val(),
                    'pemeriksaan': $('#objek').val(),
                    'penilaian': $('#asesmen').val(),
                    'rtl': $('#plan').val(),
                    'instruksi': $('#instruksi').val(),
                    'keluaran_urin': $('.formEws select[name=keluaran_urin]').val(),
                    'proteinuria': $('.formEws select[name=proteinuria]').val(),
                    'air_ketuban': $('.formEws select[name=air_ketuban]').val(),
                    'skala_nyeri': $('.formEws select[name=skala_nyeri]').val(),
                    'lochia': $('.formEws select[name=lochia]').val(),
                    'terlihat_tidak_sehat': $('.formEws select[name=terlihat_tidak_sehat]').val(),
                },
                method: 'POST',
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUKSES !',
                            text: 'Data Berhasil Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                            grafikPemeriksaan.destroy();
                            buildGrafik(no_rawat_soap)
                            setEws(no_rawat_soap, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            formSoapRanap.find('textarea[name=subjek]').val('-');
                            formSoapRanap.find('textarea[name=objek]').val('-');
                            formSoapRanap.find('textarea[name=asesmen]').val('-');
                            formSoapRanap.find('textarea[name=plan]').val('-');
                            formSoapRanap.find('textarea[name=instruksi]').val('-');
                            formSoapRanap.find('input[name=suhu]').val('-');
                            formSoapRanap.find('input[name=tinggi]').val('-');
                            formSoapRanap.find('input[name=berat]').val('-');
                            formSoapRanap.find('input[name=tensi]').val('-');
                            formSoapRanap.find('input[name=respirasi]').val('-');
                            formSoapRanap.find('input[name=nadi]').val('-');
                            formSoapRanap.find('input[name=spo2]').val('-');
                            formSoapRanap.find('input[name=gcs]').val('-');
                            formSoapRanap.find('input[name=o2]').val('-');
                            formSoapRanap.find('input[name=alergi]').val('-');
                            formSoapRanap.find('select[name=kesadaran]').val('Compos Mentis').change();
                            getInstance.show()
                        });

                        var suhu_tubuh = $('#suhu').val();
                        if (suhu_tubuh.includes(',')) {
                            suhu_tubuh = suhu_tubuh.replace(',', '.');
                        }

                        if (spesialis.toLowerCase().includes('anak')) {
                            console.log('anak');
                            if (suhu_tubuh < 35.5 || suhu_tubuh > 39.5) {
                                console.log('kirim notif');
                                notifSend(
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    $('#nomor_rawat').val(),
                                    'Ranap',
                                    'detail'
                                );
                            }
                        } else {
                            console.log('bukan anak');
                            if (suhu_tubuh < 36 || suhu_tubuh > 38) {
                                console.log('kirim notif');
                                notifSend(
                                    // FIXME : kd_dokter masih belum benar
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    $('#nomor_rawat').val(),
                                    'Ranap',
                                    'detail'
                                );
                            }
                        }


                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'GAGAL !',
                            text: 'Data Gagal Ditambah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                },
                error: (request) => {
                    alertErrorAjax(request);
                }
            })
        }

        function editSoap() {
            const no_rawat = modalSoapRanap.find('input[name=no_rawat]').val();
            $.ajax({
                url: 'soap/ubah',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'suhu_tubuh': $('#suhu').val(),
                    'nip': $('#nik').val(),
                    'no_rawat': no_rawat,
                    'jam_rawat': $('#jam_rawat').val(),
                    'tgl_perawatan': $('#tgl_perawatan').val(),
                    'tinggi': $('#tinggi').val(),
                    'berat': $('#berat').val(),
                    'respirasi': $('#respirasi').val(),
                    'tensi': $('#tensi').val(),
                    'nadi': $('#nadi').val(),
                    'kesadaran': $('#kesadaran option:selected').val(),
                    'spo2': $('#spo2').val(),
                    'o2': $('#o2').val(),
                    'gcs': $('#gcs').val(),
                    'alergi': $('#alergi').val(),
                    'keluhan': $('#subjek').val(),
                    'pemeriksaan': $('#objek').val(),
                    'penilaian': $('#asesmen').val(),
                    'rtl': $('#plan').val(),
                    'evaluasi': $('#plan').val(),
                    'instruksi': $('#instruksi').val(),
                    'tgl_perawatan_ubah': splitTanggal($('#tgl_perawatan_ubah').val()),
                    'jam_rawat_ubah': $('#jam_rawat_ubah').val(),
                },
                method: 'POST',
                beforeSend: function() {
                    swal.fire({
                        title: 'Sedang mengirim data',
                        text: 'Mohon Tunggu',
                        showConfirmButton: false,
                        didOpen: () => {
                            swal.showLoading();
                        }
                    })
                },
                error: (request, status, error) => {
                    Swal.fire(
                        'Gagal !',
                        `Tidak bisa mengubah pemeriksaan<br/> Kode ${request.status} : ${request.statusText} `,
                        'error',
                    )
                },
                success: function(response) {
                    if (response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'SUKSES !',
                            text: 'Data Berhasil Diubah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            tbSoapRanap(no_rawat_soap, tgl_pertama, tgl_kedua);
                            grafikPemeriksaan.destroy();
                            buildGrafik(no_rawat_soap)
                            setEws(no_rawat_soap, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            getInstance.show();
                            const isTriggering = formSoapRanap.reset('triger');
                            $('#btn-ubah').css('display', 'none')
                            $('#btn-reset').css('display', 'none')
                        })
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'GAGAL !',
                            text: 'Data Gagal Diubah',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }


                }
            })
        }
    </script>
@endpush
