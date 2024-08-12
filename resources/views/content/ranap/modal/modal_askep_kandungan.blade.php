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
                                    <input type="text" class="form-control form-control-sm" name="tanggal" placeholder="" aria-label="" autocomplete="off" value="{{ date('d-m-Y') }}">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-2">
                                    <label for="jam">Jam</label>
                                    <input type="text" class="form-control form-control-sm jam" name="jam" placeholder="" aria-label="" autocomplete="off" value="{{ date('H:i:s') }}">
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
                                    <select class="form-select form-select-sm" id="anamnesis" name="informasi">
                                        <option value="Autoanamnesis" selected>Autoanamnesis</option>
                                        <option value="Alloanamnesis">Alloanamnesis</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <label for="tiba_diruang_rawat">Tiba di ruang</label>
                                    <select class="form-select form-select-sm" id="tiba_diruang_rawat" name="tiba_diruang_rawat">
                                        <option value="Jalan Tanpa Bantuan" selected>Jalan Tanpa Bantuan</option>
                                        <option value="Kursi Roda">Kursi Roda</option>
                                        <option value="Brankar">Brankar</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-3">
                                    <label for="cara_masuk">Cara Masuk</label>
                                    <select class="form-select form-select-sm" id="cara_masuk" name="cara_masuk">
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
                                        <label for="alergi">Riwayat Alergi</label>
                                        <input type="text" class="form-control form-control-sm" id="alergi" name="alergi" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
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
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <button type="button" class="btn btn-primary btn-sm" id="btnRiwayatPersalinan">+ Tambah Riwayat</button>
                                </div>
                                <label for="">Riwayat Hamil Sekarang</label>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_hpht">HPHT</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_hpht" name="riwayat_hamil_hpht" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" autocomplete="off" style="border-radius: 6px" value="{{ date('d-m-Y') }}">
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_usiahamil">Usia Hamil</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_usiahamil" name="riwayat_hamil_usiahamil" placeholder="" onfocus="removeZero(this)" value="-" onblur="cekKosong(this)" autocomplete="off" style="border-radius: 6px">
                                        <label for="riwayat_hamil_usiahamil">bln/mgg</label>
                                    </div>
                                </div>
                                <div class="mb-2 col-sm-12 col-md-6 col-lg-2">
                                    <div class="input-group">
                                        <label for="riwayat_hamil_tp">TP</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_hamil_tp" name="riwayat_hamil_tp" placeholder="" onfocus="removeZero(this)" onblur="cekKosong(this)" autocomplete="off" style="border-radius: 6px" value="{{ date('d-m-Y') }}">
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
                                        <label for="riwayat_kb_komplikasi">Komplikasi</label>
                                        <select class="form-select br-left" name="riwayat_kb_komplikasi" id="riwayat_kb_komplikasi">
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
                                        <label for="riwayat_genekologi">Riwayat Ginekologi</label>
                                        <select class="form-select br-left br-full" name="riwayat_genekologi" id="riwayat_genekologi">
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
                                            <option value="Apatis">Apatis</option>
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
                                        <label for="gd">GD</label>
                                        <input type="text" class="form-control form-control-sm br-full" id="gd" name="gd" placeholder="" maxlength="10" autocomplete="off" readonly>
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
                                            <option value="Tidak">Tidak Dilakukan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" id="pemeriksaan_kebidanan_ket_inspekulo" name="pemeriksaan_kebidanan_ket_inspekulo" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_lakmus">Lakmus</label>
                                        <select class="form-select br-left" name="pemeriksaan_kebidanan_lakmus" id="pemeriksaan_kebidanan_lakmus">
                                            <option value="Dilakukan">Dilakukan</option>
                                            <option value="Tidak">Tidak Dilakukan</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm br-right" id="pemeriksaan_kebidanan_ket_lakmus" name="pemeriksaan_kebidanan_ket_lakmus" placeholder="" maxlength="10" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_kebidanan_ctg">CTG</label>
                                        <select class="form-select br-left" name="pemeriksaan_kebidanan_ctg" id="pemeriksaan_kebidanan_ctg">
                                            <option value="Dilakukan">Dilakukan</option>
                                            <option value="Tidak">Tidak Dilakukan</option>
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
                                            <option value="Normal">Normal</option>
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
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_hidung">Hidung</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_hidung" id="pemeriksaan_umum_hidung">
                                            <option value="Normal">Normal</option>
                                            <option value="Sekret">Sekret</option>
                                            <option value="Polip">Polip</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_telinga">Telinga</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_telinga" id="pemeriksaan_umum_telinga">
                                            <option value="Bersih">Bersih</option>
                                            <option value="Serumen">Serumen</option>
                                            <option value="Polip">Polip</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_mulut">Mulut</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_mulut" id="pemeriksaan_umum_mulut">
                                            <option value="Bersih">Bersih</option>
                                            <option value="Kotor">Kotor</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_leher">Leher</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_leher" id="pemeriksaan_umum_leher">
                                            <option value="Normal">Normal</option>
                                            <option value="Pembesaran KGB">Pembesaran KGB</option>
                                            <option value="Pembesaran Kelenjar Tiroid">Pembesaran Kelenjar Tiroid</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_dada">Dada</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_dada" id="pemeriksaan_umum_dada">
                                            <option value="Mamae Simetris">Mamae Simetris</option>
                                            <option value="Mamae Asimetris">Mamae Asimetris</option>
                                            <option value="Aerola Hiperpigmentasi">Aerola Hiperpigmentasi</option>
                                            <option value="Kolustrum (+)">Kolustrum (+)</option>
                                            <option value="Tumor">Tumor</option>
                                            <option value="Puting Susu Menonjol">Puting Susu Menonjol</option>
                                            <option value="Pembesaran KGB">Pembesaran KGB</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_perut">Perut</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_perut" id="pemeriksaan_umum_perut">
                                            <option value="Luka Bekas Operasi">Luka Bekas Operasi</option>
                                            <option value="Nyeri Tekan (Ya)">Nyeri Tekan (Ya)</option>
                                            <option value="Nyeri Tekan (Tidak)">Nyeri Tekan (Tidak)</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_genitalia">Genitalia</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_genitalia" id="pemeriksaan_umum_genitalia">
                                            <option value="Bersih">Bersih</option>
                                            <option value="Kotor">Kotor</option>
                                            <option value="Varises">Varises</option>
                                            <option value="Oedem">Oedem</option>
                                            <option value="Hematoma">Hematoma</option>
                                            <option value="Hemoroid">Hemoroid</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-4">
                                    <div class="input-group">
                                        <label for="pemeriksaan_umum_ekstrimitas">Ekstrimitas</label>
                                        <select class="form-select br-full" name="pemeriksaan_umum_ekstrimitas" id="pemeriksaan_umum_ekstrimitas">
                                            <option value="Normal">Normal</option>
                                            <option value="Bersih">Bersih</option>
                                            <option value="Oedem">Oedem</option>
                                            <option value="Refleks Patella Ada">Refleks Patella Ada</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : pemeriksaan umum --}}
                        </div>
                        {{-- endsection : form kanan --}}
                        {{-- section : form kiri --}}
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="separator m-2">4. Pengkajian Fungsi</div>
                            {{-- section : Pengkajian Fungsi --}}
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_kemampuan_aktifitas">a. Kemampuan Aktivitas Sehari-hari</label>
                                        <select class="form-select" name="pengkajian_fungsi_kemampuan_aktifitas" id="pengkajian_fungsi_kemampuan_aktifitas" style="border-radius:6px">
                                            <option value="Mandiri">Mandiri</option>
                                            <option value="Bantuan minimal">Bantuan Minimal</option>
                                            <option value="Bantuan Sebagian">Bantuan Sebagian</option>
                                            <option value="Ketergantungan Total">Ketergantungan Total</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_berjalan">b. Berjalan</label>
                                        <select class="form-select" name="pengkajian_fungsi_berjalan" id="pengkajian_fungsi_berjalan" style="border-radius:6px 0 0 6px ">
                                            <option value="TAK">TAK</option>
                                            <option value="Penurunan Kekuatan/ROM">Penurunan Kekuatan/ROM</option>
                                            <option value="Paralisis">Paralisis</option>
                                            <option value="Sering Jatuh">Sering Jatuh</option>
                                            <option value="Sering Jatuh">Sering Jatuh</option>
                                            <option value="Deformitas">Deformitas</option>
                                            <option value="Hilang Keseimbangan">Hilang Keseimbangan</option>
                                            <option value="Riwayat Patah Tulang">Riwayat Patah Tulang</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="pengkajian_fungsi_ket_berjalan" name="pengkajian_fungsi_ket_berjalan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-4">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_aktivitas">c. Aktivitas</label>
                                        <select class="form-select" name="pengkajian_fungsi_aktivitas" id="pengkajian_fungsi_aktivitas" style="border-radius:6px">
                                            <option value="Tirah Baring">Tirah Baring</option>
                                            <option value="Duduk">Duduk</option>
                                            <option value="Berjalan">Berjalan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ambulasi">d. Ambulasi</label>
                                        <select class="form-select" name="pengkajian_fungsi_ambulasi" id="pengkajian_fungsi_ambulasi" style="border-radius:6px">
                                            <option value="Walker">Walker</option>
                                            <option value="Tongkat">Tongkat</option>
                                            <option value="Kursi Roda">Kursi Roda</option>
                                            <option value="Tidak Menggunakan">Tidak Menggunakan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ekstrimitas_atas">e. Ekstrimitas Atas</label>
                                        <select class="form-select" name="pengkajian_fungsi_ekstrimitas_atas" id="pengkajian_fungsi_ekstrimitas_atas" style="border-radius:6px 0 0 6px">
                                            <option value="TAK">TAK</option>
                                            <option value="Lemah">Lemah</option>
                                            <option value="Oedema">Oedema</option>
                                            <option value="Tidak Simetris">Tidak Simetris</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="pengkajian_fungsi_ket_ekstrimitas_atas" name="pengkajian_fungsi_ket_ekstrimitas_atas" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_ekstrimitas_bawah">f. Ekstrimitas Bawah</label>
                                        <select class="form-select" name="pengkajian_fungsi_ekstrimitas_bawah" id="pengkajian_fungsi_ekstrimitas_bawah" style="border-radius:6px 0 0 6px">
                                            <option value="TAK">TAK</option>
                                            <option value="Lemah">Lemah</option>
                                            <option value="Oedema">Oedema</option>
                                            <option value="Tidak Simetris">Tidak Simetris</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="pengkajian_fungsi_ket_ekstrimitas_bawah" name="pengkajian_fungsi_ket_ekstrimitas_bawah" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_kemampuan_menggenggam">g. Kemampuan Menggenggam</label>
                                        <select class="form-select" name="pengkajian_fungsi_kemampuan_menggenggam" id="pengkajian_fungsi_kemampuan_menggenggam" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Kesulitan">Tidak Ada Kesulitan</option>
                                            <option value="Terakhir">Terakhir</option>
                                            <option value="Lain-lain">Lain-lain</option>

                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="pengkajian_fungsi_ket_kemampuan_menggenggam" name="pengkajian_fungsi_ket_kemampuan_menggenggam" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_koordinasi">h. Kemampuan Koordinasi</label>
                                        <select class="form-select" name="pengkajian_fungsi_koordinasi" id="pengkajian_fungsi_koordinasi" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Kesulitan">Tidak Ada Kesulitan</option>
                                            <option value="Ada Masalah">Ada Masalah</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="pengkajian_fungsi_ket_koordinasi" name="pengkajian_fungsi_ket_koordinasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="pengkajian_fungsi_gangguan_fungsi">i. Kesimpulan Gangguan Fungsi</label>
                                        <select class="form-select" name="pengkajian_fungsi_gangguan_fungsi" id="pengkajian_fungsi_gangguan_fungsi" style="border-radius:6px">
                                            <option value="Tidak (Tidak Perlu Co DPJP)">Tidak (Tidak Perlu Co DPJP)</option>
                                            <option value="Ya (Co DPJP)">Ya (Co DPJP)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : Pengkajian Fungsi --}}
                            <div class="separator m-2">5. Riwayat Psikologis, Sosial, Ekonomi, Budaya</div>
                            {{-- section : Riwayat Psikologis Sosio Budaya --}}
                            <div class="row">
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-5">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_kondisipsiko">a. Kemampuan Psikologis</label>
                                        <select class="form-select" name="riwayat_psiko_kondisipsiko" id="riwayat_psiko_kondisipsiko" style="border-radius:6px">
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
                                        <label for="riwayat_psiko_adakah_prilaku">b. Adakah Perilaku</label>
                                        <select class="form-select" name="riwayat_psiko_adakah_prilaku" id="riwayat_psiko_adakah_prilaku" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada Masalah">Tidak Ada Masalah</option>
                                            <option value="Perilaku Kekerasan">Perilaku Kekerasan</option>
                                            <option value="Gangguan Efek">Gangguan Efek</option>
                                            <option value="Gangguan Memori">Gangguan Memori</option>
                                            <option value="Halusinasi">Halusinasi</option>
                                            <option value="Kecenderungan Percobaan Bunuh Diri">Kecenderungan Percobaan Bunuh Diri</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_psiko_ket_adakah_prilaku" name="riwayat_psiko_ket_adakah_prilaku" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
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
                                        <label for="riwayat_psiko_hubungan_pasien">d. Hubungan dg. Keluarga</label>
                                        <select class="form-select" name="riwayat_psiko_hubungan_pasien" id="riwayat_psiko_hubungan_pasien" style="border-radius:6px">
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
                                        <input type="text" class="form-control form-control-sm" id="agama" name="agama" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-6">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_tinggal_dengan">f. Tinggal dg.</label>
                                        <select class="form-select" name="riwayat_psiko_tinggal_dengan" id="riwayat_psiko_tinggal_dengan" style="border-radius:6px 0 0 6px">
                                            <option value="Keluarga">Keluarga</option>
                                            <option value="Sendiri">Sendiri</option>
                                            <option value="Orang Tua">Orang Tua</option>
                                            <option value="Suami/Istri">Suami/Istri</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_psiko_ket_tinggal_dengan" name="riwayat_psiko_ket_tinggal_dengan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                                {{-- potong disini --}}
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="pekerjaan">g. Pekerjaan</label>
                                        <input type="text" class="form-control form-control-sm" id="pekerjaan" name="pekerjaan" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="penjab">h. Pembiayaan</label>
                                        <input type="text" class="form-control form-control-sm" id="penjab" name="penjab" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-9">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_budaya">i. Nilai Kepercayaan/Kebudayaan yang Perlu Diperhatikan</label>
                                        <select class="form-select" name="riwayat_psiko_budaya" id="riwayat_psiko_budaya" style="border-radius:6px 0 0 6px">
                                            <option value="Tidak Ada">Tidak Ada</option>
                                            <option value="Ada">Ada</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_psiko_ket_budaya" name="riwayat_psiko_ket_budaya" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="bahasa">j. Bahasa</label>
                                        <input type="text" class="form-control form-control-sm" id="bahasa" name="bahasa" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_pendidikan">k. Pendidikan Pasien</label>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_psiko_pendidikan" name="riwayat_psiko_pend_pj" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                    </div>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-12 col-lg-3">
                                    <div class="input-group">
                                        <label for="riwayat_psiko_pend_pj">l. Pendidikan PJ</label>
                                        <select class="form-select" name="riwayat_psiko_pend_pj" id="riwayat_psiko_pend_pj" style="border-radius:6px">
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
                                        <label for="riwayat_psiko_edukasi_pada">m. Edukasi diberikan kepada</label>
                                        <select class="form-select" name="riwayat_psiko_edukasi_pada" id="riwayat_psiko_edukasi_pada" style="border-radius:6px 0 0 6px">
                                            <option value="Keluarga">Keluarga</option>
                                            <option value="Pasien">Pasien</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="riwayat_psiko_ket_edukasi_pada" name="riwayat_psiko_ket_edukasi_pada" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="">
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : Pengkajian Fungsi --}}

                            {{-- section : Penilaian tingkat nyeri --}}
                            <div class="separator m-2">6. Penilaian Tingkat Nyeri</div>
                            <div class="row">
                                <div class="mt-2 col-sm-12 col-md-12 col-lg-5">
                                    <img src="{{ asset('/img/skala_nyeri_wong_baker.png') }}" alt="" class="mx-auto d-block" style="max-width:100%;height:auto">
                                    <div class="mt-2 col-lg-12">
                                        <label for="penilaian_nyeri_hilang">Nyeri Hilang Bila : </label>
                                        <div class="input-group">
                                            <select class="form-select" name="penilaian_nyeri_hilang" id="penilaian_nyeri_hilang" style="border-radius:6px 0 0 6px">
                                                <option value="Minum Obat">Minum Obat</option>
                                                <option value="Istirahat">Istirahat</option>
                                                <option value="Mendengarkan Musik">Mendengarkan Musik</option>
                                                <option value="Berubah Posisi/Tidur">Berubah Posisi/Tidur</option>
                                                <option value="Lain-lain">Lain-lain</option>
                                            </select>
                                            <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_ket_hilang" name="penilaian_nyeri_ket_hilang" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 col-sm-12 col-md-12 col-lg-7" style="padding-left: 0px">
                                    <div class="row">
                                        <div class="mb-1 col-lg-4" style="padding-right: 0px">
                                            <select class="form-select" name="penilaian_nyeri" id="penilaian_nyeri">
                                                <option value="Tidak Ada Nyeri">Tidak Ada Nyeri</option>
                                                <option value="Nyeri Akut">Nyeri Akut</option>
                                                <option value="Nyeri Kronis">Nyeri Kronis</option>
                                            </select>
                                        </div>
                                        <div class="mb-1 col-lg-8">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_penyebab">Penyebab</label>
                                                <select class="form-select br-left" name="penilaian_nyeri_penyebab" id="penilaian_nyeri_penyebab">
                                                    <option value="Proses Penyakit">Proses Penyakit</option>
                                                    <option value="Benturan">Benturan</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_ket_penyebab" name="penilaian_nyeri_ket_penyebab" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-12">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_kualitas">Kualitas</label>
                                                <select class="form-select br-left" name="penilaian_nyeri_kualitas" id="penilaian_nyeri_kualitas">
                                                    <option value="Seperti Tertusuk">Seperti Tertusuk</option>
                                                    <option value="Berdenyut">Berdenyut</option>
                                                    <option value="Teriris">Teriris</option>
                                                    <option value="Tertindih">Tertindih</option>
                                                    <option value="Tertiban">Tertiban</option>
                                                    <option value="Lain-lain">Lain-lain</option>
                                                </select>
                                                <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_ket_kualitas" name="penilaian_nyeri_ket_kualitas" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-7">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_lokasi">Lokasi : </label>
                                                <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_lokasi" name="penilaian_nyeri_lokasi" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-5">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_menyebar">Menybar : </label>
                                                <select class="form-select br-full" name="penilaian_nyeri_menyebar" id="penilaian_nyeri_menyebar">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-6">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_skala">Severity : Skala Nyeri </label>
                                                <select class="form-select br-full" name="penilaian_nyeri_skala" id="penilaian_nyeri_skala">
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <option value={{ $i }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-6">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_waktu">Waktu/Durasi : </label>
                                                <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_waktu" name="penilaian_nyeri_waktu" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                                <label for="penilaian_nyeri_waktu">menit</label>
                                            </div>
                                        </div>
                                        <div class="mb-1 col-lg-12">
                                            <div class="input-group">
                                                <label for="penilaian_nyeri_diberitahukan_dokter">Diberitahukan pada dokter ? </label>
                                                <select class="form-select" name="penilaian_nyeri_diberitahukan_dokter" id="penilaian_nyeri_diberitahukan_dokter" style="border-radius:6px">
                                                    <option value="Tidak">Tidak</option>
                                                    <option value="Ya">Ya</option>
                                                </select>
                                                <label for="penilaian_nyeri_jam_diberitahukan_dokter">Jam : </label>
                                                <input type="text" class="form-control form-control-sm" id="penilaian_nyeri_jam_diberitahukan_dokter" name="penilaian_nyeri_jam_diberitahukan_dokter" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off" style="border-radius:6px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : Penilaian tingkat nyeri --}}
                            {{-- section : Penilaian resiko jatuh --}}
                            <div class="separator m-2">7. Penilaian Resiko Jatuh</div>
                            <div class="row">
                                <div class="mb-1 col-lg-4">
                                    <label for="">1. Riwayat Jatuh</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala1">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala1" id="penilaian_jatuh_skala1">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="25">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai1">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai1" name="penilaian_jatuh_nilai1" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">2. Diagnosis Skunder (≥2 Diagnosis Skunder )</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala2">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala2" id="penilaian_jatuh_skala2">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="15">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai2">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai2" name="penilaian_jatuh_nilai2" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">3. Alat Bantu</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala3">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala3" id="penilaian_jatuh_skala3">
                                            <option value="Tidak Ada/Kursi Roda/Perawat/Tirah Baring" data-nilai="0">Tidak Ada/Kursi Roda/Perawat/Tirah Baring</option>
                                            <option value="Tongkat/Alat Penopang" data-nilai="15">Tongkat/Alat Penopang</option>
                                            <option value="Berpegangan Pada Perabot" data-nilai="30">Berpegangan Pada Perabot</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai3">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai3" name="penilaian_jatuh_nilai3" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">4. Terpasang Infuse</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala4">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala4" id="penilaian_jatuh_skala4">
                                            <option value="Tidak" data-nilai="0">Tidak</option>
                                            <option value="Ya" data-nilai="20">Ya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai4">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai4" name="penilaian_jatuh_nilai4" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">5. Gaya Berjalan</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala5">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala5" id="penilaian_jatuh_skala5">
                                            <option value="Normal/Tirah Baring/Imobilisasi" data-nilai="0">Normal/Tirah Baring/Imobilisasi</option>
                                            <option value="Lemah" data-nilai="10">Lemah</option>
                                            <option value="Terganggu" data-nilai="20">Terganggu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai5">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai5" name="penilaian_jatuh_nilai5" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-4">
                                    <label for="">6. Status Mental</label>
                                </div>
                                <div class="mb-1 col-lg-6">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_skala6">Skala : </label>
                                        <select class="form-select br-full" name="penilaian_jatuh_skala6" id="penilaian_jatuh_skala6">
                                            <option value="Sadar Akan Kemampuan Diri Sendiri" data-nilai="0">Sadar Akan Kemampuan Diri Sendiri</option>
                                            <option value="Sering Lupa Akan Keterbatasan Yang Dimiliki" data-nilai="15">Sering Lupa Akan Keterbatasan Yang Dimiliki</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_nilai6">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_nilai6" name="penilaian_jatuh_nilai6" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-10">
                                    <label for="">Tingkat Resiko : <span class="hasilResiko" style="color:green;font-weight:bold">Resiko Rendah (0-24)</span>, Tindakan : <span class="tindakanResiko">Intervensi pencegahan resiko jatuh standar </span></label>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="penilaian_jatuh_totalnilai">Total : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="penilaian_jatuh_totalnilai" name="penilaian_jatuh_totalnilai" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>

                            </div>
                            {{-- endsection : Penilaian resiko jatuh --}}
                            {{-- section : Skrining Gizi --}}
                            <div class="separator m-2">8. Skrining Gizi</div>
                            <div class="row">
                                <div class="mb-1 col-lg-5">
                                    <label for="skrining_gizi1">1. Apakah ada penurunan BB yang tidak diinginkan selama 6 bulan terakhit ?</label>
                                </div>
                                <div class="mb-1 col-lg-5">
                                    <select class="form-select br-full" name="skrining_gizi1" id="skrining_gizi1">
                                        <option value="Tidak ada penurunan berat badan" data-nilai="0">Tidak ada penurunan berat badan</option>
                                        <option value="Tidak yakin/ tidak tahu/ terasa baju lebih longgar" data-nilai="2">Tidak yakin/ tidak tahu/ terasa baju lebih longgar</option>
                                        <option value="Ya 1-5 kg" data-nilai="1">Ya 1-5 kg</option>
                                        <option value="Ya 6-10 kg" data-nilai="2">Ya 6-10 kg</option>
                                        <option value="Ya 11-15 kg" data-nilai="3">Ya 11-15 kg</option>
                                        <option value="Ya > 15 kg" data-nilai="4">Ya > 15 kg</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="nilai_gizi1">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="nilai_gizi1" name="nilai_gizi1" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-5">
                                    <label for="skrining_gizi2">2. Apakah asupan makan berkurang karena tidak nafsu makan ?</label>
                                </div>
                                <div class="mb-1 col-lg-5">
                                    <select class="form-select br-full" name="skrining_gizi2" id="skrining_gizi2">
                                        <option value="Tidak" data-nilai="0">Tidak</option>
                                        <option value="Ya" data-nilai="1">Ya</option>
                                    </select>
                                </div>
                                <div class="mb-1 col-lg-2">
                                    <div class="input-group">
                                        <label for="nilai_gizi2">Nilai : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="nilai_gizi2" name="nilai_gizi2" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-2 offset-lg-10">
                                    <div class="input-group">
                                        <label for="nilai_total_gizi">Total : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="nilai_total_gizi" name="nilai_total_gizi" value="0" autocomplete="off" readonly>
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-8">
                                    <div class="input-group">
                                        <label for="skrining_gizi_diagnosa_khusus">Pasien dengan diagnosis khusus : </label>
                                        <select class="form-select br-left" name="skrining_gizi_diagnosa_khusus" id="skrining_gizi_diagnosa_khusus" style="max-width:22%">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" id="skrining_gizi_ket_diagnosa_khusus" name="skrining_gizi_ket_diagnosa_khusus" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                                <div class="mb-1 col-lg-8">
                                    <div class="input-group">
                                        <label for="skrining_gizi_diagnosa_khusus">Sudah dibaca dan diketahui oleh dietisen : </label>
                                        <select class="form-select br-full" name="skrining_gizi_diagnosa_khusus" id="skrining_gizi_diagnosa_khusus" style="max-width:22%">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                        <label for="skrining_gizi_diagnosa_khusus">Jam : </label>
                                        <input type="text" class="form-control form-control-sm br-full" id="skrining_gizi_ket_diagnosa_khusus" name="skrining_gizi_ket_diagnosa_khusus" onfocus="removeZero(this)" onblur="cekKosong(this)" value="-" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            {{-- endsection : Skrining Gizi --}}
                            <div class="separator m-2"></div>
                            <div class="row">
                                {{-- section : Penilaian Kebidanan & Rencana Kebidanan --}}
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="masalah">Asesmen/Penilaian Kebidanan</label>
                                    <textarea class="form-control" name="masalah" id="masalah" cols="30" rows="10" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                <div class="mb-1 col-sm-12 col-md-6 col-lg-6">
                                    <label for="rencana">Rencana Kebidanan</label>
                                    <textarea class="form-control" name="rencana" id="rencana" cols="30" rows="10" onfocus="removeZero(this)" onblur="cekKosong(this)">-</textarea>
                                </div>
                                {{-- endsection : Penilaian Kebidanan & Rencana Kebidanan --}}
                            </div>

                        </div>
                        {{-- endsection : form kiri --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" style="font-size: 12px"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="simpanAskepKandunganRanap()" style="font-size: 12px"><i class="bi bi-save"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var kodeMasalah = []
        var kodeRencanaNeo = []

        $('#modalAskepRanapKandungan').on('hidden.bs.modal', () => {
            document.getElementById("formAskepRanapKandungan").reset();
        })
        $('#modalAskepRanapKandungan').on('shown.bs.modal', () => {
            $('#formAskepRanapKandungan input[name=tanggal]').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })
            $('#formAskepRanapKandungan input[name=riwayat_hamil_hpht]').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })
            $('#formAskepRanapKandungan input[name=riwayat_hamil_tp]').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })
            $('#formRiwayatPersalinan input[name=tgl_thn]').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            })

        })

        function getAskepRanapKandungan(no_rawat) {
            const askep = $.ajax({
                url: '/erm/ranap/askep/kandungan',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
            })

            return askep;
        }


        function askepRanapKandungan(no_rawat) {

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
                setRiwayatPersalinan(regPeriksa.no_rkm_medis)
                $('#btnRiwayatPersalinan').attr('onclick', `modalRiwayatPersalinan('${regPeriksa.no_rkm_medis}')`)
                $('#formRiwayatPersalinan input[name=no_rkm_medis]').val(regPeriksa.no_rkm_medis)
                $('#formRiwayatPersalinan input[name=nm_pasien]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.umurdaftar} ${regPeriksa.sttsumur})`)
                $('#formRiwayatPersalinan input[name=gd]').val(`${regPeriksa.pasien.gol_darah})`)

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
                    $(`#formAskepRanapKandungan input[name=riwayat_hamil_tp]`).val(splitTanggal(response.riwayat_hamil_tp))
                    $(`#formAskepRanapKandungan input[name=riwayat_hamil_hpht]`).val(splitTanggal(response.riwayat_hamil_hpht))
                } else {
                    $('#formAskepRanapKandungan input[name=nip1]').val("{{ session()->get('pegawai')->nik }}")
                    $('#formAskepRanapKandungan input[name=pengkaji1]').val("{{ session()->get('pegawai')->nama }}")
                }
                hitungSkalaNyeriKandungan()
            })

            $('#modalAskepRanapKandungan').modal('show')

        }

        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala1]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala1]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai1]').val(data)
            hitungSkalaNyeriKandungan()
        })
        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala2]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala2]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai2]').val(data)
            hitungSkalaNyeriKandungan()
        })

        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala3]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala3]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai3]').val(data)
            hitungSkalaNyeriKandungan()
        })
        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala4]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala4]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai4]').val(data)
            hitungSkalaNyeriKandungan()
        })
        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala5]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala5]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai5]').val(data)
            hitungSkalaNyeriKandungan()
        })
        $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala6]').change((e) => {
            const data = $('#formAskepRanapKandungan select[name=penilaian_jatuh_skala6]').find(':selected').data('nilai')
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai6]').val(data)
            hitungSkalaNyeriKandungan()
        })


        function getRiwayatPersalinan(no_rkm_medis) {
            const persalinan = $.ajax({
                url: '/erm/riwayat/persalinan/get/' + no_rkm_medis,
                method: 'get',
            })

            return persalinan;
        }

        function setRiwayatPersalinan(no_rkm_medis) {
            $('#tbRiwayatPersalinan tbody').empty()
            getRiwayatPersalinan(no_rkm_medis).done((response) => {
                let no = 1;
                $.map(response, (persalinan) => {
                    html = `
                        <tr>
                            <td>${no}</td>
                            <td>${persalinan.tgl_thn ? formatTanggal(persalinan.tgl_thn) : '-'}</td>
                            <td>${persalinan.tempat_persalinan}</td>
                            <td>${persalinan.usia_hamil}</td>
                            <td>${persalinan.jenis_persalinan}</td>
                            <td>${persalinan.penolong}</td>
                            <td>${persalinan.penyulit}</td>
                            <td>${persalinan.jk}</td>
                            <td>${persalinan.bbpb}</td>
                            <td>${persalinan.keadaan}</td>
                            <td> <a href="javascript:void(0)" onclick="deleteRiwayatPersalinan('${no_rkm_medis}', '${persalinan.tgl_thn}')"><i class="text-danger bi bi-trash3"></i></a></td>
                        </tr>
                    `;
                    no++;
                    $('#tbRiwayatPersalinan tbody').append(html)
                })
            })
        }

        function modalRiwayatPersalinan(no_rkm_medis) {
            $('#modalRiwayatPersalinan').modal('show')
        }

        function hitungSkalaNyeriKandungan() {
            data1 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai1]').val();
            data2 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai2]').val();
            data3 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai3]').val();
            data4 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai4]').val();
            data5 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai5]').val();
            data6 = $('#formAskepRanapKandungan input[name=penilaian_jatuh_nilai6]').val();

            skalaNyeri = parseInt(data1) + parseInt(data2) + parseInt(data3) + parseInt(data4) + parseInt(data5) + parseInt(data6);

            if (skalaNyeri >= 0 && skalaNyeri <= 24) {
                hasilResiko = 'Resiko Rendah (0-24)'
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar'
                textColor = 'green';
            } else if (skalaNyeri >= 25 && skalaNyeri <= 44) {
                hasilResiko = 'Resiko Sedang (25-44)'
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar'
                textColor = '#ff8b00';
            } else if (skalaNyeri >= 45) {
                hasilResiko = 'Resiko Tinggi (>45)'
                tindakanResiko = 'Intervensi pencegahan resiko jatuh standar & Intervensi resiko jatuh tinggi'
                textColor = 'red';
            }
            $('#formAskepRanapKandungan .hasilResiko').html(hasilResiko)
            $('#formAskepRanapKandungan .hasilResiko').css('color', textColor)
            $('#formAskepRanapKandungan .tindakanResiko').html(tindakanResiko)
            $('#formAskepRanapKandungan input[name=penilaian_jatuh_totalnilai]').val(skalaNyeri)
        }

        var nilaiGizi = 0;
        $(`#formAskepRanapKandungan select[name=skrining_gizi1]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi1]`).find(':selected').data('nilai')
            $(`#formAskepRanapKandungan input[name=nilai_gizi1]`).val(data)
            hitungSkriningGiziKandungan();
        })
        $(`#formAskepRanapKandungan select[name=skrining_gizi2]`).change(() => {
            data = $(`#formAskepRanapKandungan select[name=skrining_gizi2]`).find(':selected').data('nilai')
            $(`#formAskepRanapKandungan input[name=nilai_gizi2]`).val(data)
            hitungSkriningGiziKandungan();
        })


        function hitungSkriningGiziKandungan() {
            nilaiGizi1 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi1]`).val())
            nilaiGizi2 = parseInt($(`#formAskepRanapKandungan input[name=nilai_gizi2]`).val())
            nilaiGizi = nilaiGizi1 + nilaiGizi2
            $('#formAskepRanapKandungan input[name=nilai_total_gizi]').val(nilaiGizi)
        }

        function simpanAskepKandunganRanap() {
            let except = ['no_rkm_medis', 'dokter', 'pengkaji1', 'pengkaji2', 'pasien', 'tgl_lahir', 'bahasa', 'agama', 'penjab', 'pekerjaan', 'gd', ''];
            data = getDataForm('#formAskepRanapKandungan', ['input', 'select', 'textarea'], except)
            data['tanggal'] = `${splitTanggal(data.tanggal)} ${data.jam}`
            delete data.jam

            $.ajax({
                url: '/erm/ranap/askep/kandungan/create',
                data: data,
                method: 'post',
                success: (response) => {
                    swal.fire({
                        title: 'Berhasil',
                        text: 'Berhasil menyimpan data asesmen',
                        showConfirmButton: false,
                        icon: 'success',
                        timer: 1500,
                    }).then(() => {
                        $('#tb_ranap').DataTable().destroy()
                        tb_ranap();
                    });
                },
                error: function(request, status, error) {
                    alertErrorAjax(request)
                }
            })
        }
    </script>
@endpush
