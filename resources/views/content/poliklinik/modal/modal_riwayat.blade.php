<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-labelledby="modalRiwayat" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RIWAYAT PASIEN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-riwayat">
                <table id="tb_riwayat" class="table table-bordered table-responsive" cellpadding="5" cellspacing="0"
                    style="padding-left:50px;"></table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" style="font-size:12px" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-image" aria-hidden="true" aria-labelledby="modal-image" tabindex="-1" style="background-color:#0006;box-shadow: inset 0px -1rem 20rem 20px #000;">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" class="img-thumbnails popup" width="100%" />
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" data-bs-dismiss="modal" style="font-size:12px"><i class="bi bi-x-circle"></i> Tutup Gambar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        var no_rm = '';
        $('#modalRiwayat').on('hidden.bs.modal', function() {
            $('#tb_riwayat').empty();
            detail = '';
            isModalShow = false;
        });

        function modalRiwayat(no_rm) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    'no_rkm_medis': no_rm,
                    'sortir': 'DESC',
                },
                dataType: 'JSON',
                method: 'GET',
                success: function(response) {
                    if (response.reg_periksa.length == 0) {
                        Swal.fire('Kosong!', 'Belum ada riwayat perawatan', 'error');
                    } else {
                        $('#modalRiwayat').modal('show')
                        riwayatPasien(response);
                    }
                }
            });
        }

        var detail = '';
        var pemeriksaan = '';
        var diagnosa = '';

        function fotoPemeriksaan(foto) {
            var hasilFoto = '<table>';
            if (Object.keys(foto).length > 0) {
                foto.forEach(function(f) {
                    let arrFoto = f?.file.split(',')
                    let kategori = f?.kategori;
                    hasilFoto += '<tr>'
                    arrFoto.forEach(function(fx) {
                        hasilFoto += `<td>
                            <div class="image-set m-t-20">
                                <a data-magnify="gallery" data-src="" data-caption="${kategori?.toUpperCase()} ${formatTanggal(f.tgl_masuk)}" data-group="a" href="https://sim.rsiaaisyiyah.com/erm/public/erm/${fx}">
                                    <img src="https://sim.rsiaaisyiyah.com/erm/public/erm/${fx}" class="img-thumbnail position-relative" width="300px"><figcaption align="center">
                                </a>
                                <figcaption>${kategori?.toUpperCase()}</figcaption>
                            </div>
                        </td>`
                    })
                    hasilFoto += '</tr>'
                })
                hasilFoto += '</table>';
                return '<tr><th>Berkas Penunjang : </th><td>' + hasilFoto + '</td></tr>';
            }
            return '';
        }

        function popup(foto) {
            $('#modal-image').modal('show');
            let src = "https://sim.rsiaaisyiyah.com/erm/public/erm/" + foto;
            $('.popup').attr('src', src)
        }


        function riwayatPasien(d) {
            d.reg_periksa.forEach(function(i) {
                if (i.status_lanjut == 'Ranap') {
                    status_lanjut = 'RAWAT INAP';
                    ralan = 'UGD';
                    class_status = 'background:rgb(152, 0, 175);color:white';
                } else {
                    status_lanjut = 'RAWAT JALAN';
                    ralan = 'Poliklinik';
                    class_status = 'background:rgb(255 193 7);color:black';
                }

                if (i.catatan_perawatan == null) {
                    catatan = '<strong>Tidak ada catatan</strong>';
                } else {
                    catatan = i.catatan_perawatan.catatan.replace(/\n/g, '<br/>');
                }
                hasilOperasi(i.operasi, i.no_rawat)
                detail +=
                    '<tr>' +
                    '<th colspan="2" style="' + class_status + '"><h6 align="center">' + status_lanjut +
                    '</h6></th>' +
                    '</tr>' +
                    '<tr><th style="width:15%">Tanggal Daftar</th><td>: ' + formatTanggal(i.tgl_registrasi) + ' ' + i.jam_reg +
                    '<tr><th>Nama (Nomor RM)</th><td>: ' + d.nm_pasien + ' (' + i.no_rkm_medis + ')</td></tr>' +
                    '<tr><th>Nomor Rawat</th><td>: ' + i.no_rawat + '</td></tr>' +
                    '</td></tr>' +
                    '<tr><th>Unit/Poliklinik</th><td>: ' + i.poliklinik.nm_poli + '</td></tr>' +
                    '<tr><th>Dokter</th><td>: ' + i.dokter.nm_dokter + '</td></tr>' +
                    '<tr><th>Cara Bayar</th><td>: ' + i.penjab.png_jawab + '</td></tr>' +
                    diagnosaPasien(i.diagnosa_pasien) + prosedurPasien(i.prosedur_pasien) +
                    renderResumeMedis(i.resume_medis) +
                    renderPemeriksaan(ralan, i.pemeriksaan_ralan) + renderPemeriksaan('Rawat Inap', i.pemeriksaan_ranap) +
                    renderRiwayatAsmedAnak(i.asmed_ranap_anak) + renderRiwayatAsmedKandungan(i.asmed_ranap_kandungan) +
                    '<tr class="operasi-' + textRawat(i.no_rawat) + '" style="display:none"><th>Laporan Operasi</th><td class="laporan-op-' + textRawat(i.no_rawat) + '"></td>' +
                    pemberianObat(i.detail_pemberian_obat) +
                    pemeriksaanLab(i.detail_pemeriksaan_lab, i.umurdaftar, d.jk) +
                    pemeriksaanRadiologi(i.periksa_radiologi) +
                    fotoPemeriksaan(i.upload) +
                    '</tr>';

                pemeriksaan = '';

            });
            $('#tb_riwayat').append(detail);
        }

        function pemeriksaanRadiologi(radiologi) {
            if (Object.keys(radiologi).length) {
                html = `<tr class=""><th style="vertical-align: top;">Radiologi</th><td>`;
                radiologi.map((rad) => {
                    let hasiRadiologi = '';
                    rad.hasil_radiologi.map((hasil) => {
                        if (hasil.tgl_periksa == rad.tgl_periksa && hasil.jam == rad.jam) {
                            hasiRadiologi = hasil.hasil
                        }
                    })

                    let gambar = '';
                    if (Object.keys(rad.gambar_radiologi).length) {
                        rad.gambar_radiologi.map((img) => {
                            if (img.tgl_periksa == rad.tgl_periksa && img.jam == rad.jam) {
                                gambar += `<a data-magnify="gallery" data-src=""  data-group="a" href="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}">
                                                <img src="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}" class="img-thumbnail position-relative" width="300px">
                                            </a>`
                            } else {
                                gambar = `<a data-magnify="gallery" data-src=""  data-group="a" href="{{ asset('/img/default.png') }}">
                                                <img src="{{ asset('/img/default.png') }}" class="img-thumbnail position-relative" width="300px">
                                            </a>`
                            }
                        })
                    } else {
                        gambar = `<a data-magnify="gallery" data-src=""  data-group="a" href="{{ asset('/img/default.png') }}">
                                                <img src="{{ asset('/img/default.png') }}" class="img-thumbnail position-relative" width="300px">
                                            </a>`
                    }

                    // const gambar = rad.gambar_radiologi ? `https://sim.rsiaaisyiyah.com/webapps/radiologi/${rad.gambar_radiologi.lokasi_gambar}` : "{{ asset('/img/default.png') }}"
                    html += `
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 col-md-12">
                                        ${gambar}
                                </div>
                                <div class="col-lg-8 col-sm-12 col-md-12" style="background-color:#e1ffe3">
                                    <table class="table table-sm table-borderless" width="100%">
                                        <tr>
                                            <td width="20%">
                                                Tanggal Periksa
                                            </td>
                                            <td>
                                                : ${formatTanggal(rad.tgl_periksa)} ${rad.jam}    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Dokter Radiologi
                                            </td>
                                            <td>
                                                : ${rad.dokter.nm_dokter}    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Petugas Radiologi 
                                            </td>
                                            <td>
                                                : ${rad.petugas.nama}    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jenis Perawatan
                                            </td>
                                            <td>
                                                : ${rad.jns_perawatan.nm_perawatan}    
                                            </td>        
                                        </tr>
                                        <tr>
                                            <td>
                                                Indikasi Medis
                                            </td>
                                            <td>
                                                : ${rad.permintaan_radiologi ? rad.permintaan_radiologi.diagnosa_klinis : '-'}    
                                            </td>        
                                        </tr>
                                        <tr>
                                            <td>
                                                Informasi Tambahan
                                            </td>
                                            <td>
                                                : ${rad.permintaan_radiologi ? rad.permintaan_radiologi.informasi_tambahan : '-'}    
                                            </td>        
                                        </tr>
                                        <tr>
                                            <td>
                                                Hasil Bacaan
                                            </td>
                                            <td>
                                                :   ${stringPemeriksaan(hasiRadiologi)}
                                            </td>        
                                        </tr>
                                    </table>
                                </div>    
                                 
                            </div>`;
                })
                html += `</td></tr>`;
                return html
            }
        }

        function renderPemeriksaan(jns, data) {
            let html = '';
            if (data.length) {
                html = `<tr><th style="vertical-align: top;">Pemeriksaan ${jns}</th><td>`;
                $.map(data, (pemRanap) => {
                    html += `
                            <div class="row">
                                <div class="col-sm-12 col-lg-4">
                                    <table class="table table-sm borderless bm-2" style="background-color:#e1ffe3">
                                        <tr>
                                            <th width="10%">Petugas</th>
                                            <th>:</th>
                                            <th>${pemRanap.pegawai?.nama}</th>
                                        </tr>  
                                        <tr>
                                            <td>Tanggal </td>
                                            <td>:</td>
                                            <td>${formatTanggal(pemRanap.tgl_perawatan)} ${pemRanap.jam_rawat}</td>
                                        </tr>    
                                        <tr>
                                            <td>Tinggi </td>
                                            <td>:</td>
                                            <td>${pemRanap.tinggi} cm</td>    
                                        </tr>
                                        <tr>
                                            <td>Berat Badan </td>
                                            <td>:</td>
                                            <td>${pemRanap.berat} Kg</td>    
                                        </tr>
                                        <tr>
                                            <td>Suhu </td>
                                            <td>:</td>
                                            <td>${pemRanap.suhu_tubuh} <sup>0</sup>C</td>    
                                        </tr>
                                        <tr>
                                            <td>Tensi</td>
                                            <td>:</td>
                                            <td>${pemRanap.tensi} mmHG</td>    
                                        </tr>
                                        <tr>
                                            <td>Kesadaran</td>
                                            <td>:</td>
                                            <td>${pemRanap.kesadaran}</td>    
                                        </tr>
                                        <tr>
                                            <td>GCS</td>
                                            <td>:</td>
                                            <td>${pemRanap.gcs} E,V,M</td>    
                                            </tr>
                                        <tr>
                                            <td>Respirasi</td>
                                            <td>:</td>
                                            <td>${pemRanap.respirasi} X/menit</td>    
                                        </tr>
                                        <tr>
                                            <td>Nadi</td>
                                            <td>:</td>
                                            <td>${pemRanap.nadi} X/menit</td>    
                                        </tr>
                                        <tr>
                                            <td>SpO2</td>
                                            <td>:</td>
                                            <td>${pemRanap.spo2} %</td>    
                                        </tr>
                                        <tr>
                                            <td>Alergi</td>
                                            <td>:</td>
                                            <td>${pemRanap.alergi}</td>    
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <table class="table table-sm borderless bm-2" style="background-color:#e1ffe3">  
                                        <tr>
                                            <td width="10%">Subjek</td>
                                            <td>:</td>
                                            <td>${stringPemeriksaan(pemRanap.keluhan)}</td>
                                        </tr>    
                                        <tr>
                                            <td width="10%">Objek</td>
                                            <td>:</td>
                                            <td>${stringPemeriksaan(pemRanap.pemeriksaan)}</td>
                                        </tr>    
                                        <tr>
                                            <td width="10%">Asesmen</td>
                                            <td>:</td>
                                            <td>${stringPemeriksaan(pemRanap.penilaian)}</td>
                                        </tr>    
                                        <tr>
                                            <td width="10%">Plan</td>
                                            <td>:</td>
                                            <td>${stringPemeriksaan(pemRanap.rtl)}</td>
                                        </tr>    
                                        <tr>
                                            <td width="10%">Instruksi</td>
                                            <td>:</td>
                                            <td>${stringPemeriksaan(pemRanap.instruksi)}</td>
                                        </tr>    
                                    </table>
                                </div>
                                
                                
                            </div>`
                })
                html += `</td></tr>`
            }
            return html;
        }

        function renderResumeMedis(resumeMedis) {
            if (resumeMedis) {
                if (resumeMedis.kamar_inap) {
                    tgl_masuk = formatTanggal(resumeMedis.kamar_inap.tgl_masuk)
                    jam_masuk = resumeMedis.kamar_inap.jam_masuk
                    tgl_keluar = formatTanggal(resumeMedis.kamar_inap.tgl_keluar)
                    jam_keluar = resumeMedis.kamar_inap.jam_keluar
                    lama = resumeMedis.kamar_inap.lama
                    kamar = resumeMedis.kamar_inap.kamar.bangsal.nm_bangsal
                } else {
                    $.map(resumeMedis.bayi_gabung.kamar_inap, (kmr) => {
                        if (kmr.stts_pulang != 'Pindah Kamar') {
                            tgl_masuk = formatTanggal(kmr.tgl_masuk)
                            jam_masuk = kmr.jam_masuk
                            tgl_keluar = formatTanggal(kmr.tgl_keluar)
                            jam_keluar = kmr.jam_keluar
                            lama = kmr.lama
                            kamar = kmr.kamar.bangsal.nm_bangsal
                        }
                    })
                }
                html = `<tr><th style="vertical-align: top;">Resume Medis</th><td>`;
                html += `<div class="row">
                    <div class="col-lg-5">
                        <table class="table table-sm table-borderless" width="100%" style="background-color:#e1ffe3">
                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>: ${tgl_masuk} Jam : ${jam_masuk}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Keluar</td>
                                <td>: ${tgl_keluar} Jam : ${jam_keluar}</td>
                            </tr>
                            <tr>
                                <td>Lama</td>
                                <td>: ${lama} Hari</td>
                            </tr>
                            <tr>
                                <td>Kamar Rawat</td>
                                <td>: ${kamar}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-7" >
                        <table class="table table-sm table-borderless " width="100%" style="background-color:#e1ffe3">
                            <tr>
                                <td>Cara Bayar</td>
                                <td>: ${resumeMedis.reg_periksa.penjab.png_jawab}</td>
                            </tr>
                            <tr>
                                <td>Indikasi Medis</td>
                                <td>: ${resumeMedis.alasan}</td>
                            </tr>
                            <tr>
                                <td>Diagnosa Awal</td>
                                <td>: ${resumeMedis.diagnosa_awal}</td>
                            </tr>
                            <tr>
                                <td>Dokter DPJP</td>
                                <td>: ${resumeMedis.dokter.nm_dokter}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12" style="background-color:#e1ffe3;padding:5px">
                        <table class="table table-sm" width="100%">
                            <tr>
                                <td><strong>ANAMNESIS</strong> <br/>
                                    ${stringPemeriksaan(resumeMedis.keluhan_utama)}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PEMERIKSAAN FISIK</strong> <br/>
                                    ${stringPemeriksaan(resumeMedis.pemeriksaan_fisik)}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PEMERIKSAAN PENUNJANG</strong> <br/>
                                    ${stringPemeriksaan(resumeMedis.pemeriksaan_penunjang)}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PEMERIKSAAN LABORATORIUM</strong> <br/>
                                    ${stringPemeriksaan(resumeMedis.hasil_laborat)}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>DIAGNOSA AKHIR</strong> <br/>
                                    <table width="100%" style="margin-left:20px">
                                        <tr>
                                            <th>
                                                DIAGNOSA UTAMA
                                            </th>
                                            <td>
                                                ICD 10
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                *. ${resumeMedis.diagnosa_utama}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_utama}
                                            </td>    
                                        </tr>
                                          <tr>
                                            <th>
                                                DIAGNOSA SKUNDER
                                            </th>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>
                                                1. ${resumeMedis.diagnosa_sekunder}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                                2. ${resumeMedis.diagnosa_sekunder2}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder2}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                               3. ${resumeMedis.diagnosa_sekunder3}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder3}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                               4. ${resumeMedis.diagnosa_sekunder4}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder4}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                                5. ${resumeMedis.diagnosa_sekunder5}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder5}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                                6. ${resumeMedis.diagnosa_sekunder6}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder6}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                                7. ${resumeMedis.diagnosa_sekunder7}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_diagnosa_sekunder7}
                                            </td>    
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                             <tr>
                                <td><strong>TINDAKAN / OPERASI </strong> <br/>
                                    <table width="100%" style="margin-left:20px">
                                        <tr>
                                            <th>
                                                
                                            </th>
                                            <td>
                                                ICD 9
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                *. ${resumeMedis.prosedur_utama}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_prosedur_utama}
                                            </td>    
                                        </tr>
                                          <tr>
                                            <th>
                                                
                                            </th>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>
                                                1. ${resumeMedis.prosedur_sekunder}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_prosedur_sekunder}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                                2. ${resumeMedis.prosedur_sekunder2}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_prosedur_sekunder2}
                                            </td>    
                                        </tr>
                                         <tr>
                                            <td>
                                               3. ${resumeMedis.prosedur_sekunder3}
                                            </td>    
                                            <td>
                                                ${resumeMedis.kd_prosedur_sekunder3}
                                            </td>    
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PEMERIKSAAN PENUNJANG</strong> <br/>
                                ${resumeMedis.pemeriksaan_penunjang}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>OBAT SELAMA PERAWATAN</strong> <br/>
                                ${resumeMedis.obat_di_rs}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>PROGNOSIS</strong> <br/>
                                ${resumeMedis.ket_keadaan}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>KONDISI PULANG</strong> <br/>
                                ${resumeMedis.keadaan}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>OBAT PULANG</strong> <br/>
                                ${resumeMedis.obat_pulang}
                                </td>
                            </tr>
                            <tr>
                                <td><strong>SKH</strong> <br/>
                                ${resumeMedis.shk} Ket : ${resumeMedis.shk_keterangan} 
                                </td>
                            </tr>
                            <tr>
                                <td><strong>INSTRUKSI TINDAK LANJUT</strong> <br/>
                                KONTROL : ${formatTanggal(resumeMedis.kontrol.split(" ")[0])} 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>`
                html += `</td></tr>`;
                return html;
            }

        }

        function renderRiwayatAsmedAnak(asmed) {
            if (asmed) {
                html = '<tr><th style="vertical-align: top;">Asesmen Medis</th><td>'
                html += `
                <table class="table-print" width="100%" style="background-color:#fff">
                    <thead>
                        <tr>
                            <th colspan=6 style="font-size:14px;text-align:center">
                                ASESMEN MEDIS RAWAT INAP ANAK
                            </th>    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan=2 >
                                No. RM : ${asmed.reg_periksa.no_rkm_medis}<br>
                                Nama : ${asmed.reg_periksa.pasien.nm_pasien}
                            </td>
                            <td colspan=2 >
                                Jenis Kelamin : ${asmed.reg_periksa.pasien.jk=='L' ? 'Laki-laki' : 'Perempuan'} <br>
                                Tanggal Lahir : ${formatTanggal(asmed.reg_periksa.pasien.tgl_lahir)}
                            </td>
                            <td colspan=2  class="td-border">
                                Tanggal Asesmen : ${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]} <br>
                                Anamnesis : ${asmed.anamnesis}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               1. RIWAYAT KESEHATAN
                            </th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                 <strong>Keluhan Utama</strong> : <br> ${asmed.keluhan_utama}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                 <strong>Riwayat Penyakit Sekarang</strong> : <br> ${stringPemeriksaan(asmed.rps)}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                 <strong>Riwayat Penyakit Dahulu</strong> : <br> ${stringPemeriksaan(asmed.rpd)}
                            </td>
                            <td colspan="3" class="td-border">
                                 <strong>Riwayat Penyakit Keluarga</strong> : <br> ${stringPemeriksaan(asmed.rpk)}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                 <strong>Riwayat Pemberian Obat</strong> : <br> ${stringPemeriksaan(asmed.rpo)}
                            </td>
                            <td colspan="3" class="td-border">
                                 <strong>Riwayat Alergi</strong> : <br> ${asmed.alergi}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               2. PEMERIKSAAN FISIK
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <strong>Keadaan Umum</strong> : ${asmed.keadaan}
                            </td>
                            <td colspan="2">
                                 <strong>Kesadaran</strong> : ${asmed.kesadaran}
                            </td>
                            <td colspan="2">
                                 <strong>GCS (E,V,M)</strong> : ${asmed.gcs}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center" colspan=6>
                                TD : ${asmed.td} mmHg,
                                Nadi : ${asmed.nadi} x/m,
                                Respirasi : ${asmed.rr} x/m,
                                Suhu : ${asmed.suhu} <sup>0</sup>C,
                                SPO2: ${asmed.spo2} %,
                                BB: ${asmed.bb} Kg,
                                TB: ${asmed.tb} Cm    
                            </td>    
                        </tr>
                        <tr>
                            <td>
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>Kepala</li>
                                    <li>Mata</li>
                                    <li>Gigi & Mulut</li>
                                    <li>THT</li>
                                    <li>Thoraks</li>
                                    <li>Jantung</li>
                                </ul>  
                            </td>
                            <td class="td-border">
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>${asmed.kepala}</li>
                                    <li>${asmed.mata}</li>
                                    <li>${asmed.gigi}</li>
                                    <li>${asmed.tht}</li>
                                    <li>${asmed.thoraks}</li>
                                    <li>${asmed.jantung}</li>
                                </ul>  
                            </td>
                            <td>
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>Paru</li>
                                    <li>Abdomen</li>
                                    <li>Genital & Anus</li>
                                    <li>Ekstrimitas</li>
                                    <li>Kulit</li>
                                </ul>    
                            </td>
                            <td class="td-border">
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                     <li>${asmed.paru}</li>
                                    <li>${asmed.abdomen}</li>
                                    <li>${asmed.genital}</li>
                                    <li>${asmed.ekstremitas}</li>
                                    <li>${asmed.kulit}</li>
                                </ul>    
                            </td>
                            <td colspan=2>
                                <strong>Keterangan Fisik</strong> : <br> ${stringPemeriksaan(asmed.ket_fisik)}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               3. STATUS LOKALIS
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3" width="50%">
                                <img src="{{ asset('img/set-lokalis.jpg') }}" alt="" style="height: 220px;width:100%">
                            </td>
                            <td colspan="3" class="td-border">
                                Keterangan Lokalis : ${asmed.ket_lokalis}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                4. PEMERIKSAAN PENUNJANG
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Laboratorium : </strong> <br/> ${asmed.lab}
                            </td>    
                            <td colspan="2" class="td-border">
                                <strong>Radiologi : </strong> <br/> ${asmed.rad}
                            </td>    
                            <td colspan="2" class="td-border">
                                <strong>Penunjang Lainnya : </strong> <br/> ${asmed.penunjang}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                4. DIAGNOSIS
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${asmed.diagnosis}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                5. TATA LAKSANA
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${stringPemeriksaan(asmed.tata)}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                6. EDUKASI
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${stringPemeriksaan(asmed.edukasi)}
                            </td>    
                        </tr>
                        <tr>
                            <td colspan="6">
                                Dibuat oleh : <br/>
                                <strong>${asmed.dokter.nm_dokter}</strong> <br/> 
                                 Tanggal ${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}
                            </td>    
                        </tr>
                    </tbody>
                </table>
                `;
                html += '</td></tr>'
                return html;
            }

        }

        function renderRiwayatAsmedKandungan(asmed) {
            if (asmed) {
                html = '<tr><th style="vertical-align: top;">Asesmen Medis</th><td>'
                html += `
                <table class="table-print" width="100%" style="background-color:#fff">
                    <thead>
                        <tr>
                            <th colspan=6 style="font-size:14px;text-align:center">
                                ASESMEN MEDIS RAWAT INAP KANDUNGAN
                            </th>    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan=2 >
                                No. RM : ${asmed.reg_periksa.no_rkm_medis}<br>
                                Nama : ${asmed.reg_periksa.pasien.nm_pasien}
                            </td>
                            <td colspan=2 >
                                Jenis Kelamin : ${asmed.reg_periksa.pasien.jk=='L' ? 'Laki-laki' : 'Perempuan'} <br>
                                Tanggal Lahir : ${formatTanggal(asmed.reg_periksa.pasien.tgl_lahir)}
                            </td>
                            <td colspan=2  class="td-border">
                                Tanggal Asesmen : ${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]} <br>
                                Anamnesis : ${asmed.anamnesis}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               1. RIWAYAT KESEHATAN
                            </th>
                        </tr>
                        <tr>
                            <td colspan="6">
                                 <strong>Keluhan Utama</strong> : <br> ${asmed.keluhan_utama}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                 <strong>Riwayat Penyakit Sekarang</strong> : <br> ${stringPemeriksaan(asmed.rps)}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                 <strong>Riwayat Penyakit Dahulu</strong> : <br> ${stringPemeriksaan(asmed.rpd)}
                            </td>
                            <td colspan="3" class="td-border">
                                 <strong>Riwayat Penyakit Keluarga</strong> : <br> ${stringPemeriksaan(asmed.rpk)}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                 <strong>Riwayat Pemberian Obat</strong> : <br> ${stringPemeriksaan(asmed.rpo)}
                            </td>
                            <td colspan="3" class="td-border">
                                 <strong>Riwayat Alergi</strong> : <br> ${asmed.alergi}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               2. PEMERIKSAAN FISIK
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <strong>Keadaan Umum</strong> : ${asmed.keadaan}
                            </td>
                            <td colspan="2">
                                 <strong>Kesadaran</strong> : ${asmed.kesadaran}
                            </td>
                            <td colspan="2">
                                 <strong>GCS (E,V,M)</strong> : ${asmed.gcs}
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align:center" colspan=6>
                                TD : ${asmed.td} mmHg,
                                Nadi : ${asmed.nadi} x/m,
                                Respirasi : ${asmed.rr} x/m,
                                Suhu : ${asmed.suhu} <sup>0</sup>C,
                                SPO2: ${asmed.spo} %,
                                BB: ${asmed.bb} Kg,
                                TB: ${asmed.tb} Cm    
                            </td>    
                        </tr>
                        <tr>
                            <td>
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>Kepala</li>
                                    <li>Mata</li>
                                    <li>Gigi & Mulut</li>
                                    <li>THT</li>
                                    <li>Thoraks</li>
                                    <li>Jantung</li>
                                </ul>  
                            </td>
                            <td class="td-border">
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>${asmed.kepala}</li>
                                    <li>${asmed.mata}</li>
                                    <li>${asmed.gigi}</li>
                                    <li>${asmed.tht}</li>
                                    <li>${asmed.thoraks}</li>
                                    <li>${asmed.jantung}</li>
                                </ul>  
                            </td>
                            <td>
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                    <li>Paru</li>
                                    <li>Abdomen</li>
                                    <li>Genital & Anus</li>
                                    <li>Ekstrimitas</li>
                                    <li>Kulit</li>
                                </ul>    
                            </td>
                            <td class="td-border">
                                <ul style="list-style-type: none; text-align:left; margin:0px; padding:5px">
                                     <li>${asmed.paru}</li>
                                    <li>${asmed.abdomen}</li>
                                    <li>${asmed.genital}</li>
                                    <li>${asmed.ekstremitas}</li>
                                    <li>${asmed.kulit}</li>
                                </ul>    
                            </td>
                            <td colspan=2>
                                <strong>Keterangan Fisik</strong> : <br> ${stringPemeriksaan(asmed.ket_fisik)}
                            </td>
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                               3. STATUS OBSTETRI / GINEKOLOGI
                            </th>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align:center">
                                TFU : ${asmed.tfu} Cm, TB : ${asmed.tbj} gram, HIS : ${asmed.his} x/10 Menit, Kontraksi : ${asmed.kontraksi}, DJJ : ${asmed.djj} dpm
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong>Inspeksi : </strong> <br/> ${asmed.inspeksi}
                            </td>
                            <td colspan="3" class="td-border">
                                <strong>VT : </strong> <br/> ${asmed.vt}
                            </td>
                           
                        </tr>
                        <tr>
                            <td colspan="3">
                                <strong>Inspekulo : </strong> <br/> ${asmed.inspekulo}
                            </td>
                            <td colspan="3" class="td-border">
                                <strong>RT : </strong> <br/> ${asmed.rt}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                4. PEMERIKSAAN PENUNJANG
                            </th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Ultrasonografi : </strong> <br/> ${asmed.ultra}
                            </td>    
                            <td colspan="2" class="td-border">
                                <strong>Kardiotografi : </strong> <br/> ${asmed.kardio}
                            </td>    
                            <td colspan="2" class="td-border">
                                <strong>Laboratorium : </strong> <br/> ${asmed.lab}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                4. DIAGNOSIS
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${asmed.diagnosis}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                5. TATA LAKSANA
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${stringPemeriksaan(asmed.tata)}
                            </td>    
                        </tr>
                        <tr>
                            <th colspan="6" style="background-color:#e7e7e7 ">
                                6. EDUKASI
                            </th>
                        </tr>
                        <tr>
                            <td>
                                ${stringPemeriksaan(asmed.edukasi)}
                            </td>    
                        </tr>
                        <tr>
                            <td colspan="6">
                                Dibuat oleh : <br/>
                                <strong>${asmed.dokter.nm_dokter}</strong> <br/> 
                                 Tanggal ${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}
                            </td>    
                        </tr>
                    </tbody>
                </table>
                `;
                html += '</td></tr>'
                return html;
            }
        }

        function getAturanPakai(no_rawat, obat) {

            var aturan = '';
            var ajaxAturan = $.ajax({
                url: '/erm/aturan',
                data: {
                    'no_rawat': no_rawat,
                    'kode_brng': obat
                },
                dataType: 'JSON',
                // async: false,
                success: function(response) {
                    $('.aturan-' + textRawat(no_rawat) + '-' + obat).text(response.aturan)
                }
            })
        }

        function pemberianObat(obat) {
            if (Object.keys(obat).length > 0) {
                var pemberian = '<table class="table borderless mb-0" style="background-color:#e1ffe3">';
                let tgl_sekarang = ''
                obat.forEach(function(o) {
                    console.log(o);
                    if (o.data_barang.kdjns != 'J024') {
                        pemberian += '<tr><td width="20%">' + (tgl_sekarang != o.tgl_perawatan ? formatTanggal(o.tgl_perawatan) + ', Jam ' + o.jam : '') +
                            '</td><td>: <strong>' + o.data_barang.nama_brng + '</strong></td><td> ' + o.jml + ' ' + o.data_barang.kode_satuan?.satuan + '</td><td class="aturan-' + textRawat(o.no_rawat) +
                            '-' + o.kode_brng + '"></td><tr>';
                        tgl_sekarang = o.tgl_perawatan;
                        getAturanPakai(o.no_rawat, o.kode_brng)
                    }
                })
                pemberian += '</table>'
                return '<tr><th>Pemberian Obat</th><td>' + pemberian + '</td></tr>';
            }
            return '';
        }

        function hasilOperasi(operasi, no_rawat) {
            if (operasi) {
                $.ajax({
                    url: '/erm/operasi/laporan/' + textRawat(no_rawat, '-'),
                    dataType: 'JSON',
                    success: function(response) {
                        var html = '<table class="table borderless mb-0" style="background-color:#e1ffe3">';

                        html += '<tr>'
                        html += '<td width="30%"><strong>Jenis Operasi<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + operasi.paket_operasi.nm_perawatan + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="30%"><strong>Operator<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + operasi.op1.nm_dokter + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="30%"><strong>Asisten 1<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + operasi.asisten_op1.nama + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="30%"><strong>Asisten 2<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + operasi.asisten_op2.nama + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="30%"><strong>Jam Mulai<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.tanggal + '</td>'
                        html += '</tr>'

                        // html += '<tr>'
                        // html += '<td width="30%"><strong>Jam Selesai<strong></td>'
                        // html += '<td>:</td>'
                        // html += '<td>' + response.selesaioperasi + '</td>'
                        // html += '</tr>'

                        html += '<tr>'
                        html += '<td width="20%"><strong>Diagnosa Pre-Operasi<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.diagnosa_preop + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="20%"><strong>Diagnosa Post-Operasi<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.diagnosa_postop + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="20%"><strong>Jaringan Dieksekusi<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.jaringan_dieksekusi + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="20%"><strong>Permintaan PA.<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.permintaan_pa + '</td>'
                        html += '</tr>'

                        html += '<tr>'
                        html += '<td width="20%"><strong>Laporan<strong></td>'
                        html += '<td>:</td>'
                        html += '<td>' + response.laporan_operasi + '</td>'
                        html += '</tr>'
                        html += '</table>'
                        $('.operasi-' + textRawat(no_rawat)).removeAttr('style');
                        $('.laporan-op-' + textRawat(no_rawat)).append(html);
                    }
                })
            } else {
                // $('.operasi').css('display', 'hidden');
                // $('.laporan-op').empty();
            }


        }

        function petugasLab(no_rawat, lab) {
            $.ajax({
                url: '/erm/lab/petugas',
                data: {
                    'no_rawat': no_rawat,
                    'kd_jenis_prw': lab,
                },
                dataType: 'JSON',
                method: 'GET',
                success: function(response) {
                    $('.dr-' + textRawat(no_rawat) + '-' + lab).text(response.dokter?.nm_dokter);
                    $('.petugas-' + textRawat(no_rawat) + '-' + lab).text(response.petugas?.nama);
                }
            })

        }

        function pemeriksaanLab(lab, umur, jk) {
            if (Object.keys(lab).length > 0) {
                var hasilLab = '<table class="table mb-0" style="background-color:#e1ffe3">';
                let tgl_sekarang = '';
                let jnsPeriksa = '';
                let nmPerawatan = '';
                let no = 1;
                let rujukan = '';
                let classDokter = '';
                let classDokterSekarang = '';
                let classPetugas = '';
                let classPetugasSekarang = '';
                let barisTanggal = '';

                lab.forEach(function(l) {
                    classDokterSekarang = classDokter;
                    classPetugasSekarang = classPetugas;

                    classDokter = 'dr-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw;
                    classPetugas = 'petugas-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw;

                    tgl_sekarang != l.tgl_periksa || nmPerawatan != l.jns_perawatan_lab.nm_perawatan ? no = 1 : '';

                    hasilLab += (tgl_sekarang != l.tgl_periksa ?
                            '<tr class="table-warning" border=1><td style="width:9%">' +
                            formatTanggal(l.tgl_periksa) + ', Jam ' + l.jam + '</td>' +
                            '</td><td class="dr-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw + '"></td>' +
                            '<td class="petugas-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw +
                            '"></td>' +
                            '</tr>' : nmPerawatan != l.jns_perawatan_lab.nm_perawatan ?
                            '<tr class="">' : '') +
                        (jnsPeriksa == l.kd_jenis_prw ? (tgl_sekarang != l.tgl_periksa ?
                                '<td style="width:30%" colspan="3"><strong>' + l
                                .jns_perawatan_lab
                                .nm_perawatan +
                                '</tr>' +
                                '</tr>' +
                                '<tr><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>' : '') :
                            '<td style="width:30%" colspan="3"><p style="padding:0;margin:0"><strong>' +
                            l
                            .jns_perawatan_lab.nm_perawatan +
                            '</strong></p></td>' +
                            '</tr>' +
                            '<tr><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>') +
                        '<tr><td>' + no + '. ' + l.template.Pemeriksaan + '</td><td>' + l.nilai +
                        ' ' + l.template.satuan + (l.keterangan != '' ? ' (' + l.keterangan + ')' : '') +
                        '</td><td>' + l.nilai_rujukan + ' ' + l.template.satuan + '</td></tr>';
                    barisTanggal = tgl_sekarang != l.tgl_periksa ? '<td>' + formatTanggal(l.tgl_periksa) + ' ' +
                        l
                        .jam + '</td>' : '';
                    barisPerawatan = nmPerawatan != l.jns_perawatan_lab.nm_perawatan ?
                        '<td></td><td colspan="3""><strong>' +
                        l
                        .jns_perawatan_lab
                        .nm_perawatan + '</strong></td>' : '';
                    barisDokter = tgl_sekarang != l.tgl_periksa && classDokterSekarang != classDokter ?
                        '<td class="' + classDokter + '">' + '</td>' : '';
                    barisPetugas = tgl_sekarang != l.tgl_periksa && classPetugasSekarang != classPetugas ?
                        '<td class="' + classPetugas + '" colspan="2">' + '</td>' +
                        '<tr><td></td><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>' : '';
                    tgl_sekarang = l.tgl_periksa;
                    jnsPeriksa = l.kd_jenis_prw;
                    nmPerawatan = l.jns_perawatan_lab.nm_perawatan;
                    petugasLab(l.no_rawat, l.kd_jenis_prw);
                    no++;

                })
                hasilLab += '</table>'
                return '<tr><th>Laboratorium </th><td>' + hasilLab + '</td></tr>';
            }
            return '';
        }

        function diagnosaPasien(diagnosa) {
            let prioritas = '';
            if (Object.keys(diagnosa).length > 0) {
                var diagnosaPasien = '<table class="table borderless mb-0" style="background-color:#e1ffe3">';
                diagnosa.forEach(function(d) {
                    prioritas = d.prioritas == 1 ? '<span class="text-danger" title="Prioritas"> *</span>' : '';
                    diagnosaPasien +=
                        '<tr><td style="width:5%"><strong>' + d.kd_penyakit + '</strong></td><td>: ' + d
                        .penyakit
                        .nm_penyakit + ' ' + prioritas + '</td><tr>';
                })
                diagnosaPasien += '</table>'
                return '<tr><th>Diagnosa</th><td>' + diagnosaPasien + '</td></tr>';
            }
            return '';
        }

        function prosedurPasien(prosedur) {
            if (Object.keys(prosedur).length > 0) {
                var prosedurPasien = '<table class="table borderless mb-0" style="background-color:#e1ffe3">';
                prosedur.forEach(function(p) {
                    prosedurPasien +=
                        '<tr><td style="width:5%"><strong>' + p.kode + '</strong> : ' + p.icd9.deskripsi_panjang +
                        '</td><tr>';
                })
                prosedurPasien += '</table>'
                return '<tr><th>Prosedur </th><td>' + prosedurPasien + '</td></tr>';
            }
        }
    </script>
@endpush
