<div class="modal fade" id="modalLabRanap" tabindex="-1" aria-labelledby="#modalLabRanapLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalLabRanapLabel">PEMERIKSAAN PENUNJANG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="height: 100vh">
                <div class="card mb-2 p-0">
                    <div class="card-body">
                        <table class="borderless">
                            <tr>
                                <td>Nomor Rawat</td>
                                <td>:</td>
                                <td id="no_rawat">

                                </td>
                            </tr>
                            <tr>
                                <td>Nama / JK</td>
                                <td>:</td>
                                <td id="nama_pasien">

                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir / Umur</td>
                                <td>:</td>
                                <td id="umur">

                                </td>
                            </tr>
                            <tr>
                                <td>Dokter DPJP</td>
                                <td>:</td>
                                <td id="dokter">

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="laborat-tab" data-bs-toggle="tab" data-bs-target="#laborat-tab-pane" type="button" role="tab" aria-controls="laborat-tab-pane" aria-selected="true">Laboratorium</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-laborat-tab" data-bs-toggle="tab" data-bs-target="#permintaan-laborat-tab-pane" type="button" role="tab" aria-controls="permintaan-laborat-tab-pane" aria-selected="true">Permintaan Lab</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="radiologi-tab" data-bs-toggle="tab" data-bs-target="#radiologi-tab-pane" type="button" role="tab" aria-controls="radiologi-tab-pane" aria-selected="false">Radiologi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="permintaan-radiologi-tab" data-bs-toggle="tab" data-bs-target="#permintaan-radiologi-tab-pane" type="button" role="tab" aria-controls="permintaan-radiologi-tab-pane" aria-selected="true">Permintaan Radiologi</button>
                    </li>
                </ul>
                <div class="tab-content p-2" id="myTabContent">
                    <div class="tab-pane fade show active" id="laborat-tab-pane" role="tabpanel" aria-labelledby="laborat-tab" tabindex="0">
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
                    <div class="tab-pane fade" id="permintaan-laborat-tab-pane" role="tabpanel" aria-labelledby="permintaan-laborat-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_lab')
                    </div>
                    <div class="tab-pane fade" id="radiologi-tab-pane" role="tabpanel" aria-labelledby="radiologi-tab" tabindex="0">
                        <small class="mb-3 px-2 py-1  fw-semibold text-danger bg-danger bg-opacity-10 border border-danger opacity-10 rounded-3" id="alertHasilRadiologi" style="display: none">Belum / Tidak dilakukan pemeriksaan radiologi</small>
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
                    <div class="tab-pane fade" id="permintaan-radiologi-tab-pane" role="tabpanel" aria-labelledby="permintaan-radiologi-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_radiologi')
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i
                        class="bi bi-x-circle"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        function modalPemeriksaanPenunjang(no_rawat) {
            getHasilLab(no_rawat).done((lab) => {
                let hasilLab = '';
                lab.forEach((item, index) => {
                    if (item.detail.length) {
                        hasilLab += `<tr class="borderless" style="background-color:#eee;padding:2px">
                            <td colspan="3">
                                <p class="ms-3 mb-0"><strong>${item.jns_perawatan_lab.nm_perawatan}</strong><br/>
                                ${formatTanggal(item.tgl_periksa)} ${item.jam}</p>
                            </td>
                            <td>${item.petugas.nama}</td></tr>`;
                        item.detail.forEach((detail, index) => {
                            hasilLab += `<tr ${setWarnaPemeriksaan(detail.keterangan)}>
                                <td>${detail.template.Pemeriksaan}</td>
                                <td>${detail.nilai} ${detail.template.satuan}</td>
                                <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                                <td>${detail.keterangan}</td></tr>`
                        })
                    }
                })
                $('#tabel-lab').append(hasilLab)

            })
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                $('#modalLabRanap').modal('show')
                $('td#no_rawat').html(no_rawat)
                $('td#dokter').html(regPeriksa.dokter.nm_dokter)
                formPermintaanLab.find('#no_rawat').val(no_rawat)
                formPermintaanLab.find('#dokter').val(regPeriksa.dokter.nm_dokter)
                formPermintaanLab.find('#kd_dokter').val(regPeriksa.kd_dokter)
                formPermintaanLab.find('#status').val(regPeriksa.status_lanjut.toLowerCase())

                formPermintaanRadiologi.find('#no_rawat').val(no_rawat)
                formPermintaanRadiologi.find('#kd_dokter').val(regPeriksa.kd_dokter)
                formPermintaanRadiologi.find('#dokter').val(regPeriksa.dokter.nm_dokter)
                formPermintaanRadiologi.find('#status').val(regPeriksa.status_lanjut.toLowerCase())

                $('td#nama_pasien').html(`${regPeriksa.no_rkm_medis} ${regPeriksa.pasien.nm_pasien} / ${regPeriksa.pasien.jk}`)
                $('td#umur').html(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
            })

            getPermintaanRadiologi(no_rawat).done((permintaan) => {
                if (Object.keys(permintaan).length) {
                    permintaan.map((prm, index) => {
                        html = `<tr><td>${splitTanggal(prm.tgl_hasil)} ${prm.jam_hasil}</td>
                            <td>${prm.diagnosa_klinis}</td>
                            <td>${prm.informasi_tambahan}</td>
                            <td>`
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

        }



        $('#modalLabRanap').on('hidden.bs.modal', function() {
            $('#tabel-lab').empty()
            $('#tbHasilRadiologi tbody').empty()
            tableHasilPermintaan.find('tbody').empty();
            tableHasilPermintaan.addClass('d-none');

        })
    </script>
@endpush
