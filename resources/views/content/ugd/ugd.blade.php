@extends('index')
@section('contents')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Pasien UGD
                </div>
                <div class="card-body">
                    <form action="" id="formFilterUgd">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-sm-12">
                                <label for="tgl_registrasi" class="form-label" style="font-size: 12px;margin-bottom:0px">Periode</label>
                                <div class="input-group input-group-sm input-daterange">
                                    <input type="text" class="form-control form-control-sm tgl_awal" style="font-size:12px">
                                    <div class="input-group-text">ke</div>
                                    <input type="text" class="form-control form-control-sm tgl_akhir" style="font-size:12px">
                                    <button class="btn btn-success btn-sm" type="button" id="btn-filter-tgl"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                            @if (session()->get('pegawai')->jnj_jabatan != 'DIRU' && session()->get('pegawai')->bidang != 'Spesialis')
                                <div class="col-md-6 col-lg-3 col-sm-12">
                                    <label for="" style="font-size: 12px;margin-bottom:0px">Spesialis</label>
                                    <select name="spesialis" id="spesialis" class="form-select form-select-sm">
                                        <option value="">Semua</option>
                                        <option value="S0007">Spesialis Umum</option>
                                        <option value="S0003">Spesialis Anak</option>
                                        <option value="S0001">Spesialis Kandungan & Kebidanan</option>
                                    </select>
                                </div>
                                <input type="hidden" value="" name="kd_dokter">
                            @else
                                <input type="hidden" value="{{ session()->get('pegawai')->nik }}" name="kd_dokter">
                            @endif
                        </div>
                    </form>
                </div>
                <div class="container">
                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_ugd" width="100%">
                        <thead>
                            <tr role="row">
                                <th width="100px" style="text-align: center"></th>
                                <th>Pasien</th>
                                <th>Dokter DPJP</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('content.ugd.modal.pemeriksaan')
    @include('content.ugd.modal.asmed')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.ranap.modal.modal_lab')
@endsection


