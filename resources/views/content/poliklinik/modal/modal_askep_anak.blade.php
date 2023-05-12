<div class="modal fade" id="modalAskepAnak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="border-radius:0px">
            @if (Request::segment(2) != 'P003' || Request::segment(2) != 'P008')
                <div class="modal-header">
                    <h5 class="modal-title fs-6">ASESMEN PASIEN RAWAT
                        JALAN ANAK/BAYI</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="tb-askep table table-striped mt-3" width="100%">
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
                                style="border-radius:0px;"></select>

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
                            <table class="tb-askep table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th colspan="6">III. RIWAYAT IMUNISASI
                                        </th>
                                    </tr>
                                </thead>


                            </table>
                            <table class="tb-askep table table-striped table-bordered" width="100%">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Tempat & Penolong</th>
                                    <th>Usia Hamil</th>
                                    <th>Persalinan & Penyulit</th>
                                    <th>Anak</th>
                                </tr>
                                <tbody class="r_persalinan">

                                </tbody>
                            </table>
                            <table class="tb-askep table table-striped table-bordered" width="100%">
                                <tr>
                                    <td class="r_hamil">
                                        Riwayat Ginekologi
                                    </td>
                                    <td colspan="5">
                                        : <span class="ginekologi"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Riwayat Kebiasaan
                                    </td>
                                    <td colspan="5">
                                        : <span class="kebiasaan"></span>, Merokok : <span class="kebiasaan1"></span>,
                                        Alkohol : <span class="kebiasaan2"></span>,Obat Tidur/Narkoba : <span
                                            class="kebiasaan3"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Riwayat KB
                                    </td>
                                    <td colspan="5">
                                        : <span class="kb"></span>,
                                        Lamanya : <span class="ket_kb"></span>.
                                        Komplikasi : <span class="komplikasi"></span>.
                                        Berhenti : <span class="berhenti"></span>.
                                        Alasan : <span class="alasan"></span>.
                                    </td>
                                </tr>
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
        $('#modalAskep').on('shown.bs.modal', function() {
            isModalShow = true;
        })
        $('#modalAskep').on('hidden.bs.modal', function() {
            isModalShow = false;
            $('.r_persalinan').empty();
        })
    </script>
@endpush
