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
                    <button class="btn btn-success btn-sm" type="button" id="btn-filter-tgl"><i class="bi bi-search"></i></button>
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
                initComplete: function() {
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
                createdRow: function(row, data, dataIndex) {
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
                },
                columns: [{
                        data: '',
                        title: '',
                        render: function(data, type, row, meta) {

                            list = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalSoapUgd(\'' + row.no_rawat + '\')">CPPT</a></li>';
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalPemeriksaanPenunjang('${row.no_rawat}')">Pemeriksaan Penunjang</a></li>`
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAsmedUgd('${row.no_rawat}')">Asesmen Medis UGD ${cekList(row.asmed_igd)} </a></li>`;
                            list += renderListsAsesmenNyeri(row.pasien.tgl_lahir, row.tgl_registrasi, row.no_rawat)
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="hasilKritis('${row.no_rawat}')" data-id="${row.no_rawat}">Hasil Kritis</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="detailPeriksa('${row.no_rawat}', 'Ralan')">Upload Berkas Penunjang</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="skoringTb('${row.no_rawat}')">Skoring & Skrining TB ${cekList(row.skrining_tb)}</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${row.no_rkm_medis}')" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;

                            if (row.kd_pj == 'A01' || row.kd_pj == 'A05') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="riwayatIcare('${row.pasien.no_peserta}', '${row.dokter.mapping_dokter?.kd_dokter_bpjs}')">Riwayat Perawatan ICare</a></li>`
                            }

                            if (row.umurdaftar > 13 && row.sttsumur === 'Th') {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhDewasa('${row.no_rawat}')">Asesmen Resiko Jatuh Dewasa</a></li>`;
                            } else {
                                list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="showModalAsesmenResikoJatuhAnak('${row.no_rawat}')">Asesmen Resiko Jatuh Anak</a></li>`;
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


                            let asmed = '';
                            if (!data) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan No. RM ${row.no_rkm_medis}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return '';
                            }

                            kamarInap = Object.keys(row.kamar_inap).length ? `<button title="Pindah Kamar" class="btn btn-sm btn-success rounded-circle" type="button"><i class="bi bi-box-arrow-right"></i></button>` : '';
                            return `<strong>${row.no_rkm_medis}<br/>${row.pasien.nm_pasien} (${row.umurdaftar} ${row.sttsumur})</strong>`
                        }
                    },
                    {
                        title: 'Dokter',
                        data: 'dokter',
                        render: (data, type, row, meta) => {
                            if (!data) {
                                swal.fire({
                                    icon: 'error',
                                    html: `Gagal memuat pasien ${row.no_rawat} dengan No. ID Dokter ${row.kd_dokter}, periksa kembali data registrasi`,
                                    title: 'Terjadi Kesalahan',
                                    showConfirmButton: true,
                                    confirmButtonColor: '#3085d6',
                                })
                                return '';
                            }
                            return row.dokter.nm_dokter;
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
                            if (row.triase_skala1.length > 0) {
                                ats = `ATS I`
                                atsClass = 'bg-danger text-white';
                            } else if (row.triase_skala2.length > 0) {
                                ats = `ATS II`
                                atsClass = 'bg-warning text-dark';
                            } else if (row.triase_skala3.length > 0) {
                                ats = `ATS III`
                                atsClass = 'bg-success text-white';
                            } else if (row.triase_skala4.length > 0) {
                                ats = `ATS IV`
                                atsClass = 'bg-primary text-white';
                            } else if (row.triase_skala5.length > 0) {
                                ats = `ATS V`
                                atsClass = 'bg-secondary text-white';
                            }
                            return `<div class="${atsClass} p-2 text-center" style="font-family:monospace">${ats}</div>`
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
                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
                $('#formSoapUgd input[name="spesialis"]').val(response.dokter.kd_sps)
                $('#formResepUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formResepUgd input[name="kd_dokter"]').val(response.kd_dokter)


                const formInfoPasien = $('#formInfoPasien');

                formInfoPasien.find('input[name=no_rawat]').val(noRawat);
                formInfoPasien.find('input[name=no_rkm_medis]').val(response.no_rkm_medis);
                formInfoPasien.find('input[name=pasien]').val(`${response.pasien.nm_pasien} (${response.pasien.jk})`);
                formInfoPasien.find('input[name=tgl_lahir]').val(`${formatTanggal(response.pasien.tgl_lahir)} (${hitungUmur(response.pasien.tgl_lahir)})`);
                formInfoPasien.find('input[name=p_jawab]').val(response.p_jawab);
                formInfoPasien.find('input[name=penjab]').val(response.penjab.png_jawab);
                formInfoPasien.find('input[name=no_kartu]').val(response.pasien.no_kartu);
                formInfoPasien.find('input[name=dokter_dpjp]').val(response.dokter.nm_dokter);
                // formInfoPasien.find('input[name=dokter_dpjp]').val(response.pasien.no_kartu);

                const kamar = response.kamar_inap.filter((item) => {
                    return item.stts_pulang != 'Pindah Kamar'
                }).map((item) => {
                    return {
                        'bangsal': item.kamar ? item.kamar.bangsal.nm_bangsal : '-',
                        'diagnosa_awal': item?.diagnosa_awal
                    }
                })[0]
                formInfoPasien.find('input[name=kamar]').val(kamar ? kamar.bangsal : '-');
                formInfoPasien.find('input[name=diagnosa_awal]').val(kamar ? kamar.diagnosa_awal : '-');



                getResepObat(noRawat)
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
                                    teksRr += `   - ${dr.databarang.nama_brng} dosis ${dr.kandungan} mg, jml : ${dr.jml}\n`
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
