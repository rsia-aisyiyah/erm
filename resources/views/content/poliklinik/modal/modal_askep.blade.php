<div class="modal fade" id="modalAsmed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <h6 class="text-center">ASESMEN PENILAIAN PASIEN RAWAT
                    JALAN KEBIDANAN &
                    KANDUNGAN</h6>
                <hr />
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
                        <table class="tb-askep table table-striped" width="100%">
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
                                <td>LILA</td>
                                <td class="lila"></td>
                            </tr>
                            <tr>
                                <td>BMI</td>
                                <td class="bmi" colspan="3"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12">
                        <table class="tb-askep table table-striped" width="100%">
                            <tr>
                                <th colspan="6">II. PEMERIKSAAN KEBIDANAN</th>
                            </tr>
                            <tr>
                                <td>TFU</td>
                                <td class="tfu"></td>
                                <td>TBJ</td>
                                <td class="tbj"></td>
                                <td>Letak</td>
                                <td class="letak"></td>
                            </tr>
                            <tr>
                                <td>Presentasi</td>
                                <td class="presentasi"></td>
                                <td width="15px">Penurunan</td>
                                <td class="penurunan"></td>
                                <td>Kontraksi/HIS</td>
                                <td class="kontraksi"></td>
                            </tr>
                            <tr>
                                <td>Kekuatan</td>
                                <td class="kekuatan"></td>
                                <td>Lamanya</td>
                                <td class="lama"></td>
                                <td width="15px" colspan="">Hodge</td>
                                <td class="hodge" colspan=""></td>
                            </tr>
                            <tr>
                                <td width="20px">Portio</td>
                                <td class="portio"></td>
                                <td width="40px">Pembukaan Serviks</td>
                                <td class="serviks"></td>
                                <td width="15px">Ketuban</td>
                                <td class="ketuban"></td>
                            </tr>
                            <tr>
                                <td colspan="3">Gerak janin x/30 menit, DJJ</td>
                                <td class="djj" colspan="3"></td>
                            </tr>

                        </table>
                        <table class="tb-askep table table-striped" width="100%">
                            <tr>
                                <th colspan="6">PEMERIKSAAN PENUNJANG</th>
                            </tr>
                            <tr>
                                <td>Inspekulo</td>
                                <td class="inspekulo"></td>
                                <td>CTG</td>
                                <td class="ctg"></td>
                                <td>Lakmus</td>
                                <td class="lakmus"></td>
                            </tr>
                            <tr>
                                <td>Laboratorium</td>
                                <td class="lab"></td>
                                <td>USG</td>
                                <td class="ctg"></td>
                                <td>Panggul</td>
                                <td class="panggul"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 col-lg-3 col-sm-12">

                    </div>
                </div>
            </div>
            {{-- <p class="tb-askep"><strong>I. KEADANAN UMUM</strong></p> --}}
            {{-- <table class="tb-askep">
                    <tr>
                        <td>TD</td>
                        <td class="tensi"></td>
                        <td>Nadi</td>
                        <td class="nadi"></td>
                        <td>RR</td>
                        <td class="respirasi"></td>
                        <td>Suhu</td>
                        <td class="suhu"></td>
                        <td>GCS(E,V,M)</td>
                        <td class="gcs"></td>
                    </tr>
                    <tr>
                        <td>BB</td>
                        <td class="bb"></td>
                        <td>TB</td>
                        <td class="tb"></td>
                        <td>LILA</td>
                        <td class="lila"></td>
                        <td>BMI</td>
                        <td class="bmi" colspan="4"></td>
                    </tr>

                </table> --}}
            {{-- <p class="tb-askep"><strong>II. PEMERIKSAAN KEBIDANAN</strong></p>
            <table class="tb-askep">
                <tr>
                    <td>TFU</td>
                    <td class="tfu"></td>
                    <td>TBJ</td>
                    <td class="tbj"></td>
                    <td>Letak</td>
                    <td class="letak"></td>
                    <td>Presentasi</td>
                    <td class="presentasi"></td>
                    <td width="15px">Penurunan</td>
                    <td class="penurunan"></td>
                </tr>
                <tr>
                    <td>Kontraksi/HIS</td>
                    <td class="kontraksi"></td>
                    <td>Kekuatan</td>
                    <td class="kekuatan"></td>
                    <td>Lamanya</td>
                    <td class="lama"></td>
                    <td colspan="2">Gerak janin x/30 menit, DJJ</td>
                    <td class="djj" colspan="2"></td>
                </tr>
                <tr>
                    <td width="20px">Portio</td>
                    <td class="portio"></td>
                    <td width="40px">Pembukaan Serviks</td>
                    <td class="serviks"></td>
                    <td width="15px">Ketuban</td>
                    <td class="ketuban"></td>
                    <td width="15px" colspan="2">Hodge</td>
                    <td class="hodge" colspan="2"></td>
                </tr>
            </table>
            <p class="tb-askep">PEMERIKSAAN PENUNJANG</p>
            <table class="tb-askep">
                <tr>
                    <td width="20px">Inspekulo</td>
                    <td class="inspekulo"></td>
                    <td width="20px">CTG</td>
                    <td class="ctg"></td>
                    <td width="20px">Lakmus</td>
                    <td class="lakmus"></td>
                </tr>
                <tr>
                    <td>Laboratorium</td>
                    <td class="lab"></td>
                    <td>USG</td>
                    <td class="ctg"></td>
                    <td>Panggul</td>
                    <td class="panggul"></td>
                </tr>
            </table>
            <p class="tb-askep"><strong>III. RIWAYAT KESEHATAN</strong></p> --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i>
                    Keluar</button>

            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        $('#modalAskep').on('shown.bs.modal', function() {

        })
    </script>
@endpush
