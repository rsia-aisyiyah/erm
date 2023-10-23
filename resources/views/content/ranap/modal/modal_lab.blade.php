<div class="modal fade" id="modalLabRanap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="exampleModalLabel">PEMERIKSAAN PENUNJANG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                        </table>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="laborat-tab" data-bs-toggle="tab" data-bs-target="#laborat-tab-pane" type="button" role="tab" aria-controls="laborat-tab-pane" aria-selected="true">Laboratorium</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="radiologi-tab" data-bs-toggle="tab" data-bs-target="#radiologi-tab-pane" type="button" role="tab" aria-controls="radiologi-tab-pane" aria-selected="false">Radiologi</button>
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
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                $('#modalLabRanap').modal('show')
                $('td#no_rawat').html(no_rawat)
                $('td#nama_pasien').html(`${regPeriksa.pasien.nm_pasien} / ${regPeriksa.pasien.jk}`)
                $('td#umur').html(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
            })
            getHasilLab(no_rawat).done((lab) => {
                let jenisPerawatan = '';
                let tglPeriksa = '';
                let hasil = '';
                lab.map((item, index) => {
                    if (jenisPerawatan != item.jns_perawatan_lab.kd_jenis_prw || tglPeriksa != item.tgl_periksa) {
                        hasil += `<tr class="borderless" style="background-color:#eee">
                            <td colspan="3"><strong>${item.jns_perawatan_lab.nm_perawatan}</strong><br/>
                            ${formatTanggal(item.tgl_periksa)} ${item.jam}</td>
                            <td>${item.periksa_lab.petugas.nama}</td></tr>
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
                    hasil += '<tr ' + warna + '>';
                    hasil += '<td>' + item.template.Pemeriksaan + '</td>';
                    hasil += '<td>' + item.nilai + ' ' + item.template.satuan +
                        '</td>';
                    hasil += '<td>' + item.nilai_rujukan + '</td>';
                    hasil += '<td>' + item.keterangan + '</td>';
                    hasil += '</tr>';

                    jenisPerawatan = item.jns_perawatan_lab.kd_jenis_prw;
                    tglPeriksa = item.tgl_periksa;
                })
                $('#tabel-lab').append(hasil)
            })
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
                                    gbr = `https://sim.rsiaaisyiyah.com/webapps/radiologi/${gambar.lokasi_gambar}`
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
        })
    </script>
@endpush
