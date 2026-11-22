<style>
    .erm-ews-warning-banner {
        border-radius: 10px;
        padding: 12px 14px;
        margin: 10px 0 12px 0;
        border: 1px solid #e2e8f0;
        border-left: 5px solid #64748b;
        background: #f8fafc;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }

    .erm-ews-warning-banner.is-safe {
        background: #f0fdf4;
        border-color: #bbf7d0;
        border-left-color: #16a34a;
        color: #166534;
    }

    .erm-ews-warning-banner.is-low {
        background: #fefce8;
        border-color: #fde047;
        border-left-color: #ca8a04;
        color: #854d0e;
    }

    .erm-ews-warning-banner.is-medium {
        background: #fff7ed;
        border-color: #fdba74;
        border-left-color: #ea580c;
        color: #9a3412;
    }

    .erm-ews-warning-banner.is-critical {
        background: #fef2f2;
        border-color: #fca5a5;
        border-left-color: #dc2626;
        color: #991b1b;
        box-shadow: 0 4px 16px rgba(220, 38, 38, 0.16);
        animation: ermEwsPulseBorder 1.8s infinite;
    }

    @keyframes ermEwsPulseBorder {
        0% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.35); }
        70% { box-shadow: 0 0 0 8px rgba(220, 38, 38, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
    }

    .erm-ews-legend {
        margin-top: 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 11.5px;
    }

    .erm-ews-legend-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 6px;
        margin-top: 6px;
    }

    .erm-ews-legend-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #cbd5e1;
        border-radius: 7px;
        padding: 6px 8px;
        line-height: 1.35;
    }

    #table-ews td.ews-col-selected {
        outline: 2px solid #1d4ed8;
        outline-offset: -2px;
        font-weight: 800;
    }
</style>

<div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-primary btn-sm" type="button" onclick="showFormEws()"><i class="bi bi-plus"></i> Tambah EWS</button>
        <button class="btn btn-success btn-sm" type="button" onclick="renderToImageEwsRanap()"><i class="bi bi-save"></i> Export EWS</button>
    </div>
    <small class="text-muted"><i class="bi bi-hand-index-thumb me-1"></i>Klik angka total / warna pada kolom tabel untuk melihat detail peringatan tiap waktu pemeriksaan.</small>
</div>
<div id="sectionEws">


<table class="table table-sm table-borderless d-none" style="margin: 0 auto; width: auto;table-layout: auto;" id="tbInfoPasienEWS">
    <tr>
        <td colspan="4" style="text-align: center; font-weight: bold; font-size: 16px;">
            RUMAH SAKIT IBU DAN ANAK AISYIYAH<br>
            PEKAJANGAN – PEKALONGAN
        </td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;">
            Jl. Raya Pekajangan No. 610 Pekajangan – Pekalongan, 51172<br>
            Telp. (0285) 785909 &nbsp; Email: rba610@gmail.com<br>
            Website: www.rsiaaisyiyah.com
        </td>
    </tr>

    <tr><td colspan="4" style="height: 10px;"></td></tr>

    <tr>
        <td style="width: 25%;"><strong>No. Rawat</strong></td>
        <td style="width: 25%;" id="noRawatPasienEWS">: ...........</td>
        <td style="width: 25%;"><strong>Nama</strong></td>
        <td style="width: 25%;" id="nmPasienEws">: ................................</td>
    </tr>
    <tr>
        <td><strong>Tgl. Lahir</strong></td>
        <td id="tglLahirPasienEws">: ................................</td>
        <td ><strong>No. RM</strong></td>
        <td id="noRmPasienEWS"> : ................................</td>
    </tr>
    <tr>
        <td><strong>Ruang / Kelas</strong></td>
        <td id="kamarPasienEWS">: ................................</td>
        <td colspan="2"></td>
    </tr>
</table>

<h6 class="text-center mt-2" style="margin-bottom:0px">EARLY WARNING SCORE (EWS)</h6>
<h6 style="" class="kategori mb-2 text-center"></h6>

{{-- Dynamic Clinical Warning Banner (EWS Non-Maternal & EWS Maternal) --}}
<div id="ewsWarningBanner" class="d-none"></div>

