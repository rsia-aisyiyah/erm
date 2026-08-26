@extends('index')
@section('contents')
    <form action="" id="formFilterUgd">
        <div class="row">
            <div class="col-md-6 col-lg-3 col-sm-12">
                <label for="tgl_registrasi" class="form-label" style="font-size: 12px;margin-bottom:0px">Periode</label>
                <div class="input-group input-group-sm input-daterange">
                    <input type="text" class="form-control form-control-sm tgl_awal" style="font-size:12px">
                    <div class="input-group-text">ke</div>
                    <input type="text" class="form-control form-control-sm tgl_akhir" style="font-size:12px">
                    <button class="btn btn-success btn-sm" type="button" id="btn-filter-tgl"><i
                            class="bi bi-search"></i></button>
                </div>
            </div>
            @if (session()->get('pegawai')->jnj_jabatan != 'DIRU' && session()->get('pegawai')->bidang != 'Spesialis')
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <label for="" style="font-size: 12px;margin-bottom:0px">Spesialis</label>
                    <select name="spesialis" id="spesialis" class="form-select form-select-sm">
                        <option value="">Semua</option>
                        <option value="S0007">Umum</option>
                        <option value="S0003">Spesialis Anak</option>
                        <option value="S0001">Spesialis Kandungan & Kebidanan</option>
                    </select>
                </div>
                <input type="hidden" value="" name="kd_dokter">
            @else
                <input type="hidden" value="{{ session()->get('pegawai')->nik }}" name="kd_dokter">
            @endif
            <div class="col-md-6 col-lg-3 col-sm-12 d-flex align-items-end gap-2">
                <button type="button" class="btn btn-outline-danger btn-sm" onclick="showTabelHasilKritis()" title="Monitoring Pelaporan Nilai Kritis">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Nilai Kritis
                </button>
                <button type="button" class="btn btn-danger btn-sm fw-bold text-nowrap" onclick="showModalTriasePreReg()" title="Input Triase Pasien Baru Sebelum Registrasi">
                    <i class="bi bi-diagram-3-fill me-1"></i> + Triase Pre-Reg <span class="badge bg-white text-danger ms-1" id="badgeCountUnlinkedTriase">0</span>
                </button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-responsive text-sm table-sm" id="tb_ugd" width="100%">
            <thead>
                <tr role="row">

                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    @include('content.ugd.modal.pemeriksaan')
    @include('content.ugd.modal.asmed')
    @include('content.ugd.modal.modal_askep_igd')
    @include('content.ugd.modal.modal_askep_kebidanan')
    @include('content.ugd.modal.modal_triase_prereg')
    @include('content.ugd.modal.modal_link_triase_prereg')
    @include('content.ranap.modal.modal_penunjang')
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.ranap.modal.modal_riwayat')
    @include('content.ranap.modal.modal_lab')
    @include('content.ranap.modal.modal_hasil_kritis')
    @include('content.ranap.modal.modal_skrining_tb')
    @include('content.ranap.modal.modal_asesmen_nyeri_dewasa')
    @include('content.ranap.modal.modal_asesmen_nyeri_batita_flacc')
    @include('content.ranap.modal.modal_asesmen_nyeri_anak')
    @include('content.ranap.modal.modal_asesmen_nyeri_neonatus')
    @include('content.ranap.modal.modal_asesmen_nyeri_balita')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_dewasa')
    @include('content.ranap.modal.modal_asesmen_resiko_jatuh_anak')
    @include('content.poliklinik.modal.modal_icare')
    @include('content.ranap.modal.modal_transfer_pasien')
    @include('content.ranap.modal.modal_asesmen_geriatri')
@endsection


