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

        function reloadTabelPoli() {
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
            }, 60000);
        }
        $(document).ready(function() {
            tb_pasien();
        })

        function statusUpload(no_rawat, no_reg) {
            $.ajax({
                url: 'status/upload',
                data: {
                    'no_rawat': no_rawat,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#upload-' + no_reg).addClass(
                        'bi bi-cloud-upload-fill')
                    $('#btn-upload-' + no_reg).addClass('btn-primary')
                    if (response > 0) {
                        $('#upload-' + no_reg).addClass(
                            'bi bi-check2-circle')
                        $('#btn-upload-' + no_reg).addClass('btn-success')
                    }

                },

            })

        }

        function statusPeriksa(no_rawat, no_reg) {
            $.ajax({
                url: 'status/periksa',
                data: {
                    'no_rawat': no_rawat,
                },
                dataType: 'JSON',
                success: function(response) {
                    $('#icon-periksa-' + no_reg).addClass(
                        'bi bi-pencil-square')
                    $('#btn-periksa-' + no_reg).addClass('btn-primary')
                    if (response > 0) {
                        $('#icon-periksa-' + no_reg).addClass(
                            'bi bi-check2-circle')
                        $('#btn-periksa-' + no_reg).addClass('btn-success')
                    }

                },

            })
        }

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
                processing: false,
                scrollX: true,
                serverSide: false,
                stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                lenghtChange: false,
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
                        data: '',
                        render: function(data, type, row, meta) {
                            statusPeriksa(row.no_rawat, row.no_reg)
                            statusUpload(row.no_rawat, row.no_reg)
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
                                '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilAskep(\'' +
                                row.no_rkm_medis +
                                '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-id="' +
                                row.no_rkm_medis +
                                '"><i class="bi bi-file-bar-graph-fill"></i> ASKEP</button>';
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
            $.ajax({
                url: 'askep/kebidanan',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    let data = response.data;

                    if (data) {
                        $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                        $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' : ': Perempuan')
                        $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa.tgl_registrasi));
                        $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                        $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien.tgl_lahir) + ' / ' +
                            data
                            .reg_periksa.umurdaftar + ' ' + data.reg_periksa.sttsumur);
                        $('.anamnesis').html(': ' + data.informasi);
                        $('.tensi').html(': ' + data.td + ' mmHG');
                        $('.nadi').html(': ' + data.nadi + ' x/menit');
                        $('.respirasi').html(': ' + data.rr + ' x/menit');
                        $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                        $('.gcs').html(': ' + data.gcs);
                        $('.bb').html(': ' + data.bb + ' Kg');
                        $('.tb').html(': ' + data.bb + ' Cm');
                        $('.lila').html(': ' + data.lila + ' Cm');
                        $('.bmi').html(': ' + data.bmi + ' Kg/m<sup>2</sup>');
                        $('.tfu').html(': ' + data.tfu + ' Cm');
                        $('.tbj').html(': ' + data.tbj + ' Cm');
                        $('.letak').html(': ' + data.letak);
                        $('.presentasi').html(': ' + data.presentasi);
                        $('.penurunan').html(': ' + data.penurunan);
                        $('.kontraksi').html(': ' + data.his + ' x/10');
                        $('.kekuatan').html(': ' + data.kekuatan);
                        $('.lama').html(': ' + data.lama + ' detik');
                        $('.djj').html(': ' + data.bjj + ' /mnt ' + data.ket_bjj);
                        $('.portio').html(': ' + data.portio);
                        $('.serviks').html(': ' + data.serviks + ' Cm');
                        $('.ketuban').html(': ' + data.ketuban + ' kep/bok');
                        $('.hodge').html(': ' + data.hodge);
                        $('.inspekulo').html(': ' + data.inspekulo + ' ,<br/>Hasil : ' + data.ket_inspekulo);
                        $('.ctg').html(': ' + data.ctg + ' ,<br/>Hasil : ' + data.ket_ctg);
                        $('.lakmus').html(': ' + data.lakmus + ' ,<br/>Hasil : ' + data.ket_lakmus);
                        $('.lab').html(': ' + data.lab + ' ,<br/>Hasil : ' + data.ket_lab);
                        $('.usg').html(': ' + data.usg + ' ,<br/>Hasil : ' + data.ket_usg);
                        $('.panggul').html(': ' + data.panggul);
                        $('.keluhan').text(': ' + data.keluhan_utama);
                        $('.umur').text(': ' + data.umur + ' Th');
                        $('.lama').text(': ' + data.umur + ' Hari');
                        $('.banyak').text(': ' + data.umur + ' Pembalut');
                        $('.haid').text(': ' + data.haid);
                        $('.siklus').text(': ' + data.siklus + ' hari');
                        $('.ket_siklus1').text(data.ket_siklus1);
                        $('.ket_siklus2').text(': ' + data.ket_siklus2);
                        $('.status').text(': ' + data.status);
                        $('.kali').text(data.kali);
                        $('.usia1').text(data.usia1);
                        $('.ket1').text(data.ket1);
                        $('.usia2').text(data.usia2);
                        $('.ket2').text(data.ket2);
                        $('.usia3').text(data.usia3);
                        $('.ket3').text(data.ket3);
                        $('.hpht').text(': ' + formatTanggal(data.hpht));
                        $('.usia_kehamilan').text(': ' + data.usia_kehamilan + ' bln/mgg');
                        $('.tp').text(': ' + formatTanggal(data.tp));
                        $('.imunisasi').text(': ' + data.imunisasi);
                        $('.ket_imunisasi').text(data.ket_imunisasi ? data.ket_imunisasi : '-');
                        $('.gpa').text('G : ' + data.g + ', P :' + data.p + ', A : ' + data.a);
                        $('.hidup').text(data.hidup);
                        $('.ginekologi').text(data.ginekologi);
                        $('.kebiasaan').text(data.kebiasaan + ', ' + data.ket_kebiasaan);
                        $('.kebiasaan1').text(data.kebiasaan1 + ', ' + data.ket_kebiasaan1 + ' Batang /hari');
                        $('.kebiasaan2').text(data.kebiasaan2 + ', ' + data.ket_kebiasaan2 + ' Botol /hari');
                        $('.kebiasaan3').text(data.kebiasaan3);
                        $('.kb').text(data.kb + ' , ', +data.ket_kb);
                        $('.kb').text(data.kb);
                        $('.ket_kb').text(data.ket_kb);
                        $('.komplikasi').text(data.komplikasi + ', ' + data.ket_komplikasi);
                        $('.berhenti').text(data.berhenti);
                        $('.alasan').text(data.alasan);

                        no = 1;
                        data.reg_periksa.pasien.riwayat_persalinan.forEach(function(riwayat) {
                            console.log(riwayat)
                            html = '<tr>';
                            html += '<td>' + no + '</td>'
                            html += '<td>' + formatTanggal(riwayat.tgl_thn) + '</td>'
                            html += '<td>' + riwayat.tempat_persalinan + '</br>' + riwayat.penolong +
                                '</td>'
                            html += '<td>' + riwayat.usia_hamil + '</td>'
                            html += '<td> Persalinan : ' + riwayat.jenis_persalinan +
                                '<br/> Penyulit : ' +
                                riwayat
                                .penyulit +
                                '</td>'
                            html += '<td> JK : ' + riwayat.jk + '<br/> BB/PB : ' + riwayat.bbpb +
                                '<br/> Keadaaan : ' + riwayat.keadaan + '</td>'
                            html += '</tr>';
                            no++;
                            $('.r_persalinan').append(html)
                        })

                        $('#modalAskep').modal('show');
                    } else {
                        // $('#modalAskep').modal('toggle');
                        Swal.fire(
                            'Kosong!', 'Belum ada riwayat perawatan', 'error'
                        );
                    }


                }
            });
        }
    </script>
@endpush
