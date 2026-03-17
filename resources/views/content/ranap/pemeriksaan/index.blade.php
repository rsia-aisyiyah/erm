@extends('index')
@push('style')
    <style>
        .nowrap {
            white-space: nowrap !important;
        }

        th {
            white-space: nowrap;
        }

        .dataTables_wrapper {
            width: 100%;
            margin: 0 auto;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
@endpush
@section('contents')

    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Tanggal Awal</label>
                    <input type="date" id="tgl_perawatan1" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label>Tanggal Akhir</label>
                    <input type="date" id="tgl_perawatan2" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-4">
                    <label>Nama Kamar</label>
                    <input type="text" id="kamar" class="form-control" placeholder="Cari bangsal/kamar...">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button id="btnFilterPemeriksaan" class="btn btn-primary w-100" type="button"
                        style="font-size: 12px">Cari Data</button>
                </div>
            </div>
        </div>

    </div>

    <table class="table table-sm table-striped table-hover nowrap" id="tablePemeriksaanRanap"></table>
        <div class="modal fade" id="modalDetailPemeriksaan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-file-medical-alt me-2"></i>Detail Pemeriksaan Pasien
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body bg-light">
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body py-2 px-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4 border-end-md">
                                        <small class="text-muted d-block">No. Rawat</small>
                                        <span id="detailNoRawat" class="fw-bold text-primary">-</span>
                                    </div>
                                    <div class="col-md-4 border-end-md">
                                        <small class="text-muted d-block">Nama Pasien</small>
                                        <span id="detailNamaPasien" class="fw-bold text-primary">-</span>
                                    </div>
                                    <div class="col-md-4 border-end-md">
                                        <small class="text-muted d-block">Tgl. Lahir/Umur</small>
                                        <span id="detailTglLahir" class="fw-bold text-primary">-</span>
                                    </div>
                                    <div class="col-md-4 border-end-md">
                                        <small class="text-muted d-block">Dokter DPJP</small>
                                        <span id="detailDokterDpjp" class="fw-bold text-dark">-</span>
                                    </div>
                                    <div class="col-md-4 border-end-md">
                                        <small class="text-muted d-block">Tanggal Pemeriksaan</small>
                                        <span id="detailTgl" class="fw-bold text-dark">-</span>
                                    </div>
                                    <div class="col-md-4">
                                        <small class="text-muted d-block">Petugas Input</small>
                                        <span id="detailPetugas" class="fw-bold text-dark">-</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="sectionVerifikasi"></div>
                        <div class="card mb-3 border-0 shadow-sm section-ttv">
                            <div class="card-header bg-white fw-bold"><i class="fas fa-vitals me-2 text-danger"></i>Tanda-Tanda
                                Vital</div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Suhu</small>
                                            <h5 id="detailSuhu" class="mb-0 fw-bold text-danger">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Tensi</small>
                                            <h5 id="detailTensi" class="mb-0 fw-bold">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Nadi</small>
                                            <h5 id="detailNadi" class="mb-0 fw-bold">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">SPO2</small>
                                            <h5 id="detailSpo2" class="mb-0 fw-bold text-success">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">GCS (E,V,M)</small>
                                            <h5 id="detailGcs" class="mb-0">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Respirasi</small>
                                            <h5 id="detailRespirasi" class="mb-0">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Tinggi (cm)</small>
                                            <h5 id="detailTinggi" class="mb-0">-</h5>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="p-2 border rounded bg-white text-center h-100">
                                            <small class="text-muted d-block">Berat (Kg)</small>
                                            <h5 id="detailBerat" class="mb-0">-</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div id="labelS" class="card-header bg-info text-white fw-bold">S (Subjek/Keluhan)</div>
                                <div id="detailKeluhan" class="card-body soap-content">-</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div id="labelO" class="card-header bg-success text-white fw-bold">O (Objek/Pemeriksaan)</div>
                                <div id="detailPemeriksaan" class="card-body soap-content">-</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div id="labelA" class="card-header bg-warning text-dark fw-bold">A (Asesmen/Penilaian)</div>
                                <div id="detailPenilaian" class="card-body soap-content">-</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div id="labelP" class="card-header bg-secondary text-white fw-bold">P (Plan/Rencana)</div>
                                <div id="detailRtl" class="card-body soap-content">-</div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('script')
    <script>
        $(document).ready(function () {
            const tablePemeriksaanRanap = $('#tablePemeriksaanRanap').DataTable({
                "processing": true,
                "serverSide": true,
                "stateSave": true,
                "ordering": false,
                "order": [[0, "asc"]],
                "scrollX": true,
                "autoWidth": false,
                "dom": 'Blfrtip',
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "fixedColumns": {
                    left: 4,
                    right: 0
                },
                "autoWidth": false,
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success btn-sm',
                        filename: 'Laporan_Pemeriksaan_Ranap_' + $('#tgl_perawatan1').val(),
                        title: 'Data Pemeriksaan Rawat Inap',
                        exportOptions: {
                            modifier: {
                                page: 'all',
                                search: 'applied'
                            },
                        }
                    }
                ],
                "ajax": {
                    "url": "{{ route('ranap.pemeriksaan-ranap.table') }}",
                    "data": function (d) {
                        d.tgl_perawatan1 = $('#tgl_perawatan1').val();
                        d.tgl_perawatan2 = $('#tgl_perawatan2').val();
                        d.kamar = $('#kamar').val();
                    },
                },

                "createdRow": function (row, data, dataIndex) {
                    $(row).attr('class', `row-${dataIndex} cursor-pointer`);
                    $(row).attr('onclick', `setDetailPemeriksaanRanap('${data.no_rawat}', '${data.tgl_perawatan}', '${data.jam_rawat}')`);
                },

                "columns": [
                    { data: 'flag', name: 'flag', title: '', className: 'nowrap' },
                    { data: 'no_rawat', name: 'no_rawat', title: 'No. Rawat', className: 'nowrap' },
                    { data: 'reg_periksa.no_rkm_medis', name: 'reg_periksa.no_rkm_medis', title: 'No. RM' },
                    {
                        data: 'reg_periksa', name: 'reg_periksa', title: 'Nama Pasien', className: "fw-bold", render: function (data, type, row) {

                            let penjabIcon = '';

                            if (data.penjab.kd_pj === 'A03') {
                                penjabIcon = `<span class="text-danger">${data.penjab.png_jawab}</span> `
                            } else {
                                penjabIcon = `<span class="text-success">${data.penjab.png_jawab}</span> `
                            }
                            return `${setIconGender(data.pasien.jk)} ${data.pasien.nm_pasien} (${data.umurdaftar} ${data.sttsumur}) <br/> ${penjabIcon}`;
                        }
                    },
                    {
                        data: 'reg_periksa.tgl_registrasi', name: 'reg_periksa.tgl_registrasi', title: 'Lama Inap', render: function (data, type, row) {
                            return `${hitungLamaHari(data)} Hari`;
                        }
                    },
                    {
                        data: 'tgl_perawatan', name: 'tgl_perawatan', title: 'Tgl. Pemeriksaan', render: function (data, type, row) {
                            return formatTanggal(data);
                        }
                    },
                    { data: 'jam_rawat', name: 'jam_rawat', title: 'Jam' },
                    { data: 'keluhan', name: 'keluhan', title: 'Subjek' },
                    {
                        data: 'pemeriksaan', name: 'pemeriksaan', title: 'Object'
                    },
                    {
                        data: 'penilaian', name: 'penilaian', title: 'Assessment'
                    },
                    {
                        data: 'rtl', name: 'rtl', title: 'Plan'
                    },

                    {
                        data: 'kamar_inap', name: 'kamar_inap', title: 'Kamar', render: function (data, type, row) {
                            if (data && Array.isArray(data) && data.length > 0) {
                                const kamarAktif = data.find((item) => item.stts_pulang !== 'Pindah Kamar');
                                if (kamarAktif && kamarAktif.kamar && kamarAktif.kamar.bangsal) {
                                    return kamarAktif.kamar.bangsal.nm_bangsal;
                                }
                                if (data[0].kamar && data[0].kamar.bangsal) {
                                    return data[0].kamar.bangsal.nm_bangsal;
                                }
                            }
                            return '--'
                        }
                    },
                    { data: 'petugas.nama', name: 'nip', title: 'Petugas' },

                ]
            })

            $('#btnFilterPemeriksaan').on('click', function (e) {
                e.preventDefault();
                tablePemeriksaanRanap.ajax.reload();
            });
        })
        function setDetailPemeriksaanRanap(no_rawat, tgl, jam) {
            const modal = $('#modalDetailPemeriksaan');
            modal.modal('show');

            $('#detailKeluhan').html('<small class="text-muted">Memuat data...</small>');

            $.ajax({
                url: '/erm/soap/ambil',
                data: {
                    'no_rawat': no_rawat,
                    'tgl_perawatan': tgl,
                    'jam_rawat': jam
                },
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            }).done(function (response) {
                const data = response;

                $('#detailNoRawat').text(data.no_rawat);
                $('#detailTgl').text(`${formatTanggal(data.tgl_perawatan)} ${data.jam_rawat}`);
                $('#detailNamaPasien').html(`${setIconGender(data.reg_periksa.pasien.jk)} ${data.reg_periksa.pasien.nm_pasien}`);
                $('#detailTglLahir').text(`${formatTanggal(data.reg_periksa.pasien.tgl_lahir)} / ${data.reg_periksa.umurdaftar} ${data.reg_periksa.sttsumur}`);
                $('#detailDokterDpjp').text(data.reg_periksa.dokter.nm_dokter);
                $('#detailPetugas').text(data.petugas.nama);

                if (data.sbar !== null) {
                    // 1. Sembunyikan TTV & Set Badge
                    $('.section-ttv').hide();
                    $('#detailBadgeFlag').html('<span class="badge bg-danger ms-2">SBAR</span>');

                    // 2. Ubah Label Menjadi SBAR
                    $('#labelS').html('S (Situation)');
                    $('#labelO').html('B (Background)');
                    $('#labelA').html('A (Assessment)');
                    $('#labelP').html('R (Recommendation)');

                    // 3. Logika Verifikasi (Sesuai kode Anda sebelumnya)
                    if (data.sbar.dokter_konsul !== null) {
                        $('#sectionVerifikasi').html(`
            <div class="alert alert-success d-flex align-items-center mb-3">
                <i class="fas fa-check-circle me-2"></i>
                <div>
                    <strong>Terverifikasi:</strong> Dikonfirmasi oleh <strong>${data.sbar.dokter_konsul.dokter_sbar.nm_dokter}</strong> pada ${formatTanggal(data.sbar.dokter_konsul.tgl_perawatan)} ${data.sbar.dokter_konsul.jam_rawat}
                </div>
            </div>
        `);
                    } else {
                        $('#sectionVerifikasi').html(`
            <div class="alert alert-warning d-flex align-items-center mb-3">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <div><strong>Belum Verifikasi:</strong> Menunggu konfirmasi DPJP (TBAK).</div>
            </div>
        `);
                    }
                } else {
                    // 1. Tampilkan TTV & Set Badge
                    $('.section-ttv').show();
                    $('#detailBadgeFlag').html('<span class="badge bg-primary ms-2">CPPT</span>');
                    $('#sectionVerifikasi').empty();

                    // 2. Kembalikan Label ke SOAP (Penting agar tidak tertukar saat buka detail lain)
                    $('#labelS').html('S (Subjek/Keluhan)');
                    $('#labelO').html('O (Objek/Pemeriksaan)');
                    $('#labelA').html('A (Asesmen/Penilaian)');
                    $('#labelP').html('P (Plan/Rencana)');
                }

                $('#detailSuhu').text(data.suhu_tubuh ? data.suhu_tubuh + " °C" : "-");
                $('#detailTensi').text(data.tensi || "-");
                $('#detailNadi').text(data.nadi || "-");
                $('#detailRespirasi').text(data.respirasi || "-");
                $('#detailTinggi').text(data.tinggi || "-");
                $('#detailBerat').text(data.berat || "-");
                $('#detailGcs').text(data.gcs || "-");
                $('#detailSpo2').text(data.spo2 || "-");

                $('#detailKeluhan').html(stringPemeriksaan(data.keluhan));
                $('#detailPemeriksaan').html(stringPemeriksaan(data.pemeriksaan));
                $('#detailPenilaian').html(stringPemeriksaan(data.penilaian));
                $('#detailRtl').html(stringPemeriksaan(data.rtl));

            }).fail(function (err) {
                alert("Gagal mengambil data pemeriksaan");
                console.error(err);
            });
        }


    </script>
@endpush