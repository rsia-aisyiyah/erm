@extends('content.verify.index')

@push('style')
    <style>
        body {
            background: #f4f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .hero {
            background: linear-gradient(135deg, #dcffe9, #a1ffc4);
            padding: 60px 0 110px;
        }

        .verify-card {
            max-width: 760px;
            margin: auto;
            margin-top: -70px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .08);
        }

        .verify-icon {
            width: 100px;
            height: 100px;
            margin: auto;
            border-radius: 50%;
            background: #EAF8EF;
            color: #198754;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 54px;
        }

        .info-table th,
        .info-table td {
            padding: 14px 0;
            border-bottom: 1px solid #ececec;
        }

        .security-box {
            background: #f8f9fa;
            border-left: 5px solid #0d6efd;
            border-radius: 10px;
            padding: 18px;
        }

        .btn-download {
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

                Rumah Sakit Ibu dan Anak Aisyiyah Pekajangan

            </p>

        </div>

    </div>

    <div class="container">

        <div class="card verify-card">

            <div class="card-body p-5">

                <div class="verify-icon">

                    <i class="bi bi-patch-check-fill"></i>

                </div>

                <h2 class="text-center text-success fw-bold mt-4">

                    Dokumen Berhasil Diverifikasi

                </h2>

                <p class="text-center text-muted">

                    QR Code yang Anda pindai merupakan dokumen elektronik resmi
                    yang diterbitkan oleh Rumah Sakit Ibu dan Anak Aisyiyah Pekajangan.

                </p>

                <div class="text-center mb-4">

                    <span class="badge bg-success px-3 py-2">

                        <i class="bi bi-shield-check"></i>

                        VALID

                    </span>

                </div>

                <table class="table table-borderless info-table">

                    <tr>

                        <th width="220">

                            Nomor Dokumen

                        </th>

                        <td>

                            {{ $dokumen->nomor_dokumen }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Jenis Dokumen

                        </th>

                        <td>

                            Persetujuan Umum Pasien

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Tanggal Terbit

                        </th>

                        <td>

                            {{ \Carbon\Carbon::parse($dokumen->created_at)->translatedFormat('d F Y H:i') }} WIB

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            <span class="badge bg-success">

                                Dokumen Valid

                            </span>

                        </td>

                    </tr>

                </table>

                <div class="security-box mt-4">

                    <h6 class="fw-bold">

                        <i class="bi bi-lock-fill"></i>

                        Keamanan Dokumen

                    </h6>

                    <p class="mb-0 text-muted">

                        Dokumen ini merupakan dokumen elektronik resmi RSIA Aisyiyah Pekajangan.
                        Untuk menjaga kerahasiaan informasi pasien,
                        pengunduhan dokumen memerlukan otentikasi
                        Nomor Rekam Medis dan Tanggal Lahir pasien.

                    </p>

                </div>

                <div class="d-grid mt-4">

                    <button class="btn btn-primary btn-lg btn-download" data-bs-toggle="modal"
                        data-bs-target="#modalAuthentication">

                        <i class="bi bi-download"></i>

                        Download Dokumen

                    </button>

                </div>

            </div>

        </div>

    </div>


    <div class="modal fade" id="modalAuthentication" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form id="formAuthentication">
                    @csrf
                    <input type="hidden" name="uuid" value="{{ $dokumen->uuid }}">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-person-lock"></i>
                            Otentikasi Pasien
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            Silakan masukkan Nomor Rekam Medis dan
                            Tanggal Lahir pasien untuk mengunduh dokumen.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekam Medis</label>
                            <input type="text" name="no_rkm_medis" class="form-control"
                                placeholder="Masukkan Nomor Rekam Medis" required>
                        </div>
                        <div>
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                        <div class="alert alert-danger mt-3 d-none" id="verifyError"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="btnVerifikasi">
                            <i class="bi bi-download"></i>
                            <span id="btnVerifikasiLabel">Verifikasi & Download</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#btnVerifikasi').on('click', function (e) {



                e.preventDefault();

                const $form = $('#formAuthentication');
                const $btn = $('#btnVerifikasi');
                const $btnLabel = $('#btnVerifikasiLabel');
                const $errorBox = $('#verifyError');

                // Reset pesan error
                $errorBox
                    .addClass('d-none')
                    .text('');

                // Disable tombol
                $btn.prop('disabled', true);
                $btnLabel.html(
                    '<span class="spinner-border spinner-border-sm me-2"></span>Memverifikasi...'
                );

                $.ajax({

                    url: "{{ route('dokumen.verifikasi-unduh') }}",
                    type: 'POST',
                    data: {
                        'uuid': $form.find('input[name="uuid"]').val(),
                        'no_rkm_medis': $form.find('input[name="no_rkm_medis"]').val(),
                        'tgl_lahir': $form.find('input[name="tgl_lahir"]').val(),
                    },
                    dataType: 'json',

                    success: function (response) {

                        if (!response.ok) {

                            $errorBox
                                .removeClass('d-none')
                                .text(response.pesan ||
                                    'Nomor Rekam Medis atau Tanggal Lahir tidak sesuai.');

                            return;
                        }

                        // Tutup modal
                        $('#modalAuthentication').modal('hide');

                        // Reset form
                        $form.trigger('reset');

                        // Mulai download melalui signed URL
                        window.location.href = response.url;

                    },

                    error: function (xhr) {

                        let pesan = 'Terjadi kesalahan. Silakan coba kembali.';

                        if (xhr.responseJSON && xhr.responseJSON.pesan) {
                            pesan = xhr.responseJSON.pesan;
                        }

                        $errorBox
                            .removeClass('d-none')
                            .text(pesan);

                    },

                    complete: function () {

                        $btn.prop('disabled', false);

                        // $btnLabel.html(
                        //     '<i class="bi bi-download"></i> Verifikasi & Download'
                        // );

                    }

                });

            });
        })
    </script>
@endpush