@extends('index')

@section('contents')
    <div class="row gy-2">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-bg-primary">
                    Registrasi Pasien Hari ini
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">

                        <div class="col-md-3">
                            <label>Tanggal Registrasi</label>
                            <input type="date" class="form-control" id="tgl_registrasi" value="{{ date('Y-m-d') }}">
                        </div>

                        <div class="col-md-4">
                            <label>Poliklinik</label>
                            <select class="form-select select2" id="kd_poli">
                                <option value="">Semua Poli</option>
                                {{-- @foreach ($poli as $item)
                                <option value="{{ $item->kd_poli }}">
                                    {{ $item->nm_poli }}
                                </option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Dokter</label>
                            <select class="form-select select2" id="kd_dokter">
                                <option value="">Semua Dokter</option>
                                {{-- @foreach ($dokter as $item)
                                <option value="{{ $item->kd_dokter }}">
                                    {{ $item->nm_dokter }}
                                </option>
                                @endforeach --}}
                            </select>
                        </div>

                        <div class="col-md-1 d-flex align-items-end">
                            <button class="btn btn-primary btn-sm w-100" id="btnFilter">
                                Cari
                            </button>
                        </div>

                    </div>
                    <table class="table table-striped table-responsive text-sm table-sm" id="tb_daftar_pasien" width="100%">

                    </table>

                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modalGeneralConsent" tabindex="-1" aria-labelledby="modalGeneralConsentLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content shadow">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalGeneralConsentLabel">
                        <i class="bi bi-pen me-2"></i>
                        Tanda Tangan Digital
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" id="formInfoAdministrasiPasien" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label">No. Rawat</label>
                                <x-input type="text" id="no_rawat" readonly />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nama Pasien</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="tgl_lahir" name="no_rkm_medis" readonly></x-input>
                                    <x-input id="umurdaftar" name="nm_pasien" readonly class="w-50"></x-input>
                                </x-input-group>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tgl. Lahir/Umur</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="tgl_lahir" name="tgl_lahir" readonly></x-input>
                                    <x-input id="umurdaftar" name="umurdaftar" readonly class="w-25"></x-input>
                                </x-input-group>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Penanggung Jawab</label>
                                <x-input-group class="input-group-sm">
                                    <x-input id="hubunganpj" name="hubunganpj"></x-input>
                                    <x-input id="p_jawab" name="p_jawab" readonly class="w-50" readonly></x-input>
                                </x-input-group>
                            </div>
                        </div>
                    </form>
                    <ul class="nav nav-tabs" id="tabAdministrasiPendaftaran">
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
                                <li>
                                    <strong>SAYA MENGETAHUI DAN MENYETUJUI </strong> berdasarkan Peraturan Menteri Kesehatan
                                    Nomor 24 Tahun
                                    2022 tentang Rekam Medis, fasilitas kesehatan wajib membuka akses dan mengirim data
                                    rekam medis kepada
                                    Kementrian Kesehatan melalui platform <strong><u>SATUSEHAT</u></strong>.
                                </li>
                                <li>
                                    <strong>
                                        MENYETUJUI UNTUK MENERIMA DAN MEMBUKA </strong> data pasien dari Fasilitas Pelayanan
                                    Kesehatan
                                    lainnya melalui <strong><u>SATUSEHAT</u></strong> untuk kepentingan pelayanan kesehatan
                                    dan/atau
                                    rujukan.
                                </li>
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
                                    <strong>PERSETUJUAN PELAYANAN KESEHATAN.</strong>4. Saya memberikan persetujuan kepada
                                    RSIA Aisyiyah Pekajangan beserta dokter, perawat dan tenaga kesehatan lainnya
                                    untuk memberikan pelayanan berupa pemeriksaan umum, laboratorium, radiologi, terapi,
                                    tindakan medis maupun pelayanan
                                    lain sesuai indikasimedis.

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
                                <li><strong>BARANG PRIBADI.</strong>Saya setuju untuk tidak membawa barang-barang berharga
                                    yang tidak diperlukan (perhiasan, elektronik, dll) selama masa
                                    perawatan. Saya memahami rumah sakit tidak bertanggung jawab atas kehilangan, kerusakan
                                    atau pencurian barang berharga
                                    milik saya.
                                </li>
                                <li>
                                    <strong>FASILITAS RUMAH SAKIT.</strong> Saya bertanggung jawab atas kerusakan fasilitas
                                    rumah sakit yang saya sebabkan termasuk fasilitas umum dan
                                    fasilitas/alat medis.
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
                                <p class="mt-3">Menyatakan bahwa saya memberikan <b>PERSETUJUAN</b> terhadap diri saya/
                                    pasien
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
                                                {{-- <strong><span class="kelas" style="color:green"></span></strong> --}}

                                                {{-- Ruang :
                                                <strong><span class="kamar" style="color:green"></span></strong> --}}
                                            </li>
                                            <li>
                                                Setuju dirawat dengan pembiayaan mandiri (umum) dari awal masuk sampai
                                                dengan
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
                                                menghendaki kelas yang lebih tinggi, maka : <br> <strong>Hak Rawat Kelas 1
                                                    atau
                                                    2 :</strong>
                                                Sanggup
                                                dan bersedia membayar selisih biaya yang timbul akibat mengambil kelas
                                                diatas hak kelas perawatan saya. <br><strong>Hak Rawat Kelas 3 (PBI dan Non
                                                    PBI)
                                                    :</strong>
                                                Kepesertaan BPJS dianggap GUGUR dan dirawat dengan pembiayaan mandiri
                                                (umum).

                                            </li>
                                            <li>Bersedia dirawat di kelas perawatan diatas hak kelas perawatannya apabila
                                                kamar
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
                                                Apabila pasien menghendaki perpanjangan hari rawat inap setelah dinyatakan
                                                boleh
                                                pulang, maka kepesertaan
                                                BPJS dianggap GUGUR dan dirawat dengan pembiayaan mandiri (umum).
                                            </li>
                                        </ol>
                                    </li>
                                </ul>
                                <p class="mt-3">
                                    Saya menyetujui bahwa penunggu pasien rawat inap paling banyak berjumlah 2 orang. Saya
                                    sepenuhnya memahami dan akan mematuhi peraturan yang berlaku di RSIA Aisyiyah
                                    Pekajangan.
                                    Demikian pernyataan ini saya buat dengan sesungguhnya tanpa ada paksaan dari pihak
                                    manapun.
                                </p>
                                <p style="font-size:13px"><strong>SAYA TELAH MEMBACA dan SEPENUHNYA SETUJU</strong> dengan
                                    setiap pernyataan
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

                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                        Tutup
                    </button>

                    <div class="d-flex gap-2">

                        <button type="button" id="btnCapture" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil-square me-1"></i>
                            Ambil Tanda Tangan
                        </button>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSignature" tabindex="-1" aria-labelledby="modalSignatureLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
            <div class="modal-content shadow">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalSignatureLabel">
                        <i class="bi bi-pen me-2"></i>
                        Tanda Tangan Digital
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- Preview -->
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Preview Tanda Tangan
                            </label>

                            <div id="imageBox"
                                class="border rounded bg-light d-flex justify-content-center align-items-center"
                                style="height:220px;">

                                {{-- <img class="img-fluid previewSignature d-none" style="max-height:200px;"
                                    alt="Preview Tanda Tangan" src=""> --}}

                                <img class="img-fluid previewSignature" style="max-height:200px;" alt="Preview Tanda Tangan"
                                    src="data:image/png;base64,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">


                                <span class="placeholderSignature text-muted d-none">
                                    Belum ada tanda tangan
                                </span>

                            </div>

                        </div>

                        <!-- Informasi -->
                        <div class="col-md-6">

                            <div class="card border-0 bg-light">

                                <div class="card-body">

                                    <h6 class="card-title">
                                        Informasi
                                    </h6>

                                    <table class="table table-sm mb-0">

                                        <tr>
                                            <th width="40%">No. Rekam Medis</th>
                                            <td class="lblNoRkmMedis">12345</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">No. Rawat</th>
                                            <td class="lblNoRawat">12345</td>
                                        </tr>
                                        <tr>
                                            <th width="40%">Penanda Tangan</th>
                                            <td class="lblSigner">Nama Pasien</td>
                                        </tr>

                                        <tr>
                                            <th>Keperluan</th>
                                            <td class="lblReason">

                                            </td>
                                        </tr>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                    <input type="hidden" class="signature_base64"
                        value="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">
                    <input type="hidden" class="reference_id" id="reference_id" value="12345">
                    <input type="hidden" class="signed_at" value="{{ now() }}">
                    <input type="hidden" class="signatory_first" value="Nama Pasien">
                    <input type="hidden" class="reason" value="Persetujuan Tindakan">
                </div>
                <div class="modal-footer">

                    <button type="button" id="btnSaveSignature" class="btn btn-success btn-sm">
                        <i class="bi bi-check-circle me-1"></i>
                        Simpan
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"
                        aria-label="Close">
                        Tutup
                    </button>


                </div>
            </div>
        </div>
    </div>


@endsection

{{-- @include('content.farmasi.ralan.modal.modal_resep') --}}

@push('script')

    <script>
        // ==========================================================
        // GLOBAL
        // ==========================================================
        let wgssSignatureSDK = null;
        let sigCtl = null;
        let dynCapt = null;
        let sigObj = null;

        // ==========================================================
        // INIT
        // ==========================================================
        window.onload = function () {

            wgssSignatureSDK = new WacomGSS_SignatureSDK(function () {

                if (!wgssSignatureSDK.running) {
                    alert("Service SigCaptX tidak berjalan.");
                    return;
                }

                console.log("Connected to SigCaptX Service");

                initSigCtl();

            }, 8000);

        };

        // ==========================================================
        // MEMBUAT SigCtl
        // ==========================================================
        function initSigCtl() {

            sigCtl = new wgssSignatureSDK.SigCtl(function (sigCtlV, status) {

                if (status !== wgssSignatureSDK.ResponseStatus.OK) {
                    console.error("SigCtl gagal dibuat", status);
                    return;
                }

                sigCtl = sigCtlV;

                console.log("SigCtl OK");

                // ===========================
                // Masukkan licence di sini
                // ===========================
                // sigCtl.PutLicence(, onSigCtlPutLicence);
                sigCtl.PutLicence("eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiI3YmM5Y2IxYWIxMGE0NmUxODI2N2E5MTJkYTA2ZTI3NiIsImV4cCI6MjE0NzQ4MzY0NywiaWF0IjoxNTYwOTUwMjcyLCJyaWdodHMiOlsiU0lHX1NES19DT1JFIiwiU0lHQ0FQVFhfQUNDRVNTIl0sImRldmljZXMiOlsiV0FDT01fQU5ZIl0sInR5cGUiOiJwcm9kIiwibGljX25hbWUiOiJTaWduYXR1cmUgU0RLIiwid2Fjb21faWQiOiI3YmM5Y2IxYWIxMGE0NmUxODI2N2E5MTJkYTA2ZTI3NiIsImxpY191aWQiOiJiODUyM2ViYi0xOGI3LTQ3OGEtYTlkZS04NDlmZTIyNmIwMDIiLCJhcHBzX3dpbmRvd3MiOltdLCJhcHBzX2lvcyI6W10sImFwcHNfYW5kcm9pZCI6W10sIm1hY2hpbmVfaWRzIjpbXX0.ONy3iYQ7lC6rQhou7rz4iJT_OJ20087gWz7GtCgYX3uNtKjmnEaNuP3QkjgxOK_vgOrTdwzD-nm-ysiTDs2GcPlOdUPErSp_bcX8kFBZVmGLyJtmeInAW6HuSp2-57ngoGFivTH_l1kkQ1KMvzDKHJbRglsPpd4nVHhx9WkvqczXyogldygvl0LRidyPOsS5H2GYmaPiyIp9In6meqeNQ1n9zkxSHo7B11mp_WXJXl0k1pek7py8XYCedCNW5qnLi4UCNlfTd6Mk9qz31arsiWsesPeR9PN121LBJtiPi023yQU8mgb9piw_a-ccciviJuNsEuRDN3sGnqONG3dMSA", function (sigCtlV, status) {

                    if (status !== wgssSignatureSDK.ResponseStatus.OK) {
                        console.error("Licence gagal", status);
                        return;
                    }

                    console.log("Licence OK");

                    initDynamicCapture();

                });

            });

        }

        // ==========================================================
        // MEMBUAT DynamicCapture
        // ==========================================================
        function initDynamicCapture() {

            dynCapt = new wgssSignatureSDK.DynamicCapture(function (dynCaptV, status) {

                if (status !== wgssSignatureSDK.ResponseStatus.OK) {
                    console.error("DynamicCapture gagal dibuat", status);
                    return;
                }

                console.log("DynamicCapture OK");

                dynCapt = dynCaptV;

                sigCtl.GetSignature(function (sigCtlV, sigObjV, status) {

                    if (status !== wgssSignatureSDK.ResponseStatus.OK) {
                        console.error("GetSignature gagal", status);
                        return;
                    }

                    sigObj = sigObjV;

                    console.log("SigObj siap");

                });

            });

        }

        // ==========================================================
        // CAPTURE
        // ==========================================================
        function captureSignature() {

            if (!wgssSignatureSDK.running) {
                alert("SigCaptX belum berjalan.");
                return;
            }

            if (!sigCtl || !dynCapt || !sigObj) {
                alert("Wacom belum selesai diinisialisasi.");
                return;
            }

            dynCapt.Capture(
                sigCtl,
                "Karyawan",
                "Harap tanda tangan",
                null,
                null,
                function (dynCaptV, sigObjV, status) {

                    console.log("Capture Status :", status);

                    if (status === wgssSignatureSDK.DynamicCaptureResult.DynCaptOK) {

                        const flags =
                            wgssSignatureSDK.RBFlags.RenderOutputBase64 |
                            wgssSignatureSDK.RBFlags.RenderBackgroundTransparent |
                            wgssSignatureSDK.RBFlags.RenderColor32BPP |
                            wgssSignatureSDK.RBFlags.RenderColorAntiAlias;

                        console.log("Flags:", flags);


                        sigObjV.RenderBitmap(
                            "webp",
                            400,
                            180,
                            0.4,
                            0xFF0000,
                            0x000000,
                            flags,
                            0,
                            0,
                            function (sigObjR, bmpObj, renderStatus) {

                                console.log("Render Status:", renderStatus);

                                if (renderStatus === wgssSignatureSDK.ResponseStatus.OK) {

                                    $(".signature_base64").val(bmpObj);

                                    $(".previewSignature").attr(
                                        "src",
                                        "data:image/png;base64," + bmpObj
                                    );

                                    console.log("Signature Ready");

                                    invertImageBase64(originalBase64, function (newBase64) {
                                        console.log("data:image/png;base64," + bmpObj);
                                        // Anda dapat menetapkan ini ke tag img: document.getElementById('myImg').src = newBase64;
                                    });

                                } else {

                                    alert("Render bitmap gagal.");

                                }

                            }
                        );

                    } else if (status === wgssSignatureSDK.DynamicCaptureResult.DynCaptCancel) {

                        alert("Tanda tangan dibatalkan.");

                    } else {

                        alert("Capture gagal. Status = " + status);

                    }

                }
            );

        }

        function invertImageBase64(base64String, callback) {

            const img = new Image();

            img.onload = function () {

                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                canvas.width = img.width;
                canvas.height = img.height;

                ctx.drawImage(img, 0, 0);

                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const data = imageData.data;

                for (let i = 0; i < data.length; i += 4) {

                    const r = data[i];
                    const g = data[i + 1];
                    const b = data[i + 2];

                    // luminance
                    const gray = (r + g + b) / 3;

                    // Putih -> transparan
                    // Hitam -> opaque
                    const alpha = 255 - gray;

                    data[i] = 0; // Hitam
                    data[i + 1] = 0;
                    data[i + 2] = 0;
                    data[i + 3] = alpha;

                }

                ctx.putImageData(imageData, 0, 0);

                callback(canvas.toDataURL("image/png"));

            };

            img.src = base64String;

        }
    </script>
    <script>
        let tbPasien;

        // let wgssSignatureSDK = null;
        // let sigCtl = null;
        // let dynCapt = null;

        const tabPersetujuanUmum = $('a[href="#umum"]');
        const tabPembiayaanKelas = $('a[href="#pembiayaan"]');

        $(document).ready(function () {

            tbDaftarPasien();

            $('#btnFilter').click(function () {
                tbPasien.ajax.reload();
            });

            $('#tgl_registrasi,#kd_poli,#kd_dokter').change(function () {
                localStorage.setItem('tgl_registrasi', $('#tgl_registrasi').val());
            });

            $('#tgl_registrasi').val(localStorage.getItem('tgl_registrasi'));

            setInterval(function () {
                tbPasien.ajax.reload(null, false);
            }, 10000);

        });

        tabPembiayaanKelas.on('shown.bs.tab', function () {
            console.log("Tab Pembiayaan Kelas ditampilkan.");
            // Lakukan sesuatu ketika tab Pembiayaan Kelas ditampilkan
        });

        $('#btnCapture').click(function () {
            $('#modalSignature').modal('show');

            tabActive = $('#tabAdministrasiPendaftaran').find('.nav-link.active')
            labelTabActive = tabActive.text();
            targetTabActive = tabActive.attr('href');
            $('.lblReason').text(labelTabActive);

            if (!wgssSignatureSDK || !wgssSignatureSDK.running) {
                alert("Service SigCaptX belum berjalan.");
                return;
            }

            if (!sigCtl) {
                alert("SigCtl belum diinisialisasi.");
                return;
            }

            if (!dynCapt) {
                alert("DynamicCapture belum diinisialisasi.");
                return;
            }





            const nama = "Karyawan";
            const alasan = "Harap tanda tangan";

            console.log("Memulai Capture...");

            dynCapt.Capture(
                sigCtl,
                nama,
                alasan,
                null,
                null,
                function (dynCaptV, sigObjV, status) {

                    console.log("Capture callback :", status);

                    if (status === wgssSignatureSDK.DynamicCaptureResult.DynCaptOK) {

                        console.log("Tanda tangan berhasil.");
                        const flags =
                            wgssSignatureSDK.RBFlags.RenderOutputBase64 |
                            wgssSignatureSDK.RBFlags.RenderBackgroundTransparent |
                            wgssSignatureSDK.RBFlags.RenderColor32BPP |
                            wgssSignatureSDK.RBFlags.RenderColorAntiAlias;


                        sigObjV.RenderBitmap(
                            "webp",
                            // 400,
                            // 180,
                            // 0.3,
                            // 0x00FFFFFF, // Background putih
                            // 0x00000000, // Tinta hitam
                            // flags,
                            // 0,
                            // 0,
                            function (sigObj, bmpObj, renderStatus) {

                                console.log("Render status :", renderStatus);

                                if (renderStatus === wgssSignatureSDK.ResponseStatus.OK) {

                                    $(".placeholderSignature").addClass("d-none");

                                    console.log("Preview berhasil dibuat.");

                                    const oriBase64 = "data:image/png;base64," + bmpObj;
                                    invertImageBase64(oriBase64, function (newBase64) {
                                        const rawBase64 = newBase64.split(",")[1];

                                        $(".signature_base64").val(rawBase64);
                                        console.log(newBase64);
                                        $(".previewSignature")
                                            .removeClass("d-none")
                                            .attr("src", newBase64);

                                        // Anda dapat menetapkan ini ke tag img: document.getElementById('myImg').src = newBase64;
                                    });

                                } else {
                                    alert("Render Bitmap gagal.");
                                }

                            }
                        );

                    } else if (status === wgssSignatureSDK.DynamicCaptureResult.DynCaptCancel) {

                        alert("Penandatanganan dibatalkan.");

                    } else {

                        console.error("Capture gagal. Status :", status);

                        alert("Capture gagal. Status = " + status);

                    }

                }
            );

        })

        $('#btnSaveSignature').click(function () {

            // const signatureBase64 = $(".signature_base64").val();
            const no_rawat = $('#formInfoAdministrasiPasien').find('#no_rawat').val();
            const signatureBase64 = $(".signature_base64").val();
            const signedAt = $('#signed_at').val();

            if (!signatureBase64) {
                alert("Tanda tangan belum diambil.");
                return;
            }

            $.ajax({
                url: "{{ route('persetujuan-umum.save') }}",
                method: "POST",
                data: {
                    signature: signatureBase64,
                    no_rawat: no_rawat,
                    signed_at: signedAt,
                }
            }).done(function (response) {

                Swal.fire(
                    'Berhasil',
                    response.message,
                    'success'
                );

                // reset hidden input
                $('.signature_base64').val('');

                // reset preview
                $('#signaturePreview').attr('src', '');

                // kosongkan body
                $('#modalSignature .modal-body').empty();

                // tutup modal
                $('#modalSignature').modal('hide');

                $('#tb_daftar_pasien').DataTable().destroy();
                tbDaftarPasien();

            }).fail(function (xhr, status, error) {
                swal.fire(
                    'Gagal',
                    xhr.responseJSON.message,
                    'error'
                )
            });
        })

        function tbDaftarPasien() {

            tbPasien = $('#tb_daftar_pasien').DataTable({
                processing: false,
                serverSide: true,
                stateSave: true,
                searching: true,
                ordering: true,
                paging: true,
                info: false,
                scrollX: true,

                ajax: {
                    url: "registrasi/ambil/table",
                    data: function (d) {
                        const tanggal = localStorage.getItem('tgl_registrasi') ? localStorage.getItem('tgl_registrasi') : $('#tgl_registrasi').val();
                        d.tgl_registrasi = tanggal;
                        d.kd_poli = $('#kd_poli').val();
                        d.kd_dokter = $('#kd_dokter').val();

                    }
                },

                columns: [
                    {
                        data: 'no_rawat',
                        title: 'No. Rawat'
                    },
                    {
                        data: null,
                        title: 'Pasien',
                        render: function (data, type, row) {
                            return `
                                                                <div class="d-flex align-items-center">
                                                                            ${setIconGender(row.pasien.jk)}
                                                                            <div class="ms-2">
                                                                                <b>${row.pasien.nm_pasien}</b><br>
                                                                                <small>${row.no_rkm_medis}</small>
                                                                            </div>
                                                                </div>`;
                        }
                    },
                    {
                        data: 'poliklinik.nm_poli',
                        title: 'Poli'
                    },
                    {
                        data: 'tgl_registrasi',
                        title: 'Tgl. Registrasi'
                    },
                    {
                        data: 'dokter.nm_dokter',
                        title: 'Dokter'
                    },
                    {
                        data: null,
                        title: 'Persetujuan',
                        className: 'text-center',
                        render: function (data, type, row) {

                            if (row.general_consent?.ttd) {
                                return '<span class="badge bg-success">Selesai</span>';
                            }

                            if (row.general_consent) {
                                return '<span class="badge bg-warning">Proses</span>';
                            }

                            return `
                                                                    <button class="btn btn-primary btn-sm"
                                                                        onclick="modalGeneralConsent('${row.no_rawat}')"
                                                                        data-id="${row.no_rawat}"
                                                                        data-rm="${row.no_rkm_medis}">
                                                                        Proses
                                                                    </button>
                                                                `;
                        }
                    }
                ],

                language: {
                    zeroRecords: "Tidak ada pasien terdaftar",
                    infoEmpty: "Tidak ada pasien terdaftar"
                }
            });
        }

        // memeriksa apakah ada proses general yang gantung ?
        function cekProses(loket) {
            // loket = "{{ Request::segment(3) }}";
            hasil = '';
            $.ajax({
                url: '/erm/persetujuan/ambil',
                data: {
                    loket: loket,
                },
                async: false,
                success: function (response) {
                    // console.log('Cek Proses', response);
                    hasil = response;

                },
                error: function (request, status, error) {
                    swal.fire(
                        'Peringatan',
                        request.responseJSON.message,
                        'error',
                    )
                }

            })
            return hasil;
        }

        function hapusPersetujuan(no_rawat) {
            $.ajax({
                url: 'persetujuan/hapus',
                data: {
                    _token: "{{ csrf_token() }}",
                    no_rawat: no_rawat,
                },
                method: 'DELETE',
                success: function (response) {
                    $('#tb_daftar_pasien').DataTable().destroy();
                    tbDaftarPasien()
                }
            })
        }

        function buka(p, loket) {
            no_rawat = $(p).data('id');
            no_rkm_medis = $(p).data('rm');
            nik = "{{ session()->get('pegawai')->nik }}"
            if (Object.keys(cekProses(loket)).length == 0) {
                $.ajax({
                    url: 'persetujuan/tambah',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        no_rawat: no_rawat,
                        no_rkm_medis: no_rkm_medis,
                        nik: nik,
                        loket: loket,
                    },
                    success: function (response) {
                        $('#tb_daftar_pasien').DataTable().destroy();
                        tbDaftarPasien()
                    },
                    error: function (request, status, error) {
                        swal.fire(
                            'Gagal',
                            request.responseJSON.message,
                            'error'
                        )
                    }
                })
            } else {
                swal.fire(
                    'Peringatan',
                    'Sedang ada antrian',
                    'warning'
                )
            }
        }
        function modalGeneralConsent(no_rawat) {

            getRegPeriksa(no_rawat).done((response) => {
                const formInfoAdministrasiPasien = $('#formInfoAdministrasiPasien');
                const objUmurDaftar = hitungUmurDaftar(response.pasien.tgl_lahir, response.tgl_registrasi);

                const umurDaftar = objUmurDaftar
                    ? `${objUmurDaftar.tahun} Thn ${objUmurDaftar.bulan} Bln ${objUmurDaftar.hari} Hr`
                    : '';

                console.log(formInfoAdministrasiPasien);


                formInfoAdministrasiPasien.find('input[name=no_rawat]').val(no_rawat);
                formInfoAdministrasiPasien.find('input[name=no_rkm_medis]').val(response.no_rkm_medis);
                formInfoAdministrasiPasien.find('input[name=nm_pasien]').val(response.pasien.nm_pasien);
                formInfoAdministrasiPasien.find('input[name=tgl_lahir]').val(response.pasien.tgl_lahir);
                formInfoAdministrasiPasien.find('input[name=umurdaftar]').val(umurDaftar);
                formInfoAdministrasiPasien.find('input[name=p_jawab]').val(response.p_jawab);
                formInfoAdministrasiPasien.find('input[name=hubunganpj]').val(response.hubunganpj);

                $('.lblNoRkmMedis').text(response.no_rkm_medis);
                $('.lblSigner').text(response.p_jawab);
                $('.lblNoRawat').text(no_rawat);

            });

            $('#modalGeneralConsent').modal('show');


        }


    </script>
@endpush