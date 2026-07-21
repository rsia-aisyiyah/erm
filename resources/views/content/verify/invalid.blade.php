@extends('content.verify.index')

@push('style')
    <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #ffc0c0, #ffa6a6);
            padding: 60px 0 110px;
        }

        .invalid-card {
            max-width: 760px;
            margin: auto;
            margin-top: -70px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .08);
        }

        .invalid-icon {
            width: 100px;
            height: 100px;
            margin: auto;
            border-radius: 50%;
            background: #FDECEC;
            color: #DC3545;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 54px;
        }

        .info-box {
            background: #fff7ed;
            border-left: 5px solid #f59e0b;
            border-radius: 10px;
            padding: 18px;
        }

        .action-btn {
            border-radius: 12px;
            padding: 12px;
        }
    </style>
@endpush
@section('content')
    <div class="hero">

        <div class="container text-center">

            <img src="{{ asset('img/LOGO RSIA AISYIAH.png') }}" height="80">

            <h2 class="fw-bold mt-3">
                Portal Verifikasi Dokumen Elektronik
            </h2>

            <p class="mb-0 opacity-75">
                Rumah Sakit Ibu dan Anak
            </p>

        </div>

    </div>


    <div class="container">

        <div class="card invalid-card">

            <div class="card-body p-5">

                <div class="invalid-icon">

                    <i class="bi bi-x-circle-fill"></i>

                </div>

                <h2 class="text-center text-danger fw-bold mt-4">

                    {{ $title ?? 'Dokumen Tidak Valid' }}

                </h2>

                <p class="text-center text-muted">

                    {{ $message ?? 'QR Code yang Anda pindai tidak terdaftar pada sistem RSIA atau sudah tidak berlaku.' }}

                </p>

                <div class="info-box mt-4">

                    <h6 class="fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                        Informasi
                    </h6>

                    <ul class="mb-0 text-muted">
                        <li>QR Code mungkin rusak atau tidak lengkap.</li>
                        <li>Dokumen mungkin bukan diterbitkan oleh RSIA.</li>
                        <li>Tautan verifikasi mungkin sudah tidak berlaku.</li>
                        <li>Pastikan QR Code berasal dari dokumen resmi RSIA.</li>
                    </ul>

                </div>

                <hr class="my-4">

                <div class="text-center text-muted small">

                    <div class="fw-semibold mb-1">
                        Butuh bantuan?
                    </div>

                    Jika Anda merasa dokumen ini seharusnya valid, silakan hubungi petugas RSIA
                    dengan menyertakan QR Code atau nomor dokumen terkait.

                </div>

            </div>

        </div>

    </div>

@endsection