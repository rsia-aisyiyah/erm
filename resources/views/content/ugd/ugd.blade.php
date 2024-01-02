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
                            // list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalRiwayat('${row.no_rkm_medis}')" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
                            list += `<li><a class="dropdown-item" href="javascript:void(0)" onclick="listRiwayatPasien('${row.no_rkm_medis}')" data-id="${row.no_rkm_medis}">Riwayat Pemeriksaan</a></li>`;
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
    </script>
@endpush
