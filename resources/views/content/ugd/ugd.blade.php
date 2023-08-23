@extends('index')
@section('contents')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Pasien UGD
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <label for="tgl_registrasi" class="form-label" style="font-size: 12px;margin-bottom:0px">Periode</label>
                            <div class="input-group input-group-sm input-daterange">
                                <input type="text" class="form-control form-control-sm tgl_awal" style="font-size:12px">
                                <div class="input-group-text">ke</div>
                                <input type="text" class="form-control form-control-sm tgl_akhir" style="font-size:12px">
                                {{-- <div class="input-group-text">ke</div> --}}
                                <button class="btn btn-success btn-sm" type="button" id="btn-filter-tgl"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <label for="" style="font-size: 12px;margin-bottom:0px">Pasien</label>
                            <input type="search" class="form-control form-control-sm" id="nm_pasien" placeholder="" autocomplete="off">
                        </div>
                    </div>
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
    @include('content.ugd.modal.soap')
    @include('content.ugd.modal.asmed')
@endsection


@push('script')
    <script type="text/javascript">
        var tgl_awal = '';
        var tgl_akhir = '';
        var nm_pasien = '';
        var tableUdg = '';
        var dateStart = '';
        $(document).ready(() => {
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
            $('.tgl_awal').datepicker('setDate', splitTanggal(tgl_awal))
            $('.tgl_akhir').datepicker('setDate', splitTanggal(tgl_akhir))
        })
        $('#btn-filter-tgl').on('click', () => {
            t1 = $('.tgl_awal').datepicker('getFormattedDate')
            t2 = $('.tgl_akhir').datepicker('getFormattedDate')
            tgl_awal = splitTanggal(t1);
            tgl_akhir = splitTanggal(t2);
            localStorage.setItem('tgl_awal', tgl_awal)
            localStorage.setItem('tgl_akhir', tgl_akhir)
            $('#tb_ugd').DataTable().destroy();
            tbUgd()
        })


        function getAsmedUgd(noRawat) {
            const no_rawat = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/ugd/asesmen/medis/' + no_rawat,
                method: 'GET',
            });

            return asmed;
        }

        function tbUgd() {
            tableUdg = $('#tb_ugd').DataTable({
                processing: true,
                scrollX: true,
                scrollY: 600,
                serverSide: true,
                stateSave: true,
                ordering: false,
                paging: false,
                info: false,
                searching: false,
                ajax: {
                    url: "/erm/ugd/get/table",
                    data: {
                        tgl_awal: tgl_awal,
                        tgl_akhir: tgl_akhir,
                        nm_pasien: nm_pasien,
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
                        data: '',
                        render: function(data, type, row, meta) {
                            list = '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalSoapUgd(\'' + row.no_rawat + '\')">S.O.A.P</a></li>';
                            list += '<li><a class="dropdown-item" href="javascript:void(0)" onclick="modalAsmedUgd(\'' + row.no_rawat + '\')">Asesmen Medis UGD</a></li>';
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
                                return '<span class="text-danger">Rawat Inap</span>';
                            } else {
                                return '<span class="text-success">Rawat Jalan</span>';

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

        function modalSoapUgd(noRawat) {

            getRegPeriksa(noRawat).done((response) => {
                $('#formSoapUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formSoapUgd input[name="nm_pasien"]').val(`${response.pasien.nm_pasien} (${hitungUmur(response.pasien.tgl_lahir)})`)
            })
            $('#formSoapUgd input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
            $('#formSoapUgd input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")
            $('#modalSoapUgd').modal('show')
            $('#tbSoapUgd').DataTable().destroy();
            tbSoapUgd(noRawat);
            setEws(noRawat, 'ralan')


        }

        function modalAsmedUgd(params) {

            getAsmedUgd(params).done((response) => {
                if (Object.keys(response).length == 0) {
                    return getRegPeriksa(params).done((regPeriksa) => {
                        console.log(regPeriksa)
                        $('#formAsmedUgd input[name="no_rawat"]').val(regPeriksa.no_rawat)
                        $('#formAsmedUgd input[name="pasien"]').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                        $('#formAsmedUgd input[name="tgl_lahir"]').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} (${hitungUmur(regPeriksa.pasien.tgl_lahir)})`)
                        $('#formAsmedUgd input[name="kd_dokter"]').val(regPeriksa.kd_dokter)
                        $('#formAsmedUgd input[name="dokter"]').val(regPeriksa.dokter.nm_dokter)
                        $('.btn-asmed-ugd-ubah').css('display', 'none')
                        $('.btn-asmed-ugd').css('display', 'inline')
                    })
                }
                $('.btn-asmed-ugd').css('display', 'none')
                $('.btn-asmed-ugd-ubah').css('display', 'inline')
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
            })
            $('#modalAsmedUgd').modal('show');
        }
    </script>
@endpush
