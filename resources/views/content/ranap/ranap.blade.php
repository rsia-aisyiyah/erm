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
                        <div class="form-group mb-2">
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
    @include('content.ranap.modal.modal_hasil_kritis')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.ranap.modal.cppt.gizi._modalListAntropometri')
    @include('content.ranap.modal.cppt.gizi._modalListBiokimia')
@endsection

@push('script')
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
            new bootstrap.Tab('#tab-resep')
            new bootstrap.Tab('#tab-ews')
            new bootstrap.Tab('#tab-grafik')
            new bootstrap.Tab('#tab-tabel')
            // if (cekDepartement == 'DM3' || cekDepartement == 'DM8') {
            //     if (cekDepartement == 'DM3') {
            //         sps = 'S0001';
            //     } else if (cekDepartement == 'DM8') {
            //         sps = 'S0003';
            //     }
            //     $('#formFilterRanap select[name=spesialis]').val(sps);
            //     $('#formFilterRanap select[name=spesialis]').prop('disabled', true);
            //     $('#formFilterRanap select[name=dokter]').prop('disabled', false);
            //     $('#formFilterRanap select[name=dokter] .' + sps).css('display', 'none');
            //     if (kd_dokter) {
            //         $('#formFilterRanap select[name=dokter]').prop('disabled', false);
            //         $('#formFilterRanap select[name=dokter]').val(kd_dokter);
            //     }
            // } else if (cekDepartement == 'CSM' || "{{ session()->get('pegawai')->nik }}" == 'direksi') {
            //     $('#formSoapRanap .waktuSoap').css('visibility', 'visible');
            // } else {
            //     $('#formSoapRanap .waktuSoap').css('visibility', 'hidden');
            //     if (sps) {
            //         $('#formFilterRanap select[name=spesialis]').val(sps);
            //         $('#formFilterRanap select[name=spesialis]').prop('disabled', false);
            //         $('#formFilterRanap select[name=dokter] .' + sps).css('display', 'none');
            //     }
            //     if (kd_dokter) {
            //         $('#formFilterRanap select[name=dokter]').prop('disabled', false);
            //         $('#formFilterRanap select[name=dokter]').val(kd_dokter);
            //     } else {
            //         $('#formFilterRanap select[name=dokter]').prop('disabled', true);
            //         $('#formFilterRanap select[name=dokter] option').css('display', 'inline');
            //     }
            // }


            // if (getSpsId == 'S0005') {
            //     sps = `S0001`
            //     kd_dokter = '';
            // }

            // if (getSpsId == 'S0005' || getSpsId == 'S0003' || getSpsId == 'S0001') {
            //     valScrollX = 425;
            //     $('#formFilterRanap select[name=dokter]').prop('disabled', true);
            //     $('#formFilterRanap select[name=spesialis]').prop('disabled', true);
            //     $('#formFilterRanap select[name=dokter]').val(kd_dokter);
            //     $('#formFilterRanap select[name=spesialis]').val(getSpsId);
            // } else {
            //     valScrollX = 325;
            // }




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


        function checkJam() {
            cek = $('#cekJam').is(':checked')
            if (cek) {
                clearInterval(jamSekarang)
            } else {
                jamSekarang = setInterval(() => {
                    $('#jam_rawat_ubah').val(getJam())
                }, 1000);
            }
        }

        $('#cekJam').on('click', () => {
            console.log(checkJam());
        })



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
                scrollY: "60vh",
                stateSave: true,
                ordering: true,
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
                    // Swal.fire({
                    //     title: 'Menampilkan data rawat inap',
                    //     position: 'top-end',
                    //     toast: true,
                    //     icon: 'success',
                    //     timerProgressBar: true,
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // });
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
                                return '';
                            }
                            list = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang(\'' + data.no_rawat + '\')">Pemeriksaan Penunjang</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="hasilKritis('${data.no_rawat}')" data-id="${data.no_rawat}">Hasil Kritis</a></li>`;
                            list += '<li><a class="dropdown-item" href="javascript:void(0)" data-kd-dokter="' + row.reg_periksa.kd_dokter + '" onclick="showModalSoapRanap(\'' + data.no_rawat + '\')">CPPT</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="detailPeriksa('${data.no_rawat}', 'Ranap')">Upload Berkas Penunjang</a></li>`;

                            if (row.reg_periksa.dokter.kd_sps == 'S0003') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapAnak('${data.no_rawat}')">Asesmen Medis Anak ${cekList(row.reg_periksa.asmed_ranap_anak)}</a></li>`;
                                if (data.sttsumur == 'Hr') {
                                    list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapNeonatus('${data.no_rawat}')">Asesmen Keperawatan Neonatus ${cekList(row.reg_periksa.askep_ranap_neonatus)}</a></li>`;
                                } else {
                                    list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapAnak('${data.no_rawat}')">Asesmen Keperawatan Anak ${cekList(row.reg_periksa.askep_ranap_anak)}</a></li>`;
                                }
                            } else if (row.reg_periksa.dokter.kd_sps == 'S0001') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="asmedRanapKandungan('${data.no_rawat}')">Asesmen Medis Kandungan ${cekList(row.reg_periksa.asmed_ranap_kandungan)}</a></li>`;
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="askepRanapKandungan('${data.no_rawat}')">Asesmen Keperawatan Kandungan ${cekList(row.reg_periksa.askep_ranap_kandungan)}</a></li>`;
                            }
                            // resume medis aktif
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="skoringTb('${data.no_rawat}')">Skoring & Skrining TB ${cekList(row.skrining_tb)}</a></li>`;
                            isDokter = "{{ session()->get('pegawai')->departemen }}";
                            if (isDokter == 'DM7' || isDokter == 'Direksi' || isDokter == 'SPS' || isDokter == '-' || isDokter == 'CSM') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPlanOfCare('${data.no_rawat}')"><i>Plan of Care</i> ${cekList(row.reg_periksa.poc)}</a></li>`;
                            }
                            if (isDokter == 'Direksi' || isDokter == 'SPS' || isDokter == '-' || isDokter == 'CSM') {
                                if (row.resume) {
                                    iconCheck = '<i class="bi bi-check-circle text-success"></i>';
                                } else {
                                    iconCheck = '';
                                }
                                list += `<li><a class="dropdown-item" href="#" onclick="resumeMedis('${data.no_rawat}')">Resume Medis ${iconCheck}</a></li>`;
                            }


                            // list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${data.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${data.no_rkm_medis}')" data-id="${data.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            button = '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' + list + '</ul></div>'
                            return button;
                        }
                    },
                    {
                        data: 'reg_periksa',
                        render: function(data, type, row, meta) {
                            if (!data.pasien) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan No. RM ${row.no_rkm_medis}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return '';
                            }
                            if (data.pasien) {
                                pasien = `${data.no_rkm_medis} <br/> ${data.pasien.nm_pasien} (${data.umurdaftar} ${data.sttsumur})`;
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
                                namaBayi = `<a class="nav-link dropdown-toggle btn btn-warning btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">${row.ranap_gabung.reg_periksa.pasien.nm_pasien}</a>
                                <ul class="dropdown-menu dropdown-menu" style="font-size:12px">
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

                            asmed = '';
                            if (data.asmed_ranap_anak == null && data.asmed_ranap_kandungan == null) {
                                asmed = ' <button class="ml-1 px-1 py-0 btn btn-sm btn-danger" ><b>Belum ada Asmed</b></button>'
                            }



                            return data.no_rawat + asmed + '<br/><strong>' + '<span id="pasien">' + pasien + '</span></strong><br/>' + penjab + bayiGabung;

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
                        data: 'diagnosa_awal',
                        name: 'diagnosa'
                    },
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
            const url = rawat == 'ranap' ? `asmed/ranap/kandungan/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli != 'IGDK' && asmed.reg_periksa.kd_poli != 'U0016') {
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
            const url = rawat == 'ranap' ? `asmed/ranap/anak/rm/${no_rkm_medis}` : '';
            $.ajax({
                url: url,
                method: 'get',
                dataType: 'JSON',
            }).done((response) => {
                if (Object.keys(response).length) {
                    $.map(response, (asmed) => {
                        if (asmed.reg_periksa.kd_poli != 'IGDK' && asmed.reg_periksa.kd_poli != 'U0016') {
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
                            if (index == 'no_rawat') {
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
                            if (index == 'no_rawat') {
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
                if (request.status == 401) {
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



        function showModalSoapRanap(no_rawat) {
            var formInfoPasien = $('#formInfoPasien')
            getRegPeriksa(no_rawat).done((response) => {

                formInfoPasien.find('input[name="no_rawat"]').val(no_rawat);
                formInfoPasien.find('input[name="no_rkm_medis"]').val(response.no_rkm_medis);
                formInfoPasien.find('input[name="pasien"]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formInfoPasien.find('input[name="umur"]').val(`${response.umurdaftar} ${response.sttsumur}`);
                formInfoPasien.find('input[name="dokter_dpjp"]').val(`${response.dokter.nm_dokter}`);

                const kamar = response.kamar_inap.map((item, index) => {
                    formInfoPasien.find('input[name="kamar"]').val(item.kamar.bangsal.nm_bangsal);
                    formInfoPasien.find('input[name="diagnosa_awal"]').val(item.diagnosa_awal);
                })

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

                $('#formSoapRanap .btn-simpan').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSoapRanap .btn-simpan').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSoapRanap .btn-simpan').attr('data-nm-pasien', response.pasien.nm_pasien);

                $('#formSaveGrafikHarian #kdDokter').attr('data-kd-dokter', response.dokter.kd_dokter);
                $('#formSaveGrafikHarian #spesialisDokter').attr('data-spesialis', response.dokter.spesialis.nm_sps);
                $('#formSaveGrafikHarian #nmPasien').attr('data-nm-pasien', response.pasien.nm_pasien);
            })

            $('#modalSoapRanap').modal('toggle')

            tbSoapRanap(no_rawat);
            buildGrafik(no_rawat);
            appendDataGrafikHarian(no_rawat);
        }

        function tbSoapRanap(no_rawat = '', tgl_pertama = '', tgl_kedua = '', petugas = '') {
            no_rawat_soap = no_rawat;
            var tbSoapRanap = $('#tbSoap').dataTable({
                processing: true,
                paging: false,
                info: false,
                ajax: {
                    url: "soap",
                    data: {
                        'no_rawat': no_rawat,
                        'tgl_pertama': tgl_pertama,
                        'tgl_kedua': tgl_kedua,
                        'petugas': petugas,
                    },
                    error: (request) => {
                        if (request.status == 401) {
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
                    },
                },
                scrollCollapse: true,
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            button = '<button type="button" class="btn btn-primary btn-sm mb-2" onclick="ambilSoap(\'' + row.no_rawat + '\',\'' + row.tgl_perawatan + '\', \'' + row.jam_rawat + '\')"><i class="bi bi-pencil-square"></i></button>';
                            if (row.nip == "{{ session()->get('pegawai')->nik }}" || "{{ session()->get('pegawai')->nik }}" == "direksi") {
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
                            isDirektur = "{{ session()->get('pegawai')->jbtn }}";
                            if (isDokter == 'Direksi' || isDokter == 'SPS' || isDirektur == 'Direktur') {
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
                            baris += '<tr><td>Subjek </td><td>:</td><td>' + stringPemeriksaan(row.keluhan) + '</td></tr>'
                            baris += '<tr><td>Objek </td><td>:</td><td>' + stringPemeriksaan(row.pemeriksaan) + '</td></tr>'
                            baris += '<tr><td>Assesment</td><td>:</td><td>' + stringPemeriksaan(row.penilaian) + '</td></tr>'
                            baris += '<tr><td>Plan</td><td>:</td><td>' + stringPemeriksaan(row.rtl) + '</td></tr>'
                            html = '<table class="table table-striped">' + baris + '</table>'
                            return html;
                        },
                        name: 'soap',
                    },
                ],
                "language": {
                    "zeroRecords": "Tidak ada data  data pemeriksaan",
                    "infoEmpty": "Tidak ada data data pemeriksaan",
                    "search": "Pencarian",
                },
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

            var kd_dokter = $('#formSaveGrafikHarian #kdDokter').data('kd-dokter');
            var spesialis = $('#formSaveGrafikHarian #spesialisDokter').data('spesialis');
            var nm_pasien = $('#formSaveGrafikHarian #nmPasien').data('nm-pasien');

            var suhu_tubuh = $('#formSaveGrafikHarian input[name="suhu_tubuh"]').val();
            var no_rawat = $('#formSaveGrafikHarian input[name="no_rawat"]').val();

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
                        if (suhu_tubuh.includes(',')) {
                            suhu_tubuh = suhu_tubuh.replace(',', '.')
                        }
                        if (spesialis.toLowerCase().includes('anak')) {
                            if (suhu_tubuh < 35.5 || suhu_tubuh > 39.5) {
                                notifSend(
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    no_rawat,
                                    'Ranap',
                                    'detail'
                                );
                            }
                        } else {
                            if (suhu_tubuh < 36 || suhu_tubuh > 38) {
                                notifSend(
                                    kd_dokter,
                                    'Notifikasi Kondisi Pasien',
                                    'Suhu tubuh ' + suhu_tubuh + '°, pasien atas nama : ' + nm_pasien,
                                    no_rawat,
                                    'Ranap',
                                    'detail'
                                );
                            }
                        }

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
                    }

                },
                error: function(request, status, error) {
                    alertErrorAjax(request)
                }
            })
        });

        $('#modalGrafikHarian').on('hidden.bs.modal', function() {
            clearFormGrafikHarian();

            $('#formSaveGrafikHarian input[name="action"]').remove();
            $('#formSaveGrafikHarian input[name="tgl_perawatan"]').remove();
            $('#formSaveGrafikHarian input[name="jam_rawat"]').remove();

            // reset data-*
            $('#formSaveGrafikHarian #kdDokter').attr('data-kd-dokter', '');
            $('#formSaveGrafikHarian #spesialisSpesialis').attr('data-spesialis', '');
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
