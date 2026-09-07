@extends('index')

@section('contents')

    <style>
        .clinic-page {
            padding: 4px 0 24px;
        }

        /* =========================
                   PAGE HEADER
                ========================= */
        .clinic-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }

        .clinic-page-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .clinic-page-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #eef6f0;
            color: #2f6b3c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .clinic-page-title h4 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #26332b;
        }

        .clinic-page-title p {
            margin: 3px 0 0;
            color: #7b8580;
            font-size: 13px;
        }

        /* =========================
                   CLINIC CARD
                ========================= */
        .clinic-card {
            height: 100%;
            background: #fff;
            border: 1px solid #e9eeeb;
            border-radius: 18px;
            box-shadow: 0 5px 20px rgba(34, 58, 43, .045);
            overflow: hidden;
            transition: all .2s ease;
        }

        .clinic-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(34, 58, 43, .08);
        }

        .clinic-card-body {
            padding: 20px;
        }

        /* =========================
                   CLINIC HEADER
                ========================= */
        .clinic-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .clinic-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .clinic-header h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 700;
            color: #28332d;
        }

        .clinic-header span {
            display: block;
            margin-top: 2px;
            color: #929a96;
            font-size: 11px;
        }

        /* =========================
                   DOCTOR ITEM
                ========================= */
        .doctor-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .doctor-item {
            position: relative;
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 12px;
            background: #f8faf9;
            border: 1px solid #edf1ee;
            border-radius: 12px;
            text-decoration: none;
            transition: all .18s ease;
        }

        .doctor-item:hover {
            background: #f1f7f3;
            border-color: #d9e7dc;
            transform: translateX(2px);
        }

        .doctor-avatar {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e5efe8;
            color: #2f6b3c;
            font-size: 16px;
            flex-shrink: 0;
        }

        .doctor-info {
            min-width: 0;
            flex: 1;
        }

        .doctor-name {
            display: block;
            color: #303a34;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.35;
        }

        .doctor-schedule {
            display: block;
            margin-top: 2px;
            color: #8a938e;
            font-size: 11px;
            line-height: 1.3;
        }

        .doctor-arrow {
            color: #a5aea9;
            font-size: 14px;
            transition: transform .18s ease;
        }

        .doctor-item:hover .doctor-arrow {
            transform: translateX(3px);
            color: #2f6b3c;
        }

        /* =========================
                   SPECIALTY COLORS
                ========================= */

        .clinic-kandungan .clinic-icon {
            background: #fceef3;
            color: #c23b68;
        }

        .clinic-anak .clinic-icon {
            background: #eaf6ef;
            color: #2f7d4a;
        }

        .clinic-dalam .clinic-icon {
            background: #f0ebf8;
            color: #6f42c1;
        }

        /* =========================
                   OTHER SERVICES
                ========================= */
        .other-service {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 14px;
            border-radius: 13px;
            text-decoration: none;
            color: #fff;
            transition: all .18s ease;
        }

        .other-service+.other-service {
            margin-top: 10px;
        }

        .other-service:hover {
            color: #fff;
            transform: translateX(2px);
            filter: brightness(.97);
        }

        .other-service-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .17);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .other-service-info {
            flex: 1;
        }

        .other-service-name {
            display: block;
            font-size: 13px;
            font-weight: 600;
        }

        .other-service-desc {
            display: block;
            margin-top: 2px;
            font-size: 10px;
            opacity: .78;
        }

        .other-service-arrow {
            font-size: 13px;
            opacity: .7;
        }

        .service-umum {
            background: #dc3700;
        }

        .service-kia {
            background: #d63384;
        }

        /* =========================
                   EMPTY STATE
                ========================= */
        .empty-doctor {
            padding: 20px 12px;
            text-align: center;
            color: #9aa29e;
            font-size: 12px;
            background: #f8faf9;
            border-radius: 12px;
        }

        .empty-doctor i {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
        }

        /* =========================
                   USER / DOCTOR PERSONAL PAGE
                ========================= */
        .personal-clinic {
            max-width: 760px;
            margin: 0 auto;
        }

        .personal-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .personal-avatar {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: #eef6f0;
            color: #2f6b3c;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 24px;
        }

        .personal-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #28332d;
        }

        .personal-header p {
            margin: 4px 0 0;
            color: #8a938e;
            font-size: 12px;
        }

        /* =========================
                   RESPONSIVE
                ========================= */
        @media (max-width: 767px) {
            .clinic-page-title h4 {
                font-size: 18px;
            }

            .clinic-page-title p {
                font-size: 12px;
            }

            .clinic-card-body {
                padding: 16px;
            }
        }
    </style>

    <div class="clinic-page">

        {{-- =========================
             PAGE HEADER
        ========================= --}}
        <div class="clinic-page-header">
            <div class="clinic-page-title">
                <div class="clinic-page-icon">
                    <i class="bi bi-hospital"></i>
                </div>

                <div>
                    <h4>Poliklinik</h4>
                    <p>Pilih layanan dan dokter yang ingin Anda akses</p>
                </div>
            </div>
        </div>


        @if (session()->get('pegawai')->nama == 'direksi' ||
                session()->get('pegawai')->departemen == 'DPM2' ||
                session()->get('pegawai')->departemen == 'DIR' ||
                session()->get('pegawai')->departemen == 'CSM' ||
                session()->get('pegawai')->bidang == 'Kebidanan' ||
                session()->get('pegawai')->bidang == 'Keperawatan' ||
                session()->get('pegawai')->jbtn == 'Asisten Apoteker' ||
                session()->get('pegawai')->jbtn == 'Apoteker' ||
                session()->get('pegawai')->jbtn == 'TTK' ||
                session()->get('pegawai')->jbtn == '-')

            {{-- =========================
                 ADMIN / STAFF VIEW
            ========================= --}}
            <div class="row g-3">

                {{-- KANDUNGAN --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="clinic-card clinic-kandungan">
                        <div class="clinic-card-body">

                            <div class="clinic-header">
                                <div class="clinic-icon">
                                    <i class="bi bi-heart-pulse"></i>
                                </div>

                                <div>
                                    <h5>Poliklinik Kandungan</h5>
                                    <span>Obstetri & Ginekologi</span>
                                </div>
                            </div>

                            <div class="doctor-list">

                                @php
                                    $found = false;
                                @endphp

                                @foreach ($data as $d)
                                    @if ($d->dokter->kd_sps == 'S0001' && $d->kd_poli != 'U0017')
                                        @php
                                            $found = true;
                                        @endphp

                                        <a href="{{ url('poliklinik/' . $d->kd_poli) }}?dokter={{ $d->dokter->kd_dokter }}"
                                            class="doctor-item">

                                            <div class="doctor-avatar">
                                                <i class="bi bi-person"></i>
                                            </div>

                                            <div class="doctor-info">
                                                <span class="doctor-name">
                                                    {{ $d->dokter->nm_dokter }}
                                                </span>

                                                <span class="doctor-schedule">
                                                    {{ $d->nama }}
                                                </span>
                                            </div>

                                            <i class="bi bi-chevron-right doctor-arrow"></i>

                                        </a>
                                    @endif
                                @endforeach

                                @if (!$found)
                                    <div class="empty-doctor">
                                        <i class="bi bi-calendar-x"></i>
                                        Belum ada jadwal dokter
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


                {{-- ANAK --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="clinic-card clinic-anak">
                        <div class="clinic-card-body">

                            <div class="clinic-header">
                                <div class="clinic-icon">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>

                                <div>
                                    <h5>Poliklinik Anak</h5>
                                    <span>Kesehatan anak</span>
                                </div>
                            </div>

                            <div class="doctor-list">

                                @php
                                    $found = false;
                                @endphp

                                @foreach ($data as $d)
                                    @if ($d->dokter->kd_sps == 'S0003' && $d->kd_poli != 'U0017')
                                        @php
                                            $found = true;
                                        @endphp

                                        <a href="{{ url('poliklinik/' . $d->kd_poli) }}?dokter={{ $d->dokter->kd_dokter }}"
                                            class="doctor-item">

                                            <div class="doctor-avatar">
                                                <i class="bi bi-person"></i>
                                            </div>

                                            <div class="doctor-info">
                                                <span class="doctor-name">
                                                    {{ $d->dokter->nm_dokter }}
                                                </span>

                                                <span class="doctor-schedule">
                                                    {{ $d->nama }}
                                                </span>
                                            </div>

                                            <i class="bi bi-chevron-right doctor-arrow"></i>

                                        </a>
                                    @endif
                                @endforeach

                                @if (!$found)
                                    <div class="empty-doctor">
                                        <i class="bi bi-calendar-x"></i>
                                        Belum ada jadwal dokter
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


                {{-- PENYAKIT DALAM --}}
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="clinic-card clinic-dalam">
                        <div class="clinic-card-body">

                            <div class="clinic-header">
                                <div class="clinic-icon">
                                    <i class="bi bi-activity"></i>
                                </div>

                                <div>
                                    <h5>Poliklinik Penyakit Dalam</h5>
                                    <span>Spesialis penyakit dalam</span>
                                </div>
                            </div>

                            <div class="doctor-list">

                                @php
                                    $found = false;
                                @endphp

                                @foreach ($data as $d)
                                    @if ($d->dokter->kd_sps == 'S0005')
                                        @php
                                            $found = true;
                                        @endphp

                                        <a href="{{ url('poliklinik/' . $d->kd_poli) }}?dokter={{ $d->dokter->kd_dokter }}"
                                            class="doctor-item">

                                            <div class="doctor-avatar">
                                                <i class="bi bi-person"></i>
                                            </div>

                                            <div class="doctor-info">
                                                <span class="doctor-name">
                                                    {{ $d->dokter->nm_dokter }}
                                                </span>

                                                <span class="doctor-schedule">
                                                    {{ $d->nama }}
                                                </span>
                                            </div>

                                            <i class="bi bi-chevron-right doctor-arrow"></i>

                                        </a>
                                    @endif
                                @endforeach

                                @if (!$found)
                                    <div class="empty-doctor">
                                        <i class="bi bi-calendar-x"></i>
                                        Belum ada jadwal dokter
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>


                {{-- LAINNYA --}}
                <div class="col-lg-3 col-md-6 col-sm-12">

                    <div class="clinic-card">
                        <div class="clinic-card-body">

                            <div class="clinic-header">
                                <div class="clinic-icon" style="background:#f1f3f2;color:#58635d;">
                                    <i class="bi bi-grid"></i>
                                </div>

                                <div>
                                    <h5>Layanan Lainnya</h5>
                                    <span>Layanan poliklinik</span>
                                </div>
                            </div>

                            <div>

                                <a href="{{ url('poliklinik/P006') }}" class="other-service service-umum">

                                    <div class="other-service-icon">
                                        <i class="bi bi-person-heart"></i>
                                    </div>

                                    <div class="other-service-info">
                                        <span class="other-service-name">
                                            Poliklinik Umum
                                        </span>

                                        <span class="other-service-desc">
                                            Pelayanan kesehatan umum
                                        </span>
                                    </div>

                                    <i class="bi bi-chevron-right other-service-arrow"></i>

                                </a>


                                <a href="{{ url('poliklinik/PKIA') }}" class="other-service service-kia">

                                    <div class="other-service-icon">
                                        <i class="bi bi-person-standing-dress"></i>
                                    </div>

                                    <div class="other-service-info">
                                        <span class="other-service-name">
                                            Poliklinik KIA
                                        </span>

                                        <span class="other-service-desc">
                                            Kesehatan ibu dan anak
                                        </span>
                                    </div>

                                    <i class="bi bi-chevron-right other-service-arrow"></i>

                                </a>

                            </div>

                        </div>
                    </div>

                </div>

            </div>
        @else
            {{-- =========================
                 PERSONAL / DOCTOR VIEW
            ========================= --}}
            <div class="personal-clinic">

                <div class="clinic-card">
                    <div class="clinic-card-body">

                        <div class="personal-header">

                            <div class="personal-avatar">
                                <i class="bi bi-person"></i>
                            </div>

                            <h5>
                                {{ session()->get('pegawai')->nama }}
                            </h5>

                            <p>
                                Pilih poliklinik untuk melanjutkan
                            </p>

                        </div>


                        <div class="doctor-list">

                            @if (session()->get('pegawai')->bidang == 'Dokter Umum' || session()->get('pegawai')->jbtn == 'Dokter Umum')
                                <a href="{{ url('poliklinik/P006') }}?dokter={{ session()->get('pegawai')->nik }}"
                                    class="doctor-item">

                                    <div class="doctor-avatar">
                                        <i class="bi bi-hospital"></i>
                                    </div>

                                    <div class="doctor-info">
                                        <span class="doctor-name">
                                            Poliklinik Umum
                                        </span>

                                        <span class="doctor-schedule">
                                            Pelayanan dokter umum
                                        </span>
                                    </div>

                                    <i class="bi bi-chevron-right doctor-arrow"></i>

                                </a>
                            @else
                                @php
                                    $found = false;
                                @endphp

                                @foreach ($data as $d)
                                    @if ($d->dokter->kd_dokter == session()->get('pegawai')->nik)
                                        @php
                                            $found = true;
                                        @endphp

                                        <a href="{{ url('poliklinik/' . $d->kd_poli) }}?dokter={{ $d->dokter->kd_dokter }}"
                                            class="doctor-item">

                                            <div class="doctor-avatar">
                                                <i class="bi bi-hospital"></i>
                                            </div>

                                            <div class="doctor-info">
                                                <span class="doctor-name">
                                                    {{ $d->nama }}
                                                </span>

                                                <span class="doctor-schedule">
                                                    Buka layanan poliklinik
                                                </span>
                                            </div>

                                            <i class="bi bi-chevron-right doctor-arrow"></i>

                                        </a>
                                    @endif
                                @endforeach

                                @if (!$found)
                                    <div class="empty-doctor">
                                        <i class="bi bi-calendar-x"></i>
                                        Belum ada poliklinik yang tersedia
                                    </div>
                                @endif
                            @endif

                        </div>

                    </div>
                </div>

            </div>

        @endif

    </div>

@endsection

@push('script')
@endpush
