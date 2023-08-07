<div class="modal fade" id="modalAskep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content" style="border-radius:0px">
            @if (Request::segment(2) != 'P003' || Request::segment(2) != 'P008')
                <div class="modal-header">
                    <h5 class="modal-title fs-6">ASESMEN PASIEN RAWAT JALAN KEBIDANAN & KANDUNGAN</h5>
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
                            <select name="select-askep-bidan" id="select-askep-bidan" style="font-size:12px;border-radius:0px;" class="form-select mb-3"></select>
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
                        <div class="col-sm-12">
                            <table class="tb-askep table table-striped table-bordered" width="100%">
                                <tr>
                                    <th colspan="6">III. RIWAYAT KESEHATAN
                                    </th>

                                </tr>
                                <tr>
                                    <td colspan="6">
                                        Keluhan Utama <span class="keluhan"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="r_mens">
                                        Riwayat Menstruasi
                                    </td>
                                    <td>
                                        Menarche <span class="umur"></span>, Lamanya <span class="lama"></span>,
                                        Banyaknya <span class="banyak"></span>, Haid Terakhir <span
                                            class="haid"></span><br />
                                        Siklus <span class="siklus"></span> ( <span class="ket_siklus1"></span> ), <span
                                            class="ket_silkus2"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="r_kawin">
                                        Riwayat Perkawinan
                                    </td>
                                    <td colspan="5">
                                        Status Menikah <span class="status"></span>, <span class="kali"></span> Kali
                                        <ol>
                                            <li>Usia Perkawinan <span class="usia1"></span> Tahun, <span
                                                    class="ket1"></span>
                                            </li>
                                            <li>Usia Perkawinan <span class="usia2"></span> Tahun, <span
                                                    class="ket2"></span>
                                            </li>
                                            <li>Usia Perkawinan <span class="usia2"></span> Tahun, <span
                                                    class="ket2"></span>
                                            </li>
                                        </ol>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="r_hamil">
                                        Riwayat Kehamilan Tetap
                                    </td>
                                    <td colspan="5">
                                        HPHT <span class="hpht"></span>, Usia Kehamilan <span
                                            class="usia_kehamilan"></span>, TP <span class="tp"></span>, Riwayat
                                        Imunisasi <span class="imunisasi"></span>, <span class="ket_imunisasi"></span>
                                        Kali<br />
                                        <span class="gpa"></span>,
                                        Hidup : <span class="hidup"></span>
                                    </td>
                                </tr>
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
            $('#select-askep-bidan').empty();
            $('.r_persalinan').empty()
        });

        $('#select-askep-bidan').on('change', function() {
            noRawat = $(this).val();
            $.ajax({
                url: '/erm/poliklinik/askep/kebidanan/' + noRawat,
                dataType: 'JSON',
                method: 'GET',
                success: (data) => {
                    $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                    $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' : ': Perempuan')
                    $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa.tgl_registrasi));
                    $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                    $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien.tgl_lahir) +
                        ' / ' +
                        data
                        .reg_periksa.umurdaftar + ' ' + data.reg_periksa.sttsumur);
                    $('.anamnesis').html(': ' + data.informasi);
                    $('.tensi').html(': ' + data.td + ' mmHG');
                    $('.nadi').html(': ' + data.nadi + ' x/menit');
                    $('.respirasi').html(': ' + data.rr + ' x/menit');
                    $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                    $('.gcs').html(': ' + data.gcs);
                    $('.bb').html(': ' + data.bb + ' Kg');
                    $('.tb').html(': ' + data.bb + ' Cm');
                    $('.lila').html(': ' + data.lila + ' Cm');
                    $('.bmi').html(': ' + data.bmi + ' Kg/m<sup>2</sup>');
                    $('.tfu').html(': ' + data.tfu + ' Cm');
                    $('.tbj').html(': ' + data.tbj + ' Cm');
                    $('.letak').html(': ' + data.letak);
                    $('.presentasi').html(': ' + data.presentasi);
                    $('.penurunan').html(': ' + data.penurunan);
                    $('.kontraksi').html(': ' + data.his + ' x/10');
                    $('.kekuatan').html(': ' + data.kekuatan);
                    $('.lama').html(': ' + data.lama + ' detik');
                    $('.djj').html(': ' + data.bjj + ' /mnt ' + data.ket_bjj);
                    $('.portio').html(': ' + data.portio);
                    $('.serviks').html(': ' + data.serviks + ' Cm');
                    $('.ketuban').html(': ' + data.ketuban + ' kep/bok');
                    $('.hodge').html(': ' + data.hodge);
                    $('.inspekulo').html(': ' + data.inspekulo + ' ,<br/>Hasil : ' + data
                        .ket_inspekulo);
                    $('.ctg').html(': ' + data.ctg + ' ,<br/>Hasil : ' + data.ket_ctg);
                    $('.lakmus').html(': ' + data.lakmus + ' ,<br/>Hasil : ' + data.ket_lakmus);
                    $('.lab').html(': ' + data.lab + ' ,<br/>Hasil : ' + data.ket_lab);
                    $('.usg').html(': ' + data.usg + ' ,<br/>Hasil : ' + data.ket_usg);
                    $('.panggul').html(': ' + data.panggul);
                    $('.keluhan').text(': ' + data.keluhan_utama);
                    $('.umur').text(': ' + data.umur + ' Th');
                    $('.lama').text(': ' + data.lama + ' Hari');
                    $('.banyak').text(': ' + data.banyaknya + ' Pembalut');
                    $('.haid').text(': ' + data.haid);
                    $('.siklus').text(': ' + data.siklus + ' hari');
                    $('.ket_siklus1').text(data.ket_siklus1);
                    $('.ket_siklus2').text(': ' + data.ket_siklus2);
                    $('.status').text(': ' + data.status);
                    $('.kali').text(data.kali);
                    $('.usia1').text(data.usia1);
                    $('.ket1').text(data.ket1);
                    $('.usia2').text(data.usia2);
                    $('.ket2').text(data.ket2);
                    $('.usia3').text(data.usia3);
                    $('.ket3').text(data.ket3);
                    $('.hpht').text(': ' + formatTanggal(data.hpht));
                    $('.usia_kehamilan').text(': ' + data.usia_kehamilan + ' bln/mgg');
                    $('.tp').text(': ' + formatTanggal(data.tp));
                    $('.imunisasi').text(': ' + data.imunisasi);
                    $('.ket_imunisasi').text(data.ket_imunisasi ? data.ket_imunisasi : '-');
                    $('.gpa').text('G : ' + data.g + ', P :' + data.p + ', A : ' + data.a);
                    $('.hidup').text(data.hidup);
                    $('.ginekologi').text(data.ginekologi);
                    $('.kebiasaan').text(data.kebiasaan + ', ' + data.ket_kebiasaan);
                    $('.kebiasaan1').text(data.kebiasaan1 + ', ' + data.ket_kebiasaan1 +
                        ' Batang /hari');
                    $('.kebiasaan2').text(data.kebiasaan2 + ', ' + data.ket_kebiasaan2 +
                        ' Botol /hari');
                    $('.kebiasaan3').text(data.kebiasaan3);
                    $('.kb').text(data.kb + ' , ', +data.ket_kb);
                    $('.kb').text(data.kb);
                    $('.ket_kb').text(data.ket_kb);
                    $('.komplikasi').text(data.komplikasi + ', ' + data.ket_komplikasi);
                    $('.berhenti').text(data.berhenti);
                    $('.alasan').text(data.alasan);
                    no = 1;
                    data.reg_periksa.pasien.riwayat_persalinan.forEach(function(riwayat) {

                        html = '<tr>';
                        html += '<td>' + no + '</td>'
                        html += '<td>' + formatTanggal(riwayat.tgl_thn) + '</td>'
                        html += '<td>' + riwayat.tempat_persalinan + '</br>' + riwayat
                            .penolong +
                            '</td>'
                        html += '<td>' + riwayat.usia_hamil + '</td>'
                        html += '<td> Persalinan : ' + riwayat.jenis_persalinan +
                            '<br/> Penyulit : ' +
                            riwayat
                            .penyulit +
                            '</td>'
                        html += '<td> JK : ' + riwayat.jk + '<br/> BB/PB : ' + riwayat.bbpb +
                            '<br/> Keadaaan : ' + riwayat.keadaan + '</td>'
                        html += '</tr>';
                        no++;
                        $('.r_persalinan').append(html)
                    })
                }
            })
        })
    </script>
@endpush
