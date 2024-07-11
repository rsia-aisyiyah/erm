<div class="modal fade" id="modalSoap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN & RESEP</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-tabs-expand" id="tab-soap-rajal" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-soap" data-bs-toggle="tab"
                            data-bs-target="#tab-soap-pane" type="button" role="tab" aria-controls="tab-soap-pane"
                            aria-selected="true">SOAP</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-obg">
                        <button class="nav-link" id="tab-asesmen-obg" data-bs-toggle="tab" data-bs-target="#tab-asmed-obg"
                            type="button" role="tab" aria-controls="tab-asmed-obg" aria-selected="false">Asesmen Medis Rajal Obgyn</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ana">
                        <button class="nav-link" id="tab-asesmen-anak" data-bs-toggle="tab" data-bs-target="#tab-asmed-ana"
                            type="button" role="tab" aria-controls="tab-asmed-ana" aria-selected="false">Asesmen Medis Rajal Anak</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ranap-obg">
                        <button class="nav-link" id="tab-asesmen-ranap-obg" data-bs-toggle="tab" data-bs-target="#tab-asmed-ranap-obg"
                            type="button" role="tab" aria-controls="tab-asmed-ranap-obg" aria-selected="false">Asesmen Medis Ranap Obgyn</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-asmed-ranap-ana">
                        <button class="nav-link" id="tab-asesmen-ranap-anak" data-bs-toggle="tab" data-bs-target="#tab-asmed-ranap-ana"
                            type="button" role="tab" aria-controls="tab-asmed-ranap-ana" aria-selected="false">Asesmen Medis Ranap Anak</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-laborat-tab" data-bs-toggle="tab" data-bs-target="#permintaan-laborat-tab-pane"
                            type="button" role="tab" aria-controls="permintaan-laborat-tab-pane" aria-selected="true">Permintaan Lab</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-lab-ana">
                        <button class="nav-link" id="tab-lab" data-bs-toggle="tab" data-bs-target="#lab-ana"
                            type="button" role="tab" aria-controls="lab-ana" aria-selected="false">Hasil Laboratorium</button>
                    </li>
                    <li class="nav-item" role="presentation" id="li-rad-ana">
                        <button class="nav-link" id="tab-rad" data-bs-toggle="tab" data-bs-target="#rad-ana"
                            type="button" role="tab" aria-controls="rad-ana" aria-selected="false">Hasil Radiologi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-radiologi-tab" data-bs-toggle="tab" data-bs-target="#permintaan-radiologi-tab-pane"
                            type="button" role="tab" aria-controls="permintaan-radiologi-tab-pane" aria-selected="true">Permintaan Radiologi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="skriningTB" data-bs-toggle="tab" data-bs-target="#skriningTB-pane"
                            type="button" role="tab" aria-controls="skriningTB-pane" aria-selected="true">Skrining/Skoring TB</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="tab-soap-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.soap')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-obg" role="tabpanel" aria-labelledby="tab-asmed"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_kandungan')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ana" role="tabpanel" aria-labelledby="tab-asmed"
                        tabindex="0">
                        @include('content.poliklinik.modal.pemeriksaan.asmed_anak')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ranap-obg" role="tabpanel" aria-labelledby="tab-asmed-ranap"
                        tabindex="0">
                        @include('content.ranap.form.form_asmed_kandungan')
                    </div>
                    <div class="tab-pane fade p-3" id="tab-asmed-ranap-ana" role="tabpanel" aria-labelledby="tab-asmed-ranap"
                        tabindex="0">
                        @include('content.ranap.form.form_asemd_anak')
                    </div>
                    <div class="tab-pane fade" id="permintaan-laborat-tab-pane" role="tabpanel" aria-labelledby="permintaan-laborat-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_lab')

                    </div>
                    <div class="tab-pane fade p-3" id="lab-ana" role="tabpanel" aria-labelledby="tab-lab"
                        tabindex="0">
                        <small class="mb-3 px-2 py-1 fw-semibold text-danger bg-danger bg-opacity-10 border border-danger opacity-10 rounded-3" id="alertHasilLab" style="display: none">Belum / Tidak dilakukan pemeriksaan laboratorium</small>
                        <div class="container" id="viewHasilLaborat" style="display: none">
                            <h5 class="text-center">HASIL PEMERIKSAAN LAB</h5>
                            <table class="table table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th>Pemeriksaan</th>
                                        <th>Hasil</th>
                                        <th>Nilai Rujukan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="tabel-lab">
                                </tbody>
                            </table>
                        </div>
                        <br><button type="button" class="mt-3 btn btn-warning btn-sm" id="btnHasilKritis"><i class="bi bi-pencil me-2"></i> Hasil Kritis</button>
                    </div>
                    <div class="tab-pane fade" id="permintaan-radiologi-tab-pane" role="tabpanel" aria-labelledby="permintaan-radiologi-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_radiologi')
                    </div>
                    <div class="tab-pane fade p-3" id="rad-ana" role="tabpanel" aria-labelledby="tab-radiologi"
                        tabindex="0">
                        <small class="mb-3 px-2 py-1 fw-semibold text-danger bg-danger bg-opacity-10 border border-danger opacity-10 rounded-3" id="alertHasilRadiologi" style="display: none">Belum / Tidak dilakukan pemeriksaan radiologi</small>
                        <div class="row" id="viewHasilRadiologi" style="display: none">
                            <table class="table text-sm table-bordered" id="tbHasilRadiologi">
                                <thead>
                                    <tr>
                                        <th>Tanggal Sampel</th>
                                        <th>Diagnosa Klinis</th>
                                        <th>Informasi Medis</th>
                                        <th>Jenis Pemeriksaan</th>
                                        <th>Hasil</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade p-3" id="skriningTB-pane" role="tabpanel" aria-labelledby="tab-tb"
                        tabindex="0">
                        <form action="" id="formPasienSkoringTb">
                            <div class="row gy-1">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <label for="no_rawat">No. Rawat</label>
                                    <input type="text" class="form-control br-full" id="no_rawat" name="no_rawat" readonly>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <label for="nm_pasien">Pasien</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="no_rkm_medis" name="no_rkm_medis" readonly>
                                        <input type="text" class="form-control w-50" id="nm_pasien" name="nm_pasien" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <label for="tgl_lahir">Tgl. Lahir/Umur</label>
                                    <input type="text" class="form-control" id="tgl_lahir" name="tgl_lahir" readonly>
                                </div>
                            </div>
                            <div class="row gy-1">
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <label for="keluarga">Keluarga</label>
                                    <input type="text" class="form-control br-full" id="p_jawab" name="p_jawab" readonly>
                                </div>
                                <div class="col-lg-2 col-md-4 col-sm-12">
                                    <label for="nm_poli">Poliklinik</label>
                                    <input type="text" class="form-control br-full" id="nm_poli" name="nm_poli" readonly>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12">
                                    <label for="dokter">DPJP</label>
                                    <div class="input-group">
                                        <input type="text" id="kd_dokter" name="kd_dokter" class="form-control" readonly>
                                        <input type="text" class="form-control w-50" id="nm_dokter" name="nm_dokter" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="nav nav-tabs mt-3" id="tabsSkoringTb" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="formSkoringTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkoringTb" type="button" role="tab" aria-controls="tabSkoringTb" aria-selected="true">Form Skoring</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="SkoringTb-tab" data-bs-toggle="tab" data-bs-target="#SkoringTb" type="button" role="tab" aria-controls="SkoringTb" aria-selected="true">Hasil Skoring</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="formSkriningTb-tab" data-bs-toggle="tab" data-bs-target="#tabSkriningTb" type="button" role="tab" aria-controls="tabSkiringTb" aria-selected="true">Form Skrining</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="skriningTb-tab" data-bs-toggle="tab" data-bs-target="#skriningTb" type="button" role="tab" aria-controls="skriningTb" aria-selected="true">Hasil Skrining</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="tabSkoringTb" role="tabpanel" aria-labelledby="formSkoringTb-tab">
                                <div style="background-color:whitesmoke;border-radius:10px;padding:10px">
                                    @include('content.ranap.modal.skriningTb._formSkoringTb')
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="SkoringTb" role="tabpanel" aria-labelledby="SkoringTb-tab">
                                <table class="table nowrap" id="tbSkoringTb" width="100%"></table>
                            </div>
                            <div class="tab-pane fade p-3" id="tabSkriningTb" role="tabpanel" aria-labelledby="formSkriningTb-tab">
                                <div style="background-color:whitesmoke;border-radius:10px;padding:10px">
                                    @include('content.ranap.modal.skriningTb._formSkriningTb')
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="skriningTb" role="tabpanel" aria-labelledby="skriningTb-tab">
                                <table class="table nowrap" id="tbSkriningTb" width="100%"></table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Keluar</button>
                <button type="button" class="btn btn-success btn-sm btn-soap" onclick="createSoapRalan()"><i class="bi bi-save"></i> Simpan SOAP</button>
                <button type="button" class="btn btn-success btn-sm btn-asmed" name="simpan" style="display: none"><i class="bi bi-save"></i> Simpan Asmed Rajal</button>
                <button type="button" class="btn btn-success btn-sm btn-asmed-ranap" name="simpan" style="display: none"><i class="bi bi-save"></i> Simpan Asmed Ranap</button>
            </div>
        </div>
    </div>
