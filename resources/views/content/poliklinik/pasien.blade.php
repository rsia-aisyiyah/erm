@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Poli : {{ $poli->nm_poli }}</h5>
                    <p style="background-color: #0067dd;color:white;padding:5px">
                        <strong>{{ Request::get('dokter') ? 'Dokter : ' . $dokter->nm_dokter : '' }}</strong>
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
    @include('content.poliklinik.modal.modal_askep_anak')
    @include('content.poliklinik.modal.modal_resep')
@endsection

@push('script')
    <script type="text/javascript">
        var id = '';
        var isModalShow = false;
        var kd_poli = '{{ $poli->kd_poli }}';
        var kd_dokter = "{{ Request::get('dokter') }}";


        $(document).ready(function() {
            tb_pasien();
            hitungPanggilan();
            // reloadTabelPoli();
            // alert(kd_dokter)

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

        function simpanSoap() {
            $.ajax({
                url: '/erm/pemeriksaan/simpan',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    no_rawat: $('#nomor_rawat').val(),
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
                        // toast: true,
                        icon: 'success',
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    hitungPanggilan();
                    reloadTabelPoli();
                    $('#modalSoap').modal('hide');
                }
            })
        }

        function hitungUmur(tgl_lahir) {
            sekarang = new Date();
            hari = new Date(sekarang.getFullYear(), sekarang.getMonth(), sekarang.getDate());

            var tahunSekarang = sekarang.getFullYear();
            var bulanSekarang = sekarang.getMonth();
            var tanggalSekarang = sekarang.getDate();

            splitTgl = tgl_lahir.split('-');
            lahir = new Date(splitTgl[0], splitTgl[1] - 1, splitTgl[2]);


            tahunLahir = lahir.getFullYear();
            bulanLahir = lahir.getMonth();
            tanggalLahir = lahir.getDate();

            umurTahun = tahunSekarang - tahunLahir;
            if (bulanSekarang >= bulanLahir) {
                umurBulan = bulanSekarang - bulanLahir;
            } else {
                umurTahun--;
                umurBulan = 12 + bulanSekarang - bulanLahir;
            }

            if (tanggalSekarang >= tanggalLahir) {
                umurTanggal = tanggalSekarang - tanggalLahir;
            } else {
                umurBulan--;
                if (bulanSekarang == '1') {
                    if (bulanSekarang % 4 == 0) {
                        jmlHari = 29;
                    } else {
                        jmlHari = 28;
                    }
                } else if (bulanSekarang == '0' && bulanSekarang == '2' && bulanSekarang == '4' && bulanSekarang == '6' &&
                    bulanSekarang == '8' && bulanSekarang == '9') {
                    jmlHari = 31;
                } else {
                    jmlHari = 30;
                }
                umurTanggal = jmlHari + tanggalSekarang - tanggalLahir;
            }

            return umurTahun + ' Th ' + umurBulan + ' Bln ' + umurTanggal + ' Hari';
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
                            .pasien.nm_pasien + ' / ' + hitungUmur(response.reg_periksa.pasien.tgl_lahir) :
                            '-')
                        $('#no_rm').val(response.reg_periksa.no_rkm_medis ? response.reg_periksa.no_rkm_medis :
                            '-')
                        $('#p_jawab').val(response.reg_periksa.p_jawab ? 'P. JAWAB : ' + response.reg_periksa
                            .p_jawab : '-')
                        cekAlergi(response.reg_periksa.no_rkm_medis)
                        riwayatResep(response.reg_periksa.no_rkm_medis)

                        $('#nama').val(response.pegawai.nama);
                        $('#nik').val(response.nip);
                    } else {
                        riwayatResep(response.no_rkm_medis)
                        cekAlergi(response.no_rkm_medis)

                        $('#nama_pasien').val(response.pasien.nm_pasien ? response.pasien
                            .nm_pasien + ' / ' + hitungUmur(response.pasien.tgl_lahir) : '-')
                        $('#no_rm').val(response.no_rkm_medis ? response.no_rkm_medis : '-')
                        $('#p_jawab').val(response.p_jawab ? 'P. JAWAB : ' + response.p_jawab : '-')
                        $('#nama').val(nama);
                        $('#nik').val(nik);

                    }

                    // $('#jabatan').val(jbtn);

                    $('#nomor_rawat').val(response.no_rawat ? response.no_rawat : '-')
                    $('#tgl_perawatan').val(response.tgl_perawatan ? response.tgl_perawatan : '-')
                    $('#subjek').val(response.keluhan ? response.keluhan : '-')
                    $('#objek').val(response.pemeriksaan ? response.pemeriksaan : '-')
                    $('#asesmen').val(response.penilaian ? response.penilaian : '-')
                    $('#plan').val(response.rtl ? response.rtl : '')
                    $('#instruksi').val(response.instruksi ? response.instruksi : '-')
                    $('#suhu').val(response.suhu_tubuh ? response.suhu_tubuh : '-')
                    $('#tensi').val(response.tensi ? response.tensi : '-')
                    $('#tinggi').val(response.tinggi ? response.tinggi : '-')
                    $('#berat').val(response.berat ? response.berat : '-')
                    $('#gcs').val(response.gcs ? response.gcs : '-')
                    $('#respirasi').val(response.respirasi ? response.respirasi : '-')
                    $('#nadi').val(response.nadi ? response.nadi : '-')
                    $('#spo2').val(response.spo2 ? response.spo2 : '-')

                },
                error: function(xhr, status, error) {
                    console.log(xhr, status, error)
                }
            })
        }

        function riwayatResep(no_rm) {
            $('#tb-resep-riwayat tbody').empty()
            $.ajax({
                url: '/erm/pasien/ambil/' + no_rm,
                method: 'GET',
                success: function(response) {
                    $.map(response.reg_periksa, function(reg) {
                        if (Object.keys(reg.resep_obat).length > 0) {
                            $.map(reg.resep_obat, function(resep) {
                                html = '<tr>';
                                if (Object.keys(resep.resep_dokter).length > 0 || Object.keys(
                                        resep.resep_racikan).length > 0) {
                                    html += '<td>' + formatTanggal(resep.tgl_peresepan) + '</td>';
                                    html += '<td>' + resep.no_resep + '</td>';
                                    html += '<td class="align-top">';
                                    // html += ;
                                    $.map(resep.resep_dokter, function(dokter) {
                                        html += '<b class="">' + dokter.data_barang.nama_brng + ' Jumlah : ' + dokter.jml + ', Aturan : ' + dokter.aturan_pakai + '</b><br/>';
                                    })
                                    $.map(resep.resep_racikan, function(racik) {
                                        console.log(racik)
                                        html += '<b class="">Racikan : ' + racik
                                            .nama_racik + ' Jumlah : ' + racik.jml_dr + ', Aturan : ' + racik.aturan_pakai + '</b><br/>';
                                        $.map(racik.detail_racikan, function(detail) {
                                            if (racik.no_racik == detail.no_racik) {
                                                html += '<span class="badge rounded-pill bg-success">';
                                                html += detail.data_barang
                                                    .nama_brng;
                                                html += '</span>';
                                            }
                                        })
                                    })
                                    html += '</td>';
                                    html +=
                                        '<td><button style="font-size:12px" class="btn btn-warning btn-sm" onclick="copyResep(\'' +
                                        resep.no_resep +
                                        '\')" type="button"><i class="bi bi-clipboard-check-fill"></i></button></td>';
                                }
                                html += '</tr>';
                                $('#tb-resep-riwayat tbody').append(html)
                            })
                        }
                    })

                }
            })
        }

        function cekAlergi(no_rm) {
            $.ajax({
                url: '/erm/registrasi/riwayat',
                data: {
                    no_rkm_medis: no_rm,
                    sortir: 'ASC',
                },
                success: function(response) {
                    alergi = '-'
                    $.map(response.reg_periksa, function(val) {
                        if (val.pemeriksaan_ralan) {
                            if (val.pemeriksaan_ralan.alergi != '-' && val.pemeriksaan_ralan.alergi !=
                                '') {
                                alergi = val.pemeriksaan_ralan.alergi
                            }
                        }
                    })
                    $('#alergi').val(alergi)
                }
            })
            return false;
        }

        function hitungPanggilan() {
            kd_poli = '{{ Request::segment(2) }}';
            kd_dokter = '{{ Request::get('dokter') }}';

            $.ajax({
                url: '/erm/registrasi/status',
                data: {
                    'kd_poli': kd_poli,
                    'kd_dokter': kd_dokter,
                },
                method: 'GET',
                success: function(response) {
                    let jumlah = 0;
                    let batal = 0;
                    let tunggu = 0;
                    let sudah = 0;
                    let periksa = 0;
                    $.map(response, function(val, index) {
                        if (val.stts == 'Belum') {
                            tunggu = val.jumlah;
                        } else if (val.stts == 'Sudah') {
                            sudah = val.jumlah;
                        } else if (val.stts == 'Batal') {
                            batal = val.jumlah;
                        } else if (val.stts == 'Berkas Diterima' || val.stts == 'Periksa') {
                            periksa = val.jumlah;
                            $('#hitung-panggil').val(periksa);
                        }
                        jumlah = jumlah + parseInt(val.jumlah)

                    })
                    $('#count-pasien').text(jumlah)
                    $('#count-tunggu').text(tunggu)
                    $('#count-selesai').text(sudah)
                    $('#count-batal').text(batal)
                },
            });
        }

        function panggil(urut) {

            id = $('.panggil-' + urut).data('id');
            hitung_panggilan = $('#hitung-panggil').val();
            text_recall = $('.panggil-' + urut).text()
            reloadTabelPoli();

            if (hitung_panggilan < 2 || text_recall == 'CALL') {
                $('.selesai-' + urut).prop('disabled', false);
                $('.selesai-' + urut).prop('class', 'btn btn-warning btn-sm mb-2 selesai-' + urut + '');

                $('.batal-' + urut).prop('disabled', false);
                $('.batal-' + urut).prop('class', 'btn btn-danger btn-sm mb-2 batal-' + urut + '');

                $('.panggil-' + urut).prop('class', 'btn btn-primary btn-sm mb-2 panggil-' + urut + '');
                $('.panggil-' + urut).css({
                    'background-color': 'rgb(152 0 175)',
                    'border-color': 'rgb(142 6 163)'
                });
                $('.panggil-' + urut).text('RE-CALL');
                $.ajax({
                    url: '/erm/poliklinik/panggil',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'no_rawat': id,
                    },
                    method: "POST",
                    success: function(data) {
                        $.toast({
                            text: 'Memangil : ' + data.no_rawat + '<br/> Jam Periksa : ' + data
                                .jam_periksa,
                            position: 'bottom-center',
                            bgColor: '#0067dd',
                            loader: false,
                            stack: false,
                        })
                        hitungPanggilan();
                    }
                })
            } else {
                $.toast({
                    text: 'Sedang ada pasien',
                    position: 'bottom-center',
                    bgColor: '#ffc107',
                    textColor: 'black',
                    stack: false,
                    loader: false,
                })
                $.toast().reset();
                hitungPanggilan();
            }

        }

        function selesai(urut) {
            id = $('.panggil-' + urut).data('id');
            reloadTabelPoli();
            Swal.fire({
                title: 'Yakin pemeriksaan selesai ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Belum',
                confirmButtonText: 'Ya, Selesai !'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/erm/poliklinik/selesai',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'no_rawat': id,
                        },
                        method: 'POST',
                        success: function(response) {
                            $.toast({
                                text: 'Periksa : ' + response.no_rawat +
                                    ' Selesai <br/> Jam Periksa : ' +
                                    response.jam_periksa,
                                position: 'bottom-center',
                                bgColor: '#198754',
                                loader: false,
                                stack: false,
                            });
                            $('#aksi-' + urut).empty();
                            $('#aksi-' + urut).append(
                                '<h3 class="text-success" align="center"><i class="bi bi-check-circle-fill"></i></h3>'
                            );
                            hitungPanggilan();
                        }

                    });
                }
            })
        }

        function batal(urut) {
            reloadTabelPoli();
            $('.panggil-' + urut).prop('class', 'btn btn-success btn-sm mb-2 panggil-' + urut + '');
            $('.panggil-' + urut).removeAttr('style');
            $('.panggil-' + urut).css({
                'width': '80px'
            });

            $('.batal-' + urut).prop('disabled', true);
            $('.batal-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 batal-' + urut + '');

            $('.selesai-' + urut).prop('disabled', true);
            $('.selesai-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 selesai-' + urut + '');

            $('.panggil-' + urut).text('PANGGIL');

            id = $('.batal-' + urut).data('id');

            $.ajax({
                url: '/erm/poliklinik/batal',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'no_rawat': id,
                },
                method: "DELETE",
                success: function(response) {
                    $.toast({
                        text: response.pesan + ' : ' + response.no_rawat,
                        position: 'bottom-center',
                        bgColor: '#dc3545',
                        loader: false,
                        stack: false,
                    });
                    hitungPanggilan();
                }
            });


        }


        function cekSep(sep) {
            console.log(sep);
        }

        function tb_pasien() {
            var table = $('#tb_pasien').DataTable({
                processing: false,
                scrollX: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ordering: false,
                paging: false,
                lenghtChange: false,
                info: false,
                deferRender: true,
                columnDefs: [{
                    width: 50,
                    targets: 0,
                }],
                ajax: {
                    url: "table",
                    data: {
                        kd_poli: "{{ Request::segment(2) }}",
                        dokter: "{{ Request::get('dokter') }}",
                        tgl_periksa: "{{ date('2023-06-23') }}",
                    },
                },
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            let html = '';
                            console.log(row)
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
                                html = '<div id="aksi-' + row.no_reg + '">';
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

                            if (row.pasien) {
                                pasien = data.pasien.nm_pasien;
                            } else {
                                pasien = data.no_rkm_medis.replace(/\s/g, '');
                                $.ajax({
                                    url: '/erm/pasien/cari',
                                    data: {
                                        'q': pasien,
                                    },
                                    success: function(response) {
                                        $.map(response, function(data) {
                                            $('.pasien-' + row.no_reg).text(data
                                                .nm_pasien);
                                        })
                                    }
                                })
                            }

                            // console.log(row.sep)

                            if (row.sep && row.kd_pj != "A03") {
                                badgeSep = '<a href="#" onclick="cekSep(\'' + row.sep.no_sep + '\')"><span id="sep-' + row.no_reg + '" class="badge text-bg-success" style="font-size:12px">Sudah Terbit SEP</span></a>';
                                // $('#sep-' + row.no_reg).addClass('badge text-bg-success')
                                // $('#sep-' + row.no_reg).text('Sudah Terbit SEP')
                            } else if (!row.sep && row.kd_pj != "A03") {
                                badgeSep = '<span id="sep-' + row.no_reg + '" class="badge text-bg-danger">Belum Terbit SEP</span>';
                                // $('#sep-' + row.no_reg).addClass('badge text-bg-danger')
                                // $('#sep-' + row.no_reg).text('Belum Terbit SEP')
                            } else {
                                badgeSep = '';
                            }

                            html = '<h5>' + row.no_reg + '</h5>';
                            html += '<p><span class="pasien-' + row.no_reg + '">' + pasien +
                                '</span></br>' +
                                row.no_rawat +
                                '</br><i><strong class="' + classTeksPenjab + ' h6">' + row.penjab
                                .png_jawab + '</strong></i><br/>' + badgeSep + '</p>';

                            if (row.sep) {
                                // html += '<p>SEP TERCETAK</p>'
                            }

                            return html;
                        },
                        name: 'nm_pasien'

                    },
                    {
                        data: '',
                        render: function(data, type, row, meta) {
                            let ambilAskep = '';
                            let no_rkm_medis = row.no_rkm_medis.replace(/\s/g, '');
                            if (row.dokter) {
                                dokter = row.dokter.nm_dokter;
                                if (row.dokter.kd_sps == 'S0001') {
                                    ambilAskep = 'ambilAskepKebidanan(\'' + no_rkm_medis + '\')';
                                } else {
                                    ambilAskep = 'ambilAskepAnak(\'' + no_rkm_medis + '\')';
                                }
                            } else {
                                kd_dokter = row.kd_dokter.replace(/\s/g, '');
                                $.ajax({
                                    url: '/erm/dokter/ambil',
                                    dataType: 'JSON',
                                    data: {
                                        'nik': kd_dokter,
                                    },
                                    success: function(response) {
                                        $.map(response.data, function(res) {
                                            if (res.kd_dokter == 'S0001') {
                                                $('#btn-askep-' + row.no_reg).attr('onclick', 'ambilAskepAnak(\'' + no_rkm_medis + '\')');

                                            } else {
                                                $('#btn-askep-' + row.no_reg).attr('onclick', 'ambilAskepKebidanan(\'' + no_rkm_medis + '\')');
                                            }
                                        })
                                    }
                                });
                            }

                            html =
                                '<a href="#form-upload" class="btn btn-primary btn-sm mb-2 mr-1" style = "width:80px;font-size:12px;text-align:left" onclick = "detailPeriksa(\'' +
                                row.no_rawat + '\',\'' + row.status_lanjut + '\')" id="btn-upload-' +
                                textRawat(row.no_rawat) +
                                '"><i id="upload-' +
                                textRawat(row.no_rawat) +
                                '" class="bi bi-cloud-upload-fill"></i> UPLOAD</a></br>';
                            html +=
                                '<button id="btn-periksa-' + textRawat(row.no_rawat) +
                                '" style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRawat(\'' +
                                row.no_rawat +
                                '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalSoap" data-id="' +
                                row.no_rawat + '"><i class="bi bi-pencil-square" id="icon-periksa-' +
                                textRawat(row.no_rawat) + '"></i> SOAP</button><br/>';
                            html +=
                                '<button id="btn-askep-' + textRawat(row.no_rawat) +
                                '"style="width:80px;font-size:12px;text-align:left" onclick="' +
                                ambilAskep + '" class="btn btn-primary btn-sm mb-2 mr-1" data-id="' +
                                row.no_rkm_medis +
                                '"><i id="icon-askep-' +
                                textRawat(row.no_rawat) +
                                '" class="bi bi-file-bar-graph-fill"></i> ASKEP</button></br>';
                            html +=
                                '<button style="width:80px;font-size:12px;text-align:left" onclick="ambilNoRm(\'' +
                                row.no_rkm_medis +
                                '\')" class="btn btn-primary btn-sm mb-2 mr-1" data-bs-toggle="modal" data-bs-target="#modalRiwayat" data-id="' +
                                row.no_rkm_medis + '"><i class="bi bi-search"></i>RIWAYAT</button>';

                            if (row.upload.length > 0) {
                                $('#upload-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-cloud-upload-fill')
                                $('#btn-upload-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#upload-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-upload-' + textRawat(row.no_rawat)).addClass('btn-success')
                            }
                            if (row.pemeriksaan_ralan) {
                                $('#icon-periksa-' + textRawat(row.no_rawat)).removeClass(
                                    'bi bi-pencil-square')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).removeClass('btn-primary')
                                $('#icon-periksa-' + textRawat(row.no_rawat)).addClass(
                                    'bi bi-check2-circle')
                                $('#btn-periksa-' + textRawat(row.no_rawat)).addClass('btn-success')
                            }

                            $.map(row.pasien.reg_periksa, function(data) {
                                if (data.kd_poli == 'P001' || data.kd_poli == 'P007' || data.kd_poli == 'P009') {
                                    if (Object.keys(data.askep_ralan_kebidanan).length > 0) {
                                        $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success btn-sm mb-2 mr-1')
                                    }
                                } else if (data.kd_poli == 'P008' || data.kd_poli == 'P003') {
                                    if (Object.keys(data.askep_ralan_anak).length > 0) {
                                        $('#btn-askep-' + textRawat(row.no_rawat)).prop('class', 'btn btn-success btn-sm mb-2 mr-1')
                                    }
                                }
                            })

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

        function ambilAskepAnak(no_rkm_medis) {
            $.ajax({
                url: 'askep/anak',
                data: {
                    no_rkm_medis: no_rkm_medis,
                },
                dataType: 'JSON',
                success: function(response) {
                    if (Object.keys(response).length > 0) {
                        $('#opt-rawat').append(
                            '<option value="" disabled selected>PILIH TANGGAL ASESMEN</option>')
                        $.map(response, function(data) {
                            console.log(data)
                            $('#opt-rawat').append('<option class="opt-asesmen-anak" value=' + data
                                .no_rawat + '>' + formatTanggal(
                                    data.tanggal) + ' - ' + data.no_rawat +
                                '</option>')
                            $('.no_rkm_medis').html(': ' + data.reg_periksa.no_rkm_medis);
                            $('.jk').html(data.reg_periksa.pasien.jk == 'L' ? ': Laki-laki' :
                                ': Perempuan')
                            $('.tgl_registrasi').html(': ' + formatTanggal(data.reg_periksa
                                .tgl_registrasi));
                            $('.nm_pasien').html(': ' + data.reg_periksa.pasien.nm_pasien);
                            $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien
                                    .tgl_lahir) +
                                ' / ' + data.reg_periksa.umurdaftar + ' ' + data.reg_periksa
                                .sttsumur);
                            $('.anamnesis').html(': ' + data.informasi);
                            $('.tensi').html(': ' + data.td + ' mmHG');
                            $('.nadi').html(': ' + data.nadi + ' x/menit');
                            $('.respirasi').html(': ' + data.rr + ' x/menit');
                            $('.suhu').html(': ' + data.suhu + ' <sup>o</sup>C');
                            $('.gcs').html(': ' + data.gcs);
                            $('.bb').html(': ' + data.bb + ' Kg');
                            $('.tb').html(': ' + data.bb + ' Cm');
                            $('.lp').html(': ' + data.lp + ' Cm');
                            $('.ld').html(': ' + data.ld + ' Cm');
                            $('.lk').html(': ' + data.lk + ' Cm');
                            $('.keluhan_utama').html(': ' + data.keluhan_utama);
                            $('.rpd').html(': ' + data.rpd);
                            $('.rpk').html(': ' + data.rpk);
                            $('.rpo').html(': ' + data.rpo);
                            $('.alergi').html(': ' + data.alergi);
                            $('.anakke').html(': ' + data.anakke + ', dari ' + data.darisaudara +
                                ' bersaudara');
                            $('.caralahir').html(': ' + data.caralahir + ' ( ' + data
                                .ket_caralahir +
                                ' )');
                            $('.umurkelahiran').html(': ' + data.umurkelahiran);
                            $('.kelainanbawaan').html(': ' + data.kelainanbawaan + ' (' + data
                                .ket_kelainan_bawaan + ' )');

                            namaImunisasi = '';
                            $('.tb-askep-imunisasi tbody').empty()
                            $('.imunisasi').remove()
                            $.map(data.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                                if (namaImunisasi != imunisasi.master_imunisasi
                                    .nama_imunisasi) {
                                    namaImunisasi = imunisasi.master_imunisasi
                                        .nama_imunisasi
                                    html = '<tr class="imunisasi ' + imunisasi
                                        .kode_imunisasi +
                                        '">'
                                    html += '<td>' + namaImunisasi + '</td>';

                                    html += '</tr>'
                                    $('.tb-askep-imunisasi tbody').append(html)
                                }
                                nomorImun =
                                    '<td><i class="bi bi-check-lg text-success"></i></td>'
                                $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                            })


                            $('.usiatengkurap').html(': ' + data.usiatengkurap);
                            $('.usiaduduk').html(': ' + data.usiaduduk);
                            $('.usiaberdiri').html(': ' + data.usiaberdiri);
                            $('.usiagigipertama').html(': ' + data.usiagigipertama);
                            $('.usiaberjalan').html(': ' + data.usiaberjalan);
                            $('.usiamembaca').html(': ' + data.usiamembaca);
                            $('.usiamenulis').html(': ' + data.usiamenulis);
                            $('.wajah').html(': ' + data.wajah);
                            $('.alat_bantu').html(': ' + data.alat_bantu);
                            $('.prothesa').html(': ' + data.prothesa);
                            $('.aktifitas').html(': ' + data.aktifitas);
                            $('.status_psiko').html(': ' + data.status_psiko + ' (' + data
                                .ket_psiko +
                                ' )');
                            $('.edukasi').html(': ' + data.edukasi + ' (' + data.ket_edukasi +
                                ' )');
                            $('.hub_keluarga').html(': ' + data.hub_keluarga);
                            $('.ekonomi').html(': ' + data.ekonomi);
                            $('.pengasuh').html(': ' + data.pengasuh + ' ( ' + data.ket_pengasuh +
                                ' )');
                            $('.budaya').html(': ' + data.budaya + ' ( ' + data.ket_budaya + ' )');

                        })

                        $('#modalAskepAnak').modal('show');
                    } else {
                        Swal.fire(
                            'Kosong!', 'Belum ada data asesmen', 'error'
                        );
                    }

                }
            });
        }

        $('#opt-rawat').on('change', function() {
            no_rawat = $(this).val();
            $.ajax({
                url: 'askep/anak/detail',
                data: {
                    no_rawat: no_rawat,
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response)
                    $('.tgl_registrasi').html(': ' + formatTanggal(response.reg_periksa
                        .tgl_registrasi));
                    $('.tensi').html(': ' + response.td + ' mmHG');
                    $('.nadi').html(': ' + response.nadi + ' x/menit');
                    $('.respirasi').html(': ' + response.rr + ' x/menit');
                    $('.suhu').html(': ' + response.suhu + ' <sup>o</sup>C');
                    $('.gcs').html(': ' + response.gcs);
                    $('.bb').html(': ' + response.bb + ' Kg');
                    $('.tb').html(': ' + response.bb + ' Cm');
                    $('.lp').html(': ' + response.lp + ' Cm');
                    $('.ld').html(': ' + response.ld + ' Cm');
                    $('.lk').html(': ' + response.lk + ' Cm');
                    $('.keluhan_utama').html(': ' + response.keluhan_utama);
                    $('.rpd').html(': ' + response.rpd);
                    $('.rpk').html(': ' + response.rpk);
                    $('.rpo').html(': ' + response.rpo);
                    $('.alergi').html(': ' + response.alergi);
                    $('.anakke').html(': ' + response.anakke + ', dari ' + response.darisaudara +
                        ' bersaudara');
                    $('.caralahir').html(': ' + response.caralahir + ' ( ' + response
                        .ket_caralahir +
                        ' )');
                    $('.umurkelahiran').html(': ' + response.umurkelahiran);
                    $('.kelainanbawaan').html(': ' + response.kelainanbawaan + ' (' + response
                        .ket_kelainan_bawaan + ' )');
                    namaImunisasi = '';
                    $('.tb-askep-imunisasi tbody').empty()
                    $('.imunisasi').remove()
                    $.map(response.reg_periksa.pasien.riwayat_imunisasi, function(imunisasi) {
                        // console.log('imunisasi', imunisasi)
                        if (namaImunisasi != imunisasi.master_imunisasi.nama_imunisasi) {
                            namaImunisasi = imunisasi.master_imunisasi.nama_imunisasi
                            html = '<tr class="imunisasi ' + imunisasi.kode_imunisasi + '">'
                            html += '<td>' + namaImunisasi + '</td>';

                            html += '</tr>'
                            $('.tb-askep-imunisasi tbody').append(html)
                        }
                        nomorImun = '<td><i class="bi bi-check-lg text-success"></i></td>'
                        $('.' + imunisasi.kode_imunisasi).append(nomorImun)
                    })
                    $('.usiatengkurap').html(': ' + response.usiatengkurap);
                    $('.usiaduduk').html(': ' + response.usiaduduk);
                    $('.usiaberdiri').html(': ' + response.usiaberdiri);
                    $('.usiagigipertama').html(': ' + response.usiagigipertama);
                    $('.usiaberjalan').html(': ' + response.usiaberjalan);
                    $('.usiamembaca').html(': ' + response.usiamembaca);
                    $('.usiamenulis').html(': ' + response.usiamenulis);
                    $('.wajah').html(': ' + response.wajah);
                    $('.alat_bantu').html(': ' + response.alat_bantu);
                    $('.prothesa').html(': ' + response.prothesa);
                    $('.aktifitas').html(': ' + response.aktifitas);
                    $('.status_psiko').html(': ' + response.status_psiko + ' (' + response
                        .ket_psiko +
                        ' )');
                    $('.edukasi').html(': ' + response.edukasi + ' (' + response.ket_edukasi +
                        ' )');
                    $('.hub_keluarga').html(': ' + response.hub_keluarga);
                    $('.ekonomi').html(': ' + response.ekonomi);
                    $('.pengasuh').html(': ' + response.pengasuh + ' ( ' + response.ket_pengasuh +
                        ' )');
                    $('.budaya').html(': ' + response.budaya + ' ( ' + response.ket_budaya + ' )');
                }
            });

        })

        function ambilAskepKebidanan(no_rkm_medis) {
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
                        $('.tgl_lahir').html(': ' + formatTanggal(data.reg_periksa.pasien.tgl_lahir) +
                            ' / ' +
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
                        $('.inspekulo').html(': ' + data.inspekulo + ' ,<br/>Hasil : ' + data
                            .ket_inspekulo);
                        $('.ctg').html(': ' + data.ctg + ' ,<br/>Hasil : ' + data.ket_ctg);
                        $('.lakmus').html(': ' + data.lakmus + ' ,<br/>Hasil : ' + data.ket_lakmus);
                        $('.lab').html(': ' + data.lab + ' ,<br/>Hasil : ' + data.ket_lab);
                        $('.usg').html(': ' + data.usg + ' ,<br/>Hasil : ' + data.ket_usg);
                        $('.panggul').html(': ' + data.panggul);
                        $('.keluhan').text(': ' + data.keluhan_utama);
                        $('.umur').text(': ' + data.umur + ' Th');
                        $('.lama').text(': ' + data.lama + ' Hari');
                        $('.banyak').text(': ' + data.banyaknya + ' Pembalut');
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
                        $('.kebiasaan1').text(data.kebiasaan1 + ', ' + data.ket_kebiasaan1 +
                            ' Batang /hari');
                        $('.kebiasaan2').text(data.kebiasaan2 + ', ' + data.ket_kebiasaan2 +
                            ' Botol /hari');
                        $('.kebiasaan3').text(data.kebiasaan3);
                        $('.kb').text(data.kb + ' , ', +data.ket_kb);
                        $('.kb').text(data.kb);
                        $('.ket_kb').text(data.ket_kb);
                        $('.komplikasi').text(data.komplikasi + ', ' + data.ket_komplikasi);
                        $('.berhenti').text(data.berhenti);
                        $('.alasan').text(data.alasan);

                        no = 1;
                        data.reg_periksa.pasien.riwayat_persalinan.forEach(function(riwayat) {
                            // console.log(riwayat)
                            html = '<tr>';
                            html += '<td>' + no + '</td>'
                            html += '<td>' + formatTanggal(riwayat.tgl_thn) + '</td>'
                            html += '<td>' + riwayat.tempat_persalinan + '</br>' + riwayat
                                .penolong +
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
                        Swal.fire(
                            'Kosong!', 'Belum ada data asesmen', 'error'
                        );
                    }


                }
            });
        }

        function resep(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat,
                },
                method: 'GET',
                dataType: 'JSON',
                success: function(response) {
                    $('.no_rawat').val(response.no_rawat);
                    $('.nm_pasien').val(response.no_rkm_medis + ' / ' + response.pasien.nm_pasien + ' / ' +
                        response.umurdaftar + ' ' + response.sttsumur)
                    console.log(response)
                }
            })
            $('#modalResep').modal('show');
        }
    </script>
@endpush
