@extends('index')
@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="" id="formFilterRanap">
                        <div class="form-group mb-2">
                            {{-- @if (session()->get('pegawai')->petugas->kd_jbtn != 'J001' && session()->get('pegawai')->petugas->kd_jbtn != 'J024') --}}
                            <div class="row gy-2">
                                <div class="col-lg-2 col-md-12 col-sm-12">
                                    <div class="input-group">
                                        <div class="row gy-2">
                                            <div class="col col-sm-12">
                                                <div class="form-radio form-radio-inline mt-2">
                                                    <input class="form-radio-input" type="radio" id="belum" name="stts_pulang"
                                                        value="Belum Pulang">
                                                    <label class="form-radio-label" for="belum" style="font-size:12px">Belum
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
                                                    <label class="form-radio-label" for="pulang" style="font-size:12px">Pulang</label>
                                                </div>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                    id="tgl_pulang_awal" name="tgl_pulang_awal" autocomplete="off"
                                                    disabled>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_pulang"
                                                    id="tgl_pulang_akhir" name="tgl_pulang_akhir" autocomplete="off"
                                                    disabled>
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
                                                    <label class="form-radio-label" for="masuk" style="font-size:12px">Masuk</label>
                                                </div>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 0px;padding-right: 4px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                    id="tgl_masuk_awal" name="tgl_masuk_awal" autocomplete="off"
                                                    disabled>
                                            </div>
                                            <div class="col col-sm-4" style="padding-left: 4px;padding-right: 0px;">
                                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                                    id="tgl_masuk_akhir" name="tgl_masuk_akhir" autocomplete="off"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-12 col-sm-12">
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-success btn-sm"
                                            id="cari">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {{-- @else --}}
                            {{-- <input type="hidden" id="kd_dokter" value="{{ session()->get('pegawai')->nik }}" name="kd_dokter">
                            <input type="hidden" id="kd_sps" name="kd_sps" value="{{ session()->get('pegawai')->dokter->kd_sps }}"> --}}
                            {{-- @endif --}}
                        </div>
                        <div class="form-group">
                            <div class="row gy-2">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    <select style="font-size:12px" name="spesialis" id="spesialis" class="form-select form-select-sm"
                                        style="width:100%">
                                        <option value="">Semua Spesialis</option>
                                        <option value="S0001">Spesialis Kebidanan & Kandungan</option>
                                        <option value="S0003">Spesialis Anak</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <select style="font-size:12px" name="dokter" id="dokter" class="form-select form-select-sm" style="width:100%"
                                        disabled>
                                        <option value="">Semua Dokter</option>
                                        <option value="1.101.1112" class="S0003">dr. Himawan Budityastomo, Sp.OG</option>
                                        <option value="1.109.1119" class="S0003">dr. Siti Pattihatun Nasyiroh, Sp.OG</option>
                                        <option value="1.107.0317" class="S0001">dr. Dwi Riyanto, Sp.A</option>
                                        <option value="1.111.1221" class="S0001">dr. Rendy Yoga Ardian, Sp.A</option>
                                    </select>
                                </div>
                                <div class="col-lg-5 col-md-12 col-sm-12">
                                    <div class="row">
                                        <label for="cari-kamar" class="col-sm-3 col-form-label" style="font-size:12px">Cari Kamar : </label>
                                        <div class="col-sm-9">
                                            <input type="search" id="cari-kamar" name="cari-kamar" class="form-control form-control-sm" width="100%" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- <input type="hidden" id="kd_dokter" value="" name="kd_dokter">
            <input type="hidden" id="kd_sps" value="" name="kd_sps"> --}}
            {{-- <input type="hidden" id="kd_dokter" value="{{ session()->get('pegawai')->nik }}" name="kd_dokter">
            <input type="hidden" id="kd_sps" name="kd_sps" value="{{ session()->get('pegawai')->dokter->kd_sps }}"> --}}
            {{-- @endif --}}
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_ranap" width="100%">
                        <thead>
                            <tr role="row">
                                <th width="100px"></th>
                                <th width="25%">No.Rawat</th>
                                <th>Kamar</th>
                                <th>Lama</th>
                                <th>Dokter</th>
                                <th>Diagnosa Awal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_lab')
    @include('content.ranap.modal.modal_soap')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.ranap.modal.modal_asmed_anak')
    @include('content.ranap.modal.modal_asmed_kandungan')
    @include('content.ranap.modal.modal_grafik_harian')
    {{-- @include('content.ranap.modal.modal_ews') --}}
@endsection