</div>
@include('content.poliklinik.modal.moda_detail_resep')

@push('script')
    <script>
        const btnTabAsmedAnak = $('button[data-bs-target="#tab-asmed-ana"]');
        const btnTabAsmedRanapAnak = $('button[data-bs-target="#tab-asmed-ranap-ana"]');

        const btnTabAsmedObgyn = $('button[data-bs-target="#tab-asmed-obg"]');
        const btnTabAsmedRanapObgyn = $('button[data-bs-target="#tab-asmed-ranap-obg"]');

        const formAsmedAnak = $('#formAsmedAnak');
        const formAsmedRanapAnak = $('#formAsmedRanapAnak');

        const formAsmedRajalKandungan = $('#formAsmedRajalKandungan');
        const formAsmedRanapKandungan = $('#formAsmedRanapKandungan');

        const btnTabPermintaanLab = $('button[data-bs-target="#permintaan-laborat-tab-pane"]');

        const btnsSkriningTB = $('button[data-bs-target="#skriningTB-pane"]');


        $('button[data-bs-target="#tab-soap-pane"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'inline')

        })

        btnTabAsmedAnak.on('shown.bs.tab', function(e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedAnak)
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'inline')
            $('.btn-soap').css('display', 'none')

        })
        btnTabAsmedObgyn.on('shown.bs.tab', function(e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRajalKandungan)
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'inline')
            $('.btn-soap').css('display', 'none')

        })
        btnTabAsmedRanapAnak.on('shown.bs.tab', function(e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRanapAnak)
            $('.btn-asmed-ranap').css('display', 'inline')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
        })

        btnTabAsmedRanapObgyn.on('shown.bs.tab', function(e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            setSoapToAsmed(no_rawat, formAsmedRanapKandungan)
            $('.btn-asmed-ranap').css('display', 'inline')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
        });

        btnsSkriningTB.on('shown.bs.tab', function(e, x, y) {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            drawTbSkriningTb(no_rawat)
            drawTbSkoringTb(no_rawat)
            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    dokter,
                    poliklinik
                } = response;
                formPasienSkoringTb.find('input[name=no_rawat]').val(no_rawat)
                formPasienSkoringTb.find('input[name=no_rkm_medis]').val(response.no_rkm_medis)
                formPasienSkoringTb.find('input[name=nm_pasien]').val(`${pasien.nm_pasien} (${pasien.jk})`)
                formPasienSkoringTb.find('input[name=tgl_lahir]').val(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`)
                formPasienSkoringTb.find('input[name=nm_poli]').val(poliklinik.nm_poli)
                formPasienSkoringTb.find('input[name=p_jawab]').val(`${response.p_jawab} (${response.hubunganpj})`)
                formPasienSkoringTb.find('input[name=nm_dokter]').val(dokter.nm_dokter)
                formPasienSkoringTb.find('input[name=kd_dokter]').val(response.kd_dokter)
            })

            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
        })

        $('button[data-bs-target="#lab-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            $('#tabel-lab').empty()
            getHasilLab(no_rawat).done((lab) => {
                let jenisPerawatan = '';
                let tglPeriksa = '';
                let hasil = '';
                if (lab.length) {
                    lab.map((item, index) => {

                        const detail = item.detail.map((detail, index) => {
                            return `<tr ${setWarnaPemeriksaan(detail.keterangan)}>
                                <td>${detail.template.Pemeriksaan}</td>
                                <td>${detail.nilai} ${detail.template.satuan}</td>
                                <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                                <td>${detail.keterangan}</td></tr>`
                        })
                        if (jenisPerawatan != item.jns_perawatan_lab.kd_jenis_prw || tglPeriksa != item.tgl_periksa) {
                            hasil += `<tr class="borderless" style="background-color:#eee">
                                <td colspan="3"><strong>${item.jns_perawatan_lab.nm_perawatan}</strong><br/>
                                ${formatTanggal(item.tgl_periksa)} ${item.jam}</td>

                                <td>${item.petugas.nama}</td></tr>${detail}
                                `
                        }

                        if (item.keterangan == 'L') {
                            warna = 'style="color:#fff;background-color:#0d6efd;font-weight:bold"';
                        } else if (item.keterangan == 'H' || item.keterangan == '*' || item.keterangan == '**') {
                            warna = 'style="color:#fff;background-color:#dc3545;font-weight:bold"';
                        } else if (item.keterangan == 'K' || item.keterangan == 'k') {
                            warna = 'style="color:#fff;background-color:#dc3;font-weight:bold"';
                        } else {
                            warna = '';
                        }
                        jenisPerawatan = item.jns_perawatan_lab.kd_jenis_prw;
                        tglPeriksa = item.tgl_periksa;
                    })
                    $('#tabel-lab').append(hasil)
                    $('#viewHasilLaborat').css('display', 'inline')
                    $('#alertHasilLab').css('display', 'none')
                } else {
                    $('#viewHasilLaborat').css('display', 'none')
                    $('#alertHasilLab').css('display', 'inline')

                }
            })
        })
        $('button[data-bs-target="#rad-ana"]').on('shown.bs.tab', function(e, x, y) {
            $('.btn-asmed-ranap').css('display', 'none')
            $('.btn-asmed').css('display', 'none')
            $('.btn-soap').css('display', 'none')
            const no_rawat = $('#nomor_rawat').val();
            $('#tbHasilRadiologi tbody').empty()
            getPermintaanRadiologi(no_rawat).done((permintaan) => {
                if (Object.keys(permintaan).length) {
                    permintaan.map((prm, index) => {
                        html = `<tr><td>${splitTanggal(prm.tgl_hasil)} ${prm.jam_hasil}</td>
                                <td>${prm.diagnosa_klinis}</td>
                                <td>${prm.informasi_tambahan}</td>
                                <td>
                        `
                        prm.periksa_radiologi.map((periksa) => {
                            if (periksa.tgl_periksa == prm.tgl_hasil && periksa.jam == prm.jam_hasil) {
                                html += `${periksa.jns_perawatan.nm_perawatan}, <br/>`
                            }
                        })

                        html += `</td>`
                        html += `<td>`
                        prm.hasil_radiologi.map((hasil) => {
                            if (hasil.tgl_periksa == prm.tgl_hasil && hasil.jam == prm.jam_hasil) {
                                html += `${stringPemeriksaan(hasil.hasil)}`
                            }
                        })
                        html += `</td>`
                        html += `<td>`
                        if (prm.gambar_radiologi.length) {
                            prm.gambar_radiologi.map((gambar) => {
                                if (gambar.tgl_periksa == prm.tgl_hasil && gambar.jam == prm.jam_hasil) {
                                    gbr = `${getBaseUrl(`/webapps/radiologi/${gambar.lokasi_gambar}`)}`
                                    html += `<a class="btn btn-success btn-sm mb-2" id="btnMagnifyImage" class="magnifyImg${index}" data-magnify="gallery" data-src="${gbr}">
                                                <i class="bi bi-eye"></i> BUKA GAMBAR
                                            </a><br/>`
                                } else {
                                    html += `<button class="btn btn-danger btn-sm mb-2"><i class="bi bi-eye-slash"></i> GAMBAR KOSONG</button>`

                                }
                            })
                        } else {
                            html += `<button class="btn btn-danger btn-sm mb-2"><i class="bi bi-eye-slash"></i> GAMBAR KOSONG</button>`
                        }
                        html += `</td>`
                        html += `<tr>`

                        $('#tbHasilRadiologi tbody').append(html)
                    })

                    $('#viewHasilRadiologi').css('display', 'flex')
                    $('#alertHasilRadiologi').css('display', 'none')

                } else {
                    $('#viewHasilRadiologi').css('display', 'none')
                    $('#alertHasilRadiologi').css('display', 'inline')
                }
            })
        })

        function modalSoapRalan(no_rawat) {
            const formSoapPoli = $('#formSoapPoli')
            const btnCatatanPasien = $('#btnCatatanPasien')
            formSoapPoli.find('input[name="alergi"]').val('-').removeAttr('style');
            btnCatatanPasien.attr('onclick', `catatanPasien('${no_rawat}')`)
            formSoapPoli.find('select[name="petugas"]').prop('disabled', false)
            if (role === 'dokter') {
                formSoapPoli.find('select[name="petugas"]').prop('disabled', true)
                cekPanggilanPoli(no_rawat).done((response) => {
                    if (!Object.keys(response).length) {
                        Swal.fire({
                            title: 'Info',
                            text: 'Pasien belum dipanggil, apakah anda yakin ingin memanggilnya?',
                            icon: 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Panggil',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                panggil(no_rawat)
                            }
                        })
                    }
                });
            }

            getRegPeriksa(no_rawat).done((response) => {
                const {
                    pasien,
                    penjab,
                    dokter
                } = response;
                formSoapPoli.find('input[name="no_rawat"]').val(no_rawat)
                formSoapPoli.find('input[name="no_rkm_medis"]').val(response.no_rkm_medis)
                formSoapPoli.find('input[name="status_bayar"]').val(response.status_bayar)
                formSoapPoli.find('input[name="nm_pasien"]').val(`${pasien.nm_pasien} (${pasien.jk}) / ${hitungUmur(pasien.tgl_lahir)}`)
                formSoapPoli.find('input[name="png_jawab"]').val(penjab.png_jawab)
                formSoapPoli.find('input[name="p_jawab"]').val(`${pasien.namakeluarga} (${pasien.keluarga})`)
                if (pasien.ket_pasien) {
                    formSoapPoli.find('input[name=ket_pasien]').val(pasien.ket_pasien.keterangan)
                }
                const itemDokter = new Option(dokter.nm_dokter, dokter.kd_dokter, true, true);
                formSoapPoli.find('select[name="dokter"]').append(itemDokter).trigger('change');

                asmedBySpesialis(dokter.kd_sps)
                setRiwayatAlergi(response.no_rkm_medis);
                getResepObat(no_rawat);
                setPemeriksaanPoli(no_rawat, response.kd_poli)
                if (response.status_bayar === 'Sudah Bayar') {
                    actionResep.addClass('d-none')
                    actionIsiResep.addClass('d-none')
                } else {
                    actionResep.removeClass('d-none')
                    actionIsiResep.removeClass('d-none')
                }



                $('#modalSoap').modal('show');


            })
        }

        function asmedBySpesialis(kd_sps) {
            switch (kd_sps) {
                case "S0003":
                    btnTabAsmedRanapObgyn.addClass('d-none')
                    btnTabAsmedObgyn.addClass('d-none')
                    btnTabAsmedAnak.removeClass('d-none')
                    btnTabAsmedRanapAnak.removeClass('d-none')
                    break;
                case "S0001":
                    btnTabAsmedRanapObgyn.removeClass('d-none')
                    btnTabAsmedObgyn.removeClass('d-none')
                    btnTabAsmedAnak.addClass('d-none')
                    btnTabAsmedRanapAnak.addClass('d-none')
                    break;
                default:
                    break;
            }
        }

        function setRiwayatAlergi(no_rkm_medis) {
            getRiwayatAlergi(no_rkm_medis).done((data) => {
                data.map((item) => {
                    return item.pemeriksaan_ralan.map((itemPemeriksaan, index) => {
                        if (itemPemeriksaan.alergi.length > 1) {
                            return formSoapPoli.find('input[name="alergi"]').val(itemPemeriksaan.alergi);
                        }
                    });

                })
                const alergi = formSoapPoli.find('input[name="alergi"]').val();
                if (alergi != '-') {
                    formSoapPoli.find('input[name="alergi"]').val(alergi).css('border-color', 'red');
                } else {
                    formSoapPoli.find('input[name="alergi"]').val('-').removeAttr('style');
                }

            });
        }

        function setPemeriksaanPoli(no_rawat, kd_poli) {
            getPemeriksaanPoli(no_rawat, kd_poli).done((dataPeriksa) => {
                if (dataPeriksa.length == 1) {
                    dataPeriksa.forEach((item) => {
                        const {
                            pegawai,
                            dokter
                        } = item;
                        if (!dokter) {
                            const itemPetugas = new Option(pegawai.nama, pegawai.nik, true, true);
                            formSoapPoli.find('select[name="petugas"]').append(itemPetugas).trigger('change');
                        }
                        formSoapPoli.find('select[name="kesadaran"]').append(kesadaran).trigger('change');
                        formSoapPoli.find('input[name="suhu_tubuh"]').val(item.suhu_tubuh);
                        formSoapPoli.find('input[name="tinggi"]').val(item.tinggi);
                        formSoapPoli.find('input[name="berat"]').val(item.berat);
                        formSoapPoli.find('input[name="spo2"]').val(item.spo2);
                        formSoapPoli.find('input[name="respirasi"]').val(item.respirasi);
                        formSoapPoli.find('input[name="nadi"]').val(item.nadi);
                        formSoapPoli.find('input[name="tensi"]').val(item.tensi);
                        formSoapPoli.find('input[name="gcs"]').val(item.gcs);
                        formSoapPoli.find('textarea[name="keluhan"]').val(item.keluhan);
                        formSoapPoli.find('textarea[name="pemeriksaan"]').val(item.pemeriksaan);
                        formSoapPoli.find('textarea[name="penilaian"]').val(item.penilaian);
                        formSoapPoli.find('textarea[name="instruksi"]').val(item.instruksi);
                        formSoapPoli.find('textarea[name="rtl"]').val(item.rtl);

                    })
                } else if (dataPeriksa.length > 1) {

                    dataPeriksa.forEach(item => {
                        const {
                            pegawai,
                            dokter
                        } = item;

                        if (!dokter) {
                            const itemPetugas = new Option(pegawai.nama, pegawai.nik, true, true);
                            formSoapPoli.find('select[name="petugas"]').append(itemPetugas).trigger('change');
                            // formSoapPoli.find('select[name="petugas"]').prop('disabled', true);
                        } else if (dokter) {
                            formSoapPoli.find('select[name="kesadaran"]').append(kesadaran).trigger('change');
                            formSoapPoli.find('input[name="suhu_tubuh"]').val(item.suhu_tubuh);
                            formSoapPoli.find('input[name="tgl_perawatan"]').val(item.tgl_perawatan);
                            formSoapPoli.find('input[name="jam_rawat"]').val(item.jam_rawat);
                            formSoapPoli.find('input[name="tinggi"]').val(item.tinggi);
                            formSoapPoli.find('input[name="berat"]').val(item.berat);
                            formSoapPoli.find('input[name="spo2"]').val(item.spo2);
                            formSoapPoli.find('input[name="respirasi"]').val(item.respirasi);
                            formSoapPoli.find('input[name="nadi"]').val(item.nadi);
                            formSoapPoli.find('input[name="tensi"]').val(item.tensi);
                            formSoapPoli.find('input[name="gcs"]').val(item.gcs);
                            formSoapPoli.find('textarea[name="keluhan"]').val(item.keluhan);
                            formSoapPoli.find('textarea[name="pemeriksaan"]').val(item.pemeriksaan);
                            formSoapPoli.find('textarea[name="penilaian"]').val(item.penilaian);
                            formSoapPoli.find('textarea[name="instruksi"]').val(item.instruksi);
                            formSoapPoli.find('textarea[name="rtl"]').val(item.rtl);
                        }
                    });

                } else {
                    const nik = `{{ session()->get('pegawai')->nik }}`;
                    const pegawai = `{{ session()->get('pegawai')->nama }}`;
                    const itemPetugas = new Option(pegawai, nik, true, true);
                    formSoapPoli.find('select[name="petugas"]').append(itemPetugas).trigger('change');
                }
            })
        }



        function setSoapToAsmed(no_rawat, form) {
            return getPemeriksaanPoli(no_rawat, kd_poli).done((response) => {
                const pemeriksaan = response.filter(item => item.dokter)
                if (pemeriksaan.length != 0) {
                    pemeriksaan.forEach(item => {
                        const {
                            reg_periksa,
                            pegawai,
                            dokter
                        } = item;
                        const {
                            pasien
                        } = reg_periksa;

                        form.find('input[name="no_rawat"]').val(no_rawat)
                        form.find('input[name="no_rkm_medis"]').val(reg_periksa.no_rkm_medis)
                        form.find('input[name="pasien"]').val(`${pasien.nm_pasien} (${pasien.jk})`)
                        form.find('input[name="tgl_lahir"]').val(`${formatTanggal(pasien.tgl_lahir)} / ${hitungUmur(pasien.tgl_lahir)}`)

                        form.find(`input[name="kd_dokter"]`).val(dokter.kd_dokter)
                        form.find(`input[name="nm_dokter"]`).val(dokter.nm_dokter)

                        form.find(`select[name="kesadaran"]`).val(item.kesadaran).change();
                        form.find(`input[name="gcs"]`).val(item.gcs);
                        form.find(`input[name="alergi"]`).val(item.alergi);
                        form.find(`input[name="tb"]`).val(item.tinggi);
                        form.find(`input[name="bb"]`).val(item.berat);
                        form.find(`input[name="td"]`).val(item.tensi);
                        form.find(`input[name="nadi"]`).val(item.nadi);
                        form.find(`input[name="rr"]`).val(item.respirasi);
                        form.find(`input[name="suhu"]`).val(item.suhu_tubuh);
                        form.find(`input[name="spo"]`).val(item.spo2);
                        form.find(`textarea[name="rps"]`).val(item.keluhan);
                        form.find(`textarea[name="ket_fisik"]`).val(item.pemeriksaan);
                        form.find(`textarea[name="diagnosis"]`).val(item.penilaian);
                        form.find(`textarea[name="konsul"]`).val(item.instruksi);
                        form.find(`textarea[name="tata"]`).val(item.rtl);
                    })


                }
            })
        }

        function setAsmedRajalKandungan(no_rawat) {
            getAsmedRajalKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRajalKandungan select[name=${index}]`);
                        input = $(`#formAsmedRajalKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRajalKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRajalKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRajalKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRajalKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRajalKandungan');
                }
            })
        }

        function setAsmedAnak(no_rawat) {
            getAsmedAnak(no_rawat).done((response) => {
                $('.form-asmed-anak button[name="simpan"]').css('display', 'inline')
                $('.form-asmed-anak button[name="edit"]').css('display', 'none')
                if (Object.keys(response).length != 0) {
                    $('.form-asmed-anak button[name="simpan"]').css('display', 'none')
                    $('.form-asmed-anak button[name="edit"]').css('display', 'inline')
                    $('.form-asmed-anak select[name="anamnesis"]').val(response.anamnesis).change()
                    $('.form-asmed-anak input[name="hubungan"]').val(response.hubungan)
                    $('.form-asmed-anak textarea[name="keluhan_utama"]').val(response.keluhan_utama)
                    $('.form-asmed-anak textarea[name="rps"]').val(response.rps)
                    $('.form-asmed-anak textarea[name="rpk"]').val(response.rpk)
                    $('.form-asmed-anak textarea[name="rpd"]').val(response.rpd)
                    $('.form-asmed-anak textarea[name="rpo"]').val(response.rpo)
                    $('.form-asmed-anak input[name="alergi"]').val(response.alergi)
                    $('.form-asmed-anak select[name="keadaan"]').val(response.keadaan).change()
                    $('.form-asmed-anak select[name="kesadaran"]').val(response.kesadaran).change()
                    $('.form-asmed-anak input[name="gcs"]').val(response.gcs)
                    $('.form-asmed-anak input[name="tb"]').val(response.tb)
                    $('.form-asmed-anak input[name="bb"]').val(response.bb)
                    $('.form-asmed-anak input[name="td"]').val(response.td)
                    $('.form-asmed-anak input[name="nadi"]').val(response.nadi)
                    $('.form-asmed-anak input[name="rr"]').val(response.rr)
                    $('.form-asmed-anak input[name="suhu"]').val(response.suhu)
                    $('.form-asmed-anak input[name="spo"]').val(response.spo)
                    $('.form-asmed-anak select[name="kepala"]').val(response.kepala).change()
                    $('.form-asmed-anak select[name="mata"]').val(response.mata).change()
                    $('.form-asmed-anak select[name="genital"]').val(response.genital).change()
                    $('.form-asmed-anak select[name="gigi"]').val(response.gigi).change()
                    $('.form-asmed-anak select[name="ekstremitas"]').val(response.ekstremitas).change()
                    $('.form-asmed-anak select[name="tht"]').val(response.tht).change()
                    $('.form-asmed-anak select[name="kulit"]').val(response.kulit).change()
                    $('.form-asmed-anak select[name="thoraks"]').val(response.thoraks).change()
                    $('.form-asmed-anak select[name="kontraksi"]').val(response.kontraksi).change()
                    $('.form-asmed-anak textarea[name="ket_fisik"]').val(response.ket_fisik)
                    $('.form-asmed-anak input[name="tfu"]').val(response.tfu)
                    $('.form-asmed-anak input[name="tbj"]').val(response.tbj)
                    $('.form-asmed-anak input[name="his"]').val(response.his)
                    $('.form-asmed-anak input[name="djj"]').val(response.djj)
                    $('.form-asmed-anak input[name="inspeksi"]').val(response.inspeksi)
                    $('.form-asmed-anak input[name="vt"]').val(response.vt)
                    $('.form-asmed-anak input[name="inspekulo"]').val(response.inspekulo)
                    $('.form-asmed-anak input[name="rt"]').val(response.rt)
                    $('.form-asmed-anak textarea[name="ultra"]').val(response.ultra)
                    $('.form-asmed-anak textarea[name="kardio"]').val(response.kardio)
                    $('.form-asmed-anak textarea[name="lab"]').val(response.lab)
                    $('.form-asmed-anak textarea[name="diagnosis"]').val(response.diagnosis)
                    $('.form-asmed-anak textarea[name="tata"]').val(response.tata)
                    $('.form-asmed-anak textarea[name="konsul"]').val(response.konsul)

                }
            })
        }


        function setAsmedRanapAnak(no_rawat) {
            getAsmedRanapAnak(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapAnak select[name=${index}]`);
                        input = $(`#formAsmedRanapAnak input[name=${index}]`);
                        textarea = $(`#formAsmedRanapAnak textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapAnak select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapAnak input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapAnak textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRanapAnak');
                }
            })
        }

        function setAsmedRanapKandungan(no_rawat) {
            getAsmedRanapKandungan(no_rawat).done((response) => {
                if (Object.keys(response).length) {
                    $.each(response, (index, value) => {
                        select = $(`#formAsmedRanapKandungan select[name=${index}]`);
                        input = $(`#formAsmedRanapKandungan input[name=${index}]`);
                        textarea = $(`#formAsmedRanapKandungan textarea[name=${index}]`);

                        if (select.length) {
                            $(`#formAsmedRanapKandungan select[name=${index}]`).val(value)
                        } else if (input.length) {
                            $(`#formAsmedRanapKandungan input[name=${index}]`).val(value)
                        } else {
                            $(`#formAsmedRanapKandungan textarea[name=${index}]`).val(value)
                        }
                    })
                } else {
                    setSoapToAsmed(no_rawat, '#formAsmedRanapKandungan');
                }
            })
        }
        $('#modalSoap').on('hidden.bs.modal', function() {
            formSoapPoli.trigger('reset');
            tbResepDokter.find('tbody').empty();
            tbResepRacikan.find('tbody').empty();
            $('button[data-bs-target="#tab-soap-pane"]').tab('show')
        });

        function getAsmedRajalKandungan(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/kandungan/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        function getAsmedAnak(noRawat) {
            const id = textRawat(noRawat, '-')
            const asmed = $.ajax({
                url: '/erm/poliklinik/asmed/anak/get/' + id,
                metho: `GET`,
                error: (request) => {
                    alertSessionExpired(request.status)
                },
            })
            return asmed;
        }

        $('#btnHasilKritis').on('click', () => {
            const no_rawat = formSoapPoli.find('input[name="no_rawat"]').val();
            hasilKritis(no_rawat)
        })
    </script>
@endpush
