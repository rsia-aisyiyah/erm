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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        * {
            font-family: "Noto Sans", serif;
            font-optical-sizing: auto;
            font-weight: <weight>;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
        }

        body {
            background: url("{{ asset('img/fasad-depan.jpeg') }}") no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.80);
            /* Adjust transparency here */
            z-index: -1;
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
            <h1 class="h1 fw-bold mb-0">LOGIN ERM
            </h1>
            <p class="fs-6 mt-0">--ELEKTRONIK REKAM MEDIS--</p>
            <img class="mb-4" src="{{ asset('img/LOGO RSIA AISYIAH.png') }}" alt="" width="300" height="auto">

            @if (session()->has('error'))
                <div class="alert alert-danger fade show p-2" role="alert"
                    style="background-color:#dc3545;color:#fff;">

                    <span class="text-sm" style="font-size:12px">{{ session()->get('error') }}</span>

                </div>
            @endif

            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username"
                    placeholder="Nomor Induk Karyawan" autocomplete="off" autofocus value="{{ old('username') }}">
                <label for="username">Nomor Induk Karyawan</label>
            </div>

            <div class="form-floating position-relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                    autocomplete="off">
                <label for="password">Password</label>
                <span id="togglePassword" class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor: pointer;">
                    <i class="bi bi-eye"></i>
                </span>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            <p class="mt-5 mb-3 text-muted">&copy; RSIA Aisyiyah Pekajangan - 2024</p>
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
        localStorage.removeItem('tgl_pertama');
        localStorage.removeItem('tgl_kedua');
    });

    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        const input = document.getElementById('password')
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.replace("bi-eye", "bi-eye-slash");
            input.style.marginBottom = "10px";
        } else {
            passwordInput.type = "password";
            icon.classList.replace("bi-eye-slash", "bi-eye");
        }



    });
</script>

</html>
