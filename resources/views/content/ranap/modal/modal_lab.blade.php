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
                        <div class="d-flex align-items-center justify-content-between" style="font-size: 12px" id="detailPasien">
                            <p class="m-0">No. Rawat : <span id="no_rawat"></span></p>
                            <p class="m-0">Nama / JK : <span id="nama_pasien"></span></p>
                            <p class="m-0">Tgl. Lahir / Umur : <span id="umur"></span></p>
                            <p class="m-0">DPJP : <span id="dokter"></span></p>
                        </div>
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
                        {{-- <table class="table table-bordered" width="100%">
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
                        </table> --}}

                        <div id="hasilPermintaanLab">

                        </div>
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
        const hasilPermintaanLab = $('#hasilPermintaanLab')
        const detailPasien = $('#detailPasien')

        function modalPemeriksaanPenunjang(no_rawat) {
            getHasilPermintaanLab(no_rawat)
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                $('#modalLabRanap').modal('show')
                detailPasien.find('#no_rawat').html(no_rawat)
                detailPasien.find('#dokter').html(regPeriksa.dokter.nm_dokter)
                formPermintaanLab.find('#no_rawat').val(no_rawat)
                formPermintaanLab.find('#dokter').val(regPeriksa.dokter.nm_dokter)
                formPermintaanLab.find('#kd_dokter').val(regPeriksa.kd_dokter)
                formPermintaanLab.find('#status').val(regPeriksa.status_lanjut.toLowerCase())

                formPermintaanRadiologi.find('#no_rawat').val(no_rawat)
                formPermintaanRadiologi.find('#kd_dokter').val(regPeriksa.kd_dokter)
                formPermintaanRadiologi.find('#dokter').val(regPeriksa.dokter.nm_dokter)
                formPermintaanRadiologi.find('#status').val(regPeriksa.status_lanjut.toLowerCase())

                detailPasien.find('#nama_pasien').html(`${regPeriksa.no_rkm_medis} ${regPeriksa.pasien.nm_pasien} / ${regPeriksa.pasien.jk}`)
                detailPasien.find('#umur').html(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
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

        function getHasilPermintaanLab(no_rawat) {
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                let table = '';

                response.forEach((item) => {
                    table += `
                    <div class="d-flex align-items-center justify-content-between bg-warning p-1" style="font-size:12px">
                        <div class="p-2 bd-highlight fw-bold">No. Order : ${item.noorder}</div>
                        <div class="p-2 bd-highlight fw-bold">Diagnosa Klinis : ${item.diagnosa_klinis}</div>
                        <div class="p-2 bd-highlight fw-bold">Informasi : ${item.informasi_tambahan}</div>
                        <div class="p-2 bd-highlight fw-bold">Tgl. Permintaan : ${splitTanggal(item.tgl_permintaan)} ${item.jam_permintaan}</div>    
                    </div>
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <td width="">Pemeriksaan</td>    
                                <td width="20%">Hasil</td>    
                                <td width="30%">Nilai Rujukan</td>    
                                <td width="20%">Keterangan</td>    
                            </tr>
                        </thead>
                        <tbody>
                                ${renderHasilPermintaanLab(item.hasil)}
                                <tr>
                                    <td colspan="4" class="">Dokter PJ. Lab : <strong>${item.hasil[0].dokter.nm_dokter}</strong></td>    
                                </tr>
                                <tr>
                                    <td colspan="2" class="">Saran : <strong>${item.saran_kesan? item.saran_kesan.saran : '-'}</strong></td>    
                                    <td colspan="2" class="">Kesan : <strong>${item.saran_kesan? item.saran_kesan.kesan : '-'}</strong></td>    
                                </tr>
                        </tbody>
                    </table>`

                })

                hasilPermintaanLab.html(table);

            })
        }


        function renderHasilPermintaanLab(data) {
            let html = '';
            data.forEach((item) => {
                const detail = item.detail.map((detail, index) => {
                    return `<tr class="${setWarnaPemeriksaan(detail.keterangan)}" onclick="setTextHasil(this)">
                            <td>${detail.template.Pemeriksaan}</td>
                            <td>${detail.nilai} ${detail.template.satuan}</td>
                            <td>${detail.nilai_rujukan} ${detail.template.satuan}</td>
                            <td>${detail.keterangan}</td>
                        </tr>`

                }).join('');
                html += `
                    <tr>
                        <th colspan="2">${item.jns_perawatan_lab.nm_perawatan}</th>
                        <th>${splitTanggal(item.tgl_periksa)} ${item.jam}</th>
                        <th>${item.petugas.nama}</th>
                    </tr>
                    ${detail}
                `
            })
            return html

        }


        $('#modalLabRanap').on('hidden.bs.modal', function() {
            $('#tabel-lab').empty()
            $('#tbHasilRadiologi tbody').empty()
            tableHasilPermintaan.find('tbody').empty();
            tableHasilPermintaan.addClass('d-none');

        })

        function setTextHasil(element) {

            const textHasil = $('#formHasilKritis').find('textarea[name="hasil"]');

            if (!textHasil) {
                return false;
            }

            const pemeriksaan = $(element).find('td:nth-child(1)').text()
            const hasil = $(element).find('td:nth-child(2)').text()
            const keterangan = $(element).find('td:nth-child(4)').text()

            let stringHasil = $('#formHasilKritis').find('textarea[name="hasil"]').val();

            stringHasil += `${pemeriksaan} : ${hasil}; \n`

            $('#formHasilKritis').find('textarea[name="hasil"]').val(stringHasil)



        }
    </script>
@endpush
