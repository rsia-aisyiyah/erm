<div class="modal fade" id="modalAskepAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            @if (Request::segment(2) != 'P003' || Request::segment(2) != 'P008')
                <div class="modal-header">
                    <h5 class="modal-title fs-6">ASESMEN PASIEN RAWAT
                        JALAN ANAK/BAYI</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="tb-askep table table-striped" width="100%">
                                <tr>
                                    <th colspan="2">IDENTITAS</th>
                                </tr>
                                <tr>
                                    <td>No. RM</td>
                                    <td class="no_rkm_medis"></td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td class="nm_pasien"></td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir / Umur</td>
                                    <td class="tgl_lahir"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td class="jk"></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Periksa</td>
                                    <td class="tgl_registrasi"></td>
                                </tr>
                                <tr>
                                    <td>Informasi dari</td>
                                    <td class="anamnesis"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <select class="form-select form-select-sm" id="opt-rawat" class=""
                                style="border-radius:0px;">

                            </select>

                            <table class="tb-askep table table-striped mt-3" width="100%">
                                <tr>
                                    <th colspan="4">I. KEADAAN UMUM</th>
                                </tr>
                                <tr>
                                    <td>TD</td>
                                    <td class="tensi"></td>
                                    <td>Nadi</td>
                                    <td class="nadi"></td>
                                </tr>
                                <tr>
                                    <td>RR</td>
                                    <td class="respirasi"></td>
                                    <td>Suhu</td>
                                    <td class="suhu"></td>
                                </tr>
                                <tr>
                                    <td>GCS(E,V,M)</td>
                                    <td class="gcs"></td>
                                    <td>BB</td>
                                    <td class="bb"></td>
                                </tr>
                                <tr>
                                    <td>TB</td>
                                    <td class="tb"></td>
                                    <td>LP</td>
                                    <td class="lp"></td>
                                </tr>
                                <tr>
                                    <td>LD</td>
                                    <td class="ld"></td>
                                    <td>LK</td>
                                    <td class="lk"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="tb-askep table table-striped" width="100%">
                                <tr>
                                    <th colspan="6">II. RIWAYAT PENYAKIT</th>
                                </tr>
                                <tr>
                                    <td width="50%">Keluhan Utama</td>
                                    <td class="keluhan_utama"></td>
                                </tr>
                                <tr>
                                    <td>Riwaat Penyakit Dahulu</td>
                                    <td class="rpd"></td>
                                </tr>
                                <tr>
                                    <td>Riwaat Penyakit keluarga</td>
                                    <td class="rpk"></td>
                                </tr>
                                <tr>
                                    <td>Riwaat Alergi</td>
                                    <td class="alergi"></td>
                                </tr>
                                <tr>
                                    <td>Riwayat Pengobatan</td>
                                    <td class="rpo"></td>
                                </tr>

                            </table>
                            <table class="tb-askep table table-striped" width="100%">
                                <tr>
                                    <th colspan="6">III. RIWAYAT TUMBUH KEMBANG & PERINATAL</th>
                                </tr>
                                <tr>
                                    <td>Anak ke </td>
                                    <td class="anakke"></td>
                                    <td>Kelainan Bawaan </td>
                                    <td class="kelainanbawaan"></td>
                                </tr>
                                <tr>
                                    <td>Cara Lahir</td>
                                    <td class="caralahir"></td>
                                    <td>Umur Kehamilan</td>
                                    <td class="umurkelahiran"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12">
                            <table class="tb-askep-imunisasi table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">IV. RIWAYAT IMUNISASI
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nama Imunisasi
                                        </th>
                                        <th>
                                            Ke-1
                                        </th>
                                        <th>
                                            Ke-2
                                        </th>
                                        <th>
                                            Ke-3
                                        </th>
                                        <th>
                                            Ke-4
                                        </th>
                                        <th>
                                            Ke-5
                                        </th>
                                        <th>
                                            Ke-6
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>


                            </table>
                            <table class="tb-askep table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">V. RIWAYAT TUMBUH KEMBANG
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Usia Tengkurap</td>
                                        <td class="usiatengkurap"></td>
                                        <td>Usia Berdiri</td>
                                        <td class="usiaberdiri"></td>
                                    </tr>
                                    <tr>
                                        <td>Usia Duduk</td>
                                        <td class="usiaduduk"></td>
                                        <td>Usia Gigi Pertama</td>
                                        <td class="usiagigipertama"></td>
                                    </tr>
                                    <tr>
                                        <td>Usia Jalan</td>
                                        <td class="usiaberjalan"></td>
                                        <td>Usia Membaca</td>
                                        <td class="usiamembaca"></td>
                                    </tr>
                                    <tr>
                                        <td>Usia Menulis</td>
                                        <td class="usiamenulis"></td>
                                        <td>Gangguan Perkembangan/Emosi</td>
                                        <td class="wajah"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="tb-askep table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">VI. FUNGSIONAL
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Alat Bantu</td>
                                        <td class="alat_bantu"></td>
                                        <td>Prothesa</td>
                                        <td class="prothesa"></td>
                                        <td>Aktivitas Sehari-hari</td>
                                        <td class="aktifitas"></td>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="tb-askep table table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="7">VI. RIWAYAT PSIKO SOSIAL, SPIRITUAL & BUDAYA
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status Psikologis</td>
                                        <td class="status_psiko"></td>
                                        <td>Edukasi</td>
                                        <td class="edukasi"></td>
                                        <td>Pengasuh</td>
                                        <td class="pengasuh"></td>
                                    </tr>
                                    <tr>
                                        <td>Hubungan Keluarga</td>
                                        <td class="hub_keluarga"></td>
                                        <td>Status Ekonomi</td>
                                        <td class="ekonomi"></td>
                                        <td>Budaya</td>
                                        <td class="budaya"></td>
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="bi bi-x-circle"></i>
                        Keluar</button>
                </div>
            @endif
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalAskepAnak').on('shown.bs.modal', function() {
            isModalShow = true;
        })
        $('#modalAskepAnak').on('hidden.bs.modal', function() {
            isModalShow = false;
            var nomorImun = '';
            $('.r_persalinan').empty();
            $('.tb-askep-imunisasi tbody').empty()
            $('.imunisasi').remove()
            $('select .opt-asesmen-anak').remove()
        })
    </script>
@endpush
