<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css') }}">
    <style>
        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        .error-card {
            max-width: 480px;
            width: 100%;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }
        .icon-wrap {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }
    </style>
</head>

<body class="p-3">
    <div class="card error-card bg-white p-4 p-md-5 text-center">
        <div class="mb-3">
            <span class="icon-wrap">
                <i class="bi bi-shield-lock-fill"></i>
            </span>
        </div>
        <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-1 mb-2 fw-semibold">
            HTTP 403 &bull; Akses Ditolak
        </span>
        <h4 class="fw-bold text-dark mb-2">Anda Tidak Memiliki Hak Akses</h4>
        <p class="text-muted small mb-4">
            {{ $exception->getMessage() ?: 'Akun Anda tidak diizinkan membuka halaman atau modul ini. Silakan hubungi unit IT / SIMRS jika Anda memerlukan hak akses tambahan.' }}
        </p>

        @if (session()->has('pegawai'))
            <div class="bg-light rounded-3 p-2 px-3 mb-4 small text-start border">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Pengguna:</span>
                    <span class="fw-semibold text-dark">{{ session('pegawai')->nama ?? '-' }}</span>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <span class="text-muted">NIK / Dept:</span>
                    <span class="text-secondary">{{ session('pegawai')->nik ?? '-' }} ({{ session('pegawai')->departemen ?? '-' }})</span>
                </div>
            </div>
        @endif

        <div class="d-flex gap-2 justify-content-center">
            <button type="button" onclick="window.history.back()" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </button>
            <a href="{{ url('/') }}" class="btn btn-primary btn-sm px-3 rounded-pill">
                <i class="bi bi-house-door me-1"></i> Halaman Utama
            </a>
        </div>
    </div>
</body>

</html>