@push('script')
    <script type="text/javascript">
        var tgl_awal = '';
        var tgl_akhir = '';
        var nm_pasien = '';
        var dokter = '';
        var spesialis = '';
        var tableUdg = '';
        var dateStart = '';
        var sel = '';
        var getInstance = '';

        $(document).ready(() => {
            new bootstrap.Tab('#tab-resep')
            new bootstrap.Tab('#tab-ews')
            new bootstrap.Tab('#tab-tabel')

            sel = document.querySelector('#tab-tabel')
            getInstance = bootstrap.Tab.getInstance(sel);

            dokter = $('#formFilterUgd input[name=kd_dokter]').val();
            nm_pasien = localStorage.getItem('nm_pasien') ? localStorage.getItem('nm_pasien') : '';
            spesialis = localStorage.getItem('spesialis') ? localStorage.getItem('spesialis') : '';
            $('#cari-pasien').val(nm_pasien)
            $('#spesialis option[value="' + spesialis + '"]').prop('selected', true);
            date = new Date()
            hari = ('0' + (date.getDate())).slice(-2);
            bulan = ('0' + (date.getMonth() + 1)).slice(-2);
            tahun = date.getFullYear();
            dateStart = hari + '-' + bulan + '-' + tahun;
            let t1 = ''
            let t2 = ''
            tgl_awal = localStorage.getItem('tgl_awal') ? localStorage.getItem('tgl_awal') : splitTanggal(dateStart)
            tgl_akhir = localStorage.getItem('tgl_akhir') ? localStorage.getItem('tgl_akhir') : splitTanggal(dateStart)
            $('.tgl_awal').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
                setDate: 0,
                todayBtn: true,

            })

            $('.tgl_akhir').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                autoclose: true,
                todayHighlight: true,
                startDate: 0,
                todayBtn: true,
            })

            tbUgd()
            setInterval(() => {
                tbUgd()
                toastReload('Memperbaharui data pasien UGD', 2000)
            }, 20000);

            $('.tgl_awal').datepicker('setDate', splitTanggal(tgl_awal))
            $('.tgl_akhir').datepicker('setDate', splitTanggal(tgl_akhir))

        })
        $('#spesialis').on('change', () => {
            spesialis = $('#spesialis option:selected').val()
            localStorage.setItem('spesialis', spesialis);

            tbUgd()
        })
        $('#btn-filter-tgl').on('click', () => {
            t1 = $('.tgl_awal').datepicker('getFormattedDate')
            t2 = $('.tgl_akhir').datepicker('getFormattedDate')
            tgl_awal = splitTanggal(t1);
            tgl_akhir = splitTanggal(t2);
            localStorage.setItem('tgl_awal', tgl_awal)
            localStorage.setItem('tgl_akhir', tgl_akhir)

            tbUgd()
        })

        function tbUgd() {
            tableUdg = $('#tb_ugd').DataTable({
                destroy: true,
                processing: true,
                scrollX: true,
                scrollY: 400,
                stateSave: true,
                ordering: true,
                paging: false,
                info: false,
                searching: true,
                ajax: {
                    url: "/erm/ugd/get/table",
                    data: {
                        tgl_awal: tgl_awal,
                        tgl_akhir: tgl_akhir,
                        nm_pasien: nm_pasien,
                        spesialis: spesialis,
                        kd_dokter: dokter,
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
                        } else {
                            alertAjaxError(request)
                        }
                    },
                },
                initComplete: function() {
                    toastReload('Menampilkan data pasien UGD', 2000)
                },
                columns: [{
                        data: '',
                        render: function(data, type, row, meta) {
                            list = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalSoapUgd(\'' + row.no_rawat + '\')">CPPT</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang('${row.no_rawat}')">Pemeriksaan Penunjang</a></li>`
                            list += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAsmedUgd(\'' + row.no_rawat + '\')">Asesmen Medis UGD</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="detailPeriksa('${row.no_rawat}', 'Ralan')">Upload Berkas Penunjang</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${row.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${row.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayatV2" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan 2</a></li>`;
                            button = '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:12px;width:80px;margin-left:15px">Aksi</button><ul class="dropdown-menu" style="font-size:12px">' + list + '</ul></div>'
                            return button;
                        }
                    },
                    {
                        data: 'pasien',
                        render: (data, type, row, meta) => {
                            let penjab = '';
                            if (row.penjab.kd_pj == 'A03') {
                                penjab = `<span class="text-danger"><b>${row.penjab.png_jawab}</b></span>`
                            } else if (row.penjab.kd_pj == 'A01' || row.penjab.kd_pj == 'A05') {
                                penjab = `<span class="text-success"><b>${row.penjab.png_jawab}</b></span>`
                            }
                            kamarInap = Object.keys(row.kamar_inap).length ? `<span class="badge text-bg-success">Pindah Kamar</span>` : '';
                            return `${row.no_rawat} <br/> <strong>${row.pasien.nm_pasien} (${row.umurdaftar} ${row.sttsumur})</strong> 
                            <br/> ${penjab} <br/> ${kamarInap}`
                        }
                    },
                    {
                        data: 'dokter',
                        render: (data, type, row, meta) => {

                            return row.dokter.nm_dokter;
                        }
                    },
                    {
                        data: 'kamar',
                        render: (data, type, row, meta) => {
                            if (Object.keys(row.kamar_inap).length > 0) {
                                return '<button type="button" class="btn btn-danger btn-sm">Rawat Inap</button>';
                            } else {
                                return '<button type="button" class="btn btn-warning btn-sm">Rawat Jalan</button>';

                            }
                        }
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                    "search": "Cari Nama Pasien",
                }
            })
        }
        $('#cari-pasien').on('search', () => {
            const nama = $('#cari-pasien').val()
            if (nama.length == 0) {
                localStorage.removeItem('nm_pasien', nm_pasien)
                nm_pasien = '';
                $('#tb_ugd').DataTable().destroy()
                tbUgd();
            }
        })

        function listRiwayatPasien(no_rkm_medis) {
            $('#navTabRiwayat').empty()
            $('.tabListRiwayat').empty()
            $('.content-riwayat').empty()
            getRiwayatPasien(no_rkm_medis, 'DESC').done((riwayat) => {
                let tabList = '';
                let infoPasien = '';
                let no_rawat = '';
                riwayat.reg_periksa.map((regPeriksa, index) => {
                    if (index == 0) {
                        active = 'active';
                        collapse = 'show active';
                        setDetailRawat(regPeriksa.no_rawat)
                    } else {
                        active = '';
                        collapse = '';
                    }
                    tabNav = `<li class="nav-item list">
                        <a class="nav-link link-riwayat ${active}" aria-current="page" href="#" onclick="setDetailRawat('${regPeriksa.no_rawat}', this)">${regPeriksa.status_lanjut.toUpperCase() } : ${splitTanggal(regPeriksa.tgl_registrasi)} </a>
                        </li>`;
                    $('#navTabRiwayat').append(tabNav)
                })
                setNavTabsTitle()
                $('.tabListRiwayat').append(tabList)
            })
        }

        function setDetailRawat(no_rawat, e) {
            $('button[data-bs-target="#nav-pemeriksaan"]').tab('show')
            $('.link-riwayat').removeClass('active')
            $(e).addClass('active')
            $('.content-riwayat').empty()
            let diagnosaPasien = '';
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                console.log('REG PERIKSA===', regPeriksa);
                // status lanjut pasien
                if (regPeriksa.status_lanjut == 'Ralan') {
                    $('#nav-resume-tab').hide()
                    $('#nav-asmed-ranap-tab').hide()
                    $('#nav-askep-ranap-tab').hide()
                    $('#nav-asmed-rajal-tab').show()
                    $('#nav-askep-rajal-tab').show()
                    status_lanjut = 'Rawat Jalan';
                    cardBg = 'text-bg-warning';
                    $('.header-riwayat').removeClass('bg-purple')
                } else {
                    $('#nav-asmed-rajal-tab').hide()
                    $('#nav-askep-rajal-tab').hide()
                    $('#nav-asmed-ranap-tab').show()
                    $('#nav-askep-ranap-tab').show()
                    $('#nav-resume-tab').show()
                    status_lanjut = 'Rawat Inap';
                    cardBg = 'bg-purple';
                    $('.header-riwayat').removeClass('text-bg-warning')
                }

                // status spesialisasi
                if (regPeriksa.dokter.kd_sps == 'S0003') {
                    // asmed & askep rawat jalan

                    // asmed & askep rawat inap
                    $('#nav-asesmen-rajal-tab').attr('onclick', `setRiwayatAsesmenAnakRajal('${no_rawat}')`);
                    $('#nav-asesmen-ranap-tab').attr('onclick', `setRiwayatAsesmenAnakRanap('${no_rawat}')`)
                }
                $('.header-riwayat h6').html(status_lanjut)
                $('.header-riwayat').addClass(cardBg)
                $('#nav-resume-tab').attr('onclick', `setResumeMedis('${no_rawat}')`)
                const infoPasien = `<div class="card position-relative">
                                <div class="card-header">
                                    <span>Informasi Registrasi</span>
                                    <a class="position-absolute top-0 end-0 me-2 mt-2" style="color:#000" data-bs-toggle="collapse" href="#collapseInfo" role="button" aria-expanded="false" aria-controls="collapseInfo"><i class="bi bi-x"></i></a>
                                    </div>
                                    <div class="card-body collapse show" id="collapseInfo">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <table class="table table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <th width="25%">Tgl. Registrasi</th>
                                                        <td>:</td>
                                                        <td>${formatTanggal(regPeriksa.tgl_registrasi)} ${regPeriksa.jam_reg}</td>
                                                    </tr>    
                                                    <tr>
                                                        <th>No Rawat</th>
                                                        <td>:</td>
                                                        <td>${regPeriksa.no_rawat}</td>
                                                    </tr>    
                                                    <tr>
                                                        <th>Nama (No. RM)</th>
                                                        <td>:</td>
                                                        <td>${regPeriksa.pasien.nm_pasien} (${regPeriksa.no_rkm_medis})</td>
                                                    </tr>    
                                                </table>    
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <table class="table table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <th width="25%">Unit / Poliklinik</th>
                                                        <td>:</td>
                                                        <td>${regPeriksa.poliklinik.nm_poli}</td>
                                                    </tr>    
                                                    <tr>
                                                        <th>Dokter</th>
                                                        <td>:</td>
                                                        <td>${regPeriksa.dokter.nm_dokter}</td>
                                                    </tr>    
                                                    <tr>
                                                        <th>Cara Bayar</th>
                                                        <td>:</td>
                                                        <td>${regPeriksa.penjab.png_jawab}</td>
                                                    </tr>  
                                                </table>    
                                            </div>
                                        </div>
                                    </div>
                                </div>`;


                $('#info').append(infoPasien).hide().fadeIn()
                setDiagnosaPasien(no_rawat);
                setRiwayatPemeriksaanRalan(no_rawat, regPeriksa.kd_poli);
                setRiwayatPemeriksaanRanap(no_rawat)
                setRiwayatObat(no_rawat)
                setRiwayatLaborat(no_rawat)
                setRiwayatRadiologi(no_rawat)
                setNavTabsTitle()
            })
        }


        function setDiagnosaPasien(no_rawat) {
            const cardDxPx = $('#dxpxPasien');
            const cardDiagnosa = $('#cardDiagnosaPasien');
            const cardProsedur = $('#cardProsedurPasien');
            const bodyCardDiagnosa = $('#bodyDiagnosaPasien');
            const bodyCardProsedur = $('#bodyProsedurPasien');
            let listDiagnosa = '';
            let listProsedur = '';
            bodyCardDiagnosa.empty()
            bodyCardProsedur.empty()
            cardDiagnosa.hide();
            cardProsedur.hide();
            cardDxPx.hide();
            getDiagnosaPasien(no_rawat).done((diagnosa, index) => {
                if (diagnosa.length) {
                    cardDxPx.show();
                    cardDiagnosa.show()
                    listDiagnosa += '<ol class="px-3 m-0">'
                    diagnosa.map((dx, index) => {
                        listDiagnosa += `<li ${dx.prioritas == 1 ? 'style="font-weight:bold;"':''}> ${dx.kd_penyakit} - ${dx.penyakit.nm_penyakit} ${dx.prioritas == 1 ? '<span class="text-danger">(*)</span>':''}</li>`
                    })
                    listDiagnosa += '</ol>'
                    bodyCardDiagnosa.append(listDiagnosa).hide().fadeIn();
                }
            })

            getProsedurPasien(no_rawat).done((prosedur) => {
                if (prosedur.length) {
                    cardDxPx.show();
                    cardProsedur.show()
                    listProsedur += '<ol class="px-3 m-0">'
                    prosedur.map((px, index) => {
                        listProsedur += `<li ${px.prioritas == 1 ? 'style="font-weight:bold;"':''}> ${px.kode} - ${px.icd9.deskripsi_panjang} ${px.prioritas == 1 ? '<span class="text-danger">(*)</span>':''}</li>`
                    })
                    listProsedur += '</ol>'
                    bodyCardProsedur.append(listProsedur).hide().fadeIn();
                }

            })
        }

        function setRiwayatPemeriksaanRanap(no_rawat) {
            const cardRiwayatPemeriksaanRanap = document.getElementById('periksaRawatInap');
            const bodyCardPemeriksaanRanap = document.getElementById('collapsePemeriksaanRanap')
            cardRiwayatPemeriksaanRanap.style.display = 'none';
            getPemeriksaanRanap(no_rawat).done((periksa) => {
                if (periksa.length) {
                    cardRiwayatPemeriksaanRanap.style.display = 'inline';
                    periksa.map((pemeriksaan, index) => {
                        const listPemeriksaan = `<div class="row">

                                    <div class="col-md-6 col-lg-5 col-sm-12 mb-1">
                                        <div class="card">
                                            <div class="card-header">
                                                Tanggal : ${formatTanggal(pemeriksaan.tgl_perawatan)} ${pemeriksaan.jam_rawat}
                                            </div>
                                            <div class="card-body">
                                                <table class="table borderless table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                        <tr>
                                                            <th width="20%">Tinggi</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.tinggi} cm</td>
                                                            <th width="10%">Berat</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.berat} Kg</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="20%">Suhu</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.suhu_tubuh} °C</td>
                                                            <th width="10%">Tensi</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.tensi} mmHG</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="10%">Kesadaran</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.kesadaran}</td>
                                                            <th width="10%">GCS</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.gcs} E,V,M</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="10%">Respirasi</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.respirasi} x/menit</td>
                                                            <th width="10%">Nadi</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.nadi} x/menit</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="10%">SpO2</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.spo2} %</td>
                                                            <th width="10%">Alergi</th>
                                                            <td>:</td>
                                                            <td>${pemeriksaan.alergi}</td>
                                                        </tr>     
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-7 col-sm-12 mb-1">
                                        <div class="card">
                                            <div class="card-header">
                                                Petugas : ${pemeriksaan.petugas.nama}
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-sm table-responsive borderless" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                        <th width="20%">Subyek</th>
                                                        <td>:</td>
                                                        <td>${stringPemeriksaan(pemeriksaan.keluhan)}</td>
                                                    </tr>     
                                                    <tr>
                                                        <th width="20%">Obyek</th>
                                                        <td>:</td>
                                                        <td>${stringPemeriksaan(pemeriksaan.pemeriksaan)}</td>
                                                    </tr>     
                                                    <tr>
                                                        <th width="20%">Asesmen</th>
                                                        <td>:</td>
                                                        <td>${stringPemeriksaan(pemeriksaan.penilaian)}</td>
                                                    </tr>     
                                                    <tr>
                                                        <th width="20%">Plan</th>
                                                        <td>:</td>
                                                        <td>${stringPemeriksaan(pemeriksaan.rtl)}</td>
                                                    </tr>     
                                                    <tr>
                                                        <th width="20%">Instruksi</th>
                                                        <td>:</td>
                                                        <td>${stringPemeriksaan(pemeriksaan.instruksi)}</td>
                                                    </tr>     
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        bodyCardPemeriksaanRanap.innerHTML += listPemeriksaan
                    })
                }
            })
        }

        function setRiwayatPemeriksaanRalan(no_rawat, kd_poli) {
            const cardRiwayatPemeriksaanRajal = document.getElementById('periksaRawatJalan');
            const bodyCardRiwayatPemeriksaanRajal = document.getElementById('collapsePemeriksaanRajal')
            bodyCardRiwayatPemeriksaanRajal.innerHTML = '';
            cardRiwayatPemeriksaanRajal.style.display = 'none'
            getPemeriksaanPoli(no_rawat, kd_poli).done((pemeriksaan) => {
                if (pemeriksaan.length) {
                    cardRiwayatPemeriksaanRajal.style.display = 'inline'
                    // cardRiwayatPemeriksaanRajal.show()
                    // cardRiwayatPemeriksaanRajal.css('display', '')
                    pemeriksaan.map((periksa, index) => {
                        const listPemeriksaan = `<div class="row">
                                        <div class="col-md-6 col-lg-5 col-sm-12 mb-1">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table borderless table-sm table-responsive" cellpadding="5" cellspacing="0">
                                                            <thead style="height:50px">
                                                                <tr class="borderless">
                                                                    <th width="20%">Petugas</th>
                                                                    <td>:</td>
                                                                    <td colspan=4>${periksa.pegawai?.nama}</td>
                                                                </tr>     
                                                                <tr style="height:50px">
                                                                    <th width="20%">TanggaL</th>
                                                                    <td>:</td>
                                                                    <td colspan=4>${formatTanggal(periksa.tgl_perawatan)} ${periksa.jam_rawat}</td>
                                                                </tr>     
                                                            </thead>

                                                            <tr>
                                                                <th width="20%">Tinggi</th>
                                                                <td>:</td>
                                                                <td>${periksa.tinggi} cm</td>
                                                                <th width="10%">Berat</th>
                                                                <td>:</td>
                                                                <td>${periksa.berat} Kg</td>
                                                            </tr>     
                                                            <tr>
                                                                <th width="20%">Suhu</th>
                                                                <td>:</td>
                                                                <td>${periksa.suhu_tubuh} °C</td>
                                                                <th width="10%">Tensi</th>
                                                                <td>:</td>
                                                                <td>${periksa.tensi} mmHG</td>
                                                            </tr>     
                                                            <tr>
                                                                <th width="10%">Kesadaran</th>
                                                                <td>:</td>
                                                                <td>${periksa.kesadaran}</td>
                                                                <th width="10%">GCS</th>
                                                                <td>:</td>
                                                                <td>${periksa.gcs} E,V,M</td>
                                                            </tr>     
                                                            <tr>
                                                                <th width="10%">Respirasi</th>
                                                                <td>:</td>
                                                                <td>${periksa.respirasi} x/menit</td>
                                                                <th width="10%">Nadi</th>
                                                                <td>:</td>
                                                                <td>${periksa.nadi} x/menit</td>
                                                            </tr>     
                                                            <tr>
                                                                <th width="10%">SpO2</th>
                                                                <td>:</td>
                                                                <td>${periksa.spo2} %</td>
                                                                <th width="10%">Alergi</th>
                                                                <td>:</td>
                                                                <td>${periksa.alergi}</td>
                                                            </tr>     
                                                        </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-7 col-sm-12 mb-1">
                                            <div class="card">
                                                <div class="card-body">
                                                    <table class="table table-sm table-responsive borderless" cellpadding="5" cellspacing="0">
                                                        <tr>
                                                            <th width="20%">Subyek</th>
                                                            <td>:</td>
                                                            <td>${stringPemeriksaan(periksa.keluhan)}</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="20%">Obyek</th>
                                                            <td>:</td>
                                                            <td>${stringPemeriksaan(periksa.pemeriksaan)}</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="20%">Asesmen</th>
                                                            <td>:</td>
                                                            <td>${stringPemeriksaan(periksa.penilaian)}</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="20%">Plan</th>
                                                            <td>:</td>
                                                            <td>${stringPemeriksaan(periksa.rtl)}</td>
                                                        </tr>     
                                                        <tr>
                                                            <th width="20%">Instruksi</th>
                                                            <td>:</td>
                                                            <td>${stringPemeriksaan(periksa.instruksi)}</td>
                                                        </tr>     
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        bodyCardRiwayatPemeriksaanRajal.innerHTML += listPemeriksaan;
                    })
                }
            })
        }

        function setRiwayatObat(no_rawat) {
            const cardRiwayatObat = document.getElementById('obat')
            const bodyCardPemberianObat = document.getElementById('collapsePemberianObat')
            let obat = {}
            const groupPemberian = {}
            let listPemberianObat = '';
            $('#obat').hide();
            getPemberianObat(no_rawat).done((pemberian) => {
                if (Object.keys(pemberian).length) {
                    pemberian.map(beri => {
                        const key = `${beri.tgl_perawatan} ${beri.jam}`
                        if (!groupPemberian[key]) {
                            groupPemberian[key] = [];
                        }
                        groupPemberian[key].push(beri)
                    })
                    const resultGroup = Object.values(groupPemberian);
                    const keysGroup = Object.keys(groupPemberian);

                    listPemberianObat += '<div class="row">';
                    resultGroup.forEach((obat, index) => {
                        const tglPemberian = splitTanggal(keysGroup[index].split(' ')[0])
                        const jamPemberian = keysGroup[index].split(' ')[1]
                        listPemberianObat += `<div class="col-md-12 col-lg-12 col-sm-12">
                                                <div class="card position-relative mt-2">
                                                    <div class="card-header">
                                                        Tanggal : ${tglPemberian} ${jamPemberian} 
                                                    </div>
                                                    <div class="card-body">
                                                    <table class="table table-responsive">
                                                        <tr>
                                                            <th width="30%">
                                                            Obat 
                                                            </th>
                                                            <th width="10%">
                                                                Jumlah
                                                            </th>    
                                                            <th>
                                                                Aturan Pakai
                                                            </th>    
                                                        </tr>`;
                        obat.map((obs, index) => {
                            listPemberianObat += `<tr>
                                                    <td>
                                                        ${obs.databarang.nama_brng} 
                                                    </td>
                                                    <td>
                                                       ${obs.jml} ${obs.databarang.kode_satuan?.satuan}
                                                    </td>
                                                    <td>
                                                        ${obs.aturan_pakai ? obs.aturan_pakai.aturan : '' }
                                                    </td>
                                                </tr>`
                        })
                        listPemberianObat += `          </table>
                                                    </div> 
                                                    </div> 
                                            </div>`;
                    })
                    listPemberianObat += '</div>';
                    bodyCardPemberianObat.innerHTML = listPemberianObat;
                    $('#obat').show().fadeIn();
                }
            })
        }

        function setRiwayatLaborat(no_rawat) {
            const cardRiwayatObat = document.getElementById('hasilLab')
            const bodyCardHasilLab = document.getElementById('collapseHasilLab')
            const groupLab = {};
            let listHasilLab = '';
            getHasilLab(no_rawat).done((hasil) => {
                hasil.map((item, index) => {
                    const key = `${item.tgl_periksa} ${item.jam}`
                    if (!groupLab[key]) {
                        groupLab[key] = [];
                    }
                    groupLab[key].push(item)
                })

                const resultGroup = Object.values(groupLab)
                const keysGroup = Object.keys(groupLab)

                listHasilLab += `<div class="row">`;
                resultGroup.forEach((lab, index) => {
                    const tglPemberian = splitTanggal(keysGroup[index].split(' ')[0])
                    const jamPemberian = keysGroup[index].split(' ')[1]
                    listHasilLab += `<div class="col-md-12 col-lg-12 col-sm-12">
                                        <div class="card position-relative mt-2">
                                            <div class="card-header">
                                                <span>${tglPemberian} ${jamPemberian}</span>
                                            </div>
                                        <div class="card-body">
                                            <table class="table table-responsive">
                                                <tr>
                                                    <th width="30%">
                                                        Pemeriksaan 
                                                    </th>
                                                    <th width="30%">
                                                        Hasil
                                                    </th>    
                                                    <th>
                                                        Nilai Rujukan
                                                    </th>        
                                                </tr>`;
                    lab.map((item, index) => {
                        let jenisPemeriksaan = '';
                        if (item.kd_jenis_prw != lab[index + 1]?.kd_jenis_prw) {
                            jenisPemeriksaan = `<tr>
                                                    <td colspan=3>
                                                        <strong>${item.jns_perawatan_lab.nm_perawatan}</strong>
                                                        <br/><small>Petugas : ${item.periksa_lab.petugas.nama}</small>
                                                        </td>
                                                    </tr>`
                        }
                        listHasilLab += `${jenisPemeriksaan}
                                            <tr class="${item.keterangan === 'H' ? 'text-danger' : item.keterangan==='L' ? 'text-primary' : ''}">
                                                <td>
                                                    ${item.template.Pemeriksaan}
                                                </td>
                                                <td>
                                                    ${item.nilai} ${item.template.satuan} ${item.keterangan ? `(${item.keterangan})` : ''}
                                                </td>
                                                <td>
                                                    ${item.nilai_rujukan}
                                                </td>
                                            </tr>`
                    })
                    listHasilLab += `          </table>
                                            </div>
                                        </div>
                                    </div>  `;
                })
                bodyCardHasilLab.innerHTML = listHasilLab;
                $('#obat').show().fadeIn();
            })
        }

        function setRiwayatRadiologi(no_rawat) {
            const bodyRadiologi = document.getElementById('collapseHasilRadiologi')
            const cardRadiologi = document.getElementById('radiologi')
            $('#radiologi').hide();
            getPeriksaRadiologi(no_rawat).done((periksa) => {
                let listHasilRadiologi = '';
                if (Object.keys(periksa).length) {
                    let hasilRadiologi = '';
                    let diagnosaKlinis = '';
                    let informasiTambahan = '';
                    periksa.map((radiologi) => {
                        listHasilRadiologi += `<div class="row">`;
                        let gambar = '';
                        radiologi.gambar_radiologi.map((img, index) => {
                            if (img.tgl_periksa == radiologi.tgl_periksa && img.jam == radiologi.jam) {
                                gambar += `<a data-magnify="gallery" data-src=""  data-group="a" href="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}">
                                        <img src="https://sim.rsiaaisyiyah.com/webapps/radiologi/${img.lokasi_gambar}" class="img-thumbnail position-relative" width="100%">
                                    </a>`
                            }
                            listHasilRadiologi += `<div class="col-sm-12 col-md-6 col-lg-4">
                                                ${gambar}
                                            </div>`;
                        })

                        radiologi.permintaan.map((permintaan, index) => {
                            if (permintaan.tgl_hasil == radiologi.tgl_periksa && permintaan.jam_hasil == radiologi.jam) {
                                diagnosaKlinis = permintaan.diagnosa_klinis;
                                informasiTambahan = permintaan.informasi_tambahan;
                            }
                        })

                        radiologi.hasil_radiologi.map((hasil, index) => {
                            if (hasil.tgl_periksa == radiologi.tgl_periksa && hasil.jam == radiologi.jam) {
                                hasilRadiologi = hasil.hasil
                            }
                            listHasilRadiologi += `<div class="col-sm-12 col-md-6 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table borderless table-responsive text-sm">
                                        <tr>
                                            <th>Tanggal</th>    
                                            <td>:</td>    
                                            <td>${formatTanggal(hasil.tgl_periksa)} ${hasil.jam}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Dokter</th>    
                                            <td>:</td>    
                                            <td>${radiologi.dokter.nm_dokter}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Petugas</th>    
                                            <td>:</td>    
                                            <td>${radiologi.petugas.nama}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Pemeriksaan</th>    
                                            <td>:</td>    
                                            <td>${radiologi.jns_perawatan.nm_perawatan}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Diagnosa Klinis</th>    
                                            <td>:</td>    
                                            <td>${diagnosaKlinis}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Informasi Tambahan</th>    
                                            <td>:</td>    
                                            <td>${informasiTambahan}</td>    
                                        </tr>    
                                        <tr>
                                            <th>Hasil</th>    
                                            <td>:</td>    
                                            <td>${stringPemeriksaan(hasilRadiologi)}</td>    
                                        </tr>    
                                    </table>
                                </div>
                            </div>
                        </div>`;
                        })
                        listHasilRadiologi += '</div>';
                    })
                    bodyRadiologi.innerHTML = listHasilRadiologi;
                    $('#radiologi').show().fadeIn();
                }
            })
        }

        function setResumeMedis(no_rawat) {
            const bodyInfoLeft = $('#resume-info-left')
            const bodyInfoRight = $('#resume-info-right')
            const bodyContent = $('#resume-content')
            const cardResumeMedis = $('#resumeMedis')
            bodyInfoLeft.empty();
            bodyInfoRight.empty();
            bodyContent.empty();
            cardResumeMedis.hide()
            getResumeMedis(no_rawat).done((resume) => {
                if (Object.keys(resume).length) {
                    cardResumeMedis.css('display', 'flex')
                    const regPeriksa = resume.reg_periksa;
                    const kamarInap = resume.bayi_gabung ? resume.bayi_gabung.kamar_ibu[0] : regPeriksa.kamar_inap[0];
                    const infoLeft = `<table class="table table-sm table-responsive borderless">
                        <tr>
                            <th>No. Rawat</th>    
                            <td width=2%>:</td>    
                            <td>${regPeriksa.no_rawat}</td>    
                        </tr>            
                        <tr>
                            <th>Pasien / Umur</th>    
                            <td width=2%>:</td>    
                            <td>${regPeriksa.no_rkm_medis} - ${regPeriksa.pasien.nm_pasien} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}</td>    
                        </tr>            
                        <tr>
                            <th>Tanggal Masuk</th>    
                            <td width=2%>:</td>    
                            <td>${regPeriksa.tgl_registrasi}, Jam : ${regPeriksa.jam_reg}</td>    
                        </tr>            
                        <tr>
                            <th>Tanggal Keluar</th>    
                            <td width=2%>:</td>    
                            <td>${kamarInap.tgl_keluar}, Jam : ${kamarInap.jam_keluar}</td>    
                        </tr>  
                        <tr>
                            <th>Kamar / Lama</th>    
                            <td width=2%>:</td>    
                            <td>${kamarInap.kamar.bangsal.nm_bangsal}  / ${kamarInap.lama} Hari</td>    
                        </tr>            
                        <table>`

                    const infoRight = `
                    <table class="table table-responsive borderless">
                        <tr>
                            <th>Masuk Dari</th>    
                            <td width=2%>:</td>    
                            <td>${regPeriksa.poliklinik.nm_poli}</td>    
                        </tr>            
                        <tr>
                            <th>Cara Bayar</th>    
                            <td width=2%>:</td>    
                            <td>${regPeriksa.penjab.png_jawab}</td>    
                        </tr>            
                        <tr>
                            <th>Diagnosa Awal</th>    
                            <td width=2%>:</td>    
                            <td>${resume.diagnosa_awal}</td>    
                        </tr>            
                        <tr>
                            <th>Indikasi Medis</th>    
                            <td width=2%>:</td>    
                            <td>${resume.alasan}</td>    
                        </tr>            
                        <tr>
                            <th>Dokter Dpjp</th>    
                            <td width=2%>:</td>    
                            <td>${resume.dokter.nm_dokter}</td>    
                        </tr>  
                    <table>
                    `;

                    const resumeContent = `
                    <table class="table table-responsive">
                        <tr>
                            <td colspan=2>
                                <strong>ANAMNESIS</strong><br/>
                                ${stringPemeriksaan(resume.keluhan_utama)}
                            </td>    
                        </tr>            
                        <tr>
                            <td colspan=2>
                                <strong>PEMERIKSAAN FISIK</strong><br/>
                                ${stringPemeriksaan(resume.pemeriksaan_fisik)}
                            </td>    
                        </tr>            
                        <tr>
                            <td colspan=2>
                                <strong>PEMERIKSAAN PENUNJANG</strong><br/>
                                ${stringPemeriksaan(resume.pemeriksaan_penunjang)}
                            </td>    
                        </tr>            
                        <tr>
                            <td colspan=2>
                                <strong>PEMERIKSAAN LABORAT</strong><br/>
                                ${stringPemeriksaan(resume.hasil_laborat)}
                            </td>    
                        </tr>            
                        <tr>
                            <td colspan=2>
                                <strong>DIAGNOSA AKHIR</strong><br/>
                            </td>    
                        </tr>            
                        <tr class="">
                            <td>
                                <strong>DIAGNOSA UTAMA</strong><br/>
                                (*) ${resume.diagnosa_utama}
                            </td>    
                            <td>
                                <strong>KODE ICD</strong><br/>
                            </td>    
                        </tr>            
                        <tr>
                            <td>
                                <strong>DIAGNOSA SKUNDER</strong>
                                <ol class="px-3 m-0">
                                    <li>${resume.diagnosa_sekunder}</li>    
                                    <li>${resume.diagnosa_sekunder2}</li>    
                                    <li>${resume.diagnosa_sekunder3}</li>    
                                    <li>${resume.diagnosa_sekunder4}</li>    
                                    <li>${resume.diagnosa_sekunder5}</li>    
                                    <li>${resume.diagnosa_sekunder6}</li>    
                                    <li>${resume.diagnosa_sekunder7}</li>    
                                </ol>
                            </td>    
                            <td>
                                <strong>KODE ICD</strong>
                                <ol class="px-2 m-0" style="list-style:none">
                                    <li>${resume.kd_diagnosa_sekunder}</li>    
                                    <li>${resume.kd_diagnosa_sekunder2}</li>    
                                    <li>${resume.kd_diagnosa_sekunder3}</li>    
                                    <li>${resume.kd_diagnosa_sekunder4}</li>    
                                    <li>${resume.kd_diagnosa_sekunder5}</li>    
                                    <li>${resume.kd_diagnosa_sekunder6}</li>    
                                    <li>${resume.kd_diagnosa_sekunder7}</li>
                                </ol>
                            </td>    
                        </tr>         
                        <tr>
                        <th colspan=2>TINDAKAN OPERASI</th>    
                        </tr>         
                        <tr>
                            <td>
                                <strong>TINDAKAN UTAMA</strong><br/>
                                (*) ${resume.prosedur_utama}
                            </td>    
                            <td>
                                <strong>KODE ICD</strong>
                                ${resume.kd_prosedur_utama}
                            </td>    
                        </tr>   
                        <tr>
                            <td>
                                <strong>TINDAKAN SKUNDER</strong><br/>
                                <ol class="px-3 m-0">
                                    <li>${resume.prosedur_sekunder}</li>    
                                    <li>${resume.prosedur_sekunder2}</li>    
                                    <li>${resume.prosedur_sekunder3}</li>    
                                <ol>
                            </td>    
                            <td>
                                <strong>KODE ICD</strong><br/>
                                <ol class="px-2 m-0" style="list-style:none">
                                    <li>${resume.kd_prosedur_sekunder}</li>    
                                    <li>${resume.kd_prosedur_sekunder2}</li>    
                                    <li>${resume.kd_prosedur_sekunder3}</li>    
                                <ol>
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>PEMERIKSAAN PENUNJANG</strong><br/>
                               ${resume.pemeriksaan_penunjang}
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>OBAT SELAMA PERAWATAN</strong><br/>
                               ${resume.obat_di_rs}
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>KONDISI PULANG & PROGNOSIS</strong><br/>
                               ${resume.keadaan} - ${resume.ket_keadaan}
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>OBAT PULANG</strong><br/>
                               ${resume.obat_pulang}
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>SHK</strong><br/>
                               ${resume.shk ? resume.shk : '-' }, Keterangan : ${resume.shk_keterangan} 
                            </td>    
                        </tr>   
                        <tr>
                            <td colspan=2>
                               <strong>INSTRUKSI & TINDAK LANJUT</strong><br/>
                               ${resume.dilanjutkan} : ${resume.ket_dilanjutkan}, Tanggal : ${formatTanggal(resume.kontrol.split(" ")[0])}
                            </td>    
                        </tr>   
                    <table>`

                    bodyInfoLeft.append(infoLeft).hide().fadeIn()
                    bodyInfoRight.append(infoRight).hide().fadeIn()
                    bodyContent.append(resumeContent).hide().fadeIn()
                }
            })
        }

        function setRiwayatAsesmenAnakRanap(no_rawat) {
            const cardAsmedAnak = $('#riwayatAsmedAnak')
            const cardAskepAnak = $('#riwayatAskepAnak')
            const bodyAsmedAnak = $('#collapseAsmedAnak')
            const bodyInfoAsmedAnak = $('#infoAsmedAnak')
            const bodyContentAsmedAnak = $('#contenAsmedAnak')
            const bodyInfoAskepAnak = $('#infoAskepAnak')
            const bodyContentAskepAnak = $('#contenAskepAnak')

            cardAsmedAnak.hide()
            cardAskepAnak.hide()
            bodyInfoAsmedAnak.empty()
            bodyContentAsmedAnak.empty()
            bodyInfoAskepAnak.empty()
            bodyContentAskepAnak.empty()
            getAsmedRanapAnak(no_rawat).done((asmed) => {
                if (Object.keys(asmed).length) {
                    cardAsmedAnak.show()
                    const regPeriksa = asmed.reg_periksa;
                    const dokter = asmed.dokter;

                    let infoAsmed = `<div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th width="35%">No. Rawat</th><td width="2%">:</td><td>${no_rawat}</td>
                                </tr>    
                                <tr>
                                    <th>No. Rekam Medis</th><td>:</td><td>${regPeriksa.no_rkm_medis}</td>
                                </tr>    
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th width="35%">Nama / JK</th><td width="2%">:</td><td>${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})</td>
                                </tr>
                                <tr>
                                    <th>Umur / Tgl Lahir</th><td>:</td><td>${regPeriksa.umurdaftar} ${regPeriksa.sttsumur} / ${formatTanggal(regPeriksa.pasien.tgl_lahir)}</td>        
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th width="35%">Tgl Asesmen</th><td width="2%">:</td><td>${formatTanggal(asmed.tanggal.split(" ")[0])} ${asmed.tanggal.split(" ")[1]}</td>
                                </tr>
                                <tr>
                                    <th>Anamnesis</th><td>:</td><td>${asmed.anamnesis} (hub : ${asmed.hubungan})</td>        
                                </tr>
                            </table>
                        </div>
                    </div>`;

                    const riwayatKesehatan = `<div class="card mb-2">
                            <div class="card-header">1. Riwayat Kesehatan</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>KELUHAN</strong><br/>
                                            ${asmed.keluhan_utama}
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>RIWAYAT PENYAKIT SEKARANG</strong><br/>
                                            ${stringPemeriksaan(asmed.rps)}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>RIWAYAT PENYAKIT DAHULU</strong><br/>
                                            ${stringPemeriksaan(asmed.rpd)}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>RIWAYAT PENYAKIT DAHULU</strong><br/>
                                            ${stringPemeriksaan(asmed.rpk)}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>RIWAYAT PEMBERIAN OBAT</strong><br/>
                                            ${stringPemeriksaan(asmed.rpo)}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>RIWAYAT ALERGI</strong><br/>
                                            ${stringPemeriksaan(asmed.alergi)}
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>`

                    const pemeriksaanFisik = `<div class="card mb-2">
                            <div class="card-header">2. Pemeriksaan Fisik</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>Keadaan Umum</strong> : ${asmed.keadaan}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>Kesadaran</strong> : ${asmed.kesadaran}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                        <div class="card-text border-bottom border-1">
                                            <strong>GCS</strong> : ${asmed.gcs} E,V,M
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-12 col-md-12 mb-2">
                                        <div class="card-text border-bottom border-1 text-center">
                                            <strong>Tekanan Darah</strong> : ${asmed.td} mmHg,
                                            <strong>Nadi</strong> : ${asmed.nadi} x/menit,
                                            <strong>Respirasi</strong> : ${asmed.rr} x/menit,
                                            <strong>Suhu</strong> : ${asmed.suhu} °C,
                                            <strong>SpO2</strong> : ${asmed.spo} %,
                                            <strong>BB</strong> : ${asmed.bb} Kg,
                                            <strong>TB</strong> : ${asmed.tb} cm,
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                        <div class="card-text">
                                            <table class="table table-responsive borderless mb-0">
                                                <tr>
                                                    <td>Kepala</td><td>:</td><td>[ ${asmed.kepala} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Mata</td><td>:</td><td>[ ${asmed.mata} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Gigi & Mulut</td><td>:</td><td>[ ${asmed.gigi} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>THT</td><td>:</td><td>[ ${asmed.tht} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Thoraks</td><td>:</td><td>[ ${asmed.thoraks} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Jantung</td><td>:</td><td>[ ${asmed.jantung} ]</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                        <div class="card-text">
                                            <table class="table table-responsive borderless mb-0">
                                                <tr>
                                                    <td>Paru</td><td>:</td><td>[ ${asmed.paru} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Abdomen</td><td>:</td><td>[ ${asmed.abdomen} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Genital & Usus</td><td>:</td><td>[ ${asmed.genital} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Ekstrimitas</td><td>:</td><td>[ ${asmed.ekstremitas} ]</td>    
                                                </tr>
                                                <tr>
                                                    <td>Kulit</td><td>:</td><td>[ ${asmed.kulit} ]</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                        <div class="card-text">
                                            <strong>Keterangan Fisik : </strong><br/>
                                            ${asmed.ket_fisik}
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>`;

                    const statusLokalis = `<div class="card mb-2">
                        <div class="card-header">3. Status Lokalis</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <img class="img-thumbnail" src="{{ asset('/img/set-lokalis.jpg') }}"/>    
                                </div>    
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                     <strong>Keterangan Lokalis : </strong><br/>
                                    ${asmed.ket_lokalis}
                                </div>    
                            </div>    
                        </div>
                    </div>`;

                    const pemeriksaanPenunjang = `<div class="card mb-2">
                        <div class="card-header">4. Pemeriksaan Penunjang</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Laboratorium: </strong><br/>
                                   ${asmed.lab}
                                    
                                </div>    
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                     <strong>Radiologi : </strong><br/>
                                    ${asmed.rad}
                                </div>    
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                     <strong>Penunjang Lain : </strong><br/>
                                    ${asmed.penunjang}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    const diagnosis = `<div class="card mb-2">
                        <div class="card-header">5. Diagnosa</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                   ${asmed.diagnosis}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    const tataLaksana = `<div class="card mb-2">
                        <div class="card-header">6. Tata Laksana</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                  ${stringPemeriksaan(asmed.tata)}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    const edukasi = `<div class="card mb-2">
                        <div class="card-header">7. Edukasi</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                  ${stringPemeriksaan(asmed.edukasi)}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    const dibuatOleh = `<div class="card mb-2">
                        <div class="card-header">8. Dibuat Oleh</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                  <strong>${asmed.dokter.nm_dokter}</strong><br/>
                                  Pada ${formatTanggal(asmed.tanggal.split(" ")[0])} ${asmed.tanggal.split(" ")[1]}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    bodyInfoAsmedAnak.append(infoAsmed).hide().fadeIn()
                    bodyContentAsmedAnak.append([
                        riwayatKesehatan, pemeriksaanFisik, statusLokalis, pemeriksaanPenunjang, diagnosis, tataLaksana, edukasi, dibuatOleh
                    ]).hide().fadeIn()
                }
            })
            getAskepRanapAnak(no_rawat).done((askep) => {
                console.log('ASKEP ANAK ===', askep);
                if (Object.keys(askep).length) {
                    cardAskepAnak.show()
                    const regPeriksa = askep.reg_periksa
                    let infoAskep = `<div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th width="35%">No. Rawat</th><td width="2%">:</td><td>${no_rawat}</td>
                                </tr>    
                                <tr>
                                    <th>No. Rekam Medis</th><td>:</td><td>${regPeriksa.no_rkm_medis}</td>
                                </tr>    
                                <tr>
                                    <th width="35%">Nama / JK</th><td width="2%">:</td><td>${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})</td>
                                </tr>
                                <tr>
                                    <th>Umur / Tgl Lahir</th><td>:</td><td>${regPeriksa.umurdaftar} ${regPeriksa.sttsumur} / ${formatTanggal(regPeriksa.pasien.tgl_lahir)}</td>        
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th>Bahasa</th><td>:</td><td>${regPeriksa.pasien.bahasa.nama_bahasa }</td>        
                                </tr>
                                <tr>
                                    <th>Cara Masuk</th><td>:</td><td>${askep.cara_masuk}</td>        
                                </tr>
                                <tr>
                                    <th>Kasus</th><td>:</td><td>${askep.kasus_trauma}</td>        
                                </tr>
                                <tr>
                                    <th>Anamnesis</th><td>:</td><td>${askep.informasi} (hub : ${askep.ket_informasi})</td>        
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                                <tr>
                                    <th width="35%">Tgl Asesmen</th><td width="2%">:</td><td>${formatTanggal(askep.tanggal.split(" ")[0])} ${askep.tanggal.split(" ")[1]}</td>
                                </tr>
                                <tr>
                                    <th width="35%">Dokter DPJP</th><td width="2%">:</td><td>${askep.dokter.nm_dokter}</td>
                                </tr>
                                <tr>
                                    <th width="35%">Penkaji 1</th><td width="2%">:</td><td>${askep.pengkaji1.nama}</td>
                                </tr>
                                <tr>
                                    <th width="35%">Penkaji 2</th><td width="2%">:</td><td>${askep.pengkaji2.nama}</td>
                                </tr>
                            </table>
                        </div>
                    </div>`;

                    const riwayatKesehatan = `<div class="card">
                        <div class="card-header">1. DATA SUBYEKTIF</div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row m-1">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <p class=""><strong>RPS : </strong>${stringPemeriksaan(askep.rps)}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <p class=""><strong>RPD : </strong>${stringPemeriksaan(askep.rpd)}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <p class=""><strong>RPK : </strong>${stringPemeriksaan(askep.rpk)}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <p class=""><strong>RPO : </strong>${stringPemeriksaan(askep.rpo)}</p>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="card-text ">
                                            <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=30%>Riwayat Pembedahan</th><td width=2%>:</td><td>${askep.riwayat_pembedahan}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Alat Bantu yang Dipakai</th><td width=2%>:</td><td>${askep.alat_bantu_dipakai}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Riwayat Dirwat di RS</th><td width=2%>:</td><td>${askep.riwayat_dirawat_dirs}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Sedang Hami/Menyusui</th><td width=2%>:</td><td>${askep.riwayat_kehamilan}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Riwayat Tranfusi</th><td width=2%>:</td><td>${askep.riwayat_tranfusi}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Riwayat Alergi</th><td width=2%>:</td><td>${askep.riwayat_alergi}</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="card-text ">
                                            Kebiasaan Pasien :
                                            <ol style="list-style:none" class="mb-0">
                                                <li>Merokok : ${askep.riwayat_merokok} , Jumlah : ${askep.riwayat_merokok_jumlah} btg/hari</li>
                                                <li>Alkohol : ${askep.riwayat_alkohol}, Jumlah : ${askep.riwayat_alkohol_jumlah} sloki/hari</li>
                                                <li>Obat Tidur : ${askep.riwayat_narkoba}</li>
                                                <li>Olahraga : ${askep.riwayat_olahraga}</li>
                                            </ol>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="card-subtitle text-muted">Data Psikologis Sosial dan Kultural</div>
                                        <div class="card-text ">
                                            <ol style="list-style:none" class="mb-0">
                                                <li>Kondisi Psikologis : ${askep.riwayat_psiko_kondisi_psiko}</li>
                                                <li>Alkohol : ${askep.riwayat_alkohol}, Jumlah : ${askep.riwayat_alkohol_jumlah} sloki/hari</li>
                                                <li>Obat Tidur : ${askep.riwayat_narkoba}</li>
                                                <li>Olahraga : ${askep.riwayat_olahraga}</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                    bodyInfoAskepAnak.append(infoAskep).hide().fadeIn()
                    bodyContentAskepAnak.append(
                        [riwayatKesehatan]
                    ).hide().fadeIn()

                }
            })
        }


        function viewsAsmedAnak() {

        }

        function setNavTabsTitle() {
            const element = document.querySelector('ul.nav-tab-riwayat > li > a.active');
            $('.nav-brand').html(element.textContent)
        }


        function setListResep(noRawat) {
            return getResepByRawat(noRawat).done((resep) => {
                $('#tb-resep-umum-ugd tbody').empty()
                $('#tb-resep-racikan tbody').empty()
                let no_resep = '';
                $.map(resep, (res) => {
                    no_resep = resep.length ? res.no_resep : '';
                    if (res.resep_dokter.length) {
                        let no = 1;
                        $.map(res.resep_dokter, (rd) => {
                            html = `<tr class="obat-${no}">
                                    <td>${rd.no_resep}</td>
                                    <td>${rd.data_barang.nama_brng}</td>
                                    <td class="jml-${no}">${rd.jml}</td>
                                    <td class="aturan-${no}">${rd.aturan_pakai}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="hapusObatUmum('${rd.no_resep}', '${rd.kode_brng}')"><i class="bi bi-trash"></i></button>
                                        </td>
                                        </tr>`
                            no++;
                            $('#tb-resep-umum-ugd').append(html)
                        })
                    }

                    if (res.resep_racikan.length) {
                        let no = 1;
                        $.map(res.resep_racikan, (rr) => {
                            html = `<tr class="racikan-${no}">
                                <td>${rr.no_racik}</td>
                                    <td>${rr.no_resep}</td>
                                    <td>${rr.nama_racik}</td>
                                    <td>${rr.metode.nm_racik}</td>
                                    <td class="jml_dr-${no}">${rr.jml_dr}</td>
                                    <td class="aturan_dr-${no}">${rr.aturan_pakai}</td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="hapusRacikan('${rr.no_resep}', '${rr.no_racik}')"><i class="bi bi-trash"></i></button>
                                        <button class="btn btn-sm btn-warning" onclick="tambahDetail('${rr.no_resep}', '${rr.no_racik}')"><i class="bi bi-pencil"></i></button>
                                        </td>
                                        </tr>`
                            if (rr.detail_racikan.length) {
                                html += `<tr><td colspan="2"></td><td colspan="5">`
                                $.map(rr.detail_racikan, (dr) => {
                                    html += `<span class="badge text-bg-success">${dr.databarang.nama_brng} ${dr.kandungan} mg</span> `
                                })
                                html += `</td></tr>`
                            }
                            $('#tb-resep-racikan tbody').append(html)
                            no++;
                        })
                    }
                })
                $('#formResepUgd input[name="no_resep"]').val(no_resep)
            })
        }

        function modalSoapUgd(noRawat) {

            getRegPeriksa(noRawat).done((response) => {
                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
                $('#formSoapUgd input[name="spesialis"]').val(response.dokter.kd_sps)
                $('#formResepUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formResepUgd input[name="kd_dokter"]').val(response.kd_dokter)
                setListResep(noRawat);
                setEws(noRawat, 'ralan', response.dokter.kd_sps)
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
            })
            $('#formSoapUgd input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
            $('#formSoapUgd input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")
            $('#modalSoapUgd').modal('show')
            $('#tbSoapUgd').DataTable().destroy();
            $('.btn-umum').attr('onclick', `tambahResep('umum', '${noRawat}')`)
            $('.btn-racikan').attr('onclick', `tambahResep('racikan','${noRawat}')`)
            tbSoapUgd(noRawat);


        }

        function modalAsmedUgd(params) {
            getAsmedUgd(params).done((response) => {
                if (Object.keys(response).length == 0) {
                    return getRegPeriksa(params).done((regPeriksa) => {

                        $('.btn-asmed-ugd-ubah').css('display', 'none')
                        $('.btn-asmed-ugd').css('display', 'inline')
                        $('#formAsmedUgd input[name="no_rawat"]').val(regPeriksa.no_rawat)
                        $('#formAsmedUgd input[name="pasien"]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                        $('#formAsmedUgd input[name="tgl_lahir"]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} (${hitungUmur(regPeriksa.pasien.tgl_lahir)})`)
                        $('#formAsmedUgd input[name="kd_dokter"]').val("{{ session()->get('pegawai')->nik }}")
                        $('#formAsmedUgd input[name="dokter"]').val("{{ session()->get('pegawai')->nama }}")
                        $('#formAsmedUgd input[name="tanggal"]').val(`${formatTanggal("{{ date('Y-m-d') }}")} {{ date('H:i:s') }}`)

                    })
                } else {
                    $('#formAsmedUgd input[name="no_rawat"]').val(response.no_rawat)
                    $('#formAsmedUgd input[name="pasien"]').val(`${response.reg_periksa.pasien.nm_pasien} (${response.reg_periksa.pasien.jk})`)
                    $('#formAsmedUgd input[name="tgl_lahir"]').val(`${formatTanggal(response.reg_periksa.pasien.tgl_lahir)} (${hitungUmur(response.reg_periksa.pasien.tgl_lahir)})`)
                    $('#formAsmedUgd input[name="kd_dokter"]').val(response.kd_dokter)
                    $('#formAsmedUgd input[name="dokter"]').val(response.dokter.nm_dokter)
                    $('#formAsmedUgd input[name="tanggal"]').val(response.tanggal)
                    $('#formAsmedUgd input[name="tanggal"]').attr('style', 'background-color: #e9ecef;cursor:not-allowed')
                    $('#formAsmedUgd select[name="anamnesis"]').val(response.anamnesis).change()
                    $('#formAsmedUgd input[name="hubungan"]').val(response.hubungan)
                    $('#formAsmedUgd textarea[name="keluhan_utama"]').val(response.keluhan_utama)
                    $('#formAsmedUgd textarea[name="rps"]').val(response.rps)
                    $('#formAsmedUgd textarea[name="rpd"]').val(response.rpd)
                    $('#formAsmedUgd textarea[name="rpk"]').val(response.rpk)
                    $('#formAsmedUgd textarea[name="rpo"]').val(response.rpo)
                    $('#formAsmedUgd input[name="alergi"]').val(response.alergi)
                    $('#formAsmedUgd select[name="keadaan"]').val(response.keadaan).change()
                    $('#formAsmedUgd select[name="kesadaran"]').val(response.kesadaran).change()
                    $('#formAsmedUgd input[name="gcs"]').val(response.gcs)
                    $('#formAsmedUgd input[name="tb"]').val(response.tb)
                    $('#formAsmedUgd input[name="bb"]').val(response.bb)
                    $('#formAsmedUgd input[name="td"]').val(response.td)
                    $('#formAsmedUgd input[name="nadi"]').val(response.nadi)
                    $('#formAsmedUgd input[name="rr"]').val(response.rr)
                    $('#formAsmedUgd input[name="suhu"]').val(response.suhu)
                    $('#formAsmedUgd input[name="spo"]').val(response.spo)
                    $('#formAsmedUgd select[name="kepala"]').val(response.kepala).change()
                    $('#formAsmedUgd select[name="mata"]').val(response.mata).change()
                    $('#formAsmedUgd select[name="gigi"]').val(response.gigi).change()
                    $('#formAsmedUgd select[name="leher"]').val(response.leher).change()
                    $('#formAsmedUgd select[name="thoraks"]').val(response.thoraks).change()
                    $('#formAsmedUgd select[name="abdomen"]').val(response.abdomen).change()
                    $('#formAsmedUgd select[name="ekstremitas"]').val(response.ekstremitas).change()
                    $('#formAsmedUgd textarea[name="ket_fisik"]').val(response.ket_fisik)
                    $('#formAsmedUgd textarea[name="ket_lokalis"]').val(response.ket_lokalis)
                    $('#formAsmedUgd textarea[name="ekg"]').val(response.ekg)
                    $('#formAsmedUgd textarea[name="lab"]').val(response.lab)
                    $('#formAsmedUgd textarea[name="rad"]').val(response.rad)
                    $('#formAsmedUgd textarea[name="diagnosis"]').val(response.diagnosis)
                    $('#formAsmedUgd textarea[name="tata"]').val(response.tata)


                }

            })
            $('#modalAsmedUgd').modal('show');
        }

        function tulisPlan(no_rawat) {
            $.ajax({
                url: '/erm/resep/obat/ambil',
                method: 'GET',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    teksRd = '';
                    teksRr = '';
                    $.map(response, function(res) {
                        $.map(res.resep_dokter, function(rd) {
                            teksRd += `${rd.data_barang.nama_brng}, jml : ${rd.jml} ${rd.data_barang.kode_satuan.satuan} aturan pakai ${rd.aturan_pakai} \n`;
                        })

                        $.map(res.resep_racikan, function(rr) {
                            teksRr += `${rr.metode.nm_racik} ${rr.nama_racik}, jml : ${rr.jml_dr} aturan pakai ${rr.aturan_pakai}, isian :  \n`
                            let no = 1
                            $.map(rr.detail_racikan, function(dr) {
                                if (rr.no_racik == dr.no_racik) {
                                    teksRr += `   - ${dr.databarang.nama_brng} dosis ${dr.kandungan} mg, \n`
                                    no++;
                                }
                            })
                            teksRr += '\n';
                        })

                    })
                    $('#formSoapUgd textarea[name=plan]').val(`${teksRd} \n ${teksRr}`)

                },
                error: function(request, status, error) {
                    Swal.fire(
                        'Gagal !',
                        'Tidak tertulis di PLAN<br/>' + request.responseJSON.message,
                        'error',
                    )

                }
            })
        }
    </script>
@endpush
