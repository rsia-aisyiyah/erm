<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-content" content="{{ csrf_token() }}">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">

    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"
        integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/fixedcolumns/4.2.1/css/fixedColumns.dataTables.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="icon" href="{{ asset('img/rsiap.ico') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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
            font-size: 12px;
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

        /* to customize progress bar */
        #progress::-webkit-progress-value {
            background-color: var(--prm-color);
            transition: .5s ease;
        }

        #progress::-webkit-progress-bar {
            background-color: var(--prm-gray);

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

        table td {
            vertical-align: middle;
        }

        .borderless th,
        .borderless td {
            border: none;
            height: 5px !important;
            padding: 5px !important;
        }

        textarea .form-control {
            border-color: #bdbdbd;
        }

        .modal-content {
            border-radius: 6px;
        }

        .card,
        {
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

        @media (max-width: 400px) {
            .tb-askep {
                font-size: 9px !important;
            }

            .modal-riwayat table {
                font-size: 9px !important;
            }

            #modalSoap table,
            #modalSoap form input,
            #modalSoap form select,
            #modalSoap form textarea {
                font-size: 10px !important;
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

        .input-group-sm .btn {
            font-size: 10px;
            height: 28px;
        }

        .form-control-sm {
            font-size: 12px;
            height: 28px;
            border-radius: 6px;
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
    </style>
</head>
