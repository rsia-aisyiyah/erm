<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-content" content="" {{ csrf_token() }}>
    <title>Login</title>
    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/sign-in/"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="theme-color" content="#712cf9">


    <style>
    </style>
    {{-- <link href="{{ asset('css/signature-pad.css') }}" rel="stylesheet">
    <link href="{{ asset('css/ie9.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            background: linear-gradient(#ffffffdb, #ffffff), url('http://192.168.100.10/erm/public/img/bg.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .btn {
            border-radius: 0px;
        }

        canvas #sign {
            border: 1px dashed #000;
        }

        .title {
            top: 0px;
            overflow: hidden;
        }

        .title img {
            float: left;
            height: 100px;
            margin-top: 10px;
        }

        #loket {

            background: #af0f7e;
            color: white;
            padding: 20px;
            text-align: center;
        }

        #loket h2 {
            font-size: 120px;
        }

        #loket h1 {
            font-size: 200px;
            /* font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; */
        }

        /* *{
    margin: 0;
    padding: 0;
} */
        .rate {
            height: 46px;
            padding: 0 105px;
            display: inline-block;
            /* vertical-align: bottom; */
            margin-bottom: 20px;
        }

        .rate:not(:checked)>input {
            position: absolute;
            top: -9999px;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 50px;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }
    </style>
</head>

