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

            // var contentScrolled = $('.content-scrolled');
            // console.log('WIDTH CONTENT', contentScrolled.width());

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
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${row.no_rkm_medis}')" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan 2</a></li>`;
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
                console.log('RIWAYAT ===', riwayat);
                if (riwayat.reg_periksa.length) {
                    let tabList = '';
                    let infoPasien = '';
                    let no_rawat = '';
                    $('#modalRiwayatV2').modal('show')
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
                            <a class="nav-link link-riwayat ${active}" aria-current="page" href="#" onclick="setDetailRawat('${regPeriksa.no_rawat}', this)">
                                ${regPeriksa.status_lanjut.toUpperCase() == 'RALAN' ? '<i class="bi bi-circle-fill text-warning"></i>' : '<i class="bi bi-circle-fill text-purple"></i>'} ${regPeriksa.status_lanjut.toUpperCase() } : ${splitTanggal(regPeriksa.tgl_registrasi)} 
                                </a>
                            </li>`;
                        $('#navTabRiwayat').append(tabNav)
                    })
                    setNavTabsTitle()
                    $('.tabListRiwayat').append(tabList)
                } else {
                    swal.fire('Informasi', 'Belum terdapat riwayat pemeriksaan', 'info')
                }
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
                    status_lanjut = 'Rawat Jalan';
                    cardBg = 'text-bg-warning';
                    $('.header-riwayat').removeClass('bg-purple')
                } else {
                    $('#nav-resume-tab').show()
                    status_lanjut = 'Rawat Inap';
                    cardBg = 'bg-purple';
                    $('.header-riwayat').removeClass('text-bg-warning')
                }

                // status spesialisasi
                if (regPeriksa.dokter.kd_sps == 'S0003') {
                    // asmed & askep rawat jalan

                    // asmed & askep rawat inap
                    $('#nav-asmed-tab').attr('onclick', `setRiwayatAsmedAnak('${no_rawat}')`);
                    $('#nav-askep-tab').attr('onclick', `setRiwayatAskepAnak('${no_rawat}')`)
                } else if (regPeriksa.dokter.kd_sps == 'S0001') {
                    $('#nav-asmed-tab').attr('onclick', `setRiwayatAsmedKandungan('${no_rawat}')`);
                    $('#nav-askep-tab').attr('onclick', `setRiwayatAskepKandungan('${no_rawat}')`)
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
                setLaporanOperasi(no_rawat)
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

        function setLaporanOperasi(no_rawat) {
            const laporanOperasi = $('#laporanOperasi')
            const contentLaporan = $('#collapseLaporanOperasi')
            laporanOperasi.hide()
            contentLaporan.empty()
            getLaporanOperasi(no_rawat).done((result) => {
                let laporan = '';
                if (Object.keys(result).length) {

                    laporanOperasi.show()
                    laporan += `<table class="table table-responsive">
                        <tr>
                            <th>Jenis Operasi</th>
                            <td>:</td>
                            <td>${result.operasi.paket_operasi.nm_perawatan}</td>
                        </tr>
                        <tr>
                            <th>Operator</th>
                            <td>:</td>
                            <td>${result.operasi.op1.nm_dokter}</td>
                        </tr>
                        <tr>
                            <th>Asisten 1</th>
                            <td>:</td>
                            <td>${result.operasi.asistenop1.nama}</td>
                        </tr>
                        <tr>
                            <th>Asisten 2</th>
                            <td>:</td>
                            <td>${result.operasi.asistenop2.nama}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Operasi</th>
                            <td>:</td>
                            <td>${result.tanggal}</td>
                        </tr>
                        <tr>
                            <th>Diagnosa Pre OP</th>
                            <td>:</td>
                            <td>${result.diagnosa_preop}</td>
                        </tr>
                        <tr>
                            <th>Diagnosa Post OP</th>
                            <td>:</td>
                            <td>${result.diagnosa_postop}</td>
                        </tr>
                        <tr>
                            <th>Jaringan Dieksekusi</th>
                            <td>:</td>
                            <td>${result.jaringan_dieksekusi}</td>
                        </tr>
                        <tr>
                            <th>Laporan</th>
                            <td>:</td>
                            <td>${result.laporan_operasi}</td>
                        </tr>
                    </table>`
                    console.log('OPERASI ===', result);
                }
                contentLaporan.append(laporan).hide().fadeIn()
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

        function setRiwayatAsmedAnak(no_rawat) {
            setAsmedRanapAnak(no_rawat)
            // setAsmedRalanAnak(no_rawat)
            setAsmedUgd(no_rawat)
        }

        function setRiwayatAsmedKandungan(no_rawat) {
            $('#riwayatAsmedAnak').hide()
            setAsmedUgd(no_rawat)
            setAsmedRanapKandnungan(no_rawat)
        }



        function setRiwayatImunisasi(data) {
            let tbImunisasi = ''
            const groupImunisasi = {};
            data.map((imunisasi, index) => {
                const key = `${imunisasi.master_imunisasi.nama_imunisasi}`

                if (!groupImunisasi[key]) {
                    groupImunisasi[key] = [];
                }

                groupImunisasi[key].push(imunisasi.no_imunisasi)
            })


            const keysImunisasi = Object.keys(groupImunisasi)
            const resultImunisasi = Object.values(groupImunisasi)

            keysImunisasi.map((key) => {
                tbImunisasi += `<tr><td>${key}</td>`
                groupImunisasi[key].map((value) => {
                    tbImunisasi += `<td><i class="bi bi-check text-success"></i></td>`
                })
                tbImunisasi += `</tr>`
            })

            return tbImunisasi;
        }


        function setAsmedUgd(no_rawat) {
            const riwayatAsmedUgd = $('#riwayatAsmedUgd')
            const infoAsmedUgd = $('#infoAsmedUgd')
            const contentAsmedUgd = $('#contentAsmedUgd')

            infoAsmedUgd.empty()
            contentAsmedUgd.empty()
            getAsmedUgd(no_rawat).done((asmed) => {
                if (Object.keys(asmed).length) {
                    setRiwayatTriase(no_rawat)
                    const regPeriksa = asmed.reg_periksa;
                    const pasien = regPeriksa.pasien;
                    riwayatAsmedUgd.show()
                    const infoAsmed = `<div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <table class="table table-responsive borderless mb-0">
                                <tr>
                                    <th>No. Rekam Medis</th>    
                                    <td>:</td>    
                                    <td>${regPeriksa.no_rkm_medis}</td>    
                                </tr>
                                <tr>
                                    <th>No. Rawat</th>    
                                    <td>:</td>    
                                    <td>${no_rawat}</td>    
                                </tr>
                                 <tr>
                                    <th>Nama</th>    
                                    <td>:</td>    
                                    <td>${pasien.nm_pasien}</td>    
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <table class="table table-responsive borderless mb-0">
                                <tr>
                                    <th>Jenis Kelamin</th>    
                                    <td>:</td>    
                                    <td>${pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan'}</td>    
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>    
                                    <td>:</td>    
                                    <td>${formatTanggal(pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}</td>    
                                </tr>
                                <tr>
                                    <th>Umur</th>    
                                    <td>:</td>    
                                    <td>${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}</td>    
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <table class="table table-responsive borderless mb-0">
                                <tr>
                                    <th>Dokter Jaga</th>    
                                    <td>:</td>    
                                    <td>${asmed.dokter.nm_dokter}</td>    
                                </tr>
                                <tr>
                                    <th>Tgl. Asesmen</th>    
                                    <td>:</td>    
                                    <td>${formatTanggal(asmed.tanggal.split(' ')[0])} ${asmed.tanggal.split(' ')[1]}</td>    
                                </tr>
                                <tr>
                                    <th>Anamnesis</th>    
                                    <td>:</td>    
                                    <td>${asmed.anamnesis} (hub : ${asmed.hubungan})</td>    
                                </tr>
                            </table>
                        </div>
                    </div>`;

                    const contentAsmed = `<div class="card mb-2">
                                <div class="card-header">
                                    1. RIWAYAT KESEHATAN
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>Keluhan : </strong><br/>${asmed.keluhan_utama}
                                        </div> 
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>RPS : </strong><br/>${asmed.rps}
                                        </div> 
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>RPD : </strong><br/>${asmed.rpd}
                                        </div> 
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>RPK : </strong><br/>${asmed.rpk}
                                        </div> 
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>RPO : </strong><br/>${asmed.rpo}
                                        </div> 
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <strong>Alergi : </strong><br/>${asmed.alergi}
                                        </div> 
                                    </div>
                                </div>
                            </div>`
                    const pemeriksaanAsmed = ` <div class="card mb-2">
                                <div class="card-header">
                                    2. PEMERIKSAAN FISIK
                                </div>
                                <div class="card-body">
                                    <div class="row border-bottom border-1 mx-1 p-2 mb-2">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Keadaan Umum : </strong>${asmed.keadaan}
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>Kesadaran : </strong>${asmed.kesadaran}
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <strong>GCS : </strong>${asmed.gcs} E,V,M
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>TD : </strong>${asmed.td} mmHg
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>Nadi : </strong>${asmed.nadi} x/menit
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>Respirasi : </strong>${asmed.rr} x/menit
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>Suhu : </strong>${asmed.suhu} °C
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>SpO2 : </strong>${asmed.spo} %
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>Berat : </strong>${asmed.bb} Kg
                                        </div> 
                                        <div class="col-lg-3 col-md-3 col-xs-6">
                                            <strong>Tinggi : </strong>${asmed.tb} Cm
                                        </div> 
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-6">
                                            <table class="table table-responsive borderless">
                                                <tr><td>Kepala</td><td>:</td><td>[ ${asmed.kepala} ]</td></tr>    
                                                <tr><td>Mata</td><td>:</td><td>[ ${asmed.mata} ]</td></tr>    
                                                <tr><td>Gigi Mulut</td><td>:</td><td>[ ${asmed.gigi} ]</td></tr>    
                                                <tr><td>Leher</td><td>:</td><td>[ ${asmed.leher} ]</td></tr>    
                                            </table>
                                        </div> 
                                        <div class="col-lg-4 col-md-4 col-xs-6">
                                            <table class="table table-responsive borderless">
                                                <tr><td>Thoraks</td><td>:</td><td>[ ${asmed.thoraks} ]</td></tr>    
                                                <tr><td>Abdomen</td><td>:</td><td>[ ${asmed.abdomen} ]</td></tr>    
                                                <tr><td>Genital & Anus</td><td>:</td><td>[ ${asmed.genital} ]</td></tr>    
                                                <tr><td>Ekstremitas</td><td>:</td><td>[ ${asmed.ekstremitas} ]</td></tr>    
                                            </table>
                                        </div> 
                                        <div class="col-lg-4 col-md-4 col-xs-6">
                                            <strong>Keterangan : </strong> ${asmed.ket_fisik}
                                        </div> 
                                    </div>
                                </div>
                            </div>`

                    const statusLokalis = `<div class="card mb-2">
                        <div class="card-header">3. STATUS LOKALIS</div>
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
                        <div class="card-header">4.PEMERIKSAAN PENUNJANG</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                     <strong>EKG : </strong><br/>
                                    ${asmed.ekg}
                                </div> 
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                    <strong>Laboratorium: </strong><br/>
                                   ${asmed.lab}
                                    
                                </div>    
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                     <strong>Radiologi : </strong><br/>
                                    ${asmed.rad}
                                </div>    
                                  
                            </div>    
                        </div>
                    </div>`;

                    const diagnosa = `<div class="card mb-2">
                        <div class="card-header">5. DIAGNOSA</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                  ${stringPemeriksaan(asmed.diagnosis)}
                                </div>    
                            </div>    
                        </div>
                    </div>`;
                    const tataLaksana = `<div class="card mb-2">
                        <div class="card-header">6. TATA LAKSANA</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-lg-4 col-sm-12">
                                  ${stringPemeriksaan(asmed.tata)}
                                </div>    
                            </div>    
                        </div>
                    </div>`;

                    infoAsmedUgd.append(infoAsmed).hide().fadeIn();
                    contentAsmedUgd.append([contentAsmed, pemeriksaanAsmed, statusLokalis, pemeriksaanPenunjang, diagnosa, tataLaksana]).hide().fadeIn();
                }
            })
        }

        function setAsmedRanapKandnungan(no_rawat) {
            const cardAsmedKandungan = $('#riwayatAsmedKandungan')
            const bodyAsmedKandungan = $('#collapseAsmedKandungan')
            const bodyInfoAsmedKandungan = $('#infoAsmedKandungan')
            const bodyContentAsmedKandungan = $('#contenAsmedKandungan')

            cardAsmedKandungan.hide()
            bodyInfoAsmedKandungan.empty()
            bodyContentAsmedKandungan.empty()

            getAsmedRanapKandungan(no_rawat).done((asmed) => {
                if (asmed) {
                    cardAsmedKandungan.show()
                    console.log('AsMED ===', asmed);
                    const regPeriksa = asmed.reg_periksa
                    const pasien = regPeriksa.pasien
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
                                <div class="row card-text">
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
                    const statusObstetri = `<div class="card mb-2">
                            <div class="card-header">3. Status Obstetri & Ginekologi</div>
                            <div class="card-body">
                                <div class="row card-text">
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                        <table class="table borderless">
                                            <tr>
                                                <td>TFU</td><td>:</td><td>${asmed.tfu} cm</td>
                                            </tr>
                                            <tr>
                                                <td>TBJ</td><td>:</td><td>${asmed.tbj} gram</td>
                                            </tr>
                                            <tr>
                                                <td>HIS</td><td>:</td><td>${asmed.his}</td>
                                            </tr>
                                            <tr>
                                                <td>Kontraksi</td><td>:</td><td>${asmed.kontraksi}</td>
                                            </tr>
                                            <tr>
                                                <td>DJJ</td><td>:</td><td>${asmed.djj} Dpm</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                      <strong>Inspeksi :</strong><br/>
                                      ${asmed.inspeksi}
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-md-4 mb-2">
                                      <strong>VT :</strong><br/>
                                      ${asmed.vt}
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
                                      <strong>Inspekulo :</strong><br/>
                                      ${asmed.inspekulo}
                                    </div>
                                    <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
                                      <strong>RT :</strong><br/>
                                      ${asmed.rt}
                                    </div>
                                </div>    
                            </div>
                        </div>`;
                    bodyInfoAsmedKandungan.append(infoAsmed)
                    bodyContentAsmedKandungan.append([riwayatKesehatan, pemeriksaanFisik, statusObstetri])
                }
            })

        }

        function setAsmedRanapAnak(no_rawat) {
            const cardAsmedAnak = $('#riwayatAsmedAnak')
            const bodyAsmedAnak = $('#collapseAsmedAnak')
            const bodyInfoAsmedAnak = $('#infoAsmedAnak')
            const bodyContentAsmedAnak = $('#contenAsmedAnak')
            cardAsmedAnak.hide()
            bodyInfoAsmedAnak.empty()
            bodyContentAsmedAnak.empty()
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
                                <div class="row card-text">
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
        }


        function setAskepRanapAnak(no_rawat) {
            const cardAskepAnak = $('#riwayatAskepAnak')
            const bodyInfoAskepAnak = $('#infoAskepAnak')
            const bodyContentAskepAnak = $('#contenAskepAnak')
            cardAskepAnak.hide()
            bodyInfoAskepAnak.empty()
            bodyContentAskepAnak.empty()

            getAskepRanapAnak(no_rawat).done((askep) => {
                if (Object.keys(askep).length) {
                    console.log('ASKEP ===', askep);
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
                                    <th width="35%">Penkaji 2</th><td width="2%">:</td><td>${askep.pengkaji2?.nama}</td>
                                </tr>
                            </table>
                        </div>
                    </div>`;

                    const riwayatKesehatan = `<div class="card">
                        <div class="card-header">1. DATA SUBYEKTIF</div>
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row ">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <strong>RPS : </strong>${stringPemeriksaan(askep.rps)}
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <strong>RPD : </strong>${stringPemeriksaan(askep.rpd)}
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <strong>RPK : </strong>${stringPemeriksaan(askep.rpk)}
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <strong>RPO : </strong>${stringPemeriksaan(askep.rpo)}
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                        <div class="card-text ">
                                            <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=30%>Riwayat Pembedahan</th><td width=2%>:</td><td>${askep.riwayat_pembedahan}</td>
                                                </tr>
                                                 <tr>
                                                    <th width=30%>Riwayat Dirwat di RS</th><td width=2%>:</td><td>${askep.riwayat_dirawat_dirs}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                        <div class="card-text ">
                                            <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=30%>Riwayat Tranfusi</th><td width=2%>:</td><td>${askep.riwayat_tranfusi}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Riwayat Alergi</th><td width=2%>:</td><td>${askep.riwayat_alergi}</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-subtitle text-muted">Data Psikologis Sosial dan Kultural</div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                        <div class="card-text">
                                             <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=30%>Kondisi Psikologis</th><td width=2%>:</td><td>${askep.riwayat_psiko_kondisi_psiko}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Tempat Tinggal</th><td width=2%>:</td><td>${askep.riwayat_psiko_tinggal}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Tinggal Bersama</th><td width=2%>:</td><td>${askep.riwayat_psiko_tinggal_keterangan}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Hubungan Keluarga</th><td width=2%>:</td><td>${askep.riwayat_psiko_hubungan_keluarga}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Jaminan Kesehatan</th><td width=2%>:</td><td>${regPeriksa.penjab.png_jawab}</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                        <div class="card-text">
                                             <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=30%>Pendidikan Orangtua</th><td width=2%>:</td><td>${askep.riwayat_psiko_pendidikan_pj}</td>
                                                </tr>
                                                <tr>
                                                    <th width=30%>Agama</th><td width=2%>:</td><td>${regPeriksa.pasien.agama}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Nilai Budaya</th><td width=2%>:</td><td>${askep.riwayat_psiko_nilai_kepercayaan}, Ket : ${askep.riwayat_psiko_nilai_kepercayaan_keterangan}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Riwayat Gangguan Jiwa</th><td width=2%>:</td><td>${askep.riwayat_psiko_gangguan_jiwa}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=30%>Kondisi Perilaku</th><td width=2%>:</td><td>${askep.riwayat_psiko_perilaku}, Ket : ${askep.riwayat_psiko_perilaku_keterangan}</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 p-2">
                                        <div class="card-subtitle text-muted ms-1">Skrining Risiko Nutrisional</div>
                                        <div class="card-text">
                                             <table class="table table-responsive text-sm m-0">
                                                <tr>
                                                    <td>a. Apakah pasien tampak kurus ? : </td><td width=2%>:</td><td width=12% style="text-align:end">${askep.nilai_gizi1 ? 'YA': 'TIDAK'} [ ${askep.nilai_gizi1} ] </td>
                                                </tr>
                                                <tr>
                                                    <td>b. Apakah terdapat penurunan berat badan sebulan terakhir? (berdasarkan nilai objektif data berat badan bila ada atau untuk bayi < 1 Tahun, berat badan tidak naik selama 3 bulan terakhir)</th><td width=2%>:</td><td width=12% style="text-align:end">${askep.nilai_gizi2 ? 'YA': 'TIDAK'} [ ${askep.nilai_gizi2} ] </td>
                                                </tr>
                                                <tr>
                                                    <td>c. Apakah terdapat salah satu dari kondisi tersebut ? Diare >5 kali/sehari, dan atau muntah > 3 kali/sehari dalam seminggu terakhir, asupan makanan berkurang selama 1 minggu terakhir</td><td width=2%>:</td><td width=12% style="text-align:end">${askep.nilai_gizi3 ? 'YA': 'TIDAK'} [ ${askep.nilai_gizi3} ] </td>
                                                </tr>
                                                <tr>
                                                    <td>d. Apakah terdapat penyakit atau keadaan yang menyebabkan pasien beresiko mengalami malnutrisi ?</td><td width=2%>:</td><td width=12% style="text-align:end">${askep.nilai_gizi4 ? 'YA': 'TIDAK'} [ ${askep.nilai_gizi4} ] </td>
                                                </tr>
                                                <tr>
                                                    <th>JUMLAH SKOR</th><td width=2%>:</td><td width=12% style="text-align:end">${askep.nilai_total_gizi >=4 ? 'Resiko Tinggi' : askep.nilai_total_gizi >=3 ? 'Resiko Sedang' : askep.nilai_total_gizi == 0 ? 'Resiko Rendah' :'' } [ ${askep.nilai_total_gizi} ]</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-subtitle text-muted ms-1">Asesmen Fungsional</div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 p-2">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-lg-4 p-2">
                                                <div class="card-subtitle text-muted ms-1">a. Pola Nutrisi</div>
                                                    <table class="table table-responsive borderless text-sm ms-3">
                                                        <tr>
                                                            <td>Diet Makanan</td><td width=2%>:</td><td>${askep.pola_nutrisi_jenis_makanan}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pola Makan</td><td width=2%>:</td><td>${askep.pola_nutrisi_frekuesi_makan} kali/hari</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Porsi Makan</td><td width=2%>:</td><td>${askep.pola_nutrisi_porsi_makan}</td>
                                                        </tr>
                                                    </table>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4 p-2">
                                                <div class="card-subtitle text-muted ms-1">b. Pola Eliminasi</div>
                                                <table class="table table-responsive borderless text-sm ms-3">
                                                    <tr>
                                                        <td>BAK</td><td width=2%>:</td><td>${askep.pemeriksaan_eliminasi_bak_frekuensi_jumlah} x/${askep.pemeriksaan_eliminasi_bak_frekuensi_durasi}</td><td>Warna : ${askep.pemeriksaan_eliminasi_bak_warna} </td><td>Lain-lain : ${askep.pemeriksaan_eliminasi_bak_lainlain}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>BAB</td><td width=2%>:</td><td>${askep.pemeriksaan_eliminasi_bab_frekuensi_jumlah} x/${askep.pemeriksaan_eliminasi_bab_frekuensi_durasi}</td><td>Konsistensi : ${askep.pemeriksaan_eliminasi_bab_konsistensi} </td><td>Warna : ${askep.pemeriksaan_eliminasi_bab_warna}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4 p-2">
                                                <div class="card-subtitle text-muted ms-1">c. Pola Istirahat</div>
                                                <table class="table table-responsive borderless text-sm ms-3">
                                                    <tr>
                                                        <td>Lama Tidur</td><td width=2%>:</td><td>${askep.pola_tidur_lama_tidur} jam/hari</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ganguan Tidur</td><td>:</td><td>${askep.pola_tidur_gangguan}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                                <div class="card-subtitle text-muted ms-1">d. Pola Aktivitas</div>
                                                <table class="table table-responsive borderless text-sm ms-3">
                                                    <tr>
                                                        <td>Mandi</td><td width=2%>:</td><td>${askep.pola_aktifitas_mandi}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Eliminasi</td><td width=2%>:</td><td>${askep.pola_aktifitas_eliminasi}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobilisasi</td><td width=2%>:</td><td>${askep.pola_aktifitas_berpindah}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Makan & Minum</td><td width=2%>:</td><td>${askep.pola_aktifitas_makanminum}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Berpakaian</td><td width=2%>:</td><td>${askep.pola_aktifitas_berpakaian}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Alat Bantu yang Dipakai</td><td width=2%>:</td><td>${askep.alat_bantu_dipakai}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-6 p-2">
                                                <div class="card-subtitle text-muted ms-1">e. Pola Sensorik & Kognitif</div>
                                                <table class="table table-responsive borderless text-sm ms-3">
                                                    <tr>
                                                        <td>Sensorik</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_sensorik}</td><td>Ket </td><td>:</td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mototik</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_motorik}</td><td>Ket </td><td>:</td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Penglihatan</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_pengelihatan}</td><td>Alat Bantu</td><td>:</td><td>${askep.pemeriksaan_neurologi_alat_bantu_penglihatan}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pendengaran</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_pendengaran}</td><td>Alat Bantu</td><td>:</td><td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bicara</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_bicara}</td><td>Ket </td><td>:</td><td>${askep.pemeriksaan_neurologi_bicara_keterangan}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Otot</td><td width=2%>:</td><td>${askep.pemeriksaan_neurologi_kekuatan_otot}</td><td>Ket </td><td>:</td><td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`

                    const riwayatKelahiran = `<div class="card mt-2">
                        <div class="card-header">2. Riwayat Kelahiran & Tumbuh Kembang</div>
                        <div class="card-body">
                            <div class="card-subtitle text-muted ms-1">a. Riwayat Kelahiran</div>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                         <table class="table table-responsive borderless">
                                            <tr>
                                                <th>Anak Ke</th><td>:</td><td>${askep.anakke} dari ${askep.darisaudara} saudara</td>
                                            </tr>    
                                            <tr>
                                                <th>Umur Kelahiran</th><td>:</td><td>${askep.umurkelahiran}</td>
                                            </tr>    
                                        </table>   
                                    </div> 
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                         <table class="table table-responsive borderless">
                                            <tr>
                                                <th>Cara Lahir</th><td>:</td><td>${askep.caralahir}, Ket : ${askep.ket_caralahir}</td>
                                            </tr>    
                                            <tr>
                                                <th>Kelainan Bawaan</th><td>:</td><td>${askep.kelainanbawaan}, Ket : ${askep.ket_kelainan_bawaan}</td>
                                            </tr>    
                                        </table>   
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="card-subtitle text-muted ms-1">b. Riwayat Tumbuh Kembang</div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                         <table class="table table-responsive">
                                            <tr>
                                                <th>Usia Tengkurap</th><td>:</td><td>${askep.usiatengkurap}</td>
                                            </tr>      
                                            <tr>
                                                <th>Usia Duduk</th><td>:</td><td>${askep.usiaduduk}</td>
                                            </tr>      
                                            <tr>
                                                <th>Usia Berdiri</th><td>:</td><td>${askep.usiaberdiri}</td>
                                            </tr>      
                                        </table>   
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                         <table class="table table-responsive">
                                            <tr>
                                                <th>Usia Berjalan</th><td>:</td><td>${askep.usiaberdiri}</td>
                                            </tr> 
                                            <tr>
                                                <th>Usia Tumbuh Gigi</th><td>:</td><td>${askep.usiagigipertama}</td>
                                            </tr>      
                                            <tr>
                                                <th>Usia Bicara</th><td>:</td><td>${askep.usiabicara}</td>
                                            </tr>      
                                        </table>   
                                    </div> 
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                         <table class="table table-responsive">
                                            <tr>
                                                <th>Usia Membaca</th><td>:</td><td>${askep.usiamembaca}</td>
                                            </tr>      
                                            <tr>
                                                <th>Usia Menulis</th><td>:</td><td>${askep.usiamenulis}</td>
                                            </tr>      
                                            <tr>
                                                <th>Gangguan Perkembangan/Emosi</th><td>:</td><td>${askep.gangguanemosi}</td>
                                            </tr>    
                                        </table>   
                                    </div> 
                                </div>
                            </div>
                        </div>
                        
                    </div>`

                    let masalahKeperawatan = `<ol class="mb-0">`
                    let rencanaKeperawatan = `<ol class="mb-0">`

                    askep.masalah_keperawatan.map((masalah, index) => {
                        masalahKeperawatan += `<li>${masalah.master_masalah.nama_masalah}</li>`
                        masalah.rencana_keperawatan.map((rencana, index) => {
                            rencanaKeperawatan += `<li>${rencana.master_rencana.rencana_keperawatan}</li>`

                        })
                    })
                    rencanaKeperawatan += `</ol>`
                    masalahKeperawatan += `</ol>`

                    const masalahRencana = `<div class="card mt-2">
                    <div class="card-header">3. Masalah & Rencana & Tindakan Keperawatan</div>
                    <div class="card-body">
                        <div class="row card-text">
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="card-subtitle text-muted ms-1">a. Masalah Keperawatan</div>
                                <div class="card-text border border-1 rounded p-2">
                                    ${masalahKeperawatan}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="card-subtitle text-muted ms-1">b. Rencana Keperawatan</div>
                                <div class="card-text border border-1 rounded p-2">
                                    ${rencanaKeperawatan}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <div class="card-subtitle text-muted ms-1">c. Tindakan Keperawatan</div>
                                <div class="card-text border border-1 rounded p-2">
                                    ${stringPemeriksaan(askep.rencana)}
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>`


                    const riwayatImunisasi = `<div class="card mt-2">
                    <div class="card-header">4. Imunisasi</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card-text">
                                    <table class="table table-responsive table-bordered" id="tbImunisasi">
                                        <thead class="text-bg-secondary">
                                            <tr>
                                                <th rowspan=2 style="vertical-align:middle">Nama Imunisasi</th>    
                                                <th colspan=5 class="text-center">Imunisasi Ke</th>    
                                            </tr>    
                                            <tr class="text-center">
                                                <td>1</td>
                                                <td>2</td>
                                                <td>3</td>
                                                <td>4</td>
                                                <td>5</td>
                                            <tr>
                                        </thead>
                                        <tbody>
                                            ${setRiwayatImunisasi(regPeriksa.pasien.riwayat_imunisasi)}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>`

                    bodyInfoAskepAnak.append(infoAskep).hide().fadeIn()
                    bodyContentAskepAnak.append(
                        [riwayatKesehatan, riwayatKelahiran, masalahRencana, riwayatImunisasi]
                    ).hide().fadeIn()

                }
            })
        }

        function setRiwayatAskepAnak(no_rawat) {
            setAskepUgd(no_rawat)
            setAskepRanapAnak(no_rawat)
            setAskepRalanAnak(no_rawat)

        }

        function setAskepUgd(no_rawat) {
            const cardAskepUgd = $('#riwayatAskepUgd')
            const infoAskepUgd = $('#infoAskepUgd')
            const contentAskepUgd = $('#contentAskepUgd')

            cardAskepUgd.hide()
            infoAskepUgd.empty()
            contentAskepUgd.empty()
            getAskepUgd(no_rawat).done((askep) => {
                if (Object.keys(askep).length) {
                    console.log('ASKEP UGD ===', askep);
                    cardAskepUgd.show()
                    const regPeriksa = askep.reg_periksa;
                    const pasien = regPeriksa.pasien;
                    const infoAskep = `<div class="row">
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
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <table class="table table-responsive borderless m-0">
                               
                                <tr>
                                    <th>Umur / Tgl Lahir</th><td>:</td><td>${regPeriksa.umurdaftar} ${regPeriksa.sttsumur} / ${formatTanggal(regPeriksa.pasien.tgl_lahir)}</td>        
                                </tr>
                                <tr>
                                    <th>Bahasa</th><td>:</td><td>${regPeriksa.pasien.bahasa.nama_bahasa }</td>        
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
                                    <th width="35%">Penkaji</th><td width="2%">:</td><td>${askep.pengkaji.nama}</td>
                                </tr>
                            </table>
                        </div>
                    </div>`;



                    const riwayatKesehatan = `<div class="card mb-1">
                        <div class="card-header">
                            1. Riwayat Kesehatan    
                        </div>
                        <div class="card-body card-text">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                       <strong>Keluhan Utama : </strong><br/>
                                       ${askep.keluhan_utama}

                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                       <strong>RPD : </strong><br/>
                                       ${askep.rpd}
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                       <strong>RPO : </strong><br/>
                                       ${askep.rpo}
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                       <strong class="">Status Kehamilan : </strong> <br/>
                                       Hamil : ${askep.status_kehamilan}, Gravida : ${askep.gravida}, Para : ${askep.para}, Abortus : ${askep.abortus}, HPHT : ${askep.hpht} 
                                </div>
                            </div>
                        </div>
                    </div>`

                    const riwayatPsikologi = `<div class="card mb-1">
                        <div class="card-header">
                            2. Riwayat Psikologi
                        </div>
                        <div class="card-body card-text">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-4 p-2">
                                        <div class="card-text">
                                             <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=50%>Status Pernikahan</th><td width=2%>:</td><td>${pasien.stts_nikah}</td>
                                                </tr>
                                                <tr>
                                                    <th width=50%>Kondisi Psikologis</th><td width=2%>:</td><td>${askep.psikologis}</td>
                                                </tr>
                                                <tr>
                                                    <th width=50%>Tinggal Bersama</th><td width=2%>:</td><td>${askep.tinggal_dengan}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=50%>Tempat Tinggal</th><td width=2%>:</td><td>${askep.ket_tinggal}</td>    
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-2">
                                        <div class="card-text">
                                             <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=50%>Hubungan Keluarga</th><td width=2%>:</td><td>${askep.hubungan}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=50%>Jaminan Kesehatan</th><td width=2%>:</td><td>${regPeriksa.penjab.png_jawab}</td>    
                                                </tr>

                                                <tr>
                                                    <th width=50%>Edukasi Melalui</th><td width=2%>:</td><td>${askep.edukasi}</td>
                                                </tr>
                                                <tr>
                                                    <th width=50%>Pendidikan Orangtua</th><td width=2%>:</td><td>${askep.pendidikan_pj}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4 p-2">
                                        <div class="card-text">
                                             <table class="table table-responsive borderless text-sm m-0">
                                                <tr>
                                                    <th width=60%>Agama</th><td width=2%>:</td><td>${regPeriksa.pasien.agama}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=60%>Nilai Budaya</th><td width=2%>:</td><td>${askep.budaya}, Ket : ${askep.ket_budaya}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=60%>Riwayat Gangguan Jiwa</th><td width=2%>:</td><td>${askep.jiwa}</td>    
                                                </tr>
                                                <tr>
                                                    <th width=60%>Kondisi Perilaku</th><td width=2%>:</td><td>${askep.perilaku}, Ket : ${askep.ket_perilaku}</td>    
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>`

                    const pemeriksaanFisik = `<div class="card mb-1">
                        <div class="card-header">
                            3. Pemeriksaan Fisik
                        </div>
                        <div class="card-body card-text">
                             <div class="row">
                                <div class="col-sm-12 col-lg-4 col-md-6">
                                    <table class="table table-responsive borderless">
                                        <tr>
                                            <th width=40%>Tekanan Intrakranial</th><td> : ${askep.tekanan}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Pupil</th><td> : ${askep.pupil}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Edema</th><td> : ${askep.edema}</td>         
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-6">
                                    <table class="table table-responsive borderless">
                                        <tr>
                                            <th width=40%>Integumen</th><td> : ${askep.integumen}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Turgor Kulit</th><td> : ${askep.turgor}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Mukosa Mulut</th><td> : ${askep.edema}</td>         
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-6">
                                    <table class="table table-responsive borderless">
                                        <tr>
                                            <th width=40%>Perdarahan</th><td> : ${askep.perdarahan}, Jumlah : ${askep.jumlah_perdarahan}, Warna : ${askep.warna_perdarahan}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Intoksikasi</th><td> : ${askep.intoksikasi}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Neurosensorik/Muskulosketal</th><td> : ${askep.neurosensorik}</td>         
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <p class="text-muted mb-0">Pengkajian Fungsi</p>
                                    <table class="table table-responsive borderless">
                                        <tr>
                                            <th width=40%>Kemampuan Aktivitas</th><td> : ${askep.kemampuan}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Aktivitas</th><td> : ${askep.aktifitas}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Alat Bantu</th><td> : ${askep.alat_bantu}, Ket : ${askep.ket_bantu}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>Cacat Tubuh</th><td> : ${pasien.cacat.nama_cacat}</td>         
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <p class="text-muted mb-0">Eliminasi</p>
                                    <table class="table table-responsive borderless">
                                        <tr>
                                            <th width=40%>BAK</th><td> : ${askep.bak} x/${askep.xbak}, Warna : ${askep.wbak}, Lain-lain : ${askep.lbak}</td>         
                                        </tr>
                                        <tr>
                                            <th width=40%>BAB</th><td> : ${askep.bab} x/${askep.xbab}, Konsistensi : ${askep.kbab}, Warna : ${askep.wbab}</td>         
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>`

                    let masalahUgd = ``;
                    let rencanaUgd = ``;
                    askep.masalah_keperawatan.map((masalah, index) => {
                        masalahUgd += `<li>${masalah.master_masalah.nama_masalah}</li> `
                    })
                    askep.rencana_keperawatan.map((rencana, index) => {
                        rencanaUgd += `<li>${rencana.master_rencana.rencana_keperawatan}</li> `
                    })
                    const masalahKeperawatan = `<div class="card mb-1">
                        <div class="card-header">
                            5. Masalah, Rencana & Tindakan Keperawtatan
                        </div>
                        <div class="card-body card-text">
                             <div class="row">
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                    <p class="text-muted mb-0">Masalah Keperawatan</p>
                                    <div class="card">
                                        <div class="card-body">
                                            <ol>
                                                ${masalahUgd}
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                    <p class="text-muted mb-0">Rencana Keperawatan</p>
                                    <div class="card">
                                        <div class="card-body">
                                            <ol>
                                                ${rencanaUgd}
                                            </ol>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-12 col-lg-4 col-md-4">
                                    <p class="text-muted mb-0">Tindakan Keperawatan</p>
                                    <div class="card">
                                        <div class="card-body">
                                            ${stringPemeriksaan(askep.rencana)}
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>`;
                    infoAskepUgd.append(infoAskep).hide().fadeIn()
                    contentAskepUgd.append([riwayatKesehatan, riwayatPsikologi, pemeriksaanFisik, masalahKeperawatan]).hide().fadeIn()

                }
            })
        }

        function setRiwayatTriase(no_rawat) {
            const contentTriaseUgd = $('#riwayatTriase')
            let contentTriase = ''

            contentTriaseUgd.hide()
            getTriase(no_rawat).done((triases) => {
                if (Object.keys(triases).length) {
                    contentTriaseUgd.show()
                    contentTriaseUgd.empty()
                    if (Object.keys(triases.triase_detail4).length) {
                        contentTriase = setDetailTriase('4', triases.triase_detail4)
                    } else if (Object.keys(triases.triase_detail3).length) {
                        contentTriase = setDetailTriase('3', triases.triase_detail3)
                    } else if (Object.keys(triases.triase_detail2).length) {
                        contentTriase = setDetailTriase('2', triases.triase_detail2)
                    } else if (Object.keys(triases.triase_detail1).length) {
                        contentTriase = setDetailTriase('1', triases.triase_detail1)
                    }
                    console.log('TRIASES ===', triases);
                    contentTriaseUgd.append(contentTriase).hide().fadeIn()
                }
            })


        }

        function setDetailTriase(skala, dataTriase) {
            let data = ``;
            let contentTriase = ``;
            let pengkajian = `pengkajian_skala${skala}`;
            let indexSkala = `skala${skala}`;
            const riwayatTriase = $("riwayatTriase")

            if (skala == 5) {
                textBgColor = 'text-bg-secondary'
                textSkala = 'SKALA V'
            } else if (skala == 4) {
                textBgColor = 'text-bg-primary'
                textSkala = 'SKALA IV'
            } else if (skala == 3) {
                textBgColor = 'text-bg-success'
                textSkala = 'SKALA III'
            } else if (skala == 2) {
                textBgColor = 'text-bg-warning'
                textSkala = 'SKALA II'
            } else if (skala == 1) {
                textBgColor = 'text-bg-danger'
                textSkala = 'SKALA I'
            }

            dataTriase.map((data, index) => {
                contentTriase += `<div class="col-lg-3 col-md-6 col-sm-12">
                                <div class="card-text">
                                    <strong>${data[indexSkala].pemeriksaan.nama_pemeriksaan}</strong> : ${data[indexSkala][pengkajian]}
                                </div>
                            </div>`
            })
            const triase = `
                    <div class="card-header ${textBgColor}">
                        <span class="card-text">
                            Data Triase : ${textSkala}
                        </span>
                    </div>
                    <div class="card-body" id="collapseTriase">
                        <div class="row">
                            ${contentTriase}    
                        </div> 
                    </div>`

            return triase;

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
