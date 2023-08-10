@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            @if (session()->get('pegawai')->bidang != 'Direksi' && session()->get('pegawai')->bidang != 'Spesialis')
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <div class="row gy-2">
                                <div class="col-lg-2 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="row gy-2">
                                            <div class="col col-sm-12">
                                                <div class="form-radio form-radio-inline mt-2">
                                                    <input class="form-radio-input" type="radio" id="belum" name="stts_pulang"
                                                        value="Belum Pulang">
                                                    <label class="form-radio-label" for="belum">Belum
                                                        Pulang</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="row gy-2">
                                            <div class="col col-sm-4">
                                                <div class="form-radio form-radio-inline mt-2">
                                                    <input class="form-radio-input" type="radio" id="pulang" name="stts_pulang"
                                                        value="pulang">
                                                    <label class="form-radio-label" for="pulang">Pulang</label>
                                                </div>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                    id="tgl_pulang_awal" name="tgl_pulang_awal" autocomplete="off"
                                                    style="border-radius:0px;font-size:12px" disabled>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                    id="tgl_pulang_akhir" name="tgl_pulang_akhir" autocomplete="off"
                                                    style="border-radius:0px;font-size:12px" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="row gy-2">
                                            <div class="col col-sm-4">
                                                <div class="form-radio form-radio-inline mt-2">
                                                    <input class="form-radio-input" type="radio" id="masuk" name="stts_pulang"
                                                        value="masuk">
                                                    <label class="form-radio-label" for="masuk">Masuk</label>
                                                </div>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                    id="tgl_masuk_awal" name="tgl_masuk_awal" autocomplete="off"
                                                    style="border-radius:0px;font-size:12px" disabled>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                    id="tgl_masuk_akhir" name="tgl_masuk_akhir" autocomplete="off"
                                                    style="border-radius:0px;font-size:12px" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-success btn-sm" style="border-radius:0px"
                                            id="cari">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="row gy-2">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <select name="spesialis" id="spesialis" class="form-select form-select-sm"
                                        style="width:100%">
                                        <option value="">Kategori</option>
                                        <option value="S0001">Kebidanan & Kandungan</option>
                                        <option value="S0003">Anak</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <select name="dokter" id="dokter" class="form-select form-select-sm" style="width:100%"
                                        disabled>
                                        <option value="">Semua Dokter</option>
                                        <option value="1.101.1112">dr. Himawan Budityastomo, Sp.OG</option>
                                        <option value="1.109.1119">dr. Siti Pattihatun Nasyiroh, Sp.OG</option>
                                        <option value="1.107.0317">dr. Dwi Riyanto, Sp.A</option>
                                        <option value="1.111.1221">dr. Rendy Yoga Ardian, Sp.A</option>
                                    </select>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="mb-3 row">
                                        <label for="cari-kamar" class="col-sm-3 col-form-label">Cari Kamar : </label>
                                        <div class="col-sm-9">
                                            <input type="search" id="cari-kamar" name="cari-kamar"
                                                class="form-control form-control-sm" width="100%">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="kd_dokter" value="" name="kd_dokter">
            @else
                <input type="hidden" id="kd_dokter" value="{{ session()->get('pegawai')->nik }}" name="kd_dokter">
            @endif

        </div>
        @include('content.ranap.modal.modal_lab')
        @include('content.ranap.modal.modal_soap')
        @include('content.ranap.modal.modal_penunjang')
        @include('content.ranap.modal.modal_asmed_anak')
    @endsection
    @push('script')
        <script>
            var stts_pulang = '-';
            var tgl_awal = '';
            var tgl_akhir = '';
            var kamar = '';
            var kd_dokter = $('#kd_dokter').val();
            $(document).ready(function() {
                date = new Date()
                hari = ('0' + (date.getDate())).slice(-2);
                bulan = ('0' + (date.getMonth() + 1)).slice(-2);
                tahun = date.getFullYear();
                dateStart = hari + '-' + bulan + '-' + tahun;
                $('.tanggal').datepicker({
                    format: 'dd-mm-yyyy',
                    orientation: 'bottom',
                    autoclose: true,
                });
                kd_dokter = $('#kd_dokter').val();
                $('.tanggal').datepicker('setDate', dateStart)
                tb_ranap();
            });

            $('#cari-kamar').on('search', function() {
                if ($(this).val() == '') {
                    kamar = '';
                    $('#tb_ranap').DataTable().destroy();
                    tb_ranap();
                })

            $('#dokter').on('change', function() {
                kd_dokter = $(this).val();
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            })

            $('#pulang').on('click', function() {
                stts_pulang = 'Pulang';
                if ($('#pulang').is(':checked')) {
                    $('.tgl_pulang').prop('disabled', false)
                    $('.tgl_masuk').prop('disabled', true)
                } else {
                    $('.tgl_pulang').prop('disabled', true)
                    $('.tgl_masuk').prop('disabled', false)
                }
            }) $('#masuk').on('click', function() {
                stts_pulang = 'Masuk';
                if ($('#masuk').is(':checked')) {
                    $('.tgl_pulang').prop('disabled', true)
                    $('.tgl_masuk').prop('disabled', false)
                } else {
                    $('.tgl_pulang').prop('disabled', false)
                    $('.tgl_masuk').prop('disabled', true)
                }
            })


            $('#belum').on('click', function() {
                stts_pulang = '-';
                $('.tgl_pulang').prop('disabled', true)
                $('.tgl_masuk').prop('disabled', true)
            });

            $('#cari').on('click', function() {
                let a = '';
                let b = '';
                if (stts_pulang == 'Pulang') {
                    a = $('#tgl_pulang_awal').val();
                    b = $('#tgl_pulang_akhir').val();
                } else if (stts_pulang == 'Masuk') {
                    a = $('#tgl_masuk_awal').val();
                    b = $('#tgl_masuk_akhir').val();
                }

                tgl_awal = splitTanggal(a)
                tgl_akhir = splitTanggal(b)

                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            });

            function getAsmedRanapAnak(noRawat) {
                const asmed = $.ajax({
                    url: '/erm/asmed/ranap/anak/' + noRawat,
                    dataType: 'JSON',
                    method: 'GET',
                })

                return asmed;
            }

            function asmedRanapAnak(noRawat) {
                $.ajax({
                    url: '/erm/registrasi/ambil',
                    data: {
                        no_rawat: textRawat(noRawat, '/'),
                    },
                }).done((response) => {
                    $('#anak_no_rawat').val(response.no_rawat);
                    $('#anak_pasien').val(response.pasien.nm_pasien + ' (' + response.pasien.jk + ')');
                    $('#anak_tgl_lahir').val(formatTanggal(response.pasien.tgl_lahir) + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                    $('#anak_kd_dokter').val(response.kd_dokter);
                    $('#anak_dokter').val(response.dokter.nm_dokter);
                });
                getAsmedRanapAnak(textRawat(noRawat, '-')).done((response) => {
                    if (Object.keys(response).length > 0) {
                        $('#anak_anamnesis').val(response.anamnesis).change();
                        $('#anak_hubungan').val(response.hubungan);
                        $('#anak_keluhan_utama').val(response.keluhan_utama);
                        $('#anak_rps').val(response.rps);
                        $('#anak_rpd').val(response.rpd);
                        $('#anak_rpk').val(response.rpk);
                        $('#anak_rpo').val(response.rpo);
                        $('#anak_alergi').val(response.alergi);
                        $('#anak_keadaan').val(response.keadaan).change();
                        $('#anak_gcs').val(response.gcs);
                        $('#anak_kesadaran').val(response.kesadaran).change();
                        $('#anak_td').val(response.td);
                        $('#anak_nadi').val(response.nadi);
                        $('#anak_rr').val(response.rr);
                        $('#anak_suhu').val(response.suhu);
                        $('#anak_spo').val(response.spo);
                        $('#anak_bb').val(response.bb);
                        $('#anak_tb').val(response.tb);
                        $('#anak_kepala').val(response.kepala).change();
                        $('#anak_mata').val(response.mata).change();
                        $('#anak_gigi').val(response.gigi).change();
                        $('#anak_tht').val(response.tht).change();
                        $('#anak_mulut').val(response.mulut).change();
                        $('#anak_jantung').val(response.jantung).change();
                        $('#anak_paru').val(response.paru).change();
                        $('#anak_abdomen').val(response.abdomen).change();
                        $('#anak_genital').val(response.genital).change();
                        $('#anak_ekstremitas').val(response.ekstremitas).change();
                        $('#anak_kulit').val(response.kulit).change();
                        $('#anak_ket_fisik').val(response.ket_fisik);
                        $('#anak_ket_lokalis').val(response.ket_lokalis);
                        $('#anak_lab').val(response.lab);
                        $('#anak_rad').val(response.rad);
                        $('#anak_penunjang').val(response.penunjang);
                        $('#anak_diagnosis').val(response.diagnosis);
                        $('#anak_tata').val(response.tata);
                        $('#anak_edukasi').val(response.edukasi);
                    }

                })
                $('#modalAsmedRanapAnak').modal('show')
            }

            function tb_ranap() {

                var tb_ranap = $('#tb_ranap').DataTable({
                        processing: true,
                        scrollX: false,
                        serverSide: true,
                        stateSave: true,
                        ordering: false,
                        paging: false,
                        info: false,
                        ajax: {
                            url: "/erm/ranap/pasien",
                            data: {
                                'stts_pulang': stts_pulang,
                                'tgl_pertama': tgl_awal,
                                'tgl_kedua': tgl_akhir,
                                'kd_dokter': kd_dokter,
                                'kamar': kamar,
                            },
                        },
                        initComplete: function() {
                            Swal.fire({
                                title: 'Menampilkan data rawat inap',
                                position: 'top-end',
                                toast: true,
                                icon: 'success',
                                timerProgressBar: true,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        columns: [{
                                data: 'reg_periksa',
                                render: function(data) {

                                    list = '<li><a class="dropdown-item" href="#" onclick="modalLabRanap(\'' + data.no_rawat + '\')">Laborat</a></li>';
                                    list += '<li><a class="dropdown-item" href="#" onclick="modalSoapRanap(\'' + data.no_rawat + '\')">S.O.A.P</a></li>';
                                    list += '<li><a class="dropdown-item" href="#" onclick="modalPenunjangRanap(\'' + data.no_rawat + '\')">Pemeriksaan Penunjang</a></li>';
                                    list += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak(\'' + data.no_rawat + '\')">Asesmen Medis Kandungan</a></li>';
                                    list += '<li><a class="dropdown-item" href="#">EWS</a></li>';
                                    button =
                                        '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' +
                                        list + '</ul></div>'
                                    return button;
                                }
                            },
                            {
                                data: 'reg_periksa',
                                render: function(data) {
                                    if (data.pasien) {
                                        pasien = data.pasien.nm_pasien;
                                    } else {
                                        pasien = data.no_rkm_medis.replace(/\s/g, '');
                                        $.ajax({
                                            url: 'pasien/cari',
                                            data: {
                                                'q': pasien,
                                            },
                                            success: function(response) {
                                                $.map(response, function(data) {
                                                    $('#pasien').text(data.nm_pasien);
                                                })
                                            }
                                        })
                                    }
                                    return data.no_rawat + '<br/><strong>' + '<span id="pasien">' + pasien +
                                        '</span></strong><br/> (' + data.no_rkm_medis +
                                        ')';
                                },
                                name: 'reg_periksa',
                            },
                            {
                                data: 'kamar',
                                render: function(data) {
                                    return data.bangsal.nm_bangsal;
                                },
                                name: 'kamar',
                            },
                            {
                                data: 'lama',
                                render: function(data) {
                                    return data + ' Hari';
                                },
                                name: 'lama',
                            },
                            {
                                data: 'reg_periksa',
                                render: function(data) {
                                    let dokter = '';
                                    if (data.dokter) {
                                        dokter = data.dokter.nm_dokter;
                                    } else {
                                        kd_dokter = data.kd_dokter.replace(/\s/g, '');
                                        $.ajax({
                                            url: 'dokter/ambil',
                                            dataType: 'JSON',
                                            data: {
                                                'nik': kd_dokter,
                                            },
                                            success: function(response) {
                                                $.map(response.data, function(res) {
                                                    $('.nm_dokter').text(res.nm_dokter);
                                                })
                                            }
                                        });
                                    }
                                    return '<span class="nm_dokter">' + dokter + '</span>';
                                },
                                name: 'dokter'
                            },
                            {
                                data: 'diagnosa_awal',
                                name: 'diagnosa'
                            },


                        ],
                        "language": {
                            "zeroRecords": "Tidak ada data pasien terdaftar",
                            "infoEmpty": "Tidak ada data pasien terdaftar",
                            "search": "Cari Nama Pasien",
                        }
                    }) ===
                    ===
                    = >>>
                    >>>
                    > 36 cdc305e037c0aa08e65fc486704a4d55370cfd
            }
            });

            $('#spesialis').on('change', function() {
                sps = $('#spesialis option:selected').val();
                if (sps) {
                    $.ajax({
                        url: 'dokter/ambil',
                        data: {
                            'sps': sps,
                        },
                        success: function(response) {
                            let option =
                                '<option value="" disabled selected>Pilih Dokter Spesialis</option>';
                            response.data.forEach(function(res) {
                                $('#dokter').prop('disabled', false)
                                $('#dokter').empty();

                                option += '<option value="' + res.kd_dokter + '">' + res.nm_dokter +
                                    '</option>';
                            })
                            $('#dokter').append(option);
                        }
                    })
                } else {
                    $('#dokter').prop('disabled', true)
                    $('#dokter').empty();
                    option = '<option value="">Semua Dokter</option>'
                    $('#dokter').append(option);
                    kd_dokter = '';
                    $('#tb_ranap').DataTable().destroy();
                    tb_ranap();

                }
            })

            $("#cari-kamar").bind('keypress', function(e) {
                // console.log($(this).val())
            })

            $('#cari-kamar').on('keyup', function() {
                kamar = $(this).val();
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            })

            $('#dokter').on('change', function() {
                kd_dokter = $(this).val();
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            })

            $('#pulang').on('click', function() {
                stts_pulang = 'Pulang';
                if ($('#pulang').is(':checked')) {
                    $('.tgl_pulang').prop('disabled', false)
                    $('.tgl_masuk').prop('disabled', true)
                } else {
                    $('.tgl_pulang').prop('disabled', true)
                    $('.tgl_masuk').prop('disabled', false)
                }
            })
            $('#masuk').on('click', function() {
                stts_pulang = 'Masuk';
                if ($('#masuk').is(':checked')) {
                    $('.tgl_pulang').prop('disabled', true)
                    $('.tgl_masuk').prop('disabled', false)
                } else {
                    $('.tgl_pulang').prop('disabled', false)
                    $('.tgl_masuk').prop('disabled', true)
                }
            })


            $('#belum').on('click', function() {
                stts_pulang = '-';
                $('.tgl_pulang').prop('disabled', true)
                $('.tgl_masuk').prop('disabled', true)
            });

            $('#cari').on('click', function() {
                let a = '';
                let b = '';
                if (stts_pulang == 'Pulang') {
                    a = $('#tgl_pulang_awal').val();
                    b = $('#tgl_pulang_akhir').val();
                } else if (stts_pulang == 'Masuk') {
                    a = $('#tgl_masuk_awal').val();
                    b = $('#tgl_masuk_akhir').val();
                }

                tgl_awal = splitTanggal(a)
                tgl_akhir = splitTanggal(b)

                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            })

            function tb_ranap() {

                var tb_ranap = $('#tb_ranap').DataTable({
                    processing: true,
                    scrollX: false,
                    serverSide: true,
                    stateSave: true,
                    ordering: false,
                    paging: false,
                    info: false,
                    ajax: {
                        url: "/erm/ranap/pasien",
                        data: {
                            'stts_pulang': stts_pulang,
                            'tgl_pertama': tgl_awal,
                            'tgl_kedua': tgl_akhir,
                            'kd_dokter': kd_dokter,
                            'kamar': kamar,
                        },
                    },
                    initComplete: function() {
                        Swal.fire({
                            title: 'Menampilkan data rawat inap',
                            position: 'top-end',
                            toast: true,
                            icon: 'success',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    },
                    columns: [{
                            data: 'reg_periksa',
                            render: function(data) {

                                list = '<li><a class="dropdown-item" href="#" onclick="modalLabRanap(\'' + data
                                    .no_rawat + '\')">Laborat</a></li>';
                                list += '<li><a class="dropdown-item" href="#" onclick="modalSoapRanap(\'' +
                                    data.no_rawat + '\')">S.O.A.P</a></li>';
                                list +=
                                    '<li><a class="dropdown-item" href="#" onclick="modalPenunjangRanap(\'' +
                                    data.no_rawat + '\')">Pemeriksaan Penunjang</a></li>';
                                list +=
                                    '<li><a class="dropdown-item" href="javasript:void(0)" onclick="asmedRanapKandungan(\'' +
                                    data.no_rawat + '\')">Asesmen Medis Kandungan</a></li>';
                                list += '<li><a class="dropdown-item" href="#">EWS</a></li>';
                                button =
                                    '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' +
                                    list + '</ul></div>'
                                return button;
                            }
                        },
                        {
                            data: 'reg_periksa',
                            render: function(data) {
                                if (data.pasien) {
                                    pasien = data.pasien.nm_pasien;
                                } else {
                                    pasien = data.no_rkm_medis.replace(/\s/g, '');
                                    $.ajax({
                                        url: 'pasien/cari',
                                        data: {
                                            'q': pasien,
                                        },
                                        success: function(response) {
                                            $.map(response, function(data) {
                                                $('#pasien').text(data.nm_pasien);
                                            })
                                        }
                                    })
                                }
                                return data.no_rawat + '<br/><strong>' + '<span id="pasien">' + pasien +
                                    '</span></strong><br/> (' + data.no_rkm_medis +
                                    ')';
                            },
                            name: 'reg_periksa',
                        },
                        {
                            data: 'kamar',
                            render: function(data) {
                                return data.bangsal.nm_bangsal;
                            },
                            name: 'kamar',
                        },
                        {
                            data: 'lama',
                            render: function(data) {
                                return data + ' Hari';
                            },
                            name: 'lama',
                        },
                        {
                            data: 'reg_periksa',
                            render: function(data) {
                                let dokter = '';
                                if (data.dokter) {
                                    dokter = data.dokter.nm_dokter;
                                } else {
                                    kd_dokter = data.kd_dokter.replace(/\s/g, '');
                                    $.ajax({
                                        url: 'dokter/ambil',
                                        dataType: 'JSON',
                                        data: {
                                            'nik': kd_dokter,
                                        },
                                        success: function(response) {
                                            $.map(response.data, function(res) {
                                                $('.nm_dokter').text(res.nm_dokter);
                                            })
                                        }
                                    });
                                }
                                return '<span class="nm_dokter">' + dokter + '</span>';
                            },
                            name: 'dokter'
                        },
                        {
                            data: 'diagnosa_awal',
                            name: 'diagnosa'
                        },
                    ],
                    "language": {
                        "zeroRecords": "Tidak ada data pasien terdaftar",
                        "infoEmpty": "Tidak ada data pasien terdaftar",
                        "search": "Cari Nama Pasien",
                    }
                })
            }


            var ctx = document.getElementById('grafik-suhu').getContext('2d');
            var grafikPemeriksaan;

            $("#modalSoapRanap").on('hide.bs.modal', function() {
                grafikPemeriksaan.destroy();
                grafikPemeriksaan = null;
            });

            function buildGrafik(no_rawat) {
                $.ajax({
                    url: 'soap/chart',
                    data: {
                        'no_rawat': no_rawat
                    },
                    success: function(response) {
                        grafikPemeriksaan = new Chart(ctx, {
                            type: 'line',
                            plugins: [ChartDataLabels],
                            data: {
                                labels: response.map(function(e) {
                                    return e.tgl_perawatan + ' ' + e.jam_rawat;
                                }),
                                datasets: [{
                                    label: 'Suhu Tubuh',
                                    data: response.map(function(e) {
                                        if (e.suhu_tubuh.includes(',')) {
                                            e.suhu_tubuh = e.suhu_tubuh.replace(',', '.');
                                        }
                                        return parseFloat(e.suhu_tubuh);
                                    }),
                                    backgroundColor: 'rgba(255, 99, 132, 1)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    pointBackgroundColor: '#fff',
                                    hoverRadius: 10,
                                    borderWidth: 3,
                                    lineTension: 0,
                                    radius: 5,
                                    datalabels: {
                                        align: 'top',
                                        anchor: 'end',
                                    }
                                }, {
                                    label: 'Nadi',
                                    data: response.map(function(e) {
                                        return e.nadi;
                                    }),
                                    backgroundColor: 'rgba(54, 162, 235, 1)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    pointBackgroundColor: '#fff',
                                    hoverRadius: 10,
                                    borderWidth: 3,
                                    lineTension: 0,
                                    radius: 5,
                                    datalabels: {
                                        align: 'bottom',
                                        anchor: 'start',
                                    }
                                }],
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 100
                                        },
                                    }
                                },
                                plugins: {
                                    datalabels: {
                                        backgroundColor: function(context) {
                                            return context.dataset.backgroundColor;
                                        },
                                        borderRadius: 4,
                                        color: 'white',
                                        font: {
                                            weight: 'bold'
                                        },
                                        formatter: Math.round,
                                        padding: 6
                                    }
                                },
                            }
                        });
                    }
                });
            }

            function modalSoapRanap(no_rawat) {
                $('#modalSoapRanap').modal('toggle', {
                    backdrop: 'true'
                });

                $.ajax({
                    url: 'periksa/detail',
                    data: {
                        'no_rawat': no_rawat,
                    },
                    success: function(response) {
                        console.log(response)
                        $('#nomor_rawat').val(response.no_rawat);
                        $('#nm_pasien').val(response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                        $('#nik').val(response.kd_dokter);
                        $('#nama').val(response.dokter.nm_dokter);
                        $('.btn-tambah-grafik-harin').attr('data-no-rawat', response.no_rawat);
                        $('.btn-tambah-grafik-harin').attr('data-nm-pasien', response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                    }
                });

                buildGrafik(no_rawat);
                tbSoapRanap(no_rawat);
            }

            $('#modalSoapRanap').on('hidden.bs.modal', function() {
                $('#tbSoap').DataTable().destroy();
                $('#ubah_soap').empty();
                $('#suhu').val("-");
                $('#tinggi').val("-");
                $('#berat').val("-");
                $('#tensi').val("-");
                $('#respirasi').val("-");
                $('#nadi').val("-");
                $('#spo2').val("-");
                $('#gcs').val("-");
                $('#alergi').val("-");
                $('#asesmen').val("-");
                $('#plan').val("-");
                $('#instruksi').val("-");
                $('#evaluasi').val("-");
                $('#subjek').val("-");
                $('#objek').val("-");
                $('#btn-reset').remove();
                $('#btn-ubah').remove();
            });


            // modal tambah grafik harian
            function modalGrafikHarian() {
                $('#modalGrafikHarian').modal('toggle');
                var no_rawat = $(".btn-tambah-grafik-harin").data('no-rawat');
                var nm_pasien = $(".btn-tambah-grafik-harin").data('nm-pasien');

                // set data to modal
                $('#formSaveGrafikHarian input[name="no_rawat"]').val(no_rawat);
                $('#formSaveGrafikHarian input[name="nm_pasien"]').val(nm_pasien);
            }

            // form tambah grafik harian submit
            $('#formSaveGrafikHarian').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'grafik/store',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'no_rawat': $('#formSaveGrafikHarian input[name="no_rawat"]').val(),
                        'suhu_tubuh': $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val(),
                        'tensi': $('#formSaveGrafikHarian input[name="tensi"]').val(),
                        'nadi': $('#formSaveGrafikHarian input[name="nadi"]').val(),
                        'respirasi': $('#formSaveGrafikHarian input[name="respirasi"]').val(),
                        'spo2': $('#formSaveGrafikHarian input[name="spo2"]').val(),
                        'o2': $('#formSaveGrafikHarian input[name="o2"]').val(),
                        'gcs': $('#formSaveGrafikHarian input[name="gcs"]').val(),
                        'kesadaran': $('#formSaveGrafikHarian select[name="kesadaran"]').val(),
                    },
                    type: 'POST',
                    beforeSend: function() {
                        swal.fire({
                            title: 'Sedang mengirim data',
                            text: 'Mohon Tunggu',
                            showConfirmButton: false,
                            didOpen: () => {
                                swal.showLoading();
                            }
                        })
                    },
                    success: function(response) {
                        if (response.success) {
                            swal.close();

                            $('#modalGrafikHarian').modal('toggle');
                            grafikPemeriksaan.destroy();
                            buildGrafik(response.no_rawat);

                            swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            console.log(response);
                        }

                    },
                    error: function(request, status, error) {
                        console.log(request.responseText);
                    }
                })
            });
        </script>
    @endpush
