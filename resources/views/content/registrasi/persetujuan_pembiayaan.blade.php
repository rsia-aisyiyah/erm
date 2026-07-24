<h4 class="text-center mt-3">
    PERNYATAAN KELAS PERAWATAN DAN PEMBIAYAAN
</h4>
<div style="font-size:13px">
    <p>Saya yang bertanda tangan di bawah ini : </p>
    <table width="100%" id="tbInfoPjPasien">
        <tr>
            <td width="20%">Nama</td>
            <td>:</td>
            <td>
                <x-input name="p_jawab" id="p_jawab"></x-input>
            </td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td>
                <x-input name="tgl_lahirpj" id="tgl_lahirpj" type="date"></x-input>
            </td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td class="">
                <x-input id="alamatpj" name="alamatpj"></x-input>
            </td>
        </tr>
        <tr>
            <td>Hubungan dengan Pasien</td>
            <td>:</td>
            <td>
                <x-input id="hubunganpj" name="hubunganpj"></x-input>
            </td>
        </tr>
    </table>
    <p class="mt-3">Menyatakan bahwa saya memberikan <b>PERSETUJUAN</b> terhadap diri saya/
        pasien
        dengan :
    </p>
    <table width="100%" id="tbInfoPasien">
        <tr>
            <td width="20%">Nama</td>
            <td>:</td>
            <td class="nm_pasien"></td>
        </tr>
        <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td class="tgl_lahir"></td>
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
            <td class="dokter_ugd"></td>
        </tr>
        <tr>
            <td>Dokter yanng merawat (DPJP)</td>
            <td>:</td>
            <td class="dokter_dpjp"></td>
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
@push('script')
    <script>
        const tabPembiayaanKelas = $('a[href="#pembiayaan"]');
        tabPembiayaanKelas.on('shown.bs.tab', function () {
            console.log("Tab Pembiayaan Kelas ditampilkan.");
            const no_rawat = $('#formInfoAdministrasiPasien').find('input[name="no_rawat"]').val();

            getRegPeriksa(no_rawat).done((response) => {
                console.log('DONE RESPONSE ===', response);
                // alert('success');

                const tbInfoPjPasien = $('#tbInfoPjPasien');
                const tbInfoPasien = $('#tbInfoPasien');

                tbInfoPjPasien.find('input[name="p_jawab"]').val(response.p_jawab);
                tbInfoPjPasien.find('input[name="alamatpj"]').val(`${response.pasien.alamat}, ${response.pasien.kelurahanpj}, ${response.pasien.kecamatanpj}, ${response.pasien.kabupatenpj}`);
                tbInfoPjPasien.find('input[name="hubunganpj"]').val(response.hubunganpj);
                tbInfoPjPasien.find('input[name="hubunganpj"]').val(response.hubunganpj);

                tbInfoPasien.find('.nm_pasien').text(response.pasien.nm_pasien);
                tbInfoPasien.find('.tgl_lahir').text(formatTanggal(response.pasien.tgl_lahir));
                tbInfoPasien.find('.alamat').text(`${response.pasien.alamat}, ${response.pasien.kelurahanpj}, ${response.pasien.kecamatanpj}, ${response.pasien.kabupatenpj}`);

                

            })
            // Lakukan sesuatu ketika tab Pembiayaan Kelas ditampilkan
        });

    </script>
@endpush