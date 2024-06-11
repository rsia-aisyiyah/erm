<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ url('') }}</title>
    <!-- CSS files -->
    <link href="{{ asset('v2/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v2/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('v2/css/tabler-icons.min.css') }}" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tabler/icons@1.74.0/icons-react/dist/index.umd.min.js"></script>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body>
    <script src="{{ asset('v2/js/demo-theme.min.js') }}"></script>
    <div class="page">
        @yield('page')
    </div>
    <!-- Tabler Core -->
    <script src="{{ asset('v2/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('v2/js/demo.min.js?1684106062') }}" defer></script>
    <script async src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>
