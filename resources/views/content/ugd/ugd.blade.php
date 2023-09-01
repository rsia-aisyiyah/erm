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
                                <button class="btn btn-success btn-sm" type="button" id="btn-filter-tgl"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <label for="" style="font-size: 12px;margin-bottom:0px">Pasien</label>
                            <input type="search" class="form-control form-control-sm" id="cari-pasien" placeholder="" autocomplete="off">
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-12">
                            <label for="" style="font-size: 12px;margin-bottom:0px">Spesialis</label>
                            <select name="spesialis" id="spesialis" class="form-select form-select-sm">
                                <option value="">Semua</option>
                                <option value="S0007">Spesialis Umum</option>
                                <option value="S0003">Spesialis Anak</option>
                                <option value="S0001">Spesialis Kandungan & Kebidanan</option>
                            </select>
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
    @include('content.ugd.modal.pemeriksaan')
    @include('content.ugd.modal.asmed')
@endsection


@push('script')
    <script type="text/javascript">
        var tgl_awal = '';
        var tgl_akhir = '';
        var nm_pasien = '';
        var spesialis = '';
        var tableUdg = '';
        var dateStart = '';
        $(document).ready(() => {
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
            $('.tgl_awal').datepicker('setDate', splitTanggal(tgl_awal))
            $('.tgl_akhir').datepicker('setDate', splitTanggal(tgl_akhir))

        })
        $('#spesialis').on('change', () => {
            spesialis = $('#spesialis option:selected').val()
            localStorage.setItem('spesialis', spesialis);
            $('#tb_ugd').DataTable().destroy();
            tbUgd()
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
                scrollY: 400,
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
                        spesialis: spesialis,
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

        $('#cari-pasien').on('keyup', () => {
            const nama = $('#cari-pasien').val()
            if (nama.length >= 3) {
                nm_pasien = nama;
                localStorage.setItem('nm_pasien', nm_pasien)
                $('#tb_ugd').DataTable().destroy()
                tbUgd();
            }
        })
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
                $.map(resep, (res) => {
                    no_resep = resep.length ? res.no_resep : '';
                    if (res.resep_dokter.length) {
                        $.map(res.resep_dokter, (rd) => {
                            console.log(rd);
                            html = `<tr>
                                    <td>${rd.no_resep}</td>
                                    <td>${rd.data_barang.nama_brng}</td>
                                    <td>${rd.jml}</td>
                                    <td>${rd.aturan_pakai}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></button>
                                        <button class="btn btn-sm btn-danger" onclick="hapusObatUmum('${rd.kode_brng}')"><i class="bi bi-trash"></i></button>
                                    </td>
                                    </tr>`
                            $('#tb-resep-umum-ugd').append(html)
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
                $('#formResepUgd input[name="no_rawat"]').val(response.no_rawat)
                $('#formResepUgd input[name="kd_dokter"]').val(response.kd_dokter)
                setListResep(noRawat);
            })
            $('#formSoapUgd input[name="nama"]').val("{{ session()->get('pegawai')->nama }}")
            $('#formSoapUgd input[name="nik"]').val("{{ session()->get('pegawai')->nik }}")
            $('#modalSoapUgd').modal('show')
            $('#tbSoapUgd').DataTable().destroy();
            $('.btn-umum').attr('onclick', `tambahUmum('${noRawat}')`)
            $('.btn-racikan').attr('onclick', `tambahUmum('${noRawat}')`)
            tbSoapUgd(noRawat);
            setEws(noRawat, 'ralan')
            // getLastNoResep().done((result) => {
            //     const noResep = parseInt(result.no_resep) + 1;

            // })


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
