<style>
    /* ======================================================
       READABLE & RESPONSIVE PEMERIKSAAN UGD TABLE (#tbSoapUgd)
       ====================================================== */
    #tbSoapUgd {
        border-collapse: separate !important;
        border-spacing: 0 8px !important;
        width: 100% !important;
        margin-top: 0 !important;
    }

    #tbSoapUgd thead th {
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

    #tbSoapUgd tbody tr {
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
        transition: box-shadow 0.15s ease;
    }

    #tbSoapUgd tbody tr:hover {
        box-shadow: 0 3px 10px rgba(13, 148, 136, 0.09);
    }

    #tbSoapUgd tbody td {
        vertical-align: top !important;
        border: 1px solid #e2e8f0 !important;
        border-left-width: 0 !important;
        padding: 10px 12px !important;
        background: transparent !important;
    }

    #tbSoapUgd tbody td:first-child {
        border-left-width: 1px !important;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        background: #f8fafc !important;
        width: 56px;
    }

    #tbSoapUgd tbody td:last-child {
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .erm-ugd-meta-box {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 215px;
    }

    .erm-ugd-time-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 9px;
        border-radius: 8px;
        background: #f0fdfa;
        border: 1px solid #99f6e4;
        color: #0f766e;
        font-size: 11.5px;
        font-weight: 700;
        width: fit-content;
    }

    .erm-ugd-ttv-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 5px;
    }

    .erm-ugd-ttv-chip {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        padding: 4px 7px;
        line-height: 1.25;
    }

    .erm-ugd-ttv-chip .ttv-lbl {
        display: block;
        font-size: 9.5px;
        font-weight: 600;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.25px;
    }

    .erm-ugd-ttv-chip .ttv-val {
        display: block;
        font-size: 11.5px;
        font-weight: 700;
        color: #0f172a;
        word-break: break-word;
    }

    .erm-ugd-ttv-chip.is-full {
        grid-column: span 2;
    }

    .erm-ugd-ttv-chip.is-alergi-alert {
        background: #fef2f2;
        border-color: #fca5a5;
    }

    .erm-ugd-ttv-chip.is-alergi-alert .ttv-lbl,
    .erm-ugd-ttv-chip.is-alergi-alert .ttv-val {
        color: #b91c1c;
    }

    .erm-ugd-log-pill {
        background: #f0f9ff;
        border: 1px dashed #7dd3fc;
        color: #0369a1;
        border-radius: 7px;
        padding: 5px 8px;
        font-size: 10.5px;
        line-height: 1.35;
    }

    .erm-ugd-note-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px;
        padding-bottom: 8px;
        margin-bottom: 8px;
        border-bottom: 1px dashed #e2e8f0;
    }

    .erm-ugd-author {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        font-weight: 700;
        color: #0f172a;
    }

    .erm-ugd-author i {
        color: #0d9488;
    }

    .erm-ugd-soap-blocks {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .erm-ugd-soap-item {
        display: grid;
        grid-template-columns: 92px 1fr;
        gap: 8px;
        align-items: start;
        padding: 6px 8px;
        border-radius: 8px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
    }

    .erm-ugd-soap-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 700;
        color: #334155;
        white-space: nowrap;
    }

    .erm-ugd-letter {
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

    .erm-ugd-letter.is-s { background: #0284c7; }
    .erm-ugd-letter.is-o { background: #059669; }
    .erm-ugd-letter.is-a { background: #d97706; }
    .erm-ugd-letter.is-p { background: #4f46e5; }
    .erm-ugd-letter.is-i { background: #0f766e; }

    .erm-ugd-soap-body {
        font-size: 12.5px;
        line-height: 1.55;
        color: #1e293b;
        word-break: break-word;
    }

    .erm-ugd-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
    }

    .erm-ugd-actions .btn {
        width: 32px;
        height: 32px;
        padding: 0;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    @media (max-width: 767.98px) {
        #tbSoapUgd thead {
            display: none;
        }

        #tbSoapUgd,
        #tbSoapUgd tbody,
        #tbSoapUgd tbody tr,
        #tbSoapUgd tbody td {
            display: block !important;
            width: 100% !important;
        }

        #tbSoapUgd tbody tr {
            margin-bottom: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            overflow: hidden;
        }

        #tbSoapUgd tbody td {
            border: 0 !important;
            border-bottom: 1px solid #e2e8f0 !important;
            border-radius: 0 !important;
            padding: 9px 10px !important;
        }

        #tbSoapUgd tbody td:last-child {
            border-bottom: 0 !important;
        }

        .erm-ugd-actions {
            flex-direction: row;
            justify-content: flex-end;
        }

        .erm-ugd-meta-box {
            min-width: 0;
        }

        .erm-ugd-soap-item {
            grid-template-columns: 1fr;
            gap: 4px;
        }
    }
</style>

<div class="table-responsive">
    <table class="table table-sm align-top" id="tbSoapUgd" width="100%">
        <thead>
            <tr role="row">
                <th class="text-center" width="56px">Aksi</th>
                <th width="250px">Waktu &amp; TTV / Fisik</th>
                <th>Catatan Pemeriksaan UGD (CPPT)</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

@push('script')
    <script>
        const tabPemeriksaanRanap = $('button[data-bs-target="#tabPemeriksaanUgd-pane"]')

        tabPemeriksaanRanap.on('shown.bs.tab', function () {
            const no_rawat = formInfoPasien.find('input[name="no_rawat"]').val();
            tbSoapUgd(no_rawat);
        })

        function tbSoapUgd(noRawat) {
            $('#tbSoapUgd').DataTable({
                processing: true,
                scrollX: false,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                searching: false,
                destroy: true,
                autoWidth: false,
                ajax: {
                    url: '/erm/ugd/soap/table',
                    data: {
                        no_rawat: noRawat
                    },
                    error: (request) => {
                        if (request.status == 401) {
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
                    width: '56px',
                    render: (data, type, row, meta) => {
                        let button = '<div class="erm-ugd-actions">';
                        button += `<button type="button" class="btn btn-primary btn-sm" title="Edit Pemeriksaan UGD" onclick="ambilSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-pencil-square"></i></button>`;
                        if (row.nip == "{{ session()->get('pegawai')->nik }}") {
                            button += `<button type="button" class="btn btn-danger btn-sm" title="Hapus Pemeriksaan UGD" onclick="hapusSoapRalan('${row.no_rawat}', '${row.tgl_perawatan}', '${row.jam_rawat}')"><i class="bi bi-trash3-fill"></i></button>`;
                        }
                        button += '</div>';
                        return button;
                    },
                },
                {
                    data: null,
                    width: '250px',
                    render: (data, type, row, meta) => {
                        let o2Val = '';
                        if (Array.isArray(row.grafik_harian)) {
                            row.grafik_harian.forEach(function (grafik) {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat && grafik.o2) {
                                    o2Val = grafik.o2;
                                }
                            });
                        }
                        if (!o2Val && Array.isArray(row.grafik)) {
                            row.grafik.forEach(function (grafik) {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat && grafik.o2) {
                                    o2Val = `${grafik.o2} /mnt`;
                                }
                            });
                        }

                        const alergiRaw = (row.alergi || '-').toString().trim();
                        const alergiLower = alergiRaw.toLowerCase();
                        const hasAlergi = alergiRaw !== '' && alergiRaw !== '-' && alergiLower !== 'tidak ada' && alergiLower !== 'tidak';

                        let html = `<div class="erm-ugd-meta-box">
                            <div class="erm-ugd-time-pill">
                                <i class="bi bi-calendar-event"></i>
                                <span>${formatTanggal(row.tgl_perawatan)} &bull; ${row.jam_rawat}</span>
                            </div>
                            <div class="erm-ugd-ttv-grid">
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">Tensi</span><span class="ttv-val">${row.tensi || '-'} <small class="fw-normal text-muted">mmHg</small></span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">Nadi</span><span class="ttv-val">${row.nadi || '-'} <small class="fw-normal text-muted">/mnt</small></span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">Suhu</span><span class="ttv-val">${row.suhu_tubuh || '-'} <small class="fw-normal text-muted">&deg;C</small></span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">SpO2</span><span class="ttv-val">${row.spo2 || '-'} <small class="fw-normal text-muted">%</small></span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">Respirasi</span><span class="ttv-val">${row.respirasi || '-'} <small class="fw-normal text-muted">/mnt</small></span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">GCS</span><span class="ttv-val">${row.gcs || '-'}</span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">TB / BB</span><span class="ttv-val">${row.tinggi || '-'} cm / ${row.berat || '-'} kg</span></div>
                                <div class="erm-ugd-ttv-chip"><span class="ttv-lbl">Kesadaran</span><span class="ttv-val">${row.kesadaran || '-'}</span></div>
                                ${o2Val ? `<div class="erm-ugd-ttv-chip is-full"><span class="ttv-lbl">Oksigen (O2)</span><span class="ttv-val">${o2Val}</span></div>` : ''}
                                <div class="erm-ugd-ttv-chip is-full ${hasAlergi ? 'is-alergi-alert' : ''}">
                                    <span class="ttv-lbl">${hasAlergi ? '<i class="bi bi-exclamation-triangle-fill me-1"></i>' : ''}Alergi</span>
                                    <span class="ttv-val">${alergiRaw}</span>
                                </div>
                            </div>`;

                        if (Array.isArray(row.log)) {
                            row.log.forEach(function (log) {
                                if (row.tgl_perawatan === log.tgl_perawatan && row.jam_rawat === log.jam_rawat) {
                                    html += `<div class="erm-ugd-log-pill">
                                        <i class="bi bi-clock-history me-1"></i>Di${log.aksi.toLowerCase()} oleh <strong>${log.pegawai?.nama ?? '-'}</strong> &bull; ${formatTanggal(log.waktu)}
                                    </div>`;
                                }
                            });
                        }

                        html += '</div>';
                        return html;
                    }
                },
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        const namaPetugas = row.pegawai?.nama ?? '-';
                        const instruksiText = (row.instruksi || '').toString().trim();
                        const hasInstruksi = instruksiText !== '' && instruksiText !== '-';

                        return `
                            <div class="erm-ugd-note-header">
                                <div class="erm-ugd-author">
                                    <i class="bi bi-person-circle fs-6"></i>
                                    <span>${namaPetugas}</span>
                                </div>
                                <span class="badge border" style="font-size:10px;background:#f0fdfa;color:#0f766e;border-color:#99f6e4 !important;">CPPT UGD</span>
                            </div>
                            <div class="erm-ugd-soap-blocks">
                                <div class="erm-ugd-soap-item">
                                    <div class="erm-ugd-soap-tag"><span class="erm-ugd-letter is-s">S</span>Subjek</div>
                                    <div class="erm-ugd-soap-body">${stringPemeriksaan(row.keluhan)}</div>
                                </div>
                                <div class="erm-ugd-soap-item">
                                    <div class="erm-ugd-soap-tag"><span class="erm-ugd-letter is-o">O</span>Objek</div>
                                    <div class="erm-ugd-soap-body">${stringPemeriksaan(row.pemeriksaan)}</div>
                                </div>
                                <div class="erm-ugd-soap-item">
                                    <div class="erm-ugd-soap-tag"><span class="erm-ugd-letter is-a">A</span>Asesmen</div>
                                    <div class="erm-ugd-soap-body">${stringPemeriksaan(row.penilaian)}</div>
                                </div>
                                <div class="erm-ugd-soap-item">
                                    <div class="erm-ugd-soap-tag"><span class="erm-ugd-letter is-p">P</span>Plan</div>
                                    <div class="erm-ugd-soap-body">${stringPemeriksaan(row.rtl)}</div>
                                </div>
                                ${hasInstruksi ? `
                                    <div class="erm-ugd-soap-item">
                                        <div class="erm-ugd-soap-tag"><span class="erm-ugd-letter is-i">I</span>Instruksi</div>
                                        <div class="erm-ugd-soap-body">${stringPemeriksaan(row.instruksi)}</div>
                                    </div>
                                ` : ''}
                            </div>
                        `;
                    },
                    name: 'soap',
                }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pemeriksaan UGD",
                    "infoEmpty": "Tidak ada data pemeriksaan UGD",
                }
            });
        }
    </script>
@endpush