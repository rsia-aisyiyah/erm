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