@push('script')
    <script>
        var stts_pulang = '-';
        var tgl_awal = '';
        var tgl_akhir = '';
        var kamar = localStorage.getItem('kamar');
        var sps = localStorage.getItem('spesialis') ? localStorage.getItem('spesialis') : '';
        var valScrollX = '';
        var cekDepartement = `{{ session()->get('pegawai')->departemen }}`
        var kd_dokter = localStorage.getItem('dokter') ? localStorage.getItem('dokter') : $('#kd_dokter').val();
        var getSpsId = $('#kd_sps').val();



        $(document).ready(function() {

            if (cekDepartement == 'DM3' || cekDepartement == 'DM8') {
                if (cekDepartement == 'DM3') {
                    sps = 'S0001';
                } else if (cekDepartement == 'DM8') {
                    sps = 'S0003';
                }
                $('#formFilterRanap select[name=spesialis]').val(sps);
                $('#formFilterRanap select[name=spesialis]').prop('disabled', true);
                $('#formFilterRanap select[name=dokter]').prop('disabled', false);
                $('#formFilterRanap select[name=dokter] .' + sps).css('display', 'none');
                if (kd_dokter) {
                    $('#formFilterRanap select[name=dokter]').prop('disabled', false);
                    $('#formFilterRanap select[name=dokter]').val(kd_dokter);
                }
            } else {
                if (sps) {
                    $('#formFilterRanap select[name=spesialis]').val(sps);
                    $('#formFilterRanap select[name=spesialis]').prop('disabled', false);
                    $('#formFilterRanap select[name=dokter] .' + sps).css('display', 'none');
                }
                if (kd_dokter) {
                    $('#formFilterRanap select[name=dokter]').prop('disabled', false);
                    $('#formFilterRanap select[name=dokter]').val(kd_dokter);
                } else {
                    $('#formFilterRanap select[name=dokter]').prop('disabled', true);
                    $('#formFilterRanap select[name=dokter] option').css('display', 'inline');
                }
            }


            if (getSpsId == 'S0005') {
                sps = `S0001`
                kd_dokter = '';
            }

            if (getSpsId == 'S0005' || getSpsId == 'S0003' || getSpsId == 'S0001') {
                valScrollX = 425;
                $('#formFilterRanap select[name=dokter]').prop('disabled', true);
                $('#formFilterRanap select[name=spesialis]').prop('disabled', true);
                $('#formFilterRanap select[name=dokter]').val(kd_dokter);
                $('#formFilterRanap select[name=spesialis]').val(getSpsId);
            } else {
                valScrollX = 325;
            }

            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                defaultDate: null
            });

            $('#cari-kamar').val(kamar)
            $('.tanggal').datepicker('setDate', dateStart)
            tb_ranap();
        });

        $('#cari-kamar').on('search', function() {
            if ($(this).val() == '') {
                kamar = '';
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
                localStorage.removeItem('kamar')
            }
        })

        $('#spesialis').on('change', function() {
            sps = $('#spesialis option:selected').val();
            localStorage.setItem('spesialis', sps);
            if (sps) {
                $.ajax({
                    url: 'dokter/ambil',
                    data: {
                        'sps': sps,
                    },
                    success: function(response) {
                        let option = `<option value="" disabled selected>Pilih Dokter Spesialis</option>`;
                        response.data.forEach(function(res) {
                            $('#dokter').prop('disabled', false)
                            $('#dokter').empty();
                            option += `<option value="${res.kd_dokter}">${res.nm_dokter}</option>`;
                        })
                        $('#dokter').append(option);
                    }
                })
            } else {
                $('#dokter').prop('disabled', true)
                $('#dokter').empty();
                option = '<option value="">Semua Dokter</option>'
                $('#dokter').append(option);
                localStorage.removeItem('dokter')
                kd_dokter = '';

            }
            $('#tb_ranap').DataTable().destroy();
            tb_ranap();
        })

        $("#cari-kamar").bind('keypress', function(e) {
            // console.log($(this).val())
        })

        $('#cari-kamar').on('keyup', function() {
            kamar = $(this).val();
            if (kamar.length >= 5) {
                localStorage.setItem('kamar', kamar);
                $('#tb_ranap').DataTable().destroy();
                tb_ranap();
            }

            if (kamar.length == 0) {
                localStorage.removeItem('kamar');
            }
        })

        $('#dokter').on('change', function() {
            kd_dokter = $(this).val();
            localStorage.setItem('dokter', kd_dokter)
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

            $('#tb_ranap').DataTable({
                processing: true,
                scrollX: true,
                scrollY: valScrollX,
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
                        'spesialis': sps,

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
                    });
                },
                columns: [{
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            list = '<li><a class="dropdown-item" href="#" onclick="modalLaborat(\'' + data.no_rawat + '\')">Laborat</a></li>';
                            list += '<li><a class="dropdown-item" href="#" onclick="modalSoapRanap(\'' + data.no_rawat + '\')">S.O.A.P</a></li>';
                            list += `<li><a class="dropdown-item" href="#" onclick="detailPeriksa('${data.no_rawat}', 'Ranap')">Berkas Penunjang</a></li>`;

                            if (row.reg_periksa.dokter.kd_sps == 'S0003') {
                                list += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak(\'' + data.no_rawat + '\')">Asesmen Medis Anak</a></li>';
                            } else if (row.reg_periksa.dokter.kd_sps == 'S0001') {
                                list += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapKandungan(\'' + data.no_rawat + '\')">Asesmen Medis Kandungan</a></li>';
                            }
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${data.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.no_rkm_medis}">Riwayat</a></li>`;

                            button = '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' + list + '</ul></div>'
                            return button;
                        }
                    },
                    {
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            if (data.pasien) {
                                pasien = data.pasien.nm_pasien + ' (' + data.umurdaftar + ' ' + data.sttsumur + ')';
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
                            if (data.penjab.kd_pj == 'A03') {
                                penjab = '<span class="text-danger"><b>' + data.penjab.png_jawab + '</b></span>'
                            } else {
                                penjab = '<span class="text-success"><b>' + data.penjab.png_jawab + '</b></span>'
                            }

                            bayiGabung = '';
                            if (row.ranap_gabung) {
                                namaBayi = `<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">${row.ranap_gabung.reg_periksa.pasien.nm_pasien}</a>
                                <ul class="dropdown-menu dropdown-menu" style="font-size:12px">
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalLaborat('${row.ranap_gabung.reg_periksa.no_rawat}')">Laborat</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalSoapRanap('${row.ranap_gabung.reg_periksa.no_rawat}')">S.O.A.P</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPenunjangRanap('${row.ranap_gabung.reg_periksa.no_rawat}')">Pemeriksaan Penunjang</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${row.ranap_gabung.reg_periksa.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.ranap_gabung.reg_periksa.no_rkm_medis}">Riwayat</a></li>
                                </ul>`
                                bayiGabung = `<hr style="margin:0px"/>${row.ranap_gabung.reg_periksa.no_rawat} <br/> <strong>${namaBayi}</strong>  `

                            }

                            return data.no_rawat + '<br/><strong>' + '<span id="pasien">' + pasien + '</span></strong><br/>' + penjab + bayiGabung;

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
                        render: function(data, type, row) {
                            let lama = 0;
                            $.map(row.reg_periksa.kamar_inap, (kamar) => {
                                lama += kamar.lama
                            })
                            return lama + ' Hari';
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




        function getTTVData(params) {
            let ttv = $.ajax({
                url: '/erm/soap/chart',
                data: {
                    'no_rawat': params,
                },
                dataType: 'JSON',
            })
            return ttv;
        }

        function getAsmedRanapAnak(noRawat) {
            const asmed = $.ajax({
                url: '/erm/asmed/ranap/anak/' + textRawat(noRawat, '-'),
                dataType: 'JSON',
                method: 'GET',
            })

            return asmed;
        }

        function getAsmedRanapKandungan(noRawat) {
            const asmedKebidanan = $.ajax({
                url: '/erm/asmed/ranap/kandungan/' + textRawat(noRawat, '-'),
                dataType: 'JSON',
                method: 'GET',
            });

            return asmedKebidanan;
        }

        function asmedRanapKandungan(noRawat) {
            $('#kandungan_kd_dokter').val(`session()->get('pegawai')->nik`);
            $('#kandungan_dokter').val(`session()->get('pegawai')->nama`);
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: noRawat,
                },
            }).done((response) => {
                $('#kandungan_no_rawat').val(response.no_rawat);
                $('#kandungan_pasien').val(response.pasien.nm_pasien + ' (' + response.pasien.jk + ')');
                $('#kandungan_tgl_lahir').val(formatTanggal(response.pasien.tgl_lahir) + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');

            });

            getAsmedRanapKandungan(noRawat).done((response) => {

                if (Object.keys(response).length > 0) {
                    $('.btn-asmed-kandungan').css('display', 'none')
                    $('.btn-asmed-kandungan-ubah').css('display', 'inline')
                    if (response.kd_dokter != `{{ session()->get('pegawai')->nik }}`) {
                        $('#formAsmedKandunganRanap input').attr('readonly', true)
                        $('#formAsmedKandunganRanap select').attr('disabled', true)
                        $('#formAsmedKandunganRanap textarea').attr('readonly', true)
                        $('.btn-asmed-kandungan-ubah').css('display', 'none')
                        $('.btn-asmed-kandungan').css('display', 'none')
                    }
                    $('#kandungan_kd_dokter').val(response.kd_dokter);
                    $('#kandungan_dokter').val(response.dokter.nm_dokter);
                    $('#kandungan_anamnesis').val(response.anamnesis).change();
                    $('#kandungan_hubungan').val(response.hubungan);
                    $('#kandungan_keluhan_utama').val(response.keluhan_utama);
                    $('#kandungan_rps').val(response.rps);
                    $('#kandungan_rpd').val(response.rpd);
                    $('#kandungan_rpk').val(response.rpk);
                    $('#kandungan_rpo').val(response.rpo);
                    $('#kandungan_alergi').val(response.alergi);
                    $('#kandungan_keadaan').val(response.keadaan).change();
                    $('#kandungan_gcs').val(response.gcs);
                    $('#kandungan_kesadaran').val(response.kesadaran).change();
                    $('#kandungan_td').val(response.td);
                    $('#kandungan_nadi').val(response.nadi);
                    $('#kandungan_rr').val(response.rr);
                    $('#kandungan_suhu').val(response.suhu);
                    $('#kandungan_spo').val(response.spo);
                    $('#kandungan_bb').val(response.bb);
                    $('#kandungan_tb').val(response.tb);
                    $('#kandungan_kepala').val(response.kepala).change();
                    $('#kandungan_mata').val(response.mata).change();
                    $('#kandungan_gigi').val(response.gigi).change();
                    $('#kandungan_tht').val(response.tht).change();
                    $('#kandungan_mulut').val(response.mulut).change();
                    $('#kandungan_jantung').val(response.jantung).change();
                    $('#kandungan_paru').val(response.paru).change();
                    $('#kandungan_abdomen').val(response.abdomen).change();
                    $('#kandungan_genital').val(response.genital).change();
                    $('#kandungan_ekstremitas').val(response.ekstremitas).change();
                    $('#kandungan_kulit').val(response.kulit).change();
                    $('#kandungan_ket_fisik').val(response.ket_fisik);
                    $('#kandungan_tfu').val(response.tfu);
                    $('#kandungan_tbj').val(response.tbj);
                    $('#kandungan_djj').val(response.djj);
                    $('#kandungan_kontraksi').val(response.kontraksi).change();
                    $('#kandungan_his').val(response.his);
                    $('#kandungan_lab').val(response.lab);
                    $('#kandungan_vt').val(response.vt);
                    $('#kandungan_inspeksi').val(response.inspeksi);
                    $('#kandungan_ultra').val(response.ultra);
                    $('#kandungan_kardio').val(response.kardio);
                    $('#kandungan_inspekulo').val(response.inspekulo);
                    $('#kandungan_rt').val(response.rt);
                    $('#kandungan_rad').val(response.rad);
                    $('#kandungan_penunjang').val(response.penunjang);
                    $('#kandungan_diagnosis').val(response.diagnosis);
                    $('#kandungan_tata').val(response.tata);
                    $('#kandungan_edukasi').val(response.edukasi);
                } else {
                    $('#kandungan_kd_dokter').val("{{ session()->get('pegawai')->nik }}");
                    $('#kandungan_dokter').val("{{ session()->get('pegawai')->nama }}");
                    $('.btn-asmed-kandungan-ubah').css('display', 'none')
                    $('.btn-asmed-kandungan').css('display', 'inline')
                }
            })
            $('#modalAsmedRanapKandungan').modal('show')
        }

        function asmedRanapAnak(noRawat) {

            $('#anak_kd_dokter').val(`{{ session()->get('pegawai')->nik }}`);
            $('#anak_dokter').val(`{{ session()->get('pegawai')->nama }}`);
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: noRawat,
                },
            }).done((response) => {
                $('#anak_no_rawat').val(response.no_rawat);
                $('#anak_pasien').val(response.pasien.nm_pasien + ' (' + response.pasien.jk + ')');
                $('#anak_tgl_lahir').val(formatTanggal(response.pasien.tgl_lahir) + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#anak_dokter').attr('readonly', true)
                $('#anak_kd_dokter').attr('readonly', true)
            });
            getAsmedRanapAnak(textRawat(noRawat, '-')).done((response) => {
                console.log(response);
                if (Object.keys(response).length > 0) {
                    $('.btn-asmed-anak').css('display', 'none')
                    $('.btn-asmed-anak-ubah').css('display', 'inline')
                    if (response.kd_dokter != `{{ session()->get('pegawai')->nik }}`) {
                        $('#formAsmedAnakRanap input').attr('readonly', true)
                        $('#formAsmedAnakRanap select').attr('disabled', true)
                        $('#formAsmedAnakRanap textarea').attr('readonly', true)
                        $('.btn-asmed-anak-ubah').css('display', 'none')
                        $('.btn-asmed-anak').css('display', 'none')
                    }

                    $('#anak_kd_dokter').val(response.kd_dokter);
                    $('#anak_dokter').val(response.dokter.nm_dokter);
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
                } else {
                    $('.btn-asmed-anak-ubah').css('display', 'none')
                    $('.btn-asmed-anak').css('display', 'inline')
                }

            })
            $('#modalAsmedRanapAnak').modal('show')
        }

        var ctx = document.getElementById('grafik-suhu').getContext('2d');
        var grafikPemeriksaan;
        var tableGrafikHarian;

        $("#modalSoapRanap").on('hidden.bs.modal', function() {
            grafikPemeriksaan.destroy();
            grafikPemeriksaan = null;

            tableGrafikHarian.fnDestroy();
            tableGrafikHarian = null;
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
                        data: {
                            labels: response.map(function(e) {
                                return e.tgl_perawatan + ' ' + e.jam_rawat;
                            }),
                            datasets: [{
                                label: 'Suhu Tubuh',
                                yAxisID: 'yAxis1',
                                data: response.map(function(e) {
                                    if (e.suhu_tubuh.includes(',')) {
                                        e.suhu_tubuh = e.suhu_tubuh.replace(',', '.');
                                    }
                                    return parseFloat(e.suhu_tubuh);
                                }),
                                backgroundColor: 'rgba(54, 162, 235, 1)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                pointBackgroundColor: '#fff',
                                hoverRadius: 10,
                                borderWidth: 3,
                                lineTension: 0,
                                radius: 5,
                            }, {
                                label: 'Nadi',
                                yAxisID: 'yAxis2',
                                data: response.map(function(e) {
                                    return e.nadi;
                                }),
                                backgroundColor: 'rgba(255, 99, 132, 1)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                pointBackgroundColor: '#fff',
                                hoverRadius: 10,
                                borderWidth: 3,
                                lineTension: 0,
                                radius: 5,
                            }],
                        },
                        options: {
                            scales: {
                                yAxis1: {
                                    min: 35,
                                    max: 42,
                                    beginAtZero: true,
                                },
                                yAxis2: {
                                    beginAtZero: true,
                                    min: 40,
                                    max: 180,
                                }
                            }
                            // scales: {
                            //     y: [{
                            //             id: 'left-y-axis',
                            //             type: 'linear',
                            //             position: 'left',
                            //             display: false,
                            //             gridLines: {
                            //                 // display: false,
                            //                 color: 'rgba(219,219,219,0.3)',
                            //                 zeroLineColor: 'rgba(219,219,219,0.3)',
                            //                 drawBorder: false, // <---
                            //                 lineWidth: 27,
                            //                 // zeroLineWidth: 1
                            //             },

                            //             ticks: {
                            //                 // display: false,

                            //             },

                            //             min: 35,
                            //             max: 42,
                            //             beginAtZero: true,
                            //             grace: '20%',
                            //         },
                            //         {
                            //             id: 'right-y-axis',
                            //             type: 'linear',
                            //             position: 'right',
                            //             // display: false,
                            //             gridLines: {
                            //                 // display: false,
                            //                 color: 'rgba(219,219,219,0.3)',
                            //                 zeroLineColor: 'rgba(219,219,219,0.3)',
                            //                 drawBorder: false, // <---
                            //                 lineWidth: 27,
                            //                 // zeroLineWidth: 1
                            //             },

                            //             ticks: {
                            //                 // display: false,
                            //             },
                            //             beginAtZero: true,
                            //             min: 40,
                            //             max: 180,
                            //             grace: '10%',
                            //         },
                            //     ],
                            //     x: {
                            //         gridLines: {
                            //             display: false,
                            //         },
                            //     },
                            // },
                        }
                    });
                }
            });
        }


        function getPemeriksaanRanap(no_rawat) {
            let perawatan = $.ajax({
                url: '/erm/soap/get',
                data: {
                    'no_rawat': no_rawat,
                },
            })

            return perawatan;
        }

        function modalSoapRanap(no_rawat) {
            getRegPeriksa(no_rawat).done((response) => {
                $('#nomor_rawat').val(response.no_rawat);
                $('#nm_pasien').val(response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#nik').val("{{ session()->get('pegawai')->nik }}");
                $('#nama').val("{{ session()->get('pegawai')->nama }}");
                $('#formSoapRanap input[name=spesialis]').val(response.dokter.kd_sps);

                if (response.dokter.kd_sps == 'S0001') {
                    $('.formEws').removeAttr('style');
                    $('.formEws select[name=keluaran_urin]').val('-').change()
                    $('.formEws select[name=proteinuria]').val('-').change()
                    $('.formEws select[name=air_ketuban]').val('-').change()
                    $('.formEws select[name=skala_nyeri]').val('-').change()
                    $('.formEws select[name=lochia]').val('-').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('-').change()
                } else {
                    $('.formEws').css('display', 'none');
                    $('.formEws select[name=keluaran_urin]').val('').change()
                    $('.formEws select[name=proteinuria]').val('').change()
                    $('.formEws select[name=air_ketuban]').val('')
                    $('.formEws select[name=skala_nyeri]').val('')
                    $('.formEws select[name=lochia]').val('').change()
                    $('.formEws select[name=terlihat_tidak_sehat]').val('').change()
                }

                getDokter("{{ session()->get('pegawai')->nama }}").done((response) => {
                    if (response.length) {
                        $('.btn-tambah-grafik-harin').css('display', 'none')
                    } else {
                        $('.btn-tambah-grafik-harin').css('display', 'inline')
                    }
                })
                $('.btn-tambah-grafik-harin').attr('onclick', 'modalGrafikHarian("' + response.no_rawat + '","' + response.pasien.nm_pasien + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')")');
                setEws(no_rawat, 'ranap', response.dokter.kd_sps)

            })

            $('#modalSoapRanap').modal('toggle')

            // $('#modalSoapRanap').modal('toggle')
            tbSoapRanap(no_rawat);
            buildGrafik(no_rawat);
            appendDataGrafikHarian(no_rawat);
        }

        function tbSoapRanap(no_rawat = '', tgl_pertama = '', tgl_kedua = '', petugas = '') {
            no_rawat_soap = no_rawat;
            var tbSoapRanap = $('#tbSoap').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                lengthChange: false,
                ordering: false,
                paging: false,
                info: false,
                autoWidth: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tgl_pertama,
                        'tgl_kedua': tgl_kedua,
                        'petugas': petugas,
                    }
                },
                language: {
                    loadingRecords: '&nbsp;',
                    sProcessing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                },
                scrollCollapse: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            button = '<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-pencil-square"></i></button>';

                            // console.log(row.petugas.nip == "{{ session()->get('pegawai')->nik }}");
                            if (row.petugas.nip == "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->nik }}" == "direksi") {
                                button += '<br/><button type="button" class="btn btn-danger btn-sm" onclick="hapusSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-trash3-fill"></i></button>';
                            }
                            return button;
                        },
                        name: 'tgl_perawatan',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            list = '<li><strong>' + formatTanggal(row.tgl_perawatan) + ' ' + row.jam_rawat +
                                '</strong></li>';
                            list += '<li> Kesadaran : ' + row.kesadaran + '</li>';
                            $.map(row.grafik_harian, function(grafik) {
                                if (row.tgl_perawatan == grafik.tgl_perawatan && row.jam_rawat == grafik.jam_rawat) {
                                    list += '<li> O2 : ' + grafik.o2 + '</li>';
                                }
                            })
                            list += '<li> GCS : ' + row.gcs + '</li>';
                            list += '<li> Tensi : ' + row.tensi + ' mmHg</li>';
                            list += '<li> Nadi : ' + row.nadi + ' /mnt</li>';
                            list += '<li> SpO2 : ' + row.spo2 + ' %</li>';
                            list += '<li> Respirasi : ' + row.respirasi + ' /mnt</li>';
                            list += '<li> Suhu Tubuh : ' + row.suhu_tubuh + '  (<sup>o</sup>C)</li>';
                            list += '<li> Tinggi : ' + row.tinggi + ' Cm</li>';
                            list += '<li> Berat : ' + row.berat + ' Kg</li>';
                            list += '<li> alergi : ' + row.alergi + '</li>';
                            html = '<ul>' + list + '</ul>';


                            var btnVerif = '';

                            isDokter = "{{ session()->get('pegawai')->departemen }}";
                            if (isDokter == 'Direksi' || isDokter == 'SPS' || isDokter == '-') {
                                btnVerif = '<button type="button" style="font-size:12px; width:100%;" class="mx-auto btn btn-warning btn-sm mb-2" onclick="verifikasiSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-pencil-square" style="margin-right:5px;"></i> Verifikasi </button>';
                                $.map(row.verifikasi, function(verifikasi) {
                                    if (row.tgl_perawatan == verifikasi.tgl_perawatan && row.jam_rawat == verifikasi.jam_rawat) {
                                        btnVerif = '<button type="button" style="font-size:12px; width:100%;" class="mx-auto btn btn-success btn-sm mb-2">Telah Diverifikasi<br/>Oleh : <b>' + verifikasi.petugas.nama + '</b></button>';
                                    }
                                })
                            } else {
                                $.map(row.log, function(log) {
                                    if (row.tgl_perawatan == log.tgl_perawatan && row.jam_rawat == log.jam_rawat) {
                                        btnVerif = `<div class="alert alert-info" role="alert" style="padding:5px;font-size:10px"><i>Di${log.aksi.toLowerCase()} oleh : <b>${log.pegawai.nama} 
                                            , ${formatTanggal(log.waktu)} ${log.waktu.split(' ')[1]}
                                                </i></div>`
                                    }
                                })

                            }

                            html += btnVerif;
                            return html;
                        },
                        name: 'ttv',
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            baris = '<tr><td width="5%">Petugas </td><td width="5%">:</td><td>' + row
                                .petugas.nama + '</td></tr>'
                            baris += '<tr><td>Subjek </td><td>:</td><td>' + stringSoap(row.keluhan) + '</td></tr>'
                            baris += '<tr><td>Objek </td><td>:</td><td>' + stringSoap(row.pemeriksaan) + '</td></tr>'
                            baris += '<tr><td>Assesment</td><td>:</td><td>' + stringSoap(row.penilaian) + '</td></tr>'
                            baris += '<tr><td>Plan</td><td>:</td><td>' + stringSoap(row.rtl) + '</td></tr>'
                            baris += '<tr><td>Instruksi</td><td>:</td><td>' + stringSoap(row.instruksi) + '</td></tr>'
                            // baris += '<tr><td>Evaluasi</td><td>:</td><td>' + row.evaluasi + '</td></tr>'
                            html = '<table class="table table-striped">' + baris + '</table>'
                            return html;
                        },
                        name: 'soap',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function appendDataGrafikHarian(no_rawat) {

            tableGrafikHarian = $("#tableGrafikHarian").dataTable({
                processing: true,
                serverSide: true,
                paging: true,
                lengthChange: true,
                lengthMenu: [
                    [7, 10, 25],
                    [7, 10, 25]
                ],
                pageLength: 7,
                stateSave: false,
                searching: false,
                ordering: false,
                info: true,
                autoWidth: false,
                responsive: true,
                ajax: {
                    url: 'soap/grafik/data',
                    type: 'GET',
                    data: function(data) {
                        data.no_rawat = no_rawat;
                    },
                    "language": {
                        "emptyTable": "data grafik harian kosong"
                    }
                },
                columns: [
                    // waktu perawatan, suhu, tensi, nadi, respirasi, spo2, o2, GCS, kesadaran
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data.tgl_perawatan + ' ' + data.jam_rawat;
                        },
                        name: 'tgl_perawatan'
                    },
                    {
                        data: 'suhu_tubuh',
                        name: 'suhu_tubuh'
                    },
                    {
                        data: 'tensi',
                        name: 'tensi'
                    },
                    {
                        data: 'nadi',
                        name: 'nadi'
                    },
                    {
                        data: 'respirasi',
                        name: 'respirasi'
                    },
                    {
                        data: 'spo2',
                        name: 'spo2'
                    },
                    {
                        data: 'o2',
                        name: 'o2'
                    },
                    {
                        data: 'gcs',
                        name: 'gcs'
                    },
                    {
                        data: 'kesadaran',
                        name: 'kesadaran'
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            var htmlButton = `<button type="button" class="btn btn-sm btn-danger btn-hapus-grafik-harian" onClick="deleteGrafikHarian('` + data.no_rawat + `','` + data.tgl_perawatan + `','` + data.jam_rawat + `')"><i class="bi bi-trash"></i></button>`;
                            htmlButton += `<button type="button" class="btn btn-sm btn-warning btn-edit-grafik-harian" onClick="editGrafikHarian('` + data.no_rawat + `','` + data.tgl_perawatan + `','` + data.jam_rawat + `','` + data.suhu_tubuh + `','` + data.tensi + `','` + data.nadi + `','` + data.respirasi + `','` + data.spo2 + `','` + data.o2 + `','` + data.gcs + `','` + data.kesadaran + `')"><i class="bi bi-pencil-square"></i></button>`;

                            return htmlButton;
                        },
                        name: 'aksi'
                    }
                ],
            });
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
            $('#btn-reset').css('display', 'none');
            $('#btn-ubah').css('display', 'none');
            $('#table-ews tbody').empty();
            $('.td-jam').remove();
            $('.td-tanggal').remove();
        });


        // modal tambah grafik harian
        function modalGrafikHarian(no_rawat, nm_pasien) {
            $('#modalGrafikHarian').modal('toggle');

            // set data to modal
            $('#formSaveGrafikHarian input[name="no_rawat"]').val(no_rawat);
            $('#formSaveGrafikHarian input[name="nm_pasien"]').val(nm_pasien);


        }

        // form tambah grafik harian submit
        $('#formSaveGrafikHarian').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '/erm/soap/grafik/store',
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
                    'action': $('#formSaveGrafikHarian input[name="action"]').val(),
                    'tgl_perawatan': $('#formSaveGrafikHarian input[name="tgl_perawatan"]').val(),
                    'jam_rawat': $('#formSaveGrafikHarian input[name="jam_rawat"]').val(),
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
                        $('#modalGrafikHarian').modal('toggle');
                        grafikPemeriksaan.destroy();

                        swal.fire({
                            title: 'Berhasil',
                            text: response.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $("#tableGrafikHarian").DataTable().destroy();

                        buildGrafik(response.no_rawat);
                        appendDataGrafikHarian(response.no_rawat);
                        clearFormGrafikHarian();
                    } else {
                        console.log(response);
                    }

                },
                error: function(request, status, error) {
                    console.log(request.responseText);
                }
            })
        });

        $('#modalGrafikHarian').on('hidden.bs.modal', function() {
            clearFormGrafikHarian();

            $('#formSaveGrafikHarian input[name="action"]').remove();
            $('#formSaveGrafikHarian input[name="tgl_perawatan"]').remove();
            $('#formSaveGrafikHarian input[name="jam_rawat"]').remove();
        });

        function deleteGrafikHarian(no_rawat, tgl_perawatan, jam_rawat) {
            swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data grafik harian akan dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'soap/grafik/delete',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'no_rawat': no_rawat,
                            'tgl_perawatan': tgl_perawatan,
                            'jam_rawat': jam_rawat
                        },
                        type: 'DELETE',
                        beforeSend: function() {
                            $("#tableGrafikHarian").DataTable().destroy();
                            swal.fire({
                                title: 'Sedang menghapus data',
                                text: 'Mohon Tunggu',
                                showConfirmButton: false,
                                didOpen: () => {
                                    swal.showLoading();
                                }
                            })
                        },
                        success: function(response) {
                            if (response.success) {
                                tableGrafikHarian.fnDestroy();
                                grafikPemeriksaan.destroy();
                                grafikPemeriksaan = null;
                                swal.fire({
                                    title: 'Berhasil',
                                    text: response.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#tableGrafikHarian").DataTable().destroy();
                                buildGrafik(no_rawat);
                                appendDataGrafikHarian(no_rawat);
                                clearFormGrafikHarian();
                            } else {
                                console.log(response);
                            }
                        },
                        error: function(request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                }
            });
        }

        function editGrafikHarian(no_rawat, tgl_perawatan, jam_rawat, suhu_tubuh, tensi, nadi, respirasi, spo2, o2, gcs, kesadaran) {
            $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val(suhu_tubuh);
            $('#formSaveGrafikHarian input[name="tensi"]').val(tensi);
            $('#formSaveGrafikHarian input[name="nadi"]').val(nadi);
            $('#formSaveGrafikHarian input[name="respirasi"]').val(respirasi);
            $('#formSaveGrafikHarian input[name="spo2"]').val(spo2);
            $('#formSaveGrafikHarian input[name="o2"]').val(o2);
            $('#formSaveGrafikHarian input[name="gcs"]').val(gcs);
            $('#formSaveGrafikHarian select[name="kesadaran"]').val(kesadaran);

            var htmlEdit = `
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="tgl_perawatan" value="${tgl_perawatan}">
            <input type="hidden" name="jam_rawat" value="${jam_rawat}">`;

            // clear hidden input
            $('#formSaveGrafikHarian input[name="action"]').remove();
            $('#formSaveGrafikHarian input[name="tgl_perawatan"]').remove();
            $('#formSaveGrafikHarian input[name="jam_rawat"]').remove();

            $('#formSaveGrafikHarian').append(htmlEdit);
        }

        function clearFormGrafikHarian() {
            $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val('-');
            $('#formSaveGrafikHarian input[name="tensi"]').val('-');
            $('#formSaveGrafikHarian input[name="nadi"]').val('-');
            $('#formSaveGrafikHarian input[name="respirasi"]').val('-');
            $('#formSaveGrafikHarian input[name="spo2"]').val('-');
            $('#formSaveGrafikHarian input[name="o2"]').val('-');
            $('#formSaveGrafikHarian input[name="gcs"]').val('-');
        }
    </script>
@endpush