@push('script')
    <script type="text/javascript" src="{{ asset('js/context-menu/ugd.js') }}"></script>
    <script type="text/javascript">
        var tgl_awal = '';
        var tgl_akhir = '';
        var nm_pasien = '';
        var dokter = '';
        var spesialis = '';
        // var tableUdg = '';
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
            // setInterval(() => {
            //     tbUgd()
            //     toastReload('Memperbaharui data pasien UGD', 2000)
            // }, 50000);

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
            $('#tb_ugd').DataTable({
                destroy: true,
                processing: true,
                scrollX: true,
                scrollY: '60vh',
                stateSave: true,
                // ordering: true,
                paging: false,
                info: false,
                // searching: true,
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
                initComplete: function () {
                    // toastReload('Menampilkan data pasien UGD', 2000)
                },
                columnDefs: [{
                    target: 0,
                    width: 10,
                }, {
                    target: 1,
                    width: 100,
                }, {
                    target: 2,
                    width: 300,
                },
                {
                    target: 3,
                    width: 200,
                },
                {
                    target: 5,
                    width: 100,
                },
                {
                    target: 4,
                    width: 80,
                }, {
                    target: 6,
                    width: 80,

                },
                {
                    target: 7,
                    width: 100,
                }
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('row-ugd')
                        .attr('data-id', data.no_rawat)
                        .attr('data-no_rkm_medis', data.no_rkm_medis)
                        .attr('data-no_peserta', data.pasien.no_peserta)
                        .attr('data-penjab', data.kd_pj)
                        .attr('data-dokter_bpjs', data.dokter.mapping_dokter?.kd_dokter_bpjs)
                        .attr('data-pasien', JSON.stringify(data.pasien))
                        .attr('data-umur', data.umurdaftar)
                        .attr('data-sttsumur', data.sttsumur)
                        .attr('data-tgl_registrasi', data.tgl_registrasi)
                        .attr('data-tgl_lahir', data.pasien.tgl_lahir)
                    if (data.asmed_igd == null) {
                        $(row).addClass('table-danger').prop('title', 'Belum Ada Asesmen Medis')
                    }

                    const alertContainer = $('<div class="infection-alert mt-2"></div>');
                    $(row).find('td:eq(9)').append(alertContainer);

                    if (!window.labAlertCache) {
                        window.labAlertCache = {};
                    }

                    const noRkmMedis = data.no_rkm_medis;

                    if (window.labAlertCache[noRkmMedis]) {
                        renderInfectionAlertRow(alertContainer, window.labAlertCache[noRkmMedis], noRkmMedis);
                        return;
                    }

                    $.get(`/erm/lab/riwayat-hasil/${noRkmMedis}`)
                        .done(response => {
                            window.labAlertCache[noRkmMedis] = response.infection_alert;
                            renderInfectionAlertRow(alertContainer, response.infection_alert, noRkmMedis);
                            if (response.infection_alert?.highest_risk === 'HIGH') {
                                $(`#pasien[data-no-rkm-medis="${noRkmMedis}"]`)
                                    .addClass('text-danger fw-bold').attr('onclick', `showLabInfectionAlert('${noRkmMedis}')`);
                            }
                        });
                },
                columns: [{
                    data: '',
                    title: '',
                    render: function (data, type, row, meta) {
                        const pasien = row.pasien || {};
                        const dokter = row.dokter || {};

                        list = `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalSoapUgd('${row.no_rawat}')"><i class="bi bi-journal-medical text-info me-1"></i> CPPT</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang('${row.no_rawat}')"><i class="bi bi-file-earmark-medical text-primary me-1"></i> Pemeriksaan Penunjang</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAsmedUgd('${row.no_rawat}')"><i class="bi bi-hospital text-danger me-1"></i> Asesmen Medis UGD ${cekList(row.asmed_igd)} </a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAskepUgd('${row.no_rawat}')"><i class="bi bi-clipboard-pulse text-info me-1"></i> Asesmen Keperawatan UGD ${cekList(row.askep_igd)} </a></li>`;
                        if ((pasien.jk || '').toUpperCase() === 'P') {
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAskepKebidananUgd('${row.no_rawat}')"><i class="bi bi-gender-female text-danger me-1"></i> Asesmen Keperawatan Kebidanan ${cekList(row.askep_kebidanan)} </a></li>`;
                        }
                        if (pasien.tgl_lahir) {
                            list += renderListsAsesmenNyeri(pasien.tgl_lahir, row.tgl_registrasi, row.no_rawat);
                        }
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="hasilKritis('${row.no_rawat}')" data-id="${row.no_rawat}"><i class="bi bi-exclamation-triangle text-danger me-1"></i> Hasil Kritis</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="detailPeriksa('${row.no_rawat}', 'Ralan')"><i class="bi bi-upload text-secondary me-1"></i> Upload Berkas Penunjang</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="skoringTb('${row.no_rawat}')"><i class="bi bi-lungs text-danger me-1"></i> Skoring & Skrining TB ${cekList(row.skrining_tb)}</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${row.no_rkm_medis}')" data-id="${row.no_rkm_medis}"><i class="bi bi-clock-history text-secondary me-1"></i> Riwayat Pemeriksaan</a></li>`;

                        if (row.kd_pj == 'A01' || row.kd_pj == 'A05') {
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare('${pasien.no_peserta || ''}', '${dokter.mapping_dokter?.kd_dokter_bpjs || ''}')"><i class="bi bi-card-checklist text-primary me-1"></i> Riwayat Perawatan ICare</a></li>`;
                        }

                        if (row.umurdaftar > 13 && row.sttsumur === 'Th') {
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhDewasa('${row.no_rawat}')"><i class="bi bi-person-exclamation text-danger me-1"></i> Asesmen Resiko Jatuh Dewasa</a></li>`;
                        } else {
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhAnak('${row.no_rawat}')"><i class="bi bi-person-exclamation text-danger me-1"></i> Asesmen Resiko Jatuh Anak</a></li>`;
                        }
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalTransferPasien('${row.no_rawat}')"><i class="bi bi-arrow-left-right text-primary me-1"></i> Transfer Pasien Antar Ruang</a></li>`;
                        list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenGeriatri('${row.no_rawat}')"><i class="bi bi-person-heart text-success me-1"></i> Asesmen Awal Geriatri ${cekList(row.asesmen_geriatri)}</a></li>`;
                        
                        if (row.triase_pre_reg) {
                            list += `<li><a class="dropdown-item text-danger" href="javascript:void(0)" onclick="unlinkTriasePreReg('${row.no_rawat}', '${pasien.nm_pasien || ''}')"><i class="bi bi-link-45deg me-1"></i> Lepas Tautan Triase Pre-Reg</a></li>`;
                        }
                        button = '<div class="dropdown-center"><button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:11px"><i class="bi bi-list-task"></i></button><ul class="dropdown-menu" style="font-size:12px">' + list + '</ul></div>'
                        return button;
                    }
                },
                {
                    title: 'No. Rawat',
                    data: 'no_rawat',
                    render: (data, type, row, meta) => {
                        return `<a href="javascript:void(0)" onclick="modalSoapUgd('${row.no_rawat}')" style="text-decoration: none; color: #000">${data}</a>`;
                    }
                },
                {
                    title: 'Pasien',
                    data: 'pasien',
                    render: (data, type, row, meta) => {
                        if (!data && !row.pasien) {
                            return `<div class="text-danger small">${row.no_rkm_medis} (Data Pasien Tidak Ditemukan)</div>`;
                        }
                        const pasien = row.pasien || data || {};
                        const umurDaftar = hitungUmurDaftar(pasien.tgl_lahir, row.tgl_registrasi);
                        const umur = `${umurDaftar.tahun} Th ${umurDaftar.bulan} Bln ${umurDaftar.hari} Hr`;

                        const kamarInap = (row.kamar_inap && Object.keys(row.kamar_inap).length) ? `<button title="Pindah Kamar" class="btn btn-sm btn-success rounded-circle" type="button"><i class="bi bi-box-arrow-right"></i></button>` : '';

                        // Tentukan warna berdasarkan jenis kelamin
                        const badgeColor = pasien.jk == 'L' ? 'bg-info' : '';
                        const badgeStyle = pasien.jk == 'P' ? 'style="background-color: #ff6aaf;"' : '';

                        return `<div class="d-flex align-items-center gap-2">
                                    <span class="badge ${badgeColor} rounded-pill" ${badgeStyle}>
                                        ${pasien.jk == 'L' ? '<i class="bi bi-gender-male"></i>' : '<i class="bi bi-gender-female"></i>'}
                                    </span>
                                    <p class="m-0">
                                        <strong id="pasien" data-no-rkm-medis="${row.no_rkm_medis}">${row.no_rkm_medis}<br/>${pasien.nm_pasien || '-'}</strong>
                                        <br/><small class="text-muted">${umur}</small>
                                    </p>
                                </div>`;
                    }
                },
                {
                    title: 'Dokter',
                    data: 'dokter',
                    render: (data, type, row, meta) => {
                        return (row.dokter && row.dokter.nm_dokter) ? row.dokter.nm_dokter : (data && data.nm_dokter ? data.nm_dokter : (row.kd_dokter || '-'));
                    }
                },
                {
                    title: 'Tgl. Masuk',
                    data: 'tgl_registrasi',
                    render: (data, type, row, meta) => {
                        return `${moment(data).format('DD-MM-YYYY')} ${row.jam_reg}`;
                    }
                },

                {
                    title: 'Dx. Awal',
                    data: 'asmed_igd',
                    render: (data, type, row, meta) => {
                        if (data == null) {
                            return '-'
                        }
                        return data?.diagnosis;

                    }
                },
                {
                    title: 'Asesmen Medis',
                    data: 'asmed_igd',
                    render: (data, type, row, meta) => {
                        if (data == null) {
                            return '<span class="text-danger"><b>Belum Ada Asmed</b></span>'
                        }
                        return moment(data.tanggal).format('DD-MM-YYYY HH:mm:ss');
                    }
                },
                {
                    title: 'Pembiayaan',
                    data: 'penjab',
                    render: (data, type, row, meta) => {
                        let penjab = '';
                        if (data.kd_pj == 'A03') {
                            penjab = `<span class="text-danger"><b>${row.penjab.png_jawab}</b></span>`
                        } else if (data.kd_pj == 'A01' || row.penjab.kd_pj == 'A05') {
                            penjab = `<span class="text-success"><b>${row.penjab.png_jawab} ${row.sep?.no_sep ? '<i class="fa fa-check text-success"></i>' : ''}</b></span>`
                        }

                        return penjab;

                    }
                },
                {
                    title: 'Status',
                    data: 'status_lanjut',
                    render: (data, type, row, meta) => {
                        if (data === 'Ralan') {
                            return `<button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Rawat Jalan"><i class="bi bi-person-wheelchair"></i></button>`
                        } else {
                            return `<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-title="Default tooltip"><i class="bi bi-house-add"></i></button>`
                        }
                    }
                },
                {
                    title: 'Catatan',
                    data: 'reg_periksa.no_rkm_medis',
                    render: function (data) {
                        return `<span class="" id="riwayat_lab_${data}"></span>`
                    },
                    name: 'no_rkm_medis',
                },
                {
                    title: 'Pindah Kamar',
                    data: '',
                    render: (data, type, row, meta) => {
                        return row.kamar_pulang ? row.kamar_pulang.kamar.bangsal.nm_bangsal : '';
                    }
                }, {
                    title: 'Triase',
                    data: '',
                    render: (data, type, row, meta) => {
                        let ats = '';
                        let atsClass = '';
                        if (row.triase_skala1.length > 0 || (row.triase_pre_reg && row.triase_pre_reg.skala_triase == '1')) {
                            ats = `ATS I`
                            atsClass = 'bg-danger text-white';
                        } else if (row.triase_skala2.length > 0 || (row.triase_pre_reg && row.triase_pre_reg.skala_triase == '2')) {
                            ats = `ATS II`
                            atsClass = 'bg-warning text-dark';
                        } else if (row.triase_skala3.length > 0 || (row.triase_pre_reg && row.triase_pre_reg.skala_triase == '3')) {
                            ats = `ATS III`
                            atsClass = 'bg-success text-white';
                        } else if (row.triase_skala4.length > 0 || (row.triase_pre_reg && row.triase_pre_reg.skala_triase == '4')) {
                            ats = `ATS IV`
                            atsClass = 'bg-primary text-white';
                        } else if (row.triase_skala5.length > 0 || (row.triase_pre_reg && row.triase_pre_reg.skala_triase == '5')) {
                            ats = `ATS V`
                            atsClass = 'bg-secondary text-white';
                        }
                        
                        let preBadge = row.triase_pre_reg ? `<div class="mt-1"><span class="badge bg-dark" style="font-size:9px;" title="Pre-Reg Linked: ${row.triase_pre_reg.id_triase}"><i class="bi bi-link-45deg"></i> Pre-Reg</span></div>` : '';

                        return `<div class="${atsClass} p-1 text-center" style="font-family:monospace">${ats}${preBadge}</div>`
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
                if (!response) return;
                const pasien = response.pasien || {};
                const dokter = response.dokter || {};
                const penjab = response.penjab || {};
                const kamarInapList = response.kamar_inap || [];

                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat || noRawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(`${pasien.nm_pasien || '-'} (${pasien.tgl_lahir ? hitungUmur(pasien.tgl_lahir) : '-'})`)
                $('#formSoapUgd input[name="spesialis"]').val(dokter.kd_sps || '')
                $('#formResepUgd input[name="no_rawat"]').val(response.no_rawat || noRawat)
                $('#formResepUgd input[name="kd_dokter"]').val(response.kd_dokter || dokter.kd_dokter || '')

                $('#formInfoPasienResep').find('input[name=no_rawat]').val(response.no_rawat || noRawat);
                $('#formInfoPasienResep').find('input[name=no_rkm_medis]').val(response.no_rkm_medis || '');
                $('#formInfoPasienResep').find('input[name=kd_dokter]').val(response.kd_dokter || dokter.kd_dokter || '');
                $('#formInfoPasienResep').find('input[name=status_lanjut]').val((response.status_lanjut || '').toLowerCase());
                $('#formInfoPasienResep').find('input[name=kelasHarga]').val('ralan');

                const formInfoPasien = $('#formInfoPasien');
                formInfoPasien.find('input[name=no_rawat]').val(noRawat);
                formInfoPasien.find('input[name=no_rkm_medis]').val(response.no_rkm_medis || '');
                formInfoPasien.find('input[name=pasien]').val(`${pasien.nm_pasien || '-'} (${pasien.jk || '-'})`);
                formInfoPasien.find('input[name=tgl_lahir]').val(`${pasien.tgl_lahir ? formatTanggal(pasien.tgl_lahir) : '-'} (${pasien.tgl_lahir ? hitungUmur(pasien.tgl_lahir) : '-'})`);
                formInfoPasien.find('input[name=p_jawab]').val(response.p_jawab || '-');
                formInfoPasien.find('input[name=penjab]').val(penjab.png_jawab || '-');
                formInfoPasien.find('input[name=no_kartu]').val(pasien.no_kartu || '-');
                formInfoPasien.find('input[name=dokter_dpjp]').val(dokter.nm_dokter || '-');

                const kamar = kamarInapList.filter((item) => {
                    return item.stts_pulang != 'Pindah Kamar'
                }).map((item) => {
                    return {
                        'bangsal': item.kamar && item.kamar.bangsal ? item.kamar.bangsal.nm_bangsal : '-',
                        'diagnosa_awal': item?.diagnosa_awal || '-'
                    }
                })[0];
                formInfoPasien.find('input[name=kamar]').val(kamar ? kamar.bangsal : '-');
                formInfoPasien.find('input[name=diagnosa_awal]').val(kamar ? kamar.diagnosa_awal : '-');

                $('button[data-bs-toggle="tab"][data-bs-target="#tabSoapPaneUgd"]').trigger('click')

                getResepObat(noRawat)
                setEws(noRawat, 'ralan', dokter.kd_sps || '')
                if (dokter.kd_sps == 'S0001') {
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

        // ================= TRIASE PRE-REGISTRASI UGD =================
        let targetLinkNoRawat = '';
        let targetLinkNoRkmMedis = '';
        let targetLinkPasienJk = '';
        let selectedIdTriasePreReg = '';

        $(document).ready(() => {
            loadUnlinkedTriaseCount();
        });

        function loadUnlinkedTriaseCount() {
            $.get('/erm/triase/prereg/unlinked').done((res) => {
                if (res.status === 'success' && res.data) {
                    $('#badgeCountUnlinkedTriase').text(res.data.length);
                }
            });
        }

        function showModalTriasePreReg() {
            $('#formTriasePreReg')[0].reset();
            for (let i = 1; i <= 5; i++) {
                $(`#ats_prereg_${i}`).prop('checked', false);
            }
            $('#modalTriasePreReg').modal('show');
            loadTriasePreRegTable();
        }

        function loadTriasePreRegTable() {
            if ($.fn.DataTable.isDataTable('.tblTriasePreReg')) {
                $('.tblTriasePreReg').DataTable().destroy();
            }

            $('.tblTriasePreReg').DataTable({
                responsive: true,
                paging: false,
                searching: false,
                info: false,
                ordering: false,
                ajax: {
                    url: '/erm/triase/get/indikator',
                    data: { no_rawat: '' }
                },
                columns: [
                    { data: 'nama_pemeriksaan' },
                    {
                        data: 'skala1',
                        render: function(data) {
                            var skala1 = JSON.parse(data);
                            var html = '<div class="d-flex flex-column">';
                            skala1.forEach(function(item) {
                                html += '<div class="form-check form-check-inline">';
                                html += '<input class="form-check-input item-prereg-skala1" type="checkbox" name="skala1[' + item.kode_skala1 + ']" id="prereg_skala1_' + item.kode_skala1 + '" value="' + item.kode_skala1 + '" onchange="recalculatePreRegAts()">';
                                html += '<label class="form-check-label text-nowrap" for="prereg_skala1_' + item.kode_skala1 + '">' + item.pengkajian_skala1 + '</label>';
                                html += '</div>';
                            });
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'skala2',
                        render: function(data) {
                            var skala2 = JSON.parse(data);
                            var html = '<div class="d-flex flex-column">';
                            skala2.forEach(function(item) {
                                html += '<div class="form-check form-check-inline">';
                                html += '<input class="form-check-input item-prereg-skala2" type="checkbox" name="skala2[' + item.kode_skala2 + ']" id="prereg_skala2_' + item.kode_skala2 + '" value="' + item.kode_skala2 + '" onchange="recalculatePreRegAts()">';
                                html += '<label class="form-check-label text-nowrap" for="prereg_skala2_' + item.kode_skala2 + '">' + item.pengkajian_skala2 + '</label>';
                                html += '</div>';
                            });
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'skala3',
                        render: function(data) {
                            var skala3 = JSON.parse(data);
                            var html = '<div class="d-flex flex-column">';
                            skala3.forEach(function(item) {
                                html += '<div class="form-check form-check-inline">';
                                html += '<input class="form-check-input item-prereg-skala3" type="checkbox" name="skala3[' + item.kode_skala3 + ']" id="prereg_skala3_' + item.kode_skala3 + '" value="' + item.kode_skala3 + '" onchange="recalculatePreRegAts()">';
                                html += '<label class="form-check-label text-nowrap" for="prereg_skala3_' + item.kode_skala3 + '">' + item.pengkajian_skala3 + '</label>';
                                html += '</div>';
                            });
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'skala4',
                        render: function(data) {
                            var skala4 = JSON.parse(data);
                            var html = '<div class="d-flex flex-column">';
                            skala4.forEach(function(item) {
                                html += '<div class="form-check form-check-inline">';
                                html += '<input class="form-check-input item-prereg-skala4" type="checkbox" name="skala4[' + item.kode_skala4 + ']" id="prereg_skala4_' + item.kode_skala4 + '" value="' + item.kode_skala4 + '" onchange="recalculatePreRegAts()">';
                                html += '<label class="form-check-label text-nowrap" for="prereg_skala4_' + item.kode_skala4 + '">' + item.pengkajian_skala4 + '</label>';
                                html += '</div>';
                            });
                            html += '</div>';
                            return html;
                        }
                    },
                    {
                        data: 'skala5',
                        render: function(data) {
                            var skala5 = JSON.parse(data);
                            var html = '<div class="d-flex flex-column">';
                            skala5.forEach(function(item) {
                                html += '<div class="form-check form-check-inline">';
                                html += '<input class="form-check-input item-prereg-skala5" type="checkbox" name="skala5[' + item.kode_skala5 + ']" id="prereg_skala5_' + item.kode_skala5 + '" value="' + item.kode_skala5 + '" onchange="recalculatePreRegAts()">';
                                html += '<label class="form-check-label text-nowrap" for="prereg_skala5_' + item.kode_skala5 + '">' + item.pengkajian_skala5 + '</label>';
                                html += '</div>';
                            });
                            html += '</div>';
                            return html;
                        }
                    }
                ]
            });
        }

        function onHeaderAtsChange(scaleIndex) {
            const isChecked = $(`#ats_prereg_${scaleIndex}`).is(':checked');
            $(`.item-prereg-skala${scaleIndex}`).prop('checked', isChecked);
            recalculatePreRegAts();
        }

        function recalculatePreRegAts() {
            let highestScale = '';
            let highestCategory = '';

            for (let i = 1; i <= 5; i++) {
                let count = $(`.item-prereg-skala${i}:checked`).length;
                $(`#ats_prereg_${i}`).prop('checked', count > 0);
            }

            if ($('.item-prereg-skala1:checked').length > 0) {
                highestScale = 1;
                highestCategory = 'MERAH';
            } else if ($('.item-prereg-skala2:checked').length > 0) {
                highestScale = 2;
                highestCategory = 'KUNING';
            } else if ($('.item-prereg-skala3:checked').length > 0) {
                highestScale = 3;
                highestCategory = 'KUNING';
            } else if ($('.item-prereg-skala4:checked').length > 0) {
                highestScale = 4;
                highestCategory = 'HIJAU';
            } else if ($('.item-prereg-skala5:checked').length > 0) {
                highestScale = 5;
                highestCategory = 'HIJAU';
            }

            if (highestScale !== '') {
                $('#skala_triase_select').val(highestScale);
                $('#kategori_triase_select').val(highestCategory);
            }
        }

        function simpanTriasePreReg() {
            const form = $('#formTriasePreReg');
            const nama = form.find('input[name="nama_pasien_temp"]').val();
            if (!nama) {
                alertWarning('Nama pasien / anonim wajib diisi!');
                return;
            }

            if (!form.find('select[name="skala_triase"]').val()) {
                alertWarning('Pilih Hasil Skala Utama ATS terlebih dahulu atau centang salah satu indikator triase!');
                return;
            }

            const detailSkalaJson = {
                skala1: [],
                skala2: [],
                skala3: [],
                skala4: [],
                skala5: [],
            };
            for (let i = 1; i <= 5; i++) {
                $(`.item-prereg-skala${i}:checked`).each(function() {
                    detailSkalaJson[`skala${i}`].push($(this).val());
                });
            }

            let formData = form.serializeArray();
            formData.push({ name: 'detail_skala_json', value: JSON.stringify(detailSkalaJson) });

            $('#btnSimpanTriasePreReg').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...');
            $.ajax({
                url: '/erm/triase/prereg/simpan',
                type: 'POST',
                data: $.param(formData),
                success: function (res) {
                    $('#btnSimpanTriasePreReg').prop('disabled', false).html('<i class="bi bi-check-lg me-1"></i> Simpan Triase Pre-Registrasi');
                    if (res.status === 'success') {
                        alertSuccessAjax(res.message);
                        $('#modalTriasePreReg').modal('hide');
                        loadUnlinkedTriaseCount();
                    } else {
                        alertErrorAjax(res.message);
                    }
                },
                error: function (xhr) {
                    $('#btnSimpanTriasePreReg').prop('disabled', false).html('<i class="bi bi-check-lg me-1"></i> Simpan Triase Pre-Registrasi');
                    alertErrorAjax(xhr.responseJSON?.message || 'Gagal menyimpan Triase Pre-Registrasi');
                }
            });
        }

        function showModalLinkTriasePreReg(no_rawat, no_rkm_medis, nm_pasien, jk, umur) {
            targetLinkNoRawat = no_rawat;
            targetLinkNoRkmMedis = no_rkm_medis;
            targetLinkPasienJk = (jk || '').toUpperCase();
            selectedIdTriasePreReg = '';

            $('#link_simrs_no_rawat').text(no_rawat);
            $('#link_simrs_no_rkm_medis').text(no_rkm_medis);
            $('#link_simrs_nm_pasien').text(nm_pasien);
            $('#link_simrs_jk_umur').html(`${jk == 'L' ? 'Laki-Laki (L)' : 'Perempuan (P)'} - ${umur}`);
            $('#btnEksekusiLinkTriase').prop('disabled', true);
            $('#alertLinkMismatch').addClass('d-none');

            loadUnlinkedTriaseList();
            $('#modalLinkTriasePreReg').modal('show');
        }

        function loadUnlinkedTriaseList() {
            const search = $('#searchUnlinkedTriase').val() || '';
            $.get('/erm/triase/prereg/unlinked', { search: search }).done((res) => {
                let html = '';
                if (res.status === 'success' && res.data && res.data.length > 0) {
                    res.data.forEach((item) => {
                        let colorBadge = 'bg-success text-white';
                        if (item.kategori_triase === 'MERAH') colorBadge = 'bg-danger text-white';
                        else if (item.kategori_triase === 'KUNING') colorBadge = 'bg-warning text-dark';
                        else if (item.kategori_triase === 'HITAM') colorBadge = 'bg-dark text-white';

                        const itemJk = (item.jk || '').toUpperCase();
                        const isMismatch = (targetLinkPasienJk && itemJk && targetLinkPasienJk !== itemJk);

                        html += `<tr class="${isMismatch ? 'table-warning' : ''}" style="cursor:pointer;" onclick="selectRowTriasePreReg('${item.id_triase}', '${itemJk}')">
                            <td class="text-center">
                                <input type="radio" name="radio_triase_prereg" value="${item.id_triase}" id="radio_${item.id_triase}">
                            </td>
                            <td>
                                <strong>${item.id_triase}</strong><br>
                                <small class="text-muted">${formatTanggal(item.tgl_triase)}</small>
                            </td>
                            <td><strong>${item.nama_pasien_temp}</strong></td>
                            <td>${item.jk == 'L' ? 'L' : 'P'} / ${item.umur_temp || '-'}</td>
                            <td>${item.keterangan_kedatangan || '-'}</td>
                            <td>
                                TD: ${item.tekanan_darah || '-'}, N: ${item.nadi || '-'}, S: ${item.suhu || '-'}, SpO2: ${item.saturasi_o2 || '-'}
                            </td>
                            <td class="text-center">
                                <span class="badge ${colorBadge}">ATS ${item.skala_triase} (${item.kategori_triase})</span>
                            </td>
                            <td><small>${item.petugas ? item.petugas.nama : item.nip_petugas}</small></td>
                        </tr>`;
                    });
                } else {
                    html = '<tr><td colspan="8" class="text-center py-3 text-muted">Tidak ada data Triase Pre-Registrasi unlinked yang tersedia.</td></tr>';
                }
                $('#tbodyUnlinkedTriase').html(html);
            });
        }

        function selectRowTriasePreReg(idTriase, triaseJk) {
            $(`#radio_${idTriase}`).prop('checked', true);
            selectedIdTriasePreReg = idTriase;
            $('#btnEksekusiLinkTriase').prop('disabled', false);

            if (targetLinkPasienJk && triaseJk && targetLinkPasienJk !== triaseJk) {
                $('#textLinkMismatch').text(`Peringatan: Jenis Kelamin Registrasi (${targetLinkPasienJk == 'L' ? 'Laki-Laki' : 'Perempuan'}) TIDAK COCOK dengan Triase Pre-Reg (${triaseJk == 'L' ? 'Laki-Laki' : 'Perempuan'}). Harap periksa kembali!`);
                $('#alertLinkMismatch').removeClass('d-none');
            } else {
                $('#alertLinkMismatch').addClass('d-none');
            }
        }

        function eksekusiLinkTriase() {
            if (!selectedIdTriasePreReg || !targetLinkNoRawat) {
                alertWarning('Pilih salah satu data Triase Pre-Registrasi!');
                return;
            }

            $('#btnEksekusiLinkTriase').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Menautkan...');
            $.ajax({
                url: '/erm/triase/prereg/link',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_triase: selectedIdTriasePreReg,
                    no_rawat: targetLinkNoRawat
                },
                success: function (res) {
                    $('#btnEksekusiLinkTriase').prop('disabled', false).html('<i class="bi bi-link-45deg me-1"></i> Tautkan Data Triase Ini');
                    if (res.status === 'success') {
                        alertSuccessAjax(res.message);
                        $('#modalLinkTriasePreReg').modal('hide');
                        $('#tb_ugd').DataTable().destroy();
                        tbUgd();
                        loadUnlinkedTriaseCount();

                        if ($('#modalAsmedUgd').is(':visible')) {
                            const openNoRawat = $('#formAsmedUgd input[name="no_rawat"]').val();
                            if (openNoRawat === targetLinkNoRawat) {
                                modalAsmedUgd(openNoRawat);
                            }
                        }
                    } else {
                        alertErrorAjax(res.message);
                    }
                },
                error: function (xhr) {
                    $('#btnEksekusiLinkTriase').prop('disabled', false).html('<i class="bi bi-link-45deg me-1"></i> Tautkan Data Triase Ini');
                    alertErrorAjax(xhr.responseJSON?.message || 'Gagal menautkan Triase');
                }
            });
        }

        function unlinkTriasePreReg(no_rawat, nm_pasien) {
            Swal.fire({
                title: 'Lepaskan Tautan Triase?',
                text: `Tautan data Triase Pre-Registrasi untuk pasien "${nm_pasien}" (${no_rawat}) akan dilepaskan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Lepas Tautan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/triase/prereg/unlink',
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            no_rawat: no_rawat
                        },
                        success: function (res) {
                            if (res.status === 'success') {
                                alertSuccessAjax(res.message);
                                $('#tb_ugd').DataTable().destroy();
                                tbUgd();
                                loadUnlinkedTriaseCount();
                            } else {
                                alertErrorAjax(res.message);
                            }
                        },
                        error: function (xhr) {
                            alertErrorAjax(xhr.responseJSON?.message || 'Gagal melepaskan tautan Triase');
                        }
                    });
                }
            });
        }
    </script>
@endpush