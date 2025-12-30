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
    <link rel="stylesheet" href='/erm/public/css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wdth,wght@0,62.5..100,100..900;1,62.5..100,100..900&display=swap');
    </style>
    {{-- <link href="/erm/public/css/select2/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          rel="stylesheet"/>
    {{-- Datatable --}}
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css" rel="stylesheet"/>
    @stack('css')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    {{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="icon" href="{{ asset('img/LOGO RSIA .png') }}">
    <!-- Magnify Image Viewer CSS -->
    <link href="{{ asset('css/magnifier/jquery.magnify.css') }}" rel="stylesheet">
    {{-- sweetalert --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.1.0/ckeditor5.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

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
            color : black;
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
            border-top: 2px solid black !important; /* Border tebal di atas grup baru */
        }

        /* Seluruh Baris Akhir Grup */
        #table-ews .ews-group-end td {
            border-bottom: 2px solid black !important; /* Border tebal di bawah grup */
        }

        /* Seluruh Baris Tengah Grup */
        #table-ews .ews-group-middle td {

            border-bottom: none !important; /* Hapus border internal */
        }

        /* Perbaiki Border Seluruh Baris Hasil */
        /* Seluruh baris di tbody harus menghilangkan border bawah, kecuali ews-group-end */
        #table-ews tbody tr:not(.ews-group-end) td:not(.criteria-cell):not(.criteria-cell-hidden) {
            border-bottom: 1px solid #ccc !important; /* Tentukan border tipis antar baris data (jika diinginkan) */
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

        .list_obat ul li.active > a {
            background-color: #0d6efd;
            color: #fff;
        }

        .list_aturan ul li.active > a {
            background-color: #0d6efd;
            color: #fff;
        }

        .list_racik ul li.active > a {
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
            background-color:: inherit;
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

        .form-control-sm {
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
            transition: background-size .3s ease;;
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

        .is-valid + .select2-container .select2-selection {
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

        tr

        @media (min-width: 367px) {
            /* .batasan-lebar { */
            /* width: 497px;
                margin-left: auto;
                margin-right: auto;
            } */
            .order-sm-2 {
                order: 2 !important;
            }
        }

        @media (max-width: 1500px) {
            table {
                font-size: 11px !important;
            }

            table tbody th,
            table tbody td {
                padding: 6px 8px;
            }

            label,
            input,
            select,
            button,
            textarea,
            a {
                font-size: 11px !important;
                font-style: normal;
            }

            .form-check-label {
                font-size: 11px !important;
            }

            .sidebar .nav-link {
                font-weight: 500;
                color: #333;
                font-size: 11px !important;
                padding: 8px 12px;
            }

            h1,
            .h1 {
                font-size: 1.75rem !important;
            }

            h2,
            .h2 {
                font-size: 1.5rem !important;
            }

            h3,
            .h3 {
                font-size: 1.25rem !important;
            }

            h4,
            .h4 {
                font-size: 1rem !important;
            }

            h5,
            .h5 {
                font-size: 0.875rem !important;
            }

            h6,
            .h6 {
                font-size: 0.75rem !important;
            }


        }

        /*    select2*/

        /* Ukuran teks di dalam pilihan multiple (tag) */

        .select2-selection--multiple .select2-selection__choice__display {
            font-size: 12px !important; /* ubah ukuran sesuai selera, misal 12–13px */
            padding: 2px 6px; /* atur padding biar proporsional */
            margin-top: 3px;
        }

        /* Ukuran teks di input search-nya */
        .select2-selection--multiple .select2-search__field {
            font-size: 12px !important;
        }

        /* Border dan tinggi area utama */
        .select2-selection--multiple {
            min-height: 34px; /* pastikan tidak terlalu tinggi */
            padding: 2px;
            font-size: 12px !important;
        }

        /* Placeholder dan hasil dropdown */
        .select2-results__option {
            font-size: 12px;
        }
    </style>
</head>
