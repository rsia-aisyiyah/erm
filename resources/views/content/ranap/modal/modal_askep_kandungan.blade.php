<div class="modal fade" id="modalAskepRanapKandungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">ASESMEN KEPERAWATAN KEBIDANAN & KANDUNGAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="formAskepRanapKandungan">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="row mb-2">
                                <label for="pasien">Pasien</label>
                                <div class="col-sm-12 col-md-6 col-lg-3">
                                    <input type="text" class="form-control form-control-sm no_rawat" name="no_rawat" placeholder="" aria-label="" id="no_rawat" readonly="" style="background-color: #e9ecef;cursor:not-allowed;">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5">
                                    <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm pasien" id="pasien" name="pasien" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                                    <input type="hidden" value="" name="no_rkm_medis">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm tgl_lahir" id="tgl_lahir" name="tgl_lahir" placeholder="" aria-label="" aria-describedby="pasien" readonly="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-6 col-lg-2">
                                    <label for="">Dokter DPJP</label>
                                    <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm kd_dokter" placeholder="" aria-label="" id="kd_dokter" name="kd_dokter" readonly>
                                </div>
                                <div class="col-sm-8 col-md-6 col-lg-4">
                                    <label for=""></label>
                                    <input type="text" style="background-color: #e9ecef;cursor:not-allowed" class="form-control form-control-sm dokter" placeholder="" aria-label="" id="dokter" name="dokter" autocomplete="off" readonly>
                                    <div class="list-dokter"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control form-control-sm" name="tanggal" placeholder="" aria-label="" autocomplete="off">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="jam">Jam</label>
                                    <input type="text" class="form-control form-control-sm jam" name="jam" placeholder="" aria-label="" autocomplete="off">
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
                                    <input type="text" class="form-control form-control-sm nip1" placeholder="" aria-label="" id="nip1" name="nip1" readonly>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip1"></label>
                                    <input type="text" class="form-control form-control-sm pengkaji1" placeholder="" aria-label="" id="pengkaji1" name="pengkaji1" onkeyup="cariPetugasAskep(this, 1)">
                                    <div class="list_petugas1"></div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="nip2">Pengkaji 2</label>
                                    <input type="text" class="form-control form-control-sm nip2" placeholder="" aria-label="" id="nip2" name="nip2" readonly value="-">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <label for="nip2"></label>
                                    <input type="text" class="form-control form-control-sm pengkaji2" placeholder="" aria-label="" id="pengkaji2" name="pengkaji2" onkeyup="cariPetugasAskep(this, 2)" value="-">
                                    <div class="list_petugas2"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <label for="nip2">Anamnesis</label>
                                    <select class="form-select form-select-sm" id="anamnesis" name="informasi" style="font-size: 12px;height:28px">
                                        <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                        <option value="Alloanamnesis">Alloanamnesis</option>
                                    </select>
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
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- section : form kanan --}}

                        <div class="mb-3 col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">1. Riwayat Kesehatan</div>
                            {{-- section : riwayat kesehatan --}}
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="keluhan">Keluhan Utama</label>
                                    <textarea class="form-control" name="keluhan" id="keluhan" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rpk">Riwayat Penyakit Keluarga</label>
                                    <textarea class="form-control" name="rpk" id="rpk" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="psk">Penyakit Selama Kehamilan</label>
                                    <textarea class="form-control" name="psk" id="psk" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rp">Riwayat Pembedahan</label>
                                    <textarea class="form-control" name="rp" id="rp" cols="30" rows="5" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_alergi">Riwayat Alergi</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_alergi" name="riwayat_alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-8">
                                    <div class="input-group">
                                        <label for="komplikasi_sebelumnya">Komplikasi Kehamilan Sebelumnya</label>
                                        <select class="form-select" name="komplikasi_sebelumnya" id="komplikasi_sebelumnya" style="border-radius: 6px 0 0 6px">
                                            <option value="Tidak">Tidak</option>
                                            <option value="HAP">HAP</option>
                                            <option value="HPP">HPP</option>
                                            <option value="PEB/PER/Eklamsi">PEB/PER/Eklamsi</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="keterangan_komplikasi_sebelumnya" name="keterangan_komplikasi_sebelumnya" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <label for="" class="mt-2 mb-2">Riwayat Menstruasi</label>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_mens_umur">Umur Menarche</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_mens_umur" name="riwayat_mens_umur" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                        <label for="riwayat_mens_umur">th</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_mens_lamanya">Lama</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_mens_lamanya" name="riwayat_mens_lamanya" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                        <label for="riwayat_mens_umur">hari</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_mens_banyaknya">Banyak</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_mens_banyaknya" name="riwayat_mens_banyaknya" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                        <label for="riwayat_mens_banyaknya">pembalut</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_mens_siklus">Siklus</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_mens_siklus" name="riwayat_mens_siklus" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                        <label for="riwayat_mens_siklus">hari, </label>
                                        <select class="form-select" name="riwayat_mens_ket_siklus" id="riwayat_mens_ket_siklus" style="border-radius: 6px">
                                            <option value="Teratur">Teratur</option>
                                            <option value="Tidak Teratur">Tidak Teratur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_mens_dirasakan">Dirasakan saat menstruasi</label>
                                        <select class="form-select" name="riwayat_mens_dirasakan" id="riwayat_mens_dirasakan" style="border-radius: 6px">
                                            <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                            <option value="Dismenorhea">Dismenorhea</option>
                                            <option value="Spotting">Spotting</option>
                                            <option value="Menorhagia">Menorhagia</option>
                                            <option value="PMS">PMS</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="" class="mt-2 mb-2">Riwayat Perkawinan</label>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_perkawinan_status">Status Menikah</label>
                                        <select class="form-select" name="riwayat_perkawinan_status" id="riwayat_perkawinan_status" style="border-radius: 6px 0 0 6px">
                                            <option value="Menikah">Menikah</option>
                                            <option value="Tidak / Belum Menikah">Tidak / Belum Menikah</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_perkawinan_ket_status" name="riwayat_perkawinan_ket_status" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 0 6px 6px 0">
                                        <label for="riwayat_perkawinan_ket_status">kali</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_perkawinan_usia1">Usia Perkawinan 1 : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_perkawinan_usia1" name="riwayat_perkawinan_usia1" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_perkawinan_ket_usia1">tahun, Status :</label>
                                        <select class="form-select" name="riwayat_perkawinan_ket_usia1" id="riwayat_perkawinan_ket_usia1" style="border-radius: 6px">
                                            <option value="-">-</option>
                                            <option value="Masih Menikah">Masih Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                            <option value="Meninggal">Meninggal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_perkawinan_usia2">Usia Perkawinan 2 : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_perkawinan_usia2" name="riwayat_perkawinan_usia2" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_perkawinan_ket_usia1">tahun, Status :</label>
                                        <select class="form-select" name="riwayat_perkawinan_ket_usia2" id="riwayat_perkawinan_ket_usia2" style="border-radius: 6px">
                                            <option value="-">-</option>
                                            <option value="Masih Menikah">Masih Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                            <option value="Meninggal">Meninggal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_perkawinan_usia3">Usia Perkawinan 3 : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_perkawinan_usia3" name="riwayat_perkawinan_usia3" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_perkawinan_ket_usia1">tahun, Status :</label>
                                        <select class="form-select" name="riwayat_perkawinan_ket_usia3" id="riwayat_perkawinan_ket_usia3" style="border-radius: 6px">
                                            <option value="-">-</option>
                                            <option value="Masih Menikah">Masih Menikah</option>
                                            <option value="Cerai">Cerai</option>
                                            <option value="Meninggal">Meninggal</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="">Riwayat Persalinan & Nifas</label>
                                <div class="mb-2 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_persalinan_g">G : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_persalinan_g" name="riwayat_persalinan_g" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_persalinan_p">P : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_persalinan_p" name="riwayat_persalinan_p" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_persalinan_a">A : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_persalinan_a" name="riwayat_persalinan_a" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-4 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_persalinan_hidup">Anak yang hidup : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_persalinan_hidup" name="riwayat_persalinan_hidup" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-4 col-lg-12">
                                    <table class="table table-sm table-bordered" id="tbRiwayatPersalinan" width="100%" style="font-size:10px">
                                        <thead class="table-primary" style="text-align:center;vertical-align:middle">
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Tempat Persalinan</th>
                                                <th>Usia Hamil</th>
                                                <th>Jenis Persalinan</th>
                                                <th>Penolong</th>
                                                <th>Penyulit</th>
                                                <th>J.K.</th>
                                                <th>BB/PB</th>
                                                <th>Keadaan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <button type="button" class="btn btn-primary btn-sm" id="btnRiwayatPersalinan">+ Tambah Riwayat</button>
                                </div>
                                <label for="">Riwayat Hamil Sekarang</label>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_hpht">HPHT</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_hpht" name="riwayat_hamil_hpht" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_usiahamil">Usia Hamil</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_usiahamil" name="riwayat_hamil_usiahamil" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_hamil_usiahamil">bln/mgg</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-2">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_tp">TP</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_tp" name="riwayat_hamil_tp" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_imunisasi">Riwayat Imunisasi</label>
                                        <select class="form-select" name="riwayat_hamil_imunisasi" id="riwayat_hamil_imunisasi" style="border-radius: 6px">
                                            <option value="Tidak Pernah">Tidak Pernah</option>
                                            <option value="T I">T I</option>
                                            <option value="TT II">TT II</option>
                                            <option value="TT II">TT II</option>
                                            <option value="TT III">TT III</option>
                                            <option value="TT IV">TT IV</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_anc">ANC</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_anc" name="riwayat_hamil_anc" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_hamil_anc">x</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_ancke">Ke : </label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_ancke" name="riwayat_hamil_ancke" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px 0 0 6px">
                                        <select class="form-select" name="riwayat_hamil_ket_ancke" id="riwayat_hamil_ket_ancke" style="border-radius: 0 6px 6px 0">
                                            <option value="Teratur">Teratur</option>
                                            <option value="Tidak Teratur">Tidak Teratur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_keluhan_hamil_muda">Keluhan Hamil Muda</label>
                                        <select class="form-select" name="riwayat_hamil_keluhan_hamil_muda" id="riwayat_hamil_keluhan_hamil_muda" style="border-radius: 6px">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Mual">Mual</option>
                                            <option value="Muntah">Muntah</option>
                                            <option value="Perdarahan">Perdarahan</option>
                                            <option value="Lain–lain">Lain–lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_keluhan_hamil_tua">Keluhan Hamil Muda</label>
                                        <select class="form-select" name="riwayat_hamil_keluhan_hamil_tua" id="riwayat_hamil_keluhan_hamil_tua" style="border-radius: 6px">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Mual">Mual</option>
                                            <option value="Muntah">Muntah</option>
                                            <option value="Perdarahan">Perdarahan</option>
                                            <option value="Lain–lain">Lain–lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_kb">Riwayat KB</label>
                                        <select class="form-select" name="riwayat_kb" id="riwayat_kb" style="border-radius: 6px">
                                            <option value="Belum Pernah">Belum Pernah</option>
                                            <option value="Suntik">Suntik</option>
                                            <option value="Pil">Pil</option>
                                            <option value="AKDR">AKDR</option>
                                            <option value="MOW">MOW</option>
                                            <option value="Implant">Implant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_kb_lamanya">Lamanya</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_kb_lamanya" name="riwayat_kb_lamanya" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius: 6px">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_kb_ket_komplikasi">Komplikasi</label>
                                        <select class="form-select br-left" name="riwayat_kb_ket_komplikasi" id="riwayat_kb_ket_komplikasi">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada">Ada</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_kb_ket_komplikasi" name="riwayat_kb_ket_komplikasi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_kb_kapaberhenti">Kapan Berhenti KB</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="riwayat_kb_kapaberhenti" name="riwayat_kb_kapaberhenti" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="riwayat_kb_kapaberhenti">Alasan Berhenti KB</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="riwayat_kb_kapaberhenti" name="riwayat_kb_kapaberhenti" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_kebiasaan_obat">Riwayat Ginekologi</label>
                                        <select class="form-select br-left br-full" name="riwayat_kebiasaan_obat" id="riwayat_kebiasaan_obat">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Infertilitas">Infertilitas</option>
                                            <option value="Infeksi Virus">Infeksi Virus</option>
                                            <option value="PMS">PMS</option>
                                            <option value="Cervisitis Kronis">Cervisitis Kronis</option>
                                            <option value="Endometriosis">Endometriosis</option>
                                            <option value="Mioma">Mioma</option>
                                            <option value="Polip Cervix">Polip Cervix</option>
                                            <option value="Kanker Kandungan">Kanker Kandungan</option>
                                            <option value="Operasi Kandungan">Operasi Kandungan</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="" class="mb-2 mt-2">Riwayat Kebiasaan</label>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_kebiasaan_obat">Obat/Vitamin</label>
                                        <select class="form-select br-left" name="riwayat_kebiasaan_obat" id="riwayat_kebiasaan_obat">
                                            <option value="-">-</option>
                                            <option value="Obat Obatan">Obat Obatan</option>
                                            <option value="Vitamin">Vitamin</option>
                                            <option value="Jamu Jamuan">Jamu Jamuan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" placeholder="" aria-label="" id="riwayat_kebiasaan_ket_obat" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="riwayat_kebiasaan_ket_obat">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_kebiasaan_merokok">Merokok</label>
                                        <select class="form-select br-left" name="riwayat_kebiasaan_merokok" id="riwayat_kebiasaan_merokok">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" placeholder="" aria-label="" id="riwayat_kebiasaan_ket_merokok" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="riwayat_kebiasaan_ket_merokok">
                                        <label for="">btg /hr</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_kebiasaan_alkohol">Merokok</label>
                                        <select class="form-select br-left" name="riwayat_kebiasaan_alkohol" id="riwayat_kebiasaan_alkohol">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" placeholder="" aria-label="" id="riwayat_kebiasaan_narkoba" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" name="riwayat_kebiasaan_narkoba">
                                        <label for="">gls /hr</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_kebiasaan_narkoba">Obat Tidur</label>
                                        <select class="form-select br-full" name="riwayat_kebiasaan_narkoba" id="riwayat_kebiasaan_narkoba">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : riwayat kesehatan --}}
                            <div class="separator m-2">2. Pemeriksaan Kebidanan</div>
                            {{-- section : pemeriksaaan kebidanan --}}
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_mental">Kesadaran Mental:</label>
                                        <select class="form-select br-full" name="pemeriksaan_kebidanan_mental" id="pemeriksaan_kebidanan_mental">
                                            <option value="Compos Mentis">Compos Mentis</option>
                                            <option value="Somnolence">Somnolence</option>
                                            <option value="Sopor">Sopor</option>
                                            <option value="Coma">Coma</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_keadaan_umum">Keadaan Umum:</label>
                                        <select class="form-select br-full" name="pemeriksaan_kebidanan_keadaan_umum" id="pemeriksaan_kebidanan_keadaan_umum">
                                            <option value="Baik">Baik</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Buruk">Buruk</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_gcs">GCS (E,V,M)</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_gcs" name="pemeriksaan_kebidanan_gcs" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_td">Tensi</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_td" name="pemeriksaan_kebidanan_td" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="">mmHg</label>

                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2" style="padding-right:0">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_nadi">Nadi</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_nadi" name="pemeriksaan_kebidanan_nadi" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_nadi">x /mnt</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_rr">RR</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_rr" name="pemeriksaan_kebidanan_rr" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_rr">x /mnt</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_suhu">Suhu</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_suhu" name="pemeriksaan_kebidanan_suhu" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_suhu">°C</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_spo2">SpO2</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_spo2" name="pemeriksaan_kebidanan_spo2" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_spo2">%</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_tb">TB</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_tb" name="pemeriksaan_kebidanan_tb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_tb">Cm</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_bb">BB</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_bb" name="pemeriksaan_kebidanan_bb" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_bb">Kg</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_lila">LILA</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_lila" name="pemeriksaan_kebidanan_lila" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_lila">Cm</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_tfu">TFU</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_tfu" name="pemeriksaan_kebidanan_tfu" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_tfu">Cm</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_tbj">TBJ</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_tbj" name="pemeriksaan_kebidanan_tbj" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_tbj">gr</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_gd">GD</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_gd" name="pemeriksaan_kebidanan_gd" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_letak">Letak</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_letak" name="pemeriksaan_kebidanan_letak" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_presentasi">Presentasi</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_presentasi" name="pemeriksaan_kebidanan_presentasi" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_penurunan">Penurunan</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_penurunan" name="pemeriksaan_kebidanan_penurunan" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_his">Kontraksi/HIS</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_his" name="pemeriksaan_kebidanan_his" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_his">x /10'</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_kekuatan">Kekuatan</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_kekuatan" name="pemeriksaan_kebidanan_kekuatan" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_lamanya">Lama</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_lamanya" name="pemeriksaan_kebidanan_lamanya" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_lamanya">detik</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_djj">Gerak janin x/30 mnt, DJJ</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_djj" name="pemeriksaan_kebidanan_djj" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_djj">/mnt</label>
                                        <select class="form-select br-full" name="pemeriksaan_kebidanan_ket_djj" id="pemeriksaan_kebidanan_ket_djj">
                                            <option value="Teratur">Teratur</option>
                                            <option value="Tidak Teratur">Tidak Teratur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-6">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_djj">Gerak janin x/30 mnt, DJJ</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_djj" name="pemeriksaan_kebidanan_djj" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_djj">/mnt</label>
                                        <select class="form-select br-full" name="pemeriksaan_kebidanan_ket_djj" id="pemeriksaan_kebidanan_ket_djj">
                                            <option value="Teratur">Teratur</option>
                                            <option value="Tidak Teratur">Tidak Teratur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-2">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_portio">Portio</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_portio" name="pemeriksaan_kebidanan_portio" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_pembukaan">Pembukaan Serviks</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_pembukaan" name="pemeriksaan_kebidanan_pembukaan" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_pembukaan">Cm</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_ketuban">Ketuban</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_ketuban" name="pemeriksaan_kebidanan_ketuban" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        <label for="pemeriksaan_kebidanan_ketuban">kep/bok</label>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-3">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_hodge">Hodge</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="pemeriksaan_kebidanan_hodge" name="pemeriksaan_kebidanan_hodge" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-5">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_panggul">Panggul</label>
                                        <select class="form-select br-full" name="pemeriksaan_kebidanan_panggul" id="pemeriksaan_kebidanan_panggul">
                                            <option value="Luas">Luas</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Sempit">Sempit</option>
                                            <option value="Tidak Dilakukan Pemeriksaan">Tidak Dilakukan Pemeriksaan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_inspekulo">Inspekulo</label>
                                        <select class="form-select br-left" name="pemeriksaan_kebidanan_inspekulo" id="pemeriksaan_kebidanan_inspekulo">
                                            <option value="Dilakukan">Dilakukan</option>
                                            <option value="Tidak Dilakukan">Tidak Dilakukan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" id="pemeriksaan_kebidanan_ket_inspekulo" name="pemeriksaan_kebidanan_ket_inspekulo" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_lakmus">Lakmus</label>
                                        <select class="form-select br-left" name="pemeriksaan_kebidanan_lakmus" id="pemeriksaan_kebidanan_lakmus">
                                            <option value="Dilakukan">Dilakukan</option>
                                            <option value="Tidak Dilakukan">Tidak Dilakukan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" id="pemeriksaan_kebidanan_ket_lakmus" name="pemeriksaan_kebidanan_ket_lakmus" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_ctg">CTG</label>
                                        <select class="form-select br-left" name="pemeriksaan_kebidanan_ctg" id="pemeriksaan_kebidanan_ctg">
                                            <option value="Dilakukan">Dilakukan</option>
                                            <option value="Tidak Dilakukan">Tidak Dilakukan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" id="pemeriksaan_kebidanan_ket_ctg" name="pemeriksaan_kebidanan_ket_ctg" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            {{-- endsectoin :  pemeriksaaan kebidanan --}}
                            <div class="separator m-2">3. Pemeriksaan Umum</div>
                            {{-- section : pemeriksaan umum --}}
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_kepala">Kepala</label>
                                        <select name="pemeriksaan_umum_kepala" class="form-select br-full" id="pemeriksaan_umum_kepala">
                                            <option value="Normocephale">Normocephale</option>
                                            <option value="Hydrocephalus">Hydrocephalus</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_muka">Muka</label>
                                        <select name="pemeriksaan_umum_muka" class="form-select br-full" id="pemeriksaan_umum_muka">
                                            <option value="Normocephale">Normocephale</option>
                                            <option value="Pucat">Pucat</option>
                                            <option value="Oedem">Oedem</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_mata">Mata</label>
                                        <select name="pemeriksaan_umum_mata" class="form-select br-full" id="pemeriksaan_umum_mata">
                                            <option value="Conjungtiva Merah Muda">Conjungtiva Merah Muda</option>
                                            <option value="Conjungtiva Pucat">Conjungtiva Pucat</option>
                                            <option value="Sklera Ikterik">Sklera Ikterik</option>
                                            <option value="Pandangan Kabur">Pandangan Kabur</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : pemeriksaan umum --}}
                        </div>
                        {{-- endsection : form kanan --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary simpanAskepAnak" onclick="simpanAskepNeonatusRanap()" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var kodeMasalah = []
        var kodeRencanaNeo = []

        $('#riwayatImunisasiNeo').click(() => {
            $('#modalRiwayatImunisasi').modal('show')
        })

        $('#modalAskepRanapKandungan').on('hidden.bs.modal', () => {
            $('.simpanAskepAnak').css('display', 'inline');
            document.getElementById("formAskepRanapKandungan").reset();
            tbRencanaKeperawatanNeo()
            kodeMasalah = [];
            kodeRencanaNeo = [];
        })
        $('#modalAskepRanapKandungan').on('shown.bs.modal', () => {
            $('.simpanAskepAnak').css('display', 'none');
            localStorage.removeItem('kodeRencanaNeo')
            $('#formAskepRanapKandungan input[name=tanggal]').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })

        })

        function getAskepRanapKandungan(no_rawat) {
            const askep = $.ajax({
                url: '/erm/ranap/askep/neonatus',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
            })

            return askep;
        }


        function askepRanapKandungan(no_rawat) {

            tbMasalahKeperawatanKandungan()
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                jk = regPeriksa.pasien.jk == 'P' ? 'PEREMPUAN' : 'LAKI-LAKI';
                $('#formAskepRanapKandungan input[name=no_rawat]').val(no_rawat)
                $('#formAskepRanapKandungan input[name=pasien]').val(`${regPeriksa.pasien.nm_pasien} (${jk})`)
                $('#formAskepRanapKandungan input[name=tgl_lahir]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
                $('#formAskepRanapKandungan input[name=kd_dokter]').val(regPeriksa.kd_dokter)
                $('#formAskepRanapKandungan input[name=dokter]').val(regPeriksa.dokter.nm_dokter)
                $('#formAskepRanapKandungan input[name=agama]').val(regPeriksa.pasien.agama)
                $('#formAskepRanapKandungan input[name=penjab]').val(regPeriksa.penjab.png_jawab)
                $('#formAskepRanapKandungan input[name=pekerjaan]').val(regPeriksa.pasien.pekerjaan)
                $('#formAskepRanapKandungan input[name=bahasa]').val(regPeriksa.pasien.bahasa.nama_bahasa)
                $('#formAskepRanapKandungan input[name=riwayat_psiko_pendidikan]').val(regPeriksa.pasien.pnd)
                $('#formAskepRanapKandungan input[name=no_rkm_medis]').val(regPeriksa.no_rkm_medis)
                setRiwayatImunisasi(regPeriksa.no_rkm_medis)
                $('#formRiwayatImunisasi button[name=tambah-imunisasi]').attr('onclick', `insertRiwayatImunisasi('${regPeriksa.no_rkm_medis}')`)

            })

            getAskepRanapKandungan(no_rawat).done((response) => {
                nip = "{{ session()->get('pegawai')->nik }}";
                if (response) {
                    $.each(response, (index, value) => {
                        select = $(`#formAskepRanapKandungan select[name=${index}]`);
                        input = $(`#formAskepRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAskepRanapKandungan textarea[name=${index}]`);
                        if (select.length) {
                            $(`#formAskepRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAskepRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAskepRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })

                    $(`#formAskepRanapKandungan input[name=pengkaji2]`).val(response.pengkaji2.nama)
                    $(`#formAskepRanapKandungan input[name=pengkaji1]`).val(response.pengkaji1.nama)
                    $(`#formAskepRanapKandungan input[name=tanggal]`).val(splitTanggal(response.tanggal.split(' ')[0]))
                    $(`#formAskepRanapKandungan input[name=jam]`).val(response.tanggal.split(' ')[1])
                    $('#formAskepRanapKandungan input[name=tanggal]').datepicker('setDate', splitTanggal(response.tanggal.split(' ')[0]))
                    let arrMasalah = []
                    $.map(response.masalah_keperawatan, (msl) => {
                        $('#kodeMasalahNeo' + msl.kode_masalah).attr('checked', 'checked')
                        arrMasalah.push(msl.kode_masalah)

                    })
                    tbRencanaKeperawatanNeo(arrMasalah)

                    if (response.nip1 == nip || response.nip2 == nip) {
                        $('.simpanAskepAnak').css('display', 'inline');
                    } else if (nip == 'direksi' || nip == 'verifikator') {
                        $('.simpanAskepAnak').css('display', 'inline');
                    } else {
                        $('.simpanAskepAnak').css('display', 'none');
                    }

                } else {
                    $('#formAskepRanapKandungan input[name=nip1]').val("{{ session()->get('pegawai')->nik }}")
                    $('#formAskepRanapKandungan input[name=pengkaji1]').val("{{ session()->get('pegawai')->nama }}")
                }
            })

            $('#modalAskepRanapKandungan').modal('show')

        }

        // function getRiwayatImunisasi(no_rkm_medis) {
        //     const riwayatImunisasi = $.ajax({
        //         url: `/erm/imunisasi/riwayat/get/${no_rkm_medis}`,
        //         method: 'GET',
        //     })

        //     return riwayatImunisasi;
        // }

        $('#formAskepRanapKandungan select[name=menangis]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=menangis]').find(':selected').data('id')
            $('#formAskepRanapKandungan input[name=nilaimenangis]').val(data)
            hitungSkalaNyeriNeonatus()
        })
        $('#formAskepRanapKandungan select[name=wajah]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=wajah]').find(':selected').data('id')
            $('#formAskepRanapKandungan input[name=nilaiwajah]').val(data)
            hitungSkalaNyeriNeonatus()
        })
        $('#formAskepRanapKandungan select[name=kaki]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=kaki]').find(':selected').data('id')
            $('#formAskepRanapKandungan input[name=nilaikaki]').val(data)
            hitungSkalaNyeriNeonatus()
        })
        $('#formAskepRanapKandungan select[name=aktifitas]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=aktifitas]').find(':selected').data('id')
            $('#formAskepRanapKandungan input[name=nilaiaktifitas]').val(data)
            hitungSkalaNyeriNeonatus()
        })
        $('#formAskepRanapKandungan select[name=bersuara]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=bersuara]').find(':selected').data('id')
            $('#formAskepRanapKandungan input[name=nilaibersuara]').val(data)
            hitungSkalaNyeriNeonatus()
        })

        function hitungSkalaNyeriNeonatus() {
            bersuara = $('#formAskepRanapKandungan input[name=nilaibersuara]').val();
            menangis = $('#formAskepRanapKandungan input[name=nilaimenangis]').val();
            wajah = $('#formAskepRanapKandungan input[name=nilaiwajah]').val();
            kaki = $('#formAskepRanapKandungan input[name=nilaikaki]').val();
            aktifitas = $('#formAskepRanapKandungan input[name=nilaiaktifitas]').val();

            skalaNyeri = parseInt(bersuara) + parseInt(menangis) + parseInt(wajah) + parseInt(kaki) + parseInt(aktifitas);

            $('#formAskepRanapKandungan input[name=hasilnyeri]').val(skalaNyeri)

            if (skalaNyeri >= 1 && skalaNyeri <= 3) {
                nyeri = 'Nyeri Ringan'
            } else if (skalaNyeri >= 4 && skalaNyeri <= 6) {
                nyeri = 'Nyeri Sedang'
            } else if (skalaNyeri >= 7 && skalaNyeri <= 10) {
                nyeri = 'Nyeri Akut'
            } else {
                nyeri = 'Tidak Ada Nyeri'
            }
            $('#formAskepRanapKandungan select[name=nyeri]').val(nyeri)
        }

        var nilaiGizi = 0;
        $(`#formAskepRanapKandungan select[name=skrining_gizi1]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi1]`).find(':selected').data('id')
            $(`#formAskepRanapKandungan input[name=nilai_gizi1]`).val(data)
            hitungSkriningGiziNeonatus();
        })
        $(`#formAskepRanapKandungan select[name=skrining_gizi2]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi2]`).find(':selected').data('id')
            $(`#formAskepRanapKandungan input[name=nilai_gizi2]`).val(data)
            hitungSkriningGiziNeonatus();
        })
        $(`#formAskepRanapKandungan select[name=skrining_gizi3]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi3]`).find(':selected').data('id')
            $(`#formAskepRanapKandungan input[name=nilai_gizi3]`).val(data)
            hitungSkriningGiziNeonatus();
        })
        $(`#formAskepRanapKandungan select[name=skrining_gizi4]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi4]`).find(':selected').data('id')
            $(`#formAskepRanapKandungan input[name=nilai_gizi4]`).val(data)
            hitungSkriningGiziNeonatus();
        })

        function hitungSkriningGiziNeonatus() {
            nilaiGizi1 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi1]`).val())
            nilaiGizi2 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi2]`).val())
            nilaiGizi3 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi3]`).val())
            nilaiGizi4 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi4]`).val())
            nilaiGizi = nilaiGizi1 + nilaiGizi2 + nilaiGizi3 + nilaiGizi4
            $('#formAskepRanapKandungan input[name=nilai_total_gizi]').val(nilaiGizi)
        }

        function simpanAskepNeonatusRanap() {
            let except = ['no_rkm_medis', 'dokter', 'pengkaji1', 'pengkaji2', 'pasien', 'tgl_lahir', 'bahasa', 'agama', 'penjab', 'pekerjaan', 'rencana', ''];
            data = getDataForm('#formAskepRanapKandungan', ['input', 'select', 'textarea'], except)
            data['tanggal'] = `${splitTanggal(data.tanggal)} ${data.jam}`
            delete data.jam


            $.ajax({
                url: '/erm/ranap/askep/neonatus/create',
                data: data,
                method: 'post',
                success: (response) => {
                    swal.fire({
                        title: 'Berhasil',
                        text: 'Berhasil menyimpan data asesmen',
                        showConfirmButton: false,
                        icon: 'success',
                        timer: 1500,
                    });
                    simpanMasalahKeperawatanNeo(data.no_rawat)
                },
                error: function(request, status, error) {
                    swal.fire(
                        'Gagal',
                        `${error}, ERROR CODE : ${request.status}`,
                        'error'
                    )

                }
            })
        }


        function simpanMasalahKeperawatanNeo(no_rawat) {
            let masalah = [];
            let dataMasalah = [];
            let dataRencana = []

            $('.listMasalahKeperawatanNeo').each((index, element) => {
                isChecked = $(element).is(':checked');
                if (isChecked) {
                    idMasalah = $(element).val()
                    dataMasalah.push({
                        'no_rawat': no_rawat,
                        'kode_masalah': idMasalah,
                    })
                }
            })

            $('.listRencanaKeperawatanNeo').each((index, element) => {
                isChecked = $(element).is(':checked')
                if (isChecked) {
                    idRencana = $(element).val()
                    dataRencana.push({
                        'no_rawat': no_rawat,
                        'kode_rencana': idRencana
                    })
                }
            })

            getMasalahKeperawatan(no_rawat).done((response) => {
                if (response.length) {
                    deleteMasalahKeperawatan(no_rawat).done(() => {
                        insertMasalahKeperawatan(dataMasalah).done((response) => {})
                    })
                } else {
                    if (dataMasalah.length) {
                        insertMasalahKeperawatan(dataMasalah).done((response) => {})
                    }
                }
            })

            getRencanaKeperawatan(no_rawat).done((resRencana) => {
                if (resRencana.length) {
                    deleteRencanaKeperawatan(no_rawat).done(() => {
                        insertRencanaKeperawatan(dataRencana).done((response) => {})
                    })
                } else {
                    if (dataRencana.length) {
                        insertRencanaKeperawatan(dataRencana).done((dr) => {})
                    }
                }
            })
        }

        function insertMasalahKeperawatan(dataMasalah) {
            const masalah = $.ajax({
                url: 'ranap/askep/anak/masalah/insert',
                data: {
                    _token: "{{ csrf_token() }}",
                    masalah: dataMasalah
                },
                method: 'POST'
            })

            return masalah;
        }

        function deleteMasalahKeperawatan(no_rawat) {
            const masalah = $.ajax({
                url: 'ranap/askep/anak/masalah/delete',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat
                },
                method: 'POST'
            })

            return masalah;
        }

        function insertRencanaKeperawatan(dataRencana) {
            const rencana = $.ajax({
                url: 'ranap/askep/anak/rencana/insert',
                data: {
                    _token: "{{ csrf_token() }}",
                    rencana: dataRencana
                },
                method: 'POST'
            })

            return rencana;
        }

        function deleteRencanaKeperawatan(no_rawat) {
            const rencana = $.ajax({
                url: 'ranap/askep/anak/rencana/delete',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat
                },
                method: 'POST'
            })

            return rencana;
        }

        function getMasalahKeperawatan(no_rawat) {
            const masalah = $.ajax({
                url: 'ranap/askep/anak/masalah',
                data: {
                    no_rawat: no_rawat,
                }
            })

            return masalah;
        }

        function tbMasalahKeperawatanKandungan() {
            $('#tbMasalahKeperawatanNeo').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 250,
                info: false,
                ajax: {
                    url: '/erm/master/masalah/keperawatan/table',
                },
                columns: [{
                    data: '',
                    render: (data, type, row) => {
                        return `<div class="form-check masalahKeperawatan">
                                    <input class="form-check-input listMasalahKeperawatanNeo" type="checkbox" id="kodeMasalahNeo${row.kode_masalah}" onclick="cekMasalahKeperawatanNeo(this,'${row.kode_masalah}')" value="${row.kode_masalah}">
                                </div>`
                    }
                }, {
                    data: '',
                    render: (data, type, row) => {
                        return `<label onclick="cekMasalahKeperawatanNeo(this,'${row.kode_masalah}')">${row.nama_masalah}</label>`
                    }
                }]
            })
        }



        function cekMasalahKeperawatanNeo(element, params) {
            const isChecked = $(`#kodeMasalahNeo${params}`).is(':checked')
            if (isChecked) {
                kodeMasalah.push(params)
            } else {
                kodeMasalah = kodeMasalah.filter((item) => {
                    return item != params
                });
            }
            tbRencanaKeperawatanNeo(kodeMasalah)
            if (kodeMasalah.length == 0) {
                localStorage.removeItem(`kodeRencanaNeo`)
            }
        }

        function cekRencanaKeperawatanNeo(params) {
            const isChecked = $(`#kodeRencanaNeo${params}`).is(':checked')
            if (isChecked) {
                kodeRencanaNeo.push(params)
            } else {
                kodeRencanaNeo = kodeRencanaNeo.filter((item) => {
                    return item != params
                });
            }
            if (kodeRencanaNeo.length == 0) {
                localStorage.removeItem(`kodeRencanaNeo`)
            } else {
                localStorage.setItem(`kodeRencanaNeo`, JSON.stringify(kodeRencanaNeo))
            }
        }

        function tbRencanaKeperawatanNeo(kode) {
            $('#tbRencanaKeperawatanNeo').dataTable({
                destroy: true,
                processing: true,
                ordering: false,
                paging: false,
                scrollY: 240,
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
                            kode = localStorage.kodeRencanaNeo ? JSON.parse(localStorage.kodeRencanaNeo) : ''
                            $.map(kode, (kd) => {
                                if (kd == row.kode_rencana) {
                                    $('#kodeRencanaNeo' + row.kode_rencana).attr('checked', 'checked')
                                } else {
                                    $('#kodeRencanaNeo' + row.kode_rencana).removeProp('checked')
                                }

                            })

                            return `<div class="form-check">
                                    <input class="form-check-input listRencanaKeperawatanNeo" type="checkbox" value="${row.kode_rencana}" data-masalah="${row.kode_masalah}" onclick="cekRencanaKeperawatanNeo('${row.kode_rencana}')" id="kodeRencanaNeo${row.kode_rencana}" onclick="">
                                </div>`
                        }
                    },
                    {
                        data: '',
                        render: (data, type, row) => {
                            return row.rencana_keperawatan
                        }
                    }
                ],
                initComplete: (response) => {
                    no_rawat = $('#formAskepRanapKandungan input[name=no_rawat]').val();
                    getRencanaKeperawatan(no_rawat).done((res) => {
                        $.map(res, (rencana) => {
                            $('#kodeRencanaNeo' + rencana.kode_rencana).attr('checked', 'checked')
                        })
                    })
                }
            })
        }


        function hitungApgar(n) {
            let f = $(`#formAskepRanapKandungan input[name=f${n}]`).val() ? $(`#formAskepRanapKandungan input[name=f${n}]`).val() : 0;
            let u = $(`#formAskepRanapKandungan input[name=u${n}]`).val() ? $(`#formAskepRanapKandungan input[name=u${n}]`).val() : 0;
            let t = $(`#formAskepRanapKandungan input[name=t${n}]`).val() ? $(`#formAskepRanapKandungan input[name=t${n}]`).val() : 0;
            let r = $(`#formAskepRanapKandungan input[name=r${n}]`).val() ? $(`#formAskepRanapKandungan input[name=r${n}]`).val() : 0;
            let w = $(`#formAskepRanapKandungan input[name=w${n}]`).val() ? $(`#formAskepRanapKandungan input[name=w${n}]`).val() : 0;

            let nilaiApgar = parseInt(f) + parseInt(u) + parseInt(t) + parseInt(r) + parseInt(w)

            $(`#formAskepRanapKandungan input[name=n${n}]`).val(nilaiApgar)
        }
    </script>
@endpush
