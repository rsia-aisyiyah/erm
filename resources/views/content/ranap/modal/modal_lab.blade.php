<div class="modal fade" id="modalLabRanap" tabindex="-1" aria-labelledby="#modalLabRanapLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-scrollable modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalLabRanapLabel">PEMERIKSAAN PENUNJANG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2 gy-2" id="formInfoPasienPenunjang">
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="no_rawat">No. Rawat</label>
                        <input type="text" class="form-control form-control-sm"
                            id="no_rawat" name="no_rawat" placeholder="" readonly>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="">Pasien</label>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control form-control-sm"
                                id="no_rkm_medis" name="no_rkm_medis" placeholder="" readonly>
                                <input type="text" class="form-control form-control-sm w-50"
                                id="pasien" name="pasien" placeholder="" readonly>

                        </div>

                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="">Tgl. Lahir/Umur</label>
                        <input type="text" class="form-control form-control-sm"
                            id="tgl_lahir" name="tgl_lahir" placeholder="" readonly>

                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12">
                        <label for="">Keluarga</label>
                        <x-input id="p_jawab" name="p_jawab" />

                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="">Kamar</label>
                        <x-input id="kamar" name="kamar" readonly></x-input>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="diagnosa_awal">Diagnosa Awal</label>
                        <x-input id="diagnosa_awal" name="diagnosa_awal" readonly />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="penjab">Pembiayaan</label>
                        <x-input id="penjab" name="penjab" readonly />
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <label for="dokter_dpjp">Dokter DPJP</label>
                        <input type="text" class="form-control form-control-sm"
                            id="dokter_dpjp" name="dokter_dpjp" placeholder="" readonly>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="tabPenunjangRanap" role="tablist">
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
                <div class="tab-content p-2" id="myTabContent" style="height: 70vh">
                    <div class="tab-pane fade h-full show active" id="laborat-tab-pane" role="tabpanel" aria-labelledby="laborat-tab" tabindex="0">
                        <div class="row gy-2">
                            <div class="col-lg-8 col-sm-12">
                                <h5 class="text-center">HASIL PEMERIKSAAN LAB</h5>
                                <div id="hasilPermintaanLab">

                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12 mt-3">
                                <ul class="list-group text-sm" id='listRiwayatLabPasien'>

                                </ul>
                            </div>
                        </div>
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


                    </div>
                    <div class="tab-pane fade h-100" id="permintaan-laborat-tab-pane" role="tabpanel" aria-labelledby="permintaan-laborat-tab" tabindex="0">
                        @include('content.ranap.modal.penunjang.permintaan_lab')
                    </div>
                    <div class="tab-pane fade h-100" id="radiologi-tab-pane" role="tabpanel" aria-labelledby="radiologi-tab" tabindex="0">
                            <div class="row gy-2">
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <div class="row" id="viewHasilRadiologi" style="">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12">
                                    <ul class="list-group text-sm" id='listRiwayatRadiologiPasien'>

                                    </ul>
                                </div>
                            </div>
                    </div>
                    <div class="tab-pane fade h-100" id="permintaan-radiologi-tab-pane" role="tabpanel" aria-labelledby="permintaan-radiologi-tab" tabindex="0">
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
        const formInfoPasienPenunjang = $('#formInfoPasienPenunjang')

        function modalPemeriksaanPenunjang(no_rawat) {
            const tabPenunjang = $('#tabPenunjangRanap')
            tabPenunjang.find('.nav-link').removeClass('active')
            tabPenunjang.find('[data-bs-target="#laborat-tab-pane"]').addClass('active')

            const tabContent = $('.tab-content')
            tabContent.find('.tab-pane').removeClass('show active')
            tabContent.find('#laborat-tab-pane').addClass('show active')
            getRegPeriksa(no_rawat).done((regPeriksa) => {
                $('#modalLabRanap').modal('show')
                const kamar = regPeriksa.kamar_inap.filter((item) => {
                    return item.stts_pulang != 'Pindah Kamar'
                }).map((item) => {
                    return {
                        'bangsal': item.kamar ? item.kamar.bangsal.nm_bangsal : '-',
                        'diagnosa_awal': item?.diagnosa_awal
                    }
                })[0]

                setRiwayatLabPasien(regPeriksa.no_rkm_medis)

                formInfoPasienPenunjang.find('#no_rawat').val(no_rawat)
                formInfoPasienPenunjang.find('#pasien').val(`${regPeriksa.pasien.nm_pasien} (${regPeriksa.pasien.jk})`)
                formInfoPasienPenunjang.find('#no_rkm_medis').val(regPeriksa.no_rkm_medis)
                formInfoPasienPenunjang.find('#tgl_lahir').val(`${formatTanggal(regPeriksa.pasien.tgl_lahir)} / ${regPeriksa.umurdaftar} ${regPeriksa.sttsumur}`)
                formInfoPasienPenunjang.find('#p_jawab').val(regPeriksa.p_jawab)
                formInfoPasienPenunjang.find('#kamar').val(`${kamar ? `${kamar.bangsal} / ${hitungLamaHari(regPeriksa.tgl_registrasi)} Hari` :'-'}`)
                formInfoPasienPenunjang.find('#kd_dokter').val(regPeriksa.kd_dokter)
                formInfoPasienPenunjang.find('#dokter_dpjp').val(regPeriksa.dokter.nm_dokter)
                formInfoPasienPenunjang.find('#penjab').val(regPeriksa.penjab.png_jawab)

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

            getHasilPermintaanLab(no_rawat)
        }




        $('#tabPenunjangRanap')
            .find('[data-bs-target="#radiologi-tab-pane"]')
            .on('shown.bs.tab', () => {
                const no_rawat = formInfoPasienPenunjang.find('#no_rawat').val();
                const no_rkm_medis = formInfoPasienPenunjang.find('#no_rkm_medis').val();
                setHasilRadiologiRanap(no_rawat);
                setRiwayatRadiologiPasien(no_rkm_medis)
            });


        function setRiwayatRadiologiPasien(no_rkm_medis){
            const listRiwayatRadiologiPasien = $('#listRiwayatRadiologiPasien')
            $.get(`/erm/radiologi/riwayat/${no_rkm_medis}`).done((response)=>{
                const {data} = response;
                listRiwayatRadiologiPasien.empty()
                if(data.length === 0){
                    return false;
                }

                const list = data.map((item, index)=>{
                    return `<li class="list-group-item"  data-no-rawat="${item.no_rawat}" onclick="setHasilRadiologiRanap('${item.no_rawat}')">

                                <div class="d-flex w-100">
                                    <i class="me-2 bi bi-circle-fill f-5 ${item.status === 'ralan' ? 'text-warning' : 'text-purple'}"></i>
                                    <div class="w-100">
                                        <p class="mb-0">${formatTanggal(item.tgl_permintaan)}</p>
                                        <div class="d-flex w-100 justify-content-between gap-2">
                                        <p class="mb-0" style="font-size: 0.7rem">
                                               Dx. Klinis : ${item.diagnosa_klinis}
                                        </p>
                                        <p class="mb-0" style="font-size: 0.7rem">
                                              ${item.informasi_tambahan !== '-' ? `<i class="bi bi-info-circle-fill text-primary"></i> ${item.informasi_tambahan}` : ''}
                                        </p>
                                        </div>
                                    </div>
                                </div>

                    </li>`
                }).join('')

                listRiwayatRadiologiPasien.on('click', 'li', function () {
                    listRiwayatRadiologiPasien.find('li').removeClass('active');
                    $(this).addClass('active');
                });


                listRiwayatRadiologiPasien.html(list)


            })

        }
        function setRiwayatLabPasien(no_rkm_medis){
            const listRiwayatLabPasien = $('#listRiwayatLabPasien')
            $.get(`/erm/lab/riwayat/${no_rkm_medis}`).done((response)=>{
                const {data} = response;
                listRiwayatLabPasien.empty()
                if(data.length === 0){
                    return false;
                }

                const list = data.map((item, index)=>{
                    return `<li class="list-group-item"  data-no-rawat="${item.no_rawat}" onclick="getHasilPermintaanLab('${item.no_rawat}')">
                                <div class="d-flex w-100">
                                    <i class="me-2 bi bi-circle-fill f-5 ${item.status === 'ralan' ? 'text-warning' : 'text-purple'}"></i>
                                    <div class="w-100">
                                        <p class="mb-0">${formatTanggal(item.tgl_permintaan)}</p>
                                        <div class="d-flex w-100 justify-content-between gap-2">
                                        <p class="mb-0" style="font-size: 0.7rem">
                                               Dx. Klinis : ${item.diagnosa_klinis}
                                        </p>
                                        <p class="mb-0" style="font-size: 0.7rem">
                                               ${item.informasi_tambahan !== '-' ? `<i class="bi bi-info-circle-fill text-bg-primary"></i> ${item.informasi_tambahan}` : ''}
                                        </p>
                                        </div>
                                    </div>
                                </div>

                            </li>`
                }).join('')

                listRiwayatLabPasien.on('click', 'li', function () {
                    listRiwayatLabPasien.find('li').removeClass('active');
                    $(this).addClass('active');
                });

                listRiwayatLabPasien.html(list)
            })

        }

        function getHasilPermintaanLab(no_rawat) {
            $.get(`/erm/lab/permintaan`, {
                no_rawat: no_rawat
            }).done((response) => {
                let table = '';
                response.forEach((item, index) => {
                    table += `<div id="tablePenunjangLab${item.noorder}">
                        
                <div class="d-none d-flex align-items-center justify-content-between p-1 border infoPasien" style="font-size:11px">
                    <div class="p-2 bd-highlight fw-bold">No. Rawat : ${item.no_rawat} </div>
                    <div class="p-2 bd-highlight fw-bold">Nama : ${item.pasien.no_rkm_medis} -  ${item.pasien.nm_pasien}</div>
                    <div class="p-2 bd-highlight fw-bold">JK. : ${item.pasien.jk === 'L' ? 'Laki-laki' : 'Perempuan'}</div>
                    <div class="p-2 bd-highlight fw-bold">Tgl. Lahir : ${formatTanggal(item.pasien.tgl_lahir)}</div>
                </div>
                <div class="d-flex align-items-center justify-content-between bg-warning p-1" style="font-size:12px" onclick="renderToImagePenunjangLab('${item.noorder}')">
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
                                <td colspan="4" class="">Dokter PJ. Lab : <strong>${item.hasil[0]?.dokter.nm_dokter}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="">Saran : <strong>${item.saran_kesan? item.saran_kesan.saran : '-'}</strong></td>    
                                <td colspan="2" class="">Kesan : <strong>${item.saran_kesan? item.saran_kesan.kesan : '-'}</strong></td>    
                            </tr>
                    </tbody>
                </table>
                </div>`

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
                    <tr class="table-secondary">
                        <th colspan="4">${item.jns_perawatan_lab.nm_perawatan}</th>
                       
                    </tr>
                    ${detail}
                `
            })
            return html

        }

        function renderDetailHasilPemeriksaanLab(data) {
            return data.map((item) => {
                return `<tr class="${setWarnaPemeriksaan(item.keterangan)}" onclick="setTextHasil(this)">
                            <td>${item.template.Pemeriksaan}</td>
                            <td>${item.nilai} ${item.template.satuan}</td>
                            <td>${item.nilai_rujukan} ${item.template.satuan}</td>
                            <td>${item.keterangan}</td>
                        </tr>`
            }).join('');
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

        function renderToImagePenunjangLab(index) {
            const content = document.getElementById(`tablePenunjangLab${index}`);
            document.querySelector('.infoPasien').classList.remove('d-none');

            // Proses html2canvas
            html2canvas(content).then(function(canvas) {
                const imageDataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageDataURL;
                link.download = `${index}.png`;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);


                // Bisa kasih notifikasi sukses
                Swal.fire({
                    icon: 'success',
                    text: 'Gambar berhasil diunduh',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    document.querySelector('.infoPasien').classList.add('d-none');
                });

            }).catch(function(error) {
                Swal.close();
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: error.message
                });
            });
        }

        function setHasilRadiologiRanap(no_rawat) {
            const container = $('#viewHasilRadiologi');
            container.empty();

            getPermintaanRadiologi(no_rawat).done((permintaan) => {
                // if (!Array.isArray(permintaan) || permintaan.length === 0) {
                //     $('#viewHasilRadiologi').hide();
                //     $('#alertHasilRadiologi').show();
                //     return;
                // }
                //
                // $('#viewHasilRadiologi').show();
                // $('#alertHasilRadiologi').hide();

                permintaan.forEach((prm) => {
                    let jenisPemeriksaan = '';
                    let hasilPemeriksaan = '';
                    let tombolGambar = '';

                    // --- Jenis Pemeriksaan ---
                    prm.periksa_radiologi.forEach((periksa) => {
                        if (periksa.tgl_periksa === prm.tgl_hasil && periksa.jam === prm.jam_hasil) {
                            jenisPemeriksaan += `${periksa.jns_perawatan.nm_perawatan}<br>`;
                        }
                    });

                    // --- Hasil Pemeriksaan ---
                    prm.hasil_radiologi.forEach((hasil) => {
                        if (hasil.tgl_periksa === prm.tgl_hasil && hasil.jam === prm.jam_hasil) {
                            hasilPemeriksaan += `${stringPemeriksaan(hasil.hasil)}`;
                        }
                    });

                    // --- Gambar Radiologi ---
                    if (prm.gambar_radiologi.length) {
                        prm.gambar_radiologi.forEach((gambar) => {
                            if (gambar.tgl_periksa === prm.tgl_hasil && gambar.jam === prm.jam_hasil) {
                                const gbr = getBaseUrl(`/webapps/radiologi/${gambar.lokasi_gambar}`);
                                tombolGambar += `
                            <a class="btn btn-success btn-sm mb-2"
                               data-magnify="gallery"
                               data-src="${gbr}">
                               <i class="bi bi-eye me-1"></i> BUKA GAMBAR
                            </a><br>`;
                            }
                        });
                    } else {
                        tombolGambar = `
                    <button class="btn btn-danger btn-sm ms-auto" disabled>
                        <i class="bi bi-eye-slash me-1"></i> GAMBAR KOSONG
                    </button>`;
                    }

                    // --- Card Template ---
                    const card = `
                <div class="col">
                    <div class="card text-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="card-title m-0">
        <strong><i class="bi bi-calendar-event me-1"></i> ${splitTanggal(prm.tgl_hasil)} ${prm.jam_hasil}</strong>
    </h5>
    <div class="ms-auto">
        ${tombolGambar}
    </div>
</div>
                        <div class="card-body" style="font-size: 0.7rem">
                           <div class="d-flex gap-2 justify-content-between">
                                <div class="mb-2">
                                    <span class="fw-semibold text-secondary">Diagnosa Klinis:</span>
                                    <span>${prm.diagnosa_klinis || '-'}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-semibold text-secondary">Informasi Medis:</span>
                                    <span>${prm.informasi_tambahan || '-'}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="fw-semibold text-secondary">Jenis Pemeriksaan:</span>
                                    <span>${jenisPemeriksaan || '-'}</span>
                                </div>
                                <div class="mb-2">

                                </div>
                            </div>
                            <hr>
                            <div class="hasil-pemeriksaan"  >
                                <p class="fw-semibold mb-1">Hasil Pemeriksaan:</p>
                                <p class="mb-0">${hasilPemeriksaan || '-'}</p>

                            </div>
                        </div>
                    </div>
                </div>
            `;

                    container.append(card);
                });
            });
        }

    </script>
@endpush
