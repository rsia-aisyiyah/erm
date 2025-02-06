<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12" id="sectionSkriningTb">
        <div class="card position-relative mt-2">
            <div class="card-header" aria-controls="collapseSkriningTb" data-bs-toggle="collapse"
                 data-bs-target="#collapseSkriningTb">
                <div class="card-text">
                    <span>Skrining TB</span>
                </div>

            </div>
            <div class="card-body collapse show" id="collapseSkriningTb">
                <table class="table w-100 borderless" id="tablePetugasRiwayatSkriningTb">
                    <tr>
                        <td>Petugas</td>
                        <td>:</td>
                        <td id="petugas"></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td id="tanggal"></td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped w-100" id="tableRiwayatSkriningTb">
                    <thead>
                    <tr class="text-center">
                        <th>Gejala & Tanda-Tanda TB</th>
                        <th>Hasil/Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Batuk Berdahak</td>
                        <td id="berdahak"></td>
                    </tr>
                    <tr>
                        <td>Batuk berdahak lebih dari 2 minggu</td>
                        <td id="berdahakB"></td>
                    </tr>
                    <tr>
                        <td>Demam hilang timbul lebih dari 1 Bulan</td>
                        <td id="demam"></td>
                    </tr>
                    <tr>
                        <td>Keringat malam tanpa aktivitas</td>
                        <td id="keringat"></td>
                    </tr>
                    <tr>
                        <td>Penurunan BB tanpa sebab yang jelas atau BB sulit
                            naik dalam satu bulan terakhir
                        </td>
                        <td id="berat"></td>
                    </tr>
                    <tr>
                        <td>Pembesaran kelenjar getah bening (benjolan di daerah
                            leher) dengan ukuran lebih dari 2 cm
                        </td>
                        <td id="kelenjar"></td>
                    </tr>
                    <tr>
                        <td>Sesak nafas dan nyeri dada
                        </td>
                        <td id="sesak"></td>
                    </tr>
                    <tr>
                        <td>Pernah minum obat paru dalam waktu lama
                            sebelumnya
                        </td>
                        <td id="obat"></td>
                    </tr>
                    <tr>
                        <td>Ada keluarga/tetangga yang pernah mengalami sakit
                            paru-paru/TB/pengobatan paru-paru
                        </td>
                        <td id="keluarga"></td>
                    </tr>
                    <tr>
                        <td>Penyakit lain : Asma / Diabetes Melitus / HIV / Penyakit
                            imunokompromised lainnya
                        </td>
                        <td id="penyakit"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div >
    <div class="col-lg-6 col-md-12 col-sm-12" id="sectionSkoringTb">
        <div class="card position-relative mt-2">
            <div class="card-header" aria-controls="collapseSkoringTb" data-bs-toggle="collapse"
                 data-bs-target="#collapseSkoringTb">
                <div class="card-text">
                    <span>Skoring TB</span>
                </div>
            </div>
            <div class="card-body card-text collapse show" id="collapseSkoringTb">

                <table class="table borderless" id="tablePetugasRiwayatSkoringTb">
                    <tr>
                        <td>Dokter DPJP</td>
                        <td>:</td>
                        <td id="dokter"></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td id="tanggal"></td>
                    </tr>
                </table>
                <table class="table table-bordered table-striped w-100" id="tableRiwayatSkoringTb">
                    <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Hasil</th>
                        <th>Skor/Nilai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Kontak TB</td>
                        <td id="ket_kontak"></td>
                        <td id="kontak"></td>
                    </tr>
                    <tr>
                        <td>Uji Tuberkulin (Mantoux)</td>
                        <td id="ket_mantoux"></td>
                        <td id="mantoux"></td>
                    </tr>
                    <tr>
                        <td>Berat Badan/Keadaan Gizi</td>
                        <td id="ket_berat"></td>
                        <td id="berat"></td>
                    </tr>
                    <tr>
                        <td>Demam yang tidak diketahui penyebabnya</td>
                        <td id="ket_demam"></td>
                        <td id="demam"></td>
                    </tr>
                    <tr>
                        <td>Batuk Kronik</td>
                        <td id="ket_batul"></td>
                        <td id="batul"></td>
                    </tr>
                    <tr>
                        <td>Pembesaran kelenjar limfe kolli, aksila, inguinal</td>
                        <td id="ket_pembesaran"></td>
                        <td id="pembesaran"></td>
                    </tr>
                    <tr>
                        <td>Pembengkakan tulang/sendi panggul, lutut, falang</td>
                        <td id="ket_pembengkakan"></td>
                        <td id="pembengkakan"></td>
                    </tr>
                    <tr>
                        <td>Foto Thorax</td>
                        <td id="ket_thorax"></td>
                        <td id="thorax"></td>
                    </tr>
                    <tr>
                        <th colspan="2">Total Skor/Nilai</th>
                        <th id="total_skrining"></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        const containerSkriningTb = $('#containerSkriningTb')
        const containerSkoringTb = $('#containerSkoringTb')

        const tableRiwayatSkriningTb = $('#tableRiwayatSkriningTb')
        const tablePetugasRiwayatSkriningTb = $('#tablePetugasRiwayatSkriningTb')
        const tableRiwayatSkoringTb = $('#tableRiwayatSkoringTb')
        const tablePetugasRiwayatSkoringTb = $('#tablePetugasRiwayatSkoringTb')

        const sectionSkoringTb = $('#sectionSkoringTb')
        const sectionSkriningTb = $('#sectionSkriningTb')

        function setSkriningTb(no_rawat) {
            $.get(`${url}/skrining/tb`, {no_rawat: no_rawat}).done((response) => {
                if(!response.length){
                    sectionSkriningTb.addClass('d-none')
                }else{
                    response.map((item) => {
                        const {pegawai, reg_periksa} = item
                        tablePetugasRiwayatSkriningTb.find('#petugas').html(`${pegawai.nama}`)
                        tablePetugasRiwayatSkriningTb.find('#tanggal').html(`${item.tanggal}`)

                        Object.keys(item).map(key => {
                            tableRiwayatSkriningTb.find(`#${key}`).html(item[key])
                        })

                    })

                }
            })

        }

        function setSkoringTb(no_rawat) {
            $.get(`${url}/skoring/tb`, {no_rawat: no_rawat}).done((response) => {
                if(!response.length){
                    sectionSkoringTb.addClass('d-none')
                }else{
                    sectionSkoringTb.removeClass('d-none')
                    response.map((item) => {
                        tablePetugasRiwayatSkoringTb.find('#dokter').html(`${item.dokter.nm_dokter}`)
                        tablePetugasRiwayatSkoringTb.find('#tanggal').html(`${item.tgl_skrining} ${item.jam_skrining}`)
                        Object.keys(item).map(key => {
                            tableRiwayatSkoringTb.find(`#${key}`).html(item[key])
                        })
                    })
                }
            })
        }


    </script>
@endpush
