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
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <link href="{{ asset('css/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    @stack('css')

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="icon" href="{{ asset('img/rsiap.ico') }}">
    <!-- Magnify Image Viewer CSS -->
    <link href="{{ asset('css/magnifier/jquery.magnify.css') }}" rel="stylesheet">
    {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.7/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.2.7/sweetalert2.min.css"> --}}
    {{-- <script src="https://unpkg.com/sweetalert2@11"></script> --}}
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>

    <style>
        * {
            font-family: "Noto Sans", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
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
            vertical-align: top;
        }

        .table-print th,
        .table-print td {
            padding: 10px;
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
            height: 10px;
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
            background-color: :inherit;
        }

        .row-danger {
            color: white;
            background-color: #dc3545;
            border-color: #a91827;
            padding: 3px;
        }

        .row-primary {
            color: white;
            background-color: #0d6efd;
            border-color: #074bb0;
            padding: 3px;
        }

        .row-warning {
            background-color: #ffe600;
            border-color: #dbb106;
            padding: 3px;
        }

        .row-indigo {
            color: white;
            background-color: #cb00cb;
            border-color: #9c038c;
            padding: 3px;
        }

        .row-secondary {
            background-color: #e3e3e3;
            border-color: #ababab;
            padding: 3px;
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

        #table-ews tr td,
        #table-ews tr th,
        #table-ews tbody,
        #table-ews thead {
            border: 1px solid #000;
            background-color: inherit;
            vertical-align: middle
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
            padding: 10px;
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
                font-size: 10px !important;
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
            font-size: 10px;
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

        @media (max-width:820px) {
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

        .is-valid+.select2-container .select2-selection {
            border-color: #28a745;
            /* Green border color for valid state */
            color: #155724;
            /* Dark green text */
        }
    </style>
</head>