<div class="table-responsive">
<table class="" id="table-ews" style="margin: 0 auto; width: auto;table-layout: auto;">
    <thead>
        <tr class="tr-tanggal">
            <th width="" colspan="2">Tanggal</th>
        </tr>
        <tr class="tr-jam">
            <th colspan="2">Jam</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <td class="hasil-ews"></td>
        </tr>

    </tfoot>

</table>
</div>

{{-- Panduan Kategori Warning EWS --}}
<div id="ewsLegendBox" class="erm-ews-legend d-none"></div>

</div>

@push('script')
    <script>
        const tabEws = $('#tab-ews');

        tabEws.on('click', () => {
            const formInfoPasien = $('#formInfoPasien');
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
            const pasien = formInfoPasien.find('input[name="pasien"]').val();
            const tgl_lahir = formInfoPasien.find('input[name="tgl_lahir"]').val();
            const kamar = formInfoPasien.find('input[name="kamar"]').val();
            const no_rkm_medis = formInfoPasien.find('input[name="no_rkm_medis"]').val();
            const stts = 'ranap';

            $('#nmPasienEws').text(`: ${pasien}`)
            $('#noRawatPasienEWS').text(`: ${no_rawat}`)
            $('#tglLahirPasienEws').text(`: ${tgl_lahir}`)
            $('#kamarPasienEWS').text(`: ${kamar}`)
            $('#noRmPasienEWS').text(`: ${no_rkm_medis}`)

            setEws(no_rawat, stts, spesialis)



        })
        /**
         * Fungsi untuk merender elemen 'sectionEws' ke dokumen PDF
         * menggunakan html2pdf.js, yang memberikan hasil rendering terbaik
         * untuk struktur tabel yang kompleks.
         */
        function renderToImageEwsRanap() {
            const content = document.getElementById(`sectionEws`);
            document.getElementById('tbInfoPasienEWS').classList.remove('d-none');

            // Proses html2canvas
            html2canvas(content, {
                useCORS: true,
                allowTaint: false,
                scale: 2, // Meningkatkan skala untuk gambar beresolusi lebih tinggi
                ignoreElements: (element) => {
                    // Abaikan elemen yang tidak perlu (misalnya, tombol unduh jika ada)
                    return element.tagName === 'BUTTON';
                }
            }).then(function(canvas) {
                const imageDataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageDataURL;
                const randomNumber = Math.floor(Math.random() * (99999999 - 1000000 + 1)) + 1000000;
                link.download = `early-warning-score-${randomNumber}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);


                // Bisa kasih notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    text: 'Gambar berhasil diunduh',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    document.getElementById('tbInfoPasienEWS').classList.add('d-none');
                });

            }).catch(function(error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: error.message
                });
            });
        }

        function showFormEws() {
            const formEwsRanap = $('#formEwsRanap')

            // Ambil waktu lokal dari browser
            const now = new Date()

            // Format YYYY-MM-DD
            const tgl = now.toISOString().slice(0, 10)

            // Format HH:MM:SS dengan leading-zero
            const jam = now.toLocaleTimeString('en-GB', { hour12: false })

            formEwsRanap.find('input[name=tgl_perawatan]').val(tgl)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)
            formEwsRanap.find('input[name=jam_rawat]').val(jam)

            const kdSps = formInfoPasien.find('input[name="kd_sps_dokter"]').val()
            if(kdSps==='S0001'){
                formEwsRanap.find('#maternal').removeClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('-').change()
                formEwsRanap.find('select[name=proteinuria]').val('-').change()
                formEwsRanap.find('select[name=air_ketuban]').val('-').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('-').change()
                formEwsRanap.find('select[name=lochia]').val('-').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('-').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('-').change()
            }else{
                formEwsRanap.find('#maternal').addClass('d-none')
                formEwsRanap.find('select[name=keluaran_urin]').val('').change()
                formEwsRanap.find('select[name=proteinuria]').val('').change()
                formEwsRanap.find('select[name=air_ketuban]').val('').change()
                formEwsRanap.find('select[name=skala_nyeri]').val('').change()
                formEwsRanap.find('select[name=lochia]').val('').change()
                formEwsRanap.find('select[name=terlihat_tidak_sehat]').val('').change()
                formEwsRanap.find('select[name=kesadaran_maternal]').val('').change()
            }
            $('#modalEwsRanap').modal('show')

        }

        function createEwsRanap(){
            const data = getDataForm('#formEwsRanap', ['input', 'select'])
            data['no_rawat'] = formInfoPasien.find('input[name="no_rawat"]').val()
            data['sumber'] = 'EWS'
            delete data['nm_pegawai'];
            const formEwsRanap = $('#formEwsRanap')

            $.post('/erm/soap/grafik/store', data).done((response)=>{
                const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
                const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
                const stts = 'ranap';
                setEws(no_rawat, stts, spesialis)
                swalToast('Berhasil Menambah Data EWS')
                formEwsRanap.find('.parameterEws').find('select').val('').change();
                formEwsRanap.find('.parameterEws').find('input').val('').change();
                $('#modalEwsRanap').modal('hide')
            }).fail(function(xhr, status, error) {
                swalToast('Terjadi Kesalahan', error)
                console.error("Error:", status, error); // Tampilkan detail error
                console.log("XHR Response:", xhr.responseText); // Tampilkan respons server
            })
        }

        function deleteEwsRanap(no_rawat, tgl_perawatan, jam_rawat){
            Swal.fire({
                title: 'Yakin ingin data EWS ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/soap/grafik/delete',
                        data: {
                            no_rawat,
                            tgl_perawatan,
                            jam_rawat,
                        },
                        method: 'DELETE',
                        success: (response) => {
                            swalToast('Berhasil Hapus EWS')
                            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
                            const spesialis = formInfoPasien.find('input[name="kd_sps_dokter"]').val();
                            const stts = 'ranap';
                            setEws(no_rawat, stts, spesialis)
                        },
                        error: (request) => {
                            alertSessionExpired(request.status)
                        },
                    })
                }
            })

        }

        function getEws(params, stts) {
            const urlEws = stts == 'ranap' ? '/erm/ews/ranap/' + textRawat(params, '-') : '/erm/ews/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: urlEws,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEws(no_rawat, stts, spesialis) {
            if (spesialis == 'S0003') {
                setEwsAnak(no_rawat, stts)
            } else if (spesialis == 'S0001') {
                setEwsMaternal(no_rawat, stts)
            }else{
                setEwsAnak(no_rawat, 'ralan', '')
            }
        }

        function setEwsAnak(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                let jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEws(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                let j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';


                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1

                    let rowCount = 0;
                    const totalRowsInGroup = res.data.length;
                    $.map(res.data, (data) => {
                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';


                        rowCount++;

                        // Menentukan class untuk estetika border pengelompokan
                        let groupClass = '';
                        if (rowCount === 1) {
                            groupClass = 'ews-group-start'; // Baris pertama di grup
                        } else if (rowCount === totalRowsInGroup) {
                            groupClass = 'ews-group-end';   // Baris terakhir di grup
                        } else {
                            groupClass = 'ews-group-middle';// Baris tengah
                        }

                        if (data.hasil == 3) {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 2) {
                            style = "style='background-color:orange;color:#fff'";
                        } else if (data.hasil == 1) {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "";
                        }

                        html += '<tr class="ews-' + data.id + ' ' + groupClass + '" ' + style + ' id="kategori-' + res.kategori + '">'

                        if (rowCount === 1) {
                            html += '<td style="padding:10px; text-align:center;background-color: #fff !important;" class="criteria-cell">' + res.judul + '</td>'
                        } else {
                            html += '<td style="padding:10px;background-color: #fff !important;" class="criteria-cell-hidden"></td>'
                        }
                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" >' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {

                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td style="border-top:1px solid black !important;">' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td style="border-top:1px solid black !important;"></td>';
                            }
                            no++;

                        })
                        tanggal = data.tanggal
                            .map((tgl, index) => {
                                const id = index + 1;
                                const jamVal = data.jam[index] ?? '';
                                const sumber = data.sumber[index] ?? '';
                                let btnDelete = '';
                                if(sumber === 'EWS'){
                                    btnDelete = ` <a
                                                    href="javascript:void(0)"
                                                    onclick="deleteEwsRanap('${params}', '${tgl}', '${jamVal}')">
                                                    <i class="bi bi-x text-danger"></i>
                                                </a>`
                                }

                                return `
                                        <td class="td-tanggal" id="tanggal${id}">
                                                <span>${splitTanggal(tgl)}</span>
                                                ${btnDelete}

                                        </td>
                                 `;
                            })
                            .join('');

                        j = data.jam
                            .map((jam, index) => {
                                const id = index + 1;
                                return `
            <td  class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');


                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })



                })
                $('#table-ews tbody').append(html)
                $('#table-ews tfoot').removeClass('d-none')
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEws(no)
            })
        }
        function syncEwsHeaderAndTabBadge(level, shortLabel) {
            const tabBadge = $('#ranapEwsTabBadge');
            const hdrBadge = $('#ermRanapHdrEwsBadge');
            if (!shortLabel) {
                tabBadge.addClass('d-none').text('');
                hdrBadge.addClass('d-none').text('');
                return;
            }

            let cls = 'text-bg-success';
            if (level === 'critical') cls = 'text-bg-danger';
            else if (level === 'medium') cls = 'text-bg-warning text-dark';
            else if (level === 'low') cls = 'text-bg-warning text-dark';

            tabBadge
                .removeClass('d-none text-bg-success text-bg-warning text-bg-danger text-dark')
                .addClass(cls)
                .text(shortLabel);

            hdrBadge
                .removeClass('d-none text-bg-success text-bg-warning text-bg-danger text-dark')
                .addClass(cls)
                .html(`<i class="bi bi-activity me-1"></i>EWS: ${shortLabel}`);
        }

        function renderEwsStandardLegend() {
            $('#ewsLegendBox').removeClass('d-none').html(`
                <div class="fw-bold text-dark mb-1"><i class="bi bi-info-circle text-primary me-1"></i>Panduan Tindakan Berdasarkan Skor EWS</div>
                <div class="erm-ews-legend-grid">
                    <div class="erm-ews-legend-item" style="border-left-color:#16a34a;">
                        <div class="fw-bold text-success">Nilai Total 0</div>
                        <div class="text-muted">Monitoring ulang minimal tiap 12 jam</div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#ca8a04;">
                        <div class="fw-bold text-warning-emphasis">Nilai Total 1–4</div>
                        <div class="text-muted">Monitoring ulang minimal tiap 6–8 jam</div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#ea580c;">
                        <div class="fw-bold" style="color:#c2410c;">Terdapat Nilai 3 (di 1 Parameter)</div>
                        <div class="text-muted">Monitoring ulang minimal tiap 3–4 jam, <strong>Panggil dokter jaga</strong></div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#ea580c;">
                        <div class="fw-bold" style="color:#c2410c;">Nilai Total 5–6</div>
                        <div class="text-muted">Monitoring ulang minimal tiap 3–4 jam, <strong>Panggil dokter jaga</strong></div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#dc2626;background:#fef2f2;">
                        <div class="fw-bold text-danger">Nilai Total &ge; 7</div>
                        <div class="text-danger">Monitoring ulang tiap jam, <strong>Call Code Blue</strong>, Pindahkan perawatan ke level 2/3 (ICU)</div>
                    </div>
                </div>
            `);
        }

        function renderEwsMaternalLegend() {
            $('#ewsLegendBox').removeClass('d-none').html(`
                <div class="fw-bold text-dark mb-1"><i class="bi bi-info-circle text-primary me-1"></i>Panduan Eskalasi EWS Maternal</div>
                <div class="erm-ews-legend-grid">
                    <div class="erm-ews-legend-item" style="border-left-color:#16a34a;">
                        <div class="fw-bold text-success">0 Merah &amp; 0 Kuning</div>
                        <div class="text-muted">Kondisi stabil, lanjutkan monitoring rutin sesuai jadwal</div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#ca8a04;">
                        <div class="fw-bold text-warning-emphasis">1 Skor Kuning (0 Merah)</div>
                        <div class="text-muted">Observasi lebih ketat; lapor DPJP bila menjadi 2 Kuning atau muncul 1 Merah</div>
                    </div>
                    <div class="erm-ews-legend-item" style="border-left-color:#dc2626;background:#fef2f2;">
                        <div class="fw-bold text-danger">&ge; 1 Skor Merah atau &ge; 2 Skor Kuning</div>
                        <div class="text-danger"><strong>WAJIB Laporkan kepada DPJP segera!</strong></div>
                    </div>
                </div>
            `);
        }

        function getEwsStandardWarning(total, arrNilai) {
            const nilai = Number(total) || 0;
            const hasScore3 = (arrNilai || []).some((v) => Number(v) === 3);

            if (nilai >= 7) {
                return {
                    level: 'critical',
                    badgeText: `Skor ${nilai} (KRITIS)`,
                    shortBadge: `${nilai} • ICU`,
                    title: `PERINGATAN KRITIS — Nilai Total EWS ${nilai} (&ge; 7)`,
                    message: 'Monitoring ulang <strong>tiap jam</strong>, <strong>Call Code Blue</strong>, pindahkan perawatan ke <strong>level 2/3 (ICU)</strong>.',
                    cellStyle: 'background-color:#dc2626;color:#ffffff;font-weight:700;',
                    footerStyle: 'background-color:#dc2626;color:#ffffff;font-weight:700;padding:10px;',
                    icon: 'bi-exclamation-octagon-fill',
                };
            }

            if (nilai >= 5 && nilai <= 6) {
                return {
                    level: 'medium',
                    badgeText: `Skor ${nilai} (Risiko Sedang-Tinggi)`,
                    shortBadge: `${nilai} • Lapor Dr`,
                    title: `PERINGATAN — Nilai Total EWS ${nilai} (5–6)`,
                    message: 'Monitoring ulang minimal tiap <strong>3–4 jam</strong>, <strong>Panggil dokter jaga</strong>.',
                    cellStyle: 'background-color:#f97316;color:#ffffff;font-weight:700;',
                    footerStyle: 'background-color:#f97316;color:#ffffff;font-weight:700;padding:10px;',
                    icon: 'bi-exclamation-triangle-fill',
                };
            }

            if (hasScore3) {
                return {
                    level: 'medium',
                    badgeText: `Skor ${nilai} (Ada Nilai 3)`,
                    shortBadge: `${nilai} (Ada 3)`,
                    title: `PERINGATAN — Terdapat Nilai 3 pada Parameter EWS (Total ${nilai})`,
                    message: 'Monitoring ulang minimal tiap <strong>3–4 jam</strong>, <strong>Panggil dokter jaga</strong>.',
                    cellStyle: 'background-color:#f97316;color:#ffffff;font-weight:700;',
                    footerStyle: 'background-color:#f97316;color:#ffffff;font-weight:700;padding:10px;',
                    icon: 'bi-exclamation-triangle-fill',
                };
            }

            if (nilai >= 1 && nilai <= 4) {
                return {
                    level: 'low',
                    badgeText: `Skor ${nilai} (Waspada)`,
                    shortBadge: `${nilai}`,
                    title: `WASPADA — Nilai Total EWS ${nilai} (1–4)`,
                    message: 'Monitoring ulang minimal tiap <strong>6–8 jam</strong>.',
                    cellStyle: 'background-color:#fde047;color:#0f172a;font-weight:700;',
                    footerStyle: 'background-color:#fef08a;color:#854d0e;font-weight:700;padding:10px;',
                    icon: 'bi-exclamation-circle-fill',
                };
            }

            return {
                level: 'safe',
                badgeText: 'Skor 0 (Stabil)',
                shortBadge: '0',
                title: 'STABIL — Nilai Total EWS 0',
                message: 'Monitoring ulang minimal tiap <strong>12 jam</strong>.',
                cellStyle: 'background-color:#dcfce7;color:#166534;font-weight:700;',
                footerStyle: 'background-color:#dcfce7;color:#166534;font-weight:700;padding:10px;',
                icon: 'bi-check-circle-fill',
            };
        }

        function hitungNilaiEws(no) {
            html = '<tr>'
            html += '<th colspan=2>NILAI EWS TOTAL</th>'
            let lastTotal = null;
            let lastIndex = null;

            for (let index = 1; index < no; index++) {
                let total = 0;
                let arrNilai = [];
                $('.baris-' + index).each(function(i, element) {
                    const v = parseFloat($(element).val()) || 0;
                    total += v;
                    arrNilai.push(v);
                });

                const warn = getEwsStandardWarning(total, arrNilai);

                html += `<td onclick="tindakanEws(${total}, ${index})" class="nilai-${index}" style="cursor:pointer;text-align:center;${warn.cellStyle}" id="total-ews-${index}" title="${warn.badgeText}">${total}</td>`;
                lastTotal = total;
                lastIndex = index;
            }
            html += '</tr>'
            $('#table-ews tbody').append(html)

            renderEwsStandardLegend();
            if (lastIndex !== null) {
                tindakanEws(lastTotal, lastIndex);
            } else {
                $('#ewsWarningBanner').addClass('d-none').empty();
                syncEwsHeaderAndTabBadge('', '');
            }
        }

        function tindakanEws(total, index) {
            $('.hasil-ews').empty();
            let arrNilai = [];

            $('.baris-' + index).each(function(i, element) {
                arrNilai.push($(element).val());
            });

            const warn = getEwsStandardWarning(total, arrNilai);
            const tglText = $(`#tanggal${index} span`).text().trim() || $(`#tanggal${index}`).text().trim();
            const jamText = $(`.jam${index}`).text().trim();
            const waktuLabel = (tglText || jamText) ? `${tglText} ${jamText}`.trim() : `Pemeriksaan #${index}`;

            // Highlight kolom terpilih
            $('#table-ews td.ews-col-selected').removeClass('ews-col-selected');
            $(`.nilai-${index}`).addClass('ews-col-selected');

            // Update Banner Warning Prominent di atas tabel
            $('#ewsWarningBanner')
                .removeClass('d-none')
                .html(`
                    <div class="erm-ews-warning-banner is-${warn.level}">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi ${warn.icon} fs-4 flex-shrink-0 mt-1"></i>
                            <div>
                                <div class="fw-bold" style="font-size:13px;">${warn.title}</div>
                                <div style="font-size:12px;">${warn.message}</div>
                            </div>
                        </div>
                        <div class="text-end flex-shrink-0">
                            <span class="badge text-bg-light border text-dark" style="font-size:10.5px;">
                                <i class="bi bi-clock me-1"></i>${waktuLabel}
                            </span>
                        </div>
                    </div>
                `);

            syncEwsHeaderAndTabBadge(warn.level, warn.shortBadge);

            // Update footer tabel EWS
            const footerHtml = `<i class="bi ${warn.icon} me-1"></i><strong>[${waktuLabel}]</strong> ${warn.badgeText} &mdash; ${warn.message}`;
            let jumlahTanggal = $('.td-tanggal').length + 3;
            $('.hasil-ews')
                .attr('style', warn.footerStyle)
                .attr('colspan', jumlahTanggal)
                .css('text-align', 'center')
                .html(footerHtml);
        }


        function getEwsMaternal(params, stts) {
            const urlEws = stts == 'ranap' ? '/erm/ews/maternal/ranap/' + textRawat(params, '-') : '/erm/ews/maternal/ralan/' + textRawat(params, '-');
            const ews = $.ajax({
                url: urlEws,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })

            return ews;
        }


        function setEwsMaternal(params, stts) {
            getRegPeriksa(params).done((rawat) => {
                let jk = rawat.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan';
                $('#no_rawat_ews').html(rawat.no_rawat);
                $('#nama_pasien_ews').html(rawat.pasien.nm_pasien);
                $('#umur_ews').html(rawat.umurdaftar + ' ' + rawat.sttsumur + ' / ' + jk);
            });
            getEwsMaternal(params, stts).done(function(response) {
                $('#table-ews tbody').empty()
                $('.td-jam').remove()
                $('.td-tanggal').remove()
                let no = '';
                let j = '';
                tanggal = '';
                html = '';
                style = '';
                let rowspan = '';
                $.map(response, (res) => {
                    $('#kategori-' + res.kategori).empty()

                    rowspan = res.data.length + 1

                    let rowCount = 0;
                    const totalRowsInGroup = res.data.length;
                    $.map(res.data, (data) => {

                        $('.kategori').text(data.kategori);
                        let hasilPemeriksaan = '';
                        rowCount++;
                        if (data.hasil == 'Merah') {
                            style = "style='background-color:red;color:#fff'";
                        } else if (data.hasil == 'Kuning') {
                            style = "style='background-color:yellow;color:#000'";
                        } else {
                            style = "style='background-color:#fff;color:#000'";
                        }


                        // Menentukan class untuk estetika border pengelompokan
                        let groupClass = '';
                        if (rowCount === 1) {
                            groupClass = 'ews-group-start'; // Baris pertama di grup
                        } else if (rowCount === totalRowsInGroup) {
                            groupClass = 'ews-group-end';   // Baris terakhir di grup
                        } else {
                            groupClass = 'ews-group-middle';// Baris tengah
                        }

                        html += '<tr class="ews-' + data.id + ' '+groupClass+'" ' + style + ' id="kategori-' + res.kategori + '">'

                        if (rowCount === 1) {
                            html += '<td style="padding:10px; text-align:center;background-color: #fff !important;" class="criteria-cell">' + res.judul + '</td>'
                        } else {
                            html += '<td style="padding:10px;background-color: #fff !important;" class="criteria-cell-hidden"></td>'
                        }

                        html += '<td style="padding:5px" data-nilai1="' + data.nilai1 + '" data-nilai2="' + data.nilai2 + '" width="10%">' + data.parameter + '</td>'

                        let inputHasil = '';
                        no = 1;
                        $.map(data.hp, (hp) => {
                            if (hp) {
                                inputHasil = '<input type="hidden" value="' + data.hasil + '" class="baris-' + no + ' " name="baris[' + no + '] "/>'
                                html += '<td >' + inputHasil + '<strong>' + hp + '</strong></td>'
                            } else {
                                html += '<td ></td>';
                            }
                            no++;

                        })
                        tanggal = data.tanggal
                            .map((tgl, index) => {
                                const id = index + 1;
                                const jamVal = data.jam[index] ?? '';
                                const sumber = data.sumber[index] ?? '';
                                let btnDelete = '';

                                if(sumber === 'EWS'){
                                    btnDelete = ` <a
                                                    href="javascript:void(0)"
                                                    onclick="deleteEwsRanap('${params}', '${tgl}', '${jamVal}')">
                                                    <i class="bi bi-x text-danger"></i>
                                                </a>`
                                }

                                return `
                                        <td class="td-tanggal" id="tanggal${id}">
                                                <span>${splitTanggal(tgl)}</span>
                                                ${btnDelete}

                                        </td>
                                 `;
                            })
                            .join('');

                        j = data.jam
                            .map((jam, index) => {
                                const id = index + 1;
                                return `
            <td  class="td-jam jam${id}">
                ${jam}
            </td>
        `;
                            })
                            .join('');

                        html += '<td style="padding:5px" class="hasil">' + data.hasil + '</td>'
                        html += '</tr>'

                    })



                })
                $('#table-ews tbody').append(html)
                $('#table-ews tfoot').addClass('d-none')
                $('.tr-jam').append(j)
                $('.tr-tanggal').append(tanggal)
                hitungNilaiEwsMaternal(no)

            })
        }

        function hitungNilaiEwsMaternal(no) {
            $('.hasil-ews').empty();
            const totalCols = Math.max(1, no - 1);

            html = '<tr style="background:#fef08a;color:#0f172a;" id="rowKuning">'
            html += '<th colspan=2>JUMLAH KUNING</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(i, element) {
                    if ($(element).val() == 'Kuning') {
                        total++;
                    }
                });
                const hiStyle = total >= 2 ? 'background:#f59e0b;color:#fff;font-weight:800;' : 'font-weight:700;';
                html += `<td class="kuning-${index}" style="cursor:pointer;text-align:center;${hiStyle}" onclick="tindakanEwsMaternal(${index})" title="Klik untuk melihat peringatan EWS Maternal">${total}</td>`;
            }
            html += '</tr>'

            html += '<tr style="background:#dc2626;color:#fff;" id="rowMerah">'
            html += '<th colspan=2>JUMLAH MERAH</th>'
            for (let index = 1; index < no; index++) {
                let total = 0;
                $('.baris-' + index).each(function(i, element) {
                    if ($(element).val() == 'Merah') {
                        total++;
                    }
                });
                const hiStyle = total >= 1 ? 'background:#991b1b;color:#fff;font-weight:800;' : 'font-weight:700;';
                html += `<td class="merah-${index}" style="cursor:pointer;text-align:center;${hiStyle}" onclick="tindakanEwsMaternal(${index})" title="Klik untuk melihat peringatan EWS Maternal">${total}</td>`;
            }
            html += '</tr>'

            html += '<tr>'
            html += `<th colspan=2>TINDAKAN</th>`
            html += `<td class="tindakan" colspan="${totalCols + 1}" style="padding:10px;"></td>`
            html += '</tr>'

            $('#table-ews tbody').append(html);
            renderEwsMaternalLegend();

            if (no > 1) {
                tindakanEwsMaternal(no - 1);
            } else {
                $('#ewsWarningBanner').addClass('d-none').empty();
                syncEwsHeaderAndTabBadge('', '');
            }
        }

        function tindakanEwsMaternal(index) {
            const merah = parseInt($('.merah-' + index).text(), 10) || 0;
            const kuning = parseInt($('.kuning-' + index).text(), 10) || 0;
            const tglText = $(`#tanggal${index} span`).text().trim() || $(`#tanggal${index}`).text().trim();
            const jamText = $(`.jam${index}`).text().trim();
            const waktuLabel = (tglText || jamText) ? `${tglText} ${jamText}`.trim() : `Pemeriksaan #${index}`;

            $('#table-ews td.ews-col-selected').removeClass('ews-col-selected');
            $(`.kuning-${index}, .merah-${index}`).addClass('ews-col-selected');

            let level = 'safe';
            let icon = 'bi-check-circle-fill';
            let title = 'EWS MATERNAL STABIL — 0 Skor Merah, 0 Skor Kuning';
            let message = 'Lanjutkan monitoring rutin. <strong>Laporkan kepada DPJP</strong> jika mendapatkan <strong>1 Skor Merah</strong> atau <strong>2 Skor Kuning</strong>.';
            let shortBadge = '0M / 0K';
            let tdBg = 'background:#dcfce7;color:#166534;padding:10px;';

            if (merah >= 1 || kuning >= 2) {
                level = 'critical';
                icon = 'bi-exclamation-octagon-fill';
                title = `PERINGATAN MATERNAL — LAPORKAN KEPADA DPJP SEGERA!`;
                message = `Terdeteksi <span class="badge text-bg-danger">${merah} Skor Merah</span> dan <span class="badge text-bg-warning text-dark">${kuning} Skor Kuning</span>. <strong>Laporkan kepada DPJP</strong> karena telah memenuhi kriteria <strong>&ge; 1 Skor Merah atau &ge; 2 Skor Kuning</strong>!`;
                shortBadge = `${merah}M/${kuning}K • Lapor DPJP`;
                tdBg = 'background:#fef2f2;color:#991b1b;padding:10px;border:1px solid #fca5a5;';
            } else if (kuning === 1) {
                level = 'low';
                icon = 'bi-exclamation-triangle-fill';
                title = `WASPADA MATERNAL — Terdapat 1 Skor Kuning`;
                message = `Terdeteksi <span class="badge text-bg-warning text-dark">1 Skor Kuning</span> (0 Merah). Tingkatkan observasi dan <strong>segera laporkan kepada DPJP</strong> apabila bertambah menjadi <strong>2 Skor Kuning</strong> atau muncul <strong>1 Skor Merah</strong>.`;
                shortBadge = '0M / 1K';
                tdBg = 'background:#fefce8;color:#854d0e;padding:10px;border:1px solid #fde047;';
            }

            $('#ewsWarningBanner')
                .removeClass('d-none')
                .html(`
                    <div class="erm-ews-warning-banner is-${level}">
                        <div class="d-flex align-items-start gap-2">
                            <i class="bi ${icon} fs-4 flex-shrink-0 mt-1"></i>
                            <div>
                                <div class="fw-bold" style="font-size:13px;">${title}</div>
                                <div style="font-size:12px;">${message}</div>
                            </div>
                        </div>
                        <div class="text-end flex-shrink-0">
                            <span class="badge text-bg-light border text-dark" style="font-size:10.5px;">
                                <i class="bi bi-clock me-1"></i>${waktuLabel}
                            </span>
                        </div>
                    </div>
                `);

            syncEwsHeaderAndTabBadge(level, shortBadge);

            $('.tindakan')
                .attr('style', tdBg)
                .html(`<i class="bi ${icon} me-1"></i><strong>[${waktuLabel}]</strong> ${message}`);
        }
    </script>
@endpush
