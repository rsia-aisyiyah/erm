<div class="modal fade" id="modalRiwayat" tabindex="-1" aria-labelledby="modalRiwayat" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">RIWAYAT PASIEN</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-riwayat">
                <div id="contentRiwayat"></div>
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
        const contentRiwayat = $('#contentRiwayat');
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

            if (Object.keys(foto).length > 0) {
                const listFoto = foto.map(function(f) {
                    let arrFoto = f?.file.split(',')
                    let kategori = f?.kategori;
                    const hasil = arrFoto.map((fx) => {
                        return `<div class="col-md-2 col-sm-12">
                                    <div class="image-set m-t-20">
                                        <a data-magnify="gallery" data-src="" data-caption="${kategori?.toUpperCase()} ${formatTanggal(f.tgl_masuk)}" data-group="a" href="${getBaseUrl(`/erm/public/erm/${fx}`)}">
                                            <img src="${getBaseUrl(`/erm/public/erm/${fx}`)}" class="img-thumbnail position-relative" width="300px"><figcaption align="center">
                                        </a>
                                        <figcaption>${kategori?.toUpperCase()}</figcaption>
                                    </div>
                            </div>`
                    }).join("")

                    return `${hasil}`


                }).join('')
                return `<div class="card my-2">
                    <div class="card-header">Berkas Penunjang</div>
                    <div class="card-body row">
                        ${listFoto}
                    </div>
                    </div>`;
            }
            return '';
        }

        function popup(foto) {
            $('#modal-image').modal('show');
            let src = `${getBaseUrl(`/erm/public/erm/${foto}`)}`;
            $('.popup').attr('src', src)
        }


        function riwayatPasien(d) {

            let detail = '';
            let stts_rawat = ''
            d.reg_periksa.forEach(function(i) {

                if (i.status_lanjut == 'Ranap') {
                    stts_rawat = 'RAWAT INAP';
                    ralan = 'UGD';
                    class_status = 'background:rgb(152, 0, 175);color:white';
                } else {
                    stts_rawat = 'RAWAT JALAN';
                    ralan = 'Poliklinik';
                    class_status = 'background:rgb(255 193 7);color:black';
                }

                if (i.catatan_perawatan == null) {
                    catatan = '<strong>Tidak ada catatan</strong>';
                } else {
                    catatan = i.catatan_perawatan.catatan.replace(/\n/g, '<br/>');
                }



                const header = `<h6 class="m-0">${stts_rawat}</h6>`;
                const identitas = `<div class="card-body">
                        <table class="table table-sm table-borderless text-sm m-0">
                            <tr>
                                <th>No. Rawat</th>
                                <th>:</th>
                                <td>${i.no_rawat}</td>
                            </tr>    
                            <tr>
                                <th width="20%">Tanggal Daftar</th>
                                <th width="1%">:</th>
                                <td> ${formatTanggal(i.tgl_registrasi)} ${i.jam_reg}</td>
                            </tr>    
                            <tr>
                                <th>Nama Pasien (No. RM)</th>
                                <th>:</th>
                                <td>${d.nm_pasien} (${d.no_rkm_medis})</td>
                            </tr>    
                            <tr>
                                <th>Poliklinik</th>
                                <th>:</th>
                                <td>${i.poliklinik.nm_poli}</td>
                            </tr>    
                            <tr>
                                <th>Dokter DPJP</th>
                                <th>:</th>
                                <td>${i.dokter.nm_dokter}</td>
                            </tr>    
                            <tr>
                                <th>Pembiayaan</th>
                                <th>:</th>
                                <td>${d.kd_pj !== 'A03' ?  `<strong class="text-success">${i.penjab.png_jawab}</strong>`:`<strong class="text-danger">${i.penjab.png_jawab}</strong>` }</td>
                            </tr>    
                            <tr>
                                <th>Diagnosa Akhir</th>
                                <th>:</th>
                                <td>${i.diagnosa_pasien.map((d) => {
                                    if(d.prioritas == 1){
                                        return `<strong class="text-danger">${d.kd_penyakit} - ${d.penyakit.nm_penyakit} *</strong>`;
                                    }else{
                                        return d.kd_penyakit + ' - ' + d.penyakit.nm_penyakit;
                                    }
                                }).join('<br/>')}</td>
                            </tr>    
                            <tr>
                                <th>Prosedur/Tindakan</th>
                                <th>:</th>
                                <td>${i.prosedur_pasien.map((d) => {
                                    if(d.prioritas == 1){
                                        return `<strong class="text-danger">${d.kode} - ${d.icd9.deskripsi_panjang} *</strong>`;
                                    }else{
                                        return d.kode + ' - ' + d.icd9.deskripsi_panjang;
                                    }
                                }).join('<br/>')}</td>
                            </tr>    
                        </table>
                    </div>`;
                const pemeriksaanRajal = renderPemeriksaan(ralan, i.pemeriksaan_ralan);
                const pemeriksaanRanap = renderPemeriksaan('Rawat Inap', i.pemeriksaan_ranap);
                detail += `<div class="card card-header ${stts_rawat==='RAWAT INAP' ? 'text-bg-indigo' : 'text-bg-warning'} my-2 text-center">${header}</div>
                <div class="card">${identitas}</div>
                <div>${pemeriksaanRajal}</div>
                <div class="card my-2">
                    <div class="card-header">Catatan</div>
                    <div class="card-body">${catatan}</div>
                </div>
                <div>${pemeriksaanRanap}</div>
                <div>${renderHasilOperasi(i.operasi)}</div>
                <div>${renderResumeMedis(i.resume_medis)}</div>
                <div>${pemberianObat(i.detail_pemberian_obat)}</div>
                <div>${pemeriksaanLab(i.periksa_lab)}</div>
                <div> ${pemeriksaanRadiologi(i.periksa_radiologi)}</div>
                <div> ${fotoPemeriksaan(i.upload)}</div>
                <div> ${renderRiwayatAsmedAnak(i.asmed_ranap_anak)}</div>
                <div> ${renderRiwayatAsmedKandungan(i.asmed_ranap_kandungan)}</div>
                `
                // detail +=
                //     '<tr>' +
                //     '<th colspan="2" style="' + class_status + '"><h6 align="center">' + status_lanjut +
                //     '</h6></th>' +
                //     '</tr>' +
                //     '<tr><th style="width:15%">Tanggal Daftar</th><td>: ' + formatTanggal(i.tgl_registrasi) + ' ' + i.jam_reg +
                //     '<tr><th>Nama (Nomor RM)</th><td>: ' + d.nm_pasien + ' (' + i.no_rkm_medis + ')</td></tr>' +
                //     '<tr><th>Nomor Rawat</th><td>: ' + i.no_rawat + '</td></tr>' +
                //     '</td></tr>' +
                //     '<tr><th>Unit/Poliklinik</th><td>: ' + i.poliklinik.nm_poli + '</td></tr>' +
                //     '<tr><th>Dokter</th><td>: ' + i.dokter.nm_dokter + '</td></tr>' +
                //     '<tr><th>Cara Bayar</th><td>: ' + i.penjab.png_jawab + '</td></tr>' +
                //     diagnosaPasien(i.diagnosa_pasien) + prosedurPasien(i.prosedur_pasien) +
                //     renderResumeMedis(i.resume_medis) +
                //     renderPemeriksaan(ralan, i.pemeriksaan_ralan) + renderPemeriksaan('Rawat Inap', i.pemeriksaan_ranap) +
                //     renderRiwayatAsmedAnak(i.asmed_ranap_anak) + renderRiwayatAsmedKandungan(i.asmed_ranap_kandungan) +
                //     '<tr class="operasi-' + textRawat(i.no_rawat) + '" style="display:none"><th>Laporan Operasi</th><td class="laporan-op-' + textRawat(i.no_rawat) + '"></td>' +
                //     pemberianObat(i.detail_pemberian_obat) +
                //     pemeriksaanLab(i.detail_pemeriksaan_lab, i.umurdaftar, d.jk) +
                //     pemeriksaanRadiologi(i.periksa_radiologi) +
                //     fotoPemeriksaan(i.upload) +
                //     '</tr>';

                // pemeriksaan = '';

            });
            // $('#tb_riwayat').append(detail);
            contentRiwayat.html(detail);
        }

        function getLamaWaktu(start, end) {
            start = start.split(":");
            end = end.split(":");

            var startDate = new Date(0, 0, 0, start[0], start[1], start[2] || 0);
            var endDate = new Date(0, 0, 0, end[0], end[1], end[2] || 0);

            var diff = endDate.getTime() - startDate.getTime();

            var hours = Math.floor(diff / 1000 / 60 / 60);
            diff -= hours * 1000 * 60 * 60;

            var minutes = Math.floor(diff / 1000 / 60);
            diff -= minutes * 1000 * 60;

            var seconds = Math.floor(diff / 1000);

            if (hours < 0) hours += 24;

            return (
                (hours <= 9 ? "0" : "") + hours + " Jam " +
                (minutes <= 9 ? "0" : "") + minutes + " Menit " +
                (seconds <= 9 ? "0" : "") + seconds + " Detik"
            );
        }

        function renderHasilOperasi(operasi) {
            if (operasi === null) {
                return '';
            }
            const start = operasi.laporan.tanggal.split(' ')[1];
            const end = operasi.laporan.selesaioperasi.split(' ')[1];
            const hasil = operasi.laporan.laporan_operasi.replace(/\n/g, '<br>')

            const content = `<div class="card my-2">
                <div class="card-header">Laporan Operasi</div>
                    <div class="card-body">
                        <table class="table table-sm text-sm">
                            <tr>
                                <th width="15%">Tgl & Jam Mulai</th>
                                <td>: ${formatTanggal(operasi.laporan.tanggal)}</td>
                            </tr>
                            <tr>
                                <th>Tgl & Jam Selesai</th>
                                <td>: ${formatTanggal(operasi.laporan.selesaioperasi)}</td>
                            </tr>
                            <tr>
                                <th>Lama Operasi</th>
                                <td>: ${getLamaWaktu(start, end)}</td>
                            </tr>
                            <tr>
                                <th>Jenis Operasi</th>
                                <td>: ${operasi.paket_operasi.nm_perawatan}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>: ${operasi.kategori}</td>
                            </tr>
                            <tr>
                                <th>Operator</th>
                                <td>: ${operasi.op1.nm_dokter}</td>
                            </tr>
                            <tr>
                                <th>Asisten 1</th>
                                <td>: ${operasi.asisten_op1.nama}</td>
                            </tr>
                            <tr>
                                <th>Asisten 2</th>
                                <td>: ${operasi.asisten_op2.nama}</td>
                            </tr>
                            <tr>
                                <th>Diagnosa Pre-Operasi</th>
                                <td>: ${operasi.laporan.diagnosa_preop}</td>
                            </tr>
                            <tr>
                                <th>Diagnosa Post-Operasi</th>
                                <td>: ${operasi.laporan.diagnosa_postop}</td>
                            </tr>
                            <tr>
                                <th>Jaringan Dieksekusi</th>
                                <td>: ${operasi.laporan.jaringan_dieksekusi}</td>
                            </tr>
                            <tr>
                                <th>Permintaan PA</th>
                                <td>: ${operasi.laporan.permintaan_pa}</td>
                            </tr>
                            <tr>
                                <th>Hasil Laporan</th>    
                                <td>: ${hasil}</td>    
                            </tr>
                        </table>
                    </div>
                
                </div>`;

            return content
        }

        function pemeriksaanRadiologi(radiologi) {

            if (radiologi.length == 0) {
                return '';
            }
            const content = radiologi.map((rad) => {
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
                            gambar += `<a data-magnify="gallery" data-src=""  data-group="a" href="${getBaseUrl(`/webapps/radiologi/${img.lokasi_gambar}`)}">
                                                <img src="${getBaseUrl(`/webapps/radiologi/${img.lokasi_gambar}`)}" class="img-thumbnail position-relative" width="300px">
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
                return `<div class="row">
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                        ${gambar}
                                </div>
                                <div class="col-lg-8 col-sm-12 col-md-12">
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
            }).join('')

            return `<div class="card mt-2">
                        <div class="card-header">Pemeriksaan Radiologi</div>
                        <div class="card-body">${content}</div>
                    </div>`
        }

        function renderPemeriksaan(jns, data) {
            let html = '';
            if (data.length) {
                if (jns === 'Rawat Inap') {
                    data = data.filter((item) => item.pegawai.bidang === 'Dokter Umum' || item.pegawai.departemen === 'SPS');
                }

                const content = data.map((pemRanap) => {
                    return `<div class="row gy-2 mb-2">
                                <div class="col-sm-12 col-lg-4">
                                    <div class="card">
                                        <div class="card-header  ${jns === 'Rawat Inap' ? 'text-bg-primary' : 'text-bg-warning'}">
                                            <span class="card-title">${pemRanap.pegawai?.nama}</span>    
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-sm borderless bm-2 text-sm p-4">
                                                <tr>
                                                    <td width="20%">Tanggal </td>
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

                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-8">
                                    <div class="card">
                                        <div class="card-header ${jns === 'Rawat Inap' ? 'text-bg-primary' : 'text-bg-warning'}">Hasil Pemeriksaan</div>
                                        <div class="card-body">
                                            <table class="table table-sm borderless bm-2">  
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
                                    </div>
                                </div>
                                
                                
                            </div>`
                }).join('')

                html = `<div class="card mt-2">
                    <div class="card-header">Pemeriksaan ${jns}</div>
                    <div class="card-body">${content}</div>
                </div>`
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
                html = `<div class="row">
                    <div class="col-lg-5">
                        <table class="table table-sm table-borderless" width="100%">
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
                    <div class="col-lg-12">
                        <table class="table table-sm text-sm" width="100%">
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
                                            <th width="20%">
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
                                            <th width="20%">
                                                
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

                return `<div class="card my-2">
                    <div class="card-header text-bg-success">Resume Medis</div>
                    <div class="card-body">${html}</div>
                    </div>`;
            }
            return ''

        }

        function renderRiwayatAsmedAnak(asmed) {
            if (asmed) {
                html = `
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
                return `<div class="card my-2">
                    <div class="card-header">Asesmen Medis Rawat Inap Anak</div>
                    <div class="card-body">${html}</div>
                    </div>`;
            }

            return '';

        }

        function renderRiwayatAsmedKandungan(asmed) {
            if (asmed) {
                html = `
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
                return `<div class="card my-2">
                    <div class="card-header">Asesmen Medis Rawat Inap Kandungan</div>
                    <div class="card-body">${html}</div>
                    </div>`;
            }

            return '';
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
                let tgl_sekarang = ''
                const groupedData = obat.reduce((acc, item) => {
                    // Kelompok berdasarkan tgl_perawatan
                    if (!acc[item.tgl_perawatan]) {
                        acc[item.tgl_perawatan] = {};
                    }

                    // Kelompok berdasarkan jam di dalam tgl_perawatan
                    if (!acc[item.tgl_perawatan][item.jam]) {
                        acc[item.tgl_perawatan][item.jam] = [];
                    }

                    acc[item.tgl_perawatan][item.jam].push(item);
                    return acc;
                }, {});

                // Mengonversi ke array jika diperlukan
                const arrayObat = Object.entries(groupedData).map(([date, times]) => ({
                    tgl_perawatan: date,
                    jam: Object.entries(times).map(([time, items]) => ({
                        jam: time,
                        items
                    }))
                }));

                const pemberian = arrayObat.map((item) => {
                    const jam = item.jam.map((item) => {
                        const obat = item.items.filter(item => item.data_barang.kdjns !== 'J024' && item.data_barang.kdjns !== 'J033').map((item) => {
                            return `<tr>
                                        <td>${item.data_barang.nama_brng}</td>
                                        <td>${item.jml} ${item.data_barang.kode_satuan.satuan}</td>
                                        <td>${item.aturan_pakai ? item.aturan_pakai.aturan : ''}</td>
                                </tr>`
                        }).join('');

                        return `<tr class="table-secondary" colspan="3"><td colspan="3">${item.jam}</td>
                                ${obat}
                            </tr>`
                    }).join('')

                    return `<table class="table table-sm text-sm">
                        <tr>
                            <th colspan="3">${(tgl_sekarang !== item.tgl_perawatan ? formatTanggal(item.tgl_perawatan) : '')}</th>
                        </tr>
                        <tr>
                            <th width="30%">Nama Obat</th>
                            <th width="10%">Jumlah</th>
                            <th>Aturan Pakai</th>
                        </tr>
                        ${jam}
                        </table>`

                }).join('')
                return `<div class="card my-2">
                        <div class="card-header">
                            Pemberian Obat    
                        </div>
                        <div class="card-body"> ${pemberian}</div>
                    </div>`
            }
            return '';
        }

        function hasilOperasi(operasi, no_rawat) {
            if (operasi.length > 0) {
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

        function pemeriksaanLab(lab) {

            if (lab.length == 0) {
                return '';
            }

            const content = lab.filter(item => item.kd_jenis_prw !== 'J000019').map((item, index) => {
                const detail = item.detail.map((detail, index) => {
                    return `<tr class="${setWarnaPemeriksaan(detail.keterangan)}">
                            <td>${detail.template.Pemeriksaan}</td>
                            <td>${detail.nilai} ${detail.template.satuan}</td>
                            <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                            <td>${detail.keterangan}</td></tr>`
                })
                return `<div class="card my-2">
                            <div class="card-header text-sm text-bold">${formatTanggal(item.tgl_periksa)} ${item.jam}</div>
                            <div class="card-body">
                                <table class="table table-sm text-sm table-hover">
                                    <tr class="row-secondary">
                                        <th colspan="3">${item.jns_perawatan_lab.nm_perawatan}</th>
                                        <th>${item.petugas.nama}</th>
                                    </tr>
                                    <tr>
                                        <th>Item Pemeriksaan</th>    
                                        <th>Nilai Hasil</th>    
                                        <th>Nilai Rujukan</th>    
                                        <th>Keterangan</th>    
                                    </tr>
                                ${detail.join('')}
                                </table>    
                            </div>
                        </div>`;
            }).join('');

            return `<div class="card">
                        <div class="card-header">Pemeriksaan Laboratorium</div>
                        <div class="card-body">
                            ${content}
                        </div>
                    </div>`

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
