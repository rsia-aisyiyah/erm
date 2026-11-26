<style>
    /* ======================================================
       READABLE & RESPONSIVE CPPT RANAP TABLE (#tbSoap)
       ====================================================== */
    .erm-cppt-toolbar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 12px;
    }

    #tbSoap {
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        width: 100% !important;
        margin-top: 0 !important;
    }

    #tbSoap thead th {
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        border: 1px solid #e2e8f0 !important;
        padding: 8px 10px !important;
        white-space: nowrap;
    }

    #tbSoap tbody tr {
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
        transition: box-shadow 0.15s ease;
    }

    #tbSoap tbody tr:hover {
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.08);
    }

    #tbSoap tbody td {
        vertical-align: top !important;
        border: 1px solid #e2e8f0 !important;
        border-left-width: 0 !important;
        padding: 10px 12px !important;
        background: transparent !important;
    }

    #tbSoap tbody td:first-child {
        border-left-width: 1px !important;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        background: #f8fafc !important;
        width: 56px;
    }

    #tbSoap tbody td:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .erm-cppt-meta-box {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 215px;
    }

    .erm-cppt-time-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 9px;
        border-radius: 8px;
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        color: #1e40af;
        font-size: 11.5px;
        font-weight: 700;
        width: fit-content;
    }

    .erm-ttv-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 5px;
    }

    .erm-ttv-chip {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 4px 7px;
        line-height: 1.25;
    }

    .erm-ttv-chip .ttv-lbl {
        display: block;
        font-size: 9.5px;
        font-weight: 600;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.25px;
    }

    .erm-ttv-chip .ttv-val {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        color: #0f172a;
        word-break: break-word;
    }

    .erm-ttv-chip.is-full {
        grid-column: span 2;
    }

    .erm-ttv-chip.is-alergi-alert {
        background: #fef2f2;
        border-color: #fca5a5;
    }

    .erm-ttv-chip.is-alergi-alert .ttv-lbl,
    .erm-ttv-chip.is-alergi-alert .ttv-val {
        color: #b91c1c;
    }

    .erm-cppt-log-pill {
        background: #f0f9ff;
        border: 1px dashed #7dd3fc;
        color: #0369a1;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 10.5px;
        line-height: 1.35;
        cursor: pointer;
        transition: background 0.15s ease;
    }

    .erm-cppt-log-pill:hover {
        background: #e0f2fe;
    }

    .erm-cppt-note-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
        padding-bottom: 8px;
        margin-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
    }

    .erm-cppt-author {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .erm-cppt-author i {
        color: #2563eb;
    }

    .erm-soap-blocks {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .erm-soap-item {
        display: grid;
        grid-template-columns: 92px 1fr;
        gap: 8px;
        align-items: start;
        padding: 6px 8px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
    }

    .erm-soap-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #334155;
        white-space: nowrap;
    }

    .erm-soap-letter {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 800;
        color: #ffffff;
        flex-shrink: 0;
    }

    .erm-soap-letter.is-s { background: #0284c7; }
    .erm-soap-letter.is-o { background: #059669; }
    .erm-soap-letter.is-a { background: #d97706; }
    .erm-soap-letter.is-p { background: #4f46e5; }
    .erm-soap-letter.is-i { background: #0f766e; }
    .erm-soap-letter.is-d { background: #dc2626; }
    .erm-soap-letter.is-m { background: #7c3aed; }
    .erm-soap-letter.is-e { background: #2563eb; }

    .erm-soap-body {
        font-size: 12.5px;
        line-height: 1.55;
        color: #1e293b;
        word-break: break-word;
    }

    .erm-cppt-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .erm-cppt-actions .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive Card Stack on Mobile / Narrow Tablet (< 768px) */
    @media (max-width: 767.98px) {
        #tbSoap thead {
            display: none;
        }

        #tbSoap,
        #tbSoap tbody,
        #tbSoap tbody tr,
        #tbSoap tbody td {
            display: block !important;
            width: 100% !important;
        }

        #tbSoap tbody tr {
            margin-bottom: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            overflow: hidden;
        }

        #tbSoap tbody td {
            border: 0 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            border-radius: 0 !important;
            padding: 9px 10px !important;
        }

        #tbSoap tbody td:last-child {
            border-bottom: 0 !important;
        }

        .erm-cppt-actions {
            flex-direction: row;
            justify-content: flex-end;
        }

        .erm-cppt-meta-box {
            min-width: 0;
        }

        .erm-soap-item {
            grid-template-columns: 1fr;
            gap: 4px;
        }
    }
</style>

<div class="erm-cppt-toolbar">
    <div class="row g-2 align-items-end">
        <div class="col-12 col-md-5 col-lg-4">
            <label class="form-label mb-1 small fw-semibold text-muted">Rentang Tanggal CPPT</label>
            <div class="input-group input-group-sm">
                <input type="text" class="form-control tanggal tglSoap1_soap" value="{{ date('d-m-Y') }}">
                <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                <input type="text" class="form-control tanggal tglSoap2_soap" value="{{ date('d-m-Y') }}">
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <label for="petugasCppt" class="form-label mb-1 small fw-semibold text-muted">Filter Petugas Medis</label>
            <select name="petugasCppt" id="petugasCppt" class="form-select form-select-sm" style="font-size: 12px">
                <option value="" disabled selected>Pilih Petugas Medis</option>
                <option value="">Semua Petugas</option>
                <option value="1">Dokter</option>
                <option value="2">Petugas Medis Lain</option>
            </select>
        </div>
        <div class="col-12 col-md-3 col-lg-2">
            <button type="button" class="btn btn-success btn-sm w-100" id="cariCppt" onclick="cariSoap()">
                <i class="bi bi-search me-1"></i> Cari SOAP
            </button>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-sm align-top" id="tbSoap" width="100%">
        <thead>
            <tr>
                <th class="text-center">Aksi</th>
                <th>Waktu &amp; TTV / Fisik</th>
                <th>Catatan Perkembangan (CPPT)</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>




@push('script')
    <script>
        const modalLogTracker = $('#modalLogTracker')
        $('.tglSoap1_soap').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
        })

        $('.tglSoap2_soap').datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            autoclose: true,
        })


        function ambilSoap(no_rawat, tgl, jam) {
            getDetailPemeriksaanRanap(no_rawat, tgl, jam).done((response) => {
                formSoapRanap.find('#cekJam').prop('checked', true)
                checkJam()
                formSoapRanap.find('input[name=tgl_perawatan_ubah]').val(splitTanggal(response.tgl_perawatan));
                formSoapRanap.find('input[name=jam_rawat_ubah]').val(response.jam_rawat);
                formSoapRanap.find('input[name=tgl_perawatan]').val(response.tgl_perawatan);
                formSoapRanap.find('input[name=jam_rawat]').val(response.jam_rawat);
                $('#suhu').val(response.suhu_tubuh);
                $('#tinggi').val(response.tinggi);
                $('#berat').val(response.berat);
                $('#tensi').val(response.tensi);
                $('#respirasi').val(response.respirasi);
                $('#nadi').val(response.nadi);
                $('#spo2').val(response.spo2);
                $('#gcs').val(response.gcs);

                $.map(response.grafik_harian, function(grafik) {
                    if (response.tgl_perawatan == grafik.tgl_perawatan && response.jam_rawat == grafik.jam_rawat) {
                        $('#o2').val(grafik.o2);
                    }
                })

                $('#kesadaran select').val(response.kesadaran);
                $('#alergi').val(response.alergi);
                $('#asesmen').val(response.penilaian);
                $('#plan').val(response.rtl);
                $('#instruksi').val(response.instruksi);
                $('#evaluasi').val(response.evaluasi);
                $('#subjek').val(response.keluhan);
                $('#objek').val(response.pemeriksaan);
                $('#reset_soap').append('')

                $('#btn-reset').css('display', 'inline');
                if (response.petugas.nip == "{{ session()->get('pegawai')->nik }}" || response.reg_periksa.kd_dokter == "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->departemen }}" == "CSM" || "{{ session()->get('pegawai')->nik }}" == "direksi") {
                    $('#btn-ubah').css('display', 'inline');
                } else {
                    $('#btn-ubah').css('display', 'none');
                    $('.btn-simpan').css('display', 'inline');
                }
                if (response.petugas.dokter) {
                    if (response.petugas.dokter.kd_sps == 'S0007') {
                        $('#btn-ubah').css('display', 'inline');
                    }
                }
                if (typeof syncModalSoapRanapAlergi === 'function') {
                    syncModalSoapRanapAlergi(response.alergi);
                }
                bootstrap.Tab.getOrCreateInstance(tabSoapRanap).show()
            })
        }

        function tbSoapRanap(no_rawat = '', tglSoap1 = '', tglSoap2 = '', petugas = '') {
            no_rawat_soap = no_rawat;

            var tbSoapRanap = $('#tbSoap').dataTable({
                processing: true,
                paging: false,
                info: false,
                destroy: true,
                autoWidth: false,
                saveState: true,
                ordering: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tglSoap1,
                        'tgl_kedua': tglSoap2,
                        'petugas': petugas,
                    },
                    error: (request) => {
                        if (request.status === 401) {
                            Swal.fire({
                                title: 'Sesi login berakhir !',
                                icon: 'info',
                                text: 'Silahkan login kembali ',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = (window.ERM_BASE_URL || "{{ url('/') }}");
                                }
                            })
                        }
                    },
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.sbar) {
                                return renderBtnActionSbar(row.sbar)
                            }
                            if (row.adime) {
                                return '';
                            }
                            // Tombol & Status Stempel ASO (Automatic Stop Order)
                            const userJbtn = "{{ session()->get('pegawai')->jbtn }}".toLowerCase();
                            const userDep = "{{ session()->get('pegawai')->departemen }}".toLowerCase();
                            const userNik = "{{ session()->get('pegawai')->nik }}".toLowerCase();
                            const userNama = "{{ session()->get('pegawai')->nama }}".toLowerCase();

                            const isUserApoteker = (
                                userJbtn.includes("apoteker") ||
                                userJbtn.includes("farmasi") ||
                                userJbtn.includes("kefarmasian") ||
                                userJbtn.includes("ttk") ||
                                userDep.includes("farmasi") ||
                                userDep === "far" ||
                                userDep === "dpm1" ||
                                userNama.includes("farm") ||
                                userNama.includes("apt") ||
                                userNik === "direksi"
                            );

                            const depStr = typeof row.petugas?.pegawai?.departemen === 'object' ?
                                JSON.stringify(row.petugas?.pegawai?.departemen || '').toLowerCase() :
                                String(row.petugas?.pegawai?.departemen || '').toLowerCase();

                            const jbtnStr = typeof row.petugas?.pegawai?.jbtn === 'object' ?
                                JSON.stringify(row.petugas?.pegawai?.jbtn || '').toLowerCase() :
                                String(row.petugas?.pegawai?.jbtn || '').toLowerCase();

                            const namaPetugasStr = String(row.petugas?.nama || row.petugas?.pegawai?.nama || '').toLowerCase();

                            const isSoapApoteker = (
                                jbtnStr.includes('apoteker') ||
                                jbtnStr.includes('farmasi') ||
                                jbtnStr.includes('kefarmasian') ||
                                jbtnStr.includes('ttk') ||
                                depStr.includes('farmasi') ||
                                depStr.includes('far') ||
                                depStr.includes('dpm1') ||
                                namaPetugasStr.includes('farm') ||
                                namaPetugasStr.includes('apt') ||
                                (row.petugas && ['J018', 'J019', 'J032', 'J067'].includes(row.petugas.kd_jbtn))
                            );

                            let buttonHtml = '<span class="d-none">' + row.tgl_perawatan + ' ' + row.jam_rawat + '</span>';
                            buttonHtml += '<div class="erm-cppt-actions">';

                            // Edit Button (Blue)
                            buttonHtml += `<button type="button" class="btn btn-primary btn-sm" title="Edit SOAP" onclick="ambilSoap('${row.no_rawat}','${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>`;

                            // Delete Button (Red)
                            if (row.nip === "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->nik }}" === "direksi") {
                                buttonHtml += `<button type="button" class="btn btn-danger btn-sm" title="Hapus SOAP" onclick="hapusSoap('${row.no_rawat}','${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                            }

                            // ASO Button (Yellow/Green)
                            if (isSoapApoteker || row.aso) {
                                if (row.aso) {
                                    buttonHtml +=
                                        `<button type="button" class="btn btn-warning btn-sm text-dark position-relative" title="ASO Aktif (Di-stempel oleh ${row.aso.petugas?.nama || row.aso.nip_apoteker} pada ${formatTanggal(row.aso.tgl_aso)}) - Klik untuk batalkan" ${isUserApoteker ? `onclick="batalAso('${row.no_rawat}','${row.tgl_perawatan}','${row.jam_rawat}')"` : 'disabled'}><i class="bi bi-clock-history"></i><span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle"><span class="visually-hidden">Aktif</span></span></button>`;
                                } else if (isUserApoteker) {
                                    buttonHtml += `<button type="button" class="btn btn-outline-warning btn-sm text-dark" title="Stempel Automatic Stop Order (ASO)" onclick="stempelAso('${row.no_rawat}','${row.tgl_perawatan}','${row.jam_rawat}')"><i class="bi bi-clock-history"></i></button>`;
                                }
                            }

                            buttonHtml += '</div>';
                            return buttonHtml;
                        },
                        name: 'tgl_perawatan',
                        width: '56px'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            if (row.sbar) {
                                return renderVerifikasiSbar(row)
                            }

                            if (row.adime) {
                                return renderInfoAdime(row)
                            }

                            let o2Val = '';
                            if (Array.isArray(row.grafik_harian)) {
                                row.grafik_harian.forEach(function(grafik) {
                                    if (row.tgl_perawatan === grafik.tgl_perawatan && row.jam_rawat === grafik.jam_rawat && grafik.o2) {
                                        o2Val = grafik.o2;
                                    }
                                });
                            }

                            const alergiRaw = (row.alergi || '-').toString().trim();
                            const alergiLower = alergiRaw.toLowerCase();
                            const hasAlergi = alergiRaw !== '' && alergiRaw !== '-' && alergiLower !== 'tidak ada' && alergiLower !== 'tidak';

                            let html = `<div class="erm-cppt-meta-box">
                                <div class="erm-cppt-time-pill">
                                    <i class="bi bi-calendar-event"></i>
                                    <span>${formatTanggal(row.tgl_perawatan)} &bull; ${row.jam_rawat}</span>
                                </div>
                                <div class="erm-ttv-grid">
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">Tensi</span><span class="ttv-val">${row.tensi || '-'} <small class="fw-normal text-muted">mmHg</small></span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">Nadi</span><span class="ttv-val">${row.nadi || '-'} <small class="fw-normal text-muted">/mnt</small></span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">Suhu</span><span class="ttv-val">${row.suhu_tubuh || '-'} <small class="fw-normal text-muted">&deg;C</small></span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">SpO2</span><span class="ttv-val">${row.spo2 || '-'} <small class="fw-normal text-muted">%</small></span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">Respirasi</span><span class="ttv-val">${row.respirasi || '-'} <small class="fw-normal text-muted">/mnt</small></span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">GCS</span><span class="ttv-val">${row.gcs || '-'}</span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">TB / BB</span><span class="ttv-val">${row.tinggi || '-'} cm / ${row.berat || '-'} kg</span></div>
                                    <div class="erm-ttv-chip"><span class="ttv-lbl">Kesadaran</span><span class="ttv-val">${row.kesadaran || '-'}</span></div>
                                    ${o2Val ? `<div class="erm-ttv-chip is-full"><span class="ttv-lbl">Oksigen (O2)</span><span class="ttv-val">${o2Val}</span></div>` : ''}
                                    <div class="erm-ttv-chip is-full ${hasAlergi ? 'is-alergi-alert' : ''}">
                                        <span class="ttv-lbl">${hasAlergi ? '<i class="bi bi-exclamation-triangle-fill me-1"></i>' : ''}Alergi</span>
                                        <span class="ttv-val">${alergiRaw}</span>
                                    </div>
                                </div>`;

                            if (Array.isArray(row.log)) {
                                row.log.filter((item) => item.tgl_perawatan === row.tgl_perawatan && item.jam_rawat === row.jam_rawat).map((item) => {
                                    html += `<div class="erm-cppt-log-pill" data-no_rawat="${item.no_rawat}" data-tgl_perawatan="${item.tgl_perawatan}" data-jam_rawat="${item.jam_rawat}" onclick="getTrackerLog('pemeriksaan_ranap',this)" role="button" title="Klik untuk melihat log perubahan">
                                        <i class="bi bi-clock-history me-1"></i>Di${item.aksi.toLowerCase()} oleh <strong>${item.pegawai?.nama ?? '-'}</strong> &bull; ${formatTanggal(item.waktu)}
                                    </div>`;
                                });
                            }

                            html += '</div>';
                            return html;
                        },
                        name: 'ttv',
                        width: '250px'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            if (row.sbar !== null) {
                                return renderSbar(row)
                            }

                            if (row.adime !== null) {
                                return renderAdime(row)
                            }

                            const namaPetugas = row.petugas?.nama ?? '-';
                            let asoBanner = '';
                            if (row.aso) {
                                asoBanner = `<div class="alert alert-warning py-1.5 px-2.5 mb-2 border-warning border rounded-2" style="font-size:11.5px;">
                                    <i class="bi bi-clock-history me-1 text-danger"></i>
                                    <strong>AUTOMATIC STOP ORDER (ASO)</strong> &bull; Distempel oleh <b>${row.aso.petugas?.nama || row.aso.nip_apoteker}</b> pada <b>${formatTanggal(row.aso.tgl_aso)}</b>
                                    ${row.aso.catatan_aso ? `<div class="fst-italic text-dark mt-1">Catatan: "${row.aso.catatan_aso}"</div>` : ''}
                                </div>`;
                            }

                            return `
                                <div class="erm-cppt-note-header">
                                    <div class="erm-cppt-author">
                                        <i class="bi bi-person-circle fs-6"></i>
                                        <span>${namaPetugas}</span>
                                    </div>
                                    <span class="badge text-bg-primary bg-opacity-10 text-primary border border-primary-subtle" style="font-size:10px;">CPPT SOAP</span>
                                </div>
                                ${asoBanner}
                                <div class="erm-soap-blocks">
                                    <div class="erm-soap-item">
                                        <div class="erm-soap-tag"><span class="erm-soap-letter is-s">S</span>Subjek</div>
                                        <div class="erm-soap-body">${stringPemeriksaan(row.keluhan)}</div>
                                    </div>
                                    <div class="erm-soap-item">
                                        <div class="erm-soap-tag"><span class="erm-soap-letter is-o">O</span>Objek</div>
                                        <div class="erm-soap-body">${stringPemeriksaan(row.pemeriksaan)}</div>
                                    </div>
                                    <div class="erm-soap-item">
                                        <div class="erm-soap-tag"><span class="erm-soap-letter is-a">A</span>Asesmen</div>
                                        <div class="erm-soap-body">${stringPemeriksaan(row.penilaian)}</div>
                                    </div>
                                    <div class="erm-soap-item">
                                        <div class="erm-soap-tag"><span class="erm-soap-letter is-p">P</span>Plan</div>
                                        <div class="erm-soap-body">${stringPemeriksaan(row.rtl)}</div>
                                    </div>
                                </div>
                            `;
                        },
                        name: 'soap',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data  data pemeriksaan",
                    "infoEmpty": "Tidak ada data data pemeriksaan",
                    "search": "Pencarian",
                },
            });
        }


        function getTrackerLog(...args) {

            $.ajax({
                url: '/erm/log/track', // ganti dengan route kamu
                method: 'GET',
                data: {
                    keywords: args // otomatis jadi keywords[]=...
                },
                success: function(res) {
                    console.log("RESULT:", res);
                    modalLogTracker.modal('show')
                },
                error: function(err) {
                    console.error("ERROR:", err);
                }
            });
        }

        function hapusSoap(no, tgl, jam) {
            Swal.fire({
                title: 'Yakin ?',
                text: "Data yang dihapus tidak dapat dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus saja!',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'soap/hapus',
                        data: {
                            'no_rawat': no,
                            'tgl_perawatan': tgl,
                            'jam_rawat': jam,
                        },
                        method: 'DELETE',
                        success: function(response) {
                            if (response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'BERHASIL !',
                                    text: 'Data Berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                tbSoapRanap(no);
                                if (typeof grafikPemeriksaan !== 'undefined' && grafikPemeriksaan) {
                                    grafikPemeriksaan.destroy();
                                }
                                buildGrafik(no)
                                setEws(no, 'ranap', formSoapRanap.find('input[name=spesialis]').val())
                            }
                        }
                    })

                }
            })

        }

        function cariSoap() {
            const tglSoap1 = splitTanggal($('.tglSoap1_soap').val());
            const tglSoap2 = splitTanggal($('.tglSoap2_soap').val());
            const petugas = $('#petugasCppt').val();
            tbSoapRanap(no_rawat_soap, tglSoap1, tglSoap2, petugas);
        }

        function verifikasiSoap(no_rawat, tgl, jam) {
            $('.modal').modal('hide');

            Swal.fire({
                title: 'Verifikasi Pemeriksaan',
                text: 'Yakin ingin memverifikasi hasil pemeriksaan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Verifikasi',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),

                preConfirm: async () => {
                    try {
                        const response = await $.ajax({
                            url: '/erm/soap/verifikasi',
                            method: 'POST',
                            dataType: 'JSON',
                            data: {
                                _token: "{{ csrf_token() }}",
                                no_rawat: no_rawat,
                                tgl_perawatan: tgl,
                                jam_rawat: jam
                            }
                        });

                        return response;
                    } catch (error) {
                        Swal.showValidationMessage(
                            error.responseJSON?.message ?? 'Verifikasi gagal'
                        );
                        return false;
                    }
                }

            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Berhasil',
                        text: 'Hasil pemeriksaan telah diverifikasi',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }

                tbSoapRanap(no_rawat);
                showModalSoapRanap(no_rawat);

                const triggerEl = document.querySelector(
                    'button[data-bs-target="#tab-tabel-pane"]'
                );

                if (triggerEl) {
                    const tab = new bootstrap.Tab(triggerEl);
                    tab.show();
                }
            });
        }

        function renderVerifikasiSbar(data) {
            const kdDokter = "{{ session()->get('pegawai')->nik }}";
            const isDokterKonsul = data.sbar.dokter_konsul ?
                data.sbar.dokter_konsul.dokter :
                formInfoPasien.find('input[name=kd_dokter_dpjp]').val();

            let btn = '';
            let isVerified = '';
            let qrDiv = '';

            // validasi status verifikasi
            const verified = !!data.verifikasi;
            const isConfirmed = !!data.sbar.konfirmasi;

            const dokterKonsulNama = data.sbar.dokter_konsul
                ? (data.sbar?.dokter_konsul?.dokter_sbar?.nm_dokter || '-')
                : formInfoPasien.find('input[name=dokter_dpjp]').val();

            tulba = `<div class="alert alert-success py-1.5 px-2 mb-0" role="alert" style="font-size:10.5px;line-height:1.35;">
                <i class="bi bi-check-circle-fill me-1"></i>Ditulis &amp; dibaca oleh <strong>${data.petugas?.nama ?? '-'}</strong><br>
                <span class="text-muted">${formatTanggal(data.tgl_perawatan)} ${data.jam_rawat}</span>
            </div>`;

            let konfirmasi = isConfirmed
                ? `<div class="alert alert-success py-1.5 px-2 mb-0" role="alert" style="font-size:10.5px;line-height:1.35;">
                    <i class="bi bi-check2-all me-1"></i>Terkonfirmasi oleh <strong>${data.petugas?.nama ?? '-'}</strong><br>
                    <span class="text-muted">${formatTanggal(data.sbar.konfirmasi.tgl_konfirmasi)} ${data.sbar.konfirmasi.jam_konfirmasi}</span>
                </div>`
                : '';

            if (verified) {
                const qrData =
                    `Telah diverifikasi oleh ${data.verifikasi.petugas.nama} pada ${formatTanggal(data.verifikasi.tgl_verif)} ${data.verifikasi.jam_verif}`;
                const qrId = `qr-${data.no_rawat}-${data.tgl_perawatan}-${data.jam_rawat}`;

                qrDiv = `
                    <div class="d-flex align-items-center gap-2 p-2 bg-light border rounded-2 mt-1">
                        <div id="${qrId}" class="flex-shrink-0"></div>
                        <div style="font-size:10.5px;line-height:1.35;">
                            <div class="badge text-bg-success mb-1">Terverifikasi Dokter</div>
                            <div class="fw-bold text-dark">${data.verifikasi.petugas.nama}</div>
                            <div class="text-muted">${data.verifikasi.tgl_verif} ${data.verifikasi.jam_verif}</div>
                        </div>
                    </div>
                `;
                setTimeout(() => {
                    const qrElement = document.getElementById(qrId);
                    if (qrElement) {
                        qrElement.innerHTML = '';
                        new QRCode(qrElement, {
                            text: qrData,
                            width: 72,
                            height: 72
                        });
                    }
                }, 500);
            } else {
                if (kdDokter === isDokterKonsul) {
                    btn = `<button type="button" class="btn btn-sm btn-warning w-100 fw-semibold" onclick="verifikasiSoap('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')">
                        <i class="bi bi-patch-check me-1"></i> Verifikasi SBAR
                    </button>`;
                }

                isVerified = `<div class="alert alert-warning py-1.5 px-2 mb-0" role="alert" style="font-size:10.5px;">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Belum verifikasi Dokter
                </div>`;
            }

            return `
                <div class="erm-cppt-meta-box">
                    <div class="erm-cppt-time-pill" style="background:#f5f3ff;border-color:#ddd6fe;color:#6d28d9;">
                        <i class="bi bi-chat-left-text"></i>
                        <span>${formatTanggal(data.tgl_perawatan)} &bull; ${data.jam_rawat}</span>
                    </div>
                    <div class="erm-ttv-chip is-full">
                        <span class="ttv-lbl">Konsul Ke</span>
                        <span class="ttv-val">${dokterKonsulNama}</span>
                    </div>
                    ${btn}
                    ${isVerified}
                    ${tulba}
                    ${konfirmasi}
                    ${qrDiv}
                </div>
            `;
        }


        function renderBarcodeSbar(data) {
            setTimeout(() => {
                JsBarcode(`.barcode[data-id="${data.no_rawat}"][data-tgl="${data.tgl_perawatan}"][data-jam="${data.jam_rawat}"]`, 'wkwkwkw', {
                    displayValue: false
                });
            }, 1000)
            return '';
        }

        function renderSbar(data) {
            const isPetugas = data.sbar.pegawai.nik === "{{ session()->get('pegawai')->nik }}";
            const isConfirmed = data.sbar.konfirmasi !== null;

            const btnKonfirm = (isPetugas && !isConfirmed)
                ? `<button type="button" class="btn btn-warning btn-sm py-0 px-2" style="font-size:11px;" onclick="konfirmasiSbar('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')">
                    <i class="bi bi-check2-circle me-1"></i>Konfirmasi
                </button>`
                : '';

            const content = `
                <div class="erm-cppt-note-header">
                    <div class="erm-cppt-author">
                        <i class="bi bi-person-circle fs-6" style="color:#7c3aed;"></i>
                        <span>${stringPemeriksaan(data.sbar.pegawai.nama)}</span>
                        ${btnKonfirm}
                    </div>
                    <span class="badge border" style="font-size:10px;background:#f5f3ff;color:#6d28d9;border-color:#ddd6fe !important;">SBAR</span>
                </div>
                <div class="erm-soap-blocks">
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-s">S</span>Situation</div>
                        <div class="erm-soap-body">${stringPemeriksaan(data.keluhan)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-o">B</span>Background</div>
                        <div class="erm-soap-body">${stringPemeriksaan(data.pemeriksaan)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-a">A</span>Assessment</div>
                        <div class="erm-soap-body">${stringPemeriksaan(data.penilaian)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-p">R</span>Recommend</div>
                        <div class="erm-soap-body">${stringPemeriksaan(data.rtl)}</div>
                    </div>
                </div>
            `;

            return renderTextWithStempel(content, isConfirmed);
        }

        function renderAdime(row) {
            return `
                <div class="erm-cppt-note-header">
                    <div class="erm-cppt-author">
                        <i class="bi bi-clipboard2-check fs-6 text-warning"></i>
                        <span>${row.petugas?.nama ?? 'Ahli Gizi'}</span>
                    </div>
                    <span class="badge text-bg-warning text-dark" style="font-size:10px;">ADIME GIZI</span>
                </div>
                <div class="erm-soap-blocks">
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-a">A</span>Asesmen</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.keluhan)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-d">D</span>Diagnosis</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.pemeriksaan)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-i">I</span>Intervensi</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.penilaian)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-m">M</span>Monitoring</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.rtl)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-e">E</span>Evaluasi</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.evaluasi)}</div>
                    </div>
                    <div class="erm-soap-item">
                        <div class="erm-soap-tag"><span class="erm-soap-letter is-p">In</span>Instruksi</div>
                        <div class="erm-soap-body">${stringPemeriksaan(row.instruksi)}</div>
                    </div>
                </div>
            `;
        }

        function renderInfoAdime(row) {
            return `
                <div class="erm-cppt-meta-box">
                    <div class="erm-cppt-time-pill" style="background:#fffbeb;border-color:#fde68a;color:#b45309;">
                        <i class="bi bi-calendar-event"></i>
                        <span>${formatTanggal(row.tgl_perawatan)} &bull; ${row.jam_rawat}</span>
                    </div>
                    <div class="erm-ttv-chip is-full">
                        <span class="ttv-lbl">Petugas Gizi</span>
                        <span class="ttv-val">${row.petugas?.nama ?? '-'}</span>
                    </div>
                </div>
            `;
        }



        function renderBtnActionSbar(data) {
            const kdPetugas = "{{ session()->get('pegawai')->nik }}";
            const petugas = data?.nip;

            if (kdPetugas === petugas) {
                return `<span class="d-none">${data.tgl_perawatan} ${data.jam_rawat}</span>
                    <div class="erm-cppt-actions">
                        <button type="button" class="btn btn-sm btn-primary" title="Edit SBAR" onclick="getSbar('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" title="Hapus SBAR" onclick="deleteSbar('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>
                    </div>`;
            }

            return '';
        }

        function deleteSbar(no_rawat, tgl_perawatan, jam_rawat) {
            Swal.fire({
                title: 'Konfirmasi',
                text: "Data SBAR akan dihapus ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(`${url}/ranap/sbar/delete`, {
                        no_rawat: no_rawat,
                        tgl_perawatan: tgl_perawatan,
                        jam_rawat: jam_rawat,
                        _token: '{{ csrf_token() }}',
                    }).done((response) => {
                        alertSuccessAjax('Data SBAR berhasil dihapus')
                        tbSoapRanap(no_rawat);
                    }).fail((error) => {
                        alertErrorAjax(error)
                    })
                }
            })


        }

        function getSbar(no_rawat, tgl_perawatan, jam) {
            btnTabSbar.trigger('click');
            getDetailPemeriksaanRanap(no_rawat, tgl_perawatan, jam).done((response) => {


                btnSimpanSbar.addClass('d-none');
                btnUbahSbar.removeClass('d-none');
                btnBatalSbar.removeClass('d-none');

                formSbarRanap.find('input[name=no_rawat]').val(response.no_rawat);
                formSbarRanap.find('input[name=tgl_perawatan]').val(`${splitTanggal(response.tgl_perawatan)} ${response.jam_rawat} `);

                formSbarRanap.find('input[name=jam_rawat_awal]').val(response.jam_rawat);
                formSbarRanap.find('input[name=tgl_perawatan_awal]').val(response.tgl_perawatan);

                formSbarRanap.find('input[name=jam_rawat]').val(response.jam_rawat);
                formSbarRanap.find('input[name=petugas]').val(response.petugas.nip);
                formSbarRanap.find('input[name=nm_petugas]').attr(response.petugas.nama);
                formSbarRanap.find('textarea[name=keluhan]').val(response.keluhan);
                formSbarRanap.find('textarea[name=pemeriksaan]').val(response.pemeriksaan);
                formSbarRanap.find('textarea[name=penilaian]').val(response.penilaian);
                formSbarRanap.find('textarea[name=rtl]').val(response.rtl);

                const dokter = new Option(response.sbar.dokter_konsul.dokter_sbar.nm_dokter, response.sbar.dokter_konsul.dokter_sbar.kd_dokter, true, true);
                dokterSbar.append(dokter).trigger('change');

            });
        }

        function konfirmasiSbar(no_rawat, tgl_perawatan, jam_rawat) {
            $.post(`${url}/ranap/konfirmasi-sbar`, {
                no_rawat: no_rawat,
                tgl_perawatan: tgl_perawatan,
                jam_rawat: jam_rawat,
            }).done((response) => {
                tbSoapRanap(no_rawat);

            }).fail((error) => {
                console.error("ERROR ===", error);
            })
        }

        function getDetailPemeriksaanRanap(no_rawat, tgl, jam) {
            const pemeriksaan = $.ajax({
                url: '/erm/soap/ambil',
                data: {
                    'no_rawat': no_rawat,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return pemeriksaan;
        }

        function stempelAso(no_rawat, tgl, jam) {
            const containerTarget = document.querySelector('.modal.show') || document.getElementById('modalSoapRanap') || 'body';
            Swal.fire({
                target: containerTarget,
                title: 'Stempel Automatic Stop Order (ASO)',
                text: 'Apakah Anda yakin ingin membubuhi Stempel ASO pada catatan SOAP ini?',
                icon: 'question',
                input: 'text',
                inputPlaceholder: 'Catatan ASO (opsional, misal: Stop Antibiotik hari ke-7)',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="bi bi-clock-history"></i> Ya, Stempel ASO',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                didOpen: () => {
                    setTimeout(() => {
                        const input = Swal.getInput();
                        if (input) {
                            input.focus();
                        }
                    }, 100);
                },
                preConfirm: (catatan) => {
                    return $.ajax({
                        url: `${url}/soap/aso/simpan`,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat,
                            tgl_perawatan: tgl,
                            jam_rawat: jam,
                            catatan_aso: catatan
                        }
                    }).catch(error => {
                        Swal.showValidationMessage(error.responseJSON?.message || 'Gagal menyimpan stempel ASO');
                    });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    alertSuccessAjax('Stempel ASO berhasil diposting');
                    tbSoapRanap(no_rawat);
                }
            });
        }

        function batalAso(no_rawat, tgl, jam) {
            const containerTarget = document.querySelector('.modal.show') || document.getElementById('modalSoapRanap') || 'body';
            Swal.fire({
                target: containerTarget,
                title: 'Batalkan Stempel ASO?',
                text: 'Stempel Automatic Stop Order pada catatan SOAP ini akan dihapus.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Batalkan Stempel',
                cancelButtonText: 'Batal',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    return $.ajax({
                        url: `${url}/soap/aso/hapus`,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat,
                            tgl_perawatan: tgl,
                            jam_rawat: jam
                        }
                    }).catch(error => {
                        Swal.showValidationMessage(error.responseJSON?.message || 'Gagal membatalkan stempel ASO');
                    });
                }
            }).then((result) => {
                if (result.isConfirmed && result.value) {
                    alertSuccessAjax('Stempel ASO berhasil dibatalkan');
                    tbSoapRanap(no_rawat);
                }
            });
        }
    </script>
@endpush
