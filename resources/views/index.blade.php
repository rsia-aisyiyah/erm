<!doctype html>
<html lang="en">
@include('layout.head')

<body>
    <style>
        table {
            font-size: 12px;
        }

        table td {
            vertical-align: middle;
        }

        .borderless th,
        .borderless td {
            border: none;
            height: 5px !important;
            padding: 5px !important;
        }
    </style>
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </header>

    <div class="container-fluid">
        <div class="row">
            @include('layout.sidebar')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        {{ Request::segment(1) == null ? 'DASHBOARD' : strtoupper(Request::segment(1)) }}
                    </h1>
                </div>
                @yield('contents')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"
        integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>


    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- Include Moment.js CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <!-- Include Bootstrap DateTimePicker CDN -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        $(document).ready(function() {
            hitungPanggilan();
        })


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
                    $('.hitung-panggil').val(response)
                }
            });
        }

        function selesai(urut) {
            id = $('.periksa-' + urut).data('id');

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
                            console.log(response);
                            hitungPanggilan();
                            $.toast({
                                text: 'Periksa : ' + response.no_rawat +
                                    ' Selesai <br/> Jam Periksa : ' +
                                    response.jam_periksa,
                                position: 'bottom-center',
                                bgColor: '#198754',
                                loader: false,
                                stack: false,
                            });
                            $('.selesai-' + urut).prop('disabled', true);
                            $('.selesai-' + urut).prop('class',
                                'btn btn-secondary btn-sm mb-2 selesai-' +
                                urut + '');

                            $('.batal-' + urut).prop('disabled', true);
                            $('.batal-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 batal-' +
                                urut + '');

                            $('.periksa-' + urut).prop('disabled', true);
                            $('.periksa-' + urut).prop('class',
                                'btn btn-secondary btn-sm mb-2 periksa-' +
                                urut + '');

                            $('.periksa-' + urut).css({
                                'background-color': '',
                                'border-color': ''
                            });
                            $('.periksa-' + urut).text('PANGGIL');

                            hitungSelesai();
                        }

                    });
                }
            })
        }

        function panggil(urut) {
            id = $('.periksa-' + urut).data('id');
            hitung_panggilan = $('.hitung-panggil').val();
            text_recall = $('.periksa-' + urut).text()
            if (hitung_panggilan < 2 || text_recall == 'RE-CALL') {
                $('.selesai-' + urut).prop('disabled', false);
                $('.selesai-' + urut).prop('class', 'btn btn-warning btn-sm mb-2 selesai-' + urut + '');

                $('.batal-' + urut).prop('disabled', false);
                $('.batal-' + urut).prop('class', 'btn btn-danger btn-sm mb-2 batal-' + urut + '');

                $('.periksa-' + urut).prop('class', 'btn btn-primary btn-sm mb-2 periksa-' + urut + '');
                $('.periksa-' + urut).css({
                    'background-color': 'rgb(152 0 175)',
                    'border-color': 'rgb(142 6 163)'
                });
                $('.periksa-' + urut).text('RE-CALL');
                $.ajax({
                    url: '/erm/poliklinik/panggil',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'no_rawat': id,
                    },
                    method: "POST",
                    success: function(data) {
                        hitungPanggilan();
                        $.toast({
                            text: 'Memangil : ' + data.no_rawat + '<br/> Jam Periksa : ' + data
                                .jam_periksa,
                            position: 'bottom-center',
                            bgColor: '#0067dd',
                            loader: false,
                            stack: false,
                        })
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

        function batal(urut) {
            $('.periksa-' + urut).prop('class', 'btn btn-success btn-sm mb-2 periksa-' + urut + '');
            $('.periksa-' + urut).removeAttr('style');
            $('.periksa-' + urut).css({
                'width': '80px'
            });

            $('.batal-' + urut).prop('disabled', true);
            $('.batal-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 batal-' + urut + '');

            $('.selesai-' + urut).prop('disabled', true);
            $('.selesai-' + urut).prop('class', 'btn btn-secondary btn-sm mb-2 selesai-' + urut + '');

            $('.periksa-' + urut).text('PANGGIL');

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

        function formatTanggal(oldTgl) {
            let t = new Date(oldTgl);
            let bulan = '';
            switch ((t.getMonth() + 1)) {
                case 1:
                    bulan = "Januari";
                    break;
                case 2:
                    bulan = "Februari";
                    break;
                case 3:
                    bulan = "Maret";
                    break;
                case 4:
                    bulan = "April";
                    break;
                case 5:
                    bulan = "Mei";
                    break;
                case 6:
                    bulan = "Juni";
                    break;
                case 7:
                    bulan = "Juli";
                    break;
                case 8:
                    bulan = "Agustus";
                    break;
                case 9:
                    bulan = "September";
                    break;
                case 10:
                    bulan = "Oktober";
                    break;
                case 11:
                    bulan = "November";
                    break;
                case 12:
                    bulan = "Desember";
                    break;
                default:
                    break;
            }
            return tanggal = t.getDate() + ' ' + bulan + ' ' + t.getFullYear();
        }

        function isKosong(x, satuan = '') {
            return x ? x + satuan : '-';
        }


        function textRawat(no_rawat) {
            let splitNoRawat = no_rawat.split('/');
            textNoRawat = splitNoRawat.join('');
            return textNoRawat;

        }

        function getAturanPakai(no_rawat, obat) {

            var aturan = '';
            var ajaxAturan = $.ajax({
                url: '/erm/aturan',
                data: {
                    'no_rawat': no_rawat,
                    'kode_brng': obat
                },
                dataType: 'JSON',
                // async: false,
                success: function(response) {
                    $('.aturan-' + textRawat(no_rawat) + '-' + obat).text(response.aturan)
                }
            })
        }

        function pemberianObat(obat) {
            if (Object.keys(obat).length > 0) {
                var pemberian = '<table class="table table-success borderless mb-0">';
                let tgl_sekarang = ''
                obat.forEach(function(o) {
                    if (o.data_barang.kdjns != 'J024') {
                        pemberian += '<tr><td>' + (tgl_sekarang != o.tgl_perawatan ? formatTanggal(o
                                    .tgl_perawatan) +
                                ', Jam ' +
                                o.jam : '') +
                            '</td><td>: <strong>' + o.data_barang.nama_brng +
                            '</strong></td><td> ' + o.jml + '</td><td class="aturan-' + textRawat(o.no_rawat) +
                            '-' + o
                            .kode_brng + '"></td><tr>';
                        tgl_sekarang = o.tgl_perawatan;
                        getAturanPakai(o.no_rawat, o.kode_brng)
                    }
                })
                pemberian += '</table>'
                return '<tr><td>Pemberian Obat</td><td>' + pemberian + '</td></tr>';
            }
            return '';
        }

        function petugasLab(no_rawat, lab) {
            $.ajax({
                url: '/erm/lab/petugas',
                data: {
                    'no_rawat': no_rawat,
                    'kd_jenis_prw': lab,
                },
                dataType: 'JSON',
                method: 'GET',
                success: function(response) {
                    $('.dr-' + textRawat(no_rawat) + '-' + lab).text(response.dokter.nm_dokter);
                    $('.petugas-' + textRawat(no_rawat) + '-' + lab).text(response.petugas.nama);
                }
            })

        }

        function pemeriksaanLab(lab, umur, jk) {

            if (Object.keys(lab).length > 0) {
                var hasilLab = '<table class="table borderless table-success mb-0">';
                let tgl_sekarang = '';
                let jnsPeriksa = '';
                let nmPerawatan = '';
                let no = 1;
                let rujukan = '';
                let classDokter = '';
                let classDokterSekarang = '';
                let classPetugas = '';
                let classPetugasSekarang = '';
                let barisTanggal = '';

                lab.forEach(function(l) {
                    // console.log(l)
                    classDokterSekarang = classDokter;
                    classPetugasSekarang = classPetugas;

                    classDokter = 'dr-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw;
                    classPetugas = 'petugas-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw;

                    tgl_sekarang != l.tgl_periksa || nmPerawatan != l.jns_perawatan_lab.nm_perawatan ? no = 1 :
                        '';
                    hasilLab += (tgl_sekarang != l.tgl_periksa ?
                            '<tr class="table-warning"><td style="width:9%">' +
                            formatTanggal(l.tgl_periksa) + ', Jam ' + l.jam + '</td>' +
                            '</td><td class="dr-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw + '"></td>' +
                            '<td class="petugas-' + textRawat(l.no_rawat) + '-' + l.kd_jenis_prw +
                            '"></td>' +
                            '</tr>' : nmPerawatan != l.jns_perawatan_lab.nm_perawatan ?
                            '<tr class="">' : '') +
                        (jnsPeriksa == l.kd_jenis_prw ? (tgl_sekarang != l.tgl_periksa ?
                                '<td style="width:30%" colspan="3"> <strong>' + l.jns_perawatan_lab
                                .nm_perawatan +
                                '</tr>' +
                                '</tr>' +
                                '<tr><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>' : '') :
                            '<td style="width:30%" colspan="3"><strong>' + l.jns_perawatan_lab.nm_perawatan +
                            '</td>' +
                            '</tr>' +
                            '<tr><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>') +
                        '<tr><td>' + no + '. ' + l.template.Pemeriksaan + '</td><td>' + l.nilai +
                        ' ' + l.template.satuan + (l.keterangan != '' ? ' (' + l.keterangan + ')' : '') +
                        '</td><td>' + l.nilai_rujukan + ' ' + l.template.satuan + '</td></tr>';
                    barisTanggal = tgl_sekarang != l.tgl_periksa ? '<td>' + formatTanggal(l.tgl_periksa) + ' ' +
                        l
                        .jam + '</td>' : '';
                    barisPerawatan = nmPerawatan != l.jns_perawatan_lab.nm_perawatan ?
                        '<td></td><td colspan="3""><strong>' +
                        l
                        .jns_perawatan_lab
                        .nm_perawatan + '</strong></td>' : '';
                    barisDokter = tgl_sekarang != l.tgl_periksa && classDokterSekarang != classDokter ?
                        '<td class="' + classDokter + '">' + '</td>' : '';
                    barisPetugas = tgl_sekarang != l.tgl_periksa && classPetugasSekarang != classPetugas ?
                        '<td class="' + classPetugas + '" colspan="2">' + '</td>' +
                        '<tr><td></td><th>Pemeriksaan</th><th>Hasil</th><th>Rujukan</th></tr>' : '';


                    // console.log(barisPetugas);


                    // hasilLab += '<tr class="table-bordered">' +
                    //     barisTanggal +
                    //     barisDokter +
                    //     barisPetugas +
                    //     '<tr colspan=3>' + barisPerawatan +
                    //     '</tr>' +
                    //     '<tr><td></td><td>' + no + '. ' + l.template.Pemeriksaan + '</td><td>' + l.nilai +
                    //     ' ' + l.template.satuan + (l.keterangan != '' ? ' (' + l.keterangan + ')' : '') +
                    //     '</td><td>' + l.nilai_rujukan + ' ' + l.template.satuan + '</td></tr>' +
                    //     '</tr>';

                    tgl_sekarang = l.tgl_periksa;
                    jnsPeriksa = l.kd_jenis_prw;
                    nmPerawatan = l.jns_perawatan_lab.nm_perawatan;
                    petugasLab(l.no_rawat, l.kd_jenis_prw);

                    no++
                })
                hasilLab += '</table>'
                return '<tr><td>Laboratorium </td><td>' + hasilLab + '</td></tr>';
            }
            return '';
        }

        function diagnosaPasien(diagnosa) {
            if (Object.keys(diagnosa).length > 0) {
                var diagnosaPasien = '<table class="table table-success borderless mb-0">';
                diagnosa.forEach(function(d) {
                    diagnosaPasien +=
                        '<tr><td style="width:5%"><strong>' + d.kd_penyakit + '</strong></td><td>: ' + d
                        .penyakit
                        .nm_penyakit + '</td><tr>';
                })
                diagnosaPasien += '</table>'
                return '<tr><td>Diagnosa</td><td>' + diagnosaPasien + '</td></tr>';
            }
            return '';
        }

        function resume(d) {
            var detail = '';
            var pemeriksaan = '';
            var diagnosa = '';
            d.reg_periksa.forEach(function(i) {
                if (i.status_lanjut == 'Ranap') {
                    status_lanjut = 'RAWAT INAP';
                    class_status = 'background:rgb(152, 0, 175);color:white';
                } else {
                    status_lanjut = 'RAWAT JALAN';
                    class_status = 'background:rgb(255 193 7);color:black';
                }
                i.pemeriksaan_ralan.forEach(function(x) {
                    pemeriksaan = '<tr><td>Pemeriksaan</td><td>' +
                        '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<table class="table table-sm text-sm borderless table-success mb-2">' +
                        '<tr><td style="width=12%">Tanggal Rawat</td><td>: ' + formatTanggal(x
                            .tgl_perawatan) + ' ' + x
                        .jam_rawat + '</td></tr>' +
                        '<tr><td>Tinggi</td><td>: ' + isKosong(x.tinggi, ' cm') + '</td><tr>' +
                        '<tr><td>Berat Badan</td><td>: ' + isKosong(x.berat, ' Kg') + '</td><tr>' +
                        '<tr><td>Suhu</td><td>: ' + isKosong(x.suhu_tubuh, ' <sup>o</sup>C') +
                        '</td><tr>' +
                        '<tr><td>Tensi</td><td>: ' + isKosong(x.tensi) + '</td><tr>' +
                        '<tr><td>Kesadaran</td><td>: ' + isKosong(x.kesadaran) + '</td><tr>' +
                        '<tr><td>Respirasi</td><td>: ' + isKosong(x.respirasi) +
                        '<tr><td>GCS(E,V,M)</td><td>: ' + isKosong(x.gcs) +
                        '<tr><td>Alergi</td><td>: ' + isKosong(x.alergi) +
                        '<tr><td>Imunisasi</td><td>: ' + isKosong(x.imun_ke) +
                        '</td><tr>' +
                        '</tr>' +
                        '</table>' +
                        '</div>' +
                        '<div class="col-sm-8">' +
                        '<table class="table table-sm text-sm borderless table-success">' +
                        '<tr>' +
                        '<tr><td style="width:10%">Subject</td><td>: ' + isKosong(x.keluhan) +
                        '</td><tr>' +
                        '<tr><td>Object</td><td>: ' + isKosong(x.pemeriksaan) + '</td><tr>' +
                        '<tr><td>Assesment</td><td>: ' + isKosong(x.penilaian) + '</td><tr>' +
                        '<tr><td>Plan</td><td>: ' + isKosong(x.rtl) + '</td><tr>' +
                        '</table>' +
                        '</div>' +
                        '</td></tr>';
                })
                detail +=
                    '<tr>' +
                    '<td colspan="2" align="center" style="' + class_status + '"><h5>' + status_lanjut +
                    '<h2></td>' +
                    '</tr>' +
                    '<tr><td style="width:15%">Tanggal Daftar</td><td>: ' + formatTanggal(i.tgl_registrasi) +
                    ' ' +
                    i.jam_reg +
                    '<tr><td>Nomor Rawat</td><td>: ' + i.no_rawat + '</td></tr>' +
                    '<tr><td>Nomor RM</td><td>: ' + i.no_rkm_medis + '</td></tr>' +
                    '</td></tr>' +
                    '<tr><td>Unit/Poliklinik</td><td>: ' + i.poliklinik.nm_poli + '</td></tr>' +
                    '<tr><td>Dokter</td><td>: ' + i.dokter.nm_dokter + '</td></tr>' +
                    '<tr><td>Cara Bayar</td><td>: ' + i.penjab.png_jawab + '</td></tr>' +

                    diagnosaPasien(i.diagnosa_pasien) + pemeriksaan + pemberianObat(i.detail_pemberian_obat) +
                    pemeriksaanLab(i.detail_pemeriksaan_lab, i.umurdaftar, d.jk)
                '</tr>'

            });
            return (
                '<table class="table table-bordered table-responsive" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                detail + '</table>'
            );
        }



        function detailPeriksa(no_rawat, status) {
            $('#upload-image').css('visibility', 'hidden')
            $('#form-upload').css('visibility', 'visible')
            $('#image .tmb').detach()
            $.ajax({
                url: '/erm/periksa/detail?no_rawat=' + no_rawat,
                method: "GET",
                dataType: 'JSON',
                success: function(data) {
                    $('#no_rawat').val(data.no_rawat)
                    $('#no_rkm_medis').val(data.no_rkm_medis)
                    $('#tgl_masuk').val(data.tgl_registrasi)
                    $('#td_no_rawat').text(data.no_rawat)
                    $('#td_nm_pasien').text(data.pasien.nm_pasien)
                    $('#td_tgl_reg').text(data.tgl_registrasi)
                    if (data.kamar_inap != null) {
                        $('#td_tgl_pulang').text(data.kamar_inap.tgl_keluar)
                    } else {
                        $('#td_tgl_pulang').text("-")
                    }
                    $('#infoReg').css('visibility', 'visible')


                    $('#button-form label').detach()
                    $('#button-form input').detach()



                    if (status == "Ralan") {
                        html =
                            '<input type="radio" class="btn-check" name="kategori" id="opt-usg" autocomplete="off" onclick="showForm()" value="usg"><label class="btn btn-outline-primary btn-sm" for="opt-usg">USG</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-laborat" autocomplete="off" onclick="showForm()" value="laborat"><label class="btn btn-outline-primary btn-sm" for="opt-laborat">Laboratorium</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-radiologi" autocomplete="off" onclick="showForm()" value="radiologi"><label class="btn btn-outline-primary btn-sm" for="opt-radiologi">Radiologi</label>'
                        $('#button-form').append(html)
                    } else {
                        html =
                            '<input type="radio" class="btn-check" name="kategori" id="opt-resume" autocomplete="off" onclick="showForm()" value="resume"><label class="btn btn-outline-primary btn-sm" for="opt-resume">Resume Medis</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-laborat" autocomplete="off" onclick="showForm()" value="laborat"><label class="btn btn-outline-primary btn-sm" for="opt-laborat">Laboratorium</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-radiologi" autocomplete="off" onclick="showForm()" value="radiologi"><label class="btn btn-outline-primary btn-sm" for="opt-radiologi">Radiologi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-operasi" autocomplete="off" onclick="showForm()" value="operasi"><label class="btn btn-outline-primary btn-sm" for="opt-operasi">Operasi</label>' +
                            '<input type="radio" class="btn-check" name="kategori" id="opt-lain" autocomplete="off" onclick="showForm()" value="lainnya"><label class="btn btn-outline-primary btn-sm" for="opt-lain">Lainnya</label>'

                        $('#button-form').append(html)
                    }
                }
            })
        }

        function showForm(no_rawat = '', kategori = '') {
            $('#submit').hide()

            if (!no_rawat && !kategori) {
                no_rawat = $('#no_rawat').val();
                kategori = event.target.value;
            }


            var img = '';
            $('#image .tmb').detach()
            $.ajax({
                url: '/erm/upload/show?no_rawat=' + no_rawat + '&kategori=' + kategori,
                method: 'GET',
                dataType: 'JSON',
                success: function(data) {
                    countData = Object.keys(data).length
                    if (countData > 0) {
                        img = data.file.split(',');
                        $.map(img, function(file) {
                            $('#image').append(
                                '<div class="tmb col-sm-4"><img class="img-thumbnail position-relative" src="{{ asset('erm') }}/' +
                                file +
                                '" /><span style="cursor:pointer" class="badge text-bg-danger" onclick=deleteImage(' +
                                data.id + ',"' + file + '")>Hapus</span></div>')
                        })
                    }
                    $('#upload-image').css('visibility', 'visible')
                }
            })

        }

        function previewImage(input) {
            if (input.files && input.files[0]) {

                $('input[name="kategori"]').each(function(index) {
                    if ($(this).prop('checked') != true) {
                        $(this).prop('disabled', true);
                    }
                })
                $('#submit').show()
                countImage = input.files.length;
                for (let index = 0; index < countImage; index++) {
                    var reader = new FileReader();
                    reader.readAsDataURL(input.files[index]);
                    reader.onload = function(e) {
                        var file = e.target;
                        var fileName = input.files[index].name
                        $('#preview').append(
                            '<div class="pip col-sm-3"><input type="hidden" name="images" value="' +
                            file.result + '" class="images"><img width="75%" src="' + file.result +
                            '" title="' +
                            fileName + '" alt="' + fileName +
                            '"><br /><span class="remove badge text-bg-danger">Remove image</span></div>')
                        $(".remove").click(function() {
                            $(this).parent(".pip").remove();
                            if ($('.pip').length == 0) {
                                $('#images').val("");
                                $('#submit').hide()
                                $('input[name="kategori"]').each(function(index) {
                                    $(this).prop('disabled', false);
                                })
                            }
                        });
                    };
                }
            }
        }
        var data = {};

        function simpan() {
            var images = []

            $('input:hidden[name="images"]').each(function() {
                images.push($(this).val());
            })

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            data = {
                no_rawat: $('#no_rawat').val(),
                no_rkm_medis: $('#no_rkm_medis').val(),
                images: images,
                tgl_masuk: $('#tgl_masuk').val(),
                kategori: $('input[type="radio"]:checked').val(),
                username: "{{ session()->get('pegawai')->nik }}",
                _token: "{{ csrf_token() }}"
            }

            $.ajax({
                url: '/erm/upload',
                method: 'POST',
                data: data,
                dataType: 'JSON',
                success: function(msg) {
                    hiddenForm();
                    showHistory();
                    $(".pip").remove();
                    if ($('.pip').length == 0) {
                        $('#images').val("");
                        $('#submit').hide()
                        $('input[name="kategori"]').each(function(index) {
                            $(this).prop('disabled', false);
                        })

                    }
                    if ($('#tb_pasien').length > 0) {
                        $('#tb_pasien').DataTable().destroy();
                        tb_pasien();
                        hitungUpload();
                    }
                    showForm(data.no_rawat, data.kategori);
                    Swal.fire(
                        'Berhasil!', 'Berkas sudah terupload di server', 'success'
                    )

                },
                fail: function(jqXHR, status) {
                    console.log(status)
                }
            })

        }
        $('#submit').click(function() {})

        function hiddenForm() {
            $('#upload-image').css('visibility', 'hidden')
        }

        function showHistory() {
            var no_rkm_medis = $('.search option:selected').val();
            $('#upload-image').css('visibility', 'hidden');
            $.ajax({
                url: '/erm/periksa/show/' + no_rkm_medis,
                dataType: 'JSON',
                success: function(data) {
                    $('#ralan tbody').empty();
                    $('#ranap tbody').empty();
                    $.map(data, function(item) {
                        if (item.upload.length > 0) {
                            button = '<a href="#form-upload" onclick="detailPeriksa(\'' + item
                                .no_rawat
                                .toString() + '\',\'' + item.status_lanjut +
                                '\')" class="btn btn-success btn-sm"><i class="bi bi-check2-circle"></i></a>'


                        } else {
                            button = '<a href="#form-upload" onclick="detailPeriksa(\'' + item
                                .no_rawat
                                .toString() + '\',\'' + item.status_lanjut +
                                '\')" class="btn btn-primary btn-sm"><i class="bi bi-cloud-upload"></i></a>'
                        }

                        html = '<tr>' +
                            '<td>' + item.no_rawat + '</td>' +
                            '<td>' + item.tgl_registrasi + '</td>' +
                            '<td>' + button + '</td>' +
                            '</tr>'

                        if (item.status_lanjut == 'Ralan') {
                            $('#ralan').append(html);
                        } else {
                            $('#ranap').append(html);
                        }
                    })
                }
            });

        }

        function deleteImage(id, img) {
            kategori = $('input[type="radio"]:checked').val();
            no_rawat = $('#no_rawat').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Swal.fire({
                title: 'Yakin hapus file ini ?',
                text: "anda tidak bisa mengembalikan file yang dihapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/erm/upload/delete/' + id + '?image=' + img,
                        dataType: 'JSON',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            showForm(no_rawat, kategori);
                            if ($('#tb_pasien').length > 0) {
                                $('#tb_pasien').DataTable().destroy();
                                tb_pasien();
                                hitungUpload();
                            }
                            Swal.fire(
                                'Berhasil!', 'Berkas telah dihapus', 'success'
                            )
                        },

                    })
                }
            })
        }



        function hiddenForm() {
            $('#upload-image').css('visibility', 'hidden')

        }
    </script>
    @stack('script')
</body>

</html>