<body>
    <div class="container-fluid" id="judul">
        <div class="col-md-12">
            <div class="title mt-10">
                <img src="{{ asset('../../public/img/logo.png') }}" alt="" width="100px">
                <div class="text-center">
                    <h1 class="mt-3">ANTRIAN LOKET PENDAFTARAN</h1>
                    <h2 class="m-0">RSIA AISIYIYAH PEKAJANGAN</h2>
                </div>
            </div>
            <hr>
        </div>
    </div>
    <div class="container mt-5" id="text-consent" style="display:none">
        <div id="pasien" class="mb-3"
            style="background: white; border:1px solid #000; padding:15px; font-size:13px">
            <table width="100%">
                <tr>
                    <td>Nomor RM </td>
                    <td> : </td>
                    <td id="no_rkm_medis"> </td>
                    <td>JK</td>
                    <td> :</td>
                    <td id="jk"> </td>
                </tr>
                <tr>
                    <td>Nama Pasien </td>
                    <td> : </td>
                    <td id="nm_pasien"> </td>
                    <td>Umur </td>
                    <td>:</td>
                    <td id="umur"></td>
                </tr>
                <tr>

                    <td>P. Jawab </td>
                    <td>: </td>
                    <td id="namakeluarga"></td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td id="alamat"></td>
                </tr>
            </table>
        </div>
        <div class="isi" style="border:1px solid #000;background-color:white;padding: 2em;margin-bottom:10px">

            <h4 class="text-center">
                PERSETUJUAN UMUM / <i>GENERAL
                    CONSENT</i>
            </h4>

            <ol class="mt-4" style="font-size:13px">
                <li><strong>HAK PASIEN DAN KELUARGA</strong>. Saya telah mendapat informasi dan memahami tentang hak dan
                    kewajiban
                    pasien sesuai Undang-Undang Kesehatan No. 44 tahun 2009 tentang Rumah Sakit. Saya mengerti dan
                    memahami
                    bahwa saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan, serta memiliki hak untuk
                    menyetujui/
                    menolak setiap prosedur/ terapi</li>
                <li>
                    <strong>PERSETUJUAN PELAYANAN KESEHATAN.</strong> Saya menyetujui dan memberikan persetujuan untuk
                    mendapat
                    pelayanan kesehatan di RSIA Aisyiyah Pekajangan dan dengan ini saya meminta dan memberikan kuasa
                    kepada
                    RSIA Aisyiyah Pekajangan, dokter, perawat dan tenaga kesehatan lainnya untuk memberikan asuhan
                    perawatan,
                    pemeriksaan fisik dan melakukan prosedur diagnostik, radiologi dan/ atau terapi dan tatalaksana
                    sesuai
                    pertimbangan dokter yang diperlukan atau disarankan pada perawatan saya. Hal ini mencakup seluruh
                    pemeriksaan dan
                    prosedur diagnostik rutin, termasuk x-ray, pemberian dan atau tindakan medis serta penyuntikan dan
                    prosedur invasif seperti infus, NGT, DC, dan prosedur invasif lainnya, produk farmasi dan
                    obat-obatan,
                    pemasangan alat
                    kesehatan (kecuali yang membutuhkan persetujuan khusus/ tertulis), dan pengambilan darah untuk
                    pemeriksaan
                    laboratorium atau pemeriksaan patologi yang dibutuhkan untuk pengobatan dan tindakan yang aman.
                </li>
                <li>
                    <strong>PELAYANAN KEROHANIAN.</strong> Saya memahami pelayanan kerohanian di RSIA Aisyiyah
                    Pekajangan
                    sesuai
                    agama/ kepercayaan pasien, dan cara bimbingan kerohanian sesuai fasilitas yang ada serta sesuai
                    dengan
                    keinginan pasien/ keluarga.
                </li>
                <li>
                    <strong>PRIVASI.</strong> Saya memberikan kuasa kepada RSIA Aisyiyah Pekajangan untuk menjaga
                    privasi
                    dan kerahasiaan
                    penyakit saya selama dalam perawatan.
                </li>
                <li>
                    <strong>RAHASIA KEDOKTERAN.</strong> Saya setuju RSIA Aisyiyah Pekajangan wajib menjamin rahasia
                    kedokteran saya
                    baik untuk kepentingan perawatan atau pengobatan, pendidikan, maupun penelitian, kecuali saya
                    mengungkapkan
                    sendiri atau orang lain yang saya beri kuasa sebagai penjamin.
                </li>
                <li>
                    <strong>MEMBUKA RAHASIA KEDOKTERAN.</strong> Saya setuju untuk membuka rahasia kedokteran terkait
                    dengan
                    kondisi
                    kesehatan, asuhan dan pengobatan yang saya terima kepada :
                    <ul>
                        <li>Dokter dan tenaga kesehatan lain yang memberikan asuhan kepada saya.</li>
                        <li>Perusahaan asuransi kesehatan atau perusahaan lainnya atau pihak lain yang menjamin
                            pembiayaan
                            saya.</li>
                    </ul>
                </li>
                <li><strong>BARANG PRIBADI.</strong> Saya setuju untuk tidak membawa barang-barang berharga yang tidak
                    diperlukan (seperti:
                    perhiasan, elektronik, dll) selama dalam perawatan. Saya memahami menyetujui bahwa Rumah Sakit tidak
                    bertanggung jawab atas semua kehilangan, kerusakan atau pencurian barang-barang berharga milik saya.
                    Saya memahami apabila saya membutuhkan perlindungan barang berharga, rumah sakit memiliki fasilitas
                    penitipan barang
                    berharga dan rumah sakit hanya bertanggung jawab atas barang berharga yang dititipkan. </li>
                <li>
                    <strong>FASILITAS RUMAH SAKIT.</strong> Saya mengerti dan memahami jika terjadi kerusakan yang
                    disebabkan oleh
                    pasien maka menjadi tanggung jawab pasien termasuk fasilitas umum dan fasilitas/ alat medis.
                </li>
                <li>
                    <strong>HASIL PELAYANAN.</strong> Saya menyadari bahwa praktek kedokteran bukanlah ilmu pasti dan
                    mengerti bahwa
                    tidak ada jaminan atas hasil pengobatan atau tindakan yang akan diberikan. Saya akan mengikuti
                    pengobatan medis
                    sesuai anjuran Dokter, dan saya berharap semoga diberikan yang terbaik oleh Tuhan Yang Maha Esa.
                </li>
                <li>
                    <strong>PENGAJUAN KELUHAN</strong>. Saya telah menerima informasi tentang tatacara mengajukan dan
                    mengatasi keluhan
                    terkait pelayanan. Saya setuju untuk mengikuti tata cara mengajukan keluhan sesuai prosedur yang
                    ada.
                </li>
                <li>
                    <strong>TANGGUNG JAWAB PEMBAYARAN.</strong> Saya mengijinkan dan menyetujui Rumah Sakit untuk
                    menagihkan pembayaran
                    kepada saya (termasuk kepada Asuransi/ BPJS Kesehatan) untuk seluruh pelayanan medis, teknis dan
                    fasilitas yang telah saya terima, lebih lanjut saya mengijinkan Rumah Sakit untuk memberikan
                    informasi
                    rekam medis
                    yang diperlukan untuk kepentingan pembayaran. Biaya pelayanan berdasarkan acuan biaya dan ketentuan
                    RSIA
                    Aisyiyah Pekajangan
                </li>
            </ol>
            <p style="font-size:13px"><strong><a class="btn btn-primary" data-id="" id="btn-setuju"
                        style="border-radius:0px">TELAH MEMBACA
                        dan
                        SEPENUHNYA
                        SETUJU</a></strong> dengan setiap pernyataan
                diatas dan
                menandatanganinya
                tanpa paksaan dan dengan kesadaran penuh.</p>
        </div>
    </div>

    <div class="container" id="idle">
        <div id="loket">
            <h2>LOKET</h2>
            <h1>1</h1>
            {{-- <h1>PASIEN BPJS</h1> --}}
        </div>
    </div>

    <div class="modal fade" id="modalTtd" tabindex="-1" aria-labelledby="modalTtd" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-body">
                    <h5 class="text-center">Tanda Tangan</h5>
                    <div class="signature-pad" id="signature-pad">
                        <div class="signature-pad">
                            <div class="signature-pad-body">
                                <canvas id="sign" width="450" height="200"
                                    style="border:1px dashed #000"></canvas>
                            </div>
                        </div>
                        <br>
                        <div class="signature-pad-footer">
                            <input type="hidden" name="no_rawat" id="no_rawat">
                            <button type="button" id="save2" data-action="save" class="btn btn-primary"
                                data-dismiss="modal"><i class="fa fa-check"></i> Save</button>
                            <button type="button" data-action="clear" class="btn btn-danger"><i
                                    class="fa fa-trash-o"></i> Clear</button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPenilaian" tabindex="-1" aria-labelledby="modalTtd" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-body">
                    <div class="text-center">
                        <img id="img-pegawai" src="" class="rounded" alt="..." width="35%">
                        <p id="nm_pegawai"></p>
                    </div>
                    <h5 class="text-center">Berikan nilai atas pelayanan kami !</h5>
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script src="{{ asset('js/signature_pad.umd.js') }}"></script>
    <script>
        $(document).ready(function() {
            loket = "{{ Request::segment(3) }}"
            no_rawat = $('#no_rawat').val()
            console.log(loket)
            reloadConsent(loket)


        })

        function stopReload(stop) {
            clearInterval(stop);
        }

        function reloadConsent(loket) {
            setInterval(function() {
                cekConsent(loket)
            }, 1000);

        }

        function ambilPegawai(nik) {
            let pegawai = '';
            $.ajax({
                url: '/erm/pegawai/ambil',
                async: false,
                data: {
                    nik: nik,
                },
                success: function(response) {
                    console.log('Pegawai', response)
                    pegawai = response;
                }
            })

            return pegawai;
        }

        $('input[name="rate"]').on('click', function() {
            // alert()
            nik = "{{ session()->get('pegawai')->nik }}";
            nilai = $(this).val()
            $.ajax({
                url: '/erm/penilaian/pendaftaran/simpan',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    nik: nik,
                    nilai: nilai,
                },
                success: function(response) {
                    swal.fire(
                        'Terimakasih',
                        'Atas penilaian anda terhadap kami',
                        'success'
                    );
                    $('#modalPenilaian').modal('hide')
                    $('input[name="rate"]').prop('checked', false);

                },
                error: function(req) {
                    swal.fire(
                        'Gagal',
                        req.responseJSON.message,
                        'error'
                    )
                }
            })
        })

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

        function cekConsent(loket) {
            $.ajax({
                url: '/erm/persetujuan/ambil',
                data: {
                    loket: loket,
                },
                success: function(response) {
                    console.log(response);
                    if (Object.keys(response).length > 0) {
                        $('#text-consent').css('display', '');
                        $('#idle').css('display', 'none');
                        $('#judul').css('display', 'none');
                        $('#no_rawat').val(response.no_rawat)
                        ambilPasien(response.no_rawat)
                    } else {
                        $('#text-consent').css('display', 'none');
                        $('#judul').css('display', '');
                        $('#idle').css('display', '');
                    }
                },
                error: function(request, status, error) {
                    swal.fire(
                        'Peringatan',
                        request.responseJSON.message,
                        'error',
                    )
                }

            })
        }

        function ambilPasien(no_rawat) {
            $.ajax({
                url: '/erm/registrasi/ambil',
                data: {
                    no_rawat: no_rawat
                },
                success: function(response) {
                    console.log(response)
                    $('#no_rkm_medis').text(response.no_rkm_medis)
                    $('#jk').text(response.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan')
                    $('#nm_pasien').text(response.pasien.nm_pasien)
                    $('#umur').text(hitungUmur(response.pasien.tgl_lahir))
                    $('#namakeluarga').text(response.pasien.namakeluarga)
                    $('#alamat').text(response.pasien.alamat)
                }
            })
        }

        var canvas = document.querySelector('canvas');
        ctx = canvas.getContext("2d");
        var background = new Image();
        // background.src =
        //     "http://dkpopnews.fooyoh.com/files/attach/images4/14989425/2015/1/14995985/thumbnail_725x300_ratio.jpg";


        ctx.drawImage(background, 0, 0);
        var wrapper = document.getElementById("signature-pad"),
            clearButton = wrapper.querySelector("[data-action=clear]"),
            saveButton = wrapper.querySelector("[data-action=save]"),
            canvas = wrapper.querySelector("canvas"),
            signaturePad;


        // function resizeCanvas() {

        //     var ratio = window.devicePixelRatio || 1;
        //     canvas.width = canvas.offsetWidth * ratio;
        //     canvas.height = canvas.offsetHeight * ratio;
        //     canvas.getContext("2d").scale(ratio, ratio);
        // }
        signaturePad = new SignaturePad(canvas);
        clearButton.addEventListener("click", function(event) {
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function(event) {

            if (signaturePad.isEmpty()) {

                swal.fire(
                    'PERINGATAN',
                    'Isi tanda tangan terlebih dahulu',
                    'warning'
                )
            } else {
                console.log(signaturePad.toDataURL());
                no_rawat = $('#no_rawat').val();
                nik = "{{ session()->get('pegawai')->nik }}";
                pegawai = ambilPegawai(nik)
                console.log(no_rawat)
                console.log('hasil pegawi', pegawai)
                $.ajax({
                    type: "POST",
                    url: "/erm/persetujuan/ttd",
                    data: {
                        _token: "{{ csrf_token() }}",
                        image: signaturePad.toDataURL(),
                        no_rawat: no_rawat,
                    },
                    success: function(response) {
                        signaturePad.clear();
                        $('#modalPenilaian').modal('show')
                        $('#modalTtd').modal('hide')
                        url = 'http://192.168.100.33/rsiap/file/pegawai/' + pegawai.photo
                        $('#img-pegawai').attr('src', url)
                        $('#nm_pegawai').text(pegawai.nama)
                    }
                });
            }
        });

        // document.addEventListener("DOMContentLoaded", setupSignPad);
        $('#btn-setuju').on('click', function() {
            $('#modalTtd').modal('show')
        })
    </script>

</body>

</html>
