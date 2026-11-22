<form action="" method="POST" class="" id="formSoapRanap">
    {{-- Kartu Petugas, Alergi & Waktu Pemeriksaan --}}
    <div class="erm-section-card">
        <div class="erm-section-title">
            <span><i class="bi bi-person-check me-1"></i>Petugas, Alergi &amp; Waktu Pemeriksaan</span>
        </div>
        <div class="row g-2 align-items-end">
            <div class="col-12 col-md-6 col-xl-5">
                <label for="nama" class="form-label mb-1">Dilakukan Oleh</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ session()->get('pegawai')->nik }}" placeholder="" readonly style="max-width: 120px;">
                    <input type="search" class="form-control" id="nama" name="nama" value="{{ session()->get('pegawai')->nama }}" placeholder="" readonly>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl-3">
                <label for="alergi" class="form-label mb-1">Alergi</label>
                <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder=""
                    onfocus="removeZero(this)" onblur="cekKosong(this); if (typeof syncModalSoapRanapAlergi === 'function') syncModalSoapRanapAlergi(this.value);" value="-"
                    autocomplete="off">
            </div>
            <div class="col-6 col-md-6 col-xl-2 waktuSoap">
                <label for="tgl_perawatan_ubah" class="form-label mb-1">Tanggal</label>
                <input type="text" class="form-control form-control-sm" id="tgl_perawatan_ubah"
                    name="tgl_perawatan_ubah" placeholder="" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" value="-" autocomplete="off" disabled>
            </div>
            <div class="col-6 col-md-6 col-xl-2 waktuSoap">
                <label for="jam_rawat_ubah" class="form-label mb-1">Jam</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text px-2" title="Centang untuk menghentikan jam otomatis">
                        <input class="form-check-input mt-0" type="checkbox" value=""
                            aria-label="Stop jam otomatis" id="cekJam">
                    </span>
                    <input type="text" class="form-control" id="jam_rawat_ubah"
                        name="jam_rawat_ubah" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)"
                        value="" autocomplete="off" disabled>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Tanda-Tanda Vital (TTV) & EWS Maternal --}}
    <div class="erm-section-card">
        <div class="erm-section-title">
            <span><i class="bi bi-heart-pulse me-1"></i>Tanda-Tanda Vital (TTV) &amp; Antropometri</span>
        </div>
        <div class="row g-2">
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="suhu" class="form-label mb-1">Suhu (<sup>o</sup>C)</label>
                <input type="text" class="form-control form-control-sm" id="suhu"
                    name="suhu" placeholder="" maxlength="5" value="-" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="tensi" class="form-label mb-1">Tensi (mmHg)</label>
                <input type="text" class="form-control form-control-sm" id="tensi" name="tensi"
                    placeholder="" maxlength="8" onfocus="removeZero(this)" onblur="cekKosong(this)"
                    value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="nadi" class="form-label mb-1">Nadi (/mnt)</label>
                <input type="text" class="form-control form-control-sm" id="nadi"
                    name="nadi" placeholder="" maxlength="3" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="respirasi" class="form-label mb-1">Respirasi (/mnt)</label>
                <input type="text" class="form-control form-control-sm" id="respirasi"
                    name="respirasi" placeholder="" maxlength="3" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="spo2" class="form-label mb-1">SpO2 (%)</label>
                <input type="text" class="form-control form-control-sm" id="spo2" name="spo2"
                    placeholder="" maxlength="3" onfocus="removeZero(this)" onblur="cekKosong(this)"
                    value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="o2" class="form-label mb-1">O2</label>
                <input type="text" class="form-control form-control-sm" id="o2" name="o2"
                    placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)"
                    value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="tinggi" class="form-label mb-1">Tinggi (Cm)</label>
                <input type="text" class="form-control form-control-sm" id="tinggi"
                    name="tinggi" placeholder="" maxlength="5" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="berat" class="form-label mb-1">Berat (Kg)</label>
                <input type="text" class="form-control form-control-sm" id="berat"
                    name="berat" placeholder="" maxlength="5" onfocus="removeZero(this)"
                    onblur="cekKosong(this)" value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                <label for="gcs" class="form-label mb-1">GCS (E,V,M)</label>
                <input type="text" class="form-control form-control-sm" id="gcs" name="gcs"
                    placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)"
                    value="-" autocomplete="off">
            </div>
            <div class="col-6 col-sm-8 col-md-6 col-xl-3">
                <label for="kesadaran" class="form-label mb-1">Kesadaran</label>
                <select class="form-select form-select-sm" name="kesadaran" id="kesadaran">
                    <option value="Compos Mentis">Compos Mentis</option>
                    <option value="Apatis">Apatis</option>
                    <option value="Somnolence">Somnolence</option>
                    <option value="Sopor">Sopor</option>
                    <option value="Coma">Coma</option>
                </select>
            </div>
        </div>

        {{-- Parameter Tambahan EWS Maternal (tampil otomatis untuk spesialis S0001 / Obgyn) --}}
        <div class="formEws mt-3 pt-2 border-top">
            <div class="small fw-semibold text-primary mb-2">
                <i class="bi bi-activity me-1"></i>Parameter EWS Maternal
            </div>
            <div class="row g-2">
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="keluaran_urin" class="form-label mb-1">Keluaran Urin</label>
                    <select class="form-select form-select-sm" name="keluaran_urin" id="keluaran_urin">
                        <option value="" style="display:none"></option>
                        <option value="-">-</option>
                        <option value="Y">Y</option>
                        <option value="T">T</option>
                    </select>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="proteinuria" class="form-label mb-1">Proteinuria</label>
                    <select class="form-select form-select-sm" name="proteinuria" id="proteinuria">
                        <option value="" style="display:none"></option>
                        <option value="-">-</option>
                        <option value="++">++</option>
                        <option value="+++">+++</option>
                    </select>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="air_ketuban" class="form-label mb-1">Air Ketuban</label>
                    <select class="form-select form-select-sm" name="air_ketuban" id="air_ketuban">
                        <option value="" style="display:none"></option>
                        <option value="-" selected>-</option>
                        <option value="Jernih">Jernih/Pink</option>
                        <option value="Hijau">Hijau</option>
                    </select>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="skala_nyeri" class="form-label mb-1">Skala Nyeri</label>
                    <select class="form-select form-select-sm" name="skala_nyeri" id="skala_nyeri">
                        <option value="" style="display:none"></option>
                        <option value="-">-</option>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="lochia" class="form-label mb-1">Lochia</label>
                    <select class="form-select form-select-sm" name="lochia" id="lochia">
                        <option value="" style="display:none"></option>
                        <option value="-">-</option>
                        <option value="Normal">Normal</option>
                        <option value="Banyak">Banyak</option>
                    </select>
                </div>
                <div class="col-6 col-sm-4 col-lg-2">
                    <label for="terlihat_tidak_sehat" class="form-label mb-1">Tidak Sehat</label>
                    <select class="form-select form-select-sm" name="terlihat_tidak_sehat" id="terlihat_tidak_sehat">
                        <option value="" style="display:none"></option>
                        <option value="-" selected>-</option>
                        <option value="Tidak" selected>Tidak</option>
                        <option value="Ya">Ya</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Kartu Catatan SOAP (Subjek, Objek, Asesmen, Plan) --}}
    <div class="erm-section-card mb-0">
        <div class="erm-section-title">
            <span><i class="bi bi-journal-text me-1"></i>Catatan Perkembangan Pasien (SOAP)</span>
        </div>
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <div class="mb-2">
                    <label for="subjek" class="form-label mb-1 fw-semibold">S - Subjek</label>
                    <textarea class="form-control form-control-sm" name="subjek" id="subjek" cols="30" rows="4"
                        onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                </div>
                <div>
                    <label for="objek" class="form-label mb-1 fw-semibold">O - Objek</label>
                    <textarea class="form-control form-control-sm" name="objek" id="objek" cols="30" rows="4"
                        onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="mb-2">
                    <label for="asesmen" class="form-label mb-1 fw-semibold">A - Asesmen</label>
                    <textarea class="form-control form-control-sm" name="asesmen" id="asesmen" cols="30" rows="4"
                        onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                </div>
                <div>
                    <label for="plan" class="form-label mb-1 fw-semibold">P - Plan</label>
                    <textarea class="form-control form-control-sm" name="plan" id="plan" cols="30" rows="4"
                        onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                </div>
            </div>
        </div>

        <div class="d-none">
            <textarea class="form-control" name="instruksi" id="instruksi" cols="30" rows="3"
                onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
            <input type="hidden" name="tgl_perawatan" id="tgl_perawatan" value="">
            <input type="hidden" name="jam_rawat" id="jam_rawat" value="">
            <input type="hidden" name="spesialis" id="spesialis" value="">
        </div>

        <div class="mt-3 pt-2 border-top d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-primary btn-sm btn-simpan" onclick="simpanSoapRanap()"
                style="font-size: 12px"><i class="bi bi-save me-1"></i> Simpan</button>
            <button type="button" class="btn btn-warning btn-sm" id="btn-reset"
                style="font-size:12px;display:none"><i class="bi bi-arrow-clockwise me-1"></i> Baru</button>
            <button type="button" class="btn btn-success btn-sm" onclick="editSoap()" id="btn-ubah"
                style="font-size:12px;display:none"><i class="bi bi-pencil-square me-1"></i> Ubah</button>
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
                            tbSoapRanap(no_rawat);
                            if (typeof grafikPemeriksaan !== 'undefined' && grafikPemeriksaan) {
                                grafikPemeriksaan.destroy();
                            }
                            buildGrafik(no_rawat)
                            setEws(no_rawat, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            formSoapRanap.trigger('reset');
                            formSoapRanap.find('select[name=kesadaran]').val('Compos Mentis').change();
                            formSoapRanap.find('input[name=tgl_perawatan_ubah]').val('{{ date('d-m-Y') }}');
                            formSoapRanap.find('input[name=nik]').val('{{ session()->get('pegawai')->nik }}');
                            formSoapRanap.find('input[name=nama]').val('{{ session()->get('pegawai')->nama }}');
                            $('#tab-tabel').click();
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
                            const tgl_pertama = $('#tglSoap1_soap').val();
                            const tgl_kedua = $('#tglSoap2_soap').val();
                            tbSoapRanap(no_rawat);
                            if (typeof grafikPemeriksaan !== 'undefined' && grafikPemeriksaan) {
                                grafikPemeriksaan.destroy();
                            }
                            buildGrafik(no_rawat)
                            setEws(no_rawat, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            getInstance.show();
                            formSoapRanap.trigger('reset');
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
