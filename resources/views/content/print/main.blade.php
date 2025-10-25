<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ERM RSIA AISYIYAH PEKAJANGAN</title>
    <style>
        @page {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin-top: 10px;
            margin-right: 30px;
            margin-left: 30px;
            margin-bottom: 10px;
        }

        p {
            font-size: 12px;
            margin: 0px;
        }

        .table-print,
        .table-print tr {
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 5px;
            vertical-align: top;
        }

        .table-print td {
            padding: 5px;
        }

        .border {
            border: 1px solid #000;
            border-collapse: collapse;

        }

        .page-break {
            page-break-after: always;
        }

        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered th {
            background-color: #c2c2c2;
            color: #000;
            width: 50%;
        }

        .table-bordered td,
        .table-bordered th {
            padding: 10px;
            border: 1px solid #000;
        }

        .d-flex {
            display: flex;
            flex-wrap: nowrap;
        }

        .d-table {
            display: table;
        }

        .d-table > div,
        .d-table > span {
            display: table-cell;
            vertical-align: top;
            padding: 5px;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .m-0 {
            margin: 0 !important;
        }

        .m-1 {
            margin: .25rem !important;
        }

        .m-2 {
            margin: .5rem !important;
        }

        .m-3 {
            margin: 1rem !important;
        }

        .m-4 {
            margin: 1.5rem !important;
        }

        .m-5 {
            margin: 3rem !important;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mr-0 {
            margin-right: 0 !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .ml-0 {
            margin-left: 0 !important;
        }

        .mx-0 {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .mt-1 {
            margin-top: .25rem !important;
        }

        .mr-1 {
            margin-right: .25rem !important;
        }

        .mb-1 {
            margin-bottom: .25rem !important;
        }

        .ml-1 {
            margin-left: .25rem !important;
        }

        .mx-1 {
            margin-left: .25rem !important;
            margin-right: .25rem !important;
        }

        .my-1 {
            margin-top: .25rem !important;
            margin-bottom: .25rem !important;
        }

        .mt-2 {
            margin-top: .5rem !important;
        }

        .mr-2 {
            margin-right: .5rem !important;
        }

        .mb-2 {
            margin-bottom: .5rem !important;
        }

        .ml-2 {
            margin-left: .5rem !important;
        }

        .mx-2 {
            margin-right: .5rem !important;
            margin-left: .5rem !important;
        }

        .my-2 {
            margin-top: .5rem !important;
            margin-bottom: .5rem !important;
        }

        .mt-3 {
            margin-top: 1rem !important;
        }

        .mr-3 {
            margin-right: 1rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .ml-3 {
            margin-left: 1rem !important;
        }

        .mx-3 {
            margin-right: 1rem !important;
            margin-left: 1rem !important;
        }

        .my-3 {
            margin-bottom: 1rem !important;
            margin-top: 1rem !important;
        }

        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mr-4 {
            margin-right: 1.5rem !important;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        .ml-4 {
            margin-left: 1.5rem !important;
        }

        .mx-4 {
            margin-right: 1.5rem !important;
            margin-left: 1.5rem !important;
        }

        .my-4 {
            margin-top: 1.5rem !important;
            margin-bottom: 1.5rem !important;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .mr-5 {
            margin-right: 3rem !important;
        }

        .mb-5 {
            margin-bottom: 3rem !important;
        }

        .ml-5 {
            margin-left: 3rem !important;
        }

        .mx-5 {
            margin-right: 3rem !important;
            margin-left: 3rem !important;
        }

        .my-5 {
            margin-top: 3rem !important;
            margin-bottom: 3rem !important;
        }

        .mt-auto {
            margin-top: auto !important;
        }

        .mr-auto {
            margin-right: auto !important;
        }

        .mb-auto {
            margin-bottom: auto !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important;
        }

        .my-auto {
            margin-bottom: auto !important;
            margin-top: auto !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .p-1 {
            padding: .25rem !important;
        }

        .p-2 {
            padding: .5rem !important;
        }

        .p-3 {
            padding: 1rem !important;
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .p-5 {
            padding: 3rem !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pr-0 {
            padding-right: 0 !important;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .pl-0 {
            padding-left: 0 !important;
        }

        .px-0 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .pt-1 {
            padding-top: .25rem !important;
        }

        .pr-1 {
            padding-right: .25rem !important;
        }

        .pb-1 {
            padding-bottom: .25rem !important;
        }

        .pl-1 {
            padding-left: .25rem !important;
        }

        .px-1 {
            padding-left: .25rem !important;
            padding-right: .25rem !important;
        }

        .py-1 {
            padding-top: .25rem !important;
            padding-bottom: .25rem !important;
        }

        .pt-2 {
            padding-top: .5rem !important;
        }

        .pr-2 {
            padding-right: .5rem !important;
        }

        .pb-2 {
            padding-bottom: .5rem !important;
        }

        .pl-2 {
            padding-left: .5rem !important;
        }

        .px-2 {
            padding-right: .5rem !important;
            padding-left: .5rem !important;
        }

        .py-2 {
            padding-top: .5rem !important;
            padding-bottom: .5rem !important;
        }

        .pt-3 {
            padding-top: 1rem !important;
        }

        .pr-3 {
            padding-right: 1rem !important;
        }

        .pb-3 {
            padding-bottom: 1rem !important;
        }

        .pl-3 {
            padding-left: 1rem !important;
        }

        .py-3 {
            padding-bottom: 1rem !important;
            padding-top: 1rem !important;
        }

        .px-3 {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }

        .pt-4 {
            padding-top: 1.5rem !important;
        }

        .pr-4 {
            padding-right: 1.5rem !important;
        }

        .pb-4 {
            padding-bottom: 1.5rem !important;
        }

        .pl-4 {
            padding-left: 1.5rem !important;
        }

        .px-4 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        .pt-5 {
            padding-top: 3rem !important;
        }

        .pr-5 {
            padding-right: 3rem !important;
        }

        .pb-5 {
            padding-bottom: 3rem !important;
        }

        .pl-5 {
            padding-left: 3rem !important;
        }

        .px-5 {
            padding-right: 3rem !important;
            padding-left: 3rem !important;
        }

        .py-5 {
            padding-top: 3rem !important;
            padding-bottom: 3rem !important;
        }

        .text-center {
            text-align: center !important;
        }

        bg-danger {
            background-color: #dc3545 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        bg-primary {
            background-color: #0d6efd !important;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        bg-warning {
            background-color: #ffe600 !important;
        }

        .text-warning {
            color: #ffe600 !important;
        }

        bg-success {
            background-color: #198754 !important;
        }

        .text-success {
            color: #198754 !important;
        }

        .bg-lime {
            background-color: #d4edda !important;
        }

        .text-center {
            text-align: center !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: .5rem;
            margin-bottom: .5rem;
        }

        .col-1 {
            flex: 0 0 auto;
            width: 8.33333333%;
        }

        .col-2 {
            flex: 0 0 auto;
            width: 16.66666667%;
        }

        .col-3 {
            flex: 0 0 auto;
            width: 25%;
        }

        .col-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }

        .col-5 {
            flex: 0 0 auto;
            width: 41.66666667%;
        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .col-7 {
            flex: 0 0 auto;
            width: 58.33333333%;
        }

        .col-8 {
            flex: 0 0 auto;
            width: 66.66666667%;
        }

        .col-9 {
            flex: 0 0 auto;
            width: 75%;
        }

        .col-10 {
            flex: 0 0 auto;
            width: 83.33333333%;
        }

        .col-11 {
            flex: 0 0 auto;
            width: 91.66666667%;
        }

        .col-12 {
            flex: 0 0 auto;
            width: 100%;
        }

        .fw-bold {
            font-weight: 700 !important;
        }

        .fw-bolder {
            font-weight: bolder !important;
        }

        .lh-1 {
            line-height: 1 !important;
        }
    </style>
</head>

<body>
@yield('content')
@stack('script')
<script>
    function getBaseUrl(urlSegments = '') {
        const getUrl = "{{ url('') }}"
        const arrDomain = getUrl.split('/');
        const segment = urlSegments ? `/${urlSegments}` : ''
        if (arrDomain[2] == 'sim.rsiaaisyiyah.com') {
            url = 'https://sim.rsiaaisyiyah.com' + segment;
        } else {
            url = `${arrDomain[0]}//192.168.100.33${segment}`
        }
        return url;
    }


</script>
</body>

</html>
