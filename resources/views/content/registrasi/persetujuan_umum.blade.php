<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-content" content="" {{ csrf_token() }}>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="theme-color" content="#712cf9">


    <style>
    </style>
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

        .form-control-sm {
            font-size: 12px;
            min-height: 12px;
            border-radius: 0;
        }

        .form-underline {
            border: none;
            border-bottom: 1px solid #e9e9e9;
        }

        .form-underline:focus {
            border-bottom: 1px dashed #ececec;
            box-shadow: none;
            transition: background-size .3s ease;
            ;
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
                    <td id="no_rkm_medis"></td>
                    <td>Nomor Rawat </td>
                    <td> : </td>
                    <td id="no_rawat" width="50%"> </td>

                </tr>
                <tr>
                    <td>Nama Pasien </td>
                    <td> : </td>
                    <td id="nm_pasien"> </td>
                    <td>JK</td>
                    <td> :</td>
                    <td id="jk"> </td>
                </tr>
                <tr>
                    <td>Umur </td>
                    <td>:</td>
                    <td id="umur"></td>
                    <td>P. Jawab </td>
                    <td>: </td>
                    <td id="namakeluarga"></td>

                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td class="alamat"></td>
                    <td>Status Lanjut</td>
                    <td>: </td>
                    <td id="stts_lanjut"></td>
                </tr>
            </table>
        </div>
        <div class="isi" style="border:1px solid #000;background-color:white;padding: 2em;margin-bottom:10px"
            id="ranap">
            <ul class="nav nav-tabs" id="myTab">
                <li class="nav-item">
                    <a href="#umum" class="nav-link active" data-bs-toggle="tab">Persetujuan Umum</a>
                </li>
                <li class="nav-item">
                    <a href="#pembiayaan" class="nav-link" data-bs-toggle="tab">Persetujuan Pembiayaan</a>
                </li>
                <li class="nav-item">
                    <a href="#dokter" class="nav-link" data-bs-toggle="tab">Dokter</a>
                </li>
                <li class="nav-item">
                    <a href="#kamar" class="nav-link" data-bs-toggle="tab">Kamar</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="umum">
                    <h4 class="text-center mt-3">
                        PERSETUJUAN UMUM / <i>GENERAL
                            CONSENT</i>
                    </h4>

                    <ol class="mt-4" style="font-size:13px">
                        <li><strong>HAK PASIEN DAN KELUARGA</strong>. Saya telah mendapat informasi dan memahami tentang
                            hak dan
                            kewajiban
                            pasien sesuai Undang-Undang Kesehatan No. 44 tahun 2009 tentang Rumah Sakit. Saya mengerti
                            dan
                            memahami
                            bahwa saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan, serta memiliki hak
                            untuk
                            menyetujui/
                            menolak setiap prosedur/ terapi</li>
                        <li>
                            <strong>PERSETUJUAN PELAYANAN KESEHATAN.</strong> Saya menyetujui dan memberikan persetujuan
                            untuk
                            mendapat
                            pelayanan kesehatan di RSIA Aisyiyah Pekajangan dan dengan ini saya meminta dan memberikan
                            kuasa
                            kepada
                            RSIA Aisyiyah Pekajangan, dokter, perawat dan tenaga kesehatan lainnya untuk memberikan
                            asuhan
                            perawatan,
                            pemeriksaan fisik dan melakukan prosedur diagnostik, radiologi dan/ atau terapi dan
                            tatalaksana
                            sesuai
                            pertimbangan dokter yang diperlukan atau disarankan pada perawatan saya. Hal ini mencakup
                            seluruh
                            pemeriksaan dan
                            prosedur diagnostik rutin, termasuk x-ray, pemberian dan atau tindakan medis serta
                            penyuntikan dan
                            prosedur invasif seperti infus, NGT, DC, dan prosedur invasif lainnya, produk farmasi dan
                            obat-obatan,
                            pemasangan alat
                            kesehatan (kecuali yang membutuhkan persetujuan khusus/ tertulis), dan pengambilan darah
                            untuk
                            pemeriksaan
                            laboratorium atau pemeriksaan patologi yang dibutuhkan untuk pengobatan dan tindakan yang
                            aman.
                        </li>
                        <li>
                            <strong>PELAYANAN KEROHANIAN.</strong> Saya memahami pelayanan kerohanian di RSIA Aisyiyah
                            Pekajangan
                            sesuai
                            agama/ kepercayaan pasien, dan cara bimbingan kerohanian sesuai fasilitas yang ada serta
                            sesuai
                            dengan
                            keinginan pasien/ keluarga.
                        </li>
                        <li>
                            <strong>PRIVASI.</strong> Saya memberikan kuasa kepada RSIA Aisyiyah Pekajangan untuk
                            menjaga
                            privasi
                            dan kerahasiaan
                            penyakit saya selama dalam perawatan.
                        </li>
                        <li>
                            <strong>RAHASIA KEDOKTERAN.</strong> Saya setuju RSIA Aisyiyah Pekajangan wajib menjamin
                            rahasia
                            kedokteran saya
                            baik untuk kepentingan perawatan atau pengobatan, pendidikan, maupun penelitian, kecuali
                            saya
                            mengungkapkan
                            sendiri atau orang lain yang saya beri kuasa sebagai penjamin.
                        </li>
                        <li>
                            <strong>MEMBUKA RAHASIA KEDOKTERAN.</strong> Saya setuju untuk membuka rahasia kedokteran
                            terkait
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
                        <li><strong>BARANG PRIBADI.</strong> Saya setuju untuk tidak membawa barang-barang berharga yang
                            tidak
                            diperlukan (seperti:
                            perhiasan, elektronik, dll) selama dalam perawatan. Saya memahami menyetujui bahwa Rumah
                            Sakit tidak
                            bertanggung jawab atas semua kehilangan, kerusakan atau pencurian barang-barang berharga
                            milik saya.
                            Saya memahami apabila saya membutuhkan perlindungan barang berharga, rumah sakit memiliki
                            fasilitas
                            penitipan barang
                            berharga dan rumah sakit hanya bertanggung jawab atas barang berharga yang dititipkan. </li>
                        <li>
                            <strong>FASILITAS RUMAH SAKIT.</strong> Saya mengerti dan memahami jika terjadi kerusakan
                            yang
                            disebabkan oleh
                            pasien maka menjadi tanggung jawab pasien termasuk fasilitas umum dan fasilitas/ alat medis.
                        </li>
                        <li>
                            <strong>HASIL PELAYANAN.</strong> Saya menyadari bahwa praktek kedokteran bukanlah ilmu
                            pasti dan
                            mengerti bahwa
                            tidak ada jaminan atas hasil pengobatan atau tindakan yang akan diberikan. Saya akan
                            mengikuti
                            pengobatan medis
                            sesuai anjuran Dokter, dan saya berharap semoga diberikan yang terbaik oleh Tuhan Yang Maha
                            Esa.
                        </li>
                        <li>
                            <strong>PENGAJUAN KELUHAN</strong>. Saya telah menerima informasi tentang tatacara
                            mengajukan dan
                            mengatasi keluhan
                            terkait pelayanan. Saya setuju untuk mengikuti tata cara mengajukan keluhan sesuai prosedur
                            yang
                            ada.
                        </li>
                        <li>
                            <strong>TANGGUNG JAWAB PEMBAYARAN.</strong> Saya mengijinkan dan menyetujui Rumah Sakit
                            untuk
                            menagihkan pembayaran
                            kepada saya (termasuk kepada Asuransi/ BPJS Kesehatan) untuk seluruh pelayanan medis, teknis
                            dan
                            fasilitas yang telah saya terima, lebih lanjut saya mengijinkan Rumah Sakit untuk memberikan
                            informasi
                            rekam medis
                            yang diperlukan untuk kepentingan pembayaran. Biaya pelayanan berdasarkan acuan biaya dan
                            ketentuan
                            RSIA
                            Aisyiyah Pekajangan
                        </li>
                    </ol>
                </div>
                <div class="tab-pane fade" id="pembiayaan">
                    <h4 class="text-center mt-3">
                        PERNYATAAN KELAS PERAWATAN DAN PEMBIAYAAN
                    </h4>
                    <div style="font-size:13px">
                        <p>Saya yang bertanda tangan di bawah ini : </p>
                        <table width="100%">
                            <tr>
                                <td width="20%">Nama</td>
                                <td>:</td>
                                <td id="nama_pj"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td id="tgl_pj"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td class="alamat"></td>
                            </tr>
                            <tr>
                                <td>Hubungan dengan Pasien</td>
                                <td>:</td>
                                <td id="png_jawab"></td>
                            </tr>
                        </table>
                        <p class="mt-3">Menyatakan bahwa saya memberikan <b>PERSETUJUAN</b> terhadap diri saya/ pasien
                            dengan :
                        </p>
                        <table width="100%">
                            <tr>
                                <td width="20%">Nama</td>
                                <td>:</td>
                                <td id="nama"></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td id="tgl_lhr"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td class="alamat"></td>
                            </tr>
                        </table>
                        <p class="mt-3">
                            Untuk dilakukan perawatan di RSIA Aisyiyah Pekajangan oleh :
                        </p>
                        <table>
                            <tr>
                                <td>Dokter yang memeriksa di UGD</td>
                                <td>:</td>
                                <td id="dokter_ugd"></td>
                            </tr>
                            <tr>
                                <td>Dokter yanng merawat (DPJP)</td>
                                <td>:</td>
                                <td id="dokter_dpjp"></td>
                            </tr>
                        </table>
                        <p class="mt-3">
                            Dan saya juga menyatakan bahwa saya/ pasien bersedia dirawat sebagai pasien dengan
                            penanggung jawab pembiayaan :
                        </p>

                        <ul style="text-align: justify">
                            <li class="umum"><strong>UMUM</strong>
                                <ol type="a">
                                    <li>Setuju dirawat di kelas :
                                        <select name="kelas" class="">
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="vip">VIP</option>
                                            <option value="vvip">VVIP</option>
                                        </select>
                                        {{-- <strong><span class="kelas"style="color:green"></span></strong> --}}

                                        {{-- Ruang :
                                        <strong><span class="kamar" style="color:green"></span></strong> --}}
                                    </li>
                                    <li>
                                        Setuju dirawat dengan pembiayaan mandiri (umum) dari awal masuk sampai dengan
                                        selesai perawatan.
                                    </li>
                                    <li>
                                        Sanggup dan bersedia membayar seluruh biaya pelayanan di RSIA Aisyiyah
                                        Pekajangan.
                                    </li>
                                    <li>Tidak akan beralih menjadi menggunakan asuransi/ BPJS.
                                    </li>
                                </ol>
                            </li>
                            <li class="bpjs"><strong>BPJS Non PBI / BPJS PBI <sup>*</sup>, dengan ketentuan</strong>
                                <ol type="a">
                                    <li>
                                        Sanggup melengkapi syarat kepesertaan BPJS/ membayar denda iuran BPJS paling
                                        lambat 3 x 24 jam
                                        dirawat. Apabila sampai batas waktu belum melengkapi, maka kepesertaan BPJS
                                        dianggap GUGUR dan pasien dirawat dengan pembiayaan mandiri (umum) dari awal
                                        masuk sampai dengan selesai perawatan.
                                    </li>
                                    <li>
                                        Sanggup dan bersedia dirawat sesuai dengan hak kelas perawatannya. Apabila
                                        menghendaki kelas yang lebih tinggi, maka : <br> <strong>Hak Rawat Kelas 1 atau
                                            2 :</strong>
                                        Sanggup
                                        dan bersedia membayar selisih biaya yang timbul akibat mengambil kelas
                                        diatas hak kelas perawatan saya. <br><strong>Hak Rawat Kelas 3 (PBI dan Non PBI)
                                            :</strong>
                                        Kepesertaan BPJS dianggap GUGUR dan dirawat dengan pembiayaan mandiri (umum).

                                    </li>
                                    <li>Bersedia dirawat di kelas perawatan diatas hak kelas perawatannya apabila kamar
                                        penuh maksimal 3x24 jam sampai kamar perawatan sesuai hak tersedia. Apabila
                                        dalam 3x24 jam belum ada
                                        kamar sesuai hak kelasnya, maka BPJS dianggap gugur dan dirawat dengan
                                        pembiayaan mandiri (umum) sesuai
                                        kelas kamar yang ditempati. </li>
                                    <li>
                                        Apabila pasien menghendaki pulang atas permintaan sendiri sebelum selesai
                                        perawatan kemudian kembali Rawat Inap dalam kurun waktu 30 hari, maka
                                        kepesertaan BPJS dianggap gugur dan dirawat dengan pembiayaan mandiri
                                        (umum) di periode perawatan berikutnya.
                                    </li>
                                    <li>
                                        Apabila pasien menghendaki perpanjangan hari rawat inap setelah dinyatakan boleh
                                        pulang, maka kepesertaan
                                        BPJS dianggap GUGUR dan dirawat dengan pembiayaan mandiri (umum).
                                    </li>
                                </ol>
                            </li>
                        </ul>
                        <p class="mt-3">
                            Saya menyetujui bahwa penunggu pasien rawat inap paling banyak berjumlah 2 orang. Saya
                            sepenuhnya memahami dan akan mematuhi peraturan yang berlaku di RSIA Aisyiyah Pekajangan.
                            Demikian pernyataan ini saya buat dengan sesungguhnya tanpa ada paksaan dari pihak manapun.
                        </p>
                        <p style="font-size:13px"><strong><a class="btn btn-primary btn-setuju" data-id=""
                                    id="" style="border-radius:0px">TELAH MEMBACA
                                    dan
                                    SEPENUHNYA
                                    SETUJU</a></strong> dengan setiap pernyataan
                            diatas dan
                            menandatanganinya
                            tanpa paksaan dan dengan kesadaran penuh.</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="dokter">
                    <div class="row row-cols-1 row-cols-md-2 g-4 dokter mt-4">
                    </div>
                </div>
                <div class="tab-pane fade" id="kamar">
                    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
                        <table width="100%" class="table table-stripped">
                            <tr>
                                <td>
                                    <img src="{{ asset('kamar/KELAS 3.png') }}" alt="" width="300px">
                                </td>
                                <td width="20%">
                                    <h4>KELAS 3</h4>
                                    <strong>KAMAR HALIMATUS SAKDIYAH</strong>
                                </td>
                                <td width="50%">
                                    <ul>
                                        <li>AC Sharing</li>
                                        <li>1 Kamar Mandi Luar untuk 5 Kamar</li>
                                        <li>Luas Ruang 6m<sup>2</sup> </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <img src="{{ asset('kamar/KELAS 2.png') }}" alt="" width="300px">
                                </td>
                                <td width="20%">
                                    <h4>KELAS 2</h4>
                                    <strong>KAMAR SITI BAROROH</strong>
                                </td>
                                <td width="50%">
                                    <ul>
                                        <li>AC</li>
                                        <li>1 Kamar Mandi Luar untuk 2 Kamar</li>
                                        <li>Luas Ruang 9m<sup>2</sup> </li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <img src="{{ asset('kamar/KELAS 1A.png') }}" alt="" width="300px">
                                </td>
                                <td width="20%">
                                    <h4>KELAS 1</h4>
                                    <strong>KAMAR SITI FATIMAH AZ-ZAHRA</strong>
                                </td>
                                <td width="50%">
                                    <ul>
                                        <li>AC</li>
                                        <li>Televisi</li>
                                        <li>Kamar Mandi Dalam</li>
                                        <li>Water Heater</li>
                                        <li>Kulkas 1 Pintu</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('kamar/VIP B.png') }}" alt="" width="300px">
                                </td>
                                <td width="30%">
                                    <h4>KELAS VIP B</h4>
                                    <strong>KAMAR SITI AISYIYAH</strong>
                                </td>
                                <td width="25%">
                                    <ul>
                                        <li>AC</li>
                                        <li>Televisi</li>
                                        <li>Kamar Mandi Dalam</li>
                                        <li>Water Heater</li>
                                        <li>Kulkas 2 Pintu</li>
                                        <li>Kursi Meja Tamu</li>

                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ asset('kamar/VIP A.png') }}" alt="" width="300px">
                                </td>
                                <td width="30%">
                                    <h4>KELAS VIP A</h4>
                                    <strong>KAMAR SITI KHADIJAH</strong>
                                </td>
                                <td width="25%">
                                    <ul>
                                        <li>AC</li>
                                        <li>Televisi</li>
                                        <li>Kamar Mandi Dalam</li>
                                        <li>Water Heater</li>
                                        <li>Kulkas 2 Pintu</li>
                                        <li>Kursi Meja Tamu</li>
                                        <li>Extra 1 bed</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>



            </div>

        </div>
        <div class="isi" style="border:1px solid #000;background-color:white;padding: 2em;margin-bottom:10px"
            id="ralan">
            <h4 class="text-center">
                PERSETUJUAN UMUM / <i>GENERAL
                    CONSENT</i>
            </h4>

            <ol class="mt-4" style="font-size:13px">
                <li><strong>HAK PASIEN DAN KELUARGA</strong>. Saya telah mendapat informasi dan memahami
                    tentang
                    hak dan
                    kewajiban
                    pasien sesuai Undang-Undang Kesehatan No. 44 tahun 2009 tentang Rumah Sakit. Saya
                    mengerti
                    dan
                    memahami
                    bahwa saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan, serta memiliki
                    hak
                    untuk
                    menyetujui/
                    menolak setiap prosedur/ terapi</li>
                <li>
                    <strong>PERSETUJUAN PELAYANAN KESEHATAN.</strong> Saya menyetujui dan memberikan
                    persetujuan
                    untuk
                    mendapat
                    pelayanan kesehatan di RSIA Aisyiyah Pekajangan dan dengan ini saya meminta dan
                    memberikan
                    kuasa
                    kepada
                    RSIA Aisyiyah Pekajangan, dokter, perawat dan tenaga kesehatan lainnya untuk memberikan
                    asuhan
                    perawatan,
                    pemeriksaan fisik dan melakukan prosedur diagnostik, radiologi dan/ atau terapi dan
                    tatalaksana
                    sesuai
                    pertimbangan dokter yang diperlukan atau disarankan pada perawatan saya. Hal ini
                    mencakup
                    seluruh
                    pemeriksaan dan
                    prosedur diagnostik rutin, termasuk x-ray, pemberian dan atau tindakan medis serta
                    penyuntikan dan
                    prosedur invasif seperti infus, NGT, DC, dan prosedur invasif lainnya, produk farmasi
                    dan
                    obat-obatan,
                    pemasangan alat
                    kesehatan (kecuali yang membutuhkan persetujuan khusus/ tertulis), dan pengambilan darah
                    untuk
                    pemeriksaan
                    laboratorium atau pemeriksaan patologi yang dibutuhkan untuk pengobatan dan tindakan
                    yang
                    aman.
                </li>
                <li>
                    <strong>PELAYANAN KEROHANIAN.</strong> Saya memahami pelayanan kerohanian di RSIA
                    Aisyiyah
                    Pekajangan
                    sesuai
                    agama/ kepercayaan pasien, dan cara bimbingan kerohanian sesuai fasilitas yang ada serta
                    sesuai
                    dengan
                    keinginan pasien/ keluarga.
                </li>
                <li>
                    <strong>PRIVASI.</strong> Saya memberikan kuasa kepada RSIA Aisyiyah Pekajangan untuk
                    menjaga
                    privasi
                    dan kerahasiaan
                    penyakit saya selama dalam perawatan.
                </li>
                <li>
                    <strong>RAHASIA KEDOKTERAN.</strong> Saya setuju RSIA Aisyiyah Pekajangan wajib menjamin
                    rahasia
                    kedokteran saya
                    baik untuk kepentingan perawatan atau pengobatan, pendidikan, maupun penelitian, kecuali
                    saya
                    mengungkapkan
                    sendiri atau orang lain yang saya beri kuasa sebagai penjamin.
                </li>
                <li>
                    <strong>MEMBUKA RAHASIA KEDOKTERAN.</strong> Saya setuju untuk membuka rahasia
                    kedokteran
                    terkait
                    dengan
                    kondisi
                    kesehatan, asuhan dan pengobatan yang saya terima kepada :
                    <ul>
                        <li>Dokter dan tenaga kesehatan lain yang memberikan asuhan kepada saya.</li>
                        <li>Perusahaan asuransi kesehatan atau perusahaan lainnya atau pihak lain yang
                            menjamin
                            pembiayaan
                            saya.</li>
                    </ul>
                </li>
                <li><strong>BARANG PRIBADI.</strong> Saya setuju untuk tidak membawa barang-barang berharga
                    yang
                    tidak
                    diperlukan (seperti:
                    perhiasan, elektronik, dll) selama dalam perawatan. Saya memahami menyetujui bahwa Rumah
                    Sakit tidak
                    bertanggung jawab atas semua kehilangan, kerusakan atau pencurian barang-barang berharga
                    milik saya.
                    Saya memahami apabila saya membutuhkan perlindungan barang berharga, rumah sakit
                    memiliki
                    fasilitas
                    penitipan barang
                    berharga dan rumah sakit hanya bertanggung jawab atas barang berharga yang dititipkan.
                </li>
                <li>
                    <strong>FASILITAS RUMAH SAKIT.</strong> Saya mengerti dan memahami jika terjadi
                    kerusakan
                    yang
                    disebabkan oleh
                    pasien maka menjadi tanggung jawab pasien termasuk fasilitas umum dan fasilitas/ alat
                    medis.
                </li>
                <li>
                    <strong>HASIL PELAYANAN.</strong> Saya menyadari bahwa praktek kedokteran bukanlah ilmu
                    pasti dan
                    mengerti bahwa
                    tidak ada jaminan atas hasil pengobatan atau tindakan yang akan diberikan. Saya akan
                    mengikuti
                    pengobatan medis
                    sesuai anjuran Dokter, dan saya berharap semoga diberikan yang terbaik oleh Tuhan Yang
                    Maha
                    Esa.
                </li>
                <li>
                    <strong>PENGAJUAN KELUHAN</strong>. Saya telah menerima informasi tentang tatacara
                    mengajukan dan
                    mengatasi keluhan
                    terkait pelayanan. Saya setuju untuk mengikuti tata cara mengajukan keluhan sesuai
                    prosedur
                    yang
                    ada.
                </li>
                <li>
                    <strong>TANGGUNG JAWAB PEMBAYARAN.</strong> Saya mengijinkan dan menyetujui Rumah Sakit
                    untuk
                    menagihkan pembayaran
                    kepada saya (termasuk kepada Asuransi/ BPJS Kesehatan) untuk seluruh pelayanan medis,
                    teknis
                    dan
                    fasilitas yang telah saya terima, lebih lanjut saya mengijinkan Rumah Sakit untuk
                    memberikan
                    informasi
                    rekam medis
                    yang diperlukan untuk kepentingan pembayaran. Biaya pelayanan berdasarkan acuan biaya
                    dan
                    ketentuan
                    RSIA
                    Aisyiyah Pekajangan
                </li>
            </ol>
            <p style="font-size:13px"><strong><a class="btn btn-primary btn-setuju" data-id="" id=""
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
            <h1>{{ Request::segment(3) }}</h1>
            <h3>PETUGAS : {{ strtoupper(session()->get('pegawai')->nama) }}</h3>
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
                            <button type="button" data-action="save" class="save2 btn btn-primary"
                                data-dismiss="modal"><i class="fa fa-check"></i>
                                Save</button>
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
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js"></script>
    <script src="{{ asset('js/signature_pad.umd.js') }}"></script>
    <script>
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
                        ambilPasien(response.no_rawat)

                        if (response.status_lanjut == 'Ranap') {
                            dokterUmum(response.no_rawat)
                        }


                        // console.log(response)
                        $('#text-consent').css('display', '');
                        $('#idle').css('display', 'none');
                        $('#judul').css('display', 'none');
                        $('#no_rawat').val(response.no_rawat)

                        if ($('#stts_lanjut').text() == 'Ralan') {
                            $('#ranap').css('display', 'none');
                            $('#ralan').css('display', '');
                        } else {
                            $('#ranap').css('display', '');
                            $('#ralan').css('display', 'none');
                        }
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
                    $('#no_rawat').text(response.no_rawat)
                    $('#jk').text(response.pasien.jk == 'L' ? 'Laki-laki' : 'Perempuan')
                    $('#nm_pasien').text(response.pasien.nm_pasien)
                    $('#nama').text(response.pasien.nm_pasien)
                    $('#nama_pj').text(response.p_jawab)
                    $('#tgl_pj').text('-')
                    $('#png_jawab').text(response.hubunganpj)
                    $('#tgl_lhr').text(formatTanggal(response.pasien.tgl_lahir))
                    $('.alamat').text(response.pasien.alamatpj + ', ' + response.pasien.kelurahanpj + ', ' +
                        response.pasien.kecamatanpj + ', ' + response.pasien.kabupatenpj)
                    $('#umur').text(hitungUmur(response.pasien.tgl_lahir))
                    $('#namakeluarga').text(response.pasien.namakeluarga)
                    $('#alamat').text(response.pasien.alamat)
                    $('#stts_lanjut').text(response.status_lanjut)
                    $('#dokter_dpjp').text(response.dokter.nm_dokter)

                    if (response.kamar_inap) {
                        $.map(response.kamar_inap, function(data) {
                            $('.kelas').text(data.kamar.kelas)
                            $('.kamar').text(data.kamar.bangsal.nm_bangsal)
                        })
                    }

                    if (response.kd_pj == 'A03') {
                        $('.bpjs').css('display', 'none');
                        $('.umum').css('display', 'inline');
                    } else {
                        $('.umum').css('display', 'none');
                        $('.bpjs').css('display', 'inline');
                    }
                    // console.log(response)

                    tampilDokter(response.dokter.kd_sps)
                }
            })
        }

        function dokterUmum(no_rawat) {
            $.ajax({
                url: '/erm/penilaian/medis/ranap/ambil',
                data: {
                    no_rawat: no_rawat
                },
                success: function(response) {
                    // console.log('Dokter', response)
                    dokter = response.dokter.nm_dokter ? response.dokter.nm_dokter : '-';
                    $('#dokter_ugd').text(dokter)
                }
            })
        }

        function tampilDokter(kd_sps) {
            no_rawat = $('#no_rawat').text();
            $.ajax({
                url: '/erm/dokter/ambil',
                data: {
                    sps: kd_sps
                },
                success: function(response) {
                    $('.dokter').empty()

                    nm_dokter = $('#dokter_dpjp').text()
                    $.map(response.data, function(data) {
                        if (nm_dokter) {
                            if (data.nm_dokter == nm_dokter) {
                                classBtn = 'btn-success';
                                textBtn = 'DOKTER YANG DIPILIH'
                            } else {
                                classBtn = 'btn-primary';
                                textBtn = 'PILIH DOKTER';
                            }
                        }
                        html = '<div class="col">';
                        html += '<div class="card h-100 mx-auto" style="width: 20rem;">';
                        html +=
                            '<img src="http://192.168.100.33/rsiap/file/pegawai/' + data.pegawai.photo +
                            '" class="card-img-top" alt="">';
                        html += '<div class="card-body">';
                        html += '<p class="card-text text-center h5">' + data.nm_dokter + '</p>';
                        html += '<p class="card-text text-center">' + data.spesialis.nm_sps + '</p>';
                        html += '<div class="d-grid gap-2 col-12 mx-auto"><button class="btn ' +
                            classBtn + '" type="button" id="btn-' + data.kd_dokter +
                            '" onclick="ubahDpjp(\'' + no_rawat + '\',\'' + data
                            .kd_dokter +
                            '\')">' + textBtn + '</button></div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';

                        $('.dokter').append(html)
                    })

                }
            })
        }

        function ubahDpjp(no_rawat, dokter) {
            $.ajax({
                url: '/erm/registrasi/ubah/dokter',
                data: {
                    no_rawat: no_rawat,
                    dokter: dokter,
                },
                success: function(response) {
                    console.log(response)
                }
            })
        }

        var canvas = document.querySelector('canvas');
        ctx = canvas.getContext("2d");
        var background = new Image();
        ctx.drawImage(background, 0, 0);
        var wrapper = document.getElementById("signature-pad"),
            clearButton = wrapper.querySelector("[data-action=clear]"),
            saveButton = wrapper.querySelector("[data-action=save]"),
            canvas = wrapper.querySelector("canvas"),
            signaturePad;
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
                // console.log(signaturePad.toDataURL());
                no_rawat = $('#no_rawat').val();
                nik = "{{ session()->get('pegawai')->nik }}";
                photo = "{{ session()->get('pegawai')->photo }}"
                pegawai = ambilPegawai(nik)
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
                        url = 'http://192.168.100.33/rsiap/file/pegawai/' + photo
                        $('#img-pegawai').attr('src', url)
                        $('#nm_pegawai').text(pegawai.nama)
                    }
                });
            }
        });
        $('.btn-setuju').on('click', function() {
            $('#modalTtd').modal('show')
        })
    </script>

</body>

</html>
