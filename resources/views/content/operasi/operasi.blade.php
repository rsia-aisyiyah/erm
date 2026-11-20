@extends('index')

@section('contents')
<div class="container-fluid px-2 py-2">
    <!-- Header Modul Kamar Operasi -->
    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
        <div class="card-body p-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-3 bg-danger bg-opacity-10 text-danger p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="bi bi-heart-pulse-fill fs-4"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark mb-0">KAMAR OPERASI (INSTALASI BEDAH SENTRAL)</h5>
                        <small class="text-muted" style="font-size: 11.5px;">Jadwal Operasi Pasien &amp; Pengisian Rekam Medis Laporan Operasi</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button type="button" class="btn btn-danger btn-sm px-3 fw-bold shadow-sm" onclick="bukaModalBookingBaru()">
                        <i class="bi bi-calendar-plus-fill me-1"></i> + Tambah Jadwal Operasi
                    </button>
                </div>
            </div>

            <!-- Counter Ringkasan Status -->
            <div class="row g-2 mt-2 pt-2 border-top">
                <div class="col-md-3 col-6">
                    <div class="p-2 border rounded-2 bg-light d-flex justify-content-between align-items-center">
                        <span class="small text-muted fw-semibold" style="font-size: 11px;">Total Terjadwal</span>
                        <span class="badge bg-secondary fs-6" id="badgeTotalOperasi">0</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-2 border rounded-2 bg-light d-flex justify-content-between align-items-center">
                        <span class="small text-muted fw-semibold" style="font-size: 11px;">Menunggu Persiapan</span>
                        <span class="badge bg-warning text-dark fs-6" id="badgeMenungguOperasi">0</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-2 border rounded-2 bg-light d-flex justify-content-between align-items-center">
                        <span class="small text-muted fw-semibold" style="font-size: 11px;">Sedang Berlangsung</span>
                        <span class="badge bg-primary fs-6" id="badgeProsesOperasi">0</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-2 border rounded-2 bg-light d-flex justify-content-between align-items-center">
                        <span class="small text-muted fw-semibold" style="font-size: 11px;">Operasi Selesai</span>
                        <span class="badge bg-success fs-6" id="badgeSelesaiOperasi">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
        <div class="card-body p-2.5">
            <div class="row g-2 align-items-end">
                <div class="col-md-3 col-12">
                    <label class="form-label text-muted small fw-bold mb-1" style="font-size: 10.5px;">PERIODE TANGGAL</label>
                    <div class="input-group input-group-sm">
                        <input type="date" class="form-control form-control-sm" id="fil_tgl_awal" value="{{ date('Y-m-d') }}">
                        <span class="input-group-text bg-light text-muted" style="font-size: 11px;">s.d</span>
                        <input type="date" class="form-control form-control-sm" id="fil_tgl_akhir" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-2 col-6">
                    <label class="form-label text-muted small fw-bold mb-1" style="font-size: 10.5px;">STATUS</label>
                    <select class="form-select form-select-sm" id="fil_status">
                        <option value="Semua">Semua Status</option>
                        <option value="Menunggu">Menunggu</option>
                        <option value="Proses Operasi">Proses Operasi</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label text-muted small fw-bold mb-1" style="font-size: 10.5px;">DOKTER OPERATOR</label>
                    <select class="form-select form-select-sm" id="fil_dokter">
                        <option value="">Semua Dokter Operator</option>
                        @foreach ($dokterList as $dok)
                            <option value="{{ $dok->kd_dokter }}">{{ $dok->nm_dokter }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 col-10">
                    <label class="form-label text-muted small fw-bold mb-1" style="font-size: 10.5px;">CARI PASIEN / TINDAKAN</label>
                    <input type="text" class="form-control form-control-sm" id="fil_keyword" placeholder="Nama Pasien / No. RM / No. Rawat...">
                </div>
                <div class="col-md-1 col-2">
                    <button type="button" class="btn btn-primary btn-sm w-100 fw-bold shadow-sm" id="btnCariJadwal" style="height: 31px;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Jadwal & Laporan Operasi -->
    <div class="card border-0 shadow-sm rounded-3 bg-white">
        <div class="card-body p-0">
            <div class="table-responsive" style="min-height: 350px;">
                <table class="table table-hover align-middle mb-0" id="tabelJadwalOperasi" style="font-size: 11.5px;">
                    <thead class="table-light text-uppercase text-muted" style="font-size: 10.5px;">
                        <tr>
                            <th class="text-center py-2" style="width: 40px;">No</th>
                            <th style="width: 140px;">Waktu Operasi</th>
                            <th style="width: 220px;">Identitas Pasien</th>
                            <th>Tindakan Operasi</th>
                            <th style="width: 180px;">Dokter Operator</th>
                            <th class="text-center" style="width: 130px;">Status</th>
                            <th class="text-center" style="width: 120px;">Laporan OK</th>
                            <th class="text-center" style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyJadwalOperasi">
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <div class="spinner-border spinner-border-sm text-danger me-1" role="status"></div>
                                <span>Memuat data jadwal operasi...</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Sertakan Modal Booking & Modal Laporan Operasi -->
@include('content.operasi.modal.modal_booking_operasi')
@include('content.operasi.modal.modal_laporan_operasi')

@endsection

@push('script')
<script>
    // State aplikasi
    let timeoutSearchPasienBooking = null;
    let aktifNoRawatLaporan = null;

    $(document).ready(function() {
        loadDataJadwalOperasi();

        // Event handler filter
        $('#btnCariJadwal').on('click', function() {
            loadDataJadwalOperasi();
        });

        $('#fil_tgl_awal, #fil_tgl_akhir, #fil_status, #fil_dokter').on('change', function() {
            loadDataJadwalOperasi();
        });

        $('#fil_keyword').on('keyup', function(e) {
            if (e.key === 'Enter') {
                loadDataJadwalOperasi();
            }
        });

        // Live search autocomplete pasien di modal booking
        $('#booking_cari_pasien').on('keyup', function() {
            const query = $(this).val().trim();
            clearTimeout(timeoutSearchPasienBooking);
            if (query.length < 2) {
                $('#booking_dropdown_pasien').addClass('d-none').empty();
                return;
            }

            timeoutSearchPasienBooking = setTimeout(function() {
                $.get("{{ route('operasi.pasien.cari') }}", { keyword: query }).done(function(res) {
                    const data = res?.data || [];
                    const $drop = $('#booking_dropdown_pasien');
                    $drop.empty();

                    if (data.length === 0) {
                        $drop.append('<div class="list-group-item list-group-item-action text-muted p-2" style="font-size:11px;">Pasien tidak ditemukan.</div>');
                    } else {
                        data.forEach(function(item) {
                            const nmPasien = item.pasien?.nm_pasien || '-';
                            const noRm = item.no_rkm_medis || '-';
                            const noRawat = item.no_rawat || '-';
                            const kamar = item.kamar_inap && item.kamar_inap.length > 0 ? (item.kamar_inap[0]?.kamar?.bangsal?.nm_bangsal || item.kamar_inap[0]?.kd_kamar || '-') : (item.poliklinik?.nm_poli || 'Ralan');

                            const a = $(`
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action p-2" style="font-size:11.5px;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong class="text-dark">${nmPasien}</strong>
                                        <span class="badge bg-light text-dark border font-monospace">${noRm}</span>
                                    </div>
                                    <div class="d-flex justify-content-between text-muted" style="font-size:10.5px;">
                                        <span>No. Rawat: ${noRawat}</span>
                                        <span>${kamar}</span>
                                    </div>
                                </a>
                            `);

                            a.on('click', function() {
                                pilihPasienBooking(item, kamar);
                            });
                            $drop.append(a);
                        });
                    }
                    $drop.removeClass('d-none');
                });
            }, 300);
        });

        // Simpan Booking
        $('#btnSimpanBookingOperasi').on('click', function() {
            const noRawat = $('#booking_no_rawat').val();
            const paket = $('#booking_kode_paket').val();
            const tanggal = $('#booking_tanggal').val();
            const jamMulai = $('#booking_jam_mulai').val();
            const jamSelesai = $('#booking_jam_selesai').val();
            const dokter = $('#booking_kd_dokter').val();
            const status = $('#booking_status').val();

            if (!noRawat) {
                Swal.fire('Peringatan', 'Harap pilih pasien terlebih dahulu.', 'warning');
                return;
            }
            if (!paket) {
                Swal.fire('Peringatan', 'Harap pilih paket tindakan operasi.', 'warning');
                return;
            }
            if (!dokter) {
                Swal.fire('Peringatan', 'Harap pilih dokter operator.', 'warning');
                return;
            }

            $.ajax({
                url: "{{ route('operasi.booking.simpan') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: noRawat,
                    kode_paket: paket,
                    tanggal: tanggal,
                    jam_mulai: jamMulai,
                    jam_selesai: jamSelesai,
                    kd_dokter: dokter,
                    status: status
                },
                beforeSend: function() {
                    Swal.fire({ title: 'Menyimpan Jadwal...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                },
                success: function(resp) {
                    Swal.fire('Berhasil!', resp.message || 'Jadwal operasi berhasil disimpan.', 'success');
                    $('#modalBookingOperasi').modal('hide');
                    loadDataJadwalOperasi();
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Gagal menyimpan jadwal operasi.';
                    Swal.fire('Gagal!', msg, 'error');
                }
            });
        });

        // Simpan Laporan Operasi
        $('#btnSimpanLaporanOperasi').on('click', function() {
            const form = $('#formLaporanOperasi');
            if (!form[0].checkValidity()) {
                form[0].reportValidity();
                return;
            }

            const dataPayload = form.serialize() + '&_token={{ csrf_token() }}';

            $.ajax({
                url: "{{ route('operasi.laporan.simpan') }}",
                type: "POST",
                data: dataPayload,
                beforeSend: function() {
                    Swal.fire({ title: 'Menyimpan Laporan Operasi...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });
                },
                success: function(resp) {
                    Swal.fire('Berhasil!', resp.message || 'Laporan operasi berhasil disimpan.', 'success');
                    $('#modalLaporanOperasi').modal('hide');
                    loadDataJadwalOperasi();
                },
                error: function(xhr) {
                    const msg = xhr.responseJSON?.message || 'Gagal menyimpan laporan operasi.';
                    Swal.fire('Gagal!', msg, 'error');
                }
            });
        });
    });

    // Load data jadwal operasi via AJAX
    function loadDataJadwalOperasi() {
        const tglAwal = $('#fil_tgl_awal').val();
        const tglAkhir = $('#fil_tgl_akhir').val();
        const status = $('#fil_status').val();
        const kdDokter = $('#fil_dokter').val();
        const keyword = $('#fil_keyword').val();

        const $tbody = $('#tbodyJadwalOperasi');
        $tbody.html(`
            <tr>
                <td colspan="8" class="text-center py-5 text-muted">
                    <div class="spinner-border spinner-border-sm text-danger me-1" role="status"></div>
                    <span>Memuat data jadwal operasi...</span>
                </td>
            </tr>
        `);

        $.get("{{ route('operasi.jadwal') }}", {
            tgl_awal: tglAwal,
            tgl_akhir: tglAkhir,
            status: status,
            kd_dokter: kdDokter,
            keyword: keyword
        }).done(function(res) {
            const list = res?.data || [];
            $tbody.empty();

            let total = list.length;
            let countMenunggu = 0;
            let countProses = 0;
            let countSelesai = 0;

            if (list.length === 0) {
                $tbody.html(`
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-1 text-secondary"></i>
                            Tidak ada jadwal operasi pada periode dan filter yang dipilih.
                        </td>
                    </tr>
                `);
            } else {
                list.forEach(function(item, idx) {
                    if (item.status === 'Menunggu') countMenunggu++;
                    else if (item.status === 'Proses Operasi') countProses++;
                    else if (item.status === 'Selesai') countSelesai++;

                    const reg = item.reg_periksa || {};
                    const pasien = reg.pasien || {};
                    const nmPasien = pasien.nm_pasien || '-';
                    const noRm = pasien.no_rkm_medis || '-';
                    const jk = pasien.jk === 'L' ? 'L' : (pasien.jk === 'P' ? 'P' : '-');
                    const kamar = reg.kamar_inap && reg.kamar_inap.length > 0 
                        ? (reg.kamar_inap[0]?.kamar?.bangsal?.nm_bangsal || reg.kamar_inap[0]?.kd_kamar || '-') 
                        : (reg.poliklinik?.nm_poli || 'Ralan');

                    const tindakan = item.paket_operasi?.nm_perawatan || item.kode_paket || '-';
                    const dokter = item.dokter?.nm_dokter || item.kd_dokter || '-';

                    // Status Badge & Dropdown Action
                    let statusBadge = '';
                    if (item.status === 'Menunggu') {
                        statusBadge = `<span class="badge bg-warning-subtle text-warning-emphasis border border-warning px-2 py-1 rounded-pill"><i class="bi bi-hourglass-split me-1"></i>Menunggu</span>`;
                    } else if (item.status === 'Proses Operasi') {
                        statusBadge = `<span class="badge bg-primary-subtle text-primary border border-primary px-2 py-1 rounded-pill"><i class="bi bi-gear-wide-connected me-1"></i>Proses OK</span>`;
                    } else {
                        statusBadge = `<span class="badge bg-success-subtle text-success border border-success px-2 py-1 rounded-pill"><i class="bi bi-check-circle-fill me-1"></i>Selesai</span>`;
                    }

                    // Status Laporan Operasi
                    const hasLaporan = !!(item.laporan_operasi || item.laporan_operasi_safe || item.laporan_operasi_khanza || item.operasi_khanza);
                    const badgeLaporan = hasLaporan
                        ? `<span class="badge bg-success text-white py-1 px-1.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-check-all me-0.5"></i>Terisi</span>`
                        : `<span class="badge bg-secondary-subtle text-muted border py-1 px-1.5 rounded-pill" style="font-size: 10px;"><i class="bi bi-dash-circle me-0.5"></i>Belum</span>`;

                    const safeNoRawat = (item.no_rawat || '').replace(/'/g, "\\'");
                    const safeTanggal = (item.tanggal || '').replace(/'/g, "\\'");

                    const tr = `
                        <tr>
                            <td class="text-center font-monospace">${idx + 1}</td>
                            <td>
                                <strong class="d-block text-dark">${item.tanggal}</strong>
                                <small class="text-muted"><i class="bi bi-clock me-0.5"></i>${item.jam_mulai} - ${item.jam_selesai}</small>
                            </td>
                            <td>
                                <strong class="d-block text-primary">${nmPasien}</strong>
                                <small class="text-muted" style="font-size: 11px;">
                                    RM: <b class="text-dark">${noRm}</b> (${jk}) &bull; <span class="badge bg-light text-dark border">${kamar}</span>
                                </small>
                            </td>
                            <td>
                                <strong class="text-dark">${tindakan}</strong>
                                <small class="d-block text-muted font-monospace">${item.kode_paket}</small>
                            </td>
                            <td>
                                <span class="fw-semibold text-dark">${dokter}</span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm p-0 border-0 shadow-none dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        ${statusBadge}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size: 11.5px;">
                                        <li><a class="dropdown-item py-1" href="javascript:void(0)" onclick="updateStatusOperasi('${safeNoRawat}', '${safeTanggal}', 'Menunggu')"><i class="bi bi-hourglass-split text-warning me-1"></i> Set Menunggu</a></li>
                                        <li><a class="dropdown-item py-1" href="javascript:void(0)" onclick="updateStatusOperasi('${safeNoRawat}', '${safeTanggal}', 'Proses Operasi')"><i class="bi bi-gear-wide-connected text-primary me-1"></i> Set Proses OK</a></li>
                                        <li><a class="dropdown-item py-1" href="javascript:void(0)" onclick="updateStatusOperasi('${safeNoRawat}', '${safeTanggal}', 'Selesai')"><i class="bi bi-check-circle text-success me-1"></i> Set Selesai</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td class="text-center">
                                ${badgeLaporan}
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button" class="btn btn-sm ${hasLaporan ? 'btn-outline-primary' : 'btn-primary'} py-1 px-2 text-nowrap shadow-none" style="font-size: 11px;" onclick="bukaModalLaporanOperasi('${safeNoRawat}')" title="${hasLaporan ? 'Lihat / Edit Laporan Operasi' : 'Isi Laporan Operasi'}">
                                        <i class="bi ${hasLaporan ? 'bi-pencil-square' : 'bi-plus-circle'}"></i> Laporan
                                    </button>
                                    ${hasLaporan ? `
                                        <a href="{{ url('/operasi/laporan/cetak') }}/${encodeURIComponent(safeNoRawat.replace(/\//g, '-'))}" target="_blank" class="btn btn-outline-secondary btn-sm py-1 px-2 shadow-none" style="font-size: 11px;" title="Cetak Laporan Operasi PDF">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                    ` : ''}
                                    <button type="button" class="btn btn-outline-danger btn-sm py-1 px-1.5 shadow-none" onclick="hapusBookingOperasi('${safeNoRawat}', '${safeTanggal}')" title="Hapus Jadwal Operasi">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                    $tbody.append(tr);
                });
            }

            $('#badgeTotalOperasi').text(total);
            $('#badgeMenungguOperasi').text(countMenunggu);
            $('#badgeProsesOperasi').text(countProses);
            $('#badgeSelesaiOperasi').text(countSelesai);
        });
    }

    // Modal Booking Baru
    function bukaModalBookingBaru() {
        $('#formBookingOperasi')[0].reset();
        resetPilihanPasienBooking();
        $('#booking_tanggal').val($('#fil_tgl_awal').val() || moment().format('YYYY-MM-DD'));
        $('#modalBookingOperasi').modal('show');
    }

    function pilihPasienBooking(item, kamar) {
        $('#booking_no_rawat').val(item.no_rawat);
        $('#lblBookingNamaPasien').text(item.pasien?.nm_pasien || '-');
        $('#lblBookingNoRm').text(item.no_rkm_medis || '-');
        $('#lblBookingNoRawat').text(item.no_rawat);
        $('#lblBookingKamar').text(kamar);
        $('#booking_info_pasien_terpilih').removeClass('d-none');
        $('#booking_dropdown_pasien').addClass('d-none').empty();
        $('#booking_cari_pasien').val('');
    }

    function resetPilihanPasienBooking() {
        $('#booking_no_rawat').val('');
        $('#booking_info_pasien_terpilih').addClass('d-none');
        $('#booking_cari_pasien').val('').focus();
    }

    // Update Status Cepat
    function updateStatusOperasi(noRawat, tanggal, status) {
        $.post("{{ route('operasi.booking.status') }}", {
            _token: "{{ csrf_token() }}",
            no_rawat: noRawat,
            tanggal: tanggal,
            status: status
        }).done(function(res) {
            loadDataJadwalOperasi();
        }).fail(function(xhr) {
            Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal mengubah status operasi.', 'error');
        });
    }

    // Hapus Booking
    function hapusBookingOperasi(noRawat, tanggal) {
        Swal.fire({
            title: 'Hapus Jadwal Operasi?',
            text: `Yakin ingin menghapus jadwal operasi pasien ${noRawat} pada ${tanggal}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('operasi.booking.hapus') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: noRawat,
                        tanggal: tanggal
                    },
                    success: function(res) {
                        Swal.fire('Terhapus!', res.message || 'Jadwal operasi berhasil dihapus.', 'success');
                        loadDataJadwalOperasi();
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal menghapus jadwal operasi.', 'error');
                    }
                });
            }
        });
    }

    // Modal Laporan Operasi
    function bukaModalLaporanOperasi(noRawat) {
        aktifNoRawatLaporan = noRawat;
        $('#formLaporanOperasi')[0].reset();
        $('#laporan_no_rawat').val(noRawat);
        $('#btnCetakLaporanModal').addClass('d-none');
        $('#btnHapusLaporanModal').addClass('d-none');

        Swal.fire({ title: 'Memuat Laporan Operasi...', allowOutsideClick: false, didOpen: () => { Swal.showLoading(); } });

        $.get("{{ route('operasi.laporan.detail') }}", { no_rawat: noRawat }).done(function(res) {
            Swal.close();
            const data = res?.data || {};
            const isNew = !!res.is_new;

            // Info Pasien
            const reg = data.reg_periksa || {};
            const pas = data.pasien || reg.pasien || {};
            $('#lblLaporanNamaPasien').text(pas.nm_pasien || '-');
            $('#lblLaporanNoRm').text(pas.no_rkm_medis || '-');
            $('#lblLaporanNoRawat').text(noRawat);
            $('#lblLaporanJkLahir').text(`${pas.jk === 'L' ? 'Laki-Laki' : 'Perempuan'} / ${pas.tgl_lahir || '-'}`);
            
            const kamar = reg.kamar_inap && reg.kamar_inap.length > 0 
                ? (reg.kamar_inap[0]?.kamar?.bangsal?.nm_bangsal || reg.kamar_inap[0]?.kd_kamar || '-') 
                : '-';
            $('#lblLaporanKamar').text(kamar);

            // Populate Form
            $('#laporan_tgl_operasi').val(data.tgl_operasi ? moment(data.tgl_operasi).format('YYYY-MM-DDTHH:mm') : moment().format('YYYY-MM-DDTHH:mm'));
            $('#laporan_tgl_selesai').val(data.tgl_selesai ? moment(data.tgl_selesai).format('YYYY-MM-DDTHH:mm') : moment().format('YYYY-MM-DDTHH:mm'));
            $('#laporan_kategori').val(data.kategori || 'Elektive');
            $('#laporan_jenis_anestesi').val(data.jenis_anestesi || 'GA');
            $('#laporan_kode_paket').val(data.kode_paket || '');

            $('#laporan_operator1').val(data.operator1 || '');
            $('#laporan_dokter_anestesi').val(data.dokter_anestesi || '-');
            $('#laporan_dr_anestesi_hadir').val(data.dr_anestesi_hadir || 'Ya');
            $('#laporan_asisten_operator1').val(data.asisten_operator1 || '-');
            $('#laporan_asisten_anestesi').val(data.asisten_anestesi || '-');
            $('#laporan_asisten_operator2').val(data.asisten_operator2 || '-');
            $('#laporan_dokter_anak').val(data.dokter_anak || '-');
            $('#laporan_dr_anak_hadir').val(data.dr_anak_hadir || 'Tidak');
            $('#laporan_onloop').val(data.onloop || '-');

            $('#laporan_diagnosa_preop').val(data.diagnosa_preop || '');
            $('#laporan_diagnosa_postop').val(data.diagnosa_postop || '');
            $('#laporan_jaringan_insisi').val(data.jaringan_insisi || '');
            $('#laporan_pemeriksaan_pa').val(data.pemeriksaan_pa || 'Tidak');
            $('#laporan_narasi_operasi').val(data.laporan_operasi || '');

            if (!isNew) {
                $('#btnCetakLaporanModal').removeClass('d-none');
                $('#btnHapusLaporanModal').removeClass('d-none');
            }

            $('#modalLaporanOperasi').modal('show');
        }).fail(function(xhr) {
            Swal.fire('Gagal!', 'Gagal mengambil data laporan operasi.', 'error');
        });
    }

    function cetakLaporanOperasiAktif() {
        if (!aktifNoRawatLaporan) return;
        const safeRawat = aktifNoRawatLaporan.replace(/\//g, '-');
        window.open(`{{ url('/operasi/laporan/cetak') }}/${encodeURIComponent(safeRawat)}`, '_blank');
    }

    function hapusLaporanOperasiAktif() {
        if (!aktifNoRawatLaporan) return;
        Swal.fire({
            title: 'Hapus Laporan Operasi?',
            text: 'Data laporan operasi yang sudah tersimpan akan dihapus secara permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('operasi.laporan.hapus') }}",
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: aktifNoRawatLaporan
                    },
                    success: function(res) {
                        Swal.fire('Berhasil!', res.message || 'Laporan operasi berhasil dihapus.', 'success');
                        $('#modalLaporanOperasi').modal('hide');
                        loadDataJadwalOperasi();
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal!', xhr.responseJSON?.message || 'Gagal menghapus laporan operasi.', 'error');
                    }
                });
            }
        });
    }

    // Insert Template Cepat Laporan Operasi
    function insertTemplateLaporan(tipe) {
        let tpl = '';
        if (tipe === 'sc') {
            tpl = `- Pasien posisi terlentang dalam anestesi spinal.
- Dilakukan tindakan asepsis dan antisepsis pada lapangan operasi, kemudian dipasang doek steril.
- Dilakukan insisi pfannenstiel / mediana inferior sepanjang ± 10 cm, menembus kutis, subkutis, fasia.
- Fasia digunting ke kranial dan kaudal. Otot diregangkan secara tumpul.
- Peritoneum dibuka secara tajam kemudian diperlebar.
- Tampak uterus gravida aterm. Dilakukan plika vesikouterina dijepit, digunting melintang dan disisihkan ke kaudal.
- Dilakukan sayatan semilunar pada SBR sampai menembus kavum uteri. Ketuban dipecahkan, jernih.
- Bayi dilahirkan dengan meluksir kepala: Lahir bayi (Laki-laki / Perempuan), BB: ... gram, PB: ... cm, APGAR Score: .../...
- Plasenta dilahirkan secara manual lengkap, insersi normal.
- Kavum uteri dibersihkan dengan kasa steril, kontraksi uterus baik.
- SBR dijahit dua lapis (two-layer). Perdarahan terkontrol.
- Eksplorasi kedua adneksa dalam batas normal.
- Rongga abdomen dibersihkan dari bekuan darah.
- Dinding abdomen dijahit lapis demi lapis.
- Kulit dijahit secara subkutikuler. Operasi selesai.`;
        } else if (tipe === 'kuret') {
            tpl = `- Pasien posisi litotomi dalam anestesi umum / sedasi.
- Asepsis dan antisepsis genitalia eksterna dan vagina, pasang doek steril.
- Pasang spekulum sims anterior dan posterior, portio dijepit dengan tenakulum pada arah jam 11.
- Dilakukan sondase uterus: antefleksi / retrofleksi, ukuran ... cm.
- Dilakukan kuretase secara bertahap dan sistematis searah jarum jam hingga kavum uteri bersih (teraba sensasi krip).
- Didapatkan massa / jaringan konsepsi ± ... gram.
- Tenakulum dan spekulum dilepas, perdarahan minimal.
- Vagina dibersihkan dari sisa darah. Operasi selesai.`;
        } else if (tipe === 'apendiktomi') {
            tpl = `- Pasien posisi supine dalam anestesi general / spinal.
- Tindakan aseptik dan antiseptik, drapping lapangan operasi.
- Insisi McBurney ± 5 cm menembus kutis, subkutis, fasia oblikus eksternus.
- Otot displit secara tumpul, peritoneum dibuka.
- Identifikasi sekum dan apendiks: tampak apendiks inflamasi / perforasi.
- Mesoapendiks diligasi dan dipotong. Basis apendiks diligasi ganda dan diamputasi.
- Stump apendiks diinvaginasi dengan jahitan z-stitch / tabung purse string.
- Perdarahan dirawat dengan baik, rongga abdomen dibersihkan.
- Luka operasi ditutup lapis demi lapis. Operasi selesai.`;
        } else if (tipe === 'hernia') {
            tpl = `- Pasien posisi terlentang dalam anestesi spinal / general.
- Asepsis dan antisepsis daerah inguinal, pasang doek steril.
- Insisi transversal / oblique inguinal menembus kutis dan subkutis.
- Fasia oblikus eksternus dibuka searah seratnya, funikulus spermatikus diidentifikasi dan dibebaskan.
- Kantong hernia diidentifikasi, dibebaskan dari jaringan sekitarnya hingga leher kantong.
- Kantong dibuka, isi dikembalikan ke kavum abdomen. Dilakukan ligasi tinggi kantong hernia.
- Dilakukan hernioplasty / pemasangan mesh (bila diindikasikan).
- Kontrol hemostasis, luka operasi ditutup bertingkat. Operasi selesai.`;
        } else {
            tpl = `- Pasien posisi tidur terlentang dalam narkose umum / regional.
- Tindakan aseptik dan antiseptik lapangan operasi, pasang linen steril.
- Dilakukan insisi lapangan operasi.
- Dilakukan eksplorasi dan tindakan bedah...
- Kontrol hemostasis dengan baik, hitung kasa dan instrumen lengkap.
- Luka ditutup lapis demi lapis sampai kulit. Operasi selesai.`;
        }

        const current = $('#laporan_narasi_operasi').val();
        if (current && current.trim().length > 0) {
            Swal.fire({
                title: 'Timpa Laporan?',
                text: 'Area laporan sudah berisi teks. Apakah Anda ingin menggantinya dengan template baru?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Ganti',
                cancelButtonText: 'Batal'
            }).then((res) => {
                if (res.isConfirmed) {
                    $('#laporan_narasi_operasi').val(tpl);
                }
            });
        } else {
            $('#laporan_narasi_operasi').val(tpl);
        }
    }
</script>
@endpush

