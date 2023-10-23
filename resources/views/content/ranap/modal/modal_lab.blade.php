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
                                        <th>Petugas</th>
                                        <th>Jenis Pemeriksaan</th>
                                        <th>Proyeksi & Dosis</th>
                                        <th>Hasil</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            {{-- <h3 class="fs-5 text-center">HASIL PEMERIKSAAN RADIOLOGI</h3>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="image-set">
                                    <a class="btn btn-success btn-sm mb-2" id="btnMagnifyImage" data-magnify="gallery" data-src="">
                                        <i class="bi bi-eye"></i> LAYAR PENUH
                                    </a>
                                    <br />
                                    <img id="gambarRadiologi" class="img-thumbnail position-relative" style="padding: 10px" width="100%">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form action="" id="formHasilRadiologi">
                                    <div class="row" id="pemeriksaanRadiologi">

                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                            <label for="petugas">Petugas Radiologi</label>
                                            <input type="text" class="form-control form-control-sm" id="petugas" name="petugas" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                            <label for="jns_perawatan">Jenis Pemeriksaan</label>
                                            <input type="text" class="form-control form-control-sm" id="jns_perawatan" name="jns_perawatan" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-4">
                                            <label for="tgl_sampel">Tanggal & Jam Sampling</label>
                                            <input type="text" class="form-control form-control-sm" id="tgl_sampel" name="tgl_sampel" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <label for="proyeksi">Proyeksi</label>
                                            <input type="text" class="form-control form-control-sm" id="proyeksi" name="proyeksi" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <label for="kv">KV</label>
                                            <input type="text" class="form-control form-control-sm" id="kv" name="kv" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <label for="inak">Inak</label>
                                            <input type="text" class="form-control form-control-sm" id="inak" name="inak" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-3">
                                            <label for="jml_penyinaran">Jml. Penyinaran</label>
                                            <input type="text" class="form-control form-control-sm" id="jml_penyinaran" name="jml_penyinaran" placeholder="" readonly>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="Hasil Radiologi">Hasil Radiologi</label>
                                            <textarea class="form-control" id="hasil" name="hasil" cols="8" rows="18" name="hasil" readonly></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
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
            getPeriksaRadiologi(no_rawat).done((radiologi) => {
                if (Object.keys(radiologi).length) {
                    html = `<table class="table table-striped text-sm table-sm">
                        <tr>
                            <td>Tanggal Sampel</td>
                            <td>Petugas</td>
                            <td>Jenis Pemeriksaan</td>
                            <td>Proyeksi & Dosis</td>
                            <td>Hasil</td>
                            <td>Gambar</td>
                            </tr> 
                            `
                    radiologi.map((radItem, index) => {
                        let hasilRadiologi = '';
                        // let gambar = radItem.gambar_radiologi ? `https://sim.rsiaaisyiyah.com/webapps/radiologi/${response.gambar_radiologi.lokasi_gambar}` : "{{ asset('/img/default.png') }}"

                        radItem.hasil_radiologi.map((hasil) => {
                            if (hasil.tgl_periksa == radItem.tgl_periksa && hasil.jam == radItem.jam) {
                                hasilRadiologi = stringPemeriksaan(hasil.hasil)
                            }
                        })
                        html = `<tr>
                                    <td>${splitTanggal(radItem.permintaan_radiologi.tgl_sampel)} ${radItem.permintaan_radiologi.jam_sampel}</td>
                                    <td>${radItem.petugas.nama}</td>
                                    <td>${radItem.jns_perawatan.nm_perawatan}</td>
                                    <td>Proyeksi : ${radItem.proyeksi},<br/> kV : ${radItem.kV},<br/> Inak : ${radItem.inak},<br/> Jml. Penyinaran : ${radItem.jml_penyinaran},<br/> Dosis : ${radItem.dosis}</td>
                                    <td>${hasilRadiologi}</td>
                                    <td width="20%"><img id="img${index}" class="img-thumbnail" style="max-width:100%;height:auto"/></td>
                                    </tr>`

                        $('#tbHasilRadiologi tbody').append(html)

                        let gambar = "";
                        if (Object.keys(radItem.gambar_radiologi).length) {
                            radItem.gambar_radiologi.map((imgx, i) => {
                                if (imgx.tgl_periksa == radItem.tgl_periksa && imgx.jam == radItem.jam) {
                                    gambar = `https://sim.rsiaaisyiyah.com/webapps/radiologi/${imgx.lokasi_gambar}`
                                } else {
                                    gambar = "{{ asset('img/default.png') }}"
                                }
                            })

                        } else {
                            gambar = "{{ asset('img/default.png') }}"
                        }
                        gbr = document.getElementById(`img${index}`);
                        gbr.setAttribute('src', gambar)

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
