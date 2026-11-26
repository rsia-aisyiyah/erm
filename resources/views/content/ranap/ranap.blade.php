@extends('index')
@push('style')
    <style>
        /* ======================================================
           RANAP KPI SUMMARY CARDS & MODERN FILTER UX
           ====================================================== */
        .ranap-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-top: 12px;
            margin-bottom: 12px;
        }

        .ranap-kpi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #2563eb;
            border-radius: 12px;
            padding: 11px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.04);
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
            text-align: left;
        }

        .ranap-kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        }

        .ranap-kpi-card.is-active {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.18);
        }

        .ranap-kpi-card.is-dirawat { border-left-color: #2563eb; }
        .ranap-kpi-card.is-masuk   { border-left-color: #16a34a; }
        .ranap-kpi-card.is-pulang  { border-left-color: #d97706; }
        .ranap-kpi-card.is-rujuk   { border-left-color: #dc2626; }

        .ranap-kpi-icon {
            width: 42px;
            height: 42px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .ranap-kpi-card.is-dirawat .ranap-kpi-icon { background: #eff6ff; color: #2563eb; }
        .ranap-kpi-card.is-masuk   .ranap-kpi-icon { background: #f0fdf4; color: #16a34a; }
        .ranap-kpi-card.is-pulang  .ranap-kpi-icon { background: #fffbeb; color: #d97706; }
        .ranap-kpi-card.is-rujuk   .ranap-kpi-icon { background: #fef2f2; color: #dc2626; }

        .ranap-kpi-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.35px;
            color: #64748b;
        }

        .ranap-kpi-value {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.15;
            margin: 2px 0;
        }

        .ranap-kpi-sub {
            font-size: 10.5px;
            color: #64748b;
        }

        .ranap-filter-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
            margin-bottom: 12px;
            overflow: hidden;
        }

        .ranap-filter-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 9px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ranap-filter-body {
            padding: 12px 14px;
        }

        .ranap-status-pills {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 4px;
            background: #f1f5f9;
            padding: 3px;
            border-radius: 9px;
            border: 1px solid #e2e8f0;
        }

        .ranap-status-pills .btn {
            border-radius: 7px !important;
            border: 0 !important;
            font-size: 11.5px;
            font-weight: 600;
            padding: 5px 11px;
            color: #475569;
            background: transparent;
        }

        .ranap-status-pills .btn-check:checked + .btn {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(37, 99, 235, 0.28);
        }

        .ranap-status-pills .btn-check:checked + .btn.is-masuk-pill {
            background: #16a34a;
            box-shadow: 0 2px 6px rgba(22, 163, 74, 0.28);
        }

        .ranap-status-pills .btn-check:checked + .btn.is-pulang-pill {
            background: #d97706;
            box-shadow: 0 2px 6px rgba(217, 119, 6, 0.28);
        }

        .ranap-status-pills .btn-check:checked + .btn.is-rujuk-pill {
            background: #dc2626;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.28);
        }

        .ranap-filter-lbl {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            margin-bottom: 4px;
            display: block;
        }

        @media (max-width: 991.98px) {
            .ranap-kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575.98px) {
            .ranap-kpi-card {
                padding: 9px 10px;
            }
            .ranap-kpi-icon {
                width: 34px;
                height: 34px;
                font-size: 16px;
            }
            .ranap-kpi-value {
                font-size: 18px;
            }
        }
    </style>
@endpush
@section('contents')
    {{-- Display Statistik Pasien Rawat Inap (Otomatis mengikuti tanggal & filter tabel) --}}
    <div class="ranap-kpi-grid" id="ranapStatDisplay">
        <button type="button" class="ranap-kpi-card is-dirawat is-active" id="kpiCardDirawat" onclick="pilihStatusRanapCepat('-')" title="Klik untuk menampilkan pasien yang sedang dirawat">
            <div class="min-w-0">
                <div class="ranap-kpi-title">Sedang Dirawat</div>
                <div class="ranap-kpi-value text-primary" id="statRanapDirawat">-</div>
                <div class="ranap-kpi-sub">Pasien aktif di bangsal</div>
            </div>
            <div class="ranap-kpi-icon"><i class="bi bi-hospital"></i></div>
        </button>

        <button type="button" class="ranap-kpi-card is-masuk" id="kpiCardMasuk" onclick="pilihStatusRanapCepat('Masuk')" title="Klik untuk menampilkan pasien baru masuk pada periode ini">
            <div class="min-w-0">
                <div class="ranap-kpi-title">Pasien Baru Masuk</div>
                <div class="ranap-kpi-value text-success" id="statRanapMasuk">-</div>
                <div class="ranap-kpi-sub ranap-stat-periode-label">Hari ini</div>
            </div>
            <div class="ranap-kpi-icon"><i class="bi bi-box-arrow-in-right"></i></div>
        </button>

        <button type="button" class="ranap-kpi-card is-pulang" id="kpiCardPulang" onclick="pilihStatusRanapCepat('Pulang')" title="Klik untuk menampilkan pasien pulang pada periode ini">
            <div class="min-w-0">
                <div class="ranap-kpi-title">Pasien Pulang</div>
                <div class="ranap-kpi-value text-warning-emphasis" id="statRanapPulang">-</div>
                <div class="ranap-kpi-sub ranap-stat-periode-label">Hari ini</div>
            </div>
            <div class="ranap-kpi-icon"><i class="bi bi-box-arrow-right"></i></div>
        </button>

        <button type="button" class="ranap-kpi-card is-rujuk" id="kpiCardRujuk" onclick="pilihStatusRanapCepat('Rujuk')" title="Klik untuk menampilkan pasien rujuk pada periode ini">
            <div class="min-w-0">
                <div class="ranap-kpi-title">Pasien Rujuk</div>
                <div class="ranap-kpi-value text-danger" id="statRanapRujuk">-</div>
                <div class="ranap-kpi-sub ranap-stat-periode-label">Hari ini</div>
            </div>
            <div class="ranap-kpi-icon"><i class="bi bi-send-exclamation-fill"></i></div>
        </button>
    </div>

    {{-- Modern Filter Panel Rawat Inap --}}
    <div class="ranap-filter-card">
        <div class="ranap-filter-header">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="fw-bold text-dark d-inline-flex align-items-center gap-1" style="font-size: 12.5px;">
                    <i class="bi bi-funnel-fill text-primary"></i>
                    <span>Filter Pasien Rawat Inap</span>
                </span>
                <span class="badge text-bg-light border text-secondary" id="ranapActivePeriodBadge" style="font-size: 10.5px;">
                    <i class="bi bi-calendar3 me-1"></i>Hari Ini
                </span>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('ranap.pemeriksaan-ranap.index') }}" target="_blank"
                    class="btn btn-outline-primary btn-sm text-nowrap py-1 px-2" style="font-size: 11.5px;">
                    <i class="bi bi-journal-text me-1"></i>CPPT Harian
                </a>
                <button type="button" class="btn btn-outline-danger btn-sm text-nowrap py-1 px-2" style="font-size: 11.5px;"
                    onclick="showTabelHasilKritis()" title="Monitoring Pelaporan Nilai Kritis">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Nilai Kritis
                </button>
            </div>
        </div>

        <div class="ranap-filter-body">
            <form action="" id="formFilterRanap" class="mb-0">
                {{-- Baris 1: Status Pasien (Segmented Pills) + Rentang Tanggal --}}
                <div class="row g-2 align-items-end mb-2 pb-2 border-bottom">
                    <div class="col-12 col-lg-auto">
                        <span class="ranap-filter-lbl">Status Perawatan</span>
                        <div class="ranap-status-pills" role="group" aria-label="Status Rawat Inap">
                            <input class="btn-check" type="radio" id="belum" name="stts_pulang" value="Belum Pulang" checked autocomplete="off">
                            <label class="btn" for="belum"><i class="bi bi-hospital me-1"></i>Belum Pulang</label>

                            <input class="btn-check" type="radio" id="masuk" name="stts_pulang" value="masuk" autocomplete="off">
                            <label class="btn is-masuk-pill" for="masuk"><i class="bi bi-box-arrow-in-right me-1"></i>Masuk</label>

                            <input class="btn-check" type="radio" id="pulang" name="stts_pulang" value="pulang" autocomplete="off">
                            <label class="btn is-pulang-pill" for="pulang"><i class="bi bi-box-arrow-right me-1"></i>Pulang</label>

                            <input class="btn-check" type="radio" id="rujuk" name="stts_pulang" value="rujuk" autocomplete="off">
                            <label class="btn is-rujuk-pill" for="rujuk"><i class="bi bi-send-exclamation me-1"></i>Rujuk</label>
                        </div>
                    </div>

                    {{-- Grup Tanggal Masuk (juga jadi periode referensi saat Belum Pulang) --}}
                    <div class="col-12 col-md-6 col-lg-4" id="wrapTglMasuk">
                        <label for="tgl_masuk_awal" class="ranap-filter-lbl" id="lblTglMasuk">Periode Tanggal (Statistik &amp; Masuk)</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar-event text-primary"></i></span>
                            <input type="text" class="form-control tanggal tgl_masuk"
                                id="tgl_masuk_awal" name="tgl_masuk_awal" autocomplete="off">
                            <span class="input-group-text">s/d</span>
                            <input type="text" class="form-control tanggal tgl_masuk"
                                id="tgl_masuk_akhir" name="tgl_masuk_akhir" autocomplete="off">
                        </div>
                    </div>

                    {{-- Grup Tanggal Pulang / Rujuk --}}
                    <div class="col-12 col-md-6 col-lg-4 d-none" id="wrapTglPulang">
                        <label for="tgl_pulang_awal" class="ranap-filter-lbl" id="lblTglPulang">Periode Tanggal Pulang / Rujuk</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="bi bi-calendar-check text-warning"></i></span>
                            <input type="text" class="form-control tanggal tgl_pulang"
                                id="tgl_pulang_awal" name="tgl_pulang_awal" autocomplete="off" disabled>
                            <span class="input-group-text">s/d</span>
                            <input type="text" class="form-control tanggal tgl_pulang"
                                id="tgl_pulang_akhir" name="tgl_pulang_akhir" autocomplete="off" disabled>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-auto ms-lg-auto d-flex align-items-center gap-1 flex-wrap">
                        <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="setQuickRanapDate(0)" style="font-size: 11px;">Hari Ini</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="setQuickRanapDate(2)" style="font-size: 11px;">3 Hari</button>
                        <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="setQuickRanapDate(6)" style="font-size: 11px;">7 Hari</button>
                    </div>
                </div>

                {{-- Baris 2: Filter Spesialis, Dokter DPJP, Bangsal/Kamar & Tombol Aksi --}}
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="spesialis" class="ranap-filter-lbl">Spesialis</label>
                        <select name="spesialis" id="spesialis" class="form-select form-select-sm select2" style="width:100%">
                            <option value="" selected>Semua Spesialis</option>
                            <option value="S0001">Spesialis Kebidanan &amp; Kandungan</option>
                            <option value="S0003">Spesialis Anak</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                        <label for="dokter" class="ranap-filter-lbl">Dokter DPJP</label>
                        <select name="dokter" id="dokter" class="form-select form-select-sm select2" style="width:100%">
                            <option value="" selected>Semua Dokter</option>
                            <option value="1.113.1023" class="S0001">dr. Achmad Dahlan Kadir, Sp.OG</option>
                            <option value="1.101.1112" class="S0003">dr. Himawan Budityastomo, Sp.OG</option>
                            <option value="1.109.1119" class="S0003">dr. Siti Pattihatun Nasyiroh, Sp.OG</option>
                            <option value="1.116.0926" class="S0003">dr. Ilham Rizka Putra, Sp.OG</option>
                            <option value="1.111.1221" class="S0001">dr. Rendy Yoga Ardian, Sp.A</option>
                            <option value="1.227.0824" class="S0001">dr. Alifa Nofia Febriani, Sp.A</option>
                            <option value="1.210.0825" class="S0001">dr. Hanif Hary Setyawan, Sp.A</option>
                            <option value="1.107.0317" class="S0001">dr. Dwi Riyanto, Sp.A</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="cari-kamar" class="ranap-filter-lbl">Cari Bangsal / Kamar</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light"><i class="bi bi-door-open text-secondary"></i></span>
                            <input type="search" id="cari-kamar" name="cari-kamar" class="form-control"
                                placeholder="Ketik nama bangsal..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col-12 col-lg-2 d-flex gap-2">
                        <button type="button" class="btn btn-success btn-sm flex-grow-1 fw-semibold" id="cari">
                            <i class="bi bi-search me-1"></i>Terapkan
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" id="btnResetFilterRanap" onclick="resetFilterRanap()" title="Reset semua filter">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('content.ranap.partials.dropdown_aksi_ranap')
    @include('content.ranap.partials.floating_kelengkapan_berkas')

    <table class="table table-hover text-sm table-sm" id="tb_ranap" width="100%">
        {{-- <thead>
            <tr role="row">
                <th></th>
                <th>No. Rawat</th>
                <th>Pasien</th>
                <th>Pembiayaan</th>
                <th>Kamar</th>
                <th>Lama</th>
                <th>Dokter</th>
                <th>Diag. Awal</th>
            </tr>
        </thead> --}}
    </table>

    @include('content.ranap.modal.modal_persetujuan_regional_anestesi')
    @include('content.ranap.modal.modal_hasil_kritis')
    @include('content.ranap.modal.modal_lab')
    @include('content.ranap.modal.modal_soap')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.ranap.modal.modal_asmed_anak')
    @include('content.ranap.modal.modal_asmed_kandungan')
    @include('content.ranap.modal.modal_askep_anak')
    @include('content.ranap.modal.modal_askep_neonatus')
    @include('content.ranap.modal.modal_askep_kandungan')
    @include('content.ranap.modal.modal_grafik_harian')
    @include('content.ranap.modal.modal_resume_ranap')
    @include('content.ranap.modal.modal_list_pemeriksaan')
    @include('content.ranap.modal.modal_list_pemeriksaan_asmed')
    @include('content.ranap.modal.modal_list_diagnosa')
    @include('content.ranap.modal.modal_riwayat_vaksin')
    @include('content.ranap.modal.modal_riwayat_asmed_kandungan')
    @include('content.ranap.modal.modal_riwayat_persalinan')
    @include('content.ranap.modal.modal_poc')
    @include('content.ranap.modal.modal_skrining_tb')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.ranap.modal.modal_catatan_edukasi_pasien')
    @include('content.ranap.modal.cppt.gizi._modalListAntropometri')
    @include('content.ranap.modal.cppt.gizi._modalListBiokimia')
    @include('content.ranap.modal.modal_monitoring_cairan')
    @include('content.ranap.modal.modal_edukasi_obat_pulang')
    @include('content.ranap.modal.modal_discharge_planning')
    @include('content.ranap.modal.modal_skrining_gizi')
    @include('content.ranap.modal.modal_permintaan_diet')
    @include('content.ranap.modal.modal_resep_pulang')
    @include('content.ranap.modal.modal_permintaan_resep_pulang')
    @include('content.ranap.modal.modal_retur_obat')
    @include('content.ranap.modal.modal_asesmen_nyeri_dewasa')
    @include('content.ranap.modal.modal_asesmen_nyeri_batita_flacc')
    @include('content.ranap.modal.modal_asesmen_nyeri_balita')
    @include('content.ranap.modal.modal_asesmen_nyeri_anak')
    @include('content.ranap.modal.modal_asesmen_nyeri_neonatus')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_dewasa')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_anak')
    @include('content.poliklinik.modal.modal_icare')
    @include('content.ugd.modal.asmed')
    @include('content.ranap.modal.modal_persetujuan_ppra')
    @include('content.ranap.modal.modal_transfer_pasien')
    @include('content.ranap.modal.modal_asesmen_geriatri')
    @include('content.ranap.modal.modal_permintaan_stok_obat_pasien')
    @include('content.ranap.modal.modal_pemberian_obat_pasien')
    @include('content.ranap.modal.modal_retur_stok_udd')
    @include('content.ranap.partials.floating_monitoring_pulang')

    <div class="modal fade" id="modalEwsRanap" tabindex="-1" aria-labelledby="modalEwsRanapLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEwsRanapLabel">Tambah Nilai EWS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formEwsRanap">
                        <div class="row gy-2 infoEws">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="nip">Petugas</label>
                                <x-input type="hidden" value="{{ session()->get('pegawai')->nik }}" name="nik"
                                    id="nik"></x-input>
                                <x-input value="{{ session()->get('pegawai')->nama }}" name="nm_pegawai" id="nm_pegawai"
                                    readonly=""></x-input>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="tgl_perawatan">Tanggal</label>
                                <x-input type="date" value="" name="tgl_perawatan"
                                    id="tgl_perawatan"></x-input>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label for="jam_rawat">Tanggal</label>
                                <x-input type="time" value="" name="jam_rawat" id="jam_rawat"
                                    step="1"></x-input>
                            </div>
                        </div>
                        <hr />
                        <div class="row parameterEws">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="suhu_tubuh">Suhu (<sup>0</sup>C)</label>
                                <x-input id="suhu_tubuh" name="suhu_tubuh"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="tensi">Tensi (mmHG)</label>
                                <x-input id="tensi" name="tensi"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="respirasi">Respirasi (x/mnt)</label>
                                <x-input id="respirasi" name="respirasi"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="nadi">Nadi (x/mnt)</label>
                                <x-input id="nadi" name="nadi"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="spo2">SpO2 (%)</label>
                                <x-input id="spo2" name="spo2"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="gcs">GCS (EVM)</label>
                                <x-input id="gcs" name="gcs"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="o2">Oksigen (%)</label>
                                <x-input id="o2" name="o2"></x-input>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="kesadaran">Kesadaran</label>
                                <select name="kesadaran" id="kesadaran" class="form-select">
                                    <option value="Compos Mentis" selected>Compos Mentis</option>
                                    <option value="Confusion">Confusion</option>
                                    <option value="Pain">Pain</option>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="maternal">
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="keluaran_urin">Keluaran Urin :</label>
                                <select class="form-select" name="keluaran_urin" id="keluaran_urin">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Y">Y</option>
                                    <option value="T">T</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="proteinuria">Proteinuria :</label>
                                <select class="form-select" name="proteinuria" id="proteinuria">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="++">++</option>
                                    <option value="+++">+++</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="air_ketuban">Air Ketuban :</label>
                                <select class="form-select" name="air_ketuban" id="air_ketuban">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Jernih">Jernih/Pink</option>
                                    <option value="Hijau">Hijau</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="skala_nyeri">Skala Nyeri</label>
                                <select class="form-select" name="skala_nyeri" id="skala_nyeri">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="lochia">Lochia : </label>
                                <select class="form-select" name="lochia" id="lochia">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Banyak">Banyak</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="lochia">Respon Neurologis : </label>
                                <select class="form-select" name="kesadaran_maternal" id="kesadaran_maternal">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Sadar">Sadar</option>
                                    <option value="Verbal">Verbal</option>
                                    <option value="Nyeri">Nyeri</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                                <label for="terlihat_tidak_sehat">Terlihat Tidak Sehat </label>
                                <select class="form-select" name="terlihat_tidak_sehat" id="terlihat_tidak_sehat">
                                    <option value="" style="display:none"></option>
                                    <option value="-" selected>-</option>
                                    <option value="Tidak" selected>Tidak</option>
                                    <option value="Ya">Ya</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                            class="bi bi-x me-1"></i>
                        Close
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="createEwsRanap()"><i
                            class="bi bi-save me-1"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal ppra --}}
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/context-menu/ranap.js') }}"></script>
    <script>
        const formSoapPoli = $('#formSoapPoli');
        var stts_pulang = '-';
        var tgl_awal = '';
        var tgl_akhir = '';
        var jamSekarang = '';
        var cek = '';
        var kamar = localStorage.getItem('kamar');
        var sps = localStorage.getItem('spesialis') ? localStorage.getItem('spesialis') : '';
        var valScrollX = '';
        var cekDepartement = `{{ session()->get('pegawai')->departemen }}`
        var kd_dokter = localStorage.getItem('dokter') ? localStorage.getItem('dokter') : $('#kd_dokter').val();
        var getSpsId = $('#kd_sps').val();


        $(document).ready(function() {
            // new bootstrap.Tab('#tab-resep')
            new bootstrap.Tab('#tab-ews')
            new bootstrap.Tab('#tab-grafik')
            new bootstrap.Tab('#tab-tabel')

            date = new Date()
            const hari = ('0' + (date.getDate())).slice(-2);
            const bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            const tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                defaultDate: null,
                todayHighlight: true,
                todayBtn: true
            });

            $('#cari-kamar').val(kamar)
            $('.tanggal').datepicker('setDate', dateStart)
            syncRanapFilterDateVisibility();
            loadStatistikRanap();

            let isDokter = "{{ session()->get('pegawai')->dokter }}"

            let isSpesialis = "{{ session()->get('pegawai')->dokter?->kd_sps }}"

            kd_dokter = isDokter && isSpesialis != 'S0007' ? "{{ session()->get('pegawai')->nik }}" : '';
            tb_ranap();
            initFilterDokterSps()
        });

        $('#cari-kamar').on('search', function() {
            if ($(this).val() === '') {
                kamar = '';
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
                localStorage.removeItem('kamar')
            }
        })

        $('#spesialis').on('change', function() {
            sps = $('#spesialis option:selected').val();
            localStorage.setItem('spesialis', sps);
            if (sps) {
                $.ajax({
                    url: 'dokter/ambil',
                    data: {
                        'sps': sps,
                    },
                    success: function(response) {
                        let option = `<option value="" selected>Pilih Dokter</option>`;
                        response.data.forEach(function(res) {
                            $('#dokter').prop('disabled', false)
                            $('#dokter').empty();
                            option +=
                                `<option value="${res.kd_dokter}">${res.nm_dokter}</option>`;
                        })
                        $('#dokter').append(option);
                    }
                })
            } else {
                // $('#dokter').prop('disabled', true)
                // $('#dokter').empty();
                // option = '<option value="">Semua Dokter</option>'
                // $('#dokter').append(option);
                localStorage.removeItem('dokter')
                kd_dokter = '';

            }
            $('#tb_ranap').DataTable().destroy();
            tb_ranap();

            if (typeof loadMonitoringPulangRanap === 'function') {
                loadMonitoringPulangRanap();
            }
        })

        function initFilterDokterSps() {
            let isDokter = "{{ session()->get('pegawai')->dokter }}"
            let isSpesialis = "{{ session()->get('pegawai')->dokter?->kd_sps }}"
            kd_dokter = isDokter && isSpesialis != 'S0007' ? "{{ session()->get('pegawai')->nik }}" : '';

            if (kd_dokter) {
                $('#dokter').val(kd_dokter).trigger('change');
            }

            if (isSpesialis) {
                $('#spesialis').val(isSpesialis).trigger('change');
            }

            $('#dokter').select2({
                placeholder: 'Pilih Dokter',
                allowClear: true,
                ajax: {
                    url: "{{ route('dokter.ambil') }}",
                    data: function(params) {
                        return {
                            sps: $('#spesialis').val(),
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(function(dokter) {
                                return {
                                    id: dokter.kd_dokter,
                                    text: dokter.nm_dokter
                                };
                            })
                        };
                    }
                }
            })

        }

        $("#cari-kamar").bind('keypress', function(e) {
            // console.log($(this).val())
        })

        $('#cari-kamar').on('keyup', function() {
            kamar = $(this).val();
            if (kamar.length >= 5) {
                localStorage.setItem('kamar', kamar);
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            }

            if (kamar.length === 0) {
                localStorage.removeItem('kamar');
            }
        })

        $('#dokter').on('change', function() {
            kd_dokter = $(this).val();
            localStorage.setItem('dokter', kd_dokter)
            $('#tb_ranap').DataTable().destroy();
            tb_ranap();

            if (typeof loadMonitoringPulangRanap === 'function') {
                loadMonitoringPulangRanap();
            }
        })

        function syncRanapFilterDateVisibility() {
            const isKeluarMode = (stts_pulang === 'Pulang' || stts_pulang === 'Rujuk');
            $('#wrapTglPulang').toggleClass('d-none', !isKeluarMode);
            $('#wrapTglMasuk').toggleClass('d-none', isKeluarMode);
            $('.tgl_pulang').prop('disabled', !isKeluarMode);
            $('.tgl_masuk').prop('disabled', isKeluarMode);

            if (stts_pulang === 'Masuk') {
                $('#lblTglMasuk').text('Periode Tanggal Masuk');
            } else if (stts_pulang === '-') {
                $('#lblTglMasuk').text('Periode Statistik (Masuk / Pulang / Rujuk)');
            } else if (stts_pulang === 'Rujuk') {
                $('#lblTglPulang').text('Periode Tanggal Rujuk');
            } else {
                $('#lblTglPulang').text('Periode Tanggal Pulang');
            }

            // Highlight kartu KPI aktif
            $('.ranap-kpi-card').removeClass('is-active');
            if (stts_pulang === '-') $('#kpiCardDirawat').addClass('is-active');
            else if (stts_pulang === 'Masuk') $('#kpiCardMasuk').addClass('is-active');
            else if (stts_pulang === 'Pulang') $('#kpiCardPulang').addClass('is-active');
            else if (stts_pulang === 'Rujuk') $('#kpiCardRujuk').addClass('is-active');
        }

        function getActiveRanapDateRange() {
            const isKeluarMode = (stts_pulang === 'Pulang' || stts_pulang === 'Rujuk');
            const a = isKeluarMode ? $('#tgl_pulang_awal').val() : $('#tgl_masuk_awal').val();
            const b = isKeluarMode ? $('#tgl_pulang_akhir').val() : $('#tgl_masuk_akhir').val();
            return {
                awalDmy: a || '',
                akhirDmy: b || '',
                awalYmd: a ? splitTanggal(a) : '',
                akhirYmd: b ? splitTanggal(b) : '',
            };
        }

        function loadStatistikRanap() {
            const rng = getActiveRanapDateRange();
            $.ajax({
                url: '/erm/ranap/statistik',
                method: 'GET',
                dataType: 'JSON',
                ermSilent: true,
                data: {
                    tgl_pertama: rng.awalYmd,
                    tgl_kedua: rng.akhirYmd,
                    kd_dokter: kd_dokter || '',
                    spesialis: sps || '',
                    kamar: kamar || '',
                },
            }).done(function (res) {
                if (!res || !res.success) return;
                const st = res.stats || {};
                const per = res.periode || {};

                $('#statRanapDirawat').text(st.sedang_dirawat ?? 0);
                $('#statRanapMasuk').text(st.baru_masuk ?? 0);
                $('#statRanapPulang').text(st.pulang ?? 0);
                $('#statRanapRujuk').text(st.rujuk ?? 0);

                let periodeLabel = 'Hari ini';
                if (!per.is_today && per.awal && per.akhir) {
                    periodeLabel = (per.awal === per.akhir)
                        ? splitTanggal(per.awal)
                        : `${splitTanggal(per.awal)} s/d ${splitTanggal(per.akhir)}`;
                }
                $('.ranap-stat-periode-label').text(periodeLabel);
                $('#ranapActivePeriodBadge').html(`<i class="bi bi-calendar3 me-1"></i>${periodeLabel}`);
            });
        }

        function setQuickRanapDate(daysBack) {
            const end = new Date();
            const start = new Date();
            start.setDate(end.getDate() - Number(daysBack || 0));

            const fmt = (d) => `${String(d.getDate()).padStart(2, '0')}-${String(d.getMonth() + 1).padStart(2, '0')}-${d.getFullYear()}`;
            const startStr = fmt(start);
            const endStr = fmt(end);

            $('#tgl_masuk_awal, #tgl_pulang_awal').datepicker('setDate', startStr);
            $('#tgl_masuk_akhir, #tgl_pulang_akhir').datepicker('setDate', endStr);
            $('#cari').trigger('click');
        }

        function pilihStatusRanapCepat(statusKey) {
            if (statusKey === '-') {
                $('#belum').prop('checked', true);
                stts_pulang = '-';
            } else if (statusKey === 'Masuk') {
                $('#masuk').prop('checked', true);
                stts_pulang = 'Masuk';
            } else if (statusKey === 'Pulang') {
                $('#pulang').prop('checked', true);
                stts_pulang = 'Pulang';
            } else if (statusKey === 'Rujuk') {
                $('#rujuk').prop('checked', true);
                stts_pulang = 'Rujuk';
            }
            syncRanapFilterDateVisibility();
            $('#cari').trigger('click');
        }

        function resetFilterRanap() {
            $('#belum').prop('checked', true);
            stts_pulang = '-';
            sps = '';
            kd_dokter = '';
            kamar = '';
            localStorage.removeItem('spesialis');
            localStorage.removeItem('dokter');
            localStorage.removeItem('kamar');
            $('#spesialis').val('');
            $('#dokter').val(null).trigger('change.select2');
            $('#cari-kamar').val('');
            setQuickRanapDate(0);
            syncRanapFilterDateVisibility();
        }

        $('#pulang').on('click', function() {
            stts_pulang = 'Pulang';
            // Sinkronkan tanggal dari input masuk agar tidak loncat saat pindah tab status
            const a = $('#tgl_masuk_awal').val();
            const b = $('#tgl_masuk_akhir').val();
            if (a && b) {
                $('#tgl_pulang_awal').datepicker('setDate', a);
                $('#tgl_pulang_akhir').datepicker('setDate', b);
            }
            syncRanapFilterDateVisibility();
        });

        $('#rujuk').on('click', function() {
            stts_pulang = 'Rujuk';
            const a = $('#tgl_masuk_awal').val();
            const b = $('#tgl_masuk_akhir').val();
            if (a && b) {
                $('#tgl_pulang_awal').datepicker('setDate', a);
                $('#tgl_pulang_akhir').datepicker('setDate', b);
            }
            syncRanapFilterDateVisibility();
        });

        $('#masuk').on('click', function() {
            stts_pulang = 'Masuk';
            const a = $('#tgl_pulang_awal').val();
            const b = $('#tgl_pulang_akhir').val();
            if (a && b) {
                $('#tgl_masuk_awal').datepicker('setDate', a);
                $('#tgl_masuk_akhir').datepicker('setDate', b);
            }
            syncRanapFilterDateVisibility();
        });

        $('#belum').on('click', function() {
            stts_pulang = '-';
            syncRanapFilterDateVisibility();
        });

        $('#cari').on('click', function() {
            const rng = getActiveRanapDateRange();
            tgl_awal = rng.awalYmd;
            tgl_akhir = rng.akhirYmd;

            $('#tb_ranap').DataTable().destroy();
            tb_ranap();
            loadStatistikRanap();

            if (typeof loadMonitoringPulangRanap === 'function') {
                if (stts_pulang === 'Pulang' || stts_pulang === 'Rujuk') {
                    setRanapMonitorRange('filter');
                } else {
                    loadMonitoringPulangRanap();
                }
            }
        });

        // Otomatis sinkronkan KPI Display setiap kali tabel #tb_ranap memuat ulang (dari filter spesialis, dokter, kamar, dll.)
        $(document).on('xhr.dt', '#tb_ranap', function () {
            loadStatistikRanap();
        });

        function tb_ranap() {
            $('#tb_ranap').DataTable({
                processing: true,
                scrollX: true,
                scrollY: "60vh",
                stateSave: true,
                ordering: true,
                paging: false,
                info: false,
                destroy: true,
                ajax: {
                    url: `ranap/pasien`,
                    data: {
                        'stts_pulang': stts_pulang,
                        'tgl_pertama': tgl_awal,
                        'tgl_kedua': tgl_akhir,
                        'kd_dokter': kd_dokter,
                        'kamar': kamar,
                        'spesialis': sps,

                    },
                },
                columnDefs: [{
                        target: 0,
                        width: 10,
                    }, {
                        target: 1,
                        width: 80,
                    }, {
                        target: 2,
                        width: 250,
                    },
                    {
                        target: 3,
                        width: 150,
                    }, {
                        target: 4,
                        width: 80,
                    }, {
                        target: 5,
                        width: 20,
                    }, {
                        target: 6,
                        width: 100,
                    }, {
                        target: 7,
                        width: 50,
                    }, {
                        target: 8,
                        width: 180,
                    }, {
                        target: 9,
                        width: 150,
                    }
                ],
                createdRow: (element, data, index, meta) => {
                    const row = $(element);
                    const dataAttr = {
                        'no_rawat': data.no_rawat,
                        'no_rkm_medis': data.reg_periksa.no_rkm_medis,
                        'kd_dokter': data.reg_periksa.kd_dokter,
                        'tgl_lahir': data.pasien.tgl_lahir,
                        'umurdaftar': data.reg_periksa.umurdaftar,
                        'tgl_reg': data.reg_periksa.tgl_registrasi,
                        'sttsumur': data.reg_periksa.sttsumur,
                        'no_peserta': data.pasien.no_peserta,
                        'kd_dokter_bpjs': data.reg_periksa.dokter.mapping_dokter.kd_dokter_bpjs,
                        'kd_pj': data.reg_periksa.kd_pj,
                        'kd_sps': data.reg_periksa.dokter.kd_sps
                    }

                    row.attr('data-pasien', JSON.stringify(dataAttr))
                        .addClass('row-ranap');

                    const asmedAnak = data.asmed_anak;
                    const asmedKandungan = data.asmed_kandungan;
                    const asmedUmumBBL = data.asmed_umum;

                    if (asmedAnak === null && asmedKandungan === null) {
                        row.addClass('table-danger')
                    }

                    if (data.reg_periksa.umurdaftar === '0' && data.reg_periksa.sttsumur === 'Hr') {
                        if (asmedUmumBBL === null) {
                            row.addClass('table-danger')
                        }
                    }

                    const alertContainer = $('<div class="infection-alert mt-2"></div>');
                    row.find('td:eq(10)').append(alertContainer);

                    if (!window.labAlertCache) {
                        window.labAlertCache = {};
                    }

                    const noRkmMedis = dataAttr.no_rkm_medis;

                    if (window.labAlertCache[noRkmMedis]) {
                        renderInfectionAlertRow(alertContainer, window.labAlertCache[noRkmMedis], noRkmMedis);
                        return;
                    }

                    $.get(`/erm/lab/riwayat-hasil/${noRkmMedis}`)
                        .done(response => {
                            window.labAlertCache[noRkmMedis] = response.infection_alert;
                            renderInfectionAlertRow(alertContainer, response.infection_alert, noRkmMedis);

                            if (response.infection_alert?.highest_risk === 'HIGH') {
                                $(`#pasien[data-no-rkm-medis="${noRkmMedis}"]`)
                                    .addClass('text-danger fw-bold').attr('onclick',
                                        `showLabInfectionAlert('${noRkmMedis}')`);
                            }
                        });

                },
                columns: [{
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            // 1. Validasi Data Dokter
                            if (!data.dokter) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan ID Dokter ${row}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                });
                                return false;
                            }

                            // Fungsi utilitas bawaan kode Anda (jika dipakai di tempat lain)
                            const textNoRawat = textRawat(row.no_rawat);

                            // 2. Buat elemen list item (Li) menu dropdown terkategori
                            let listItems = buildCategorizedMenuRanap(data, row);

                            // 3. Bungkus list ke dalam komponen Dropdown Bootstrap
                            return buildDropdownButton(meta.row, row.no_rawat, listItems);
                        }
                    },
                    {
                        title: 'No. Rawat',
                        data: 'no_rawat',
                        render: function(data) {
                            return `<a href="javascript:void(0)" class="text-dark" style="text-decoration: none " onclick="showModalSoapRanap('${data}')">${data}</a>`
                        }
                    },
                    {
                        title: 'Pasien',
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {

                            const umurdaftar = hitungUmurDaftar(data.pasien.tgl_lahir, data.tgl_registrasi);
                            const umur =
                                `<small class="text-muted">${umurdaftar.tahun} tahun ${umurdaftar.bulan} bulan ${umurdaftar.hari} hari</small>`;
                            const labelJK = data.pasien.jk === 'L' ?
                                '<span class="badge bg-info"><i class="bi bi-gender-male"></i></span>' :
                                '<span style="background-color: #ff6aaf;" class="badge"><i class="bi bi-gender-female"></i></span>';

                            // Perbaikan di bagian ini: Menggunakan d-flex dan align-items-center
                            pasien =
                                `
                                                                                                            <div class="m-0" onclick="showModalSoapRanap('${data.no_rawat}')" style="cursor:pointer">
                                                                                                                <div class="d-flex align-items-center gap-2 mt-1">
                                                                                                                    ${labelJK}
                                                                                                                    <span>
                                                                                                                        <strong>${data.no_rkm_medis} <br/>${data.pasien.nm_pasien}</strong>
                                                                                                                        <br/>
                                                                                                                        ${umur}
                                                                                                                    </span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                                        `;

                            let bayiGabung = '';

                            if (row.ranap_gabung) {
                                const regPeriksa = row.ranap_gabung.reg_periksa;
                                const noRawatBayi = regPeriksa.no_rawat;

                                // 1. Dapatkan menu resume medis berdasarkan hak akses departemen
                                const resumeMenu = getResumeMenuBayi(row);

                                // 2. Dapatkan list menu lengkap untuk bayi
                                const listMenuBayi = getListMenuBayi(regPeriksa, resumeMenu);

                                // 3. Gabungkan nama bayi dengan bungkus dropdown-nya
                                const namaBayiDropdown = `
                                            <a class="dropdown-toggle btn btn-warning btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                ${regPeriksa.pasien.nm_pasien}
                                            </a>
                                            <ul class="dropdown-menu" style="font-size:11px">
                                                ${listMenuBayi}
                                            </ul>
                                        `;

                                // 4. Output akhir komponen bayi gabung (Berjejer ke bawah)
                                bayiGabung = `
                            <hr style="margin:6px 0; border-top: 1px dashed #ccc;"/>
                            <div class="d-flex flex-column gap-1 small">
                                <span class="text-muted" style="font-size: 10px;">${noRawatBayi}</span>
                                <div>
                                    <strong>${namaBayiDropdown}</strong>
                                </div>
                            </div>
                        `;
                            }


                            return `
                                                                                    <span id="pasien" data-no-rkm-medis="${data.no_rkm_medis}">${pasien}</span> ${bayiGabung}`;

                        },
                        name: 'reg_periksa',
                    },

                    {
                        title: 'Kamar',
                        data: 'kamar',
                        render: function(data) {
                            return data.bangsal.nm_bangsal;
                        },
                        name: 'kamar',
                    },
                    {
                        title: 'Tgl. Masuk',
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            return `${splitTanggal(data.tgl_registrasi)} ${data.jam_reg}`;
                        },
                        name: 'tgl_masuk',
                    },
                    {
                        title: 'Lama',
                        data: 'lama',
                        render: function(data, type, row) {
                            return `${data} Hari`;
                        },
                        name: 'lama',
                    },
                    {
                        title: 'Diag. Awal',
                        data: '',
                        name: 'diagnosa',
                        render: function(data, type, row) {
                            const asmedAnak = row.asmed_anak;
                            const asmedKandungan = row.asmed_kandungan;
                            const asmedUmumBBL = row.asmed_umum;

                            if (asmedAnak) {
                                return asmedAnak.diagnosis;
                            } else if (asmedKandungan) {
                                return asmedKandungan.diagnosis;
                                // return moment(asmedKandungan.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else if (asmedUmumBBL) {
                                return asmedUmumBBL.diagnosis;
                                // return moment(asmedUmumBBL.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else {
                                return '<span class="text-danger"><b>Belum Ada Asmed</b></span>'
                            }
                        }
                    },
                    {
                        title: 'Asesmen Medis',
                        render: (data, type, row) => {
                            const asmedAnak = row.asmed_anak;
                            const asmedKandungan = row.asmed_kandungan;
                            const asmedUmumBBL = row.asmed_umum;

                            if (asmedAnak) {
                                return moment(asmedAnak.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else if (asmedKandungan) {
                                return moment(asmedKandungan.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            }

                            if (row.reg_periksa.umurdaftar === '0' && row.reg_periksa.sttsumur === 'Hr') {
                                if (asmedUmumBBL === null) {
                                    // row.addClass('table-danger')
                                    return moment(asmedUmumBBL.tanggal).format('DD-MM-YYYY HH:mm:ss');
                                }
                            }
                            // else if (asmedUmumBBL) {} else {
                            // }
                            return '<span class="text-danger"><b>Belum Ada Asmed</b></span>'

                            // if (data.reg_periksa.umurdaftar === '0' && data.reg_periksa.sttsumur === 'Hr') {
                            //     if (asmedUmumBBL === null) {
                            //         // row.addClass('table-danger')
                            //     }
                            // }
                            // return false;
                        }
                    },
                    {
                        title: 'Dokter DPJP',
                        data: 'reg_periksa',
                        render: function(data, type, row) {
                            let dokter = '';
                            if (!data.dokter) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan ID Dokter ${data.kd_dokter}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return '';
                            }
                            if (data.dokter) {
                                dokter = data.dokter.nm_dokter;
                            } else {
                                kd_dokter = data.kd_dokter.replace(/\s/g, '');
                                $.ajax({
                                    url: 'dokter/ambil',
                                    dataType: 'JSON',
                                    data: {
                                        'nik': kd_dokter,
                                    },
                                    success: function(response) {
                                        $.map(response.data, function(res) {
                                            $('.nm_dokter').text(res.nm_dokter);
                                        })
                                    }
                                });
                            }
                            dokterGabung = '';
                            if (row.ranap_gabung) {
                                namaBayi =
                                    dokterGabung =
                                    `<hr style="margin:0px"/>${row.ranap_gabung.reg_periksa.dokter.nm_dokter}`

                            }
                            return `<span class="nm_dokter">${dokter} ${dokterGabung}</span>`;
                        },
                        name: 'dokter'
                    },

                    {
                        title: 'Pembiayaan',
                        data: 'reg_periksa.penjab',
                        render: function(data) {
                            penjab =
                                `<span class="${data.kd_pj === 'A03' ? 'text-danger' : 'text-success'}"><b>${data.png_jawab}</b></span>`
                            return penjab;
                        },
                        name: 'penjab',
                    }, {
                        title: 'Catatan',
                        data: 'reg_periksa.no_rkm_medis',
                        render: function(data) {
                            return `<span class="" id="riwayat_lab_${data}"></span>`
                        },
                        name: 'no_rkm_medis',
                    },
                    {
                        title: 'Status',
                        data: 'stts_pulang',
                        render: function(data, type, row, meta) {
                            let tanggal = '';
                            if (data === '-') {
                                tanggal = ``;
                            } else {
                                tanggal =
                                    `${moment(row.tgl_keluar).format('DD-MM-YYYY')} ${row.jam_keluar}`;

                            }
                            return `${tanggal}<br>${data}`;
                        }
                    }
                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                    "search": "Pencarian",
                }
            })
        }

        function getTTVData(params) {
            let ttv = $.ajax({
                url: '/erm/soap/chart',
                data: {
                    'no_rawat': params,
                },
                dataType: 'JSON',
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return ttv;
        }

        function showRiwayatAsmedKandungan(rawat, no_rkm_medis) {
            $('#tbRiwayatAsmed tbody').empty()
            const urlAsmed = rawat === 'ranap' ? `asmed/ranap/kandungan/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: urlAsmed,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli !== 'IGDK' && asmed.reg_periksa.kd_poli !== 'U0016') {
                            html = '<tr>'
                            html +=
                                `<td>${asmed.no_rawat}</td>
                                                                                                    <td>${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}</td>
                                                                                                    <td>${asmed.reg_periksa.poliklinik.nm_poli}</td>
                                                                                                    <td>${asmed.dokter.nm_dokter}</td>
                                                                                                    <td><button class="btn btn-success btn-sm" type="button" onclick="copyAsmedKandunganRanap('${asmed.no_rawat}')"><i class="bi bi-download"></i> Gunakan</button></td>`
                            html += '<tr>'
                            $('#tbRiwayatAsmed tbody').append(html)
                            $('#modalRiwayatAsmed').modal('show')
                        } else {
                            alertErrorAjax({
                                status: 404,
                                statusText: 'TIDAK ADA ASMED DARI POLI',
                                responseJSON: {
                                    message: ''
                                }
                            })
                        }
                    })
                } else {
                    alertErrorAjax({
                        status: 404,
                        statusText: 'TIDAK ADA ASMED DARI POLI',
                        responseJSON: {
                            message: ''
                        }
                    })
                }
            }).fail((request) => {
                alertErrorAjax();
            })
        }

        function showRiwayatAsmedAnak(rawat, no_rkm_medis) {
            $('#tbRiwayatAsmed tbody').empty()
            const urlAsmed = rawat === 'ranap' ? `asmed/ranap/anak/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: urlAsmed,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli !== 'IGDK' && asmed.reg_periksa.kd_poli !== 'U0016') {
                            html = '<tr>'
                            html +=
                                `<td>${asmed.no_rawat}</td>
                                                                                            <td>${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}</td>
                                                                                            <td>${asmed.reg_periksa.poliklinik.nm_poli}</td>
                                                                                            <td>${asmed.dokter.nm_dokter}</td>
                                                                                            <td><button class="btn btn-success btn-sm" type="button" onclick="copyAsmedAnakRanap('${asmed.no_rawat}')"><i class="bi bi-download"></i> Gunakan</button></td>`
                            html += '<tr>'
                            $('#tbRiwayatAsmed tbody').append(html)
                            $('#modalRiwayatAsmed').modal('show')
                        } else {
                            alertErrorAjax({
                                status: 404,
                                statusText: 'TIDAK ADA ASMED DARI POLI',
                                responseJSON: {
                                    message: ''
                                }
                            })
                        }
                    })
                } else {
                    alertErrorAjax({
                        status: 404,
                        statusText: 'TIDAK ADA ASMED DARI POLI',
                        responseJSON: {
                            message: ''
                        }
                    })
                }
            }).fail((request) => {
                alertErrorAjax();
            })
        }

        function copyAsmedKandunganRanap(no_rawat) {
            getAsmedRanapKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);
                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            if (index === 'no_rawat') {
                                $(`#formAsmedRanapKandungan input[name=no_rawat_2]`).val(value)
                                $(`#modalAsmedRanapKandungan button[name=simpan]`).attr('onclick',
                                    `replaceAsmedRanapKandungan('${value}')`)
                            } else {
                                $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                            }
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                    $(`#formAsmedRanapKandungan input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                }
                alertSuccessAjax('Berhasil tarik data asesmen').then(() => {
                    $('#modalRiwayatAsmed').modal('hide')
                })
            })
        }

        function copyAsmedAnakRanap(no_rawat) {
            getAsmedRanapAnak(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);
                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            if (index === 'no_rawat') {
                                $(`#formAsmedRanapAnak input[name=no_rawat_2]`).val(value)
                                $(`#modalAsmedRanapAnak button[name=simpan]`).attr('onclick',
                                    `replaceAsmedRanapAnak('${value}')`)
                            } else {
                                $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                            }
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                }
                alertSuccessAjax('Berhasil tarik data asesmen').then(() => {
                    $('#modalRiwayatAsmed').modal('hide')
                })
            })
        }

        function asmedRanapKandungan(noRawat) {
            const kd_dokter = "{{ session()->get('pegawai')->nik }}"
            const nm_dokter = "{{ session()->get('pegawai')->nama }}"
            $('#formAsmedRanapKandungan input[name=kd_dokter]').val(kd_dokter);
            $('#formAsmedRanapKandungan input[name=nm_dokter]').val(nm_dokter);
            getRegPeriksa(noRawat).done((response) => {
                $('#formAsmedRanapKandungan input[name=no_rawat]').val(response.no_rawat);
                $('#formAsmedRanapKandungan input[name=pasien]').val(response.pasien.nm_pasien + ' (' + response
                    .pasien.jk + ')');
                $('#formAsmedRanapKandungan input[name=tgl_lahir]').val(formatTanggal(response.pasien.tgl_lahir) +
                    ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#formAsmedRanapKandungan button[name=riwayatAsmedRanap]').attr('onclick',
                    `showRiwayatAsmedKandungan('ranap', '${response.no_rkm_medis}')`);
            }).fail((request) => {
                if (request.status === 401) {
                    Swal.fire({
                        title: 'Sesi login berakhir !',
                        icon: 'info',
                        text: 'Silahkan login kembali ',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/erm';
                        }
                    })
                }
            })

            getAsmedRanapKandungan(noRawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                    $('#btnPrintAsmedRanapKandungan').attr('href',
                        `/erm/asmed/ranap/kandungan/print?no_rawat=${noRawat}`).removeClass('d-none');
                } else {
                    $('#btnPrintAsmedRanapKandungan').attr('href', `javascript:void(0)`).addClass('d-none');

                }
            })
            $('#formAsmedRanapKandungan .srcPemeriksaanAsmed').attr('onclick',
                `listRiwayatTtv('${noRawat}', 'ttv', 'formAsmedRanapAnak')`);
            $('#modalAsmedRanapKandungan').modal('show')
            $('#modalAsmedRanapKandungan button[name=simpan]').attr('onclick', `simpanAsmedRanapKandungan()`)
        }

        function asmedRanapAnak(noRawat) {
            const kd_dokter = "{{ session()->get('pegawai')->nik }}"
            const nm_dokter = "{{ session()->get('pegawai')->nama }}"
            $('#formAsmedRanapAnak input[name=kd_dokter]').val(kd_dokter);
            $('#formAsmedRanapAnak input[name=nm_dokter]').val(nm_dokter);
            getRegPeriksa(noRawat).done((response) => {
                $('#formAsmedRanapAnak input[name=no_rawat]').val(response.no_rawat);
                $('#formAsmedRanapAnak input[name=pasien]').val(response.pasien.nm_pasien + ' (' + response.pasien
                    .jk + ')');
                $('#formAsmedRanapAnak input[name=tgl_lahir]').val(formatTanggal(response.pasien.tgl_lahir) + ' (' +
                    hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#formAsmedRanapAnak button[name=riwayatAsmedRanap]').attr('onclick',
                    `showRiwayatAsmedAnak('ranap', '${response.no_rkm_medis}')`);
            });
            getAsmedRanapAnak(textRawat(noRawat, '-')).done((response) => {
                if (Object.keys(response).length) {
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).attr('readonly', 'readonly')
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })

                    $('#btnPrintAsmedRanapAnak').attr('href', `/erm/asmed/ranap/anak/print?no_rawat=${noRawat}`)
                        .removeClass('d-none');
                } else {
                    $('#btnPrintAsmedRanapAnak').attr('href', `javascript:void(0)`).addClass('d-none');
                }
            })
            $('#formAsmedRanapAnak .srcPemeriksaanAsmed').attr('onclick',
                `listRiwayatTtv('${noRawat}', 'ttv', 'formAsmedRanapAnak')`);
            $('#modalAsmedRanapAnak button[name=simpan]').attr('onclick', 'simpanAsmedRanapAnak()')
            $('#modalAsmedRanapAnak').modal('show')
        }

        $("#modalSoapRanap").on('hidden.bs.modal', function() {
            if (typeof grafikPemeriksaan !== 'undefined' && grafikPemeriksaan) {
                grafikPemeriksaan.destroy();
                grafikPemeriksaan = null;
            }

            if (typeof tableGrafikHarian !== 'undefined' && tableGrafikHarian && typeof tableGrafikHarian
                .fnDestroy === 'function') {
                tableGrafikHarian.fnDestroy();
                tableGrafikHarian = null;
            }
        });

        // Komponen dropdown aksi dipisahkan di: resources/views/content/ranap/partials/dropdown_aksi_ranap.blade.php

        function getResumeMenuBayi(row) {
            const isDokter = "{{ session()->get('pegawai')->departemen }}";
            const grupAksesResume = ['Direksi', 'SPS', '-', 'CSM'];

            if (grupAksesResume.includes(isDokter)) {
                const iconCheck = row.resume ? '<i class="bi bi-check-circle text-success ms-1"></i>' : '';
                return `<li><a class="dropdown-item" href="#" onclick="resumeMedis('${row.ranap_gabung.reg_periksa.no_rawat}')"><i class="bi bi-file-text text-dark me-1"></i> Resume Medis ${iconCheck}</a></li>`;
            }

            return ''; // Kembalikan string kosong jika tidak punya akses
        }

        function getListMenuBayi(regPeriksa, resumeMenu) {
            let list = '';
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang('${regPeriksa.no_rawat}')"><i class="bi bi-file-earmark-medical text-primary me-1"></i> Laborat</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" data-kd-dokter="${regPeriksa.kd_dokter}" onclick="showModalSoapRanap('${regPeriksa.no_rawat}')"><i class="bi bi-journal-medical text-info me-1"></i> CPPT</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak('${regPeriksa.no_rawat}')"><i class="bi bi-person-badge text-primary me-1"></i> Asesmen Medis Anak ${cekList(regPeriksa.asmed_ranap_anak)}</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapNeonatus('${regPeriksa.no_rawat}')"><i class="bi bi-heart-pulse text-danger me-1"></i> Asesmen Keperawatan Neonatus ${cekList(regPeriksa.askep_ranap_neonatus)}</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPenunjangRanap('${regPeriksa.no_rawat}')"><i class="bi bi-file-earmark-medical text-primary me-1"></i> Pemeriksaan Penunjang</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPermintaanObatRanap('${regPeriksa.no_rawat}')"><i class="bi bi-cart-plus text-success me-1"></i> Permintaan Obat</a></li>`;
            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemberianObatRanap('${regPeriksa.no_rawat}')"><i class="bi bi-capsule-pill text-primary me-1"></i> Jadwal & Pemberian Obat (E-MAR)</a></li>`;

            // Memasukkan menu resume jika ada aksesnya
            if (resumeMenu) {
                list += resumeMenu;
            }

            list +=
                `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${regPeriksa.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${regPeriksa.no_rkm_medis}"><i class="bi bi-clock-history text-secondary me-1"></i> Riwayat Pemeriksaan</a></li>`;

            return list;
        }
    </script>
@endpush
