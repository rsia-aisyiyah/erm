<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-content" content="{{ csrf_token() }}">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">

    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link rel="stylesheet" href="{{ url('public/css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap');

        /* ==========================================================================
           MASTER RESPONSIVE TYPOGRAPHY & COMPACT ERM DASHBOARD SYSTEM
           Menjaga font & kontrol tetap proporsional dan muat dalam satu layar device
           ========================================================================== */
        :root {
            /* Master Font Variables */
            --font-master: 11.5px;
            --font-xs: 9.5px;
            --font-sm: 10.5px;
            --font-base: 11.5px;
            --font-md: 12px;
            --font-lg: 13.5px;
            --font-xl: 15px;

            /* Master Compact Form Heights & Sizes */
            --form-height: 30px;
            --form-height-sm: 26px;
            --form-height-lg: 36px;
            --form-font-size: 11.5px;
            --form-font-size-sm: 10.5px;
            --form-padding-y: 3px;
            --form-padding-x: 6px;
            --form-radius: 6px;
            --form-border: #d0d7de;
            --form-primary: #0d6efd;
            --form-text: #1e293b;
            --form-muted: #94a3b8;

            /* Master Compact Button Variables */
            --btn-height: 30px;
            --btn-height-sm: 26px;
            --btn-radius: 6px;
            --btn-padding-y: 4px;
            --btn-padding-x: 10px;
            --btn-font-size: 11.5px;
            --btn-font-weight: 600;
            --btn-transition: all 0.15s ease-in-out;

            /* Master Table Sizing (Dense for Medical Records) */
            --table-font-size: 11px;
            --table-padding-y: 3.5px;
            --table-padding-x: 6px;
        }

        /* Responsive Breakpoints untuk Master Font */
        html {
            font-size: var(--font-master);
            -webkit-text-size-adjust: 100%;
        }

        body {
            font-size: var(--font-master);
            line-height: 1.4;
            color: #1e293b;
        }

        /* Large Monitor (> 1600px) */
        @media (min-width: 1600px) {
            :root {
                --font-master: 12px;
                --form-height: 27px;
                --form-height-sm: 27px;
                --btn-height: 32px;
                --btn-height-sm: 27px;
                --form-font-size: 12px;
                --btn-font-size: 12px;
                --table-font-size: 11.5px;
                --table-padding-y: 4px;
                --table-padding-x: 7px;
            }
        }

        /* Standard Workstation / Laptop (1200px - 1599px) - Standar Ruang Perawatan & Poli */
        @media (max-width: 1599.98px) {
            :root {
                --font-master: 11.5px;
                --form-height: 30px;
                --form-height-sm: 26px;
                --btn-height: 30px;
                --btn-height-sm: 26px;
                --form-font-size: 11.5px;
                --btn-font-size: 11.5px;
                --table-font-size: 11px;
                --table-padding-y: 3.5px;
                --table-padding-x: 6px;
            }
        }

        /* Small Laptop / Tablet Landscape (992px - 1199px) */
        @media (max-width: 1199.98px) {
            :root {
                --font-master: 11px;
                --form-height: 28px;
                --form-height-sm: 25px;
                --btn-height: 28px;
                --btn-height-sm: 25px;
                --form-font-size: 11px;
                --btn-font-size: 11px;
                --table-font-size: 10.5px;
                --table-padding-y: 3px;
                --table-padding-x: 5px;
            }
        }

        /* Tablet Portrait (768px - 991px) */
        @media (max-width: 991.98px) {
            :root {
                --font-master: 10.5px;
                --form-height: 28px;
                --form-height-sm: 24px;
                --btn-height: 28px;
                --btn-height-sm: 24px;
                --form-font-size: 10.5px;
                --btn-font-size: 10.5px;
                --table-font-size: 10px;
                --table-padding-y: 2.5px;
                --table-padding-x: 4px;
            }
        }

        /* Mobile Devices (< 768px) */
        @media (max-width: 767.98px) {
            :root {
                --font-master: 10.5px;
                --form-height: 30px;
                --form-height-sm: 26px;
                --btn-height: 30px;
                --btn-height-sm: 26px;
                --form-font-size: 11px;
                --btn-font-size: 11px;
                --table-font-size: 10px;
                --table-padding-y: 3px;
                --table-padding-x: 4px;
            }
        }
    </style>
    {{-- <link href="/erm/public/css/select2/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />
    {{-- Datatable --}}
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css" rel="stylesheet" />
    @stack('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="icon" href="{{ asset('img/LOGO RSIA .png') }}">
    <!-- Magnify Image Viewer CSS -->
    <link href="{{ asset('css/magnifier/jquery.magnify.css') }}" rel="stylesheet">
    {{-- sweetalert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">



    <style>
        /* Pastikan tabel menggunakan border collapse */
        #table-ews {
            border-collapse: collapse;
        }


        #table-ews tr td,
        #table-ews tr th,
        #table-ews tbody,
        #table-ews thead {
            border: 1px solid #000;
            color: black;
            background-color: inherit;
            vertical-align: middle;
            padding: 2px;
        }

        /* Kriteria Utama: Sel pertama di grup (menampung judul) */
        #table-ews .criteria-cell {
            /* Pastikan latar belakangnya solid (misal: putih) */
            background-color: white !important;
            /* Hapus border vertikal di antara baris dalam grup */
            border-bottom: none !important;
        }

        /* Sel Kriteria Tersembunyi: Sel kriteria selain yang pertama di grup */
        #table-ews .criteria-cell-hidden {
            /* Latar belakang sama dengan yang di atas */
            background-color: white !important;
            /* Hapus semua border horizontal internal untuk menggabungkannya secara visual */
            border-bottom: none !important;
            border-top: none !important;
        }

        /* Seluruh Baris Awal Grup */
        #table-ews .ews-group-start td {
            border-top: 2px solid black !important;
            /* Border tebal di atas grup baru */
        }

        /* Seluruh Baris Akhir Grup */
        #table-ews .ews-group-end td {
            border-bottom: 2px solid black !important;
            /* Border tebal di bawah grup */
        }

        /* Seluruh Baris Tengah Grup */
        #table-ews .ews-group-middle td {

            border-bottom: none !important;
            /* Hapus border internal */
        }

        /* Perbaiki Border Seluruh Baris Hasil */
        /* Seluruh baris di tbody harus menghilangkan border bawah, kecuali ews-group-end */
        #table-ews tbody tr:not(.ews-group-end) td:not(.criteria-cell):not(.criteria-cell-hidden) {
            border-bottom: 1px solid #ccc !important;
            /* Tentukan border tipis antar baris data (jika diinginkan) */
        }
    </style>

    <style>
        * {
            font-family: "Noto Sans", serif;
            font-optical-sizing: auto;
            /*font-weight: <weight>;*/
            font-style: normal;
            font-variation-settings: "wdth" 100;
        }

        .card {
            border-radius: 6px;
        }

        .btn {
            border-radius: 6px;
            box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.05)
        }

        .btn-sm {
            font-size: 11px;
            box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.05)
        }

        .dropdown-item,
        .dropdown-menu {
            border-radius: 6px;
        }


        input[type=text],
        input[type=number],
        input[type=search],
        .form-select-sm {
            border-radius: 6px;
            font-size: 11px;
            border-color: #bdbdbd;
            transition: all .1s linear;
        }

        .form-select {
            border-radius: 6px;
            font-size: 11px;
            height: 32px;
        }

        option {
            padding: 2px;
            border-radius: 6px;
        }

        textarea {
            border-radius: 6px;
            font-size: 12px;
            resize: none;
            border-color: #bdbdbd !important;
        }

        .my-custom-scrollbar {
            position: relative;
            height: 500px;
            overflow: auto;
        }

        label {
            font-size: 12px;
        }


        .table-wrapper-scroll-y {
            display: block;
        }

        .table tr td,
        .table tr th {
            vertical-align: middle !important;
        }

        .table-print th,
        .table-print td {
            padding: 11px;
        }

        .list_obat ul li.active>a {
            background-color: #0d6efd;
            color: #fff;
        }

        .list_aturan ul li.active>a {
            background-color: #0d6efd;
            color: #fff;
        }

        .list_racik ul li.active>a {
            background-color: #0d6efd;
            color: #fff;
        }

        .table-print .td-border {
            border: 1px solid #000;
            border-collapse: collapse;

        }

        .table-print,
        .table-print tr {
            border: 1px solid #000;
            border-collapse: collapse;
            vertical-align: top;
        }

        .steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .step-button {
            width: 30px;
            height: 30px;
            font-size: 12px;
            border-radius: 50%;
            border: none;
            background-color: #f1f1f1;
            border: 1px solid #0d6efd;
            transition: .4s;
        }

        .step-button[aria-expanded="true"] {
            width: 40px;
            height: 40px;
            background-color: #0d6efd;
            color: #fff;
        }

        .done {
            border: none;
            background-color: #198754;
            color: #fff;
        }

        .step-item {
            z-index: 10;
            text-align: center;
        }

        #progress {
            -webkit-appearance: none;
            position: absolute;
            width: 97%;
            z-index: 5;
            height: 11px;
            margin-left: 18px;
            margin-bottom: 18px;
        }

        #tabel-lab tr .low {
            background-color: #0d6efd;
        }

        /* to customize progress bar */
        #progress::-webkit-progress-value {
            background-color: var(--prm-color);
            transition: .5s ease;
        }

        #progress::-webkit-progress-bar {
            background-color: var(--prm-gray);

        }

        .text-bg-indigo {
            background-color: #6f42c1 !important;
            color: white !important;
        }

        .card-body asmed {
            padding: 5px;
        }

        .card-text {
            font-size: 12px;
        }

        .card-shadow {
            box-shadow: 0 4px 12px 0 rgba(0, 0, 0, 0.07), 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .separator {
            font-size: 12px;
            color: #6e6e6e;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ced4da;
        }

        .separator:not(:empty)::before {
            margin-right: .25em;
        }

        .separator:not(:empty)::after {
            margin-left: .25em;
        }

        /* .container-fluid {
            background-image: url("https://sim.rsiaaisyiyah.com/rsiap/assets/images/wa7.png") !important;
        } */

        table {
            font-size: 12px;
        }

        tr th {
            background-color: : inherit;
        }

        .row-danger {
            color: #dc3545;
            font-weight: bold;
        }

        .row-primary {
            color: #0d6efd;
            font-weight: bold;
        }

        .row-warning {
            color: #ffe600;
            font-weight: bold;
        }

        .row-indigo {
            color: #cb00cb;
            font-weight: bold;
        }

        .row-secondary {
            color: #e3e3e3;
            font-weight: bold;
        }

        .row-success {
            color: #198754;
            font-weight: bold;
        }

        .row-danger td,
        .row-primary td,
        .row-warning td,
        .row-success td,
        .row-secondary td,
        .row-indigo td {
            background-color: inherit;
            color: inherit;
            vertical-align: middle;
        }

        .row-danger th,
        .row-primary th,
        .row-warning th,
        .row-success th,
        .row-secondary th,
        .row-indigo th {
            background-color: inherit;
            color: inherit;
            vertical-align: middle;
        }


        table td {
            vertical-align: middle;
        }

        .borderless th,
        .borderless td {
            border: none;
            vertical-align: top;
            height: 5px !important;
            padding: 3px !important;
        }

        textarea .form-control {
            border-color: #bdbdbd;
        }

        .modal-content {
            border-radius: 6px;
        }

        .card {
            border-radius: 6px !important;
        }

        .nav-tabs .nav-link {
            /* border: 1px solid #0d6efd !important;
            border-top-left-radius: 6px !important;
            border-top-right-radius: 6px !important;
            border-bottom-right-radius: 0px !important;
            border-bottom-left-radius: 0px !important; */
            font-size: 12px;
            padding: 11px;
        }

        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: white;
            transition: all .1s linear;
        }

        .modal.fade.show {
            background-color: rgb(0 0 0 / 49%)
        }

        .modal {
            background-color: none;
        }


        .btn-width-poliklinik {
            width: 100px !important;
            font-size: 11px;
            text-align: left
        }

        @media (max-width: 1200px) {

            table tr td,
            th {
                font-size: 10px !important
            }
        }

        @media (max-width: 368px) {
            .tb-askep {
                font-size: 9px !important;
            }

            .modal-riwayat table {
                font-size: 9px !important;
            }

            .card-text {

                font-size: 9px !important;
            }


            #modalSoap table,
            #modalSoap form input,
            #modalSoap form select,
            #modalSoap form textarea {
                font-size: 11px !important;
            }

            .content-scrolled {
                height: 670px !important;
            }
        }

        .form-control {
            font-size: 12px;
            border-radius: 6px;
        }

        .input-group-sm .input-group-text,
        .input-group-sm .btn {
            height: 28px;
        }

        .input-group select {
            height: 28px;
        }

        .input-group .br-left {
            border-radius: 6px 0 0 6px !important;
        }

        .input-group .br-right {
            border-radius: 0 6px 6px 0 !important;
        }

        .input-group .br-full {
            border-radius: 6px !important;
        }

        .input-group label {
            font-size: 11px;
            padding: 5px;
        }

        .input-group-sm .btn {
            font-size: 11px;
            height: 28px;
        }

        .form-control-sm:not(textarea) {
            font-size: 12px;
            height: 28px;
            border-radius: 6px;
        }

        .input-group .form-control-sm {
            font-size: 11px;
        }

        .form-underline {
            border: none;
            border-bottom: 1px solid #e9e9e9;
        }

        .form-underline:focus {
            border-bottom: 1px dashed #ececec;
            box-shadow: none;
            transition: background-size .3s ease;
            ;
        }

        form label {
            font-size: 11px;
        }

        #table-ews tr td,
        #table-ews tr th,
        #table-ews tbody,
        #table-ews thead {
            border: 1px solid #000;
        }

        #table-ews tr.judul-ews {

            border: 3px solid #000;
        }

        .ews-aktif {
            background-color: #0d6efd;
        }


        .form-control:focus,
        .form-control-sm:focus {
            /* transition: all .1s linear; */
        }

        .chart-container {
            position: relative;
            margin: auto;
            height: 60vh;
            width: auto;
        }

        @media (max-width: 400px) {
            .chart-container {
                width: 600px;
            }

            .nav-brand {
                display: inline;
            }

            #navbarSupportedContent {
                max-height: 150px;
                overflow-y: auto;
            }
        }

        .nav-brand {
            display: none;
        }

        .nav-link.active {
            font-weight: bold;
        }

        .nav-brand {
            font-weight: bold;
            text-decoration: none;
            color: rgb(70, 70, 70)
        }

        .content-scrolled {
            height: calc(100vh - 278px);
            overflow-y: auto;
        }


        .navbar {
            border-radius: 6px;
        }

        @media (max-width: 820px) {
            .tab-responsive {
                display: none;
            }

            .nav-brand {
                display: inherit !important;
            }


        }

        .text-indigo {
            color: var(--bs-indigo);
        }

        .text-purple {
            color: #6f42c1;
        }

        .bg-indigo {
            background-color: var(--bs-indigo);
            color: #fff;
        }

        .bg-purple {
            background-color: var(--bs-purple);
            color: #fff !important;
        }

        .select2-container--default .select2-results__option {
            font-size: 11px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            font-size: 11px;
        }

        .select2-container {
            display: block;
        }

        .select2-selection {
            display: block;
            width: 100%;
        }

        .select2 .is-valid+.select2-container .select2-selection {
            border-color: #28a745;
            /* Green border color for valid state */
            color: #155724;
            /* Dark green text */
        }

        .context-menu-list,
        .context-menu-item {
            font-size: 11px !important;
        }

        .context-menu-item.context-menu-hover {
            background-color: #0d6efd !important;
            color: #fff;
        }

        .context-menu-icon.context-menu-icon--fa::before {

            color: #0d6efd;
        }

        tbody {
            border-color: #ccc;
            border-style: solid;
            border-width: 0;
        }

        @media (min-width: 368px) {
            .order-sm-2 {
                order: 2 !important;
            }
        }

        /* Headings: proporsional dan hemat ruang vertikal layar */
        h1,
        .h1 {
            font-size: 1.35rem !important;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 0.35rem;
        }

        h2,
        .h2 {
            font-size: 1.2rem !important;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 0.3rem;
        }

        h3,
        .h3 {
            font-size: 1.1rem !important;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.25rem;
        }

        h4,
        .h4 {
            font-size: 1rem !important;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.25rem;
        }

        h5,
        .h5 {
            font-size: 0.9rem !important;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.2rem;
        }

        h6,
        .h6 {
            font-size: 0.8rem !important;
            font-weight: 600;
            line-height: 1.3;
            margin-bottom: 0.2rem;
        }

        /* Tabel Kompak: seluruh kolom & data pasien muat dalam satu layar */
        table {
            font-size: var(--table-font-size, 11px) !important;
        }

        table tbody th,
        table tbody td,
        table thead th {
            padding: var(--table-padding-y, 3.5px) var(--table-padding-x, 6px) !important;
            vertical-align: middle !important;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            font-size: var(--font-sm, 10.5px) !important;
            padding: 6px 10px;
        }

        .form-check-label {
            font-size: var(--font-sm, 10.5px) !important;
        }

        /* ==========================================================================
           SELECT2: Terintegrasi Presisi dengan Tinggi Form Control & Font Master
           ========================================================================== */
        .select2-container--default .select2-selection--single {
            height: var(--form-height) !important;
            min-height: var(--form-height) !important;
            border: 1px solid var(--form-border);
            border-radius: var(--form-radius);
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 8px;
            padding-right: 22px;
            color: var(--form-text);
            font-size: var(--form-font-size);
            line-height: calc(var(--form-height) - 2px) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(var(--form-height) - 2px) !important;
            right: 6px;
            top: 1px;
            display: flex;
            align-items: center;
        }

        .select2-container--default.select2-container--open .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--form-primary);
            box-shadow: 0 0 0 2px rgba(13, 110, 253, .15);
        }

        .select2-selection--multiple {
            min-height: var(--form-height) !important;
            padding: 1px 4px;
            border: 1px solid var(--form-border);
            border-radius: var(--form-radius);
            font-size: var(--form-font-size) !important;
        }

        .select2-selection--multiple .select2-selection__choice__display {
            font-size: var(--form-font-size-sm, 10.5px) !important;
            padding: 1px 5px;
            margin-top: 1px;
        }

        .select2-selection--multiple .select2-search__field {
            font-size: var(--form-font-size) !important;
            margin-top: 2px;
        }

        .select2-dropdown {
            border: 1px solid var(--form-border);
            border-radius: var(--form-radius);
            box-shadow: 0 6px 16px rgba(15, 23, 42, .08);
            font-size: var(--form-font-size);
            overflow: hidden;
        }

        .select2-results__option {
            padding: 4px 8px;
            font-size: var(--form-font-size);
        }

        /* SweetAlert2 & Select2 Z-Index */
        .swal2-container {
            z-index: 2000 !important;
        }

        .select2-container--open {
            z-index: 2050 !important;
        }

        /* ==========================================================================
           MODERN COMPACT BUTTON OVERRIDE (Bootstrap 5)
           Responsif | Hemat Ruang Layar | Elegan
           ========================================================================== */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            height: var(--btn-height);
            min-height: var(--btn-height);
            padding: var(--btn-padding-y) var(--btn-padding-x);
            border-radius: var(--btn-radius);
            font-size: var(--btn-font-size);
            font-weight: var(--btn-font-weight);
            line-height: 1;
            letter-spacing: 0.01em;
            border-width: 1px;
            transition: var(--btn-transition);
            white-space: nowrap;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: none !important;
        }

        .btn:focus,
        .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.18);
        }

        .btn:disabled,
        .btn.disabled {
            opacity: 0.55;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-sm {
            height: var(--btn-height-sm) !important;
            min-height: var(--btn-height-sm) !important;
            padding: 2px 7px !important;
            font-size: var(--form-font-size-sm, 10.5px) !important;
            border-radius: calc(var(--btn-radius) - 1px) !important;
        }

        .btn-lg {
            height: 36px !important;
            min-height: 36px !important;
            padding: 5px 12px !important;
            font-size: 12.5px !important;
            border-radius: 8px;
        }

        .btn-primary {
            box-shadow: 0 1px 3px rgba(13, 110, 253, 0.18);
        }

        .btn-secondary {
            box-shadow: 0 1px 3px rgba(108, 117, 125, 0.12);
        }

        .btn-success {
            box-shadow: 0 1px 3px rgba(25, 135, 84, 0.18);
        }

        .btn-danger {
            box-shadow: 0 1px 3px rgba(220, 53, 69, 0.18);
        }

        .btn-warning {
            box-shadow: 0 1px 3px rgba(255, 193, 7, 0.18);
        }

        .btn-info {
            box-shadow: 0 1px 3px rgba(13, 202, 240, 0.18);
        }

        .btn-light {
            border-color: #e2e8f0;
            background-color: #f8fafc;
            color: #334155;
        }

        .btn-light:hover {
            background-color: #f1f5f9;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .btn-dark {
            box-shadow: 0 1px 3px rgba(33, 37, 41, 0.18);
        }

        [class*="btn-outline-"] {
            background-color: transparent;
            box-shadow: none;
        }

        [class*="btn-outline-"]:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .btn-link {
            box-shadow: none;
            text-decoration: none;
        }

        .btn-link:hover {
            transform: none;
            text-decoration: underline;
        }

        .btn.rounded-pill {
            border-radius: 50rem;
        }

        .btn i,
        .btn svg,
        .btn .bi {
            font-size: 1em;
            vertical-align: middle;
            flex-shrink: 0;
        }

        .btn-group>.btn,
        .btn-group-vertical>.btn {
            transform: none;
        }

        .btn-group>.btn:hover {
            z-index: 2;
        }

        .btn-block,
        .btn.w-100 {
            width: 100%;
        }


        /* ==========================================================================
           GLOBAL COMPACT FORM CONTROLS
           Input, Select, Textarea, Label yang proporsional & muat satu layar
           ========================================================================== */
        .form-control:not(textarea),
        .form-select,
        input:not([type="checkbox"]):not([type="radio"]):not([type="hidden"]):not([type="submit"]):not([type="button"]):not([type="reset"]),
        select {
            height: var(--form-height);
            min-height: var(--form-height);
            padding: var(--form-padding-y) var(--form-padding-x);
            border: 1px solid var(--form-border);
            border-radius: var(--form-radius);
            background-color: #fff;
            color: var(--form-text);
            font-size: var(--form-font-size);
            font-weight: 500;
            line-height: 1.35;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .form-control-sm:not(textarea),
        .form-select-sm,
        .input-sm {
            height: var(--form-height-sm) !important;
            min-height: var(--form-height-sm) !important;
            padding: 2px 6px !important;
            font-size: var(--form-font-size-sm, 10.5px) !important;
            border-radius: calc(var(--form-radius) - 1px) !important;
        }

        /* TEXTAREA: Menghormati atribut rows dan cols HTML bawaan */
        textarea,
        textarea.form-control,
        textarea.form-control-sm {
            height: auto !important;
            min-height: auto !important;
            max-height: none;
            padding: 5px 8px;
            border: 1px solid var(--form-border);
            border-radius: var(--form-radius);
            background-color: #fff;
            color: var(--form-text);
            font-size: var(--form-font-size);
            line-height: 1.4;
            box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        /* Menghormati atribut rows pada textarea */
        /* textarea[rows],
        textarea[rows].form-control,
        textarea[rows].form-control-sm {
            height: auto !important;
            min-height: auto !important;
        } */

        /* Menghormati atribut cols pada textarea */
        /* textarea[cols],
        textarea[cols].form-control,
        textarea[cols].form-control-sm {
            width: auto !important;
            max-width: 100%;
            display: inline-block;
        } */

        .form-label,
        label {
            margin-bottom: 2px;
            color: #475569;
            font-size: var(--font-sm, 10.5px);
            font-weight: 600;
            line-height: 1.3;
        }

        .form-control::placeholder,
        input::placeholder,
        textarea::placeholder {
            color: var(--form-muted);
            font-weight: 400;
            opacity: 1;
            font-size: var(--form-font-size);
        }

        .form-control:hover,
        .form-select:hover,
        input:not([type="checkbox"]):not([type="radio"]):hover,
        select:hover,
        textarea:hover {
            border-color: #b8c8dc;
        }

        .form-control:focus,
        .form-select:focus,
        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--form-primary);
            outline: 0;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, .15);
        }

        .form-control:disabled,
        .form-select:disabled,
        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #f1f5f9;
            color: #94a3b8;
            border-color: #e2e8f0;
            cursor: not-allowed;
            opacity: 1;
        }

        .form-control[readonly],
        input[readonly],
        textarea[readonly] {
            background-color: #f8fafc;
            color: #64748b;
        }


        /* ==========================================================================
           INPUT GROUP & SIZE VARIANTS
           ========================================================================== */
        .input-group {
            --ig-height: var(--form-height);
            --ig-font-size: var(--form-font-size);
            --ig-padding-x: 6px;
            flex-wrap: nowrap;
        }

        .input-group>.form-control:not(textarea),
        .input-group>.form-select,
        .input-group>.input-group-text,
        .input-group>.btn,
        .input-group>button {
            height: var(--ig-height);
            min-height: var(--ig-height);
            font-size: var(--ig-font-size);
        }

        .input-group-text {
            display: flex;
            align-items: center;
            padding: 0 var(--ig-padding-x);
            border: 1px solid var(--form-border);
            background-color: #f8fafc;
            color: #64748b;
            font-size: var(--ig-font-size);
        }

        .input-group.input-group-sm {
            --ig-height: var(--form-height-sm);
            --ig-font-size: var(--form-font-size-sm, 10.5px);
            --ig-padding-x: 6px;
        }

        .input-group.input-group-sm>.form-control:not(textarea),
        .input-group.input-group-sm>.form-select {
            height: var(--ig-height);
            min-height: var(--ig-height);
            padding: 2px var(--ig-padding-x);
            font-size: var(--ig-font-size);
        }

        .input-group.input-group-sm>.input-group-text,
        .input-group.input-group-sm>.btn,
        .input-group.input-group-sm>button {
            height: var(--ig-height);
            min-height: var(--ig-height);
            padding: 0 var(--ig-padding-x);
            font-size: var(--ig-font-size);
        }

        .input-group.input-group-lg {
            --ig-height: var(--form-height-lg);
            --ig-font-size: 13px;
            --ig-padding-x: 12px;
        }

        .input-group.input-group-lg>.form-control:not(textarea),
        .input-group.input-group-lg>.form-select {
            height: var(--ig-height);
            min-height: var(--ig-height);
            padding: 5px var(--ig-padding-x);
            font-size: var(--ig-font-size);
        }

        .input-group.input-group-lg>.input-group-text,
        .input-group.input-group-lg>.btn,
        .input-group.input-group-lg>button {
            height: var(--ig-height);
            min-height: var(--ig-height);
            padding: 0 var(--ig-padding-x);
            font-size: var(--ig-font-size);
        }

        /* Select2 di dalam Input Group */
        .input-group.input-group-sm .select2-container--default .select2-selection--single {
            height: var(--ig-height) !important;
            min-height: var(--ig-height) !important;
        }

        .input-group.input-group-sm .select2-selection--single .select2-selection__rendered {
            line-height: calc(var(--ig-height) - 2px) !important;
            font-size: var(--ig-font-size);
        }

        .input-group.input-group-sm .select2-selection--single .select2-selection__arrow {
            height: calc(var(--ig-height) - 2px) !important;
        }

        /* Input Group: Border-radius Presisi Tanpa Celah */
        .input-group> :not(:last-child) {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .input-group> :not(:first-child) {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
            margin-left: -1px;
        }

        .input-group> :first-child {
            border-top-left-radius: var(--form-radius) !important;
            border-bottom-left-radius: var(--form-radius) !important;
        }

        .input-group> :last-child {
            border-top-right-radius: var(--form-radius) !important;
            border-bottom-right-radius: var(--form-radius) !important;
        }

        /* ==========================================================================
           MODAL & CARD PADDING OPTIMIZATION
           Memastikan modal CPPT, SOAP, dan asuhan muat utuh di layar
           ========================================================================== */
        .modal-header {
            padding: 8px 14px !important;
        }

        .modal-body {
            padding: 10px 14px !important;
        }

        .modal-footer {
            padding: 6px 14px !important;
        }

        .card-body {
            padding: 10px 12px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/erm-ajax-loader.css') }}">
</head>
