<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-content" content="" {{ csrf_token() }}>
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/">
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">


    <style>
        * {
            font-family: "Noto Sans", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>

<body class="text-center">
    <main class="form-signin w-100 m-auto">
        <form action="/erm/login" method="POST">
            @csrf
            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="" width="72" height="72">
            <h1 class="h3 mb-3 fw-normal">LOGIN ERM</h1>

            @if (session()->has('error'))
                <div class="alert alert-danger fade show p-2" role="alert"
                    style="background-color:#dc3545;color:#fff;border-radius:0px">

                    <span class="text-sm" style="font-size:12px">{{ session()->get('error') }}</span>

                </div>
            @endif

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Nomor Induk Karyawan" autocomplete="off" autofocus value="{{ old('username') }}">
                <label for="username">Nomor Induk Karyawan</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    autocomplete="off">
                <label for="password">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
        </form>
    </main>
</body>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        localStorage.removeItem('pasien')
        localStorage.removeItem('kamar')
        localStorage.removeItem('nm_pasien')
        localStorage.removeItem('tanggal')
        localStorage.removeItem('tgl_awal')
        localStorage.removeItem('tgl_akhir')
        localStorage.removeItem('tanggal')
        localStorage.removeItem('spesialis')
        localStorage.removeItem('dokter')
        localStorage.removeItem('riwayat')
    });
</script>

</html>
