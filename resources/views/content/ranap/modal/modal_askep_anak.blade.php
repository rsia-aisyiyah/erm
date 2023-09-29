<div class="modal fade" id="modalAskepRanapAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN KEPERAWATAN ANAK</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAskepAnakRanap">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-2">
                                <label for="pasien">Pasien</label>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <input type="text" class="form-control form-control-sm no_rawat" name="no_rawat" placeholder="" aria-label="" id="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-6 col-lg-2">
                                    <label for="">Dokter DPJP</label>
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" name="kd_dokter" readonly>
                                </div>
                                <div class="col-sm-8 col-md-6 col-lg-4">
                                    <label for=""></label>
                                    <input type="search" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="dokter" autocomplete="off" readonly>
                                    <div class="list-dokter"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control form-control-sm tanggal" name="tanggal" placeholder="" aria-label="" id="tanggal" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="jam">Jam</label>
                                    <input type="text" class="form-control form-control-sm jam" name="jam" placeholder="" aria-label="" id="jam" value="{{ date('H:i:s') }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="kasus_trauma">Kasus</label>
                                    <select class="form-select form-select-sm" id="kasus_trauma" style="font-size: 12px;height:28px" name="kasus_trauma">
                                        <option value="Trauma" selected>Trauma</option>
                                        <option value="Non Trauma">Non Trauma</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-2">
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="nip1">Pengkaji 1</label>
                                    <input type="search" class="form-control form-control-sm nip1" placeholder="" aria-label="" id="nip1" name="nip1" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip1"></label>
                                    <input type="search" class="form-control form-control-sm pengkaji1" placeholder="" aria-label="" id="pengkaji1" name="pengkaji1" onkeyup="cariPetugasAskep(this, 1)">
                                    <div class="list_petugas1"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="nip2">Pengkaji 2</label>
                                    <input type="search" class="form-control form-control-sm nip2" placeholder="" aria-label="" id="nip2" name="nip2" readonly value="-">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip2"></label>
                                    <input type="search" class="form-control form-control-sm pengkaji2" placeholder="" aria-label="" id="pengkaji2" name="pengkaji2" onkeyup="cariPetugasAskep(this, 2)" value="-">
                                    <div class="list_petugas2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <label for="nip2">Anamnesis</label>
                                    <div class="input-group">
                                        <select class="form-select form-select-sm" id="anamnesis" name="informasi" style="font-size: 12px">
                                            <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                            <option value="Alloanamnesis">Alloanamnesis</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm hubungan" placeholder="" aria-label="" id="ket_informasi" name="ket_informasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label for="tiba_diruang_rawat">Tiba di ruang</label>
                                    <select class="form-select form-select-sm" id="tiba_diruang_rawat" name="tiba_diruang_rawat" style="font-size: 12px;height:28px">
                                        <option value="Jalan Tanpa Bantuan" selected>Jalan Tanpa Bantuan</option>
                                        <option value="Kursi Roda">Kursi Roda</option>
                                        <option value="Brankar">Brankar</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="cara_masuk">Cara Masuk</label>
                                    <select class="form-select form-select-sm" id="cara_masuk" name="cara_masuk" style="font-size: 12px;height:28px">
                                        <option value="Poli" selected>Poli</option>
                                        <option value="IGD">IGD</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rps">Riwayat Penyakit Sekarang</label>
                                    <textarea class="form-control" name="rps" id="rps" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpd">Riwayat Penyakit Dahulu</label>
                                    <textarea class="form-control" name="rpd" id="rpd" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                                    <textarea class="form-control" name="rpk" id="rpk" cols="30" rows="2" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpo">Riwayat Penggunaan Obat</label>
                                    <textarea class="form-control" name="rpo" id="rpo" cols="30" rows="2" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_pembedahan">Riwayat Pembedahan</label>
                                    <input type="text" class="form-control form-control-sm" id="riwayat_pembedahan" name="riwayat_pembedahan" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_dirawat_dirs">Riwayat Perawatan di RS</label>
                                    <input type="text" class="form-control form-control-sm" id="riwayat_dirawat_dirs" name="riwayat_dirawat_dirs" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_transfusi">Riwayat Transfusi</label>
                                    <input type="text" class="form-control form-control-sm" id="riwayat_transfusi" name="riwayat_transfusi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="alat_bantu_dipakai">Alat Bantu yang Dipakai</label>
                                    <select class="form-select" name="alat_bantu_dipakai" id="alat_bantu_dipakai">
                                        <option value="Kacamata">Kacamata</option>
                                        <option value="Prothesa">Prothesa</option>
                                        <option value="Alat Bantu Dengar">Alat Bantu Dengar</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                    <input type="hidden" name="riwayat_kehamilan" value="-">
                                    <input type="hidden" name="riwayat_kehamilan_perkiraan" value="-">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="rpk">Alergi</label>
                                    <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_merokok">Merokok /btg perhari</label>
                                    <div class="input-group">
                                        <select class="form-select" name="riwayat_merokok" id="riwayat_merokok">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="riwayat_merokok_jumlah" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="riwayat_merokok_jumlah">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_alkohol">Alkohol /gls perhari</label>
                                    <div class="input-group">
                                        <select class="form-select" name="riwayat_alkohol" id="riwayat_alkohol">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="riwayat_alkohol_jumlah" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="riwayat_alkohol_jumlah">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_narkoba">Obat Tidur</label>
                                    <select class="form-select" name="riwayat_narkoba" id="riwayat_narkoba">
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <label for="riwayat_olahraga">Olahraga</label>
                                    <select class="form-select" name="riwayat_olahraga" id="riwayat_olahraga">
                                        <option value="Tidak">Tidak</option>
                                        <option value="Ya">Ya</option>
                                    </select>
                                </div>
                            </div>

                            <div class="separator m-2">2. Pemeriksaan Fisik</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <label for="">Kesadaran Mental:</label>
                                    <select class="form-select" name="pemeriksaan_mental" id="pemeriksaan_mental">
                                        <option value="Compos Mentis">Compos Mentis</option>
                                        <option value="Somnolence">Somnolence</option>
                                        <option value="Sopor">Sopor</option>
                                        <option value="Coma">Coma</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <label for="pemeriksaan_keadaan_umum">Keadaan Umum:</label>
                                    <select class="form-select" name="pemeriksaan_keadaan_umum" id="pemeriksaan_keadaan_umum">
                                        <option value="Baik">Baik</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Buruk">Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_gcs">GCS (E,V,M)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_gcs" name="pemeriksaan_gcs" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_td">TD (mmHg)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_td" name="pemeriksaan_td" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_nadi">Nadi (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_nadi" name="pemeriksaan_nadi" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_rr">RR (x/menit)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_rr" name="pemeriksaan_rr" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_suhu">Suhu (<sup>0</sup>C)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_suhu" name="pemeriksaan_suhu" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-3 col-sm-12 col-md-4 col-lg-2">
                                    <label for="pemeriksaan_spo2">SpO2(%)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_spo2" name="pemeriksaan_spo2" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <label for="pemeriksaan_tb">TB (cm)</label>
                                    <input type="text" class="form-control form-control-sm" id="pemeriksaan_tb" name="pemeriksaan_tb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <label for="bb">BB (Kg)</label>
                                    <input type="text" class="form-control form-control-sm" id="bb" name="bb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                </div>
                                <div class="row">
                                    {{-- <div class="separator m-2"></div> --}}
                                    <label for="" class="mb-2">a. Sistem Susunan Saraf Pusat</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_susunan_kepala">Kepala</label>
                                            <select class="form-select" name="pemeriksaan_susunan_kepala" id="pemeriksaan_susunan_kepala" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Hydrocephalus">Hydrocephalus</option>
                                                <option value="Hematoma">Hematoma</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_susunan_kepala_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="pemeriksaan_susunan_kepala_keterangan">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_susunan_wajah">Wajah</label>
                                            <select class="form-select" name="pemeriksaan_susunan_wajah" id="pemeriksaan_susunan_wajah" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Asimetris">Asimetris</option>
                                                <option value="Kelainan Kongenital">Kelainan Kongenital</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_susunan_wajah_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="pemeriksaan_susunan_wajah_keterangan">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_susunan_leher">Leher</label>
                                            <select class="form-select" name="pemeriksaan_susunan_leher" id="pemeriksaan_susunan_leher" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Kaku Kuduk">Kaku Kuduk</option>
                                                <option value="Pembesaran Thyroid">Pembesaran Thyroid</option>
                                                <option value="Pembesaran KGB">Pembesaran KGB</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_susunan_kejang" style="padding: 5px">Kejang</label>
                                            <select class="form-select" name="pemeriksaan_susunan_kejang" id="pemeriksaan_susunan_kejang" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Kuat">Kuat</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_susunan_kejang_keterangan" name="pemeriksaan_susunan_kejang_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_susunan_sensorik">Sensorik</label>
                                            <select class="form-select" name="pemeriksaan_susunan_sensorik" id="pemeriksaan_susunan_sensorik" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Sakit Nyeri">Sakit Nyeri</option>
                                                <option value="Rasa Kebas">Rasa Kebas</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label for="" class="mb-2">b. Kardiovaskuler</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_kardiovaskuler_pulsasi">Pulasasi</label>
                                            <select class="form-select" name="pemeriksaan_kardiovaskuler_pulsasi" id="pemeriksaan_kardiovaskuler_pulsasi" style="border-radius:6px">
                                                <option value="Kuat">Kuat</option>
                                                <option value="Lemah">Lemah</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_kardiovaskuler_sirkulasi">Sirkulasi</label>
                                            <select class="form-select" name="pemeriksaan_kardiovaskuler_sirkulasi" id="pemeriksaan_kardiovaskuler_sirkulasi" style="border-radius:6px 0 0 6px">
                                                <option value="Akral Hangat">Akral Hangat</option>
                                                <option value="Akral Dingin">Akral Dingin</option>
                                                <option value="Edema">Edema</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" name="pemeriksaan_kardiovaskuler_sirkulasi_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_kardiovaskuler_denyut_nadi">Denyut Nadi</label>
                                            <select class="form-select" name="pemeriksaan_kardiovaskuler_denyut_nadi" id="pemeriksaan_kardiovaskuler_denyut_nadi" style="border-radius:6px">
                                                <option value="Teratur">Teratur</option>
                                                <option value="Tidak Teratur">Tidak Teratur</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label class="mb-2">c. Respirasi</label>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_retraksi">Retraksi</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_retraksi" id="pemeriksaan_respirasi_retraksi" style="border-radius:6px">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ringan">Ringan</option>
                                                <option value="Berat">Berat</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_pola_navas">Pola Nafas</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_pola_nafas" id="pemeriksaan_respirasi_pola_nafas" style="border-radius:6px">
                                                <option value="Normal">Normal</option>
                                                <option value="Bradipnea">Bradipnea</option>
                                                <option value="Tachipnea">Tachipnea</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_suara_nafas">Suara Nafas</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_suara_nafas" id="pemeriksaan_respirasi_suara_nafas" style="border-radius:6px">
                                                <option value="Vesikuler">Vesikuler</option>
                                                <option value="Wheezing">Wheezing</option>
                                                <option value="Rhonki">Rhonki</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_batuk">Batuk & Sekresi</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_batuk" id="pemeriksaan_respirasi_batuk" style="border-radius:6px">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Ya : Produktif">Ya : Produktif</option>
                                                <option value="Ya : Non Produktif">Ya : Non Produktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_volume">Volume</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_volume_pernafasan" id="pemeriksaan_respirasi_volume_pernafasan" style="border-radius:6px">
                                                <option value="Normal">Normal</option>
                                                <option value="Hiperventilasi">Hiperventilasi</option>
                                                <option value="Hipoventilasi">Hipoventilasi</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_jenis_pernafasan">Jenis Pernafasan</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_jenis_pernafasan" id="pemeriksaan_respirasi_jenis_pernafasan" style="border-radius:6px 0 0 6px">
                                                <option value="Pernafasan Dada">Pernafasan Dada</option>
                                                <option value="Alat Bantu Pernafasaan">Alat Bantu Pernafasan</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_respirasi_jenis_pernafasan_keterangan" name="pemeriksaan_respirasi_jenis_pernafasan_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_respirasi_irama_nafas">Irama</label>
                                            <select class="form-select" name="pemeriksaan_respirasi_irama_nafas" id="pemeriksaan_respirasi_irama_nafas" style="border-radius:6px">
                                                <option value="Teratur">Teratur</option>
                                                <option value="Tidak Teratur">Tidak Teratur</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label class="mb-2">d. Gastrotential</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_mulut">Mulut</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_mulut" id="pemeriksaan_gastrointestinal_mulut" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Mukosa Kering">Mukosa Kering</option>
                                                <option value="Bibir Pucat">Bibir Pucat</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_gastrointestinal_mulut_keterangan"
                                                name="pemeriksaan_gastrointestinal_mulut_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_tenggorokan">Tenggorokan</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_tenggorokan"
                                                id="pemeriksaan_gastrointestinal_tenggorokan" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Gangguan Menelan">Gangguan Menelan</option>
                                                <option value="Sakit Menelan">Sakit Menelan</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_gastrointestinal_tenggorokan_keterangan"
                                                name="pemeriksaan_gastrointestinal_tenggorokan_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_lidah">Lidah</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_lidah"
                                                id="pemeriksaan_gastrointestinal_lidah" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Kotor">Kotor</option>
                                                <option value="Gerak Asimetris">Gerak Asimetris</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_gastrointestinal_lidah_keterangan"
                                                name="pemeriksaan_gastrointestinal_lidah_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_abdomen">Abdomen</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_abdomen"
                                                id="pemeriksaan_gastrointestinal_abdomen" style="border-radius:6px 0 0 6px">
                                                <option value="Supel">Supel</option>
                                                <option value="Asictes">Asictes</option>
                                                <option value=" Tegang">Tegang</option>
                                                <option value="Nyeri Tekan/Lepas">Nyeri Tekan/Lepas</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_gastrointestinal_abdomen_keterangan"
                                                name="pemeriksaan_gastrointestinal_abdomen_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_gigi">Gigi</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_gigi"
                                                id="pemeriksaan_gastrointestinal_gigi" style="border-radius:6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Karies">Karies</option>
                                                <option value="Goyang">Goyang</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_gastrointestinal_gigi_keterangan"
                                                name="pemeriksaan_gastrointestinal_gigi_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_peistatik_usus">Peistatik Usus</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_peistatik_usus" id="pemeriksaan_gastrointestinal_peistatik_usus" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Tidak Ada Bising Usus">Tidak Ada Bising Usus</option>
                                                <option value="Hiperistaltik">Hiperistaltik</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_gastrointestinal_anus">Anus</label>
                                            <select class="form-select" name="pemeriksaan_gastrointestinal_anus" id="pemeriksaan_gastrointestinal_anus" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Atresia Ani">Atresia Ani</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label class="mb-2">e. Neurologi</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_sensorik">Sensorik</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_sensorik"
                                                id="pemeriksaan_neurologi_sensorik" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Sakit Nyeri">Sakit Nyeri</option>
                                                <option value="Rasa Kebas">Rasa Kebas</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_pengelihatan">Penglihatan</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_pengelihatan"
                                                id="pemeriksaan_neurologi_pengelihatan" style="border-radius: 6px 0 0 6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Ada Kelainan">Ada Kelainan</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_neurologi_pengelihatan_keterangan"
                                                name="pemeriksaan_neurologi_pengelihatan_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_lidah">Alat Bantu</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_alat_bantu_penglihatan"
                                                id="pemeriksaan_neurologi_alat_bantu_penglihatan" style="border-radius:6px">
                                                <option value="Tidak">Tidak</option>
                                                <option value="Kacamata">Kacamata</option>
                                                <option value="Lensa Kontak">Lensa Kontak</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_motorik">Motorik</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_motorik"
                                                id="pemeriksaan_neurologi_motorik" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Hemiparese">Hemiparese</option>
                                                <option value="Tetraparese">Tetraparese</option>
                                                <option value="Tremor">Tremor</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_pendengaran">Pendengaran</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_pendengaran"
                                                id="pemeriksaan_neurologi_pendengaran" style="border-radius:6px">
                                                <option value="TAK">TAK</option>
                                                <option value="Berdengung">Berdengung</option>
                                                <option value="Nyeri">Nyeri</option>
                                                <option value="Tuli">Tuli</option>
                                                <option value="Keluar Cairan">Keluar Cairan</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_kekuatan_otot">Otot</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_kekuatan_otot" id="pemeriksaan_neurologi_kekuatan_otot" style="border-radius:6px">
                                                <option value="Kuat">Kuat</option>
                                                <option value="Lemah">Lemah</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                        <div class="input-group">
                                            <label for="pemeriksaan_neurologi_bicara">Bicara</label>
                                            <select class="form-select" name="pemeriksaan_neurologi_bicara"
                                                id="pemeriksaan_neurologi_bicara" style="border-radius:6px 0 0 6px">
                                                <option value="Jelas">Jelas</option>
                                                <option value="Tidak Jelas">Tidak Jelas</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_neurologi_bicara_keterangan"
                                                name="pemeriksaan_neurologi_bicara_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>

                                    <label class="mb-2">f. Integument</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <div class="input-group">
                                                <label for="pemeriksaan_integument_kulit">Kulit</label>
                                                <select class="form-select" name="pemeriksaan_integument_kulit" id="pemeriksaan_integument_kulit" style="border-radius:6px">
                                                    <option value="Normal">Normal</option>
                                                    <option value="Rash/Kemerahan">Rash/Kemerahan</option>
                                                    <option value="Luka">Luka</option>
                                                    <option value="Memar">Memar</option>
                                                    <option value="Ptieke">Ptieke</option>
                                                    <option value="Bula">Bula</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_integument_warnakulit">Warna Kulit</label>
                                            <select class="form-select" name="pemeriksaan_integument_warnakulit" id="pemeriksaan_integument_warnakulit" style="border-radius:6px">
                                                <option value="Normal">Normal</option>
                                                <option value="Pucat">Pucat</option>
                                                <option value="Sianosis">Sianosis</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_integument_turgor">Turgor</label>
                                            <select class="form-select" name="pemeriksaan_integument_turgor" id="pemeriksaan_integument_turgor" style="border-radius:6px">
                                                <option value="Baik">Baik</option>
                                                <option value="Sedang">Sedang</option>
                                                <option value="Buruk">Buruk</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_integument_dekubitas">Resiko Dekubitas</label>
                                            <select class="form-select" name="pemeriksaan_integument_dekubitas" id="pemeriksaan_integument_dekubitas" style="border-radius:6px">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Usia > 65 Tahun">Usia > 65 Tahun</option>
                                                <option value="Obesitas">Obesitas</option>
                                                <option value="Imobilisasi">Imobilisasi</option>
                                                <option value="Praplegi/Vegetatif State">Praplegi/Vegetatif State</option>
                                                <option value="Dirawat Di HCU">Dirawat Di HCU</option>
                                                <option value="Penyakit Kronis (DM, CHF, CKD)">Penyakit Kronis (DM, CHF, CKD)</option>
                                                <option value="Inkontinentia Uri/Alvi">Inkontinentia Uri/Alvi</option>
                                            </select>
                                        </div>
                                    </div>

                                    <label class="mb-2">g. Muskuloskletal</label>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_muskuloskletal_oedema">Oedema</label>
                                            <select class="form-select" name="pemeriksaan_muskuloskletal_oedema" id="pemeriksaan_muskuloskletal_oedema" style="border-radius:6px 0 0 6px">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_muskuloskletal_oedema_keterangan"
                                                name="pemeriksaan_muskuloskletal_oedema_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_muskuloskletal_pergerakan_sendi">Pergerakan Sendi</label>
                                            <select class="form-select" name="pemeriksaan_muskuloskletal_pergerakan_sendi" id="pemeriksaan_muskuloskletal_pergerakan_sendi" style="border-radius:6px">
                                                <option value="Bebas">Bebas</option>
                                                <option value="Terbatas">Terbatas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                        <div class="input-group">
                                            <label for="pemeriksaan_muskuloskletal_kekauatan_otot">Kekuatan Otot</label>
                                            <select class="form-select" name="pemeriksaan_muskuloskletal_kekauatan_otot" id="pemeriksaan_muskuloskletal_kekauatan_otot" style="border-radius:6px">
                                                <option value="Baik">Baik</option>
                                                <option value="Lemah">Lemah</option>
                                                <option value="Tremor">Tremor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_muskuloskletal_fraktur">Fraktur</label>
                                            <select class="form-select" name="pemeriksaan_muskuloskletal_fraktur" id="pemeriksaan_muskuloskletal_fraktur" style="border-radius:6px 0 0 6px">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_muskuloskletal_fraktur_keterangan"
                                                name="pemeriksaan_muskuloskletal_fraktur_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                        <div class="input-group">
                                            <label for="pemeriksaan_muskuloskletal_nyeri_sendi">Nyeri Sendi</label>
                                            <select class="form-select" name="pemeriksaan_muskuloskletal_nyeri_sendi" id="pemeriksaan_muskuloskletal_nyeri_sendi" style="border-radius:6px 0 0 6px">
                                                <option value="Tidak Ada">Tidak Ada</option>
                                                <option value="Ada">Ada</option>
                                            </select>
                                            <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                                id="pemeriksaan_muskuloskletal_nyeri_sendi_keterangan"
                                                name="pemeriksaan_muskuloskletal_nyeri_sendi_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                                value="-" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <label class="mb-2">h. Eliminasi</label>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bab_frekuensi">BAB : Frekuensi</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bab_frekuensi_jumlah"
                                            name="pemeriksaan_eliminasi_bab_frekuensi_jumlah" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="">/x</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bab_frekuensi_durasi"
                                            name="pemeriksaan_eliminasi_bab_frekuensi_durasi" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bab_konsistensi" style="padding: 5px">Konsistensi</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label="" id="pemeriksaan_eliminasi_bab_konsistensi" name="pemeriksaan_eliminasi_bab_konsistensi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bab_warna" style="padding: 5px">Warna</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bab_warna"
                                            name="pemeriksaan_eliminasi_bab_warna" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>

                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bab_frekuensi">BAK : Frekuensi</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bak_frekuensi_jumlah"
                                            name="pemeriksaan_eliminasi_bak_frekuensi_jumlah" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="">/x</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bak_frekuensi_durasi"
                                            name="pemeriksaan_eliminasi_bak_frekuensi_durasi" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bak_warna">Warna</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bak_warna"
                                            name="pemeriksaan_eliminasi_bak_warna" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">

                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_eliminasi_bak_lainlain">Lain-lain</label>
                                        <input type="search" class="form-control form-control-sm" placeholder="" aria-label=""
                                            id="pemeriksaan_eliminasi_bak_lainlain"
                                            name="pemeriksaan_eliminasi_bak_lainlain" onfocus="removeZero(this)" onblur="cekKosong(this)"
                                            value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                            </div>

                            <div class="separator m-2">3. Pola Kehidupan Sehari-hari</div>
                            <div class="row">
                                <label class="mb-2">a. Pola Aktivitas</label>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pola_aktifitas_mandi">Mandi</label>
                                        <select class="form-select" name="pola_aktifitas_mandi" id="pola_aktifitas_mandi" style="border-radius: 6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Orang Lain">Bantuan Orang Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pola_aktifitas_makanminum">Makan/Minum</label>
                                        <select class="form-select" name="pola_aktifitas_makanminum" id="pola_aktifitas_makanminum" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Orang Lain">Bantuan Orang Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pola_aktifitas_berpakaian">Berpakaian</label>
                                        <select class="form-select" name="pola_aktifitas_berpakaian" id="pola_aktifitas_berpakaian" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Orang Lain">Bantuan Orang Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pola_aktifitas_eliminasi">Eliminasi</label>
                                        <select class="form-select" name="pola_aktifitas_eliminasi" id="pola_aktifitas_eliminasi" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Orang Lain">Bantuan Orang Lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pola_aktifitas_berpindah">Berpindah</label>
                                        <select class="form-select" name="pola_aktifitas_berpindah" id="pola_aktifitas_berpindah" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Orang Lain">Bantuan Orang Lain</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-1 col-sm-12 col-md-12 col-lg-12">
                                    <label for="pola_nutrisi_porsi_makan" style="margin-bottom:2px">b. Pola Makan / Nutrisi : </label>
                                    <div class="input-group">
                                        <label for="pola_nutrisi_porsi_makan">Porsi </label>
                                        <input type="search" class="form-control form-control-sm" id="pola_nutrisi_porsi_makan" name="pola_nutrisi_porsi_makan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px ">
                                        <label for="pola_nutrisi_porsi_makan">Frekuensi </label>
                                        <input type="search" class="form-control form-control-sm" id="pola_nutrisi_frekuesi_makan" name="pola_nutrisi_frekuesi_makan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px ">
                                        <label for="pola_nutrisi_porsi_makan">Jenis Makanan </label>
                                        <input type="search" class="form-control form-control-sm" id="pola_nutrisi_jenis_makanan" name="pola_nutrisi_jenis_makanan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px ">
                                    </div>
                                </div>

                                <div class="mb-1 col-sm-12 col-md-12 col-lg-12">
                                    <label for="pola_tidur_lama_tidur">c. Pola Tidur : </label>
                                    <div class="input-group">
                                        <label for="pola_tidur_lama_tidur">Lama Tidur : </label>
                                        <input type="search" class="form-control form-control-sm" id="pola_tidur_lama_tidur" name="pola_tidur_lama_tidur" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="">Jam / Hari, </label>
                                        <select class="form-select" name="pola_tidur_gangguan" id="pola_tidur_gangguan" style="border-radius: 6px">
                                            <option value="Tidak Ada Gangguan">Tidak Ada Gangguan</option>
                                            <option value="Insomnia">Insomnia</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">4. Pengkajian Fungsi</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_kemampuan_sehari">a. Kemampuan Aktivitas Sehari-hari</label>
                                        <select class="form-select" name="pengkajian_fungsi_kemampuan_sehari" id="pengkajian_fungsi_kemampuan_sehari" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Minimal">Bantuan Minimal</option>
                                            <option value="Bantuan Sebagian">Bantuan Sebagian</option>
                                            <option value="Ketergantungan Total">Ketergantungan Total</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_berjalan">b. Berjalan</label>
                                        <select class="form-select" name="pengkajian_fungsi_berjalan" id="pengkajian_fungsi_berjalan" style="border-radius:6px 0 0 6px ">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan Minimal">Bantuan Minimal</option>
                                            <option value="Bantuan Sebagian">Bantuan Sebagian</option>
                                            <option value="Ketergantungan Total">Ketergantungan Total</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="pengkajian_fungsi_berjalan" name="pengkajian_fungsi_berjalan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_aktifitas">c. Aktivitas</label>
                                        <select class="form-select" name="pengkajian_fungsi_aktifitas" id="pengkajian_fungsi_aktifitas" style="border-radius:6px">
                                            <option value="Tirah Baring">Tirah Baring</option>
                                            <option value="Duduk">Duduk</option>
                                            <option value="Berjalan">Berjalan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ambulasi">d. Ambulansi</label>
                                        <select class="form-select" name="pengkajian_fungsi_ambulasi" id="pengkajian_fungsi_ambulasi" style="border-radius:6px">
                                            <option value="Walker">Walker</option>
                                            <option value="Tongkat">Tongkat</option>
                                            <option value="Kursi Roda">Kursi Roda</option>
                                            <option value="Tidak Ada">Tidak Ada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ekstrimitas_atas">e. Ekstremitas Atas</label>
                                        <select class="form-select" name="pengkajian_fungsi_ekstrimitas_atas" id="pengkajian_fungsi_ekstrimitas_atas" style="border-radius:6px 0 0 6px">
                                            <option value="TAK">TAK</option>
                                            <option value="Lemah">Lemah</option>
                                            <option value="Oedema">Oedema</option>
                                            <option value="Tidak Simetris">Tidak Simetris</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="pengkajian_fungsi_ekstrimitas_atas_keterangan" name="pengkajian_fungsi_ekstrimitas_atas_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ekstrimitas_bawah">f. Ekstremitas Bawah</label>
                                        <select class="form-select" name="pengkajian_fungsi_ekstrimitas_bawah" id="pengkajian_fungsi_ekstrimitas_bawah" style="border-radius:6px 0 0 6px">
                                            <option value="TAK">TAK</option>
                                            <option value="Lemah">Lemah</option>
                                            <option value="Oedema">Oedema</option>
                                            <option value="Tidak Simetris">Tidak Simetris</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="pengkajian_fungsi_ekstrimitas_bawah_keterangan" name="pengkajian_fungsi_ekstrimitas_bawah_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_menggenggam">g. Kemampuan Menggenggam</label>
                                        <select class="form-select" name="pengkajian_fungsi_menggenggam" id="pengkajian_fungsi_menggenggam" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Kesulitan">Tidak Ada Kesulitan</option>
                                            <option value="Terakhir">Terakhir</option>
                                            <option value="Lain-lain">Lain-lain</option>

                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="pengkajian_fungsi_menggenggam_keterangan" name="pengkajian_fungsi_menggenggam_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_koordinasi">h. Kemampuan Koordinasi</label>
                                        <select class="form-select" name="pengkajian_fungsi_koordinasi" id="pengkajian_fungsi_koordinasi" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Kesulitan">Tidak Ada Kesulitan</option>
                                            <option value="Ada Masalah">Ada Masalah</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="pengkajian_fungsi_menggenggam_keterangan" name="pengkajian_fungsi_koordinasi_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_koordinasi">i. Kesimpulan Gangguan Fungsi</label>
                                        <select class="form-select" name="pengkajian_fungsi_koordinasi" id="pengkajian_fungsi_koordinasi" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak (Tidak Perlu Co DPJP)">Tidak (Tidak Perlu Co DPJP)</option>
                                            <option value="Ya (Co DPJP)">Ya (Co DPJP)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="separator m-2">5. Riwayat Psikologis, Sosial, Ekonomi, Budaya</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_kondisi_psiko">a. Kemampuan Psikologis</label>
                                        <select class="form-select" name="riwayat_psiko_kondisi_psiko" id="riwayat_psiko_kondisi_psiko" style="border-radius:6px">
                                            <option value="Tidak Ada Masalah">Tidak Ada Maslah</option>
                                            <option value="Marah">Marah</option>
                                            <option value="Takut">Takut</option>
                                            <option value="Depresi">Depresi</option>
                                            <option value="Cepat Lelah">Cepat Lelah</option>
                                            <option value="Cemas">Cemas</option>
                                            <option value="Gelisah">Gelisah</option>
                                            <option value="Sulit Tidur">Sulit Tidur</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-7">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_perilaku">b. Adakah Perilaku</label>
                                        <select class="form-select" name="riwayat_psiko_perilaku" id="riwayat_psiko_perilaku" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                            <option value="Perilaku Kekerasan">Perilaku Kekerasan</option>
                                            <option value="Gangguan Efek">Gangguan Efek</option>
                                            <option value="Gangguan Memori">Gangguan Memori</option>
                                            <option value="Halusinasi">Halusinasi</option>
                                            <option value="Kecenderungan Percobaan Bunuh Diri">Kecenderungan Percobaan Bunuh Diri</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="riwayat_psiko_perilaku_keterangan" name="riwayat_psiko_perilaku_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_gangguan_jiwa">c. Riwayat Gangguan Jiwa</label>
                                        <select class="form-select" name="riwayat_psiko_gangguan_jiwa" id="riwayat_psiko_gangguan_jiwa" style="border-radius:6px">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_hubungan_keluarga">d. Hubungan dg. Keluarga</label>
                                        <select class="form-select" name="riwayat_psiko_hubungan_keluarga" id="riwayat_psiko_hubungan_keluarga" style="border-radius:6px">
                                            <option value="Harmonis">Harmonis</option>
                                            <option value="Kurang Harmonis">Kurang Harmonis</option>
                                            <option value="Tidak Harmonis">Tidak Harmonis</option>
                                            <option value="Konflik Besar">Konflik Besar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="agama">e. Agama</label>
                                        <input type="search" class="form-control form-control-sm" id="agama" name="agama" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_tinggal">f. Tinggal dg.</label>
                                        <select class="form-select" name="riwayat_psiko_tinggal" id="riwayat_psiko_tinggal" style="border-radius:6px 0 0 6px">
                                            <option value="Keluarga">Keluarga</option>
                                            <option value="Sendiri">Sendiri</option>
                                            <option value="Orang Tua">Orang Tua</option>
                                            <option value="Suami/Istri">Suami/Istri</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="riwayat_psiko_tinggal_keterangan" name="riwayat_psiko_tinggal_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                                {{-- potong disini --}}
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pekerjaan">g. Pekerjaan</label>
                                        <input type="search" class="form-control form-control-sm" id="pekerjaan" name="pekerjaan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="penjab">h. Pembiayaan</label>
                                        <input type="search" class="form-control form-control-sm" id="penjab" name="penjab" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-9">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_nilai_kepercayaan">i. Nilai Kepercayaan/Kebudayaan yang Perlu Diperhatikan</label>
                                        <select class="form-select" name="riwayat_psiko_nilai_kepercayaan" id="riwayat_psiko_nilai_kepercayaan" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada">Ada</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="riwayat_psiko_nilai_kepercayaan_keterangan" name="riwayat_psiko_nilai_kepercayaan_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="bahasa">j. Bahasa</label>
                                        <input type="search" class="form-control form-control-sm" id="bahasa" name="bahasa" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_pendidikan">k. Pendidikan Pasien</label>
                                        <input type="search" class="form-control form-control-sm" id="riwayat_psiko_pendidikan" name="riwayat_psiko_pendidikan_pj" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_pendidikan_pj">l. Pendidikan PJ</label>
                                        <select class="form-select" name="riwayat_psiko_pendidikan_pj" id="riwayat_psiko_pendidikan_pj" style="border-radius:6px">
                                            <option value="-">-</option>
                                            <option value="TS">TS</option>
                                            <option value="TK">TK</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="D4">D4</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_edukasi_diberikan">m. Edukasi diberikan kepada</label>
                                        <select class="form-select" name="riwayat_psiko_edukasi_diberikan" id="riwayat_psiko_edukasi_diberikan" style="border-radius:6px 0 0 6px">
                                            <option value="Keluarga">Keluarga</option>
                                            <option value="Pasien">Pasien</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="rriwayat_psiko_edukasi_diberikan_keterangan" name="riwayat_psiko_edukasi_diberikan_keterangan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                            </div>
                            <div class="separator m-2">6. Riwayat Tumbuh Kembang & Perinatal Care</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="anakke">Anak Ke : </label>
                                        <input type="search" class="form-control form-control-sm" id="anakke" name="anakke" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for=""> dari </label>
                                        <input type="search" class="form-control form-control-sm" id="darisaudara" name="darisaudara" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="caralahir">Cara Kelahiran : </label>
                                        <select class="form-select" name="caralahir" id="caralahir" style="border-radius:6px 0 0 6px">
                                            <option value="Spontan">Spontan</option>
                                            <option value="Sectio Caesaria">Sectio Caesaria</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="ket_caralahir" name="ket_caralahir" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="umurkelahiran">Umur Kelahiran : </label>
                                        <select class="form-select" name="umurkelahiran" id="umurkelahiran" style="border-radius:6px">
                                            <option value="Cukup Bulan">Cukup Bulan</option>
                                            <option value="Kurang Bulan">Kurang Bulan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="kelainanbawaan">Kelaian Bawaaan : </label>
                                        <select class="form-select" name="kelainanbawaan" id="kelainanbawaan" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada">Ada</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="ket_kelainan_bawaan" name="ket_kelainan_bawaan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="separator m-2">7. Riwayat Imunisasi</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-12">
                                    <table class="table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="50%">Nama Imunisasi</th>
                                                <th>Ke 1</th>
                                                <th>Ke 2</th>
                                                <th>Ke 3</th>
                                                <th>Ke 4</th>
                                                <th>Ke 5</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="separator m-2">8. Riwayat Tumbuh Kembang</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="usiatengkurap">a. Tengkurap, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiatengkurap" name="usiatengkurap" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="usiaduduk">b. Duduk, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiaduduk" name="usiaduduk" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="usiaberdiri">c. Berdiri, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiaberdiri" name="usiaberdiri" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="usiagigipertama">d. Gigi Pertama, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiagigipertama" name="usiagigipertama" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="usiaberjalan">e. Berdiri, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiaberjalan" name="usiaberjalan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="usiabicara">f. Mulai Bicara, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiabicara" name="usiabicara" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="usiamembaca">g. Mulai Membaca, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiamembaca" name="usiamembaca" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="usiamenulis">h. Mulai Menulis, usia : </label>
                                        <input type="search" class="form-control form-control-sm" id="usiamenulis" name="usiamenulis" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-8">
                                    <div class="input-group">
                                        <label for="gangguanemosi">i. Gangguan perkembangan mental/emosi, jelaskan : </label>
                                        <input type="search" class="form-control form-control-sm" id="gangguanemosi" name="gangguanemosi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                            </div>
                            <div class="separator m-2">9. Skrining Gizi (Strong Kid)</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-8">
                                    <label for="skrining_gizi1">a. Apakah pasien tampak kurus ? : </label>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <select class="form-select" name="skrining_gizi1" id="skrining_gizi1" style="">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilai_gizi1" name="nilai_gizi1" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-8">
                                    <label for="skrining_gizi2">b. Apakah terdapat penurunan berat badan sebulan terakhir? (berdasarkan nilai objektif data berat badan bila ada atau untuk bayi < 1 Tahun, berat badan tidak naik selama 3 bulan terakhir)</label>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <select class="form-select" name="skrining_gizi2" id="skrining_gizi2" style="">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilai_gizi2" name="nilai_gizi2" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-8">
                                    <label for="skrining_gizi3">c. Apakah terdapat salah satu dari kondisi tersebut ? Diare >5 kali/sehari, dan atau muntah > 3 kali/sehari dalam seminggu terakhir, asupan makanan berkurang selama 1 minggu terakhir</label>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <select class="form-select" name="skrining_gizi3" id="skrining_gizi3" style="">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilai_gizi3" name="nilai_gizi3" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-8">
                                    <label for="skrining_gizi4">d. Apakah terdapat penyakit atau keadaan yang menyebabkan pasien beresiko mengalami malnutrisi ?</label>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <select class="form-select" name="skrining_gizi4" id="skrining_gizi4" style="">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilai_gizi4" name="nilai_gizi3" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>

                                <div class="mb-1 col-sm-12 col-md-12 col-lg-10">
                                    <label for="nilai_total_gizi">Total nilai skrining : </label>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-2">
                                    <input type="search" class="form-control form-control-sm" id="nnilai_total_gizi" name="nilai_total_gizi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="0" autocomplete="off" readonly>
                                </div>


                            </div>

                            <div class="separator m-2">10. Penilaian Tingkat Nyeri</div>
                            <div class="row">
                                <label for="" class="mb-2">Skala FLACCS : </label>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="wajah">Wajah : </label>
                                        <select class="form-select" name="wajah" id="wajah" style="width:60%;border-radius:6px 0 0 6px">
                                            <option value="Tersenyum/tidak ada ekspresi khusus">Tersenyum/tidak ada ekspresi khusus</option>
                                            <option value="Terkadang meringis/menarik diri">Terkadang meringis/menarik diri</option>
                                            <option value="Sering menggetarkan dagu dan mengatupkan rahang">Sering menggetarkan dagu dan mengatupkan rahang</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilaiwajah" name="nilaiwajah" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="menangis">Menangis : </label>
                                        <select class="form-select" name="menangis" id="menangis" style="width:60%;border-radius:6px 0 0 6px">
                                            <option value="Tersenyum/tidak ada ekspresi khusus">Tersenyum/tidak ada ekspresi khusus</option>
                                            <option value="Terkadang meringis/menarik diri">Terkadang meringis/menarik diri</option>
                                            <option value="Sering menggetarkan dagu dan mengatupkan rahang">Sering menggetarkan dagu dan mengatupkan rahang</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilaimenangis" name="nilaimenangis" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="kaki">Kaki : </label>
                                        <select class="form-select" name="kaki" id="kaki" style="width:60%;border-radius:6px 0 0 6px">
                                            <option value="Gerakan normal/relaksasi">Gerakan normal/relaksasi</option>
                                            <option value="Tidak tenang/tegang">Tidak tenang/tegang</option>
                                            <option value="Kaki dibuat menendang/menarik">Kaki dibuat menendang/menarik</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilaikaki" name="nilaikaki" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="bersuara">Bersuara : </label>
                                        <select class="form-select" name="bersuara" id="bersuara" style="width:60%;border-radius:6px 0 0 6px">
                                            <option value="Bersuara normal/tenang">Bersuara normal/tenang</option>
                                            <option value="Tenang bila dipeluk, digendong/diajak bicara">Tenang bila dipeluk, digendong/diajak bicara</option>
                                            <option value="Sulit untuk menenangkan">Sulit untuk menenangkan</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilaibersuara" name="nilaibersuara" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="aktifitas">Aktifitas : </label>
                                        <select class="form-select" name="aktifitas" id="aktifitas" style="width:60%;border-radius:6px 0 0 6px">
                                            <option value="Tidur posisi normal, mudah bergerak">Tidur posisi normal, mudah bergerak</option>
                                            <option value="Gerakan menggeliat/berguling, kaku">Gerakan menggeliat/berguling, kaku</option>
                                            <option value="Melengkungkan punggung/kaku menghentak">Melengkungkan punggung/kaku menghentak</option>
                                        </select>
                                        <input type="search" class="form-control form-control-sm" id="nilaiaktifitas" name="nilaiaktifitas" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="aktifitas">Skala Nyeri : </label>
                                        <input type="search" class="form-control form-control-sm" id="nilaiaktifitas" name="nilaiaktifitas" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mt-2 col-sm-12 col-md-12 col-lg-6">
                                    <img src="{{ asset('/img/skala_nyeri_wong_baker.png') }}" alt="" class="mx-auto d-block" style="max-width:100%;height:auto">
                                </div>

                                <div class="mt-2 col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <div class="mb-1 col-lg-5">
                                            <select class="form-select" name="nyeri" id="nyeri">
                                                <option value="Tidak Ada Nyeri">Tidak Ada Nyeri</option>
                                                <option value="Nyeri Akut">Nyeri Akut</option>
                                                <option value="Nyeri Kronis">Nyeri Kronis</option>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-lg-7">
                                            <div class="input-group">
                                                <label for="lokasi">Lokasi : </label>
                                                <input type="search" class="form-control form-control-sm" id="lokasi" name="lokasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-6">
                                            <div class="input-group">
                                                <label for="durasi">Durasi : </label>
                                                <input type="search" class="form-control form-control-sm" id="durasi" name="durasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-6">
                                            <div class="input-group">
                                                <label for="frekuensi">Frekuensi : </label>
                                                <input type="search" class="form-control form-control-sm" id="frekuensi" name="frekuensi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-12">
                                            <div class="input-group">
                                                <label for="nyeri_hilang">Nyeri Hilang Bila : </label>
                                                <select class="form-select" name="nyeri_hilang" id="nyeri_hilang" style="border-radius:6px 0 0 6px">
                                                    <option value="Minum Obat">Minum Obat</option>
                                                    <option value="Istirahat">Istirahat</option>
                                                    <option value="Mendengarkan Musik">Mendengarkan Musik</option>
                                                    <option value="Berubah Posisi/Tidur">Berubah Posisi/Tidur</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="search" class="form-control form-control-sm" id="ket_nyeri" name="ket_nyeri" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-12">
                                            <div class="input-group">
                                                <label for="pada_dokter">Diberitahukan pada dokter ? </label>
                                                <select class="form-select" name="pada_dokter" id="pada_dokter" style="border-radius:6px">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <label for="ket_dokter">Jam : </label>
                                                <input type="search" class="form-control form-control-sm" id="ket_dokter" name="ket_dokter" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="separator m-2">11. Masalah & Rencana Keperawtan</div>
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <table id="tbMasalahKeperawatan" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>P</th>
                                                <th>Masalah Keperawatan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="mb-1 mt-1 col-sm-12 col-md-12 col-lg-6">
                                    <ul class="nav nav-tabs" id="tabMasalah" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button style="font-size:10px;padding:6px" class="nav-link active" id="rancana" data-bs-toggle="tab" data-bs-target="#rancana-pane" type="button" role="tab" aria-controls="rancana-pane" aria-selected="true">Rencana Keperawatan</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button style="font-size:10px;padding:6px" class="nav-link" id="tindakan" data-bs-toggle="tab" data-bs-target="#tindakan-pane" type="button" role="tab" aria-controls="tindakan-pane" aria-selected="false">Tindakan Keperawatan</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="tabIsiMasalah">
                                        <div class="tab-pane fade show active p-2" id="rancana-pane" role="tabpanel" aria-labelledby="rancana" tabindex="0">
                                            <table id="tbRencanaKeperawatan" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>P</th>
                                                        <th>Rencana Keperawatan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane fade p-2" id="tindakan-pane" role="tabpanel" aria-labelledby="tindakan" tabindex="0">
                                            <textarea class="form-control" name="rancana" id="rancana" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
            <button type="button" class="btn btn-primary simpanAskepAnak" onclick="" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
        </div>
    </div>
</div>
</div>
@push('script')
    <script>
        $('#modalAskepRanapAnak').on('hidden.bs.modal', () => {
            localStorage.removeItem('kodeRencana')
            tbRencanaKeperawatan()
        })

        function getAskepRanapAnak(no_rawat) {
            const askep = $.ajax({
                url: '/erm/ranap/askep/anak',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
            })

            return askep;
        }

        function askepRanapAnak(no_rawat) {
            $('#modalAskepRanapAnak').modal('show')
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                jk = regPeriksa.pasien.jk == 'P' ? 'PEREMPUAN' : 'LAKI-LAKI';
                $('#formAskepAnakRanap input[name=no_rawat]').val(no_rawat)
                $('#formAskepAnakRanap input[name=pasien]').val(`${regPeriksa.pasien.nm_pasien} (${jk})`)
                $('#formAskepAnakRanap input[name=tgl_lahir]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
                $('#formAskepAnakRanap input[name=kd_dokter]').val(regPeriksa.kd_dokter)
                $('#formAskepAnakRanap input[name=dokter]').val(regPeriksa.dokter.nm_dokter)
            })
            getAskepRanapAnak(no_rawat).done((response) => {
                let pengkaji1 = response ? response.pengkaji1.nama : "{{ session()->get('pegawai')->nama }}";
                let nip1 = response ? response.nip1 : "{{ session()->get('pegawai')->nik }}";
                let pengkaji2 = response ? response.pengkaji2.nama : "-";
                let nip2 = response ? response.nip2 : "-";
                let tanggal = response ? splitTanggal(response.tanggal.split(' ')[0]) : "{{ date('d-M-Y') }}"
                let jam = response ? response.tanggal.split(' ')[1] : "{{ date('H:i:s') }}"
                let kasus = response ? response.kasus_trauma : "Trauma"
                let informasi = response ? response.informasi : "Autoanamnesis"
                let ket_informasi = response ? response.ket_informasi : "-"
                let tiba_diruang_rawat = response ? response.tiba_diruang_rawat : "-"
                let cara_masuk = response ? response.cara_masuk : "-"
                let rps = response ? response.rps : "-"
                let rpd = response ? response.rpd : "-"
                let rpk = response ? response.rpk : "-"
                let rpo = response ? response.rpo : "-"
                let riwayat_alergi = response ? response.riwayat_alergi : "-"
                let riwayat_pembedahan = response ? response.riwayat_pembedahan : "-"
                let riwayat_dirawat_dirs = response ? response.riwayat_dirawat_dirs : "-"
                let riwayat_alkohol = response ? response.riwayat_alkohol : "-"
                let riwayat_alkohol_jumlah = response ? response.riwayat_alkohol_jumlah : "-"
                let riwayat_rokok = response ? response.riwayat_rokok : "-"
                let riwayat_rokok_jumlah = response ? response.riwayat_rokok_jumlah : "-"
                let riwayat_narkoba = response ? response.riwayat_narkoba : "-"
                let riwayat_olahraga = response ? response.riwayat_olahraga : "-"
                let pemeriksaan_mental = response ? response.pemeriksaan_mental : "-"
                let pemeriksaan_keadaan_umum = response ? response.pemeriksaan_keadaan_umum : "-"
                let pemeriksaan_gcs = response ? response.pemeriksaan_gcs : "-"
                let pemeriksaan_td = response ? response.pemeriksaan_td : "-"
                let pemeriksaan_nadi = response ? response.pemeriksaan_nadi : "-"
                let pemeriksaan_rr = response ? response.pemeriksaan_rr : "-"
                let pemeriksaan_suhu = response ? response.pemeriksaan_suhu : "-"
                let pemeriksaan_spo2 = response ? response.pemeriksaan_spo2 : "-"
                let pemeriksaan_bb = response ? response.pemeriksaan_bb : "-"
                let pemeriksaan_tb = response ? response.pemeriksaan_tb : "-"
                let pemeriksaan_susunan_kepala = response ? response.pemeriksaan_susunan_kepala : "TAK"
                let pemeriksaan_susunan_kepala_keterangan = response ? response.pemeriksaan_susunan_kepala_keterangan : "-"
                let pemeriksaan_susunan_wajah = response ? response.pemeriksaan_susunan_wajah : "TAK"
                let pemeriksaan_susunan_wajah_keterangan = response ? response.pemeriksaan_susunan_wajah_keterangan : "-"
                let pemeriksaan_susunan_leher = response ? response.pemeriksaan_susunan_leher : "TAK"
                let pemeriksaan_susunan_kejang = response ? response.pemeriksaan_susunan_kejang : "TAK"
                let pemeriksaan_susunan_kejang_keterangan = response ? response.pemeriksaan_susunan_kejang_keterangan : "-"
                let pemeriksaan_susunan_sensorik = response ? response.pemeriksaan_susunan_sensorik : "TAK"

                if (response) {
                    $('#formAskepAnakRanap select[name=pemeriksaan_kardiovaskuler_denyut_nadi]').val(response.pemeriksaan_kardiovaskuler_denyut_nadi).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_kardiovaskuler_sirkulasi]').val(response.pemeriksaan_kardiovaskuler_sirkulasi).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_kardiovaskuler_sirkulasi_keterangan]').val(response.pemeriksaan_kardiovaskuler_sirkulasi_keterangan)
                    $('#formAskepAnakRanap select[name=pemeriksaan_kardiovaskuler_pulsasi]').val(response.pemeriksaan_kardiovaskuler_pulsasi).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_pola_nafas]').val(response.pemeriksaan_respirasi_pola_nafas).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_retraksi]').val(response.pemeriksaan_respirasi_retraksi).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_suara_nafas]').val(response.pemeriksaan_respirasi_suara_nafas).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_volume_pernafasan]').val(response.pemeriksaan_respirasi_volume_pernafasan).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_jenis_pernafasan]').val(response.pemeriksaan_respirasi_jenis_pernafasan).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_jenis_pernafasan_keterangan]').val(response.pemeriksaan_respirasi_jenis_pernafasan_keterangan)
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_irama_nafas]').val(response.pemeriksaan_respirasi_irama_nafas).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_respirasi_batuk]').val(response.pemeriksaan_respirasi_batuk).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_mulut]').val(response.pemeriksaan_gastrointestinal_mulut).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_gastrointestinal_mulut_keterangan]').val(response.pemeriksaan_gastrointestinal_mulut_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_lidah]').val(response.pemeriksaan_gastrointestinal_lidah).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_gastrointestinal_lidah_keterangan]').val(response.pemeriksaan_gastrointestinal_lidah_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_gigi]').val(response.pemeriksaan_gastrointestinal_gigi).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_gastrointestinal_gigi_keterangan]').val(response.pemeriksaan_gastrointestinal_gigi_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_tenggorokan]').val(response.pemeriksaan_gastrointestinal_tenggorokan).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_gastrointestinal_tenggorokan_keterangan]').val(response.pemeriksaan_gastrointestinal_tenggorokan_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_abdomen]').val(response.pemeriksaan_gastrointestinal_abdomen).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_gastrointestinal_abdomen_keterangan]').val(response.pemeriksaan_gastrointestinal_abdomen_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_peistatik_usus]').val(response.pemeriksaan_gastrointestinal_peistatik_usus).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_gastrointestinal_anus]').val(response.pemeriksaan_gastrointestinal_anus).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_sensorik]').val(response.pemeriksaan_neurologi_sensorik).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_pengelihatan]').val(response.pemeriksaan_neurologi_pengelihatan).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_neurologi_pengelihatan_keterangan]').val(response.pemeriksaan_neurologi_pengelihatan_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_alat_bantu_penglihatan]').val(response.pemeriksaan_neurologi_alat_bantu_penglihatan).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_pendengaran]').val(response.pemeriksaan_neurologi_pendengaran).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_bicara]').val(response.pemeriksaan_neurologi_bicara).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_neurologi_bicara_keterangan]').val(response.pemeriksaan_neurologi_bicara_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_sensorik]').val(response.pemeriksaan_neurologi_sensorik).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_motorik]').val(response.pemeriksaan_neurologi_motorik).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_neurologi_kekuatan_otot]').val(response.pemeriksaan_neurologi_kekuatan_otot).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_integument_kulit]').val(response.pemeriksaan_integument_kulit).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_integument_turgor]').val(response.pemeriksaan_integument_turgor).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_integument_warnakulit]').val(response.pemeriksaan_integument_warnakulit).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_integument_dekubitas]').val(response.pemeriksaan_integument_dekubitas).change()

                    $('#formAskepAnakRanap select[name=pemeriksaan_muskuloskletal_fraktur]').val(response.pemeriksaan_muskuloskletal_fraktur).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_muskuloskletal_fraktur_keterangan]').val(response.pemeriksaan_muskuloskletal_fraktur_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_muskuloskletal_oedema]').val(response.pemeriksaan_muskuloskletal_oedema).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_muskuloskletal_oedema_keterangan]').val(response.pemeriksaan_muskuloskletal_oedema_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_muskuloskletal_nyeri_sendi]').val(response.pemeriksaan_muskuloskletal_nyeri_sendi).change()
                    $('#formAskepAnakRanap input[name=pemeriksaan_muskuloskletal_nyeri_sendi_keterangan]').val(response.pemeriksaan_muskuloskletal_nyeri_sendi_keterangan)

                    $('#formAskepAnakRanap select[name=pemeriksaan_muskuloskletal_pergerakan_sendi]').val(response.pemeriksaan_muskuloskletal_pergerakan_sendi).change()
                    $('#formAskepAnakRanap select[name=pemeriksaan_muskuloskletal_kekauatan_otot]').val(response.pemeriksaan_muskuloskletal_kekauatan_otot).change()

                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bab_frekuensi_jumlah]').val(response.pemeriksaan_eliminasi_bab_frekuensi_jumlah)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bab_frekuensi_durasi]').val(response.pemeriksaan_eliminasi_bab_frekuensi_durasi)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bab_konsistensi]').val(response.pemeriksaan_eliminasi_bab_konsistensi)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bab_warna]').val(response.pemeriksaan_eliminasi_bab_warna)

                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bak_frekuensi_jumlah]').val(response.pemeriksaan_eliminasi_bak_frekuensi_jumlah)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bak_frekuensi_durasi]').val(response.pemeriksaan_eliminasi_bak_frekuensi_durasi)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bak_warna]').val(response.pemeriksaan_eliminasi_bak_warna)
                    $('#formAskepAnakRanap input[name=pemeriksaan_eliminasi_bak_lainlain]').val(response.pemeriksaan_eliminasi_bak_lainlain)

                    $('#formAskepAnakRanap select[name=pola_aktifitas_berpakaian]').val(response.pola_aktifitas_berpakaian).change()
                    $('#formAskepAnakRanap select[name=pola_aktifitas_mandi]').val(response.pola_aktifitas_mandi).change()
                    $('#formAskepAnakRanap select[name=pola_aktifitas_eliminasi]').val(response.pola_aktifitas_eliminasi).change()
                    $('#formAskepAnakRanap select[name=pola_aktifitas_makanminum]').val(response.pola_aktifitas_makanminum).change()
                    $('#formAskepAnakRanap select[name=pola_aktifitas_berpindah]').val(response.pola_aktifitas_berpindah).change()

                    $('#formAskepAnakRanap input[name=pola_nutrisi_porsi_makan]').val(response.pola_nutrisi_porsi_makan)
                    $('#formAskepAnakRanap input[name=pola_nutrisi_frekuesi_makan]').val(response.pola_nutrisi_frekuesi_makan)
                    $('#formAskepAnakRanap input[name=pola_nutrisi_jenis_makan]').val(response.pola_nutrisi_jenis_makan)

                    $('#formAskepAnakRanap input[name=pola_tidur_lama_tidur]').val(response.pola_tidur_lama_tidur)
                    $('#formAskepAnakRanap select[name=pola_tidur_gangguan]').val(response.pola_tidur_gangguan).change()



                }


                $('#formAskepAnakRanap input[name=nip1]').val(nip1)
                $('#formAskepAnakRanap input[name=pengkaji1]').val(pengkaji1)
                $('#formAskepAnakRanap input[name=nip2]').val(nip2)
                $('#formAskepAnakRanap input[name=pengkaji2]').val(pengkaji2)
                $('#formAskepAnakRanap input[name=tanggal]').val(tanggal)
                $('#formAskepAnakRanap input[name=jam]').val(jam)
                $('#formAskepAnakRanap input[name=ket_informasi]').val(ket_informasi)
                $('#formAskepAnakRanap select[name=kasus_trauma]').val(kasus).change()
                $('#formAskepAnakRanap select[name=informasi]').val(informasi).change()
                $('#formAskepAnakRanap select[name=tiba_diruang_rawat]').val(tiba_diruang_rawat).change()
                $('#formAskepAnakRanap select[name=cara_masuk]').val(cara_masuk).change()
                $('#formAskepAnakRanap textarea[name=rps]').val(rps)
                $('#formAskepAnakRanap textarea[name=rpd]').val(rpd)
                $('#formAskepAnakRanap textarea[name=rpk]').val(rpk)
                $('#formAskepAnakRanap textarea[name=rpo]').val(rpo)
                $('#formAskepAnakRanap input[name=riwayat_alergi]').val(riwayat_alergi)
                $('#formAskepAnakRanap input[name=riwayat_pembedahan]').val(riwayat_pembedahan)
                $('#formAskepAnakRanap input[name=riwayat_dirawat_dirs]').val(riwayat_dirawat_dirs)
                $('#formAskepAnakRanap select[name=riwayat_alkohol]').val(riwayat_alkohol).change()
                $('#formAskepAnakRanap input[name=riwayat_alkohol_jumlah]').val(riwayat_alkohol_jumlah)
                $('#formAskepAnakRanap select[name=riwayat_rokok]').val(riwayat_rokok).change()
                $('#formAskepAnakRanap input[name=riwayat_rokok_jumlah]').val(riwayat_rokok_jumlah)
                $('#formAskepAnakRanap select[name=riwayat_narkoba]').val(riwayat_narkoba).change()
                $('#formAskepAnakRanap select[name=riwayat_olahraga]').val(riwayat_olahraga).change()
                $('#formAskepAnakRanap select[name=pemeriksaan_mental]').val(pemeriksaan_mental == 'cm' ? 'Compos Mentis' : '-').change()
                $('#formAskepAnakRanap select[name=pemeriksaan_keadaan_umum]').val(pemeriksaan_keadaan_umum).change()
                $('#formAskepAnakRanap input[name=pemeriksaan_gcs]').val(pemeriksaan_gcs)
                $('#formAskepAnakRanap input[name=pemeriksaan_td]').val(pemeriksaan_td)
                $('#formAskepAnakRanap input[name=pemeriksaan_nadi]').val(pemeriksaan_nadi)
                $('#formAskepAnakRanap input[name=pemeriksaan_rr]').val(pemeriksaan_rr)
                $('#formAskepAnakRanap input[name=pemeriksaan_suhu]').val(pemeriksaan_suhu)
                $('#formAskepAnakRanap input[name=pemeriksaan_spo2]').val(pemeriksaan_spo2)
                $('#formAskepAnakRanap input[name=pemeriksaan_bb]').val(pemeriksaan_bb)
                $('#formAskepAnakRanap input[name=pemeriksaan_tb]').val(pemeriksaan_tb)
                $('#formAskepAnakRanap select[name=pemeriksaan_susunan_kepala]').val(pemeriksaan_susunan_kepala).change()
                $('#formAskepAnakRanap input[name=pemeriksaan_susunan_kepala_keterangan]').val(pemeriksaan_susunan_kepala_keterangan)
                $('#formAskepAnakRanap select[name=pemeriksaan_susunan_wajah]').val(pemeriksaan_susunan_wajah).change()
                $('#formAskepAnakRanap input[name=pemeriksaan_susunan_wajah_keterangan]').val(pemeriksaan_susunan_wajah_keterangan)
                $('#formAskepAnakRanap select[name=pemeriksaan_susunan_leher]').val(pemeriksaan_susunan_leher).change()
                $('#formAskepAnakRanap select[name=pemeriksaan_susunan_kejang]').val(pemeriksaan_susunan_kejang).change()
                $('#formAskepAnakRanap input[name=pemeriksaan_susunan_kejang_keterangan]').val(pemeriksaan_susunan_kejang_keterangan)


                console.log(response, response.pemeriksaan_respirasi_volume_pernafasan);
            })

        }

        function tbMasalahKeperawatan() {
            $('#tbMasalahKeperawatan').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 200,
                info: false,
                ajax: {
                    url: '/erm/master/masalah/keperawatan/table',
                },
                columns: [{
                        data: '',
                        render: (data, type, row) => {
                            return `<div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="listMasalahKeperawatan" id="kodeMasalah${row.kode_masalah}" onclick="cekMasalahKeperawatan(this,'${row.kode_masalah}')">
                                </div>`
                        }
                    },
                    {
                        data: '',
                        render: (data, type, row) => {
                            return row.nama_masalah
                        }
                    }
                ]
            })
        }

        var kodeMasalah = [];
        var kodeRencana = [];

        function cekMasalahKeperawatan(element, params) {
            const isChecked = $(`#kodeMasalah${params}`).is(':checked')
            if (isChecked) {
                kodeMasalah.push(params)
            } else {
                kodeMasalah = kodeMasalah.filter((item) => {
                    return item != params
                });
            }
            tbRencanaKeperawatan(kodeMasalah)
            if (kodeMasalah.length == 0) {
                localStorage.removeItem(`kodeRencana`)
            }
        }

        function cekRencanaKeperawatan(params) {
            const isChecked = $(`#kodeRencana${params}`).is(':checked')
            if (isChecked) {
                kodeRencana.push(params)
            } else {
                kodeRencana = kodeRencana.filter((item) => {
                    return item != params
                });
            }
            if (kodeRencana.length == 0) {
                localStorage.removeItem(`kodeRencana`)
            } else {
                localStorage.setItem(`kodeRencana`, JSON.stringify(kodeRencana))
            }
        }

        function tbRencanaKeperawatan(kode) {
            $('#tbRencanaKeperawatan').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 200,
                info: false,
                searching: false,
                ajax: {
                    url: '/erm/master/rencana/keperawatan/table/',
                    data: {
                        kode: kode,
                    },
                },
                columns: [{
                        data: '',
                        render: (data, type, row) => {
                            kode = localStorage.kodeRencana ? JSON.parse(localStorage.kodeRencana) : ''
                            // console.log('Kode Rencana', JSON.parse(localStorage.kodeRencana));
                            $.map(kode, (kd) => {
                                if (kd == row.kode_rencana) {
                                    $('#kodeRencana' + row.kode_rencana).attr('checked', 'checked')
                                } else {
                                    $('#kodeRencana' + row.kode_rencana).removeProp('checked')
                                }

                            })
                            return `<div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="${row.kode_rencana}" onclick="cekRencanaKeperawatan('${row.kode_rencana}')" id="kodeRencana${row.kode_rencana}" onclick="">
                                </div>`
                        }
                    },
                    {
                        data: '',
                        render: (data, type, row) => {
                            return row.rencana_keperawatan
                        }
                    }
                ]
            })
        }

        $('#modalAskepRanapAnak').on('shown.bs.modal', () => {
            tbMasalahKeperawatan()
            // tbRencanaKeperawatan('008')
            $('#tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })
        })

        function cariPetugasAskep(p, no) {
            getPetugas(p.value, no).done((response) => {
                html = '<ul class="dropdown-menu" style="width:auto;display:block;position:absolute;font-size:12px">';
                $.map(response, function(data) {
                    html += `<li><a data-id="${data.nip}" class="dropdown-item" onclick="setPetugasAskep(this, ${no})">${data.nama}</a><li>`
                })
                html += '</ul>';
                $('.list_petugas' + no).fadeIn();
                $('.list_petugas' + no).html(html);
            })
        }

        function setPetugasAskep(p, no) {
            const nip = $(p).data('id');
            const nama = $(p).text();

            $('.nip' + no).val(nip)
            $('.pengkaji' + no).val(nama)

            $('.list_petugas' + no).fadeOut();
        }
    </script>
@endpush
