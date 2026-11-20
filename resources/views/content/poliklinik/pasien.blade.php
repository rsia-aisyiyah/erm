@extends('index')

@section('contents')
    <style>
        /* ======================================
                           QUEUE SUMMARY - MODERN DASHBOARD
                        ====================================== */

        .queue-summary {
            width: 100%;
            margin-bottom: 16px;
            font-family: inherit;
        }

        .queue-summary-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .queue-summary-title {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        .queue-summary-title i {
            font-size: 17px;
            color: #64748b;
        }

        .queue-summary-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748b;
            font-size: 11px;
            font-weight: 500;
        }

        .queue-summary-status span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22c55e;
        }

        /* Grid */
        .queue-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        /* Card */
        .queue-stat {
            min-width: 0;
            padding: 14px 16px;
            border: 1px solid var(--stat-border);
            border-radius: 10px;
            background: var(--stat-bg);
            transition: border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .queue-stat:hover {
            border-color: var(--stat-color);
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
        }

        /* Color variants */
        .stat-primary {
            --stat-color: #2563eb;
            --stat-bg: #eff6ff;
            --stat-border: #dbeafe;
        }

        .stat-success {
            --stat-color: #16a34a;
            --stat-bg: #f0fdf4;
            --stat-border: #dcfce7;
        }

        .stat-warning {
            --stat-color: #d97706;
            --stat-bg: #fffbeb;
            --stat-border: #fef3c7;
        }

        .stat-danger {
            --stat-color: #dc2626;
            --stat-bg: #fef2f2;
            --stat-border: #fee2e2;
        }

        /* Card header */
        .queue-stat-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .queue-stat-label {
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        /* Icon */
        .queue-stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.8);
            color: var(--stat-color);
            font-size: 16px;
        }

        /* Number */
        .queue-stat-value {
            margin-top: 8px;
            color: var(--stat-color);
            font-size: 27px;
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.8px;
            font-variant-numeric: tabular-nums;
        }

        .queue-stat-desc {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 400;
        }

        /* Tablet */
        @media (max-width: 991.98px) {
            .queue-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
            }
        }

        /* Mobile */
        @media (max-width: 575.98px) {
            .queue-summary-header {
                margin-bottom: 10px;
            }

            .queue-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .queue-stat {
                padding: 12px;
                border-radius: 8px;
            }

            .queue-stat-value {
                font-size: 24px;
            }

            .queue-stat-label {
                font-size: 11px;
            }

            .queue-stat-desc {
                font-size: 10px;
            }

            .queue-stat-icon {
                width: 28px;
                height: 28px;
                font-size: 14px;
            }
        }

        /* Very small screen */
        @media (max-width: 360px) {
            .queue-stat {
                padding: 10px;
            }

            .queue-stat-value {
                font-size: 21px;
            }
        }

        /* ==========================================
               MODERN QUEUE MANAGEMENT
               Bootstrap 5 | Tailwind Inspired
            ========================================== */

        :root {
            --queue-primary: #2563eb;
            --queue-primary-soft: #eff6ff;
            --queue-text: #1e293b;
            --queue-muted: #64748b;
            --queue-border: #e2e8f0;
            --queue-bg: #f8fafc;
            --queue-radius: 10px;
        }

        /* MAIN CARD */
        .queue-main-card {
            border: 1px solid var(--queue-border);
            border-radius: var(--queue-radius);
            background: #fff;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .04);
        }

        .queue-main-card>.card-body {
            padding: 20px;
        }

        /* ==========================================
               HEADER
            ========================================== */

        .queue-page-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-bottom: 18px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--queue-border);
        }

        .queue-header-icon {
            width: 52px;
            height: 52px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--queue-primary-soft);
            color: var(--queue-primary);
            font-size: 25px;
        }

        .queue-header-content {
            min-width: 0;
        }

        .queue-header-label {
            color: var(--queue-muted);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 3px;
        }

        .queue-header-title {
            color: var(--queue-text);
            font-size: 19px;
            font-weight: 700;
            margin: 0;
            line-height: 1.4;
        }

        .queue-doctor-info {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            padding: 4px 10px;
            border-radius: 5px;
            background: #f1f5f9;
            color: #475569;
            font-size: 12px;
            font-weight: 500;
        }

        /* ==========================================
               SECTION HEADING
            ========================================== */

        .queue-section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .queue-section-heading>div {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--queue-text);
            font-size: 13px;
            font-weight: 700;
        }

        .queue-section-heading>div i {
            color: var(--queue-primary);
            font-size: 16px;
        }

        .queue-section-heading>span {
            color: #94a3b8;
            font-size: 11px;
        }

        /* ==========================================
               FILTER SECTION
            ========================================== */

        .queue-filter-section {
            padding: 16px;
            margin-bottom: 22px;
            border: 1px solid var(--queue-border);
            border-radius: 9px;
            background: var(--queue-bg);
        }

        .queue-filter-item {
            width: 100%;
        }

        .queue-filter-item .form-label {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 6px;
            color: #475569;
            font-size: 12px;
            font-weight: 600;
        }

        .queue-filter-item .form-label i {
            color: #94a3b8;
            font-size: 13px;
        }

        .queue-filter-item .form-control,
        .queue-filter-item .form-select {
            min-height: 35px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background-color: #fff;
            color: #334155;
            font-size: 12px;
            box-shadow: none;
            transition: border-color .15s ease,
                box-shadow .15s ease;
        }

        .queue-filter-item .form-control:focus,
        .queue-filter-item .form-select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
        }

        .queue-filter-item .form-control::placeholder {
            color: #94a3b8;
        }

        /* ==========================================
               PATIENT TABLE
            ========================================== */

        .queue-table-section {
            width: 100%;
        }

        .queue-patient-table {
            width: 100% !important;
            margin-bottom: 0;
            font-size: 12px;
            border-collapse: separate;
            border-spacing: 0;
        }

        .queue-patient-table thead th {
            padding: 11px 12px;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .3px;
            border-top: 1px solid var(--queue-border);
            border-bottom: 1px solid var(--queue-border);
            white-space: nowrap;
        }

        .queue-patient-table tbody td {
            padding: 10px 12px;
            color: #334155;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }

        .queue-patient-table tbody tr {
            transition: background-color .15s ease;
        }

        .queue-patient-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .queue-patient-table tbody tr:last-child td {
            border-bottom: 0;
        }

        /* Baris ganjil */
        .queue-patient-table tbody tr:nth-child(odd)>td {
            background-color: #ffffff !important;
        }

        /* Baris genap */
        .queue-patient-table tbody tr:nth-child(even)>td {
            background-color: #f1f5f9 !important;
        }

        /* Hover tetap terlihat */
        .queue-patient-table tbody tr:hover>td {
            background-color: #dbeafe !important;
        }

        /* Border pemisah */
        .queue-patient-table tbody td {
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* Header */
        .queue-patient-table thead th {
            background-color: #eaf0f7 !important;
            color: #334155;
        }

        /* Jangan menghilangkan warna saat selected */
        .queue-patient-table tbody tr.selected>td {
            background-color: #dbeafe !important;
        }

        /* ==========================================
               RESPONSIVE
            ========================================== */

        @media (max-width: 767.98px) {

            .queue-main-card>.card-body {
                padding: 14px;
            }

            .queue-page-header {
                gap: 12px;
                margin-bottom: 16px;
                padding-bottom: 14px;
            }

            .queue-header-icon {
                width: 44px;
                height: 44px;
                font-size: 21px;
            }

            .queue-header-title {
                font-size: 16px;
            }

            .queue-filter-section {
                padding: 12px;
                margin-bottom: 18px;
            }

            .queue-section-heading>span {
                font-size: 10px;
            }

            .queue-patient-table {
                min-width: 450px;
            }
        }

        @media (max-width: 575.98px) {

            .queue-main-card>.card-body {
                padding: 12px;
            }

            .queue-header-label {
                font-size: 9px;
            }

            .queue-header-title {
                font-size: 15px;
            }

            .queue-doctor-info {
                font-size: 11px;
            }

            .queue-section-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .queue-filter-item .form-control,
            .queue-filter-item .form-select {
                min-height: 38px;
            }
        }
    </style>
    <div class="row gy-2">
        <div class="col-sm-12">

            <div class="queue-summary">
                <div class="queue-summary-header">
                    <div class="queue-summary-title">
                        <i class="bi bi-bar-chart-line"></i>
                        Ringkasan Antrian
                    </div>
                    <span class="queue-summary-status">
                        <span></span> Statistik Pasien
                    </span>
                </div>

                <div class="queue-summary-grid">

                    <div class="queue-stat stat-primary">
                        <div class="queue-stat-info">
                            <div class="queue-stat-label">Jumlah Pasien</div>
                            <div class="queue-stat-icon">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="queue-stat-value" id="count-pasien"></div>
                        <div class="queue-stat-desc">Total antrian</div>
                    </div>

                    <div class="queue-stat stat-success">
                        <div class="queue-stat-info">
                            <div class="queue-stat-label">Selesai</div>
                            <div class="queue-stat-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                        <div class="queue-stat-value" id="count-selesai"></div>
                        <div class="queue-stat-desc">Sudah dilayani</div>
                    </div>

                    <div class="queue-stat stat-warning">
                        <div class="queue-stat-info">
                            <div class="queue-stat-label">Menunggu</div>
                            <div class="queue-stat-icon">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                        <div class="queue-stat-value" id="count-tunggu"></div>
                        <div class="queue-stat-desc">Dalam antrian</div>
                    </div>

                    <div class="queue-stat stat-danger">
                        <div class="queue-stat-info">
                            <div class="queue-stat-label">Batal</div>
                            <div class="queue-stat-icon">
                                <i class="bi bi-x-circle"></i>
                            </div>
                        </div>
                        <div class="queue-stat-value" id="count-batal"></div>
                        <div class="queue-stat-desc">Antrian dibatalkan</div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-12">
            <div class="card queue-main-card">

                <div class="card-body">

                    {{-- HEADER POLI --}}
                    <div class="queue-page-header">
                        <div class="queue-header-icon">
                            <i class="bi bi-hospital"></i>
                        </div>

                        <div class="queue-header-content">
                            <div class="queue-header-label">LAYANAN RAWAT JALAN</div>
                            <h5 class="queue-header-title">
                                {{ $poli->nm_poli }}
                            </h5>

                            @if (Request::get('dokter'))
                                <div class="queue-doctor-info">
                                    <i class="bi bi-person-badge"></i>
                                    {{ $dokter->nm_dokter }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" id="hitung-panggil" value="">

                    {{-- FILTER SECTION --}}
                    <div class="queue-filter-section">

                        <div class="queue-section-heading">
                            <div>
                                <i class="bi bi-funnel"></i>
                                Filter Pencarian
                            </div>
                            <span>Gunakan filter untuk mencari pasien</span>
                        </div>

                        <div class="row g-3">

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="queue-filter-item">
                                    <label for="tgl_registrasi" class="form-label">
                                        <i class="bi bi-calendar3"></i>
                                        Tanggal Registrasi
                                    </label>
                                    <input type="text"
                                        class="form-control form-control-sm"
                                        id="tgl_registrasi"
                                        placeholder="Pilih tanggal"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="queue-filter-item">
                                    <label for="pasien-cari" class="form-label">
                                        <i class="bi bi-search"></i>
                                        Nama Pasien
                                    </label>
                                    <input type="search"
                                        class="form-control form-control-sm"
                                        id="pasien-cari"
                                        placeholder="Cari nama pasien..."
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="queue-filter-item">
                                    <label for="pembiayaan" class="form-label">
                                        <i class="bi bi-wallet2"></i>
                                        Pembiayaan
                                    </label>
                                    <select name="pembiayaan"
                                        id="pembiayaan"
                                        class="form-select form-select-sm">
                                        <option value="" disabled selected>
                                            Pilih Pembiayaan
                                        </option>
                                        <option value="">Umum & BPJS</option>
                                        <option value="BPJS">BPJS</option>
                                        <option value="Umum">Umum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="queue-filter-item">
                                    <label for="status_periksa" class="form-label">
                                        <i class="bi bi-clipboard-check"></i>
                                        Status Periksa
                                    </label>
                                    <select name="status_periksa"
                                        id="status_periksa"
                                        class="form-select form-select-sm">
                                        <option value="" disabled selected>
                                            Pilih Status Periksa
                                        </option>
                                        <option value="">Semua</option>
                                        <option value="Sudah">Sudah</option>
                                        <option value="Belum">Belum</option>
                                        <option value="Batal">Batal</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- TABLE SECTION --}}
                    <div class="queue-table-section">

                        <div class="queue-section-heading">
                            <div>
                                <i class="bi bi-people"></i>
                                Daftar Pasien
                            </div>
                            <span>Data registrasi pasien</span>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-sm queue-patient-table"
                                id="tb_pasien"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">Aksi</th>
                                        <th>Nama Pasien</th>
                                        <th style="width: 120px;">Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- @include('content.upload.inforegistrasi')
        @include('content.upload.resume') --}}
    </div>
    @include('content.poliklinik.modal.modal_pemeriksaan')
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.poliklinik.modal.modal_askep')
    @include('content.poliklinik.modal.modal_askep_anak')
    {{-- @include('content.poliklinik.modal.modal_resep') --}}
    @include('content.poliklinik.modal.modal_skrj')
    @include('content.poliklinik.modal.modal_spri')
    @include('content.poliklinik.modal.modal_rujukan_keluar')
    @include('content.poliklinik.modal.modal_kontrol_umum')
    @include('content.poliklinik.modal.modal_icare')
    @include('content.poliklinik.modal.modal_peserta')
    @include('content.poliklinik.modal.modal_catatan')
    @include('content.ranap.modal.modal_hasil_kritis')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.ranap.modal.modal_riwayat_vaksin')
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        var isModalShow = false;
        var kd_poli = '{{ $poli->kd_poli }}';
        var kd_dokter = "{{ Request::get('dokter') }}";
        var tgl_registrasi = "";
        var nmpasien = localStorage.getItem('pasien');
        var pembiayaan = "";
        var status_periksa = "";

        $('#pasien-cari').on('keyup', function() {
            localStorage.setItem('pasien', $('#pasien-cari').val());
            nmpasien = localStorage.getItem('pasien');
            if (nmpasien.length >= 3 || nmpasien.length == 0) {
                $('#tb_pasien').DataTable().destroy();
                tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
            }
        })

        $('#pasien-cari').on('search', function() {
            nmpasien = '';
            localStorage.setItem('pasien', '');
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi);
        })

        $('#pembiayaan').on('change', function() {
            pembiayaan = $(this).val();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
        })
        $('#status_periksa').on('change', function() {
            status_periksa = $(this).val();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tgl_registrasi, nmpasien, pembiayaan, status_periksa);
        })

        $(document).ready(function() {
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;

            $('#tgl_registrasi').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
            }).on('changeDate', (e) => {
                selectTgl = splitTanggal($('#tgl_registrasi').datepicker('getFormattedDate')) ? splitTanggal($('#tgl_registrasi').datepicker('getFormattedDate')) : "{{ date('Y-m-d') }}";
                localStorage.setItem('tanggal', selectTgl);
                $('#tb_pasien').DataTable().destroy();
                tb_pasien(selectTgl, nmpasien);
                hitungPanggilan();
                tgl_registrasi = localStorage.getItem('tanggal');
            });
            tgl_registrasi = localStorage.getItem('tanggal') ? localStorage.getItem('tanggal') : "{{ date('Y-m-d') }}";
            $('#tb_pasien').DataTable().destroy();
            $('#pasien-cari').val(nmpasien)
            tb_pasien(tgl_registrasi, $('#pasien-cari').val());
            hitungPanggilan();
            $('#tgl_registrasi').datepicker('setDate', splitTanggal(tgl_registrasi));
        });

        function hitungPasien() {
            $.ajax({
                url: '/erm/pemeriksaan/jumlah',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter
                },
                method: 'GET',
                success: function(response) {
                    $('#count-pasien').text(response);
                }
            })
        }


        // function modalsoap(no_rawat) {
        //     jbtn = "{{ session()->get('pegawai')->jbtn }}";
        //     nik = "{{ session()->get('pegawai')->nik }}";
        //     nama = "{{ session()->get('pegawai')->nama }}";
        //     $('#nama_user').val(nama);
        //     $('#user').val(nik);
        //     let kd_dokter = "{{ Request::get('dokter') }}"
        //     let textObject = `Janin : \nPres : \nDJJ : \nTBJ : \nJK : \nPlacenta : \nAk : \n`

        //     getRegPeriksa(no_rawat).done((regPeriksa) => {
        //         if (regPeriksa.pasien.ket_pasien) {
        //             $('#formSoapPoli input[name=ket_pasien]').val(regPeriksa.pasien.ket_pasien.keterangan)
        //         }
        //         $('#formSoapPoli input[name=no_rawat]').val(no_rawat)
        //         $('#formSoapPoli input[name=no_rkm_medis]').val(regPeriksa.no_rkm_medis)
        //         $('#formSoapPoli input[name=nm_pasien]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk}) / ${hitungUmur(regPeriksa.pasien.tgl_lahir)}`)
        //         $('#formSoapPoli input[name=p_jawab]').val(regPeriksa.p_jawab)
        //         $('#formSoapPoli input[name=png_jawab]').val(`${regPeriksa.penjab.png_jawab}`)

        //         if (role === 'dokter') {
        //             cekPanggilanPoli(no_rawat).done((response) => {
        //                 if (!response.length) {
        //                     panggil(textRawat(regPeriksa.no_rawat))
        //                 }
        //             });
        //         }

        //         riwayatResep(regPeriksa.no_rkm_medis)
        //         cekAlergi(regPeriksa.no_rkm_medis)
        //     }).fail((request) => {
        //         alertErrorAjax(request);
        //     })

        // }

        function cekPanggilanPoli(no_rawat) {
            return $.ajax({
                url: '/erm/poli/panggil',
                data: {
                    no_rawat: no_rawat
                },
                method: 'GET',
            })
        }



        function cekAlergi(no_rm) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    no_rkm_medis: no_rm,
                    sortir: 'ASC',
                },
                success: function(response) {
                    alergi = '-'
                    $.map(response.reg_periksa, function(val) {
                        if (val.pemeriksaan_ralan.length) {
                            $.map(val.pemeriksaan_ralan, (pem) => {
                                if (pem.alergi != '-' || pem.alergi != '' || pem.alergi) {
                                    alergi = pem.alergi
                                }
                            })
                        }
                    })
                    $('#alergi').val(alergi)
                }
            })
            return false;
        }

        function hitungPanggilan() {
            kd_poli = '{{ Request::segment(2) }}';
            kd_dokter = '{{ Request::get('dokter') }}';

            $.ajax({
                url: '/erm/registrasi/status',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                method: 'GET',
                success: function(response) {
                    let jumlah = 0;
                    let batal = 0;
                    let tunggu = 0;
                    let sudah = 0;
                    let periksa = 0;
                    $.map(response, function(val, index) {
                        if (val.stts == 'Belum') {
                            tunggu = val.jumlah;
                        } else if (val.stts == 'Sudah') {
                            sudah = val.jumlah;
                        } else if (val.stts == 'Batal') {
                            batal = val.jumlah;
                        } else if (val.stts == 'Berkas Diterima' || val.stts == 'Periksa') {
                            periksa = val.jumlah;
                            $('#hitung-panggil').val(periksa);
                        }
                        jumlah = jumlah + parseInt(val.jumlah)

                    })
                    $('#count-pasien').text(jumlah)
                    $('#count-tunggu').text(tunggu)
                    $('#count-selesai').text(sudah)
                    $('#count-batal').text(batal)
                },
            });
        }

        function panggil(urut) {

            id = $('.panggil-' + urut).data('id');
            if (!$('.panggil-' + urut)) {
                return false
            }
            hitung_panggilan = $('#hitung-panggil').val();
            text_recall = $('.panggil-' + urut).text()
            if (hitung_panggilan < 2 || text_recall == 'CALL') {
                $('.selesai-' + urut).prop('disabled', false);
                $('.selesai-' + urut).prop('class', 'btn btn-warning btn-sm mb-2 selesai-' + urut + '');

                $('.batal-' + urut).prop('disabled', false);
                $('.batal-' + urut).prop('class', 'btn btn-danger btn-sm mb-2 batal-' + urut + '');

                $('.panggil-' + urut).prop('class', 'btn btn-primary btn-sm mb-2 panggil-' + urut + '');
                $('.panggil-' + urut).css({
                    'background-color': 'rgb(152 0 175)',
                    'border-color': 'rgb(142 6 163)'
                });
                $('.panggil-' + urut).text('RE-CALL');
                $.ajax({
                    url: '/erm/poliklinik/panggil',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'no_rawat': id,
                    },
                    method: "POST",
                    success: function(data) {
                        $.toast({
                            text: 'Memangil : ' + data.no_rawat + '<br/> Jam Periksa : ' + data
                                .jam_periksa,
                            position: 'bottom-center',
                            bgColor: '#0067dd',
                            loader: false,
                            stack: false,
                        })
                        hitungPanggilan();
                    }
                })
            } else {
                $.toast({
                    text: 'Sedang ada pasien',
                    position: 'bottom-center',
                    bgColor: '#ffc107',
                    textColor: 'black',
                    stack: false,
                    loader: false,
                })
                $.toast().reset();
                hitungPanggilan();
            }

        }

        function selesai(urut) {
            id = $('.panggil-' + urut).data('id');
            reloadTabelPoli();
            Swal.fire({
                title: 'Yakin pemeriksaan selesai ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Belum',
                confirmButtonText: 'Ya, Selesai !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/poliklinik/selesai',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'no_rawat': id,
                        },
                        method: 'POST',
                        success: function(response) {
                            $.toast({
                                text: 'Periksa : ' + response.no_rawat +
                                    ' Selesai <br/> Jam Periksa : ' +
                                    response.jam_periksa,
                                position: 'bottom-center',
                                bgColor: '#198754',
                                loader: false,
                                stack: false,
                            });
                            $('#aksi-' + urut).empty();
                            $('#aksi-' + urut).append(
                                '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>'
                            );
                            hitungPanggilan();
                        }

                    });
                }
            })
        }

        function batal(urut) {

            id = $('.batal-' + urut).data('id');

            $.ajax({
                url: '/erm/poliklinik/batal',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'no_rawat': id,
                },
                method: "DELETE",
            }).done((response) => {
                $.toast({
                    text: response.pesan + ' : ' + response.no_rawat,
                    position: 'bottom-center',
                    bgColor: '#dc3545',
                    loader: false,
                    stack: false,
                });

                $('.panggil-' + urut).prop('class', 'btn btn-success btn-sm mb-2 panggil-' + urut + '');
                $('.panggil-' + urut).removeAttr('style');
                $('.panggil-' + urut).css({
                    'width': '80px'
                });

                $('.batal-' + urut).prop('disabled', true);
                $('.batal-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 batal-' + urut + '');

                $('.selesai-' + urut).prop('disabled', true);
                $('.selesai-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 selesai-' + urut + '');

                $('.panggil-' + urut).text('PANGGIL');

                hitungPanggilan();
            }).fail((request, error) => {
                // console.log(, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: request.responseJSON,
                })
            });


        }

        function getListRencanaKontrol(bulan, tahun, noka, filter) {
            rencana = $.ajax({
                url: '/erm/bridging/rencanaKontrol/list/' + bulan + '/' + tahun + '/' + noka + '/' + filter,
                dataType: 'JSON',
                method: 'GET',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            });

            return rencana;
        }

        function setDokterSpesialis(kode, nama) {
            $('#modalSkrj').modal('show')
            $('#modalDokter').modal('hide')
            $('.kode_dokter').val(kode);
            $('.nama_dokter').val(nama);
        }



        function reloadTabelPoli() {
            tanggal = localStorage.getItem('tanggal') ? localStorage.getItem('tanggal') : "{{ date('Y-m-d') }}"
            hitungPanggilan();
            $('#tb_pasien').DataTable().destroy();
            tb_pasien(tanggal);
        }

        function tb_pasien(tgl_registrasi, nama = '', pembiayaan = '', status) {
            tgl_registrasi = tgl_registrasi ? tgl_registrasi : "{{ date('Y-m-d') }}";
            hitungPanggilan();
            var table = $('#tb_pasien').DataTable({
                processing: false,
                scrollX: true,
                serverSide: true,
                // stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                lenghtChange: false,
                info: false,
                // deferRender: true,
                destroy: true,

                columnDefs: [{
                    width: 50,
                    targets: 0,
                    orderable: false,
                }],
                ajax: {
                    url: "table",
                    data: {
                        kd_poli: '{{ $poli->kd_poli }}',
                        kd_dokter: "{{ Request::get('dokter') }}",
                        tgl_registrasi: tgl_registrasi,
                        pasien: nama,
                        pembiayaan: pembiayaan,
                        status_periksa: status,
                    },
                },
                createdRow: function(row, data, dataIndex) {
                    $(row).attr('data-no-rkm-medis', data.no_rkm_medis);
                    //
                    // const alertContainer = $('<div class="infection-alert mt-2"></div>');
                    // $(row).find('td:eq(9)').append(alertContainer);
                    //
                    // if (!window.labAlertCache) {
                    //     window.labAlertCache = {};
                    // }
                    //
                    window.labAlertCache = window.labAlertCache || {};
                    const noRkmMedis = data.no_rkm_medis;

                    if (window.labAlertCache[noRkmMedis] !== undefined) {
                        if (window.labAlertCache[noRkmMedis] === 'HIGH') {
                            $(`.pasien-${data.no_reg}`)
                                .addClass('text-danger fw-bold').attr('onclick', `showLabInfectionAlert('${noRkmMedis}')`);
                        }
                    } else {
                        $.get(`/erm/lab/riwayat-hasil/${data.no_rkm_medis}`)
                            .done(response => {
                                const risk = response.infection_alert?.highest_risk || 'NONE';
                                window.labAlertCache[noRkmMedis] = risk;
                                if (risk === 'HIGH') {
                                    $(`.pasien-${data.no_reg}`)
                                        .addClass('text-danger fw-bold').attr('onclick', `showLabInfectionAlert('${noRkmMedis}')`);
                                }
                            });
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = '';
                            norawat = textRawat(row.no_rawat)
                            if (row.stts == 'Batal') {
                                html =
                                    '<h3 class="text-danger" align="center"><i class="bi bi-x-circle-fill"></i></h3>';
                            } else if (row.stts == 'Sudah') {
                                html =
                                    '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>';
                            } else {

                                if (row.stts == 'Berkas Diterima' || row.stts == 'Periksa') {
                                    $('.panggil-' + norawat).text('RE-CALL');
                                    $('.selesai-' + norawat).addClass('btn-warning');
                                    $('.panggil-' + norawat).prop('style',
                                        'width:80px;background-color:#9800af;border-color:#8e06a3;color:white'
                                    );
                                    $('.batal-' + norawat).addClass('btn-danger');
                                } else {
                                    $('.panggil-' + norawat).addClass('btn-success');
                                    $('.batal-' + norawat).addClass('btn-secondary');
                                    $('.selesai-' + norawat).addClass('btn-secondary');
                                    $('.panggil-' + norawat).text('PANGGIL')
                                    $('.batal-' + norawat).prop('disabled', true);
                                    $('.selesai-' + norawat).prop('disabled', true);
                                }
                                html = '<div id="aksi-' + norawat + '">';
                                html += ' <button onclick="panggil(\'' + norawat + '\')" class="btn btn-sm mb-2 panggil-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '"></button><br/>';
                                html += ' <button onclick="selesai(\'' + norawat + '\')" class="btn btn-sm mb-2 selesai-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '">SELESAI</button><br/>';
                                html += ' <button onclick="batal(\'' + norawat + '\')" class="btn btn-sm mb-2 batal-' + norawat + '" type="button" style="width:80px;" data-id="' + row.no_rawat + '">BATAL</button><br/>';
                                html += '</div>';
                            }
                            return html
                        },
                        name: 'aksi'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.kd_pj == 'A01' || row.kd_pj == 'A05') {
                                classTeksPenjab = 'text-success';
                            } else {
                                classTeksPenjab = 'text-danger';
                            }

                            pasien = data.pasien.nm_pasien;
                            no_rawat = textRawat(row.no_rawat);
                            badgeKontrol = '';
                            btnSep = '<div class="dropdown mb-1 mt-1" id="dropdown-sep-' + no_rawat + '"> <button id="btn-rujuk-' + no_rawat + '" class="btn-sm" style="font-size:10px;width:112px" type="button" data-bs-toggle="dropdown" aria-expanded="false" ><ul class="dropdown-menu" style="font-size:12px"></button></div>';
                            if (row.sep && row.kd_pj != "A03") {
                                $('#btn-rujuk-' + no_rawat).addClass('btn btn-success dropdown-toggle');
                                $('#btn-rujuk-' + no_rawat).text('SEP Sudah Terbit');
                                html = '<ul class="dropdown-menu" style="font-size:12px">'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="kontrolUlang(\'' + row.sep.no_sep + '\')">Kontrol Ulang / SKRJ</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rawatInap(\'' + row.no_rawat + '\')">Perintah Rawat Inap / SPRI</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rujukanKeluar(\'' + row.sep.no_sep + '\')">Rujukan Keluar</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare(\'' + row.pasien.no_peserta + '\', ' + row.dokter.mapping_dokter.kd_dokter_bpjs + ')">Riwayat Perawatan ICare</a></li>'
                                html += '</ul>'
                                $('#dropdown-sep-' + no_rawat).append(html)
                                if (row.sep?.surat_kontrol) {
                                    badgeKontrol = '<a target="_blank" href="/erm/rencanaKontrol/print/' + row.sep?.surat_kontrol?.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Kontrol : ' + splitTanggal(row.sep.surat_kontrol.tgl_rencana) + '</span></a>';
                                } else if (row.sep?.rujukan_keluar) {
                                    textRujukan = row.sep.rujukan_keluar?.nm_ppkDirujuk?.split(' - ')[0];
                                    rujukan = textRujukan.length > 10 ? textRujukan.substring(0, 10) + '...' : textRujukan
                                    badgeKontrol = '<a target="_blank" href="/erm/rujukan/print/' + row.sep?.rujukan_keluar?.no_rujukan + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Rujuk : ' + rujukan + '</span></a>';
                                }

                                if (row.pasien.spri?.tgl_surat == row.tgl_registrasi) {
                                    badgeKontrol = '<a target="_blank" href="/erm/spri/print/' + row.pasien?.spri?.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >SPRI : ' + splitTanggal(row.pasien.spri.tgl_rencana) + '</span></a>';
                                }
                            } else if (!row.sep && row.kd_pj != "A03") {
                                $('#btn-rujuk-' + no_rawat).addClass('btn btn-danger dropdown-toggle');
                                html = '<ul class="dropdown-menu" style="font-size:12px">'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="rawatInap(\'' + row.no_rawat + '\')">Perintah Rawat Inap / SPRI</a></li>'
                                html += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare(\'' + row.pasien.no_peserta + '\', ' + row.dokter.mapping_dokter.kd_dokter_bpjs + ')">Riwayat Perawatan ICare</a></li>'
                                html += '</ul>'
                                $('#dropdown-sep-' + no_rawat).append(html)
                                $('#btn-rujuk-' + no_rawat).text('Belum Terbit SEP');
                                if (row.pasien.spri?.tgl_surat == row.tgl_registrasi) {
                                    badgeKontrol = '<a target="_blank" href="/erm/spri/print/' + row.pasien.spri.no_surat + '"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >SPRI : ' + splitTanggal(row.pasien.spri.tgl_rencana) + '</span></a>';
                                }
                            } else {
                                if (row.surat_kontrol) {
                                    badgeKontrol = '<a href="javascript:void(0)"><span id="kontrol-' + no_rawat + '" class="badge text-bg-warning" >Kontrol : ' + splitTanggal(row.surat_kontrol.tanggal) + '</span></a>';
                                }
                                $('#dropdown-sep-' + no_rawat).css('display', 'none')
                            }


                            if (row.penjab?.png_jawab == 'UMUM') {
                                textPenjab = '<a href="javascript:void(0)" onclick="kontrolUmum(\'' + row.no_rawat + '\')" style="text-decoration:none;color:red">' + row.penjab.png_jawab + '</a>'
                            } else {
                                textPenjab = '<a href="javascript:void(0)" onclick="" style="text-decoration:none;color:green">' + row.penjab.png_jawab + '</a>'
                            }

                            html = '<h5 class="mb-1 h3">' + row.no_reg + '</h5>';
                            html += '<p style="margin:0px"><span class="pasien-' + row.no_reg + '">' + pasien + cekList(row.skrining_tb) +
                                '</span></br>' +
                                row.no_rawat +
                                '</br><i><strong class="' + classTeksPenjab + '">' + textPenjab + '</strong></i></p>' + btnSep + ' ' + badgeKontrol;

                            return html;
                        },
                        name: 'nm_pasien'

                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {
                            let ambilAskep = '';
                            let no_rkm_medis = row.no_rkm_medis.replace(/\s/g, '');
                            if (row.dokter) {
                                dokter = row.dokter.nm_dokter;
                                if (row.dokter.kd_sps == 'S0001') {
                                    ambilAskep = 'ambilAskepKebidanan(\'' + no_rkm_medis + '\')';
                                } else {
                                    ambilAskep = 'ambilAskepAnak(\'' + no_rkm_medis + '\')';
                                }
                            }
                            html =
                                '<a href="#form-upload" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" style="" onclick = "detailPeriksa(\'' +
                                row.no_rawat + '\',\'' + row.status_lanjut + '\')" id="btn-upload-' +
                                textRawat(row.no_rawat) +
                                '"><i id="upload-' +
                                textRawat(row.no_rawat) +
                                '" class="bi bi-cloud-upload-fill"></i> UPLOAD</a>';
                            html += `<button id="btn-periksa-${textRawat(row.no_rawat)}" style="" onclick="showSoapRalan('${row.no_rawat}')" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik">
                                            <i class="bi bi-pencil-square" id="icon-periksa-${textRawat(row.no_rawat)}"></i>
                                            SOAP
                                        </button>`

                            html += '<button id="btn-askep-' + textRawat(row.no_rawat) + '" onclick="' + ambilAskep + '" class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" data-id="' +
                                row.no_rkm_medis +
                                '"><i id="icon-askep-' +
                                textRawat(row.no_rawat) +
                                '" class="bi bi-file-bar-graph-fill"></i> ASKEP</button>';
                            html +=
                                '<button class="btn btn-primary btn-sm mb-2 mr-1 btn-width-poliklinik" onclick="confirmUpdateRiwayat(\'' + row.no_rkm_medis + '\')" data-id="' +
                                row.no_rkm_medis + '"  style="width:100px;font-size:11px;text-align:left"><i class="bi bi-search"></i>RIWAYAT</button>';

                            if (row.upload.length > 0) {
                                $('#upload-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-cloud-upload-fill')
                                $('#btn-upload-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#upload-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-upload-' + textRawat(row.no_rawat)).addClass('btn-success')
                            }


                            if (row.pemeriksaan_ralan.length) {
                                $('#icon-periksa-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-pencil-square')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#icon-periksa-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).addClass('btn-success')
                                $('.panggil-' + textRawat(row.no_rawat)).addClass('btn-success');
                                $('.panggil-' + textRawat(row.no_rawat)).removeClass('btn-secondary');
                                $('.panggil-' + textRawat(row.no_rawat)).attr('disabled', false);
                            } else {
                                $('.panggil-' + textRawat(row.no_rawat)).removeClass('btn-success');
                                $('.panggil-' + textRawat(row.no_rawat)).addClass('btn-secondary');
                                $('.panggil-' + textRawat(row.no_rawat)).attr('disabled', true);
                            }

                            const hasAskepKebidanan = (row.askep_ralan_kebidanan && row.askep_ralan_kebidanan.length > 0) ||
                                (row.pasien?.askep_ralan_kebidanan && row.pasien.askep_ralan_kebidanan.length > 0);
                            const hasAskepAnak = (row.askep_ralan_anak && row.askep_ralan_anak.length > 0) ||
                                (row.pasien?.askep_ralan_anak && row.pasien.askep_ralan_anak.length > 0);

                            if (row.kd_poli == 'P001' || row.kd_poli == 'P007' || row.kd_poli == 'P009') {
                                if (hasAskepKebidanan) {
                                    $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success mb-2 btn-sm mr-1 btn-width-poliklinik')
                                }
                            } else if (row.kd_poli == 'P008' || row.kd_poli == 'P003') {
                                if (hasAskepAnak) {
                                    $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success btn-sm mr-1 btn-width-poliklinik')
                                }
                            }

                            return `<div class="d-flex flex-column">${html}</div>`;
                        },
                        name: 'upload',
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function confirmUpdateRiwayat(no_rkm_medis) {
            if (localStorage.getItem('riwayat') === 'baru') {
                listRiwayatPasien(no_rkm_medis);
            } else if (localStorage.getItem('riwayat') === 'lama') {
                modalRiwayat(no_rkm_medis);
            } else {
                Swal.fire({
                    title: 'Update',
                    text: "Pnambahan tampilan riwayat baru, apakah lanjut ke tampilan riwayat baru ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Gunakan yang baru',
                    cancelButtonText: 'Tidak, Tetap yang lama',
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.setItem('riwayat', 'baru');
                        listRiwayatPasien(no_rkm_medis);
                    } else {
                        localStorage.setItem('riwayat', 'lama');
                        modalRiwayat(no_rkm_medis);
                    }
                })
            }
        }

        function kontrolUmum(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat
                },
                success: function(response) {
                    if (response.surat_kontrol) {
                        tanggalKontrol = splitTanggal(response.surat_kontrol.tanggal);
                        $('.no_surat').val(response.surat_kontrol.no_surat)
                        $('.btn-buat-kontrol-umum').css('display', 'none')
                    } else {
                        tanggalKontrol = '';
                        $('.no_surat').val('')
                        $('.btn-buat-kontrol-umum').css('display', 'inline')
                    }
                    $('.btn-cari-peserta').attr('onclick', 'getPesertaDetail(\'' + response.pasien.no_peserta + '\')');
                    $('.no_rawat').val(response.no_rawat)
                    $('.no_rkm_medis').val(response.no_rkm_medis)
                    $('.pasien').val(response.pasien.no_rkm_medis + ' - ' + response.pasien.nm_pasien + ' (' + response.umurdaftar + ' ' + response.sttsumur + ')')
                    $('.umurdaftar').val(response.umurdaftar)
                    $('.sttsumur').val(response.sttsumur)
                    $('.kode_dokter').val(response.kd_dokter)
                    $('.dokter').val(response.dokter.nm_dokter)
                    $('.nama_dokter').val(response.kd_dokter + ' - ' + response.dokter.nm_dokter)
                    $('.tgl_lahir').val(splitTanggal(response.pasien.tgl_lahir))
                    jenis = response.dokter.kd_sps == 'S0003' ? 'PAN' : 'POG';
                    $('.kode_jenis').val(jenis)
                    $('.kode_poli').val(response.kd_poli)
                    $('.nama_poli').val(response.kd_poli + ' - ' + response.poliklinik.nm_poli)
                    $('#modalKontrolUmum').modal('show')
                }
            })
        }

        function buatKontrolUmum() {

            no_rkm_medis = $('.no_rkm_medis').val()
            no_rawat = $('.no_rawat').val()
            jenis = $('.kode_jenis').val()
            tanggal = $('.tgl_kontrol_umum').val()
            dokter = $('.dokter').val()
            kode_dokter = $('.kode_dokter').val()
            kode_poli = $('.kode_poli').val()
            umurdaftar = $('.umurdaftar').val()
            sttsumur = $('.sttsumur').val()
            $.ajax({
                url: '/erm/kontrol/umum/baru',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rkm_medis: no_rkm_medis,
                    no_rawat: no_rawat,
                    jenis: jenis,
                    tanggal: splitTanggal(tanggal),
                    dokter: dokter,
                },
                success: function(response) {
                    Swal.fire(
                        'Berhasil',
                        'Surat kontrol sudah dibuat',
                        'success'
                    );
                    dataBooking = {
                        'no_rkm_medis': no_rkm_medis,
                        'kd_dokter': kode_dokter,
                        'kd_poli': kode_poli,
                        'tanggal': splitTanggal(tanggal),
                    }

                    buatBooking(dataBooking).done(function(val) {
                        data = {
                            'no_reg': val.response.no_reg,
                            'tgl_registrasi': val.response.tanggal_periksa,
                            'kd_dokter': val.response.kd_dokter,
                            'no_rkm_medis': val.response.no_rkm_medis,
                            'kd_poli': val.response.kd_poli,
                            'p_jawab': val.response.pasien.namakeluarga,
                            'almt_pj': val.response.pasien.alamatpj + ', ' + val.response.pasien.kecamatanpj + ', ' + val.response.pasien.kabupatenpj,
                            'hubungan': val.response.pasien.keluarga,
                            'status_lanjut': 'Ralan',
                            'kd_pj': val.response.kd_pj,
                            'umurdaftar': umurdaftar,
                            'sttsumur': sttsumur,
                            'status_poli': 'Lama',
                            'stts_daftar': 'Lama',
                        }
                        buatRegistrasi(data);
                    })

                    $('#modalKontrolUmum').modal('hide')
                }
            })
        }

        function buatBooking(data) {
            data._token = "{{ csrf_token() }}";

            booking = $.ajax({
                url: '/erm/booking/buat',
                data: data,
                method: 'POST',
                success: function(response) {
                    $('.booking').val('true');
                    Swal.fire(
                        'Berhasil',
                        'Telah di tambahakan booking',
                        'success'
                    );
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal',
                        'Terjadi kesalahan pembuatan booking',
                        'error'
                    );
                }
            });
            return booking;
        }

        function buatRegistrasi(data) {
            data._token = "{{ csrf_token() }}";

            registrasi = $.ajax({
                url: '/erm/registrasi/buat',
                method: 'POST',
                data: data,
                success: function(response) {
                    $('.registrasi').val('true');
                    Swal.fire(
                        'Berhasil',
                        'Data registrasi telah dibuat dengan nomor registrasi ' + response.response.no_rawat,
                        'success'
                    );
                    reloadTabelPoli();
                },
                error: function(a, b, c) {
                    Swal.fire(
                        'Gagal',
                        'Terjadi kesalahan pembuatan registrasi pasien',
                        'error'
                    );
                }
            })

            return registrasi;
        }

        function ambilAskepAnak(no_rkm_medis) {
            $.ajax({
                url: 'askep/anak',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        $('#opt-rawat').append(
                            '<option value="" disabled selected>PILIH TANGGAL ASESMEN</option>')
                        $.map(response, function(data) {
                            $('#opt-rawat').append('<option class="opt-asesmen-anak" value=' + data.no_rawat + '>' + formatTanggal(data.tanggal) + ' - ' + data.no_rawat + '</option>')
                            $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                            $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' :
                                ': Perempuan')
                            $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa
                                .tgl_registrasi));
                            $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                            $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien
                                    .tgl_lahir) +
                                ' / ' + data.reg_periksa.umurdaftar + ' ' + data.reg_periksa
                                .sttsumur);
                            $('.anamnesis').html(': ' + data.informasi);
                            $('.tensi').html(': ' + data.td + ' mmHG');
                            $('.nadi').html(': ' + data.nadi + ' x/menit');
                            $('.respirasi').html(': ' + data.rr + ' x/menit');
                            $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                            $('.gcs').html(': ' + data.gcs);
                            $('.bb').html(': ' + data.bb + ' Kg');
                            $('.tb').html(': ' + data.bb + ' Cm');
                            $('.lp').html(': ' + data.lp + ' Cm');
                            $('.ld').html(': ' + data.ld + ' Cm');
                            $('.lk').html(': ' + data.lk + ' Cm');
                            $('.keluhan_utama').html(': ' + data.keluhan_utama);
                            $('.rpd').html(': ' + data.rpd);
                            $('.rpk').html(': ' + data.rpk);
                            $('.rpo').html(': ' + data.rpo);
                            $('.alergi').html(': ' + data.alergi);
                            $('.anakke').html(': ' + data.anakke + ', dari ' + data.darisaudara +
                                ' bersaudara');
                            $('.caralahir').html(': ' + data.caralahir + ' ( ' + data
                                .ket_caralahir +
                                ' )');
                            $('.umurkelahiran').html(': ' + data.umurkelahiran);
                            $('.kelainanbawaan').html(': ' + data.kelainanbawaan + ' (' + data
                                .ket_kelainan_bawaan + ' )');

                            namaImunisasi = '';
                            $('.tb-askep-imunisasi tbody').empty()
                            $('.imunisasi').remove()
                            $.map(data.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                                if (namaImunisasi != imunisasi.master_imunisasi
                                    .nama_imunisasi) {
                                    namaImunisasi = imunisasi.master_imunisasi
                                        .nama_imunisasi
                                    html = '<tr class="imunisasi ' + imunisasi
                                        .kode_imunisasi +
                                        '">'
                                    html += '<td>' + namaImunisasi + '</td>';

                                    html += '</tr>'
                                    $('.tb-askep-imunisasi tbody').append(html)
                                }
                                nomorImun =
                                    '<td><i class="bi bi-check-lg text-success"></i></td>'
                                $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                            })


                            $('.usiatengkurap').html(': ' + data.usiatengkurap);
                            $('.usiaduduk').html(': ' + data.usiaduduk);
                            $('.usiaberdiri').html(': ' + data.usiaberdiri);
                            $('.usiagigipertama').html(': ' + data.usiagigipertama);
                            $('.usiaberjalan').html(': ' + data.usiaberjalan);
                            $('.usiamembaca').html(': ' + data.usiamembaca);
                            $('.usiamenulis').html(': ' + data.usiamenulis);
                            $('.wajah').html(': ' + data.wajah);
                            $('.alat_bantu').html(': ' + data.alat_bantu);
                            $('.prothesa').html(': ' + data.prothesa);
                            $('.aktifitas').html(': ' + data.aktifitas);
                            $('.status_psiko').html(': ' + data.status_psiko + ' (' + data
                                .ket_psiko +
                                ' )');
                            $('.edukasi').html(': ' + data.edukasi + ' (' + data.ket_edukasi +
                                ' )');
                            $('.hub_keluarga').html(': ' + data.hub_keluarga);
                            $('.ekonomi').html(': ' + data.ekonomi);
                            $('.pengasuh').html(': ' + data.pengasuh + ' ( ' + data.ket_pengasuh +
                                ' )');
                            $('.budaya').html(': ' + data.budaya + ' ( ' + data.ket_budaya + ' )');

                        })

                        $('#modalAskepAnak').modal('show');
                    } else {
                        Swal.fire(
                            'Kosong!', 'Belum ada data asesmen', 'error'
                        );
                    }

                }
            });
        }

        $('#opt-rawat').on('change', function() {
            no_rawat = $(this).val();
            $.ajax({
                url: 'askep/anak/detail',
                data: {
                    no_rawat: no_rawat,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('.tgl_registrasi').html(': ' + formatTanggal(response.reg_periksa
                        .tgl_registrasi));
                    $('.tensi').html(': ' + response.td + ' mmHG');
                    $('.nadi').html(': ' + response.nadi + ' x/menit');
                    $('.respirasi').html(': ' + response.rr + ' x/menit');
                    $('.suhu').html(': ' + response.suhu + ' <sup>o</sup>C');
                    $('.gcs').html(': ' + response.gcs);
                    $('.bb').html(': ' + response.bb + ' Kg');
                    $('.tb').html(': ' + response.bb + ' Cm');
                    $('.lp').html(': ' + response.lp + ' Cm');
                    $('.ld').html(': ' + response.ld + ' Cm');
                    $('.lk').html(': ' + response.lk + ' Cm');
                    $('.keluhan_utama').html(': ' + response.keluhan_utama);
                    $('.rpd').html(': ' + response.rpd);
                    $('.rpk').html(': ' + response.rpk);
                    $('.rpo').html(': ' + response.rpo);
                    $('.alergi').html(': ' + response.alergi);
                    $('.anakke').html(': ' + response.anakke + ', dari ' + response.darisaudara +
                        ' bersaudara');
                    $('.caralahir').html(': ' + response.caralahir + ' ( ' + response
                        .ket_caralahir +
                        ' )');
                    $('.umurkelahiran').html(': ' + response.umurkelahiran);
                    $('.kelainanbawaan').html(': ' + response.kelainanbawaan + ' (' + response
                        .ket_kelainan_bawaan + ' )');
                    namaImunisasi = '';
                    $('.tb-askep-imunisasi tbody').empty()
                    $('.imunisasi').remove()
                    $.map(response.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                        if (namaImunisasi != imunisasi.master_imunisasi.nama_imunisasi) {
                            namaImunisasi = imunisasi.master_imunisasi.nama_imunisasi
                            html = '<tr class="imunisasi ' + imunisasi.kode_imunisasi + '">'
                            html += '<td>' + namaImunisasi + '</td>';

                            html += '</tr>'
                            $('.tb-askep-imunisasi tbody').append(html)
                        }
                        nomorImun = '<td><i class="bi bi-check-lg text-success"></i></td>'
                        $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                    })
                    $('.usiatengkurap').html(': ' + response.usiatengkurap);
                    $('.usiaduduk').html(': ' + response.usiaduduk);
                    $('.usiaberdiri').html(': ' + response.usiaberdiri);
                    $('.usiagigipertama').html(': ' + response.usiagigipertama);
                    $('.usiaberjalan').html(': ' + response.usiaberjalan);
                    $('.usiamembaca').html(': ' + response.usiamembaca);
                    $('.usiamenulis').html(': ' + response.usiamenulis);
                    $('.wajah').html(': ' + response.wajah);
                    $('.alat_bantu').html(': ' + response.alat_bantu);
                    $('.prothesa').html(': ' + response.prothesa);
                    $('.aktifitas').html(': ' + response.aktifitas);
                    $('.status_psiko').html(': ' + response.status_psiko + ' (' + response
                        .ket_psiko +
                        ' )');
                    $('.edukasi').html(': ' + response.edukasi + ' (' + response.ket_edukasi +
                        ' )');
                    $('.hub_keluarga').html(': ' + response.hub_keluarga);
                    $('.ekonomi').html(': ' + response.ekonomi);
                    $('.pengasuh').html(': ' + response.pengasuh + ' ( ' + response.ket_pengasuh +
                        ' )');
                    $('.budaya').html(': ' + response.budaya + ' ( ' + response.ket_budaya + ' )');
                }
            });

        })

        function ambilAskepKebidanan(no_rkm_medis) {
            $.ajax({
                url: 'askep/kebidanan',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    let option = '';
                    response?.data?.map((data) => {
                        $('#select-askep-bidan').append('<option class="opt-askep-bidan" value=' + textRawat(data.no_rawat, '-') + '>' + formatTanggal(data.tanggal) + ' - ' + data.no_rawat + '</option>')
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
                        $('#modalAskep').modal('show');
                    })
                }
            });
        }

        function resep(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $('.no_rawat').val(response.no_rawat);
                    $('.nm_pasien').val(response.no_rkm_medis + ' / ' + response.pasien.nm_pasien + ' / ' +
                        response.umurdaftar + ' ' + response.sttsumur)
                }
            })
            $('#modalResep').modal('show');
        }
    </script>
@endpush
