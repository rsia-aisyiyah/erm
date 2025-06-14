@extends('index')
@section('contents')
    <form action="" id="formFilterRanap" class="mb-3">
        <div class="form-group mb-2">
            <div class="row gy-2">
                <div class="col-lg-2 col-md-12 col-sm-12">
                    <div class="input-group">
                        <div class="row gy-2">
                            <div class="col col-sm-12">
                                <div class="form-radio form-radio-inline">
                                    <input class="form-radio-input" type="radio" id="belum"
                                        name="stts_pulang"
                                        value="Belum Pulang">
                                    <label class="form-radio-label" for="belum">Belum
                                        Pulang</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="row gy-2">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-radio form-radio-inline">
                                <input class="form-radio-input" type="radio" id="pulang"
                                    name="stts_pulang"
                                    value="pulang">
                                <label class="form-radio-label" for="pulang">Pulang</label>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                            <div class="input-group input-group-sm">
                                <input type="text"
                                    class="form-control form-control-sm tanggal tgl_pulang"
                                    id="tgl_pulang_awal" name="tgl_pulang_awal" autocomplete="off"
                                    disabled>
                                <span class="input-group-text"><label for="">s/d</label></span>
                                <input type="text"
                                    class="form-control form-control-sm tanggal tgl_pulang"
                                    id="tgl_pulang_akhir" name="tgl_pulang_akhir" autocomplete="off"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="row gy-2">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="form-radio form-radio-inline">
                                <input class="form-radio-input" type="radio" id="masuk"
                                    name="stts_pulang"
                                    value="masuk">
                                <label class="form-radio-label" for="masuk">Masuk</label>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-4 col-sm-12">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                    id="tgl_masuk_awal" name="tgl_masuk_awal" autocomplete="off"
                                    disabled>

                                <span class="input-group-text"><label for="">s/d</label></span>
                                <input type="text" class="form-control form-control-sm tanggal tgl_masuk"
                                    id="tgl_masuk_akhir" name="tgl_masuk_akhir" autocomplete="off" disabled>

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
        </div>
        <div class="form-group">
            <div class="row gy-2">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <select name="spesialis" id="spesialis" class="form-select form-select-sm"
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
    <table class="table table-hover text-sm table-sm" id="tb_ranap" width="100%">
        {{-- <thead>
                <tr role="row">
                    <th></th>
                    <th>No. Rawat</th>
                    <th>Pasien</th>
                    <th>Pembiayaan</th>
                    <th>Kamar</th>
                    <th>Lama</th>
                    <th>Dokter</th>
                    <th>Diag. Awal</th>
                </tr>
            </thead> --}}
    </table>

    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_hasil_kritis')
    @include('content.ranap.modal.modal_lab')
    @include('content.ranap.modal.modal_soap')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.ranap.modal.modal_asmed_anak')
    @include('content.ranap.modal.modal_asmed_kandungan')
    @include('content.ranap.modal.modal_askep_anak')
    @include('content.ranap.modal.modal_askep_neonatus')
    @include('content.ranap.modal.modal_askep_kandungan')
    @include('content.ranap.modal.modal_grafik_harian')
    @include('content.ranap.modal.modal_resume_ranap')
    @include('content.ranap.modal.modal_list_pemeriksaan')
    @include('content.ranap.modal.modal_list_pemeriksaan_asmed')
    @include('content.ranap.modal.modal_list_diagnosa')
    @include('content.ranap.modal.modal_riwayat_vaksin')
    @include('content.ranap.modal.modal_riwayat_asmed_kandungan')
    @include('content.ranap.modal.modal_riwayat_persalinan')
    @include('content.ranap.modal.modal_poc')
    @include('content.ranap.modal.modal_skrining_tb')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.ranap.modal.modal_catatan_edukasi_pasien')
    @include('content.ranap.modal.cppt.gizi._modalListAntropometri')
    @include('content.ranap.modal.cppt.gizi._modalListBiokimia')
    @include('content.ranap.modal.modal_monitoring_cairan')
    @include('content.ranap.modal.modal_edukasi_obat_pulang')
    @include('content.ranap.modal.modal_discharge_planning')
    @include('content.ranap.modal.modal_resep_pulang')
    @include('content.ranap.modal.modal_asesmen_nyeri_dewasa')
    @include('content.ranap.modal.modal_asesmen_nyeri_batita_flacc')
    @include('content.ranap.modal.modal_asesmen_nyeri_balita')
    @include('content.ranap.modal.modal_asesmen_nyeri_anak')
    @include('content.ranap.modal.modal_asesmen_nyeri_neonatus')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_dewasa')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_anak')
    @include('content.poliklinik.modal.modal_icare')
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('js/context-menu/ranap.js') }}"></script>
    <script>
        var stts_pulang = '-';
        var tgl_awal = '';
        var tgl_akhir = '';
        var jamSekarang = '';
        var cek = '';
        var kamar = localStorage.getItem('kamar');
        var sps = localStorage.getItem('spesialis') ? localStorage.getItem('spesialis') : '';
        var valScrollX = '';
        var cekDepartement = `{{ session()->get('pegawai')->departemen }}`
        var kd_dokter = localStorage.getItem('dokter') ? localStorage.getItem('dokter') : $('#kd_dokter').val();
        var getSpsId = $('#kd_sps').val();


        $(document).ready(function() {
            // new bootstrap.Tab('#tab-resep')
            new bootstrap.Tab('#tab-ews')
            new bootstrap.Tab('#tab-grafik')
            new bootstrap.Tab('#tab-tabel')

            date = new Date()
            const hari = ('0' + (date.getDate())).slice(-2);
            const bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            const tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                defaultDate: null,
                todayHighlight: true,
                todayBtn: true
            });

            $('#cari-kamar').val(kamar)
            $('.tanggal').datepicker('setDate', dateStart)
            tb_ranap();
        });

        $('#cari-kamar').on('search', function() {
            if ($(this).val() === '') {
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

            if (kamar.length === 0) {
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
            if (stts_pulang === 'Pulang') {
                a = $('#tgl_pulang_awal').val();
                b = $('#tgl_pulang_akhir').val();
            } else if (stts_pulang === 'Masuk') {
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
                scrollY: "60vh",
                stateSave: true,
                ordering: true,
                paging: false,
                info: false,
                destroy: true,
                ajax: {
                    url: `ranap/pasien`,
                    data: {
                        'stts_pulang': stts_pulang,
                        'tgl_pertama': tgl_awal,
                        'tgl_kedua': tgl_akhir,
                        'kd_dokter': kd_dokter,
                        'kamar': kamar,
                        'spesialis': sps,

                    },
                },
                columnDefs: [{
                        target: 0,
                        width: 10,
                    }, {
                        target: 1,
                        width: 80,
                    },
                    {
                        target: 3,
                        width: 150,
                    }, {
                        target: 4,
                        width: 50,
                    }, {
                        target: 5,
                        width: 20,
                    }, {
                        target: 6,
                        width: 100,
                    }, {
                        target: 7,
                        width: 50,
                    }, {
                        target: 8,
                        width: 150,
                    }, {
                        target: 9,
                        width: 150,
                    }
                ],
                createdRow: (element, data, index, meta) => {
                    const row = $(element);
                    const dataAttr = {
                        'no_rawat': data.no_rawat,
                        'no_rkm_medis': data.reg_periksa.no_rkm_medis,
                        'kd_dokter': data.reg_periksa.kd_dokter,
                        'tgl_lahir': data.pasien.tgl_lahir,
                        'umurdaftar': data.reg_periksa.umurdaftar,
                        'tgl_reg': data.reg_periksa.tgl_registrasi,
                        'sttsumur': data.reg_periksa.sttsumur,
                        'no_peserta': data.pasien.no_peserta,
                        'kd_dokter_bpjs': data.reg_periksa.dokter.mapping_dokter.kd_dokter_bpjs,
                        'kd_pj': data.reg_periksa.kd_pj,
                        'kd_sps': data.reg_periksa.dokter.kd_sps
                    }

                    row.attr('data-pasien', JSON.stringify(dataAttr))
                        .addClass('row-ranap');

                    const asmedAnak = data.asmed_anak;
                    const asmedKandungan = data.asmed_kandungan;
                    const asmedUmumBBL = data.asmed_umum;

                    if (asmedAnak === null && asmedKandungan === null) {
                        row.addClass('table-danger')
                    }

                    if (data.reg_periksa.umurdaftar === '0' && data.reg_periksa.sttsumur === 'Hr') {
                        if (asmedUmumBBL === null) {
                            row.addClass('table-danger')
                        }
                    }



                },
                columns: [{
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            if (!data.dokter) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan ID Dokter ${row}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return false;
                            }

                            const textNoRawat = textRawat(row.no_rawat);

                            list = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang(\'' + data.no_rawat + '\')">Pemeriksaan Penunjang</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="hasilKritis('${data.no_rawat}')" data-id="${data.no_rawat}">Hasil Kritis</a></li>`;
                            list += '<li><a class="dropdown-item" href="javascript:void(0)" data-kd-dokter="' + row.reg_periksa.kd_dokter + '" onclick="showModalSoapRanap(\'' + data.no_rawat + '\')">CPPT</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="detailPeriksa('${data.no_rawat}', 'Ranap')">Upload Berkas Penunjang</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="catatanEdukasiPasien('${data.no_rawat}')">Catatan Edukasi Pasien</a></li>`;

                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalMonitoringCairan('${data.no_rawat}')">Monitoring Cairan Pasien</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalObatPulang('${data.no_rawat}')">Edukasi Obat Pulang  ${cekList(row.edukasi_obat_pulang)}</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalDischargePlanning('${data.no_rawat}')">Discharge Planning  ${cekList(row.discharge_planning)}</a></li>`;

                            list += renderListsAsesmenNyeri(data.pasien.tgl_lahir, data.tgl_registrasi, data.no_rawat);
                            if (row.reg_periksa.dokter.kd_sps === 'S0003') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak('${data.no_rawat}')">Asesmen Medis Anak ${cekList(row.reg_periksa.asmed_ranap_anak)}</a></li>`;
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhAnak('${data.no_rawat}')">Asesmen Resiko Jatuh Anak</a></li>`;
                                if (data.sttsumur === 'Hr') {
                                    list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapNeonatus('${data.no_rawat}')">Asesmen Keperawatan Neonatus ${cekList(row.reg_periksa.askep_ranap_neonatus)}</a></li>`;
                                } else if (data.sttsumur === 'Bl' || (data.umurdaftar <= 3 && data.sttsumur === 'Th')) {

                                    list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapAnak('${data.no_rawat}')">Asesmen Keperawatan Anak ${cekList(row.reg_periksa.askep_ranap_anak)}</a></li>`;
                                } else {
                                    list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapAnak('${data.no_rawat}')">Asesmen Keperawatan Anak ${cekList(row.reg_periksa.askep_ranap_anak)}</a></li>`;
                                }
                            } else if (row.reg_periksa.dokter.kd_sps === 'S0001') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapKandungan('${data.no_rawat}')">Asesmen Medis Kandungan ${cekList(row.reg_periksa.asmed_ranap_kandungan)}</a></li>`;
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapKandungan('${data.no_rawat}')">Asesmen Keperawatan Kandungan ${cekList(row.reg_periksa.askep_ranap_kandungan)}</a></li>`;
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhDewasa('${data.no_rawat}')">Asesmen Resiko Jatuh Dewasa</a></li>`;

                            }

                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="skoringTb('${data.no_rawat}')">Skoring & Skrining TB ${cekList(row.skrining_tb)}</a></li>`;
                            isDokter = "{{ session()->get('pegawai')->departemen }}";
                            if (isDokter === 'DM7' || isDokter === 'Direksi' || isDokter === 'SPS' || isDokter === '-' || isDokter === 'CSM') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPlanOfCare('${data.no_rawat}')"><i>Plan of Care</i> ${cekList(row.reg_periksa.poc)}</a></li>`;
                            }
                            if (isDokter === 'Direksi' || isDokter === 'SPS' || isDokter === '-' || isDokter === 'CSM') {
                                if (row.resume) {
                                    iconCheck = '<i class="bi bi-check-circle text-success"></i>';
                                } else {
                                    iconCheck = '';
                                }
                                list += `<li><a class="dropdown-item" href="#" onclick="resumeMedis('${data.no_rawat}')">Resume Medis ${iconCheck}</a></li>`;
                            }
                            // list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${data.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${data.no_rkm_medis}')" data-id="${data.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            // list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare('${data.pasien.no_peserta}', '${data.dokter.mapping_dokter.kd_dokter_bpjs}')">Riwayat Pemeriksaan I-Care</a></li>`;
                            button = `<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="dropdownAksi${meta.row}" data-id="${row.no_rawat}"><i class="bi bi-list-task"></i></button><ul class="dropdown-menu" style="font-size:11px">${list}</ul></div>`

                            return button;
                        }
                    },
                    {
                        title: 'No. Rawat',
                        data: 'no_rawat',
                    },
                    {
                        title: 'Pasien',
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            pasien = `${data.no_rkm_medis} <br/> ${data.pasien.nm_pasien} (${data.umurdaftar} ${data.sttsumur})`;

                            bayiGabung = '';
                            if (row.ranap_gabung) {
                                isDokter = "{{ session()->get('pegawai')->departemen }}";
                                resume = '';
                                if (isDokter == 'Direksi' || isDokter == 'SPS' || isDokter == '-' || isDokter == 'CSM') {
                                    if (row.resume) {
                                        iconCheck = '<i class="bi bi-check-circle text-success"></i>';
                                    } else {
                                        iconCheck = '';
                                    }
                                    resume = `<li><a class="dropdown-item" href="#" onclick="resumeMedis('${row.ranap_gabung.reg_periksa.no_rawat}')">Resume Medis ${iconCheck}</a></li>`;
                                }
                                namaBayi = `<a class="dropdown-toggle btn btn-warning btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">${row.ranap_gabung.reg_periksa.pasien.nm_pasien}</a>
                                <ul class="dropdown-menu" style="font-size:12px">
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang('${row.ranap_gabung.reg_periksa.no_rawat}')">Laborat</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" data-kd-dokter="${row.ranap_gabung.reg_periksa.kd_dokter}" onclick="showModalSoapRanap('${row.ranap_gabung.reg_periksa.no_rawat}')">CPPT</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak('${row.ranap_gabung.reg_periksa.no_rawat}')">Asesmen Medis Anak ${cekList(row.ranap_gabung.reg_periksa.asmed_ranap_anak)}</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapNeonatus('${row.ranap_gabung.reg_periksa.no_rawat}')">Asesmen Keperawatan Neonatus ${cekList(row.ranap_gabung.reg_periksa.askep_ranap_neonatus)}</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPenunjangRanap('${row.ranap_gabung.reg_periksa.no_rawat}')">Pemeriksaan Penunjang</a></li>
                                    ${resume}
                                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${row.ranap_gabung.reg_periksa.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.ranap_gabung.reg_periksa.no_rkm_medis}">Riwayat Pemeriksaan</a></li>
                                </ul>`
                                bayiGabung = `<hr style="margin:0px"/>${row.ranap_gabung.reg_periksa.no_rawat} <br/> <strong>${namaBayi}</strong>  `

                            }


                            return '<strong>' + '<span id="pasien">' + pasien + '</span></strong><br/>' + bayiGabung;

                        },
                        name: 'reg_periksa',
                    },

                    {
                        title: 'Kamar',
                        data: 'kamar',
                        render: function(data) {
                            return data.bangsal.nm_bangsal;
                        },
                        name: 'kamar',
                    },
                    {
                        title: 'Tgl. Masuk',
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            return `${splitTanggal(data.tgl_registrasi)} ${data.jam_reg}`;
                        },
                        name: 'tgl_masuk',
                    },
                    {
                        title: 'Lama',
                        data: 'lama',
                        render: function(data, type, row) {
                            return `${data} Hari`;
                        },
                        name: 'lama',
                    },
                    {
                        title: 'Diag. Awal',
                        data: '',
                        name: 'diagnosa',
                        render: function(data, type, row) {
                            const asmedAnak = row.asmed_anak;
                            const asmedKandungan = row.asmed_kandungan;
                            const asmedUmumBBL = row.asmed_umum;

                            if (asmedAnak) {
                                return asmedAnak.diagnosis;
                            } else if (asmedKandungan) {
                                return asmedKandungan.diagnosis;
                                // return moment(asmedKandungan.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else if (asmedUmumBBL) {
                                return asmedUmumBBL.diagnosis;
                                // return moment(asmedUmumBBL.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else {
                                return '<span class="text-danger"><b>Belum Ada Asmed</b></span>'
                            }
                        }
                    },
                    {
                        title: 'Asesmen Medis',
                        render: (data, type, row) => {
                            const asmedAnak = row.asmed_anak;
                            const asmedKandungan = row.asmed_kandungan;
                            const asmedUmumBBL = row.asmed_umum;

                            if (asmedAnak) {
                                return moment(asmedAnak.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            } else if (asmedKandungan) {
                                return moment(asmedKandungan.tanggal).format('DD-MM-YYYY HH:mm:ss');
                            }

                            if (row.reg_periksa.umurdaftar === '0' && row.reg_periksa.sttsumur === 'Hr') {
                                if (asmedUmumBBL === null) {
                                    // row.addClass('table-danger')
                                    return moment(asmedUmumBBL.tanggal).format('DD-MM-YYYY HH:mm:ss');
                                }
                            }
                            // else if (asmedUmumBBL) {} else {
                            // }
                            return '<span class="text-danger"><b>Belum Ada Asmed</b></span>'

                            // if (data.reg_periksa.umurdaftar === '0' && data.reg_periksa.sttsumur === 'Hr') {
                            //     if (asmedUmumBBL === null) {
                            //         // row.addClass('table-danger')
                            //     }
                            // }
                            // return false;
                        }
                    },
                    {
                        title: 'Dokter DPJP',
                        data: 'reg_periksa',
                        render: function(data, type, row) {
                            let dokter = '';
                            if (!data.dokter) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan ID Dokter ${data.kd_dokter}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return '';
                            }
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
                            dokterGabung = '';
                            if (row.ranap_gabung) {
                                namaBayi =
                                    dokterGabung = `<hr style="margin:0px"/>${row.ranap_gabung.reg_periksa.dokter.nm_dokter}`

                            }
                            return `<span class="nm_dokter">${dokter} ${dokterGabung}</span>`;
                        },
                        name: 'dokter'
                    },

                    {
                        title: 'Pembiayaan',
                        data: 'reg_periksa.penjab',
                        render: function(data) {
                            penjab = `<span class="${data.kd_pj === 'A03' ? 'text-danger' : 'text-success'}"><b>${data.png_jawab}</b></span>`
                            return penjab;
                        },
                        name: 'penjab',
                    },
                    {
                        title: 'Status',
                        data: 'stts_pulang',
                        render: function(data, type, row, meta) {
                            let tanggal = '';
                            if (data === '-') {
                                tanggal = ``;
                            } else {
                                tanggal = `${moment(row.tgl_keluar).format('DD-MM-YYYY')} ${row.jam_keluar}`;

                            }
                            return `${tanggal}<br>${data}`;
                        }
                    }
                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                    "search": "Pencarian",
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
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return ttv;
        }

        function showRiwayatAsmedKandungan(rawat, no_rkm_medis) {
            $('#tbRiwayatAsmed tbody').empty()
            const urlAsmed = rawat === 'ranap' ? `asmed/ranap/kandungan/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: urlAsmed,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli !== 'IGDK' && asmed.reg_periksa.kd_poli !== 'U0016') {
                            html = '<tr>'
                            html += `<td>${asmed.no_rawat}</td>
                            <td>${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}</td>
                            <td>${asmed.reg_periksa.poliklinik.nm_poli}</td>
                            <td>${asmed.dokter.nm_dokter}</td>
                            <td><button class="btn btn-success btn-sm" type="button" onclick="copyAsmedKandunganRanap('${asmed.no_rawat}')"><i class="bi bi-download"></i> Gunakan</button></td>`
                            html += '<tr>'
                            $('#tbRiwayatAsmed tbody').append(html)
                            $('#modalRiwayatAsmed').modal('show')
                        } else {
                            alertErrorAjax({
                                status: 404,
                                statusText: 'TIDAK ADA ASMED DARI POLI',
                                responseJSON: {
                                    message: ''
                                }
                            })
                        }
                    })
                } else {
                    alertErrorAjax({
                        status: 404,
                        statusText: 'TIDAK ADA ASMED DARI POLI',
                        responseJSON: {
                            message: ''
                        }
                    })
                }
            }).fail((request) => {
                alertErrorAjax();
            })
        }

        function showRiwayatAsmedAnak(rawat, no_rkm_medis) {
            $('#tbRiwayatAsmed tbody').empty()
            const urlAsmed = rawat === 'ranap' ? `asmed/ranap/anak/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: urlAsmed,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli !== 'IGDK' && asmed.reg_periksa.kd_poli !== 'U0016') {
                            html = '<tr>'
                            html += `<td>${asmed.no_rawat}</td>
                                <td>${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}</td>
                                <td>${asmed.reg_periksa.poliklinik.nm_poli}</td>
                                <td>${asmed.dokter.nm_dokter}</td>
                                <td><button class="btn btn-success btn-sm" type="button" onclick="copyAsmedAnakRanap('${asmed.no_rawat}')"><i class="bi bi-download"></i> Gunakan</button></td>`
                            html += '<tr>'
                            $('#tbRiwayatAsmed tbody').append(html)
                            $('#modalRiwayatAsmed').modal('show')
                        } else {
                            alertErrorAjax({
                                status: 404,
                                statusText: 'TIDAK ADA ASMED DARI POLI',
                                responseJSON: {
                                    message: ''
                                }
                            })
                        }
                    })
                } else {
                    alertErrorAjax({
                        status: 404,
                        statusText: 'TIDAK ADA ASMED DARI POLI',
                        responseJSON: {
                            message: ''
                        }
                    })
                }
            }).fail((request) => {
                alertErrorAjax();
            })
        }

        function copyAsmedKandunganRanap(no_rawat) {
            getAsmedRanapKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);
                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            if (index === 'no_rawat') {
                                $(`#formAsmedRanapKandungan input[name=no_rawat_2]`).val(value)
                                $(`#modalAsmedRanapKandungan button[name=simpan]`).attr('onclick', `replaceAsmedRanapKandungan('${value}')`)
                            } else {
                                $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                            }
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                    $(`#formAsmedRanapKandungan input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                }
                alertSuccessAjax('Berhasil tarik data asesmen').then(() => {
                    $('#modalRiwayatAsmed').modal('hide')
                })
            })
        }

        function copyAsmedAnakRanap(no_rawat) {
            getAsmedRanapAnak(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);
                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            if (index === 'no_rawat') {
                                $(`#formAsmedRanapAnak input[name=no_rawat_2]`).val(value)
                                $(`#modalAsmedRanapAnak button[name=simpan]`).attr('onclick', `replaceAsmedRanapAnak('${value}')`)
                            } else {
                                $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                            }
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                }
                alertSuccessAjax('Berhasil tarik data asesmen').then(() => {
                    $('#modalRiwayatAsmed').modal('hide')
                })
            })
        }

        function asmedRanapKandungan(noRawat) {
            const kd_dokter = "{{ session()->get('pegawai')->nik }}"
            const nm_dokter = "{{ session()->get('pegawai')->nama }}"
            $('#formAsmedRanapKandungan input[name=kd_dokter]').val(kd_dokter);
            $('#formAsmedRanapKandungan input[name=nm_dokter]').val(nm_dokter);
            getRegPeriksa(noRawat).done((response) => {
                $('#formAsmedRanapKandungan input[name=no_rawat]').val(response.no_rawat);
                $('#formAsmedRanapKandungan input[name=pasien]').val(response.pasien.nm_pasien + ' (' + response.pasien.jk + ')');
                $('#formAsmedRanapKandungan input[name=tgl_lahir]').val(formatTanggal(response.pasien.tgl_lahir) + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#formAsmedRanapKandungan button[name=riwayatAsmedRanap]').attr('onclick', `showRiwayatAsmedKandungan('ranap', '${response.no_rkm_medis}')`);
            }).fail((request) => {
                if (request.status === 401) {
                    Swal.fire({
                        title: 'Sesi login berakhir !',
                        icon: 'info',
                        text: 'Silahkan login kembali ',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/erm';
                        }
                    })
                }
            })

            getAsmedRanapKandungan(noRawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })

                }
            })
            $('#formAsmedRanapKandungan .srcPemeriksaanAsmed').attr('onclick', `listRiwayatTtv('${noRawat}', 'ttv', 'formAsmedRanapAnak')`);
            $('#modalAsmedRanapKandungan').modal('show')
            $('#modalAsmedRanapKandungan button[name=simpan]').attr('onclick', `simpanAsmedRanapKandungan()`)
        }

        function asmedRanapAnak(noRawat) {
            const kd_dokter = "{{ session()->get('pegawai')->nik }}"
            const nm_dokter = "{{ session()->get('pegawai')->nama }}"
            $('#formAsmedRanapAnak input[name=kd_dokter]').val(kd_dokter);
            $('#formAsmedRanapAnak input[name=nm_dokter]').val(nm_dokter);
            getRegPeriksa(noRawat).done((response) => {
                $('#formAsmedRanapAnak input[name=no_rawat]').val(response.no_rawat);
                $('#formAsmedRanapAnak input[name=pasien]').val(response.pasien.nm_pasien + ' (' + response.pasien.jk + ')');
                $('#formAsmedRanapAnak input[name=tgl_lahir]').val(formatTanggal(response.pasien.tgl_lahir) + ' (' + hitungUmur(response.pasien.tgl_lahir) + ')');
                $('#formAsmedRanapAnak button[name=riwayatAsmedRanap]').attr('onclick', `showRiwayatAsmedAnak('ranap', '${response.no_rkm_medis}')`);
            });
            getAsmedRanapAnak(textRawat(noRawat, '-')).done((response) => {
                if (Object.keys(response).length) {
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).val(response.dokter.nm_dokter)
                    $(`#formAsmedRanapAnak input[name=nm_dokter]`).attr('readonly', 'readonly')
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })

                }
            })
            $('#formAsmedRanapAnak .srcPemeriksaanAsmed').attr('onclick', `listRiwayatTtv('${noRawat}', 'ttv', 'formAsmedRanapAnak')`);
            $('#modalAsmedRanapAnak button[name=simpan]').attr('onclick', 'simpanAsmedRanapAnak()')
            $('#modalAsmedRanapAnak').modal('show')
        }

        $("#modalSoapRanap").on('hidden.bs.modal', function() {
            grafikPemeriksaan.destroy();
            grafikPemeriksaan = null;

            tableGrafikHarian.fnDestroy();
            tableGrafikHarian = null;
        });




        // function toggleDropdownAksi(e) {
        //     const isShow = $(e).hasClass('show');
        //     const no_rawat = $(e).data('id');
        //     const id = $(e).attr('id');
        //     if (isShow) {
        //         $(`#${id}`).removeClass('show');
        //     } else {
        //         $(`#${id}`).addClass('show');
        //     }
        // }
    </script>
@endpush
