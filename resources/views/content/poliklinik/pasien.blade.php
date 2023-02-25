@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Poli : {{ $poli->nm_poli }}</h5>
                    <p style="background-color: #0067dd;color:white;padding:5px">
                        Dokter : <strong>{{ $dokter->nm_dokter }}</strong>
                    </p>
                    <table>
                        <tr style="height: 25px">
                            <td>Jumlah Pasien</td>
                            <td>:</td>
                            <td width="100px">
                                <button class="btn btn-sm" id="count-pasien"
                                    style=" display: block; width:auto; border-radius: 50%; background-color: #0067dd; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                            <td>Selesai</td>
                            <td>:</td>
                            <td>
                                <button id="count-selesai" class="btn btn-sm btn-success"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                        </tr>
                        <tr style="height: 40   px">
                            <td>Menunggu</td>
                            <td>:</td>
                            <td>
                                <button id="count-tunggu" class="btn btn-sm btn-warning"
                                    style=" display: block; width:auto; border-radius: 50%; color:rgb(48, 48, 48); font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                            <td>Batal</td>
                            <td>:</td>
                            <td>
                                <button id="count-batal" class="btn btn-sm btn-danger"
                                    style=" display: block; width:auto; border-radius: 50%; color:white; font-weight:bold; font-size:9pt">
                                </button>
                            </td>
                        </tr>

                    </table>

                    <input type="hidden" id="hitung-panggil" value="">

                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_pasien" width="100%">
                        <thead>
                            <tr role="row">
                                <th style="width: 20px">Aksi</th>
                                <th>Nama</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
        @include('content.upload.inforegistrasi')
        @include('content.upload.resume')
    </div>
    @include('content.poliklinik.modal.modal_soap')
    @include('content.poliklinik.modal.modal_riwayat')
    @include('content.poliklinik.modal.modal_askep')
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        var isModalSoapShow = false;
        var kd_poli = '{{ $poli->kd_poli }}';
        var kd_dokter = '{{ $dokter->kd_dokter }}';

        $(document).ready(function() {
            tb_pasien();
            hitungUpload();
            hitungSelesai();
            hitungPasien();
            hitungPanggilan();
            hitungBatal();
            hitungTunggu();
            setInterval(function() {
                $('#tb_pasien').DataTable().destroy();
                tb_pasien();
                hitungUpload();
                hitungSelesai();
                hitungPanggilan();
                hitungBatal();
                hitungTunggu();

                if (isModalSoapShow == false) {
                    Swal.fire({
                        title: 'Memuat ulang data register!',
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }, 25000);
        })

        function hitungPasien() {
            $.ajax({
                url: '/erm/pemeriksaan/jumlah',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter
                },
                method: 'GET',
                success: function(response) {
                    $('#count-pasien').text(response);
                }
            })
        }

        $('#modalSoap').on('shown.bs.modal', function() {
            modalsoap(id);
            isModalSoapShow = true;
        });

        $('#modalSoap').on('hidden.bs.modal', function() {
            isModalSoapShow = false;
        });


        function simpanSoap() {
            $.ajax({
                url: '/erm/pemeriksaan/simpan',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    no_rawat: id,
                    suhu_tubuh: $('#suhu').val(),
                    tensi: $('#tensi').val(),
                    nadi: $('#nadi').val(),
                    respirasi: $('#respirasi').val(),
                    tinggi: $('#tinggi').val(),
                    berat: $('#berat').val(),
                    spo2: $('#spo2').val(),
                    gcs: $('#gcs').val(),
                    kesadaran: $('#kesadaran').val(),
                    rtl: $('#plan').val(),
                    keluhan: $('#subjek').val(),
                    penilaian: $('#asesmen').val(),
                    pemeriksaan: $('#objek').val(),
                    alergi: $('#alergi').val(),
                    instruksi: $('#instruksi').val(),
                    evaluasi: '-',
                    nip: $('#nik').val(),
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data SOAP disimpan',
                        position: 'center',
                        toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500,
                    })

                    $('#modalSoap').modal('hide');
                }
            })
        }

        function modalsoap(no_rawat) {
            jbtn = "{{ session()->get('pegawai')->jbtn }}";
            nik = "{{ session()->get('pegawai')->nik }}";
            nama = "{{ session()->get('pegawai')->nama }}";
            $.ajax({
                url: '/erm/pemeriksaan',
                method: 'GET',
                dataType: 'JSON',
                data: {
                    no_rawat: no_rawat,
                },
                success: function(response) {
                    if (response.reg_periksa) {
                        $('#nama_pasien').val(response.reg_periksa.pasien.nm_pasien ? response.reg_periksa
                            .pasien
                            .nm_pasien : '-')
                        $('#no_rm').val(response.reg_periksa.no_rkm_medis ? response.reg_periksa.no_rkm_medis :
                            '-')
                    } else {
                        $('#nama_pasien').val(response.pasien.nm_pasien ? response.pasien
                            .nm_pasien : '-')
                        $('#no_rm').val(response.no_rkm_medis ? response.no_rkm_medis : '-')

                    }

                    $('#nama').val(nama);
                    $('#nik').val(nik);
                    $('#jabatan').val(jbtn);

                    $('#nomor_rawat').val(response.no_rawat ? response.no_rawat : '-')
                    $('#tgl_perawatan').val(response.tgl_perawatan ? response.tgl_perawatan : '-')
                    $('#subjek').val(response.keluhan ? response.keluhan : '-')
                    $('#objek').val(response.pemeriksaan ? response.pemeriksaan : '-')
                    $('#asesmen').val(response.penilaian ? response.penilaian : '-')
                    $('#plan').val(response.rtl ? response.rtl : '-')
                    $('#instruksi').val(response.instruksi ? response.instruksi : '-')
                    $('#suhu').val(response.suhu_tubuh ? response.suhu_tubuh : '-')
                    $('#tensi').val(response.tensi ? response.tensi : '-')
                    $('#tinggi').val(response.tinggi ? response.tinggi : '-')
                    $('#berat').val(response.berat ? response.berat : '-')
                    $('#gcs').val(response.gcs ? response.gcs : '-')
                    $('#respirasi').val(response.respirasi ? response.respirasi : '-')
                    $('#alergi').val(response.alergi ? response.alergi : '-')
                    $('#nadi').val(response.nadi ? response.nadi : '-')
                    $('#spo2').val(response.spo2 ? response.spo2 : '-')
                },
                error: function(xhr, status, error) {
                    console.log(error)
                }
            })
        }

        function hitungSelesai() {
            $.ajax({
                url: '/erm/registrasi/selesai',
                method: 'GET',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#count-selesai').text(response)
                }
            });
        }

        function hitungBatal() {
            $.ajax({
                url: '/erm/registrasi/batal',
                method: 'GET',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#count-batal').text(response)
                }
            });
        }

        function hitungTunggu() {
            $.ajax({
                url: '/erm/registrasi/tunggu',
                method: 'GET',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#count-tunggu').text(response)
                }
            });
        }

        function hitungUpload() {
            $.ajax({
                url: 'count/{{ $poli->kd_poli }}?dokter={{ $dokter->kd_dokter }}',
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    $('#count-uploaded').text(data)
                }
            })
        }

        function tb_pasien() {
            var table = $('#tb_pasien').DataTable({
                processing: true,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                paging: false,
                info: false,
                columnDefs: [{
                    width: 50,
                    targets: 0,
                }],
                ajax: {
                    url: "table",
                    data: {
                        kd_poli: "{{ Request::segment(2) }}",
                        dokter: "{{ Request::get('dokter') }}",
                    },
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = '';
                            if (row.stts == 'Batal') {
                                html =
                                    '<h3 class="text-danger" align="center"><i class="bi bi-x-circle-fill"></i></h3>';
                            } else if (row.stts == 'Sudah') {
                                html =
                                    '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>';
                            } else {

                                if (row.stts == 'Berkas Diterima' || row.stts == 'Periksa') {
                                    $('.panggil-' + row.no_reg).text('RE-CALL');
                                    $('.selesai-' + row.no_reg).addClass('btn-warning');
                                    $('.panggil-' + row.no_reg).prop('style',
                                        'width:80px;background-color:#9800af;border-color:#8e06a3;color:white'
                                    );
                                    $('.batal-' + row.no_reg).addClass('btn-danger');
                                } else {
                                    $('.panggil-' + row.no_reg).addClass('btn-success');
                                    $('.batal-' + row.no_reg).addClass('btn-secondary');
                                    $('.selesai-' + row.no_reg).addClass('btn-secondary');
                                    $('.panggil-' + row.no_reg).text('PANGGIL')
                                    $('.batal-' + row.no_reg).prop('disabled', true);
                                    $('.selesai-' + row.no_reg).prop('disabled', true);
                                }
                                html = '<div id="aksi">';
                                html += ' <button onclick="panggil(\'' + row.no_reg +
                                    '\')" class="btn btn-sm mb-2 panggil-' + row.no_reg +
                                    '" type="button" style="width:80px;" data-id="' + row.no_rawat +
                                    '"></button><br/>';
                                html += ' <button onclick="selesai(\'' + row.no_reg +
                                    '\')" class="btn btn-sm mb-2 selesai-' + row.no_reg +
                                    '" type="button" style="width:80px;" data-id="' + row.no_rawat +
                                    '">SELESAI</button><br/>';
                                html += ' <button onclick="batal(\'' + row.no_reg +
                                    '\')" class="btn btn-sm mb-2 batal-' + row.no_reg +
                                    '" type="button" style="width:80px;" data-id="' + row.no_rawat +
                                    '">BATAL</button><br/>';
                                html += '</div>';
                            }
                            return html
                        },
                        name: 'aksi'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {

                            if (row.kd_pj == 'A01' || row.kd_pj == 'A05') {
                                classTeksPenjab = 'text-success';
                            } else {
                                classTeksPenjab = 'text-danger';
                            }

                            html = '<h5>' + row.no_reg + '</h5>';
                            html += '<p>' + row.pasien.nm_pasien + '</br>' + row.no_rawat +
                                '</br><i><strong class="' + classTeksPenjab + ' h6">' + row.penjab
                                .png_jawab + '</strong></i></p>';

                            return html;
                        },
                        name: 'nm_pasien'

                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            $.ajax({
                                url: 'status/upload',
                                data: {
                                    'no_rawat': row.no_rawat,
                                },
                                success: function(response) {
                                    if (Object.keys(response).length > 0) {
                                        $('#upload-' + row.no_reg).addClass(
                                            'bi bi-check2-circle')
                                        $('#btn-upload-' + row.no_reg).addClass('btn-success')
                                    } else {
                                        $('#upload-' + row.no_reg).addClass(
                                            'bi bi-cloud-upload-fill')
                                        $('#btn-upload-' + row.no_reg).addClass('btn-primary')
                                    }
                                }
                            })
                            $.ajax({
                                url: 'status/periksa',
                                data: {
                                    'no_rawat': row.no_rawat,
                                },
                                success: function(response) {
                                    if (Object.keys(response).length > 0) {
                                        $('#icon-periksa-' + row.no_reg).addClass(
                                            'bi bi-check2-circle')
                                        $('#btn-periksa-' + row.no_reg).addClass('btn-success')
                                    } else {
                                        $('#icon-periksa-' + row.no_reg).addClass(
                                            'bi bi-pencil-square')
                                        $('#btn-periksa-' + row.no_reg).addClass('btn-primary')
                                    }
                                }
                            })
                            html =
                                '<a href="#form-upload" class="btn btn-sm mb-2 mr-1" style = "width:80px;font-size:12px;text-align:left" onclick = "detailPeriksa(\'' +
                                row.no_rawat + '\',\'' + row.status_lanjut + '\')" id="btn-upload-' + row
                                .no_reg +
                                '"><i id="upload-' +
                                row.no_reg + '" class=""></i> UPLOAD</a></br>';
                            html +=
                                '<button id="btn-periksa-' + row.no_reg +
                                '" style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRawat(\'' +
                                row.no_rawat +
                                '\')" class="btn btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalSoap" data-id="' +
                                row.no_rawat + '"><i class="" id="icon-periksa-' +
                                row.no_reg + '"></i> SOAP</button><br/>';
                            html +=
                                '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRm(\'' +
                                row.no_rkm_medis +
                                '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="' +
                                row.no_rkm_medis + '"><i class="bi bi-search"></i>RIWAYAT</button></br>';
                            html +=
                                '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilAskeb(\'' +
                                row.no_rkm_medis +
                                '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalAsmed" data-id="' +
                                row.no_rkm_medis +
                                '"><i class="bi bi-file-bar-graph-fill"></i> ASMED</button>';
                            return html;
                        },
                        name: 'upload',
                    }

                ],
                "language": {
                    "zeroRecords": "Tidak ada data pasien terdaftar",
                    "infoEmpty": "Tidak ada data pasien terdaftar",
                }
            });
        }

        function ambilAskep(no_rkm_medis) {
            $('#modalAskep').modal('show');
        }
    </script>
@endpush
